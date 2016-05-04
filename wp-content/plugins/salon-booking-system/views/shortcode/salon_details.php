<?php
/**
 * @var SLN_Plugin                $plugin
 * @var string                    $formAction
 * @var string                    $submitName
 * @var SLN_Shortcode_Salon_Step $step
 */
$bb = $plugin->getBookingBuilder();
$style = $step->getShortcode()->getStyleShortcode();
$size = SLN_Enum_ShortcodeStyle::getSize($style);
global $current_user;
get_currentuserinfo();
$values = array(
    'firstname' => $current_user->user_firstname,
    'lastname'  => $current_user->user_lastname,
    'email'     => $current_user->user_email,
    'phone'     => get_user_meta($current_user->ID, '_sln_phone', true)
);
?>
<?php if (!is_user_logged_in()): ?>
    <form method="post" action="<?php echo $formAction ?>" role="form">
        <h2 class="salon-step-title"><?php _e('Client inregistrat?', 'salon-booking-system') ?> <?php _e('Va rugam sa va inregistrati.', 'salon-booking-system') ?> </h2>
    <?php
    if ($size == '900') { ?>
        <div class="row">
            <div class="col-sm-6 col-md-4 sln-input sln-input--simple">
                <label for="login_name"><?php _e('E-mail') ?></label>
                <input name="login_name" type="text" class="sln-input sln-input--text"/>
                <span class="help-block"><a href=" <?php echo wp_lostpassword_url($formAction) ?>" class="tec-link"><?php _e('Ati uitat parola?', 'salon-booking-system') ?></a></span>
            </div>
            <div class="col-sm-6 col-md-4 sln-input sln-input--simple">
                <label for="login_password"><?php _e('Parola') ?></label>
                <input name="login_password" type="password" class="sln-input sln-input--text"/>
            </div>
            <div class="col-sm-6 col-md-4 pull-right sln-input sln-input--simple">
                <label for="login_name">&nbsp;</label>
                <div class="sln-btn sln-btn--emphasis sln-btn--big sln-btn--fullwidth">
                <button type="submit" data-salon-data="<?php echo "sln_step_page=".$step->getShortcode()->getCurrentStep()."&$submitName=next" ?>" data-salon-toggle="next" name="<?php echo $submitName ?>"
                            value="next">
                        Login <i class="glyphicon glyphicon-user"></i></button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12"><?php include '_errors.php'; ?></div>
        </div>
    <?php
    // IF SIZE 900 // END
    } else if ($size == '600') { ?>
        <div class="row">
            <div class="col-sm-6 col-md-6 sln-input sln-input--simple">
                <label for="login_name"><?php _e('E-mail') ?></label>
                <input name="login_name" type="text" class="sln-input sln-input--text"/>
                <span class="help-block"><a href=" <?php echo wp_lostpassword_url($formAction) ?>" class="tec-link"><?php _e('Ati uitat parola?', 'salon-booking-system') ?></a></span>
            </div>
            <div class="col-sm-6 col-md-6 sln-input sln-input--simple">
                <label for="login_password"><?php _e('Parola') ?></label>
                <input name="login_password" type="password" class="sln-input sln-input--text"/>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6"></div>
            <div class="col-sm-6 col-md-6 sln-input sln-input--simple">
                <div class="sln-btn sln-btn--emphasis sln-btn--big sln-btn--fullwidth">
                <button type="submit" data-salon-data="<?php echo "sln_step_page=".$step->getShortcode()->getCurrentStep()."&$submitName=next" ?>" data-salon-toggle="next" name="<?php echo $submitName ?>"
                            value="next">
                        Login <i class="glyphicon glyphicon-user"></i></button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12"><?php include '_errors.php'; ?></div>
        </div>
    <?php
    // IF SIZE 600 // END
    } else if ($size == '400') { ?>
        <div class="row">
            <div class="col-xs-12 sln-input sln-input--simple">
                <label for="login_name"><?php _e('E-mail') ?></label>
                <input name="login_name" type="text" class="sln-input sln-input--text"/>
                <span class="help-block"><a href=" <?php echo wp_lostpassword_url($formAction) ?>" class="tec-link"><?php _e('Ati uitat parola?', 'salon-booking-system') ?></a></span>
            </div>
            <div class="col-xs-12 sln-input sln-input--simple">
                <label for="login_password"><?php _e('Parola') ?></label>
                <input name="login_password" type="password" class="sln-input sln-input--text"/>
            </div>
            <div class="col-xs-12 sln-input sln-input--simple">
                <label for="login_name">&nbsp;</label>
                <div class="sln-btn sln-btn--emphasis sln-btn--big sln-btn--fullwidth">
                <button type="submit" data-salon-data="<?php echo "sln_step_page=".$step->getShortcode()->getCurrentStep()."&$submitName=next" ?>" data-salon-toggle="next" name="<?php echo $submitName ?>"
                            value="next">
                        Login <i class="glyphicon glyphicon-user"></i></button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12"><?php include '_errors.php'; ?></div>
        </div>
    <?php
    // IF SIZE 400 // END
    } else  { ?>

    <?php
    // ELSE // END
    }  ?>
    </form>
    <form method="post" action="<?php echo $formAction ?>" role="form">
    <h2 class="salon-step-title"><?php _e('Verifica ca oaspete', 'salon-booking-system') ?>, <?php _e('Creati un cont automat', 'salon-booking-system') ?>
    </h2>
    <?php
    if ($size == '900') { ?>
    <div class="row">
    <div class="col-md-8">
        <div class="row">
            <?php foreach (array(
                               'firstname' => __('Nume', 'salon-booking-system'),
                               'lastname'  => __('Prenume', 'salon-booking-system'),
                               'email'     => __('e-mail', 'salon-booking-system'),
                               'phone'     => __('Telefon mobil', 'salon-booking-system'),
                               'address'     => __('Adresa', 'salon-booking-system'),
                               'password'  => __('Parola', 'salon-booking-system'),
                               'password_confirm' => __('Confirmati parola', 'salon-booking-system')
                           ) as $field => $label):  ?>
                <div class="col-sm-6 col-md-<?php echo $field == 'address' ? 12 : 6 ?> <?php echo 'field-'.$field ?> sln-input sln-input--simple">
                        <label for="<?php echo SLN_Form::makeID('sln[' . $field . ']') ?>"><?php echo $label ?></label>
                        <?php if(($field == 'phone') && ($prefix = $plugin->getSettings()->get('sms_prefix'))): ?>
                        <div class="input-group sln-input-group">
                            <span class="input-group-addon sln-input--addon"><?php echo $prefix?></span>
                            <?php endif ?>
                        <?php 
                            if(strpos($field, 'password') === 0){
                                SLN_Form::fieldText('sln[' . $field . ']', $bb->get($field), array('required' => true, 'type' => 'password'));
                            }else{
                                SLN_Form::fieldText('sln[' . $field . ']', $bb->get($field), array('required' =>  ($field != 'address')));
                            }
                        ?>
                        <?php if(($field == 'phone') && isset($prefix)):?>
                        </div>
                        <?php endif ?>
                </div>

            <?php endforeach ?>
        </div>
    </div>
    <div class="col-md-4 sln-input sln-input--action  sln-box--main sln-box--formactions">
        <label for="login_name">&nbsp;</label>
        <?php include "_form_actions.php" ?>
    </div>
    </div>
    <div class="row">
        <div class="col-xs-12"><?php include '_errors.php'; ?></div>
    </div>
    <?php
    // IF SIZE 900 // END
    } else if ($size == '600') { ?>
    <div class="row">
            <?php foreach (array(
                               'firstname' => __('Nume', 'salon-booking-system'),
                               'lastname'  => __('Prenume', 'salon-booking-system'),
                               'email'     => __('e-mail', 'salon-booking-system'),
                               'phone'     => __('Telefon mobil', 'salon-booking-system'),
                               'address'     => __('Adresa', 'salon-booking-system'),
                               'password'  => __('Parola', 'salon-booking-system'),
                               'password_confirm' => __('Confirmati parola', 'salon-booking-system')
                           ) as $field => $label):  ?>
                <div class="col-sm-6 col-md-<?php echo $field == 'address' ? 12 : 6 ?> <?php echo 'field-'.$field ?> sln-input sln-input--simple">
                        <label for="<?php echo SLN_Form::makeID('sln[' . $field . ']') ?>"><?php echo $label ?></label>
                        <?php if(($field == 'phone') && ($prefix = $plugin->getSettings()->get('sms_prefix'))): ?>
                        <div class="input-group sln-input-group">
                            <span class="input-group-addon sln-input--addon"><?php echo $prefix?></span>
                            <?php endif ?>
                        <?php 
                            if(strpos($field, 'password') === 0){
                                SLN_Form::fieldText('sln[' . $field . ']', $bb->get($field), array('required' => true, 'type' => 'password'));
                            }else{
                                SLN_Form::fieldText('sln[' . $field . ']', $bb->get($field), array('required' =>  ($field != 'address')));
                            }
                        ?>
                        <?php if(($field == 'phone') && isset($prefix)):?>
                        </div>
                        <?php endif ?>
                </div>

            <?php endforeach ?>
    </div>
    <div class="row sln-box--main sln-box--formactions">
           <div class="col-md-12">
           <?php include "_form_actions.php" ?></div>
        </div>
    <div class="row">
        <div class="col-xs-12"><?php include '_errors.php'; ?></div>
    </div>
    <?php
    // IF SIZE 600 // END
    } else if ($size == '400') { ?>
    <div class="row">
            <?php foreach (array(
                               'firstname' => __('Nume', 'salon-booking-system'),
                               'lastname'  => __('Prenume', 'salon-booking-system'),
                               'email'     => __('e-mail', 'salon-booking-system'),
                               'phone'     => __('Telefon mobil', 'salon-booking-system'),
                               'address'     => __('Adresa', 'salon-booking-system'),
                               'password'  => __('Parola', 'salon-booking-system'),
                               'password_confirm' => __('Confirmati parola', 'salon-booking-system')
                           ) as $field => $label):  ?>
                <div class="col-xs-12 <?php echo 'field-'.$field ?> sln-input sln-input--simple">
                        <label for="<?php echo SLN_Form::makeID('sln[' . $field . ']') ?>"><?php echo $label ?></label>
                        <?php if(($field == 'phone') && ($prefix = $plugin->getSettings()->get('sms_prefix'))): ?>
                        <div class="input-group sln-input-group">
                            <span class="input-group-addon sln-input--addon"><?php echo $prefix?></span>
                            <?php endif ?>
                        <?php 
                            if(strpos($field, 'password') === 0){
                                SLN_Form::fieldText('sln[' . $field . ']', $bb->get($field), array('required' => true, 'type' => 'password'));
                            }else{
                                SLN_Form::fieldText('sln[' . $field . ']', $bb->get($field), array('required' =>  ($field != 'address')));
                            }
                        ?>
                        <?php if(($field == 'phone') && isset($prefix)):?>
                        </div>
                        <?php endif ?>
                </div>

            <?php endforeach ?>
            <div class="col-xs-12  sln-box--formactions"><label for="login_name">&nbsp;</label><?php include "_form_actions.php" ?></div>
    </div>
    <div class="row">
        <div class="col-xs-12"><?php include '_errors.php'; ?></div>
    </div>
    <?php
    // IF SIZE 400 // END
    } else  { ?>

    <?php
    // ELSE // END
    }  ?>
    </form>
<?php else: ?>

    <form method="post" action="<?php echo $formAction ?>" role="form">
    <h2 class="salon-step-title"><?php _e('Verifica', 'salon-booking-system') ?></h2>
    <?php
    if ($size == '900') { ?>
    <div class="row">
    <div class="col-md-8">
        <div class="row">
            <?php foreach (array(
                               'firstname' => __('Nume', 'salon-booking-system'),
                               'lastname'  => __('Prenume', 'salon-booking-system'),
                               'email'     => __('e-mail', 'salon-booking-system'),
                               'phone'     => __('Telefon mobil', 'salon-booking-system'),
                               'address'     => __('Adresa', 'salon-booking-system'),
                           ) as $field => $label): ?>
                <div class="col-sm-6 col-md-<?php echo $field == 'address' ? 12 : 6 ?> <?php echo 'field-'.$field ?> sln-input sln-input--simple">
                        <label for="<?php echo SLN_Form::makeID('sln[' . $field . ']') ?>"><?php echo $label ?></label>
                        <?php if(($field == 'phone') && ($prefix = $plugin->getSettings()->get('sms_prefix'))): ?>
                        <div class="input-group sln-input-group">
                            <span class="input-group-addon sln-input--addon"><?php echo $prefix?></span>
                        <?php endif ?>
                        <?php SLN_Form::fieldText('sln[' . $field . ']', $bb->get($field), array('required' => ($field != 'address'))) ?>
                            <?php if(($field == 'phone') && isset($prefix)):?>
                                </div>
                            <?php endif ?>
                </div>

            <?php endforeach ?>
        </div>
    </div>
    <div class="col-md-4 sln-input sln-input--action sln-box--formactions">
        <label for="login_name">&nbsp;</label>
        <?php include "_form_actions.php" ?>
    </div>
    </div>
    <div class="row">
        <div class="col-xs-12"><?php include '_errors.php'; ?></div>
    </div>
    <?php
    // IF SIZE 900 // END
    } else if ($size == '600') { ?>
    <div class="row">
            <?php foreach (array(
                               'firstname' => __('Nume', 'salon-booking-system'),
                               'lastname'  => __('Prenume', 'salon-booking-system'),
                               'email'     => __('e-mail', 'salon-booking-system'),
                               'phone'     => __('Telefon mobil', 'salon-booking-system'),
                               'address'     => __('Adresa', 'salon-booking-system'),
                           ) as $field => $label): ?>
                <div class="col-sm-6 col-md-<?php echo $field == 'address' ? 12 : 6 ?> <?php echo 'field-'.$field ?> sln-input sln-input--simple">
                        <label for="<?php echo SLN_Form::makeID('sln[' . $field . ']') ?>"><?php echo $label ?></label>
                        <?php if(($field == 'phone') && ($prefix = $plugin->getSettings()->get('sms_prefix'))): ?>
                        <div class="input-group sln-input-group">
                            <span class="input-group-addon sln-input--addon"><?php echo $prefix?></span>
                        <?php endif ?>
                        <?php SLN_Form::fieldText('sln[' . $field . ']', $bb->get($field), array('required' => ($field != 'address'))) ?>
                            <?php if(($field == 'phone') && isset($prefix)):?>
                                </div>
                            <?php endif ?>
                </div>

            <?php endforeach ?>
        </div>
    <div class="row sln-box--formactions">
           <div class="col-md-12">
           <?php include "_form_actions.php" ?></div>
        </div>
    <div class="row">
        <div class="col-xs-12"><?php include '_errors.php'; ?></div>
    </div>
    <?php
    // IF SIZE 600 // END
    } else if ($size == '400') { ?>
    <div class="row">
            <?php foreach (array(
                               'firstname' => __('Nume', 'salon-booking-system'),
                               'lastname'  => __('Prenume', 'salon-booking-system'),
                               'email'     => __('e-mail', 'salon-booking-system'),
                               'phone'     => __('Telefon mobil', 'salon-booking-system'),
                               'address'     => __('Adresa', 'salon-booking-system'),
                           ) as $field => $label): ?>
                <div class="col-xs-12 <?php echo 'field-'.$field ?> sln-input sln-input--simple">
                        <label for="<?php echo SLN_Form::makeID('sln[' . $field . ']') ?>"><?php echo $label ?></label>
                        <?php if(($field == 'phone') && ($prefix = $plugin->getSettings()->get('sms_prefix'))): ?>
                        <div class="input-group sln-input-group">
                            <span class="input-group-addon sln-input--addon"><?php echo $prefix?></span>
                        <?php endif ?>
                        <?php SLN_Form::fieldText('sln[' . $field . ']', $bb->get($field), array('required' => ($field != 'address'))) ?>
                            <?php if(($field == 'phone') && isset($prefix)):?>
                                </div>
                            <?php endif ?>
                </div>
            <?php endforeach ?>
            <div class="col-xs-12 sln-box--formactions"><label for="login_name">&nbsp;</label><?php include "_form_actions.php" ?></div>
    </div>
    <div class="row">
        <div class="col-xs-12"><?php include '_errors.php'; ?></div>
    </div>
    <?php
    // IF SIZE 400 // END
    } else  { ?>
<div class="row">
    <div class="col-md-8">
        <div class="row">
            <?php foreach (array(
                               'firstname' => __('Nume', 'salon-booking-system'),
                               'lastname'  => __('Prenume', 'salon-booking-system'),
                               'email'     => __('e-mail', 'salon-booking-system'),
                               'phone'     => __('Telefon mobil', 'salon-booking-system'),
                               'address'     => __('Adresa', 'salon-booking-system'),
                           ) as $field => $label): ?>
                <div class="col-md-<?php echo $field == 'address' ? 12 : 6 ?> <?php echo 'field-'.$field ?> sln-input sln-input--simple">
                        <label for="<?php echo SLN_Form::makeID('sln[' . $field . ']') ?>"><?php echo $label ?></label>
                        <?php if(($field == 'phone') && ($prefix = $plugin->getSettings()->get('sms_prefix'))): ?>
                        <div class="input-group sln-input-group">
                            <span class="input-group-addon sln-input--addon"><?php echo $prefix?></span>
                        <?php endif ?>
                        <?php SLN_Form::fieldText('sln[' . $field . ']', $bb->get($field), array('required' => ($field != 'address'))) ?>
                            <?php if(($field == 'phone') && isset($prefix)):?>
                                </div>
                            <?php endif ?>
                </div>

            <?php endforeach ?>
        </div>
    </div>
    <div class="col-md-4 sln-input sln-input--action sln-box--formactions">
        <label for="login_name">&nbsp;</label>
        <?php include "_form_actions.php" ?>
    </div>
    </div>
    <div class="row">
        <div class="col-xs-12"><?php include '_errors.php'; ?></div>
    </div>
    <?php
    // ELSE // END
    }  ?>
    </form>
<?php endif ?>

