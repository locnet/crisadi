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

add_filter( 'cmb_meta_boxes', 'dfd_headers_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes Metabox options.
 *
 * @return array
 */
function dfd_headers_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list.
	$prefix = 'preloader_';

	$meta_boxes[] = array(
		'id'         => 'dfd-preloader_settings_box',
		'title'      => esc_attr__( 'Preloader options', 'dfd' ),
		'pages'      => array('page','post','my-product','product','gallery'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left.
		'fields'     => array(
			array(
				'type' => 'title',
				'id' => 'preloader_styles_heading',
				'name' => esc_html__('Preloader styling options','dfd'),
			),
			array(
				'type'    => 'file',
				'id'      => $prefix . 'bg_img',
				'name'    => esc_attr__( 'Preloader background', 'dfd' ),
                'tooltip_text' => esc_html__('The image will be displayed as a background for the preloader', 'dfd'),
				'std'     => '',
				'save_id' => false,
			),
			array(
				'type'    => 'select',
				'id'      => $prefix . 'bg_img_position',
				'name'    => esc_attr__( 'Background position', 'dfd' ),
                'tooltip_text' => esc_html__('Allows you to select the image position for preloader', 'dfd'),
				'options' => dfd_get_bgposition_redux(),
				'std'     => '',
			),
			array(
				'type'    => 'colorpicker',
				'id'      => $prefix . 'bg_color',
				'name'    => esc_attr__( 'Background color', 'dfd' ),
                'tooltip_text' => esc_html__('The color will be displayed as a background for the preloader', 'dfd'),
				'std'     => '',
				'save_id' => false,
			),
			array(
				'type'    => 'select',
				'id'      => $prefix . 'bg_size',
				'name'    => esc_attr__( 'Background size', 'dfd' ),
                'tooltip_text' => esc_html__('Allows you to adjust the background image displaying', 'dfd'),
				'options' => array(
				'std'     => '',
					array(
						'name'  => esc_attr__( 'Cover', 'dfd' ),
						'value' => 'cover',
					),
					array(
						'name'  => esc_attr__( 'Contain', 'dfd' ),
						'value' => 'contain',
					),
					array(
						'name'  => esc_attr__( 'Inheirt', 'dfd' ),
						'value' => 'inherit',
					),
				),
			),
			array(
				'type'    => 'select',
				'id'      => $prefix . 'bg_repeat',
				'name'    => esc_attr__( 'Background repeat', 'dfd' ),
                'tooltip_text' => esc_html__('Allows you to repeat or do not repeate the image set on the background', 'dfd'),
				'std'     => '',
				'options' => array(
					array(
						'name'  => esc_attr__( 'No-repeat', 'dfd' ),
						'value' => 'no-repeat',
					),
					array(
						'name'  => esc_attr__( 'Repeat All', 'dfd' ),
						'value' => 'repeat',
					),
					array(
						'name'  => esc_attr__( 'Repeat Horizontally', 'dfd' ),
						'value' => 'repeat-x',
					),
					array(
						'name'  => esc_attr__( 'Repeat Vertically', 'dfd' ),
						'value' => 'repeat-y',
					),
					array(
						'name'  => esc_attr__( 'Inheirt', 'dfd' ),
						'value' => 'inherit',
					),
				),
			),
			array(
				'type'    => 'select',
				'id'      => $prefix . 'bg_attachment',
				'name'    => esc_attr__( 'Background attachment', 'dfd' ),
                'tooltip_text' => esc_html__('When scroll background style is enabled, the background image scrolls with the content. When fixed background style is enabled, the background image is fixed and content scrolls over it. When initial background style is enabled, the background image and content will be fixed.', 'dfd'),
				'std'     => '',
				'options' => array(
					array(
						'name'  => esc_attr__( 'Inherit', 'dfd' ),
						'value' => 'inherit',
					),
					array(
						'name'  => esc_attr__( 'Scroll', 'dfd' ),
						'value' => 'scroll',
					),
					array(
						'name'  => esc_attr__( 'Fixed', 'dfd' ),
						'value' => 'fixed',
					),
				),
			),
			array(
				'type'    => 'radio_inline_triple',
				'id'      => $prefix . 'enable_counter',
				'name'    => esc_attr__( 'Counter', 'dfd' ),
                'tooltip_text' => esc_html__('Allows you to enable per cents counter for the page loading. If you choose theme default the displaying will correspond to the theme options settings', 'dfd'),
				'options' => array(
					array(
						'name'  => esc_attr__( 'Theme default', 'dfd' ),
						'value' => '',
					),
					array(
						'name'  => esc_attr__( 'On', 'dfd' ),
						'value' => 'on',
					),
					array(
						'name'  => esc_attr__( 'Off', 'dfd' ),
						'value' => 'off',
					),
				),
			),
			array(
				'type'    => 'select',
				'id'      => $prefix . 'style',
				'name'    => esc_attr__( 'Preloader style', 'dfd' ),
                'tooltip_text' => esc_html__('Allows you to choose one of the preset preloader styles and adjust its settings', 'dfd'),
				'options' => array(
				'std'     => '',
					array(
						'name'  => esc_attr__( 'Inherit from options', 'dfd' ),
						'value' => '',
					),
					array(
						'name'  => esc_attr__( 'None', 'dfd' ),
						'value' => 'none',
					),
					array(
						'name'  => esc_attr__( 'CSS Animetion', 'dfd' ),
						'value' => 'css_animation',
					),
					array(
						'name'  => esc_attr__( 'Image', 'dfd' ),
						'value' => 'image',
					),
					array(
						'name'  => esc_attr__( 'Progress bar', 'dfd' ),
						'value' => 'progress_bar',
					),
				),
			),
			array(
				'type'    => 'select',
				'id'      => $prefix . 'animation_style',
				'name'    => esc_attr__( 'Animation style', 'dfd' ),
                'tooltip_text' => esc_html__('Allows you to select the preloader CSS Animation style for your page', 'dfd'),
				'std'     => '',
				'options' => dfd_preloader_animation_style_cmb(),
				'dep_option'    => $prefix . 'style',
				'dep_values'    => 'css_animation',
			),
			array(
				'type'    => 'colorpicker',
				'id'      => $prefix . 'animation_color',
				'name'    => esc_attr__( 'Animation base color', 'dfd' ),
                'tooltip_text' => esc_html__('Allows you to select the color for the selected CSS animation style', 'dfd'),
				'save_id' => false,
				'std'     => '',
				'dep_option'    => $prefix . 'style',
				'dep_values'    => 'css_animation',
			),
			array(
				'type'    => 'file',
				'id'      => $prefix . 'img',
				'name'    => esc_attr__( 'Preloader image', 'dfd' ),
                'tooltip_text' => esc_html__('Allows you to select and upload the image for the preloader on your page', 'dfd'),
				'save_id' => false,
				'std'     => '',
				'dep_option'    => $prefix . 'style',
				'dep_values'    => 'image',
			),
			array(
				'type' => 'text',
				'id'   => $prefix . 'bar_height',
				'name' => esc_attr__( 'Preloader bar height in px', 'dfd' ),
                'tooltip_text' => esc_html__('Allows you to set the preloader bar', 'dfd'),
				'dep_option'    => $prefix . 'style',
				'dep_values'    => 'progress_bar',
			),
			array(
				'type'    => 'colorpicker',
				'id'      => $prefix . 'bar_bg',
				'name'    => esc_attr__( 'Preloader bar background color', 'dfd' ),
                'tooltip_text' => esc_html__('Select the color for your preloader bar to be displayed on the page', 'dfd'),
				'std'     => '',
				'save_id' => false,
				'dep_option'    => $prefix . 'style',
				'dep_values'    => 'progress_bar',
			),
			array(
				'type' => 'text',
				'id'   => $prefix . 'bar_opacity',
				'name' => esc_attr__( 'Preloader bar opacity', 'dfd' ),
                'tooltip_text' => esc_html__('Please enter value from 1 to 100 to adjust preloader bar background opacity', 'dfd'),
				'dep_option'    => $prefix . 'style',
				'dep_values'    => 'progress_bar',
			),
			array(
				'type'    => 'select',
				'id'      => $prefix . 'bar_position',
				'name'    => esc_attr__( 'Preloader bar position', 'dfd' ),
                'tooltip_text' => esc_html__('Allows you to select the preloader bar position', 'dfd'),
				'std'     => '',
				'options' => array(
					array(
						'name'  => esc_attr__( 'Middle', 'dfd' ),
						'value' => 'middle',
					),
					array(
						'name'  => esc_attr__( 'Top', 'dfd' ),
						'value' => 'top',
					),
					array(
						'name'  => esc_attr__( 'Bottom', 'dfd' ),
						'value' => 'bottom',
					),
				),
				'dep_option'    => $prefix . 'style',
				'dep_values'    => 'progress_bar',
			),
		),
	);

	return $meta_boxes;
}
