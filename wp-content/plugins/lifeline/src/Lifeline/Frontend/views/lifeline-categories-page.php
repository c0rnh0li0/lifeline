<?php
    $columns = 5;
    $limit = 15;

    if (wp_is_mobile()) {
        $columns = 2;
        $limit = 20;
    }
    
    echo do_shortcode('[product_categories number="0" parent="0"]');