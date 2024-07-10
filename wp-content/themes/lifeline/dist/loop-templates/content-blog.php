<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" class="blog-post">

    <div class="entry-meta">
        <?php the_time('F j, Y'); ?>
    </div>

    <?php the_title( '<h1 class="entry-title"><span>', '</span></h1>' ); ?>	

    <div class="entry-content">

	    <div class="featured-image"><?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?></div>
            <?php
            the_content();            
		?>

	</div><!-- .entry-content -->
	

</article><!-- #post-<?php the_ID(); ?> -->
