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

        // $product_id = wc_get_product_id_by_sku('1036102');
        // $woo_product = wc_get_product($product_id);

        // var_dump($woo_product->get_description());
        // var_dump($woo_product->get_short_description());
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
        add_action( 'wp_enqueue_scripts', [$this, 'scripts']);
        add_action( 'wp_enqueue_scripts', [$this, 'styles']);

        // $this->scripts();
        // $this->styles();
    }

    public function scripts() {

        wp_enqueue_script('lifeline_slick', plugin_dir_url( __FILE__ ) . 'assets/js/slick.min.js', [ 'jquery' ], null, true);
        
        wp_enqueue_script('lifeline_frontend', plugin_dir_url( __FILE__ ) . 'assets/js/lifeline.js', [ 'jquery' ], null, true);

        wp_localize_script('lifeline_frontend', 'lifeline_frontend_ajax', [ 
            'ajaxurl' => admin_url('admin-ajax.php') 
        ]);
    }

    public function styles() {
        wp_enqueue_style( 'lifeline_slick_css', plugin_dir_url( __FILE__ ) . 'assets/css/slick.css', array(), null, 'all' );
        wp_enqueue_style( 'lifeline_slick_theme_css', plugin_dir_url( __FILE__ ) . 'assets/css/slick-theme.css', array(), null, 'all' );
        wp_enqueue_style( 'lifeline_frontend_css', plugin_dir_url( __FILE__ ) . 'assets/css/lifeline.css', array(), null, 'all' );
    }

    // Shortcodes 
    public function product_group($id, $display_title, $columns) {
        $frontendGroups = new LifelineGroups();

        return $frontendGroups->product_group_shortcode($id, $display_title, $columns);
    }

    public static function disable_wpml_filters() {
        global $sitepress;
        remove_filter(
            "get_terms_args", 
            [$sitepress, "get_terms_args_filter"], 
            10
        );
        remove_filter(
            "get_term", 
            [$sitepress, "get_term_adjust_id"], 
            1
        );
        remove_filter(
            "terms_clauses", 
            [$sitepress, "terms_clauses"], 
            10
        );
    }

    public static function enable_wpml_filters() {
        global $sitepress;
        add_filter(
            "get_terms_args", 
            [$sitepress, "get_terms_args_filter"], 
            10,
            2
        );
        add_filter(
            "get_term", 
            [$sitepress, "get_term_adjust_id"], 
            1
        );
        add_filter(
            "terms_clauses", 
            [$sitepress, "terms_clauses"], 
            10,
            4
        );
    }

    public function manufacturers() {
        $all_languages = apply_filters( 'wpml_active_languages', null, [
            'skip_missing' => false
        ]);

        self::disable_wpml_filters();

        $terms = get_terms([
            'taxonomy' => 'pa_manufacturer',
        ]);

        self::enable_wpml_filters();

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