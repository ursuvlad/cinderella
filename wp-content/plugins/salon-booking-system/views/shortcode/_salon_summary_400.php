<div class="row sln-summary">
    <div class="col-md-12">
        <div class="row sln-summary-row">
            <div class="col-xs-12 sln-data-desc"><span class="label"><?php _e('Data si ora rezervarii', 'salon-booking-system') ?></span></div>
            <div class="col-xs-12 sln-data-val">
                <?php echo $plugin->format()->date($datetime); ?> / <?php echo $plugin->format()->time($datetime) ?>
            </div>
            <div class="col-xs-12"><hr></div>
        </div>
        <?php if($attendants = $bb->getAttendants()) :  ?>
            <div class="row sln-summary-row">
                <div class="col-xs-12 sln-data-desc"><span class="label"><?php _e('Asistent', 'salon-booking-system') ?></span></div>
                <div class="col-xs-12 sln-data-val"><?php $names = array(); foreach(array_unique($attendants) as $att) { $names[] = $att->getName(); } echo implode(', ', $names); ?></div>
                <div class="col-xs-12"><hr></div>
            </div>
        <?php // IF ASSISTANT // END
        endif ?>
        <div class="row sln-summary-row">
            <div class="col-xs-12 sln-data-desc"><span class="label"><?php _e('Serviciile rezervate', 'salon-booking-system') ?></span></div>
            <div class="col-xs-12 sln-data-val">
                <ul class="sln-list--dashed">
                    <?php foreach ($bb->getServices() as $service): ?>
                        <li> <span class="service-label"><?php echo $service->getName(); ?></span>
                            <?php if($showPrices){?>
                                <small> (<?php echo $plugin->format()->money($service->getPrice()) ?>)</small>
                            <?php } ?>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
            <div class="col-md-12"><hr></div>
        </div>
    </div>
    <div class="col-md-12 sln-total">
        <hr>
        <?php if($showPrices){?>
            <h3 class="col-xs-6 sln-total-label"><?php _e('Suma totala', 'salon-booking-system') ?></h3>
            <h3 class="col-xs-6 sln-total-price"><?php echo $plugin->format()->money(
                    $plugin->getBookingBuilder()->getTotal()
                ) ?> </h3>
        <?php }; ?>
    </div>
    <div class="col-md-12 sln-input sln-input--simple">
        <label><?php _e('Ai vriun mesaj pentru noi?', 'salon-booking-system') ?></label>
        <?php SLN_Form::fieldTextarea(
            'sln[note]',
            $bb->get('note'),
            array('attrs' => array('placeholder' => __('Lasa mesajul', 'salon-booking-system')))
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
<div class="row">
    <div class="col-xs-12 sln-input sln-input--action">
        <label for="login_name">&nbsp;</label>
        <?php $nextLabel = __('Finalizat', 'salon-booking-system');
        include "_form_actions.php" ?>
    </div>
</div>
