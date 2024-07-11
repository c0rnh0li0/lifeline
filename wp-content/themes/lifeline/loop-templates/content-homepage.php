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
						<div class="carousel-item active" data-bs-interval="10000">
							<a href="https://orion.com.mk/users/web1_apteka/promotiven-set/%d0%bc%d0%b5%d1%81%d0%b5%d1%86-%d0%bd%d0%b0-eucerin/">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/temp-sliders/eucerin-big.webp" alt="Slide 001" class="d-block w-100">
							</a>						
						</div>
						<div class="carousel-item" data-bs-interval="2000">
							<a href="https://orion.com.mk/users/web1_apteka/promotiven-set/%d0%b5%d0%ba%d1%81%d0%ba%d0%bb%d1%83%d0%b7%d0%b8%d0%b2%d0%bd%d0%b8-%d1%81%d0%b5%d1%82%d0%be%d0%b2%d0%b8-%d0%bd%d0%b0-bioderma-%d0%b2%d0%be-%d0%bc%d0%b5%d1%81%d0%b5%d1%86-%d1%98%d1%83%d0%bb%d0%b8/">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/temp-sliders/bioderma-big.webp" alt="Slide 002" class="d-block w-100">						
						</div>
						<div class="carousel-item">
							<a href="https://orion.com.mk/users/web1_apteka/promotiven-set/%d0%bf%d1%80%d0%be%d0%bc%d0%be%d1%82%d0%b8%d0%b2%d0%bd%d0%b8-%d1%81%d0%b5%d1%82%d0%be%d0%b2%d0%b8-%d0%bd%d0%b0-%d0%b1%d0%b5%d0%ba%d1%83%d1%82%d0%b0%d0%bd/">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/temp-sliders/becutan-big.webp" alt="Slide 003" class="d-block w-100">
							</a>
						</div>
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
					<a href="https://orion.com.mk/users/web1_apteka/akcija/%d0%b3%d0%be%d0%bb%d0%b5%d0%bc%d0%b8-%d0%bf%d0%be%d0%bf%d1%83%d1%81%d1%82%d0%b8-%d0%bd%d0%b0-uriage-%d0%bf%d1%80%d0%be%d0%b8%d0%b7%d0%b2%d0%be%d0%b4%d0%b8-%d0%b2%d0%be-lifeline/" class="lifeline-offer"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/temp-sliders/uriage-600x600.webp" alt="Offer 001"></a>
					<a href="https://orion.com.mk/users/web1_apteka/akcija/%d0%bc%d0%b5%d1%81%d0%b5%d1%86-%d0%bd%d0%b0-bioderma-%d0%b2%d0%be-lifeline/" class="lifeline-offer"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/temp-sliders/bioderma-600x600.webp" alt="Offer 002"></a>
					<a href="https://orion.com.mk/users/web1_apteka/akcija/eucerin-%d0%bf%d1%80%d0%be%d0%b8%d0%b7%d0%b2%d0%be%d0%b4%d0%b8-%d1%81%d0%be-25-%d0%bf%d0%be%d0%bf%d1%83%d1%81%d1%82-%d1%81%d0%b0%d0%bc%d0%be-%d0%be%d0%b2%d0%be%d1%98-%d0%bc%d0%b5%d1%81%d0%b5%d1%86/" class="lifeline-offer"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/temp-sliders/eucerin-600x600.webp" alt="Offer 003"></a>
					<a href="https://orion.com.mk/users/web1_apteka/akcija/%d0%bc%d0%b5%d1%81%d0%b5%d1%86-%d0%bd%d0%b0-%d0%b1%d0%b5%d0%ba%d1%83%d1%82%d0%b0%d0%bd-%d0%bf%d1%80%d0%be%d0%b8%d0%b7%d0%b2%d0%be%d0%b4%d0%b8/" class="lifeline-offer"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/temp-sliders/becutan-600x600.webp" alt="Offer 004"></a>
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