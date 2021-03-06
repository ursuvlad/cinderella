<div class="row sln-summary">
    <div class="col-md-12">
        <div class="row sln-summary-row">
            <div class="col-sm-6 col-md-6 sln-data-desc"><?php _e('Data si ora rezervarii', 'salon-booking-system') ?></div>
            <div class="col-sm-6 col-md-6 sln-data-val">
                <?php echo $plugin->format()->date($datetime); ?> / <?php echo $plugin->format()->time($datetime) ?>
            </div>
            <div class="col-sm-12 col-md-12"><hr></div>
        </div>
        <?php if($attendants = $bb->getAttendants()) :  ?>
            <div class="row sln-summary-row">
                <div class="col-sm-6 col-md-6 sln-data-desc"><?php _e('Asistent', 'salon-booking-system') ?></div>
                <div class="col-sm-6 col-md-6 sln-data-val"><?php $names = array(); foreach(array_unique($attendants) as $att) { $names[] = $att->getName(); } echo implode(', ', $names); ?></div>
                <div class="col-sm-12 col-md-12"><hr></div>
            </div>
        <?php // IF ASSISTANT
        endif ?>
        <div class="row sln-summary-row">
            <div class="col-sm-6 col-md-6 sln-data-desc"><?php _e('Serviciile rezervate', 'salon-booking-system') ?></div>
            <div class="col-sm-6 col-md-6 sln-data-val">
                <ul class="sln-list--dashed">
                    <?php foreach ($bb->getServices() as $service): ?>
                        <li><?php echo $service->getName(); ?>
                            <?php if($showPrices){?>
                                <small> (<?php echo $plugin->format()->money($service->getPrice()) ?>)</small>
                            <?php } ?>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
            <div class="col-sm-12 col-md-12"><hr></div>
        </div>
    </div>
    <div class="col-md-12 sln-total">
        <hr>
        <?php if($showPrices){?>
            <div class="row">
                <h3 class="col-xs-6 sln-total-label"><?php _e('Suma totala', 'salon-booking-system') ?></h3>
                <h3 class="col-xs-6 sln-total-price"><?php echo $plugin->format()->money(
                        $plugin->getBookingBuilder()->getTotal()
                    ) ?> </h3>
            </div>
        <?php }; ?>
    </div>
    <div class="col-md-12 sln-input sln-input--simple">
        <label><?php _e('Aveti vriun mesaj pentru noi?', 'salon-booking-system') ?></label>
        <?php SLN_Form::fieldTextarea(
            'sln[note]',
            $bb->get('note'),
            array('attrs' => array('placeholder' => __('Lasati un mesaj', 'salon-booking-system')))
        ); ?>
    </div>
    <div class="col-md-12">
        <p><strong><?php _e('Termeni & conditii','salon-booking-system')?></strong></p>

        <p><?php echo $plugin->getSettings()->get('gen_timetable')
            /*_e(
                'In case of delay of arrival. we will wait a maximum of 10 minutes from booking time. Then we will release your reservation',
                'salon-booking-system'
            )*/ ?></p>
    </div>
</div>
<div class="row sln-box--main sln-box--formactions">
    <div class="col-md-12">
        <label for="login_name">&nbsp;</label>
        <?php $nextLabel = __('Finisare', 'salon-booking-system');
        include "_form_actions.php" ?>
    </div>
</div>
