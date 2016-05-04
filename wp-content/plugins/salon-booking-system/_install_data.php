<?php
return array(
    'settings' => array(
        'date_format'       => 'default',
        'time_format'       => 'default',
        'hours_before_from' => '+1 day',
        'hours_before_to'   => '+1 month',
        'interval'          => 60,
        'availability_mode' => 'basic',
        'disabled_message'  => 'Rezervarea nu este disponibila in acest moment, va rugam sa ne contactati la ' . get_option('admin_email'),
        'gen_name'         => '',
        'gen_email'        => '',
        'gen_phone'        => '00391122334455',
        'gen_address'      => 'Main Street 123',
        'gen_timetable'    => 'In caz de intirziere vom pastra un scaun pentru dvs. timp de 15 minute, dupa care veti pierde prioritatea.',
        'soc_facebook'     => 'http://www.facebook.com',
        'soc_twitter'      => 'http://www.twitter.com',
        'soc_google'       => 'http://www.google.it',
        'ajax_enabled'     => true,
        'booking'          => true,
        'thankyou'         => true,
        'availabilities'   => array(
            array(
            "days" => array(
                2 => 1,
                3 => 1,
                4 => 1,
                5 => 1,
                6 => 1
            ),
            "from" => array("08:00", "13:00"),
            "to"   => array("13:00", "20:00")
            )
        ),
        'email_subject'    => 'Rezervarea dvs. pentru [DATE] at [TIME] at [SALON NAME]',
        'pay_currency'     => 'USD',
        'pay_currency_pos' => 'right',
        'pay_paypal_email' => 'test@test.com',
        'pay_paypal_test'  => true,
        'parallels_hour'   => 1, 
//        'confirmation'     => true,
//        'pay_enabled'      => true,
//        'pay_cash'         => true
        'sln_db_version' => SLN_VERSION
    ),
    'posts'    => array(
        array(
            'post' => array(
                'post_title'   => 'Mario',
                'post_excerpt' => 'mario',
                'post_status'  => 'publish',
                'post_type'    => 'sln_attendant'
            ),
        ),
        array(
            'post' => array(
                'post_title'   => 'Pablo',
                'post_excerpt' => 'pablo',
                'post_status'  => 'publish',
                'post_type'    => 'sln_attendant'
            ),
        ),
 
        array(
            'post' => array(
                'post_title'   => 'Manicure',
                'post_excerpt' => 'manicure',
                'post_status'  => 'publish',
                'post_type'    => 'sln_service'
            ),
            'meta' => array(
                '_sln_service_price' => 15,
                '_sln_service_unit'  => 3,
                '_sln_service_order' => '0',
            )
        ),
        array(
            'post' => array(
                'post_title'   => 'Nails styling',
                'post_excerpt' => 'nails styling',
                'post_status'  => 'publish',
                'post_type'    => 'sln_service',
            ),
            'meta' => array(
                '_sln_service_price'      => 10.11,
                '_sln_service_unit'       => 2,
                '_sln_service_duration'   => '00:30',
                '_sln_service_secondary'  => true,
                '_sln_service_notav_from' => '11',
                '_sln_service_notav_to'   => '15',
                '_sln_service_order'      => '0',
            )
        ),
        array(
            'post' => array(
                'post_title'   => 'Mesaj',
                'post_excerpt' => 'mesaj',
                'post_status'  => 'publish',
                'post_type'    => 'sln_service',
            ),
            'meta' => array(
                '_sln_service_price'      => 29.99,
                '_sln_service_unit'       => 2,
                '_sln_service_duration'   => '01:00',
                '_sln_service_secondary'  => true,
                '_sln_service_notav_from' => '11',
                '_sln_service_notav_to'   => '15',
                '_sln_service_order'      => '0',
            )
        ),
        'booking'  => array(
            'post' => array(
                'post_title'     => 'Rezervare',
                'post_content'   => '[salon/]',
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
            ),
            'meta' => array()
        ),
        'thankyou' => array(
            'post' => array(
                'post_title'     => 'Multumesc pentru rezervare',
                'post_excerpt'   => 'multumesc',
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
            ),
            'meta' => array()
        ),
        'bookingmyaccount'  => array(   // algolplus
            'post' => array(
                'post_title'     => 'Contul meu de rezervare',
                'post_content'   => '[salon_booking_my_account]',
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
            ),
            'meta' => array()
        ),
    )
);
