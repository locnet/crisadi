<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$unique_id = uniqid('dfd-related-products-');

if ( $related_products ) : ?>

	<div class="twelve columns related products products-slider-wrap widget">

		<h3 class="widget-title"><?php _e( 'Related products', 'dfd' ); ?></h3>
		
		<div id="<?php echo esc_attr($unique_id); ?>" class="related_products products-slider">
		
			<?php woocommerce_product_loop_start(); ?>

				<?php foreach ( $related_products as $related_product ) : ?>

					<?php
						$post_object = get_post( $related_product->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object );

						wc_get_template_part( 'content', 'product' ); ?>

				<?php endforeach; ?>

			<?php woocommerce_product_loop_end(); ?>
			
		</div>

	</div>

	<script type="text/javascript">
	(function($){
		"use strict";
		$(document).ready(function(){

			$('#<?php echo esc_js($unique_id); ?> .products').slick({
				infinite: false,
				slidesToShow: 4,
				slidesToScroll: 1,
				arrows: false,
				dots: true,
				autoplay: false,//true
				autoplaySpeed: 5000,
				responsive: [
					{
						breakpoint: 1280,
						settings: {
							slidesToShow: 3,
							infinite: true,
							arrows: false,
							dots: true
						}
					},
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 2,
							infinite: true,
							arrows: false,
							dots: true
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 1,
							arrows: false,
							dots: true
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							arrows: false,
							dots: true
						}
					}
				]
			});
		});
		$('#<?php echo esc_js($unique_id); ?> .product').on('mousedown select',(function(e){
			e.preventDefault();
		}));
	})(jQuery);
	</script>

<?php endif;

wp_reset_postdata(); wp_reset_query();
