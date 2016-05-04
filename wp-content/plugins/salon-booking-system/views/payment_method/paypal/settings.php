
    <div class="col-xs-12"><h2 class="sln-box-title"><?php _e('Informatii despre contul PayPal','salon-booking-system');?></h2></div>
        <div class="col-xs-12 col-sm-6 col-md-4 sln-input--simple">
            <?php $adminSettings->row_input_text('pay_paypal_email', __('Scrie PayPal e-mail adresa', 'salon-booking-system')); ?>
            <p class="sln-input-help"><?php _e('-','salon-booking-system');?></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-5 sln-checkbox">
        	<?php $adminSettings->row_input_checkbox('pay_paypal_test', __('Permite PayPal ', 'salon-booking-system')); ?>
        	<p class="sln-input-help"><?php _e('Bifați această opțiune pentru a testa PayPal plati<br /> folosindu-va PayPal account.', 'salon-booking-system') ?></p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 sln-box-maininfo  align-top">
            <p class="sln-input-help"><?php _e('Bifati aceasta optiune pentru a testa PayPal plati
accesind PayPal account.','salon-booking-system');?></p>
        </div>

