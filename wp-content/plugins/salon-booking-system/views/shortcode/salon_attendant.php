<?php
/**
 * @var SLN_Plugin                        $plugin
 * @var string                            $formAction
 * @var string                            $submitName
 * @var SLN_Shortcode_Salon_AttendantStep $step
 * @var bool                              $isMultipleAttSelection
 */
$bb = $plugin->getBookingBuilder();
$attendants = $step->getAttendants();
$style = $step->getShortcode()->getStyleShortcode();
$size = SLN_Enum_ShortcodeStyle::getSize($style);
?>
<form id="salon-step-attendant" method="post" action="<?php echo $formAction ?>" role="form">
<h2 class="salon-step-title"><?php _e($isMultipleAttSelection && count($bb->getServices()) > 1 ? 'Selectati asistentii' : 'Selecteaza asistentul tau','salon-booking-system')?></h2>
<?php
	if ($size == '900') { ?>
		<div class="row sln-box--main sln-attendants-wrapper">
			<div class="col-md-8">
			<?php if ($isMultipleAttSelection) {
		       		include "_m_attendants.php";
			    } else {
			        include "_attendants.php";
			    } ?>
		    </div>
			<div class="col-md-4 sln-box--formactions">
	           <div class="col-md-12">
	           <?php include "_form_actions.php" ?></div>
	        </div>
		</div>
	<?php
	// IF SIZE 900 // END
	} else if ($size == '600') { ?>
		<div class="row sln-box--main sln-attendants-wrapper"><div class="col-md-12">
		<?php if ($isMultipleAttSelection) {
		       		include "_m_attendants.php";
			    } else {
			        include "_attendants.php";
			    } ?>
		</div></div>
		<div class="row sln-box--main sln-box--formactions">
           <div class="col-md-12">
           <?php include "_form_actions.php" ?></div>
        </div>
	<?php
	// IF SIZE 600 // END
	} else if ($size == '400') { ?>
		<div class="row sln-box--main sln-attendants-wrapper"><div class="col-md-12">
		<?php if ($isMultipleAttSelection) {
		       		include "_m_attendants.php";
			    } else {
			        include "_attendants.php";
			    } ?>
		</div></div>
		<div class="row sln-box--main sln-box--formactions"><div class="col-md-12"><?php include "_form_actions.php" ?></div></div>
	<?php
	// IF SIZE 400 // END
	} else  { ?>
	<?php
	// ELSE // END
	}
?>
</form>
