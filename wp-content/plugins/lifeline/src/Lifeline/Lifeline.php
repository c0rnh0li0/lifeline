<?php

namespace Lifeline;

class Lifeline {
    public function __construct() {
    
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
        if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'lifeline') {
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

        $charset_collate = $wpdb->get_charset_collate();

        // Check to see if the table exists already, if not, then create it
        if($wpdb->get_var("SHOW TABLES LIKE '$tbl_settings'") != $tbl_settings) {

            $sql = "CREATE TABLE $tbl_settings (
                    id INT(11) NOT NULL AUTO_INCREMENT,
                    mklek_db_host VARCHAR(200) NOT NULL,
                    mklek_db_user VARCHAR(200) NOT NULL,
                    mklek_db_pass VARCHAR(200) NOT NULL,
                    mklek_db_view VARCHAR(200) NOT NULL,
                    UNIQUE KEY id (id)
            ) $charset_collate;";


            require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }

    private static function remove_db_table() {
        global $table_prefix, $wpdb;

        $wpdb->query('DROP TABLE IF EXISTS ' . $table_prefix . LIFELINE_SETTINGS_DB);
    }
}

?>