<?php

if (!defined('ABSPATH')) {
	exit;
}
/*
 * Add-on Name: DFD Delimiter for Visual Composer
 */
if (!class_exists('Dfd_Delimiter_Shortcode')) {

	class Dfd_Delimiter_Shortcode {

		function __construct() {
			add_action('init', array(&$this, 'dfd_delimiter_init'));
			add_shortcode('dfd_delimiter', array(&$this, 'dfd_delimiter_form'));
		}

		function dfd_delimiter_init() {
			if (function_exists('vc_map')) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/delimiter/';
				vc_map(
					array(
						'name' => esc_html__('Delimiter', 'dfd'),
						'base' => 'dfd_delimiter',
						'controls' => 'full',
						'show_settings_on_create' => true,
						'icon' => 'dfd_delimiter dfd_shortcode',
						'description' => esc_html__('Delimiter line allows to separate the content', 'dfd'),
						'category' => esc_html__('Ronneby 2.0', 'dfd'),
						'params' => array(
							array(
								'heading' => esc_html__('Style', 'dfd'),
								'type' => 'radio_image_select',
								'param_name' => 'delimiter_style',
								'simple_mode' => false,
								'options' => array(
									'dfd-delimiter-with-arrow' => array(
										'tooltip' => esc_attr__('To top', 'dfd'),
										'src' => $module_images . 'style-1.png'
									),
									'dfd-delimiter-with-line' => array(
										'tooltip' => esc_attr__('Standard', 'dfd'),
										'src' => $module_images . 'style-2.png'
									),
									'dfd-delimiter-with-icon' => array(
										'tooltip' => esc_attr__('With icon', 'dfd'),
										'src' => $module_images . 'style-3.png'
									),
									'dfd-delimiter-with-text' => array(
										'tooltip' => esc_attr__('With text', 'dfd'),
										'src' => $module_images . 'style-4.png'
									),
									'dfd-delimiter-with-image' => array(
										'tooltip' => esc_attr__('Image delimiter', 'dfd'),
										'src' => $module_images . 'style-5.png'
									),
								),
								"value" => "dfd-delimiter-with-arrow"
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__('Delimiter text', 'dfd'),
								'param_name' => 'text_delimiter',
								'value' => 'Delimiter text',
								'dependency' => array('element' => 'delimiter_style', 'value' => array("dfd-delimiter-with-text")),
							),
							array(
								'type' => 'attach_image',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Upload the image or choose from the media library. Notice: The image will be shown in its origin size.', 'dfd') . '</span></span>' . esc_html__('Image', 'dfd'),
								'param_name' => 'image',
								'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc',
								'dependency' => array('element' => 'delimiter_style', 'value' => array("dfd-delimiter-with-image")),
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'text_color',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the delimiter text color. The default value is inherited from Theme Options > Typography/Fonts > Headings typography > Content title small Typography', 'dfd') . '</span></span>' . esc_html__('Text color', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency' => array('element' => 'delimiter_style', 'value' => array("dfd-delimiter-with-text")),
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'text_bg_color',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the delimiter text background color. The default background color is transparent', 'dfd') . '</span></span>' . esc_html__('Text background color', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency' => array('element' => 'delimiter_style', 'value' => array("dfd-delimiter-with-text")),
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'icon_color',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the color for the delimiter icon. The default color is #1b1b1b', 'dfd') . '</span></span>' . esc_html__('Icon color', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency' => array('element' => 'delimiter_style', 'value' => array("dfd-delimiter-with-arrow", "dfd-delimiter-with-icon")),
								'group' => esc_html__('Icon', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'icon_hover_color',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the hover color for the delimiter icon. The default hover color for the to top style is #fff. The default hover color for the with icon style is #1b1b1b', 'dfd') . '</span></span>' . esc_html__('Icon hover color', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 no-top-padding',
								'dependency' => array('element' => 'delimiter_style', 'value' => array("dfd-delimiter-with-arrow", "dfd-delimiter-with-icon")),
								'group' => esc_html__('Icon', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'content_bg_color',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the background color for the icon. The background color by default is not set', 'dfd') . '</span></span>' . esc_html__('Icon background color', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency' => array('element' => 'delimiter_style', 'value' => array("dfd-delimiter-with-arrow")),
								'group' => esc_html__('Icon', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'content_bg_hover_color',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the background hover color for the icon. The default background hover color is inherited from Theme Options > Styling Options > Main site color', 'dfd') . '</span></span>' . esc_html__('Icon background hover color', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency' => array('element' => 'delimiter_style', 'value' => array("dfd-delimiter-with-arrow")),
								'group' => esc_html__('Icon', 'dfd'),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Enter the icon size. The minimum value is 10px', 'dfd') . '</span></span>' . esc_html__('Icon size', 'dfd'),
								'param_name' => 'icon_size',
								'dependency' => array('element' => 'delimiter_style', 'value' => array("dfd-delimiter-with-arrow", "dfd-delimiter-with-icon")),
								'edit_field_class' => 'vc_column vc_col-sm-12 dfd-number-wrap crum_vc',
								'value' => 10,
								'group' => esc_html__('Icon', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'delim_circle_line_color',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the circle border color for the icon. The default border color is inherited from Theme Options > Styling Options > Second site color', 'dfd') . '</span></span>' . esc_html__('Circle border color', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-4',
								'dependency' => array('element' => 'delimiter_style', 'value' => array("dfd-delimiter-with-arrow")),
								'group' => esc_html__('Icon', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'delim_hover_circle_line_color',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the circle border hover color for the icon. The default border hover color is transparent', 'dfd') . '</span></span>' . esc_html__('Circle border hover color', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-4',
								'dependency' => array('element' => 'delimiter_style', 'value' => array("dfd-delimiter-with-arrow")),
								'group' => esc_html__('Icon', 'dfd'),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to set the height for the delimiter', 'dfd') . '</span></span>' . esc_html__('Delimiter height', 'dfd'),
								'param_name' => 'delimiter_height',
								'edit_field_class' => 'vc_column vc_col-sm-3 dfd-number-wrap crum_vc',
								'value' => "1",
								'dependency' => array('element' => 'delimiter_style', 'value_not_equal_to' => array("dfd-delimiter-with-image")),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to enable or disable the repeating of the image you\'ve set', 'dfd') . '</span></span>' . esc_html__('Image repeating', 'dfd'),
								'param_name' => 'repeat_image',
								'value' => 'show',
								'options' => array(
									'show' => array(
										'on' => esc_html__('Yes', 'dfd'),
										'off' => esc_html__('No', 'dfd'),
									),
								),
								'dependency' => array('element' => 'delimiter_style', 'value' => array("dfd-delimiter-with-image")),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to align the image horizontally', 'dfd') . '</span></span>' . esc_html__('Image alignment', 'dfd'),
								'param_name' => 'align_image',
								'value' => 'left',
								'options' => array(
									esc_html__('left', 'dfd') => 'left',
									esc_html__('center', 'dfd') => 'center',
									esc_html__('right', 'dfd') => 'right',
								),
								'dependency' => array('element' => 'repeat_image', 'value_not_equal_to' => "show"),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose one of the delimiter\'s styles', 'dfd') . '</span></span>' . esc_html__('Delimiter style', 'dfd'),
								'param_name' => 'delimiter_border_style',
								'value' => 'solid',
								'options' => array(
									esc_attr__('Solid', 'dfd') => 'solid',
									esc_attr__('Dashed', 'dfd') => 'dashed',
									esc_attr__('Dotted', 'dfd') => 'dotted',
									esc_attr__('Double', 'dfd') => 'double',
									esc_attr__('Inset', 'dfd') => 'inset',
									esc_attr__('Outset', 'dfd') => 'outset',
								),
								'edit_field_class' => 'vc_column vc_col-sm-9 crum_vc',
								'dependency' => array('element' => 'delimiter_style', 'value' => array('dfd-delimiter-with-arrow', 'dfd-delimiter-with-line', 'dfd-delimiter-with-icon', 'dfd-delimiter-with-text')),
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'delim_line_color',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the delimter color. The default color is inherited from Theme Options > Styling Options > Second site color', 'dfd') . '</span></span>' . esc_html__('Delimiter color', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-12',
								'dependency' => array('element' => 'delimiter_style', 'value' => array("dfd-delimiter-with-line", "dfd-delimiter-with-arrow", "dfd-delimiter-with-icon", "dfd-delimiter-with-text")),
							),
							array(
								'type' => 'dfd_font_container_param',
								'heading' => '',
								'param_name' => 'title_font_options',
								'settings' => array(
									'fields' => array(
										'font_size',
										'letter_spacing',
										'line_height',
										'font_style'
									),
								),
								'dependency' => array('element' => 'delimiter_style', 'value' => array("dfd-delimiter-with-text")),
								'group' => esc_attr__('Typography', 'dfd'),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to use custom Google font', 'dfd') . '</span></span>' . esc_html__('Custom font family', 'dfd'),
								'param_name' => 'use_google_fonts',
								'options' => array(
									'show' => array(
										'on' => esc_html__('Yes', 'dfd'),
										'off' => esc_html__('No', 'dfd'),
									),
								),
								'dependency' => array('element' => 'delimiter_style', 'value' => array("dfd-delimiter-with-text")),
								'group' => esc_attr__('Typography', 'dfd'),
							),
							array(
								'type' => 'google_fonts',
								'param_name' => 'custom_fonts',
								'value' => '',
								'group' => esc_attr__('Typography', 'dfd'),
								'settings' => array(
									'fields' => array(
										'font_family_description' => esc_html__('Select font family.', 'dfd'),
										'font_style_description' => esc_html__('Select font style.', 'dfd'),
									),
								),
								'dependency' => array('element' => 'use_google_fonts', 'value' => 'show'),
							),
							array(
								'type' => 'dfd_param_responsive_text',
								'heading' => esc_html__('Delimiter text responsive settings', 'dfd'),
								'param_name' => 'delimiter_text_responsive',
								'edit_field_class' => 'vc_column vc_col-sm-12 no-bottom-padding no-border-bottom',
								'dependency' => array('element' => 'delimiter_style', 'value' => array('dfd-delimiter-with-text')),
								'group' => esc_html__('Responsive', 'dfd'),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to set cusom icon for the delimiter', 'dfd') . '</span></span>' . esc_html__('Custom icon', 'dfd'),
								'param_name' => 'show_icon',
								'options' => array(
									'enable_icon' => array(
										'on' => esc_attr__('Yes', 'dfd'),
										'off' => esc_attr__('No', 'dfd'),
									),
								),
								'dependency' => array('element' => 'delimiter_style', 'value' => array("dfd-delimiter-with-icon", "dfd-delimiter-with-arrow")),
								'group' => esc_html__('Icon', 'dfd'),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the icon library', 'dfd') . '</span></span>' . esc_html__('Icon library', 'dfd'),
								'options' => array(
//										esc_attr__( 'None', 'js_composer' ) => '',
//										esc_attr__( 'Theme default', 'js_composer' ) => 'dfd_icons',
									esc_attr__('Font Awesome', 'js_composer') => 'fontawesome',
									esc_attr__('Open Iconic', 'js_composer') => 'openiconic',
									esc_attr__('Typicons', 'js_composer') => 'typicons',
									esc_attr__('Entypo', 'js_composer') => 'entypo',
									esc_attr__('Linecons', 'js_composer') => 'linecons',
								),
								'value' => 'fontawesome',
								'param_name' => 'icon_font',
								'group' => esc_html__('Icon', 'dfd'),
								'dependency' => array('element' => 'show_icon', 'value' => array("enable_icon")),
							),
							array(
								'type' => 'iconpicker',
								'class' => '',
								'heading' => esc_html__('Select Icon ', 'dfd'),
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
								'group' => esc_html__('Icon', 'dfd'),
							),
							array(
								'type' => 'iconpicker',
								'heading' => __('Icon', 'js_composer'),
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
								'description' => __('Select icon from library.', 'js_composer'),
								'group' => esc_html__('Icon', 'dfd'),
							),
							array(
								'type' => 'iconpicker',
								'heading' => __('Icon', 'js_composer'),
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
								'description' => __('Select icon from library.', 'js_composer'),
								'group' => esc_html__('Icon', 'dfd'),
							),
							array(
								'type' => 'iconpicker',
								'heading' => __('Icon', 'js_composer'),
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
								'group' => esc_html__('Icon', 'dfd'),
							),
							array(
								'type' => 'iconpicker',
								'heading' => __('Icon', 'js_composer'),
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
								'description' => __('Select icon from library.', 'js_composer'),
								'group' => esc_html__('Icon', 'dfd'),
							),
							array(
								'type' => 'dfd_heading_param',
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
						),
					)
				);
			}
		}

		function dfd_delimiter_form($atts, $content = null) {
			$output = $icon_style = $icon_color = $delim_line_color = $delimiter_style = "";
			$center_arrow_style = $delimiter_height = $icon_class = $delimiter_styles = $icon_size_increse = "";
			$text_delimiter = $el_class = $animation_data = $delim_circle_line_color = $content_bg_hover_color = $content_bg_color = $delimiter_border_style = '';
			$delimiter_image_center_html = $image = "";
			$el_class_anim = $delim_hover_circle_line_color = $align_style = $repeat_image = $text_bg_color = $link_css = '';
			$module_animation = $delimiter_line_html = $text_color = $use_google_fonts = $icon_hover_color = $custom_fonts = "";
			
			$atts = vc_map_get_attributes('dfd_delimiter', $atts);
			extract($atts);
			
			$atts["icon_type"] = "selector";
			$uniqid = uniqid('dfd-delimiter-') . '-' . rand(1, 9999);
			if (!empty($module_animation)) {
				$el_class_anim = 'cr-animate-gen ';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}

			if (!empty($icon_size)) {
				$icon_size = esc_attr($icon_size);
			}
			$icon_size = (int) $icon_size < 10 ? 10 : (int) $icon_size;

			switch ($delimiter_style) {
				case 'dfd-delimiter-with-arrow':
					$icon_size_increse = ($icon_size * 2) + 10;
					$icon_class = "dfd-icon-up_2";
					break;
				case 'dfd-delimiter-with-icon':
					$icon_size_increse = ($icon_size * 2);
					$icon_class = "dfd-icon-earth";
					break;
			}

			if (!empty($icon_size) || !empty($icon_color)) {
				$icon_style = 'style="';
				if ($delimiter_style == "dfd-delimiter-with-arrow") {
					if ($icon_color) {
						$link_css .= '#' . esc_js($uniqid) . '.dfd-delimier-wrapper.dfd-delimiter-with-arrow .center-arrow .inner-wrapper-icon i{'
							. '    text-shadow: 0px 0px ' . $icon_color . ', 0px 150px ' . $icon_color . '; }';
					}
				} else {
					$icon_style .= $icon_color ? 'color:' . esc_attr($icon_color) . ';' : '';
				}
				$icon_style .= $icon_size ? 'font-size:' . esc_attr($icon_size) . 'px;' : '';
				$icon_style .= '"';
			}

			/**
			 * delimiter styles
			 */
			if (!empty($delim_line_color) || !empty($delimiter_height) || !empty($delimiter_border_style)) {
				$delimiter_styles = 'style="';
				$delimiter_styles .= $delim_line_color ? 'border-bottom-color:' . esc_attr($delim_line_color) . ';' : '';
				$delimiter_styles .= $delimiter_height ? 'border-bottom-width:' . esc_attr($delimiter_height) . 'px; ' : '';
				$delimiter_styles .= $delimiter_border_style ? 'border-bottom-style:' . esc_attr($delimiter_border_style) . '; ' : '';
				$delimiter_styles .= '"';
			}
			if (!empty($delim_line_color) || !empty($icon_size)) {
				$center_arrow_style = 'style="';

				$center_arrow_style .= $icon_size ? 'width:' . $icon_size_increse . 'px; height:' . $icon_size_increse . 'px;' : '';
				if ($delim_circle_line_color) {
					$center_arrow_style .= $delim_circle_line_color ? 'border-color:' . esc_attr($delim_circle_line_color) . ';' : '';
				} else {
					$center_arrow_style .= $delim_line_color ? 'border-color:' . esc_attr($delim_line_color) . ';' : '';
				}
				$center_arrow_style .= '"';
			}
			if ($show_icon != "enable_icon") {
				$icon_html = '<i class="featured-icon ' . $icon_class . '" ' . $icon_style . '></i> ';
			} else {
				if ($icon_font != '') {
					$icon = 'icon_' . $icon_font;
					if (isset($$icon) || $$icon != '') {
						if ($icon_font != 'dfd_icons')
							vc_icon_element_fonts_enqueue($icon_font);

						$el_class .= ' with-icon';
						$icon_html = '<i class="featured-icon ' . esc_attr($$icon) . '" ' . $icon_style . '></i>';
					}
				}
			}

			/**
			 * Stytle with arrow and icon
			 */
			$delimiter_left_html = '<span class="delim-left">
				<span class="line" ' . $delimiter_styles . '></span>
			</span>';
			$delimiter_center_html = '<span class="delim-center">
				<div class="center-arrow" ' . $center_arrow_style . '>
					<div class="inner-wrapper-icon">' . $icon_html . '</div>
				</div>
			</span>';

			if ($align_image) {
				$align_style .= " style='";
				$align_style .= "text-align:" . esc_attr($align_image) . "; ";
				$align_style .= "' ";
			}
			/**
			 * Style with Text
			 */
			$text_delimiter = empty($text_delimiter) ? "Delimiter text" : esc_attr($text_delimiter);
			/**
			 * Text color
			 */
			$text_color_style = _crum_parse_text_shortcode_params($title_font_options, 'feature-title', $use_google_fonts, $custom_fonts);


			$content_style = $text_color_style['style'];

			if (isset($text_color) && !empty($text_color)) {
				$content_style_bg = 'color:' . esc_attr($text_color) . ';';
				$content_style = _add_custom_param_to_text_shortcode_params($content_style, $content_style_bg);
			}
			if (!empty($text_bg_color)) {
				$content_style_bg = 'background-color:' . esc_attr($text_bg_color) . ';';
				$content_style_bg .= 'padding:8px;';
				$content_style = _add_custom_param_to_text_shortcode_params($content_style, $content_style_bg);
			}
			$delimiter_text_center_html = '<span class="delim-center">
				<span class="text dfd-content-title-small" ' . $content_style . '>' . $text_delimiter . '</span>
			</span>';
			$delimiter_right_html = '<span class="delim-right">
				<span class="line" ' . $delimiter_styles . '></span>
			</span>';
			$delimiter_line_html = '<span><span class="line" ' . $delimiter_styles . '></span></span>';

			/**
			 * Main html tempaletes
			 */
			$output .= '<div class="dfd-delimier-main-wrapper ' . $el_class_anim . '" ' . $animation_data . '>';
			$output .= '<div id="' . $uniqid . '"  class="dfd-delimier-wrapper ' . $delimiter_style . ' ' . $el_class . '" ' . $align_style . '>';
			switch ($delimiter_style) {
				case 'dfd-delimiter-with-arrow':
					if ($content_bg_color) {
						$link_css .= '#' . esc_js($uniqid) . '.dfd-delimier-wrapper.dfd-delimiter-with-arrow .center-arrow{'
							. 'background-color: ' . esc_attr($content_bg_color) . '; }';
					}
					if ($delim_hover_circle_line_color) {
						$link_css .= '#' . esc_js($uniqid) . '.dfd-delimier-wrapper.dfd-delimiter-with-arrow .center-arrow:hover{'
							. ' border-color:' . esc_attr($delim_hover_circle_line_color) . ' !important; '
							. '}';
					}

					if ($content_bg_hover_color) {
						$link_css .= '#' . esc_js($uniqid) . '.dfd-delimier-wrapper.dfd-delimiter-with-arrow .center-arrow:hover{'
							. 'background-color: ' . esc_attr($content_bg_hover_color) . '; }';
					}
					$output .= $delimiter_left_html;
					$output .= $delimiter_center_html;
					$output .= $delimiter_right_html;
					break;
				case 'dfd-delimiter-with-line':
					$output .= $delimiter_line_html;
					break;
				case 'dfd-delimiter-with-text':
					$link_css .= $delim_line_color ? 'border-bottom-color:' . esc_attr($delim_line_color) . '; ' : '';
					$link_css .= $delimiter_border_style ? 'border-bottom-style:' . esc_attr($delimiter_border_style) . '; ' : '';
					if ($delimiter_height) {
						$link_css .= 'height:' . (int) $delimiter_height . 'px; ';
						$link_css .= 'border-bottom-width:' . (int) $delimiter_height . 'px; ';
						$link_css .= 'margin-top: -' . (int) $delimiter_height / 2 . 'px; ';
					}
					$link_css = '#' . esc_js($uniqid) . ' .delim-center span:before, #' . esc_js($uniqid) . ' .delim-center span:after { ' . $link_css . '; } ';
					if (isset($delimiter_text_responsive) && $delimiter_text_responsive != '') {
						$link_css .= Dfd_Resposive_Text_Param::responsive_css($delimiter_text_responsive, '#' . esc_js($uniqid) . '.dfd-delimiter-with-text .delim-center span ');
					}
					$output .= $delimiter_text_center_html;
					break;
				case 'dfd-delimiter-with-image':
					if (!empty($image)) {
						$image_src = wp_get_attachment_image_src($image, 'full');
						if ($repeat_image == "show") {
							$delimiter_image_style = 'style="background:url(' . $image_src[0] . '); height:' . $image_src[2] . 'px;"';
							$delimiter_image_center_html = '<div class="background-repeat" ' . $delimiter_image_style . '></div>';
						} else {
							$img_atts = Dfd_Theme_Helpers::get_image_attrs($image_src[0], $image, $image_src[1], $image_src[2], esc_attr__('Delimiter', 'dfd'));
							$delimiter_image_center_html = '<img width="' . $image_src[1] . '" height="' . $image_src[2] . '" src="' . $image_src[0] . '" ' . $img_atts . ' />';
						}
					} else {
						$image_src = get_template_directory_uri() . '/assets/images/no_image_resized_480-360.jpg';
						if ($repeat_image == "show") {
							$delimiter_image_style = 'style="background:url(' . $image_src . '); height:5px;"';
							$delimiter_image_center_html = '<div class="background-repeat" ' . $delimiter_image_style . '></div>';
						} else {
							$delimiter_image_center_html = '<img width="300" height="300" src="' . $image_src . '"alt="' . esc_attr__('Delimiter', 'dfd') . '" />';
						}
					}
					$output .= $delimiter_image_center_html;
					break;

				default:
					$output .= $delimiter_left_html;
					$output .= $delimiter_center_html;
					$output .= $delimiter_right_html;
			}
			if (!empty($icon_hover_color) && $icon_hover_color) {
				if ($delimiter_style == "dfd-delimiter-with-arrow") {
					$link_css .= '#' . esc_js($uniqid) . '.dfd-delimier-wrapper.dfd-delimiter-with-arrow .center-arrow:hover .inner-wrapper-icon i{'
						. '    text-shadow: 0px -150px ' . $icon_hover_color . ', 0px 0px ' . $icon_hover_color . ' !important; }';
				} else {
					$link_css .= '#' . esc_js($uniqid) . '.dfd-delimiter-with-icon .inner-wrapper-icon i:hover{color:' . esc_attr($icon_hover_color) . ' !important;}';
				}
			}
			if (!empty($link_css)) {
				$output .= '<script type="text/javascript">'
					. '(function($) {'
					. '$("head").append("<style>' . $link_css . '</style>");'
					. '})(jQuery);'
					. '</script>';
			}
			$output .= '</div></div>';
			return $output;
		}

	}

}

if (class_exists('Dfd_Delimiter_Shortcode')) {
	$Dfd_Delimiter_Shortcode = new Dfd_Delimiter_Shortcode;
}