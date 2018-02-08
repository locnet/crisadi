<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Twitter module
*/
if(!class_exists('Dfd_Twitter')) 
{
	class Dfd_Twitter{
		function __construct(){
			add_action('init',array($this,'dfd_twitter_init'));
			add_shortcode('dfd_twitter',array($this,'dfd_twitter_shortcode'));
		}
		function dfd_twitter_init(){
			if(function_exists('vc_map')) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/twitter/';
				vc_map(
					array(
					   'name'				=> esc_html__('Twitter module','dfd'),
					   'base'				=> 'dfd_twitter',
					   'icon'				=> 'dfd_twitter dfd_shortcode',
					   'category'			=> esc_html__('Ronneby 2.0','dfd'),
					   'description'		=> esc_html__('Displays recent tweets carousel','dfd'),
					   'params' => array(
							array(
								'type' => 'ult_param_heading',
								'text' => __('Please make sure that you have all necessary options filled in Twitter options section of <a href="' . admin_url('admin.php?page=_options') . '" target="_blank">Theme options panel</a> before using this module.', 'dfd'),
								'param_name' => 'main_heading_typograpy',
								'class' => 'ult-param-heading',
								'edit_field_class' => 'no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'heading' => esc_html__('Style', 'dfd'),
								'type' => 'radio_image_select',
								'param_name' => 'main_style',
								'simple_mode' => false,
								'options' => array(
									'style-1' => array(
										'tooltip' => esc_attr__('Gray icon', 'dfd'),
										'src' => $module_images . 'style-1.png'
									),
									'style-2' => array(
										'tooltip' => esc_attr__('Top icon', 'dfd'),
										'src' => $module_images . 'style-2.png'
									),
									'style-3' => array(
										'tooltip' => esc_attr__('Bottom icon', 'dfd'),
										'src' => $module_images . 'style-3.png'
									),
									'style-4' => array(
										'tooltip' => esc_attr__('Left icon', 'dfd'),
										'src' => $module_images . 'style-4.png'
									),
									'style-5' => array(
										'tooltip' => esc_attr__('Right icon', 'dfd'),
										'src' => $module_images . 'style-5.png'
									),
									'style-6' => array(
										'tooltip' => esc_attr__('Bottom right icon', 'dfd'),
										'src' => $module_images . 'style-6.png'
									),
									'style-7' => array(
										'tooltip' => esc_attr__('Bottom left icon', 'dfd'),
										'src' => $module_images . 'style-7.png'
									),
								),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Set the number of slides to show', 'dfd') . '</span></span>' . esc_html__('Number of slides to display', 'dfd'),
								'param_name' => 'slides_to_show',
								'value' => 1,
								'group' => esc_html__('Sliding', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 no-top-padding',
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Set the number of slides to scroll', 'dfd') . '</span></span>' . esc_html__('Number of slides to scroll', 'dfd'),
								'param_name' => 'slides_to_scroll',
								'value' => 1,
								'group' => esc_html__('Sliding', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6 no-top-padding',
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the speed for the slideshow', 'dfd') . '</span></span>' . esc_html__('Slideshow speed', 'dfd'),
								'param_name' => 'slideshow_speed',
								'value' => 3000,
								'edit_field_class' => 'vc_column vc_col-sm-4 no-top-padding',
								'group' => esc_html__('Sliding', 'dfd')
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to enable or disable the autoplay for the slider', 'dfd') . '</span></span>' . esc_html__('Auto slideshow', 'dfd'),
								'param_name' => 'auto_slideshow',
								'options' => array(
									'yes' => array(
										'yes' => esc_attr__('Yes', 'dfd'),
										'no' => esc_attr__('No', 'dfd'),
									),
								),
								'group' => esc_html__('Sliding', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-4 no-top-padding',
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to enable or disable the dots navigation', 'dfd') . '</span></span>' . esc_html__('Dots navigation', 'dfd'),
								'param_name' => 'enable_dots',
								'options' => array(
									'yes' => array(
										'yes' => esc_attr__('Yes', 'dfd'),
										'no' => esc_attr__('No', 'dfd'),
									),
								),
								'group' => esc_html__('Sliding', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-4 no-top-padding',
							),
							array(
								'type' => 'radio_image_select',
								'param_name' => 'dots_style',
								'simple_mode' => false,
								'options' => array(
									'dfdrounded' => array(
										'tooltip' => esc_attr__('Rounded', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_1.png'
									),
									'dfdfillrounded' => array(
										'tooltip' => esc_attr__('Filled rounded', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_2.png'
									),
									'dfdfillsquare' => array(
										'tooltip' => esc_attr__('Filled square', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_7.png'
									),
									'dfdemptyrounded' => array(
										'tooltip' => esc_attr__('Transparent rounded', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_3.png'
									),
									'dfdline' => array(
										'tooltip' => esc_attr__('Line', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_4.png'
									),
									'dfdadvancesquare' => array(
										'tooltip' => esc_attr__('Advanced square', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_5.png'
									),
								),
								'heading' => esc_html__('Pagination style', 'dfd'),
								'group' => esc_html__('Sliding', 'dfd'),
								'dependency' => array('element' => 'enable_dots', 'value' => 'yes'),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the twit content alignment', 'dfd') . '</span></span>' . __('Text Alignment', 'dfd'),
								'param_name' => 'text_alignment',
								'value' => 'text-left',
								'options' => array(
									__('Left', 'dfd') => 'text-left',
									__('Center', 'dfd') => 'text-center',
									__('Right', 'dfd') => 'text-right'
								)
							),
							array(
								'type' => 'dropdown',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the appear effect for the element', 'dfd') . '</span></span>' . esc_html__('Animation', 'dfd'),
								'param_name' => 'module_animation',
								'value' => dfd_module_animation_styles(),
							),
							array(
								'type' => 'textfield',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Add the unique class name for the element which can be used for custom CSS codes', 'dfd') . '</span></span>' . esc_html__('Custom CSS Class', 'dfd'),
								'param_name' => 'el_class',
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Content Typography', 'dfd'),
								'param_name' => 'content_t_heading',
								'group' => esc_attr__('Typography', 'dfd'),
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dfd_font_container_param',
								'heading' => '',
								'param_name' => 'font_options',
								'settings' => array(
									'fields' => array(
										'letter_spacing',
										'font_size',
										'line_height',
										'color',
										'font_style',
									),
								),
								'group' => esc_attr__('Typography', 'dfd'),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to use custom Google font', 'dfd') . '</span></span>' . esc_html__('Custom font family', 'dfd'),
								'param_name' => 'use_google_fonts',
								'options' => array(
									'yes' => array(
										'yes' => esc_attr__('Yes', 'dfd'),
										'no' => esc_attr__('No', 'dfd'),
									),
								),
								'group' => esc_attr__('Typography', 'dfd'),
							),
							array(
								'type' => 'google_fonts',
								'param_name' => 'custom_fonts',
								'value' => '',
								'group' => esc_attr__('Typography', 'dfd'),
								'settings' => array(
									'fields' => array(
										'font_family_description' => esc_html__('Select font family.', 'dfd'),
										'font_style_description' => esc_html__('Select font styling.', 'dfd'),
									),
								),
								'dependency' => array('element' => 'use_google_fonts', 'value' => 'yes'),
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Date Typography', 'dfd'),
								'param_name' => 'date_t_heading',
								'group' => esc_attr__('Typography', 'dfd'),
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dfd_font_container_param',
								'heading' => '',
								'param_name' => 'date_font_options',
								'settings' => array(
									'fields' => array(
										'letter_spacing',
										'font_size',
										'line_height',
										'color',
										'font_style',
									),
								),
								'group' => esc_attr__('Typography', 'dfd'),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to use custom Google font', 'dfd') . '</span></span>' . esc_html__('Custom font family', 'dfd'),
								'param_name' => 'date_use_google_fonts',
								'options' => array(
									'yes' => array(
										'yes' => esc_attr__('Yes', 'dfd'),
										'no' => esc_attr__('No', 'dfd'),
									),
								),
								'group' => esc_attr__('Typography', 'dfd'),
							),
							array(
								'type' => 'google_fonts',
								'param_name' => 'date_custom_fonts',
								'value' => '',
								'group' => esc_attr__('Typography', 'dfd'),
								'settings' => array(
									'fields' => array(
										'font_family_description' => esc_html__('Select font family.', 'dfd'),
										'font_style_description' => esc_html__('Select font styling.', 'dfd'),
									),
								),
								'dependency' => array('element' => 'date_use_google_fonts', 'value' => 'yes'),
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Icon Decoration', 'dfd'),
								'param_name' => 'icon_t_decoration',
								'group' => esc_html__('Typography', 'dfd'),
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to show or hide the twitter icon', 'dfd') . '</span></span>' . esc_html__('Icon', 'dfd'),
								'param_name' => 'switch_icon',
								'value' => 'yes',
								'options' => array(
									'yes' => array(
										'yes' => esc_attr__('Yes', 'dfd'),
										'no' => esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class' => 'vc_col-sm-12 vc_column crum_vc',
								'group' => esc_html__('Typography', 'dfd')
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to choose the size for the icon. The default value is 30px', 'dfd') . '</span></span>' . esc_html__('Icon Size', 'dfd'),
								'param_name' => 'icon_size',
								'min' => 10,
								'max' => 100,
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'dependency' => array('element' => 'switch_icon', 'value' => array('yes')),
								'group' => esc_html__('Typography', 'dfd'),
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the color for the icon. The default color is #5eaade. The default value for the style Grey icon is inherited from Theme Options > Styling Options > Border color', 'dfd') . '</span></span>' . esc_html__('Color', 'dfd'),
								'param_name' => 'icon_color',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'switch_icon', 'value' => array('yes')),
								'group' => esc_html__('Typography', 'dfd'),
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Link Decoration', 'dfd'),
								'param_name' => 'link_t_decoration',
								'description' => esc_html__('By default the value is set from theme options.', 'dfd'),
								'group' => esc_html__('Typography', 'dfd'),
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the link\'s font size. The default value is inherited from Theme Options > Styling Options > Link options > Link Typography', 'dfd') . '</span></span>' . esc_html__('Font size', 'dfd'),
								'param_name' => 'link_size',
								'value' => '',
								'min' => 5,
								'max' => 50,
								'group' => esc_html__('Typography', 'dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
							),
						),
					)
				);
			}
		}

		// Shortcode handler function
		function dfd_twitter_shortcode($atts) {
			$output = $el_class = $tweets = $text_alignment = $module_animation = $icon_color = $icon_size = $link_size = $icon_style = $link_style_css = '';
			$main_style = $font_options = $use_google_fonts = $custom_fonts = $content_typo = $google_fonts_obj = $icon_html = $dots_style = $dots_class = '';
			$icon_echo_st1 = $icon_echo_st2 = $icon_echo_st3 = $icon_echo_st4 = $icon_echo_st5 = $icon_echo_st6 = $icon_echo_st7 = $main_style_class = $switch_icon = '';
			$icon_class = $date_font_options = $date_custom_fonts = $date_use_google_fonts = '';
			
			$atts = vc_map_get_attributes( 'dfd_twitter', $atts );
			extract( $atts );
			
			$unique_id = uniqid('dfd-twitter-module-');
			
			if(empty($slides_to_show)) {
				$slides_to_show = 1;
			}
			
			if(empty($slides_to_scroll)) {
				$slides_to_scroll = 1;
			}
			
			if(empty($slideshow_speed)) {
				$slideshow_speed = 3000;
			}
			
			if(isset($auto_slideshow) && $auto_slideshow != 'yes') {
				$auto_slideshow = 'false';
			} else {
				$auto_slideshow = 'true';
			}

			if(isset($enable_dots) && $enable_dots != 'yes') {
				$enable_dots = 'false';
			} else {
				$el_class .= ' dfd-dots-enabled';
				$enable_dots = 'true';
			}
			
			if(isset($dots_style) && !empty($dots_style)) {
				$dots_class = $dots_style;
			}
			
			$icon_style .= 'style="';
			if($icon_color) {
				$icon_style .= 'color:' .$icon_color.'; ';
			}
			if($icon_size) {
				$icon_style .= 'font-size:' .$icon_size.'px; ';
			}
			$icon_style .= '"';
			
			if(isset($text_alignment) && strcmp($text_alignment, 'text-left') === 0 ) {
				$link_style_css .= '.dfd-twitter-module #'.esc_attr($unique_id).' .dfd-slick-dots {text-align: left;}';
			}elseif (strcmp($text_alignment, 'text-right') === 0) {
				$link_style_css .= '.dfd-twitter-module #'.esc_attr($unique_id).' .dfd-slick-dots {text-align: right;}';
			}
			
			if (strcmp($switch_icon, 'yes') === 0) {
				$icon_html = '<i class="icon-module-twitt soc_icon-twitter-3" '.$icon_style.'></i>';
			} else {
				$icon_class = 'without-icon';
			}
			
			if(isset($main_style) && !empty($main_style)) {
				if(strcmp($main_style, 'style-1') === 0) {
					$icon_echo_st1 = $icon_html;
				}elseif(strcmp($main_style, 'style-2') === 0) {
					$icon_echo_st2 = $icon_html;
				}elseif(strcmp($main_style, 'style-3') === 0) {
					$icon_echo_st3 = $icon_html;
				}elseif(strcmp($main_style, 'style-4') === 0) {
					$icon_echo_st4 = $icon_html;
				}elseif(strcmp($main_style, 'style-5') === 0) {
					$icon_echo_st5 = $icon_html;
				}elseif(strcmp($main_style, 'style-6') === 0) {
					$icon_echo_st6 = $icon_html;
				}elseif(strcmp($main_style, 'style-7') === 0) {
					$icon_echo_st7 = $icon_html;
				}
			}

			$font_options = _crum_parse_text_shortcode_params( $font_options, 'content', $use_google_fonts, $custom_fonts );
			$date_font_options = _crum_parse_text_shortcode_params( $date_font_options, '', $date_use_google_fonts, $date_custom_fonts );

			if($link_size !== '') {
				$link_style_css .= '.dfd-twitter-module #'.esc_attr($unique_id).' .tweet-item .tweet .tweet-content a {font-size: '.esc_attr($link_size).'px;}';
			}
			if($date_font_options !== '') {
				$link_style_css .= '.dfd-twitter-module #'.esc_attr($unique_id).' .date {'.esc_js($date_font_options['style']).'}';
			}
			
			// Get the tweets from Twitter.
			require_once locate_template('/inc/lib/twitteroauth.php');
			$twitter = new DFDTwitter();
			$tweets = $twitter->getTweets();

			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			$output .= '<div class="dfd-twitter-module icon-'.esc_attr($main_style).' '.esc_attr($dots_class).' '.esc_attr($el_class).' '.esc_attr($animate).'" '.$animation_data.'>';
				if(!$twitter->hasError()) {
					if(!empty($tweets)) {
						$output .= '<div id="'.esc_attr($unique_id).'">';
							foreach($tweets as $tweet) {
								$output .= '<div class="tweet-item '.esc_attr($icon_class).'">';
									$output .= $icon_echo_st4;
									$output .= '<div class="tweet '.esc_attr($text_alignment).'">';
										$output .= $icon_echo_st2;
										$output .= '<'.$font_options['tag'].' class="tweet-content '.esc_attr($font_options['class']).'" ' . $font_options['style'] . '>';
											$output .= $icon_echo_st1;
											$output .= $tweet['text'];
										$output .= '</'.$font_options['tag'].'>';
										$output .= '<div class="date subtitle">';
											$output .= $icon_echo_st7;
											$output .= date('d F Y', $tweet['time']);//human_time_diff($t['time'], current_time('timestamp'));
											$output .= $icon_echo_st6;
										$output .= '</div>';
										$output .= $icon_echo_st3;
									$output .= '</div>';
									$output .= $icon_echo_st5;
								$output .= '</div>';
							}
						$output .= '</div>';
					}
				} else {
					$output .= '<p class="text-bold text-center">';
						$output .= $twitter->getError()->message;
					$output .= '</p>';
				}
			$output .= '</div>';
			if(!$twitter->hasError() && !empty($tweets)) {

				$breakpoint_first = ($slides_to_show > 3) ? 3 : $slides_to_show;

				$breakpoint_second = ($slides_to_show > 2) ? 2 : $slides_to_show;

				$output .= '<script type="text/javascript">
					(function($) {
						"use strict";
						$(document).ready(function() {
							$("#'.esc_js($unique_id).'").slick({
								infinite: true,
								slidesToShow: '.esc_js($slides_to_show).',
								slidesToScroll: '.esc_js($slides_to_scroll).',
								arrows: false,
								dots: '.esc_js($enable_dots).',
								autoplay: '.esc_js($auto_slideshow) .',
								dotsClass: \'dfd-slick-dots\',
								autoplaySpeed: '.esc_js($slideshow_speed) .',
								customPaging: function(slider, i) {
									return \'<span data-role="none" role="button" aria-required="false" tabindex="0"></span>\';
								},
								responsive: [
									{
										breakpoint: 1280,
										settings: {
											slidesToShow: '.esc_js($breakpoint_first).',
											infinite: true,
											arrows: false,
											dots: '.esc_js($enable_dots) .'
										}
									},
									{
										breakpoint: 800,
										settings: {
											slidesToShow: '.$breakpoint_second.',
											infinite: true,
											arrows: false,
											dots: '.esc_js($enable_dots) .'
										}
									}
								]
							});
						});
						$("#'. esc_js($unique_id) .'").next(".slider-controls").find(".next").click(function(e) {
							$("#'. esc_js($unique_id) .'").slickNext();

							e.preventDefault();
						});

						$("#'. esc_js($unique_id).'").next(".slider-controls").find(".prev").click(function(e) {
							$("#'. esc_js($unique_id) .'").slickPrev();

							e.preventDefault();
						});
						$("#'. esc_js($unique_id) .' .tweet-item").on("mousedown select",(function(e){
							e.preventDefault();
						}));
					})(jQuery);
				</script>';
			}
			if(!empty($link_style_css)) {
				$output .= '<script type="text/javascript">
					(function($) {
						$("head").append("<style type=\'text/css\'>'.esc_js($link_style_css).'</style>");
					})(jQuery);
				</script>';
			}
			return $output;
		}
	}
}
if(class_exists('Dfd_Twitter')) {
	$Dfd_Twitter = new Dfd_Twitter;
}