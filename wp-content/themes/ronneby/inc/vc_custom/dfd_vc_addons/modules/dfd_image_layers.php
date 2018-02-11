<?php
if ( !defined( 'ABSPATH' )) { exit; }
/*
* Add-on Name: DFD Price List
*/
if( !class_exists('Dfd_Image_Layers')) {
	
	class Dfd_Image_Layers {
		
		function __construct() {
			add_action('init', array(&$this, 'image_layers_init'));
			add_shortcode('image_layers', array(&$this, 'image_layers_form'));
		}
		
		function image_layers_init () {
			if ( function_exists('vc_map') ) {
				vc_map (
					array (
						'name'					=> esc_html__('Image Layers', 'dfd'),
						'base'					=> 'image_layers',
						'icon'					=> 'image_layers dfd_shortcode',
						'category'				=> esc_html__('Ronneby 2.0', 'dfd'),
						'params'				=> array(
							array(
								'type'				=> 'dfd_radio_advanced',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the module horizontally','dfd').'</span></span>'.esc_html__('Alignment', 'dfd'),
								'param_name'		=> 'alignment',
								'value'				=> 'layers-center',
								'options'			=> array(
									esc_html__('Left', 'dfd')	=> 'layers-left',
									esc_html__('Center', 'dfd')	=> 'layers-center',
									esc_html__('Right', 'dfd')	=> 'layers-right',
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
							),
							array(
								'type'				=> 'number',
								'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the periodicity for image appearing in seconds','dfd').'</span></span>'.esc_html__('Interval', 'dfd'),
								'param_name'		=> 'periodicity',
								'value'				=> 0.3,
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding crum_vc dfd-number-second',
							),
							array(
								'type'				=> 'textfield',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
								'param_name'		=> 'el_class',
							),
//							array(
//								'type'				=> 'dfd_video_link_param',
//								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Video tutorial and theme documentation article','dfd').'</span></span>'.esc_html__('Tutorials','dfd'),
//								'param_name'		=> 'tutorials',
//								'doc_link'			=> '//nativewptheme.net/support/visual-composer/image-layers',
//								'video_link'		=> 'https://www.youtube.com/watch?v=cIDdfCqO2bE&feature=youtu.be',
//							),
							array(
								'type'				=> 'param_group',
								'heading'			=> esc_html__('List of layers', 'dfd'),
								'param_name'		=> 'list_fields',
								'params'			=> array(
									array(
										'type'			=> 'attach_image',
										'heading'		=> esc_html__('Upload Image:', 'dfd'),
										'param_name'	=> 'image_id',
									),
									array(
										'type'				=> 'number',
										'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the layer offset in %, for example -100% or 100%','dfd').'</span></span>'.esc_html__('Horizontal offset', 'dfd'),
										'param_name'		=> 'offcet_x',
										'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-percent',
									),
									array(
										'type'				=> 'number',
										'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the layer offset in %, for example -100% or 100%','dfd').'</span></span>'.esc_html__('Vertical offset', 'dfd'),
										'param_name'		=> 'offcet_y',
										'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-percent',
									),
									array(
										'type'				=> 'dropdown',
										'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd').'</span></span>'.esc_html__('Animation', 'dfd'),
										'param_name'		=> 'layer_animation',
										'value'				=> array(
											esc_html__('Fade In', 'dfd')			=> 'fadeIn',
											esc_html__('Flip Horizontally', 'dfd')	=> 'flipXIn',
											esc_html__('Flip Vertically', 'dfd')	=> 'flipYIn',
											esc_html__('Shrink', 'dfd')				=> 'shrinkIn',
											esc_html__('Expand', 'dfd')				=> 'expandIn',
											esc_html__('Grow', 'dfd')				=> 'grow',
											esc_html__('Slide Up', 'dfd')			=> 'slideUpBigIn',
											esc_html__('Slide Down', 'dfd')			=> 'slideDownBigIn',
											esc_html__('Slide Right', 'dfd')		=> 'slideLeftBigIn',
											esc_html__('Slide Left', 'dfd')			=> 'slideRightBigIn',
											esc_html__('Perspective Up', 'dfd')		=> 'perspectiveUpIn',
											esc_html__('Perspective Down', 'dfd')	=> 'perspectiveDownIn',
											esc_html__('Perspective Right', 'dfd')	=> 'perspectiveLeftIn',
											esc_html__('Perspective Left', 'dfd')	=> 'perspectiveRightIn',
										),
									),
								),
								'group'				=> esc_html__('Layers', 'dfd'),
							),
						)
					)
				);
			}
		}
		
		function image_layers_form($atts, $content = null) {
			$output = $uniqid = $link_css = $el_class = $list_fields = $anim_class = $padding = $padding_css = $periodicity = $alignment = '';
			$animation_data = '';

			$atts = vc_map_get_attributes( 'image_layers', $atts );
			extract( $atts );

			$uniqid = uniqid('dfd-image-layers-').'-'.rand(1,9999);

			if(isset($alignment)) {
				$el_class .= ' '.$alignment;
			}

			$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-image-layers-wrap '.esc_attr($el_class).'">';

				$max_val_x = $max_val_y = $nth_child = 0;
				$translate = -100; $translate_step = 100;
				$nth_child_step = 1;
				$animate_delay = - $periodicity;

				if(isset($list_fields) && !empty($list_fields) && function_exists('vc_param_group_parse_atts')) {
					$list_fields = (array) vc_param_group_parse_atts($list_fields);

					foreach($list_fields as $fields) {

						$image = $offset_x_css = $offset_y_css = '';

						if(isset($fields['image_id']) && !empty($fields['image_id'])) {
							if(isset($fields['layer_animation']) && !empty($fields['layer_animation'])) {
								$anim_class = esc_attr($fields['layer_animation']);
							}

							$animate_delay = $animate_delay + $periodicity;
							$nth_child = $nth_child_step++;
							$translate = $translate + $translate_step;

							$link_css .= '#'.esc_js($uniqid).' .dfd-layer-container:nth-child('.$nth_child.') .dfd-layer-item {-webkit-transition-delay: '.$animate_delay.'s; -moz-transition-delay: '.$animate_delay.'s; -o-transition-delay: '.$animate_delay.'s; transition-delay: '.$animate_delay.'s;}';

							if(!isset($fields['offcet_x'])) {
								$fields['offcet_x'] = 0;
							}
							if(!isset($fields['offcet_y'])) {
								$fields['offcet_y'] = 0;
							}
							if($fields['offcet_x'] >= 100) {
								$fields['offcet_x'] = 100;
							}
							if($fields['offcet_x'] <= -100) {
								$fields['offcet_x'] = -100;
							}
							if($fields['offcet_y'] >= 100) {
								$fields['offcet_y'] = 100;
							}
							if($fields['offcet_y'] <= -100) {
								$fields['offcet_y'] = -100;
							}

							if( (isset($fields['offcet_x']) && strcmp($fields['offcet_x'], '') != 0) || (isset($fields['offcet_y']) && strcmp($fields['offcet_y'], '') != 0) ) {
								$offset_x_css = '-webkit-transform: translate('.esc_attr($fields['offcet_x']).'%, '.esc_attr($fields['offcet_y']).'%); -moz-transform: translate('.esc_attr($fields['offcet_x']).'%, '.esc_attr($fields['offcet_y']).'%); -o-transform: translate('.esc_attr($fields['offcet_x']).'%, '.esc_attr($fields['offcet_y']).'%); transform: translate('.esc_attr($fields['offcet_x']).'%, '.esc_attr($fields['offcet_y']).'%);';
							}

							$image = wp_get_attachment_image_src($fields['image_id'], 'full');

							$img_atts = Dfd_Theme_Helpers::get_image_attrs($image[0], $fields['image_id'], $image[1], $image[2], esc_attr__('Layer','dfd'));

							$output .= '<div class="dfd-layer-container '.esc_attr($anim_class).'">';
								$output .= '<div class="dfd-layer-centered" style="'.$offset_x_css.' '.$offset_y_css.'">';
									$output .= '<div class="dfd-layer-item">';
										$output .= '<img src="'.esc_url($image[0]).'" '.$img_atts.' />';
									$output .= '</div>';
								$output .= '</div>';
							$output .= '</div>';
						}
					}

					if(!empty($link_css)) {
						$output .= '<script type="text/javascript">'
									. '(function($) {'
										. '$("head").append("<style>'.$link_css.'</style>");'
									. '})(jQuery);'
								. '</script>';
					}
				}

			$output .= '</div>';

			return $output;
		}
	}
}

if ( class_exists( 'Dfd_Image_Layers' ) ) {
	$Dfd_Image_Layers = new Dfd_Image_Layers;
}

