<?php


abstract class SLN_Helper_Availability_AbstractDayBookings
{
    protected $currentBooking;
    protected $bookings;
    protected $timeslots;
    protected $date;
    protected $minutesIntervals;

    /**
     * @return array
     */
    abstract protected function buildTimeslots();
    /**
     * @return DateTime
     */
    abstract public function getTime($hour = null, $minutes = null);


    public function __construct(DateTime $date, SLN_Wrapper_Booking $booking = null)
    {
        $interval = min(SLN_Enum_Interval::toArray());
        $this->minutesIntervals = SLN_Func::getMinutesIntervals($interval);
        $this->date = $date;
        $this->currentBooking = $booking;
        $this->bookings = $this->buildBookings();
        $this->timeslots = $this->buildTimeslots();
    }

    private function buildBookings()
    {
        $args = array(
            'post_type'  => SLN_Plugin::POST_TYPE_BOOKING,
            'nopaging'   => true,
            'meta_query' => array(
                array(
                    'key'     => '_sln_booking_date',
                    'value'   => $this->date->format('Y-m-d'),
                    'compare' => '=',
                )
            )
        );
        $query = new WP_Query($args);
        $ret = array();
        $noTimeStatuses = SLN_Enum_BookingStatus::$noTimeStatuses;
        foreach ($query->get_posts() as $p) {
            /** @var WP_Post $p */
            if (empty($this->currentBooking) || $p->ID != $this->currentBooking->getId()) {
                $tmp = SLN_Plugin::getInstance()->createBooking($p);
                if(!$tmp->hasStatus($noTimeStatuses))
                    $ret[] = $tmp;
            }
        }
        wp_reset_query();
        wp_reset_postdata();

        SLN_Plugin::addLog(__CLASS__.' - buildBookings('.$this->date->format('Y-m-d').')');
        foreach($ret as $b)
            SLN_Plugin::addLog(' - '.$b->getId());
        return $ret;
    }

    public function countBookingsByDay()
    {
        return count($this->bookings);
    }

    /**
     * @return SLN_Wrapper_Booking[]
     */
    public function getBookingsByHour($hour = null, $minutes = null)
    {
        $now = $this->getTime($hour, $minutes);
        $time = $now->format('H:i');
        $ret = array();
        $bookings = $this->timeslots[$time]['booking'];
        foreach($bookings as $bId) {
            $ret[] = new SLN_Wrapper_Booking($bId);
        }

        if(!empty($ret)){
            SLN_Plugin::addLog(__CLASS__.' - checking hour('.$hour.')');
            SLN_Plugin::addLog(__CLASS__.' - found('.count($ret).')');
            foreach($ret as $b){
                SLN_Plugin::addLog(' - ' . $b->getId(). ' => '.$b->getStartsAt()->format('H:i').' - '.$b->getEndsAt()->format('H:i'));
            }
        }else{
            SLN_Plugin::addLog(__CLASS__.' - checking hour('.$hour.') EMPTY');
        }
        return $ret;
    }

    public function countBookingsByHour($hour = null, $minutes = null)
    {
        return count($this->getBookingsByHour($hour, $minutes));
    }

    public function countAttendantsByHour($hour = null, $minutes = null)
    {
        SLN_Plugin::addLog(get_class($this).' - count attendants by hour('.$hour.') minutes('.$minutes.')');
        $now = $this->getTime($hour, $minutes);
        $time = $now->format('H:i');
        $ret = $this->timeslots[$time]['attendant'];
        SLN_Plugin::addLog(print_r($ret, true));

        return $ret;
    }

    public function countServicesByHour($hour = null, $minutes = null)
    {
        SLN_Plugin::addLog(get_class($this).' - count services by hour('.$hour.') minutes('.$minutes.')');
        $now = $this->getTime($hour, $minutes);
        $time = $now->format('H:i');
        $ret = $this->timeslots[$time]['service'];
        SLN_Plugin::addLog(print_r($ret, true));
        return $ret;
    }

    /**
     * @return DateTime
     */
    protected function getDate()
    {
        return $this->date;
    }

    /**
     * @return SLN_Wrapper_Booking[]
     */
    protected function getBookings()
    {
        return $this->bookings;
    }

    public function getMinutesIntervals(){
        return $this->minutesIntervals;
    }
}
