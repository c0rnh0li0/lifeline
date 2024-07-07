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

	<div class="entry-content za-nas">

		<?php
		the_content();
		understrap_link_pages();
		?>

	</div><!-- .entry-content -->

    <div class="photos-container">
        <div class="container-fluid">
            <div class="row">
                <div class="photozoom col-12 col-md-4">
                    <a href="<?php echo get_stylesheet_directory_uri(); ?>/img/lifeline-photos/lifeline-001.webp"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/lifeline-photos/lifeline-001-t.webp" alt="Lifeline pharmacy 001"></a>    
                </div>
                <div class="photozoom col-12 col-md-4">
                    <a href="<?php echo get_stylesheet_directory_uri(); ?>/img/lifeline-photos/lifeline-002.webp"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/lifeline-photos/lifeline-002-t.webp" alt="Lifeline pharmacy 002"></a>
                </div>
                <div class="photozoom col-12 col-md-4">
                    <a href="<?php echo get_stylesheet_directory_uri(); ?>/img/lifeline-photos/lifeline-003.webp"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/lifeline-photos/lifeline-002-t.webp" alt="Lifeline pharmacy 003"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-container">
        <div class="container-fluid">
            <div class="row">
                <div class="contact-left col-12 col-md-4">    
                    <div class="contacts-content">
                        <div class="contact-logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/lifeline-logo.webp" alt="<?php echo get_bloginfo( 'name' ); ?>" /></div>
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
                </div>
                <div class="contact-right col-12 col-md-8">
                    <div class="contact-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1482.493442839648!2d21.400788!3d42.000557!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1354157c15d39f35%3A0xda61bdbefb49cec8!2sLifeLine%20Pharmacy!5e0!3m2!1sen!2sus!4v1719949294049!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="photos-container">
        <div class="container-fluid">
            <div class="row">
                <div class="photozoom col-12 col-md-4">
                    <a href="<?php echo get_stylesheet_directory_uri(); ?>/img/lifeline-photos/lifeline-004.webp"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/lifeline-photos/lifeline-004-t.webp" alt="Lifeline pharmacy 004"></a>    
                </div>
                <div class="photozoom col-12 col-md-4">
                    <a href="<?php echo get_stylesheet_directory_uri(); ?>/img/lifeline-photos/lifeline-005.webp"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/lifeline-photos/lifeline-005-t.webp" alt="Lifeline pharmacy 005"></a>
                </div>
                <div class="photozoom col-12 col-md-4">
                    <a href="<?php echo get_stylesheet_directory_uri(); ?>/img/lifeline-photos/lifeline-006.webp"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/lifeline-photos/lifeline-006-t.webp" alt="Lifeline pharmacy 006"></a>
                </div>
            </div>
        </div>
    </div>

	<footer class="entry-footer">

		<?php understrap_edit_post_link(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
