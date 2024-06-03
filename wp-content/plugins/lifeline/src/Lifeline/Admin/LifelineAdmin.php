<?php

namespace Lifeline\Admin;

use Lifeline\Controller\LifelineSync;

class LifelineAdmin {        
    public $sync_types = [
        LifelineSync::SYNC_TYPE_CRON => 'System cron job',
        LifelineSync::SYNC_TYPE_WP_CRON => 'Wordpress cron job',
        LifelineSync::SYNC_TYPE_MANUAL => 'Manual sync',
        LifelineSync::SYNC_TYPE_UNKNOWN => 'Unknown sync',
    ];
    
    public function __construct() { }

    public function register_scripts() {
        // include admin scripts and styles
        if (isset($_REQUEST['page']) && str_contains($_REQUEST['page'], 'lifeline')) {
            add_action('admin_enqueue_scripts', [$this, 'styles']);
            add_action('admin_enqueue_scripts', [$this, 'scripts']);

            $this->actions();
        }      
    }

    public function scripts() {
        wp_enqueue_script('lifeline_bootstrap', plugin_dir_url( __FILE__ ) . 'assets/js/bootstrap.min.js', [], null, true);
        wp_enqueue_script('lifeline_overlay', plugin_dir_url( __FILE__ ) . 'assets/js/plain-overlay.min.js', array( 'jquery' ), null, true);
        wp_enqueue_script('lifeline_admin', plugin_dir_url( __FILE__ ) . 'assets/js/lifeline-admin.js', array( 'jquery' ), null, true);

        wp_localize_script('lifeline_admin', 'lifeline_admin_ajax', [ 
            'ajaxurl' => admin_url('admin-ajax.php') 
        ]);
    }

    public function styles() {
        wp_enqueue_style( 'lifeline_admin_bootstrap', plugin_dir_url( __FILE__ ) . 'assets/css/bootstrap.min.css', array(), null, 'all' );

        wp_enqueue_style( 'lifeline_admin_css', plugin_dir_url( __FILE__ ) . 'assets/css/lifeline-admin.css', array(), null, 'all' );
    }

    public function menu() {
        add_menu_page('Lifeline', 'Lifeline', 'manage_options', 'lifeline', array( $this, 'dashboard' ));
        add_submenu_page("lifeline", "Lifeline", "Sync", 'manage_options', "lifeline-sync", array( $this, 'sync' ));
        add_submenu_page("lifeline", "Lifeline", "Logs", 'manage_options', "lifeline-logs", array( $this, 'logs' ));
    }

    public function actions() {
        $lifelineSync = new LifelineSync();
        
        add_action('wp_ajax_ll_sync', array($lifelineSync, 'sync'));
        add_action('wp_ajax_ll_restore', array($lifelineSync, 'restore_wc_data'));
    }

    public function dashboard() {
        global $table_prefix, $wpdb;

        if (isset($_POST)) {
            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'save_settings': 
                        $this->save_settings($_POST);
                        break;
                    default: break;
                }
            }                    
        }

        $settings_result = $wpdb->get_row("SELECT * FROM " . $table_prefix . LIFELINE_SETTINGS_DB);
        
        require 'views/lifeline-admin-general.php';
    }

    public function sync() {
        global $table_prefix, $wpdb;

        $restore_logs = $wpdb->get_results("SELECT * FROM " . $table_prefix . LIFELINE_SYNC_LOG_DB . " WHERE old_restore = 1");
        $old_data_exists = file_exists(LIFELINE_PLUGIN_DIR . '/src/wc.csv');

        require 'views/lifeline-admin-sync.php';
    }

    public function logs() {
        global $table_prefix, $wpdb;

        $sync_logs = $wpdb->get_results("SELECT * FROM " . $table_prefix . LIFELINE_SYNC_LOG_DB . " WHERE old_restore = 0");
        $restore_logs = $wpdb->get_results("SELECT * FROM " . $table_prefix . LIFELINE_SYNC_LOG_DB . " WHERE old_restore = 1");

        require 'views/lifeline-admin-logs.php';
    }

    public function save_settings($data) {
        global $table_prefix, $wpdb;
        
        $vals_arr = array(
            'mklek_db_host' => $data['mklek_db_host'],
            'mklek_db_user' => $data['mklek_db_user'],
            'mklek_db_pass' => $data['mklek_db_pass'],
            'mklek_db_view' => $data['mklek_db_view'],
            'mklek_db_port' => $data['mklek_db_port'],
            'mklek_db_dbname' => $data['mklek_db_dbname'],
        );

        if ($data['id'] == '0')
            $wpdb->insert($table_prefix . LIFELINE_SETTINGS_DB, $vals_arr);
        else
            $wpdb->update($table_prefix . LIFELINE_SETTINGS_DB, $vals_arr,
                array(
                    'id' => $data['id']
                ));
    }
}