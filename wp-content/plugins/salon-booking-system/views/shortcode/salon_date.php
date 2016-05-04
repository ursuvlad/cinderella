<?php
/**
 * @var SLN_Plugin $plugin
 * @var string $formAction
 * @var string $submitName
 */
if ($plugin->getSettings()->isDisabled()) {
    $message = $plugin->getSettings()->getDisabledMessage();
    ?>
    <div class="sln-alert sln-alert--problem">
        <?php echo empty($message) ? __('Rezervarea online este dezactivata', 'salon-booking-system') : $message ?>
    </div>
    <?php
} else {
    if ($timezone = get_option('timezone_string')) {
        date_default_timezone_set($timezone);
    }
    $bb = $plugin->getBookingBuilder();
    $intervals = $plugin->getIntervals($bb->getDateTime());
    $date = $intervals->getSuggestedDate();
    $intervalsArray = $intervals->toArray();
    if (!$intervalsArray['times']):
        $hb = $plugin->getAvailabilityHelper()->getHoursBeforeHelper()->getToDate();
        ?>
        <div class="sln-alert sln-alert--problem">
            <p><?php echo __('Nu exista mai multe sloturi disponibile pina la', 'salon-booking-system') ?><?php echo $plugin->format(
                )->datetime($hb) ?></p>
        </div>
    <?php else: ?>
        <form method="post" action="<?php echo $formAction ?>" id="salon-step-date"
              data-intervals="<?php echo esc_attr(json_encode($intervals->toArray())); ?>">
            <h2 class="salon-step-title"><?php _e('Cind vrei sa vii?', 'salon-booking-system') ?></h2>
            <?php include '_salon_date_pickers.php' ?>
            <?php include '_errors.php'; ?>
        </form>
    <?php endif ?>
    <?php
}