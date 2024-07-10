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
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/temp-images/main-banner.webp" alt="Slide 001" class="d-block w-100">
						<div class="carousel-caption d-none d-md-block" style="display: none !important">
							<h5>First slide label</h5>
							<p>Some representative placeholder content for the first slide.</p>
						</div>
						</div>
						<div class="carousel-item" data-bs-interval="2000">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/temp-images/main-banner.webp" alt="Slide 002" class="d-block w-100">
						<div class="carousel-caption d-none d-md-block" style="display: none !important">
							<h5>Second slide label</h5>
							<p>Some representative placeholder content for the second slide.</p>
						</div>
						</div>
						<div class="carousel-item">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/temp-images/main-banner.webp" alt="Slide 003" class="d-block w-100">
						<div class="carousel-caption d-none d-md-block" style="display: none !important">
							<h5>Third slide label</h5>
							<p>Some representative placeholder content for the third slide.</p>
						</div>
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
					<a href="#" class="lifeline-offer"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/temp-images/square-banner-01.webp" alt="Offer 001"></a>
					<a href="#" class="lifeline-offer"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/temp-images/square-banner-02.webp" alt="Offer 002"></a>
					<a href="#" class="lifeline-offer"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/temp-images/square-banner-03.webp" alt="Offer 003"></a>
					<a href="#" class="lifeline-offer"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/temp-images/square-banner-04.webp" alt="Offer 004"></a>
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
				<?php echo do_shortcode('[product-group id="3"]'); ?>
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

				<div class="brands-name-container">				
					<?php 
						$terms = get_terms([
							'taxonomy' => 'pa_manufacturer'
						]);
						
						// $brands = [];
						
						// for ($i = 0; $i < 6; $i++)
						// 	$brands[] = $terms[rand(0, count($terms) - 1)];
						$brands = array_rand($terms, 18);

						foreach ($brands as $index) { ?> 
						
						<a href="<?php echo home_url('/brands/' . $terms[$index]->slug . '/'); ?>">
							<?php echo $terms[$index]->name; ?>
						</a>

					<?php } ?>
				</div>

				<?php if ( wp_is_mobile() ) : ?>
					<div class="more-items"><a href="<?php echo home_url('/brands/'); ?>">Комплетна листа на брендови»</a></div>
				<?php endif; ?>

			</div>	

		</div><!-- .row -->

	</div> <!-- .container -->

</div>