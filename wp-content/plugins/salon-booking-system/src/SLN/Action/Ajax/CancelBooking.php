<?php // algolplus

class SLN_Action_Ajax_CancelBooking extends SLN_Action_Ajax_Abstract
{
	private $errors = array();

	public function execute()
	{
		if($timezone = get_option('timezone_string'))
			date_default_timezone_set($timezone);

		if (!is_user_logged_in()) {
			return array( 'redirect' => wp_login_url());
		}

		$ret = array();
		$plugin = SLN_Plugin::getInstance();
		$booking = $plugin->createBooking($_POST['id']);

		$available = $booking->getUserId() == get_current_user_id();
		$cancellationEnabled = $plugin->getSettings()->get('cancellation_enabled');
		$outOfTime = (strtotime($booking->getStartsAt())-current_time('timestamp')) < $plugin->getSettings()->get('hours_before_cancellation') * 3600;

		if ($cancellationEnabled && !$outOfTime && $available) {
			$booking->setStatus(SLN_Enum_BookingStatus::CANCELED);
			$booking = $plugin->createBooking($_POST['id']);

			$args = compact('booking');

			$args['forAdmin'] = true;
			$args['to'] = get_option('admin_email');
			$plugin->sendMail('mail/status_canceled', $args);
		} elseif (!$available) {
			$this->addError(__("Nu aveti acces", 'salon-booking-system'));
		} elseif (!$cancellationEnabled) {
			$this->addError(__('Dezactivare de anulare', 'salon-booking-system'));
		} elseif ($outOfTime) {
			$this->addError(__('Ramas fara timp', 'salon-booking-system'));
		}

		if ($errors = $this->getErrors()) {
			$ret = compact('errors');
		} else {
			$ret = array('success' => 1);
		}

		return $ret;
	}

	protected function addError($err)
	{
		$this->errors[] = $err;
	}

	public function getErrors()
	{
		return $this->errors;
	}
}