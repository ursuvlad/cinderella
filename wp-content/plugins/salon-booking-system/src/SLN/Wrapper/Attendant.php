<?php

class SLN_Wrapper_Attendant extends SLN_Wrapper_Abstract
{
    const _CLASS = 'SLN_Wrapper_Attendant';
    private $availabilityItems;

    public function getPostType()
    {
        return SLN_Plugin::POST_TYPE_ATTENDANT;
    }

    function getNotAvailableOn($key)
    {
        $post_id = $this->getId();
        $ret = apply_filters(
            'sln_attendant_notav_'.$key,
            get_post_meta($post_id, '_sln_attendant_notav_'.$key, true)
        );
        $ret = empty($ret) ? false : ($ret ? true : false);

        return $ret;
    }

    function getEmail()
    {
        return $this->getMeta('email');
    }

    function getPhone()
    {
        return $this->getMeta('phone');
    }


    function isNotAvailableOnDate(SLN_DateTime $date)
    {
        return !$this->getAvailabilityItems()->isValidDatetime($date);
    }

    /**
     * @return SLN_Helper_AvailabilityItems
     */
    function getAvailabilityItems()
    {
        if (!isset($this->availabilityItems)) {
            $this->availabilityItems = new SLN_Helper_AvailabilityItems($this->getMeta('availabilities'));
        }
        return $this->availabilityItems;
    }

    public function getNotAvailableString()
    {
        return '(Available '.implode('-', $this->getAvailabilityItems()->toArray()).')';
    }

    public function getServicesIds()
    {
        $ret = $this->getMeta('services');
        if (is_array($ret)) {
            $ret = array_unique($ret);
        }

        return empty($ret) ? array() : $ret;
    }

    public function getServices()
    {
        $ret = array();
        foreach ($this->getServicesIds() as $id) {
            $tmp = new SLN_Wrapper_Service($id);
            if (!$tmp->isEmpty()) {
                $ret[] = $tmp;
            }
        }

        return $ret;
    }

    public function hasService(SLN_Wrapper_Service $service)
    {
        return in_array($service->getId(), $this->getServicesIds());
    }

    public function hasAllServices()
    {
        //an assistant without services is an assistant available for all services
        return $this->getServicesIds() ? false : true;
    }

    public function getName()
    {
        return $this->getTitle();
    }

    public function getContent()
    {
        return $this->object->post_excerpt;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
