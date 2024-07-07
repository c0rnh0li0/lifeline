<?php

namespace Lifeline\Frontend;

use Lifeline\Controller\LifelineGroups;

class LifelineFrontend {
    public static $shortcodes = [
        'product-group' => ['product_group', 3],
        'product-manufacturers' => ['manufacturers', 1],
    ];

    public function __construct() {
        
    }

    public function init() {
        $this->register_hooks();
    }

    public function register_hooks() {
        $this->register_shortcodes();
    }

    public function register_shortcodes() {
        foreach (self::$shortcodes as $shortcode_key => $shortcode_val) {
            add_shortcode($shortcode_key, [$this, $shortcode_val[0]], 10, $shortcode_val[1]);
        }
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
}