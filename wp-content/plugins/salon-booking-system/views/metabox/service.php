<?php
$helper->showNonce($postType);
?>

<div class="row sln-service-price-time">
<!-- default settings -->
    <div class="col-sm-6 col-md-3 form-group sln-input--simple">
            <label><?php _e('Pretul', 'salon-booking-system') . ' (' . $settings->getCurrencySymbol() . ')' ?></label>
            <?php SLN_Form::fieldText($helper->getFieldName($postType, 'pret'), $service->getPrice()); ?>
    </div>
    <div class="col-sm-6 col-md-3 form-group sln-select">
            <label><?php _e('Unitatea pe ora', 'salon-booking-system'); ?></label>
            <?php SLN_Form::fieldNumeric($helper->getFieldName($postType, 'unitate'), $service->getUnitPerHour()); ?>
    </div>
    <div class="col-sm-6 col-md-3 form-group sln-select">
            <label><?php _e('Durata', 'salon-booking-system'); ?></label>
            <?php SLN_Form::fieldTime($helper->getFieldName($postType, 'durata'), $service->getDuration()); ?>
    </div>
    <div class="col-sm-6 col-md-3 form-group sln-checkbox">
                         <?php SLN_Form::fieldCheckbox($helper->getFieldName($postType, 'secondary'), $service->isSecondary()) ?>
            <label for="_sln_service_secondary"><?php _e('Secundar', 'salon-booking-system'); ?></label>
                    <p><?php _e('Selectati aceasta optiune daca doriti ca acest serviciu sa fie considerat ca serviciu de nivel secundar','salon-booking-system'); ?></p>
    </div>
    <div class="sln-clear"></div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-3 form-group sln-select">
        <label><?php _e('Executie comandar', 'salon-booking-system'); ?></label>
        <?php SLN_Form::fieldNumeric($helper->getFieldName($postType, 'exec_order'), $service->getExecOrder(), array('min' => 1, 'max' => 10, 'attrs' => array())) ?>
    </div>
    <div class="col-sm-6 col-md-9 form-group sln-box-maininfo align-top">
        <p class="sln-input-help"><?php _e('Utilizati un numar pentru a da acest serviciu un ordin de executie in comparatie cu celelalte servicii.','salon-booking-system'); ?></p>
        <p class="sln-input-help"><?php _e('Luati in considerare faptul ca aceasta optiune va afecta disponibilitatea membrilor personalului dvs. pe care le-ati asociat cu acest serviciu.','salon-booking-system'); ?></p>
    </div>
    <div class="sln-clear"></div>
</div>
<?php echo $plugin->loadView(
    'settings/_tab_booking_rules',
    array(
        'availabilities' => $service->getMeta('availabilities'),
        'base' => '_sln_service_availabilities',
    )
); ?>
<div class="sln-clear"></div>