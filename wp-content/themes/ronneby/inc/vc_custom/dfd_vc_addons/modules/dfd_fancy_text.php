<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists('Dfd_Animated_Text')) {
	class Dfd_Animated_Text {
		function __construct() {
			add_action( 'init', array( &$this, 'dfd_animated_text_init' ) );
			add_shortcode( 'dfd_animated_text', array( &$this, 'dfd_animated_text_shortcode' ) );
		}
		
		function animation_lists() {
			return array(
				esc_attr__('Bounce','dfd') => 'bounce',
				esc_attr__('Flash','dfd') => 'flash',
				esc_attr__('Pulse','dfd') => 'pulse',
				esc_attr__('Rubber Band','dfd') => 'rubberBand',
				esc_attr__('Shake','dfd') => 'shake',
				esc_attr__('Swing','dfd') => 'swing',
				esc_attr__('Tada','dfd') => 'tada',
				esc_attr__('Wobble','dfd') => 'wobble',
				esc_attr__('Jello','dfd') => 'jello',
				esc_attr__('BounceIn','dfd') => 'bounceIn',
				esc_attr__('BounceInDown','dfd') => 'bounceInDown',
				esc_attr__('BounceInLeft','dfd') => 'bounceInLeft',
				esc_attr__('BounceInRight','dfd') => 'bounceInRight',
				esc_attr__('BounceInUp','dfd') => 'bounceInUp',
				esc_attr__('FadeIn','dfd') => 'fadeIn',
				esc_attr__('FadeInDown','dfd') => 'fadeInDown',
				esc_attr__('FadeInDownBig','dfd') => 'fadeInDownBig',
				esc_attr__('FadeInLeft','dfd') => 'fadeInLeft',
				esc_attr__('FadeInLeftBig','dfd') => 'fadeInLeftBig',
				esc_attr__('FadeInRight','dfd') => 'fadeInRight',
				esc_attr__('FadeInRightBig','dfd') => 'fadeInRightBig',
				esc_attr__('FadeInUp','dfd') => 'fadeInUp',
				esc_attr__('FadeInUpBig','dfd') => 'fadeInUpBig',
				esc_attr__('Flip','dfd') => 'flip',
				esc_attr__('FlipInX','dfd') => 'flipInX',
				esc_attr__('FlipInY','dfd') => 'flipInY',
				esc_attr__('LightSpeedIn','dfd') => 'lightSpeedIn',
				esc_attr__('RotateIn','dfd') => 'rotateIn',
				esc_attr__('RotateInDownLeft','dfd') => 'rotateInDownLeft',
				esc_attr__('RotateInDownRight','dfd') => 'rotateInDownRight',
				esc_attr__('RotateInUpLeft','dfd') => 'rotateInUpLeft',
				esc_attr__('RotateInUpRight','dfd') => 'rotateInUpRight',
				esc_attr__('SlideInUp','dfd') => 'slideInUp',
				esc_attr__('SlideInDown','dfd') => 'slideInDown',
				esc_attr__('SlideInLeft','dfd') => 'slideInLeft',
				esc_attr__('SlideInRight','dfd') => 'slideInRight',
				esc_attr__('ZoomIn','dfd') => 'zoomIn',
				esc_attr__('ZoomInDown','dfd') => 'zoomInDown',
				esc_attr__('ZoomInLeft','dfd') => 'zoomInLeft',
				esc_attr__('ZoomInRight','dfd') => 'zoomInRight',
				esc_attr__('ZoomInUp','dfd') => 'zoomInUp',
				esc_attr__('Hinge','dfd') => 'hinge',
				esc_attr__('RollIn','dfd') => 'rollIn',
			);
		}
		
		function dfd_animated_text_init() {
			if ( function_exists( 'vc_map' ) ) {

				vc_map( array(
					'name' => esc_html__('Animated text', 'dfd'),
					'base' => 'dfd_animated_text',
					'controls' => 'full',
					'show_settings_on_create' => true,
					'icon' => 'dfd_animated_text dfd_shortcode',
					'description' => esc_html__('Animated text with changing or typing effect', 'dfd'),
					'category' => esc_html__('Ronneby 2.0', 'dfd'),
					'params'      => array(
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Animation settings', 'dfd' ),
							'param_name'       => 'main_heading',
							'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
						),
						array(
							'type'       => 'radio_image_select',
							'heading'    => '',
							'param_name' => 'style',
							'admin_label' => true,
							'simple_mode'		=> false,
							'options'      => array(
								'chaffle' => array(
									'tooltip' => esc_attr__('Shuffle','dfd'),
									'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/animated_text/chaffle.png'
								),
								'typed' => array(
									'tooltip' => esc_attr__('Typing','dfd'),
									'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/animated_text/typed.png'
								),
								'changethewords' => array(
									'tooltip' => esc_attr__('Changing words','dfd'),
									'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/animated_text/changethewords.png'
								),
							),
						),
						array(
							'type'       => 'dfd_radio_advanced',
							'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the text horizontally','dfd').'</span></span>'.esc_html__('Text alignment', 'dfd'),
							'param_name' => 'alignment',
							'admin_label' => true,
							'value'      => 'text-left',
							'options'      => array(
								esc_attr__('Left','dfd') => 'text-left',
								esc_attr__('Right','dfd') => 'text-right',
								esc_attr__('Center','dfd') => 'text-center',
							),
							'edit_field_class' => 'vc_column vc_col-sm-6',
						),
						array(
							'type' => 'number',
							'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the speed of the text animation','dfd').'</span></span>'.esc_html__('Typing speed', 'dfd'),
							'param_name' => 'type_speed',
							'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-second',
						),
						array(
							'type'       => 'dropdown',
							'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the animation for the words appearing','dfd').'</span></span>'.esc_html__('Words animation effect', 'dfd'),
							'param_name' => 'onchange_animation',
							'edit_field_class' => 'vc_column vc_col-sm-6',
							'dependency'  => array( 'element' => 'style', 'value' => array( 'changethewords' ) ),
							'value'      => $this->animation_lists(),
						),
						array(
							'type'        => 'dfd_single_checkbox',
							'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the loop for the animated text','dfd').'</span></span>'.esc_html__('Loop', 'dfd'),
							'param_name'  => 'loop',
							'value'       => 'on',
							'options' => array(
								'on' => array(
									'on' => 'Yes',
									'off' => 'No',
								),
							),
							'dependency'  => array( 'element' => 'style', 'value' => array( 'typed' ) ),
							'edit_field_class' => 'vc_column vc_col-sm-6',
						),
						array(
							'type'        => 'dfd_single_checkbox',
							'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the cursor for the animated text','dfd').'</span></span>'.esc_html__('Cursor', 'dfd'),
							'param_name'  => 'cursor',
							'value'       => 'on',
							'options' => array(
								'on' => array(
									'on' => 'Yes',
									'off' => 'No',
								),
							),
							'dependency'  => array( 'element' => 'style', 'value' => array( 'typed' ) ),
							'edit_field_class' => 'vc_column vc_col-sm-6',
						),
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Extra features', 'dfd' ),
							'param_name'       => 'extra_features_elements_heading',
							'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
						),
						array(
							'type'        => 'dropdown',
							'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd-native').'</span></span>'.esc_html__('Animation', 'dfd-native'),
							'param_name'  => 'module_animation',
							'value'       => dfd_module_animation_styles(),
						),
						array(
							'type' => 'textfield',
							'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
							'param_name' => 'el_class',
						),
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Content settings', 'dfd' ),
							'param_name'       => 'content_heading',
							'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
							'group'      => esc_html__( 'Content', 'dfd' ),
						),
						array(
							'type'       => 'textarea',
							'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Will be displayed before animated text','dfd').'</span></span>'.esc_attr__('Prefix', 'dfd'),
							'param_name' => 'prefix',
							'group'      => esc_html__( 'Content', 'dfd' ),
						),
						array(
							'type'        => 'param_group',
							'heading'     => esc_html__( 'Animated text strings', 'dfd' ),
							'param_name'  => 'text_fields',
							'params'      => array(
								array(
									'type'        => 'textfield',
									'heading'     => esc_html__( 'Single string', 'dfd' ),
									'param_name'  => 'text_field',
								),
								array(
									'type' => 'colorpicker',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the single string. The default color is inherited from Theme Options > Typography/Fonts > H2 Title Typography','dfd').'</span></span>'. esc_html__('String color', 'dfd'),
									'param_name' => 'text_field_color',
									'edit_field_class' => 'vc_column vc_col-sm-6',
								),
								array(
									'type'			=> 'colorpicker',
									'heading'		=> esc_html__('String background', 'dfd'),
									'param_name'	=> 'text_field_background',
									'edit_field_class' => 'vc_column vc_col-sm-6',
								),
							),
							'group'      => esc_html__( 'Content', 'dfd' ),
						),
						array(
							'type'       => 'textfield',
							'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Will be displayed after animated text','dfd').'</span></span>'.esc_attr__('Postfix', 'dfd'),
							'param_name' => 'postfix',
							'group'      => esc_html__( 'Content', 'dfd' ),
						),
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Typography settings', 'dfd' ),
							'param_name'       => 'typography_heading',
							'group'            => esc_html__( 'Style', 'dfd' ),
							'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
						),
						array(
							'type'       => 'dfd_font_container_param',
							'heading'    => '',
							'param_name' => 'title_font_options',
							'settings'   => array(
								'fields' => array(
									'letter_spacing',
									'font_size',
									'line_height',
									'font_style'
								),
							),
							'group'      => esc_html__( 'Style', 'dfd' ),
						),
						array(
							'type'        => 'dfd_single_checkbox',
							'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
							'param_name'  => 'title_google_fonts',
							'options'	  => array(
								'yes'		  => array(
									'yes'				=> esc_attr__('Yes', 'dfd'),
									'no'				=> esc_attr__('No', 'dfd'),
								),
							),
							'group'       => esc_html__( 'Style', 'dfd' ),
						),
						array(
							'type'       => 'google_fonts',
							'param_name' => 'title_custom_fonts',
							'value'      => '',
							'settings'   => array(
								'fields' => array(
									'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
									'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
								),
							),
							'dependency' => array('element' => 'title_google_fonts', 'value'   => 'yes',),
							'group'      => esc_html__( 'Style', 'dfd' ),
						),
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Prefix and Postfix Typography settings', 'dfd' ),
							'param_name'       => 'typography_add_heading',
							'group'            => esc_html__( 'Style', 'dfd' ),
							'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
						),
						array(
							'type'       => 'dfd_font_container_param',
							'heading'    => '',
							'param_name' => 'pref_post_font_options',
							'settings'   => array(
								'fields' => array(
									'letter_spacing',
									'font_size',
									'line_height',
									'font_style'
								),
							),
							'group'      => esc_html__( 'Style', 'dfd' ),
						),
						array(
							'type'        => 'dfd_single_checkbox',
							'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
							'param_name'  => 'pref_post_google_fonts',
							'options'	  => array(
								'yes'		  => array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd'),
									),
							),
							'group'       => esc_html__( 'Style', 'dfd' ),
						),
						array(
							'type'       => 'google_fonts',
							'param_name' => 'pref_post_custom_fonts',
							'value'      => '',
							'settings'   => array(
								'fields' => array(
									'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
									'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
								),
							),
							'dependency' => array(
								'element' => 'pref_post_google_fonts',
								'value'   => 'yes',
							),
							'group'      => esc_html__( 'Style', 'dfd' ),
						),
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Color settings', 'dfd' ),
							'param_name'       => 'colors_heading',
							'group'            => esc_html__( 'Style', 'dfd' ),
							'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
						),
						array(
							'type' => 'colorpicker',
							'param_name' => 'prefix_color',
							'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the prefix. The default color is inherited from Theme Options > Typography/Fonts > H2 Title Typography','dfd').'</span></span>'.esc_html__('Prefix color', 'dfd'),
							'value' => '',
							'edit_field_class' => 'vc_column vc_col-sm-6',
							'group' => esc_attr__('Style','dfd'),
						),
						array(
							'type' => 'colorpicker',
							'param_name' => 'postfix_color',
							'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the postfix. The default color is inherited from Theme Options > Typography/Fonts > H2 Title Typography','dfd').'</span></span>'.esc_html__('Postfix color', 'dfd'),
							'edit_field_class' => 'vc_column vc_col-sm-6',
							'group' => esc_attr__('Style','dfd'),
						),
						array(
							'type'				=> 'dfd_param_responsive_text',
							'heading'			=> esc_html__('Prefix/postfix responsive settings', 'dfd'),
							'param_name'		=> 'prefix_postfix_responsive',
							'edit_field_class'	=> 'vc_column vc_col-sm-12 no-bottom-padding no-border-bottom',
							'group'				=> esc_html__('Responsive', 'dfd'),
						),
						array(
							'type'				=> 'dfd_param_responsive_text',
							'heading'			=> esc_html__('Animated text responsive settings', 'dfd'),
							'param_name'		=> 'text_responsive',
							'edit_field_class'	=> 'vc_column vc_col-sm-12 no-bottom-padding no-border-bottom',
							'group'				=> esc_html__('Responsive', 'dfd'),
						),
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Min height settings', 'dfd' ),
							'param_name'       => 'min_height_heading',
							'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
							'group'            => esc_html__( 'Responsive', 'dfd' ),
						),
						array(
							'type' => 'number',
							'heading' => esc_html__('Desktop','dfd'),
							'param_name' => 'desktop_min_height',
							'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc dfd-number-wrap',
							'group' => esc_html__( 'Responsive', 'dfd' ),
						),
						array(
							'type' => 'number',
							'heading' => esc_html__('Tablet','dfd'),
							'param_name' => 'tablet_min_height',
							'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc dfd-number-wrap',
							'group' => esc_html__( 'Responsive', 'dfd' ),
						),
						array(
							'type' => 'number',
							'heading' => esc_html__('Mobile','dfd'),
							'param_name' => 'mobile_min_height',
							'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc dfd-number-wrap',
							'group' => esc_html__( 'Responsive', 'dfd' ),
						),
					)
				) );
			}
		}

		function dfd_animated_text_shortcode( $atts, $content = null ) {
			
			global $dfd_ronneby;
			
			$style = $alignment = $type_speed = $onchange_animation = $el_class = $module_animation = $text_field_background = $prefix = $postfix = $text_fields = '';
			$title_font_options = $title_google_fonts = $title_custom_fonts = $prefix_color = $postfix_color = $animated_text_color = $prefix_postfix_responsive = '';
			$text_responsive = $html = $animated_text = $css_rules = $js_rules = $js_atts = $data_atts = $desktop_min_height = $tablet_min_height = $mobile_min_height = '';
			
			if(isset($dfd_ronneby['disable_typography_responsive']) && $dfd_ronneby['disable_typography_responsive']) {
				$responsive_class = 'dfd-disable-resposive-headings';
			} else {
				$responsive_class = 'dfd-enable-resposive-headings';
			}
			
			$atts = vc_map_get_attributes( 'dfd_animated_text', $atts );
			extract( $atts );
			
			$uniqid = uniqid('dfd-animated-text-');
			
			if(!empty($module_animation)) {
				$el_class .= ' cr-animate-gen';
				$data_atts .= ' data-animate-type="'.esc_attr($module_animation).'" ';
			}
			
			if($alignment != '') {
				$el_class .= ' '.$alignment;
			}
			
			$title_font_options = _crum_parse_text_shortcode_params( $title_font_options, '', $title_google_fonts, $title_custom_fonts );
			$title_font_options = str_replace('style=','',$title_font_options['style']);
			$title_font_options = substr($title_font_options, 1, -1);
			
			if($title_font_options != '') {
				$css_rules .= '#' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span.dfd-animate-text span, #' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span.dfd-animate-me {'.esc_js($title_font_options).'}';
			}
			
			$pref_post_font_options = _crum_parse_text_shortcode_params( $pref_post_font_options, '', $pref_post_google_fonts, $pref_post_custom_fonts );
			$pref_post_font_options = str_replace('style=','',$pref_post_font_options['style']);
			$pref_post_font_options = substr($pref_post_font_options, 1, -1);
			
			if($pref_post_font_options != '') {
				$css_rules .= '#' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span, #' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span {'.esc_js($pref_post_font_options).'}';
			}
			
			if($prefix_color != '') {
				$css_rules .= '#' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span.dfd-anim-prefix {color: '.esc_js($prefix_color).';}';
			}
			
			if($postfix_color != '') {
				$css_rules .= '#' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span.dfd-anim-postfix {color: '.esc_js($postfix_color).';}';
			}
			
			if($animated_text_color != '') {
				$css_rules .= '#' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span.dfd-animate-text span, #' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span.dfd-animate-me span {color: '.esc_js($animated_text_color).';}';
			}
			if(isset($desktop_min_height) && $desktop_min_height != '') {
				$css_rules .= '@media (max-width: 1280px) and (min-width: 1024px) {'
					. '#'.esc_js($uniqid).' {min-height: '.esc_js($desktop_min_height).'px;}'
				. '}';
			}
			if(isset($tablet_min_height) && $tablet_min_height != '') {
				$css_rules .= '@media (max-width: 1023px) and (min-width: 800px) {'
					. '#'.esc_js($uniqid).' {min-height: '.esc_js($tablet_min_height).'px;}'
				. '}';
			}
			if(isset($mobile_min_height) && $mobile_min_height != '') {
				$css_rules .= '@media (max-width: 799px) {'
					. '#'.esc_js($uniqid).' {min-height: '.esc_js($mobile_min_height).'px;}'
				. '}';
			}
			
			if($type_speed == '') {
				$type_speed = 10;
			}
			
			switch($style) {
				case 'typed':
					wp_enqueue_script('dfd-typed');
					if(isset($cursor) && $cursor == 'on') {
						$js_atts .= 'showCursor: true,';
					} else {
						$js_atts .= 'showCursor: false,';
					}
					
					if($loop == 'on') {
						$js_atts .= 'loop: true,';
					}
					
					$js_rules .=	'$("#'.esc_js($uniqid).' .dfd-animate-me").typed({
										stringsElement: $("#'. esc_js($uniqid) .' .dfd-animate-text"),'
										.$js_atts.
										'typeSpeed: '. esc_js($type_speed) .'
									});';
					break;
				case 'chaffle':
					$js_rules .=	'$("#'.esc_js($uniqid).' .dfd-animate-text").changeWords({
										animate: "none",
										afterChangeAnimate: "none",	
										selector: "span",
										time: '. esc_js($type_speed) * 1000 .'
									});';
					break;
				case 'changethewords':
					$js_rules .=	'$("#'.esc_js($uniqid).' .dfd-animate-text").changeWords({
										animate: "'. esc_js($onchange_animation) .'",
										selector: "span",
										time: '. esc_js($type_speed) * 1000 .'
									});';
					break;
			}
			
			if(isset($prefix_postfix_responsive) && $prefix_postfix_responsive != '') {
				$css_rules .= Dfd_Resposive_Text_Param::responsive_css($prefix_postfix_responsive, '#' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span.dfd-animate-text, #' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span.dfd-animate-me, #' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span.typed-cursor');
			}
			if(isset($text_responsive) && $text_responsive != '') {
				$css_rules .= Dfd_Resposive_Text_Param::responsive_css($text_responsive, '#' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span.dfd-anim-prefix, #' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span.dfd-anim-postfix');
			}
			
			/* Animated text */
			if(!empty($text_fields)) {
				$text_fields = (array) vc_param_group_parse_atts($text_fields);
				$i = 1;
				foreach($text_fields as $field) {
					$single_field_css = 'style="';
					if(isset($field['text_field_color']) && !empty($field['text_field_color'])) {
						$single_field_css .= 'color: '.esc_attr($field['text_field_color']).';';
					}
					if(isset($field['text_field_background']) && !empty($field['text_field_background'])) {
						$single_field_css .= 'background: '.esc_attr($field['text_field_background']).';';
					}
					$single_field_css .= '"';
					if(isset($field['text_field'])) {
						$animated_text .= '<span class="dfd-animated-text-string  '.esc_attr($style).'" data-remove-hover="true" data-lang="en" data-id="'.esc_attr($i).'" data-load="onload" '.$single_field_css.'>' . esc_html($field['text_field']) . '</span>';
					}
					$i++;
				}
				$animated_text = '<span class="dfd-animate-text">' . $animated_text . '</span>';
				
				if($style == 'typed') {
					$animated_text .= '<span class="dfd-animate-me"></span>';
				}
			}
			
			$html .= '<div class="dfd-animated-text-wrap" id="'.esc_attr($uniqid).'">';
			
				$html .= '<div class="dfd-animated-text-block '.esc_attr($el_class).'" '.$data_atts.'>';
					if($prefix != '') {
						$html .= '<span class="dfd-anim-prefix ">'.wp_kses($prefix, array('br' => array())).'</span>';
					}
					
					$html .= $animated_text;
					
					if($postfix != '') {
						$html .= '<span class="dfd-anim-postfix ">'.esc_html($postfix).'</span>';
					}
				$html .= '</div>';
			
				if($css_rules != '' || $js_rules != '') {
					$html .=	'<script type="text/javascript">
									(function($) {';

						if($js_rules != '') {
							$html .=	'$(document).ready(function() {'.$js_rules.'});';
						}
						
						if($css_rules != '') {
							$html .=	'$("head").append("<style>'.$css_rules.'</style>")';
						}

					$html .=	'
									})(jQuery);
								</script>';
				}
			
			$html .= '</div>';

			return $html;

		}
	}
	$Dfd_Animated_Text = new Dfd_Animated_Text;
}