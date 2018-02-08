<?php
/**
 * The template to display the reviewers meta data (name, verified owner, review date)
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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $comment;
$verified = wc_review_is_from_verified_owner( $comment->comment_ID );

if ( '0' === $comment->comment_approved ) { ?>

	<p class="meta subtitle"><em class="woocommerce-review__awaiting-approval"><?php esc_attr_e( 'Your comment is awaiting approval', 'dfd' ); ?></em></p>

<?php } else { ?>

	<div class="box-name author left woocommerce-review__author" itemprop="author"><?php comment_author(); ?></div> <?php

	if ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ) {
		echo '<em class="woocommerce-review__verified verified">(' . esc_attr__( 'verified owner', 'dfd' ) . ')</em> ';
	}

	?>&ndash; <time itemprop="datePublished" class="woocommerce-review__published-date" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( wc_date_format() ); ?></time>:

<?php }