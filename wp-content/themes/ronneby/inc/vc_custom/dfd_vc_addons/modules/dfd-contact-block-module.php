<?php //
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Clients Testimonials
*/
if(!class_exists('Dfd_Contact_Block')) {
	
	class Dfd_Contact_Block {
		function __construct(){
			add_action('init',array($this,'dfd_contact_block_init'));
			add_shortcode('dfd_contact_block', array($this,'dfd_contact_block_shortcode'));
		}
		function dfd_contact_block_init() {
			if(function_exists('vc_map')) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/contact_block/';
				vc_map(
					array(
					   'name'				=> esc_html__('Contact Block','dfd'),
					   'base'				=> 'dfd_contact_block',
					   'icon'				=> 'dfd_contact_block dfd_shortcode',
					   'category'			=> esc_html__('Ronneby 2.0','dfd'),
					   'description'		=> esc_html__('Display your contact info in block','dfd'),
					   'params'				=> array(
							array(
								'heading'			=> esc_html__( 'Style', 'dfd' ),
								'type'				=> 'radio_image_select',
								'param_name'		=> 'main_style',
								'simple_mode'		=> false,
								'options'			=> array(
									'style-1'	=> array(
										'tooltip'	=> esc_attr__('Simple','dfd'),
										'src'		=> $module_images . 'style-1.png'
									),
									'style-2'	=> array(
										'tooltip'	=> esc_attr__('Bordered','dfd'),
										'src'		=> $module_images . 'style-2.png'
									),
									'style-3'	=> array(
										'tooltip'	=> esc_attr__('Background','dfd'),
										'src'		=> $module_images . 'style-3.png'
									),
									'style-4'	=> array(
										'tooltip'	=> esc_attr__('Image','dfd'),
										'src'		=> $module_images . 'style-4.png'
									),
								),
							),
							array(
								'type'				=> 'textfield',
								'heading'	  => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
								'param_name'		=> 'el_class',
							),
							array(
								'type'				=> 'textfield',
								'heading'	  => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the postal address which will be shown in address field','dfd').'</span></span>'.esc_html__('Address', 'dfd'),
								'param_name'		=> 'fild_address',
								'value'				=> '',
								'admin_label'		=> true,
								'group'				=> esc_html__('Content', 'dfd')
							),
							array(
								'type'				=> 'textfield',
								'heading'	  => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the telephone number which will be shown in telephone field','dfd').'</span></span>'.esc_html__('Phone', 'dfd'),
								'param_name'		=> 'fild_phone',
								'value'				=> '',
								'group'				=> esc_html__('Content', 'dfd')
							),
							array(
								'type'				=> 'textfield',
								'heading'	  => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the email address which will be shown in email field','dfd').'</span></span>'.esc_html__('Email', 'dfd'),
								'param_name'		=> 'fild_email',
								'value'				=> '',
								'group'				=> esc_html__('Content', 'dfd')
							),
							array(
								'type'				=> 'textfield',
								'heading'	  => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the website address which will be shown in website field','dfd').'</span></span>'.esc_html__('Website', 'dfd'),
								'param_name'		=> 'fild_website',
								'value'				=> '',
								'group'				=> esc_html__('Content', 'dfd')
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Icon decoration', 'dfd'),
								'param_name'		=> 'field_and_button_styles',
								'class'				=> 'ult-param-heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
								'group'				=> esc_html__('Decoration', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to specify the size for the icon. The default size is 36px. The min icon size is 10, the max icon size is 50px.','dfd').'</span></span>'.esc_html__('Icon size', 'dfd'),
								'param_name'		=> 'icon_size',
								'value'				=> '',
								'min'				=> 10,
								'max'				=> 50,
								'group'				=> esc_html__('Decoration', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the size of the icon\'s thumbnail. Max size is 60px. The default value is 40px','dfd').'</span></span>'.esc_html__('Thumb Size', 'dfd'),
								'param_name'		=> 'thumb_size',
								'value'				=> '40',
								'min'				=> 25,
								'max'				=> 60,
								'group'				=> esc_html__('Decoration', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
								'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-1', 'style-2' ) ),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the background color for the icon\'s thumbnail. The default value is inherited from Theme Options > Styling options > Third site color','dfd').'</span></span>'.esc_html__('Icon background', 'dfd'),
								'param_name'		=> 'icon_background_color',
								'value'				=> '',
								'group'				=> esc_html__('Decoration', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
								'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-1', 'style-2' ) ),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the color of your icons. The default value is #fff. For the style Background the icon color is inherited from Theme Options > Styling options > Default title color.','dfd').'</span></span>'.esc_html__('Icon color', 'dfd'),
								'param_name'		=> 'icon_color',
								'value'				=> '',
								'group'				=> esc_html__('Decoration', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the border radius of the icon\'s thumbnail. Max value is 60px','dfd').'</span></span>'.esc_html__('Border Radius', 'dfd'),
								'param_name'		=> 'icon_border_radius',
								'value'				=> '',
								'min'				=> 0,
								'max'				=> 60,
								'group'				=> esc_html__('Decoration', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
								'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-1', 'style-2' ) ),
							),
							array(
								'type'				=> 'dropdown',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose one of the border styles for the icon\'s thumbnail','dfd').'</span></span>'.esc_html__('Thumb Border Style', 'dfd'),
								'param_name'		=> 'icon_border_style',
								'value'				=> array(
									esc_html__('None','dfd')	=> 'none',
									esc_html__('Solid','dfd')	=> 'solid',
									esc_html__('Dashed','dfd')	=> 'dashed',
									esc_html__('Dotted','dfd')	=> 'dotted',
									esc_html__('Double','dfd')	=> 'double',
									esc_html__('Inset','dfd')	=> 'inset',
									esc_html__('Outset','dfd')	=> 'outset',
								),
								'group'				=> esc_html__('Decoration', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
								'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-1', 'style-2' ) ),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose border width for the icon\'s thumbnail.','dfd').'</span></span>'.esc_html__('Thumb Border width', 'dfd'),
								'param_name'		=> 'icon_border_width',
								'value'				=> '',
								'min'				=> 1,
								'max'				=> 10,
								'edit_field_class'	=> 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
								'group'				=> esc_html__('Decoration', 'dfd'),
								'dependency'		=> array('element' => 'icon_border_style', 'value' => array('solid', 'dashed', 'dotted', 'double', 'inset', 'outset')),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose border color for the icon\'s thumbnail','dfd').'</span></span>'.esc_html__('Thumb Border color', 'dfd'),
								'param_name'		=> 'icon_border_color',
								'value'				=> '',
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
								'group'				=> esc_html__('Decoration', 'dfd'),
								'dependency'		=> array('element' => 'icon_border_style', 'value' => array('solid', 'dashed', 'dotted', 'double', 'inset', 'outset')),
							),
							array(
								'type'				=> 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to disable the delimiter between the contact block info','dfd').'</span></span>'.esc_html__( 'Disable Delimiter', 'dfd' ),
								'param_name'		=> 'disable_delimiter',
								'value'				=> '',
								'options'			=> array(
									'yes'			=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd')
									),
								),
								'group'				=> esc_html__('Decoration', 'dfd'),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('General decoration', 'dfd'),
								'param_name'		=> 'general_border_styles',
								'class'				=> 'ult-param-heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group'				=> esc_html__('Decoration', 'dfd'),
								'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-2' ) ),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the border radius of the contact block. Max value is 100px','dfd').'</span></span>'.esc_html__('Border Radius', 'dfd'),
								'param_name'		=> 'main_border_radius',
								'value'				=> '',
								'min'				=> 0,
								'max'				=> 100,
								'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group'				=> esc_html__('Decoration', 'dfd'),
								'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-2', 'style-3', 'style-4' ) ),
							),
							array(
								'type'				=> 'dropdown',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose one of the border styles for the contact block','dfd').'</span></span>'.esc_html__('Border Style', 'dfd'),
								'param_name'		=> 'general_border_style',
								'value'				=> array(
									esc_html__('Solid','dfd')	=> 'solid',
									esc_html__('Dashed','dfd')	=> 'dashed',
									esc_html__('Dotted','dfd')	=> 'dotted',
									esc_html__('Double','dfd')	=> 'double',
									esc_html__('Inset','dfd')	=> 'inset',
									esc_html__('Outset','dfd')	=> 'outset',
								),
								'group'				=> esc_html__('Decoration', 'dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
								'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-2' ) ),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose border width for the contact block','dfd').'</span></span>'.esc_html__('Border width', 'dfd'),
								'param_name'		=> 'general_border_width',
								'value'				=> '',
								'min'				=> 1,
								'max'				=> 10,
								'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group'				=> esc_html__('Decoration', 'dfd'),
								'dependency'		=> array('element' => 'general_border_style', 'value' => array('solid', 'dashed', 'dotted', 'double', 'inset', 'outset')),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose border color for the contact block. The default color for the style Bordered is inherited from  Theme options > Styling options > Default border color','dfd').'</span></span>'.esc_html__('Border color', 'dfd'),
								'param_name'		=> 'general_border_color',
								'value'				=> '',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
								'group'				=> esc_html__('Decoration', 'dfd'),
								'dependency'		=> array('element' => 'general_border_style', 'value' => array('solid', 'dashed', 'dotted', 'double', 'inset', 'outset')),
							),
							array(
								'type'				=> 'attach_image',
								'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the custom image which should be set as contact block background from media library','dfd').'</span></span>'.esc_html__('Background Image', 'dfd'),
								'param_name'		=> 'background_image',
								'value'				=> '',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
								'group'				=> esc_html__('Decoration', 'dfd'),
								'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-4' ) ),
							),
							array(
								'type'				=> 'dropdown',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to enable or disable the repeating of the image you\'ve set as background for the contact block','dfd').'</span></span>'.__('Background Image Repeat', 'dfd'),
								'param_name'		=> 'background_image_repeat',
								'value'				=> array(
									esc_html__('No Repeat', 'dfd')	=> 'no-repeat',
									esc_html__('Repeat', 'dfd')		=> 'repeat',
									esc_html__('Repeat X', 'dfd')	=> 'repeat-x',
									esc_html__('Repeat Y', 'dfd')	=> 'repeat-y',
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
								'group'				=> esc_html__('Decoration', 'dfd'),
								'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-4' ) ),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the background color for the contact block. The default value is inherited from Theme Options > Styling options > Third site color','dfd').'</span></span>'.esc_html__('background Color', 'dfd'),
								'param_name'		=> 'background_color',
								'value'				=> '',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
								'group'				=> esc_html__('Decoration', 'dfd'),
								'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-3', 'style-4' ) ),
							),
							array(
								'type'				=> 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enable this option if you\'ve set light background color. The text color will be changed to make the text more readable','dfd').'</span></span>'.esc_html__('light background', 'dfd'),
								'param_name'		=> 'background_check',
								'value'				=> '',
								'options'			=> array(
									'yes'			=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd')
									),
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-margin crum_vc',
								'group'				=> esc_html__('Decoration', 'dfd'),
								'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-3', 'style-4' ) ),
							),
							array(
								'type'				=> 'dropdown',
								'heading'	 => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd').'</span></span>'.esc_html__('Animation', 'dfd'),
								'param_name'		=> 'module_animation',
								'value'				=> dfd_module_animation_styles(),
								'description'		=> esc_html__( '', 'dfd' ),
								'group'				=> esc_html__('Animation Settings', 'dfd'),
							),
						),
					)
				);
			}
		}
		// Shortcode handler function
		function dfd_contact_block_shortcode($atts) {
			$main_style = $background_color = $background_image = $background_check = $el_class = $fild_address = $fild_phone = $fild_email = $fild_website = '';
			$module_animation = $animate = $animation_data = $output = $filds = $fild_html = $icon = $class_item = $bg_class = $bg_image_src = $bg_image = $bg_style = '';
			$icon_size = $thumb_size = $icon_background_color = $icon_color = $icon_border_radius = $icon_border_style = $icon_border_width = $icon_style = '';
			$icon_border_color = $main_border_radius = $general_css = $delim_html = $half_thumb_size = $block_margin_left_style = $disable_delimiter = $fild_name_css = '';
			$general_border_style = $general_border_width = $general_border_color = $margin_offset = $size_margin_left = $fild_email_html = $fild_website_html = '';
			$background_mask_html = $background_mask_css = $background_image_repeat = $delim_css = $delim_left = $delim_distance = $delim_ofset = '';
			$address_var = $phones_var = $email_var = $website_var = '';
			
			extract(shortcode_atts( array(
				'main_style' => 'style-1',
				'background_color' => '',
				'background_image' => '',
				'background_image_repeat' => 'no-repeat',
				'background_check' => '',
				'el_class' => '',
				'fild_address' => '',
				'fild_phone' => '',
				'fild_email' => '',
				'fild_website' => '',
				'icon_size' => '',
				'thumb_size' => '40',
				'icon_background_color' => '',
				'icon_color' => '',
				'icon_border_radius' => '',
				'icon_border_style' => '',
				'icon_border_width' => '',
				'icon_border_color' => '',
				'disable_delimiter' => '',
				'main_border_radius' => '',
				'general_border_style' => 'solid',
				'general_border_width' => '',
				'general_border_color' => '',
				'module_animation' => ''
			),$atts));
			
			if (isset($fild_email) && !empty($fild_email)) {
				$fild_email_html = '<a href="mailto:'.esc_attr($fild_email).'">'.esc_attr($fild_email).'</a>';
			}
			if (isset($fild_website) && !empty($fild_website)) {
				$fild_website_html = '<a href="'.esc_attr($fild_website).'" target="_blank">'.esc_attr($fild_website).'</a>';
			}
			
			$address_var	= __('address', 'dfd');
			$phones_var		= __('phone', 'dfd');
			$email_var		= __('email', 'dfd');
			$website_var	= __('website', 'dfd');
			$filds = array (
				$address_var	=> $fild_address,
				$phones_var		=> $fild_phone,
				$email_var		=> $fild_email_html,
				$website_var	=> $fild_website_html
			);
			$icon = array (
				$address_var	=> 'dfd-icon-navigation',
				$phones_var		=> 'dfd-icon-tablet2',
				$email_var		=> 'dfd-icon-email_1',
				$website_var	=> 'dfd-icon-earth'
			);
			
			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			$icon_style .= 'style="';
			$general_css .= 'style="';
			$fild_name_css .= 'style="';
			$delim_css .= 'style="';
			
			if (isset($icon_size) && !empty($icon_size)) {
				$icon_style .= 'font-size: '.esc_attr($icon_size).'px; ';
			}
			if(isset($main_style) && strcmp($main_style, 'style-1') === 0 || strcmp($main_style, 'style-2') === 0) {
				if (isset($thumb_size) && !empty($thumb_size)) {
					$icon_style .= 'width: '.esc_attr($thumb_size).'px; ';
					$icon_style .= 'height: '.esc_attr($thumb_size).'px; ';
					$delim_distance = esc_attr($thumb_size);
					$half_thumb_size = esc_attr($thumb_size)/2;
				}
			}
			if (isset($icon_background_color) && !empty($icon_background_color)) {
				$icon_style .= 'background: '.esc_attr($icon_background_color).'; ';
			}
			if (isset($icon_color) && !empty($icon_color)) {
				$icon_style .= 'color: '.esc_attr($icon_color).'; ';
			}
			if ((isset($icon_border_radius) && !empty($icon_border_radius)) || strcmp($icon_border_radius, '0') === 0) {
				$icon_style .= 'border-radius: '.esc_attr($icon_border_radius).'px; ';
			}
			if(isset($icon_border_style) && strcmp($icon_border_style, 'none') !== 0) {
				if ( $icon_border_style || $icon_border_width || $icon_border_color ) {
					if ($icon_border_style) {
						$icon_style .= 'border-style: '.esc_attr($icon_border_style).'; ';
					}
					if ($icon_border_width) {
						$icon_style .= 'border-width: '.esc_attr($icon_border_width).'px; ';
						$delim_ofset = esc_attr($icon_border_width);
					}
					if ($icon_border_color) {
						$icon_style .= 'border-color: '.esc_attr($icon_border_color).'; ';
					}
				}
			}
			
			if(isset($main_style) && strcmp($main_style, 'style-3') === 0 || strcmp($main_style, 'style-4') === 0) {
				if($background_check !== 'yes') {
					$bg_class = 'dfd-background-dark';
				}
			}
			
			$bg_image_src = wp_get_attachment_image_src( $background_image, 'full' );
			if ( isset( $bg_image_src[0] ) && $bg_image_src[0] != '' ) {
				$bg_image = dfd_aq_resize( $bg_image_src[0], true, true, false, true, false );
				if ( ! $bg_image ) {
					$bg_image = $bg_image_src[0];
				}
				$general_css .= 'background-image: url('.esc_url($bg_image).'); ';
			}
			if(isset($background_image_repeat) && strcmp($background_image_repeat, 'no-repeat') !== 0 ) {
				$general_css .= 'background-repeat: '.esc_attr($background_image_repeat).' ;';
			}
			if(isset($background_color) && !empty($background_color)) {
				$general_css .= 'background-color: '.  esc_attr($background_color).'; ';
			}
			if((isset($main_border_radius) && !empty($main_border_radius)) || strcmp($main_border_radius, '0') === 0) {
				$general_css .= 'border-radius: '.esc_attr($main_border_radius).'px; ';
			}
			if(isset($main_style) && strcmp($main_style, 'style-2') === 0) {
				if(isset($general_border_style) && !empty($general_border_style)) {
					if ( $general_border_style || $general_border_width || $general_border_color ) {
						if ($general_border_style) {
							$general_css .= 'border-style: '.esc_attr($general_border_style).'; ';
						}
						if ($general_border_width) {
							$margin_offset = esc_attr($general_border_width)/2;
							$general_css .= 'border-width: '.esc_attr($general_border_width).'px; ';
						}
						if ($general_border_color) {
							$general_css .= 'border-color: '.esc_attr($general_border_color).'; ';
						}
					}
				}
				$size_margin_left = esc_attr($half_thumb_size) + esc_attr($margin_offset);
				if(!empty($thumb_size) || !empty($general_border_width)){
					$block_margin_left_style = 'style="margin-left: -'.$size_margin_left.'px;"';
					$general_css .= 'margin-left: '.$size_margin_left.'px; ';
				}
			}
			if(isset($main_style) && strcmp($main_style, 'style-1') === 0 || strcmp($main_style, 'style-3') === 0) {
			}
			
			$delim_left = esc_attr($delim_distance) - esc_attr($delim_ofset);
			if(isset($main_style) && strcmp($main_style, 'style-1') === 0 || strcmp($main_style, 'style-2') === 0) {
				$delim_css .= 'left: '.$delim_left.'px ;';
				if(isset($thumb_size) && !empty($thumb_size)) {
					$fild_name_css .= 'height: '.esc_attr($half_thumb_size).'px; ';
				}
			}
			
			$fild_name_css .= '"';
			$general_css .= '"';
			$icon_style .= '"';
			$delim_css .= '"';
			if($disable_delimiter !== 'yes') {
				$delim_html = '<span class="delimiter" '.$delim_css.'></span>';
			}
			
			$output .= '<div class="dfd-contact-block-container '.esc_attr($main_style).' '.esc_attr($bg_class).' '.esc_attr($el_class).' '.esc_attr($animate).'" '.$animation_data.' '.$general_css.'>';
				$output .= '<div class="dfd-contact-block-module" '.$block_margin_left_style.'>';

					foreach($filds as $key => $value){
						if(isset($value) && !empty($value)){
							if(key_exists($key, $icon)){
								$class_item = $icon[$key];
							};
							$fild_html .= '
							<div class="fild-content">
								<i class="'.$class_item.'" '.$icon_style.'>'.$delim_html.'</i>
								<div class="fild-name" '.$fild_name_css.'>'.$key.':</div>
								<p class="'.$key.'">'.$value.'</p>
							</div>';
						}
					}
					$output .= $fild_html;

				$output .= '</div>';
			$output .= '</div>';
			
			return $output;
		}
	}
}
if(class_exists('Dfd_Contact_Block')) {
	$Dfd_Contact_Block = new Dfd_Contact_Block;
}