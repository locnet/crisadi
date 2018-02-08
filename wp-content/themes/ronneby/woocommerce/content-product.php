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

$wrap_class = $animation_data = '';

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( !empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $woocommerce_loop['columns'] );
elseif(isset($dfd_ronneby['woo_category_columns']) && !empty($dfd_ronneby['woo_category_columns']))
	$woocommerce_loop['columns'] =  apply_filters( 'loop_shop_columns', (int) $dfd_ronneby['woo_category_columns']);
else
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
    $classes[] = 'three columns';
} elseif ($woocommerce_loop['columns'] == '3') {
    $classes[] = 'four columns';
} elseif ($woocommerce_loop['columns'] == '2') {
    $classes[] = 'six columns';
} elseif ($woocommerce_loop['columns'] == '1') {
    $classes[] = 'twelve columns';
} else {
    $classes[] = 'four columns';
}

$product_style = (isset($dfd_ronneby['woo_products_loop_style']) && $dfd_ronneby['woo_products_loop_style']) ? $dfd_ronneby['woo_products_loop_style'] : 'style-1';

$buttons_color_scheme = (isset($dfd_ronneby['woo_products_buttons_color_scheme']) && $dfd_ronneby['woo_products_buttons_color_scheme']) ? $dfd_ronneby['woo_products_buttons_color_scheme'] : 'dfd-buttons-dark';

$content_align = (isset($dfd_ronneby['woo_category_content_alignment']) && $dfd_ronneby['woo_category_content_alignment']) ? $dfd_ronneby['woo_category_content_alignment'] : 'text-center';

$classes[] = ' dfd-loop-shop-responsive ';

$classes[] = $product_style;

$wrap_class .= $content_align;

if(isset($dfd_ronneby['woo_category_item_appear_effect']) && $dfd_ronneby['woo_category_item_appear_effect']) {
	$wrap_class .= ' cr-animate-gen';
	$animation_data .= 'data-animate-type="'.esc_attr($dfd_ronneby['woo_category_item_appear_effect']).'"';
}

//$categ = $product->get_categories(); //if all categories should be displayed
$subtitle = get_post_meta($product->get_id(), 'dfd_product_product_subtitle', true);

$catalogue_mode = (isset($dfd_ronneby['woocommerce_catalogue_mode']) && $dfd_ronneby['woocommerce_catalogue_mode']);

$stock = $product->is_in_stock() ? '' : '<span class="dfd-woo-stock">'.esc_html__('Out of stock','dfd').'</span>';

$permalink = get_permalink();
?>
<div <?php post_class($classes); ?>>
    <div class="prod-wrap <?php echo esc_attr($wrap_class) ?>" <?php echo $animation_data ?>>

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
					<a href="<?php echo esc_url($permalink); ?>" class="link"></a>
				<?php endif ?>
				<?php echo $stock; ?>
			</div>
		</div>
		<?php if(!$catalogue_mode): ?>
			<div class="woo-title-wrap">
				<div class="heading">
					<div class="dfd-folio-categories">
						<?php get_template_part('templates/woo', 'term'); ?>
					</div>
					<div class="box-name"><a href="<?php echo esc_url($permalink); ?>"><?php the_title(); ?></a></div>
					<?php if(!empty($subtitle)) : ?>
						<div class="subtitle"><?php echo esc_html($subtitle); ?></div>
					<?php endif; ?>
					<div class="price-wrap">
						<?php do_action('woocommerce_after_shop_loop_item_title'); ?>
					</div>
					<div class="rating-section">
						<?php wc_get_template_part('loop/rating'); ?>
					</div>
				</div>
			</div>
		<?php endif ?>
		<?php if(strcmp($product_style, 'style-2') === 0) : ?>
			<div class="additional-price <?php echo esc_attr($buttons_color_scheme) ?>">
				<div>
					<?php do_action('woocommerce_after_shop_loop_item_title') ?>
				</div>
			</div>
		<?php endif; ?>
    </div>
</div>