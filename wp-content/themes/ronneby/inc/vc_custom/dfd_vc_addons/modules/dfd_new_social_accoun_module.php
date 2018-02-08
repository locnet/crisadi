<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Social Accounts Module
*/
if(!class_exists('Dfd_New_Social_Accounts')) {
	class Dfd_New_Social_Accounts {
		function __construct(){
			add_action('init',array($this, 'dfd_new_social_accounts_init'));
			add_shortcode('dfd_new_social_accounts',array($this, 'dfd_new_social_accounts_shortcode'));
		}
		function dfd_new_social_accounts_init() {
			if(function_exists('vc_map')) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/social_accounts/';
				vc_map(
					array(
						'name' => esc_html__('New Social Accounts', 'dfd'),
						'base' => 'dfd_new_social_accounts',
						'icon' => 'dfd_new_social_accounts dfd_shortcode',
						'category' => esc_html__('Ronneby 2.0', 'dfd'),
						'description' => esc_html__('Displays new social accounts icons', 'dfd'),
						'params' => array(
							array(
								'heading' => esc_html__('Select Style', 'dfd'),
								'type' => 'radio_image_select',
								'param_name' => 'main_style',
								'simple_mode' => false,
								'options' => array(
									'style-1' => array(
										'tooltip' => esc_attr__('Sliding icon', 'dfd'),
										'src' => $module_images . 'style-1.png'
									),
									'style-2' => array(
										'tooltip' => esc_attr__('Sliding background', 'dfd'),
										'src' => $module_images . 'style-2.png'
									),
									'style-3' => array(
										'tooltip' => esc_attr__('Rotate icon', 'dfd'),
										'src' => $module_images . 'style-3.png'
									),
									'style-4' => array(
										'tooltip' => esc_attr__('Fade', 'dfd'),
										'src' => $module_images . 'style-4.png'
									),
									'style-5' => array(
										'tooltip' => esc_attr__('Appear out', 'dfd'),
										'src' => $module_images . 'style-5.png'
									),
									'style-6' => array(
										'tooltip' => esc_attr__('General shadow', 'dfd'),
										'src' => $module_images . 'style-6.png'
									),
									'style-7' => array(
										'tooltip' => esc_attr__('Round to square', 'dfd'),
										'src' => $module_images . 'style-7.png'
									),
									'style-8' => array(
										'tooltip' => esc_attr__('Animated cube', 'dfd'),
										'src' => $module_images . 'style-8.png'
									),
									'style-9' => array(
										'tooltip' => esc_attr__('Retro disco', 'dfd'),
										'src' => $module_images . 'style-9.png'
									),
									'style-10' => array(
										'tooltip' => esc_attr__('Long shadow', 'dfd'),
										'src' => $module_images . 'style-10.png'
									),
									'style-11' => array(
										'tooltip' => esc_attr__('General border', 'dfd'),
										'src' => $module_images . 'style-11.png'
									),
									'style-12' => array(
										'tooltip' => esc_attr__('Flying line', 'dfd'),
										'src' => $module_images . 'style-12.png'
									),
								),
							),
							array(
								'type' => 'param_group',
								'heading' => esc_html__('Social networks', 'dfd'),
								'param_name' => 'dfd_social_networks',
								'params' => array(
									array(
										'type' => 'dropdown',
										'heading' => esc_html__('Select social networks', 'dfd'),
										'param_name' => 'dfd_social_networks_sel',
										'value' => array(
											esc_html__('', 'dfd') => 'none',
											esc_html__('Deviantart link', 'dfd') => 'soc_icon-deviantart',
											esc_html__('Digg link', 'dfd') => 'soc_icon-digg',
											esc_html__('Dribbble link', 'dfd') => 'soc_icon-dribbble',
											esc_html__('Dropbox link', 'dfd') => 'soc_icon-dropbox',
											esc_html__('Evernote link', 'dfd') => 'soc_icon-evernote',
											esc_html__('Facebook link', 'dfd') => 'soc_icon-facebook',
											esc_html__('Flickr link', 'dfd') => 'soc_icon-flickr',
											esc_html__('Foursquare link', 'dfd') => 'soc_icon-foursquare_2',
											esc_html__('Google + link', 'dfd') => 'soc_icon-google__x2B_',
											esc_html__('Instagram link', 'dfd') => 'soc_icon-instagram',
											esc_html__('LastFM link', 'dfd') => 'soc_icon-last_fm',
											esc_html__('LinkedIN link', 'dfd') => 'soc_icon-linkedin',
											esc_html__('Livejournal link', 'dfd') => 'soc_icon-livejournal',
											esc_html__('Picasa link', 'dfd') => 'soc_icon-picasa',
											esc_html__('Pinterest link', 'dfd') => 'soc_icon-pinterest',
											esc_html__('RSS link', 'dfd') => 'soc_icon-rss',
											esc_html__('Tumblr link', 'dfd') => 'soc_icon-tumblr',
											esc_html__('Twitter link', 'dfd') => 'soc_icon-twitter-3',
											esc_html__('Vimeo link', 'dfd') => 'soc_icon-vimeo',
											esc_html__('Wordpress link', 'dfd') => 'soc_icon-wordpress',
											esc_html__('YouTube link', 'dfd') => 'soc_icon-youtube',
											esc_html__('500px link', 'dfd') => 'dfd-added-font-icon-px-icon',
											esc_html__('ViewBug link', 'dfd') => 'dfd-added-font-icon-vb',
											esc_html__('Mail link', 'dfd') => 'soc_icon-mail',
											esc_html__('VKontakte link', 'dfd') => 'soc_icon-rus-vk-02',
											esc_html__('Xing', 'dfd') => 'dfd-added-font-icon-b_Xing-icon_bl',
											esc_html__('Spotify', 'dfd') => 'dfd-added-font-icon-c_spotify-512-black',
											esc_html__('Houzz', 'dfd') => 'dfd-added-font-icon-houzz-dark-icon',
											esc_html__('Skype', 'dfd') => 'dfd-added-font-icon-skype',
											esc_html__('Slideshare', 'dfd') => 'dfd-added-font-icon-slideshare',
											esc_html__('Bandcamp', 'dfd') => 'dfd-added-font-icon-bandcamp-logo',
											esc_html__('Soundcloud', 'dfd') => 'dfd-added-font-icon-soundcloud-logo',
											esc_html__('Meerkat', 'dfd') => 'dfd-added-font-icon-Meerkat-color',
											esc_html__('Periscope', 'dfd') => 'dfd-added-font-icon-periscope-logo',
											esc_html__('Snapchat', 'dfd') => 'dfd-added-font-icon-Snapchat-logo',
											esc_html__('The City', 'dfd') => 'dfd-added-font-icon-the-city',
											esc_html__('Behance', 'dfd') => 'soc_icon-behance',
											esc_html__('Microsoft Pinpoint', 'dfd') => 'dfd-added-font-icon-pinpoint',
											esc_html__('Viadeo', 'dfd') => 'dfd-added-font-icon-viadeo',
											esc_html__('TripAdvisor', 'dfd') => 'dfd-added-font-icon-tripadvisor'
										),
										'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									),
									array(
										'type' => 'vc_link',
										'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Enter the URL for your social account', 'dfd') . '</span></span>' . esc_html__('URL', 'dfd'),
										'param_name' => 'soc_url',
										'edit_field_class' => 'vc_column vc_col-sm-6 no-top-padding crum_vc',
									),
								),
								'group' => esc_attr__('Social networks', 'dfd')
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the horizontal alignment for the social icons', 'dfd') . '</span></span>' . esc_html__('Icon alignment', 'dfd'),
								'param_name' => 'info_alignment',
								'value' => 'text-center',
								'options' => array(
									esc_html__('Center', 'dfd') => 'text-center',
									esc_html__('Left', 'dfd') => 'text-left',
									esc_html__('Right', 'dfd') => 'text-right'
								),
								'edit_field_class' => 'vc_column vc_col-sm-12 no-top-margin crum_vc',
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Extra features', 'dfd'),
								'param_name' => 'extra_features_elements_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
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
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Enter the size for the icon. The default icon size is 20px', 'dfd') . '</span></span>' . esc_html__('Icon size', 'dfd'),
								'param_name' => 'icon_font_size',
								'value' => '',
								'min' => 10,
								'max' => 40,
								'group' => esc_html__('Styles', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-12 dfd-number-wrap crum_vc',
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the color for the icon. The default icon color is #28262b. The default icon color for the styles Long shadow, General shadow and Round to square is #fff', 'dfd') . '</span></span>' . esc_html__('Icon color', 'dfd'),
								'param_name' => 'icon_color',
								'value' => '',
								'group' => esc_html__('Styles', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-8', 'style-11', 'style-12')),
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the background color for the icon. The background color is not set by default. The default backgroun color for the styles Long shadow, General shadow and Round to square depends on the social network. The background color for the style Animated cube is #f4f4f4', 'dfd') . '</span></span>' . esc_html__('Icon background color', 'dfd'),
								'param_name' => 'icon_background_color',
								'value' => '',
								'group' => esc_html__('Styles', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-8', 'style-11', 'style-12')),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to set the border radius for the icons', 'dfd') . '</span></span>' . esc_html__('Border radius', 'dfd'),
								'param_name' => 'border_radius',
								'value' => '',
								'group' => esc_html__('Styles', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'dependency' => array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6', 'style-10')),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to add the space between the social icons', 'dfd') . '</span></span>' . esc_html__('Space between icons', 'dfd'),
								'param_name' => 'icon_margin',
								'value' => '',
								'dependency' => array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6', 'style-7', 'style-8', 'style-9', 'style-10')),
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group' => esc_html__('Styles', 'dfd'),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to enable or disable the border for the social icon. The border is set around single social icon', 'dfd') . '</span></span>' . esc_html__('Border', 'dfd'),
								'param_name' => 'icon_border',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'options' => array(
									'ic_border' => array(
										'on' => esc_html__('Yes', 'dfd'),
										'off' => esc_html__('No', 'dfd'),
									),
								),
								'group' => esc_html__('Styles', 'dfd'),
								'dependency' => array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-3', 'style-4', 'style-5')),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Enter the border width', 'dfd') . '</span></span>' . esc_html__('Border width', 'dfd'),
								'param_name' => 'border_width',
								'value' => '',
								'group' => esc_html__('Styles', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'dependency' => array(
									'element' => 'icon_border',
									'value' => array('ic_border')
								),
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the color for the border. The border color is not set by default', 'dfd') . '</span></span>' . esc_html__('Border color', 'dfd'),
								'param_name' => 'border_color',
								'value' => '',
								'group' => esc_html__('Styles', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array(
									'element' => 'icon_border',
									'value' => array('ic_border')
								),
							),
							array(
								'type' => 'dropdown',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the sliding animation direction', 'dfd') . '</span></span>' . esc_html__('Sliding direction', 'dfd'),
								'param_name' => 'sliding_direction',
								'value' => array(
									esc_html__('Left to right', 'dfd') => 'left_to_right',
									esc_html__('Top to bottom', 'dfd') => 'top_to_bottom',
									esc_html__('Right to left', 'dfd') => 'right_to_left',
									esc_html__('Bottom to top', 'dfd') => 'bottom_to_top'
								),
								'group' => esc_html__('Styles', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-3', 'style-8')),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Enter the border width', 'dfd') . '</span></span>' . esc_html__('Border width', 'dfd'),
								'param_name' => 'general_border_width',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'dependency' => array('element' => 'main_style', 'value' => array('style-11')),
								'group' => esc_html__('Styles', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the color for the border', 'dfd') . '</span></span>' . esc_html__('Border color', 'dfd'),
								'param_name' => 'general_border_color',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'main_style', 'value' => array('style-11')),
								'group' => esc_html__('Styles', 'dfd'),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to enable the settings for the custom hover colors', 'dfd') . '</span></span>' . esc_html__('Customizable hover colors', 'dfd'),
								'param_name' => 'customizable_hover_colors',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-12',
								'options' => array(
									'custom_hover' => array(
										'on' => esc_html__('Yes', 'dfd'),
										'off' => esc_html__('No', 'dfd'),
									),
								),
								'group' => esc_html__('Styles', 'dfd'),
								'dependency' => array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-8', 'style-11', 'style-12')),
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the icon hover color. The default color is #fff', 'dfd') . '</span></span>' . esc_html__('Icon hover color', 'dfd'),
								'param_name' => 'icon_hover_color',
								'value' => '',
								'group' => esc_html__('Styles', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'customizable_hover_colors', 'value' => array('custom_hover')),
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the icon background hover color. The default background color depends on the social network', 'dfd') . '</span></span>' . esc_html__('Icon background hover color', 'dfd'),
								'param_name' => 'icon_hover_background_color',
								'value' => '',
								'group' => esc_html__('Styles', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'customizable_hover_colors', 'value' => array('custom_hover')),
							),
						),
					)
				);
			}
		}
		// Shortcode handler function
		function dfd_new_social_accounts_shortcode($atts) {
			$output = $module_animation = $main_style = $dfd_social_networks = $dfd_social_networks_sel = $soc_url = $single_icon = $link = $link_atts = $el_class = '';
			$info_alignment = $icon_font_size = $border_radius = $icon_border = $border_width = $icon_margin = $link_css = $icon_color = $style_two_hover = '';
			$icon_hover_color = $icon_background_color = $icon_hover_background_color = $general_class = $line_height_height = $line_height_ofset = $line_height = '';
			$a_style = $a_before_style = $i_style = $i_before_style = $customizable_hover_colors = $sliding_direction = $icon_style_html = $border_color = '';
			$link_atts_url = $link_atts_title = $link_atts_target = $link_atts_rel = $animate = $animation_data = $general_border_width = $general_border_color = '';
			
			$atts = vc_map_get_attributes( 'dfd_new_social_accounts', $atts );
			extract( $atts );
						
			$uniqid = uniqid('dfd-soc-icon-') .'-'.rand(1,9999);
			
			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			$general_class .= esc_attr($main_style).' ';
			if(isset($main_style) && strcmp($main_style, 'style-1') === 0 || strcmp($main_style, 'style-2') === 0 || strcmp($main_style, 'style-3') === 0 || strcmp($main_style, 'style-8') === 0) {
				$general_class .= esc_attr($sliding_direction).' ';
			}
			if(isset($icon_font_size) && !empty($icon_font_size)) {
				$a_style .= 'font-size: '.esc_attr($icon_font_size).'px; ';
				$line_height_height = esc_attr($icon_font_size) * 3;
			}else{
				$line_height_height = 60;
			}
			if(isset($border_radius) && !empty($border_radius)) {
				$a_style .= 'border-radius: '.esc_attr($border_radius).'px; ';
			}
			if(isset($icon_margin) && $icon_margin != '') {
				$a_style .= 'margin-right: '.esc_attr($icon_margin).'px; ';
			}
			if(isset($icon_border) && strcmp($icon_border, 'ic_border') === 0) {
				$general_class .= 'with-border ';
				if(isset($border_width) && !empty($border_width)) {
					$a_before_style .= 'border-width: '.esc_attr($border_width).'px; ';
					$line_height_ofset = esc_attr($border_width) * 2;
				}
				if(isset($border_color) && !empty($border_color)) {
					$a_before_style .= 'border-color: '.esc_attr($border_color).'; ';
				}
				$line_height = $line_height_height - $line_height_ofset;
				$a_before_style .= 'line-height: '.$line_height.'px; ';
			}
			if(isset($icon_color) && !empty($icon_color)) {
				$a_style .= 'color: '.esc_attr($icon_color).'; ';
				$link_css .= '#'.$uniqid.'.dfd-new-soc-icon.style-12 a:after {background: '.esc_attr($icon_color).';}';
			}
			if(isset($icon_background_color) && !empty($icon_background_color)) {
				if(isset($main_style) && strcmp($main_style, 'style-8') === 0) {
					$a_before_style .= 'background: '.esc_attr($icon_background_color).'; ';
				}else{
					$a_style .= 'background: '.esc_attr($icon_background_color).'; ';
				}
			}
			if(isset($customizable_hover_colors) && strcmp($customizable_hover_colors, 'custom_hover') === 0) {
				if(isset($icon_hover_color) && !empty($icon_hover_color)) {
					$i_style .= 'color: '.esc_attr($icon_hover_color).'; ';
					$link_css .= '#'.$uniqid.'.dfd-new-soc-icon.style-2 a:hover {color: '.esc_attr($icon_hover_color).';}';
					$link_css .= '#'.$uniqid.'.dfd-new-soc-icon.style-5 a:hover {color: '.esc_attr($icon_hover_color).';}';
					$link_css .= '#'.$uniqid.'.dfd-new-soc-icon.style-12 a:hover {color: '.esc_attr($icon_hover_color).';}';
					$link_css .= '#'.$uniqid.'.dfd-new-soc-icon.style-12 a:hover:after {background: '.esc_attr($icon_hover_color).';}';
				}
				if(isset($icon_hover_background_color) && !empty($icon_hover_background_color)) {
					$i_style .= 'background: '.esc_attr($icon_hover_background_color).'; ';
					$link_css .= '#'.$uniqid.'.dfd-new-soc-icon.style-12 a:hover {background: '.esc_attr($icon_hover_background_color).';}';
				}
			}
			if(isset($main_style) && strcmp($main_style, 'style-2') === 0 && empty($icon_hover_color)) {
				$link_css .= '#'.$uniqid.'.dfd-new-soc-icon.style-2 a:hover {color: #ffffff;}';
			}
			if(!empty($a_style) || !empty($a_before_style) || !empty($i_style)) {
				$link_css .= '#'.$uniqid.'.dfd-new-soc-icon a {'.$a_style.'}';
				$link_css .= '#'.$uniqid.'.dfd-new-soc-icon a:before {'.$a_before_style.'}';
				$link_css .= '#'.$uniqid.'.dfd-new-soc-icon a i {'.$i_style.'}';
			}
			if(isset($general_border_width) && $general_border_width != '') {
				$link_css .= '#'.$uniqid.'.style-11 .soc-icon-container {border-width: '.$general_border_width.'px;}';
			}
			if(isset($general_border_color) && $general_border_color != '') {
				$link_css .= '#'.$uniqid.'.style-11 .soc-icon-container {border-color: '.$general_border_color.';}';
			}
			
			if(isset($dfd_social_networks) && !empty($dfd_social_networks) && function_exists('vc_param_group_parse_atts')) {
				$dfd_social_networks = (array) vc_param_group_parse_atts( $dfd_social_networks );
				
				$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-new-soc-icon '.esc_attr($info_alignment). ' ' .$general_class. ' '.esc_attr($animate).' '.esc_attr($el_class).'" '.$animation_data.'>';
					$output .= '<div class="soc-icon-container clearfix">';

						foreach($dfd_social_networks as $network) {

							if(isset($network['dfd_social_networks_sel']) && isset($network['soc_url'])) {
								if(isset($network['dfd_social_networks_sel'])) {
									$single_icon = $network['dfd_social_networks_sel'];
								}
								if(isset($network['soc_url'])) {
									$link = vc_build_link($network['soc_url']);
								}
								if(isset($link['url']) && !empty($link['url'])) {
									$link_atts_url = 'href="'.esc_url($link['url']).'"';
								}
								if(isset($link['title']) && !empty($link['title'])) {
									$link_atts_title = 'title="'.esc_attr($link['title']).'"';
								}
								if(isset($link['target']) && !empty($link['target'])) {
									$link_atts_target = 'target="'.esc_attr($link['target']).'"';
								}
								if(isset($link['rel']) && !empty($link['rel'])) {
									$link_atts_rel = 'rel="'.esc_attr($link['rel']).'"';
								}
								
								if(isset($main_style) && strcmp($main_style, 'style-9') === 0) {
									$icon_style_html = '<span class="line-top-left '.esc_attr($single_icon).'"></span><span class="line-top-center '.esc_attr($single_icon).'"></span><span class="line-top-right '.esc_attr($single_icon).'"></span><span class="line-bottom-left '.esc_attr($single_icon).'"></span><span class="line-bottom-center '.esc_attr($single_icon).'"></span><span class="line-bottom-right '.esc_attr($single_icon).'"></span>';
								}else{
									$icon_style_html = '<i class="'.esc_attr($single_icon).'"></i>';
								}
								$output .= '<a '.$link_atts_url.' '.$link_atts_title.' '.$link_atts_target.' '.$link_atts_rel.' class="'.esc_attr($single_icon).'">'.$icon_style_html.'</a>';
							}
						}
						
					$output .= '</div>';
				$output .= '</div>';
			}

			$output .= '<script type="text/javascript">
							(function($) {
								$("head").append("<style>'. esc_js($link_css) .'</style>");
							})(jQuery);
						</script>';
			
			return $output;
		}
	}
}
if(class_exists('Dfd_New_Social_Accounts')) {
	$Dfd_New_Social_Accounts = new Dfd_New_Social_Accounts;
}