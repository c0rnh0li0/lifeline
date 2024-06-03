<?php
/**
 * Header Navbar (bootstrap5)
 *
 * @package Understrap
 * @since 1.1.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<nav id="main-nav" class="navbar navbar-expand-md navbar-dark" aria-labelledby="main-nav-label">

	<h2 id="main-nav-label" class="screen-reader-text">
		<?php esc_html_e( 'Main Navigation', 'understrap' ); ?>
	</h2>


	<div class="<?php echo esc_attr( $container ); ?>">

		<!-- Your site branding in the menu -->
		<?php get_template_part( 'global-templates/navbar-branding' ); ?>		

		<div class="search-home">
			<?php get_search_form(); ?>
		</div>

		<div class="phone">
			<a href="tel:+389070217128"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/icon-phone.svg" alt="Phone" /><span>070 217 128</span></a>
		</div>

		<div class="top-buttons">
			<a href="#" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/icon-heart-plus.svg" alt="Heart plus" /></a>
			<a href="#" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/icon-cart.svg" alt="Cart" /></a>
		</div>
		
		<div class="social">
			<a href="#" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/facebook.svg" alt="Facebook" /></a>
			<a href="#" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/instagram.svg" alt="Instagram" /></a>
		</div>

		<button
			class="navbar-toggler"
			type="button"
			data-bs-toggle="collapse"
			data-bs-target="#navbarNavDropdown"
			aria-controls="navbarNavDropdown"
			aria-expanded="false"
			aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>"
		>
			<span class="navbar-toggler-icon"></span>
		</button>

	</div><!-- .container(-fluid) -->	

</nav><!-- #main-nav -->

<div class="wrapper menu-wrapper">
		<div class="<?php echo esc_attr( $container ); ?>">	
		
			<div class="row header-bottom">

				<div class="col-9 lifeline-nav navbar-expand-md">
					<!-- The WordPress Menu goes here -->
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'container_class' => 'collapse navbar-collapse',
							'container_id'    => 'navbarNavDropdown',
							'menu_class'      => 'navbar-nav',
							'fallback_cb'     => '',
							'menu_id'         => 'main-menu',
							'depth'           => 2,
							'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
						)
					);
					?>
				</div>

				<div class="col-3 lifeline-profile">
					<a href="#" class="profile-button create-profile"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/icon-profile.svg" alt="Create profile"><span>Креирај профил</span></a>
					<a href="#" class="profile-button profile-login"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/icon-login.svg" alt="Profile login"><span>Најави се</span></a>
				</div>


			</div>

			
		</div>
	</div>
