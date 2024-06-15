
<div class="wrapper" id="index-wrapper">

	<div class="container product-carousel-container" id="product-carousel">		

			<main class="site-main" id="main">

				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'loop-templates/content-product-carousel', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				}
				?>

			</main>
		
	</div><!-- #content -->

</div><!-- #page-wrapper -->