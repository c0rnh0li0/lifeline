<?php 
    global $wp_query;

    $brand_url = ICL_LANGUAGE_CODE == "mk" ? 'brands' : 'brands-en';

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
            <?php 
                echo do_shortcode('[product_attribute attribute="manufacturer" terms="' . $slug . '" operator="IN" paginate="true" columns="' . $columns . '" limit="' . $limit . '"]');
            ?>
        </div>
<?php } else { ?>
    <div class="brands-name-container brands-page-container">
        <?php foreach ($terms as $term) { 
            $single_brand_url = home_url('/' . $brand_url . '/' . $term->slug . '/');

            // echo '<a href="' . $single_brand_url . '">';
            // echo $term->name;
            // echo '</a>';
        ?>
        <div class="ll-brand-cart" data-url="<?php echo $single_brand_url; ?>">
            <a href="<?php echo $single_brand_url; ?>">
                <?php echo $term->name; ?>
            </a>
        </div>

        <?php } ?>
    </div>
<?php } ?>