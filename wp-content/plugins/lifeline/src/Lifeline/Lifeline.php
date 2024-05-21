<?php

namespace Lifeline;

use Lifeline\Controller\LifelineSync;

class Lifeline {
    public $connection;

    public function __construct() {
        if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            // add_action( 'woocommerce_loaded', [$this, 'woocommerce_hook'] );        
            add_action( 'wp_loaded', [$this, 'woocommerce_hook'] );        
        }
    }

    public function woocommerce_hook() {
        if (!is_admin()) {
            if (isset($_REQUEST['sync'])) {
                $sync = new LifelineSync();
            
                $sync->sync();
            }

            if (isset($_REQUEST['restore'])) {
                $sync = new LifelineSync();
            
                $sync->restore_wc_data();
            }
        }
    }

    public function run() {
        if (is_admin())
            $this->admin_hooks();
    }

    public function admin_hooks() {
        $_admin = new \Lifeline\Admin\LifelineAdmin();

        // add wp admin menu for Mollie Propeller
        add_action('admin_menu', [$_admin, 'menu']);
        
        // include admin scripts and styles
        if (isset($_REQUEST['page']) && str_contains($_REQUEST['page'], 'lifeline')) {
            add_action('admin_enqueue_scripts', [$_admin, 'styles']);
            add_action('admin_enqueue_scripts', [$_admin, 'scripts']);
        }    
    }

    public static function activate() {
        self::create_db_table();
    }

    public static function deactivate() {
        // self::remove_db_table();
    }

    public static function uninstall() {
        self::remove_db_table();
    }

    private static function create_db_table() {
        global $table_prefix, $wpdb;

        $tbl_settings   = $table_prefix . LIFELINE_SETTINGS_DB;
        $tbl_logs   = $table_prefix . LIFELINE_SYNC_LOG_DB;

        $charset_collate = $wpdb->get_charset_collate();

        require_once(ABSPATH . '/wp-admin/includes/upgrade.php');

        // Check to see if the table exists already, if not, then create it
        if($wpdb->get_var("SHOW TABLES LIKE '$tbl_settings'") != $tbl_settings) {

            $sql = "CREATE TABLE $tbl_settings (
                    id INT(11) NOT NULL AUTO_INCREMENT,
                    mklek_db_host VARCHAR(200) NOT NULL,
                    mklek_db_port INT(10) NOT NULL,
                    mklek_db_user VARCHAR(200) NOT NULL,
                    mklek_db_pass VARCHAR(200) NOT NULL,
                    mklek_db_view VARCHAR(200) NOT NULL,
                    UNIQUE KEY id (id)
            ) $charset_collate;";
            
            dbDelta($sql);
        }

        if($wpdb->get_var("SHOW TABLES LIKE '$tbl_logs'") != $tbl_logs) {

            $sql = "CREATE TABLE $tbl_logs (
                    id INT(11) NOT NULL AUTO_INCREMENT,
                    execution TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    inserted INT(10) NOT NULL DEFAULT 0,
                    updated INT(10) NOT NULL DEFAULT 0,
                    deleted INT(10) NOT NULL DEFAULT 0,
                    logs TEXT DEFAULT NULL,
                    old_restore TINYINT(2) DEFAULT 0,
                    sync_type INT(10) DEFAULT 3,
                    UNIQUE KEY id (id)
            ) $charset_collate;";
            
            dbDelta($sql);
        }
    }

    private static function remove_db_table() {
        global $table_prefix, $wpdb;

        $wpdb->query('DROP TABLE IF EXISTS ' . $table_prefix . LIFELINE_SETTINGS_DB);
        $wpdb->query('DROP TABLE IF EXISTS ' . $table_prefix . LIFELINE_SYNC_LOG_DB);
    }
}

?>