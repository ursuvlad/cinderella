<?php // algolplus

class SLN_Helper_Availability_MyAccountBookings
{
	private $date;
	private $bookings;

	public function __construct()
	{
		$this->date = new DateTime();
	}

	private function buildBookings($user, $mode)
	{
		$args = array(
			'post_type'  => SLN_Plugin::POST_TYPE_BOOKING,
			'nopaging'   => true,
			'meta_query' => array(
				array(
					'key'     => '_sln_booking_date',
					'value'   => $this->date->format('Y-m-d'),
					'compare' => $mode == 'past' ? '<' : '>=',
				)
			),
			'author' => $user
		);
		$query = new WP_Query($args);
		$ret = array();
		foreach ($query->get_posts() as $p) {
			$ret[] = SLN_Plugin::getInstance()->createBooking($p);
		}
		wp_reset_query();
		wp_reset_postdata();
		usort(
				$ret,
				$mode == 'past' ? array($this, 'sortDescByStartsAt') : array($this, 'sortAscByStartsAt')
		);

		SLN_Plugin::addLog(__CLASS__.' - buildBookings('.$this->date->format('Y-m-d').', ' . $mode . ')');
		foreach($ret as $b)
			SLN_Plugin::addLog(' - '.$b->getId());
		return $ret;
	}

	/**
	 * @param SLN_Wrapper_Booking $a
	 * @param SLN_Wrapper_Booking $b
	 *
	 * @return int
	 */
	private function sortAscByStartsAt($a, $b) {
		return (strtotime($a->getStartsAt()->format('Y-m-d H:i:s')) > strtotime($b->getStartsAt()->format('Y-m-d H:i:s')) ? 1 : -1 );
	}

	/**
	 * @param SLN_Wrapper_Booking $a
	 * @param SLN_Wrapper_Booking $b
	 *
	 * @return int
	 */
	private function sortDescByStartsAt($a, $b) {
		return (strtotime($a->getStartsAt()->format('Y-m-d H:i:s')) >= strtotime($b->getStartsAt()->format('Y-m-d H:i:s')) ? -1 : 1 );
	}

	public function getBookings($user, $mode = 'past')
	{
		$this->bookings = $this->buildBookings($user, $mode);
		return $this->bookings;
	}
}