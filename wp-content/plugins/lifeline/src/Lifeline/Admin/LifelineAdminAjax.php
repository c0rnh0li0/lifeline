<?php

use Lifeline\Controller\LifelineSync;

add_filter('query_vars', 'query_vars');

$lifelineSync = new LifelineSync();
        
add_action('wp_ajax_ll_sync', [$lifelineSync, 'async_sync']);
// add_action('wp_ajax_nopriv_ll_sync', [$lifelineSync, 'async_sync']);
add_action('wp_ajax_ll_restore', [$lifelineSync, 'async_restore']);
// add_action('wp_ajax_nopriv_ll_restore', [$lifelineSync, 'async_restore']);
add_action('wp_ajax_ll_sync_status', [$lifelineSync, 'async_status']);
// add_action('wp_ajax_nopriv_ll_sync_status', [$lifelineSync, 'async_status']);

function query_vars($qvars) {
    $qvars[] = 'action';

    return $qvars;
}