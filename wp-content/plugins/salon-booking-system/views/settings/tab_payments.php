<div class="sln-tab" id="sln-tab-payments">
<div class="sln-box sln-box--main">
    <h2 class="sln-box-title"><?php _e('Plateste on-line<span>Se permite utilizatorilor sa plateasca in avans folosind una dintre metodele de plata.</span>','salon-booking-system');?></h2>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 form-group sln-switch">
            <?php $this->row_input_checkbox_switch(
                'plata_activata',
                'Starea de plata on-line',
                array(
                    'help' => __('Se permite utilizatorilor să plătească în avans prin PayPal.','salon-booking-system'),
                    'bigLabelOn' => 'Plata on-line este activata',
                    'bigLabelOff' => 'Plata on-line este dezactivata'
                    )
            ); ?>
        </div>
        <div class="col-md-4 col-sm-4 form-group sln-box-maininfo align-top">
            <p class="sln-input-help"><?php _e('Daca este activata trebuie sa configurati una dintre metodele de plata disponibile.','salon-booking-system');?></p>
        </div>
    </div>
    <div class="sln-box-info">
       <div class="sln-box-info-trigger"><button class="sln-btn sln-btn--main sln-btn--small sln-btn--icon sln-icon--info">info</button></div>
       <div class="sln-box-info-content row">
       <div class="col-md-4 col-sm-8 col-xs-12">
       <h5><?php _e('In the future we\'ll provide more detailed information about this specific option.','salon-booking-system');?></h5>
        </div>
        </div>
        <div class="sln-box-info-trigger"><button class="sln-btn sln-btn--main sln-btn--small sln-btn--icon sln-icon--close">info</button></div>
    </div>
</div>

<div class="sln-box sln-box--main">
    <h2 class="sln-box-title"><?php _e('Vezi preturile','salon-booking-system') ?></h2>
    <div class="row">
        <div class="col-sm-6 form-group">
        <div class="sln-checkbox">
            <?php $this->row_input_checkbox('hide_prices', __('Ascunde pretul', 'salon-booking-system')); ?>
        </div>
        </div>
        <div class="col-md-4 col-sm-4 form-group sln-box-maininfo align-top">
            <p class="sln-input-help"><?php _e('Selectati acesta obtiune daca doriti sa ascundeti toate preturile.<br/>Nota: Plata on-line va fi dezactivata.', 'salon-booking-system') ?></p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
    <div class="sln-box sln-box--main sln-box--main--small">
    <h2 class="sln-box-title"><?php _e('Plateste mai tirziu','salon-booking-system');?></span></h2>
    <div class="row">
            <div class="col-xs-12 form-group sln-switch">
                <?php $this->row_input_checkbox_switch(
                'pay_cash',
                'Pay later status',
                array(
                    'help' => __('Ofera obtiunea clientului de a plati cind va fi la salon.','salon-booking-system'),
                    'bigLabelOn' => 'Plata mai triziu este activata',
                    'bigLabelOff' => 'Plata mai tirziu este dezactivata'
                    )
            ); ?>
            </div>
        </div>
        <div class="sln-box-info">
       <div class="sln-box-info-trigger"><button class="sln-btn sln-btn--main sln-btn--small sln-btn--icon sln-icon--info">info</button></div>
       <div class="sln-box-info-content row">
       <div class="col-xs-12">
       <h5><?php _e('Pe parcurs venim cu informatie specificata acestei obtiuni.','salon-booking-system');?></h5>
        </div>
        </div>
        <div class="sln-box-info-trigger"><button class="sln-btn sln-btn--main sln-btn--small sln-btn--icon sln-icon--close">info</button></div>
    </div>
    </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
    <div class="sln-box sln-box--main sln-box--main--small">
    <h2 class="sln-box-title"><?php _e('Acorda un depozit','salon-booking-system');?></h2>
    <div class="row">
            <div class="col-xs-12 form-group sln-select  sln-select--info-label">
            <label for="salon_settings_pay_deposit"><?php _e('Acorda un depozit de ','salon-booking-system') ?></label>
            <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
            <?php echo SLN_Form::fieldSelect(
                        'salon_settings[pay_deposit]',
                        array(
                            '0' => "entire amount (disabled)",
                            '10' => "10%",
                            '20' => "20%",
                            '30' => "30%",
                            '40' => "40%",
                            '50' => "50%",
                            '60' => "60%",
                            '70' => "70%",
                            '80' => "80%",
                            '90' => "90%",
                        ),
                        $this->settings->get('acorda_depozit'),
                        array(

'help' => __('Utilizatorii doresc sa plateasca %% doar din suma totala.','salon-booking-system'),
                            ),
                        true
                    ) ?>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 sln-label--big">
            <label for="salon_settings_pay_deposit"><?php _e('din total','salon-booking-system');?></label>
            </div>
            </div>
        </div>
        </div>
        <div class="sln-box-info">
       <div class="sln-box-info-trigger"><button class="sln-btn sln-btn--main sln-btn--small sln-btn--icon sln-icon--info">info</button></div>
       <div class="sln-box-info-content row">
       <div class="col-xs-12">
       <h5><?php _e('Pe parcurs venim cu informatie specificata acestei obtiuni.','salon-booking-system');?></h5>
        </div>
        </div>
        <div class="sln-box-info-trigger"><button class="sln-btn sln-btn--main sln-btn--small sln-btn--icon sln-icon--close">info</button></div>
    </div>
    </div>
    </div>
</div>

<div class="sln-box sln-box--main">
    <h2 class="sln-box-title"><?php _e('Valuta','salon-booking-system');?></h2>
    <div class="row">
            <div class="col-sm-6 col-md-4 form-group sln-select ">
                <label for="salon_settings_pay_currency"><?php _e('Setati moneda','salon-booking-system') ?></label>
                <?php echo SLN_Form::fieldCurrency(
                    "salon_settings[pay_currency]",
                    $this->settings->getCurrency()
                ) ?>
            </div>
            <div class="col-sm-6 col-md-4 form-group sln-select ">
                <label for="salon_settings_pay_currency_pos"><?php _e('Setati pozitia valutara','salon-booking-system') ?></label>
                 <?php echo SLN_Form::fieldSelect(
                        'salon_settings[pay_currency_pos]',
                        array('left' => __('pe partea stinga'),'right' => __('pe partea dreapta')),
                        $this->settings->get('pay_currency_pos'),
                        array(),
                        true
                    ) ?>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 sln-box-maininfo  align-top">
                <p class="sln-input-help"><?php _e('Daca doriti o noua moneda ce urmeaza sa fie adaugata va rugam sa ne transmiteti un e-mail la support@wpchef.it','salon-booking-system');?></p>
            </div>
            </div>
</div>

<div class="sln-box sln-box--main">
    <h2 class="sln-box-title"><?php _e('Metoda de plata','salon-booking-system');?></h2>
    <div class="row">
<?php
$current_payment_method = $this->settings->getPaymentMethod();
foreach(SLN_Enum_PaymentMethodProvider::toArray() as $method => $name){
	$checked = ($current_payment_method == $method) ?  'checked="checked"' : '';
?>
		<div class="sln-radiobox sln-radiobox--fullwidth salon_settings_pay_method col-sm-4">
            <input class="sln-pay_method-radio" id="salon_settings_availability_mode--<?php echo $method?>" type="radio" name="salon_settings[pay_method]" value="<?php echo $method?>" data-method="<?php echo $method?>" <?php echo $checked; ?> >
            <label for="salon_settings_availability_mode--<?php echo $method?>"><?php echo $name?></label>
        </div>
<?php } ?>

        <div class="col-sm-4 sln-box-maininfo  align-top">
            <p class="sln-input-help"><?php _e('In cazul in care dorit sa integram un nou getway de plata personalizat, va rugam sa ne consultati <strong>custom_payment_gateway.txt</strong> fisierul in interiorul pluginului.','salon-booking-system');?></p>
        </div>
    </div>
    <?php
    foreach(SLN_Enum_PaymentMethodProvider::toArray() as $k => $v){
        ?><div class="sln-box--sub row payment-mode-data"  style="display: none;" id="payment-mode-<?php echo $k?>"><?php
        echo SLN_Enum_PaymentMethodProvider::getService($k, $this->plugin)->renderSettingsFields(
            array('adminSettings' => $this));
        ?></div><?php
    }
?>
<div class="clearfix"></div>
</div>
<!--
    <div class="row">
        <div class="col-md-4 col-sm-6">
			<?php $settings=$this->hidePriceSettings();?>
            <?php $this->row_input_checkbox('plata_activata', __('Plata on-line activata', 'salon-booking-system'),$settings); ?>
            <p><?php _e('Se permite utilizatorilor sa plateasca in avans.', 'salon-booking-system') ?></p>
        </div>
        <div class="col-md-4 col-sm-6">
            <?php $this->row_input_checkbox('plata_cash', __('Activati obtiunea "Platiti mai triziu"', 'salon-booking-system')); ?>
            <p><?php _e('Ofera utilizatorilor optiunea de a plati odată ce acestea sunt la salon.', 'salon-booking-system') ?></p>
        </div>
    </div>


    <div class="row">
        <div class="col-md-3 col-sm-4">
             <label for="salon_settings_pay_currency"><?php _e('Setati moneda','salon-booking-system') ?></label>
                <?php echo SLN_Form::fieldCurrency(
                    "salon_settings[pay_currency]",
                    $this->settings->getCurrency()
                ) ?>
        </div>
        <div class="col-md-3 col-sm-4">
             <label for="salon_settings_pay_currency_pos"><?php _e('Setati pozitia valutara','salon-booking-system') ?></label>
                 <?php echo SLN_Form::fieldSelect(
                        'salon_settings[pay_currency_pos]',
                        array('left' => __('pe partea stinga'),'right' => __('pe partea dreapta')),
                        $this->settings->get('pay_currency_pos'),
                        array(),
                        true
                    ) ?>
        </div>
 
    </div> 
    <div class="row">
        <div class="col-md-3 col-sm-4">
             <label for="salon_settings_pay_currency_pos"><?php _e('Metoda de plata','salon-booking-system') ?></label>
                 <?php echo SLN_Form::fieldSelect(
                        'salon_settings[pay_method]',
                        SLN_Enum_PaymentMethodProvider::toArray(),
                        $this->settings->getPaymentMethod(),
                        array(),
                        true
                    ) ?>
        </div>
    </div>
<?php 
    foreach(SLN_Enum_PaymentMethodProvider::toArray() as $k => $v){
        ?><div class="payment-mode-data" id="payment-mode-<?php echo $k?>"><?php
        echo SLN_Enum_PaymentMethodProvider::getService($k, $this->plugin)->renderSettingsFields(array('adminSettings' => $this));
        ?></div><?php
    }
?>
    <div class="row">
        <div class="col-md-6 col-sm-6">
             <label for="salon_settings_pay_deposit"><?php _e('Acorda un depozit ','salon-booking-system') ?></label>
                 <?php echo SLN_Form::fieldSelect(
                        'salon_settings[pay_deposit]',
                        array(
                            '0' => "entire amount (disabled)",
                            '10' => "10%",
                            '20' => "20%",
                            '30' => "30%",
                            '40' => "40%",
                            '50' => "50%",
                            '60' => "60%",
                            '70' => "70%",
                            '80' => "80%",
                            '90' => "90%",
                        ),
                        $this->settings->get('acorda_depozit'),
                        array(),
                        true
                    ) ?>
        </div>
    </div>
    -->
</div>
<div class="clearfix"></div>
