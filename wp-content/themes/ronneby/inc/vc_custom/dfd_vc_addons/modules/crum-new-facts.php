<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Facts Line
*/
if ( ! class_exists( 'Dfd_Facts' ) ) {
	/**
	 * Class Dfd_Facts
	 */
	class Dfd_Facts {
		
		function __construct() {
			add_action( 'init', array( $this, '_dfd_facts_init' ) );
			add_shortcode( 'facts', array( $this, '_dfd_facts_shortcode' ) );
		}

		function _dfd_facts_init() {
			if ( function_exists( 'vc_map' ) ) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/facts/';
				$icon_style = _crum_vc_icon_settings();
					foreach ($icon_style as  $key => $icon_param) {
						if($icon_param["param_name"] == "opacity"){
							$icon_style[$key]["dependency"]=array(
									'element' => 'icon_type',
									'value_not_equal_to' => array( 'custom' ),
							);
						}
					}
				vc_map(
					array(
						'name'        => esc_html__( 'New Facts', 'dfd' ),
						'base'        => 'facts',
						'icon'        => 'facts dfd_shortcode',
						'category'    => esc_html__( 'Ronneby 2.0', 'dfd' ),
						'description' => esc_html__( 'Display facts with number and icon', 'dfd' ),
						'params' => array_merge(
							array(
								array(
									'heading'     => esc_html__( 'Style', 'dfd' ),
									'type'        => 'radio_image_select',
									'param_name'  => 'main_layout',
									'simple_mode' => false,
									'options'     => array(
										'layout-1'	=> array(
											'tooltip'	=> esc_attr__('Standard','dfd'),
											'src'		=> $module_images . 'layout-1.png'
										),
										'layout-2'	=> array(
											'tooltip'	=> esc_attr__('Top icon','dfd'),
											'src'		=> $module_images . 'layout-2.png'
										),
										'layout-3'	=> array(
											'tooltip'	=> esc_attr__('Bottom icon','dfd'),
											'src'		=> $module_images . 'layout-3.png'
										),
										'layout-4'	=> array(
											'tooltip'	=> esc_attr__('Left counter','dfd'),
											'src'		=> $module_images . 'layout-4.png'
										),
										'layout-5'	=> array(
											'tooltip'	=> esc_attr__('Right counter','dfd'),
											'src'		=> $module_images . 'layout-5.png'
										),
										'layout-6'	=> array(
											'tooltip'	=> esc_attr__('Left icon','dfd'),
											'src'		=> $module_images . 'layout-6.png'
										),
										'layout-7'	=> array(
											'tooltip'	=> esc_attr__('Right icon','dfd'),
											'src'		=> $module_images . 'layout-7.png'
										),
										'layout-8'	=> array(
											'tooltip'	=> esc_attr__('Left number, right title','dfd'),
											'src'		=> $module_images . 'layout-8.png'
										),
									),
								),
								array(
									'type'             => 'number',
									'heading'          => esc_html__( 'Number', 'dfd' ),
									'param_name'       => 'number',
									'edit_field_class' => 'vc_column vc_col-sm-3 crum_vc',
									'admin_label'      => true,
								),
								array(
									'type'             => 'textfield',
									'heading'          => esc_html__('Title', 'dfd'),
									'param_name'       => 'title',
									'edit_field_class' => 'vc_column vc_col-sm-9',
									'admin_label'      => true,
								),
								array(
									'type'       => 'textarea',
									'heading'    => esc_html__( 'Subtitle', 'dfd' ),
									'param_name' => 'subtitle',
								),
								array(
									'type'       => 'dropdown',
									'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the animation for the number. You can also set the number without animation','dfd').'</span></span>'.esc_html__('Numbers animation', 'dfd'),
									'param_name' => 'transition',
									'value'      => array(
										esc_html__( 'Count numbers', 'dfd' )     => 'counter',
										esc_html__( 'Odometr animation', 'dfd' ) => 'odometer',
										esc_html__( 'Without animation', 'dfd' ) => 'disable-animation',
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
									'text'             => esc_html__('Main settings', 'dfd'),
									'param_name'       => 'main_t_heading',
									'edit_field_class' => 'dfd-heading-param-wrapper vc_column no-top-margin vc_col-sm-12',
									'group'            => esc_html__('Style', 'dfd')
								),
								array(
									'type'				=> 'dfd_radio_advanced',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the horizontal alignment','dfd').'</span></span>'.esc_html__('Alignment', 'dfd'),
									'param_name'		=> 'content_alignment',
									'value'				=> 'text-center',
									'options'			=> array(
										esc_html__('Left', 'dfd')	=> 'text-left',
										esc_html__('Center', 'dfd')	=> 'text-center',
										esc_html__('Right', 'dfd')	=> 'text-right'
									),
									'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc',
									'dependency'		=> array('element' => 'main_layout', 'value' => array('layout-2')),
									'group'            => esc_html__('Style', 'dfd')
								),
								array(
									'type' => 'number',
									'heading' => esc_html__('Number offset top +/-', 'dfd'),
									'param_name' => 'number_margin',
									'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
									'dependency' => array('element' => 'main_layout', 'value' => array('layout-8')),
									'group' => esc_html__('Style', 'dfd')
								),
								array(
									'type' => 'number',
									'heading' => esc_html__('Title wrap offset top +/-', 'dfd'),
									'param_name' => 'title_margin',
									'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
									'dependency' => array('element' => 'main_layout', 'value' => array('layout-8')),
									'group' => esc_html__('Style', 'dfd')
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__('Delimiter style', 'dfd'),
									'param_name'       => 'del_t_heading',
									'edit_field_class' => 'dfd-heading-param-wrapper vc_column no-top-margin vc_col-sm-12',
									'group'            => esc_html__('Style', 'dfd')
								),
							),
							$icon_style,
							array(
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__('Content typography', 'dfd'),
									'param_name'       => 'content_t_heading',
									'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
									'group'            => esc_attr__('Typography', 'dfd'),
								),
								array(
									'type'       => 'dfd_font_container_param',
									'heading'    => '',
									'param_name' => 'font_options',
									'settings'   => array(
										'fields' => array(
										//	'tag' => 'div',
											'font_size',
											'line_height',
											'color',
										),
									),
									'group'      => esc_attr__( 'Typography', 'dfd' ),
								),
								array(
									'type'				=> 'number',
									'heading'			=> esc_html__('Letter spacing', 'dfd'),
									'param_name'		=> 'number_letter_spacing',
									'value'				=> '',
									'group'				=> esc_html__('Typography', 'dfd'),
									'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__('Title typography', 'dfd'),
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
											'font_style'
										),
									),
									'group'      => esc_attr__( 'Typography', 'dfd' ),
								),
								array(
									'type' => 'dfd_single_checkbox',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
									'param_name'  => 'use_google_fonts',
									'options' => array(
										'yes' => array(
											'yes' => esc_attr__('Yes', 'dfd'),
											'no' => esc_attr__('No', 'dfd'),
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
									'dependency' => array('element' => 'use_google_fonts', 'value' => 'yes'),
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__('Subtitle typography', 'dfd'),
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
									'type' => 'dfd_single_checkbox',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
									'param_name'  => 'use_google_fonts_subtitle',
									'options' => array(
										'yes' => array(
											'yes' => esc_attr__('Yes', 'dfd'),
											'no' => esc_attr__('No', 'dfd'),
										),
									),
									'group'       => esc_attr__( 'Typography', 'dfd' ),
								),
								array(
									'type'       => 'google_fonts',
									'param_name' => 'custom_fonts_subtitle',
									'value'      => '',
									'group'      => esc_attr__( 'Typography', 'dfd' ),
									'settings'   => array(
										'fields' => array(
											'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
											'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
										),
									),
									'dependency' => array('element' => 'use_google_fonts_subtitle', 'value' => 'yes'),
								),
							),
							_crum_vc_delim_settings()
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
		function _dfd_facts_shortcode( $atts ) {
			$main_layout = $line_position = $number = $title = $subtitle = $transition = $font_options = $use_google_fonts = $custom_fonts = $title_font_options = '';
			$subtitle_font_options = $line_width = $line_hide = $line_border = $line_color = $letter_spacing = '';
			$title_block = $delimiter_html = $delimiter_style = $title_html = $subtitle_html = $content_style = $content_typo = $icon_style = $icon_html = '';
			$animation = $icon = $icon_image_id = $icon_size = $content_html = $animation_data = $content_alignment = '';
			$output = $el_class = $module_animation = $data_max = $facts_number_html = $disable_animation_class = $number_letter_spacing = $link_css = $uniqid = '';
			$number_margin = $title_margin = $use_google_fonts_subtitle = $custom_fonts_subtitle = '';

			$atts = vc_map_get_attributes( 'facts', $atts );
			extract( $atts );

			wp_enqueue_script( 'odometer-js', get_template_directory_uri() . '/assets/js/odometer.min.js', array( 'jquery' ), false, true );

			$uniqid = uniqid('dfd-facts-') .'-'.rand(1,9999);

			if (!($module_animation == '')) {
				$el_class       .= ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr( $module_animation ) . '" ';
			}
			if(isset($main_layout) && $main_layout == 'layout-2') {
				$el_class .= ' '.esc_attr($content_alignment);
			}
			if(isset($transition) && !empty($transition)) {
				$el_class .= ' dfd-'.esc_attr($transition);
			}

			/*********************
			 *   ICON HTML.
			 ********************/
			if ( (!empty($icon) && $icon != 'none') || !empty($icon_image_id) ) {
				if (isset($atts['icon_size']) && $atts['icon_size'] != '') {
					$link_css .= '#'.esc_js($uniqid).' {min-height: '.esc_js($atts['icon_size']).'px;}';
					$link_css .= '#'.esc_js($uniqid).'.layout-8 .module-icon + .content-wrap {padding-left: '.esc_js($atts['icon_size'] + 20).'px;}';
				}
				$icon_html = '<div class="module-icon">' . crumina_icon_render( $atts ) . '</div>';
			}

			/**************************
			 * Title / Subtitle HTML.
			 *************************/
			if ( ! empty( $title ) ) {
				$title_options = _crum_parse_text_shortcode_params( $title_font_options, 'feature-title', $use_google_fonts, $custom_fonts);
				$title_html = '<'.$title_options['tag'].' class="facts-title ' .$title_options['class'].'" ' . $title_options['style'] . '>' . esc_html( $title ) . '</'.$title_options['tag'].'>';
			}
			if ( ! empty( $subtitle ) ) {
				$subtitle_options = _crum_parse_text_shortcode_params($subtitle_font_options, 'subtitle', $use_google_fonts_subtitle, $custom_fonts_subtitle);
				$subtitle_html = '<'.$subtitle_options['tag'].' class="facts-subtitle ' . $subtitle_options['class'] . '" ' . $subtitle_options['style'] . '>' . wp_kses($subtitle, array('br' => array())) . '</'.$subtitle_options['tag'].'>';
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
			 * Title Block + Delimiter.
			 *************************/

			switch ( $line_position ) {
				case 'top':
					$title_block .= $delimiter_html;
					$title_block .= $title_html;
					$title_block .= $subtitle_html;
					break;

				case 'medium':
					$title_block .= $title_html;
					$title_block .= $delimiter_html;
					$title_block .= $subtitle_html;
					break;

				case 'bottom':
					$title_block .= $title_html;
					$title_block .= $subtitle_html;
					$title_block .= $delimiter_html;
					break;

				default:
					$title_block .= $delimiter_html;
					$title_block .= $title_html;
					$title_block .= $subtitle_html;
					break;
			}

			/**************************
			 * Other Block options.
			 *************************/

			if('counter' === $transition) {
				$animation = 'count';
			}

			$font_options = _crum_parse_text_shortcode_params($font_options,'');
			
			if(isset($number_letter_spacing) && !empty($number_letter_spacing)) {
				$letter_spacing = esc_attr($number_letter_spacing) / 2;
				$link_css .= '#'.esc_js($uniqid).'.dfd-facts-counter .odometer.odometer-auto-theme .odometer-digit {margin: 0 '.esc_js($letter_spacing).'px;}';
			}
			if(isset($number_margin) && $number_margin != '') {
				$link_css .= '#'.esc_js($uniqid).' .content-wrap .stat-count {margin-top: '.esc_js($number_margin).'px;}';
			}
			if(isset($title_margin) && $title_margin != '') {
				$link_css .= '#'.esc_js($uniqid).' .content-wrap .tittle-wrap {margin-top: '.esc_js($title_margin).'px;}';
			}
			
			if (isset($transition) && strcmp($transition, 'disable-animation') === 0) {
				$disable_animation_class = 'disable-animation';
			}
			$data_max = 'data-max="' . esc_attr( $number ) . '"';
			$facts_number_html .= '<div class="facts-number call-on-waypoint '.$disable_animation_class.'" data-animation="' . esc_attr( $animation ) . '" '.$data_max.' ' . $font_options['style'] . '>';
			if (isset($transition) && strcmp($transition, 'disable-animation') === 0) {
				$facts_number_html .= esc_attr( $number );
			}else{
				$facts_number_html .= '0';
			}
			$facts_number_html .= '</div>';
			
			if('layout-1' === $main_layout) {
				if (intval($icon_size) !== '80' && !empty($icon_size)) {
					$wrap_style = 'style="padding-top:' . ( intval( $icon_size ) - 60 ) . 'px;"';
				} else {
					$wrap_style = '';
				}
				$content_html .= '<div class="wrap" ' . $wrap_style . '><div class="stat-count">' . $icon_html . ' '.$facts_number_html.' </div></div>';
			} else {
				$content_html .= '<div class="stat-count"> '.$facts_number_html.' </div>';
			}

			$output .= '<div id="'.$uniqid.'" class="dfd-facts-counter ' . $content_style . ' ' . $main_layout . ' ' . $el_class . '" ' . $animation_data . '>';

				switch ( $main_layout ) {
					case 'layout-1':
						$output .= $content_html;
						$output .= $title_block;
						break;

					case 'layout-2':
						$output .= $icon_html;
						$output .= $content_html;
						$output .= $title_block;
						break;

					case 'layout-3':
						$output .= $content_html;
						if ( ! empty( $line_position ) ) {
							$output .= $title_block;
						} else {
							$output .= $title_html;
							$output .= $subtitle_html;
							$output .= $delimiter_html;
						}
						$output .= $icon_html;
						break;

					case 'layout-4':
						$output .= $content_html;
						$output .= $icon_html;
						$output .= $title_block;
						break;

					case 'layout-5':
						$output .= $icon_html;
						$output .= $content_html;
						$output .= $title_block;
						break;

					case 'layout-6':
					case 'layout-7':
						$output .= $icon_html;
						$output .= '<div class="content-wrap">';
						$output .= $content_html;
						$output .= $title_block;
						$output .= '</div>';
						break;

					case 'layout-8':
						$output .= $icon_html;
						$output .= '<div class="content-wrap">';
							$output .= $content_html;
							$output .= '<div class="tittle-wrap">';
								$output .= $title_block;
							$output .= '</div>';
						$output .= '</div>';
						break;
					
					default:
						$output .= $content_html;
						$output .= $title_block;
						break;
				}

				if(!empty($link_css)) {
					$output .= '<script type="text/javascript">
						(function($) {
							$("head").append("<style>'. esc_js($link_css) .'</style>");
						})(jQuery);
					</script>';
				}
			$output .= '</div>';

			return $output;
		}
	}
}
if ( class_exists( 'Dfd_Facts' ) ) {
	$Dfd_Facts = new Dfd_Facts;
}