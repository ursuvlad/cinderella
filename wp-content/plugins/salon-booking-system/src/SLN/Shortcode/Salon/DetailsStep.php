<?php

class SLN_Shortcode_Salon_DetailsStep extends SLN_Shortcode_Salon_AbstractUserStep
{
    protected function dispatchForm()
    {
        global $current_user;
        if (isset($_POST['login_name'])) {
            $ret = $this->dispatchAuth($_POST['login_name'], $_POST['login_password']);
            if (!$ret) {
                return false;
            }

            $values = array(
                'firstname' => $current_user->user_firstname,
                'lastname'  => $current_user->user_lastname,
                'email'     => $current_user->user_email,
                'phone'     => get_user_meta($current_user->ID, '_sln_phone', true),
                'address'     => get_user_meta($current_user->ID, '_sln_address', true)
            );
            $this->bindValues($values);
            $this->validate($values);
            if ($this->getErrors()) {
                $this->bindValues($values);
                return false;
            }
        } else {
            $values = $_POST['sln'];
            if (!is_user_logged_in()) {
                $this->validate($values);
                if ($this->getErrors()) {
                    $this->bindValues($values);
                    return false;
                }

                if (email_exists($values['email'])) {
                    $this->addError(__('E-mail deja exista', 'salon-booking-system'));
                }
                if ($values['password'] != $values['password_confirm']) {
                    $this->addError(__('Parolele sunt diferite', 'salon-booking-system'));
                }
                if ($this->getErrors()) {
                    $this->bindValues($values);
                    return false;
                }
                if(!$this->getShortcode()->needSms()) {
                    $this->successRegistration($values);
                }else{
                    $_SESSION['sln_detail_step'] = $values;
                }
            }else{
                wp_update_user(
                    array('ID' => $current_user->ID, 'first_name' => $values['firstname'], 'last_name' => $values['lastname'])
                );
                foreach(array('phone', 'address') as $k){
                    if(isset($values[$k])){
                       update_user_meta($current_user->ID, '_sln_'.$k, $values[$k]);
                    }
                }
            }
        }
        $this->bindValues($values);

        return true;
    }

    private function validate($values){
        if (empty($values['firstname'])) {
            $this->addError(__('Prenumele nu poate fi loc gol', 'salon-booking-system'));
        }
        if (empty($values['lastname'])) {
            $this->addError(__('Numele nu poate fi loc gol', 'salon-booking-system'));
        }
        if (empty($values['email'])) {
            $this->addError(__('e-mail nu poate fi loc gol', 'salon-booking-system'));
        }
        if (empty($values['phone'])) {
            $this->addError(__('Telefonul nu poate fi loc gol', 'salon-booking-system'));
        }
#       if (empty($values['address'])) {
#           $this->addError(__('Address can\'t be empty', 'salon-booking-system'));
#       } 
        if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
            $this->addError(__('e-mail nu este valid', 'salon-booking-system'));
        }
    }
}
