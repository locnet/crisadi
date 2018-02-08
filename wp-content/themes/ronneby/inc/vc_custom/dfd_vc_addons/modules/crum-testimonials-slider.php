<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( ! class_exists( 'Dfd_Testimonials_Slider' ) ) {

	class Dfd_Testimonials_Slider {

		function __construct() {
			add_action( 'init', array( &$this, 'dfd_testimonial_slider_init' ) );
			add_shortcode( 'testimonials_slider', array( &$this, 'dfd_testimonial_slider_form' ) );
		}

		function dfd_testimonial_slider_init() {

			if ( function_exists( 'vc_map' ) ) {

				vc_map(
					array(
						'name'        => esc_html__( 'Testimonials slider', 'dfd' ),
						'base'        => 'testimonials_slider',
						'icon'        => 'testimonials_slider dfd_shortcode',
						'category'    => esc_html__( 'Ronneby 2.0', 'dfd' ),
						'description' => esc_html__( 'Display slider of your clients testimonials', 'dfd' ),
						'params'      => array(
							array(
								'type'       => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the author image above or below the testimonial','dfd').'</span></span>'.esc_html__('Image position', 'dfd'),
								'param_name' => 'style',
								'value'      => 'above',
								'options'      => array(
									esc_html__( 'Above content', 'dfd' ) => 'above',
									esc_html__( 'Below content', 'dfd' ) => 'below',
								),
							),
							array(
								'type'       => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the content horizontally','dfd').'</span></span>'.esc_html__('Content alignment', 'dfd'),
								'param_name' => 'align',
								'value'      => 'align-center',
								'options'      => array(
									esc_html__( 'Center', 'dfd' ) => 'align-center',
									esc_html__( 'Left', 'dfd' )   => 'align-left',
									esc_html__( 'Right', 'dfd' )  => 'align-right',
								),
							),
							array(
								'type'        => 'param_group',
								'heading'     => __( 'Testimonials', 'dfd' ),
								'param_name'  => 'testimonials',
								'params'      => array(
									array(
										"type"        => "attach_image",
										"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the testimonial author image','dfd').'</span></span>'.esc_html__('Author image', 'dfd'),
										"param_name"  => 'client_photo',
									),
									array(
										'type'             => 'textfield',
										'heading'          => __( 'Title', 'dfd' ),
										'param_name'       => 'title',
										'admin_label'      => true,
										'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									),
									array(
										'type'             => 'textfield',
										'heading'          => __( 'Subtitle', 'dfd' ),
										'param_name'       => 'subtitle',
										'admin_label'      => true,
										'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									),
									array(
										'type'        => 'textarea',
										'heading'     => __( 'Testimonial', 'dfd' ),
										'param_name'  => 'testimonial_text',
									),
								),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Extra features', 'dfd' ),
								'param_name'       => 'extra_features_elements_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type'        => 'dropdown',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd').'</span></span>'.esc_html__('Animation', 'dfd'),
								'param_name'  => 'module_animation',
								'value'       => dfd_module_animation_styles(),
							),
							array(
								'type'        => 'textfield',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__('Custom CSS Class', 'dfd-native'),
								'param_name'  => 'el_class',
							),
							array(
								'type'       => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the autoplay for the carousel','dfd').'</span></span>'.esc_html__('Autoplay‏', 'dfd'),
								'param_name' => 'autoplay',
								'value'      => 'show',
								'options'    => array(
									'show' => array(
										'on'    => esc_html__( 'Yes', 'dfd' ),
										'off'   => esc_html__( 'No', 'dfd' ),
									),
								),
								'group'      => esc_html__( 'Slider settings', 'dfd' )
							),
							array(
								'type'       => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the speed for the autoplay','dfd').'</span></span>'.esc_html__('Autoplay Speed', 'dfd'),
								'param_name' => 'autoplay_speed',
								'dependency' => array( 'element' => 'autoplay', 'value' => array( 'show' ) ),
								'value'      => '5000',
								'min'        => '1000',
								'max'        => '10000',
								'step'       => '200',
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-ml-second crum_vc',
								'group'      => esc_html__( 'Slider settings', 'dfd' )
							),
							array(
								'type'       => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the dragging of the carousel\'s slides','dfd').'</span></span>'.esc_html__('Draggable effect', 'dfd'),
								'param_name' => 'draggable',
								'value'      => '',
								'options'	  => array(
									'yes'		  => array(
											'yes'				=> esc_attr__('Yes', 'dfd'),
											'no'				=> esc_attr__('No', 'dfd'),
										),
									),
								'group'      => esc_html__( 'Slider settings', 'dfd' )
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Author thumbnail', 'dfd' ),
								'param_name'       => 'thumb_t_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
								'group'       => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to show the shadow for the testimonial image','dfd').'</span></span>'.esc_html__('Shadow', 'dfd'),
								'param_name'       => 'shadow',
								'value'      => 'show',
								'options'    => array(
									'show' => array(
										'on'    => esc_html__( 'Yes', 'dfd' ),
										'off'   => esc_html__( 'No', 'dfd' ),
									),
								),
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the size for the author\'s image','dfd').'</span></span>'.esc_html__('Image size', 'dfd'),
								'param_name' => 'thumb_size',
								'min'        => 80,
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the border radius for the author\'s image','dfd').'</span></span>'.esc_html__('Border radius', 'dfd'),
								'param_name' => 'thumb_radius',
								'min'        => 0,
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Delimiter style', 'dfd' ),
								'param_name'       => 'del_t_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group'       => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the width of the testimonial\'s delimiter. The default value is 380px','dfd').'</span></span>'.esc_html__( 'Width', 'dfd' ),
								'param_name' => 'line_width',
								'min'        => 0,
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the height of the testimonial\'s delimiter. The default value is 1px','dfd').'</span></span>'. esc_html__( 'Height', 'dfd' ),
								'param_name' => 'line_border',
								'min'        => 0,
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to  specify the color of the testimonial\'s delimiter. The default value is rgba(0,0,0,0.1)','dfd').'</span></span>'.esc_html__( 'Color', 'dfd' ),
								'param_name' => 'line_color',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to hide the delimiter','dfd').'</span></span>'.esc_html__( 'Disable element', 'dfd' ),
								'options'			=> array(
									'yes'				=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd'),
									),
								),
								'param_name'       => 'line_hide',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Quote symbol', 'dfd' ),
								'param_name'       => 'quote_t_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'group'       => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the size for the testimonial\'s quote symbol. The default value is 30px','dfd').'</span></span>'.esc_html__( 'Size', 'dfd' ),
								'param_name' => 'quote_size',
								'min'        => 0,
								'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the quote color for the testimonial. The default value is #d2d2d2','dfd').'</span></span>'.esc_html__('Color', 'dfd'),
								'param_name' => 'quote_color',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group'      => esc_html__( 'Style', 'dfd' ),
							),
							array(
								'type'             => 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to hide the quote symbol','dfd').'</span></span>'. esc_html__('Disable element', 'dfd'),
								'options'			=> array(
									'yes'			=> array(
										'on'			=> 'Yes',
										'off'			=> 'No',
									),
								),
								'param_name'       => 'quote_hide',
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'group'            => esc_html__( 'Style', 'dfd' ),
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
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
								'param_name'  => 'use_google_fonts',
								'options'	  => array(
									'yes'		  => array(
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
										'letter_spacing',
										'font_size',
										'line_height',
										'color',
										'font_style'
									),
								),
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),

						)
					)
				);
			}
		}

		function dfd_testimonial_slider_form( $atts) {

			$style    = $align = $testimonials = $title_font_options = $subtitle_font_options = $font_options = $use_google_fonts = $custom_fonts = '';
			$controls_html = $thumbs_html = $content_html = $title_html = $subtitle_html = $delimiter_html = $content_style =
			$quote_color = $quote_size = $quote_style = $quote_hide = $icon_html = $image_style = $line_width = $line_border = $line_color = $delimiter_style = $line_hide = $thumb_size = $shadow = '';
			$autoplay = $autoplay_speed = $draggable = $rtl = $infinite_loop = $nav_style = '';
			$el_class = $output = $module_animation = '';
			$_autoplay = isset($atts["autoplay"]) ? $atts["autoplay"]=="show" ? "true" : "false" : "true" ;
			extract( shortcode_atts( array(
				'style'                 => 'above',
				'align'					=> 'center',
				'testimonials'          => '',
				'title_font_options'    => '',
				'subtitle_font_options' => '',
				'font_options'          => '',
				'use_google_fonts'      => '',
				'custom_fonts'          => '',
				'autoplay'              => 'false',
				'autoplay_speed'        => '5000',
				'draggable'             => 'false',
				'shadow'                => '',
				'thumb_radius'          => '',
				'thumb_size'            => '80',
				'line_hide'             => '',
				'line_width'            => '',
				'line_border'           => '',
				'line_color'            => '',
				'quote_size'            => '',
				'quote_hide'            => '',
				'quote_color'           => '',
				'module_animation'      => '',
				'el_class'              => '',
			), $atts ) );

			$no_image = get_template_directory_uri() . '/assets/img/no-user.png';

			$el_class .= ' '.$style.' ';
			$el_class .= ' align-'.$align;

			/**************************
			 * Appear Animation
			 *************************/

			$animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$el_class       .= ' cr-animate-gen ';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}

			/**************************
			 * Typography options
			 *************************/
			$title_options = _crum_parse_text_shortcode_params( $title_font_options, 'feature-title', $use_google_fonts, $custom_fonts  );
			$subtitle_options = _crum_parse_text_shortcode_params( $subtitle_font_options, 'subtitle' );
			$testimonial_text_options = _crum_parse_text_shortcode_params( $font_options, 'dfd-testimonial-content');

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
				$delimiter_html .= '<div class="wrap-delimiter"><div class="delimiter ' . $delimiter_style . '" ' . $delimiter_style . '></div></div>';
			}

			/**************************
			 * Quote HTML.
			 *************************/

			if ( $quote_color || $quote_size ) {
				$quote_style .= 'style="';
				if ( ! empty( $quote_color ) ) {
					$quote_style .= 'color:' . $quote_color . ';';
				}
				if ( ! empty( $quote_size ) ) {
					$quote_style .= 'font-size:' . $quote_size . 'px';
				}
				$quote_style .= '"';
			}

			if ( '1' !== $quote_hide ) {
				$icon_html .= '<span class="icon-wrap"><i class="navicon-quote-right" ' . $quote_style . '></i></span>';
			}

			/**************************
			 * parse array of items.
			 *************************/

			if ( function_exists( 'vc_param_group_parse_atts' ) ) {
				$testimonials = (array) vc_param_group_parse_atts( $testimonials );
			}

			/**************************
			 * Testimonials thumbs.
			 *************************/

			if ( ! empty( $thumb_radius ) ) {
				$image_style .= 'style="border-radius:' . $thumb_radius . 'px;"';
			}
			if ( ! empty( $shadow ) ){
				$shadow = 'enable-shadow';
			}

			if( 'right' === $align ){
				$right_style='dir="rtl"';
				$nav_style = 'direction:rtl;';
				$rtl='true';
			} else {
				$right_style ='';
				$rtl = 'false';
			}
			$style_width_thumb_below = '';
			if ( 80 < intval( $thumb_size ) ) {
				$nav_style = ' width: ' . ( ( intval( $thumb_size ) + 20 ) * 3 ) . 'px;';
				
				if (strcmp($style, 'below') === 0) {
					$style_width_thumb_below = 'style="max-width: '.(intval( $thumb_size ) + 20).'px;"';
				}
			}

			$lazy_load = false;
			global $dfd_ronneby;
			$cover_class = '';
			if(isset($dfd_ronneby['enable_images_lazy_load']) && $dfd_ronneby['enable_images_lazy_load'] == 'on') {
				$lazy_load = true;
				$cover_class = 'dfd-img-lazy-load';
				$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $thumb_size $thumb_size'%2F%3E";
			}

			foreach($testimonials as $testimonial){
				$img_id = '';
				$testimonial_title = isset($testimonial['title'] ) ? $testimonial['title'] : "";
				if ( isset ($testimonial['client_photo'])) {
					$img_id = $testimonial['client_photo'];
					$image_src = wp_get_attachment_image_src( $testimonial['client_photo'], 'full' );
					$image_url = dfd_aq_resize( $image_src[0], $thumb_size, $thumb_size, true, true, true );
					if(!$image_url) {
						$image_url = $image_src[0];
					}
				} else {
					$image_url = $no_image;
				}
				$attr = Dfd_Theme_Helpers::get_image_attrs($image_url, $img_id, $thumb_size, $thumb_size);
				$thumbs_html .= '<a class="thumb '.$cover_class.'" '.$style_width_thumb_below.'>';
				
				if($lazy_load) {
					$img_html = '<img src="'.$loading_img_src.'" data-src="' . $image_url . '" width="'.$thumb_size.'" height="'.$thumb_size.'" '.$attr.' ' . $image_style . '/>';
				} else {
					$img_html = '<img src="' . $image_url . '" width="'.$thumb_size.'" height="'.$thumb_size.'" '.$attr.' ' . $image_style . '/>';
				}
				$thumbs_html .= $img_html;
				if ( 'below' === $style ) {

					$thumbs_html .='<span class="below-title">';
					if ( isset ( $testimonial['title'] ) ) {
						$thumbs_html .= '<' . $title_options['tag'] . ' class="testimonial-title ' . $title_options['class'] . '" ' . $title_options['style'] . '>' . esc_html( $testimonial['title'] ) . '</' . $title_options['tag'] . '>';
					}
					if ( isset ( $testimonial['subtitle'] ) ) {
						$thumbs_html .= '<' . $subtitle_options['tag'] . ' class="testimonial-subtitle ' . $subtitle_options['class'] . '"  ' . $subtitle_options['style'] . '>' . esc_html( $testimonial['subtitle'] ) . '</' . $subtitle_options['tag'] . '>';
					}
					$thumbs_html .= '</span>';
				}
				$thumbs_html .= '</a>';
			}

			$controls_html .= '<div class="testimonials-thumbs-wrap ' . $shadow . '" style="'.$nav_style.'"  ' . $right_style . '>';
				$controls_html .= '<div class="testimonials-thumbs-slider">';
					$controls_html .= $thumbs_html;
				$controls_html .= '</div>';
			$controls_html .= '</div>';

			/**************************
			 * Content.
			 *************************/

			$content_html .= '<div class="testimonials-content-wrap" ' . $right_style . '>';

			if ( ! empty( $quote_size ) ) {
				$content_style .= 'style="min-height:' . $quote_size . 'px"';
			}
			$content_html .= '<div class="testimonials-slider">';
			$counter = 0;
			foreach($testimonials as $single_testimonial) {
				$content_html .= '<div class="testimonials-content">';
				$content_html .= $icon_html;
				$content_html .= '<div class="text-wrap" ' . $content_style . '>';
				if ( isset($single_testimonial['testimonial_text']) && !empty($single_testimonial['testimonial_text']) ) {
					$content_html .= '<div class="testimonial-text ' . $testimonial_text_options['class'] . '" ' . $testimonial_text_options['style'] . '>' . $single_testimonial['testimonial_text'] . '</div>';
				}
				$content_html .= '</div>';
				if ( 'above' === $style ) {

					$content_html .= $delimiter_html;

					if ( isset ( $single_testimonial['title'] ) ) {
						$content_html .= '<' . $title_options['tag'] . ' class="info-box-title ' . $title_options['class'] . '" ' . $title_options['style'] . '>' . esc_html( $single_testimonial['title'] ) . '</' . $title_options['tag'] . '>';
					}
					if ( isset ( $single_testimonial['subtitle'] ) ) {
						$content_html .= '<' . $subtitle_options['tag'] . ' class="info-box-subtitle ' . $subtitle_options['class'] . '"  ' . $subtitle_options['style'] . '>' . esc_html( $single_testimonial['subtitle'] ) . '</' . $subtitle_options['tag'] . '>';
					}
				}


				$content_html .= '</div>';
				$counter++;
			}
			$content_html .= '</div>';
			$content_html .= '</div>';

			/**************************
			 * Module
			 *************************/

			$uniqid = uniqid('testimonial-slider');
			if('center' === $align){
				$centered_slider = 'true';
			} else {
				$centered_slider = 'false';
			}
			if ( '1' === $draggable){
				$draggable = 'true';
				$cls_draggable= " draggable ";
			}else{
				$cls_draggable= "";
			}
			if ( ( 'center' === $align ) && ( $counter > 2 ) ) {
				$start_from = absint($counter / 2);
			}else {
				$start_from = '0';
			}
			
			$output .= '<div id="' . esc_attr( $uniqid ) . '" class="dfd-testimonial-slider  ' . $el_class .$cls_draggable. '"
			data-autoplay="' .$_autoplay . '"
			data-centered="' . $centered_slider . '"
			data-autoplay_speed="' . $autoplay_speed . '"
			data-draggable="' . $draggable . '"
			data-start_slide="' . $start_from . '"
			data-rtl="' . $rtl . '"
			' . $animation_data . '
			>';

			if ( 'above' === $style ) {
				$output .= $controls_html;
				$output .= $content_html;
			} else {
				$output .= $content_html;
				$output .= $delimiter_html;
				$output .= $controls_html;
			}
			$output .= '</div>';
			ob_start();
			?>
			<script type="text/javascript">
				(function ($) {
					"use strict";
					var $carousel = $('#<?php echo esc_js($uniqid); ?>');
					$(document).ready(function () {
						$carousel.find('.testimonials-slider').slick({
							slidesToShow: 1,
							slidesToScroll: 1,
							arrows: false,
							dots: false,
							fade: false,
							asNavFor: $carousel.find('.testimonials-thumbs-slider'),
							centerPadding: '0',
							autoplay: $carousel.data('autoplay'),
							autoplaySpeed: $carousel.data('autoplay_speed'),
							draggable: $carousel.data('draggable'),
							infinite: true,
							rtl: $carousel.data('rtl'),
							initialSlide: $carousel.data('start_slide')

						});
						$carousel.find('.testimonials-thumbs-slider').slick({
							slidesToShow: 1,
							slidesToScroll: 1,
							asNavFor: $carousel.find('.testimonials-slider'),
							dots: false,
							arrows: false,
							draggable: false,
							centerMode: $carousel.data('centered'),
							initialSlide:  $carousel.data('start_slide'),
							variableWidth: true,
							focusOnSelect: true,
							rtl: $carousel.data('rtl')
						});
					});
				})(jQuery);
			</script>
			<?php
			$output .= ob_get_clean();
			return $output;

		}
	}
}

if ( class_exists( 'Dfd_Testimonials_Slider' ) ) {
	$Dfd_Testimonials_Slider = new Dfd_Testimonials_Slider;
}