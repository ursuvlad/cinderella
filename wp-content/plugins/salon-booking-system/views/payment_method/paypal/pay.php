        <a data-salon-data="<?php echo $ajaxData.'&mode='.$paymentMethod->getMethodKey() ?>" data-salon-toggle="direct"
        href="<?php echo $payUrl ?>" class="">
            <?php $deposit = $plugin->getBookingBuilder()->getLastBooking()->getDeposit(); ?> 
            <?php if($deposit > 0): ?>
                <?php echo sprintf(__('Plata %s cu un depozit %s', 'salon-booking-system'), $plugin->format()->money($deposit), $paymentMethod->getMethodLabel()) ?>
            <?php else : ?>
                <?php echo sprintf(__('Plateste cu %s', 'salon-booking-system'), $paymentMethod->getMethodLabel()) ?>
            <?php endif ?>
        </a>
