<?php

namespace Lifeline\Frontend;

use Lifeline\Controller\LifelineGroups;

class LifelineFrontend {
    public static $shortcodes = [
        'product-group' => ['product_group', 1],
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
    public function product_group($id) {
        $frontendGroups = new LifelineGroups();

        return $frontendGroups->product_group_shortcode($id);
    }
}