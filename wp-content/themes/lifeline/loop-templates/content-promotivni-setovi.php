<?php
/**
 * Partial template for content in page.php
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>" class="blogs">

	<?php
	if ( ! is_page_template( 'page-templates/no-title.php' ) ) {
		the_title(
			'<header class="entry-header"><h1 class="entry-title"><span>',
			'</span></h1></header><!-- .entry-header -->'
		);
	}

	echo get_the_post_thumbnail( $post->ID, 'large' );
	?>

	<div class="entry-content promotiven-set-posts">

		<?php
		the_content();		
		?>

        <div class="container-fluid px-0">
            <div class="row no-gutters gx-4">
            <?php
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $args = array(
                'post_type' => 'post' ,
                'meta_type' => 'DATE',              
                'orderby' => 'meta_value',
                'order' => 'ASC',
                'posts_per_page' => -1,
                'category_name' => 'promotiven-set',
                'paged' => $paged
                );
                $custom_query = new WP_Query( $args );
                ?>
                <?php
                while($custom_query->have_posts()) :
                    $custom_query->the_post();
                ?>
                <?php 
                    $teamname = get_the_title();
                    $teamimg = wp_get_attachment_image_src(get_post_thumbnail_id() , 'full', false);
                ?>
                <div class="col-12 col-md-3 promotiven-set-post">
                    <div class="promotiven-set-post-container">
                        <div class="featured-image"><?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?></div>
                        <div class="entry-meta">
                            <?php the_time('F j, Y'); ?>
                        </div>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    </div>
                </div>
            <?php endwhile; ?>	
            </div>
        </div>

	</div><!-- .entry-content -->

    

	<footer class="entry-footer">

		<?php understrap_edit_post_link(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
