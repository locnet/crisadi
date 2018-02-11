<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Progressbar Line
*/
if ( ! class_exists( 'Dfd_Progressbar' ) ) {
	/**
	 * Class Dfd_Progressbar
	 */
	class Dfd_Progressbar {
		/**
		 * Main construct class.
		 */
		function __construct() {
			add_action( 'init', array( $this, '_dfd_progressbar_init' ) );
			add_shortcode( 'progressbar', array( $this, '_dfd_progressbar_shortcode' ) );
		}

		/**
		 * Block options.
		 */
		function _dfd_progressbar_init() {
			if ( function_exists( 'vc_map' ) ) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/progressbar/';
				vc_map(
					array(
						'name'        => esc_html__( 'Progress bar', 'dfd' ),
						'base'        => 'progressbar',
						'icon'        => 'progressbar dfd_shortcode',
						'category'    => esc_html__( 'Ronneby 2.0', 'dfd' ),
						'description' => esc_html__( 'Display animated progress bar', 'dfd' ),
						'params'      => array(
							array(
								'heading'     => esc_html__( 'Style', 'dfd' ),
								'type'        => 'radio_image_select',
								'param_name'  => 'main_layout',
								'simple_mode' => false,
								'options'     => array(
									'layout-1'	=> array(
										'tooltip'	=> esc_attr__('Simple','dfd'),
										'src'		=> $module_images . 'layout-1.png'
									),
									'layout-2'	=> array(
										'tooltip'	=> esc_attr__('Bordered','dfd'),
										'src'		=> $module_images . 'layout-2.png'
									),
									'layout-3'	=> array(
										'tooltip'	=> esc_attr__('Diagonal','dfd'),
										'src'		=> $module_images . 'layout-3.png'
									),
									'layout-4'	=> array(
										'tooltip'	=> esc_attr__('Tiled','dfd'),
										'src'		=> $module_images . 'layout-4.png'
									),
								),
							),
							array(
								'type'             => 'number',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the progress value','dfd').'</span></span>'.esc_html__( 'Progress value', 'dfd' ),
								'param_name'       => 'percent',
								'min'              => '10',
								'max'              => '100',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc no-top-padding',
							),
							array(
								'type'             => 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the progress bar animation','dfd').'</span></span>'.esc_html__( 'Progress animation', 'dfd' ),
								'param_name'       => 'animate_progress',
								'value'              => 'yes',
								'options'		   => array(
									'yes'				=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc no-top-padding',
							),
							array(
								'type'             => 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the slanting lines decoration on progress line','dfd').'</span></span>'.esc_html__('Slanting lines decoration', 'dfd'),
								'param_name'       => 'animate_lines',
								'options'		   => array(
									'yes'				=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc no-top-padding',
								'dependency' => array('element' => 'main_layout', 'value'   => array( 'layout-3' )),
							),
							array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Title', 'dfd' ),
								'param_name'  => 'title',
								'admin_label' => true,
							),
							array(
								'type'        => 'dfd_radio_advanced',
								'heading'	  => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the position for the progress bar text','dfd').'</span></span>'.esc_html__( 'Title position', 'dfd' ),
								'param_name'  => 'text_position',
								'value'       => 'top',
								'options'       => array(
									esc_html__( 'Top', 'dfd' )    => 'top',
									esc_html__( 'Bottom', 'dfd' ) => 'bottom',
								),
							),
							array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__( 'Delimiter color', 'dfd' ),
								'param_name' => 'delim_color',
								'dependency' => array('element' => 'main_layout', 'value'   => array( 'layout-4' )),
							),
							array(
								'type'       => 'dropdown',
								'heading'	 => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd').'</span></span>'.esc_html__('Animation', 'dfd'),
								'param_name' => 'module_animation',
								'value'      => dfd_module_animation_styles(),
							),
							array(
								'type'        => 'textfield',
								'heading'	  => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
								'param_name'  => 'el_class',
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Progress line', 'dfd' ),
								'param_name'       => 'f_s_h',
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the start background color for the progress line. The default color is inherited from Theme options > Styling Options > Third site color','dfd-native').'</span></span>'.esc_html__( 'Start', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
								'param_name'       => 'fill_color_start',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the end background color for the progress line. The default color is inherited from Theme options > Styling Options > Third site color','dfd-native').'</span></span>'.esc_html__( 'End', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
								'param_name'       => 'fill_color_end',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'number',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the progress bar height','dfd').'</span></span>'.esc_html__('Progress line height', 'dfd'),
								'param_name'       => 'height',
								'value'			   => '8',
								'min'              => 1,
								'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Back line', 'dfd' ),
								'param_name'       => 'b_s_h',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'number',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify width for the back line border','dfd').'</span></span>'.esc_html__( 'Border width', 'dfd' ),
								'param_name'       => 'line_border',
								'value'			   => '0',
								'min'              => 0,
								'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
								'dependency' => array('element' => 'main_layout', 'value'   => array( 'layout-2', 'layout-3' )),
							),
							array(
								'type'             => 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify color for the back line border','dfd').'</span></span>'.esc_html__( 'Border Color', 'dfd' ),
								'param_name'       => 'line_color',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
								'dependency' => array('element' => 'main_layout', 'value'   => array( 'layout-2', 'layout-3' )),
							),
							array(
								'type'             => 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the background color for the back line. The default value for the style Tiled is rgba(0,0,0,0.1)','dfd').'</span></span>'.esc_html__( 'Background', 'dfd' ),
								'param_name'       => 'bg_color',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Title typography', 'dfd' ),
								'param_name'       => 'content_t_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
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
										'color'
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
								'dependency' => array('element' => 'use_google_fonts', 'value'   => 'yes'),
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Number', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
								'param_name'       => 'nfh',
								'group'            => esc_attr__( 'Typography', 'dfd' ),
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type'       => 'dfd_font_container_param',
								'heading'    => '',
								'param_name' => 'number_font_options',
								'settings'   => array(
									'fields' => array(
										'tag' => 'div',
										'letter_spacing',
										'font_size',
										'color'
									),
								),
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'        => 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
								'param_name'  => 'use_number_google_fonts',
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
								'param_name' => 'number_custom_fonts',
								'value'      => '',
								'settings'   => array(
									'fields' => array(
										'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
										'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
									),
								),
								'dependency' => array('element' => 'use_number_google_fonts', 'value'   => 'yes'),
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),
						),
					)
				);
			}
		}

		/**
		 * Shortcode handler function.
		 *
		 * @param array $atts Shortcode atributes.
		 *
		 * @return string
		 */
		function _dfd_progressbar_shortcode( $atts ) {
			$main_layout = $percent = $animate_progress = $text_position = $title = $font_options = $number_font_options = $fill_color_start = $fill_color_end = $height = '';
			$title_style = $number_style = $line_style = $content_html = $progress_style = $progress_class = $progress_anim_data = $uniqid = $delim_color = $line_color = '';
			$output = $el_class = $module_animation = $animate_lines = $link_css = $border_width = $border_color = $animation_data = $line_border = $bg_color = '';
			$use_google_fonts = $custom_fonts = $use_number_google_fonts = $number_custom_fonts = '';

			$atts = vc_map_get_attributes('progressbar', $atts);
			extract($atts);

			/**************************
			 * Appear Animation
			 *************************/
			
			$uniqid = uniqid('dfd-progress-') .'-'.rand(1,9999);

			if ( ! ( $module_animation == '' ) ) {
				$el_class .= ' cr-animate-gen ';
				$animation_data = 'data-animate-type = "' . esc_attr( $module_animation ) . '" ';
			}

			if ( ! empty( $title ) ) {
				$font_options        = _crum_parse_text_shortcode_params( $font_options, '', $use_google_fonts, $custom_fonts );
				$number_font_options = _crum_parse_text_shortcode_params( $number_font_options, '', $use_number_google_fonts, $number_custom_fonts );

				$title_html = '<div class="title-wrap"><' . $font_options['tag'] . ' class="progressbar-title" ' . $font_options['style'] . '>' . esc_html( $title ) . '</' . $font_options['tag'] . '><' . $number_font_options['tag'] . ' class="progressbar-number" ' . $number_font_options['style'] . '>' . $percent . '<span>%</span></' . $number_font_options['tag'] . '></div>';
			} else {
				$number_font_options = _crum_parse_text_shortcode_params( $number_font_options, '', $use_number_google_fonts, $number_custom_fonts );

				$title_html = '<div class="title-wrap"><' . $number_font_options['tag'] . ' class="progressbar-number" ' . $number_font_options['style'] . '>' . $percent . '<span>%</span></' . $number_font_options['tag'] . '></div>';
			}

			if ( $bg_color || ( $line_border !== '0' ) || $line_color || $delim_color || ( $height !== '8' ) ) {
				$line_style .= 'style="';
				if ( $bg_color ) {
					$line_style .= 'background:' . $bg_color . '; ';
				}
				
				if(isset($line_border) && !empty($line_border)) {
					$border_width = 'border-width: '.esc_attr($line_border).'px; ';
				}
				if(isset($line_color) && !empty($line_color)) {
					$border_color = 'border-color: '.esc_attr($line_color).'; ';
				}
				
				$line_style .= 'height:' . ( intval( $height ) + intval( $line_border * 2 ) ) . 'px;';
				
				if ( 'layout-4' === $main_layout && $delim_color ) {
					$line_style .= ' color: ' . esc_attr( $delim_color ) . '; ';
				}
				$line_style .= '"';
			}

			if ( '0' !== $percent ) {
				if ( 'layout-4' === $main_layout ) {
					$percent = ceil( $percent / 10 ) * 10;
				}
				$progress_anim_data = ' data-percentage-value="' . esc_attr( intval( $percent ) ) . '"';
			}

			if ( $fill_color_end && $fill_color_start ) {
				$progress_style .= 'background: linear-gradient(to right, ' . $fill_color_start . ' 0%,' . $fill_color_end . ' 100%); ';
			} elseif ( $fill_color_start ) {
				$progress_style .= 'background-color:' . $fill_color_start . '; ';
			} elseif ( $fill_color_end ) {
				$progress_style .= 'background-color:' . $fill_color_end . '; ';
			}

			if ( 'yes' !== $animate_progress ) {
				$el_class .= ' no-animation ';
			}
			if ( 'yes' === $animate_lines ) {
				$el_class .= ' move-lines ';
			}

			$link_css .= '#'.$uniqid.'.dfd-progressbar.layout-2 .progress-bar-line:before, #'.$uniqid.'.dfd-progressbar.layout-3 .progress-bar-line:before {'.$border_width.' '.$border_color.'}';

			$content_html .= '
			<div class="progress-bar-line" ' . $line_style . '>';
			if ( 'layout-4' === $main_layout ) {
				for ( $i = 1; $i <= 10; $i ++ ) {
					$content_html .= '<span class="vertical-line"></span>';
				}
			}
			$content_html .= '<div style="' . $progress_style . '" class="meter" ' . $progress_anim_data . '>';
			$content_html .= '</div></div>';

			/**************************
			 * Module.
			 *************************/
			$output .= '<div id="'.$uniqid.'" class="dfd-progressbar ' . $main_layout . ' text-' . $text_position . ' ' . esc_attr( $el_class ) . '" ' . $animation_data . '>';

			if ( 'top' === $text_position ) {
				$output .= $title_html;
				$output .= $content_html;
			} else {
				$output .= $content_html;
				$output .= $title_html;
			}

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
if ( class_exists( 'Dfd_Progressbar' ) ) {
	$Dfd_Progressbar = new Dfd_Progressbar;
}