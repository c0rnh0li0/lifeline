<?php

function ll_sync_cron_job() {
    $sync_type = \Lifeline\Controller\LifelineSync::SYNC_TYPE_WP_CRON;
    
    require_once(plugin_dir_path(__FILE__) . '/ll-system-cron.php');
}

add_action('ll_sync_cron', 'll_sync_cron_job', 10, 0);

add_action('init', function () {
    if (!has_action('ll_sync_cron'))
        add_action('ll_sync_cron', 'll_sync_cron_job');
});

if (!wp_next_scheduled('ll_sync_cron'))
    wp_schedule_event(strtotime('00:00:00'), 'daily', 'll_sync_cron');