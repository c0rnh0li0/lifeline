<?php

/**
* Plugin Name: Lifeline Pharmacy
* Plugin URI: https://lifeline.mk/lifeline.zip
* Description: Lifeline pharmacy Wordpress plugin
* Version: 1.0.0
* Author: Darko & Chima
* Author URI: https://lifeline.mk
* Text Domain: lifeline
* Domain Path: /languages
* License: GPL2
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

defined( 'ABSPATH' ) || exit;


define('LIFELINE_SETTINGS_DB', 'lifeline_settings');
define('LIFELINE_SYNC_LOG_DB', 'lifeline_sync_log');
define('LIFELINE_FE_GROUPS_DB', 'lifeline_fe_groups');
define('LIFELINE_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('LIFELINE_TEMPLATES_DIR', plugin_dir_path(__FILE__) . 'src/Lifeline/Frontend/views/');

require plugin_dir_path(__FILE__) . '/vendor/autoload.php';

global $lifeline_active;

$active_plugins = (array) get_option('active_plugins', array());
$lifeline_active = !empty($active_plugins) && in_array(basename(__DIR__) . '/lifeline.php', $active_plugins);

function activate_lifeline() {
	\Lifeline\Lifeline::activate();

	flush_rewrite_rules();
	
	if (!wp_next_scheduled('ll_sync_cron'))
        wp_schedule_event(strtotime('00:00:00'), 'daily', 'll_sync_cron');
}

function deactivate_lifeline() {
	\Lifeline\Lifeline::deactivate();

	wp_unschedule_event(wp_next_scheduled('ll_sync_cron'), 'll_sync_cron');
}

function uninstall_lifeline() { 
	\Lifeline\Lifeline::uninstall();
}

register_activation_hook(__FILE__, 'activate_lifeline');
register_deactivation_hook(__FILE__, 'deactivate_lifeline');
register_uninstall_hook(__FILE__, 'uninstall_lifeline');

if ($lifeline_active) {
	require_once plugin_dir_path(__FILE__) . '/rewrite_rules.php';
	require_once plugin_dir_path(__FILE__) . '/ajax.php';
}

function run_lifeline() {
	$lifeline = new \Lifeline\Lifeline();
	
	$lifeline->run();
}

run_lifeline();

?>