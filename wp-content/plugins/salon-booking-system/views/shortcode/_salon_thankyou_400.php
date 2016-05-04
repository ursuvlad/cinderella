<div class="col-md-12">
    <?php if($confirmation) : ?>
        <h2 class="salon-step-title"><?php _e('Starea rezervarii', 'salon-booking-system') ?></h2>
    <?php else : ?>
        <h2 class="salon-step-title"><?php _e('Confirmarea rezervarii', 'salon-booking-system') ?></h2>
    <?php endif ?>

    <?php include '_errors.php'; ?>

    <?php if (isset($payOp) && $payOp == 'cancel'): ?>

        <div class="alert alert-danger">
            <p><?php _e('Plata este nu a reușit, vă rugăm să încercați din nou.', 'salon-booking-system') ?></p>
        </div>

    <?php else: ?>
        <div class="row sln-thankyou--okbox <?php if($confirmation): ?> sln-bkg--attention<?php else : ?> sln-bkg--ok<?php endif ?>">
            <div class="col-md-12">
                <h1 class="sln-icon-wrapper"><?php echo $confirmation ? __('Rezervarea dumneavoastră este în așteptare', 'salon-booking-system') : __('Rezervarea dvs. este finalizată', 'salon-booking-system') ?>
                    <?php if($confirmation): ?>
                        <i class="sln-icon sln-icon--time"></i>
                    <?php else : ?>
                        <i class="sln-icon sln-icon--checked--square"></i>
                    <?php endif ?>
                </h1>
            </div>
            <div class="col-md-12"><hr></div>
            <div class="col-md-12">
                <h2 class="salon-step-title"><?php _e('Numarul rezervarii', 'salon-booking-system') ?></h2>
                <h3><?php echo $plugin->getBookingBuilder()->getLastBooking()->getId() ?></h3>
            </div>
        </div>
        <?php $ppl = false; ?>
        <?php include '_salon_thankyou_alert.php' ?>
    <?php endif ?>
</div>
<div class="col-md-12 sln-form-actions-wrapper sln-input--action">
    <?php if($paymentMethod): ?>
        <div class="sln-form-actions sln-payment-actions row">
            <div class="col-md-12">
                <div class="sln-btn sln-btn--emphasis sln-btn--noheight sln-btn--fullwidth">
                    <?php echo $paymentMethod->renderPayButton(compact('booking', 'paymentMethod', 'ajaxData', 'payUrl')); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if($paymentMethod && $plugin->getSettings()->get('pay_cash')): ?>
        <div class="sln-form-actions sln-payment-actions row">
            <div class="col-md-8 pull-right">
                <a  href="<?php echo $laterUrl ?>" class="sln-btn sln-btn--emphasis sln-btn--big sln-btn--fullwidth"
                    <?php if($ajaxEnabled): ?>
                        data-salon-data="<?php echo $ajaxData.'&mode=later' ?>" data-salon-toggle="direct"
                    <?php endif ?>>
                    <?php _e('Plateste mai tirziu', 'salon-booking-system') ?>
                </a>
            </div>
            <div class="col-md-4 pull-right">
                <h4><?php _e('Sau', 'salon-booking-system') ?></h4>
            </div>
        </div>
    <?php elseif(!$paymentMethod) : ?>
        <div class="form-actions row">
            <div class="col-sm-12 col-md-8 pull-right">
                <a  href="<?php echo $laterUrl ?>" class="sln-btn sln-btn--emphasis sln-btn--big sln-btn--fullwidth"
                    <?php if($ajaxEnabled): ?>
                        data-salon-data="<?php echo $ajaxData.'&mode=later' ?>" data-salon-toggle="direct"
                    <?php endif ?>>
                    <?php _e('Complet', 'salon-booking-system') ?>
                </a>
            </div>
        </div>
    <?php endif ?>
</div>
