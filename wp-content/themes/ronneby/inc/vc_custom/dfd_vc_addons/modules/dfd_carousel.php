<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
Module Name: Ultimate Carousel for Visual Composer
Module URI: https://www.brainstormforce.com/demos/ultimate-carousel
*/
if(!class_exists("Dfd_Carousel_Shortcode")){
	class Dfd_Carousel_Shortcode{
		
		function __construct(){
			add_action('init', array($this, 'init_carousel_addon'));
			add_shortcode('dfd_carousel', array($this, 'dfd_carousel_shortcode'));
		}
		
		function init_carousel_addon(){
			if(function_exists('vc_map')){
				new dfd_hide_unsuport_module_frontend("dfd_carousel");
				vc_map(
					array(
						'name' => __('DFD Carousel', 'dfd'),
						'base' => 'dfd_carousel',
						'icon' => 'dfd_carousel dfd_shortcode',
						'as_parent' => array('except' => 'dfd_carousel, dfd_side_by_side_slider, dfd_side_by_side_left, dfd_side_by_side_right, dfd_side_by_side_slide, dfd_horizontal_scroll, dfd_horizontal_scroll_container, dfd_horizontal_scroll_item'),
						'content_element' => true,
						'controls' => 'full',
						'show_settings_on_create' => true,
						'category' => __('Ronneby 2.0', 'dfd'),
						'description' => 'Apply animations everywhere.',
						'params' => array(
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Carousel style', 'dfd'),
								'param_name' => 'main_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type' => 'radio_image_select',
								'heading' => esc_html__('Style', 'dfd'),
								'param_name' => 'slider_type',
								'simple_mode' => false,
								'options' => array(
									'horizontal' => array(
										'tooltip' => esc_attr__('Horizontal', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/horizontal.png'
									),
									'vertical' => array(
										'tooltip' => esc_attr__('Vertical', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/vertical.png'
									),
								),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to loop your slides', 'dfd-native') . '</span></span>' . __('Loop', 'dfd'),
								'param_name' => 'infinite_loop',
								'value' => 'on',
								'options' => array(
									'on' => array(
										'on' => esc_attr__('Yes', 'dfd'),
										'off' => esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-4',
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to set the active element in the center', 'dfd') . '</span></span>' . esc_html__('Center mode', 'dfd'),
								'param_name' => 'center_mode',
								'value' => '',
								'options' => array(
									'on' => array(
										'on' => esc_attr__('Yes', 'dfd'),
										'off' => esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-4',
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to decrease the size of side elements, so the central element will be more noticeable', 'dfd') . '</span></span>' . esc_html__('Scale center element', 'dfd'),
								'param_name' => 'center_mode_scale',
								'value' => '',
								'options' => array(
									'on' => array(
										'on' => esc_attr__('Yes', 'dfd'),
										'off' => esc_attr__('No', 'dfd'),
									),
								),
								'dependency' => array('element' => 'center_mode', 'value' => array('on')),
								'edit_field_class' => 'vc_column vc_col-sm-4',
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to enable or disable the dragging of the carousel\'s slides', 'dfd') . '</span></span>' . esc_html__('Draggable Effect', 'dfd'),
								'param_name' => 'draggable',
								'value' => 'on',
								'options' => array(
									'on' => array(
										'on' => esc_attr__('Yes', 'dfd'),
										'off' => esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-4',
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to enable or disable the carousel sliding by swiping on touch devices', 'dfd') . '</span></span>' . esc_html__('Touch Move', 'dfd'),
								'param_name' => 'touch_move',
								'value' => 'on',
								'options' => array(
									'on' => array(
										'on' => esc_attr__('Yes', 'dfd'),
										'off' => esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-4',
								'dependency' => array('element' => 'draggable', 'value' => array('on')),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option will adapt the carousel according to the content size. Option is available when you set one slide to show', 'dfd') . '</span></span>' . esc_html__('Adaptive height', 'dfd'),
								'param_name' => 'adaptive_height',
								'value' => 'on',
								'options' => array(
									'on' => array(
										'on' => esc_attr__('Yes', 'dfd'),
										'off' => esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-4',
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Extra features', 'dfd'),
								'param_name' => 'extra_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12 no-top-margin',
							),
							array(
								'type' => 'dropdown',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the appear effect for the element', 'dfd') . '</span></span>' . esc_html__('Animation', 'dfd'),
								'param_name' => 'module_animation',
								'value' => dfd_module_animation_styles(),
							),
							array(
								'type' => 'textfield',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Add the unique class name for the element which can be used for custom CSS codes', 'dfd') . '</span></span>' . esc_html__('Custom CSS Class', 'dfd'),
								'param_name' => 'el_class',
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Slideshow settings', 'dfd'),
								'param_name' => 'slides_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
								'group' => esc_attr__('Slideshow', 'dfd'),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Set the number of slides you would like to display', 'dfd') . '</span></span>' . esc_html__('Slides to show', 'dfd'),
								'param_name' => 'slides_to_show',
								'value' => '1',
								'min' => '1',
								'max' => '25',
								'step' => '1',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group' => esc_html__('Slideshow', 'dfd'),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the speed for the slideshow', 'dfd') . '</span></span>' . esc_html__('Slideshow speed', 'dfd'),
								'param_name' => 'speed',
								'value' => '300',
								'min' => '100',
								'max' => '10000',
								'step' => '100',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc dfd-number-ml-second',
								'group' => esc_html__('Slideshow', 'dfd'),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to add the space between the carousel items', 'dfd') . '</span></span>' . esc_html__('Items offset', 'dfd'),
								'param_name' => 'items_offset',
								'value' => '20',
								'min' => '0',
								'max' => '100',
								'step' => '1',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc dfd-number-wrap',
								'group' => esc_html__('Slideshow', 'dfd'),
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Autoslideshow settings', 'dfd'),
								'param_name' => 'autoslides_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group' => esc_attr__('Slideshow', 'dfd'),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to enable or disable the autoplay for the carousel', 'dfd') . '</span></span>' . esc_html__('Autoplay', 'dfd'),
								'param_name' => 'autoplay',
								'value' => 'on',
								'options' => array(
									'on' => array(
										'on' => esc_attr__('Yes', 'dfd'),
										'off' => esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_html__('Slideshow', 'dfd'),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the speed for the autoplay', 'dfd') . '</span></span>' . esc_html__('Autoplay Speed', 'dfd'),
								'param_name' => 'autoplay_speed',
								'value' => '5000',
								'min' => '100',
								'max' => '10000',
								'step' => '10',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-ml-second',
								'dependency' => array('element' => 'autoplay', 'value' => array('on')),
								'group' => esc_html__('Slideshow', 'dfd'),
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Medium desktop', 'dfd'),
								'param_name' => 'sizing_normal',
								'group' => esc_html__('Responsive', 'dfd'),
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Set the screen resolution for the medium desktops', 'dfd') . '</span></span>' . esc_html__('Screen resolution', 'dfd'),
								'param_name' => 'screen_normal_resolution',
								'value' => 1024,
								'group' => esc_html__('Responsive', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap'
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Set the number of slides to show for the medium desktops', 'dfd') . '</span></span>' . esc_html__('Number of slides', 'dfd'),
								'value' => '1',
								'param_name' => 'screen_normal_slides',
								'group' => esc_html__('Responsive', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc'
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Tablets', 'dfd'),
								'param_name' => 'sizing_tablet',
								'group' => esc_html__('Responsive', 'dfd'),
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Set the screen resolution for the tablets', 'dfd') . '</span></span>' . esc_html__('Screen resolution', 'dfd'),
								'param_name' => 'screen_tablet_resolution',
								'value' => 800,
								'group' => esc_html__('Responsive', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap'
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Set the number of slides to show for the tablets', 'dfd') . '</span></span>' . esc_html__('Number of slides', 'dfd'),
								'value' => '1',
								'param_name' => 'screen_tablet_slides',
								'group' => esc_html__('Responsive', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc'
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Mobile phones', 'dfd'),
								'param_name' => 'sizing_mobile',
								'group' => esc_html__('Responsive', 'dfd'),
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Set the screen resolution for the mobile phones', 'dfd') . '</span></span>' . esc_html__('Screen resolution', 'dfd'),
								'param_name' => 'screen_mobile_resolution',
								'value' => 480,
								'group' => esc_html__('Responsive', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap'
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Set the number of slides to show for the mobile phones', 'dfd-native') . '</span></span>' . esc_html__('Number of slides', 'dfd'),
								'value' => '1',
								'param_name' => 'screen_mobile_slides',
								'group' => esc_html__('Responsive', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc'
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Navigation arrows', 'dfd'),
								'param_name' => 'arrows_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
								'group' => esc_html__('Navigation', 'dfd'),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to enable or disable the carousel navigation', 'dfd') . '</span></span>' . esc_html__('Navigation Arrows', 'dfd'),
								'param_name' => 'arrows',
								'value' => 'on',
								'options' => array(
									'on' => array(
										'on' => esc_attr__('Yes', 'dfd'),
										'off' => esc_attr__('No', 'dfd'),
									),
								),
								'group' => esc_html__('Navigation', 'dfd'),
							),
							array(
								'type' => 'radio_image_select',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to choose the navigation arrows position', 'dfd') . '</span></span>' . esc_html__('Arrows position', 'dfd'),
								'param_name' => 'arrows_position',
								'simple_mode' => false,
								'options' => array(
									'aside_offset' => array(
										'tooltip' => esc_attr__('Aside with offset', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows_position/aside_offset.png'
									),
									'aside' => array(
										'tooltip' => esc_attr__('Aside', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows_position/aside.png'
									),
									'aside2' => array(
										'tooltip' => esc_attr__('Inside', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows_position/aside2.png'
									),
									'top_left' => array(
										'tooltip' => esc_attr__('Top left', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows_position/top_left.png'
									),
									'top_center' => array(
										'tooltip' => esc_attr__('Top center', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows_position/top_center.png'
									),
									'top_right' => array(
										'tooltip' => esc_attr__('Top right', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows_position/top_right.png'
									),
									'bottom_left' => array(
										'tooltip' => esc_attr__('Bottom left', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows_position/bottom_left.png'
									),
									'bottom_center' => array(
										'tooltip' => esc_attr__('Bottom center', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows_position/bottom_center.png'
									),
									'bottom_right' => array(
										'tooltip' => esc_attr__('Bottom right', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows_position/bottom_right.png'
									),
								),
								'dependency' => array('element' => 'arrows', 'value' => array('on')),
								'group' => esc_html__('Navigation', 'dfd'),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you add the offset for the navigation arrows to specify their placement', 'dfd') . '</span></span>' . esc_html__('Navigation vertical offset', 'dfd'),
								'param_name' => 'arrows_vertical_offset',
								'edit_field_class' => 'vc_column vc_col-sm-12 dfd-number-wrap crum_vc',
								'dependency' => array('element' => 'arrows_position', 'value' => array('aside_offset', 'aside', 'aside2')),
								'group' => esc_html__('Navigation', 'dfd'),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the arrow style. You can choose among preset styles or upload your own images for the navigation', 'dfd') . '</span></span>' . esc_html__('Arrow Style', 'dfd'),
								'param_name' => 'arrow_style',
								'value' => 'default',
								'options' => array(
									esc_attr__('Pre-built', 'dfd') => 'default',
									esc_attr__('Upload', 'dfd') => 'upload',
								),
								'edit_field_class' => 'no-top-padding vc_column vc_col-sm-12',
								'dependency' => array('element' => 'arrows', 'value' => array('on')),
								'group' => esc_html__('Navigation', 'dfd'),
							),
							array(
								'type' => 'radio_image_select',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose one of the 5 preset arrow styles', 'dfd') . '</span></span>' . esc_html__('Arrows style', 'dfd'),
								'param_name' => 'arrows_style',
								'simple_mode' => false,
								'options' => array(
									'style_1' => array(
										'tooltip' => esc_attr__('Simple arrows', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows/style_1.png'
									),
									'style_2' => array(
										'tooltip' => esc_attr__('Arrows', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows/style_2.png'
									),
									'style_3' => array(
										'tooltip' => esc_attr__('Arrows with rounded background', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows/style_3.png'
									),
									'style_4' => array(
										'tooltip' => esc_attr__('Arrows with square background', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows/style_4.png'
									),
									'style_5' => array(
										'tooltip' => esc_attr__('Simple arrows with square background', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows/style_5.png'
									),
								),
								'dependency' => array('element' => 'arrow_style', 'value' => array('default')),
								'group' => esc_html__('Navigation', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to set color fot the arrows background. The default color is inherited from Theme Options > Styling Options > Third site color', 'dfd') . '</span></span>' . esc_html__('Arrows background', 'dfd'),
								'param_name' => 'arrows_bg',
								'dependency' => array('element' => 'arrows_style', 'value' => array('style_3', 'style_4', 'style_5')),
								'edit_field_class' => 'no-top-padding vc_column vc_col-sm-6',
								'group' => esc_html__('Navigation', 'dfd'),
							),
							array(
								'type' => 'attach_image',
								'heading' => esc_html__('Left navigation arrow', 'dfd'),
								'param_name' => 'left_arrow',
								'dependency' => array('element' => 'arrow_style', 'value' => array('upload')),
								'edit_field_class' => 'no-top-padding vc_column vc_col-sm-6',
								'group' => esc_html__('Navigation', 'dfd'),
							),
							array(
								'type' => 'attach_image',
								'heading' => esc_html__('Right navigation arrow', 'dfd'),
								'param_name' => 'right_arrow',
								'dependency' => array('element' => 'arrow_style', 'value' => array('upload')),
								'edit_field_class' => 'no-top-padding vc_column vc_col-sm-6',
								'group' => esc_html__('Navigation', 'dfd'),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to enable or disable the slides counter for the carousel\'s navigation', 'dfd') . '</span></span>' . esc_html__('Slides counter', 'dfd'),
								'param_name' => 'enable_counter',
								'value' => 'on',
								'options' => array(
									'on' => array(
										'on' => esc_attr__('Yes', 'dfd'),
										'off' => esc_attr__('No', 'dfd'),
									),
								),
								'dependency' => array('element' => 'arrows', 'value' => array('on')),
								'group' => esc_html__('Navigation', 'dfd'),
								'edit_field_class' => 'no-top-padding vc_column vc_col-sm-6',
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to make arrows always visible', 'dfd') . '</span></span>' . esc_html__('Always show arrows', 'dfd'),
								'param_name' => 'arrows_always_show',
								'value' => 'on',
								'options' => array(
									'on' => array(
										'on' => esc_attr__('Yes', 'dfd'),
										'off' => esc_attr__('No', 'dfd'),
									),
								),
								'dependency' => array('element' => 'arrows', 'value' => array('on')),
								'group' => esc_html__('Navigation', 'dfd'),
								'edit_field_class' => 'no-top-padding vc_column vc_col-sm-6',
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the arrows color. The arrows styles Simple arrows and Arrows the color is inherited from Theme Options > Styling options> Third site color. The default color for the styles Arrows with rounded background and Arrows with square background is #fff. The default color for the style Simple arrows with square background is #1b1b1b', 'dfd') . '</span></span>' . esc_html__('Arrows color', 'dfd'),
								'param_name' => 'arrows_color',
								'dependency' => array('element' => 'arrows', 'value' => array('on')),
								'edit_field_class' => 'no-top-padding vc_column vc_col-sm-6',
								'group' => esc_html__('Navigation', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the arrows hover color. The arrows styles Simple arrows and Arrows the color is inherited from Theme Options > Styling options> Third site color. The default color for the styles Arrows with rounded background and Arrows with square background is #fff. The default color for the style Simple arrows with square background is #1b1b1b', 'dfd') . '</span></span>' . esc_html__('Arrows hover color', 'dfd'),
								'param_name' => 'arrows_hover_color',
								'dependency' => array('element' => 'arrows', 'value' => array('on')),
								'edit_field_class' => 'no-top-padding vc_column vc_col-sm-6',
								'group' => esc_html__('Navigation', 'dfd'),
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Navigation dots', 'dfd'),
								'param_name' => 'dots_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group' => esc_html__('Navigation', 'dfd'),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to add the pagination dots for your carousel', 'dfd') . '</span></span>' . esc_html__('Dots Pagination', 'dfd'),
								'param_name' => 'dots',
								'value' => 'on',
								'options' => array(
									'on' => array(
										'on' => esc_attr__('Yes', 'dfd'),
										'off' => esc_attr__('No', 'dfd'),
									),
								),
								'group' => esc_html__('Navigation', 'dfd'),
							),
							array(
								'type' => 'radio_image_select',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose one of the preset pagination styles', 'dfd') . '</span></span>' . esc_html__('Pagination style', 'dfd'),
								'param_name' => 'dots_style',
								'simple_mode' => false,
								'options' => array(
									'dfdrounded' => array(
										'tooltip' => esc_attr__('Rounded dot', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_1.png'
									),
									'dfdfillrounded' => array(
										'tooltip' => esc_attr__('Filled rounded', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_2.png'
									),
									'dfdemptyrounded' => array(
										'tooltip' => esc_attr__('Transparent rounded', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_3.png'
									),
									'dfdfillsquare' => array(
										'tooltip' => esc_attr__('Filled square', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_7.png'
									),
									'dfdroundedold' => array(
										'tooltip' => esc_attr__('Rounded', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_10.png'
									),
									'dfdsquare' => array(
										'tooltip' => esc_attr__('Square', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_6.png'
									),
									'dfdemptysquare' => array(
										'tooltip' => esc_attr__('Transparent square', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_8.png'
									),
									'dfdline' => array(
										'tooltip' => esc_attr__('Line', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_4.png'
									),
									'dfdlineold' => array(
										'tooltip' => esc_attr__('Line hovered', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_9.png'
									),
									'dfdadvancesquare' => array(
										'tooltip' => esc_attr__('Advanced square', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_5.png'
									),
									'dfdemptyroundedold' => array(
										'tooltip' => esc_attr__('Transparent rounded small', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_11.png'
									),
									'dfdfillsquareold' => array(
										'tooltip' => esc_attr__('Filled square small', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_12.png'
									),
								),
								'dependency' => array('element' => 'dots', 'value' => array('on')),
								'group' => esc_html__('Navigation', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose color for the active dot. The default color is inherited from Theme Options > Styling Options > Third site color', 'dfd') . '</span></span>' . esc_html__('Active dot color', 'dfd'),
								'param_name' => 'dots_color',
								'dependency' => array('element' => 'dots', 'value' => array('on')),
								'group' => esc_html__('Navigation', 'dfd'),
							),
						),
						'js_view' => 'VcColumnView'
					)
				); // vc_map
				if(is_rtl() && function_exists('vc_add_parap')) {
					vc_add_param(array(
						'type' => 'dfd_single_checkbox',
						'heading' => esc_html__('RTL Mode', 'dfd'),
						'param_name' => 'rtl',
						'value' => '',
						'options' => array(
							'on' => array(
								'on' => esc_attr__('Yes','dfd'),
								'off' => esc_attr__('No','dfd'),
							),
						),
						'dependency' => array('element' => 'slider_type', 'value' => array('horizontal')),
						'edit_field_class' => 'vc_column vc_col-sm-4',
					));
				}
			}
		}
		
		function dfd_carousel_shortcode($atts, $content) {
			if(dfd_show_unsuport_nested_module_frontend("DFD Carousel")) return false;

			$disabled_tags = array( 'vc_tab', 'vc_accordion_tab', 'info_list_item', 'ult_hotspot_items', 'info_circle_item', 'ultimate_icon_list_item', 'ult_ihover_item', 'dfd_service_item' );
			
			$slider_type = $el_class = $module_animation = $arrows_style = $dots_style = $animation_data = $infinite_loop = $center_mode = $draggable = $touch_move = '';
			$rtl = $slides_to_show = $slides_to_scroll = $speed = $autoplay = $autoplay_speed = $screen_normal_resolution = $screen_normal_slides = '';
			$screen_tablet_resolution = $screen_tablet_slides = $screen_mobile_resolution = $screen_mobile_slides = $arrows = $arrows_position = $arrow_style = '';
			$dots_color = $enable_counter = $arrows_always_show = $dots = $arrows_vertical_offset = $settings = $left_arrow_html = $right_arrow_html = $counter_html = '';
			$css_rules = $arrows_hover_color = $center_mode_scale = $arrows_color = '';
			
			$atts = vc_map_get_attributes( 'dfd_carousel', $atts );
			extract( $atts );
			
			$uniqid = uniqid('dfd-carousel-');
			
			$settings .= 'arrows: false,';
			$settings .= 'dotsClass: \'dfd-slick-dots\',';
			$settings .= 'slidesToScroll: 1,';
			
			if($autoplay == 'on') {
				$settings .= 'autoplay: true,';
				if($autoplay != '') {
					$settings .= 'autoplaySpeed: '.esc_js($autoplay_speed).',';
				}
			}
			
			if($slider_type != '') {
				$el_class .= ' dfd-carousel-' . $slider_type;
			}
			
			if($arrows_position != '') {
				$el_class .= ' dfd-arrows_' . $arrows_position;
			}
			
			if($arrows_always_show == 'on') {
				$el_class .= ' dfd-keep-arrows';
			}
			
			if($dots_style != '') {
				$el_class .= ' ' . $dots_style;
			}
			
			if($arrow_style == 'default') {
				$el_class .= ' dfd-arrows-' . $arrows_style . ' dfd-arrows-enabled';
				$left_arrow_html .= '<i class="dfd-added-font-icon-left-open2"></i>';
				$right_arrow_html .= '<i class="dfd-added-font-icon-right-open2"></i>';
			} elseif($arrow_style == 'upload' && isset($left_arrow) && !empty($left_arrow) && isset($right_arrow) && !empty($right_arrow)) {
				$left_arrow_src = wp_get_attachment_image_src($left_arrow, 'full');
				$right_arrow_src = wp_get_attachment_image_src($right_arrow, 'full');
				if(isset($left_arrow_src[0]) && !empty($left_arrow_src[0]))
					$left_arrow_html .= '<img src="'.esc_url($left_arrow_src[0]).'" alt="'.esc_attr__('Left arrow','dfd').'" />';
				if(isset($right_arrow_src[0]) && !empty($right_arrow_src[0]))
					$right_arrow_html .= '<img src="'.esc_url($right_arrow_src[0]).'" alt="'.esc_attr__('Right arrow','dfd').'" />';
				$el_class .= ' dfd-arrows-enabled dfd-arrows-uploaded';
			}
			
			if($module_animation != '') {
				$el_class .= ' cr-animate-gen';
				$animation_data .= 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			if($slider_type == 'vertical') {
				$settings .= 'vertical: true,';
			}
			
			if($dots == 'on' && $arrows_position != 'bottom_center') {
                $settings .= 'dots: true,';
                $settings .=	'customPaging: function(slider, i) {
									return \'<span data-role="none" role="button" aria-required="false" tabindex="0"></span>\';
								},';
				$el_class .= ' dfd-dots-enabled';
			}else{
                $settings .= 'dots: false,';
			}
			
			if($infinite_loop == 'on') {
                $settings .= 'infinite: true,';
			}else{
				$settings .= 'infinite: false,';
			}
			
			if($center_mode == 'on') {
                $settings .= 'centerMode: true,';
				if($center_mode_scale == 'on') {
					$el_class .= ' dfd-center-mode-scale';
				}
			}
			
			if($slides_to_show != '') {
                $settings .= 'slidesToShow: '.esc_js($slides_to_show).',';
			}
			
			if($speed != '') {
                $settings .= 'speed: '.esc_js($speed).',';
			}
			
			if($draggable == 'on') {
				$settings .= 'swipe: true,';
				$settings .= 'draggable: true,';
			} else {
				$settings .= 'swipe: false,';
				$settings .= 'draggable: false,';

				if($touch_move == 'on') {
					$settings .= 'touchMove: true,';
				}
			}

			if($adaptive_height == 'on') {
				$settings .= 'adaptiveHeight: true,';
			}

			if($rtl == 'on') {
				$settings .= 'rtl: true,';
			}
			
			if($screen_normal_resolution == '') {
				$screen_normal_resolution == 1024;
			}
			
			if($screen_tablet_resolution == '') {
				$screen_tablet_resolution == 800;
			}
			
			if($screen_mobile_resolution == '') {
				$screen_mobile_resolution == 480;
			}
			
			if($screen_normal_slides != '' || $screen_tablet_slides != '' || $screen_mobile_slides != '') {
				$settings .= 'responsive: [';
				if($screen_normal_slides != '') {
					$settings .= '
							{
								breakpoint: '.esc_js($screen_normal_resolution).',
								settings: {
									slidesToShow: '.esc_js($screen_normal_slides).',
									slidesToScroll: 1,
								}
							},';
				}
				if($screen_tablet_slides != '') {
					$settings .= '
							{
								breakpoint: '.esc_js($screen_tablet_resolution).',
								settings: {
									slidesToShow: '.esc_js($screen_tablet_slides).',
									slidesToScroll: 1,
								}
							},';
				}
				if($screen_mobile_slides != '') {
					$settings .= '
							{
								breakpoint: '.esc_js($screen_mobile_resolution).',
								settings: {
									slidesToShow: '.esc_js($screen_mobile_slides).',
									slidesToScroll: 1,
								}
							},';
				}
				$settings .= ']';
			}
			
			if($enable_counter == 'on') {
				$counter_html .= '<span class="count"></span>';
			}
			
			if($arrows_bg != '') {
				$css_rules .= '#'.esc_js($uniqid).' .dfd-arrows-style_3 .dfd-slider-control:after, #'.esc_js($uniqid).' .dfd-arrows-style_4 .dfd-slider-control:after, #'.esc_js($uniqid).' .dfd-arrows-style_5 .dfd-slider-control {background: '.esc_js($arrows_bg).'}';
			}
			if($dots_color != '') {
				$css_rules .=	'#'.esc_js($uniqid).' .dfdrounded ul.dfd-slick-dots li.slick-active span:before, #'.esc_js($uniqid).' .dfdsquare ul.dfd-slick-dots li.slick-active span:before {background: '.esc_js($dots_color).'}'
								.'#'.esc_js($uniqid).' .dfdfillrounded ul.dfd-slick-dots li.slick-active span, #'.esc_js($uniqid).' .dfdfillsquare ul.dfd-slick-dots li.slick-active span {background: '.esc_js($dots_color).';border-color: '.esc_js($dots_color).';}'
								.'#'.esc_js($uniqid).' .dfdemptyrounded ul.dfd-slick-dots li.slick-active span, #'.esc_js($uniqid).' .dfdemptysquare ul.dfd-slick-dots li.slick-active span {border-color: '.esc_js($dots_color).';}'
								.'#'.esc_js($uniqid).' .dfdline ul.dfd-slick-dots li.slick-active span:before {border-color: '.esc_js($dots_color).';}'
								.'#'.esc_js($uniqid).' .dfdadvancesquare ul.dfd-slick-dots li.slick-active span, #'.esc_js($uniqid).' .dfdfillsquareold .dfd-slick-dots li.slick-active span {background: '.esc_js($dots_color).';}'
								.'#'.esc_js($uniqid).' .dfdadvancesquare ul.dfd-slick-dots li.slick-active span:before {border-bottom-color: '.esc_js($dots_color).';}'
								.'#'.esc_js($uniqid).' .dfdemptyroundedold .dfd-slick-dots li.slick-active span {-webkit-box-shadow: 0 0 0 2px '.esc_js($dots_color).'; box-shadow: 0 0 0 2px '.esc_js($dots_color).';}'
								.'#'.esc_js($uniqid).' .dfdfillsquareold .dfd-slick-dots li.slick-active span {-webkit-box-shadow: 0 0 0 1px '.esc_js($dots_color).'; box-shadow: 0 0 0 1px '.esc_js($dots_color).';}';
			}
			if($items_offset != '') {
				$css_rules .= '#'.esc_js($uniqid).' > .dfd-carousel-module-wrapper > .dfd-carousel > .slick-list > .slick-track > .dfd-item-wrap > .cover {padding: '.esc_js($items_offset/2).'px;}'
							. '#'.esc_js($uniqid).' {margin: -'.esc_attr($items_offset/2).'px;}';
			}
			if(isset($arrows_vertical_offset) && $arrows_vertical_offset != '') {
				$css_rules .= '#'.esc_js($uniqid).' .dfd-arrows-enabled .dfd-slider-control {margin-top: '.esc_js($arrows_vertical_offset).'px;}';
			}
			if(isset($arrows_color) && !empty($arrows_color)) {
				$css_rules .= '#'.esc_js($uniqid).' .dfd-slider-control i, #'.esc_js($uniqid).' .dfd-slider-control .count, #'.esc_js($uniqid).' .dfd-arrows-style_1 .dfd-slider-control:after {color: '.esc_js($arrows_color).';}';
				$css_rules .= '#'.esc_js($uniqid).' .dfd-arrows-style_1 .dfd-slider-control:after, #'.esc_js($uniqid).' .dfd-arrows-style_5 .dfd-slider-control:after {background: '.esc_js($arrows_color).';}';
			}
			if(isset($arrows_hover_color) && !empty($arrows_hover_color)) {
				$css_rules .= '#'.esc_js($uniqid).' .dfd-slider-control:hover i, #'.esc_js($uniqid).' .dfd-slider-control:hover .count, #'.esc_js($uniqid).' .dfd-arrows-style_1 .dfd-slider-control:hover:after {color: '.esc_js($arrows_hover_color).';}';
				$css_rules .= '#'.esc_js($uniqid).' .dfd-arrows-style_1 .dfd-slider-control:hover:after, #'.esc_js($uniqid).' .dfd-arrows-style_5 .dfd-slider-control:hover:after {background: '.esc_js($arrows_hover_color).';}';
			}
			
			ob_start();
			
			echo '<div id="'.esc_attr($uniqid).'" class="dfd-carousel-wrapper">';
				echo '<div class="dfd-carousel-module-wrapper '.esc_attr($el_class).'" '.$animation_data.'>';
					echo '<div class="dfd-carousel">';
						if(method_exists('Dfd_Wrap_Shortcode','dfd_override_shortcodes'))
							Dfd_Wrap_Shortcode::dfd_override_shortcodes($disabled_tags);
						echo do_shortcode($content);
						if(method_exists('Dfd_Wrap_Shortcode','dfd_restore_shortcodes'))
							Dfd_Wrap_Shortcode::dfd_restore_shortcodes();
					echo '</div>';
					if($arrows == 'on') {
						echo '<a href="#" class="dfd-slider-control prev" title="'.esc_attr__('Previous slide','dfd').'">'.$counter_html.$left_arrow_html.'</a>';
						echo '<a href="#" class="dfd-slider-control next" title="'.esc_attr__('Next slide','dfd').'">'.$counter_html.$right_arrow_html.'</a>';
					}
				echo '</div>';
				?>
				<script type="text/javascript">
					(function($) {
						"use strict";
						var $carousel = $('#<?php echo esc_js($uniqid); ?>').find('.dfd-carousel');
						$(document).ready(function() {
							var $initialized = ($('body').hasClass('page-template-tmp-side-by-side')) ? $carousel.not('.slick-initialized') : $carousel;
							<?php if($arrows == 'on') {
								if($enable_counter == 'on') :  ?>
									var total_slides;
									$carousel.on('init reInit afterChange', function (event, slick, currentSlide) {
										var prev_slide_index, next_slide_index, current;
										var $prev_counter = $carousel.siblings('.dfd-slider-control.prev').find('.count');
										var $next_counter = $carousel.siblings('.dfd-slider-control.next').find('.count');
										total_slides = slick.slideCount;
										current = (currentSlide ? currentSlide : 0) + 1;
										prev_slide_index = (current - 1 < 1) ? total_slides : current - 1;
										next_slide_index = (current + 1 > total_slides) ? 1 : current + 1;
										$prev_counter.text(prev_slide_index + '/' + total_slides);
										$next_counter.text(next_slide_index + '/'+ total_slides);
									});
								<?php endif;
							} ?>
							$carousel.siblings('.dfd-slider-control.prev').click(function(e) {
								e.preventDefault();
								$carousel.eq(0).slick('slickPrev');
							});
							$carousel.siblings('.dfd-slider-control.next').click(function(e) {
								e.preventDefault();
								$carousel.eq(0).slick('slickNext');
							});
							$initialized.slick({<?php echo $settings; ?>});
							<?php if($css_rules != '')
								echo '$("head").append("<style>' . $css_rules . '</style>")';
							?>
						});
					})(jQuery);
				</script>
            <?php
			echo '</div>';
			return ob_get_clean();
		}
	}
	new Dfd_Carousel_Shortcode;
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_dfd_carousel extends WPBakeryShortCodesContainer {
		}
	}
}