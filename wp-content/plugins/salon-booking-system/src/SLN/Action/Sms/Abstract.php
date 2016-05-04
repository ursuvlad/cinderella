<?php

abstract class SLN_Action_Sms_Abstract
{
    protected $plugin;

    public function __construct(SLN_Plugin $plugin)
    {
        $this->plugin = $plugin;
    }

    abstract public function send($to, $message);

    protected function getAccount(){
        return $this->plugin->getSettings()->get('sms_account');
    }

    protected function getPassword(){
        return $this->plugin->getSettings()->get('sms_password');
    }

    protected function getFrom(){
        return $this->plugin->getSettings()->get('sms_from');
    }

    protected function processTo($to){
        $s = $this->plugin->getSettings();
        $prefix = $s->get('sms_prefix');
        if($s->get('sms_trunk_prefix') && strpos($to,'0') === 0){
            $to = substr($to,1);
        }
        //$prefix = str_replace('+','',$prefix);
        $to = str_replace(' ','',$to);
        return $prefix . $to;
    }
    protected function createException($message, $code = 1000, $previous = null){
        throw new SLN_Action_Sms_Exception($message, $code, $previous);
    }
}
