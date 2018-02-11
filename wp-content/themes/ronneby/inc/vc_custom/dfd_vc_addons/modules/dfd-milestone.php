<?php
if(!defined('ABSPATH')) {exit;}
/*
* Add-on Name: Milestone
*/

if(!class_exists('Dfd_Milestone')) {
	class Dfd_Milestone {
		function __construct() {
			add_action( 'init', array( $this, 'dfd_milestone_init' ) );
			add_shortcode( 'dfd_milestone', array( $this, 'dfd_milestone_shortcode' ) );
		}
		
		function dfd_milestone_init() {
			if ( function_exists( 'vc_map' ) ) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/milestone/';
				vc_map(
					array(
						'name'					=> esc_html__('Milestone', 'dfd'),
						'base'					=> 'dfd_milestone',
						'icon'					=> 'dfd_milestone dfd_shortcode',
						'category'				=> esc_html__('Ronneby 2.0', 'dfd'),
						'params'				=> array(
							array(
								'heading'			=> esc_html__('Style', 'dfd'),
								'type'				=> 'radio_image_select',
								'param_name'		=> 'main_style',
								'simple_mode'		=> false,
								'options'			=> array(
									'style-1'			=> array(
										'tooltip'			=> esc_attr__('Simple','dfd'),
										'src'				=> $module_images.'style-1.png'
									),
									'style-2'			=> array(
										'tooltip'			=> esc_attr__('Left align','dfd'),
										'src'				=> $module_images.'style-2.png'
									),
									'style-3'			=> array(
										'tooltip'			=> esc_attr__('Right align','dfd'),
										'src'				=> $module_images.'style-3.png'
									),
								),
							),
							array(
								'type'				=> 'dfd_radio_advanced',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Please, select width of the elements according to the width of the container','dfd').'</span></span>'.esc_html__('Element width', 'dfd'),
								'param_name'		=> 'columns_width',
								'value'				=> 'one-third-width-elements',
								'options'			=> array(
									esc_html__('Full width', 'dfd')		=> 'full-width-elements',
									esc_html__('Half size', 'dfd')		=> 'half-size-elements',
									esc_html__('Third size', 'dfd')		=> 'one-third-width-elements',
									esc_html__('Quarter size', 'dfd')	=> 'quarter-width-elements',
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc',
								'dependency'		=> array('element' => 'main_style', 'value' => array('style-1')),
							),
							array(
								'type'				=> 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to show the description only when you hover over the element','dfd').'</span></span>'.esc_html__('Description only on hover', 'dfd'),
								'param_name'		=> 'content_only_hover',
								'value'				=> 'only_hover',
								'options'			=> array(
									'only_hover'		=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc no-border-bottom',
							),
							array(
								'type'				=> 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to have the delimiter not only between the items, but also from the left and right sides for the style Simple. The delimeter will be set at the top and bottom for the styles Left align and Right align','dfd').'</span></span>'.esc_html__('Side delimeter', 'dfd'),
								'param_name'		=> 'side_delimeter',
								'options'			=> array(
									'enable'		=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc no-border-bottom',
							),
							array(
								'type'				=> 'dfd_radio_advanced',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the content alignment according to the icon','dfd').'</span></span>'.esc_html__('Content alignment', 'dfd'),
								'param_name'		=> 'centred_content_alignment',
								'value'				=> 'middle',
								'options'			=> array(
									esc_html__('Middle', 'dfd')	=> 'middle',
									esc_html__('Top', 'dfd')	=> 'top',
								),
								'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc',
								'dependency'		=> array('element' => 'main_style', 'value' => array('style-2', 'style-3')),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Extra features', 'dfd' ),
								'param_name'       => 'extra_features_elements_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type'				=> 'dropdown',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd').'</span></span>'.esc_html__('Animation', 'dfd'),
								'param_name'		=> 'module_animation',
								'value'				=> dfd_module_animation_styles(),
							),
							array(
								'type'				=> 'textfield',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
								'param_name'		=> 'el_class',
							),
//							array(
//								'type' => 'dfd_video_link_param',
//								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd') . '</span></span>' . esc_html__('Tutorials', 'dfd'),
//								'param_name' => 'tutorials',
//								'doc_link' => '//nativewptheme.net/support/visual-composer/milestone',
//								'video_link' => 'https://www.youtube.com/watch?v=W0nJrydHnQM&feature=youtu.be',
//							),
							array(
								'type'				=> 'param_group',
								'heading'			=> esc_html__('List content', 'dfd'),
								'param_name'		=> 'list_fields',
								'value'				=> '',
								'group'				=> esc_html__('Content', 'dfd'),
								'params'			=> array(
									array(
										'type'			=> 'dfd_radio_advanced',
										'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Use the existing icon font, upload custom image or add the text','dfd').'</span></span>'.esc_html__('Icon to display', 'dfd'),
										'param_name'	=> 'icon_type',
										'value'			=> 'selector',
										'options'		=> array(
											esc_html__('Icon','dfd')	=> 'selector',
											esc_html__('Image','dfd')	=> 'custom',
											esc_html__('Text', 'dfd')	=> 'text',
										),
									),
									array(
										'type'			=> 'iconpicker',
										'heading'		=> esc_html__('Select Icon ', 'dfd'),
										'param_name'	=> 'icon',
										'value'			=> '',
										'settings'		=> array(
											'emptyIcon'		=> false,
											'type'			=> 'dfd_icons',
											'iconsPerPage'	=> 4000,
										),
									),
									array(
										'type'			=> 'attach_image',
										'heading'		=> esc_html__('Upload Image', 'dfd'),
										'param_name'	=> 'icon_image_id',
										'dependency'	=> array('element' => 'icon_type','value' => array('custom')),
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Text', 'dfd'),
										'param_name'	=> 'icon_text',
										'dependency'	=> array('element' => 'icon_type', 'value' => array('text')),
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Title', 'dfd'),
										'param_name'	=> 'block_title',
										'admin_label'	=> true,
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Subtitle', 'dfd'),
										'param_name'	=> 'block_subtitle',
										'admin_label'	=> true,
									),
									array(
										'type'			=> 'textarea',
										'heading'		=> esc_html__('Description','dfd'),
										'param_name'	=> 'block_content',
									),
								),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the size for the icon placed in the milestone element','dfd').'</span></span>'.esc_html__('Icon size', 'dfd'),
								'param_name'		=> 'icon_size',
								'value'				=> 27,
								'edit_field_class'	=> 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the icon. The default icon color is #fff','dfd').'</span></span>'.esc_html__('Icon color', 'dfd'),
								'param_name'		=> 'icon_color',
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc no-top-padding',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the hover color for the icon. The default value is inherited from Theme Options > Styling Options > Main site color','dfd').'</span></span>'.esc_html__('Icon hover color', 'dfd'),
								'param_name'		=> 'icon_hover_color',
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc no-top-padding',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the background size for the icon','dfd').'</span></span>'.esc_html__('Icon background size', 'dfd'),
								'param_name'		=> 'icon_bg_size',
								'value'				=> 70,
								'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the border radius for the icon\'s background','dfd').'</span></span>'.esc_html__('Border radius', 'dfd'),
								'param_name'		=> 'border_radius',
								'value'				=> 35,
								'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border color for the icon. The default value is inherited from Theme Options > Styling Options > Main site color','dfd').'</span></span>'.esc_html__('Border color', 'dfd'),
								'param_name'		=> 'border_color',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border hover color for the icon. The default value is inherited from Theme Options > Styling Options > Main site color','dfd').'</span></span>'.esc_html__('Border hover color', 'dfd'),
								'param_name'		=> 'hover_border_color',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the icon. The default value is inherited from Theme Options > Styling Options > Main site color','dfd').'</span></span>'.esc_html__('Icon background color', 'dfd'),
								'param_name'		=> 'background_color',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon hover background color. The default color is transparent','dfd').'</span></span>'.esc_html__('Icon hover background color', 'dfd'),
								'param_name'		=> 'hover_background_color',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the space between the milestone elements','dfd').'</span></span>'.esc_html__('Space between blocks', 'dfd'),
								'param_name'		=> 'item_offset',
								'value'				=> 50,
								'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom',
								'dependency'		=> array('element' => 'main_style', 'value' => array('style-2', 'style-3')),
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the delimiter color. The default delimiter color is #e7e7e7','dfd').'</span></span>'.esc_html__('Delimeter color', 'dfd'),
								'param_name'		=> 'connector_color',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Title Typography', 'dfd'),
								'param_name'		=> 'title_t_heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
								'group'				=> esc_attr__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'dfd_font_container_param',
								'param_name'		=> 'title_font_options',
								'settings'			=> array(
									'fields'			=> array(
										'tag'				=> 'div',
										'font_size',
										'letter_spacing',
										'line_height',
										'color',
										'font_style'
									),
								),
								'group'				=> esc_attr__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
								'param_name'		=> 'use_google_fonts',
								'options'			=> array(
									'yes'				=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd'),
									),
								),
								'group'				=> esc_html__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'google_fonts',
								'param_name'		=> 'custom_fonts',
								'settings'			=> array(
									'fields'			=> array(
										'font_family_description' => esc_html__('Select font family.', 'dfd'),
										'font_style_description'  => esc_html__('Select font style.', 'dfd'),
									),
								),
								'dependency' => array('element' => 'use_google_fonts', 'value' => 'yes'),
								'group'				=> esc_attr__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Subtitle Typography', 'dfd'),
								'param_name'		=> 'subtitle_t_heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group'				=> esc_html__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'dfd_font_container_param',
								'param_name'		=> 'subtitle_font_options',
								'settings'			=> array(
									'fields'			=> array(
										'tag'				=> 'div',
										'font_size',
										'letter_spacing',
										'line_height',
										'color',
										'font_style'
									),
								),
								'group'				=> esc_html__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Content Typography', 'dfd'),
								'param_name'		=> 'content_t_heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group'				=> esc_attr__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'dfd_font_container_param',
								'param_name'		=> 'font_options',
								'settings'			=> array(
									'fields'			=> array(
										'font_size',
										'letter_spacing',
										'line_height',
										'color',
										'font_style'
									),
								),
								'group'				=> esc_attr__('Typography', 'dfd'),
							),
						),
					)
				);
			}
		}
		
		function dfd_milestone_shortcode( $atts ) {
			$main_style = $module_animation = $animation_data = $el_class = $columns_width = $list_class = $decor_html = $text_html = $title_options = $title_font_options = '';
			$uniqid = $use_google_fonts = $custom_fonts = $subtitle_options = $subtitle_font_options = $content_font_options = $font_options = $content_style = $link_css = '';
			$list_fields = $output = $icon_type = $icon = $ic_fontawesome = $ic_openiconic = $content_only_hover = $icon_hover_color = $centred_content_alignment = '';
			$block_title = $block_subtitle = $block_content = $icon_size = $icon_color = $connector_color = $icon_bg_size = $border_radius = $border_color = '';
			$hover_border_color = $background_color = $hover_background_color = $item_offset = $side_delimeter = '';

			$atts = vc_map_get_attributes('dfd_milestone', $atts);
			extract($atts);

			$uniqid = uniqid('dfd-milestone-').'-'.rand(1,9999);

			$el_class .= ' '.$main_style;

			if(!($module_animation == '')) {
				$el_class .= ' cr-animate-gen';
				$animation_data = 'data-animate-item=".dfd-milestone-item" data-animate-type = "'.esc_attr($module_animation).'"';
			}
			if(isset($content_only_hover) && strcmp($content_only_hover, 'only_hover') == 0) {
				$el_class .= ' content-only-hover';
			}
			if (isset($side_delimeter) && $side_delimeter == 'enable') {
				$el_class .= ' side-delimeter';
			}
			if (isset($centred_content_alignment) && $centred_content_alignment == 'top') {
				$el_class .= ' dfd-milestone-content-top';
			}

			if(isset($main_style) && strcmp($main_style, 'style-1') == 0 && isset($columns_width) && strcmp($columns_width, '') !== 0) {
				$list_class .= $columns_width;
			}

			$title_options = _crum_parse_text_shortcode_params($title_font_options, 'feature-title', $use_google_fonts, $custom_fonts);
			$subtitle_options = _crum_parse_text_shortcode_params($subtitle_font_options, 'subtitle');
			$content_font_options = _crum_parse_text_shortcode_params($font_options);
			$content_style = $content_font_options['style'];

			if(isset($icon_size) && !empty($icon_size)) {
				$link_css .= '#'.esc_js($uniqid).' .dfd-milestone-item .icon-wrap {font-size: '.esc_js($icon_size).'px;}';
			}
			if(isset($icon_color) && !empty($icon_color)) {
				$link_css .= '#'.esc_js($uniqid).' .dfd-milestone-item .icon-wrap {color: '.esc_js($icon_color).';}';
			}
			if(isset($icon_hover_color) && !empty($icon_hover_color)) {
				$link_css .= '#'.esc_js($uniqid).' .dfd-milestone-item:hover .icon-wrap {color: '.esc_js($icon_hover_color).';}';
			}
			if(isset($icon_bg_size) && !empty($icon_bg_size)) {
				$link_css .= '#'.esc_js($uniqid).'.style-1 .dfd-milestone-item .icon-centered-container, #'.esc_js($uniqid).'.style-2 .dfd-milestone-item .icon-wrap, #'.esc_js($uniqid).'.style-3 .dfd-milestone-item .icon-wrap {width: '.esc_js($icon_bg_size).'px; height: '.esc_js($icon_bg_size).'px; line-height: '.esc_js($icon_bg_size).'px;}';
				if(is_rtl()) {
					$link_css .= '#'.esc_js($uniqid).'.style-1 .icon-wrap:before {left: '.esc_js($icon_bg_size).'px;}';
					$link_css .= '#'.esc_js($uniqid).'.style-1 .icon-wrap:after {right: '.esc_js($icon_bg_size).'px;}';
				} else {
					$link_css .= '#'.esc_js($uniqid).'.style-1 .icon-wrap:before {right: '.esc_js($icon_bg_size).'px;}';
					$link_css .= '#'.esc_js($uniqid).'.style-1 .icon-wrap:after {left: '.esc_js($icon_bg_size).'px;}';
				}
				$link_css .= '#'.esc_js($uniqid).'.style-2 .icon-wrap:before, #'.esc_js($uniqid).'.style-3 .icon-wrap:before {bottom: '.esc_js($icon_bg_size).'px;}';
				$link_css .= '#'.esc_js($uniqid).'.style-2 .icon-wrap:after, #'.esc_js($uniqid).'.style-3 .icon-wrap:after {top: '.esc_js($icon_bg_size).'px;}';
				$link_css .= '#'.esc_js($uniqid).'.style-2 .content-wrap {margin-left: '.esc_js($icon_bg_size + 25).'px;}';
				$link_css .= '#'.esc_js($uniqid).'.style-3 .content-wrap {margin-right: '.esc_js($icon_bg_size + 25).'px;}';
				$link_css .= '#'.esc_js($uniqid).'.style-2 .icon-wrap, #'.esc_js($uniqid).'.style-3 .icon-wrap {margin-top: -'.esc_js($icon_bg_size / 2).'px;}';
				$link_css .= '#'.esc_js($uniqid).'.style-2 .icon-centered-container, #'.esc_js($uniqid).'.style-3 .icon-centered-container {min-height: '.esc_js($icon_bg_size).'px;}';
			}
			if(isset($border_radius) && !empty($border_radius) || strcmp($border_radius, 0) === 0) {
				$link_css .= '#'.esc_js($uniqid).' .icon-decoration {border-radius: '.esc_js($border_radius).'px;}';
			}
			if(isset($border_color) && !empty($border_color)) {
				$link_css .= '#'.esc_js($uniqid).' .dfd-milestone-item .icon-decoration:before {border-color: '.esc_js($border_color).';}';
			}
			if(isset($hover_border_color) && !empty($hover_border_color)) {
				$link_css .= '#'.esc_js($uniqid).' .dfd-milestone-item:hover .icon-decoration:before {border-color: '.esc_js($hover_border_color).';}';
			}
			if(isset($background_color) && !empty($background_color)) {
				$link_css .= '#'.esc_js($uniqid).' .dfd-milestone-item .icon-decoration:before {background: '.esc_js($background_color).';}';
			}
			if(isset($hover_background_color) && !empty($hover_background_color)) {
				$link_css .= '#'.esc_js($uniqid).' .dfd-milestone-item:hover .icon-decoration:before {background: '.esc_js($hover_background_color).';}';
			}
			if(isset($connector_color) && !empty($connector_color)) {
				$link_css .= '#'.esc_js($uniqid).' .icon-wrap:before, #'.esc_js($uniqid).' .icon-wrap:after {background: '.esc_js($connector_color).';}';
			}
			if(isset($item_offset) && strcmp($item_offset, '') != 0) {
				$link_css .= '#'.esc_js($uniqid).'.style-2 .dfd-milestone-item, #'.esc_js($uniqid).'.style-3 .dfd-milestone-item {padding: '.esc_js($item_offset / 2).'px 0;}';
			}

			$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-milestone-wrap '.esc_attr($el_class).'" '.$animation_data.'>';
				if(isset($list_fields) && !empty($list_fields) && function_exists('vc_param_group_parse_atts')) {
					$list_fields = (array) vc_param_group_parse_atts($list_fields);

					$output .= '<ul class="dfd-milestone-list clearfix '.esc_attr($list_class).'">';

						foreach($list_fields as $fields) {
							$title_html = $subtitle_html = $content_html = $icon_html = '';
							if(isset($fields['block_title']) && !empty($fields['block_title'])) {
								$title_html = '<'.$title_options['tag'].' class="'.$title_options['class'].'" '.$title_options['style'].'>'.(strip_tags($fields['block_title'], "<br><br/>")).'</'.$title_options['tag'].'>';
							}
							if(isset($fields['block_subtitle']) && !empty($fields['block_subtitle'])) {
								$subtitle_html = '<'.$subtitle_options['tag'].' class="grad-millestone-subtitle '.$subtitle_options['class'].'" '.$subtitle_options['style'].'>'.(strip_tags($fields['block_subtitle'], "<br><br/>")).'</'.$subtitle_options['tag'].'>';
							}
							if(isset($fields['block_content']) && !empty($fields['block_content'])) {
								$content_html = '<div class="description" '.$content_style.'>'.(strip_tags($fields['block_content'], "<br><br/>")).'</div>';
							}
							$icon_html = crumina_icon_render($fields);

							$output .= '<li class="dfd-milestone-item dfd-equalize-height">';
								$output .= '<div class="icon-centered-container">';
									$output .= '<div class="icon-wrap">';
										$output .= '<span class="icon-decoration">';
											$output .= $icon_html;
										$output .= '</span>';
									$output .= '</div>';
								$output .= '</div>';
								$output .= '<div class="content-wrap">';
									$output .= '<div class="content-centered-container">';
										$output .= '<div class="title-wrap">';
											$output .= $title_html;
											$output .= $subtitle_html;
										$output .= '</div>';
										if(!empty($content_html)) {
											$output .= '<div class="description-container">';
												$output .= $content_html;
											$output .= '</div>';
										}
									$output .= '</div>';
								$output .= '</div>';
							$output .= '</li>';
						}
					$output .= '</ul>';
				}

				if(!empty($link_css)) {
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
if(class_exists('Dfd_Milestone')) {
	$Dfd_Milestone = new Dfd_Milestone;
}