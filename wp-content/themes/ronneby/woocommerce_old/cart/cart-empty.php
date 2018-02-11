<?php
/**
 * Empty cart page
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

?>

<div class="cart-empty-page cart-empty">
	
	<h1><?php _e('Empty', 'dfd'); ?></h1>
	
	<p class="cart-empty-text"><?php _e( 'Your cart is currently', 'dfd' ) ?></p>
	
	<p class="cart-empty-subtext"><?php _e( 'You may check out all the available products and buy some in the shop.', 'dfd' ) ?></p>

	<?php do_action( 'woocommerce_cart_is_empty' );
	
	if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
		<p class="return-to-shop">
			<a class="button wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
				<?php _e( 'Return to shop', 'woocommerce' ) ?>
			</a>
		</p>
	<?php endif; ?>
</div>