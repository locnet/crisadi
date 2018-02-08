<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Image module
*/
if(!class_exists('Dfd_Single_Image_Module')) {
	class Dfd_Single_Image_Module {
		function __construct() {
			add_action('init',array($this,'dfd_simgle_image_init'));
			add_shortcode('dfd_single_image',array($this,'dfd_single_image_shortcode'));
		}
		function dfd_simgle_image_init(){
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   'name' => esc_html__('DFD Single image shortcode','dfd'),
					   'base' => 'dfd_single_image',
					   'icon' => 'dfd_single_image dfd_shortcode',
					   'category' => esc_html__('Ronneby 2.0','dfd'),
					   'description' => esc_html__('Single image shortcode','dfd'),
					   'params' => array(
							array(
								'type' => 'dfd_radio_advanced',
                                'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the image type. You can choose the image from the media library, add the external link or use the featured image of the page','dfd').'</span></span>'.esc_html__('Image type','dfd'),
								'param_name' => 'image_type',
								'value' => 'media_library',
                                'options' => array(
                                    esc_attr__('Media gallery','dfd') => 'media_library',
                                    esc_attr__('External link','dfd') => 'external_link',
                                    esc_attr__('Page thumb','dfd') => 'featured_image',
                                ),
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__('External image URL', 'js_composer'),
								'param_name' => 'external_link_url',
								'dependency' => array('element' => 'image_type','value' => array('external_link')),
							),
							array(
								'type' => 'attach_image',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the custom image from media library','dfd').'</span></span>'.esc_html__('Upload Image', 'dfd'),
								'param_name' => 'image',
								'value' => '',
								'dependency' => array('element' => 'image_type','value' => array('media_library')),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the size of the image','dfd').'</span></span>'.esc_html__('Image size','dfd'),
								'param_name' => 'image_size',
								'value' => 'full',
								'options' => array(
									esc_attr__('Full size','dfd') => 'full',
									esc_attr__('Medium','dfd') => 'medium',
									esc_attr__('Thumbnail','dfd') => 'thumb',
									esc_attr__('Custom size','dfd') => 'custom'
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-8',
								'dependency' => array('element' => 'image_type','value' => array('media_library')),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the border radius for the image. The value is not by default','dfd').'</span></span>'.esc_html__('Image border radius', 'dfd'),
								'param_name' => 'image_border_radius',
								'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc dfd-number-wrap',
								'dependency' => array('element' => 'image_type','value' => array('media_library')),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the width for the image','dfd').'</span></span>'.esc_html__('Image width', 'dfd'),
								'param_name' => 'image_width',
								'value' => 600,
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
								'dependency' => array('element' => 'image_size','value' => array('custom')),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the height for the image','dfd').'</span></span>'.esc_html__('Image height', 'dfd'),
								'param_name' => 'image_height',
								'value' => 550,
								'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
								'dependency' => array('element' => 'image_size','value' => array('custom')),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the image for the retina. If the option is enabled you can add the x2 or x4 image','dfd').'</span></span>'.esc_html__('Image for retina displays','dfd'),
								'param_name' => 'enable_retina',
								'options'			=> array(
									'yes'				=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-4',
								'dependency' => array('element' => 'image_type','value' => array('media_library')),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the size of the image on retina','dfd').'</span></span>'.esc_html__('Image size','dfd'),
								'param_name' => 'retina_image_size',
								'value' => '',
								'options' => array(
									esc_attr__('None','dfd') => '',
									esc_attr__('x2','dfd') => 'x2',
									esc_attr__('x4','dfd') => 'x4',
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-4',
								'dependency' => array('element' => 'enable_retina','value' => array('yes')),
							),
							array(
								'type' => 'attach_image',
								'heading' => esc_html__('Image for Retina x2','dfd'),
								'param_name' => 'retina_image_x2',
								'value' => '',
								'edit_field_class'	=> 'vc_column vc_col-sm-4',
								'dependency' => array('element' => 'retina_image_size','value' => array('x2')),
							),
							array(
								'type' => 'attach_image',
								'heading' => esc_html__('Image for Retina x4','dfd'),
								'param_name' => 'retina_image_x4',
								'value' => '',
								'edit_field_class'	=> 'vc_column vc_col-sm-4',
								'dependency' => array('element' => 'retina_image_size','value' => array('x4')),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the image horizontally','dfd').'</span></span>'.esc_html__('Image alignment','dfd'),
								'param_name' => 'image_alignment',
								'value' => 'image-center',
								'options' => array(
									esc_attr__('Center','dfd') => 'image-center',
									esc_attr__('Left','dfd') => 'image-left',
									esc_attr__('Right','dfd') => 'image-right'
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
							),
							array(
								'type' => 'dropdown',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the hover effect for the image', 'dfd') . '</span></span>' .esc_html__('Image hover effect','dfd'),
								'param_name' => 'hover_style',
								'value' => array(
									esc_attr__('None','dfd') => '',
									esc_attr__('Shadow','dfd') => 'dfd-image-shadow',
									esc_attr__('Fade in','dfd') => 'dfd-image-fade-in',
									esc_attr__('Fade out','dfd') => 'dfd-image-fade-out',
									esc_attr__('Blur','dfd') => 'dfd-image-blur',
									esc_attr__('Grow','dfd') => 'dfd-image-scale',
									esc_attr__('Grow with rotation','dfd') => 'dfd-image-scale-rotate',
									esc_attr__('Image parallax','dfd') => 'panr',
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the link for the image. If the option is enabled you can choose the lightbox, external link or use as one page scroll navigation','dfd').'</span></span>'.esc_html__('Link for image','dfd'),
								'param_name' => 'enable_link',
								'options'			=> array(
									'yes'				=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-3',
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select the behavior for the link','dfd').'</span></span>'.esc_html__('Apply link to','dfd'),
								'param_name' => 'link_object',
								'value' => 'lightbox',
                                'options' => array(
									esc_attr__('Lightbox','dfd') => 'lightbox',
									esc_attr__('External link','dfd') => 'link',
									esc_attr__('One page scroll nav','dfd') => 'onepage',
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-12',
								'dependency' => array('element' => 'enable_link','value' => array('yes')),
							),
							array(
								'type' => 'textfield',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the link for the image','dfd').'</span></span>'.esc_html__('External link url', 'dfd'),
								'param_name' => 'image_ext_link_url',
								'edit_field_class'	=> 'vc_column vc_col-sm-12',
								'dependency' => array('element' => 'link_object','value' => array('link')),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select the navigation direction, you can apply the link to next or previous slides. This option is available only for one page scroll templates','dfd').'</span></span>'.esc_html__('Navigate to','dfd'),
								'param_name' => 'onepage_navigate',
								'value' => 'slickPrev',
								'options' => array(
									esc_attr__('Previous slide','dfd') => 'slickPrev',
									esc_attr__('Next slide','dfd') => 'slickNext',
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-5',
								'dependency' => array('element' => 'link_object','value' => array('onepage')),
							),
							array(
								'type'        => 'dropdown',
								'heading'	  => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd').'</span></span>'.esc_html__('Animation', 'dfd'),
								'param_name'  => 'module_animation',
								'value'       => dfd_module_animation_styles(),
							),
							array(
								'type' => 'textfield',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
								'param_name' => 'el_class',
							),
							array(
								'type' => 'dfd_radio_advanced',
                                'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the image alignment on smaller devices. The alignment will inherit the Image alignment from General tab if you set Inherit','dfd').'</span></span>'.esc_html__('Alignment','dfd'),
								'param_name' => 'mobile_alignment',
								'value' => '',
                                'options' => array(
                                    esc_attr__('Inherit','dfd') => '',
                                    esc_attr__('Left','dfd') => 'left',
                                    esc_attr__('Center','dfd') => 'center',
                                    esc_attr__('Right','dfd') => 'right',
                                ),
                                'edit_field_class'	=> 'vc_column vc_col-sm-8',
								'group'				=> esc_html__('Responsive', 'dfd'),
							),
							array(
								'type' => 'number',
                                'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the screen resolution till which the alignment should work. The default value is 799px','dfd').'</span></span>'.esc_html__('Screen resolution','dfd'),
								'param_name' => 'alignment_resolution',
								'value' => '',
                                'edit_field_class'	=> 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc no-top-padding',
								'group'				=> esc_html__('Responsive', 'dfd'),
							),
						),
					)
				);
			}
		}
		
		function dfd_single_image_shortcode($atts) {
			$output = $image_url = $elem_class = $image_dimention = $width = $height = $animation_data = $thumb_data_attr = $large_image_url = $retina_atts = '';
			$image_type = $external_link_url = $image = $enable_retina = $retina_image_size = $retina_image_x2 = $retina_image_x4 = $image_size = $image_width = '';
			$image_height = $image_alignment = $enable_link = $link_object = $image_ext_link_url = $onepage_navigate = $hover_style = $module_animation = $el_class = '';
			$link_css = $image_border_radius = $mobile_alignment = $alignment_resolution = '';
			
			$atts = vc_map_get_attributes('dfd_single_image', $atts);
			extract($atts);
			
			if(!isset($image_alignment) || empty($image_alignment)) {
				$image_alignment = 'image-center';
			}

			if($hover_style == 'panr') {
				wp_enqueue_script('dfd-tween-max');
				wp_enqueue_script('dfd-panr');
			}
			
			$el_class .= ' '.$image_alignment.' '.$hover_style;

			if ( ! ( $module_animation == '' ) ) {
				$el_class .= ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}

			if(isset($image_type) && $image_type == 'media_library' && isset($image) && !empty($image)) {
				if(!isset($image_size) || empty($image_size)) {
					$image_size = 'full';
				}
				
				$image_dimention = $image_size;
				
				if($image_size == 'custom') {
					$image_dimention = 'full';
				}
				
				$image_src = wp_get_attachment_image_src($image, $image_dimention);
				
				if(isset($enable_retina) && !empty($enable_retina) && isset($retina_image_size) && !empty($retina_image_size)) {
					$retina_img_id = 'retina_image_'.$retina_image_size;
					if($$retina_img_id && !empty($$retina_img_id)) {
						$retina_img_src = wp_get_attachment_image_src($$retina_img_id, 'full');
						if(isset($retina_img_src[0]) && $retina_img_src[0])
							$retina_atts .= 'data-retina-img="'.esc_url($retina_img_src[0]).'"';
					}
				}
				
				if(isset($image_src[0]) && !empty($image_src[0])) {
					$large_image_url = $image_src[0];
					
					$thumb_url = wp_get_attachment_image_src($image, 'thumbnail');

					if(!empty($thumb_url[0])) {
						$thumb_data_attr = 'data-thumb="'.esc_url($thumb_url[0]).'"';
					}

					if($image_size == 'custom') {
						if(!isset($image_width) || empty($image_width)) {
							$image_width = 600;
						}
						if(!isset($image_height) || empty($image_height)) {
							$image_height = 550;
						}
						
						$image_url = dfd_aq_resize($image_src[0], $image_width, $image_height, true, true, true);
						
						$width = 'width="'.esc_attr($image_width).'"';
						$height = 'height="'.esc_attr($image_height).'"';
					} else {
						$image_url = $image_src[0];
 
						$width = 'width="'.esc_attr($image_src[1]).'"';
						$height = 'height="'.esc_attr($image_src[2]).'"';
					}
				}
			} elseif(isset($image_type) && $image_type == 'external_link' && isset($external_link_url) && !empty($external_link_url)) {
				$image_url = $large_image_url = $external_link_url;
				$thumb_data_attr = 'data-thumb="'.esc_url($image_url).'"';
			} elseif(isset($image_type) && $image_type == 'featured_image' && has_post_thumbnail()) {
				$thumb = get_post_thumbnail_id();
				$image_url = $large_image_url = wp_get_attachment_url($thumb);
				$thumb_data_attr = 'data-thumb="'.esc_url($image_url).'"';
			}
			
			$image_html = '<img src="'.esc_url($image_url).'" '.$width.' '.$height.' '.$retina_atts.' alt="'.esc_attr__('Image module','dfd').'" />';
			
			if(isset($enable_link) && !empty($enable_link)) {
				switch($link_object) {
					case 'lightbox':
						$image_html = '<a href="'.esc_url($large_image_url).'" title="'.esc_attr__('Open in lightbox', 'dfd').'" class="prettyPhoto" '.$thumb_data_attr.' data-rel="prettyPhoto[]">'.$image_html.'</a>';
						break;
					case 'link':
						if(isset($image_ext_link_url) && !empty($image_ext_link_url))
							$image_html = '<a href="'.esc_url($image_ext_link_url).'" title="">'.$image_html.'</a>';
						break;
					case 'onepage':
						if(isset($onepage_navigate) && !empty($onepage_navigate))
							$image_html = '<a href="#" class="dfd-one-page-nav" data-dir="'.esc_attr($onepage_navigate).'" title="'.esc_attr($onepage_navigate).'">'.$image_html.'</a>';
						break;
				}
			}
			
			$uniqid = uniqid('dfd-single-image-module').'-'.rand(1,9999);
			
			if(isset($image_border_radius) && $image_border_radius != '') {
				$link_css .= '#'.esc_js($uniqid).' {border-radius: '.esc_js($image_border_radius).'px;}';
			}
			if(isset($mobile_alignment) && $mobile_alignment != '') {
				$respons_css = '';
				$alignment_resolution = (isset($alignment_resolution) && $alignment_resolution != '') ? $alignment_resolution : '799';
				switch ($mobile_alignment) {
					case 'left':
						$respons_css .= 'float: left;';
						break;

					case 'center':
						$respons_css .= 'float: none;';
						$respons_css .= 'margin: 0 auto;';
						break;
					
					case 'right':
						$respons_css .= 'float: right;';
						break;
					
					default:
						break;
				}
				$link_css .= '@media only screen and (max-width: '.esc_js($alignment_resolution).'px) {#'.esc_js($uniqid).' img {'.esc_js($respons_css).'}}';
			}

			$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-single-image-module '.esc_attr($el_class).'" '.$animation_data.'>';
				$output .= $image_html;
				
				if(!empty($link_css)) {
					$output .= '<script type="text/javascript">'
								. '(function($) {'
									. '$("head").append("<style>'.$link_css.'</style>");'
								. '})(jQuery);'
							. '</script>';
				}
			$output .= '</div>';
			
			return $output;
		}
	}
}

if(class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_dfd_single_image extends WPBakeryShortCode {
		function __construct($settings) {
			parent::__construct( $settings );
		}
		
		public function singleParamHtmlHolder( $param, $value ) {
			$output = '';
			// Compatibility fixes
			$old_names = array(
				'yellow_message',
				'blue_message',
				'green_message',
				'button_green',
				'button_grey',
				'button_yellow',
				'button_blue',
				'button_red',
				'button_orange',
			);
			$new_names = array(
				'alert-block',
				'alert-info',
				'alert-success',
				'btn-success',
				'btn',
				'btn-info',
				'btn-primary',
				'btn-danger',
				'btn-warning',
			);
			$value = str_ireplace( $old_names, $new_names, $value );

			$param_name = isset( $param['param_name'] ) ? $param['param_name'] : '';
			$type = isset( $param['type'] ) ? $param['type'] : '';
			$class = isset( $param['class'] ) ? $param['class'] : '';

			if ( 'attach_image' === $param['type'] && 'image' === $param_name ) {
				$output .= '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';
				$element_icon = $this->settings( 'icon' );
				$img = wpb_getImageBySize( array(
					'attach_id' => (int) preg_replace( '/[^\d]/', '', $value ),
					'thumb_size' => 'thumbnail',
				));
				$this->setSettings( 'logo', ( $img ? $img['thumbnail'] : '<img width="150" height="150" src="' . vc_asset_url( 'vc/blank.gif' ) . '" class="attachment-thumbnail vc_general vc_element-icon"  data-name="' . $param_name . '" alt="" title="" style="display: none;" />' ) . '<span class="no_image_image vc_element-icon' . ( ! empty( $element_icon ) ? ' ' . $element_icon : '' ) . ( $img && ! empty( $img['p_img_large'][0] ) ? ' image-exists' : '' ) . '" /><a href="#" class="column_edit_trigger' . ( $img && ! empty( $img['p_img_large'][0] ) ? ' image-exists' : '' ) . '">' . __( 'Add image', 'js_composer' ) . '</a>' );
				$output .= $this->outputTitleTrue( $this->settings['name'] );
			} elseif ( ! empty( $param['holder'] ) ) {
				if ( 'input' === $param['holder'] ) {
					$output .= '<' . $param['holder'] . ' readonly="true" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '">';
				} elseif ( in_array( $param['holder'], array( 'img', 'iframe' ) ) ) {
					$output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" src="' . $value . '">';
				} elseif ( 'hidden' !== $param['holder'] ) {
					$output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">' . $value . '</' . $param['holder'] . '>';
				}
			}

			if ( ! empty( $param['admin_label'] ) && true === $param['admin_label'] ) {
				$output .= '<span class="vc_admin_label admin_label_' . $param['param_name'] . ( empty( $value ) ? ' hidden-label' : '' ) . '"><label>' . $param['heading'] . '</label>: ' . $value . '</span>';
			}

			return $output;
		}
		public function getImageSquareSize( $img_id, $img_size ) {
			if ( preg_match_all( '/(\d+)x(\d+)/', $img_size, $sizes ) ) {
				$exact_size = array(
					'width' => isset( $sizes[1][0] ) ? $sizes[1][0] : '0',
					'height' => isset( $sizes[2][0] ) ? $sizes[2][0] : '0',
				);
			} else {
				$image_downsize = image_downsize( $img_id, $img_size );
				$exact_size = array(
					'width' => $image_downsize[1],
					'height' => $image_downsize[2],
				);
			}
			$exact_size_int_w = (int) $exact_size['width'];
			$exact_size_int_h = (int) $exact_size['height'];
			if ( isset( $exact_size['width'] ) && $exact_size_int_w !== $exact_size_int_h ) {
				$img_size = $exact_size_int_w > $exact_size_int_h
					? $exact_size['height'] . 'x' . $exact_size['height']
					: $exact_size['width'] . 'x' . $exact_size['width'];
			}

			return $img_size;
		}
		
		protected function outputTitle( $title ) {
			return '';
		}

		protected function outputTitleTrue( $title ) {
			return '<h4 class="wpb_element_title">' . $title . ' ' . $this->settings( 'logo' ) . '</h4>';
		}
	}
}

if(class_exists('Dfd_Single_Image_Module')) {
	$Dfd_Single_Image_Module = new Dfd_Single_Image_Module;
}