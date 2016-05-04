<?php

class SLN_Action_Ajax_ResendNotification extends SLN_Action_Ajax_Abstract
{
    public function execute()
    {
       if(!current_user_can( 'manage_options' )) throw new Exception('now allowed');
        $booking = new SLN_Wrapper_Booking($_POST['post_id']);
        if(isset($_POST['emailto'])){
            $to = $_POST['emailto'];
            SLN_Plugin::getInstance()->sendMail(
                'mail/summary',
                compact('booking','to')
            );
            return ['success' => __('E-mail trimis')];
        }else{
            return ['error' => __('Va rugam sa specificati cu un email')];
        }
 
       return $ret;
    }
}
