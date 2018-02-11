<?php
if ( !defined( 'ABSPATH' )) { exit; }
/*
* Add-on Name: DFD Rotate Box
*/
if( !class_exists('Dfd_Rotate_Box')) {
	
	class Dfd_Rotate_Box {
		
		function __construct() {
			add_action('init', array(&$this, 'rotate_box_init'));
			add_shortcode('rotate_box', array(&$this, 'rotate_box_form'));
		}
		
		function rotate_box_init () {
			if ( function_exists('vc_map') ) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/rotate_box/';
				vc_map (
					array(
						'name'					=> esc_html__('Rotate Box', 'dfd'),
						'base'					=> 'rotate_box',
						'icon'					=> 'rotate_box dfd_shortcode',
						'category'				=> esc_html__('Ronneby 2.0', 'dfd'),
						'params'				=> array(
							array(
								'heading'			=> esc_html__('Style', 'dfd'),
								'type'				=> 'radio_image_select',
								'param_name'		=> 'main_style',
								'simple_mode'		=> false,
								'options'			=> array(
									'to-left'			=> array(
										'tooltip'			=> esc_attr__('Rotate left','dfd'),
										'src'				=> $module_images.'style-1.png'
									),
									'to-right'			=> array(
										'tooltip'			=> esc_attr__('Rotate right','dfd'),
										'src'				=> $module_images.'style-2.png'
									),
									'to-bottom'			=> array(
										'tooltip'			=> esc_attr__('Rotate bottom','dfd'),
										'src'				=> $module_images.'style-3.png'
									),
									'to-top'			=> array(
										'tooltip'			=> esc_attr__('Rotate top','dfd'),
										'src'				=> $module_images.'style-4.png'
									),
								),
							),
							array(
								'type'				=> 'textfield',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the height for the rotate item. The default value is 300px','dfd').'</span></span>'.esc_html__('Rotate item height', 'dfd'),
								'param_name'		=> 'height_block',
								'edit_field_class'	=> 'vc_column vc_col-sm-12 dfd-number-wrap',
							),
							array(
								'type'				=> 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the link to your rotate item','dfd').'</span></span>'.esc_html__('Link', 'dfd'),
								'param_name'		=> 'link_box',
								'value'				=> '',
								'options'			=> array(
									'link_b'			=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd')
									),
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
							),
							array(
								'type'				=> 'vc_link',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add a custom link or select existing page','dfd').'</span></span>'.esc_html__('Add link', 'dfd'),
								'param_name'		=> 'link',
								'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc no-border-bottom',
								'dependency'		=> array('element' => 'link_box', 'value' => 'link_b'),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__( 'Extra features', 'dfd' ),
								'param_name'		=> 'extra_features_elements_heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
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
//								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd') . '</span></span>' . esc_html__('Tutorials', 'dfd'),
//								'param_name'		=> 'tutorials',
//								'doc_link'			=> '//nativewptheme.net/support/visual-composer/rotate-box',
//								'video_link'		=> 'https://www.youtube.com/watch?v=T9A44JfPUsw',
//							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__( 'Front Side', 'dfd' ),
								'param_name'		=> 'extra_features_elements_heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12 no-top-margin',
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'				=> 'dfd_radio_advanced',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background style for the front side. You can choose color or image','dfd').'</span></span>'.esc_html__('Background style', 'dfd'),
								'param_name'		=> 'bg_style',
								'value'				=> 'color',
								'options'			=> array(
									esc_html__('Image', 'dfd')	=> 'image',
									esc_html__('Color', 'dfd')	=> 'color',
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'				=> 'attach_image',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the custom image from media library','dfd').'</span></span>'.esc_html__('Upload Image', 'dfd'),
								'param_name'		=> 'icon_image_id',
								'dependency'		=> array('element' => 'bg_style', 'value' => 'image'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the front side. The default color is inherited from Theme Options > Styling Options > Main site color','dfd').'</span></span>'.esc_html__('Background', 'dfd'),
								'param_name'		=> 'mask_background',
								'dependency'		=> array('element' => 'bg_style', 'value' => 'color'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'			=> 'textarea',
								'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Type the title for the rotate item. It will be seen on the front side','dfd').'</span></span>'.esc_html__('Title', 'dfd'),
								'param_name'	=> 'title_first',
								'value'			=> 'Rotate box title',
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'			=> 'textfield',
								'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Type the subtitle for the rotate item. It will be seen on the front side','dfd').'</span></span>'.esc_html__('Subtitle', 'dfd'),
								'param_name'	=> 'subtitle_first',
								'value'			=> 'Rotate box subtitle',
								'group'				=> esc_html__('Content', 'dfd'),
							), 
							array(
								'type'				=> 'dfd_radio_advanced',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the horizontal alignment for the content on the front side','dfd').'</span></span>'.esc_html__('Horizontal alignment', 'dfd'),
								'param_name'		=> 'h_alignment',
								'value'				=> 'horizontal-center',
								'options'			=> array(
									esc_html__('Left', 'dfd') => 'horizontal-left',
									esc_html__('Center', 'dfd') => 'horizontal-center',
									esc_html__('Right', 'dfd') => 'horizontal-right',
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'group'				=> esc_html__('Content', 'dfd')
							),
							array(
								'type'				=> 'dfd_radio_advanced',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the vertical alignment for the content on the front side','dfd').'</span></span>'.esc_html__('Vertical alignment', 'dfd'),
								'param_name'		=> 'v_alignment',
								'value'				=> 'vertical-center',
								'options'			=> array(
									esc_html__('Top', 'dfd') => 'vertical-top',
									esc_html__('Center', 'dfd') => 'vertical-center',
									esc_html__('Bottom', 'dfd') => 'vertical-bottom',
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'group'				=> esc_html__('Content', 'dfd')
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the top/bottom offset for the content on the front side of the rotate box. The default offset value is 50px','dfd').'</span></span>'.esc_html__('Front side top/bottom offset', 'dfd'),
								'param_name'		=> 'front_content_vertical_offset',
								'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc dfd-number-wrap',
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the left/right offset for the content on the front side of the rotate box. The default offset value is 50px','dfd').'</span></span>'.esc_html__('Front side left/right offset', 'dfd'),
								'param_name'		=> 'front_content_horizontal_offset',
								'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc dfd-number-wrap',
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'				=> 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('','dfd').'</span></span>'.esc_html__('Heading decoration', 'dfd'),
								'param_name'		=> 'heading_decoration',
								'options'			=> array(
									'yes'				=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd'),
									),
								),
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__('Back Side', 'dfd' ),
								'param_name'       => 'extra_features_elements_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12 ',
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'			=> 'dfd_radio_advanced',
								'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background style for the back side. You can choose color or image','dfd').'</span></span>'.esc_html__('Background style', 'dfd'),
								'param_name'	=> 'bg_style_reverse',
								'value'			=> 'color',
								'options'		=> array(
									esc_html__('Image', 'dfd')	=> 'image',
									esc_html__('Color', 'dfd')	=> 'color',
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'				=> 'attach_image',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the custom image from media library','dfd').'</span></span>'.esc_html__('Upload Image', 'dfd'),
								'param_name'		=> 'image_id_reverse',
								'dependency'		=> array('element' => 'bg_style_reverse', 'value' => 'image'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the back side. The default color is inherited from Theme Options > Styling Options > Main site color','dfd').'</span></span>'.esc_html__('Background', 'dfd'),
								'param_name'		=> 'mask_bg_reverse',
								'dependency'		=> array('element' => 'bg_style_reverse', 'value' => 'color'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'			=> 'textarea',
								'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Type the description for your rotate item. It will be seen on the back side','dfd').'</span></span>'.esc_html__('Description', 'dfd'),
								'param_name'	=> 'desc_reverse',
								'value'			=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque velit mi, facilisis id nunc sed, vehicula molestie felis.',
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the top/bottom offset for the content on the back side of the rotate box. The default offset value is 50px','dfd').'</span></span>'.esc_html__('Back side top/bottom offset', 'dfd'),
								'param_name'		=> 'back_content_vertical_offset',
								'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc dfd-number-wrap',
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the left/right offset for the content on the back side of the rotate box. The default offset value is 50px','dfd').'</span></span>'.esc_html__('Back side left/right offset', 'dfd'),
								'param_name'		=> 'back_content_horizontal_offset',
								'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc dfd-number-wrap',
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'				=> 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to add the number or short text at rotate item', 'dfd') . '</span></span>' .esc_html__('Additional info', 'dfd'),
								'param_name'		=> 'block_number',
								'options'			=> array(
									'yes'				=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc',
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'				=> 'textfield',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the additional information you would like to show on the rotate item','dfd').'</span></span>'.esc_html__('Info', 'dfd'),
								'param_name'		=> 'number_text',
								'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc',
								'dependency'		=> array('element' => 'block_number', 'value' => array('yes')),
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'				=> 'dfd_radio_advanced',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the horizontal alignment for the additional information','dfd').'</span></span>'.esc_html__('Alignment', 'dfd'),
								'param_name'		=> 'number_alignment',
								'value'				=> 'text-left',
								'options'			=> array(
									esc_html__('Left', 'dfd')	=> 'text-left',
									esc_html__('Center', 'dfd')	=> 'text-center',
									esc_html__('Right', 'dfd')	=> 'text-right'
								),
								'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc no-border-bottom',
								'dependency'		=> array('element' => 'block_number', 'value' => array('yes')),
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'				=> 'dfd_radio_advanced',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the position for the additional information. It can be set at the top or at the bottom of the rotate item','dfd').'</span></span>'.esc_html__('Position', 'dfd'),
								'param_name'		=> 'number_position',
								'value'				=> 'number-after-content',
								'options'			=> array(
									esc_html__('Top', 'dfd')	=> 'number-before-content',
									esc_html__('Bottom', 'dfd')	=> 'number-after-content',
								),
								'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc',
								'dependency'		=> array('element' => 'block_number', 'value' => array('yes')),
								'group'				=> esc_html__('Content', 'dfd'),
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
								'text'				=> esc_html__('Description Typography', 'dfd'),
								'param_name'		=> 'desc_t_heading',
								'class'				=> 'ult-param-heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group'				=> esc_html__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'dfd_font_container_param',
								'param_name'		=> 'desc_font_options',
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
								'param_name'		=> 'desc_google_fonts',
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
								'param_name'		=> 'desc_custom_fonts',
								'settings'			=> array(
									'fields'			=> array(
										'font_family_description'	=> esc_html__('Select font family.', 'dfd'),
										'font_style_description'	=> esc_html__('Select font style.', 'dfd'),
									),
								),
								'dependency'		=> array('element' => 'desc_google_fonts', 'value' => 'yes'),
								'group'				=> esc_html__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Info Typography', 'dfd'),
								'param_name'		=> 'number_t_heading',
								'class'				=> 'ult-param-heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'dependency'		=> array('element' => 'number_text', 'not_empty' => true),
								'group'				=> esc_html__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> esc_html__('Font size', 'dfd'),
								'param_name'		=> 'number_font_size',
								'edit_field_class'	=> 'vc_col-sm-12 vc_column crum_vc dfd-number-wrap',
								'dependency'		=> array('element' => 'number_text', 'not_empty' => true),
								'group'				=> esc_html__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'dfd_font_container_param',
								'param_name'		=> 'number_font_options',
								'settings'			=> array(
									'fields'			=> array(
										'letter_spacing',
										'color',
										'font_style'
									),
								),
								'dependency'		=> array('element' => 'number_text', 'not_empty' => true),
								'group'				=> esc_html__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
								'param_name'		=> 'number_google_fonts',
								'options'			=> array(
									'yes'				=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd'),
									),
								),
								'dependency'		=> array('element' => 'number_text', 'not_empty' => true),
								'group'				=> esc_html__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'google_fonts',
								'param_name'		=> 'number_custom_fonts',
								'settings'			=> array(
									'fields'			=> array(
										'font_family_description'	=> esc_html__('Select font family.', 'dfd'),
										'font_style_description'	=> esc_html__('Select font style.', 'dfd'),
									),
								),
								'dependency'		=> array('element' => 'number_google_fonts', 'value' => 'yes'),
								'group'				=> esc_html__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('','dfd').'</span></span>'.esc_html__('Title background', 'dfd'),
								'param_name'		=> 'title_background',
								'dependency'		=> array('element' => 'heading_decoration', 'value' => 'yes'),
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('','dfd').'</span></span>'.esc_html__('Padding top', 'dfd'),
								'param_name'		=> 'title_padding_top',
								'edit_field_class'	=> 'vc_col-sm-3 vc_column crum_vc dfd-number-wrap',
								'dependency'		=> array('element' => 'heading_decoration', 'value' => 'yes'),
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('','dfd').'</span></span>'.esc_html__('Padding right', 'dfd'),
								'param_name'		=> 'title_padding_right',
								'edit_field_class'	=> 'vc_col-sm-3 vc_column crum_vc dfd-number-wrap',
								'dependency'		=> array('element' => 'heading_decoration', 'value' => 'yes'),
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('','dfd').'</span></span>'.esc_html__('Padding bottom', 'dfd'),
								'param_name'		=> 'title_padding_bottom',
								'edit_field_class'	=> 'vc_col-sm-3 vc_column crum_vc dfd-number-wrap',
								'dependency'		=> array('element' => 'heading_decoration', 'value' => 'yes'),
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('','dfd').'</span></span>'.esc_html__('Padding left', 'dfd'),
								'param_name'		=> 'title_padding_left',
								'edit_field_class'	=> 'vc_col-sm-3 vc_column crum_vc dfd-number-wrap',
								'dependency'		=> array('element' => 'heading_decoration', 'value' => 'yes'),
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('','dfd').'</span></span>'.esc_html__('Margin top', 'dfd'),
								'param_name'		=> 'title_margin_top',
								'edit_field_class'	=> 'vc_col-sm-3 vc_column crum_vc dfd-number-wrap',
								'dependency'		=> array('element' => 'heading_decoration', 'value' => 'yes'),
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('','dfd').'</span></span>'.esc_html__('Margin right', 'dfd'),
								'param_name'		=> 'title_margin_right',
								'edit_field_class'	=> 'vc_col-sm-3 vc_column crum_vc dfd-number-wrap',
								'dependency'		=> array('element' => 'heading_decoration', 'value' => 'yes'),
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('','dfd').'</span></span>'.esc_html__('Margin bottom', 'dfd'),
								'param_name'		=> 'title_margin_bottom',
								'edit_field_class'	=> 'vc_col-sm-3 vc_column crum_vc dfd-number-wrap',
								'dependency'		=> array('element' => 'heading_decoration', 'value' => 'yes'),
								'group'				=> esc_html__('Style', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('','dfd').'</span></span>'.esc_html__('Margin left', 'dfd'),
								'param_name'		=> 'title_margin_left',
								'edit_field_class'	=> 'vc_col-sm-3 vc_column crum_vc dfd-number-wrap',
								'dependency'		=> array('element' => 'heading_decoration', 'value' => 'yes'),
								'group'				=> esc_html__('Style', 'dfd'),
							),
						),
					)
				);
			}
		}
		
		function rotate_box_form($atts, $content = null) {
			$main_style = $uniqid = $el_class = $module_animation = $animation_data = $output = $block_number = $number_text = $number_alignment = $number_position = '';
			$title_font_options = $use_google_fonts = $custom_fonts = $subtitle_font_options = $subtitle_google_fonts = $subtitle_custom_fonts = $link_box = $link = '';
			$link_css = $link_html = $mask_background = $title_first = $subtitle_first = $bg_style = $direction = $icon_image_id = $front_content_vertical_offset = '';
			$image_url = $img_src = $img_html = $title_html = $subtitle_html = $number_font_options = $number_google_fonts = $number_custom_fonts = $number_font_size = '';
			$v_alignment = $h_alignment = $content_alignment = $front_content_horizontal_offset = $bg_style_reverse = $image_id_reverse = $mask_bg_reverse = '';
			$desc_reverse = $back_content_vertical_offset = $back_content_horizontal_offset = $img_src_reverse = $image_url_reverse = $img_reverse_html = '';
			$desc_reverse_html = $desc_font_options = $desc_google_fonts = $desc_custom_fonts = $height_block = $heading_decoration = $title_padding_top = '';
			$title_padding_right = $title_padding_bottom = $title_padding_left = $title_margin_top = $title_margin_right = $title_margin_bottom = $title_margin_left = '';
			$title_background = $before_title_html = $after_title_html = '';

			$atts = vc_map_get_attributes('rotate_box', $atts);
			extract($atts);

			$uniqid = uniqid('dfd-rotate-box-').'-'.rand(1,9999);

			$el_class .= ' '.$main_style;

			if(isset($number_position) && $number_position != '' && isset($block_number) && $block_number = 'yes' && isset($number_text) && !empty($number_text)) {
				$el_class .= ' '.$number_position;
			}

			if(!($module_animation == '')) {
				$animation_data = ' data-animate="1" data-animate-type = "'.esc_attr($module_animation).'"';
			}
			
			if(isset($heading_decoration) && $heading_decoration == 'yes') {
				$before_title_html = '<div class="title-decoration">';
				$after_title_html = '</div>';
				if(isset($title_padding_top) && $title_padding_top != '') {
					$link_css .= '#'. esc_js($uniqid).' .title-decoration {padding-top: '.esc_js($title_padding_top).'px;}';
				}
				if(isset($title_padding_right) && $title_padding_right != '') {
					$link_css .= '#'. esc_js($uniqid).' .title-decoration {padding-right: '.esc_js($title_padding_right).'px;}';
				}
				if(isset($title_padding_bottom) && $title_padding_bottom != '') {
					$link_css .= '#'. esc_js($uniqid).' .title-decoration {padding-bottom: '.esc_js($title_padding_bottom).'px;}';
				}
				if(isset($title_padding_left) && $title_padding_left != '') {
					$link_css .= '#'. esc_js($uniqid).' .title-decoration {padding-left: '.esc_js($title_padding_left).'px;}';
				}
				if(isset($title_margin_top) && $title_margin_top != '') {
					$link_css .= '#'. esc_js($uniqid).' .title-decoration {margin-top: '.esc_js($title_margin_top).'px;}';
				}
				if(isset($title_margin_right) && $title_margin_right != '') {
					$link_css .= '#'. esc_js($uniqid).' .title-decoration {margin-right: '.esc_js($title_margin_right).'px;}';
				}
				if(isset($title_margin_bottom) && $title_margin_bottom != '') {
					$link_css .= '#'. esc_js($uniqid).' .title-decoration {margin-bottom: '.esc_js($title_margin_bottom).'px;}';
				}
				if(isset($title_margin_left) && $title_margin_left != '') {
					$link_css .= '#'. esc_js($uniqid).' .title-decoration {margin-left: '.esc_js($title_margin_left).'px;}';
				}
				if(isset($title_background) && !empty($title_background)) {
					$link_css .= '#'. esc_js($uniqid).' .title-decoration {background: '.esc_js($title_background).';}';
				}
			}

			$title_font_options = _crum_parse_text_shortcode_params( $title_font_options, 'feature-title', $use_google_fonts, $custom_fonts, true );
			$subtitle_font_options = _crum_parse_text_shortcode_params( $subtitle_font_options, 'subtitle', $subtitle_google_fonts, $subtitle_custom_fonts, true );
			$desc_font_options = _crum_parse_text_shortcode_params( $desc_font_options, '', $desc_google_fonts, $desc_custom_fonts, true );
			if(isset($title_font_options['style']) && $title_font_options['style'] != '') {
				$link_css .= '#'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .content-wrap .title-first {'.esc_js($title_font_options['style']).'}';
			}
			if(isset($subtitle_font_options['style']) && $subtitle_font_options['style'] != '') {
				$link_css .= '#'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .content-wrap .subtitle-first {'.esc_js($subtitle_font_options['style']).'}';
			}
			if(isset($desc_font_options['style']) && $desc_font_options['style'] != '') {
				$link_css .= '#'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .content-wrap .description-reverse {'.esc_js($desc_font_options['style']).'}';
			}

			// Height block
			if(isset($height_block) && !empty($height_block)) {
				$link_css .= '#'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .thumb-wrap-front, #'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .thumb-wrap-back {min-height: '.$height_block.'px !important; }';
			}

			// Alignment
			if( isset ($v_alignment) ) {
				if ($v_alignment == 'vertical-top') {
					$content_alignment .= 'dfd-rotate-content-top ';
				}
				if ($v_alignment == 'vertical-center') {
					$content_alignment .= 'dfd-rotate-content-v_center ';
				}
				if ($v_alignment == 'vertical-bottom') {
					$content_alignment .= 'dfd-rotate-content-bottom ';
				}
			} 
			if ( isset ($h_alignment) ) {
				if ($h_alignment == 'horizontal-left') {
					$content_alignment .= 'dfd-rotate-content-left ';
				}
				if ($h_alignment == 'horizontal-center') {
					$content_alignment .= 'dfd-rotate-content-h_center ';
				}
				if($h_alignment == 'horizontal-right') {
					$content_alignment .= 'dfd-rotate-content-right ';
				}
			}

			if(isset($front_content_vertical_offset) && $front_content_vertical_offset != '') {
				$link_css .= '#'. esc_js($uniqid).' .rotate-box .dfd-rotate-box-item .thumb-wrap .thumb-wrap-front .content-wrap .content-block {padding-top: '.esc_js($front_content_vertical_offset).'px; padding-bottom: '.esc_js($front_content_vertical_offset).'px;}';
			}
			if(isset($front_content_horizontal_offset) && $front_content_horizontal_offset != '') {
				$link_css .= '#'. esc_js($uniqid).' .rotate-box .dfd-rotate-box-item .thumb-wrap .thumb-wrap-front .content-wrap .content-block {padding-left: '.esc_js($front_content_horizontal_offset).'px; padding-right: '.esc_js($front_content_horizontal_offset).'px;}';
			}
			if(isset($back_content_vertical_offset) && $back_content_vertical_offset != '') {
				$link_css .= '#'. esc_js($uniqid).' .rotate-box .dfd-rotate-box-item .thumb-wrap .thumb-wrap-back .content-wrap {padding-top: '.esc_js($back_content_vertical_offset).'px; padding-bottom: '.esc_js($back_content_vertical_offset).'px;}';
			}
			if(isset($back_content_horizontal_offset) && $back_content_horizontal_offset != '') {
				$link_css .= '#'. esc_js($uniqid).' .rotate-box .dfd-rotate-box-item .thumb-wrap .thumb-wrap-back .content-wrap {padding-left: '.esc_js($back_content_horizontal_offset).'px; padding-right: '.esc_js($back_content_horizontal_offset).'px;}';
			}

			$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-rotate-box-wrap '.esc_attr($el_class).'" '.$animation_data.'>';
				$output .= '<div class="dfd-rotate-box-list">';

						// First Side
						if(isset($title_first) && !empty($title_first)) {
							$title_html = '<'.$title_font_options['tag'].' class="title-first '.$title_font_options['class'].'">'.wp_kses( $title_first, array('br' => array()) ).'</'.$title_font_options['tag'].'>';
						}
						if(isset($subtitle_first) && !empty($subtitle_first)){
							$subtitle_html = '<'.$subtitle_font_options['tag'].' class="subtitle-first '.$subtitle_font_options['class'].'">'.wp_kses( $subtitle_first, array('br' => array()) ).'</'.$subtitle_font_options['tag'].'>';
						}

						if(isset($bg_style) && $bg_style == 'image' && isset($icon_image_id) && !empty($icon_image_id)) {
							$image_url = wp_get_attachment_image_src($icon_image_id, 'full');

							if(!$img_src) {
								$img_src = $image_url[0];
							}
							$link_css .= '#'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .thumb-wrap-front {background-image: url('.$img_src.'); }';

						} else {
							if (isset($mask_background) && !empty($mask_background)) {
								$link_css .= '#'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .thumb-wrap-front {background-color: '.$mask_background.'; }';
							}
						}
						// Reverse Side
						if(isset($desc_reverse) && !empty($desc_reverse)){
								$desc_reverse_html = '<div class="description-reverse">'.wp_kses($desc_reverse, array('br' => array())).'</div>';
						}

						if(isset($bg_style_reverse) && $bg_style_reverse == 'image' && isset($image_id_reverse) && !empty($image_id_reverse)) {
							$image_url_reverse = wp_get_attachment_image_src($image_id_reverse, 'full');

							if(!$img_src_reverse) {
								$img_src_reverse = $image_url_reverse[0];
							}
							$link_css .= '#'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .thumb-wrap-back {background-image: url('.$img_src_reverse.'); }';
						} else {
							if (isset($mask_bg_reverse) && !empty($mask_bg_reverse)) {
								$link_css .= '#'. esc_js($uniqid).' .dfd-rotate-box-item .thumb-wrap .thumb-wrap-back {background-color: '.$mask_bg_reverse.' }';
							}
						}

						if(isset($link_box) && $link_box == 'link_b' && isset($link)) {
							$link = vc_build_link($link);
							$link_target = !empty($link['target']) ? 'target="'.esc_attr(preg_replace('/\s+/', '', $link['target'])).'"' : '';
							$link_html = '<a href="'.esc_url($link['url']).'" class="full-box-link" title="'.esc_attr($link['title']).'" '.$link_target.' rel="'.esc_attr($link['rel']).'"></a>';
						}

						$output .= '<div class="dfd-item-offset rotate-box">';
							$output .= '<div class="dfd-rotate-box-item '.esc_attr($main_style).'">';
								$output .= '<div class="thumb-wrap">';
										$output .= '<div class="thumb-wrap-front dfd-background-main">';
											$output .= $img_html;
											$output .= '<div class="content-wrap">';
												$output .= '<div class="content-block '. esc_attr($content_alignment) .'">';
													$output .= $before_title_html;
														$output .= $title_html;
														$output .= $subtitle_html;
													$output .= $after_title_html;
												$output .= '</div>';
											$output .= '</div>';	
										$output .= '</div>';
										$output .= '<div class="thumb-wrap-back dfd-background-main">';
											$output .= $img_reverse_html;
											$output .= '<div class="content-wrap">';
												$output .= $desc_reverse_html;
											$output .= '</div>';
										$output .= '</div>';
								$output .= '</div>';
								$output .= $link_html;	
							$output .= '</div>';
						$output .= '</div>';

						if(isset($block_number) && $block_number = 'yes' && isset($number_text) && !empty($number_text)) {
							if(isset($number_font_size) && $number_font_size != '') {
								$link_css .= '#'. esc_js($uniqid).' .dfd-rotate-box-number {font-size: '.esc_js($number_font_size).'px;}';
								$link_css .= '#'. esc_js($uniqid).'.number-before-content {padding-top: '.(esc_js($number_font_size) / 2).'px;}';
								$link_css .= '#'. esc_js($uniqid).'.number-after-content {padding-bottom: '.(esc_js($number_font_size) / 2).'px;}';
							}
							$number_font_options = _crum_parse_text_shortcode_params( $number_font_options, '', $number_google_fonts, $number_custom_fonts, true );
							if(isset($number_font_options['style']) && $number_font_options['style'] != '') {
								$link_css .= '#'. esc_js($uniqid).' .dfd-rotate-box-number {'.esc_js($number_font_options['style']).'}';
							}
							$output .= '<div class="dfd-rotate-box-number dfd-content-title-big '.esc_attr($number_alignment).'">'.esc_html($number_text).'</div>';
						}

				$output .= '</div>';

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

if ( class_exists( 'Dfd_Rotate_Box' ) ) {
	$Dfd_Rotate_Box = new Dfd_Rotate_Box;
}

