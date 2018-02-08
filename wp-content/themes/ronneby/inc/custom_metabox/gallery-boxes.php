<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
add_filter( 'cmb_meta_boxes', 'dfd_gallery_boxes' );

function dfd_gallery_boxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'dfd_gallery_';
	
	$appear_effects = dfd_module_animation_styles('metaboxes');
	
	$appear_effects[0]['name'] = __('Inherit from theme options', 'dfd');

	$meta_boxes[] = array(
		'id'         => 'dfd-gallery_single_settings_box',
		'title'      => __('Single gallery options', 'dfd'),
		'pages'      => array('gallery'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => esc_html__('Single gallery options','dfd'),
				'id' => 'heading_single_gallery_option',
				'type' => 'title',
			),  
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'single_stun_header',
				'name'	=> __('Stunning header', 'dfd'),
                'tooltip_text' => esc_html__('Allows you to enable or disable the Stunning header on the single gallery. If you choose inherit from theme options the displaying will correspond to the theme options settings.','dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => __('Enable', 'dfd'), 'value' => 'on', ),
                    array( 'name' => __('Disable', 'dfd'), 'value' => 'off', ),
				),
			),
			array(
				'type' => 'radio_inline_triple',
				'id' => $prefix . 'single_layout',
				'name' => __('Layout width','dfd'),
                'tooltip_text' => esc_html__('Allows you to set your gallery\'s content width to full width or boxed. If you choose inherit from theme options the displaying will correspond to the theme options settings.','dfd'),
				'std'  => false,
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
					array( 'name' => __('Boxed','dfd'), 'value' => 'boxed', ),
					array( 'name' => __('Full width','dfd'), 'value' => 'full-width', ),
				),
			),
			array(
				'type'	=> 'radio_inline',
				'id'	=> $prefix . 'single_sidebars',
				'name'	=> __('Sidebar cofiguration', 'dfd'),
                'tooltip_text' => esc_html__('Allows you to choose sidebars and their position. If you choose inherit from theme options the displaying will correspond to the theme options settings.','dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
                    array( 'name' => __('No sidebars', 'dfd'), 'value' => '1col-fixed', ),
                    array( 'name' => __('Sidebar on left', 'dfd'), 'value' => '2c-l-fixed', ),
                    array( 'name' => __('Sidebar on right', 'dfd'), 'value' => '2c-r-fixed', ),
                    //array( 'name' => __('2 left sidebars', 'dfd'), 'value' => '3c-l-fixed', ),
                    //array( 'name' => __('2 right sidebars', 'dfd'), 'value' => '3c-r-fixed', ),
                    array( 'name' => __('Both left and right sidebars', 'dfd'), 'value' => '3c-fixed', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'single_show_title',
				'name'	=> __('Title', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide the title of the gallery item. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'single_show_meta',
				'name'	=> __('Subtitle', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide the subtitle of the gallery item. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'type' => 'select',
				'id' => $prefix . 'single_type',
				'name' => __('Single gallery style','dfd'),
                'tooltip_text'	=> esc_html__('Allows you to choose the style of the gallery item. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'std'  => '1',
				'options' => array(
					array( 'name' => __('Inherit from theme options','dfd'), 'value' => false, ),
					array( 'name' => __('Carousel','dfd'), 'value' => 'carousel', ),
					array( 'name' => __('Masonry','dfd'), 'value' => 'masonry', ),
					array( 'name' => __('Grid','dfd'), 'value' => 'fitRows', ),
					array( 'name' => __('Advanced gallery','dfd'), 'value' => 'advanced-gallery', ),
				),
			),
			array(
				'type' => 'text',
				'id' => $prefix . 'single_items_offset',
				'name' => __('Items offset in px', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to add space between single images.', 'dfd'),
				'std' => '',
				'save_id' => false, // save ID using true
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'single_autoplay',
				'name'	=> __('Autoslideshow', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to enable or disable the autoslideshow. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
                    array( 'name' => __('Disable', 'dfd'), 'value' => 'false', ),
					array( 'name' => __('Enable', 'dfd'), 'value' => 'true', ),
				),
				'dep_option'    => $prefix . 'single_type',
				'dep_values'    => 'carousel',
			),
			array(
				'type' => 'text',
				'id' => $prefix . 'single_slideshow_speed',
				'name' => __('Slideshow speed', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to adjust the slideshow speed.', 'dfd'),
				'std' => '',
				'save_id' => false, // save ID using true
				'dep_option'    => $prefix . 'single_type',
				'dep_values'    => 'carousel',
			),
			array(
				'type' => 'select',
				'id' => $prefix . 'single_columns',
				'name' => __('Number of columns','dfd'),
				'std'  => '1',
				'options' => array(
					array( 'name' => __('Inherit from theme options','dfd'), 'value' => '', ),
					array( 'name' => __('One column','dfd'), 'value' => '1', ),
					array( 'name' => __('Two columns','dfd'), 'value' => '2', ),
					array( 'name' => __('Three columns','dfd'), 'value' => '3', ),
					array( 'name' => __('Four columns','dfd'), 'value' => '4', ),
					array( 'name' => __('Five columns','dfd'), 'value' => '5', ),
					//array( 'name' => __('Six columns','dfd'), 'value' => '6', ),
				),
				'dep_option'    => $prefix . 'single_type',
				'dep_values'    => 'masonry,fitRows',
			),
			array(
				'type' => 'text',
				'id' => $prefix . 'single_image_width',
				'name' => __('Image width', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to adjust the image width', 'dfd'),
				'std' => '',
				'save_id' => false, // save ID using true
				'dep_option'    => $prefix . 'single_type',
				'dep_values'    => 'carousel,fitRows,advanced-gallery',
			),
			array(
				'type' => 'text',
				'id' => $prefix . 'single_image_height',
				'name' => __('Image height', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to adjust the image height', 'dfd'),
				'std' => '',
				'save_id' => false, // save ID using true
				'dep_option'    => $prefix . 'single_type',
				'dep_values'    => 'carousel,fitRows,advanced-gallery',
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'single_enable_pagination',
				'name'	=> __('Inside pagination', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to enable or disable the inner pagination style for gallery item. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
                    array( 'name' => __('Disable', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Enable', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'single_pagination_style',
				'name'	=> __('Inside pagination position', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to select the inner pagination style for gallery item. If you choose inherit from theme options the displaying will correspond to the theme options settings. If \'Fixed\' is selected, the next/prev pagination arrows will be displayed on scroll. When \'Top\' is selected the next/prev pagination arrows are displayed on top of the gallery item.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
					array( 'name' => __('Fixed', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Top', 'dfd'), 'value' => 'top-folio', ),
				),
				'dep_option'    => $prefix . 'single_enable_pagination',
				'dep_values'    => 'on',
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'single_show_read_more_share',
				'name'	=> __('Share', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide the Read more and share buttons of the single gallery item. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'type'	=> 'select',
				'id'	=> $prefix . 'single_share_style',
				'name'	=> __('Share style', 'dfd'),
                'tooltip_text'	=> esc_html__('Choose one of the preset styles for the Share button. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
					array( 'name' => __('Animated on hover', 'dfd'), 'value' => 'animated', ),
					array( 'name' => __('Simple', 'dfd'), 'value' => 'simple', ),
					//array( 'name' => __('Slide up', 'dfd'), 'value' => 'slide-up', ),
				),
				'dep_option'    => $prefix . 'single_show_read_more_share',
				'dep_values'    => 'on',
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'single_show_fixed_share',
				'name'	=> __('Fixed Share', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide fixed share on the single gallery item\'s page. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
			),
		),
	);
	$meta_boxes[] = array(
		'id'         => 'dfd-gallery_page_settings_box',
		'title'      => __('Gallery options', 'dfd'),
		'pages'      => array('page'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on' => array(
			'key' => 'page-template',
			'value' => 'tmp-gallery.php',
		),
		'fields'     => array(
            array(
				'type' => 'title',
				'id' => 'gallery_layout_heading',
				'name' => esc_html__('Gallery page options','dfd'),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'stun_header',
				'name'	=> __('Stunning header', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide Stunning header. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
					array( 'name' => __('Enable', 'dfd'), 'value' => 'on', ),
                    array( 'name' => __('Disable', 'dfd'), 'value' => 'off', ),
				),
			),
			array(
				'type' => 'radio_inline_triple',
				'id' => $prefix . 'layout',
				'name' => __('Gallery layout width','dfd'),
                'tooltip_text'	=> esc_html__('Allows you specify the width of the page. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'std'  => false,
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
					array( 'name' => __('Boxed','dfd'), 'value' => 'boxed', ),
					array( 'name' => __('Full width','dfd'), 'value' => 'full-width', ),
				),
			),
			array(
				'type'	=> 'radio_inline',
				'id'	=> $prefix . 'sidebars',
				'name'	=> __('Sidebar cofiguration', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you specify the sidebars to be shown. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
                    array( 'name' => __('No sidebars', 'dfd'), 'value' => '1col-fixed', ),
                    array( 'name' => __('Sidebar on left', 'dfd'), 'value' => '2c-l-fixed', ),
                    array( 'name' => __('Sidebar on right', 'dfd'), 'value' => '2c-r-fixed', ),
                    //array( 'name' => __('2 left sidebars', 'dfd'), 'value' => '3c-l-fixed', ),
                    //array( 'name' => __('2 right sidebars', 'dfd'), 'value' => '3c-r-fixed', ),
                    array( 'name' => __('Both left and right sidebars', 'dfd'), 'value' => '3c-fixed', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'show_title',
				'name'	=> __('Title', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide the title of the gallery item. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'show_subtitle',
				'name'	=> __('Subtitle', 'dfd'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide the subtitle of the gallery item. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'content_alignment',
				'name'	=> __('Content alignment', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to choose the content alignment for the gallery item.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Center', 'dfd'), 'value' => 'text-center', ),
                    array( 'name' => __('Left', 'dfd'), 'value' => 'text-left', ),
					array( 'name' => __('Right', 'dfd'), 'value' => 'text-right', ),
				),
			),
			array(
				'type'	=> 'select',
				'id'	=> $prefix . 'title_position',
				'name'	=> __('Heading position', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to specify the title and subtitle position. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => __('Over the image', 'dfd'), 'value' => 'top', ),
                    array( 'name' => __('Under the image', 'dfd'), 'value' => 'bottom', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'show_comments',
				'name'	=> __('Comments count', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide the comments count of the single gallery item. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'show_likes',
				'name'	=> __('Likes', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide the likes count of the single gallery item. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'type'	=> 'select',
				'id'	=> $prefix . 'comments_likes_style',
				'name'	=> __('Comments and like style', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to specify the visibility of comments and likes counter. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Always show', 'dfd'), 'value' => ' ', ),
					array( 'name' => __('Show on hover', 'dfd'), 'value' => 'comments-like-hover', ),
				),
			),
			array(
				'type' => 'text',
				'id' => $prefix . 'works_per_page',
				'name' => __('Works per page', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to enter the number of items to be displayed on gallery page.', 'dfd'),
				'std' => '',
				'save_id' => false, // save ID using true
			),
			array(
				'type' => 'text',
				'id' => $prefix . 'items_offset',
				'name' => __('Items offset in px', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to add space between single galleries.', 'dfd'),
				'std' => '',
				'save_id' => false, // save ID using true
			),
			array(
				'type' => 'select',
				'id' => $prefix . 'layout_style',
				'name' => __('Gallery layout style','dfd'),
                'tooltip_text'	=> esc_html__('Here you can choose layout style for the whole gallery page. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'std'  => '',
				'options' => array(
					array( 'name' => __('Inherit from theme options','dfd'), 'value' => '', ),
					array( 'name' => __('Standard','dfd'), 'value' => 'standard', ),
					array( 'name' => __('Masonry','dfd'), 'value' => 'masonry', ),
					array( 'name' => __('Grid','dfd'), 'value' => 'fitRows', ),
				),
			),
			array(
				'type' => 'select',
				'id' => $prefix . 'columns',
				'name' => __('Number of columns','dfd'),
				'std'  => '1',
				'options' => array(
					array( 'name' => __('Inherit from theme options','dfd'), 'value' => '', ),
					array( 'name' => __('One column','dfd'), 'value' => '1', ),
					array( 'name' => __('Two columns','dfd'), 'value' => '2', ),
					array( 'name' => __('Three columns','dfd'), 'value' => '3', ),
					array( 'name' => __('Four columns','dfd'), 'value' => '4', ),
					array( 'name' => __('Five columns','dfd'), 'value' => '5', ),
					array( 'name' => __('Six columns','dfd'), 'value' => '6', ),
				),
				'dep_option'    => $prefix . 'layout_style',
				'dep_values'    => 'masonry,fitRows',
			),
			array(
                'type' => 'taxonomy_multicheck',
                'id'	=> $prefix . 'category',
                'name' => __('Gallery Category','dfd'),
                'desc'	=> __('Select Gallery items category','dfd'),
                'taxonomy' => 'gallery_category',
            ),
			array(
				'type'	=> 'select',
				'id'	=> $prefix . 'item_appear_effect',
				'name'	=> __('Items appear effect', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to set the unique appear effect for the gallery items. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => $appear_effects,
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'cat_tag',
				'name'	=> __('Categories and tags dropdown', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide categories, tags and author drop-down sorter before gallery items. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => false, ),
					array( 'name' => __('Enable', 'dfd'), 'value' => 'on', ),
                    array( 'name' => __('Disable', 'dfd'), 'value' => 'off', ),
				),
			),
		),
	);
	$meta_boxes[] = array(
		'id'         => 'dfd-gallery_hover_settings_box',
		'title'      => __('Gallery hover options', 'dfd'),
		'pages'      => array('page'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on' => array(
			'key' => 'page-template',
			'value' => 'tmp-gallery.php',
		),
		'fields'     => array(
            array(
				'type' => 'title',
				'id' => 'gallery_hover_heading',
				'name' => esc_html__('Gallery hover options','dfd'),
			),
			array(
				'type'	=> 'select',
				'id'	=> $prefix . 'hover_appear_effect',
				'name'	=> __('Appear effect', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to choose one of the preset appear animations for the gallery items. If you choose inherit from theme options the displaying will correspond to the theme options settings', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Fade out', 'dfd'), 'value' => 'dfd-fade-out', ),
                    array( 'name' => __('Fade out offset', 'dfd'), 'value' => 'dfd-fade-offset', ),
                    array( 'name' => __('From left to right', 'dfd'), 'value' => 'dfd-left-to-right', ),
					array( 'name' => __('From right to left', 'dfd'), 'value' => 'dfd-right-to-left', ),
					array( 'name' => __('From top to bottom', 'dfd'), 'value' => 'dfd-top-to-bottom', ),
					array( 'name' => __('From bottom to top', 'dfd'), 'value' => 'dfd-bottom-to-top', ),
                    array( 'name' => __('From left to right shift image', 'dfd'), 'value' => 'dfd-left-to-right-shift', ),
					array( 'name' => __('From right to left shift image', 'dfd'), 'value' => 'dfd-right-to-left-shift', ),
					array( 'name' => __('From top to bottom shift image', 'dfd'), 'value' => 'dfd-top-to-bottom-shift', ),
					array( 'name' => __('From bottom to top shift image', 'dfd'), 'value' => 'dfd-bottom-to-top-shift', ),
					array( 'name' => __('Following the mouse', 'dfd'), 'value' => 'portfolio-hover-style-1', ),
					array( 'name' => __('Rotate content up', 'dfd'), 'value' => 'dfd-rotate-content-up', ),
                    array( 'name' => __('Rotate content down', 'dfd'), 'value' => 'dfd-rotate-content-down', ),
                    array( 'name' => __('Rotate left', 'dfd'), 'value' => 'dfd-rotate-left', ),
                    array( 'name' => __('Rotate right', 'dfd'), 'value' => 'dfd-rotate-right', ),
                    array( 'name' => __('Rotate top', 'dfd'), 'value' => 'dfd-rotate-top', ),
                    array( 'name' => __('Rotate bottom', 'dfd'), 'value' => 'dfd-rotate-bottom', ),
				),
			),
			array(
				'type'	=> 'select',
				'id'	=> $prefix . 'hover_image_effect',
				'name'	=> __('Image animation', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to choose one of the preset animations for the images. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Image parallax', 'dfd'), 'value' => 'panr', ),
					array( 'name' => __('Grow', 'dfd'), 'value' => 'dfd-image-scale', ),
					array( 'name' => __('Grow with rotation', 'dfd'), 'value' => 'dfd-image-scale-rotate', ),
					array( 'name' => __('Shift left', 'dfd'), 'value' => 'dfd-image-shift-left', ),
					array( 'name' => __('Shift right', 'dfd'), 'value' => 'dfd-image-shift-right', ),
					array( 'name' => __('Shift top', 'dfd'), 'value' => 'dfd-image-shift-top', ),
					array( 'name' => __('Shift bottom', 'dfd'), 'value' => 'dfd-image-shift-bottom', ),
					array( 'name' => __('Blur', 'dfd'), 'value' => 'dfd-image-blur', ),
				),
				'dep_option'    => $prefix . 'hover_appear_effect',
				'dep_values'    => 'dfd-fade-out,dfd-fade-offset,dfd-left-to-right,dfd-right-to-left,dfd-top-to-bottom,dfd-bottom-to-top',
			),
			array(
				'type'	=> 'select',
				'id'	=> $prefix . 'hover_main_dedcoration',
				'name'	=> __('Main decoration', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows to set the decoration which will be displayed on hover. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('None', 'dfd'), 'value' => 'none', ),
                    array( 'name' => __('Heading', 'dfd'), 'value' => 'heading', ),
					array( 'name' => __('Plus', 'dfd'), 'value' => 'plus', ),
					array( 'name' => __('Lines', 'dfd'), 'value' => 'lines', ),
					array( 'name' => __('Dots', 'dfd'), 'value' => 'dots', ),
				),
			),
			array(
				'type'	=> 'select',
				'id'	=> $prefix . 'hover_title_dedcoration',
				'name'	=> __('Heading decoration', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to choose the style for the heading hover decoration. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('None', 'dfd'), 'value' => 'title-deco-none', ),
					array( 'name' => __('Diagonal line', 'dfd'), 'value' => 'diagonal-line', ),
					array( 'name' => __('Title underline', 'dfd'), 'value' => 'title-underline', ),
					array( 'name' => __('Square behind heading', 'dfd'), 'value' => 'square-behind-heading', ),
				),
				'dep_option'    => $prefix . 'hover_main_dedcoration',
				'dep_values'    => 'heading',
			),
			array(
				'type'	=> 'select',
				'id'	=> $prefix . 'hover_link',
				'name'	=> __('Hover link', 'dfd'),
                'tooltip_text'	=> esc_html__('This option allows you to choose the behavior for the decoration link. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Open gallery in lightbox', 'dfd'), 'value' => 'lightbox', ),
					array( 'name' => __('Go to Gallery single item', 'dfd'), 'value' => 'link', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'hover_show_title',
				'name'	=> __('Title', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide the title of the gallery item on hover. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
				'dep_option'    => $prefix . 'hover_main_dedcoration',
				'dep_values'    => 'heading',
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'hover_show_subtitle',
				'name'	=> __('Subtitle', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide the subtitle of the gallery item on hover. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'desc'	=> __('This field requires Page subtitle options to be specified for gallery item to show subtitle correctly','dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
				'dep_option'    => $prefix . 'hover_main_dedcoration',
				'dep_values'    => 'heading',
			),
			array(
				'type'	=> 'select',
				'id'	=> $prefix . 'hover_plus_position',
				'name'	=> __('Plus position', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to specify the Plus decoration position. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => __('Middle of the project', 'dfd'), 'value' => 'dfd-middle', ),
                    array( 'name' => __('Top right corner', 'dfd'), 'value' => 'dfd-top-right', ),
                    array( 'name' => __('Top left corner', 'dfd'), 'value' => 'dfd-top-left', ),
                    array( 'name' => __('Bottom right corner', 'dfd'), 'value' => 'dfd-bottom-right', ),
                    array( 'name' => __('Bottom left corner', 'dfd'), 'value' => 'dfd-bottom-left', ),
				),
				'dep_option'    => $prefix . 'hover_main_dedcoration',
				'dep_values'    => 'plus',
			),
			array(
                'type' => 'colorpicker',
                'id'   => $prefix . 'hover_plus_bg',
                'name' => __('Plus background','dfd'),
                'tooltip_text'	=> esc_html__('Allows you to specify the Plus decoration\'s background. This option is not available for \'Middle of the project\' plus position. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
                'std'  => '',
                'save_id' => false,
				'dep_option'    => $prefix . 'hover_main_dedcoration',
				'dep_values'    => 'plus',
            ),
		),
	);
	// Add other metaboxes as needed

	return $meta_boxes;
}

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function dfd_gallery_add_custom_box() {

    $screens = array( 'gallery' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'dfd_gallery_gallery',
            __( 'Images gallery', 'dfd' ),
            'dfd_gallery_inner_custom_box',
            $screen,
            'side'
        );
    }
}
add_action( 'add_meta_boxes', 'dfd_gallery_add_custom_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function dfd_gallery_inner_custom_box( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'dfd_gallery_inner_custom_box', 'dfd_gallery_inner_custom_box_nonce' );


    ?>

    <div id="gallery_images_container">
        <ul class="gallery_images">
            <?php
            if ( metadata_exists( 'post', $post->ID, '_gallery_image_gallery' ) ) {
                $gallery_image_gallery = get_post_meta( $post->ID, '_gallery_image_gallery', true );
            } else {
                // Backwards compat
                $attachment_ids = get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' );
                $attachment_ids = array_diff( $attachment_ids, array( get_post_thumbnail_id() ) );
                $gallery_image_gallery = implode( ',', $attachment_ids );
            }

            $attachments = array_filter( explode( ',', $gallery_image_gallery ) );

            if ( $attachments ) {
                foreach ( $attachments as $attachment_id ) {
                    echo '<li class="image" data-attachment_id="' . esc_attr($attachment_id) . '">
								' . wp_get_attachment_image( $attachment_id ) . '
								<ul class="actions">
									<li><a href="#" class="delete tips" data-tip="' . __( 'Delete image', 'dfd' ) . '">' . __( 'Delete', 'dfd' ) . '</a></li>
								</ul>
							</li>';
                }
			} ?>
        </ul>

        <input type="hidden" id="gallery_image_gallery" name="gallery_image_gallery" value="<?php echo esc_attr( $gallery_image_gallery ); ?>" />

    </div>
    <p class="add_gallery_images hide-if-no-js">
        <a class="button" href="#"><?php _e( 'Add gallery images', 'dfd' ); ?></a>
    </p>
    <script type="text/javascript">
        jQuery(document).ready(function($){

            // Uploading files
            var gallery_gallery_frame;
            var $image_gallery_ids = $('#gallery_image_gallery');
            var $gallery_images = $('#gallery_images_container ul.gallery_images');

            jQuery('.add_gallery_images').on( 'click', 'a', function( event ) {

                var $el = $(this);
                var attachment_ids = $image_gallery_ids.val();

                event.preventDefault();

                // If the media frame already exists, reopen it.
                if ( gallery_gallery_frame ) {
                    gallery_gallery_frame.open();
                    return;
                }

                // Create the media frame.
                gallery_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: '<?php _e( 'Add Images to Gallery', 'dfd' ); ?>',
                    button: {
                        text: '<?php _e( 'Add to gallery', 'dfd' ); ?>'
                    },
                    multiple: true
                });

                // When an image is selected, run a callback.
                gallery_gallery_frame.on( 'select', function() {

                    var selection = gallery_gallery_frame.state().get('selection');

                    selection.map( function( attachment ) {

                        attachment = attachment.toJSON();

                        if ( attachment.id ) {
                            attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;

                            $gallery_images.append('\
									<li class="image" data-attachment_id="' + attachment.id + '">\
										<img src="' + attachment.url + '" />\
										<ul class="actions">\
											<li><a href="#" class="delete" title="<?php _e( 'Delete image', 'dfd' ); ?>"><?php _e( 'Delete', 'dfd' ); ?></a></li>\
										</ul>\
									</li>');
                        }

                    } );

                    $image_gallery_ids.val( attachment_ids );
                });

                // Finally, open the modal.
                gallery_gallery_frame.open();
            });

            // Image ordering
            $gallery_images.sortable({
                items: 'li.image',
                cursor: 'move',
                scrollSensitivity:40,
                forcePlaceholderSize: true,
                forceHelperSize: false,
                helper: 'clone',
                opacity: 0.65,
                placeholder: 'wc-metabox-sortable-placeholder',
                start:function(event,ui){
                    ui.item.css('background-color','#f6f6f6');
                },
                stop:function(event,ui){
                    ui.item.removeAttr('style');
                },
                update: function(event, ui) {
                    var attachment_ids = '';

                    $('#gallery_images_container ul li.image').css('cursor','default').each(function() {
                        var attachment_id = jQuery(this).attr( 'data-attachment_id' );
                        attachment_ids = attachment_ids + attachment_id + ',';
                    });

                    $image_gallery_ids.val( attachment_ids );
                }
            });

            // Remove images
            $('#gallery_images_container').on( 'click', 'a.delete', function() {

                $(this).closest('li.image').remove();

                var attachment_ids = '';

                $('#gallery_images_container ul li.image').css('cursor','default').each(function() {
                    var attachment_id = jQuery(this).attr( 'data-attachment_id' );
                    attachment_ids = attachment_ids + attachment_id + ',';
                });

                $image_gallery_ids.val( attachment_ids );

                return false;
            } );

        });
    </script>


<?php

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function dfd_gallery_save_postdata( $post_id ) {

    /*
     * We need to verify this came from the our screen and with proper authorization,
     * because save_post can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['dfd_gallery_inner_custom_box_nonce'] ) )
        return $post_id;

    $nonce = $_POST['dfd_gallery_inner_custom_box_nonce'];

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'dfd_gallery_inner_custom_box' ) )
        return $post_id;

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;

    // Check the user's permissions.
    if ( 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) )
            return $post_id;

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) )
            return $post_id;
    }

    /* OK, its safe for us to save the data now. */

    // Sanitize user input.
    $mydata = $_POST['gallery_image_gallery'];

    // Update the meta field in the database.
    update_post_meta( $post_id, '_gallery_image_gallery', $mydata );
}
add_action( 'save_post', 'dfd_gallery_save_postdata' );