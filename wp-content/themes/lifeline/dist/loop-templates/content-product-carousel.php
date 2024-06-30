<div class="container product-carousel-container" id="product-carousel">

	<div class="row product-carousel">

		<div class="col-12">

			<header class="entry-header">

				<h2>
					<span>Најпродавани</span>
					<a href="<?php echo home_url('/bestsellers/'); ?>">Комплетна листа на најпродавани производи»</a>
				</h2>

				<div class="title-separator">
					<span></span>
				</div>

			</header>

			<div class="products-container">				
				<?php echo do_shortcode('[product-group id="1"]'); ?>
			</div>

		</div>	

	</div><!-- .row -->

</div> <!-- .container -->





