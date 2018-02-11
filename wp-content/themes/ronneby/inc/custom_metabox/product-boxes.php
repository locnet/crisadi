<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_filter( 'cmb_meta_boxes', 'dfd_product_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */

function dfd_product_metaboxes( array $meta_boxes ) {

	$meta_boxes[] = array(
		'id'         => 'dfd-product_subtitle_metabox',
		'title'      => __('Additional options', 'dfd'),
		'pages'      => array( 'product' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => esc_html__('Additional options','dfd'),
				'id' => 'heading_woo_option',
				'type' => 'title',
			),
			array(
                'type' => 'text',
	            'id'   => 'dfd_product_product_subtitle',
	            'name' => __('Product subtitle', 'dfd'),
				'std'  => '',
                'save_id' => false, // save ID using true
	        ),/*
			array(
	            'name' => __('Size guide', 'dfd'),
	            'desc' => __('', 'dfd'),
	            'id'   => 'dfd_product_size_guide',
                'type' => 'file',
                'save_id' => true, // save ID using true
				'std'  => ''
	        ),*/
		),
	);

	return $meta_boxes;
}
