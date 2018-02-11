<?php
if ( !defined( 'ABSPATH' )) { exit; }
/*
* Add-on Name: DFD Client Logo for Visual Composer
*/
if( !class_exists('Dfd_Logo_Carousel')) {
	
	class Dfd_Logo_Carousel {
		
		function __construct() {
			add_action('init', array(&$this, 'dfd_logo_carousel_init'));
			add_shortcode('dfd_logo_carousel', array(&$this, 'dfd_logo_carousel_form'));
		}
		
		function dfd_logo_carousel_init () {
			if ( function_exists('vc_map') ) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/logo-carousel/';
				vc_map (
					array(
						'name'					=> esc_html__('Image Carousel', 'dfd'),
						'base'					=> 'dfd_logo_carousel',
						'class'					=> 'dfd_logo_carousel dfd_shortcode',
						'icon'					=> 'dfd_logo_carousel dfd_shortcode',
						'category'				=> esc_html__('Ronneby 2.0', 'dfd'),
						'params'				=> array(
							array(
								'heading'			=> esc_html__('Style', 'dfd'),
								'type'				=> 'radio_image_select',
								'param_name'		=> 'main_style',
								'simple_mode'		=> false,
								'options'			=> array(
									'style-1'			=> array(
										'tooltip'			=> esc_attr__('Opacity','dfd'),
										'src'				=> $module_images.'style-1.png'
									),
									'style-2'			=> array(
										'tooltip'			=> esc_attr__('Greyscale','dfd'),
										'src'				=> $module_images.'style-2.png'
									),
									'style-3'			=> array(
										'tooltip'			=> esc_attr__('Rotate','dfd'),
										'src'				=> $module_images.'style-3.png'
									),
								),
							),
							array(
								'type'				=> 'dfd_radio_advanced',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to display images set in carousel or in columns','dfd').'</span></span>'.esc_html__('Display on the screen', 'dfd'),
								'param_name'		=> 'enable_slides',
								'value'				=> 'column',
								'options'			=> array(
										esc_html__('Columns', 'dfd') => 'column',
										esc_html__('Slideshow', 'dfd') => 'slides',
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-12',
							),
							array(
								'type'             => 'dfd_heading_param',
								'text'             => esc_html__( 'Extra features', 'dfd' ),
								'param_name'       => 'extra_features_elements_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
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
//								'type' => 'dfd_video_link_param',
//								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd') . '</span></span>' . esc_html__('Tutorials', 'dfd'),
//								'param_name' => 'tutorials',
//								'doc_link' => '//nativewptheme.net/support/visual-composer/image-carousel',
//								'video_link' => 'https://www.youtube.com/watch?v=_epKpY9EOV8&feature=youtu.be',
//							),
							array(
								'type'				=> 'param_group',
								'heading'			=> esc_html__('List content', 'dfd'),
								'param_name'		=> 'list_fields',
								'value'				=> '%5B%7B%22description%22%3A%22Image%20short%20description%20which%20will%20be%20visible%20on%20the%20back%20side.%20%22%7D%2C%7B%22description%22%3A%22Image%20short%20description%20which%20will%20be%20visible%20on%20the%20back%20side.%20%22%7D%2C%7B%22description%22%3A%22Image%20short%20description%20which%20will%20be%20visible%20on%20the%20back%20side.%20%22%7D%5D',
								'params'			=> array(
									array(
										'type'			=> 'attach_image',
										'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the custom image from media library','dfd').'</span></span>'.esc_html__('Upload Image', 'dfd'),
										'param_name'	=> 'icon_image_id',
									),
									array(
										'type'			=> 'textfield',
										'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add some information for the image. This option is available only for the Rotate style','dfd').'</span></span>'.esc_html__('Description', 'dfd'),
										'param_name'	=> 'description',
										'dependency'	=> array('element' => 'main_style', 'value' => array('style-3'))
									), 
									array(
										'type'			=> 'dfd_single_checkbox',
										'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the link to your image','dfd').'</span></span>'.esc_html__('Link', 'dfd'),
										'param_name'	=> 'link_box',
										'options'		=> array(
											'link_b'		=> array(
												'yes'			=> esc_attr__('Yes', 'dfd'),
												'no'			=> esc_attr__('No', 'dfd')
											),
										),
										'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
									),
									array(
										'type'			=> 'vc_link',
										'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add a custom link or select existing page','dfd').'</span></span>'.esc_html__('Add link', 'dfd'),
										'param_name'	=> 'link',
										'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc no-border-bottom',
										'dependency'	=> array('element' => 'link_box', 'value' => 'link_b'),
									),
								),
								'group'				=> esc_html__('Content', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the number of slides to show','dfd').'</span></span>'.esc_html__('Number of slides to display', 'dfd'),
								'param_name'		=> 'slides_to_show',
								'value'				=> 1,
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding',
								'dependency'		=> array('element' => 'enable_slides', 'value' => 'slides'),
								'group'				=> esc_html__('Sliding', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the number of slides to scroll','dfd').'</span></span>'.esc_html__('Number of slides to scroll', 'dfd'),
								'param_name'		=> 'slides_to_scroll',
								'value'				=> 1,
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding',
								'dependency'		=> array('element' => 'enable_slides', 'value' => 'slides'),
								'group'				=> esc_html__('Sliding', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the speed for the slideshow','dfd').'</span></span>'.esc_html__('Slideshow speed', 'dfd'),
								'param_name'		=> 'slideshow_speed',
								'value'				=> 3000,
								'dependency'		=> array('element' => 'enable_slides', 'value' => 'slides'),
								'group'				=> esc_html__('Sliding', 'dfd')
							),
							array(
								'type'				=> 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the autoplay for the slider','dfd').'</span></span>'.esc_html__('Auto slideshow', 'dfd'),
								'param_name'		=> 'auto_slideshow',
								'options'			=> array(
									'auto_slid'			=> array(
										'on'				=> esc_attr__('Yes', 'dfd'),
										'off'				=> esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'dependency'		=> array('element' => 'enable_slides', 'value' => 'slides'),
								'group'				=> esc_html__('Sliding', 'dfd'),
							),
							array(
								'type'				=> 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the dots navigation','dfd').'</span></span>'.esc_html__('Dots navigation', 'dfd'),
								'param_name'		=> 'enable_dots',
								'options'			=> array(
									'dots'				=> array(
										'on'				=> esc_attr__('Yes', 'dfd'),
										'off'				=> esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'dependency'		=> array('element' => 'enable_slides', 'value' => 'slides'),
								'group'				=> esc_html__('Sliding', 'dfd'),
							),
							array(
								'type' => 'radio_image_select',
								'heading' => esc_html__('Pagination style', 'dfd'),
								'param_name' => 'dots_style',
								'simple_mode' => false,
								'options' => array(
									'dfdrounded' => array(
										'tooltip' => esc_attr__('Rounded dot', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_1.png'
									),
									'dfdfillrounded' => array(
										'tooltip' => esc_attr__('Filled rounded', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_2.png'
									),
									'dfdemptyrounded' => array(
										'tooltip' => esc_attr__('Transparent rounded', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_3.png'
									),
									'dfdfillsquare' => array(
										'tooltip' => esc_attr__('Filled square', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_7.png'
									),
									'dfdroundedold' => array(
										'tooltip' => esc_attr__('Rounded', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_10.png'
									),
									'dfdsquare' => array(
										'tooltip' => esc_attr__('Square', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_6.png'
									),
									'dfdemptysquare' => array(
										'tooltip' => esc_attr__('Transparent square', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_8.png'
									),
									'dfdline' => array(
										'tooltip' => esc_attr__('Line', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_4.png'
									),
									'dfdlineold' => array(
										'tooltip' => esc_attr__('Line hovered', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_9.png'
									),
									'dfdadvancesquare' => array(
										'tooltip' => esc_attr__('Advanced square', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_5.png'
									),
									'dfdemptyroundedold' => array(
										'tooltip' => esc_attr__('Transparent rounded small', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_11.png'
									),
									'dfdfillsquareold' => array(
										'tooltip' => esc_attr__('Filled square small', 'dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_12.png'
									),
								),
								'dependency'		=> array('element' => 'enable_dots', 'value' => array('dots')),
								'group'				=> esc_html__('Sliding', 'dfd'),
							),
							array(
								'type'				=> 'dfd_radio_advanced',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the number of columns you would like to display','dfd').'</span></span>'.esc_html__('Columns', 'dfd'),
								'param_name'		=> 'columns',
								'value'				=> 'default',
								'options'			=> array(
									esc_html__('Auto', 'dfd')		=> 'default',
									esc_html__('1', 'dfd')		=> 1,
									esc_html__('2', 'dfd')		=> 2,
									esc_html__('3', 'dfd')		=> 3,
									esc_html__('4', 'dfd')		=> 4,
									esc_html__('5', 'dfd')		=> 5,
									esc_html__('6', 'dfd')		=> 6,
								),
								'dependency'		=> array('element' => 'enable_slides', 'value' => 'column'),
								'group'				=> esc_html__('Settings', 'dfd'),
							),
							array(
								'type'				=> 'dfd_single_checkbox',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the delimiter between the images','dfd').'</span></span>'.esc_html__('Delimiter', 'dfd'),
								'param_name'		=> 'enable_delimiter',
								'options'			=> array(
									'on'			=> array(
										'on'				=> esc_attr__('Yes', 'dfd'),
										'off'				=> esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'dependency'		=> array('element' => 'enable_slides', 'value' => 'column'),
								'group'				=> esc_html__('Settings', 'dfd'),
							),
							array(
								'type'				=> 'colorpicker',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the mask background. The default mask color is inherited from Theme Options > Styling Options > Main site color','dfd').'</span></span>'.esc_html__('Background', 'dfd'),
								'param_name'		=> 'mask_background',
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'dependency'		=> array('element' => 'main_style', 'value' => array('style-3')),
								'group'				=> esc_html__('Settings', 'dfd'),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Set the border radius for the image. The border radius is not set by default', 'dfd') . '</span></span>' .esc_html__('Border radius', 'dfd'),
								'param_name' => 'thumb_radius',
								'min' => 0,
								'edit_field_class' => 'vc_column vc_col-sm-12 dfd-number-wrap crum_vc',
								'group' => esc_html__('Settings', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the image\'s opacity for the idle. The default opacity is 50%','dfd').'</span></span>'.esc_html__('Opacity', 'dfd'),
								'param_name'		=> 'opacity_before',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-percent crum_vc no-border-bottom',
								'dependency'		=> array('element' => 'main_style', 'value' => array('style-1')),
								'group'				=> esc_html__('Settings', 'dfd'),
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the image\'s opacity for the hover. The opacity is not set by default','dfd').'</span></span>'.esc_html__('Opacity on hover', 'dfd'),
								'param_name'		=> 'opacity_after',
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-percent',
								'dependency'		=> array('element' => 'main_style', 'value' => array('style-1')),
								'group'				=> esc_html__('Settings', 'dfd'),
							),
							array(
								'type'				=> 'ult_param_heading',
								'text'				=> esc_html__('Description Typography', 'dfd'),
								'param_name'		=> 'title_t_heading',
								'class'				=> 'ult-param-heading',
								'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
								'dependency'		=> array('element' => 'main_style', 'value' => array('style-3')),
								'group'				=> esc_attr__('Typography', 'dfd'),
							),
							array(
								'type'				=> 'dfd_font_container_param',
								'param_name'		=> 'title_font_options',
								'settings'			=> array(
									'fields'			=> array(
										'tag'				=> 'div',
										'letter_spacing',
										'font_size',
										'line_height',
										'color',
										'font_style'
									),
								),
								'dependency'		=> array('element' => 'main_style', 'value' => array('style-3')),
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
								'dependency'		=> array('element' => 'main_style', 'value' => array('style-3')),
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
						),
					)
				);
			}
		}
		
		function dfd_logo_carousel_form($atts, $content = null) {
			$main_style = $uniqid = $el_class = $module_animation = $data_atts = $output = $css_rules = $title_font_options = $use_google_fonts = $custom_fonts = $dots_style = '';
			$list_fields = $thumb_radius = $link_css = $desc_color = $mask_background = $opacity_before = $opacity_after = $description = $enable_slides = $enable_main_border = '';

			$atts = vc_map_get_attributes('dfd_logo_carousel', $atts);
			extract($atts);

			$images_lazy_load = false;

			global $dfd_ronneby;

			if(isset($dfd_ronneby['enable_images_lazy_load']) && $dfd_ronneby['enable_images_lazy_load'] == 'on') {
				$images_lazy_load = true;
				$thumb_class = ' dfd-img-lazy-load ';
			}

			$uniqid = uniqid('dfd-logo-carousel-').'-'.rand(1,9999);

			$el_class .= ' '.$main_style;

			if(!($module_animation == '')) {
				$data_atts = ' data-animate="1" data-animate-type = "'.esc_attr($module_animation).'"';
			}

			/********************
			 * Settings Carousel
			 ********************/
			if(empty($slides_to_show)) {
				$slides_to_show = 1;
			}
			$data_atts .= ' data-slide="'.esc_attr($slides_to_show).'"';

			if(empty($slides_to_scroll)) {
				$slides_to_scroll = 1;
			}
			$data_atts .= ' data-scroll="'.esc_attr($slides_to_scroll).'"';

			if(empty($slideshow_speed)) {
				$slideshow_speed = 3000;
			}
			$data_atts .= ' data-speed="'.esc_attr($slideshow_speed).'"';

			if(isset($auto_slideshow) && strcmp($auto_slideshow, 'auto_slid') === 0) {
				$data_atts .= ' data-autoplay="1"';
			}

			if(isset($enable_dots) && strcmp($enable_dots, 'dots') === 0) {
				$data_atts .= ' data-dots="1"';
				$el_class .= ' dots-enable';
			}
			if(isset($dots_style) && !empty($dots_style)) {
				$el_class .= ' '.esc_attr($dots_style);
			}

			/*********************
			 * Settings delimiter
			 *********************/
			if(isset($enable_delimiter) && $enable_delimiter == 'on') {
				$el_class .= ' enable-delimiter';
			}

			if(isset($enable_slides) && $enable_slides == 'slides') {
				$el_class .= ' dfd-slide-images';
			}

			$title_font_options = _crum_parse_text_shortcode_params( $title_font_options, '', $use_google_fonts, $custom_fonts, true );
			if(isset($title_font_options['style']) && $title_font_options['style'] != '') {
				$link_css .= '#'. esc_js($uniqid).' .dfd-logo-carousel-item .thumb-wrap .thumb-wrap-back .desc-text .text-overflow {'.esc_js($title_font_options['style']).'}';
			}

			if(! empty($thumb_radius)){
				$link_css .= '#'.esc_js($uniqid).' .dfd-logo-carousel-item {border-radius: '.esc_attr($thumb_radius).'px;}';
			}
			if(isset($mask_background) && ! empty($mask_background)){
				$link_css .= '#'.esc_js($uniqid).' .dfd-logo-carousel-item .thumb-wrap-back {background: '.esc_attr($mask_background).';}';
			}

			if(isset($main_style) && $main_style == 'style-1'){
				if(isset($opacity_before) && $opacity_before !== ''){
					if($opacity_before < 0) {
						$opacity_before = 0;
					}
					if($opacity_before > 100) {
						$opacity_before = 100;
					}
					$link_css .= '#'.esc_js($uniqid).' .dfd-logo-carousel-item .thumb-wrap {opacity: '.esc_attr($opacity_before) / 100 .';}';
				}
				if(isset($opacity_after) && $opacity_after !== ''){
					if($opacity_after < 0) {
						$opacity_after = 0;
					}
					if($opacity_after > 100) {
						$opacity_after = 100;
					}
					$link_css .= '#'.esc_js($uniqid).' .dfd-logo-carousel-item:hover .thumb-wrap {opacity: '.esc_attr($opacity_after) / 100 .';}';
				}
			}

			if(isset($list_fields) && !empty($list_fields) && function_exists('vc_param_group_parse_atts')) {
				$list_fields = (array) vc_param_group_parse_atts($list_fields);

				if($columns == 'default') {
					$columns_count = count($list_fields);

					if($columns_count > 4) {
						if($columns_count % 3 == 0 && $columns_count % 4 != 0) {
							$columns_count = 3;
						} else {
							$columns_count = 4;
						}
					}
					$num = (int)$columns_count;
					$columns_class = dfd_num_to_string($columns_count);
				} else {
					$columns_class = 'columns-'.$columns;
					$num = (int)$columns;
				}

				$data_atts .= ' data-count="'.esc_attr($num).'"';

				$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-logo-carousel-wrap '.esc_attr($el_class).'" '.$data_atts.'>';

					$output .= '<div class="dfd-logo-carousel-list row">';

						foreach($list_fields as $fields) {

							$image_url = $img_src = $img_html = $desc_html = $link_title = $link_rel = $link_target = $link_html = $thumb = '';
							$width = 675;
							$height = 450;

							if(isset($fields['description']) && !empty($fields['description'])){
								$desc_html = '<span class="desc-text"><'.$title_font_options['tag'].' class="text-overflow" '.$title_font_options['style'].'>'.esc_html($fields['description']).'</'.$title_font_options['tag'].'></span>';
							}

							if(isset($fields['icon_image_id']) && !empty($fields['icon_image_id'])) {
								$thumb = $fields['icon_image_id'];
								$image_url = wp_get_attachment_image_src($fields['icon_image_id'], 'full');

								$img_src = $image_url[0];
								$width = $image_url[1];
								$height = $image_url[2];
							} else {
								$img_src = get_template_directory_uri() . '/assets/images/no_image_resized_480-360.jpg';
							}

							$img_atts = Dfd_Theme_Helpers::get_image_attrs($img_src, $thumb, $width, $height, esc_attr__('Client logo','dfd'));

							if($images_lazy_load) {
								$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $width $height'%2F%3E";
								$img_html = '<img src="'.$loading_img_src.'" data-src="'.esc_url($img_src).'" width="'.esc_attr($width).'" height="'.esc_attr($height).'" '.$img_atts.' />';
							} else {
								$img_html = '<img src="'.esc_url($img_src).'" width="'.esc_attr($width).'" height="'.esc_attr($height).'" '.$img_atts.' />';
							}

							if(isset($fields['link_box']) && $fields['link_box'] == 'link_b' && isset($fields['link'])) {
								$link = vc_build_link($fields['link']);
								$link_title = !empty($link['title']) ? 'title="'.esc_attr($link['title']).'"' : '';
								$link_rel = !empty($link['rel']) ? 'rel="'.esc_attr($link['rel']).'"' : '';
								$link_target = !empty($link['target']) ? 'target="'.esc_attr(preg_replace('/\s+/', '', $link['target'])).'"' : '';
								$link_html = '<a href="'.esc_url($link['url']).'" class="full-box-link" '.$link_title.' '.$link_target.' '.$link_rel.'></a>';
							}

							$output .= '<div class="dfd-item-offset columns columns-with-border logo-carousel '.esc_attr($columns_class).'">';
								$output .= '<div class="dfd-logo-carousel-item">';
									$output .= '<div class="thumb-wrap dfd-equalize-height '.$thumb_class.'">';
										if(isset($main_style) && $main_style == 'style-3'){
											$output .= '<div class="thumb-wrap-front dfd-equalize-height">';
												$output .= $img_html;
											$output .= '</div>';
											$output .= '<div class="thumb-wrap-back dfd-equalize-height">';
												$output .= '<div class="content-wrap">'; 
													$output .= $desc_html;
												$output .= '</div>'; 
											$output .= '</div>';
										} else {
											$output .= $img_html;
										}
									$output .= '</div>';

								$output .= $link_html;	
								$output .= '</div>';
							$output .= '</div>';
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
			}

			return $output;
		}
	}
}

if ( class_exists( 'Dfd_Logo_Carousel' ) ) {
	$Dfd_Logo_Carousel = new Dfd_Logo_Carousel;
}