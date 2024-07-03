<?php 
    global $wp_query;

    // var_dump($wp_query);

    if (isset($wp_query->query_vars['manufacturer']) && !empty($wp_query->query_vars['manufacturer'])) {
        $slug = $wp_query->query_vars['manufacturer'];

        $term = get_term_by( 'slug', $slug, 'pa_manufacturer' );

        echo "<h2>$term->name</h2>";


        echo do_shortcode('[product_attribute attribute="manufacturer" terms="' . $slug . '" operator="IN" paginate="true"]');
        // echo do_shortcode('[products terms="' . $slug . '" terms_operator="IN" paginate="true"]');
    } else {
        foreach ($terms as $term) { ?>
            <a href="<?php echo home_url('/brands/' . $term->slug . '/'); ?>">
                <?php echo $term->name; ?>
            </a>
<?php } } ?>