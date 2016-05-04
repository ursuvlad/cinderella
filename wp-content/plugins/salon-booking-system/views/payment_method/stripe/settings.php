
    <div class="col-xs-12"><h2 class="sln-box-title"><?php _e('Informatii despre cont','salon-booking-system');?></h2></div>
        <div class="col-xs-12 col-sm-4 sln-input--simple">
            <?php $adminSettings->row_input_text('pay_stripe_apiKey', __('Introduceti cheia Stripe ', 'salon-booking-system')); ?>
            <p class="sln-input-help"><?php _e('-','salon-booking-system');?></p>
        </div>
        <div class="col-xs-12 col-sm-4 sln-input--simple">
            <?php $adminSettings->row_input_text('pay_stripe_apiKeyPublic', __('Itroduceti cheia Stripe ', 'salon-booking-system')); ?>
        <p class="sln-input-help"><?php _e('-','salon-booking-system');?></p>
        </div>
        <div class="col-xs-12 col-sm-4 sln-box-maininfo  align-top">
            <p class="sln-input-help"><?php _e('Pentru a utiliza aceasta metoda aveti nevoie de un acount Stripe.','salon-booking-system');?></p>
        </div>

