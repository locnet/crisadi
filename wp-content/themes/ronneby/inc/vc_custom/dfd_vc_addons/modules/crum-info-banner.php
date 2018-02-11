<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( ! class_exists( 'Dfd_Info_Banner' ) ) {

	class Dfd_Info_Banner {

		function __construct() {
			add_action( 'init', array( &$this, 'dfd_info_banner_init' ) );
			add_shortcode( 'info_banner', array( &$this, 'dfd_info_banner_form' ) );
		}

		function dfd_info_banner_init() {

			if ( function_exists( 'vc_map' ) ) {

				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/info_banner/';
				$delim_options_base = _crum_vc_delim_settings();

				$delim_options_style = array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Delimiter style', 'dfd' ),
					'param_name' => 'delimiter_style',
					'value'      => array(
						esc_html__( 'Solid', 'dfd' )  => '',
						esc_html__( 'Dotted', 'dfd' ) => 'dotted',
						esc_html__( 'Dashed', 'dfd' ) => 'dashed',
					),
					'group'      => esc_html__( 'Style', 'dfd' ),
				);
				
				$delim_options = $delim_options_base;
				$delim_options[0] = $delim_options_style;

				vc_map( array(
					'name'        => esc_html__( 'Info banner', 'dfd' ).' 2',
					'base'        => 'info_banner',
					'icon'        => 'info_banner dfd_shortcode',
					'category'    => esc_html__( 'Ronneby 2.0', 'dfd' ),
					'description' => esc_html__( 'Add image banners with content', 'dfd' ),
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
										'tooltip'	=> esc_attr__('Overlay','dfd'),
										'src'		=> $module_images . 'style-02.png'
									),
									'style-03'	=> array(
										'tooltip'	=> esc_attr__('Title offset','dfd'),
										'src'		=> $module_images . 'style-03.png'
									),
									'style-04'	=> array(
										'tooltip'	=> esc_attr__('Top','dfd'),
										'src'		=> $module_images . 'style-04.png'
									),
									'style-05'	=> array(
										'tooltip'	=> esc_attr__('Right','dfd'),
										'src'		=> $module_images . 'style-05.png'
									),
									'style-06'	=> array(
										'tooltip'	=> esc_attr__('Left','dfd'),
										'src'		=> $module_images . 'style-06.png'
									),
									'style-07'	=> array(
										'tooltip'	=> esc_attr__('Centered','dfd'),
										'src'		=> $module_images . 'style-07.png'
									),
									'style-08'	=> array(
										'tooltip'	=> esc_attr__('Hovered content','dfd'),
										'src'		=> $module_images . 'style-08.png'
									),
									'style-09'	=> array(
										'tooltip'	=> esc_attr__('Hovered description','dfd'),
										'src'		=> $module_images . 'style-09.png'
									),
									'style-10'	=> array(
										'tooltip'	=> esc_attr__('Hovered center','dfd'),
										'src'		=> $module_images . 'style-10.png'
									),
									'style-11'	=> array(
										'tooltip'	=> esc_attr__('Hovered overlay','dfd'),
										'src'		=> $module_images . 'style-11.png'
									),
									'style-12'	=> array(
										'tooltip'	=> esc_attr__('Hovered bottom','dfd'),
										'src'		=> $module_images . 'style-12.png'
									),
									'style-13'	=> array(
										'tooltip'	=> esc_attr__('Hovered top','dfd'),
										'src'		=> $module_images . 'style-13.png'
									),
								),
							),
							array(
								'type'        => 'textfield',
								'heading'	  => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
								'param_name'  => 'el_class',
							),
							array(
								'type'       => 'dropdown',
								'heading'	 => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd').'</span></span>'.esc_html__('Animation', 'dfd'),
								'param_name' => 'module_animation',
								'value'      => dfd_module_animation_styles(),
							),
							array(
								'type'             => 'attach_image',
								'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the custom image from media library','dfd').'</span></span>'.esc_html__('Upload Image', 'dfd'),
								'param_name'       => 'image',
								'value'            => '',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group'       => esc_html__( 'Content', 'dfd' ),
							),
							array(
								'type'             => 'number',
								'heading'          => esc_html__( 'Image width', 'dfd' ),
								'param_name'       => 'img_width',
								'min'              => 0,
								'std'              => '400',
								'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
								'group'       => esc_html__( 'Content', 'dfd' ),
							),
							array(
								'type'             => 'number',
								'heading'          => esc_html__( 'Image height', 'dfd' ),
								'param_name'       => 'img_height',
								'min'              => 0,
								'std'              => '350',
								'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
								'group'       => esc_html__( 'Content', 'dfd' ),
							),
							array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Title', 'dfd' ),
								'param_name'  => 'title',
								'admin_label' => true,
								'group'       => esc_html__( 'Content', 'dfd' ),
							),
							array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Subtitle', 'dfd' ),
								'param_name'  => 'subtitle',
								'group'       => esc_html__( 'Content', 'dfd' ),
							),
							array(
								'type'       => 'textarea',
								'heading'    => esc_html__( 'Content', 'dfd' ),
								'param_name' => 'content',
								'group'      => esc_html__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dropdown',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select where the link should be applied','dfd').'</span></span>'.esc_html__('Apply link to', 'dfd'),
								'param_name' => 'read_more',
								'value' => array(
									esc_html__('No Link', 'dfd') => '',
									esc_html__('Complete Box', 'dfd') => 'box',
									esc_html__('Box Title', 'dfd') => 'title',
									esc_html__('Read More', 'dfd') => 'more',
								),
								'group'      => esc_html__( 'Content', 'dfd' ),
							),
							array(
								'type'       => 'vc_link',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add a custom link or select existing page. You can remove existing link as well','dfd').'</span></span>'.esc_html__('Add link', 'dfd'),
								'param_name' => 'link',
								'description' => esc_html__( 'Add a custom link or select existing page. You can remove existing link as well.', 'dfd' ),
								'group'      => esc_html__( 'Content', 'dfd' ),
								'dependency' => Array('element' => 'read_more', 'value' => array('box','title','more')),
							),
							array(
								'type'       => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the Read more','dfd').'</span></span>'.esc_html__('Read more', 'dfd'),
								'value'				=> '',
								'options'			=> array(
									'yes'			=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd')
									),
								),
								'param_name' => 'readmore_show',
								'group'      => esc_html__( 'Content', 'dfd' ),
							),
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__( 'Button visibility', 'dfd' ),
								'param_name' => 'more_show',
								'value'      => array(
									esc_html__( 'Permanent', 'dfd' )     => 'permanent',
									esc_html__( 'Show on hover', 'dfd' ) => 'hover',
								),
								'dependency' => array(
									'element' => 'readmore_show',
									'value'   => array( 'yes' )
								),
								'group'      => esc_html__( 'Content', 'dfd' ),
							),
							array(
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose one of the 8 preset read more styles','dfd').'</span></span>'.esc_html__('Read more style', 'dfd'),
								'type'        => 'dropdown',
								'param_name'  => 'readmore_style',
								'value'       => array(

									esc_html__( 'Text link', 'dfd' )    => 'read-more-01',
									esc_html__( 'Lines', 'dfd' )        => 'read-more-02',
									esc_html__( 'Dots', 'dfd' )         => 'read-more-03',
									esc_html__( 'Slashes', 'dfd' )      => 'read-more-04',
									esc_html__( 'Text + Arrow', 'dfd' ) => 'read-more-05',
									esc_html__( 'Arrow', 'dfd' )        => 'read-more-06',
									esc_html__( 'Circle', 'dfd' )       => 'read-more-07',
									esc_html__( 'Button', 'dfd' )       => 'read-more-08',

								),
								'dependency'  => array('element' => 'readmore_show', 'value'   => 'yes'),
								'group'       => esc_html__( 'Content', 'dfd' ),
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Read more', 'dfd' ) . ' ' . esc_html__( 'Text', 'dfd' ),
								'param_name' => 'readmore_text',
								'value'      => esc_html__( 'Read more', 'dfd' ),
								'dependency' => array(
									'element' => 'readmore_style',
									'value'   => array( 'read-more-01', 'read-more-05', 'read-more-08' ),
								),
								'group'      => esc_html__( 'Content', 'dfd' ),
							),
							array(
								'type'       => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to set the horizontal alignment for the banner\'s content', 'dfd') . '</span></span>' .esc_html__('Horizontal alignment', 'dfd'),
								'param_name' => 'content_alignment',
								'value'      => 'text-center',
								'options'      => array(
									esc_attr__('Left','dfd') => 'text-left',
									esc_attr__('Center','dfd') => 'text-center',
									esc_attr__('Right','dfd') => 'text-right',
								),
								'dependency'  => array(
									'element' => 'style',
									'value'   => array('style-01','style-02','style-03','style-04','style-07','style-08','style-09','style-10','style-11','style-12','style-13'),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group'      => esc_html__( 'Content', 'dfd' ),
							),
							array(
								'type'       => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to set the vertical alignment for the banner\'s content', 'dfd') . '</span></span>' .esc_html__('Vertical alignment', 'dfd'),
								'param_name' => 'vertical_content_alignment',
								'value'      => '',
								'options'      => array(
									esc_attr__('Top','dfd') => 'title-top',
									esc_attr__('Middle','dfd') => '',
									esc_attr__('Bottom','dfd') => 'title-bottom',
								),
								'dependency'  => array('element' => 'style', 'value' => array('style-07')),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group'      => esc_html__( 'Content', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Image', 'dfd' ) . ' ' . esc_html__( 'effect', 'dfd' ),
								'param_name'       => 'image_effect_heading',
								'group'            => esc_html__( 'Style', 'dfd' ),
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type'       => 'dropdown',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the hover effect for the image', 'dfd') . '</span></span>' .esc_html__('Image effect', 'dfd'),
								'param_name' => 'image_effect',
								'value'      => array(
									esc_attr__('None','dfd') => '',
									esc_attr__('Easy image parallax','dfd') => 'panr',
									esc_attr__('Blur', 'dfd') => 'dfd-image-blur',
									esc_attr__('Grow', 'dfd') => 'dfd-image-scale',
									esc_attr__('Grow with rotation', 'dfd') => 'dfd-image-scale-rotate',
								),
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Overlay', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
								'param_name'       => 'subtitle_h_heading',
								'group'            => esc_html__( 'Style', 'dfd' ),
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type'             => 'colorpicker',
								'heading'          => esc_html__( 'Start', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
								'param_name'       => 'gradient_color1',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'colorpicker',
								'heading'          => esc_html__( 'End', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
								'param_name'       => 'gradient_color2',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add the shadow to the info banner','dfd').'</span></span>'.esc_html__('Shadow', 'dfd'),
								'param_name' => 'shadow',
								'value'      => '',
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'options'    => array(
									'show' => array(
										'on'    => esc_html__( 'Yes', 'dfd' ),
										'off'   => esc_html__( 'No', 'dfd' ),
									),
								),
								'dependency' => array(
									'element' => 'image_effect',
									'value' => array('')
								),
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'dropdown',
								'heading'    => esc_html__( 'Shadow visibility', 'dfd' ),
								'param_name' => 'shadow_style',
								'value'      => array(
									esc_html__( 'Permanent shadow', 'dfd' ) => 'permanent',
									esc_html__( 'Shadow on hover', 'dfd' )  => 'hover',
								),
								'group'      => esc_html__( 'Style', 'dfd' ),
								'dependency' => array(
									'element' => 'shadow',
									'value' => array('show')
								),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Delimiter options', 'dfd' ),
								'param_name'       => 'title_d_heading',
								'group'            => esc_attr__( 'Style', 'dfd' ),
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Title', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
								'param_name'       => 'title_t_heading',
								'group'            => esc_attr__( 'Typography', 'dfd' ),
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
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
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to use custom Google font', 'dfd') . '</span></span>' . esc_html__('Custom font family', 'dfd'),
								'param_name'  => 'use_google_fonts',
								'value'				=> '',
								'options'			=> array(
									'yes'			=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd')
									),
								),
								'group'       => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'       => 'google_fonts',
								'param_name' => 'custom_fonts',
								'value'      => '',
								'group'      => esc_attr__( 'Typography', 'dfd' ),
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
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Subtitle', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
								'param_name'       => 'subtitle_t_heading',
								'group'            => esc_html__( 'Typography', 'dfd' ),
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
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
								'type'        => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to use custom Google font', 'dfd') . '</span></span>' . esc_html__('Custom font family', 'dfd'),
								'param_name'  => 'subtitle_use_google_fonts',
								'value'				=> '',
								'options'			=> array(
									'yes'			=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd')
									),
								),
								'group'       => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'       => 'google_fonts',
								'param_name' => 'subtitle_custom_fonts',
								'value'      => '',
								'group'      => esc_attr__( 'Typography', 'dfd' ),
								'settings'   => array(
									'fields' => array(
										'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
										'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
									),
								),
								'dependency' => array('element' => 'subtitle_use_google_fonts', 'value'   => 'yes'),
							),

							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Content', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
								'param_name'       => 'content_t_heading',
								'group'            => esc_attr__( 'Typography', 'dfd' ),
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
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
						),
						$delim_options
					),
				) );
			}

		}

		function dfd_info_banner_form( $atts, $content = null ) {

			$style = $title = $subtitle = $image = $img_width = $img_height = $more_show = $readmore_style = $readmore_text = $read_more = $link = '';
			$delimiter_styles = $delimiter_style = $line_width = $line_border = $line_color = $line_hide = $fill_color_start = $fill_color_end = $shadow = $shadow_style = '';
			$title_font_options = $subtitle_font_options = $font_options = $use_google_fonts = $custom_fonts = $animation_data = $subtitle_use_google_fonts = '';
			$el_class = $output = $module_animation = $subtitle_custom_fonts = $vertical_content_alignment = '';
			$title_html =  $subtitle_html = $image_html = $delimiter_html = $content_html = $read_more_html = $shadow_class = $overlay_output = '';
			$content_alignment = $image_effect = '';

//			extract( shortcode_atts( array(
//				'style'                 => 'style-01',
//				'title'                 => '',
//				'subtitle'              => '',
//				'image'                 => '',
//				'img_width'             => '400',
//				'img_height'            => '350',
//				'link'                  => '',
//				'read_more'             => '',
//				'readmore_show'         => '',
//				'more_show'             => '',
//				'readmore_style'        => 'read-more-01',
//				'readmore_text'         => esc_html__( 'Read more', 'dfd' ),
//				'delimiter_style'       => '',
//				'line_width'            => '',
//				'line_border'           => '',
//				'line_color'            => '',
//				'line_hide'             => '',
//				'gradient_color1'      => '',
//				'gradient_color2'        => '',
//				'shadow'                => '',
//				'shadow_style'          => 'permanent',
//				'title_font_options'    => '',
//				'subtitle_font_options' => '',
//				'font_options'          => '',
//				'use_google_fonts'      => '',
//				'custom_fonts'          => '',
//				'module_animation'      => '',
//				'el_class'              => '',
//				'content_alignment'     => 'text-center',
//				'image_effect'			=> '',
//			), $atts ) );
			$atts = vc_map_get_attributes( 'info_banner', $atts );
			extract( $atts );

			/**************************
			 * Appear Animation
			 *************************/

			if ( ! ( $module_animation == '' ) ) {
				$el_class       .= ' cr-animate-gen ';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}

			/**************************
			 * Shadow options.
			 *************************/

			if ( isset( $shadow ) && ( 'show' === $shadow ) ) {
				if ( isset( $shadow_style ) && ( 'hover' === $shadow_style ) ) {
					$shadow_class .= ' module-shadow-hover';
				} else {
					$shadow_class .= ' module-shadow-permanent';
				}
			}

			/**************************
			 * Title / Subtitle HTML.
			 *************************/
			if ( ! empty( $title ) ) {
				$title_options = _crum_parse_text_shortcode_params( $title_font_options, 'feature-title', $use_google_fonts, $custom_fonts  );
				if ( $link && 'title' === $read_more ) {
					$link = vc_build_link( $link );
					$blank = (!empty($link['target']) ? 'target="'.$link['target'].'"' : '');
					$title_html .= '<'.$title_options['tag'].' class="info-box-title ' . $title_options['class'] . '" ' . $title_options['style'] . '><a '.$blank.' href="' . $link['url'] . '">' . esc_html( $title ) . '</a></'.$title_options['tag'].'>';
				} else {
					$title_html .= '<'.$title_options['tag'].' class="info-box-title ' . $title_options['class'] . '" ' . $title_options['style'] . '>' . esc_html( $title ) . '</'.$title_options['tag'].'>';
				}
			}
			if ( ! empty( $subtitle ) ) {
				$subtitle_options = _crum_parse_text_shortcode_params($subtitle_font_options, 'subtitle', $subtitle_use_google_fonts, $subtitle_custom_fonts);
				$subtitle_html .= '<'.$subtitle_options['tag'].' class="info-box-subtitle widget-sub-title ' . $subtitle_options['class'] . '" ' . $subtitle_options['style'] . '>' . esc_html( $subtitle ) . '</'.$subtitle_options['tag'].'>';
			}

			/**************************
			 * Image.
			 *************************/

			if ( ! empty( $image ) ) {
				$image_src = wp_get_attachment_image_src( $image, 'full' );
				if(isset($img_width) && $img_width == '') {
					$img_width = 400;
				}
				if(isset($img_height) && $img_height == '') {
					$img_height = 350;
				}
				$image_url = dfd_aq_resize( $image_src[0], $img_width, $img_height, true, true, true );
				
				if(!$image_url) {
					$image_url = $image_src[0];
				}
				
				$attr = Dfd_Theme_Helpers::get_image_attrs($image_src[0], $image, $img_width, $img_height);
				
				global $dfd_ronneby;
				$cover_class = '';
				if(isset($dfd_ronneby['enable_images_lazy_load']) && $dfd_ronneby['enable_images_lazy_load'] == 'on') {
					$cover_class = 'dfd-img-lazy-load';
					$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $img_width $img_height'%2F%3E";
					$img_html = '<img src="'.$loading_img_src.'" data-src="' . esc_url( $image_url ) . '" '.$attr.' class="info-banner-image ' . esc_attr($shadow_class) . '" ' . /*$image_style .*/ '/>';
				} else {
					$img_html = '<img src="' . esc_url( $image_url ) . '" '.$attr.' class="info-banner-image ' . esc_attr($shadow_class) . '" ' . /*$image_style .*/ '/>';
				}
					
				$image_html .= '<div class="image-cover '.esc_attr($cover_class).'">'.$img_html.'</div>';

				if ( ! empty( $gradient_color1 ) || ! empty( $gradient_color2 ) /*|| ! empty( $thumb_radius )*/ ) {

					$gradient_style = 'style="';

					if ( ! empty( $gradient_color1 ) && ! empty( $gradient_color2 ) ) {
						$gradient_style .= 'background: linear-gradient(to bottom, ' . $gradient_color1 . ', ' . $gradient_color2 . ');';
					} elseif ( ! empty( $gradient_color1 ) || ! empty( $gradient_color2 ) ) {
						if ( ! empty( $gradient_color1 ) ) {
							$gradient_style .= 'background:' . $gradient_color1 . ';';
						} elseif ( ! empty( $gradient_color2 ) ) {
							$gradient_style .= 'background:' . $gradient_color2 . ';';
						}
					}
					$gradient_style .= '"';
				} else {
					$gradient_style = '';
				}
				$overlay_output = '<div class="overlay" ' . $gradient_style . '></div>';
				if ( $link && ( 'image-link' === $read_more ) ) {
					$link = vc_build_link( $link );
					$blank = (!empty($link['target']) ? 'target="'.$link['target'].'"' : '');
					$overlay_output .= '<a class="image-custom-link" '.$blank.' href="'.$link['url'].'"></a>';
				}

			}

			/**************************
			 * Delimiter HTML.
			 *************************/

			if ( $line_width || $line_border || $line_color || $delimiter_style ) {
				$delimiter_styles .= 'style="';
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
			} else {
				$el_class .= ' delimiter-hidden ';
			}

			/**************************
			 * Content HTML.
			 *************************/
			$content_font_options = _crum_parse_text_shortcode_params( $font_options, '');
			$content_style        = $content_font_options['style'];
			$content_html .= '<div class="description" ' . $content_style . '>' . $content . '</div>';

			/**************************
			 * Read More button.
			 *************************/
			if ( isset( $readmore_show ) && 'yes' === $readmore_show ) {
				if ( $link && 'more' === $read_more ) {
					$link = vc_build_link( $link );
					$blank = (!empty($link['target']) ? 'target="'.$link['target'].'"' : '');
					$more_open = '<div class="dfd-module-readmore"><a href="' . esc_url($link['url']) . '" '.$blank.' class="' . esc_attr($readmore_style) . '">';
					$more_close = '</a></div>';
				} else {
					$more_open = '<div class="dfd-module-readmore"><span class="' . $readmore_style . '">';
					$more_close = '</span></div>';
				}
				if ( 'read-more-01' === $readmore_style ) {
					$read_more_html .= $more_open . $readmore_text . $more_close;
				} elseif ( 'read-more-02' === $readmore_style || 'read-more-03' === $readmore_style || 'read-more-04' === $readmore_style ) {
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
			 * Hover styles.
			 *************************/
			if ( 'hover' === $more_show ) {
				$el_class .= ' more-hover';
			}

			if ( 'panr' === $image_effect ) {
				wp_enqueue_script('dfd-tween-max');
				wp_enqueue_script('dfd-panr');
			}

			if ( '' != $image_effect ) {
				$el_class .= ' '.$image_effect;
			}
			
			if ( '' != $content_alignment ) {
				$el_class .= ' '.$content_alignment;
			}
			
			if(isset($vertical_content_alignment) && $vertical_content_alignment != '') {
				$el_class .= ' '.esc_attr($vertical_content_alignment);
			}

			$output .= '<div class="dfd-info-banner ' . esc_attr($style) . ' ' . esc_attr($el_class) . '" ' . $animation_data . '>';

			switch ( $style ) {
				case 'style-01':

					$output .= $image_html;
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= $delimiter_html;
					$output .= $content_html;
					$output .= $read_more_html;
					break;

				case 'style-02':
					$output .= '<div class="image-wrap">';
					$output .= $image_html;
					$output .= $overlay_output;
					$output .= '<div class="title-wrap">';
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= '</div>';
					$output .= '</div>';
					$output .= $delimiter_html;
					$output .= $content_html;
					$output .= $read_more_html;
					break;
				
				case 'style-03':
					$output .= '<div class="image-wrap">';
					$output .= $image_html;
					$output .= $overlay_output;
					$output .= '</div>';
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= $delimiter_html;
					$output .= $content_html;
					$output .= $read_more_html;
					break;

				case 'style-04':
				case 'style-12':
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= $image_html;
					$output .= '<div class="content-wrap">';
					$output .= $delimiter_html;
					$output .= $content_html;
					$output .= $read_more_html;
					$output .= '</div>';
					break;

				case 'style-05':
				case 'style-06':
					$output .= $image_html;
					$output .= '<div class="content-wrap">';
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= $delimiter_html;
					$output .= $content_html;
					$output .= $read_more_html;
					$output .= '</div>';
					break;

				case 'style-07':
					$output .= '<div class="image-wrap">';
					$output .= $image_html;
					$output .= $overlay_output;
					$output .= '<div class="content-wrap">';
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= '</div>';
					$output .= '</div>';
					$output .= $delimiter_html;
					$output .= $content_html;
					$output .= $read_more_html;
					break;

				case 'style-08':
					$output .= '<div class="image-wrap">';
					$output .= $image_html;
					$output .= $overlay_output;
					$output .= '<div class="title-wrap">';
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= $delimiter_html;
					$output .= '</div>';
					$output .= '</div>';
					$output .= '<div class="content-wrap">';
					$output .= $content_html;
					$output .= $read_more_html;
					$output .= '</div>';
					break;

				case 'style-09':
				case 'style-10':
					$output .= '<div class="image-wrap">';
					$output .= $image_html;
					$output .= $overlay_output;
					$output .= '<div class="title-wrap">';
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= '</div>';
					$output .= '</div>';
					$output .= '<div class="content-wrap">';
					$output .= $delimiter_html;
					$output .= $content_html;
					$output .= $read_more_html;
					$output .= '</div>';
					break;

				case 'style-11':
					$output .= '<div class="image-wrap">';
					$output .= $image_html;
					$output .= $overlay_output;
					$output .= '<div class="content-wrap">';
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= $delimiter_html;
					$output .= $content_html;
					$output .= $read_more_html;
					$output .= '</div>';
					$output .= '</div>';
					break;

				case 'style-13':
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= $delimiter_html;
					$output .= '<div class="image-wrap">';
					$output .= $image_html;
					$output .= $overlay_output;
					$output .= '<div class="content-wrap">';
					$output .= $content_html;
					$output .= $read_more_html;
					$output .= '</div>';
					$output .= '</div>';
					break;

				default:
					$output .= $image_html;
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= $delimiter_html;
					$output .= $content_html;
					$output .= $read_more_html;
			}

			if ( $link && 'box' === $read_more ) {
				$link = vc_build_link( $link );
				$blank = (!empty($link['target']) ? 'target="'.$link['target'].'"' : '');
				$output .= '<a '.$blank.' href="' . $link['url'] . '" class="full-box-link"></a>';
			}
			$output .= '</div>';
			return $output;
		}
	}
}

if ( class_exists( 'Dfd_Info_Banner' ) ) {
	$Dfd_Info_Banner = new Dfd_Info_Banner;
}
