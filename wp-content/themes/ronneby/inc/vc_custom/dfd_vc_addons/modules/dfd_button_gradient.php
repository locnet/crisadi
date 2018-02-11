<?php
if ( !defined( 'ABSPATH' )) { exit; }
/*
* Add-on Name: DFD Button Gradient
*/
if( !class_exists('Dfd_Button_Gradient')) {
	
	class Dfd_Button_Gradient {
		
		function __construct() {
			add_action('init', array(&$this, 'button_gradient_init'));
			add_shortcode('button_gradient', array(&$this, 'button_gradient_form'));
		}
		
		function button_gradient_init () {
			if ( function_exists('vc_map') ) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/button-gradient/';
				vc_map (
					array(
						'name'					=> esc_html__('Button Gradient', 'dfd'),
						'base'					=> 'button_gradient',
						'icon'					=> 'button_gradient dfd_shortcode',
						'category'				=> esc_html__('Ronneby 2.0', 'dfd'),
						'params'				=> array(
							array(
								'type'				=> 'radio_image_select',
								'heading'			=> esc_html__('Style', 'dfd'),
								'param_name'		=> 'main_style',
								'simple_mode'		=> false,
								'options'			=> array(
									'style-2'			=> array(
										'tooltip'			=> esc_html__('Left icon','dfd'),
										'src'				=> $module_images.'/style-2.png'
									),
									'style-3'			=> array(
										'tooltip'			=> esc_html__('Right icon','dfd'),
										'src'				=> $module_images.'/style-3.png'
									),
									'style-4'			=> array(
										'tooltip'			=> esc_html__('Left icon on hover','dfd'),
										'src'				=> $module_images.'/style-4.png'
									),
									'style-5'			=> array(
										'tooltip'			=> esc_html__('Right icon on hover','dfd'),
										'src'				=> $module_images.'/style-5.png'
									),
									'style-6'			=> array(
										'tooltip'			=> esc_html__('Top icon on hover','dfd'),
										'src'				=> $module_images.'/style-6.png'
									),
								),
							),
							array(
								'type'				=> 'dfd_radio_advanced',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the direction for the buttons\'s background gradient' ,'dfd').'</span></span>'.esc_html__('Gradient direction', 'dfd'),
								'param_name'		=> 'direction_gradient',
								'value'				=> 'to right',
								'options'			=> array(
									esc_html__('Horizontal', 'dfd') => 'to right',
									esc_html__('Vertical', 'dfd') => 'to top',
									esc_html__('Diagonal top to left', 'dfd') => 'to top left',
									esc_html__('Diagonal top to right', 'dfd') => 'to top right',
								),
								'edit_field_class'	=> ' vc_column vc_col-sm-12',
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Hover style', 'dfd'),
								'param_name'		=> 'hover_style_heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type'				=> 'dropdown',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to select among 7 preset button hover styles','dfd').'</span></span>'.esc_html__('Hover style', 'dfd'),
								'param_name'		=> 'hover_style',
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'value'				=> array(
									esc_html__('Fade', 'dfd')		=> 'dfd-fade',
									esc_html__('Slide left', 'dfd')	=> 'dfd-slide-left',
									esc_html__('Slide right', 'dfd')	=> 'dfd-slide-right',
									esc_html__('Slide top', 'dfd')	=> 'dfd-slide-top',
									esc_html__('Slide bottom', 'dfd')	=> 'dfd-slide-bottom',
									esc_html__('Zoom out', 'dfd')	=> 'dfd-zoom-in',
									esc_html__('3d rotation', 'dfd')	=> 'dfd-3d-rotate',
								),
							),
							array(
								'type'				=> 'dfd_radio_advanced',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the size for the button. The full width allows you to have full width button according to the container','dfd').'</span></span>'.esc_html__('Button size', 'dfd'),
								'param_name'		=> 'button_size',
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'value'				=> 'normal',
								'options'			=> array(
									esc_html__('Normal','dfd')		=> 'normal',
									esc_html__('Full width','dfd')	=> 'dfd-button-full-width',
								),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Main button settings', 'dfd'),
								'param_name'		=> 'main_heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type'				=> 'textfield',
								'heading'			=> esc_html__('Button text', 'dfd'),
								'param_name'		=> 'button_text',
								'value'				=> esc_html__('Button','dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
							),
							array(
								'type'				=> 'textfield',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Tooltip is small pop-up box that appears when the user moves the mouse pointer over the button','dfd').'</span></span>'.esc_html__('Tooltip text', 'dfd'),
								'param_name'		=> 'tooltip_text',
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
							),
							array(
								'type'				=> 'dfd_radio_advanced',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the horizontal alignment for the button','dfd').'</span></span>'.esc_html__('Button alignment', 'dfd'),
								'param_name'		=> 'alignment',
								'value'				=> 'text-center',
								'options'			=> array(
									esc_html__('Center','dfd')	=> 'text-center',
									esc_html__('Left','dfd')	=> 'text-left',
									esc_html__('Right','dfd')	=> 'text-right',
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'dependency'		=> array('element' => 'button_size', 'value' => 'normal'),
							),
							array(
								'type'				=> 'vc_link',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add a custom link or select existing page. You can remove existing link as well','dfd').'</span></span>'.esc_html__('Button link url', 'dfd'),
								'param_name'		=> 'buttom_link_src',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-bottom-padding',
							),
							array(
								'type'				=> 'dfd_radio_advanced',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the alignment for the button\'s tooltip','dfd').'</span></span>'.esc_html__('Tooltip alignment', 'dfd'),
								'param_name'		=> 'tooltip_alignment',
								'css_rules'			=> 'padding: 0 12px;',
								'value'				=> 'dfd-button-tooltip-left',
								'options'			=> array(
									esc_html__('Left', 'dfd')			=> 'dfd-button-tooltip-left',
									esc_html__('Right', 'dfd')			=> 'dfd-button-tooltip-right',
									esc_html__('Top', 'dfd')			=> 'dfd-button-tooltip-top',
									esc_html__('Bottom', 'dfd')			=> 'dfd-button-tooltip-bottom',
									esc_html__('Top Left', 'dfd')		=> 'dfd-button-tooltip-top-left',
									esc_html__('Top Right', 'dfd')		=> 'dfd-button-tooltip-top-right',
									esc_html__('Bottom Left', 'dfd')	=> 'dfd-button-tooltip-bottom-left',
									esc_html__('Bottom Right', 'dfd')	=> 'dfd-button-tooltip-bottom-right',
								),
								'dependency'		=> array('element' => 'tooltip_text', 'not_empty' => true),
								'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Extra features', 'dfd'),
								'param_name'		=> 'extra_heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12 no-top-margin',
							),
							array(
								'type'				=> 'dropdown',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd').'</span></span>'.esc_html__('Animation', 'dfd'),
								'param_name'		=> 'module_animation',
								'value'				=> dfd_module_animation_styles(),
							),
							array(
								'type'				=> 'textfield',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes.','dfd').'</span></span>'.esc_html__('Custom CSS class','dfd'),
								'param_name'		=> 'el_class',
							),
//							array(
//								'type'				=> 'dfd_video_link_param',
//								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Video tutorial and theme documentation article','dfd').'</span></span>'.esc_html__('Tutorials','dfd'),
//								'param_name'		=> 'tutorials',
//								'doc_link'			=> '//nativewptheme.net/support/visual-composer/buttons',
//								'video_link'		=> 'https://youtu.be/e-0sJqH7now',
//							),
							array(
								'type'					=> 'dropdown',
								'heading'				=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon library','dfd').'</span></span>'.esc_html__('Icon library', 'dfd'),
								'value'		=> array(
										esc_attr__( 'None', 'js_composer' ) => '',
										//esc_attr__( 'Theme default', 'js_composer' ) => 'dfd_icons',
										esc_attr__( 'Font Awesome', 'js_composer' ) => 'fontawesome',
										esc_attr__( 'Open Iconic', 'js_composer' ) => 'openiconic',
										esc_attr__( 'Typicons', 'js_composer' ) => 'typicons',
										esc_attr__( 'Entypo', 'js_composer' ) => 'entypo',
										esc_attr__( 'Linecons', 'js_composer' ) => 'linecons',
								),
								'param_name' => 'icon_font',
								'group'      => esc_html__( 'Icon', 'dfd' ),
							),	
							array(
								'type'       => 'iconpicker',
								'class'      => '',
								'heading'    => esc_html__( 'Select Icon ', 'dfd' ),
								'param_name' => 'icon_fontawesome',
								'value' => '', // default value to backend editor admin_label
								'settings' => array(
									'emptyIcon' => true,
									'iconsPerPage' => 4000,
								),
								'dependency' => array(
									'element' => 'icon_font',
									'value' => 'fontawesome',
								),
								'group'      => esc_html__( 'Icon', 'dfd' ),
							),
							array(
								'type' => 'iconpicker',
								'heading' => __( 'Icon', 'js_composer' ),
								'param_name' => 'icon_openiconic',
								'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
								'settings' => array(
									'emptyIcon' => true, // default true, display an "EMPTY" icon?
									'type' => 'openiconic',
									'iconsPerPage' => 4000, // default 100, how many icons per/page to display
								),
								'dependency' => array(
									'element' => 'icon_font',
									'value' => 'openiconic',
								),
								'description' => __( 'Select icon from library.', 'js_composer' ),
								'group'      => esc_html__( 'Icon', 'dfd' ),
							),
							array(
								'type' => 'iconpicker',
								'heading' => __( 'Icon', 'js_composer' ),
								'param_name' => 'icon_typicons',
								'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
								'settings' => array(
									'emptyIcon' => true, // default true, display an "EMPTY" icon?
									'type' => 'typicons',
									'iconsPerPage' => 4000, // default 100, how many icons per/page to display
								),
								'dependency' => array(
									'element' => 'icon_font',
									'value' => 'typicons',
								),
								'description' => __( 'Select icon from library.', 'js_composer' ),
								'group'      => esc_html__( 'Icon', 'dfd' ),
							),
							array(
								'type' => 'iconpicker',
								'heading' => __( 'Icon', 'js_composer' ),
								'param_name' => 'icon_entypo',
								'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
								'settings' => array(
									'emptyIcon' => true, // default true, display an "EMPTY" icon?
									'type' => 'entypo',
									'iconsPerPage' => 4000, // default 100, how many icons per/page to display
								),
								'dependency' => array(
									'element' => 'icon_font',
									'value' => 'entypo',
								),
								'group'      => esc_html__( 'Icon', 'dfd' ),
							),
							array(
								'type' => 'iconpicker',
								'heading' => __( 'Icon', 'js_composer' ),
								'param_name' => 'icon_linecons',
								'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
								'settings' => array(
									'emptyIcon' => true, // default true, display an "EMPTY" icon?
									'type' => 'linecons',
									'iconsPerPage' => 4000, // default 100, how many icons per/page to display
								),
								'dependency' => array(
									'element' => 'icon_font',
									'value' => 'linecons',
								),
								'description' => __( 'Select icon from library.', 'js_composer' ),
								'group'      => esc_html__( 'Icon', 'dfd' ),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the size of the icon in px. Default icon size is 11px','dfd').'</span></span>'.esc_html__('Icon size', 'dfd'),
								'param_name'		=> 'icon_size',
								'dependency'		=> array('element' => 'icon_font', 'not_empty' => true),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
								'group'				=> esc_html__('Icon', 'dfd'),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Button paddings', 'dfd'),
								'param_name'		=> 'background_heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Default left padding is inherited from Theme Options > General options > Default button options > Default button left padding','dfd').'</span></span>'.esc_html__('Left padding', 'dfd'),
								'param_name'		=> 'padding_left',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom no-bottom-padding',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Default right padding is inherited from Theme Options > General options > Default button options > Default button right padding','dfd').'</span></span>'.esc_html__('Right padding', 'dfd'),
								'param_name'		=> 'padding_right',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom no-bottom-padding',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Color settings', 'dfd'),
								'param_name'		=> 'background_heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Default color is inherited from Theme Options > General options > Default Button Typography','dfd').'</span></span>'.esc_html__('Text color', 'dfd'),
								'param_name'		=> 'text_color',
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Default text hover color is inherited from Theme Options > General options > Default button options > Default button hover text color','dfd').'</span></span>'.esc_html__('Hover text color', 'dfd'),
								'param_name'		=> 'hover_text_color',
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Default color is inherited from Theme Options > General options > Default button options > Default Button Typography','dfd').'</span></span>'.esc_html__('Icon color', 'dfd'),
								'param_name'		=> 'ic_color',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom no-bottom-padding',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Default icon hover color is inherited from Theme Options > General options > Default button options > Default button hover text color','dfd').'</span></span>'.esc_html__('Icon hover color', 'dfd'),
								'param_name'		=> 'hover_ic_color',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom no-bottom-padding',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Background gradient color', 'dfd'),
								'param_name'		=> 'background_heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'param_name'		=> 'background_from',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the start color for the button\'s background gradient. The default value is inherited from Theme Options > General options > Default button options > Default button background color','dfd').'</span></span>'.esc_html__('Start color', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom no-bottom-padding',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'param_name'		=> 'background_to',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the end color for the button\'s background gradient. The default value is inherited from Theme Options > General options > Default button options > Default button background color','dfd').'</span></span>'.esc_html__('End color', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom no-bottom-padding',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Hover background gradient color', 'dfd'),
								'param_name'		=> 'background_heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'param_name'		=> 'hover_background_from',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the start color for the button\'s hover background gradient. The default value is inherited from Theme Options > General options > Default button options > Default button hover background color','dfd').'</span></span>'.esc_html__('Start color', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom no-bottom-padding',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'param_name'		=> 'hover_background_to',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the start color for the button\'s hover background gradient. The default value is inherited from Theme Options > General options > Default button options > Default button hover background color','dfd').'</span></span>'.esc_html__('End color', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom no-bottom-padding',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Border gradient color', 'dfd'),
								'param_name'		=> 'border_heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'dfd_radio_advanced',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the border for the button','dfd').'</span></span>'.esc_html__('Border', 'dfd'),
								'param_name'		=> 'border',
								'value'				=> 'no',
								'options'			=> array(
									esc_html__('Disable', 'dfd')	=> 'no',
									esc_html__('Enable', 'dfd')		=> 'yes',

								),
								'edit_field_class'	=> 'vc_column vc_col-sm-12',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'param_name'		=> 'border_color_from',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the start color for the button\'s border gradient','dfd').'</span></span>'.esc_html__('Start color', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom',
								'dependency'		=> array('element' => 'border', 'value' => 'yes'),
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'param_name'		=> 'border_color_to',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the end color for the button\'s border gradient','dfd').'</span></span>'.esc_html__('End color', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom',
								'dependency'		=> array('element' => 'border', 'value' => 'yes'),
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'param_name'		=> 'border_color_from_hover',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the start color for the button\'s border gradient on hover. This option does not work for the style hover style zoom out','dfd').'</span></span>'.esc_html__('Start color on hover', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom',
								'dependency'		=> array('element' => 'border', 'value' => 'yes'),
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'param_name'		=> 'border_color_to_hover',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the end color for the button\'s border gradient on hover. This option does not work for the style hover style zoom out','dfd').'</span></span>'.esc_html__('End color on hover', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom',
								'dependency'		=> array('element' => 'border', 'value' => 'yes'),
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the border width. The default value is inherited from Theme Options > General options > Default Button Options > Default button border width','dfd').'</span></span>'.esc_html__('Border width', 'dfd'),
								'param_name'		=> 'border_width',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
								'dependency'		=> array('element' => 'border', 'value' => 'yes'),
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the border radius. The default value is inherited from Theme Options > General options > Default Button Options > Default button border radius','dfd').'</span></span>'.esc_html__('Border radius', 'dfd'),
								'param_name'		=> 'border_radius',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
								'dependency'		=> array('element' => 'border', 'value' => 'yes'),
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Tooltip settings', 'dfd'),
								'param_name'		=> 'tooltip_heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'dependency'		=> array('element' => 'tooltip_text', 'value_not_equal_to' => array('')),
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'param_name'		=> 'tooltip_color',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Default tooltip color is #ffffff;','dfd').'</span></span>'.esc_html__('Tooltip color', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom no-bottom-padding',
								'dependency'		=> array('element' => 'tooltip_text', 'not_empty' => true),
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'param_name'		=> 'tooltip_background',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Default tooltip background color is #404040;','dfd').'</span></span>'.esc_html__('Tooltip Background', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom no-bottom-padding',
								'dependency'		=> array('element' => 'tooltip_text', 'not_empty' => true),
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Box shadow settings', 'dfd'),
								'param_name'		=> 'shadow_heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group'				=> esc_html__('Style', 'dfd'),
								'dependency'		=> array('element' => 'hover_style', 'value_not_equal_to' => array('dfd-3d-rotate')),
							),
							array(
								'type'				=> 'dfd_box_shadow_param',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the shadow for the button','dfd').'</span></span>'.esc_html__('Box Shadow', 'dfd'),
								'param_name'		=> 'box_shadow',
								'group'				=> esc_html__('Style', 'dfd'),
								'dependency'		=> array('element' => 'hover_style', 'value_not_equal_to' => array('dfd-3d-rotate')),
							),
							array(
								'type'				=> 'dfd_box_shadow_param',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the shadow for the button on hover','dfd').'</span></span>'.esc_html__('Box Shadow on Hover', 'dfd'),
								'param_name'		=> 'hover_box_shadow',
								'group'				=> esc_html__('Style', 'dfd'),
								'dependency'		=> array('element' => 'hover_style', 'value_not_equal_to' => array('dfd-3d-rotate')),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Typography settings', 'dfd'),
								'param_name'		=> 'typography_heading',
								'group'				=> esc_html__('Typography', 'dfd'),
								'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type'				=> 'dfd_font_container_param',
								'param_name'		=> 'title_font_options',
								'settings'			=> array(
									'fields'			=> array(
										'font_size',
										'letter_spacing',
										'line_height',
										'font_style',
									),
								),
								'dependency'		=> array('element' => 'button_text', 'not_empty' => true),
								'group'				=> esc_html__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
								'param_name'		=> 'title_google_fonts',
								'options'			=> array(
									'yes'				=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd'),
									),
								),
								'dependency'		=> array('element' => 'button_text', 'not_empty' => true),
								'group'				=> esc_html__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'google_fonts',
								'param_name'		=> 'title_custom_fonts',
								'settings'			=> array(
									'fields'			=> array(
										'font_family_description' => esc_html__('Select font family.', 'dfd'),
										'font_style_description'  => esc_html__('Select font style.', 'dfd'),
									),
								),
								'dependency'		=> array('element' => 'title_google_fonts', 'value' => 'yes'),
								'edit_field_class'	=> 'no-top-margin vc_column vc_col-sm-12',
								'group'				=> esc_html__('Typography', 'dfd'),
							),
						),
					)
				);
			}
		}
		
		function button_gradient_form($atts, $content = null) {
			$main_style = $module_animation = $data_animation = $el_class = $button_size = $button_text = $tooltip_text = $alignment = $tooltip_alignment = '';
			$buttom_link_src = $button_class = $select_icon = $ic_fontawesome = $ic_openiconic = $ic_typicons = $ic_entypo = $ic_linecons = $icon_size = '';
			$title_font_options = $title_google_fonts = $title_custom_fonts = $output = $link_css = $buttom_link_attr = $icon_html = $button_text_html = $ic_dfd_icons = '';
			$padding_left = $padding_right = $text_color = $hover_text_color = $ic_color = $hover_ic_color = $direction_gradient = $background_from = $background_to = '';
			$hover_background_from = $hover_background_to = $border = $border_width = $border_color_from = $border_color_to = $tooltip_color = $tooltip_background = '';
			$box_shadow = $hover_box_shadow = $border_css = $border_color_from_hover = $border_color_to_hover = $border_radius = '';

			$atts = vc_map_get_attributes('button_gradient', $atts);
			extract( $atts );

			$uniqid = uniqid('dfd-button-gradient').'-'.rand(1,9999);

			if(!empty($module_animation)) {
				$data_animation .= ' data-animate="1"  data-animate-type="'.esc_attr($module_animation).'" ';
			}

			if(isset($hover_style) && $hover_style != '') {
				$button_class .= ' '.$hover_style;
			}

			if(isset($main_style) && !empty($main_style)) {
				$el_class .= ' '.$main_style;
			}
			if(isset($button_size) && !empty($button_size)) {
				$el_class .= ' '.$button_size;
			}
			if(isset($alignment) && !empty($alignment)) {
				$el_class .= ' '.$alignment;
			}

			if(isset($buttom_link_src) && !empty($buttom_link_src)) {
				$buttom_link_src = vc_build_link($buttom_link_src);

				if(isset($buttom_link_src['url']) && !empty($buttom_link_src['url'])) {
					$buttom_link_attr .= 'href="'.esc_attr($buttom_link_src['url']).'" ';
				}else{
					$buttom_link_attr .= 'href="#" ';
				}
				if(isset($buttom_link_src['title']) && !empty($buttom_link_src['title'])) {
					$buttom_link_attr .= 'title="'.esc_attr($buttom_link_src['title']).'" ';
				}
				if(isset($buttom_link_src['target']) && !empty($buttom_link_src['target'])) {
					$buttom_link_attr .= 'target="'.esc_attr(preg_replace('/\s+/', '', $buttom_link_src['target'])).'" ';
				}
				if(isset($buttom_link_src['rel']) && !empty($buttom_link_src['rel'])) {
					$buttom_link_attr .= 'rel="'.esc_attr($buttom_link_src['rel']).'"';
				}
			} else {
				$buttom_link_attr .= 'href="#" ';
			}

			if($icon_font != '') {
				$icon = 'icon_'.$icon_font;
				if(isset($$icon) || $$icon != '') {
					if($icon_font != 'dfd_icons')
						vc_icon_element_fonts_enqueue( $icon_font );
					
					$el_class .= ' with-icon';
					$icon_html = '<span class="icon-wrap"><i class="featured-icon '.esc_attr($$icon).'"></i></span>';
				}
			}

			if(isset($button_text) && !empty($button_text)) {
				$title_font_options = _crum_parse_text_shortcode_params( $title_font_options, '', $title_google_fonts, $title_custom_fonts );
				$button_text_html = '<span class="dfd-button-text-main" '.$title_font_options['style'].'>'.esc_html($button_text).'</span>';
			}

			if(isset($padding_left) && strcmp($padding_left, '') !== 0) {
				$link_css .= '#'.esc_js($uniqid).' .dfd-button-link .dfd-button-inner-cover {padding-left: '.esc_js($padding_left).'px;}';
			}
			if(isset($padding_right) && strcmp($padding_right, '') !== 0) {
				$link_css .= '#'.esc_js($uniqid).' .dfd-button-link .dfd-button-inner-cover {padding-right: '.esc_js($padding_right).'px;}';
			}

			/* Text */
			if(isset($text_color) && !empty($text_color)) {
				$link_css .= '#'.esc_js($uniqid).' .dfd-button-link:not(:hover),'
						. '#'.esc_js($uniqid).'.dfd-button-gradient-module-wrap .dfd-button-link.dfd-3d-rotate .dfd-button-inner-cover.front .dfd-button-text-main,'
						. '#'.esc_js($uniqid).'.dfd-button-gradient-module-wrap .dfd-button-link:not(:hover) .featured-icon {color: '.esc_js($text_color).';}';
			}
			if(isset($hover_text_color) && !empty($hover_text_color)) {
				$link_css .= '#'.esc_js($uniqid).' .dfd-button-link:hover,'
							. '#'.esc_js($uniqid).'.dfd-button-gradient-module-wrap .dfd-button-link.dfd-3d-rotate .dfd-button-inner-cover.back .dfd-button-text-main,'
							. '#'.esc_js($uniqid).'.dfd-button-gradient-module-wrap .dfd-button-link:hover .featured-icon  {color: '.esc_js($hover_text_color).';}';
			}
			/* Icon */
			if(isset($ic_color) && !empty($ic_color)) {
				$link_css .= '#'.esc_js($uniqid).' .dfd-button-link:not(:hover) .dfd-button-inner-cover .featured-icon {color: '.esc_js($ic_color).';}';
			}
			if(isset($hover_ic_color) && !empty($hover_ic_color)) {
				$link_css .= '#'.esc_js($uniqid).' .dfd-button-link:hover .dfd-button-inner-cover .featured-icon {color: '.esc_js($hover_ic_color).';}';
			}
			if(isset($icon_size) && !empty($icon_size)) {
				$link_css .= '#'.esc_js($uniqid).' .dfd-button-link .dfd-button-inner-cover .featured-icon {font-size: '.esc_js($icon_size).'px;}';
			}

			/* Background gradient */
			if(isset($background_from) && !empty($background_from) && isset($background_to) && !empty($background_to)) {
				$link_css .= '#'.esc_js($uniqid).' .dfd-button-link .dfd-button-inner-cover:before,'
							.'#'.esc_js($uniqid).'.dfd-button-gradient-module-wrap .dfd-button-link.dfd-fade .dfd-button-inner-cover:before {background: linear-gradient('.esc_js($direction_gradient).', '.esc_js($background_from).', '.esc_js($background_to).');}';
			}
			if(isset($hover_background_from) && !empty($hover_background_from) && isset($hover_background_to) && !empty($hover_background_to)) {
				$link_css .= '#'.esc_js($uniqid).' .dfd-button-link .dfd-button-inner-cover:after {background: linear-gradient('.esc_js($direction_gradient).', '.esc_js($hover_background_from).', '.esc_js($hover_background_to).');}';
			}

			/* Border gradient */
			if(isset($border_color_from) && !empty($border_color_from) && isset($border_color_to) && !empty($border_color_to)) {
				$link_css .= '#'.esc_js($uniqid).' .dfd-button-link .dfd-button-inner-cover .dfd-button-border:before {background: linear-gradient('.esc_js($direction_gradient).', '.esc_js($border_color_from).', '.esc_js($border_color_to).');}';
			}
			if(isset($border_color_from_hover) && !empty($border_color_from_hover) && isset($border_color_to_hover) && !empty($border_color_to_hover)) {
				$link_css .= '#'.esc_js($uniqid).' .dfd-button-link .dfd-button-inner-cover .dfd-button-border:after {background: linear-gradient('.esc_js($direction_gradient).', '.esc_js($border_color_from_hover).', '.esc_js($border_color_to_hover).');}';
			}
			if(isset($border_width) && $border_width != '') {
				$link_css .= '#'.esc_js($uniqid).' .dfd-button-link .dfd-button-inner-cover:before, #'.esc_js($uniqid).' .dfd-button-link .dfd-button-inner-cover:after {top: '.esc_js($border_width).'px; right: '.esc_js($border_width).'px; bottom: '.esc_js($border_width).'px; left: '.esc_js($border_width).'px;}';
			}
			if(isset($border_radius) && $border_radius != '') {
				$link_css .= '#'.esc_js($uniqid).' .dfd-button-link:hover, #'.esc_js($uniqid).' .dfd-button-link:hover .dfd-button-inner-cover, #'.esc_js($uniqid).' .dfd-button-link:not(:hover), #'.esc_js($uniqid).' .dfd-button-link:not(:hover) .dfd-button-inner-cover {border-radius: '.esc_js($border_radius).'px;}';
			}

			/* Tooltip */
			if(isset($tooltip_color) && !empty($tooltip_color)) {
				$link_css .= '#'.esc_js($uniqid).' .dfd-button-link .dfd-button-tooltip {color: '.esc_js($tooltip_color).';}';
			}
			if(isset($tooltip_background) && !empty($tooltip_background)) {
				$link_css .= '#'.esc_js($uniqid).' .dfd-button-link .dfd-button-tooltip {background: '.esc_js($tooltip_background).';}';
			}

			/* Shadow */
			if(substr_count($box_shadow, 'disable') == 0) {
				$box_shadow = Dfd_Box_Shadow_Param::box_shadow_css($box_shadow);
				$link_css .= '#'.esc_js($uniqid).' .dfd-button-link:not(:hover) {'.esc_attr($box_shadow).'}';
			}
			if(substr_count($hover_box_shadow, 'disable') == 0) {
				$hover_box_shadow = Dfd_Box_Shadow_Param::box_shadow_css($hover_box_shadow);
				$link_css .= '#'.esc_js($uniqid).' .dfd-button-link:hover {'.esc_attr($hover_box_shadow).'}';
			}

			$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-button-gradient-module-wrap">';

				$output .= '<div class="dfd-button-module '.esc_attr($el_class).'" '.$data_animation.'>';
					$output .= '<a '.$buttom_link_attr.' class="dfd-button-link '.esc_attr($button_class).'">';

						if(isset($hover_style) && $hover_style == 'dfd-3d-rotate') {
							$output .= '<span class="dfd-button-inner-rotator">';
							$output .= '<span class="dfd-button-inner-cover front">';
							$output .= $icon_html;
							$output .= $button_text_html;
							$output .= '<span class="dfd-button-border"></span>';
							$output .= '</span>';
							$output .= '<span class="dfd-button-inner-cover back">';
							$output .= $icon_html;
							$output .= $button_text_html;
							$output .= '<span class="dfd-button-border"></span>';
							$output .= '</span>';
							$output .= '</span>';
						} else {
							$output .= '<span class="dfd-button-inner-cover">';
							$output .= $icon_html;
							$output .= $button_text_html;
							$output .= '<span class="dfd-button-border"></span>';
							$output .= '</span>';
						}

						if(isset($tooltip_text) && !empty($tooltip_text)) {
							$output .= '<span class="dfd-button-tooltip '.esc_attr($tooltip_alignment).'">'.esc_html($tooltip_text).'</span>';
						}
					$output .= '</a>';
				$output .= '</div>';

					if($link_css != '') {
						$output .= '<script type="text/javascript">'
									. '(function($) {'
										. '$("head").append("<style>'.$link_css.'</style>");'
									. '})(jQuery);'
								. '</script>';
					}
			$output .= '</div>';

			return $output;
		}
	}
}

if ( class_exists( 'Dfd_Button_Gradient' ) ) {
	$Dfd_Button_Gradient = new Dfd_Button_Gradient;
}