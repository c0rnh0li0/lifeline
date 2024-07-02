<?php

function ll_sync_cron_schedules( $schedules ) {
    $schedules['daily'] = array(
        'interval' => 86400,
        'display'  => 'Once a day',
    );

    return $schedules;
}

add_filter( 'cron_schedules', 'll_sync_cron_schedules', 10, 1 );


function ll_sync_cron() {
    $sync_type = \Lifeline\Controller\LifelineSync::SYNC_TYPE_WP_CRON;
    
    require_once(plugin_dir_path(__FILE__) . '/ll-system-cron.php');
}

add_action( 'll_sync_cron', 'll_sync_cron' );

if (!wp_next_scheduled('ll_sync_cron'))
    wp_schedule_event(strtotime('00:00:00'), 'daily', 'll_sync_cron');