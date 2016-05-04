<?php
/**
 * @var $plugin SLN_Plugin
 */
$from = $plugin->getSettings()->get('hours_before_from');
$to = $plugin->getSettings()->get('hours_before_to');
?>
<h2 class="sln-box-title"><?php _e('Rezervari on-line de sincronizare','salon-booking-system');?> <span>-</span></h2>
<div class="sln-box--sub row">
    <div class="col-xs-12"><h2 class="sln-box-title"><?php _e('Interval de timp de rezervare <span>Intervalul de timp defini in care clientii pot rezerva o programare</span><','salon-booking-system');?>/h2></div>
    <div class="col-xs-12 col-sm-6 col-md-4 form-group sln-select  sln-select--info-label">
        <label for="salon_settings_hours_before_from"><?php _e('Star interval','salon-booking-system');?></label>
        <div class="row">
            <div class="col-xs-7">
                <?php $field = "salon_settings[hours_before_from]"; ?>
                <?php echo SLN_Form::fieldSelect(
                    $field,
                    SLN_Func::getIntervalItems(),
                    $from,
                    array(),
                    true
                ) ?>
            </div>
            <div class="col-xs-5 sln-label--big"><label for="salon_settings_hours_before_from"><?php _e('Minimum','salon-booking-system');?></label></div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4 form-group sln-select   sln-select--boxedoptions sln-select--info-label">
        <label for="salon_settings_hours_before_to"><?php _e('Stop interval','salon-booking-system');?></label>
        <div class="row">
            <div class="col-xs-7">
                <?php $field = "salon_settings[hours_before_to]"; ?>
                <?php echo SLN_Form::fieldSelect(
                    $field,
                    SLN_Func::getIntervalItems(),
                    $to,
                    array(),
                    true
                ) ?>
            </div>
            <div class="col-xs-5 sln-label--big"><label for="salon_settings_hours_before_to"><?php _e('Maximum','salon-booking-system');?></label></div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4 sln-box-maininfo  align-top">
        <p class="sln-input-help"><?php _e('Daca doriti ca de exemplu ca clientul dvs. sa poata face o rezervare pina la doua zile inainte de data numirii si cel mult o luna inainte pe acest interval setati regula dorita.','salon-booking-system');?></p>
    </div>
</div>