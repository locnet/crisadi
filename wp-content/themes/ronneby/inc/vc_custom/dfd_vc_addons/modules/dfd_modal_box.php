<?php
if ( !defined( 'ABSPATH' )) { exit; }
/*
* Add-on Name: DFD Modal Box
*/
if( !class_exists('Dfd_Modal_Box')) {
	
	class Dfd_Modal_Box {
		
		function __construct() {
			add_action('init', array(&$this, 'modal_box_init'));
			add_shortcode('dfd_modal_box', array(&$this, 'modal_box_form'));
		}
		
		function modal_box_init () {
			if ( function_exists('vc_map') ) {
                new dfd_hide_unsuport_module_frontend ("dfd_modal_box");
				vc_map (
					array(
						'name' => esc_html__('Modal Box', 'dfd'),
						'base' => 'dfd_modal_box',
						'icon' => 'dfd_modal_box dfd_shortcode',
						'class' => 'dfd_modal_box',
						'category' => esc_html__('Ronneby 2.0', 'dfd'),
						'content_element' => true,
						'controls' => 'full',
						'show_settings_on_create' => true,
						"js_view" => "VcColumnView",
						'as_parent' => array('except' => 'dfd_modal_box'),
						'params' => array(
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Delay: this option allows to set the delay for the modal box displaying.On scroll: this option allows you to show the modal box on scroll', 'dfd') . '</span></span>' . esc_html__('Display options', 'dfd'),
								'param_name' => 'display_options',
								'value' => 'set_timeout',
								'options' => array(
									esc_html__('Delay') => 'set_timeout',
									esc_html__('On scroll') => 'show_scroll',
									esc_html__('On click') => 'on_click',
								),
								'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc'
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the delay timeout for the modal box', 'dfd') . '</span></span>' . esc_html__('Timeout', 'dfd'),
								'param_name' => 'time_output',
								'value' => 3000,
								'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc dfd-number-ml-second',
								'dependency' => array('element' => 'display_options', 'value' => 'set_timeout'),
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Extra features', 'dfd'),
								'param_name' => 'extra_features_elements_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dropdown',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the appear effect for the overlay', 'dfd') . '</span></span>' . esc_html__('Animation', 'dfd'),
								'param_name' => 'module_animation',
								'value' => dfd_module_animation_styles(),
							),
							array(
								'type' => 'textfield',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Add the unique class name for the element which can be used for custom CSS codes', 'dfd') . '</span></span>' . esc_html__('Custom CSS Class', 'dfd'),
								'param_name' => 'el_class',
							),
//                            array(
//                                'type' => 'dfd_video_link_param',
//                                'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd') . '</span></span>' . esc_html__('Tutorials', 'dfd'),
//                                'param_name' => 'tutorials',
//                                'doc_link' => '//nativewptheme.net/support/visual-composer/modal-box',
//                                'video_link' => 'https://youtu.be/i5yXephy3gE',
//                            ),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose background for the overlay. The default color is #000', 'dfd') . '</span></span>' . esc_html__('Overlay background', 'dfd'),
								'param_name' => 'overlay_bg',
								'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc',
								'group' => esc_html__('Style', 'dfd')
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Modal box settings', 'dfd'),
								'param_name' => 'modal_settings',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group' => esc_html__('Style', 'dfd')
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the width of the modal box according to the width of the container', 'dfd') . '</span></span>' . esc_html__('Modal Box Size', 'dfd'),
								'param_name' => 'modal_box_width',
								'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc dfd-number-wrap',
								'group' => esc_html__('Style', 'dfd')
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the top/bottom paddings for the modal box. The default value is 30px', 'dfd') . '</span></span>' . esc_html__('Top/bottom padding', 'dfd'),
								'param_name' => 'modal_tb_padding',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
								'group' => esc_html__('Style', 'dfd')
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the left/right paddings for the modal box. The default value is 30px', 'dfd') . '</span></span>' . esc_html__('Left/right padding', 'dfd'),
								'param_name' => 'modal_lr_padding',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
								'group' => esc_html__('Style', 'dfd')
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose background style for the content', 'dfd') . '</span></span>' . esc_html__('Background', 'dfd'),
								'param_name' => 'content_bg',
								'value' => 'color-background',
								'options' => array(
									esc_html__('Color') => 'color-background',
									esc_html__('Image') => 'image-background',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group' => esc_html__('Style', 'dfd')
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('If you choose Dark background the text colors will be changed to make it more visible', 'dfd') . '</span></span>' . esc_html__('Dark background', 'dfd'),
								'param_name' => 'dark_bg',
								'options' => array(
									'bg' => array(
										'yes' => esc_attr__('Yes', 'dfd'),
										'no' => esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group' => esc_html__('Style', 'dfd')
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose background color for the content', 'dfd') . '</span></span>' . esc_html__('Color background', 'dfd'),
								'param_name' => 'color_background',
								'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc',
								'dependency' => array('element' => 'content_bg', 'value' => array('color-background')),
								'group' => esc_html__('Style', 'dfd')
							),
							array(
								'type' => 'attach_image',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose background image for the content', 'dfd') . '</span></span>' . esc_html__('Image background', 'dfd'),
								'param_name' => 'image_background',
								'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc',
								'dependency' => array('element' => 'content_bg', 'value' => array('image-background')),
								'group' => esc_html__('Style', 'dfd')
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the style for the modal box border', 'dfd') . '</span></span>' . esc_html__('Modal box border', 'dfd'),
								'param_name' => 'modal_border',
								'value' => '',
								'options' => array(
									esc_html__('None', 'dfd') => '',
									esc_html__('Solid', 'dfd') => 'solid',
									esc_html__('Dashed', 'dfd') => 'dashed',
									esc_html__('Dotted', 'dfd') => 'dotted',
									esc_html__('Inset', 'dfd') => 'inset',
									esc_html__('Outset', 'dfd') => 'outset',
								),
								'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc no-border-bottom',
								'group' => esc_html__('Style', 'dfd')
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the border width', 'dfd') . '</span></span>' . esc_html__('Border width', 'dfd'),
								'param_name' => 'modal_border_width',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap no-border-bottom',
								'dependency' => array('element' => 'modal_border', 'not_empty' => true),
								'group' => esc_html__('Style', 'dfd')
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the border color', 'dfd') . '</span></span>' . esc_html__('Border color', 'dfd'),
								'param_name' => 'modal_border_color',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'modal_border', 'not_empty' => true),
								'group' => esc_html__('Style', 'dfd')
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__('Button text', 'dfd'),
								'param_name' => 'button_text',
								'value' => esc_html__('Button', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
								'dependency' => array('element' => 'display_options', 'value' => 'on_click'),
								'group' => esc_html__('Button settings', 'dfd')
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the horizontal alignment for the button', 'dfd') . '</span></span>' . esc_html__('Button alignment', 'dfd'),
								'param_name' => 'button_alignment',
								'value' => 'button-center',
								'options' => array(
									esc_html__('Center', 'dfd') => 'button-center',
									esc_html__('Left', 'dfd') => 'button-left',
									esc_html__('Right', 'dfd') => 'button-right',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 no-top-padding no-border-bottom',
								'dependency' => array('element' => 'display_options', 'value' => 'on_click'),
								'group' => esc_html__('Button settings', 'dfd')
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading'	 => '<span class="dfd-vc-toolip ещщдешз-ищеещь"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the size for the button. The full width allows you to have full width button according to the container','dfd').'</span></span>'. esc_html__('Button size', 'dfd'),
								'param_name' => 'button_size',
								'value' => '',
								'options' => array(
									esc_html__('Button', 'dfd') => '',
									esc_html__('Full width', 'dfd') => 'button_full_width',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 no-top-padding no-border-bottom',
								'dependency' => array('element' => 'display_options', 'value' => 'on_click'),
								'group' => esc_html__('Button settings', 'dfd')
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Button paddings', 'dfd'),
								'param_name' => 'button_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'dependency' => array('element' => 'display_options', 'value' => 'on_click'),
								'group' => esc_html__('Button settings', 'dfd')
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the left padding for the button. Default value is inherited from Theme Options > General options > Default button options > Default button left padding', 'dfd') . '</span></span>' . esc_html__('Left padding', 'dfd'),
								'param_name' => 'padding_left',
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom',
								'dependency' => array('element' => 'display_options', 'value' => 'on_click'),
								'group' => esc_html__('Button settings', 'dfd')
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the right padding for the button. Default value is inherited from Theme Options > General options > Default button options > Default button right padding', 'dfd') . '</span></span>' . esc_html__('Right padding', 'dfd'),
								'param_name' => 'padding_right',
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom',
								'dependency' => array('element' => 'display_options', 'value' => 'on_click'),
								'group' => esc_html__('Button settings', 'dfd')
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Color settings', 'dfd'),
								'param_name' => 'color_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'dependency' => array('element' => 'display_options', 'value' => 'on_click'),
								'group' => esc_html__('Button settings', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the text color for the button. Default color is inherited from Theme Options > General options > Default button options > Default Button Typography', 'dfd') . '</span></span>' . esc_html__('Text color', 'dfd'),
								'param_name' => 'text_color',
								'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
								'dependency' => array('element' => 'display_options', 'value' => 'on_click'),
								'group' => esc_html__('Button settings', 'dfd')
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the text hover color for the button. Default color is inherited from Theme Options > General options > Default button options > Default button hover text color', 'dfd') . '</span></span>' . esc_html__('Hover text color', 'dfd'),
								'param_name' => 'text_hover_color',
								'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
								'dependency' => array('element' => 'display_options', 'value' => 'on_click'),
								'group' => esc_html__('Button settings', 'dfd')
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Background settings', 'dfd'),
								'param_name' => 'background_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'dependency' => array('element' => 'display_options', 'value' => 'on_click'),
								'group' => esc_html__('Button settings', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'background',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the background color for the button. Default color is inherited from Theme Options > General options > Default button options > Default button background color', 'dfd') . '</span></span>' . esc_html__('Background color', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom no-bottom-padding',
								'dependency' => array('element' => 'display_options', 'value' => 'on_click'),
								'group' => esc_html__('Button settings', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'hover_background',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the background hover color for the button. Default color is inherited from Theme Options > General options > Default button options > Default button hover background color', 'dfd') . '</span></span>' . esc_html__('Hover Background', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom no-bottom-padding',
								'dependency' => array('element' => 'display_options', 'value' => 'on_click'),
								'group' => esc_html__('Button settings', 'dfd'),
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Border settings', 'dfd'),
								'param_name' => 'border_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'dependency' => array('element' => 'display_options', 'value' => 'on_click'),
								'group' => esc_html__('Button settings', 'dfd')
							),
							array(
								'type' => 'dfd_param_border',
								'heading' => esc_html__('Idle Border', 'dfd'),
								'param_name' => 'border',
								'simple' => false,
								'enable_radius' => true,
								'edit_field_class' => 'dfd-vc-border-param-styles vc_column vc_col-sm-12 no-border-bottom no-bottom-padding',
								'value' => 'border_style:default',
								'dependency' => array('element' => 'display_options', 'value' => 'on_click'),
								'group' => esc_html__('Button settings', 'dfd')
							),
							array(
								'type' => 'dfd_param_border',
								'heading' => esc_html__('Border on hover', 'dfd'),
								'param_name' => 'hover_border',
								'simple' => false,
								'enable_radius' => true,
								'value' => 'border_style:default',
								'edit_field_class' => 'dfd-vc-border-param-styles vc_column vc_col-sm-12 no-border-bottom no-bottom-padding',
								'dependency' => array('element' => 'display_options', 'value' => 'on_click'),
								'group' => esc_html__('Button settings', 'dfd')
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Box shadow settings', 'dfd'),
								'param_name' => 'shadow_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'dependency' => array('element' => 'display_options', 'value' => 'on_click'),
								'group' => esc_html__('Button settings', 'dfd')
							),
							array(
								'type' => 'dfd_box_shadow_param',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to enable or disable the shadow for the button', 'dfd') . '</span></span>' . esc_html__('Box Shadow', 'dfd'),
								'param_name' => 'box_shadow',
								'dependency' => array('element' => 'display_options', 'value' => 'on_click'),
								'group' => esc_html__('Button settings', 'dfd')
							),
							array(
								'type' => 'dfd_box_shadow_param',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to enable or disable the shadow for the button on hover', 'dfd') . '</span></span>' . esc_html__('Box Shadow on Hover', 'dfd'),
								'param_name' => 'hover_box_shadow',
								'dependency' => array('element' => 'display_options', 'value' => 'on_click'),
								'group' => esc_html__('Button settings', 'dfd')
							),
							array(
								'type' => 'dropdown',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the appear effect for the button', 'dfd') . '</span></span>' . esc_html__('Button animation', 'dfd'),
								'param_name' => 'button_animation',
								'value' => dfd_module_animation_styles(),
								'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc no-border-bottom',
								'dependency' => array('element' => 'display_options', 'value' => 'on_click'),
								'group' => esc_html__('Button settings', 'dfd')
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Typography settings', 'dfd'),
								'param_name' => 'typography_heading',
								'group' => esc_html__('Typography', 'dfd'),
								'dependency' => array('element' => 'button_text', 'not_empty' => true),
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dfd_font_container_param',
								'param_name' => 'button_font_options',
								'settings' => array(
									'fields' => array(
										'font_size',
										'letter_spacing',
										'line_height',
										'font_style',
									),
								),
								'dependency' => array('element' => 'button_text', 'not_empty' => true),
								'group' => esc_html__('Typography', 'dfd'),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to use custom Google font', 'dfd') . '</span></span>' . esc_html__('Custom font family', 'dfd'),
								'param_name' => 'button_google_fonts',
								'options' => array(
									'yes' => array(
										'yes' => esc_attr__('Yes', 'dfd'),
										'no' => esc_attr__('No', 'dfd'),
									),
								),
								'dependency' => array('element' => 'button_text', 'not_empty' => true),
								'group' => esc_html__('Typography', 'dfd'),
							),
							array(
								'type' => 'google_fonts',
								'param_name' => 'button_custom_fonts',
								'settings' => array(
									'fields' => array(
										'font_family_description' => esc_html__('Select font family.', 'dfd'),
										'font_style_description' => esc_html__('Select font style.', 'dfd'),
									),
								),
								'dependency' => array('element' => 'button_google_fonts', 'value' => 'yes'),
								'edit_field_class' => 'no-top-margin vc_column vc_col-sm-12',
								'group' => esc_html__('Typography', 'dfd'),
							),
						)
					)
				);
			}
		}
		
		function modal_box_form($atts, $content = null) {
            $icon_type = $icon_image_id = $modal_box_title = $modal_box_content = $el_class = $modal_box_size = $modal_box_width = $button_size = '';
            $overlay_bg = $overlay_opacity = $header_bg = $content_bg = $color_background = $image_background = $modal_border = $modal_radius =  $modal_border_width = $modal_border_color = '';
            $title_font_options = $use_google_fonts = $custom_fonts = $content_font_options = $content_google_fonts = $content_custom_fonts = '';
            $output = $title_html = $img_src = $link_css = $module_animation = $animation_data = $dark_bg = '';
            $modal_desc = $modal_image = $modal_img_src = $time_output = $display_options = $img_src = $data_img = $modal_tb_padding = $modal_lr_padding = '';
            $button_text = $button_alignment = $padding_left = $padding_right = $text_color = $text_hover_color = $background = $hover_background = '';
            $border = $hover_border = $box_shadow = $hover_box_shadow = $button_font_options = $button_google_fonts = $button_custom_fonts = $button_animation = $button_text_html = $button_style = $animation_data_button = '';
            $unique_class = $button_border_width = $button_border = $button_border_color = $button_border_width_hover = $button_border_hover = $button_border_color_hover = '';

            $atts = vc_map_get_attributes('dfd_modal_box', $atts);
            extract($atts);

            $output_uid = uniqid('dfd-modal-display').'-'.rand(1,9999);
            $uniqid_box = uniqid('dfd-modal-box').'-'.rand(1,9999);
            $uniqid_btn = uniqid('dfd-modal-btn').'-'.rand(1,9999);

            if (!( $module_animation == '' )) {
                $el_class .= ' cr-animate-gen ';
                $animation_data = 'data-animate-item="'.esc_attr($uniqid_box).'" data-animate-type = "' . esc_attr($module_animation) . '" ';
            }

            /******************
             * Size Modal Box
            ******************/
            if (isset($modal_box_width) && ! empty($modal_box_width)) {
                $link_css .= '#'.esc_js($uniqid_box).' .dfd-modal-box-cover .dfd-modal-box-wrap  {width: '.esc_js($modal_box_width).'px; }';
            }

            if(function_exists('wpb_js_remove_wpautop')) {
                $shortcode = wpb_js_remove_wpautop($content, true);
            } else {
                $shortcode = do_shortcode($content);
            }
            if(isset($modal_tb_padding) && $modal_tb_padding != '') {
                $link_css .= '#'.esc_js($uniqid_box).' .dfd-modal-box-cover .dfd-modal-box-wrap .dfd-modal-box-shortcode {padding-top: '.esc_js($modal_tb_padding).'px; padding-bottom: '.esc_js($modal_tb_padding).'px; }';
            }
            if(isset($modal_lr_padding) && $modal_lr_padding != '') {
                $link_css .= '#'.esc_js($uniqid_box).' .dfd-modal-box-cover .dfd-modal-box-wrap .dfd-modal-box-shortcode {padding-left: '.esc_js($modal_lr_padding).'px; padding-right: '.esc_js($modal_lr_padding).'px; }';
            }
            if(isset($overlay_bg) && $overlay_bg !== '') {
                $link_css .= '#'.esc_js($uniqid_box).'.dfd-modal-box-overlay {background: '.esc_js($overlay_bg).'; }';
            }
            if(isset($dark_bg) && !empty($dark_bg)){
                $el_class .= ' dfd-background-dark';
            }
            if(isset($content_bg) && $content_bg == 'color-background' && isset($color_background) && !empty($color_background)){
                $link_css .= '#'.esc_js($uniqid_box).' .dfd-modal-box-cover .dfd-modal-box-wrap .dfd-modal-box-shortcode {background: '.esc_js($color_background).'; }';
            }
            if(isset($content_bg) && $content_bg == 'image-background' && isset($image_background) && !empty($image_background)){
                $img_src = wp_get_attachment_image_src($image_background, 'full');
                if(!$img_url) {
                    $img_url = $img_src[0];
                }
                $data_img = 'with-image';
                $link_css .= '#'.esc_js($uniqid_box).' .dfd-modal-box-cover .dfd-modal-box-wrap .dfd-modal-box-shortcode {background-image: url('.esc_js($img_url).'); }';
            }
            if(isset($modal_border) && !empty($modal_border) || isset($modal_border_width) && !empty($modal_border_width) || isset($modal_border_color) && !empty($modal_border_color)){
                $link_css .= '#'.esc_js($uniqid_box).' .dfd-modal-box-cover .dfd-modal-box-wrap {border-style: '.esc_js($modal_border).'; border-width: '.esc_js($modal_border_width).'px; border-color: '.esc_js($modal_border_color).';}';
                $link_css .= '#'.esc_js($uniqid_box).' .dfd-modal-box-cover .dfd-modal-box-wrap .dfd-icon-block {top: -'.esc_js($modal_border_width).'px; padding-left: '.(esc_js($modal_border_width) + 20).'px;}';
            }
            if(!($button_animation == '')) {
                $animation_data_button = ' data-animate="1" data-animate-type = "' . esc_attr($button_animation) . '" ';
            }
            if(isset($button_alignment) && $button_alignment != '') {
                $button_style .= ''.$button_alignment;
            }
            if(isset($button_text) && !empty($button_text)) {
                $button_font_options = _crum_parse_text_shortcode_params($button_font_options, '', $button_google_fonts, $button_custom_fonts);
                $button_text_html = '<span class="dfd-button-text" >'.esc_html($button_text).'</span>';
            }
            if(isset($text_color) && !empty($text_color)) {
                $link_css .= '#'.esc_js($uniqid_btn).'.dfd-btn-open-modal-box .dfd-btn-wrap:not(:hover) {color: '.esc_js($text_color).';}';
            }
            if(isset($text_hover_color) && !empty($text_hover_color)) {
                $link_css .= '#'.esc_js($uniqid_btn).'.dfd-btn-open-modal-box .dfd-btn-wrap:hover {color: '.esc_js($text_hover_color).';}';
            }
            if(isset($background) && !empty($background)) {
                $link_css .= '#'.esc_js($uniqid_btn).'.dfd-btn-open-modal-box .dfd-btn-wrap:not(:hover) {background: '.esc_js($background).';}';
            }
            if(isset($hover_background) && !empty($hover_background)) {
                $link_css .= '#'.esc_js($uniqid_btn).'.dfd-btn-open-modal-box .dfd-btn-wrap:hover {background: '.esc_js($hover_background).';}';
            }
            if(isset($padding_left) && $padding_left != '') {
                $link_css .= '#'.esc_js($uniqid_btn).'.dfd-btn-open-modal-box .dfd-btn-wrap {padding-left: '.esc_js($padding_left).'px;}';
            }
            if(isset($padding_right) && $padding_right != '') {
                $link_css .= '#'.esc_js($uniqid_btn).'.dfd-btn-open-modal-box .dfd-btn-wrap {padding-right: '.esc_js($padding_right).'px;}';
            }
            if(isset($border) && $border != '') {
                $border_css = Dfd_Border_Param::border_css($border);
                if(substr_count($border_css,'border-radius:') > 0) {
                    $border_radius = substr($border_css,stripos($border_css,'border-radius:'));
                    if($border_radius != '') {
                        $link_css .= '#'.esc_js($uniqid_btn).'.dfd-btn-open-modal-box .dfd-btn-wrap {'.$border_radius.'}';
                    }    
                }
                $link_css .= '#'.esc_js($uniqid_btn).'.dfd-btn-open-modal-box .dfd-btn-wrap:not(:hover) .dfd-btn-border {'.$border_css.'}';	
            }
            if(isset($hover_border) && $hover_border != '') {
                $hover_border_css = Dfd_Border_Param::border_css($hover_border);
                if(substr_count($hover_border_css,'border-radius:') > 0) {
                    $hover_border_radius = substr($hover_border_css,stripos($hover_border_css,'border-radius:'));
                    if($hover_border_radius != '') {
                        $link_css .= '#'.esc_js($uniqid_btn).'.dfd-btn-open-modal-box .dfd-btn-wrap:hover {'.$hover_border_radius.'}';
                    }    
                }
                $link_css .= '#'.esc_js($uniqid_btn).'.dfd-btn-open-modal-box .dfd-btn-wrap:hover .dfd-btn-border {'.$hover_border_css.'}';	
            }
            if(substr_count($box_shadow, 'disable') == 0) {
                $box_shadow = Dfd_Box_Shadow_Param::box_shadow_css($box_shadow);
                $link_css .= '#'.esc_js($uniqid_btn).' .dfd-btn-wrap:not(:hover) {'.esc_attr($box_shadow).'}';
            }
            if(substr_count($hover_box_shadow, 'disable') == 0) {
                $hover_box_shadow = Dfd_Box_Shadow_Param::box_shadow_css($hover_box_shadow);
                $link_css .= '#'.esc_js($uniqid_btn).' .dfd-btn-wrap:hover {'.esc_attr($hover_box_shadow).'}';
            }
			if(isset($button_size) && !empty($button_size)) {
                $link_css .= '#'.esc_js($uniqid_btn).' .dfd-btn-wrap {display: block;}';
			}

            /***************
             * HTML
            ***************/
                if(isset($display_options)) {
                    if($display_options == "show_scroll") {
                        $output .= '<div id="'.esc_attr($output_uid).'" class="output-display call-on-waypoint"></div>'; // for output on the scrolls
                    }
                    if ($display_options == "on_click") {
                        $output .= '<div id="'.  esc_js($uniqid_btn).'" class="dfd-btn-open-modal-box '.esc_attr($button_style).'" '.$animation_data_button.'>';
                            $output .= '<div class="dfd-btn-wrap button" '.$button_font_options['style'].'>';
                                $output .= $button_text_html;
                                $output .= '<span class="dfd-btn-border"></span>';
                            $output	.= '</div>';
                        $output .= '</div>';

                        $unique_class .= ''.$uniqid_btn;
                    } else {
                        $unique_class .= ''.$uniqid_box;
                    }
                }

                $output .= '<div id="'.esc_attr($uniqid_box).'" class="dfd-modal-box-overlay '.esc_attr($unique_class).'">';
                    $output .= '<div class="dfd-modal-box-cover '.esc_attr($el_class).' '.esc_attr($unique_class).'" '.$animation_data.'>';
                        $output .= '<div class="dfd-modal-box-wrap">'; 
                        $output .= '<i class="close-block"></i>';
                            $output .= '<div class="dfd-modal-box-shortcode '.esc_attr($data_img).'">';
                                $output .= $shortcode;
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';

            if(!empty($link_css)) {
                $output .=	'<script type="text/javascript">
                                (function($) {
                                    $("head").append("<style>'. esc_js($link_css) .'</style>");
                                })(jQuery);
                            </script>';
            }
            ?>

                <script type="text/javascript">
                    (function($) {
                        "use strict";
                        $(document).ready(function() {
                            $('.dfd-modal-box-overlay').appendTo(document.body);
                            function setcookie(a,b,c) {
                                if(c){
                                    var d = new Date();
                                    d.setTime(d.getTime()+c);
                                }
                                if(a && b) {
                                    document.cookie = a+'='+b+(c ? '; expires='+d.toUTCString() : '');
                                } else {
                                    return false;
                                }
                            }
                            function getcookie(a) {
                                var b = new RegExp(a+'=([^;]){1,}');
                                var c = b.exec(document.cookie);
                                if(c) {
                                    c = c[0].split('=');
                                } else {
                                    return false;
                                }
                                return c[1] ? c[1] : false;
                            }

                            var overlay_id = $('#<?php echo esc_js($uniqid_box); ?>.dfd-modal-box-overlay');
                            var box_id = $('#<?php echo esc_js($uniqid_box); ?> .dfd-modal-box-cover');
                            var uniqclass_overlay = '.dfd-modal-box-overlay.<?php echo esc_attr($unique_class);?>';
                            var uniqclass_box = '.dfd-modal-box-cover.<?php echo esc_attr($unique_class);?>';


                            var modalBoxResponsive = function() {
                                var windowHeight = $(window).height();
                                var modalHeight = $('.dfd-modal-box-wrap.open-modal').height();
                                if (modalHeight > windowHeight) {
                                    box_id.addClass('scroll-show');
                                    $('.dfd-modal-box-wrap.open-modal').addClass('height-resize');
                                } else if (modalHeight < windowHeight) {
                                    box_id.removeClass('scroll-show');
                                    $('.dfd-modal-box-wrap.open-modal').removeClass('height-resize');
                                }
                            }

                            <?php if ($display_options == 'show_scroll') { ?>
                                if(!getcookie('Modal-box-scroll')) {
                                    setcookie('Modal-box-scroll',true);
                                    $('#<?php echo esc_js($output_uid); ?>').on('on-waypoin', function () {
                                        if ( !overlay_id.hasClass('one-animation') ){
                                            overlay_id.addClass('one-animation');
                                            overlay_id.css({'visibility':'visible', 'opacity': '1'}, 500);
                                        }
                                        if ( !box_id.hasClass('one-animation') ){
                                            box_id.addClass('one-animation');
                                            var $anim = box_id.data('animate-type');
                                            setTimeout(function(){
                                                box_id.find('.dfd-modal-box-wrap').addClass('open-modal');
                                                box_id.css('visibility','visible').velocity($anim,{display:'auto'});
                                                modalBoxResponsive();
                                            }, 500);
                                        }
                                    });
                                }
                            <?php }; ?>
                            <?php if ($display_options == 'set_timeout') { ?>	
                                if(!getcookie('Modal-box-timeout')) {
                                    setcookie('Modal-box-timeout',true);
                                    setTimeout(function(){
                                        overlay_id.css({'visibility':'visible', 'opacity': '1'}, 500);
                                        var $animation = $('.dfd-modal-box-cover').data('animate-type');
                                        setTimeout(function(){
                                            box_id.find('.dfd-modal-box-wrap').addClass('open-modal');
                                            box_id.css({'visibility': 'visible'}).velocity($animation,{display:'auto'});
                                            modalBoxResponsive();
                                        }, 500);
                                    }, <?php echo esc_js($time_output); ?>);
                                }	
                            <?php }; ?>
                            <?php if ($display_options == 'on_click') { ?>
                                $(document).on('click', '#<?php echo esc_js($uniqid_btn);?> .dfd-btn-wrap', function(){
                                    $(uniqclass_overlay).css({'visibility':'visible', 'opacity': '1'}, 500);
                                    var $anim = $(uniqclass_box).data('animate-type');
                                    setTimeout(function(){
                                        box_id.find('.dfd-modal-box-wrap').addClass('open-modal');
                                        $(uniqclass_box).css('visibility','visible').velocity($anim,{display:'auto'});
                                        modalBoxResponsive();
                                    }, 500);
                                });
                            <?php }; ?>	
                            $(document).on('click', uniqclass_box, function(){
                                box_id.find('.dfd-modal-box-wrap').removeClass('open-modal');
                                $(uniqclass_box).velocity('reverse', 500).css({'visibility': 'hidden'});
                                setTimeout(function(){
                                    $(uniqclass_overlay).css({'visibility': 'hidden', 'opacity': '0'}, 500);
                                }, 500);
                            }); 
                            $(document).on('click', '.dfd-modal-box-shortcode', function(event){
                                event.stopPropagation();
                            });
                            $(window).on('resize', modalBoxResponsive);
                        });	
                    })(jQuery);
                </script>

            <?php
            return $output;
		}
	}
    new Dfd_Modal_Box;
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_dfd_modal_box extends WPBakeryShortCodesContainer {
		}
	}
}

