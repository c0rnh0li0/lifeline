<?php

use Lifeline\Controller\LifelineGroups;
use Lifeline\Controller\LifelineSync;

add_filter('query_vars', 'query_vars');

$lifelineSync = new LifelineSync();
$lifelineGroups = new LifelineGroups();
        
add_action('wp_ajax_ll_sync', [$lifelineSync, 'async_sync']);
add_action('wp_ajax_ll_restore', [$lifelineSync, 'async_restore']);
add_action('wp_ajax_ll_sync_status', [$lifelineSync, 'async_status']);

add_action('wp_ajax_ll_get_group', [$lifelineGroups, 'get_group']);
add_action('wp_ajax_ll_new_group', [$lifelineGroups, 'new_group']);
add_action('wp_ajax_ll_group_products', [$lifelineGroups, 'search']);
add_action('wp_ajax_ll_save_group', [$lifelineGroups, 'save']);
add_action('wp_ajax_ll_delete_group', [$lifelineGroups, 'delete']);

function query_vars($qvars) {
    $qvars[] = 'action';

    return $qvars;
}