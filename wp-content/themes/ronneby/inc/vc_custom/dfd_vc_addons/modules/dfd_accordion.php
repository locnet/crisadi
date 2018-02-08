<?php

if (!defined('ABSPATH')) {
	exit;
}

/*
 * Add-on Name: Announcement Line
 */
if (!class_exists('Dfd_Accordion')) {

	/**
	 * Class Dfd_Announcement
	 */
	class Dfd_Accordion {

		/**
		 * Main construct class.
		 */
		function __construct() {
			add_action('init', array($this, '_dfd_accordion_init'));
//			add_shortcode('dfd_accordion', array ($this, '_dfd_accordion_shortcode'));
		}

		/**
		 * Block options.
		 */
		function _dfd_accordion_init() {
			$module_images_accordion = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/accordion/';

			vc_map(array(
				'name' => __('DFD Accordion', 'dfd'),
				'base' => 'dfd_accordion',
				'icon' => 'dfd_accordion dfd_shortcode',
				'is_container' => true,
				'show_settings_on_create' => true,
				'as_parent' => array(
					'only' => 'vc_tta_section',
				),
				'category' => __('Ronneby 2.0', 'dfd'),
				'description' => __('Collapsible content panels', 'dfd'),
				'params' => array(
					array(
						'type' => 'radio_image_select',
						'heading' => esc_html__('Style', 'dfd'),
						'param_name' => 'style',
						'simple_mode' => false,
						'options' => array(
							'style-1' => array(
								'tooltip' => esc_attr__('Square Bordered', 'dfd'),
								'src' => $module_images_accordion . 'style-1.png'
							),
							'style-2' => array(
								'tooltip' => esc_attr__('Square Background', 'dfd'),
								'src' => $module_images_accordion . 'style-2.png'
							),
							'style-3' => array(
								'tooltip' => esc_attr__('Rounded Bordered', 'dfd'),
								'src' => $module_images_accordion . 'style-3.png'
							),
							'style-4' => array(
								'tooltip' => esc_attr__('Rounded Background', 'dfd'),
								'src' => $module_images_accordion . 'style-4.png'
							),
							'style-6' => array(
								'tooltip' => esc_attr__('Square Underline', 'dfd'),
								'src' => $module_images_accordion . 'style-6.png'
							),
						),
						"value" => "style-2",
					),
					array(
						'type' => 'dropdown',
						'param_name' => 'autoplay',
						'value' => array(
							__('None', 'dfd') => 'none',
							'1' => '1',
							'2' => '2',
							'3' => '3',
							'4' => '4',
							'5' => '5',
							'10' => '10',
							'20' => '20',
							'30' => '30',
							'40' => '40',
							'50' => '50',
							'60' => '60',
						),
						'std' => 'none',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enable the automatical tabs rotation, choose the periodicity of tabs rotation in seconds','dfd').'</span></span>'.esc_html__('Autorotate', 'dfd'),
					),
					array(
						'edit_field_class' => 'vc_ui-panel',
						'type' => 'checkbox',
						'param_name' => 'collapsible_all',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to collapse all section of the accordion','dfd').'</span></span>'. __('Collapse all', 'dfd'),
					),
					// Control Icons END
					array(
						'type' => 'textfield',
						'param_name' => 'active_section',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the number of the section which should be active on page load. Note: to have all sections closed on initial load enter non-existing number.','dfd').'</span></span>'.esc_html__('Active section', 'dfd'),
						'value' => 1,
					),
					array(
						'type' => 'number',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border radius for the tabs','dfd').'</span></span>'.  __('Border radius', 'dfd'),
						'param_name' => 'border_radius',
						'value' => '',
						'min' => 1,
						'max' => 10,
						'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
						'group' => "Tabs Style",
					),
					array(
						"type" => "colorpicker",
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows toy to specify the background color for the tabs. The background color is not set by default','dfd').'</span></span>'. __("Tab background", 'dfd'),
						"param_name" => "tab_background",
						"value" => "",
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => "Tabs Style",
					),
					array(
						"type" => "colorpicker",
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows toy to specify the background hover color for the tabs. The background color is not set by default','dfd').'</span></span>'.  esc_html__('Tab hover background', 'dfd'),
						"param_name" => "tab_hover_background",
						"value" => "",
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => "Tabs Style",
					),
					array(
						"type" => "colorpicker",
						"heading" => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the active tab. The default background color for the styles Square Background and Rounded Background is inherited from Theme Options > Styling Options > Third site color. The backgrouns color for the style other styles is transparent','dfd').'</span></span>'.esc_html__('Active tab background', 'dfd'),
						"param_name" => "active_tab_background",
						"value" => "",
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => "Tabs Style",
					),
					array(
						"type" => "colorpicker",
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border color. The default border color is not set by default','dfd').'</span></span>'.  esc_html__('Border Color', 'dfd'),
						"param_name" => "border_color_radius",
						"value" => "",
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => "Tabs Style",
					),
					array(
						"type" => "colorpicker",
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the active tab border color. The default border color for the styles Square Bordered and Rounded Bordered is inherited from Theme Options > Styling Options > Third site color. The default border color for the style Square Underline is #e6e6e6','dfd').'</span></span>'.esc_html__('Border Color active tab', 'dfd'),
						"param_name" => "border_color_active",
						"value" => "",
						'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
						'group' => "Tabs Style",
					),
					array(
						'type' => 'dfd_single_checkbox',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set border width 2px for the active tab','dfd').'</span></span>'. __('2px active tab border', 'dfd'),
						'param_name' => 'active_two_px_border',
						'value' => '',
						'options' => array(
							'on' => array(
								'on' => 'Yes',
								'off' => 'No',
							),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
						'group' => "Tabs Style",
					),
					array(
						"type" => "colorpicker",
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the content background color. The color is not set by default', 'dfd') . '</span></span>' .  esc_html__('Content background color ', 'dfd'),
						"param_name" => "color_content_area",
						"value" => "",
						'group' => "Content Style",
					),
					array(
						'type' => 'dropdown',
						'param_name' => 'c_align',
						'value' => array(
							__('Left', 'dfd') => 'left',
							__('Right', 'dfd') => 'right',
							__('Center', 'dfd') => 'center',
						),
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Select accordion section title alignment', 'dfd') . '</span></span>' . esc_html__('Alignment', 'dfd'),
						'group' => "Text Style",
					),
					array(
						'type' => 'number',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the font size for the accordion\'s title','dfd').'</span></span>'. esc_html__('Font size', 'dfd'),
						'param_name' => 'font_size',
						'value' => 14,
						'min' => 1,
						'max' => 100,
						'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
						'group' => "Text Style",
					),
					array(
						"type" => "colorpicker",
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the title. The default color is inherited from Theme Options > Styling options > Link options > Link Typography','dfd').'</span></span>'.esc_html__('Title color', 'dfd'),
						"param_name" => "tab_text_color",
						"value" => "",
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => "Text Style",
					),
					array(
						"type" => "colorpicker",
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the hover color for the title. The default color is inherited from Theme Options > Styling Options > Link Options > Link hover color','dfd').'</span></span>'.esc_html__('Title hover color', 'dfd'),
						"param_name" => "tab_hover_text_color",
						"value" => "",
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => "Text Style",
					),
					array(
						"type" => "colorpicker",
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the active tab title. The default color for the styles Square Bordered, Round Bordered and Square Underline is inherited from Theme Options > Styling options > Link options > Link Typography. The color for the styles Square Background and Rounded background is #fff','dfd').'</span></span>'. __('Active tab title color', 'dfd'),
						"param_name" => "tab_active_color_text",
						"value" => "",
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => "Text Style",
					),
					array(
						'type' => 'dfd_single_checkbox',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the underline decoration for the title','dfd').'</span></span>'. esc_html__('Underline in tab', 'dfd'),
						'param_name' => 'underline',
						'value' => 'off',
						'options' => array(
							'on' => array(
								'on' => 'Yes',
								'off' => 'No',
							),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
						'group' => "Text Style",
					),
					array(
						'type' => 'dfd_single_checkbox',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to show or hide +/- cotrols for the accordion tabs','dfd').'</span></span>'. __('Hide +/- controls', 'dfd'),
						'param_name' => 'disable_plus_minus',
						'value' => '',
						'options' => array(
							'on' => array(
								'on' => 'Yes',
								'off' => 'No',
							),
						),
						'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
						'group' => "Text Style",
					),
					array(
						'type'       => 'dfd_font_container_param',
						'heading'    => '',
						'param_name' => 'tab_title_font_options',
						'settings'   => array(
							'fields' => array(
								//'tag' => 'h5',
								'letter_spacing',
								//'font_size',
								//'line_height',
								//'color',
								'font_style'
							),
						),
						'group'      => esc_attr__( 'Text Style', 'dfd' ),
					),
					array(
						'type'			=> 'dfd_single_checkbox',
						'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
						'param_name'	=> 'tab_title_google_fonts',
						'value' => '',
						'options' => array(
							'yes'	=> array(
								'yes'	=> esc_attr__('Yes', 'dfd'),
								'no'	=> esc_attr__('No', 'dfd')
							),
						),
						'group'       => esc_attr__('Text Style', 'dfd'),
					),
					array(
						'type'       => 'google_fonts',
						'param_name' => 'tab_title_custom_fonts',
						'value'      => '',
						'settings'   => array(
							'fields' => array(
								'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
								'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
							),
						),
						'dependency' => array('element' => 'tab_title_google_fonts', 'value' => 'yes'),
						'group'      => esc_attr__('Text Style', 'dfd'),
					),
					array(
						'type' => 'dropdown',
						'param_name' => 'c_icon',
						'edit_field_class' => 'vc_ui-panel',
						'value' => array(
							__('None', 'dfd') => '',
							__('Chevron', 'dfd') => 'chevron',
							__('Plus', 'dfd') => 'plus',
							__('Triangle', 'dfd') => 'triangle',
						),
						'std' => 'plus',
						'heading' =>  __('Icon', 'dfd'),
						'group' => "Icon Style",
					),
					// Control Icons
					array(
						'type' => 'dfd_radio_advanced',
						'param_name' => 'c_position',
						'value'			=> 'left',
						'options'		=> array(
							__('Left', 'dfd') => 'left',
							__('Right', 'dfd') => 'right',
						),
						'dependency' => array(
							'element' => 'c_icon',
							'not_empty' => true,
						),
						'heading'	 => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the +/- icons placement according to the title','dfd'). '</span></span>'.__('Icon Plus Position', 'dfd'),
						'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
						'group' => "Icon Style",
					),
					array(
						'type' => 'dfd_radio_advanced',
						'param_name' => 'c_icon_position',
						'value'			=> 'left',
						'options'		=> array(
							__('Left', 'dfd') => 'left',
							__('Right', 'dfd') => 'right',
						),
						'dependency' => array(
							'element' => 'c_icon',
							'not_empty' => true,
						),
						'heading'	 => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the custom icons placement according to the title','dfd'). '</span></span>'.__('Custom Icon Position', 'dfd'),
						'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
						'group' => "Icon Style",
					),
					array(
						"type" => "colorpicker",
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify icons color. The default color is inherited from Theme Options > Styling options > Link options > Link Typography ', 'dfd') . '</span></span>' . __("Icon Color", 'dfd'),
						"param_name" => "icon_color",
						"value" => "",
						'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
						'group' => "Icon Style",
					),
					array(
						'type' => 'number',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set icon size','dfd').'</span></span>'. __('Icon size', 'dfd'),
						'param_name' => 'icon_size',
						'value' => 14,
						'min' => 1,
						'max' => 100,
						'edit_field_class' => 'vc_col-sm-6 dfd-number-wrap vc_column crum_vc',
						'group' => "Icon Style",
					),
					array(
						'type' => 'css_editor',
						'heading' => __('CSS box', 'dfd'),
						'param_name' => 'css',
						'group' => __('Design Options', 'dfd'),
					),
					array(
						'type' => 'dropdown',
						'heading'	 => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd').'</span></span>'.esc_html__('Animation', 'dfd'),
						'param_name' => 'module_animation',
						'value' => dfd_module_animation_styles(),
					),
					array(
						'type' => 'textfield',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
						'param_name' => 'el_class',
					),
				),
				'js_view' => 'VcBackendTtaAccordionView',
				'custom_markup' => '
<div class="vc_tta-container" data-vc-action="collapseAll">
	<div class="vc_general vc_tta vc_tta-accordion vc_tta-color-backend-accordion-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-o-shape-group vc_tta-controls-align-left vc_tta-gap-2">
	   <div class="vc_tta-panels vc_clearfix {{container-class}}">
	      {{ content }}
	      <div class="vc_tta-panel vc_tta-section-append">
	         <div class="vc_tta-panel-heading">
	            <h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left">
	               <a href="javascript:;" aria-expanded="false" class="vc_tta-backend-add-control">
	                   <span class="vc_tta-title-text">' . __('Add Section', 'dfd') . '</span>
	                    <i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i>
					</a>
	            </h4>
	         </div>
	      </div>
	   </div>
	</div>
</div>',
				'default_content' => '[vc_tta_section title="' . sprintf('%s %d', __('Section', 'dfd'), 1) . '"][/vc_tta_section][vc_tta_section title="' . sprintf('%s %d', __('Section', 'dfd'), 2) . '"][/vc_tta_section]',
			));
		}

		/**
		 * Shortcode handler function.
		 *
		 * @param array  $atts    Shortcode atributes.
		 * @param string $content Text Field.
		 *
		 * @return string
		 */
		function _dfd_accordion_shortcode($atts, $content) {
//			return  "Hello";
		}

	}

}
if (class_exists('Dfd_Accordion')) {
	$Dfd_Accordion = new Dfd_Accordion;
}
