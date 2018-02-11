<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
 * Add-on Name: Announcement Line
 */
if (!class_exists('Dfd_Tour')) {

	/**
	 * Class Dfd_Announcement
	 */
	class Dfd_Tour {

		/**
		 * Main construct class.
		 */
		function __construct() {
			add_action('init', array($this, '_dfd_tour_init'));
		}

		/**
		 * Block options.
		 */
		function _dfd_tour_init() {
			$module_images_accordion = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/tour/';

			vc_map(array(
				'name' => esc_html__('DFD Tour', 'dfd'),
				'base' => 'dfd_tta_tour',
				'icon' => 'dfd_tta_tour dfd_shortcode',
				'is_container' => true,
				'show_settings_on_create' => true,
				'as_parent' => array('only' => 'vc_tta_section'),
				'category' => esc_html__('Ronneby 2.0', 'dfd'),
				'description' => esc_html__('Vertical tabbed content', 'dfd'),
				'params' => array(
					array(
						'type' => 'radio_image_select',
						'heading' => esc_html__('Style', 'dfd'),
						'param_name' => 'style',
						'simple_mode' => false,
						'options' => array(
							'style-1' => array(
								'tooltip' => esc_attr__('Square Background', 'dfd'),
								'src' => $module_images_accordion . 'style-1.png'
							),
							'style-2' => array(
								'tooltip' => esc_attr__('Square Bordered', 'dfd'),
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
							'style-5' => array(
								'tooltip' => esc_attr__('Square Underline', 'dfd'),
								'src' => $module_images_accordion . 'style-5.png'
							),
						),
						'value' => 'style-1',
					),
					array(
						'type'       => 'dfd_font_container_param',
						'heading'    => '',
						'param_name' => 'tour_title_font_options',
						'settings'   => array(
							'fields' => array(
								//'tag' => 'h5',
								'letter_spacing',
								//'font_size',
								'line_height',
								//'color',
								'font_style'
							),
						),
						'group'      => esc_attr__( 'Text Style', 'dfd' ),
					),
					array(
						'type'			=> 'dfd_single_checkbox',
						'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
						'param_name'	=> 'tour_title_google_fonts',
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
						'param_name' => 'tour_title_custom_fonts',
						'value'      => '',
						'settings'   => array(
							'fields' => array(
								'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
								'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
							),
						),
						'dependency' => array('element' => 'tour_title_google_fonts', 'value' => 'yes'),
						'group'      => esc_attr__('Text Style', 'dfd'),
					),
					array(
						'type'			=> 'dfd_radio_advanced',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the text transform for the tour\'s title','dfd').'</span></span>'.esc_html__('Text transform', 'dfd'),
						'param_name'	=> 'tour_title_uppercase',
						'value'			=> '',
						'options'		=> array(
							esc_html__('Default', 'dfd') => '',
							esc_html__('None', 'dfd') => 'none',
							esc_html__('Capitalize', 'dfd') => 'capitalize',
							esc_html__('Lowercase', 'dfd') => 'lowercase',
							esc_html__('Uppercase', 'dfd') => 'uppercase',
						),
						'edit_field_class' => 'vc_column vc_col-sm-12',
						'group'			=> esc_html__('Text Style', 'dfd')
					),
					array(
						'type' => 'number',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the font size for the tour\'s title','dfd').'</span></span>'. esc_html__('Font size', 'dfd'),
						'param_name' => 'font_size',
						'value' => 14,
						'min' => 1,
						'max' => 100,
						'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
						'group' => esc_html__('Text Style', 'dfd')
					),
					array(
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the title. The default color is inherited from Theme Options > Custom typography > Text Typography','dfd').'</span></span>'.esc_html__('Title color', 'dfd'),
						'param_name' => 'tab_text_color',
						'value' => '',
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => esc_html__('Text Style', 'dfd')
					),
					array(
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the hover color for the title. The default color is inherited from Theme Options > Styling Options > Link Options > Link hover color','dfd').'</span></span>'.esc_html__('Title hover color', 'dfd'),
						'param_name' => 'tab_hover_text_color',
						'value' => '',
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => esc_html__('Text Style', 'dfd')
					),
					array(
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the active tab title. The default color is inherited from Theme Options > Custom typography > Text Typography','dfd').'</span></span>'. esc_html__('Active tab title color', 'dfd'),
						'param_name' => 'tab_active_color_text',
						'value' => '',
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => esc_html__('Text Style', 'dfd')
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
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => esc_html__('Text Style', 'dfd')
					),
					array(
						'type' => 'dfd_radio_advanced',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Select tour section title alignment', 'dfd') . '</span></span>' . esc_html__('Alignment', 'dfd'),
						'param_name' => 'alignment',
						'value' => 'left',
						'options' => array(
							esc_html__('Left', 'dfd') => 'left',
							esc_html__('Right', 'dfd') => 'right',
							esc_html__('Center', 'dfd') => 'center',
						),
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => esc_html__('Text Style', 'dfd')
					),
					array(
						'type' => 'dfd_radio_advanced',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows toy to specify the tabs position according to the tours content','dfd').'</span></span>'.  __('Tabs Position', 'dfd'),
						'param_name' => 'tab_position',
						'value' => 'left',
						'options' => array(
							esc_html__('Left', 'dfd') => 'left',
							esc_html__('Right', 'dfd') => 'right',
						),
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => esc_html__('Tab Style', 'dfd')
					),
					array(
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows toy to specify the background color for the tabs. The background color is not set by default','dfd').'</span></span>'. esc_html__('Tab background', 'dfd'),
						'param_name' => 'tab_background',
						'value' => '',
						'edit_field_class' => 'vc_column vc_col-sm-6 no-top-padding',
						'group' => esc_html__('Tab Style', 'dfd')
					),
					array(
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows toy to specify the background hover color for the tabs. The background color is not set by default','dfd').'</span></span>'.  esc_html__('Tab hover background', 'dfd'),
						'param_name' => 'tab_hover_background',
						'value' => '',
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => esc_html__('Tab Style', 'dfd')
					),
					array(
						'type' => 'colorpicker',
						"heading" => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the active tab. The default background color for the styles Square Background and Rounded Background is inherited from Theme Options > Styling Options > Third site color. The backgrouns color for the style other styles is transparent','dfd').'</span></span>'.esc_html__('Active tab background', 'dfd'),
						'param_name' => 'active_tab_background',
						'value' => '',
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => esc_html__('Tab Style', 'dfd')
					),
					array(
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border color. The default border color is not set by default','dfd').'</span></span>'.  esc_html__('Border Color', 'dfd'),
						'param_name' => 'border_color_radius',
						'value' => '',
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => esc_html__('Tab Style', 'dfd')
					),
					array(
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the active tab border color. The default border color for the styles Square Bordered and Rounded Bordered is inherited from Theme Options > Styling Options > Third site color. The default border color for the style Square Underline is #e6e6e6','dfd').'</span></span>'.esc_html__('Border Color active tab', 'dfd'),
						'param_name' => 'border_color_active',
						'value' => '',
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => esc_html__('Tab Style', 'dfd')
					),
					array(
						'type' => 'number',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border radius for the tabs','dfd').'</span></span>'.esc_html__('Border radius', 'dfd'),
						'param_name' => 'border_radius',
						'value' => '',
						'min' => 1,
						'max' => 10,
						'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
						'group' => esc_html__('Tab Style', 'dfd')
					),
					array(
						'type' => 'textfield',
						'param_name' => 'active_section',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the number of the section which should be active on page load. Note: to have all sections closed on initial load enter non-existing number','dfd').'</span></span>'. esc_html__('Active section', 'dfd'),
						'value' => 1,
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => esc_html__('Tab Style', 'dfd')
					),
					array(
						'type' => 'dropdown',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the size of the tour\'s navigation','dfd').'</span></span>'. esc_html__('Navigation size', 'dfd'),
						'param_name' => 'controls_size',
						'value' => array(
							esc_html__('Medium', 'dfd') => 'md',
							esc_html__('Auto', 'dfd') => '',
							esc_html__('Extra large', 'dfd') => 'xl',
							esc_html__('Large', 'dfd') => 'lg',
							esc_html__('Small', 'dfd') => 'sm',
							esc_html__('Extra small', 'dfd') => 'xs',
						),
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => esc_html__('Tab Style', 'dfd')
					),
					array(
						'type' => 'dropdown',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the space in tabs', 'dfd') . '</span></span>' . esc_html__('Gap', 'dfd'),
						'param_name' => 'spacing',
						'value' => array(
							__('None', 'dfd') => '',
							'1px' => '1',
							'2px' => '2',
							'3px' => '3',
							'4px' => '4',
							'5px' => '5',
							'10px' => '10',
							'15px' => '15',
							'20px' => '20',
							'25px' => '25',
							'30px' => '30',
							'35px' => '35',
						),
						'std' => '5',
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => esc_html__('Tab Style', 'dfd')
					),
					array(
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify icons color. The default color is inherited from Theme Options > Custom typography > Text Typography', 'dfd') . '</span></span>' . esc_html__('Icon Color', 'dfd'),
						'param_name' => 'icon_color',
						'value' => '',
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => esc_html__('Icon Style', 'dfd')
					),
					array(
						'type' => 'number',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set icon size','dfd').'</span></span>'. esc_html__('Icon size', 'dfd'),
						'param_name' => 'icon_size',
						'value' => 14,
						'min' => 1,
						'max' => 100,
						'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap no-top-padding',
						'group' => esc_html__('Icon Style', 'dfd')
					),
					array(
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the content background color. The color is not set by default', 'dfd') . '</span></span>' .  esc_html__('Content background color ', 'dfd'),
						'param_name' => 'color_content_area',
						'value' => '',
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => esc_html__('Content Style', 'dfd')
					),
					array(
						'type' => 'dropdown',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the margin between tabs and content. The bidder gap you set the smaller tab container will be', 'dfd') . '</span></span>' . esc_html__('Gap', 'dfd'),
						'param_name' => 'gap',
						'value' => array(
							'20px' => '20',
							esc_html__('None', 'dfd') => '',
							'1px' => '1',
							'2px' => '2',
							'3px' => '3',
							'4px' => '4',
							'5px' => '5',
							'10px' => '10',
							'15px' => '15',
							'25px' => '25',
							'30px' => '30',
							'35px' => '35',
						),
						'edit_field_class' => 'vc_column vc_col-sm-6 no-top-padding',
						'group' => esc_html__('Content Style', 'dfd')
					),
					array(
						'type' => 'dfd_single_checkbox',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to enable or disable the devider between tabs and conent', 'dfd') . '</span></span>' . esc_html__('Delimiter line between tabs and content', 'dfd'),
						'param_name' => 'show_separator_line',
						'value' => 'on',
						'options' => array(
							'on' => array(
								'on' => 'Yes',
								'off' => 'No',
							),
						),
						'edit_field_class' => 'vc_column vc_col-sm-6',
						'group' => esc_html__('Content Style', 'dfd')
					),
					array(
						'type' => 'dropdown',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose one of the 6 preset pagination styles','dfd').'</span></span>'. esc_html__('Pagination style', 'dfd'),
						'param_name' => 'pagination_style',
						'value' => array(
							esc_html__('None', 'dfd') => '',
							/* Dfd style pagination */
							esc_html__('Dfd Style rounded', 'dfd') => 'dfdrounded-',
							esc_html__('Dfd Style fill rounded', 'dfd') => 'dfdfillrounded-',
							esc_html__('Dfd Style fill square', 'dfd') => 'dfdfillsquare-',
							esc_html__('Dfd Style empty rounded', 'dfd') => 'dfdemptyrounded-',
							esc_html__('Dfd Style line', 'dfd') => 'dfdline-',
							esc_html__('Dfd Style advance square', 'dfd') => 'dfdadvancesquare-',
						),
						'edit_field_class' => 'vc_column vc_col-sm-6',
					),
					array(
						'type' => 'dropdown',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enable the automatical tabs rotation, choose the periodicity of tours rotation in seconds','dfd').'</span></span>'.esc_html__('Autorotate', 'dfd'),
						'param_name' => 'autoplay',
						'value' => array(
							esc_html__('None', 'dfd') => 'none',
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
						'edit_field_class' => 'vc_column vc_col-sm-6',
					),
					array(
						'type' => 'css_editor',
						'heading' => esc_html__('CSS box', 'dfd'),
						'param_name' => 'css',
						'group' => esc_html__('Design Options', 'dfd'),
					),
					array(
						'type'       => 'dropdown',
						'heading'	 => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd').'</span></span>'.esc_html__('Animation', 'dfd'),
						'param_name' => 'module_animation',
						'value'      => dfd_module_animation_styles(),
					),
					array(
						'type' => 'textfield',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
						'param_name' => 'el_class',
					),
				),
				'js_view' => 'VcBackendTtaTourView',
				'custom_markup' => '
<div class="vc_tta-container" data-vc-action="collapse">
	<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-left vc_tta-controls-align-left">
		<div class="vc_tta-tabs-container">'
				. '<ul class="vc_tta-tabs-list">'
				. '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}"><a href="javascript:;" data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}" data-vc-tabs>{{ section_title }}</a></li>'
				. '</ul>
		</div>
		<div class="vc_tta-panels {{container-class}}">
		  {{ content }}
		</div>
	</div>
</div>',
				'default_content' => '
[vc_tta_section title="' . sprintf('%s %d', __('Section', 'dfd'), 1) . '"][/vc_tta_section]
[vc_tta_section title="' . sprintf('%s %d', __('Section', 'dfd'), 2) . '"][/vc_tta_section]
	',
				'admin_enqueue_js' => array(
					vc_asset_url('lib/vc_tabs/vc-tabs.min.js')
				),
				'front_enqueue_js' => get_template_directory_uri() . '/assets/js/tabsModelextended.js'
			));
		}

	}

}
if (class_exists('Dfd_Accordion')) {
	$Dfd_Tour = new Dfd_Tour;
}
