<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Portfolio module
*/
if(!class_exists('Dfd_Portfolio_Module')) {
	class Dfd_Portfolio_Module {
		
		var $admin_src = 'inc/vc_custom/dfd_vc_addons/admin/img/portfolio/';
		var $front_template = 'inc/vc_custom/dfd_vc_addons/templates/portfolio/';
		
		function __construct(){
			add_action('init',array($this,'dfd_portfolio_module_init'));
			add_shortcode('dfd_portfolio_module',array($this,'dfd_portfolio_module_shortcode'));
		}
		function dfd_portfolio_module_init(){
			if(function_exists('vc_map')) {
				vc_map(
					array(
						'name' => esc_attr__('Portfolio module','dfd'),
						'base' => 'dfd_portfolio_module',
						'icon' => 'dfd_portfolio_module dfd_shortcode',
						'category' => esc_attr__('Ronneby 2.0','dfd'),
						'description' => esc_attr__('Displays Portfolio items','dfd'),
						'params' => array(
							array(
								'type'        => 'radio_image_select',
								'heading'     => esc_html__( 'Style', 'dfd' ),
								'param_name'  => 'style',
								'options'     => dfd_build_shortcode_style_param($this->admin_src, $this->front_template),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Portfolio items settings', 'dfd' ),
								'param_name'       => 'loop_elements_heading',
								'group'            => esc_attr__( 'Content', 'dfd' ),
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allos you to choose the portfolios to show. You can set Loop and specify the categories to be shown or choose single item','dfd').'</span></span>'. esc_html__('Content','dfd'),
								'param_name' => 'items',
								'value'		=> 'loop',
								'options'	=> array(
									esc_attr__('Loop','dfd') => 'loop',
									esc_attr__('Single item','dfd') => 'single',
								),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'radio_image_post_select',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the number of items you would like to display','dfd').'</span></span>'.esc_html__('Items to show', 'dfd'),
								'param_name' => 'single_custom_post_item',
								'value' => '',
								'post_type' => 'my-product',
								'css' => array(
									'width' => '120px',
									'height' => '120px',
									'background-repeat' => 'repeat',
									'background-size' => 'cover' 
								),
								'show_default' => false,
								'description' => esc_attr__('Select portfolio item to display', 'dfd'),
								'dependency' => array('element' => 'items','value' => array('single')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select the categories you would like to display','dfd').'</span></span>'.esc_html__('Categories','dfd'),
								'param_name' => 'post_categories',
								'value' => dfd_get_select_options_multi('my-product_category'),
								'dependency' => array('element' => 'items','value' => array('loop')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to hide the chosen categories','dfd').'</span></span>'.esc_html__('Exclude selected categories','dfd'),
								'param_name' => 'exclude_from_loop',
								'value' => 'exclude',
								'options' => array(
									'exclude' => array(
										'label' => esc_html__('Yes, please','dfd'),
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'dependency' => array('element' => 'post_categories','not_empty' => true),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the number of portfolios you would like to display','dfd').'</span></span>'. esc_html__('Items to show', 'dfd'),
								'param_name' => 'posts_to_show',
								'value' => 9,
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'dependency' => array('element' => 'items','value' => array('loop')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the space between the portfolio items','dfd').'</span></span>'.esc_html__('Items offset', 'dfd'),
								'param_name' => 'items_offset',
								'value' => 20,
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'dependency' => array('element' => 'style','value' => array('carousel','masonry','fitRows')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the horizontal alignment for the portfolio content','dfd').'</span></span>'.esc_html__('Content alignment','dfd'),
								'param_name' => 'content_alignment',
								'value' => 'text-center',
								'options' => array(
									esc_attr__('Center','dfd') => 'text-center',
									esc_attr__('Left','dfd') => 'text-left',
									esc_attr__('Right','dfd') => 'text-right'
								),
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'dependency' => array('element' => 'style','value' => array('carousel','masonry','fitRows')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dropdown',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the visibility options for the portfolio\'s content','dfd').'</span></span>'.esc_html__('Content visibility','dfd'),
								'param_name' => 'content_effect',
								'value' => array(
									esc_attr__('Show content on hover','dfd') => 'desc-hover',
									esc_attr__('Show content by default','dfd') => '',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('simple')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Layout settings', 'dfd' ),
								'param_name'       => 'layout_settings_heading',
								'group'			   => esc_attr__( 'Content', 'dfd' ),
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'number',
								'heading' => esc_html__('Number of columns', 'dfd'),
								'param_name' => 'columns',
								'value' => 3,
								'dependency' => array('element' => 'style','value' => array('masonry','fitRows','carousel')),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the autoplay for the slider','dfd').'</span></span>'. esc_html__('Auto slideshow','dfd'),
								'param_name' => 'enabled_autoslideshow',
								'value' => 'true',
								'options' => array(
									'true' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('carousel')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the speed for the slideshow','dfd').'</span></span>'. esc_html__('Slideshow speed', 'dfd'),
								'param_name' => 'carousel_slideshow_speed',
								'value' => 5000,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'enabled_autoslideshow','value' => array('true')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Content elements', 'dfd' ),
								'param_name'       => 'enabled_elements_heading',
								'group'            => esc_attr__( 'Content', 'dfd' ),
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('Sort Panel','dfd'),
								'param_name' => 'sort_panel',
								'value' => 'sort',
								'options' => array(
									'sort' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','fitRows')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('Title','dfd'),
								'param_name' => 'enabled_title',
								'value' => 'title',
								'options' => array(
									'title' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('carousel','masonry','fitRows')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('Subtitle','dfd'),
								'param_name' => 'enabled_meta',
								'value' => 'meta',
								'options' => array(
									'meta' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('carousel','masonry','fitRows')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('Excerpt','dfd'),
								'param_name' => 'enabled_excerpt',
								'value' => 'excerpt',
								'options' => array(
									'excerpt' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('carousel','masonry','fitRows')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('Read more button','dfd'),
								'param_name' => 'enabled_read_more',
								'value' => 'read_more',
								'options' => array(
									'read_more' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('carousel','masonry','fitRows')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('Share buttons','dfd'),
								'param_name' => 'enabled_share',
								'value' => 'share',
								'options' => array(
									'share' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('Comments','dfd'),
								'param_name' => 'enabled_comments',
								'value' => 'comments',
								'options' => array(
									'comments' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('carousel','masonry','fitRows')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('Likes','dfd'),
								'param_name' => 'enabled_likes',
								'value' => 'likes',
								'options' => array(
									'likes' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('carousel','masonry','fitRows')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('Animate comments and likes','dfd'),
								'param_name' => 'enabled_anim_com_like',
								'value' => 'anim_com_like',
								'options' => array(
									'anim_com_like' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('carousel','masonry','fitRows')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the sort panel horizontally','dfd').'</span></span>'. esc_html__('Sort panel alignment','dfd'),
								'param_name' => 'sort_alignment',
								'value'		=> 'text-center',
								'options'	=> array(
									esc_attr__('Center','dfd') => 'text-center',
									esc_attr__('Left','dfd') => 'text-left',
									esc_attr__('Right','dfd') => 'text-right'
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'sort_panel','value' => array('sort')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the title position','dfd').'</span></span>'. esc_html__('Heading position','dfd'),
								'param_name' => 'heading_position',
								'value'		=> '',
								'options'	=> array(
									esc_attr__('Under image','dfd') => '',
									esc_attr__('In front of the image','dfd') => 'dfd-folio-title-front',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => Array('element' => 'enabled_title', 'value' => 'title'),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose one the style for the read more ','dfd').'</span></span>'.esc_html__('Read more style','dfd'),
								'param_name' => 'read_more_style',
								'value'		=> 'simple',
								'options'	=> array(
									esc_attr__('Simple','dfd') => 'simple',
									esc_attr__('Shuffle','dfd') => 'chaffle',
									esc_attr__('Slide up','dfd') => 'slide-up',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => Array('element' => 'enabled_read_more', 'value' => 'read_more'),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose one the style for the share button','dfd').'</span></span>'.esc_html__('Share style','dfd'),
								'param_name' => 'share_style',
								'value'		=> 'animated',
								'options'	=> array(
									esc_attr__('Animated','dfd') => 'animated',
									esc_attr__('Simple','dfd') => 'simple',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'enabled_share', 'value' => 'share'),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the width for the portfolio thumbnail','dfd').'</span></span>'.esc_html__('Image width', 'dfd'),
								'param_name' => 'image_width',
								'value' => 900,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
								'dependency' => array('element' => 'style','value' => array('carousel','fitRows')),
								'group'      => esc_attr__( 'Thumbs settings', 'dfd' ),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the height for the portfolio thumbnail','dfd').'</span></span>'.esc_html__('Image height', 'dfd'),
								'param_name' => 'image_height',
								'value' => 600,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap no-top-padding',
								'dependency' => array('element' => 'style','value' => array('carousel','fitRows')),
								'group'      => esc_attr__( 'Thumbs settings', 'dfd' ),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the hover style. You can theme options styles or customize the hover','dfd').'</span></span>'.esc_html__('Hover style','dfd'),
								'param_name' => 'hover_style',
								'value'		=> '',
								'options'	=> array(
									esc_attr__('Inherit from theme options','dfd') => '',
									esc_attr__('Design your own','dfd') => 'custom',
								),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
								'dependency' => array('element' => 'style','value' => array('carousel','masonry','fitRows')),
							),
							array(
								'type' => 'dropdown',
								'param_name' => 'folio_hover_appear_effect',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to select the hover effect for the mask appearing','dfd').'</span></span>'.esc_html__('Mask appear effect','dfd'),
								'value' => array(
									esc_attr__('Fade out', 'dfd') => 'dfd-fade-out',
									esc_attr__('Fade out with offset', 'dfd') => 'dfd-fade-offset',
									esc_attr__('From left to right', 'dfd') => 'dfd-left-to-right',
									esc_attr__('From right to left', 'dfd') => 'dfd-right-to-left',
									esc_attr__('From top to bottom', 'dfd') => 'dfd-top-to-bottom',
									esc_attr__('From bottom to top', 'dfd') => 'dfd-bottom-to-top',
									esc_attr__('From left to right shift image', 'dfd') => 'dfd-left-to-right-shift',
									esc_attr__('From right to left shift image', 'dfd') => 'dfd-right-to-left-shift',
									esc_attr__('From top to bottom shift image', 'dfd') => 'dfd-top-to-bottom-shift',
									esc_attr__('From bottom to top shift image', 'dfd') => 'dfd-bottom-to-top-shift',
									esc_attr__('Following the mouse', 'dfd') => 'portfolio-hover-style-1',
									esc_attr__('Rotate content up', 'dfd') => 'dfd-rotate-content-up',
									esc_attr__('Rotate content down', 'dfd') => 'dfd-rotate-content-down',
									esc_attr__('Rotate left', 'dfd') => 'dfd-rotate-left',
									esc_attr__('Rotate right', 'dfd') => 'dfd-rotate-right',
									esc_attr__('Rotate top', 'dfd') => 'dfd-rotate-top',
									esc_attr__('Rotate bottom', 'dfd') => 'dfd-rotate-bottom',
								),
								'dependency' => array('element' => 'hover_style','value' => array('custom')),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'type' => 'number',
								'heading' => esc_html__('Mask offset size', 'dfd'),
								'param_name' => 'mask_offset_size',
								'edit_field_class' => 'vc_column crum_vc vc_col-sm-6 dfd-number-wrap',
								'dependency' => array('element' => 'folio_hover_appear_effect', 'value' => array('dfd-fade-offset')),
								'group' => esc_html__('Hover options', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify hover mask background color. The default value is inherited from Theme Options > Portfolio options > Portfolio hover options > Mask background gradient/ Mask background color','dfd').'</span></span>'. esc_html__('Hover mask background', 'dfd' ),
								'param_name'		=> 'mask_background',
								'edit_field_class'	=> 'vc_column crum_vc vc_col-sm-6',
								'dependency'		=> array('element' => 'hover_style','value' => array('custom')),
								'group'				=> esc_html__('Hover options', 'dfd'),

							),
							array(
								'param_name' => 'folio_hover_image_effect',
								'type' => 'dropdown',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the image behavior on hover','dfd').'</span></span>'.esc_html__('Image hover effect','dfd'),
								'value' => array(
									esc_attr__('Image parallax', 'dfd') => 'panr',
									esc_attr__('Grow', 'dfd') => 'dfd-image-scale',
									esc_attr__('Grow with rotation', 'dfd') => 'dfd-image-scale-rotate',
									esc_attr__('Shift left', 'dfd') => 'dfd-image-shift-left',
									esc_attr__('Shift right', 'dfd') => 'dfd-image-shift-right',
									esc_attr__('Shift top', 'dfd') => 'dfd-image-shift-top',
									esc_attr__('Shift bottom', 'dfd') => 'dfd-image-shift-bottom',
									esc_attr__('Blur', 'dfd') => 'dfd-image-blur',
									esc_attr__('Colored with grow', 'dfd') => 'grow-grayscale',
									esc_attr__('None', 'dfd') => 'dfd-not-image-effect',
								),
								'dependency' => array('element' => 'folio_hover_appear_effect','value' => array(
									'dfd-fade-out',
									'dfd-fade-offset',
									'dfd-left-to-right',
									'dfd-right-to-left',
									'dfd-top-to-bottom',
									'dfd-bottom-to-top',
									'portfolio-hover-style-1',
									'dfd-rotate-content-up',
									'dfd-rotate-content-down',
								)),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'param_name' => 'folio_hover_main_dedcoration',
								'type' => 'dropdown',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to choose the main decoration style', 'dfd') . '</span></span>' .esc_html__('Main decoration','dfd'),
								'value' => array(
									esc_attr__('None', 'dfd') => 'none',
									esc_attr__('Heading', 'dfd') => 'heading',
									esc_attr__('Plus', 'dfd') => 'plus',
									esc_attr__('Lines', 'dfd') => 'lines',
									esc_attr__('Dots', 'dfd') => 'dots',
								),
								'dependency' => array('element' => 'hover_style','value' => array('custom')),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'param_name' => 'folio_hover_title_dedcoration',
								'type' => 'dropdown',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to choose the heading decoration style', 'dfd') . '</span></span>'.esc_html__('Heading decoration', 'dfd'),
								'value' => array(
									esc_attr__('None', 'dfd') => 'title-deco-none',
									esc_attr__('Diagonal line', 'dfd') => 'diagonal-line',
									esc_attr__('Title underline', 'dfd') => 'title-underline',
									esc_attr__('Square behind heading', 'dfd') => 'square-behind-heading',
								),
								'dependency' => array('element' => 'folio_hover_main_dedcoration', 'value' => array('heading')),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'param_name' => 'folio_hover_show_title',
								'type' => 'dfd_single_checkbox', //the field type
								'heading' => esc_html__('Titles', 'dfd'),
								'value' => 'on',
								'options' => array(
									'on' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'folio_hover_main_dedcoration', 'value' => array('heading')),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'param_name' => 'folio_hover_show_subtitle',
								'type' => 'dfd_single_checkbox', //the field type
								'heading' => esc_html__('Subtitle', 'dfd'),
								'value' => 'on',
								'options' => array(
									'on' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'folio_hover_main_dedcoration', 'value' => array('heading')),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'param_name' => 'folio_hover_plus_position',
								'type' => 'dropdown',
								'heading' => esc_html__('Plus position', 'dfd'),
								'value' => array(
									esc_attr__('Middle of the project', 'dfd') => 'dfd-middle',
									esc_attr__('Top right corner', 'dfd') => 'dfd-top-right',
									esc_attr__('Top left corner', 'dfd') => 'dfd-top-left',
									esc_attr__('Bottom right corner', 'dfd') => 'dfd-bottom-right',
									esc_attr__('Bottom left corner', 'dfd') => 'dfd-bottom-left',
								),
								'dependency' => array('element' => 'folio_hover_main_dedcoration', 'value' => array('plus')),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'param_name' => 'folio_hover_plus_bg',
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to choose the background color for the Plus decoration. The default color is inherited from Theme Oprions > Styling options > Third site color', 'dfd') . '</span></span>'.esc_html__('Plus background', 'dfd'),
								'dependency' => array('element' => 'folio_hover_plus_position', 'value' => array('dfd-top-right','dfd-top-left','dfd-bottom-right','dfd-bottom-left')),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'param_name' => 'folio_hover_show_ext_link',
								'type' => 'dfd_single_checkbox', //the field type
								'heading' => esc_html__('External link', 'dfd'),
								'value' => 'on',
								'options' => array(
									'on' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'hover_style','value' => array('custom')),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'param_name' => 'folio_hover_show_quick_view',
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('Quick view', 'dfd'),
								'value' => 'on',
								'options' => array(
									'on' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'hover_style','value' => array('custom')),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'param_name' => 'folio_hover_show_lightbox',
								'type' => 'dfd_single_checkbox', //the field type
								'heading' => esc_html__('Lightbox', 'dfd'),
								'value' => 'on',
								'options' => array(
									'on' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'hover_style','value' => array('custom')),
								'group'      => esc_attr__( 'Hover options', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Title', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
								'param_name'       => 'title_t_heading',
								'group'            => esc_attr__( 'Typography', 'dfd' ),
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type'       => 'dfd_font_container_param',
								'heading'    => '',
								'param_name' => 'title_font_options',
								'settings'   => array(
									'fields' => array(
										'tag' => 'div',
										'letter_spacing',
										'font_size',
										'line_height',
										'color',
										'font_style'
									),
								),
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'        => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
								'param_name'  => 'title_google_fonts',
								'value' => '',
                                'options' => array(
                                    'yes'	=> array(
                                        'yes'	=> esc_attr__('Yes', 'dfd'),
                                        'no'	=> esc_attr__('No', 'dfd')
                                    ),
                                ),
								'group'       => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'       => 'google_fonts',
								'param_name' => 'title_custom_fonts',
								'value'      => '',
								'group'      => esc_attr__( 'Typography', 'dfd' ),
								'settings'   => array(
									'fields' => array(
										'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
										'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
									),
								),
								'dependency' => array(
									'element' => 'title_google_fonts',
									'value'   => 'yes',
								),
							),
							array(
								'type'        => 'dropdown',
								'heading'	 => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd').'</span></span>'.esc_html__('Animation', 'dfd'),
								'param_name'  => 'module_animation',
								'value'       => dfd_module_animation_styles(),
							),
							array(
								'type'        => 'textfield',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
								'param_name'  => 'el_class',
							),
						),
					)
				);
			}
		}
		
		function dfd_portfolio_module_shortcode($atts) {
			$output = $title_html = $data_atts = $article_data_atts = $css_rules = $folio_hover_style_class = $js_scripts = $anim_class = $mask_background = $mask_offset_size = '';
			$sort_panel_enabled = false;
			
			$atts = vc_map_get_attributes( 'dfd_portfolio_module', $atts );
			extract( $atts );
			
			$el_class .= ' ' . $style;
			
			$uniqid = uniqid('dfd-portfolio-module-');
			
			if(!empty($module_animation)) {
				$anim_class .= ' cr-animate-gen';
				$data_atts .= ' data-animate-item=".cover" data-animate-type="'.esc_attr($module_animation).'" ';
			}
			
			if($items == 'single' && isset($single_custom_post_item) && !empty($single_custom_post_item)) {
				$args = array(
					'post_type' => 'my-product',
					'p' => $single_custom_post_item
				);
				$columns = 1;
			} else {
				$sticky = get_option( 'sticky_posts' );

				if (!empty($post_categories)){
					$post_categories_array = explode(',', $post_categories);
					$args = array(
						'post_type' => 'my-product',
						'posts_per_page' => $posts_to_show,
						'ignore_sticky_posts' => 1,
						'post__not_in' => $sticky,
					);
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'my-product_category',
							'field' => 'slug',
							'terms' => $post_categories_array,
						)
					);
					if(isset($exclude_from_loop) && $exclude_from_loop == 'exclude') {
						$args['tax_query'][0]['operator '] = 'NOT IN';
					}
				} else {
					$args = array(
						'post_type' => 'my-product',
						'posts_per_page' => $posts_to_show,
						'ignore_sticky_posts' => 1,
						'post__not_in' => $sticky,
					);
				}
			}
			
			$enable_title = ($enabled_title == 'title') ? true : false;
			
			$enable_meta = ($enabled_meta == 'meta') ? true : false;
			
			$enable_excerpt = ($enabled_excerpt == 'excerpt') ? true : false;
			
			$read_more = ($enabled_read_more == 'read_more') ? true : false;
			
			$share = ($enabled_share == 'share') ? true : false;
			
			$comments = ($enabled_comments == 'comments') ? true : false;

			$likes = ($enabled_likes == 'likes')? true : false;

			$media_class = ($enabled_anim_com_like == 'anim_com_like') ? 'comments-like-hover' : '';
			
			$wp_query = new WP_Query($args);
			
			$style_template = locate_template($this->front_template).$style.'.php';
			
			$options = array(
				'folio_hover_appear_effect' => 'dfd-fade-out',
				'folio_hover_image_effect' => '',
				'folio_hover_main_dedcoration' => 'heading',
				'folio_hover_title_dedcoration' => 'none',
				'folio_hover_show_title' => 'on',
				'folio_hover_show_subtitle' => 'on',
				'folio_hover_show_ext_link' => 'on',
				'folio_hover_show_quick_view' => 'on',
				'folio_hover_show_lightbox' => 'on',
				'folio_hover_plus_position' => '',
			);
			
			if($hover_style == 'custom') {
				foreach($options as $k => $v) {
					$options[$k] = (isset($$k)) ? $$k : $v;
				}
			} else {
				global $dfd_ronneby;
				foreach($options as $k => $v) {
					$options[$k] = (isset($dfd_ronneby[$k])) ? $dfd_ronneby[$k] : $v;
				}
			}
			
			$non3d_hovers = array(
				'dfd-fade-out',
				'dfd-fade-offset',
				'dfd-left-to-right',
				'dfd-right-to-left',
				'dfd-top-to-bottom',
				'dfd-bottom-to-top',
				'dfd-rotate-content-up'
			);
			
			$folio_hover_style_class .= $options['folio_hover_appear_effect'];
			
			if($options['folio_hover_image_effect'] == 'panr') {
				wp_enqueue_script('dfd-tween-max');
				wp_enqueue_script('dfd-panr');
			}
			
			if(in_array($options['folio_hover_appear_effect'], $non3d_hovers)) {
				$folio_hover_style_class .= ' '.$options['folio_hover_image_effect'];
			}
			
			$output .= '<div class="dfd-module-wrapper">';
			
			if(file_exists($style_template)) {
				ob_start();
				
				include($style_template);
				
				$output .= ob_get_clean();
			}
			
			if(isset($mask_background) && !empty($mask_background)) {
				$css_rules .= '#'.esc_js($uniqid).' .project .entry-thumb .portfolio-custom-hover {background-color: '.esc_js($mask_background).';}';
			}
			if(isset($mask_offset_size) && $mask_offset_size != '') {
				$css_rules .= '#'.esc_js($uniqid).' .project.dfd-fade-offset .entry-thumb:hover .portfolio-custom-hover {left: '.esc_js($mask_offset_size).'px; right: '.esc_js($mask_offset_size).'px; top: '.esc_js($mask_offset_size).'px; bottom: '.esc_js($mask_offset_size).'px;}';
			}
			if(!empty($css_rules) || !empty($js_scripts)) {
				$output .= '<script type="text/javascript">
								(function($) {';
				
				if(!empty($css_rules)) {
					$output .= '$("head").append("<style>'.$css_rules.'</style>");';
				}
				if(!empty($js_scripts)) {
					$output .= $js_scripts;
				}
				
				$output .= '})(jQuery);
							</script>';
			}
			
			$output .= '</div>';
			
			return $output;
		}
	}
}
if(class_exists('Dfd_Portfolio_Module')) {
	$Dfd_Portfolio_Module = new Dfd_Portfolio_Module;
}