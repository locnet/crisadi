<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $dfd_ronneby;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == (1 == $woocommerce_loop['columns']) || (( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns']) ) {
    $classes[] = 'first';
}
if ( 0 == (1 == $woocommerce_loop['columns']) || ($woocommerce_loop['loop'] % $woocommerce_loop['columns']) ) {
    $classes[] = 'last';
}

if($woocommerce_loop['columns'] == '4') {
    $classes[] = 'three columns dfd-loop-shop-responsive ';
} elseif ($woocommerce_loop['columns'] == '3') {
    $classes[] = 'four columns dfd-loop-shop-responsive ';
} else {
    $classes[] = 'four columns dfd-loop-shop-responsive ';
}
$post_id = $product->get_id();
$terms = get_the_terms($post_id, 'product_cat');
$categories = array();
if(is_array($terms)) {
	foreach($terms as $term) {
		$categories[] = $term->name;
	}
}
//$categ = $product->get_categories(); //if all categories should be displayed
$subtitle = get_post_meta($product->get_id(), 'dfd_product_product_subtitle', true);

$catalogue_mode = (isset($dfd_ronneby['woocommerce_catalogue_mode']) && $dfd_ronneby['woocommerce_catalogue_mode']);

?>
<div <?php post_class($classes); ?>>
    <div class="prod-wrap">

		<?php do_action('woocommerce_before_shop_loop_item'); ?>
		<div class="woo-cover">
			<div class="prod-image-wrap woo-entry-thumb">

				<?php
					/**
					 * woocommerce_before_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action('woocommerce_before_shop_loop_item_title');
				?>
				<?php if(!$catalogue_mode): ?>
					<a href="<?php the_permalink(); ?>" class="link"></a>
				<?php endif ?>
			</div>
		</div>
		<?php if(!$catalogue_mode): ?>
			<div class="woo-title-wrap">
				<div class="box-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
				<div class="price-wrap">
					<?php do_action('woocommerce_after_shop_loop_item_title'); ?>
				</div>
				<?php if(!empty($subtitle)) : ?>
					<div class="subtitle"><?php echo $subtitle; ?></div>
				<?php endif; ?>
				<div class="rating-section">
					<?php wc_get_template_part('loop/rating'); ?>
				</div>
			</div>
		<?php endif ?>
    </div>
</div>