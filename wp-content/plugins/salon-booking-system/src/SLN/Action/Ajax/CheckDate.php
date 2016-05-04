<?php

class SLN_Action_Ajax_CheckDate extends SLN_Action_Ajax_Abstract
{
    private $date;
    private $time;
    private $errors = array();

    public function execute()
    {
        if($timezone = get_option('timezone_string'))
            date_default_timezone_set($timezone);

        if (!isset($this->date)) {
            if(isset($_POST['sln'])){
                $this->date = $_POST['sln']['date'];
                $this->time = $_POST['sln']['time'];
            }
            if(isset($_POST['_sln_booking_date'])) {
                $this->date = $_POST['_sln_booking_date'];
                $this->time = $_POST['_sln_booking_time']; 
            }
        }
        $this->checkDateTime();
        if ($errors = $this->getErrors()) {
            $ret = compact('errors');
        } else {
            $ret = array('success' => 1);
        }
        $ret['intervals'] = $this->plugin->getIntervals($this->getDateTime())->toArray();

        return $ret;
    }

    public function checkDateTime()
    {

        $plugin = $this->plugin;
        $date   = $this->getDateTime();
//        $this->addError($plugin->format()->datetime($date));
        $ah   = $plugin->getAvailabilityHelper();
        $hb   = $ah->getHoursBeforeHelper();
        $from = $hb->getFromDate();
        $to   = $hb->getToDate();
        if (!$hb->isValidFrom($date)) {
            $txt = $plugin->format()->datetime(new SLN_DateTime($from));
            $this->addError(sprintf(__('Data este prea mare, minim permisa este:', 'salon-booking-system') . '<br /><strong>%s</strong>', $txt));
        } elseif (!$hb->isValidTo($date)) {
            $txt = $plugin->format()->datetime($to);
            $this->addError(sprintf(__(' Data este prea departe, maxima pesrmisa este:', 'salon-booking-system') . '<br /><strong>%s</strong>', $txt));
        } elseif (!$ah->getItems()->isValidDatetime($date) || !$ah->getHolidaysItems()->isValidDatetime($date)) {
            $txt = $plugin->format()->datetime($date);
            $this->addError(sprintf(__('Nu sunt disponibile la:', 'salon-booking-system') . '<br /><strong>%s</strong>', $txt));
        } else {
            $ah->setDate($date);
            if (!$ah->isValidDate($date)) {
                $this->addError(
                    __(
                        'Nu exista timp disponibil azi, va rugam sa selectati o alta zi',
                        'salon-booking-system'
                    )
                );
            } elseif (!$ah->isValidTime($date)) {
                $this->addError(
                    __(
                        'Nu exista timp disponibil pentru aceasta perioada - Va rugam sa selectati o ora diferita',
                        'salon-booking-system'
                    )
                );
            }
        }
    }

    protected function addError($err)
    {
        $this->errors[] = $err;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param mixed $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @param mixed $time
     * @return $this
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    protected function getDateTime()
    {
        $date = $this->date;
        $time = $this->time;
        $ret = new SLN_DateTime(
            SLN_Func::filter($date, 'date') . ' ' . SLN_Func::filter($time, 'time'.':00')
        );
        return $ret;
    }
}
