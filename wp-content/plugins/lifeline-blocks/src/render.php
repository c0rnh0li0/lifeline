<?php 

if ( isset( $attributes['lifelineGroupId'] ) && is_numeric($attributes['lifelineGroupId']) ) {
    $group_id = $attributes['lifelineGroupId'];

    $block_content = do_shortcode('[product-group id="' . $group_id . '"]');
} else {
    $block_content = '<p ' . get_block_wrapper_attributes() . '>No lifeline group selected</p>';
}

var_dump($content);
?>

<p <?php echo get_block_wrapper_attributes(); ?>>
    <?php echo wp_kses_post( $block_content ); ?>
</p>