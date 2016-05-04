<?php
/**
 * @var SLN_Plugin $plugin
 * @var string $formAction
 * @var string $submitName
 * @var SLN_Shortcode_Salon_Step $step
 */
$bb = $plugin->getBookingBuilder();
$valid = isset($_SESSION['sln_sms_valid']) ? $_SESSION['sln_sms_valid'] : false;
$currentStep = $step->getShortcode()->getCurrentStep();
$ajaxData = "sln_step_page=$currentStep&submit_$currentStep=1";
$ajaxEnabled = $plugin->getSettings()->isAjaxEnabled();
$style = $step->getShortcode()->getStyleShortcode();
$size = SLN_Enum_ShortcodeStyle::getSize($style);
?>
<?php if (isset($_GET['resend'])): ?>
    <div class="alert alert-success">
        <p><?php _e('SMS sent successfully.') ?></p>
    </div>
<?php endif ?>
<h2><?php _e('SMS Verificare', 'salon-booking-system') ?>
    <br/>
    <em><?php _e('Noi vam trimis un SMS text pe numarul dumneavoastra.', 'salon-booking-system') ?></em>
</h2>
<form method="post" action="<?php echo $formAction ?>" role="form">
    <?php if ($valid): ?>
        <div class="alert alert-success">
            <p><?php _e('Numarul dumneavoastra este confirmat', 'salon-booking-system') ?></p>
        </div>
        <?php include "_form_actions.php" ?>
    <?php else: ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="<?php echo SLN_Form::makeID('sln_verification') ?>">
                        <?php _e('cifre de verificare a codului', 'salon-booking-system'); ?>
                    </label>
                </div>
            </div>
                        <div class="col-md-6">
                <div class="form-group">
                   <?php SLN_Form::fieldText('sln_verification', '', array('required' => true)) ?>
                    <a href="<?php echo $formAction ?>&resend=1" class="recover"
                        <?php if($ajaxEnabled): ?>
                       data-salon-data="<?php echo $ajaxData.'&resend=1' ?>" data-salon-toggle="direct"
                        <?php endif ?>>
                        <?php _e('Nu am primit codul va rog sa-l transmiteti din nou', 'salon-booking-system') ?>
                    </a>
                </div>
            </div>
        </div>
        <?php include '_errors.php'; ?>
        <?php include "_form_actions.php"; ?>
    <?php endif ?>
</form>

