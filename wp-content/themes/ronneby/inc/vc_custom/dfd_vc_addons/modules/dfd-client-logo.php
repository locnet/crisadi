<?php
if ( !defined( 'ABSPATH' )) { exit; }
/*
* Add-on Name: DFD Client Logo for Visual Composer
*/
if( !class_exists('Dfd_Client_Logo')) {
	
	class Dfd_Client_Logo {
		
		function __construct() {
			add_action('init', array(&$this, 'dfd_client_logo_init'));
			add_shortcode('dfd_client_logo', array(&$this, 'dfd_client_logo_form'));
		}
		
		function dfd_client_logo_init () {
			if ( function_exists('vc_map') ) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/client_logo/';
				vc_map (
					array(
						'name'					=> esc_html__('Client Logos', 'dfd'),
						'base'					=> 'dfd_client_logo',
//						'class'					=> 'dfd_client_logo dfd_shortcode',
						'icon'					=> 'dfd_client_logo dfd_shortcode',
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
										'tooltip'			=> esc_attr__('Slide up','dfd'),
										'src'				=> $module_images.'style-2.png'
									),
								),
							),
							array(
								'type'             => 'dfd_heading_param',
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
//								'type'				=> 'dfd_video_link_param',
//								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Video tutorial and theme documentation article','dfd').'</span></span>'.esc_html__('Tutorials','dfd'),
//								'param_name'		=> 'tutorials',
//								'doc_link'			=> '//nativewptheme.net/support/visual-composer/clients-logos',
//								'video_link'		=> 'https://www.youtube.com/watch?v=NU7LgIuQOc8&feature=youtu.be',
//							),
							array(
								'type'				=> 'param_group',
								'heading'			=> esc_html__('List content', 'dfd'),
								'param_name'		=> 'list_fields',
								'value'				=> '%5B%7B%22block_title%22%3A%22Client%20title%22%2C%22block_subtitle%22%3A%22Client%20subtitle%22%2C%22block_content%22%3A%22Client%20description.%20Lorem%20ipsum%20dolor%20sit%20amet%2C%20consectetur%20adipiscing%20elit.%20Quisque%20mollis%20ex%20eu%20blandit%20scelerisque.%22%2C%22link_box%22%3A%22link_b%22%7D%2C%7B%22block_title%22%3A%22Client%20title%22%2C%22block_subtitle%22%3A%22Client%20subtitle%22%2C%22block_content%22%3A%22Client%20description.%20Lorem%20ipsum%20dolor%20sit%20amet%2C%20consectetur%20adipiscing%20elit.%20Quisque%20mollis%20ex%20eu%20blandit%20scelerisque.%22%2C%22link_box%22%3A%22link_b%22%7D%2C%7B%22block_title%22%3A%22Client%20title%22%2C%22block_subtitle%22%3A%22Client%20subtitle%22%2C%22block_content%22%3A%22Client%20description.%20Lorem%20ipsum%20dolor%20sit%20amet%2C%20consectetur%20adipiscing%20elit.%20Quisque%20mollis%20ex%20eu%20blandit%20scelerisque.%22%2C%22link_box%22%3A%22link_b%22%7D%5D',
								'params'			=> array(
									array(
										'type'			=> 'attach_image',
										'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the custom image from media library','dfd').'</span></span>'.esc_html__('Upload Image', 'dfd'),
										'param_name'	=> 'icon_image_id',
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Title', 'dfd'),
										'param_name'	=> 'block_title',
										'value'			=> esc_html__('Client title', 'dfd'),
										'admin_label'	=> true,
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> esc_html__('Subtitle', 'dfd'),
										'param_name'	=> 'block_subtitle',
										'value'			=> esc_html__('Client subtitle', 'dfd'),
										'admin_label'	=> true,
									),
									array(
										'type'			=> 'textarea',
										'heading'		=> esc_html__('Description','dfd'),
										'param_name'	=> 'block_content',
										'value'			=> esc_html__('Client description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque mollis ex eu blandit scelerisque.', 'dfd'),
									),
									array(
										'type'			=> 'dfd_single_checkbox',
										'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the link to your client\'s logo','dfd').'</span></span>'.esc_html__('Link', 'dfd'),
										'param_name'	=> 'link_box',
										'value'			=> 'link_b',
										'options'		=> array(
											'link_b'		=> array(
												'yes'			=> esc_attr__('Yes', 'dfd'),
												'no'			=> esc_attr__('No', 'dfd')
											),
										),
										'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
									),
									array(
										'type'			=> 'vc_link',
										'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add a custom link or select existing page. You can remove existing link as well','dfd').'</span></span>'.esc_html__('Add link', 'dfd'),
										'param_name'	=> 'link',
										'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc no-border-bottom',
										'dependency'	=> array('element' => 'link_box', 'value' => 'link_b'),
									),
								),
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'				=> 'dfd_radio_advanced',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the number of columns you would like to show your logos','dfd').'</span></span>'.esc_html__('Columns', 'dfd'),
								'param_name'		=> 'columns',
								'value'				=> 'default',
								'options'			=> array(
									esc_html__('Auto', 'dfd')		=> 'default',
									esc_html__('1', 'dfd')		=> 1,
									esc_html__('2', 'dfd')		=> 2,
									esc_html__('3', 'dfd')		=> 3,
									esc_html__('4', 'dfd')		=> 4,
									esc_html__('5', 'dfd')		=> 5,
									esc_html__('6', 'dfd')		=> 6,
								),
								'group'				=> esc_html__('Settings', 'dfd'),
							),
							array(
								'type'				=> 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the delimiter between the logos','dfd').'</span></span>'.esc_html__('Delimiter', 'dfd'),
								'param_name'		=> 'enable_delimiter',
								'value'				=> '',
								'options'			=> array(
									'on'			=> array(
										'on'				=> esc_attr__('Yes', 'dfd'),
										'off'				=> esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'group'				=> esc_html__('Settings', 'dfd'),
							),
							array(
								'type'				=> 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the general border for the clients\' logos. The border will be set around all logos','dfd').'</span></span>'.esc_html__('General border', 'dfd'),
								'param_name'		=> 'enable_main_border',
								'value'				=> '',
								'options'			=> array(
									'on'			=> array(
										'on'				=> esc_attr__('Yes', 'dfd'),
										'off'				=> esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'group'				=> esc_html__('Settings', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('The default title color is inherited from Theme Options > Typography/Fonts > Headings typography > Content title big Typography. The default subtitle color is #b5b5b5. The default content color is inherited from Theme Options > Typography/Fonts > Text typography > Default text Typography','dfd').'</span></span>'.esc_html__('Content color', 'dfd'),
								'param_name'		=> 'mask_content_color',
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'group'				=> esc_html__('Settings', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the mask background. The default mask color is #fff','dfd').'</span></span>'.esc_html__('Mask background', 'dfd'),
								'param_name'		=> 'mask_background',
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'group'				=> esc_html__('Settings', 'dfd'),
							),
							array(
								'type'				=> 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the shadow on hover for the client logo','dfd').'</span></span>'.esc_html__('Shadow', 'dfd'),
								'param_name'		=> 'disable_shadow',
								'value'				=> 'shadow',
								'options'			=> array(
									'shadow'			=> array(
										'on'				=> esc_attr__('Yes', 'dfd'),
										'off'				=> esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom',
								'dependency'	=> array('element' => 'main_style', 'value' => array('style-1', 'style-2')),
								'group'				=> esc_html__('Settings', 'dfd'),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Title Typography', 'dfd'),
								'param_name'		=> 'title_t_heading',
								'class'				=> 'ult-param-heading',
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
								'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
								'dependency' => array('element' => 'use_google_fonts', 'value' => 'yes'),
								'group'				=> esc_attr__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Subtitle Typography', 'dfd'),
								'param_name'		=> 'subtitle_t_heading',
								'class'				=> 'ult-param-heading',
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
								'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
								'group'				=> esc_html__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Description Typography', 'dfd'),
								'param_name'		=> 'content_t_heading',
								'class'				=> 'ult-param-heading',
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
		
		function dfd_client_logo_form($atts, $content = null) {
			$main_style = $uniqid = $el_class = $module_animation = $animation_data = $output = $css_rules = $title_font_options = $use_google_fonts = $custom_fonts = '';
			$subtitle_font_options = $font_options = $list_fields = $icon_image_id = $block_title = $block_subtitle = $block_content = $link = '';
			$title_options = $subtitle_options = $content_font_options = $content_style = '';
			$disable_shadow = $link_box = $columns_class = '';
			$images_lazy_load = false;

			global $dfd_ronneby;

			if(isset($dfd_ronneby['enable_images_lazy_load']) && $dfd_ronneby['enable_images_lazy_load'] == 'on') {
				$images_lazy_load = true;
				$columns_class .= ' dfd-img-lazy-load ';
			}

			$atts = vc_map_get_attributes('dfd_client_logo', $atts);
			extract($atts);

			$uniqid = uniqid('dfd-client-logo-').'-'.rand(1,9999);

			$el_class .= ' '.$main_style;

			if(!($module_animation == '')) {
				$animation_data = ' data-animate="1" data-animate-type = "'.esc_attr($module_animation).'"';
			}

			if(isset($disable_shadow) && strcmp($disable_shadow, 'shadow') == 0) {
				$el_class .= ' enable-shadow';
			}

			if(isset($enable_delimiter) && $enable_delimiter == 'on') {
				$el_class .= ' enable-delimiter';
			}

			if(isset($enable_main_border) && $enable_main_border == 'on') {
				$el_class .= ' enable-main-border';
			}

			$title_options = _crum_parse_text_shortcode_params($title_font_options, 'dfd-content-title-big', $use_google_fonts, $custom_fonts);
			$subtitle_options = _crum_parse_text_shortcode_params($subtitle_font_options, 'dfd-content-subtitle');
			$content_font_options = _crum_parse_text_shortcode_params($font_options);
			$content_style = $content_font_options['style'];

			if(isset($mask_content_color) && $mask_content_color != '') {
				$css_rules .= '#'.esc_js($uniqid).'.dfd-client-logo-wrap .dfd-client-logo-item .title-wrap .dfd-content-title-big,'
							. '#'.esc_js($uniqid).'.dfd-client-logo-wrap .dfd-client-logo-item .description {color: '.esc_js($mask_content_color).';}';
				$css_rules .= '#'.esc_js($uniqid).'.dfd-client-logo-wrap .dfd-client-logo-item .title-wrap .subtitle {color: '.esc_js(Dfd_Theme_Helpers::dfd_hex2rgb($mask_content_color,.4)).';}';
			}

			if(isset($mask_background) && $mask_background != '') {
				$css_rules .= '#'.esc_js($uniqid).'.dfd-client-logo-wrap.style-1.enable-shadow .dfd-client-logo-item:hover .dfd-shadow-wrap,'
							. '#'.esc_js($uniqid).'.dfd-client-logo-wrap.style-2.enable-shadow .dfd-client-logo-item:hover .dfd-shadow-wrap {background: '.esc_js($mask_background).';}';
			}

			if(isset($list_fields) && !empty($list_fields) && function_exists('vc_param_group_parse_atts')) {
				$list_fields = (array) vc_param_group_parse_atts($list_fields);

				if($columns == 'default') {
					$columns_count = count($list_fields);

					if($columns_count > 4) {
						if($columns_count % 3 == 0 && $columns_count % 4 != 0) {
							$columns_count = 3;
						} else {
							$columns_count = 4;
						}
					}
					$num = (int)$columns_count;
					$columns_class .= dfd_num_to_string($columns_count);
				} else {
					$columns_class .= 'columns-'.$columns;
					$num = (int)$columns;
				}

				$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-client-logo-wrap '.esc_attr($el_class).'" data-count="'.esc_attr($num).'" '.$animation_data.'>';

					$output .= '<div class="dfd-client-logo-offset-wrap">';
						$output .= '<div class="dfd-client-logo-list row">';

							foreach($list_fields as $fields) {

								$title_html = $subtitle_html = $heading_html = $content_html = $image_url = $img_src = $img_html = $link_html = $field_class = '';
								$link_title = $link_rel = $link_target = '';

								if(isset($fields['block_title']) && !empty($fields['block_title'])) {
									$title_html = '<'.$title_options['tag'].' class="'.$title_options['class'].'" '.$title_options['style'].'>'.esc_html($fields['block_title']).'</'.$title_options['tag'].'>';
								}
								if(isset($fields['block_subtitle']) && !empty($fields['block_subtitle'])) {
									$subtitle_html = '<'.$subtitle_options['tag'].' class="'.$subtitle_options['class'].'" '.$subtitle_options['style'].'>'.esc_html($fields['block_subtitle']).'</'.$subtitle_options['tag'].'>';
								}
								if(isset($fields['block_content']) && !empty($fields['block_content'])) {
									$content_html = '<div class="description" '.$content_style.'>'.esc_html($fields['block_content']).'</div>';
								}
								if($title_html != '' || $subtitle_html != '' || $content_html != '') {
									if($title_html != '' || $subtitle_html != '') {
										$heading_html .= '<div class="title-wrap">';
											$heading_html .= $title_html;
											$heading_html .= $subtitle_html;
										$heading_html .= '</div>';
									}
									$field_class = 'with-content';
								}
								if(isset($fields['icon_image_id']) && !empty($fields['icon_image_id'])) {
									$image_url = wp_get_attachment_image_src($fields['icon_image_id'], 'full');
									$img_src = dfd_aq_resize($image_url[0], 300, 200, true, true, false);

									if(!$img_src) {
										$img_src = $image_url[0];
									}

								} else {
									$img_src = get_template_directory_uri() . '/assets/images/no_image_resized_480-360.jpg';
								}

								$img_atts = Dfd_Theme_Helpers::get_image_attrs($img_src, $fields['icon_image_id'], 300, 200, esc_attr__('Client logo','dfd'));

								if($images_lazy_load) {
									$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 300 200'%2F%3E";
									$img_html = '<img src="'.$loading_img_src.'" data-src="'.esc_url($img_src).'" '.$img_atts.' />';
								} else {
									$img_html = '<img src="'.esc_url($img_src).'" '.$img_atts.' />';
								}

								if(isset($fields['link_box']) && $fields['link_box'] == 'link_b' && isset($fields['link'])) {
									$link = vc_build_link($fields['link']);
									$link_title = !empty($link['title']) ? 'title="'.esc_attr($link['title']).'"' : '';
									$link_rel = !empty($link['rel']) ? 'rel="'.esc_attr($link['rel']).'"' : '';
									$link_target = !empty($link['target']) ? 'target="'.esc_attr(preg_replace('/\s+/', '', $link['target'])).'"' : '';
									$link_html = '<a href="'.esc_url($link['url']).'" class="full-box-link" '.$link_title.' '.$link_target.' '.$link_rel.'></a>';
								}

								$output .= '<div class="dfd-item-offset columns columns-with-border '.esc_attr($columns_class).'">';
									$output .= '<div class="dfd-client-logo-item '.esc_attr($field_class).'">';
										if(isset($main_style) && ($main_style == 'style-1' || $main_style == 'style-2')) {
											$output .= '<span class="dfd-shadow-wrap"></span>';
										}
										if(!isset($main_style) || strcmp($main_style, 'style-1') == 0 || strcmp($main_style, 'style-3') == 0) {
											$output .= $heading_html;
										}
										$output .= '<div class="thumb-wrap">';
											$output .= $img_html;
										$output .= '</div>';
										if(!isset($main_style) || ($main_style != 'style-1' && $main_style != 'style-3')) {
											$output .= '<div class="content-wrap">';
												$output .= $heading_html;
										}
										$output .= $content_html;
										if(isset($main_style) && $main_style != 'style-1' && $main_style != 'style-3') {
											$output .= '</div>';
										}
									$output .= $link_html;
									$output .= '</div>';
								$output .= '</div>';
							}

						$output .= '</div>';
					$output .= '</div>';

					if($css_rules != '') {
						$output .= '<script type="text/javascript">'
									. '(function($) {'
										. '$("head").append("<style>'.$css_rules.'</style>");'
									. '})(jQuery);'
								. '</script>';
					}

				$output .= '</div>';
			}

			return $output;
		}
	}
}

if ( class_exists( 'Dfd_Client_Logo' ) ) {
	$Dfd_Client_Logo = new Dfd_Client_Logo;
}