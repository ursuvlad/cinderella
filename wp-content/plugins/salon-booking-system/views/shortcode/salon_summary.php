<?php
/**
 * @var SLN_Plugin $plugin
 * @var string $formAction
 * @var string $submitName
 * @var SLN_Shortcode_Salon_Step $step
 */
$bb = $plugin->getBookingBuilder();
$currencySymbol = $plugin->getSettings()->getCurrencySymbol();
$datetime = $bb->getDateTime();
$confirmation = $plugin->getSettings()->get('confirmation');
$showPrices = ($plugin->getSettings()->get('hide_prices') != '1') ? true : false;
$style = $step->getShortcode()->getStyleShortcode();
$size = SLN_Enum_ShortcodeStyle::getSize($style);
?>
<form method="post" action="<?php echo $formAction ?>" role="form" id="salon-step-summary">
    <h2 class="salon-step-title"><?php _e('Detaliile rezervarii', 'salon-booking-system') ?></h2>
    <div class="row">
        <div class="col-md-8">
            <p class="sln-text--dark"><?php _e('Cu drag', 'salon-booking-system') ?>
                <strong><?php echo esc_attr($bb->get('prenume')).' '.esc_attr($bb->get('nume')); ?></strong>
                <br/>
                <?php _e('Aici detalii despre rezervare:', 'salon-booking-system') ?>
            </p>
        </div>
    </div>
    <?php
    if ($size == '900') {
        include '_salon_summary_900.php';
    } elseif ($size == '600') {
        include '_salon_summary_600.php';
    } elseif ($size == '400') {
        include '_salon_summary_400.php';
    } else {
        throw new Exception('dimensiune neacceptata');
    } ?>
</form>