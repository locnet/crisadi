<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
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
 * @version     3.2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews" class="row">

	<div id="comments" class="six columns">
		<div class="dfd-wrapper">
		<?php
		echo '<div class="box-name">'.__( 'Reviews', 'dfd' ).'</div>';

		$title_reply = '';

		if ( have_comments() ) :

			?>

			<ol class="commentlist">

			<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>

			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<div class="navigation">
					<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous', 'dfd' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'dfd' ) ); ?></div>
				</div>
			<?php endif;

			//echo '<p class="add_review"><a href="#review_form" class="inline show_review_form button" data-rel="prettyPhoto" title="' . __( 'Add Your Review', 'dfd' ) . '"><i class="infinityicon-pencil"></i>' . __( 'Add Review', 'dfd' ) . '</a></p>';

			$title_reply = __( 'Add a review', 'dfd' );

		else :

			$title_reply = __( 'Be the first to review', 'dfd' ).' &ldquo;'.$post->post_title.'&rdquo;'; ?>

			<p class="noreviews"><?php _e( 'There are no reviews yet, would you like to <a href="#review_form" class="inline show_review_form"><i class="infinityicon-pencil"></i>submit yours</a>?', 'dfd' ); ?></p>

		<?php endif;

		if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) :

		$commenter = wp_get_current_commenter(); ?>

		</div>
	</div>
	<div id="review_form_wrapper" class="six columns">
		<div id="review_form">

			<?php
			$comment_form = array(
				'title_reply'          => have_comments() ? __( 'Add a review', 'dfd' ) : sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'dfd' ), get_the_title() ),
				'title_reply_to'       => __( 'Leave a Reply to %s', 'dfd' ),
				'title_reply_before'   => '<span id="reply-title" class="comment-reply-title">',
				'title_reply_after'    => '</span>',
				'comment_notes_after'  => '',
				'fields'               => array(
					'author' => '<p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name', 'dfd' ) . ' <span class="required">*</span></label> ' .
								'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" required /></p>',
					'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'dfd' ) . ' <span class="required">*</span></label> ' .
								'<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" required /></p>',
				),
				'label_submit'  => __( 'Submit', 'dfd' ),
				'logged_in_as'  => '',
				'comment_field' => '',
			);

			if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
				$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'dfd' ), esc_url( $account_page_url ) ) . '</p>';
			}

			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
				$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'dfd' ) . '</label><select name="rating" id="rating" aria-required="true" required>
					<option value="">' . esc_html__( 'Rate&hellip;', 'dfd' ) . '</option>
					<option value="5">' . esc_html__( 'Perfect', 'dfd' ) . '</option>
					<option value="4">' . esc_html__( 'Good', 'dfd' ) . '</option>
					<option value="3">' . esc_html__( 'Average', 'dfd' ) . '</option>
					<option value="2">' . esc_html__( 'Not that bad', 'dfd' ) . '</option>
					<option value="1">' . esc_html__( 'Very poor', 'dfd' ) . '</option>
				</select></div>';
			}

			$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your review', 'dfd' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required></textarea></p>';

			comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );

			endif; ?>

		</div>
	</div>

	<div class="clear"></div>
	
</div>