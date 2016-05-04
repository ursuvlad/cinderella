<?php
/**
 * @var SLN_Plugin $plugin
 * @var string $formAction
 * @var string $submitName
 * @var SLN_Shortcode_Salon_AttendantStep $step
 * @var SLN_Wrapper_Attendant[] $attendants
 */

$ah = $plugin->getAvailabilityHelper();
$ah->setDate($plugin->getBookingBuilder()->getDateTime());
$duration = new SLN_DateTime('1970-01-01 '.$bb->getDuration());
$hasAttendants = false;
$style = $step->getShortcode()->getStyleShortcode();
$size = SLN_Enum_ShortcodeStyle::getSize($style);
?>
<div class="sln-attendant-list">
    <?php foreach ($attendants as $attendant) {
        $validateAttServicesErrors = $ah->validateAttendantServices($attendant, $bb->getServices());

        if (!empty($validateAttServicesErrors)) {
            continue;
        }
        
        $validateErrors = $ah->validateAttendant($attendant, $bb->getDateTime(), $duration);
        if ($validateErrors && $validateAttServicesErrors) {
            $errors = array_merge($validateErrors, $validateAttServicesErrors);
        } elseif ($validateErrors) {
            $errors = $validateErrors;
        } elseif ($validateAttServicesErrors) {
            $errors = $validateAttServicesErrors;
        } else {
            $errors = false;
        }

        $settings = array();
        if ($errors) {
            $settings['attrs']['disabled'] = 'disabled';
        }
        if ($size == '900') {
            include '_attendants_item_900.php';
        } elseif ($size == '600') {
            include '_attendants_item_600.php';
        } elseif ($size == '400') {
            include '_attendants_item_400.php';
        } else {
            throw new Exception('size not supported');
        }
        $hasAttendants = true;
    } ?>
    <?php if (!$hasAttendants) : ?>
        <div class="alert alert-warning">
            <p><?php echo __(
                    'Nu exista asistenti disponibili pentru perioada selectata, va rugam sa selectati alta perioada',
                    'salon-booking-system'
                ) ?></p>
        </div>
    <?php endif ?>
</div>
