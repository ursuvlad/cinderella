<?php
/**
 * @var SLN_Plugin                $plugin
 * @var SLN_Wrapper_Booking       $booking
 */
if(!isset($data['to'])){    // algolplus fix
    $data['to'] = $booking->getEmail();
}
if ($plugin->getSettings()->get('attendant_email')
    && ($attendant = $booking->getAttendant())
    && ($email = $attendant->getEmail())
) {
    $data['to'] = array($data['to'], $email);
}

$data['subject'] = __('Calendarul rezervarilor','salon-booking-system')
    . ' ' . $plugin->format()->date($booking->getDate()) 
    . ' - ' . $plugin->format()->time($booking->getTime());

include dirname(__FILE__).'/_header.php';
include dirname(__FILE__).'/_status_canceled_content.php';
include dirname(__FILE__).'/_footer.php';