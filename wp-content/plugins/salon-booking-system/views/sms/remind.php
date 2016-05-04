<?php
/**
 * @var SLN_Plugin          $plugin
 * @var SLN_Wrapper_Booking $booking
 */
echo 
__('Salut ','salon-booking-system') . $booking->getFirstname() . ' ' . $booking->getLastname()

. __('Nu uitati de rezervare ','salon-booking-system'). $plugin->getSettings()->getSalonName()
. __(' pe ','salon-booking-system') . $plugin->format()->date($booking->getDate()) 
. __(' la ','salon-booking-system') . $plugin->format()->time($booking->getTime())
. __(' Rezervare ID ','salon-booking-system') .$booking->getId();