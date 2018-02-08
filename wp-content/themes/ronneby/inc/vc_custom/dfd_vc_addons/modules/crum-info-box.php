<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Info box
*/

if ( ! class_exists( 'Dfd_Info_Box' ) ) {

	class Dfd_Info_Box {

		function __construct() {
			add_action( 'init', array( &$this, 'info_box_init' ) );
			add_shortcode( 'dfd_info_box', array( &$this, 'info_box_form' ) );
		}

		function info_box_init() {

			if ( function_exists( 'vc_map' ) ) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/info_box/';

				$delim_options_base = _crum_vc_delim_settings();

				$delim_options_style = array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Delimiter style', 'dfd' ),
					'param_name' => 'delimiter_style',
					'value'      => array(
						esc_html__( 'Theme default', 'dfd' )  => '',
						esc_html__( 'Solid', 'dfd' )  => 'solid',
						esc_html__( 'Dotted', 'dfd' ) => 'dotted',
						esc_html__( 'Dashed', 'dfd' ) => 'dashed',
					),
					'group'      => esc_html__( 'Style', 'dfd' ),
				);
				$content_under_offset = array(
					'type'       => 'number',
					'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the space above the info box content ','dfd').'</span></span>'.esc_html__( 'Offset above content', 'dfd' ),
					'param_name' => 'content_under_offset',
					'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
					'group'      => esc_html__( 'Style', 'dfd' ),
				);
				
				$delim_options = $delim_options_base;
				$delim_options[0] = $delim_options_style;
				$delim_options[] = $content_under_offset;

				vc_map(
					array(
						'name'        => esc_html__('Info box', 'dfd'),
						'base'        => 'dfd_info_box',
						"icon"        => 'dfd_info_box dfd_shortcode',
						'category'    => esc_html__('Ronneby 2.0', 'dfd'),
						'description' => esc_html__('Box with information', 'dfd'),
						'params'      => array_merge(
							array(
								array(
									'heading'     => esc_html__( 'Style', 'dfd' ),
									'type'        => 'radio_image_select',
									'param_name'  => 'style',
									'simple_mode' => false,
									'options'     => array(
										'style-01'	=> array(
											'tooltip'	=> esc_attr__('Simple','dfd'),
											'src'		=> $module_images . 'style-01.png'
										),
										'style-02'	=> array(
											'tooltip'	=> esc_attr__('Solid','dfd'),
											'src'		=> $module_images . 'style-02.png'
										),
										'style-03'	=> array(
											'tooltip'	=> esc_attr__('Bordered','dfd'),
											'src'		=> $module_images . 'style-03.png'
										),
										'style-04'	=> array(
											'tooltip'	=> esc_attr__('Framed','dfd'),
											'src'		=> $module_images . 'style-04.png'
										),
										'style-05'	=> array(
											'tooltip'	=> esc_attr__('Image background','dfd'),
											'src'		=> $module_images . 'style-05.png'
										),
										'style-06'	=> array(
											'tooltip'	=> esc_attr__('Overlay','dfd'),
											'src'		=> $module_images . 'style-06.png'
										),
									),
								),
								array(
									'heading'     => esc_html__( 'Layout', 'dfd' ),
									'type'        => 'radio_image_select',
									'param_name'  => 'layout',
									'simple_mode' => false,
									'options'     => array(
										'layout-01'	=> array(
											'tooltip'	=> esc_attr__('Top','dfd'),
											'src'		=> $module_images . 'layout-01.png'
										),
										'layout-02'	=> array(
											'tooltip'	=> esc_attr__('Bottom','dfd'),
											'src'		=> $module_images . 'layout-02.png'
										),
										'layout-03'	=> array(
											'tooltip'	=> esc_attr__('Middle','dfd'),
											'src'		=> $module_images . 'layout-03.png'
										),
										'layout-04'	=> array(
											'tooltip'	=> esc_attr__('Left','dfd'),
											'src'		=> $module_images . 'layout-04.png'
										),
										'layout-05'	=> array(
											'tooltip'	=> esc_attr__('Right','dfd'),
											'src'		=> $module_images . 'layout-05.png'
										),
										'layout-06'	=> array(
											'tooltip'	=> esc_attr__('Top left','dfd'),
											'src'		=> $module_images . 'layout-06.png'
										),
										'layout-07'	=> array(
											'tooltip'	=> esc_attr__('Top right','dfd'),
											'src'		=> $module_images . 'layout-07.png'
										),
									),
									'dependency'  => array(
										'element'            => 'style',
										'value_not_equal_to' => array( 'style-06' ),
									),
								),
								array(
									'type'				=> 'dfd_radio_advanced',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the horizontal alignment for the info box','dfd').'</span></span>'.esc_html__('Alignment', 'dfd'),
									'param_name'		=> 'content_alignment',
									'value'				=> 'text-center',
									'options'			=> array(
										esc_html__('Left', 'dfd')	=> 'text-left',
										esc_html__('Center', 'dfd')	=> 'text-center',
										esc_html__('Right', 'dfd')	=> 'text-right'
									),
									'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc',
									'dependency'		=> array('element' => 'layout', 'value' => array('layout-01', 'layout-02', 'layout-03')),
								),
								array(
									'type'       => 'dfd_radio_advanced',
									'heading'    => esc_html__( 'Hover', 'dfd' ).' '.esc_html__( 'Animation', 'dfd' ),
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the hover animation for the info box','dfd').'</span></span>'.esc_html__( 'Hover', 'dfd' ).' '.esc_html__( 'Animation', 'dfd' ),
									'param_name' => 'hover_animation',
									'value' => '',
									'options' => array(
										__('No Effect', 'dfd') => '',
										__('Icon Bounce Up', 'dfd') => 'hover-up-icon',
										__('All box bounce up', 'dfd') => 'hover-up-box',
									),
								),
								array(
									'type'       => 'dropdown',
									'heading'	 => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd').'</span></span>'.esc_html__('Animation', 'dfd'),
									'param_name' => 'module_animation',
									'value'      => dfd_module_animation_styles(),
								),
								array(
									'type'        => 'textfield',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
									'param_name'  => 'el_class',
								),
								array(
									'type'        => 'textfield',
									'heading'     => esc_html__( 'Title', 'dfd' ),
									'param_name'  => 'title',
									'admin_label' => true,
									'group'       => esc_html__( 'Content', 'dfd' ),
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__( 'Subtitle', 'dfd' ),
									'param_name' => 'subtitle',
									'group'      => esc_html__( 'Content', 'dfd' ),
								),
								array(
									'type'       => 'textarea',
									'heading'    => esc_html__( 'Content', 'dfd' ),
									'param_name' => 'content',
									'group'      => esc_html__( 'Content', 'dfd' ),
								),

								array(
									'type' => 'dfd_radio_advanced',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select where the link should be applied','dfd').'</span></span>'.esc_html__('Apply link to', 'dfd'),
									'param_name' => 'read_more',
									'value' => 'none',
									'options' => array(
										esc_html__('No Link', 'dfd') => '',
										esc_html__('Complete Box', 'dfd') => 'box',
										esc_html__('Box Title', 'dfd') => 'title',
										esc_html__('Read More', 'dfd') => 'more',
									),
									'group'      => esc_html__( 'Content', 'dfd' ),
								),
								array(
									'type'       => 'vc_link',
									'heading'	 => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add a custom link or select existing page. You can remove existing link as well','dfd').'</span></span>'.esc_html__('Link URL', 'dfd'),
									'param_name' => 'link',
									'description' => esc_html__( 'Add a custom link or select existing page. You can remove existing link as well.', 'dfd' ),
									'dependency' => array('element' => 'read_more', 'value' => array('box','title','more')),
									'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
									'group'      => esc_html__( 'Content', 'dfd' ),
								),
								array(
									'type'       => 'dfd_single_checkbox',
									'heading'	 => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the Read more button for the info box','dfd').'</span></span>'.esc_html__('Read more button', 'dfd'),
									'param_name' => 'readmore_show',
									'options'			=> array(
										'yes'				=> array(
											'yes'				=> esc_attr__('Yes', 'dfd'),
											'no'				=> esc_attr__('No', 'dfd'),
										),
									),
									'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
									'group'      => esc_html__( 'Content', 'dfd' ),
								),
								array(
									'type'       => 'dfd_radio_advanced',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the visibility options for the Read more button','dfd').'</span></span>'.esc_html__('Button visibility', 'dfd'),
									'param_name' => 'more_show',
									'value'		 => 'permanent',
									'options'      => array(
										esc_html__( 'Permanent', 'dfd' )     => 'permanent',
										esc_html__( 'Show on hover', 'dfd' ) => 'hover',
									),
									'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
									'dependency' => array('element' => 'readmore_show', 'value'   => array( 'yes' )),
									'group'      => esc_html__( 'Content', 'dfd' ),
								),

								array(
									'type' => 'dropdown',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose one of the 8 preset read more styles', 'dfd') . '</span></span>' . esc_html__('Read more style', 'dfd'),
									'param_name' => 'readmore_style',
									'value' => array(
										esc_html__('Text link', 'dfd') => 'read-more-01',
										esc_html__('Lines', 'dfd') => 'read-more-02',
										esc_html__('Dots', 'dfd') => 'read-more-03',
										esc_html__('Slashes', 'dfd') => 'read-more-04',
										esc_html__('Text + Arrow', 'dfd') => 'read-more-05',
										esc_html__('Arrow', 'dfd') => 'read-more-06',
										esc_html__('Circle', 'dfd') => 'read-more-07',
										esc_html__('Button', 'dfd') => 'read-more-08',
										esc_html__('Text shaffle', 'dfd') => 'read-more-09',
										esc_html__('Lines to crosses', 'dfd') => 'read-more-10',
									),
									'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
									'dependency' => array('element' => 'readmore_show', 'value' => 'yes',),
									'group' => esc_html__('Content', 'dfd'),
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__( 'Read more', 'dfd' ) . ' ' . esc_html__( 'Text', 'dfd' ),
									'param_name' => 'readmore_text',
									'value'      => esc_html__( 'Read more', 'dfd' ),
									'dependency' => array('element' => 'readmore_style', 'value' => array( 'read-more-01', 'read-more-05', 'read-more-08', 'read-more-09')),
									'group'      => esc_html__( 'Content', 'dfd' ),
								),
								array(
									'type'       => 'dfd_single_checkbox',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to set the number in a circled background on the icon', 'dfd') . '</span></span>' .esc_html__('Number at icon', 'dfd'),
									'param_name' => 'icon_number',
									'options'			=> array(
										'yes'				=> array(
											'yes'				=> esc_attr__('Yes', 'dfd'),
											'no'				=> esc_attr__('No', 'dfd'),
										),
									),
									'edit_field_class' => 'vc_col-sm-4 vc_column crum_vc',
									'dependency' => array('element' => 'style', 'value_not_equal_to' => array( 'style-06' ),),
									'group'      => esc_attr__( 'Icon', 'dfd' ),
								),
								array(
									'type'       => 'textfield',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Enter the number you\'d like to show', 'dfd') . '</span></span>' .esc_html__('Number', 'dfd'),
									'param_name' => 'icon_number_text',
									'dependency' => array( 'element' => 'icon_number', 'value' => 'yes' ),
									'edit_field_class' => 'vc_col-sm-4 vc_column crum_vc no-top-padding',
									'group'      => esc_html__( 'Icon', 'dfd' ),
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the background color for the number. The default value is #a16961', 'dfd') . '</span></span>'.esc_html__( 'Background', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
									'param_name' => 'number_bg_color',
									'edit_field_class' => 'vc_col-sm-4 vc_column crum_vc no-top-padding',
									'dependency' => array( 'element' => 'icon_number', 'value' => 'yes' ),
									'group'      => esc_html__( 'Icon', 'dfd' ),
								),
								array(
									'type'       => 'dfd_radio_advanced',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Use the existing icon font, upload custom image or add the text', 'dfd').'</span></span>'.esc_html__('Icon to display', 'dfd'),
									'param_name' => 'icon_type',
									'value'		 => 'selector',
									'options'      => array(
										esc_html__( 'Icon', 'dfd' ) => 'selector',
										esc_html__( 'Image', 'dfd' ) => 'custom',
										esc_html__( 'Text', 'dfd' ) => 'text',
									),
									'group'      => esc_html__( 'Icon', 'dfd' ),
								),
								array(
									'type'             => 'number',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the opacity value for the info box icon. The minimum value is 0(the icon will be transparent), the maximum value is 100%', 'dfd').'</span></span>'.esc_html__( 'Opacity', 'dfd' ),
									'param_name'       => 'opacity',
									'min'              => '0',
									'max'              => '100',
									'value'            => '100',
									'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc dfd-number-percent',
									'dependency' => array( 'element' => 'icon_type', 'value' => array( 'selector', 'custom' ) ),
									'group'            => esc_html__( 'Icon', 'dfd' ),
								),
								array(
									'type'       => 'number',
									'heading'	=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the size of the icon set for the info box', 'dfd').'</span></span>'.esc_html__( 'Icon size', 'dfd' ),
									'param_name' => 'icon_size',
									'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
									'min'        => 12,
									'dependency' => array( 'element' => 'icon_type', 'value' => array( 'selector', 'custom' ) ),
									'group'      => esc_html__( 'Icon', 'dfd' ),
								),
								array(
									'type'       => 'colorpicker',
									'class'      => 'crum_vc',
									'heading'	=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the color of the icon set for the info box. The default value is inherited from Theme Option > Typograhy settings > H1, color value with opacity 20%', 'dfd').'</span></span>'.esc_html__( 'Color', 'dfd' ),
									'param_name' => 'icon_color',
									'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
									'dependency' => array( 'element' => 'icon_type', 'value' => array( 'selector' ) ),
									'group'      => esc_html__( 'Icon', 'dfd' ),
								),
								array(
									'type'       => 'colorpicker',
									'class'      => 'crum_vc',
									'heading'	=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the hover color of the icon set for the info box. The default value is inherited from Theme Option > Typograhy settings > H1, color value with opacity 20%', 'dfd').'</span></span>'. esc_html__( 'Hover Color', 'dfd' ),
									'param_name' => 'icon_hover',
									'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
									'dependency' => array( 'element' => 'icon_type', 'value' => array( 'selector' ) ),
									'group'      => esc_html__( 'Icon', 'dfd' ),
								),
								array(
									'type'       => 'icon_manager',
									'heading'    => esc_html__( 'Select Icon ', 'dfd' ),
									'param_name' => 'icon',
									'value'      => '',
									'group'      => esc_html__( 'Icon', 'dfd' ),
									'dependency' => array( 'element' => 'icon_type', 'value' => array( 'selector' ) ),
								),
								array(
									'type'        => 'attach_image',
									'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the custom image from media library','dfd').'</span></span>'.esc_html__('Upload Image', 'dfd'),
									'param_name'  => 'icon_image_id',
									'admin_label' => true,
									'value'       => '',
									'group'       => esc_html__( 'Icon', 'dfd' ),
									'dependency'  => array( 'element' => 'icon_type', 'value' => array( 'custom' ) ),
								),
								array(
									'type'				=> 'textfield',
									'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the text which should be displayed instead of the info box icon','dfd').'</span></span>'.esc_html__('Text', 'dfd'),
									'param_name'		=> 'icon_text',
									'dependency'		=> array('element' => 'icon_type', 'value' => array('text')),
									'group'				=> esc_html__('Icon', 'dfd'),
								),
								array(
									'type'				=> 'dfd_font_container_param',
									'param_name'		=> 'text_icon_font_options',
									'settings'			=> array(
										'fields'		=> array(
											'font_size',
											'letter_spacing',
											'color',
											'font_style'
										),
									),
									'dependency'		=> array('element' => 'icon_type', 'value' => array('text')),
									'group'				=> esc_html__('Icon', 'dfd'),
								),
								array(
									'type'				=> 'dfd_single_checkbox',
									'heading'			=> esc_html__('Custom font family', 'dfd'),
									'param_name'		=> 'text_icon_use_google_fonts',
									'options'			=> array(
										'yes'				=> array(
											'yes'				=> esc_attr__('Yes', 'dfd'),
											'no'				=> esc_attr__('No', 'dfd'),
										),
									),
									'dependency'		=> array('element' => 'icon_type', 'value' => array('text')),
									'group'				=> esc_html__('Icon', 'dfd'),
								),
								array(
									'type'				=> 'google_fonts',
									'param_name'		=> 'text_icon_custom_fonts',
									'settings'			=> array(
										'fields'			=> array(
											'font_family_description' => esc_html__('Select font family.', 'dfd'),
											'font_style_description'  => esc_html__('Select font style.', 'dfd'),
										),
									),
									'dependency'		=> array('element' => 'text_icon_use_google_fonts', 'value' => 'yes'),
									'group'				=> esc_html__('Icon', 'dfd'),
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Will work for the styles with the background', 'dfd' ),
									'param_name'       => 'title_ibg',
									'dependency' => array('element' => 'icon_type', 'value' => array('selector', 'custom')),
									'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
									'group'         => esc_html__( 'Icon BG.', 'dfd' ),
								),
								array(
									'type'       => 'number',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the background size for the icon','dfd').'</span></span>'.esc_html__( 'Icon background size', 'dfd' ),
									'param_name' => 'icon_bg_size',
									'min'        => 0,
									'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
									'group'      => esc_html__( 'Icon BG.', 'dfd' ),
								),
								array(
									'type'       => 'number',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border radius for the icon\'s background','dfd').'</span></span>'. esc_html__( 'Border radius', 'dfd' ),
									'param_name' => 'border_radius',
									'min'        => 0,
									'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
									'group'      => esc_html__( 'Icon BG.', 'dfd' ),
								),
								array(
									'type'       => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border color for the icon\'s background','dfd').'</span></span>'.esc_html__( 'Border', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
									'param_name' => 'border_color',
									'edit_field_class' => 'vc_column vc_col-sm-6',
									'dependency' => array('element' => 'style', 'value'   => array( 'style-03', 'style-04', 'style-05' ),),
									'group'      => esc_html__( 'Icon BG.', 'dfd' ),
								),
								array(
									'type'       => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border hover color for the icon\'s background','dfd').'</span></span>'.esc_html__( 'Hover', 'dfd' ) .' '.esc_html__( 'Border', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
									'param_name' => 'hover_icon_border',
									'edit_field_class' => 'vc_column vc_col-sm-6',
									'dependency' => array('element' => 'style', 'value'   => array( 'style-03', 'style-04', 'style-05' ),),
									'group'      => esc_html__( 'Icon BG.', 'dfd' ),
								),
								array(
									'type'       => 'number',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the width for the border','dfd').'</span></span>'.esc_html__( 'Border width', 'dfd' ),
									'param_name' => 'border_width',
									'min'        => 0,
									'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
									'dependency' => array('element' => 'style', 'value'   => array( 'style-03', 'style-05' ),),
									'group'      => esc_html__( 'Icon BG.', 'dfd' ),
								),
								array(
									'type'       => 'colorpicker',
									'heading'	=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the start background color for the icon\'s background. The default color is inherited from Theme Options > Styling options > Third site color','dfd').'</span></span>'.esc_html__( 'Start', 'dfd' ) .' '. esc_html__( 'Background', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
									'param_name' => 'fill_color_start',
									'edit_field_class' => 'vc_column vc_col-sm-6',
									'group'      => esc_html__( 'Icon BG.', 'dfd' ),
								),
								array(
									'type'       => 'colorpicker',
									'heading'	=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the end background color for the icon\'s background. The default color is inherited from Theme Options > Styling options > Third site color','dfd').'</span></span>'.esc_html__( 'End', 'dfd' ) .' '. esc_html__( 'Background', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
									'param_name' => 'fill_color_end',
									'edit_field_class' => 'vc_column vc_col-sm-6',
									'group'      => esc_html__( 'Icon BG.', 'dfd' ),
								),
								array(
									'type'       => 'colorpicker',
									'heading'	=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the hover background color for the icon\'s background. The default color is inherited from Theme Options > Styling options > Third site color','dfd').'</span></span>'.esc_html__( 'Hover', 'dfd' ) .' '. esc_html__( 'Background', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
									'param_name' => 'hover_icon_bg',
									'edit_field_class' => 'vc_column vc_col-sm-12',
									'group'      => esc_html__( 'Icon BG.', 'dfd' ),
									'dependency' => array('element' => 'style', 'value_not_equal_to' => array( 'style-01', 'style-06' ),),
								),
								array(
									'type'       => 'attach_image',
									'heading'	=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to upload the image from the media gallery to be set as icon\'s background','dfd').'</span></span>'.esc_html__( 'Background', 'dfd' ) . ' ' . esc_html__( 'Image', 'crum' ),
									'param_name' => 'icon_bg_img',
									'dependency' => array('element' => 'style', 'value'   => array( 'style-05' ),),
									'group'      => esc_html__( 'Icon BG.', 'dfd' ),
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Title', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
									'param_name'       => 'title_t_heading',
									'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
									'group'            => esc_attr__( 'Typography', 'dfd' ),
								),
								array(
									'type'       => 'dfd_font_container_param',
									'heading'    => '',
									'param_name' => 'title_font_options',
									'settings'   => array(
										'fields' => array(
											'tag' => 'div',
											'letter_spacing',
											'font_size',
											'line_height',
											'color',
											'font_style'
										),
									),
									'group'      => esc_attr__( 'Typography', 'dfd' ),
								),
								array(
									'type'        => 'dfd_single_checkbox',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
									'param_name'  => 'use_google_fonts',
									'options'			=> array(
										'yes'				=> array(
											'yes'				=> esc_attr__('Yes', 'dfd'),
											'no'				=> esc_attr__('No', 'dfd'),
										),
									),
									'group'       => esc_attr__( 'Typography', 'dfd' ),
								),
								array(
									'type'       => 'google_fonts',
									'param_name' => 'custom_fonts',
									'value'      => '',
									'settings'   => array(
										'fields' => array(
											'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
											'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
										),
									),
									'dependency' => array(
										'element' => 'use_google_fonts',
										'value'   => 'yes',
									),
									'group'      => esc_attr__( 'Typography', 'dfd' ),
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Subtitle', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
									'param_name'       => 'subtitle_t_heading',
									'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
									'group'            => esc_html__( 'Typography', 'dfd' ),
								),
								array(
									'type'       => 'dfd_font_container_param',
									'heading'    => '',
									'param_name' => 'subtitle_font_options',
									'settings'   => array(
										'fields' => array(
											'tag' => 'div',
											'letter_spacing',
											'font_size',
											'line_height',
											'color',
											'font_style'
										),
									),
									'group'      => esc_html__( 'Typography', 'dfd' ),
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Content', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
									'param_name'       => 'content_t_heading',
									'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
									'group'            => esc_attr__( 'Typography', 'dfd' ),
								),
								array(
									'type'       => 'dfd_font_container_param',
									'heading'    => '',
									'param_name' => 'font_options',
									'settings'   => array(
										'fields' => array(
											'tag' => 'div',
											'letter_spacing',
											'font_size',
											'line_height',
											'color',
											'font_style'
										),
									),
									'group'      => esc_attr__( 'Typography', 'dfd' ),
								),
								array(
									'type'        => 'dfd_single_checkbox',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
									'param_name'  => 'use_content_google_fonts',
									'options'			=> array(
										'yes'				=> array(
											'yes'				=> esc_attr__('Yes', 'dfd'),
											'no'				=> esc_attr__('No', 'dfd'),
										),
									),
									'group'       => esc_attr__( 'Typography', 'dfd' ),
								),
								array(
									'type'       => 'google_fonts',
									'param_name' => 'content_custom_fonts',
									'value'      => '',
									'group'      => esc_attr__( 'Typography', 'dfd' ),
									'settings'   => array(
										'fields' => array(
											'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
											'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
										),
									),
									'dependency' => array('element' => 'use_content_google_fonts', 'value' => 'yes'),
								),

								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Delimiter options', 'dfd' ),
									'param_name'       => 'title_d_heading',
									'group'            => esc_attr__( 'Style', 'dfd' ),
									'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
								),
							),
							$delim_options,
							array(
								array(
									'type' => 'ult_param_heading',
									'text' => esc_html__( 'Read more options', 'dfd' ),
									'param_name' => 'title_read_more_heading',
									'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
									'dependency' => array('element' => 'readmore_show', 'value' => 'yes'),
									'group' => esc_attr__('Style', 'dfd')
								),
								array(
									'type' => 'colorpicker',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the element color', 'dfd') . '</span></span>' . esc_html__('Element color', 'dfd'),
									'param_name' => 'read_more_color',
									'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
									'dependency' => array('element' => 'readmore_style', 'value' => array('read-more-09', 'read-more-10')),
									'group' => esc_attr__('Style', 'dfd')
								),
								array(
									'type' => 'colorpicker',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the element color on hover', 'dfd') . '</span></span>' . esc_html__('Element hover color', 'dfd'),
									'param_name' => 'read_more_hover_color',
									'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
									'dependency' => array('element' => 'readmore_style', 'value' => array('read-more-09', 'read-more-10')),
									'group' => esc_attr__('Style', 'dfd')
								),
							),
							array(
								array(
									'type'				=> 'dfd_param_responsive_text',
									'heading'			=> esc_html__('Title responsive settings', 'dfd-native'),
									'param_name'		=> 'title_responsive',
									'edit_field_class'	=> 'vc_column vc_col-sm-12 no-bottom-padding no-border-bottom',
									'group'				=> esc_html__('Responsive', 'dfd-native'),
								)
							)
						)
					)
				);
			}
		}

		function info_box_form( $atts, $content = null ) {

			$style = $layout = $title = $subtitle = $output = $hover_icon_bg = $hover_icon_border = $icon_hover = $bg_hover_style = $delimiter_styles = '';
			$more_show = $readmore_style = $readmore_text = $read_more = $link = $hover_animation = $el_class = $content_under_offset = $read_more_color = '';
			$icon_number = $number_bg_color = $icon_number_text = $delimiter_style = $line_width = $line_border = $line_color = $line_hide = '';
			$title_font_options = $border_width = $subtitle_font_options = $font_options = $use_google_fonts = $custom_fonts = $animation_data = '';
			$icon_style = $border_radius = $border_color = $icon_bg_size = $fill_color_start = $fill_color_end = $icon_bg_img = $module_animation = '';
			$delimiter_style = $number_style = $delimiter_html = $read_more_html = $title_html = $subtitle_html = $content_html = $css = '';
			$link_atts_url = $link_atts_title = $link_atts_target = $icon_html = $use_content_google_fonts = $content_custom_fonts = '';
			$icon_text = $content_alignment = $readmore_class = $readmore_data = $read_more_hover_color = $title_responsive = '';
			
			$atts = vc_map_get_attributes( 'dfd_info_box', $atts );
			extract( $atts );
		
			/**************************
			 * Appear Animation
			 *************************/

			$id = "idinfobox".uniqid();
			$el_class       .= ' '.esc_attr($id);

			if(!($module_animation == '')) {
				$el_class       .= ' cr-animate-gen';
				$animation_data = 'data-animate-item=".dfd-animate-container" data-animate-type = "' . esc_attr( $module_animation ) . '" ';
			}

			/**************************
			 * Content Alignment.
			 *************************/
			if(isset($layout) && strcmp($layout, 'layout-01') == 0 || strcmp($layout, 'layout-02') == 0 || strcmp($layout, 'layout-03') == 0)  {
				$el_class .= ' '.esc_attr($content_alignment);
			}
			
			/**************************
			 * Hover styles.
			 *************************/
			if ( 'hover' === $more_show ) {
				$el_class .= ' more-hover';
			}
			if ( $hover_animation ) {
				$el_class .= ' ' . $hover_animation;
			}

			if ( $hover_icon_bg ) {
				$el_class .= ' icon-bg-change';
				$bg_hover_style .= 'style="';
				$bg_hover_style .= 'background:'.$hover_icon_bg.';';

				if ( isset($border_radius) ) {
					if ( ( ( 'style-05' === $style ) && $border_width ) || ( ( 'style-03' === $style ) && $border_width ) ) {
						$bg_hover_style .= 'border-radius:' . ( $border_radius ) . 'px;';
					} elseif ( ( 'style-05' === $style ) || ( 'style-03' === $style ) ) {
						$bg_hover_style .= 'border-radius:' . ( $border_radius ) . 'px;';
					} elseif ( ( 'style-04' === $style )){
						$bg_hover_style .= 'border-radius:' . ( $border_radius-4 ) . 'px;';
					} else {
						$bg_hover_style .= 'border-radius:' . ($border_radius) . 'px;';
					}
				}
				$bg_hover_style .= '"';
			}
			if (isset($icon_hover) && !empty($icon_hover)) {
				$css .= '.'.esc_js($id).':hover .module-icon i {color: '.esc_js($icon_hover).' !important;}';
			}
			if (isset($border_color) && !empty($border_color)) {
				$css .= '.'.esc_js($id).' .module-icon {border-color: '.esc_js($border_color).';}';
			}
			if(isset($hover_icon_border) && !empty($hover_icon_border)) {
				$css .= '.'.esc_js($id).':hover .module-icon {border-color: '.esc_js($hover_icon_border).';}';
			}

			/*********************
			 *   ICON HTML.
			 ********************/

			if ( $border_radius || $border_width || $icon_bg_size || $fill_color_start || $fill_color_end || $icon_bg_img ) {

				$icon_style .= 'style="';
				if ( isset($border_radius) ) {
					$icon_style .= 'border-radius:' . $border_radius . 'px;';
				}
				if ( ( ( 'style-05' === $style ) && $border_width ) || ( ( 'style-03' === $style ) && $border_width ) ) {
					$icon_style .= 'border-width: ' . $border_width . 'px;';
					$css .= '.'.$id.' .module-icon:before{border-width: ' . $border_width . 'px !important;}';
				}

				if ( $icon_bg_size ) {
					$icon_style .= 'font-size:' . $icon_bg_size . 'px;';
				}
				if ( ( 'style-05' === $style ) && $icon_bg_img ) {
					$icon_bg_img = wp_get_attachment_image_src( $icon_bg_img, 'full' );
					$icon_style .= 'background-image:url(' . $icon_bg_img[0] . ');';
				}
				if ( $fill_color_end && $fill_color_start ) {
					$icon_style .= 'background: linear-gradient(to right, ' . $fill_color_start . ' 0%,' . $fill_color_end . ' 100%); ';
				} elseif ( $fill_color_start ) {
					$icon_style .= 'background-color:' . $fill_color_start . '; ';
				} elseif ( $fill_color_end ) {
					$icon_style .= 'background-color:' . $fill_color_end . '; ';
				}
				$icon_style .= '"';
			}
			if(isset($content_under_offset) && $content_under_offset != '') {
				$css .= '.'.esc_js($id).' .description, #'.esc_js($id).' .description {padding-top: '.esc_js($content_under_offset).'px;}';
			}
			if(isset($read_more_color) && !empty($read_more_color)) {
				$css .= '.'.esc_js($id).' .dfd-module-readmore .read-more-09 {color: '.esc_js($read_more_color).';}';
				$css .= '.'.esc_js($id).' .dfd-module-readmore .read-more-10 span:before {background: '.esc_js($read_more_color).';}';
			}
			if(isset($read_more_hover_color) && !empty($read_more_hover_color)) {
				$css .= '.'.esc_js($id).' .dfd-module-readmore .read-more-09:hover {color: '.esc_js($read_more_hover_color).';}';
				$css .= '.'.esc_js($id).' .dfd-module-readmore .read-more-10:hover span:before, .'.esc_js($id).' .dfd-module-readmore .read-more-10:hover span:after {background: '.esc_js($read_more_hover_color).';}';
			}
			if(isset($title_responsive) && $title_responsive != '') {
				$css .= Dfd_Resposive_Text_Param::responsive_css($title_responsive, '#'.esc_js($id).' .info-box-title ');
			}
			
			$link = vc_build_link( $link );
			if(isset($link['url']) && !empty($link['url'])) {
				$link_atts_url = 'href="'.esc_url($link['url']).'"';
			}
			if(isset($link['title']) && !empty($link['title'])) {
				$link_atts_title = 'title="'.esc_attr($link['title']).'"';
			}
			if(isset($link['target']) && !empty($link['target'])) {
				$link_atts_target = 'target="'.esc_attr(preg_replace('/\s+/', '', $link['target'])).'"';
			}
			
			if ($icon_type === 'text') {
				$el_class .= ' with-text';
			}
			
			if (isset($icon) && !empty($icon) || !empty($icon_image_id) || $icon_text != '') {
				$icon_html = '<div class="icon-wrapper">';
				$icon_html .= '<div class="module-icon" ' . $icon_style . '>';
				$icon_html .= '<div class="hover-layer" '.$bg_hover_style.'></div>';

				$icon_html .= crumina_icon_render( $atts );

				//number at icon
				if ( 'yes' === $icon_number && ! empty( $icon_number_text ) ) {
					if ( $number_bg_color ) {
						$number_style = 'style="background-color:' . $number_bg_color . '"';
					}
					$icon_html .= '<div class="info-box-icon-text" ' . $number_style . '>' . $icon_number_text . '</div>';
				}
				$icon_html .= '</div>';

				$icon_html .= '</div>';
			}

			/**************************
			 * Title / Subtitle HTML.
			 *************************/
			if ( ! empty( $title ) ) {
				// Title name HTML.
				$title_options = _crum_parse_text_shortcode_params( $title_font_options, 'feature-title', $use_google_fonts, $custom_fonts  );
				if ( $link && 'title' === $read_more ) {
					$title_html .= '<'.$title_options['tag'].' class="info-box-title ' . $title_options['class'] . '" ' . $title_options['style'] . '><a '.$link_atts_url.' '.$link_atts_title.' '.$link_atts_target.'>' . esc_html( $title ) . '</a></'.$title_options['tag'].'>';
				} else {
					$title_html .= '<'.$title_options['tag'].' class="info-box-title ' . $title_options['class'] . '" ' . $title_options['style'] . '>' . esc_html( $title ) . '</'.$title_options['tag'].'>';
				}
			}

			// Subtitle HTML.
			if ( ! empty( $subtitle ) ) {
				$subtitle_options = _crum_parse_text_shortcode_params( $subtitle_font_options, 'subtitle' );
				$subtitle_html .= '<'.$subtitle_options['tag'].' class="info-box-subtitle ' . $subtitle_options['class'] . '" ' . $subtitle_options['style'] . '>' . esc_html( $subtitle ) . '</'.$subtitle_options['tag'].'>';
			}

			/**************************
			 * Delimiter HTML.
			 *************************/

			if ( $line_width || $line_border || $line_color || $delimiter_style ) {
				$delimiter_styles = 'style="';
				if ( $line_width ) {
					$delimiter_styles .= 'width:' . $line_width . 'px;';
				}
				if ( $line_border ) {
					$delimiter_styles .= 'border-width:' . $line_border . 'px;';
				}
				if ( $line_color ) {
					$delimiter_styles .= 'border-color:' . $line_color.';';
				}
				if ( ! empty( $delimiter_style ) ) {
					$delimiter_styles .= 'border-bottom-style:' . $delimiter_style;
				}
				$delimiter_styles .= '"';
			}
			if ( 'yes' !== $line_hide ) {
				$delimiter_html .= '<div class="wrap-delimiter"><div class="delimiter" ' . $delimiter_styles . '></div></div>';
			}

			/**************************
			 * Content HTML.
			 *************************/
			$content_font_options = _crum_parse_text_shortcode_params( $font_options, '', $use_content_google_fonts, $content_custom_fonts);
			$content_style        = $content_font_options['style'];
			$content_html .= '<div class="description" ' . $content_style . '>' . $content . '</div>';

			/**************************
			 * Read More button.
			 *************************/
			if ( isset( $readmore_show ) && 'yes' === $readmore_show ) {
				if($readmore_style == 'read-more-09') {
					$readmore_class = 'chaffle';
					$readmore_data = 'data-lang="en"';
				}
				if ( $link && 'more' === $read_more ) {
					$more_open = '<div><div class="dfd-module-readmore"><a '.$link_atts_url.' '.$link_atts_title.' '.$link_atts_target.' class="'.$readmore_style.' '.$readmore_class.'" '.$readmore_data.'>';
					$more_close = '</a></div></div>';
				} else {
					$more_open = '<div><div class="dfd-module-readmore"><span class="' . $readmore_style . '">';
					$more_close = '</span></div></div>';
				}
				if ( 'read-more-01' === $readmore_style ) {
					$read_more_html .= $more_open . $readmore_text . $more_close;
				} elseif ( 'read-more-02' === $readmore_style || 'read-more-03' === $readmore_style || 'read-more-04' === $readmore_style  || 'read-more-10' === $readmore_style) {
					$read_more_html .= $more_open . '<span></span><span></span><span></span>' . $more_close;
				} elseif ( 'read-more-05' === $readmore_style ) {
					$read_more_html .= $more_open . '<i class="dfd-icon-down_right"></i><span>' . $readmore_text . '</span><i class="dfd-icon-down_right"></i>' . $more_close;
				} elseif ( 'read-more-06' === $readmore_style ) {
					$read_more_html .= $more_open . '<i class="dfd-icon-down_right"></i>' . $more_close;
				} elseif ( 'read-more-07' === $readmore_style ) {
					$read_more_html .= $more_open . '<i class="dfd-added-font-icon-right-open"></i>' . $more_close;
				} else {
					$read_more_html .= $more_open . $readmore_text . $more_close;
				}
			}

			/**************************
			 * Module output.
			 *************************/

			if ( 'style-06' === $style ) {
				$layout = 'layout-01';
			}

			$output .= '<div id="'.$id.'" class="dfd-info-box clearfix ' . $style . ' ' . $layout . ' ' . $el_class . '" '.$animation_data.'>';
				$output .= '<div class="dfd-animate-container">';

					switch ( $layout ) {
						case 'layout-01':
							$output .= $icon_html;
							$output .= $title_html;
							$output .= $subtitle_html;
							$output .= $delimiter_html;
							$output .= $content_html;
							$output .= $read_more_html;
							break;

						case 'layout-02':
							$output .= $content_html;
							$output .= $delimiter_html;
							$output .= $title_html;
							$output .= $subtitle_html;
							$output .= $icon_html;
							$output .= $read_more_html;
							break;

						case 'layout-03':
							$output .= $title_html;
							$output .= $subtitle_html;
							$output .= $delimiter_html;
							$output .= $icon_html;
							$output .= $content_html;
							$output .= $read_more_html;
							break;

						case 'layout-04':
						case 'layout-05':
							$output .= $icon_html;
							$output .= '<div class="content-wrap ovh">';
							$output .= $title_html;
							$output .= $subtitle_html;
							$output .= $delimiter_html;
							$output .= $content_html;
							$output .= $read_more_html;
							$output .= '</div>';
							break;

						case 'layout-06':
						case 'layout-07':
							$output .= $icon_html;
							$output .= '<div class="content-wrap ovh">';
							$output .= $title_html;
							$output .= $subtitle_html;
							$output .= $delimiter_html;
							$output .= '</div>';
							$output .= '<div class="clear ovh">';
							$output .= $content_html;
							$output .= $read_more_html;
							$output .= '</div>';
							break;

						default:

							$output .= $icon_html;
							$output .= $title_html;
							$output .= $subtitle_html;
							$output .= $delimiter_html;
							$output .= $content_html;
							$output .= $read_more_html;
					}

				if ( $link && 'box' === $read_more ) {
					$output .= '<a '.$link_atts_url.' '.$link_atts_title.' '.$link_atts_target.' class="full-box-link"></a>';
				}
				ob_start();
				if(!empty($css)) { ?>
					<script>
						(function($){
							$('head').append('<style type="text/css"> <?php echo esc_js($css); ?></style>');
						})(jQuery)
					</script>

				<?php }

				$output .= ob_get_clean();

				$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
	}
}

if ( class_exists( 'Dfd_Info_Box' ) ) {
	$Dfd_Info_Box = new Dfd_Info_Box;
}
