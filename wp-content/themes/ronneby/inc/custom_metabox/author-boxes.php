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

add_filter('cmb_meta_boxes', 'dfd_author_metaboxes');

/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function dfd_author_metaboxes(array $meta_boxes) {


	// Start with an underscore to hide fields from custom fields list
	$prefix = 'author_';

	$meta_boxes[] = array(
		'id' => 'dfd-portfolio-page-options',
		'title' => __('Set author parameters', 'dfd'),
		'pages' => array('author','dfd-author',), // Post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => esc_html__('Set author parameters','dfd'),
				'id' => 'heading_author_taxonomy',
				'type' => 'title',
			),
			array(
				'type' => 'text',
				'id' => 'dfd_author_name',
				'name' => __('Author\'s name', 'dfd'),
				'std' => '',
				'save_id' => false, // save ID using true
			),
			array(
				'type' => 'text',
				'id' => 'dfd_author_subtitle',
				'name' => __('Author\'s info', 'dfd'),
				'std' => '',
				'save_id' => false, // save ID using true
			),
			array(
				'type' => 'text',
				'id' => 'dfd_author_facebook',
				'name' => __('Author\'s Facebook URL', 'dfd'),
				'std' => '',
				'save_id' => false, // save ID using true
			),
			array(
				'type' => 'text',
				'id' => 'dfd_author_twitter',
				'name' => __('Author\'s Twitter URL', 'dfd'),
				'std' => '',
				'save_id' => false, // save ID using true
			),
			array(
				'type' => 'text',
				'id' => 'dfd_author_google',
				'name' => __('Author\'s Google+ URL', 'dfd'),
				'std' => '',
				'save_id' => false, // save ID using true
			),
			array(
				'type' => 'text',
				'id' => 'dfd_author_linkedin',
				'name' => __('Author\'s LinkedIn URL', 'dfd'),
				'std' => '',
				'save_id' => false, // save ID using true
			),
			array(
				'type' => 'text',
				'id' => 'dfd_author_flickr',
				'name' => __('Author\'s Flickr URL', 'dfd'),
				'std' => '',
				'save_id' => false, // save ID using true
			),
			array(
				'type' => 'text',
				'id' => 'dfd_author_vimeo',
				'name' => __('Author\'s Vimeo page URL', 'dfd'),
				'std' => '',
				'save_id' => false, // save ID using true
			),
			array(
				'type' => 'text',
				'id' => 'dfd_author_instagram',
				'name' => __('Author\'s Instagram page URL', 'dfd'),
				'std' => '',
				'save_id' => false, // save ID using true
			),
		),
	);

	return $meta_boxes;
}
