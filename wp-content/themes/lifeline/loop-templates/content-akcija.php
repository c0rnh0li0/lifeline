<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" class="akcija-post">

    <div class="entry-meta">
        <?php the_time('F j, Y'); ?>
    </div>

    <?php the_title( '<h1 class="entry-title"><span>', '</span></h1>' ); ?>	

    <div class="entry-content">

            <?php
            the_content();            
		?>

	</div><!-- .entry-content -->
	

</article><!-- #post-<?php the_ID(); ?> -->
