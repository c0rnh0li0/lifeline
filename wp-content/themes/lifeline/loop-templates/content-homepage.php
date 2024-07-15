<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<div class="container" id="homepage-top-section">	

	<div class="row home-top-row">

		<div class="col-12">

			<div class="main-carousel">
				<div id="carouselExampleDark" class="carousel slide" data-bs-ride="carousel">				
					<div class="carousel-inner">
					<?php if( have_rows('main-homepage-slider', 'option') ): while ( have_rows('main-homepage-slider', 'option') ) : the_row(); ?>
						<?php if( have_rows('main-slider-slides', 'option') ): $counter = 0; while ( have_rows('main-slider-slides', 'option') ) : the_row();  ?>					
								<?php 
								$klasa = "carousel-item";
								if ( $counter == 0) : $klasa = "carousel-item active"; endif;
								$optvalue = get_sub_field('homepage-slide');
								$optimg = get_sub_field('big-banner');
								$optlink = get_permalink( $optvalue->ID );
								$opttitle = $optvalue->post_title;
								?>		
								<div class="<?php echo esc_html( $klasa ); ?>" data-bs-interval="4000">
									<a href="<?php echo esc_html( $optlink ); ?>">
										<img src="<?php echo esc_html( $optimg ); ?>" alt="<?php echo esc_html( $opttitle ); ?>" class="d-block w-100">
									</a>						
								</div>	
							<?php $counter++; endwhile; ?><?php endif; ?>
						<?php endwhile; ?><?php endif; ?>
					</div>
					<div class="carousel-indicators">
						<button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
						<button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
						<button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>

						<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Previous</span>
						</button>
						<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Next</span>
						</button>
					</div>
					
				</div>
		
			</div>

			<div class="recommend-block">
				<h2><span>Наша препорака</span></h2>
				<div class="recommend-inner">
					<?php if( have_rows('recomended-posts', 'option') ): while ( have_rows('recomended-posts', 'option') ) : the_row(); ?>		
						<?php 
						$kockatl = get_sub_field('post-top-left');
						$kockatr = get_sub_field('post-top-right');
						$kockabl = get_sub_field('post-down-left');
						$kockabr = get_sub_field('post-down-right');
						$linktl = get_permalink( $kockatl->ID );
						$titletl = $kockatl->post_title;
						$srctl = wp_get_attachment_image_src( get_post_thumbnail_id($kockatl->ID), 'full' );
						$feattl = $srctl[0];
						$linktr = get_permalink( $kockatr->ID );
						$titletr = $kockatr->post_title;
						$srctr = wp_get_attachment_image_src( get_post_thumbnail_id($kockatr->ID), 'full' );
						$feattr = $srctr[0];
						$linkbl = get_permalink( $kockabl->ID );
						$titlebl = $kockabl->post_title;
						$srcbl = wp_get_attachment_image_src( get_post_thumbnail_id($kockabl->ID), 'full' );
						$featbl = $srcbl[0];
						$linkbr = get_permalink( $kockabr->ID );
						$titlebr = $kockabr->post_title;
						$srcbr = wp_get_attachment_image_src( get_post_thumbnail_id($kockabr->ID), 'full' );
						$featbr = $srcbr[0];
						?>		
						<a href="<?php echo esc_html( $linktl ); ?>" class="lifeline-offer"><img src="<?php echo esc_html( $feattl ); ?>" alt="<?php echo esc_html( $titletl ); ?>"></a>	
						<a href="<?php echo esc_html( $linktr ); ?>" class="lifeline-offer"><img src="<?php echo esc_html( $feattr ); ?>" alt="<?php echo esc_html( $titletr ); ?>"></a>	
						<a href="<?php echo esc_html( $linkbl ); ?>" class="lifeline-offer"><img src="<?php echo esc_html( $featbl ); ?>" alt="<?php echo esc_html( $titlebl ); ?>"></a>	
						<a href="<?php echo esc_html( $linkbr ); ?>" class="lifeline-offer"><img src="<?php echo esc_html( $featbr ); ?>" alt="<?php echo esc_html( $titlebr ); ?>"></a>	
					<?php endwhile; ?><?php endif; ?>
				</div>
			</div>

		</div>	

	</div><!-- .row -->

	<div class="row" id="green-home">
			
		
	</div><!-- .row -->


	</article><!-- #post-<?php the_ID(); ?> -->

</div><!-- #content -->

<!-- TOP PRODUCTS -->

<div class="container product-carousel-container" id="product-carousel">

	<div class="row product-carousel">

		<div class="col-12">

			<header class="entry-header">

				<h2>
					<span>Најпродавани</span>
					<?php if ( !wp_is_mobile() ) : ?>
						<a href="<?php echo home_url('/bestsellers/'); ?>">Комплетна листа на најпродавани производи»</a>
					<?php endif; ?>
				</h2>

				<div class="title-separator">
					<span></span>
				</div>

			</header>

			<div class="products-container">				
				<?php echo do_shortcode('[product-group id="1"]'); ?>
			</div>

			<?php if ( wp_is_mobile() ) : ?>
				<div class="more-items"><a href="<?php echo home_url('/bestsellers/'); ?>">Комплетна листа на најпродавани производи»</a></div>
			<?php endif; ?>

		</div>	

	</div><!-- .row -->

</div> <!-- .container -->

<!-- BRANDS -->

<div class="wrapper brands-wrapper" id="brands-wrapper">

	<div class="container brands-container" id="brands-carousel">

		<div class="row brands-carousel">

			<div class="col-12">

				<header class="entry-header">

					<h2>
						<span>Брендови</span>
						<?php if ( !wp_is_mobile() ) : ?>
							<a href="<?php echo home_url('/brands/'); ?>">Комплетна листа на брендови»</a>
						<?php endif; ?>
					</h2>

					<div class="title-separator">
						<span></span>
					</div>

				</header>

				<div class="brands-carousel-wrapper">
					<div class="brands-slider-container">				
						<?php 
							$terms = get_terms([
								'taxonomy' => 'pa_manufacturer'
							]);
							
							$total_brands = 24;

							if (wp_is_mobile())
								$total_brands = 12;

							$brands = array_rand($terms, $total_brands);

							foreach ($brands as $index) { ?> 
							
							<a href="<?php echo home_url('/brands/' . $terms[$index]->slug . '/'); ?>">
								<?php echo $terms[$index]->name; ?>
							</a>

						<?php } ?>
					</div>
				</div>
				<?php if ( wp_is_mobile() ) : ?>
					<div class="more-items"><a href="<?php echo home_url('/brands/'); ?>">Комплетна листа на брендови»</a></div>
				<?php endif; ?>

			</div>	

		</div><!-- .row -->

	</div> <!-- .container -->

</div>