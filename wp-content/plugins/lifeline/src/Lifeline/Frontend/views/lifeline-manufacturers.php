<?php 
    global $wp_query;

    $columns = 5;
    $limit = 15;

    if (wp_is_mobile()) {
        $columns = 2;
        $limit = 10;
    }        

    if (isset($wp_query->query_vars['manufacturer']) && !empty($wp_query->query_vars['manufacturer'])) {
        $slug = $wp_query->query_vars['manufacturer'];

        $term = get_term_by( 'slug', $slug, 'pa_manufacturer' );

        echo "<h2>$term->name</h2>";
?>
        <div class="brands-products-container">
            <?php echo do_shortcode('[product_attribute attribute="manufacturer" terms="' . $slug . '" operator="IN" paginate="true" columns="' . $columns . '" limit="' . $limit . '"]'); ?>
        </div>
<?php } else { ?>
    <div class="brands-name-container">
        <?php foreach ($terms as $term) { ?>
            <a href="<?php echo home_url('/brands/' . $term->slug . '/'); ?>" class="brand-single-container">
                <?php echo $term->name; ?>
            </a>
        <?php } ?>
    </div>
<?php } ?>