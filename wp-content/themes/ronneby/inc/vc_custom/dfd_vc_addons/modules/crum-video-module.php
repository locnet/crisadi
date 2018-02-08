<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Clients Videoplayer
*/
if ( ! class_exists( 'Dfd_Videoplayer' ) ) {
	/**
	 * Class Dfd_Videoplayer
	 */
	class Dfd_Videoplayer {
		/**
		 * Main construct class.
		 */
		function __construct() {
			add_action( 'init', array( $this, 'dfd_videoplayer_init' ) );
			add_shortcode( 'videoplayer', array( $this, 'dfd_videoplayer_shortcode' ) );
		}

		/**
		 * Block options.
		 */
		function dfd_videoplayer_init() {
			if ( function_exists( 'vc_map' ) ) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/videoplayer/';
				
				vc_map(
					array(
						'name'        => esc_html__( 'Video Player', 'dfd' ),
						'base'        => 'videoplayer',
						'icon'        => 'videoplayer dfd_shortcode',
						'category'    => esc_html__( 'Ronneby 2.0', 'dfd' ),
						'description' => esc_html__( 'Display Button with video popup', 'dfd' ),
						'params'      => array_merge(
							array(
								array(
									'heading'    => esc_html__( 'Style', 'dfd' ),
									'type'       => 'radio_image_select',
									'param_name' => 'main_style',
									'simple_mode' => false,
									'options'    => array(
										'style-1'	=> array(
											'tooltip'	=> esc_attr__('Background','dfd'),
											'src'		=> $module_images . 'style-2.png'
										),
										'style-2'	=> array(
											'tooltip'	=> esc_attr__('Simple','dfd'),
											'src'		=> $module_images . 'style-1.png'
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
											'tooltip'	=> esc_attr__('Underlined','dfd'),
											'src'		=> $module_images . 'layout-1.png'
										),
										'layout-2'	=> array(
											'tooltip'	=> esc_attr__('Bordered','dfd'),
											'src'		=> $module_images . 'layout-2.png'
										),
										'layout-3'	=> array(
											'tooltip'	=> esc_attr__('Icon underline','dfd'),
											'src'		=> $module_images . 'layout-3.png'
										),
										'layout-4'	=> array(
											'tooltip'	=> esc_attr__('Icon border','dfd'),
											'src'		=> $module_images . 'layout-4.png'
										),
									),
									'dependency'  => array(
										'element' => 'main_style',
										'value'   => array( 'style-2' )
									),
								),
								array(
									'type'       => 'dropdown',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the horizontal alignment for the player button','dfd').'</span></span>'.esc_html__( 'Button', 'dfd' ) . ' ' . esc_html__( 'Alignment', 'dfd' ),
									'param_name' => 'button_align',
									'value'      => array(
										esc_html__( 'Center', 'dfd' ) => 'text-center',
										esc_html__( 'Left', 'dfd' )   => 'text-left',
										esc_html__( 'Right', 'dfd' )  => 'text-right'
									),
									'dependency' => array(
										'element' => 'main_style',
										'value'   => array( 'style-2' )
									),
								),
								array(
									'type'       => 'dropdown',
									'heading'	 => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the full screen video','dfd').'</span></span>'.esc_html__( 'Full screen video', 'dfd' ).' '.esc_html__( 'animation', 'dfd' ),
									'param_name' => 'videoanimation',
									'value'      => dfd_module_animation_styles(),
									'dependency' => array('element' => 'main_style', 'value'   => array( 'style-2' )),
								),
								array(
									'type'       => 'dropdown',
									'heading'	 => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd').'</span></span>'.esc_html__('Animation', 'dfd'),
									'param_name' => 'module_animation',
									'value'      => dfd_module_animation_styles(),
								),
								array(
									'type'        => 'textfield',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
									'param_name'  => 'el_class_name',
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
								array(
									'type'        => 'attach_image',
									'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the custom image for the video thumbnail from media library','dfd').'</span></span>'.esc_html__( 'Thumbnail Image', 'dfd' ),
									'param_name'  => 'video_thumb',
									'value'       => '',
									'dependency'  => array('element' => 'main_style', 'value'   => array( 'style-1' )),
									'group'       => esc_attr__( 'Content', 'dfd' ),
								),
								array(
									'type'       => 'textfield',
									'heading'		=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the link to the video','dfd').'</span></span>'.esc_html__( 'Video link', 'dfd' ),
									'param_name' => 'video_link',
									'group'      => esc_attr__( 'Content', 'dfd' ),

								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Module Style', 'dfd' ),
									'param_name'       => 'etc_h',
									'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
									'group'            => esc_html__( 'Style', 'dfd' ),

								),
								array(
									'type'             => 'dfd_single_checkbox',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to make play icon\'s background square or circle. To make the button circle, please, set the border radius in Style > Button style','dfd').'</span></span>'.esc_html__( 'Equal sides', 'dfd' ),
									'options'			=> array(
										'yes'				=> array(
											'yes'				=> esc_attr__('Yes', 'dfd'),
											'no'				=> esc_attr__('No', 'dfd'),
										),
									),
									'param_name'       => 'round_button',
									'edit_field_class' => 'vc_column vc_col-sm-6',
									'dependency'  => array('element' => 'main_layout', 'value'   => array( 'layout-4' )),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type' => 'number',
									'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Icon background size. Default 60px', 'dfd') . '</span></span>' . esc_html__('Icon background size', 'dfd'),
									'param_name' => 'bg_size',
									'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
									'dependency' => array('element' => 'round_button', 'value' => array('yes')),
									'group' => esc_html__('Style', 'dfd'),
								),
								array(
									'type'             => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon color. The default color for the style Background is #fff, color for the style simple is #1b1b1b','dfd').'</span></span>'.esc_html__('Icon color', 'dfd'),
									'param_name'       => 'icon_color',
									'edit_field_class' => 'vc_column crum_vc vc_col-sm-6',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon background color. The default color is rgba(27,27,27,0.7)','dfd').'</span></span>'.esc_html__( 'Icon Background Color', 'dfd' ),
									'param_name'       => 'icon_bg_color',
									'edit_field_class' => 'vc_column crum_vc vc_col-sm-6',
									'dependency'	   => array('element' => 'main_style', 'value' => array('style-1')),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Button style', 'dfd' ),
									'param_name'       => 'bg_t_h',
									'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',									
									'group'            => esc_html__( 'Style', 'dfd' ),
									'dependency' => array( 'element' => 'main_style','value'=> array( 'style-2' ))
								),
								array(
									'type'             => 'colorpicker',
									'heading'          => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the video button\'s start color, the background will cover both play button and content. The value is not set by default','dfd').'</span></span>'.esc_html__( 'Start Color', 'dfd' ),
									'param_name'       => 'fill_color_start',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
									'dependency' => array( 'element' => 'main_style','value'=> array( 'style-2' ))
								),
								array(
									'type'             => 'colorpicker',
									'heading'          => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the video button\'s end color, the background will cover both play button and content. The value is not set by default','dfd').'</span></span>'.esc_html__( 'End Color', 'dfd' ),
									'param_name'       => 'fill_color_end',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
									'dependency' => array( 'element' => 'main_style','value'=> array( 'style-2' ))
								),
								array(
									'type'             => 'number',
									'heading'          => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the video button\'s border radius. The default value is 2px','dfd').'</span></span>'.esc_html__( 'Border radius', 'dfd' ),
									'param_name'       => 'bg_radius',
									'min'              => 0,
									'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
									'dependency' => array( 'element' => 'main_style','value'=> array( 'style-2' ))
								),	
								array(
									'type'             => 'colorpicker',
									'heading'          => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the video button\'s border color. The default value is rgba(0,0,0,0.1)','dfd').'</span></span>'.esc_html__( 'Border color', 'dfd' ),
									'param_name'       => 'button_b_color',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
									'dependency' => array( 'element' => 'main_style','value'=> array( 'style-2' ))
								),	
								array(
									'type'             => 'number',
									'heading'          => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the video button\'s border width. The default value is 1px','dfd').'</span></span>'.esc_html__( 'Border width', 'dfd' ),
									'param_name'       => 'button_b_width',
									'min'              => 0,
									'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
									'dependency' => array( 'element' => 'main_style','value'=> array( 'style-2' ))
								),
								array(
									'type'             => 'dfd_single_checkbox',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to show or hide the shadow for the video button','dfd').'</span></span>'.esc_html__( 'Shadow', 'dfd' ),
									'value'            => '',
									'options'			=> array(
										'yes'				=> array(
											'yes'				=> esc_attr__('Yes', 'dfd'),
											'no'				=> esc_attr__('No', 'dfd'),
										),
									),
									'param_name'       => 'shadow',
									'edit_field_class' => 'vc_column vc_col-sm-6',
									'group'            => esc_html__( 'Style', 'dfd' ),
									'dependency' => array( 'element' => 'main_style','value'=> array( 'style-2' ))
								),	
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Delimiter style', 'dfd' ),
									'param_name'       => 'del_t_heading',
									'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
									'group'            => esc_html__( 'Style', 'dfd' ),
									'dependency' => array( 'element' => 'main_style','value'=> array( 'style-2' ))
								),	
								array(
									'type'             => 'dropdown',
									'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the delimiter style, the delimiter is shown between play button and video content','dfd').'</span></span>'.esc_html__( 'Style', 'dfd' ),
									'param_name'       => 'line_style',
									'value'            => array(
										esc_html__( 'Default', 'dfd' ) => '',
										esc_html__( 'Dotted', 'dfd' )  => 'dotted',
										esc_html__( 'Solid', 'dfd' )   => 'solid',
										esc_html__( 'Dashed', 'dfd' )  => 'dashed',
									),
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
									'dependency' => array( 'element' => 'main_style','value'=> array( 'style-2' ))
								),		
								array(
									'type'             => 'colorpicker',
									'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the delimiter color. The default value is rgba(0,0,0,0.1)','dfd').'</span></span>'.esc_html__( 'Color', 'dfd' ),
									'param_name'       => 'line_color',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
									'dependency' => array( 'element' => 'main_style','value'=> array( 'style-2' ))
								),		
								array(
									'type'             => 'dfd_single_checkbox',
									'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you hide the delimiter between the play button and video content','dfd').'</span></span>'.esc_html__( 'Disable delimiter', 'dfd' ),
									'options'			=> array(
										'yes'				=> array(
											'yes'				=> esc_attr__('Yes', 'dfd'),
											'no'				=> esc_attr__('No', 'dfd'),
										),
									),
									'param_name'       => 'line_hide',
									'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
									'dependency' => array( 'element' => 'main_style','value'=> array( 'style-2' ))
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'lightbox Background settings', 'dfd' ),
									'param_name'       => 'bg_t_h',
									'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',									
									'group'            => esc_html__( 'Style', 'dfd' ),
									'dependency' => array( 'element' => 'main_style','value'=> array( 'style-2' ))
								),
								array(
									'type'             => 'colorpicker',
									'heading'          => esc_html__( 'Start Color', 'dfd' ),
									'param_name'       => 'lightbox_fill_color_start',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
									'dependency' => array( 'element' => 'main_style','value'=> array( 'style-2' ))
								),
								array(
									'type'             => 'colorpicker',
									'heading'          => esc_html__( 'End Color', 'dfd' ),
									'param_name'       => 'lightbox_fill_color_end',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
									'dependency' => array( 'element' => 'main_style','value'=> array( 'style-2' ))
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Title Typography', 'dfd' ),
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
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Subtitle Typography', 'dfd' ),
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
							)
						)
					)
				);
			}
		}

		/**
		 * Shortcode handler function.
		 *
		 * @param $atts
		 *
		 * @return string
		 */
		function dfd_videoplayer_shortcode( $atts ) {
			$main_style = $main_layout = $button_align = $title = $subtitle = $video_thumb = $video_animation = $videoanimation = $video_link = $title_font_options = $shadow =
			$subtitle_font_options = $icon_color = $fill_color_start = $fill_color_end = $bg_radius = $button_b_color = $button_b_width = $line_hide = $line_style = $icon_bg_color = '';
			$title_html = $thumb_html = $title_style = $icon_style = $subtitle_html = $subtitle_style = $button_style = $button_html = $delimiter_html = $delimiter_style = $content_html = '';
			$output = $el_class = $module_animation = $thumb_radius = $line_color = $round_button = $general_style =$lightbox_fill_color_start= $lightbox_fill_color_end= $link_css = $unique_id_shortcode = $el_class_name = '';
			$bg_size = '';

			$atts = vc_map_get_attributes( 'videoplayer', $atts );
			extract( $atts );

			$size = ( isset( $content_width ) ) ? $content_width : '500';
			wp_enqueue_script( 'video-module-js', get_template_directory_uri() . '/assets/js/crum-video-module.js', array( 'jquery' ), false, true );

			// Create parts of module according to parameters.

			/**************************
			 * Appear Animation
			 *************************/

			$animation_data = $an_class  = $an_appear_class = '';

			if ( ! ( $module_animation == '' ) ) {
				$an_class       .= ' cr-animate-gen ';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			if ( ! ( $video_animation == '' ) ) {
				$an_appear_class       .= ' cr-animate-gen ';
			}
			
			if('yes' === $round_button){
				$el_class .= ' rounded-play-button ';
			}
			
			$unique_id_shortcode = uniqid('video-player-') .'-'.rand(1,9999);
			
			/**************************
			 * Title / Subtitle HTML.
			 *************************/
			if ( ! empty( $title ) ) {
				$title_options = _crum_parse_text_shortcode_params( $title_font_options, 'feature-title');
				$title_html = '<'.$title_options['tag'].' class="' .$title_options['class'].'" ' . $title_options['style'] . '>' . esc_html( $title ) . '</'.$title_options['tag'].'>';
			}

			if ( ! empty( $subtitle ) ) {
				$subtitle_options = _crum_parse_text_shortcode_params($subtitle_font_options,'subtitle');
				$subtitle_html = '<'.$subtitle_options['tag'].' class="' . $subtitle_options['class'] . '" ' . $subtitle_options['style'] . '>' . esc_html( $subtitle ) . '</'.$subtitle_options['tag'].'>';
			}

			/**************************
			 * Delimiter HTML.
			 *************************/

			if ( $line_style || (!empty($line_color)) ) {
				if(!empty($line_color)){
					$line_color='border-color:'.$line_color.';';
				}
				if ( ( 'layout-1' === $main_layout ) || ( 'layout-2' === $main_layout ) ) {
					$delimiter_style .= 'style="border-right-style:' . $line_style . ';' . $line_color . '"';
				} else {
					$delimiter_style .= 'style="border-bottom-style:' . $line_style . ';' . $line_color . '"';
				}
			}
			if ( 'yes' !== $line_hide ) {
				$delimiter_html .= '<div class="delimiter" ' . $delimiter_style . '></div>';
			}

			/**************************
			 * Icon style.
			 *************************/

			if ( $icon_color ) {
				$icon_style .= 'style="border-left-color:' . $icon_color . '"';
			}
			
			/**************************
			 * Icon Background Style.
			 *************************/
			if(isset($icon_bg_color) && $icon_bg_color != '') {
				$link_css .= '#'.esc_js($unique_id_shortcode).'.style-1 .dfd-video-content .dfd-video-box .dfd-video-image-thumb .container-play {background: '.$icon_bg_color.';}';
			}
		
			/**************************
			 * Button Style + HTML.
			 *************************/
			$unique_id = uniqid('module_video_');

			if($fill_color_start || $fill_color_end || $bg_radius || $button_b_color ){
				if ( $button_b_width ) {
					$button_style .= 'border-style:solid; border-width:' . esc_attr($button_b_width) . 'px; ';
				}
				if ( '0' === $button_b_width ) {
					$button_style .= 'border:none; ';
				}
				if ( ( empty( $button_b_width ) && $fill_color_end ) || ( $fill_color_start && empty( $button_b_width ) ) ) {
					$button_style .= 'border: none; ';
				}
				if ( $button_b_color ) {
					$button_style .= 'border-color:' . esc_attr($button_b_color).'; ';
				}
				if ( $bg_radius ) {
					$button_style .= 'border-radius:' . esc_attr($bg_radius).'px; ';
					$general_style .= 'border-radius:' . esc_attr($bg_radius).'px; ';
				}
				if ( $fill_color_end && $fill_color_start ) {
					$button_style .= 'background: linear-gradient(to right, ' . esc_attr($fill_color_start) . ' 0%,' . esc_attr($fill_color_end) . ' 100%); ';
				} elseif ( $fill_color_start ) {
					$button_style .= 'background:' . esc_attr($fill_color_start) . '; ';
				} elseif ( $fill_color_end ) {
					$button_style .= 'background:' . esc_attr($fill_color_end) . ';';
				}

				$link_css .= '#'.$unique_id_shortcode.' .dfd-video-button {'.$general_style.'}';
				$link_css .= ' #'.$unique_id_shortcode.'.style-2 .dfd-video-button .mask-for-hover {'.$button_style.'}';
			}
			if($lightbox_fill_color_start || $lightbox_fill_color_end){
				$lightbox_style = '';
				$lightbox_style = 'opacity: 1 !important;';
				if ( $lightbox_fill_color_start && $lightbox_fill_color_end ) {
					$lightbox_style .= 'background: linear-gradient(to right, ' . esc_attr($lightbox_fill_color_start) . ' 0%,' . esc_attr($lightbox_fill_color_end) . ' 100%) !important;';
				} elseif ( $lightbox_fill_color_start ) {
					$lightbox_style.= 'background:' . esc_attr($lightbox_fill_color_start) . ' !important;';
				} elseif ( $lightbox_fill_color_end ) {
					$lightbox_style .= 'background:' . esc_attr($lightbox_fill_color_end) . ' !important;';
				}
				$link_css .= ' #'.$unique_id.'.dfd-fullscreen-video-container.video_module:before {'.$lightbox_style.'}';
			}
			if(isset($bg_size) && $bg_size != '') {
				$link_css .= '#'.$unique_id_shortcode.' .dfd-video-button {width: '.esc_js($bg_size).'px; height: '.esc_js($bg_size).'px;}';
			}
			if ( $shadow ) {
				$shadow = 'shadow';
			}

			if (('layout-1' === $main_layout) || ('layout-2' === $main_layout)) {
				$button_html .= '<span class="dfd-video-button ' . $shadow . ' ' . $el_class . '" >';
				$button_html .= '<span class="mask-for-hover">';
					if('layout-1' === $main_layout){
						$button_html .= '<u></u><b></b>';
					}
				$button_html .= $delimiter_html;
				$button_html .= '</span>';
				$button_html .= '<span class="play" ' . $icon_style . '></span>';
				if($title || $subtitle) {
					$button_html .= '<div class="title-wrap">';
					$button_html .= $title_html;
					$button_html .= $subtitle_html;
					$button_html .= '</div>';
				}
				$button_html .= '<a href="#'.$unique_id.'" class="dfd-video-link '.$an_appear_class.'" data-animation="'.$videoanimation.'"></a>';
				$button_html .= '</span>';
			} else {
				$button_html .= '<div class="button-wrap">';
				$button_html .= '<div class="dfd-video-button ' . $shadow . ' ' . $el_class . '" >';
				$button_html .= '<span class="mask-for-hover">';
					if('layout-3' === $main_layout){
						$button_html .= '<u></u><b></b>';
					}
				$button_html .= '</span>';
				$button_html .= '<span class="play" ' . $icon_style . '></span>';
				$button_html .= '</div>';
				if($title || $subtitle) {
					$button_html .= '<div class="title-wrap">';
					$button_html .= $title_html;
					$button_html .= $delimiter_html;
					$button_html .= $subtitle_html;
					$button_html .= '</div>';
				}
				$button_html .= '<a href="#'.$unique_id.'" class="dfd-video-link '.$an_appear_class.'" data-animation="'.$videoanimation.'"></a>';
				$button_html .= '</div>';
			}

			/**************************
			 * Block style 1 HTML.
			 *************************/

			$video_w = $size;
			$video_h = $size / 1.61; //1.61 golden ratio


			if ( ! empty( $thumb_radius ) ){
				$thumb_radius = 'style="border-radius:' . $thumb_radius . 'px;"';
			}

			/** @var WP_Embed $wp_embed  */
			global $wp_embed;
			$embed = $wp_embed->run_shortcode( '[embed width="' . $video_w . '"' . $video_h . ']' . $video_link . '[/embed]' );

			if ( 'style-1' === $main_style ) {
				$content_html .= '<div class="dfd-video-content video-content" id="' . esc_html( $unique_id ) . '">';
				if(isset($video_thumb) && !empty($video_thumb)) {
					$thumb_image_url = wp_get_attachment_image_src($video_thumb, 'full');
					$image_src = dfd_aq_resize($thumb_image_url[0], $video_w, $video_h, true, true, true);
					if(!$image_src) {
						$image_src = $thumb_image_url[0];
					}
					$attr = Dfd_Theme_Helpers::get_image_attrs($thumb_image_url[0], $image_src, $video_w, $video_h);
				
					global $dfd_ronneby;
					$cover_class = '';
					if(isset($dfd_ronneby['enable_images_lazy_load']) && $dfd_ronneby['enable_images_lazy_load'] == 'on') {
						$cover_class = 'dfd-img-lazy-load';
						$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $video_w $video_h'%2F%3E";
						$img_html = '<img src="'.$loading_img_src.'" data-src="'.esc_url($image_src).'" '.$attr.' />';
					} else {
						$img_html = '<img src="'.esc_url($image_src).'" '.$attr.' />';
					}
					$thumb_html = '<a href="#'. esc_html( $unique_id ).'" class="dfd-video-image-thumb '.$cover_class.'" title="'.esc_html__('Play video','dfd').'"><span class="container-play"><span class="play" '.$icon_style.'></span><span class="play-shadow"></span></span>'.$img_html.'</a>';
					$opacity_class = '';
				} else {
					$opacity_class = 'no-thumb';
				}

				$content_html .= '<div class="dfd-video-box '.$opacity_class.'"  '.$thumb_radius.'>';
				$content_html .= $thumb_html;
				$content_html .= '<div class="wpb_video_wrapper">' . $embed . '</div>';
				$content_html .= '</div>';
				$content_html .= '</div>';
			}

			if ( 'style-2' === $main_style ) {
				$content_html .=  '<div  style="display:none;" class="'.$an_appear_class.'" id="' . esc_html( $unique_id ) . '" data-animation="' . $videoanimation. '">' . $embed . '</div>';
			}

			// Module output according to layout selection.
			$output .= '<div class="animation-container '.$an_class.'" '.$animation_data.'>';
				$output .= '<div id="'.$unique_id_shortcode.'" class="dfd-videoplayer ' . $main_style . ' ' . $main_layout . ' ' . $button_align . ' '.$el_class_name.'">';
					if ( 'style-2' === $main_style ) {
						$output .= $button_html;
						$output .= $content_html;
					} else {
						$output .= $content_html;
					}
				$output .= '</div>';
			$output .= '</div>';
			
			$output .= '<script type="text/javascript">
							(function($) {
								$("head").append("<style>'. esc_js($link_css) .'</style>");
								$(document).ready(function(){
									DFD_VideoModule.init("'.$unique_id.'","'.$unique_id_shortcode.'");
								});
							})(jQuery);
						</script>';

			return $output;
		}
	}
}
if ( class_exists( 'Dfd_Videoplayer' ) ) {
	$Dfd_Videoplayer = new Dfd_Videoplayer;
}