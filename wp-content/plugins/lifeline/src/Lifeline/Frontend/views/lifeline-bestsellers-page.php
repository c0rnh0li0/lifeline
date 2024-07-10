<?php
    $columns = 5;
    $limit = 15;

    if (wp_is_mobile()) {
        $columns = 2;
        $limit = 20;
    }
    
    echo do_shortcode('[best_selling_products paginate="true" limit="' . $limit . '" columns="' . $columns . '"]');