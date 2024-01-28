<?php

namespace Lifeline\Admin;

class LifelineAdmin {        
        public function __construct() { }

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
           
            require 'views/lifeline-admin-panel.php';
        }

        public function scripts() {
            // wp_enqueue_script('mollie_admin_bootstrap', plugin_dir_url( __FILE__ ) . 'assets/js/bootstrap.min.js', array( 'jquery' ), null, true);
            
            // custom propeller admin js
            wp_enqueue_script('lifeline_admin_js', plugin_dir_url( __FILE__ ) . 'assets/js/lifeline-admin.js', array( 'jquery' ), null, true);
        }

        public function styles() {
            wp_enqueue_style( 'lifeline_admin_bootstrap', plugin_dir_url( __FILE__ ) . 'assets/css/bootstrap.min.css', array(), null, 'all' );

            // custom propeller admin css
            wp_enqueue_style( 'lifeline_admin_css', plugin_dir_url( __FILE__ ) . 'assets/css/lifeline-admin.css', array(), null, 'all' );
        }

        public function menu() {
            add_menu_page('Lifeline', 'Lifeline', 'manage_options', 'lifeline', array( $this, 'dashboard' ));
        }

        public function save_settings($data) {
            global $table_prefix, $wpdb;
            
            $vals_arr = array(
                'mklek_db_host' => $data['mklek_db_host'],
                'mklek_db_user' => $data['mklek_db_user'],
                'mklek_db_pass' => $data['mklek_db_pass'],
                'mklek_db_view' => $data['mklek_db_view'],
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