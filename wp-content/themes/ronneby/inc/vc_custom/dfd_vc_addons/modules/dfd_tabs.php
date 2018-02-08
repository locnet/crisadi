<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
 * Add-on Name: Announcement Line
 */
if (!class_exists('Dfd_Tabs')) {

	/**
	 * Class Dfd_Announcement
	 */
	class Dfd_Tabs {

		/**
		 * Main construct class.
		 */
		function __construct() {
			add_action('init', array($this, '_dfd_tabs_init'));
		}

		/**
		 * Block options.
		 */
		function _dfd_tabs_init() {
			$module_images_accordion = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/tabs/';

			vc_map(array(
				'name' => __('DFD Tabs', 'dfd'),
				'base' => 'dfd_tta_tabs',
				'icon' => 'dfd_tta_tabs dfd_shortcode',
				'is_container' => true,
				'show_settings_on_create' => true,
				'as_parent' => array('only' => 'vc_tta_section'),
				'category' => __('Ronneby 2.0', 'dfd'),
				'description' => __('Tabbed content', 'dfd'),
				'params' => array(
					array(
						'type' => 'radio_image_select',
						'heading' => esc_html__('Style', 'dfd'),
						'param_name' => 'style',
						'simple_mode' => false,
						'options' => array(
							'classic' => array(
								'tooltip' => esc_attr__('Classic Rounded', 'dfd'),
								'src' => $module_images_accordion . 'classic.png'
							),
							'classic_empty' => array(
								'tooltip' => esc_attr__('Simple', 'dfd'),
								'src' => $module_images_accordion . 'classic_empty.png'
							),
							'collapse' => array(
								'tooltip' => esc_attr__('Square Background', 'dfd'),
								'src' => $module_images_accordion . 'collapse.png'
							),
							'big_icon' => array(
								'tooltip' => esc_attr__('Big Icon', 'dfd'),
								'src' => $module_images_accordion . 'big_icon.png'
							),
							'empty_style' => array(
								'tooltip' => esc_attr__('Empty', 'dfd'),
								'src' => $module_images_accordion . 'empty.png'
							),
						),
						'value' => 'classic',
					),
					array(
						'type' => 'number',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border radius for the tabs','dfd').'</span></span>'. esc_html__('Border radius', 'dfd'),
						'param_name' => 'border_radius',
						'value' => 42,
						'min' => 1,
						'max' => 100,
//						'weight' => 450,
						'dependency' => array('element' => 'style', 'value' => array('classic', 'classic_empty')),
						'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
						'group' => esc_html__('Tabs Style', 'dfd')
					),
					array(
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border color. The default border color is #e6e6e6','dfd').'</span></span>'. esc_html__('Border Color', 'dfd'),
						'param_name' => 'border_color_radius',
						'value' => '',
//						'weight' => 400,
						'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding',
						'dependency' => array('element' => 'style', 'value' => array('classic', 'classic_empty', 'collapse', 'big_icon')),
						'group' => esc_html__('Tabs Style', 'dfd')
					),
					array(
						'type' => 'dfd_radio_advanced',
						'param_name' => 'tab_position',
						'value' => 'top',
						'options' => array(
							esc_html__('Top', 'dfd') => 'top',
							esc_html__('Bottom', 'dfd') => 'bottom',
						),
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows toy to specify the tabs position according to the tabs content','dfd').'</span></span>'.  __('Tabs Position', 'dfd'),
						'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding',
						'group' => esc_html__('Tabs Style', 'dfd')
					),
					array(
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows toy to specify the background color for the tabs. The background color is not set by default','dfd').'</span></span>'. esc_html__('Tab background', 'dfd'),
						'param_name' => 'tab_background',
						'value' => '',
						'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding',
						'dependency' => array('element' => 'style', 'value' => array('classic', 'classic_empty', 'collapse', 'big_icon')),
						'group' => esc_html__('Tabs Style', 'dfd')
					),
					array(
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows toy to specify the background hover color for the tabs. The background color is not set by default','dfd').'</span></span>'. esc_html__('Tab hover background', 'dfd'),
						'param_name' => 'tab_hover_background',
						'value' => '',
						'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding',
						'dependency' => array('element' => 'style', 'value' => array('classic', 'classic_empty', 'collapse', 'big_icon')),
						'group' => esc_html__('Tabs Style', 'dfd')
					),
					array(
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the active tab. The default background color for the style Classic Rounded is inherited from Theme Options > Styling Options > Third site color. The backgrouns color for the style Simple is transparent, for the style Square backgrouns color is #1b1b1, for the style Big icon color is #fff','dfd').'</span></span>'. esc_html__('Active tab background', 'dfd'),
						'param_name' => 'active_tab_background',
						'value' => '',
						'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding',
						'dependency' => array('element' => 'style', 'value' => array('classic', 'classic_empty', 'collapse', 'big_icon')),
						'group' => esc_html__('Tabs Style', 'dfd')
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
						'type'			=> 'dfd_radio_advanced',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the text transform for the tab\'s title','dfd').'</span></span>'. esc_html__('Text transform', 'dfd'),
						'param_name'	=> 'tab_title_uppercase',
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
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the font size for the tab\'s title','dfd').'</span></span>'. esc_html__('Font size', 'dfd'),
						'param_name' => 'font_size',
						'value' => 14,
						'min' => 1,
						'max' => 100,
//						'weight' => 450,
						'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
						'dependency' => array('element' => 'style', 'value' => array('classic', 'classic_empty', 'collapse', 'empty_style')),
						'group' => esc_html__('Text Style', 'dfd')
					),
					array(
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the title. The default color is inherited from Theme Options > Styling options > Link options > Link Typography','dfd').'</span></span>'.esc_html__('Title color', 'dfd'),
						'param_name' => 'tab_text_color',
						'value' => '',
						'dependency' => array('element' => 'style', 'value' => array('classic', 'classic_empty', 'collapse', 'empty_style')),
						'edit_field_class'	=> 'vc_column vc_col-sm-6',
						'group' => esc_html__('Text Style', 'dfd')
					),
					array(
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the hover color for the title. The default color is inherited from Theme Options > Styling Options > Main site color','dfd').'</span></span>'.esc_html__('Title hover color', 'dfd'),
						'param_name' => 'tab_hover_text_color',
						'value' => '',
						'dependency' => array('element' => 'style', 'value' => array('classic', 'classic_empty', 'collapse', 'empty_style')),
						'edit_field_class'	=> 'vc_column vc_col-sm-6',
						'group' => esc_html__('Text Style', 'dfd')
					),
					array(
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the active tab title. The default color is inherited from Theme Options > Styling options > Link options > Link Typography','dfd').'</span></span>'. esc_html__('Active tab title color', 'dfd'),
						'param_name' => 'tab_active_color_text',
						'value' => '',
						'dependency' => array('element' => 'style', 'value' => array('classic', 'classic_empty', 'collapse', 'empty_style')),
						'edit_field_class'	=> 'vc_column vc_col-sm-6',
						'group' => esc_html__('Text Style', 'dfd')
					),
					array(
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the hover color for the active tab title. The default color is inherited from Theme Options > Styling Options > Main site color','dfd').'</span></span>'. esc_html__('Active tab title hover color', 'dfd'),
						'param_name' => 'tab_active_hover_color_text',
						'value' => '',
						'dependency' => array('element' => 'style', 'value' => array('classic', 'classic_empty', 'collapse', 'empty_style')),
						'edit_field_class'	=> 'vc_column vc_col-sm-6',
						'group' => esc_html__('Text Style', 'dfd')
					),
					array(
						'type' => 'dfd_single_checkbox',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the underline decoration for the tab','dfd').'</span></span>'. esc_html__('Underline in tab', 'dfd'),
						'param_name' => 'underline',
						'value' => 'off',
						'options' => array(
							'on' => array(
								'on' => 'Yes',
								'off' => 'No',
							),
						),
//						'weight' => 300,
						'dependency' => array('element' => 'style', 'value' => array('classic_empty')),
						'edit_field_class'	=> 'vc_column vc_col-sm-6',
						'group' => esc_html__('Text Style', 'dfd')
					),
					array(
						'type' => 'dfd_radio_advanced',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Select tabs section title alignment', 'dfd') . '</span></span>' . esc_html__('Alignment', 'dfd'),
						'param_name' => 'alignment',
						'value' => 'left',
						'options' => array(
							esc_html__('Left', 'dfd') => 'left',
							esc_html__('Right', 'dfd') => 'right',
							esc_html__('Center', 'dfd') => 'center',
						),
						'edit_field_class'	=> 'vc_column vc_col-sm-6',
						'group' => esc_html__('Text Style', 'dfd')
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
//						'weight' => 400,
						'edit_field_class'	=> 'vc_column vc_col-sm-6',
						'group' => esc_html__('Content Style', 'dfd')
					),
					array(
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the content background color. The color is not set by default', 'dfd') . '</span></span>' .  esc_html__('Content background color ', 'dfd'),
						'param_name' => 'color_content_area',
						'value' => '',
						'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding',
						'group' => esc_html__('Content Style', 'dfd')
					),
					array(
						'type' => 'dropdown',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the space between tabs and content', 'dfd') . '</span></span>' . esc_html__('Gap', 'dfd'),
						'param_name' => 'gap',
						'value' => array(
							esc_html__('None', 'dfd') => '',
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
						'edit_field_class'	=> 'vc_column vc_col-sm-6',
						'group' => esc_html__('Content Style', 'dfd')
					),
					array(
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify icons color. The default color is inherited from Theme Options > Styling options > Link options > Link Typography ', 'dfd') . '</span></span>' . esc_html__('Icon Color', 'dfd'),
						'param_name' => 'icon_color',
						'value' => '',
						'edit_field_class'	=> 'vc_column vc_col-sm-6',
						'group' => esc_html__('Icon Style', 'dfd')
					),
					array(
						'type' => 'number',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set icon size','dfd').'</span></span>'. esc_html__('Icon size', 'dfd'),
						'param_name' => 'icon_size',
						'value' => 30,
						'min' => 1,
						'max' => 100,
						'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding crum_vc dfd-number-wrap',
						'group' => esc_html__('Icon Style', 'dfd')
					),
					array(
						'type' => 'dropdown',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enable the automatical tabs rotation, choose the periodicity of tabs rotation in seconds','dfd').'</span></span>'.esc_html__('Autorotate', 'dfd'),
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
					),
					array(
						'type' => 'textfield',
						'param_name' => 'active_section',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the number of the section which should be active on page load. Note: to have all sections closed on initial load enter non-existing number.','dfd').'</span></span>'.esc_html__('Active section', 'dfd'),
						'value' => 1,
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
				'js_view' => 'VcBackendTtaTabsView',
				'custom_markup' => '
<div class="vc_tta-container" data-vc-action="collapse">
	<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
		<div class="vc_tta-tabs-container">'
				. '<ul class="vc_tta-tabs-list">'
				. '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="vc_tta_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
				. '</ul>
		</div>
		<div class="vc_tta-panels vc_clearfix {{container-class}}">
		  {{ content }}
		</div>
	</div>
</div>',
				'default_content' => '
[vc_tta_section title="' . sprintf('%s %d', __('Tab', 'dfd'), 1) . '"][/vc_tta_section]
[vc_tta_section title="' . sprintf('%s %d', __('Tab', 'dfd'), 2) . '"][/vc_tta_section]
	',
				'admin_enqueue_js' => array(
					vc_asset_url('lib/vc_tabs/vc-tabs.min.js'),
				),
				'front_enqueue_js' => get_template_directory_uri() . '/assets/js/tabsModelextended.js'
			));
		}

	}

}
if (class_exists('Dfd_Tabs')) {
	$Dfd_Tour = new Dfd_Tabs;
}
