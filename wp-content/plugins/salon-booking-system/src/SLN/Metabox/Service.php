<?php

class SLN_Metabox_Service extends SLN_Metabox_Abstract
{
    public function add_meta_boxes()
    {
        $postType = $this->getPostType();
        add_meta_box(
            $postType . '-details',
            __('Detalii serviciu', 'salon-booking-system'),
            array($this, 'details_meta_box'),
            $postType,
            'normal',
            'high'
        );
        remove_meta_box('postexcerpt', $postType, 'side');
        add_meta_box(
            'postexcerpt',
            __('Descriere serviciu', 'salon-booking-system'),
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
            <?php _e('Descriere serviciu', 'salon-booking-system') ?>
        </label>
        <textarea rows="1" cols="40" name="excerpt"
                  id="excerpt"><?php echo $post->post_excerpt; // textarea_escaped ?></textarea>
        <p><?php _e('O foarte scurta descriere a acestui serviciu.Este optional', 'salon-booking-system'); ?></p>
    <?php
    }


    public function details_meta_box($object, $box)
    {
        echo $this->getPlugin()->loadView(
            'metabox/service',
            array(
                'metabox'  => $this,
                'settings' => $this->getPlugin()->getSettings(),
                'service'  => $this->getPlugin()->createService($object),
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
            'price'      => 'float',
            'duration'   => 'time',
            'secondary'  => 'bool',
            'unit'       => 'int',
            'exec_order' => 'int',
        );
    }
}
