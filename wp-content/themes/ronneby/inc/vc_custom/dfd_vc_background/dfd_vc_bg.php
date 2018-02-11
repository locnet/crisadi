<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists('Dfd_VC_Row_Background')) {
	class Dfd_VC_Row_Background {
		
		private $base_dir = 'inc/vc_custom/dfd_vc_background/';
				
		function get_template_names() {
			$dir = locate_template($this->base_dir . 'admin_templates');
			if(!$dir) return;

			if(is_dir($dir)) {
				$options_array = array(
					esc_attr__('None','dfd') => ''
				);
				$dir_content = scandir($dir);
				if(!empty($dir_content) && is_array($dir_content)) {
					foreach($dir_content as $item) {
						if(substr_count($item, '.php') == 1) {
							$val = substr($item, 0, -4);
							$options_array[$val] = $val;
						}
					}
				}
				return $options_array;
			}
			return;
		}

		function get_template_files() {
			$dir = locate_template($this->base_dir . 'admin_templates');
			
			if(!$dir) return false;
			
			if(is_dir($dir)) {
				foreach(glob($dir.'/*.php') as $file) {
					require_once($file);
				}
				if(isset($row_params) && is_array($row_params)) return $row_params;
			}
			return false;
		}
		
		public function build_backend_options() {
			$bg_variants = $this->get_template_names();
			
			$patterns_list = glob(locate_template($this->base_dir.'patterns').'/*.*');
			$patterns = array();
			
			foreach($patterns_list as $pattern)
				$patterns[basename($pattern)] = get_template_directory_uri().'/'.$this->base_dir.'patterns/'.basename($pattern);

			if(!$bg_variants) return false;

			$row_params = array();
			$row_params[] = array(
				'type' => 'ult_param_heading',
				'text' => esc_html__('Background settings', 'dfd'),
				'param_name' => 'bg_main',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group' => esc_attr__('Background options', 'dfd')
			);
			$row_params[] = array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background style for the row. The text colors will be changed according to the style you choose to make it more readable','dfd').'</span></span>'.esc_html__('Row Background Style', 'dfd'),
				'param_name' => 'bg_check',
				'value'	=> '',
				'options' => array(
					esc_attr__('Light', 'dfd') => '',
					esc_attr__('Dark', 'dfd') => 'row-background-dark'
				),
				'group' => esc_attr__('Background options', 'dfd')
			);
			$row_params[] = array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background style for the row. Animated allows you to add colors changing effect. Canvas allows you to choose one of the following mouse animations. 3 canvas styles are available. Gradient allows you to set the gradient backgrouns. Image allows you to upload the image and add the parallax. Video allows you to set the video as row\'s backgrounds','dfd').'</span></span>'.esc_attr__('Background style', 'dfd'),
				'param_name' => 'dfd_bg_style',
				'value'	=> '',
				'options' => $bg_variants,
				'group' => esc_attr__('Background options', 'dfd')
			);
			$include_params = $this->get_template_files();
			if($include_params && is_array($include_params)) {
				foreach($include_params as $param) {
					$row_params[] = $param;
				}
			}
			/*
			$row_params[] = array(
				"type" => "ult_switch",
				"class" => "",
				"heading" => __("Fade Effect on Scroll", 'dfd'),
				"param_name" => "dfd_fadeout_row",
				//"admin_label" => true,
				"value" => "",
				"options" => array(
						"fadeout_row_value" => array(
							"label" => "",
							"on" => "Yes",
							"off" => "No",
						)
					),
				'group' => esc_attr__('Background options', 'dfd'),
				"description" => __("If enabled, the the content inside row will fade out slowly as user scrolls down.", 'dfd')
			);
			$row_params[] = array(
				"type" => "number",
				"class" => "",
				"heading" => __("Viewport Position", 'dfd'),
				"param_name" => "dfd_fadeout_start_effect",
				"suffix" => "%",
				//"admin_label" => true,
				"value" => "30",
				'group' => esc_attr__('Background options', 'dfd'),
				"description" => __("The area of screen from top where fade out effect will take effect once the row is completely inside that area.", 'dfd'),
				"dependency" => Array("element" => "fadeout_row", "value" => array("fadeout_row_value"))
			);
			*/
			$row_params[] = array(
				'type' => 'ult_param_heading',
				'text' => __('Overlay settings', 'dfd'),
				'param_name' => 'bg_overlay',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group' => esc_attr__('Background options', 'dfd')
			);
			$row_params[] = array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the overlay for the row','dfd').'</span></span>'.__('Overlay', 'dfd'),
				'param_name' => 'dfd_enable_overlay',
				'value' => 'yes',
				'options' => array(
					'yes' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'group' => esc_attr__('Background options', 'dfd'),
			);
			$row_params[] = array(
				'type' => 'colorpicker',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the overlay','dfd').'</span></span>'.__('Color', 'dfd'),
				'param_name' => 'dfd_overlay_color',
				'value' => '',
				'group' => esc_attr__('Background options', 'dfd'),
				'dependency' => array('element' => 'dfd_enable_overlay', 'value' => array('yes')),
				'description' => __('Select RGBA values or opacity will be set to 20% by default.','dfd')
			);
			$row_params[] = array(
				'type' => 'radio_image_box',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the pattern for the overlay','dfd').'</span></span>'.__('Pattern','dfd'),
				'param_name' => 'dfd_overlay_pattern',
				'value' => '',
				'options' => $patterns,
				'css' => array(
					'width' => '40px',
					'height' => '35px',
					'background-repeat' => 'repeat',
					'background-size' => 'cover' 
				),
				'group' => esc_attr__('Background options', 'dfd'),
				'dependency' => array('element' => 'dfd_enable_overlay', 'value' => array('yes'))
			);
			$row_params[] = array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to control the pattern\'s opacity for the overlay. Enter value between 0 to 100 (0 is transparent)','dfd').'</span></span>'.__('Pattern Opacity','dfd'),
				'param_name' => 'dfd_overlay_pattern_opacity',
				'value' => '80',
				'min' => '0',
				'max' => '100',
				'group' => esc_attr__('Background options', 'dfd'),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-percent',
				'dependency' => array('element' => 'dfd_enable_overlay', 'value' => array('yes')),
			);
			$row_params[] = array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the pattern\'s size for the overlay','dfd').'</span></span>'.__('Pattern Size','dfd'),
				'param_name' => 'dfd_overlay_pattern_size',
				'value' => '',
				'group' => esc_attr__('Background options', 'dfd'),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
				'dependency' => array('element' => 'dfd_enable_overlay', 'value' => array('yes')),
			);

			vc_add_params('vc_row',$row_params);
		}
	}
	
	$Dfd_VC_Row_Background = new Dfd_VC_Row_Background;
}