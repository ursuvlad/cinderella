<?php

$alert = __(
    'Aceasta regula reprezinta zilele deschise si inchise, tura. Setati cu atentie deoarece acesta va afecta sistemul de rezervare.',
    'salon-booking-system'
);

if (empty($row) || !isset($row['from'])) {
    $row = array('from' => array('9:00', '14:00'), 'to' => array('13:00', '19:00'));
}
if (empty($rulenumber)) {
    $rulenumber = 'New';
}
?>
<div class="col-xs-12 sln-booking-rule">
    <h2 class="sln-box-title"><?php _e('Rule', 'salon-booking-system'); ?> <strong><?php echo $rulenumber; ?></strong>
    </h2>
    <h6 class="sln-fake-label"><?php _e('Zilele libere verificate, verde.', 'salon-booking-system'); ?></h6>
    <div class="sln-checkbutton-group">
        <?php foreach (SLN_Func::getDays() as $k => $day) : ?>
            <div class="sln-checkbutton">
                <?php SLN_Form::fieldCheckboxButton(
                    $prefix."[days][{$k}]",
                    (isset($row['days'][$k]) ? 1 : null),
                    $label = substr($day, 0, 3)
                ) ?>
            </div>
        <?php endforeach ?>
        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-8 sln-slider-wrapper">
            <h6 class="sln-fake-label"><?php _e('In primul rind schimbarea', 'salon-booking-system'); ?></h6>
            <div class="sln-slider">
                <div class="sliders_step1 col col-slider">
                    <div class="slider-range"></div>
                </div>
                <div class="col col-time">
                    <span class="slider-time-from">9:00</span>
                    to <span class="slider-time-to">16:00</span>
                    <input type="text" name="<?php echo $prefix ?>[from][0]" id=""
                           value="<?php echo $row['from'][0] ? $row['from'][0] : "9:00" ?>"
                           class="slider-time-input-from hidden">
                    <input type="text" name="<?php echo $prefix ?>[to][0]" id=""
                           value="<?php echo $row['to'][0] ? $row['to'][0] : "13:00" ?>"
                           class="slider-time-input-to hidden">
                </div>
                <div class="clearfix"></div>
            </div>
            <h6 class="sln-fake-label"><?php _e('In aldoilea rind schimbarea', 'salon-booking-system'); ?></h6>
            <div class="sln-slider">
                <div class="sliders_step1 col col-slider">
                    <div class="slider-range"></div>
                </div>
                <div class="col col-time">
                    <span class="slider-time-from">9:00</span> to <span class="slider-time-to">16:00</span>
                    <input type="text" name="<?php echo $prefix ?>[from][1]" id=""
                           value="<?php echo $row['from'][1] ? $row['from'][1] : "14:00" ?>"
                           class="slider-time-input-from hidden">
                    <input type="text" name="<?php echo $prefix ?>[to][1]" id=""
                           value="<?php echo $row['to'][1] ? $row['to'][1] : "19:00" ?>"
                           class="slider-time-input-to hidden">
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4 sln-box-maininfo  align-top">
            <p class="sln-input-help"><?php echo $alert ?></p>
            <button class="sln-btn sln-btn--problem sln-btn--big sln-btn--icon sln-icon--trash"
                    data-collection="remove"><?php echo __('Elimina', 'salon-booking-system') ?></button>
        </div>
    </div>
</div>
