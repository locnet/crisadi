<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Countdown Line
*/
if ( ! class_exists( 'Dfd_Countdown' ) ) {
	/**
	 * Class Dfd_Countdown
	 */
	class Dfd_Countdown {
		/**
		 * Main construct class.
		 */
		function __construct() {
			add_action( 'init', array( $this, '_dfd_countdown_init' ) );
			add_shortcode( 'countdown', array( $this, '_dfd_countdown_shortcode' ) );
		}
		/**
		 * Block options.
		 */
		function _dfd_countdown_init() {
			if ( function_exists( 'vc_map' ) ) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/countdown/';
				vc_map(
					array(
						'name'             => esc_html__( 'Countdown', 'dfd' ),
						'base'             => 'countdown',
						'icon'             => 'countdown dfd_shortcode',
						'category'         => esc_html__( 'Ronneby 2.0', 'dfd' ),
						'description'      => esc_html__( 'Display animated countdown block', 'dfd' ),
						'params'           => array(
							array(
								'heading'     => esc_html__( 'Style', 'dfd' ),
								'description' => '',
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
										'tooltip'	=> esc_attr__('Underlined','dfd'),
										'src'		=> $module_images . 'layout-3.png'
									),
									'layout-4'	=> array(
										'tooltip'	=> esc_attr__('Background','dfd'),
										'src'		=> $module_images . 'layout-4.png'
									),
								),
							),
							array(
								'type' => 'datetimepicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Date and time format (yyyy/mm/dd hh:mm:ss)','dfd').'</span></span>'.esc_html__('Target time for countdown', 'dfd'),
								'param_name' => 'datetime',
								'value' => '',
								'admin_label' => true,
							),
							array(
								'type' => 'checkbox',
								'heading' => esc_html__('Time Units To Display In Countdown Timer', 'dfd'),
								'param_name' => 'countdown_opts',
								'value' => array(
									esc_html__('Years','dfd') => 'syear',
									esc_html__('Months','dfd') => 'smonth',
									esc_html__('Weeks','dfd') => 'sweek',
									esc_html__('Days','dfd') => 'sday',
									esc_html__('Hours','dfd') => 'shr',
									esc_html__('Minutes','dfd') => 'smin',
									esc_html__('Seconds','dfd') => 'ssec',
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
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Element style', 'dfd' ),
								'param_name'       => 'b_s_h',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column  no-top-margin vc_col-sm-12',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'number',
								'heading'	 => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the border radius for the countdown','dfd').'</span></span>'.esc_html__('border radius', 'dfd'),
								'param_name' => 'radius',
								'min'        => 0,
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'colorpicker',
								'heading'	 => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose border color for the countdown','dfd').'</span></span>'.esc_html__('Border color', 'dfd'),
								'param_name' => 'line_color',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array(
									'element' => 'main_layout',
									'value'   => array('layout-2','layout-3','layout-4')
								),
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'colorpicker',
								'heading'	 => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the background color for the countdown units. The default value is #1b1b1b','dfd').'</span></span>'.esc_html__('Background', 'dfd'),
								'param_name' => 'bg_color',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
								'dependency'		=> array('element' => 'main_layout', 'value' => array('layout-4')),
							),
							array(
								'type'       => 'colorpicker',
								'heading'	 => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose delimiter color for the countdown\'s time utnits','dfd').'</span></span>'.esc_html__('Delimiter color', 'dfd'),
								'param_name' => 'delim_color',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'dfd_single_checkbox',
								'heading'	 => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to enable the shadow around the coundown units','dfd').'</span></span>'.esc_html__('Shadow', 'dfd'),
								'param_name'       => 'shadow',
								'value'      => 'off',
								'options'    => array(
									'show' => array(
										'on'    => esc_html__( 'Yes', 'dfd' ),
										'off'   => esc_html__( 'No', 'dfd' ),
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'        => 'dfd_single_checkbox',
								'heading'	 => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to hide the dividers between the coundown units','dfd').'</span></span>'.esc_html__( 'Disable dividers', 'dfd' ),
								'param_name'  => 'disable_ividers',
								'options'			=> array(
									'yes'				=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Dividers', 'dfd' ).' '.esc_attr__( 'Typography', 'dfd' ),
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
										'font_size',
										'color'
									),
								),
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Number', 'dfd' ).' '.esc_attr__( 'Typography', 'dfd' ),
								'param_name'       => 'nfh',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group'            => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'       => 'dfd_font_container_param',
								'heading'    => '',
								'param_name' => 'number_font_options',
								'settings'   => array(
									'fields' => array(
										'font_size',
										'color'
									),
								),
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Time Units', 'dfd' ).' '.esc_attr__( 'Typography', 'dfd' ),
								'param_name'       => 'tut',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group'            => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'				=> 'number',
								'heading'			=> esc_html__('Font size', 'dfd'),
								'param_name'		=> 'time_units_font_size',
								'value'				=> '',
								'min'				=> 1,
								'max'				=> 10,
								'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group'				=> esc_html__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> esc_html__('Text color', 'dfd'),
								'param_name'		=> 'time_units_font_color',
								'value'				=> '',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
								'group'				=> esc_html__('Typography', 'dfd'),
							),
							array(
								'type'       => 'dfd_font_container_param',
								'heading'    => '',
								'param_name' => 'units_font_options',
								'settings'   => array(
									'fields' => array(
										'letter_spacing',
										'line_height',
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
								'dependency' => array('element' => 'use_google_fonts', 'value' => 'yes'),
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
		 * @param array  $atts    Shortcode atributes.
		 *
		 * @return string
		 */
		function _dfd_countdown_shortcode( $atts ) {
			$main_layout = $datetime = $countdown_opts = $ult_tz = $font_options = $number_font_options = $radius = $bg_color = $line_color = $shadow =  '';
			$dots_style = $line_style = $wrap_style = $count_frmt = $delim_color = $delim_style = $period_style = $use_google_fonts = '';
			$output = $el_class = $module_animation = $time_units_font_size = $time_units_font_color = $units_font_options = $custom_fonts = $link_css = '';
			$disable_ividers = $dot_html = '';

			$atts = vc_map_get_attributes('countdown', $atts);
			extract($atts);

			// Create parts of module according to parameters.

			$uniq_id = uniqid('countdown') .'-'.rand(1,9999);

			$font_options = _crum_parse_text_shortcode_params($font_options);
			$dots_style .= $font_options['style'];
			
			$units_font_options = _crum_parse_text_shortcode_params($units_font_options, '', $use_google_fonts, $custom_fonts);

			if(isset($units_font_options['style']) && $units_font_options['style'] != '') {
				$link_css .= '#'.esc_js($uniq_id).' .period {'.esc_js($units_font_options['style']).'}';
			}
			$number_font_options = _crum_parse_text_shortcode_params($number_font_options);
			if(isset($number_font_options) && !empty($number_font_options)){
				$link_css .= '#'.esc_js($uniq_id).' .number {'.esc_js($number_font_options['style']).'}';
			}
			
			if ( $bg_color || $line_color || $radius ) {
				$wrap_style .= 'style="';
				if ( $bg_color ) {
					$wrap_style .= 'background:' . $bg_color . '; ';
				}if ( $line_color ) {
					$wrap_style .= 'border-color:' . $line_color . '; ';
				}if ( $radius ) {
					$wrap_style .= 'border-radius:' . $radius . 'px; ';
				}

				$wrap_style .= '"';
			}

			if ('show'  ===  $shadow ) {
				$shadow = 'shadow';
			}
			if(isset($delim_color) && !empty($delim_color)){
				$link_css .= '#'.esc_js($uniq_id).' .period {border-color:'.esc_js($delim_color).';}';
			}
			if(isset($time_units_font_color) && !empty($time_units_font_color)){
				$link_css .= '#'.esc_js($uniq_id).' .period {color: '.esc_js($time_units_font_color).';}';
			}
			if ( ! empty( $delim_color ) || !empty($time_units_font_size) || !empty($time_units_font_color)) {
				$period_style .= 'style="';
				if(isset($time_units_font_size) && !empty($time_units_font_size)){
					$period_style .= 'font-size: '. esc_attr($time_units_font_size) .'px; ';
				}
				$period_style .= '"';
			}

			$countdown_opt = explode( ',', $countdown_opts );
			if(isset($disable_ividers) && $disable_ividers != 'yes') {
				$dot_html = '<span class="dot" ' . $dots_style . '><table class="table_vert_align_dot"><tr><td class="table_cell_align_dot" ' . $dots_style . '>:</td></tr></table></span>';
			}else{
				$el_class .= ' disable-dividers';
			}
			if ( is_array( $countdown_opt ) ) {
				$syear = $smonth = $sweek = $sday = $shr = $smin = '';
				foreach ( $countdown_opt as $opt ) {
					if('syear' === $opt) {
						$syear = 'syear';
					}
					if('smonth' === $opt) {
						$smonth = 'smonth';
					}
					if('sweek' === $opt) {
						$sweek = 'sweek';
					}
					if('sday' === $opt) {
						$sday = 'sday';
					}
					if('shr' === $opt) {
						$shr = 'shr';
					}
					if('smin' === $opt) {
						$smin = 'smin';
					}
					if('ssec' === $opt) {
						$ssec = 'ssec';
					}
				}
				
				if('syear' === $syear) {
					$count_frmt .= '<span class="number-wrap ' . $shadow . '" '.$wrap_style.'><span class="number">%-Y</span><span class="period" '.$period_style.'>' . esc_html__( 'Years', 'dfd' ) . '</span><i></i><b></b>'.$dot_html.'</span>';
				}
				
				if('smonth' === $smonth && 'syear' === $syear) {
					$count_frmt .= '<span class="number-wrap ' . $shadow . '" '.$wrap_style.'><span class="number">%-z</span><span class="period" '.$period_style.'>' . esc_html__( 'Months', 'dfd' ) . '</span><i></i><b></b>'.$dot_html.'</span>';
				}elseif('smonth' === $smonth && '' === $syear) {
					$count_frmt .= '<span class="number-wrap ' . $shadow . '" '.$wrap_style.'><span class="number">%-m</span><span class="period" '.$period_style.'>' . esc_html__( 'Months', 'dfd' ) . '</span><i></i><b></b>'.$dot_html.'</span>';
				}
				
				if('sweek' === $sweek && 'smonth' === $smonth) {
					$count_frmt .= '<span class="number-wrap ' . $shadow . '" '.$wrap_style.'><span class="number">%-W</span><span class="period" '.$period_style.'>' . esc_html__( 'Weeks', 'dfd' ) . '</span><i></i><b></b>'.$dot_html.'</span>';
				}elseif('sweek' === $sweek && '' === $syear && '' === $smonth) {
					$count_frmt .= '<span class="number-wrap ' . $shadow . '" '.$wrap_style.'><span class="number">%-w</span><span class="period" '.$period_style.'>' . esc_html__( 'Weeks', 'dfd' ) . '</span><i></i><b></b>'.$dot_html.'</span>';
				}
				
				if('sday' === $sday && 'sweek' === $sweek) {
					$count_frmt .= '<span class="number-wrap ' . $shadow . '" '.$wrap_style.'><span class="number">%-d</span><span class="period" '.$period_style.'>' . esc_html__( 'Days', 'dfd' ) . '</span><i></i><b></b>'.$dot_html.'</span>';
				}elseif('sday' === $sday && '' === $syear && '' === $smonth && '' === $sweek) {
					$count_frmt .= '<span class="number-wrap ' . $shadow . '" '.$wrap_style.'><span class="number">%-D</span><span class="period" '.$period_style.'>' . esc_html__( 'Days', 'dfd' ) . '</span><i></i><b></b>'.$dot_html.'</span>';
				}
				if('shr' === $shr) {
					$count_frmt .= '<span class="number-wrap ' . $shadow . '" '.$wrap_style.'><span class="number">%-H</span><span class="period" '.$period_style.'>' . esc_html__( 'Hours', 'dfd' ) . '</span><i></i><b></b>'.$dot_html.'</span>';
				}
				if('smin' === $smin) {
					$count_frmt .= '<span class="number-wrap ' . $shadow . '" '.$wrap_style.'><span class="number">%-M</span><span class="period" '.$period_style.'>' . esc_html__( 'Minutes', 'dfd' ) . '</span><i></i><b></b>'.$dot_html.'</span>';
				}
				if('ssec' === $ssec) {
					$count_frmt .= '<span class="number-wrap ' . $shadow . '" '.$wrap_style.'><span class="number">%-S</span><span class="period" '.$period_style.'>' . esc_html__( 'Seconds', 'dfd' ) . '</span><i></i><b></b>'.$dot_html.'</span>';
				}
			}

			/**************************
			 * Appear Animation
			 *************************/

			$animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$el_class       .= ' cr-animate-gen ';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}

			// Module output according to layout selection.
			$output .= '<div class="dfd-countdown ' . $main_layout . ' '.esc_attr($el_class).'" ' . $animation_data . '>';

			if($datetime!=''){
				$output .= '<div id="' . $uniq_id . '" class="dfd-countdown-wrap" data-date="'.esc_attr($datetime).'" data-finish-text="'.esc_attr__('Event already pass','dfd-native').'">';
					$output .= '<div class="hide dfd-countdown-html">'.wp_kses($count_frmt, array('span' => array('class' => array(), 'style' => array()), 'i' => array(), 'b' => array())).'</div>';
				$output .= '</div>';
			}
			$output .='</div>';

			ob_start();
			if(!empty($link_css)) {
				$output .= '<script type="text/javascript">'
								. '(function($) {'
									. '$("head").append("<style>'.$link_css.'</style>");'
								. '})(jQuery);'
							. '</script>';
			}
			
			$output .=ob_get_clean();

			return $output;
		}
	}
}
if ( class_exists( 'Dfd_Countdown' ) ) {
	$Dfd_Countdown = new Dfd_Countdown;
}