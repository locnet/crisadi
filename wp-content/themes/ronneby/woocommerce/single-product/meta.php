<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
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

global $product;
?>
<div class="product-meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>
	
	<div class="inline-block text-left">

		<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
			<span itemprop="productID" class="sku_wrapper"><span class="meta-heading"><?php _e( 'Product code:', 'dfd' ); ?></span> <span class="sku"><?php echo $product->get_sku(); ?></span>.</span>
		<?php endif; ?>

		<?php 
		if(function_exists('wc_get_product_category_list')) {
			echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in"><span class="meta-heading">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'dfd' ) . '</span> ', '</span>' );
		} else {
			echo $product->get_categories( ', ', '<span class="posted_in"><span class="meta-heading">' . _n( 'Category:', 'Categories:', sizeof( get_the_terms( $product->get_id(), 'product_cat' ) ), 'dfd' ) . '</span> ', '.</span>' );
		}
		?>

		<?php
		if(function_exists('wc_get_product_tag_list')) {
			echo wc_get_product_tag_list( $product->get_id(), ' ', '<span class="tagged_as"><span class="meta-heading">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'dfd' ) . '</span> ', '</span>' );
		} else {
			echo $product->get_tags( ' ', '<span class="tagged_as"><span class="meta-heading">' . _n( 'Tag:', 'Tags:', sizeof( get_the_terms( $product->get_id(), 'product_tag' ) ), 'dfd' ) . '</span> ', '</span>' );
		}
		?>

	</div>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>