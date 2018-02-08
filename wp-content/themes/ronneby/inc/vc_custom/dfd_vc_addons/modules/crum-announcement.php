<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Announcement Line
*/
if ( ! class_exists( 'Dfd_Announcement' ) ) {
	/**
	 * Class Dfd_Announcement
	 */
	class Dfd_Announcement {
		/**
		 * Main construct class.
		 */
		function __construct() {
			add_action( 'init', array( $this, '_dfd_announcement_init' ) );
			add_shortcode( 'announcement', array( $this, '_dfd_announcement_shortcode' ) );
		}

		/**
		 * Block options.
		 */
		function _dfd_announcement_init() {
			if ( function_exists( 'vc_map' ) ) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/announcement/';
				vc_map(
					array(
						'name'        => esc_html__( 'Announcement', 'dfd' ),
						'base'        => 'announcement',
						'icon'        => 'announcement dfd_shortcode',
						'category'    => esc_html__( 'Ronneby 2.0', 'dfd' ),
						'description' => esc_html__( 'Display announcement with icon', 'dfd' ),
						'params'      => array(
							array(
								'heading'    => esc_html__( 'Style', 'dfd' ),
								'type'       => 'radio_image_select',
								'param_name' => 'main_style',
								'simple_mode'		=> false,
								'options'    => array(
									'style-1'	=> array(
										'tooltip'	=> esc_attr__('Simple','dfd'),
										'src'		=> $module_images . 'style-1.png'
									),
									'style-2'	=> array(
										'tooltip'	=> esc_attr__('Bordered','dfd'),
										'src'		=> $module_images . 'style-2.png'
									),
									'style-3'	=> array(
										'tooltip'	=> esc_attr__('Background','dfd'),
										'src'		=> $module_images . 'style-3.png'
									),
								),
							),
							array(
								'heading'     => esc_html__( 'Layout', 'dfd' ),
								'type'        => 'radio_image_select',
								'param_name'  => 'main_layout',
								'simple_mode' => false,
								'options'     => array(
									'layout-1'	=> array(
										'tooltip'	=> esc_attr__('Left','dfd'),
										'src'		=> $module_images . 'layout-1.png'
									),
									'layout-2'	=> array(
										'tooltip'	=> esc_attr__('Right','dfd'),
										'src'		=> $module_images . 'layout-2.png'
									),
									'layout-3'	=> array(
										'tooltip'	=> esc_attr__('Inline left','dfd'),
										'src'		=> $module_images . 'layout-3.png'
									),
									'layout-4'	=> array(
										'tooltip'	=> esc_attr__('Inline right','dfd'),
										'src'		=> $module_images . 'layout-4.png'
									),
								),
							),
							array(
								'type'       => 'dfd_radio_advanced',
								'heading'    => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the announcement alignment','dfd').'</span></span>'.esc_html__('Alignment', 'dfd'),
								'param_name' => 'align',
								'value'		=> 'text-center',
								'options'	=> array(
									esc_html__( 'Left', 'dfd' )   => 'align-left',
									esc_html__( 'Center', 'dfd' ) => 'align-center',
									esc_html__( 'Right', 'dfd' )  => 'align-right',
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
								'heading'	=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
								'param_name'  => 'el_class',
							),
							array(
								'type'       => 'textarea_html',
								'heading'    => esc_html__( 'Content', 'dfd' ),
								'param_name' => 'content',
								'admin_label' => true,
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type'       => 'icon_manager',
								'heading'    => esc_html__( 'Select Icon ', 'dfd' ),
								'param_name' => 'icon',
								'std'        => 'dfd-icon-navigation',
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Icon style', 'dfd' ),
								'param_name'       => 'thumb_t_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'dfd_single_checkbox',
                                'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to show or hide the icon for the announcement module','dfd').'</span></span>'.esc_html__('Hide icon', 'dfd'),
								'value' => '',
                                'options' => array(
                                    'yes'	=> array(
                                        'yes'	=> esc_attr__('Yes', 'dfd'),
                                        'no'	=> esc_attr__('No', 'dfd')
                                    ),
                                ),
								'param_name' => 'hide_icon',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to specify the icon\'s border radius','dfd').'</span></span>'.esc_html__('Border radius', 'dfd'),
								'param_name'       => 'icon_radius',
								'min'              => 0,
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'dependency'       => array('element' => 'hide_icon', 'value_not_equal_to' => array( 'yes' )),
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to choose the size for the icon you have set','dfd').'</span></span>'.esc_html__('Icon size', 'dfd'),
								'param_name'       => 'icon_size',
								'min'              => 0,
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'dependency'       => array('element' => 'hide_icon', 'value_not_equal_to' => array( 'yes' )),
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to choose the color for the icon. Default color is #fff for the layouts Left and Right. For the layouts Inline left and Inline right the color is inherited from Theme Options > Styling Options > Main site color','dfd').'</span></span>'.esc_html__( 'Color', 'dfd' ),
								'param_name'       => 'icon_color',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency'       => array('element' => 'hide_icon', 'value_not_equal_to' => array( 'yes' )),
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'colorpicker',
								'heading'		   => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Default icon background is inherited from Theme Options > Styling Options > Main site color. For the layouts Inline left and Inline right the background color is not set by default','dfd').'</span></span>'.esc_html__('Icon background', 'dfd'),
								'param_name'       => 'icon_bg',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency'       => array('element' => 'hide_icon', 'value_not_equal_to' => array( 'yes' )),
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Content style', 'dfd' ),
								'param_name'       => 'del_t_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'number',
                                'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to specify the border radius for the announcement module. Border radius is not set by default','dfd').'</span></span>'.esc_html__('Border radius', 'dfd'),
								'param_name'       => 'content_radius',
								'min'              => 0,
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'number',
								'heading'		   => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to specify the border width for the announcement module. The default border width for the style Bordered is 1px','dfd').'</span></span>'.esc_html__('Border width', 'dfd'),
								'param_name'       => 'content_border',
								'min'              => 0,
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to specify the color for the announcement module\'s border. The default border color for the style Bordered is inherited from Theme Options > Styling Options > Border color','dfd').'</span></span>'.esc_html__('Border color', 'dfd'),
								'param_name'       => 'border_color',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the announcement. Default background color is #8a8f6a','dfd').'</span></span>'.esc_html__('Background color', 'dfd'),
								'param_name'       => 'content_bg',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'dfd_single_checkbox',
								'heading'	 => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('If you choose Dark background the text colors will be changed to make it more visible','dfd').'</span></span>'.esc_html__('Dark Background', 'dfd'),
								'param_name' => 'dark_bg',
								'value'      => '',
								'options'    => array(
									'show' => array(
										'on'    => esc_html__( 'Yes', 'dfd' ),
										'off'   => esc_html__( 'No', 'dfd' ),
									),
								),
								'dependency' => array('element' => 'main_style', 'value' => array( 'style-1' )),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to set the full width background for the announcement according to the row/column width','dfd').'</span></span>'.esc_html__('Full width background', 'dfd'),
								'param_name' => 'full_width_background',
								'value'      => '',
								'options'    => array(
									'show' => array(
										'on'    => esc_html__( 'Yes', 'dfd' ),
										'off'   => esc_html__( 'No', 'dfd' ),
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Content typography', 'dfd' ),
								'param_name'       => 'content_t_heading',
								'group'            => esc_attr__( 'Typography', 'dfd' ),
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type'       => 'dfd_font_container_param',
								'heading'    => '',
								'param_name' => 'font_options',
								'settings'   => array(
									'fields' => array(
										'letter_spacing',
										'font_size',
										'line_height',
										'color',
										'font_style',
									),
								),
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'        => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
								'param_name'  => 'use_google_fonts',
								'value' => '',
                                'options' => array(
                                    'yes'	=> array(
                                        'yes'	=> esc_attr__('Yes', 'dfd'),
                                        'no'	=> esc_attr__('No', 'dfd')
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
								'dependency' => array('element' => 'use_google_fonts', 'value'   => 'yes'),
							),
						),
					)
				);
			}
		}

		/**
		 * Shortcode handler function.
		 *
		 * @param array  $atts    Shortcode atributes.
		 * @param string $content Text Field.
		 *
		 * @return string
		 */
		function _dfd_announcement_shortcode( $atts, $content ) {
			$main_style = $main_layout = $icon = $font_options = $use_google_fonts = $custom_fonts = $icon_size = $icon_radius = $icon_bg = $icon_color = $content_border = $border_color = $content_bg = $content_radius = $dark_bg = '';
			$icon_style = $content_style = $content_typo = $icon_html = $content_html = $hide_icon = $align = $full_width_background = $full_bg_class = $link_css = '';
			$output = $el_class = $module_animation = $uniqid = $container_content_style = $content_style_top = '';

			extract( shortcode_atts( array(
				'main_style'       => 'style-1',
				'main_layout'      => 'layout-1',
				'align'      => 'align-left',
				'icon'             => 'dfd-icon-navigation',
				'font_options'     => '',
				'use_google_fonts' => '',
				'custom_fonts'     => '',
				'hide_icon'        => '',
				'icon_radius'      => '2',
				'icon_size'        => '',
				'icon_bg'          => '',
				'icon_color'       => '',
				'content_border'   => '',
				'border_color'     => '',
				'content_bg'       => '',
				'content_radius'   => '2',
				'dark_bg'          => 'off',
				'full_width_background'          => 'off',
				'module_animation' => '',
				'el_class'         => '',
			), $atts ) );

			$uniqid = uniqid('dfd-announce-') .'-'.rand(1,9999);

			// Create parts of module according to parameters.
			// Avatar HTML.
			if ( ! empty( $icon ) && ( 'none' !== $icon ) && ('yes' !== $hide_icon) ) {
				if ( $icon_bg || ('2' !== $icon_radius ) || $icon_color || $icon_size ) {
					$icon_style .= 'style="';
					if ( $icon_bg ) {
						$icon_style .= 'background:' . $icon_bg . '; ';
					}
					if ('2' !== $icon_radius ) {
						$icon_style .= 'border-radius:' . $icon_radius . 'px; ';
					}
					if ( $icon_size ) {
						$icon_style .= 'font-size:' . $icon_size . 'px; ';
					}
					if ( $icon_color ) {
						$icon_style .= 'color:' . $icon_color . ';';
					}
					$icon_style .= '"';
				}

				$icon_html .= '<div class="module-icon" ' . $icon_style . '>';
				$icon_html .= '<i class = "' . $icon . '"></i>';
				$icon_html .= '</div>';
			}

			// Text Typography.
			$font_options = _crum_parse_text_shortcode_params( $font_options, 'module-text', $use_google_fonts, $custom_fonts );

			$content_html .= '<div class="' . $font_options['class'] . '" ' . $font_options['style'] . '>' . do_shortcode( $content ) . '</div>';

			if ( $content_border || $border_color || $content_bg || ( '2' !== $content_radius ) || $icon_size ) {
				$content_style .= 'style="';
				$container_content_style .= 'style="';
				if ( $content_border ) {
					$content_style .= 'border:' . $border_color . ' ' . $content_border . 'px solid; ';
				}
				if ( '2' !== $content_radius ) {
					$content_style .= 'border-radius:' . $content_radius . 'px; ';
				}
				if ( $content_bg ) {
					$content_style .= 'background-color:' . $content_bg . ';';
				}
				if ( $icon_size ) {
					$container_content_style .= 'margin-top:' . $icon_size . 'px; ';
					$content_style_top = 'top:' . $icon_size . 'px; ';
					$link_css .= '#'.$uniqid.'.dfd-announce-module-wrap.full_bg_class .dfd-announce-module:before {'.$content_style_top.'}';
				}
				$container_content_style .= '"';
				$content_style .= '"';
				
				$link_css .= '#'.$uniqid.'.dfd-announce-module-wrap .dfd-announce-module {'.$container_content_style.'}';
				$link_css .= '#'.$uniqid.'.dfd-announce-module-wrap .dfd-announce-module:before {'.$content_style.'}';
			}

			/**************************
			 * Appear Animation
			 *************************/

			$animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$el_class .= ' cr-animate-gen ';
				$animation_data = 'data-animate-type="' . esc_attr( $module_animation ) . '" ';
			}

			$el_class .= ' ' . $main_style;
			$el_class .= ' ' . $main_layout;
			if ( 'none' === $icon ) {
				$el_class .= ' no-icon';
			}
			if ( 'off' !== $dark_bg ) {
				$el_class .= ' dark-bg';
			}
			if ( 'off' !== $full_width_background ) {
				$full_bg_class = 'full_bg_class';
			}else{
				$full_bg_class = 'no_full_bg_class';
			}

			// Module output according to layout selection.
			$output .= '<div id="'.$uniqid.'" class="dfd-announce-module-wrap ' . $align . ' '.$full_bg_class.' '.$el_class.'" '.$animation_data.'>';
			$output .= '<div class="dfd-announce-module">';
			$output .= $icon_html;
			$output .= $content_html;
			$output .= '</div>';
			$output .= '</div>';
			
			if(!empty($link_css)) {
				$output .= '<script type="text/javascript">
					(function($) {
						$("head").append("<style>'. esc_js($link_css) .'</style>");
					})(jQuery);
				</script>';
			}

			return $output;
		}
	}
}
if ( class_exists( 'Dfd_Announcement' ) ) {
	$Dfd_Announcement = new Dfd_Announcement;
}
