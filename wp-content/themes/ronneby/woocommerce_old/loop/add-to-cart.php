<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
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
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if(isset($class) && !empty($class)) {
	$class = str_replace('button', '', $class);
	$class = str_replace('add_to_cart_', 'add_to_cart_button', $class);
} else {
	$class = 'add_to_cart_button';
}

echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		esc_attr( $class ),
		'<span class="cover"><span class="front"><i class="dfd-icon-trolley_input"></i><span>'.esc_html( $product->add_to_cart_text() ).'</span></span><span class="back"><i class="dfd-icon-trolley_input"></i><span>'.esc_html( $product->add_to_cart_text() ).'</span></span></span>'
	),
$product );
