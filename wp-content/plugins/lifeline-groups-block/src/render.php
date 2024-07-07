<p <?php echo get_block_wrapper_attributes(); ?>>

<?php 

if ( isset( $attributes['groupId'] ) && !empty($attributes['groupId']) ) {
    $group_id = (int) $attributes['groupId'];
	$display_title = (bool) $attributes['displayTitle'];
    $columns = (int) $attributes['columns'];

	$shortcode = '[product-group id="' . $group_id . '" display_title="' . $display_title . '" columns="' . $columns . '"]';

    echo do_shortcode($shortcode);
}

?>
</p>