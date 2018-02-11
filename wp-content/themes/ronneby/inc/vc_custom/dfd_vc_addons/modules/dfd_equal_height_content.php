<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists("Dfd_Equal_Height_Content")){
	class Dfd_Equal_Height_Content{
		
		function __construct(){
			add_action('init', array($this, 'dfd_equal_height_content_init'));
			add_shortcode('dfd_equal_height_content', array($this, 'dfd_equal_height_content_shortcodes'));
		}
		
		function dfd_equal_height_content_init(){
			if(function_exists("vc_map")){
				new dfd_hide_unsuport_module_frontend("eq_height_content_block");
				vc_map(
					array(
						"name" => __('Equal height content blocks', 'dfd'),
						'base' => "dfd_equal_height_content",
						'icon' => "dfd_equal_height_content dfd_shortcode",
						'class' => "eq_height_content_block",
						'as_parent' => array('except' => 'vc_gmaps'),
						'content_element' => true,
						'controls' => 'full',
						'show_settings_on_create' => true,
						'category' => __('Ronneby 2.0','dfd'),
						'params' => array(
							array(
								'type' => 'dfd_radio_advanced',
								'heading'	=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the column\'s width acorrding to container','dfd').'</span></span>'.__('Columns width','dfd'),
								'param_name' => 'columns_width',
								'value' => 'full-width-elements',
								'options' => array(
									__('1/1', 'dfd') => 'full-width-elements',
									__('1/2', 'dfd') => 'half-size-elements',
									__('1/3', 'dfd') => 'one-third-width-elements',
									__('1/4', 'dfd') => 'quarter-width-elements',
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading'	=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set 2 columns instead of 4 on the screen width 1023-800px','dfd').'</span></span>'. __('Set 1/2 columns on tablets', 'dfd'),
								'param_name' => 'tablet_columns_width',
								'options'			=> array(
									'yes'				=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
								'dependency' => array('element' => 'columns_width', 'value' => array('quarter-width-elements')),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading'	=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the offset between columns','dfd').'</span></span>'. __('Columns offsets','dfd'),
								'param_name' => 'columns_offsets',
								'value' => '',
								'options' => array(
									__('No offset', 'dfd') => '',
									__('6px', 'dfd') => 'dfd-small-paddings',
									__('20px', 'dfd') => 'dfd-normal-paddings',
								),
								'description' => __('Please select width of the elements','dfd'),
								'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding',
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option will add top and bottom spaces inside the smaller column to display the content vertically centered','dfd').'</span></span>'. __('Align content vertically', 'dfd'),
								'param_name' => 'align_content_vertically',
								'options'			=> array(
									'yes'				=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to display columns content one by one on small screens and do not keep equal height.','dfd').'</span></span>'. __('Turn off equal heights on mobiles', 'dfd'),
								'param_name' => 'mobile_destroy_equal_heights',
								'options'			=> array(
									'yes'				=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd'),
									),
								),
								'edit_field_class'	=> 'vc_column vc_col-sm-6',
							),
							array(
								'type' => 'textfield',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
								'param_name' => 'el_class',
						  	),
						),
						'js_view' => 'VcColumnView'
					)
				); // vc_map
			}
		}
		
		function dfd_equal_height_content_shortcodes($atts, $content){
			
			if(dfd_show_unsuport_nested_module_frontend("Equal height content blocks")) return false;
			
			$el_class = $columns_width = $columns_offsets = $align_content_vertically = $mobile_destroy_equal_heights = $tablet_columns_width = '';
			
			$atts = vc_map_get_attributes('dfd_equal_height_content', $atts);
			extract($atts);
			
			if(!empty($mobile_destroy_equal_heights)) {
				$el_class .= ' dfd-mobile-destroy-equal-heights';
			}
			
			if(!empty($align_content_vertically)) {
				$el_class .= ' dfd-align-content-vertically';
			}
			
			if(empty($columns_width)) {
				$columns_width = 'full-width-elements';
			}
			$el_class .= ' '.$columns_width;
			
			if(!empty($columns_offsets)) {
				$el_class .= ' '.$columns_offsets;
			}
			
			if(isset($tablet_columns_width) && !empty($tablet_columns_width)) {
				$el_class .= ' tablet-columns-width-two';
			}
			
			ob_start();
			$uniqid = uniqid(rand());
			echo '<div id="'.esc_attr($uniqid).'" class="dfd-equal-height-wrapper clearfix '.esc_attr($el_class).'">';
				echo do_shortcode($content);
			echo '</div>';
			?>
			<script type="text/javascript">
				(function($) {
					"use strict";
					$(document).ready(function() {
						if($('#<?php echo esc_js($uniqid); ?>').hasClass('dfd-align-content-vertically')) {
							$('#<?php echo esc_js($uniqid); ?>').find('>div').wrapInner('<div class="dfd-vertical-aligned"></div>');
						}
					});
				})(jQuery);
			</script>
            <?php
			return ob_get_clean();
		}
	}
	new Dfd_Equal_Height_Content;
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_dfd_equal_height_content extends WPBakeryShortCodesContainer {
		}
	}
}