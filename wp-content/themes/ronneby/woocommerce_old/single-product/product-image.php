<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $woocommerce, $dfd_ronneby;
$unique_id = uniqid('woo-single-image-');
?>

<div class="images columns seven">
	<div class="single-product-image woocommerce-product-gallery__image">
		<?php
		if ( has_post_thumbnail() ) {
			$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
			$thumb_link  = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
			if(function_exists('wc_get_image_size')) {
				$image_size = wc_get_image_size('shop_single');
				$img_url = dfd_aq_resize($image_link, $image_size['width'], $image_size['height'], $image_size['crop'], true, true);
				if(!$img_url) {
					$img_url = $image_link;
				}
				$image = '<img src="'.esc_url($img_url).'" class="dfd-woo-main-image wp-post-image" alt="'.esc_attr($image_title).'" />';
			} else {
				$image = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
			}

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div itemprop="image" id="'. esc_attr($unique_id) .'" class="woocommerce-main-image %s">%s <a href="'.esc_url($image_link).'"><img src="%s" alt="" class="dfd-large-image" /></a></div>', $image_title, $image, $image_link ), $post->ID );
			?>
			<script type="text/javascript">
			(function($) {
				var wrap = $('#<?php echo $unique_id; ?>');
				var wrapLeft, wrapTop, wrapWidth, wrapHeight, largeImage, largeImageWidth, largeImageheight, ratioX, ratioY;
				var calculateVars = function() {
					setTimeout(function() {
						wrapLeft =  wrap.offset().left;
						wrapTop =  wrap.offset().top;
						wrapWidth =  wrap.width();
						wrapHeight =  wrap.height();
						largeImage = wrap.find('img.dfd-large-image');
						largeImageWidth = largeImage.width();
						largeImageheight = largeImage.height();
						ratioX = largeImageWidth / wrapWidth - 1;
						ratioY = largeImageheight / wrapHeight - 1;
					},100);
				};
				var magnifierMove = function() {
					wrap.mousemove(function(e) {
						if(largeImage) {
							var coordLeft = (e.pageX - wrapLeft) * ratioX;
							if(coordLeft < 0) coordLeft = 0;
							if(coordLeft > largeImageWidth) coordLeft = largeImageWidth;
							var coordTop = (e.pageY - wrapTop) * ratioY;
							if(coordTop < 0) coordTop = 0;
							if(coordTop > largeImageheight) coordTop = largeImageheight;
							largeImage.css({
								'left' : -coordLeft,
								'top' : -coordTop
							});
						}
					});
				};
				$(document).ready(function() {
					magnifierMove();
				});
				$(window).on("resize load scroll", calculateVars);
			})(jQuery);
			</script>
			<?php
		} else {
			/*Compatibility v 3.0.0*/
			if(function_exists('wc_placeholder_img_src')) {
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );
			} else {
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );
			}
		}
		?>
	</div>
	
	<div class="single-product-thumbnails">
		<?php do_action( 'woocommerce_product_thumbnails' ); ?>
	</div>
</div>