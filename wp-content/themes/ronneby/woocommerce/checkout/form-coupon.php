<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
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
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

	/*Compatibility v 3.0.0*/
if(function_exists('wc_coupons_enabled')) {
	if ( ! wc_coupons_enabled() ) {
		return;
	}
} else {
	if ( ! WC()->cart->coupons_enabled() ) {
		return;
	}
}
?>

<div class="dfd-coupon-wrap right">
	
	<?php
	if ( empty( WC()->cart->applied_coupons ) ) {
		$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'dfd' ) . ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'dfd' ) . '</a>' );
		wc_print_notice( $info_message, 'notice' );
	}
	?>

	<form class="checkout_coupon" method="post" style="display:none">

		<p class="form-row form-row-first">
			<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'dfd' ); ?>" id="coupon_code" value="" />
		</p>

		<p class="form-row form-row-last">
			<input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'dfd' ); ?>" />
		</p>

		<div class="clear"></div>
	</form>
	
</div>
<div class="clear"></div>