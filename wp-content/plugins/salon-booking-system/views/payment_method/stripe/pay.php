<form method="POST" action="<?php echo $booking->getPayUrl() ?>&mode=<?php echo $paymentMethod->getMethodKey() ?>">
<script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="<?php echo $paymentMethod->getApiKeyPublic()?>"
<?php /*    data-image="/img/documentation/checkout/marketplace.png"
    data-name="Stripe.com"
*/?>
    data-description="Booking #<?php echo $booking->getId() ?>"
    data-amount="<?php echo intval($booking->getToPayAmount() * 100) ?>"
    data-label="<?php $deposit = $plugin->getBookingBuilder()->getLastBooking()->getDeposit(); ?>
            <?php if($deposit > 0): ?>
                <?php echo sprintf(__('Plateste %s un depozit defined(name) %s', 'salon-booking-system'), $plugin->format()->money($deposit), $paymentMethod->getMethodLabel()) ?>
            <?php else : ?>
                <?php sprintf(__('Plateste cu %s', 'salon-booking-system'), $paymentMethod->getMethodLabel()) ?>
            <?php endif ?>"
    data-email="<?php echo $booking->getEmail() ?>"
    data-currency="<?php echo $plugin->getSettings()->getCurrency() ?>"
    data-locale="auto">
  </script>
</form>
