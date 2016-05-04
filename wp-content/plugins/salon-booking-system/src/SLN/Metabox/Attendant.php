<?php

class SLN_Metabox_Attendant extends SLN_Metabox_Abstract
{
    public function add_meta_boxes()
    {
        $postType = $this->getPostType();
        add_meta_box(
//            $postType . '-details',
            'sln_service-details',
            __('Detalii asistent', 'salon-booking-system'),
            array($this, 'details_meta_box'),
            $postType,
            'normal',
            'high'
        );
        remove_meta_box('postexcerpt', $postType, 'side');
        add_meta_box(
            'postexcerpt',
            __('Descriere asistent'),
            array($this, 'post_excerpt_meta_box'),
            $postType,
            'normal',
            'high'
        );
    }

    public function post_excerpt_meta_box($post)
    {
        ?>
        <label class="screen-reader-text" for="excerpt">
            <?php _e('Descriere asistent', 'salon-booking-system') ?>
        </label>
        <textarea rows="1" cols="40" name="excerpt"
                  id="excerpt"><?php echo $post->post_excerpt; // textarea_escaped ?></textarea>
        <p><?php _e('O foarte scrurta descriere a acestui asistent. Este optional', 'salon-booking-system'); ?></p>
    <?php
    }


    public function details_meta_box($object, $box)
    {
        echo $this->getPlugin()->loadView(
            'metabox/attendant',
            array(
                'metabox'  => $this,
                'settings' => $this->getPlugin()->getSettings(),
                'attendant'  => $this->getPlugin()->createAttendant($object),
                'postType' => $this->getPostType(),
                'helper'   => new SLN_Metabox_Helper()
            )
        );
        do_action($this->getPostType() . '_details_meta_box', $object, $box);
    }

    protected function getFieldList()
    {
        return array(
            'availabilities' => '',
            'email'    => 'text',
            'phone'    => 'text',
            'services'    => 'nofilter',
        );
    }

    public function save_post($post_id, $post)
    {
        if(isset($_POST['_sln_attendant_services'])) {
            foreach($_POST['_sln_attendant_services'] as $k => $v){
                $_POST['_sln_attendant_services'][$k] = str_replace('sln_attendant_services_','', $v);
            }
        }
        parent::save_post($post_id, $post);
    }
}
