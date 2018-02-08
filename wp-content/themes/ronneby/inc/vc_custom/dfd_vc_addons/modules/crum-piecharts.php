<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Piecharts Line
*/
if ( ! class_exists( 'Dfd_Piecharts' ) ) {
	/**
	 * Class Dfd_Piecharts
	 */
	class Dfd_Piecharts {
		/**
		 * Main construct class.
		 */
		function __construct() {
			add_action( 'init', array( $this, '_dfd_piecharts_init' ) );
			add_shortcode( 'piecharts', array( $this, '_dfd_piecharts_shortcode' ) );
		}

		/**
		 * Block options.
		 */
		function _dfd_piecharts_init() {
			if ( function_exists( 'vc_map' ) ) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/piecharts/';
				vc_map(
					array(
						'name'        => esc_html__( 'Pie Charts', 'dfd' ),
						'base'        => 'piecharts',
						'icon'        => 'piecharts dfd_shortcode',
						'category'    => esc_html__( 'Ronneby 2.0', 'dfd' ),
						'description' => esc_html__( 'Display animated pie charts', 'dfd' ),
						'params'      => array_merge(
							array(
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
											'tooltip'	=> esc_attr__('Info','dfd'),
											'src'		=> $module_images . 'layout-2.png'
										),
										'layout-3'	=> array(
											'tooltip'	=> esc_attr__('Combined','dfd'),
											'src'		=> $module_images . 'layout-3.png'
										),
										'layout-4'	=> array(
											'tooltip'	=> esc_attr__('Advanced','dfd'),
											'src'		=> $module_images . 'layout-4.png'
										),
									),
								),
								array(
									'type'             => 'number',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the percentage value of the pie chart circle filling','dfd').'</span></span>'.esc_html__( 'Percent circle to fill', 'dfd' ),
									'param_name'       => 'percent',
									'min'              => '10',
									'max'              => '100',
									'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-percent crum_vc',
								),
								array(
									'type'             => 'number',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the size of the pie chart circle','dfd').'</span></span>'.esc_html__('Circle size', 'dfd'),
									'param_name'       => 'size',
									'min'              => 150,
									'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								),

								array(
									'type'       => 'dfd_single_checkbox',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to disable the animation for the pie chart circle','dfd').'</span></span>'.esc_html__( 'Disable circle animation', 'dfd' ),
									'param_name' => 'animation_off',
									'options'			=> array(
										'yes'				=> array(
											'yes'				=> esc_attr__('Yes', 'dfd'),
											'no'				=> esc_attr__('No', 'dfd'),
										),
									),
									'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
								),
								array(
									'type'				=> 'dfd_single_checkbox',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to change the direction for the animation','dfd').'</span></span>'.esc_html__('Anticlockwise ', 'dfd'),
									'param_name'		=> 'clock_wise',
									'options'			=> array(
										'counterclock'		=> array(
											'on'				=> esc_attr__('Yes', 'dfd'),
											'off'				=> esc_attr__('No', 'dfd'),
										),
									),
									'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
								),
								array(
									'type'        => 'textfield',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
									'param_name'  => 'el_class',
								),
								array(
									'type'       => 'dropdown',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd').'</span></span>'.esc_html__('Animation', 'dfd'),
									'param_name' => 'module_animation',
									'value'      => dfd_module_animation_styles(),
								),
								array(
									'type'             => 'number',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the number you would like to display in pie chart','dfd').'</span></span>'.esc_html__('Number', 'dfd'),
									'param_name'       => 'number',
									'admin_label'      => true,
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'group'            => esc_attr__( 'Content', 'dfd' ),
								),
								array(
									'type'             => 'textfield',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the measuring units you\'d like to display in the pie chart','dfd').'</span></span>'.esc_html__('Measuring unit', 'dfd'),
									'param_name'       => 'unit',
									'edit_field_class' => 'vc_column vc_col-sm-6 no-top-padding',
									'group'            => esc_attr__( 'Content', 'dfd' ),
								),
								array(
									'type'        => 'textfield',
									'heading'     => esc_html__( 'Title', 'dfd' ),
									'param_name'  => 'title',
									'admin_label' => true,
									'group'       => esc_attr__( 'Content', 'dfd' ),
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__( 'Subtitle', 'dfd' ),
									'param_name' => 'subtitle',
									'group'      => esc_attr__( 'Content', 'dfd' ),
								),
							),
							_crum_vc_icon_settings(),
							array(

								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Circle style', 'dfd' ),
									'param_name'       => 'f_s_h',
									'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the start color for the pie chart circle. The color is #c39f76 by default','dfd').'</span></span>'.esc_html__( 'Start', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
									'param_name'       => 'fill_color_start',
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the end color for the pie chart circle. The color is #c39f76 by default','dfd').'</span></span>'.esc_html__( 'End', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
									'param_name'       => 'fill_color_end',
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'number',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the width for the pie chart circle','dfd').'</span></span>'.esc_html__( 'Width', 'dfd' ),
									'param_name'       => 'fill_width',
									'min'              => 1,
									'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Border style', 'dfd' ),
									'param_name'       => 'b_s_h',
									'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the border color for the pie chart circle. The color is #efefef by default','dfd').'</span></span>'.esc_html__( 'Color', 'dfd' ),
									'param_name'       => 'bg_color',
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Delimiter style', 'dfd' ),
									'param_name'       => 'del_t_heading',
									'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'number',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the width for the delimiter placed under the pie chart','dfd').'</span></span>'.esc_html__( 'Width', 'dfd' ),
									'param_name'       => 'line_width',
									'min'              => 0,
									'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'number',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the height for the delimiter placed under the pie chart','dfd').'</span></span>'.esc_html__( 'Height', 'dfd' ),
									'param_name'       => 'line_border',
									'min'              => 0,
									'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the color for the delimiter placed under the pie chart. The color is rgba(0, 0, 0, 0.1) by default','dfd').'</span></span>'.esc_html__( 'Color', 'dfd' ),
									'param_name'       => 'line_color',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'dfd_single_checkbox',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to disable the divider under the pie chart','dfd').'</span></span>'.esc_html__( 'Disable delimiter', 'dfd' ),
									'value' => '',
									'options' => array(
										'yes'	=> array(
											'yes'	=> esc_attr__('Yes', 'dfd'),
											'no'	=> esc_attr__('No', 'dfd')
										),
									),
									'param_name'       => 'line_hide',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Content', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
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
											'color'
										),
									),
									'group'      => esc_attr__( 'Typography', 'dfd' ),
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Title', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
									'param_name'       => 'title_t_heading',
									'group'            => esc_attr__( 'Typography', 'dfd' ),
									'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
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
										),
									),
									'group'      => esc_attr__( 'Typography', 'dfd' ),
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
										),
									),
									'group'      => esc_html__( 'Typography', 'dfd' ),
								),
							)
						)
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
		function _dfd_piecharts_shortcode( $atts ) {
			$main_layout = $percent = $icon = $unit= $size = $number = $fill_width = $fill_color_start = $fill_color_end = $bg_color = $title = $subtitle = '';
			$font_options = $title_font_options = $subtitle_font_options = $line_width = $line_hide = $line_border = $line_color = $title_style = $delimiter_html = '';
			$delimiter_style = $title_html = $subtitle_style = $subtitle_html = $content_style = $content_typo = $icon_style = $icon_html = $content_html = '';
			$output = $el_class = $module_animation = $animation_off = $clock_wise = $animation_data = '';

			$atts = vc_map_get_attributes( 'piecharts', $atts );
			extract( $atts );
			
			$uniqid = uniqid('dfd-piecharts-') .'-'. rand(1,9999);
			
			if($main_layout == '') {
				$main_layout = 'layout-1';
			}
			
			if($percent == '') {
				$percent = 0;
			}	
			
			if($number == '') {
				$number = 0;
			}
			
			if($size == '') {
				$size = 150;
			}	
				
			if($fill_color_start == '') {
				$fill_color_start = '#c39f76';
			}	
				
			if($bg_color == '') {
				$bg_color = '#efefef';
			}	

			wp_enqueue_script( 'piechart-js', get_template_directory_uri() . '/assets/js/circle-progress.js', array( 'jquery' ), false, true );

			if ( 'yes' === $animation_off ) {
				$el_class .= ' circle-off-animation ';
			}
			if ( ! ( $module_animation == '' ) ) {
				$el_class       .= ' cr-animate-gen ';
				$animation_data = 'data-animate-type = "' . esc_attr( $module_animation ) . '" ';
			}

			if(isset($clock_wise) && strcmp($clock_wise, 'counterclock') == 0) {
				$el_class .= ' counterclock-wise-animation';
			}
			
			// Create parts of module according to parameters.
			/*********************
			 *   ICON HTML.
			 ********************/
			if ( ! empty( $icon ) || ! empty( $icon_image_id ) ) {

				$icon_html =  crumina_icon_render( $atts ) ;
			}

			/**************************
			 * Content.
			 *************************/
			if ( ! empty( $number ) ) {
				// Content typo HTML.
				$content_options = _crum_parse_text_shortcode_params( $font_options, 'feature-title');
				$content_html = '<'.$content_options['tag'].' class="piecharts-number ' .$content_options['class'].'" data-max="' . esc_attr( $number ) . '" data-units="' . esc_attr( $unit ) . '"' . $content_options['style'] . '>0</'.$content_options['tag'].'>';
			}
			
			/**************************
			 * Title / Subtitle HTML.
			 *************************/
			if ( ! empty( $title ) ) {
				// Title name HTML.
				$title_options = _crum_parse_text_shortcode_params( $title_font_options, 'feature-title');
				$title_html = '<'.$title_options['tag'].' class="pichart-title ' .$title_options['class'].'" ' . $title_options['style'] . '>' . esc_html( $title ) . '</'.$title_options['tag'].'>';
			}

			// Subtitle HTML.
			if ( ! empty( $subtitle ) ) {
				$subtitle_options = _crum_parse_text_shortcode_params($subtitle_font_options, 'subtitle');
				$subtitle_html = '<'.$subtitle_options['tag'].' class="pichart-subtitle ' . $subtitle_options['class'] . '" ' . $subtitle_options['style'] . '>' . esc_html( $subtitle ) . '</'.$subtitle_options['tag'].'>';
			}

			/**************************
			 * Delimiter HTML.
			 *************************/

			if ( $line_width || $line_border || $line_color ) {
				$delimiter_style .= 'style="';
				if ( $line_width ) {
					$delimiter_style .= 'width:' . $line_width . 'px;';
				}
				if ( $line_border ) {
					$delimiter_style .= 'border-width:' . $line_border . 'px;';
				}
				if ( $line_color ) {
					$delimiter_style .= 'border-color:' . $line_color;
				}
				$delimiter_style .= '"';
			}
			if ( 'yes' !== $line_hide ) {
				$delimiter_html .= '<div class="wrap-delimiter"><div class="delimiter" ' . $delimiter_style . '></div></div>';
			}


			/**************************
			 * Other Block options.
			 *************************/
			if(!empty($fill_color_end) && !empty($fill_color_start)){
				$fill_style = 'data-fill="{&quot;gradient&quot;: [&quot;' . $fill_color_start . '&quot;,&quot;' . $fill_color_end . '&quot;]}" ';
			} elseif(!empty($fill_color_end)){
				$fill_style = 'data-fill="{&quot;color&quot;: &quot;' . $fill_color_end . '&quot;}" ';
			} else {
				$fill_style = 'data-fill="{&quot;color&quot;: &quot;' . $fill_color_start . '&quot;}" ';
			}
			$value = $percent / 100;


			// Module output according to layout selection.
			$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-piecharts call-on-waypoint ' . $content_style . ' ' . $main_layout . ' ' . esc_attr( $el_class ) . '"
			data-emptyfill = "'.$bg_color.'" '.$fill_style.'
			data-value="'.$value.'" data-size="'. $size .'"  data-thickness="'.$fill_width.'"  data-animation-start-value="0"
			data-reverse="true" ' . $animation_data . '>';

			switch ( $main_layout ) {
				case 'layout-1':
					$output .= '<div class="inner-circle" style="line-height:'.esc_attr($size).'px; height:'.esc_attr($size).'px; width:'.esc_attr($size).'px;">';
					$output .= $content_html;
					$output .= '</div>';
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= $delimiter_html;
					break;

				case 'layout-2':
					$output .= '<div class="inner-circle" style="line-height:'.esc_attr($size).'px; height:'.esc_attr($size).'px; width:'.esc_attr($size).'px;">';
					$output .= $icon_html;
					$output .= '</div>';
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= $delimiter_html;
					break;

				case 'layout-3':
					$output .= '<div class="inner-circle" style="line-height:'.esc_attr($size).'px; height:'.esc_attr($size).'px; width:'.esc_attr($size).'px;">';
					$output .= $icon_html;
					$output .= $content_html;
					$output .= '</div>';
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= $delimiter_html;
					break;

				case 'layout-4':
					$output .= '<div class="inner-circle" style="line-height:'.esc_attr($size).'px; height:'.esc_attr($size).'px; width:'.esc_attr($size).'px;">';
					$output .= $content_html;
					$output .= '</div>';
					$output .= '<div class="wrap">';
					$output .= '<div class="module-icon">';
					$output .= $icon_html;
					$output .= '</div>';
					$output .= '<div class="title-wrap">';
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= '</div>';
					$output .= $delimiter_html;
					$output .= '</div>';
					break;

				default:
					$output .= $content_html;
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= $delimiter_html;
					break;
			}

			$output .= '</div>';

			return $output;
		}
	}
}
if ( class_exists( 'Dfd_Piecharts' ) ) {
	$Dfd_Piecharts = new Dfd_Piecharts;
}