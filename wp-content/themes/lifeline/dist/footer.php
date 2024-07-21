<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="ecommerce">

		<div class="wrapper ecommerce-wrapper" id="ecommerce-wrapper">

			<div class="container">

				<div class="row">

					<div class="col-12">

						<div class="ecommerce-content">

							<div class="ecommerce-element">
								<div class="ecommerce-img">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/ecommerce-icon-001.webp" alt="Ecommerce icon 001" />
								</div>
								<p class="ecommerce-title"><?php _e('Free delivery','woothemes'); ?></p>
								<span><?php _e('On all orthers over 1500 den.','woothemes'); ?></span>
							</div>

							<div class="ecommerce-element">
								<div class="ecommerce-img">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/ecommerce-icon-002.webp" alt="Ecommerce icon 002" />
								</div>
								<p class="ecommerce-title"><?php _e('Secure payment','woothemes'); ?></p>
								<span><?php _e('For all types of cards','woothemes'); ?></span>							
							</div>

							<div class="ecommerce-element">
								<div class="ecommerce-img">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/ecommerce-icon-003.webp" alt="Ecommerce icon 003" />
								</div>
								<p class="ecommerce-title"><?php _e('Customer support','woothemes'); ?></p>
								<span><?php _e('We are always here for your questions','woothemes'); ?></span>							
							</div>

							<div class="ecommerce-element">
								<div class="ecommerce-img">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/ecommerce-icon-004.webp" alt="Ecommerce icon 004" />
								</div>
								<p class="ecommerce-title"><?php _e('Cache refunds','woothemes'); ?></p>
								<span><?php _e('Possibility of exchange or refund','woothemes'); ?></span>
							</div>

						</div>					

					</div>

				</div>

			</div>

		</div>

		<div class="wrapper footer-wrapper" id="footer-wrapper">

			<div class="container">

				<div class="col-12">

					<div class="footer-main">

						<div class="footer-one">

							<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/lifeline_black.webp" alt="Lifeline footer logo" />

						</div>

						<div class="footer-two">

							<div class="footer-contacts">
								<a class="footer-contact" href="tel:+389070217128">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/icon-phone-green.svg" alt="Lifeline phone" />
									<span>070 217 128</span>
								</a>
								<a class="footer-contact" href="mailto:contact@lifeline.mk">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/icon-mail.svg" alt="Lifeline mail" />
									<span>contact@lifeline.mk</span>
								</a>
								<a class="footer-contact" href="https://maps.app.goo.gl/u75AJ43y9cyeppJ89" target="_blank">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/icon-location.svg" alt="Lifeline location" />
									<span>Париска 15, Скопје</span>
								</a>
							</div>
						</div>

						<div class="footer-three">

							<div class="social">
								<a href="#" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/facebook.svg" alt="Facebook" /></a>
								<a href="#" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/instagram.svg" alt="Instagram" /></a>
							</div>

							<div class="copyright-container">
								<span>&copy;</span>
								<span id="copyright">
									<script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>
								</span>
								<span>, <?php _e('All rights reserved','woothemes'); ?></span>
							</div>

							<div class="cards">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/cards.webp" alt="Cards" />
							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>


</div><!-- #wrapper-footer -->

<?php // Closing div#page from header.php. ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>

