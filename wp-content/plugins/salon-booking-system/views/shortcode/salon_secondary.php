<?php
/**
 * @var SLN_Plugin                        $plugin
 * @var string                            $formAction
 * @var string                            $submitName
 * @var SLN_Shortcode_Salon_ServicesStep $step
 */
$bb = $plugin->getBookingBuilder();
$services = $step->getServices();

$style = $step->getShortcode()->getStyleShortcode();
$size = SLN_Enum_ShortcodeStyle::getSize($style);
?>
<form id="salon-step-secondary" method="post" action="<?php echo $formAction ?>" role="form">
<h2 class="salon-step-title"><?php _e('Ceva mai mult?','salon-booking-system')?></h2>
<?php
	if ($size == '900') { ?>
		<div class="row sln-box--main">
			<div class="col-md-8"><?php include "_services.php"; ?></div>
			<div class="col-md-4"><?php include "_form_actions.php" ?></div>
		</div>
	<?php
	// IF SIZE 900 // END
	} else if ($size == '600') { ?>
		<div class="row sln-box--main"><div class="col-md-12"><?php include "_services.php"; ?></div></div>
		<div class="row sln-box--main sln-box--formactions">
           <div class="col-md-12">
           <?php include "_form_actions.php" ?></div>
        </div>
	<?php
	// IF SIZE 600 // END
	} else if ($size == '400') { ?>
		<div class="row sln-box--main"><div class="col-md-12"><?php include "_services.php"; ?></div></div>
		<div class="row sln-box--main"><div class="col-md-12"><?php include "_form_actions.php" ?></div></div>
	<?php
	// IF SIZE 400 // END
	} else  { ?>
	<?php
	// ELSE // END
	}
?>
</form>
