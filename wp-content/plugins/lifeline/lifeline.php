<?php

/**
* Plugin Name: Lifeline WP Plugin
* Plugin URI: https://lifeline.mk/lifeline.zip
* Description: Lifeline plugin for MakedonijaLek products sync
* Version: 1.0.0
* Author: Darko Krstev
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

require plugin_dir_path(__FILE__) . '/vendor/autoload.php';

function activate_lifeline() {
	\Lifeline\Lifeline::activate();
}

function deactivate_lifeline() {
	\Lifeline\Lifeline::deactivate();
}

function uninstall_lifeline() { 
	\Lifeline\Lifeline::uninstall();
}

register_activation_hook(__FILE__, 'activate_lifeline');
register_deactivation_hook(__FILE__, 'deactivate_lifeline');
register_uninstall_hook(__FILE__, 'uninstall_lifeline');

function run_lifeline() {
	$lifeline = new \Lifeline\Lifeline();
	
	$lifeline->run();
}

run_lifeline();

?>