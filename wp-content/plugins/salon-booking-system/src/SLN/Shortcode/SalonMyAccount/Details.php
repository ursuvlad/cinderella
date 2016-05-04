<?php // algolplus

class SLN_Shortcode_SalonMyAccount_Details
{
	const NAME = 'salon_booking_my_account_details';

	private $plugin;
	private $attrs;

	function __construct(SLN_Plugin $plugin, $attrs)
	{
		$this->plugin = $plugin;
		$this->attrs = $attrs;
	}

	public static function init(SLN_Plugin $plugin)
	{
		add_shortcode(self::NAME, array(__CLASS__, 'create'));
	}

	public static function create($attrs)
	{
		if($timezone = get_option('timezone_string'))
			date_default_timezone_set($timezone);


		$obj = new self(SLN_Plugin::getInstance(), $attrs);

		$ret = $obj->execute();
		if($timezone = get_option('timezone_string'))
			date_default_timezone_set('UTC');
		return $ret;
	}

	public function execute()
	{
		if (!is_user_logged_in()) {
			return false;
		}
		$accountBookings = new SLN_Helper_Availability_MyAccountBookings();

		return $this->render(array(
				'upcoming' => $this->prepareBookings($accountBookings->getBookings(get_current_user_id(), 'future')),
				'history' => $this->prepareBookings($accountBookings->getBookings(get_current_user_id())),
				'cancellation_enabled' => $this->plugin->getSettings()->get('cancellation_enabled'),
				'seconds_before_cancellation' => $this->plugin->getSettings()->get('hours_before_cancellation') * 3600,
				'gen_phone' => $this->plugin->getSettings()->get('gen_phone'),
				'cancelled' => !empty($_POST['option']) && $_POST['option'] = 'cancelled' ? true : false,
				'user_name' => wp_get_current_user()->user_firstname,
				'gen_name' => $this->plugin->getSettings()->get('gen_name'),
				'hide_prices' => $this->plugin->getSettings()->get('hide_prices'),
				'attendant_enabled' => $this->plugin->getSettings()->get('attendant_enabled'),
		));
	}

	private function prepareBookings($bookings)
	{
		$result = array();
		foreach ( $bookings as $booking ) {
			$result[] = $this->prepareBooking($booking);
		}

		return $result;
	}

	private function prepareBooking($booking) {
        $format = $this->plugin->format();
        $serviceNames = array();
        foreach($booking->getServices() as $s){
            $serviceNames[] = $s->getName();
        }

		$total = $format->money($booking->getAmount());
        if (SLN_Enum_BookingStatus::PAID == $booking->getStatus() && $deposit = $booking->getDeposit()) {
	        $total .= ' (' . $format->money($deposit) . ' ' .
	                  __('already paid as deposit','salon-booking-system') . ')';
        }
		return array(
			'id' => $booking->getId(),
			'date' => $format->datetime($booking->getStartsAt()),
			'timestamp' => strtotime($booking->getStartsAt()),
			'services' => implode("<br>", $serviceNames),
			'assistant' => $booking->getAttendantsString(),
			'total' => $total,
			'status' => SLN_Enum_BookingStatus::getLabel($booking->getStatus()),
			'status_code' => $booking->getStatus(),
			'rating' => $booking->getRating(),
		);
	}

	protected function render($data)
	{
		return $this->plugin->loadView('shortcode/salon_my_account_details', compact('data'));
	}

}
