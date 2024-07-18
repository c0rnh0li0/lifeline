<?php

namespace Lifeline;

// use Lifeline\Controller\LifelineSync;

class Lifeline {
    public $connection;

    public function __construct() { }

    public function run() {
        if (is_admin())
            $this->admin_hooks();
        else 
            $this->frontend_hooks();
    }

    public function admin_hooks() {
        $_admin = new \Lifeline\Admin\LifelineAdmin();

        add_action('admin_menu', [$_admin, 'menu']);
        
        $_admin->register_scripts();   
    }

    public function frontend_hooks() {
        $_frontend = new \Lifeline\Frontend\LifelineFrontend();

        $_frontend->init();   
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
        $tbl_groups   = $table_prefix . LIFELINE_FE_GROUPS_DB;

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
                    mklek_db_dbname VARCHAR(200) NOT NULL,
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

        if($wpdb->get_var("SHOW TABLES LIKE '$tbl_groups'") != $tbl_groups) {

            $sql = "CREATE TABLE $tbl_groups (
                    id INT(11) NOT NULL AUTO_INCREMENT,
                    group_name VARCHAR(150) NOT NULL,
                    products TEXT DEFAULT NULL,
                    promo TINYINT(2) DEFAULT 0,
                    starts_at TIMESTAMP DEFAULT NULL,
                    ends_at TIMESTAMP DEFAULT NULL,
                    active TINYINT(2) DEFAULT 0,
                    is_bestseller TINYINT(2) DEFAULT 0,
                    use_bestseller_cookie TINYINT(2) DEFAULT 0,
                    UNIQUE KEY id (id)
            ) $charset_collate;";
            
            dbDelta($sql);
        }
    }

    private static function remove_db_table() {
        global $table_prefix, $wpdb;

        $wpdb->query('DROP TABLE IF EXISTS ' . $table_prefix . LIFELINE_SETTINGS_DB);
        $wpdb->query('DROP TABLE IF EXISTS ' . $table_prefix . LIFELINE_SYNC_LOG_DB);
        $wpdb->query('DROP TABLE IF EXISTS ' . $table_prefix . LIFELINE_FE_GROUPS_DB);
    }
}

?>