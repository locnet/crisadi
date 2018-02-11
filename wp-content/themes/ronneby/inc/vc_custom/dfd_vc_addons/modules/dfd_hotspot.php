<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Dfd_Hotspot' ) ) {
	class Dfd_Hotspot {
		
		function __construct() {
			add_action( 'init', array( &$this, '_dfd_hotspot_init' ) );
			add_shortcode( 'dfd_hotspot', array( &$this, '_dfd_hotspot_shortcode' ) );
		}
		
		function _dfd_hotspot_init() {
			if ( function_exists( 'vc_map' ) ) {
				vc_map(
					array(
						'name' => esc_html__('Hotspot','dfd'),
						'base' => 'dfd_hotspot',
						'class' => 'dfd_hotspot dfd_shortcode',
						'icon' => 'dfd_hotspot dfd_shortcode',
						'category' => esc_html__('Ronneby 2.0','dfd'),
						'description' => esc_html__('Display single images with external links and hover effects','dfd'),
						'params' => array(
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('General settings', 'dfd'),
								'param_name' => 'general_options_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12 no-top-margin',
							),
							array(
								'type' => 'attach_image',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the image from the media library', 'dfd') . '</span></span>' . esc_html__('Image', 'dfd'),
								'param_name' => 'image',
								'edit_field_class' => 'vc_column vc_col-sm-12 no-border-bottom',
							),
							array(
								'type' => 'dfd_hotspot_param',
								'heading' => '',
								'param_name' => 'hotspot_data',
								'edit_field_class' => 'vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to define the action the hotspot tooltip will be displayed on. If None action is selected the tooltips will be displayed by default', 'dfd') . '</span></span>' . esc_html__('Tooltip action', 'dfd'),
								'param_name' => 'hotspot_action',
								'edit_field_class' => 'vc_column vc_col-sm-12',
								'value' => 'hover',
								'options' => array(
									esc_html__('None', 'dfd') => 'none',
									esc_html__('Hover', 'dfd') => 'hover',
									esc_html__('Click', 'dfd') => 'click',
								),
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
//							array(
//								'type' => 'dfd_video_link_param',
//								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd') . '</span></span>' . esc_html__('Tutorials', 'dfd'),
//								'param_name' => 'tutorials',
//								'doc_link' => '',
//								'video_link' => 'https://youtu.be/5IWEH1tuS6Q',
//							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Marker settings', 'dfd'),
								'param_name' => 'tooltip_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column no-top-margin vc_col-sm-12',
								'group' => esc_html__('Marker', 'dfd'),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the marker style for the tooltips. You can leave default style or upload your own image', 'dfd') . '</span></span>' . esc_html__('Marker style', 'dfd'),
								'param_name' => 'marker_style',
								'value' => 'default',
								'options' => array(
									esc_html__('Default', 'dfd') => 'default',
									esc_html__('Image', 'dfd') => 'custom_image',
								),
								'group' => esc_html__('Marker', 'dfd'),
							),
							array(
								'type' => 'attach_image',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the image from the media library', 'dfd') . '</span></span>' . esc_html__('Image', 'dfd'),
								'param_name' => 'marker_image',
								'dependency' => array('element' => 'marker_style', 'value' => 'custom_image'),
								'edit_field_class' => 'vc_column vc_col-sm-12 no-border-bottom',
								'group' => esc_html__('Marker', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'marker_background',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to change the background of hotspot markers', 'dfd') . '</span></span>' . esc_html__('Marker Background', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom no-bottom-padding',
								'value' => '',
								'dependency' => array('element' => 'marker_style', 'value_not_equal_to' => 'custom_image'),
								'group' => esc_html__('Marker', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'marker_deco_background',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to change the background of the hotspot marker decoration', 'dfd') . '</span></span>' . esc_html__('Marker decoration Background', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom no-bottom-padding',
								'value' => '#ffffff',
								'dependency' => array('element' => 'marker_style', 'value_not_equal_to' => 'custom_image'),
								'group' => esc_html__('Marker', 'dfd'),
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Tooltip settings', 'dfd'),
								'param_name' => 'tooltip_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column no-top-margin vc_col-sm-12',
								'group' => esc_html__('Tooltip', 'dfd'),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to set the tooltip position from the hotspot marker', 'dfd') . '</span></span>' . esc_html__('Tooltip position', 'dfd'),
								'param_name' => 'tooltip_position',
								'css_rules' => 'padding: 0 12px;',
								'value' => 'dfd-button-tooltip-top',
								'options' => array(
									esc_html__('Top', 'dfd') => 'dfd-button-tooltip-top',
									esc_html__('Bottom', 'dfd') => 'dfd-button-tooltip-bottom',
									esc_html__('Left', 'dfd') => 'dfd-button-tooltip-left',
									esc_html__('Right', 'dfd') => 'dfd-button-tooltip-right',
									esc_html__('Top Left', 'dfd') => 'dfd-button-tooltip-top-left',
									esc_html__('Top Right', 'dfd') => 'dfd-button-tooltip-top-right',
									esc_html__('Bottom Left', 'dfd') => 'dfd-button-tooltip-bottom-left',
									esc_html__('Bottom Right', 'dfd') => 'dfd-button-tooltip-bottom-right',
								),
								'group' => esc_html__('Tooltip', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to set the tooltip text alignment', 'dfd') . '</span></span>' . esc_html__('Tooltip content alignment', 'dfd'),
								'param_name' => 'tooltip_content_align',
								'value' => 'text-left',
								'options' => array(
									esc_html__('Left', 'dfd') => 'text-left',
									esc_html__('Right', 'dfd') => 'text-right',
									esc_html__('Center', 'dfd') => 'text-center',
								),
								'group' => esc_html__('Tooltip', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-5 no-border-bottom no-bottom-padding',
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to define the minimal width for hotspot item tooltip', 'dfd') . '</span></span>' . esc_html__('Tooltip min width', 'dfd'),
								'param_name' => 'tooltip_width',
								'value' => 300,
								'edit_field_class' => 'vc_column vc_col-sm-3 dfd-number-wrap crum_vc no-border-bottom no-bottom-padding',
								'group' => esc_html__('Tooltip', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'tooltip_background',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to choose the color for the tooltip\'s background. The default value is #fff', 'dfd') . '</span></span>' . esc_html__('Tooltip Background', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-4 no-border-bottom no-bottom-padding',
								'group' => esc_html__('Tooltip', 'dfd'),
							),
							array(
								'type' => 'dfd_param_border',
								'heading' => '',
								'param_name' => 'border',
								'simple' => false,
								'enable_radius' => true,
								'edit_field_class' => 'dfd-vc-border-param-styles vc_column vc_col-sm-12',
								'value' => 'border_style:default',
								'group' => esc_html__('Tooltip', 'dfd'),
							),
							array(
								'type' => 'dfd_box_shadow_param',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to enable or disable the shadow for the hotspot tooltip', 'dfd') . '</span></span>' . esc_html__('Box Shadow', 'dfd'),
								'param_name' => 'box_shadow',
								'edit_field_class' => 'vc_column vc_col-sm-12 no-border-bottom no-bottom-padding',
								'group' => esc_html__('Tooltip', 'dfd'),
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Title typography', 'dfd'),
								'param_name' => 'title_typography_heading',
								'group' => esc_html__('Typography', 'dfd'),
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dfd_font_container_param',
								'param_name' => 'title_font_options',
								'settings' => array(
									'fields' => array(
										'font_size',
										'line_height',
										'letter_spacing',
										'font_style',
										'color',
									),
								),
								'group' => esc_html__('Typography', 'dfd'),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to use custom Google font', 'dfd') . '</span></span>' . esc_html__('Custom font family', 'dfd'),
								'param_name' => 'title_google_fonts',
								'options' => array(
									'yes' => array(
										'yes' => esc_attr__('Yes', 'dfd'),
										'no' => esc_attr__('No', 'dfd'),
									),
								),
								'group' => esc_html__('Typography', 'dfd'),
							),
							array(
								'type' => 'google_fonts',
								'param_name' => 'title_custom_fonts',
								'settings' => array(
									'fields' => array(
										'font_family_description' => esc_html__('Select font family.', 'dfd'),
										'font_style_description' => esc_html__('Select font style.', 'dfd'),
									),
								),
								'dependency' => array('element' => 'title_google_fonts', 'value' => 'yes'),
								'edit_field_class' => 'no-top-margin vc_column vc_col-sm-12',
								'group' => esc_html__('Typography', 'dfd'),
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Content typography', 'dfd'),
								'param_name' => 'content_typography_heading',
								'group' => esc_html__('Typography', 'dfd'),
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dfd_font_container_param',
								'param_name' => 'content_font_options',
								'settings' => array(
									'fields' => array(
										'font_size',
										'line_height',
										'letter_spacing',
										'font_style',
										'color',
									),
								),
								'group' => esc_html__('Typography', 'dfd'),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to use custom Google font', 'dfd') . '</span></span>' . esc_html__('Custom font family', 'dfd'),
								'param_name' => 'content_google_fonts',
								'options' => array(
									'yes' => array(
										'yes' => esc_attr__('Yes', 'dfd'),
										'no' => esc_attr__('No', 'dfd'),
									),
								),
								'group' => esc_html__('Typography', 'dfd'),
							),
							array(
								'type' => 'google_fonts',
								'param_name' => 'content_custom_fonts',
								'settings' => array(
									'fields' => array(
										'font_family_description' => esc_html__('Select font family.', 'dfd'),
										'font_style_description' => esc_html__('Select font style.', 'dfd'),
									),
								),
								'dependency' => array('element' => 'content_google_fonts', 'value' => 'yes'),
								'edit_field_class' => 'no-top-margin vc_column vc_col-sm-12',
								'group' => esc_html__('Typography', 'dfd'),
							),
						),
					)
				);
			}
		}
		
		function _dfd_hotspot_shortcode( $atts, $content = null ) {
			$output = $el_class = $data_atts = $css_rules = '';
			
			$atts = vc_map_get_attributes( 'dfd_hotspot', $atts );
			extract( $atts );
			
			if(isset($image) && !empty($image)) {
				global $dfd_ronneby;

				$uniqid = uniqid('dfd-hotspot-module');

				if(isset($dfd_ronneby['dev_mode']) && $dfd_ronneby['dev_mode'] == 'on') {
					wp_enqueue_script('dfd-hotspot');
				}

				/*Data attributes*/
				if(!empty($module_animation)) {
					$data_atts .= ' data-animate="1"  data-animate-type="'.esc_attr($module_animation).'" ';
				}

				if(!empty($hotspot_data)) {
					$data_atts .= ' data-hotspot-content="'.esc_attr($hotspot_data).'" ';
				}

				if(!empty($hotspot_action)) {
					$el_class .= ' dfd-action-'.$hotspot_action;
					$data_atts .= ' data-action="'.esc_attr($hotspot_action).'" ';
				}

				/*Marker*/
				if(isset($marker_style) && $marker_style == 'custom_image' && isset($marker_image) && !empty($marker_image)) {
					$data_atts .= ' data-hotspot-class="HotspotPlugin_Hotspot dfdHotspotImageMarker" ';
					$marker_img_src = wp_get_attachment_image_src($marker_image, 'full');
					$css_rules .= '#'.esc_js($uniqid).' .dfd-hotspot-shortcode .HotspotPlugin_Hotspot.dfdHotspotImageMarker {'
										. 'width: '.esc_js($marker_img_src[1]).'px;'
										. 'height: '.esc_js($marker_img_src[2]).'px;'
										. 'margin-left: -'.esc_js($marker_img_src[1] / 2).'px;'
										. 'margin-top: -'.esc_js($marker_img_src[2] / 2).'px;'
										. 'background-image: url('.esc_url($marker_img_src[0]).');'
								. '}';
				}

				/*Shortcode class*/
				if(isset($tooltip_position) && !empty($tooltip_position)) {
					$el_class .= ' '.$tooltip_position;
				}

				if(isset($tooltip_content_align) && !empty($tooltip_content_align)) {
					$el_class .= ' '.$tooltip_content_align;
				}

				/*Shortcode dynamic css*/
				if(isset($tooltip_width) && $tooltip_width != '') {
					$css_rules .= '#'.esc_js($uniqid).' .dfd-hotspot-shortcode .HotspotPlugin_Hotspot > div { min-width: '.esc_js($tooltip_width).'px;}';
				}

				if(isset($tooltip_background) && $tooltip_background != '') {
					$css_rules .= '#'.esc_js($uniqid).' .dfd-hotspot-shortcode .HotspotPlugin_Hotspot > div { background: '.esc_js($tooltip_background).';}';
				}

				if(isset($marker_background) && $marker_background != '') {
					$css_rules .= '#'.esc_js($uniqid).' .dfd-hotspot-shortcode .HotspotPlugin_Hotspot:not(.dfdHotspotImageMarker):before { background: '.esc_js($marker_background).';}';
				}

				if(isset($marker_deco_background) && $marker_deco_background != '') {
					$css_rules .= '#'.esc_js($uniqid).' .dfd-hotspot-shortcode .HotspotPlugin_Hotspot:not(.dfdHotspotImageMarker):after { background: '.esc_js($marker_deco_background).';}';
				}

				$title_css = _crum_parse_text_shortcode_params($title_font_options, '', $title_google_fonts, $title_custom_fonts, true);
				if(isset($title_css['style']) && !empty($title_css['style'])) {
					$css_rules .= '#'.esc_js($uniqid).' .dfd-hotspot-shortcode .HotspotPlugin_Hotspot > div > .Hotspot_Title {'.esc_js($title_css['style']).'}';
				}

				$content_css = _crum_parse_text_shortcode_params($content_font_options, '', $content_google_fonts, $content_custom_fonts, true);
				if(isset($content_css['style']) && !empty($content_css['style'])) {
					$css_rules .= '#'.esc_js($uniqid).' .dfd-hotspot-shortcode .HotspotPlugin_Hotspot > div > .Hotspot_Message {'.esc_js($content_css['style']).'}';
				}

				if($border != '') {
					$border_css = Dfd_Border_Param::border_css($border);
					$css_rules .= '#'.esc_js($uniqid).' .dfd-hotspot-shortcode .HotspotPlugin_Hotspot > div {'.esc_js($border_css).'}';
				}

				if(substr_count($box_shadow, 'disable') == 0) {
					$box_shadow_css = Dfd_Box_Shadow_Param::box_shadow_css($box_shadow);
					$css_rules .= '#'.esc_js($uniqid).' .dfd-hotspot-shortcode .HotspotPlugin_Hotspot > div {'.esc_js($box_shadow_css).'}';
				}

				$img_src = wp_get_attachment_image_src($image, 'full');

				$img_atts = Dfd_Theme_Helpers::get_image_attrs($img_src[0], $image, $img_src[1], $img_src[2], esc_attr__('Hotspot image','dfd'));

				if(isset($dfd_ronneby['enable_images_lazy_load']) && $dfd_ronneby['enable_images_lazy_load'] == 'on') {
					$el_class .= ' dfd-img-lazy-load';
					$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $img_src[1] $img_src[2]'%2F%3E";
					$img_html = '<img src="'.$loading_img_src.'" data-src="'.esc_attr($img_src[0]).'" width="'.esc_attr($img_src[1]).'" height="'.esc_attr($img_src[2]).'" '.$img_atts.' />';
				} else {
					$img_html = '<img src="'.esc_attr($img_src[0]).'" width="'.esc_attr($img_src[1]).'" height="'.esc_attr($img_src[2]).'" '.$img_atts.' />';
				}

				$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-hotspot-shortcode-wrapper">';
					$output .= '<div class="dfd-hotspot-shortcode" '.$data_atts.'>';
						$output .= '<div class="dfd-hotspot-image-cover '.esc_attr($el_class).'">';
							$output .= $img_html;
						$output .= '</div>';
					$output .= '</div>';

					if($css_rules != '') {
						$output .= '<script type="text/javascript">'
									. '(function($) {'
										. '$("head").append("<style>'.$css_rules.'</style>")'
									. '})(jQuery);'
								. '</script>';
					}

				$output .= '</div>';
			}

			return $output;
		}
	}
}
if ( class_exists( 'Dfd_Hotspot' ) ) {
	$Dfd_Hotspot = new Dfd_Hotspot;
}