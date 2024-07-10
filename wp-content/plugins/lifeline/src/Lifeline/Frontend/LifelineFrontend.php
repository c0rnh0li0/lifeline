<?php

namespace Lifeline\Frontend;

use Lifeline\Controller\LifelineGroups;

class LifelineFrontend {
    public static $shortcodes = [
        'product-group' => ['product_group', 3],
        'product-manufacturers' => ['manufacturers', 1],
        'product-bestsellers' => ['bestsellers', 1],
        'product-categories' => ['categories', 1],
    ];

    public function __construct() {
        
    }

    public function init() {
        $this->register_hooks();

        $this->register_scripts();
    }

    public function register_hooks() {
        $this->register_shortcodes();
    }

    public function register_shortcodes() {
        foreach (self::$shortcodes as $shortcode_key => $shortcode_val) {
            add_shortcode($shortcode_key, [$this, $shortcode_val[0]], 10, $shortcode_val[1]);
        }
    }

    public function register_scripts() {
        $this->scripts();
        $this->styles();
    }

    private function scripts() {
        wp_enqueue_script('lifeline_slick', plugin_dir_url( __FILE__ ) . 'assets/js/slick.min.js', [ 'jquery' ], null, true);
        
        wp_enqueue_script('lifeline_frontend', plugin_dir_url( __FILE__ ) . 'assets/js/lifeline.js', [ 'jquery' ], null, true);

        wp_localize_script('lifeline_frontend', 'lifeline_frontend_ajax', [ 
            'ajaxurl' => admin_url('admin-ajax.php') 
        ]);
    }

    private function styles() {
        wp_enqueue_style( 'lifeline_slick_css', plugin_dir_url( __FILE__ ) . 'assets/css/slick.css', array(), null, 'all' );
        wp_enqueue_style( 'lifeline_slick_theme_css', plugin_dir_url( __FILE__ ) . 'assets/css/slick-theme.css', array(), null, 'all' );
        wp_enqueue_style( 'lifeline_frontend_css', plugin_dir_url( __FILE__ ) . 'assets/css/lifeline.css', array(), null, 'all' );
    }

    // Shortcodes 
    public function product_group($id, $display_title, $columns) {
        $frontendGroups = new LifelineGroups();

        return $frontendGroups->product_group_shortcode($id, $display_title, $columns);
    }

    public function manufacturers() {
        $terms = get_terms([
            'taxonomy' => 'pa_manufacturer'
        ]);

        ob_start();

        require_once LIFELINE_TEMPLATES_DIR . 'lifeline-manufacturers.php';

        $content = ob_get_clean();

        return $content;
    }

    public function bestsellers($dummy) {
        ob_start();

        require_once LIFELINE_TEMPLATES_DIR . 'lifeline-bestsellers-page.php';

        $content = ob_get_clean();

        return $content;
    }

    public function categories($dummy) {
        ob_start();

        require_once LIFELINE_TEMPLATES_DIR . 'lifeline-categories-page.php';

        $content = ob_get_clean();

        return $content;
    }
}