<?php //
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Clients Testimonials
*/
if(!class_exists('Dfd_New_Subscribe')) {
	
	class Dfd_New_Subscribe {
		function __construct(){
			add_action('init',array($this,'dfd_new_subscribe_init'));
			add_shortcode('dfd_new_subscribe',array($this,'dfd_new_subscribe_shortcode'));
		}
		function dfd_new_subscribe_init() {
			if(function_exists('vc_map')) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/subscribe/';
				vc_map(
					array(
						'name' => esc_html__('New Subscribe Module', 'dfd'),
						'base' => 'dfd_new_subscribe',
						'icon' => 'dfd_new_subscribe dfd_shortcode',
						'category' => esc_html__('Ronneby 2.0', 'dfd'),
						'description' => esc_html__('Displays Subscribe Form', 'dfd'),
						'params' => array(
							array(
								'heading' => esc_html__('Select Style', 'dfd'),
								'type' => 'radio_image_select',
								'param_name' => 'main_style',
								'simple_mode' => false,
								'options' => array(
									'style-1' => array(
										'tooltip' => esc_attr__('Standard', 'dfd'),
										'src' => $module_images . 'style-1.png'
									),
									'style-2' => array(
										'tooltip' => esc_attr__('Inside', 'dfd'),
										'src' => $module_images . 'style-2.png'
									),
									'style-3' => array(
										'tooltip' => esc_attr__('Separate', 'dfd'),
										'src' => $module_images . 'style-3.png'
									),
									'style-4' => array(
										'tooltip' => esc_attr__('Simple', 'dfd'),
										'src' => $module_images . 'style-4.png'
									),
									'style-5' => array(
										'tooltip' => esc_attr__('Animated', 'dfd'),
										'src' => $module_images . 'style-5.png'
									),
								),
							),
							array(
								'type' => 'textfield',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Please enter the placeholder name. The text will be shown inside the subscribe form', 'dfd') . '</span></span>' . esc_html__('Placeholder', 'dfd'),
								'param_name' => 'subscribe_module_placeholder',
								'admin_label' => true,
								'value' => '',
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__('Feedburner Feed Name', 'dfd'),
								'param_name' => 'subscribe_module_feed_name',
								'admin_label' => true,
								'value' => '',
								'description' => esc_html__('Read more how to setup', 'dfd') . ' <a href="https://support.google.com/feedburner/answer/78978" target="_blank"> ' . esc_html__('Adding FeedBurner Email', 'dfd') . '</a>',
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
								'text' => esc_html__('Text field and button styles', 'dfd'),
								'param_name' => 'field_and_button_styles',
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
								'group' => esc_attr__('Styling field', 'dfd'),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the border radius for the subscribe botton and field', 'dfd') . '</span></span>' . esc_html__('Border Radius field & button', 'dfd'),
								'param_name' => 'border_radius',
								'value' => '',
								'min' => 0,
								'max' => 10,
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group' => esc_html__('Styling field', 'dfd'),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the horizontal alignment for the subscribe button', 'dfd') . '</span></span>' . esc_html__('Alignment', 'dfd'),
								'param_name' => 'field_alignment',
								'value' => '',
								'options' => array(
									esc_html__('Center', 'dfd') => 'align-center',
									esc_html__('Left', 'dfd') => 'align-left',
									esc_html__('Right', 'dfd') => 'align-right',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'main_style', 'value' => array('style-5')),
								'group' => esc_html__('Styling field', 'dfd'),
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Text field styles', 'dfd'),
								'param_name' => 'field_styles',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group' => esc_attr__('Styling field', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the color for the text typed in subscribe field. The default color is inherited from Theme Options > Custom typography > Box name typography', 'dfd') . '</span></span>' . esc_html__('Text Color', 'dfd'),
								'param_name' => 'field_text_color',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group' => esc_html__('Styling field', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the background color for the subscribe field', 'dfd') . '</span></span>' . esc_html__('Background', 'dfd'),
								'param_name' => 'field_bg_color',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group' => esc_html__('Styling field', 'dfd'),
							),
							array(
								'type' => 'dropdown',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the border style for the subscribe field', 'dfd') . '</span></span>' . esc_html__('Field Border Style', 'dfd'),
								'param_name' => 'field_border_style',
								'value' => array(
									esc_html__('Solid', 'dfd') => 'solid',
									esc_html__('Dashed', 'dfd') => 'dashed',
									esc_html__('Dotted', 'dfd') => 'dotted',
									esc_html__('Double', 'dfd') => 'double',
									esc_html__('Inset', 'dfd') => 'inset',
									esc_html__('Outset', 'dfd') => 'outset',
									esc_html__('None', 'dfd') => 'none',
								),
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group' => esc_html__('Styling field', 'dfd'),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the border width for the subscribe field', 'dfd') . '</span></span>' . esc_html__('Border Width', 'dfd'),
								'param_name' => 'field_border_width',
								'value' => '1',
								'min' => 1,
								'max' => 10,
								'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
								'group' => esc_html__('Styling field', 'dfd'),
								'dependency' => array('element' => 'field_border_style', 'value' => array('solid', 'dashed', 'dotted', 'double', 'inset', 'outset')),
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the border color for the subscribe field. The dafault value is #cdcdcd', 'dfd') . '</span></span>' . esc_html__('Border Color', 'dfd'),
								'param_name' => 'field_border_color',
								'value' => '#cdcdcd',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group' => esc_html__('Styling field', 'dfd'),
								'dependency' => array('element' => 'field_border_style', 'value' => array('solid', 'dashed', 'dotted', 'double', 'inset', 'outset')),
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Button styles', 'dfd'),
								'param_name' => 'button_styles',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group' => esc_attr__('Styling field', 'dfd'),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the border color for the subscribe field. The dafault value is #cdcdcd', 'dfd') . '</span></span>' . esc_html__('Button content', 'dfd'),
								'param_name' => 'button_element',
								'value' => 'text',
								'options' => array(
									esc_html__('Text', 'dfd') => 'text',
									esc_html__('Icon', 'dfd') => 'icon',
								),
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group' => esc_html__('Styling field', 'dfd'),
							),
							array(
								'type' => 'textfield',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Enter the text you\'d like to display on the subscribe button', 'dfd') . '</span></span>' . esc_html__('Button Text', 'dfd'),
								'param_name' => 'button_text',
								'admin_label' => true,
								'value' => 'Subscribe',
								'edit_field_class' => 'vc_column vc_col-sm-8 crum_vc',
								'group' => esc_html__('Styling field', 'dfd'),
								'dependency' => array('element' => 'button_element', 'value' => array('text')),
							),
							array(
								'type' => 'icon_manager',
								'heading' => esc_html__('Select Icon ', 'dfd'),
								'param_name' => 'button_icon',
								'value' => '',
								'description' => __("Click and select icon of your choice. If you can't find the one that suits for your purpose, you can <a href='admin.php?page=font-icon-Manager' target='_blank'>add new here</a>.", "flip-box"),
								'group' => esc_html__('Styling field', 'dfd'),
								'dependency' => array('element' => 'button_element', 'value' => array('icon')),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to choose the size for the icon you have set', 'dfd') . '</span></span>' . esc_html__('Icon size', 'dfd'),
								'param_name' => 'icon_size',
								'value' => '22',
								'min' => 15,
								'max' => 40,
								'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
								'group' => esc_html__('Styling field', 'dfd'),
								'dependency' => array('element' => 'button_element', 'value' => array('icon')),
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the content color. The default value is inherited from Theme Options > General options > Default button options > Default Button Typography. For the style Simple the color is inherited from Theme Options > Custom typography > Box Name Typography', 'dfd') . '</span></span>' . esc_html__('Button Content Color', 'dfd'),
								'param_name' => 'button_element_color',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group' => esc_html__('Styling field', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to specify subscription button\'s background color. The default vale is #1b1b1b', 'dfd') . '</span></span>' . esc_html__('Button Background', 'dfd'),
								'param_name' => 'button_background',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group' => esc_html__('Styling field', 'dfd'),
								'dependency' => array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-3', 'style-5')),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the letter-spacing for subscription button\'s text. The default value is inherited from Theme Options > General options > Default button options > Default Button Typography', 'dfd') . '</span></span>' . esc_html__('Letter Spacing', 'dfd'),
								'param_name' => 'button_letter_spacing',
								'value' => '',
								'min' => -20,
								'max' => 20,
								'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
								'group' => esc_html__('Styling field', 'dfd'),
								'dependency' => array('element' => 'button_element', 'value' => array('text')),
							),
							array(
								'type' => 'dropdown',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the border style for the subscribe button', 'dfd') . '</span></span>' . esc_html__('Button Border Style', 'dfd'),
								'param_name' => 'button_border_style',
								'value' => array(
									esc_html__('None', 'dfd') => 'none',
									esc_html__('Solid', 'dfd') => 'solid',
									esc_html__('Dashed', 'dfd') => 'dashed',
									esc_html__('Dotted', 'dfd') => 'dotted',
									esc_html__('Double', 'dfd') => 'double',
									esc_html__('Inset', 'dfd') => 'inset',
									esc_html__('Outset', 'dfd') => 'outset',
								),
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group' => esc_html__('Styling field', 'dfd'),
								'dependency' => array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-3', 'style-5')),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the border width for the subscribe button. The value is not set by default', 'dfd') . '</span></span>' . esc_html__('Border Width', 'dfd'),
								'param_name' => 'button_border_width',
								'value' => '0',
								'min' => 1,
								'max' => 10,
								'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
								'group' => esc_html__('Styling field', 'dfd'),
								'dependency' => array('element' => 'button_border_style', 'value' => array('solid', 'dashed', 'dotted', 'double', 'inset', 'outset')),
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the border color for the subscribe button. The dafault value is #cdcdcd', 'dfd') . '</span></span>' . esc_html__('Border Color', 'dfd'),
								'param_name' => 'button_border_color',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group' => esc_html__('Styling field', 'dfd'),
								'dependency' => array('element' => 'button_border_style', 'value' => array('solid', 'dashed', 'dotted', 'double', 'inset', 'outset')),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Button left padding', 'dfd') . '</span></span>' . esc_html__('Left padding', 'dfd'),
								'param_name' => 'button_left_padding',
								'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
								'dependency' => array('element' => 'button_element', 'value' => array('text')),
								'group' => esc_html__('Styling field', 'dfd'),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Button right padding', 'dfd') . '</span></span>' . esc_html__('Right padding', 'dfd'),
								'param_name' => 'button_right_padding',
								'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
								'dependency' => array('element' => 'button_element', 'value' => array('text')),
								'group' => esc_html__('Styling field', 'dfd'),
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Button hover styles', 'dfd'),
								'param_name' => 'button_hover_styles',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group' => esc_attr__('Styling field', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the content hover color. The default value is inherited from Theme Options > General options > Default button options > Default button hover text color. For the style Simple the color is inherited from Theme Options > Custom typography > Box Name Typography', 'dfd') . '</span></span>' . esc_html__('Button Content Hover Color', 'dfd'),
								'param_name' => 'button_element_hover_color',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group' => esc_html__('Styling field', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to specify subscription button\'s background hover color. The default value is rgba(27,27,27,0.85)', 'dfd') . '</span></span>' . esc_html__('Button Hover Background', 'dfd'),
								'param_name' => 'button_hover_background',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group' => esc_html__('Styling field', 'dfd'),
								'dependency' => array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-3', 'style-5')),
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the border hover color for the subscribe button', 'dfd') . '</span></span>' . esc_html__('Border Hover Color', 'dfd'),
								'param_name' => 'button_hover_border_color',
								'value' => '#cdcdcd',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group' => esc_html__('Styling field', 'dfd'),
								'dependency' => array('element' => 'button_border_style', 'value' => array('solid', 'dashed', 'dotted', 'double', 'inset', 'outset')),
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Placeholder typography', 'dfd'),
								'param_name' => 'placeholder_t_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
								'dependency' => array('element' => 'subscribe_module_placeholder', 'not_empty' => true),
								'group' => esc_attr__('Typography', 'dfd'),
							),
							array(
								'type' => 'dfd_font_container_param',
								'heading' => '',
								'param_name' => 'placeholder_font_options',
								'settings' => array(
									'fields' => array(
										'letter_spacing',
										'font_size',
										//'line_height',
										'color',
										'font_style',
									),
								),
								'dependency' => array('element' => 'subscribe_module_placeholder', 'not_empty' => true),
								'group' => esc_attr__('Typography', 'dfd'),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to use custom Google font', 'dfd') . '</span></span>' . esc_html__('Custom font family', 'dfd'),
								'param_name' => 'placeholder_use_google_fonts',
								'value' => '',
								'options' => array(
									'yes' => array(
										'yes' => esc_attr__('Yes', 'dfd'),
										'no' => esc_attr__('No', 'dfd')
									),
								),
								'dependency' => array('element' => 'subscribe_module_placeholder', 'not_empty' => true),
								'group' => esc_attr__('Typography', 'dfd'),
							),
							array(
								'type' => 'google_fonts',
								'param_name' => 'placeholder_custom_fonts',
								'value' => '',
								'settings' => array(
									'fields' => array(
										'font_family_description' => esc_html__('Select font family.', 'dfd'),
										'font_style_description' => esc_html__('Select font styling.', 'dfd'),
									),
								),
								'dependency' => array('element' => 'placeholder_use_google_fonts', 'value' => 'yes'),
								'group' => esc_attr__('Typography', 'dfd'),
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Button typography', 'dfd'),
								'param_name' => 'button_t_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
								'dependency' => array('element' => 'button_element', 'value' => 'text'),
								'group' => esc_attr__('Typography', 'dfd'),
							),
							array(
								'type' => 'dfd_font_container_param',
								'heading' => '',
								'param_name' => 'button_font_options',
								'settings' => array(
									'fields' => array(
										//'letter_spacing',
										'font_size',
										//'line_height',
										//'color',
										'font_style',
									),
								),
								'dependency' => array('element' => 'button_element', 'value' => 'text'),
								'group' => esc_attr__('Typography', 'dfd'),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to use custom Google font', 'dfd') . '</span></span>' . esc_html__('Custom font family', 'dfd'),
								'param_name' => 'button_use_google_fonts',
								'value' => '',
								'options' => array(
									'yes' => array(
										'yes' => esc_attr__('Yes', 'dfd'),
										'no' => esc_attr__('No', 'dfd')
									),
								),
								'dependency' => array('element' => 'button_element', 'value' => 'text'),
								'group' => esc_attr__('Typography', 'dfd'),
							),
							array(
								'type' => 'google_fonts',
								'param_name' => 'button_custom_fonts',
								'value' => '',
								'settings' => array(
									'fields' => array(
										'font_family_description' => esc_html__('Select font family.', 'dfd'),
										'font_style_description' => esc_html__('Select font styling.', 'dfd'),
									),
								),
								'dependency' => array('element' => 'button_use_google_fonts', 'value' => 'yes'),
								'group' => esc_attr__('Typography', 'dfd'),
							),
						),
					)
				);
			}
		}
		// Shortcode handler function
		function dfd_new_subscribe_shortcode($atts) {
			$output = $subscribe_module_feed_name = $subscribe_module_placeholder = $el_class = $module_animation = $main_style = $field_border_style = $field_border_width = '';
			$field_border_color = $border_radius = $field_text_color = $button_border_style = $button_border_width = $button_border_color = $button_element_color = '';
			$button_element = $button_text = $button_icon = $button_background = $text_fild_style = $button_style = $field_bg_color = $button_info = $button_hover_style = '';
			$button_element_hover_color = $button_hover_background = $button_hover_border_color = $link_css = $main_class = $button_letter_spacing = $field_css = '';
			$icon_size = $icon_style = $field_alignment = $placeholder_font_options = $placeholder_use_google_fonts = $placeholder_custom_fonts = '';
			$button_font_options = $button_use_google_fonts = $button_custom_fonts = $button_left_padding = $button_right_padding = '';
			
			$atts = vc_map_get_attributes( 'dfd_new_subscribe', $atts );
			extract( $atts );
			
			$text_fild_style .= 'style="';
			
			$unique_id = uniqid('dfd-subscribe-').'-'.rand(0,9999);
			$main_class .= esc_attr($field_alignment).' ';
			
			if(isset($border_radius) && !empty($border_radius)) {
				$text_fild_style .= 'border-radius: '.esc_attr($border_radius).'px; ';
				$button_style .= 'border-radius: '.esc_attr($border_radius).'px; ';
			}
			if(isset($field_bg_color) && !empty($field_bg_color)) {
				$text_fild_style .= 'background: '.esc_attr($field_bg_color).'; ';
			}
			if(isset($field_border_style) && strcmp($field_border_style, 'none') !== 0) {
				if ( $field_border_style || $field_border_width || $field_border_color ) {
					if ($field_border_style) {
						$field_css .= 'border-style: '.esc_attr($field_border_style).'; ';
					}
					if ($field_border_width) {
						$field_css .= 'border-width: '.esc_attr($field_border_width).'px; ';
					}
					if ($field_border_color) {
						$field_css .= 'border-color: '.esc_attr($field_border_color).'; ';
					}
				}
			} else {
				$field_css .= 'border-width: 0; ';
			}
			
			$link_css .= '.dfd-subscribe-module-form #form_'.esc_attr($unique_id).' .text {'.$field_css.'}';
			$link_css .= '.dfd-background-dark .dfd-subscribe-module-form #form_'.esc_attr($unique_id).' .text {border-color: rgba(255,255,255,0.2);}';
			
			if(isset($field_text_color) && !empty($field_text_color)) {
				$text_fild_style .= 'color: '.esc_attr($field_text_color).'; ';
			}
			if(isset($button_element) && strcmp($button_element, 'text') === 0) {
				if(isset($button_text) && !empty($button_text)) {
					$button_info = esc_attr($button_text);
				}
			}else{
				if(isset($button_icon) && !empty($button_icon)) {
					if(isset($icon_size) && !empty($icon_size)) {
						$icon_style .= 'font-size: '.esc_attr($icon_size).'px; ';
					}
					$button_info = '<i class="'.esc_attr($button_icon).'" style="'.esc_attr($icon_style).'"></i>';
					$main_class .= 'select-icon';
				}
			}
			if(isset($button_element_color) && !empty($button_element_color)) {
				$button_style .= 'color: '.esc_attr($button_element_color).'; ';
			}
			if(isset($button_background) && !empty($button_background)) {
				$button_style .= 'background: '.esc_attr($button_background).'; ';
			}
			if(isset($button_letter_spacing) && !empty($button_letter_spacing)) {
				$button_style .= 'letter-spacing: '.esc_attr($button_letter_spacing).'px; ';
			}
			if(isset($button_border_style) && strcmp($button_border_style, 'none') !== 0) {
				if ( $button_border_style || $button_border_width || $button_border_color ) {
					if ($button_border_style) {
						$button_style .= 'border-style: '.esc_attr($button_border_style).'; ';
					}
					if ($button_border_width) {
						$button_style .= 'border-width: '.esc_attr($button_border_width).'px; ';
					}
					if ($button_border_color) {
						$button_style .= 'border-color: '.esc_attr($button_border_color).'; ';
					}
				}
			} else {
				$button_style .= 'border-width: 0; ';
			}
			if ( $button_element_hover_color || $button_hover_background || $button_hover_border_color ) {
				if ($button_element_hover_color) {
					$button_hover_style .= 'color: '.esc_attr($button_element_hover_color).'; ';
				}
				if ($button_hover_background) {
					$button_hover_style .= 'background: '.esc_attr($button_hover_background).'; ';
				}
				if ($button_hover_border_color) {
					$button_hover_style .= 'border-color: '.esc_attr($button_hover_border_color).'; ';
				}
			}
			
			$text_fild_style .= '"';
			
			$animate = $animation_data = $title_css = $subtitle_css = $background_css = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			if($button_style !== '') {
				$link_css .= '.dfd-subscribe-module-form #form_'.esc_attr($unique_id).' .submit {'.esc_attr($button_style).'}';
			}
			if($button_hover_style !== '') {
				$link_css .= '.dfd-subscribe-module-form #form_'.esc_attr($unique_id).' .submit:hover {'.esc_attr($button_hover_style).'}';
			}
			$placeholder_font_options = _crum_parse_text_shortcode_params( $placeholder_font_options, '', $placeholder_use_google_fonts, $placeholder_custom_fonts );
			if(isset($placeholder_font_options) && !empty($placeholder_font_options)) {
				$link_css .= '.dfd-new-subscribe-module .dfd-subscribe-module-form #form_'.esc_attr($unique_id).' ::-webkit-input-placeholder {'.esc_js($placeholder_font_options['style']).'}';
				$link_css .= '.dfd-new-subscribe-module .dfd-subscribe-module-form #form_'.esc_attr($unique_id).' :-moz-placeholder {'.esc_js($placeholder_font_options['style']).'}';
				$link_css .= '.dfd-new-subscribe-module .dfd-subscribe-module-form #form_'.esc_attr($unique_id).' ::-moz-placeholder {'.esc_js($placeholder_font_options['style']).'}';
				$link_css .= '.dfd-new-subscribe-module .dfd-subscribe-module-form #form_'.esc_attr($unique_id).' :-ms-input-placeholder {'.esc_js($placeholder_font_options['style']).'}';
				$link_css .= '.dfd-new-subscribe-module .dfd-subscribe-module-form #form_'.esc_attr($unique_id).' :focus::-webkit-input-placeholder {color: transparent !important;}';
				$link_css .= '.dfd-new-subscribe-module .dfd-subscribe-module-form #form_'.esc_attr($unique_id).' :focus:-moz-placeholder {color: transparent !important;}';
				$link_css .= '.dfd-new-subscribe-module .dfd-subscribe-module-form #form_'.esc_attr($unique_id).' :focus::-moz-placeholder {color: transparent !important;}';
				$link_css .= '.dfd-new-subscribe-module .dfd-subscribe-module-form #form_'.esc_attr($unique_id).' :focus:-ms-input-placeholder {color: transparent !important;}';
			}
			$button_font_options = _crum_parse_text_shortcode_params( $button_font_options, '', $button_use_google_fonts, $button_custom_fonts );
			if(isset($button_font_options) && !empty($button_font_options)) {
				$link_css .= '.dfd-new-subscribe-module #form_'.esc_attr($unique_id).' .submit {'.esc_js($button_font_options['style']).'}';
			}
			if(isset($button_left_padding) && $button_left_padding != '') {
				$link_css .= '.dfd-new-subscribe-module #form_'.esc_attr($unique_id).' .submit {padding-left: '.esc_js($button_left_padding).'px;}';
			}
			if(isset($button_right_padding) && $button_right_padding != '') {
				$link_css .= '.dfd-new-subscribe-module #form_'.esc_attr($unique_id).' .submit {padding-right: '.esc_js($button_right_padding).'px;}';
			}
			
			$output .= '<div class="dfd-new-subscribe-module '. esc_attr($el_class).' '.esc_attr($animate) .'" '. $background_css .' '. $animation_data .'>';
				
			if($subscribe_module_feed_name != '') :
				$output .= '<div class="dfd-subscribe-module-form dfd-subscribe-'.esc_attr($main_style).' '.esc_attr($main_class) .'">';
					$output .= '<form id="form_'. esc_attr($unique_id) .'" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open(\'http://feedburner.google.com/fb/a/mailverify?uri='. $subscribe_module_feed_name.'\', \'popupwindow\', \'scrollbars=yes,width=550,height=520\');return true">';
						$output .= '<table>';
							$output .= '<tr>';
								$output .= '<td class="cell-text">';
									$output .= '<input class="text" type="text" name="email" id="'.uniqid('subsmail_').'" '.$text_fild_style.' placeholder="'. esc_attr($subscribe_module_placeholder).'" />';
								$output .= '</td>';
								$output .= '<td class="cell-submit">';
									$output .= '<button type="submit" class="submit">'. $button_info .'</button>';
								$output .= '</td>';
							$output .= '</tr>';
						$output .= '</table>';
						$output .= '<input type="hidden" value="'. esc_attr($subscribe_module_feed_name) .'" name="uri"/>';
						$output .= '<input type="hidden" name="loc" value="en_US"/>';
					$output .= '</form>';
				$output .= '</div>';
				$output .= '<script type="text/javascript">
					(function($) {
						$("head").append("<style>'. esc_js($link_css) .'</style>");
						$(".dfd-subscribe-style-5 input.text").focus(function(e){
							$(this).parent("td").addClass("active").siblings().addClass("active");
						}).blur(function(){
							if($(this).val() == "") {
								$(this).parent("td").removeClass("active").siblings().removeClass("active");
							}
						});
					})(jQuery);
				</script>';
			else :
				$output .= '<h3 class="widget-title">'. _e('Please fill in the Feedburner Feed Name parameter', 'dfd') .'</h3>';
			endif;
				
			$output .= '</div>';
			
			return $output;
		}
	}
}
if(class_exists('Dfd_New_Subscribe')) {
	$Dfd_New_Subscribe = new Dfd_New_Subscribe;
}