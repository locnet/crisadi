<?php
if ( !defined( 'ABSPATH' )) { exit; }
/*
* Add-on Name: DFD Price List
*/
if( !class_exists('Dfd_Price_List')) {
	
	class Dfd_Price_List {
		
		function __construct() {
			add_action('init', array(&$this, 'price_list_init'));
			add_shortcode('price_list', array(&$this, 'price_list_form'));
		}
		
		function price_list_init () {
			if ( function_exists('vc_map') ) {
				vc_map (
					array (
						'name'					=> esc_html__('Pricing List', 'dfd'),
						'base'					=> 'price_list',
						'icon'					=> 'price_list dfd_shortcode',
						'category'				=> esc_html__('Ronneby 2.0', 'dfd'),
						'params'				=> array(
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the width of the pricing list item according to the container width','dfd').'</span></span>'.esc_html__('Price List Size', 'dfd'),
								'param_name'		=> 'box_width',
								'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc dfd-number-percent'
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
								'param_name'		=> 'el_class'
							),
//							array(
//								'type'				=> 'dfd_video_link_param',
//								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd') . '</span></span>' . esc_html__('Tutorials', 'dfd'),
//								'param_name'		=> 'tutorials',
//								'doc_link'			=> '//nativewptheme.net/support/visual-composer/pricing-list',
//								'video_link'		=> 'https://www.youtube.com/watch?v=JxUWteix4sg',
//							),
							array(
								'type'				=> 'param_group',
								'heading'			=> esc_html__('List content', 'dfd'),
								'param_name'		=> 'list_fields',
								'params'			=> array(
									array(
										'type'			=> 'attach_image',
										'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select image from media library for your pricing list item','dfd').'</span></span>'.esc_html__('Image', 'dfd'),
										'param_name'	=> 'image_id',
									),
									array(
										'type'			=> 'textarea',
										'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the title for your pricing list item','dfd').'</span></span>'.esc_html__('Title', 'dfd'),
										'param_name'	=> 'title',
									),
									array(
										'type'				=> 'textfield',
										'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the price for your pricing list item','dfd').'</span></span>'.esc_html__('Price', 'dfd'),
										'param_name'		=> 'price',
										'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc',
									),
									array(
										'type'			=> 'textarea',
										'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the subtitle for your pricing list item','dfd').'</span></span>'.esc_html__('Subtitle', 'dfd'),
										'param_name'	=> 'subtitle',
									),
								),
								'group'				=> esc_html__('Content', 'dfd')
							),
							array(
								'type'				=> 'dfd_radio_advanced',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose one of the delimiter styles','dfd').'</span></span>'.esc_html__('Delimiter style', 'dfd'),
								'param_name'		=> 'delimeter_style',
								'value'				=> 'none',
								'options'			=> array(
									esc_html__('None','dfd')	=> 'none',
									esc_html__('Solid','dfd')	=> 'solid',
									esc_html__('Dotted','dfd')	=> 'dotted',
									esc_html__('Dashed','dfd')	=> 'dashed',
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc',
								'group'				=> esc_html__('Settings', 'dfd')
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the width for the delimiter','dfd').'</span></span>'.esc_html__('Delimiter width', 'dfd'),
								'param_name'		=> 'delimeter_width',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
								'dependency'		=> array('element' => 'delimeter_style', 'value' => array('solid', 'dotted', 'dashed')),
								'group'				=> esc_html__('Settings', 'dfd')
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you set the color for the delimiter','dfd').'</span></span>'.esc_html__('Delimiter Color', 'dfd'),
								'param_name'		=> 'color_delim',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
								'dependency'		=> array('element' => 'delimeter_style', 'value' => array('solid', 'dotted', 'dashed')),
								'group'				=> esc_html__('Settings', 'dfd')
							),
							array(
								'type'			=> 'number',
								'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the width for the image. Max width is 100px','dfd').'</span></span>'.esc_html__('Image width', 'dfd'),
								'param_name'	=> 'img_width',
								'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
								'group'				=> esc_html__('Settings', 'dfd')
							),
							array(
								'type'			=> 'number',
								'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the height for the image. Max height is 100px','dfd').'</span></span>'.esc_html__('Image height', 'dfd'),
								'param_name'	=> 'img_height',
								'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
								'group'				=> esc_html__('Settings', 'dfd')
							),
							array(
								'type'			=> 'number',
								'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the border radius for the image','dfd').'</span></span>'.esc_html__('Image radius', 'dfd'),
								'param_name'	=> 'img_radius',
								'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
								'group'				=> esc_html__('Settings', 'dfd')
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add the spacing between the pricing list content','dfd').'</span></span>'.esc_html__('Spacing between content', 'dfd'),
								'param_name'		=> 'spacing_content',
								'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc dfd-number-wrap	',
								'group'				=> esc_html__('Settings', 'dfd')
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Title Typography', 'dfd'),
								'param_name'		=> 'title_t_heading',
								'class'				=> 'ult-param-heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
								'group'				=> esc_html__('Typography', 'dfd'),
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
								'group'				=> esc_html__('Typography', 'dfd'),
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
								'dependency'		=> array('element' => 'use_google_fonts', 'value' => 'yes'),
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
								'group'				=> esc_html__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
								'param_name'		=> 'subtitle_google_fonts',
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
								'param_name'		=> 'subtitle_custom_fonts',
								'settings'			=> array(
									'fields'			=> array(
										'font_family_description'	=> esc_html__('Select font family.', 'dfd'),
										'font_style_description'	=> esc_html__('Select font style.', 'dfd'),
									),
								),
								'dependency'		=> array('element' => 'subtitle_google_fonts', 'value' => 'yes'),
								'group'				=> esc_html__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Price typography', 'dfd'),
								'param_name'		=> 'price_t_heading',
								'class'				=> 'ult-param-heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group'				=> esc_html__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'dfd_font_container_param',
								'param_name'		=> 'title_price_font_options',
								'settings'			=> array(
									'fields'			=> array(
										//'tag'				=> 'div',
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
								'type'				=> 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
								'param_name'		=> 'use_price_google_fonts',
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
								'param_name'		=> 'custom_price_fonts',
								'settings'			=> array(
									'fields'			=> array(
										'font_family_description' => esc_html__('Select font family.', 'dfd'),
										'font_style_description'  => esc_html__('Select font style.', 'dfd'),
									),
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
								'dependency'		=> array('element' => 'use_price_google_fonts', 'value' => 'yes'),
								'group'				=> esc_attr__('Typography', 'dfd'),
							),
						)
					)
				);
			}
		}
		
		function price_list_form($atts, $content = null) {
			$main_style = $module_animation = $el_class = $list_fields = $delimeter_style = $delimeter_width = $color_delim = '';
			$title_font_options = $use_google_fonts = $custom_fonts = $subtitle_font_options = $subtitle_google_fonts = $subtitle_custom_fonts = '';
			$animation_data = $output = $delimiter_html = $link_css = $box_width = $spacing_content = '';
			$image_id = $img_html = $img_src = $img_url = $img_width = $img_height = $img_radius = '';
			$price_font_option = $title_price_font_options = $use_price_google_fonts = $custom_price_fonts = '';

			$atts = vc_map_get_attributes('price_list', $atts);
			extract($atts);
			
			$uniqid = uniqid('dfd-price-wrap-').'-'.rand(1,9999);

			if(!($module_animation == '')) {
				$animation_data = ' data-animate="1" data-animate-type = "'.esc_attr($module_animation).'"';
			}

			$title_font_options = _crum_parse_text_shortcode_params( $title_font_options, 'feature-title', $use_google_fonts, $custom_fonts, true );
			$subtitle_font_options = _crum_parse_text_shortcode_params( $subtitle_font_options, 'subtitle', $subtitle_google_fonts, $subtitle_custom_fonts, true );
			$price_font_option = $title_font_options;
			if(isset($title_price_font_options) && !empty($title_price_font_options)) {
				$title_price_font_options = _crum_parse_text_shortcode_params( $title_price_font_options, 'feature-title', $use_price_google_fonts, $custom_price_fonts, true );
				$price_font_option = $title_price_font_options;
			}

			/**********************
			 * Delimiter Settings
			 *********************/
			if(isset($delimeter_style) && !empty($delimeter_style)) {
				$link_css .= '#'. esc_js($uniqid).' .dfd-price-cover .price-delimeter {border-bottom-style: '.esc_attr($delimeter_style).';}';
			}
			if(isset($delimeter_width) && $delimeter_width != '') {
				$link_css .= '#'. esc_js($uniqid).' .dfd-price-cover .price-delimeter {border-bottom-width: '.esc_attr($delimeter_width).'px;}';
			}
			if(isset($color_delim) && !empty($color_delim)){
				$link_css .= '#'. esc_js($uniqid).' .dfd-price-cover .price-delimeter {border-color: '.esc_attr($color_delim).';}';
			}


			if(isset($box_width) && $box_width !== '') {
				if($box_width < 0) {
					$box_width = 0;
				}
				if($box_width > 100) {
					$box_width = 100;
				}
				$link_css .= '#'. esc_js($uniqid).'.dfd-price-wrap {width: '.esc_js($box_width).'%;}';
			}

			if(isset($spacing_content) && !empty($spacing_content)){
				$link_css .= '#'.esc_js($uniqid).' .dfd-price-block {margin-top: '.esc_attr($spacing_content).'px;}';
			}

			/**********************
			 * Image Settings
			 *********************/
			if(!isset($img_width) || $img_width == '') {
				$img_width = 80;
			}
			// Setting max size for image
			if($img_width < 0) {
				$img_width = 0;
			}
			if($img_width > 100) {
				$img_width = 100;
			}
			$link_css .= '#'. esc_js($uniqid).' .thumb-wrap img {width: '.esc_js($img_width).'px;}';
			if(!isset($img_height) || $img_height == '') {
				$img_height = 80;
			}
			// Setting max size for image
			if($img_height < 0) {
				$img_height = 0;
			}
			if($img_height > 100) {
				$img_height = 100;
			}
			$link_css .= '#'. esc_js($uniqid).' .thumb-wrap img {height: '.esc_js($img_height).'px;}';
			if(isset($img_radius) && $img_radius !== '') {
				$link_css .= '#'. esc_js($uniqid).' .thumb-wrap img {border-radius: '.esc_js($img_radius).'px;}';
			}

			$output .= '<div id="'.  esc_attr($uniqid).'" class="dfd-price-wrap '.  esc_attr($el_class).'" '.$animation_data.'>';

				if(isset($list_fields) && !empty($list_fields) && function_exists('vc_param_group_parse_atts')) {
					$list_fields = vc_param_group_parse_atts($list_fields);

					foreach ($list_fields as $fields) {
						$img_html = '';

						$output .= '<div class="dfd-price-block">';	
							if(isset($fields['image_id']) && !empty($fields['image_id'])) {
								$image_url = wp_get_attachment_image_src($fields['image_id'], 'full');
								$img_src = dfd_aq_resize($image_url[0], $img_width, $img_height, true, true, true);
								if(!$img_src) {
									$img_src = $img_url[0];
								}

								global $dfd_ronneby;
								$thumb_class = '';

								$img_atts = Dfd_Theme_Helpers::get_image_attrs($img_src, $fields['image_id'], $img_width, $img_height, esc_html__('Pricing list', 'dfd'));

								if(isset($dfd_ronneby['enable_images_lazy_load']) && $dfd_ronneby['enable_images_lazy_load'] == 'on') {
									$thumb_class .= ' dfd-img-lazy-load';
									$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $img_width $img_height'%2F%3E";
									$img_html = '<img src="'.$loading_img_src.'" data-src="'.esc_url($img_src).'" width="'.esc_attr($img_width).'" height="'.esc_attr($img_height).'" '.$img_atts.' />';
								} else {
									$img_html = '<img src="'.esc_url($img_src).'" width="'.esc_attr($img_width).'" height="'.esc_attr($img_height).'" '.$img_atts.' />';
								}
								$output .= '<div class="thumb-wrap '.esc_attr($thumb_class).'">'.$img_html.'</div>';
							}
							$output .= '<div class="text-wrap">';
								$output .= '<div class="dfd-price-cover clearfix">';
									if(isset($fields['title']) && !empty($fields['title'])){
										$output .= '<'.esc_attr($title_font_options['tag']).' class="price-title '.esc_attr($title_font_options['class']).'" style="'.$title_font_options['style'].'"> ' . esc_html($fields['title']) . ' </'.esc_attr($title_font_options['tag']).'>';
									}
									$output .= '<div class="price-delimeter"></div>';
									if(isset($fields['price']) && !empty($fields['price'])){
										$output .= '<'.esc_attr($price_font_option['tag']).' class="amount-price amount '.esc_attr($price_font_option['class']).'" style="'.$price_font_option['style'].'"> ' . esc_html($fields['price']) . ' </'.esc_attr($price_font_option['tag']).'>';
									}
								$output .= '</div>';
								if(isset($fields['subtitle']) && !empty($fields['subtitle'])){
									$output .= '<div class="dfd-price-cover"><'.esc_attr($subtitle_font_options['tag']).' class="'.esc_attr($subtitle_font_options['class']).'" style="'.$subtitle_font_options['style'].'"> ' . wp_kses( $fields['subtitle'], array('br' => array()) ) . ' </'.esc_attr($subtitle_font_options['tag']).'></div>';
								}
							$output .= '</div>';	
						$output .= '</div>';	
					}

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

if ( class_exists( 'Dfd_Price_List' ) ) {
	$Dfd_Price_List = new Dfd_Price_List;
}

