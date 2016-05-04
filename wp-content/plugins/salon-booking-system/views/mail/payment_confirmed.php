<?php
/**
 * @var SLN_Plugin                $plugin
 * @var SLN_Wrapper_Booking       $booking
 */
$data['to'] = $booking->getEmail();
$data['subject'] = sprintf(__('Plata pentru rezervare %s a fost confirmata','salon-booking-system'),$booking->getId());
include dirname(__FILE__).'/_header.php';
?>
<p ><?php _e('Cu drag', 'salon-booking-system') ?>
    <strong><?php echo esc_attr($booking->getFirstname()) . ' ' . esc_attr($booking->getLastname()); ?></strong>
    <br/>
    <?php _e('Am primit plata pentru rezervare.', 'salon-booking-system') ?>
</p>
<?php
include dirname(__FILE__).'/_footer.php';
?>
