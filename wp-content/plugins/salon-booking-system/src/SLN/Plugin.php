<?php

class SLN_Plugin
{
    const POST_TYPE_SERVICE = 'sln_service';
    const POST_TYPE_ATTENDANT = 'sln_attendant';
    const POST_TYPE_BOOKING = 'sln_booking';
    const TAXONOMY_SERVICE_CATEGORY = 'sln_service_category';
    const USER_ROLE_STAFF = 'sln_staff';
    const USER_ROLE_CUSTOMER = 'sln_customer';
    const TEXT_DOMAIN = 'salon-booking-system';
    const F = 'slnc';
    const F1 = 30;
    const F2 = 20;
    const DEBUG_ENABLED = 0;
    const CATEGORY_ORDER = 'sln_service_category_order';

    private static $instance;
    private $settings;
    private $formatter;
    private $availabilityHelper;
    private $repositories;
    private $phpServices = array();

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function __construct()
    {
        $obj = new SLN_Action_Init($this);
    }


    /** @return SLN_Settings */
    public function getSettings()
    {
        if (!isset($this->settings)) {
            $this->settings = new SLN_Settings();
        }

        return $this->settings;
    }

    /**
     * @param $attendant
     * @return SLN_Wrapper_Attendant
     * @throws Exception
     */
    public function createAttendant($attendant)
    {
        return $this->getRepository(self::POST_TYPE_ATTENDANT)->create($attendant);
    }

    /**
     * @param $service
     * @return SLN_Wrapper_Service
     * @throws Exception
     */
    public function createService($service)
    {
        return $this->getRepository(self::POST_TYPE_SERVICE)->create($service);
    }

    public function createBooking($booking)
    {
        if (is_string($booking) && strpos($booking, '-') !== false) {
            $secureId = $booking;
            $booking = intval($booking);
        }
        if (is_int($booking)) {
            $booking = get_post($booking);
        }
        $ret = new SLN_Wrapper_Booking($booking);
        if (isset($secureId) && $ret->getUniqueId() != $secureId) {
            throw new Exception('Not allowed, failing secure id');
        }

        return $ret;
    }

    public function getBookingBuilder()
    {
        return new SLN_Wrapper_Booking_Builder($this);
    }

    public function getViewFile($view)
    {
        return SLN_PLUGIN_DIR.'/views/'.$view.'.php';
    }

    public function loadView($view, $data = array())
    {
        ob_start();
        extract($data);
        $plugin = $this;
        include $this->getViewFile($view);

        return ob_get_clean();
    }

    public function sendMail($view, $data)
    {
        $data['data'] = $settings = new ArrayObject($data);
        $content = $this->loadView($view, $data);
        if (!function_exists('sln_html_content_type')) {

            function sln_html_content_type()
            {
                return 'text/html';
            }
        }

        add_filter('wp_mail_content_type', 'sln_html_content_type');
        $headers = 'From: '.$this->getSettings()->getSalonName().' <'.$this->getSettings()->getSalonEmail().'>'."\r\n";
        if(empty($settings['to'])){
            throw new Exception('Receiver not defined');
        }
        wp_mail($settings['to'], $settings['subject'], $content, $headers);
        remove_filter('wp_mail_content_type', 'sln_html_content_type');
    }

    /**
     * @return SLN_Formatter
     */
    public function format()
    {
        if (!isset($this->formatter)) {
            $this->formatter = new SLN_Formatter($this);
        }

        return $this->formatter;
    }

    public function getAvailabilityHelper()
    {
        if (!isset($this->availabilityHelper)) {
            $this->availabilityHelper = new SLN_Helper_Availability($this);
        }

        return $this->availabilityHelper;
    }

    /**
     * @param Datetime $datetime
     * @return \SLN_Helper_Intervals
     */
    public function getIntervals(DateTime $datetime)
    {
        $obj = new SLN_Helper_Intervals($this->getAvailabilityHelper());
        $obj->setDatetime($datetime);

        return $obj;
    }

    public function ajax()
    {
        if ($timezone = get_option('timezone_string')) {
            date_default_timezone_set($timezone);
        }


        //check_ajax_referer('ajax_post_validation', 'security');
        $method = $_REQUEST['method'];
        $className = 'SLN_Action_Ajax_'.ucwords($method);
        if (class_exists($className)) {
            SLN_Plugin::addLog('calling ajax '.$className);
            //SLN_Plugin::addLog(print_r($_POST,true));
            /** @var SLN_Action_Ajax_Abstract $obj */
            $obj = new $className($this);
            $ret = $obj->execute();
            SLN_Plugin::addLog("$className returned:\r\n".json_encode($ret));
            if (is_array($ret)) {
                header('Content-Type: application/json');
                echo json_encode($ret);
            } elseif (is_string($ret)) {
                echo $ret;
            } else {
                throw new Exception("no content returned from $className");
            }
            exit();
        } else {
            throw new Exception("ajax method not found '$method'");
        }
    }

    public static function addLog($txt)
    {
        if (self::DEBUG_ENABLED) {
            file_put_contents(
                SLN_PLUGIN_DIR.'/log.txt',
                '['.date('Y-m-d H:i:s').'] '.$txt."\r\n",
                FILE_APPEND | LOCK_EX
            );
        }
    }

    public function createFromPost($post)
    {
        if (!is_object($post)) {
            $post = get_post($post);
            if (!$post) {
                throw new Exception('post not found');
            }
        }

        return $this->getRepository($post->post_type)->create($post);
    }

    public function addRepository(SLN_Repository_AbstractRepository $repo)
    {
        foreach ($repo->getBindings() as $k) {
            $this->repositories[$k] = $repo;
        }
    }

    /**
     * @param $binding
     * @return AbstractRepository
     * @throws \Exception
     */
    public function getRepository($binding)
    {
        $ret = $this->repositories[$binding];
        if (!$ret) {
            throw new Exception(sprintf('repository for "%s" not found', $binding));
        }

        return $ret;
    }

    /**
     * @return SLN_Service_Sms
     */
    public function sms()
    {
        if (!isset($this->phpServices['sms'])) {
            $this->phpServices['sms'] = new SLN_Service_Sms($this);
        }

        return $this->phpServices['sms'];
    }

    /**
     * @return SLN_Service_Messages
     */
    public function messages()
    {
        if (!isset($this->phpServices['messages'])) {
            $this->phpServices['messages'] = new SLN_Service_Messages($this);
        }

        return $this->phpServices['messages'];
    }
}

function sln_sms_reminder()
{
    $obj = new SLN_Action_Reminder();
    $obj->executeSms();
}

function sln_email_reminder()
{
    $obj = new SLN_Action_Reminder();
    $obj->executeEmail();
}
