<?php

class SLN_Action_Install
{

    public static function execute($force = false)
    {
        $data = require SLN_PLUGIN_DIR . '/_install_data.php';
        $ids  = array();
        foreach ($data['posts'] as $label => $post) {
            if (!self::checkPost($post['post']['post_title'], $post['post']['post_type'])) {
                $id = wp_insert_post($post['post']);
                if (isset($post['meta'])) {
                    foreach ($post['meta'] as $k => $v) {
                        add_post_meta($id, $k, $v);
                    }
                }
                $ids[$label] = $id;
            }
        }
        if (!get_option(SLN_Settings::KEY)) {
            if (isset($ids['thankyou'])) {
                $data['settings']['thankyou'] = $ids['thankyou'];
            }
            if (isset($ids['booking'])) {
                $data['settings']['booking'] = $ids['booking'];
                if(isset($data['settings']['pay']))
                    $data['settings']['pay'] = $ids['pay'];
            }

            update_option(SLN_Settings::KEY, $data['settings']);
        }

        new SLN_UserRole_SalonStaff(SLN_Plugin::getInstance(), SLN_Plugin::USER_ROLE_STAFF, __('Salon staff', 'salon-booking-system'));
        new SLN_UserRole_SalonCustomer(SLN_Plugin::getInstance(), SLN_Plugin::USER_ROLE_CUSTOMER, __('Salon customer', 'salon-booking-system'));
    }


    private static function checkPost($title, $post_type)
    {
        return get_page_by_title($title, null, $post_type) ? true : false;
    }

    /**
     * Show plugin changes. Code adapted from W3 Total Cache.
     */
    public static function inPluginUpdateMessage( $args ) {

        $transient_name = 'sln_upgrade_notice_' . $args['Version'];
    
        if ( false === ( $upgrade_notice = get_transient( $transient_name ) ) ) {
            $response = wp_safe_remote_get( 'https://plugins.svn.wordpress.org/salon-booking-system/trunk/readme.txt' );

            if ( ! is_wp_error( $response ) && ! empty( $response['body'] ) ) {
                $upgrade_notice = self::parseUpdateNotice( $response['body'] );
                set_transient( $transient_name, $upgrade_notice, DAY_IN_SECONDS );
            }
        }

        echo wp_kses_post( $upgrade_notice );
    }

    /**
     * Parse update notice from readme file.
     * @param  string $content
     * @return string
     */
    private static function parseUpdateNotice( $content ) {
        // Output Upgrade Notice
        $matches        = null;
        $regexp         = '~==\s*Upgrade Notice\s*==\s*=\s*(.*)\s*=(.*)(=\s*' . preg_quote( SLN_Plugin::getInstance()->getSettings()->getVersion() ) . '\s*=|$)~Uis';
        $upgrade_notice = '';

        if ( preg_match( $regexp, $content, $matches ) ) {
            $version = trim( $matches[1] );
            $notices = (array) preg_split('~[\r\n]+~', trim( $matches[2] ) );

            if ( version_compare( SLN_Plugin::getInstance()->getSettings()->getVersion(), $version, '<' ) ) {

                $upgrade_notice .= '<div class="sln_plugin_upgrade_notice">';

                foreach ( $notices as $index => $line ) {
                    $upgrade_notice .= wp_kses_post( preg_replace( '~\[([^\]]*)\]\(([^\)]*)\)~', '<a href="${2}">${1}</a>', $line ) );
                }

                $upgrade_notice .= '</div> ';
            }
        }

        return wp_kses_post( $upgrade_notice );
    }
}
