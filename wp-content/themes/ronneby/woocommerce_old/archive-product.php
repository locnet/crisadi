<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
?>

<?php get_template_part('templates/header/top', 'woocommerce'); ?>

<section id="layout">
    <div class="row module dfd-woo-archive">
        <div class="nine columns">
			
			<h2 class="widget-title  text-left woo-page-title">
				<span><?php _e('The best offers', 'dfd'); ?></span>
			</h2>
			
			<div class="clear"></div>
			
            <?php
            global $post;
            if(function_exists('wc_get_page_id')) {
				$shop_page_id = wc_get_page_id( 'shop' );
			} else {
				$shop_page_id = woocommerce_get_page_id( 'shop' );
			}
            $shop_page    = get_post( $shop_page_id );


            if ( is_post_type_archive() && !empty($shop_page) && is_object($shop_page) ){
                echo '<div class="shop__main_desc">';
					$content = apply_filters('the_content', $shop_page->post_content);
					echo $content;
                echo '</div>';
            }

            ?>
			
			<div class="clear"></div>
			<?php
			/**
			 * woocommerce_before_main_content hook.
			 *
			 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			 * @hooked woocommerce_breadcrumb - 20
			 */

			//do_action( 'woocommerce_before_main_content' );

			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
			
            if (have_posts()) : ?>

				<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */

				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

				do_action('woocommerce_before_shop_loop');

				?>

				<?php woocommerce_product_loop_start(); ?>

				<?php
					global $woocommerce_loop;
					$woocommerce_loop['columns'] = 3;
				?>
				<?php 
					while (have_posts()) : the_post();

						/**
						 * Hook: woocommerce_shop_loop.
						 *
						 * @hooked WC_Structured_Data::generate_product_data() - 10
						 */
						do_action( 'woocommerce_shop_loop' );

						wc_get_template_part( 'content', 'product' );

					endwhile;
					?>

				<?php woocommerce_product_loop_end(); ?>

				<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action('woocommerce_after_shop_loop');
				?>

            <?php elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

            <?php wc_get_template('loop/no-products-found.php'); ?>

            <?php endif; ?>
			
			<?php
			/**
			 * woocommerce_after_main_content hook.
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			//do_action( 'woocommerce_after_main_content' );
			?>

        </div>

        <div class="three columns">
            <?php dynamic_sidebar('shop-sidebar-product-list'); ?>
        </div>

    </div>
</section>

