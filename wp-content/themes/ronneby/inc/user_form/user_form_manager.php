<?php

class Dfd_User_Form_Manager {

	private $param_name = "check_layout";
	private $fake_param_name = "fake_check_layout";
	private $param_type = "dfd_check_layout";

	/**
	 *
	 * @var Dfd_User_Form_Manager $_instance 
	 */
	private static $_instance = null;

	public static function instance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	function __construct() {
		$this->init();
	}

	public function init() {
		require_once locate_template("/inc/user_form/template_manager.php");
		require_once locate_template("/inc/user_form/user_input.php");
		require_once locate_template("/inc/user_form/contact_form_input.php");
		require_once locate_template("/inc/user_form/components/decoder.php");
		require_once locate_template("/inc/user_form/components/submission.php");
		require_once locate_template("/inc/user_form/components/field_manager.php");
		require_once locate_template("/inc/user_form/components/reCaptcha.php");
		require_once locate_template("/inc/user_form/components/mail.php");
		require_once locate_template("/inc/user_form/components/settings.php");
		require_once locate_template("/inc/user_form/decoration/Form.php");
		require_once locate_template("/inc/user_form/vendor/Akismet.class.php");
		require_once locate_template("/inc/user_form/vendor/AkismetManager.php");
		require_once locate_template("/inc/user_form/inputs/recaptcha.php");
//        require_once locate_template("/inc/recaptcha/recaptchalib.php");
		$this->setActions();
	}

	public function setActions() {
		add_action('init', array ($this, "dfd_contact_from_init"));
	}

	public function dfd_contact_from_init() {
		if (!isset($_SERVER['REQUEST_METHOD'])) {
			return;
		}
		wp_enqueue_script('jquery-form');

		if ('POST' == $_SERVER['REQUEST_METHOD']) {
			if (isset($_POST['_dfd_is_ajax_call'])) {

				$submission = Dfd_Submission::instance();

				$echo = $submission->ajaxValidate();

				$echo = wp_json_encode($echo);

				@header('Content-Type: application/json; charset=' . get_option('blog_charset'));
				echo $echo;
				exit();
			}
		}
	}

	public function getParamName() {
		return $this->param_name;
	}

	public function getFakeParamName() {
		return $this->fake_param_name;
	}

	public function getParamType() {
		return $this->param_type;
	}

	public function getoptions() {

		$files = Dfd_User_Form_template_manager::instance()->getAllTempletes();
		$res_arr = array ();
		//revers key and  value
		foreach ($files as $key => $value) {
			$res_arr[$value] = $key;
		}
		return $res_arr;
	}

	public function generateDependencys() {
		$files = Dfd_User_Form_template_manager::instance()->getAllTempletes();

		$result = array ();
		foreach ($files as $f_key => $f_value) {
			$merge_arr = array (
					'type' => 'dfd_form_template',
					'param_name' => $this->getParamName() . '_' . $f_key,
					'dependency' => Array ('element' => $this->fake_param_name, 'value' => array ($f_key)),
					'group' => __('Field Editor {' . $f_key . '}', 'js_composer'),
					'weight' => "400",
			);
			$result[] = ($merge_arr);
		}
//        print_r($r);
//        print_r($reuslt);
		return $result;
	}

	public function getParams() {
		$message = "From: {{your-name}}
Subject: {{your-subject}}

Message Body:
{{your-message}}

--
This e-mail was sent from a contact form";
//        $message = htmlspecialchars($message);
		$arr = array_merge(array(
			array(
				'type' => 'dfd_form_preset_select',
				'heading' => __('Style', 'dfd'),
				'param_name' => 'preset',
				'value' => array(
					__('Standart', 'dfd') => 'preset1',
					__('General border', 'dfd') => 'preset2',
					__('Simple', 'dfd') => 'preset3'
				),
				'weight' => "600",
			),
			array(
				'type' => 'dfd_check_layout',
				'heading' => __('Form Layouts', 'dfd'),
				'param_name' => $this->param_name,
				'options' => $this->getoptions(),
				'weight' => "500",
			),
			array(
				'type' => 'checkbox',
				'heading' => __('Enable sort panel', 'dfd'),
				'edit_field_class' => 'fakecheckbox',
				'param_name' => $this->fake_param_name,
				'value' => $this->getoptions()
			),
			array(
				'type' => 'textfield',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Add the unique class name for the element which can be used for custom CSS codes', 'dfd') . '</span></span>' . esc_html__('Custom CSS Class', 'dfd'),
				'param_name' => 'el_class',
			),
			array(
				'type' => 'dropdown',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the appear effect for the element', 'dfd') . '</span></span>' . esc_html__('Animation', 'dfd'),
				'param_name' => 'module_animation',
				'value' => dfd_module_animation_styles(),
			),
			/* -------------------Input Style----------------------------------------- */
			array (
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the style of the inputs','dfd').'</span></span>'.esc_html__('Input style on focus', 'dfd'),
				'param_name' => 'hover_style_input2',
				'value' => 'simple',
				'options' => array (
					esc_html__('Simple', 'dfd') => 'simple',
					esc_html__('Underline', 'dfd') => 'underline',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array ('element' => 'preset', 'value' => array ('preset3')),
				'group' => esc_html__('Input Style', 'dfd'),
			),
			array(
				"type" => "colorpicker",
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the color for the inputs\' background', 'dfd') . '</span></span>' . esc_html__('Inputs inner background color', 'dfd'),
				"param_name" => "input_background",
				'edit_field_class' => 'vc_column vc_col-sm-6 no-top-padding',
				'group' => esc_html__('Input Style', 'dfd'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to enable or disable the placeholder', 'dfd') . '</span></span>' . esc_html__('placeholder', 'dfd'),
				'param_name' => 'placeholder',
				'value' => 'on',
				'options' => array(
					'on' => array(
						'on' => 'Yes',
						'off' => 'No',
					),
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to enable or disable the label for text fields', 'dfd') . '</span></span>' . esc_html__('label for text fields', 'dfd'),
				'param_name' => 'show_label_text',
				'options' => array(
					'on' => array(
						'on' => 'Yes',
						'off' => 'No',
					),
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array('element' => 'preset', 'value' => array('preset1')),
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'ult_param_heading',
				'param_name' => 'content_spacing',
				'text' => __('Border settings', 'dfd'),
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'dropdown',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose one of the border styles for the inputs', 'dfd') . '</span></span>' . esc_html__('Border Style', 'dfd'),
				'param_name' => 'border_style',
				'value' => array(
					__('solid', 'dfd') => 'solid',
					__('dotted', 'dfd') => 'dotted',
					__('dashed', 'dfd') => 'dashed',
					__('hidden', 'dfd') => 'hidden',
					__('double', 'dfd') => 'double',
					__('initial', 'dfd') => 'initial',
					__('inherit', 'dfd') => 'inherit',
				),
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'number',
				'heading' => __('Border width', 'dfd'),
				'param_name' => 'borderwidth',
				'value' => 1,
				'min' => 1,
				'max' => 10,
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc crum-number-wrap',
				'dependency' => array('element' => 'preset', 'value' => array("preset1")),
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'number',
				'heading' => __('Border radius', 'dfd'),
				'param_name' => 'border_radius',
				'value' => 0,
				'min' => 1,
				'max' => 10,
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc crum-number-wrap',
				'dependency' => array('element' => 'preset', 'value' => array("preset1")),
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				"type" => "colorpicker",
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the border color for the inner fields\' borders', 'dfd') . '</span></span>' . __("Border Color", 'dfd'),
				"param_name" => "border_color",
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the size for the inner fields\' borders', 'dfd') . '</span></span>' .__('Inner border width', 'dfd'),
				'param_name' => 'inner_border_width',
				'value' => '',
				'min' => 1,
				'max' => 10,
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc crum-number-wrap',
				'dependency' => array('element' => 'preset', 'value' => array('preset2')),
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				"type" => "colorpicker",
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the border color for the general contact form\'s border', 'dfd') . '</span></span>' . esc_html__('Outer Border Color', 'dfd'),
				"param_name" => "outer_border_color",
				"value" => "#000000",
				'edit_field_class' => 'vc_column vc_col-sm-4',
				'dependency' => array('element' => 'preset', 'value' => array("preset2")),
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'ult_param_heading',
				'param_name' => 'content_spacing',
				'text' => __('Text settings', 'dfd'),
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				"type" => "colorpicker",
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the text color for the inputs', 'dfd') . '</span></span>' . esc_html__('Text Color', 'dfd'),
				"param_name" => "text_color",
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the font size for the inputs', 'dfd') . '</span></span>' . esc_html__('font size', 'dfd'),
				'param_name' => 'font_size_input',
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc crum-number-wrap',
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to use custom Google font', 'dfd') . '</span></span>' . esc_html__('Custom font family FOR INPUT TEXT', 'dfd'),
				'param_name' => 'use_google_fonts_input',
				'value' => '',
				'options' => array(
					'yes' => array(
						'yes' => esc_attr__('Yes', 'dfd'),
						'no' => esc_attr__('No', 'dfd')
					),
				),
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'custom_fonts_input',
				'heading' => __('Input Text Font Family', 'dfd'),
				'settings' => array(
					'fields' => array(
						'font_family_description' => esc_html__('Select font family.', 'dfd'),
						'font_style_description' => esc_html__('Select font styling.', 'dfd'),
					),
				),
				'edit_field_class' => 'no-top-margin vc_col-sm-12',
				'dependency' => array('element' => 'use_google_fonts_input', 'value' => 'yes'),
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'ult_param_heading',
				'param_name' => 'content_spacing',
				'text' => __('Placeholder settings', 'dfd'),
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to use custom Google font', 'dfd') . '</span></span>' . esc_html__('Custom font family for placeholder text', 'dfd'),
				'param_name' => 'use_google_fonts_placeholder',
				'value' => '',
				'options' => array(
					'yes' => array(
						'yes' => esc_attr__('Yes', 'dfd'),
						'no' => esc_attr__('No', 'dfd')
					),
				),
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'google_fonts',
				'heading' => __('Placeholder Font Family', 'dfd'),
				'param_name' => 'custom_fonts_label',
				'settings' => array(
					'fields' => array(
						'font_family_description' => esc_html__('Select font family.', 'dfd'),
						'font_style_description' => esc_html__('Select font styling.', 'dfd'),
					),
				),
				'edit_field_class' => 'no-top-margin vc_col-sm-12',
				'group' => esc_attr__('Input Style', 'dfd'),
				'dependency' => array('element' => 'use_google_fonts_placeholder', 'value' => 'yes'),
			),
			array(
				'type' => 'ult_param_heading',
				'text' => __('Placeholder text settings', 'dfd'),
				'param_name' => 'content_spacing',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'dependency' => array('element' => 'placeholder', 'value' => array('on')),
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the font size for placeholder\'s text', 'dfd') . '</span></span>' . esc_html__('Font size', 'dfd'),
				'param_name' => 'font_size_place',
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc crum-number-wrap',
				'dependency' => array('element' => 'placeholder', 'value' => array('on')),
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'colorpicker',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the color for placeholder\'s text', 'dfd') . '</span></span>' . __('Color', 'dfd'),
				'param_name' => 'color_place',
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'dependency' => array('element' => 'placeholder', 'value' => array('on')),
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'ult_param_heading',
				'param_name' => 'content_spacing',
				'text' => esc_html__('Label settings', 'dfd'),
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'dependency' => array('element' => 'show_label_text', 'value' => array('on')),
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the font size for label\'s text', 'dfd') . '</span></span>' . esc_html__('Font size', 'dfd'),
				'param_name' => 'font_size_label',
				'edit_field_class' => 'vc_column vc_col-sm-3 crum_vc crum-number-wrap',
				'dependency' => array('element' => 'show_label_text', 'value' => array('on')),
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the line height for label\'s text', 'dfd') . '</span></span>' . __('Line height', 'dfd'),
				'param_name' => 'line_height_label',
				'edit_field_class' => 'vc_column vc_col-sm-3 crum_vc crum-number-wrap',
				'dependency' => array('element' => 'show_label_text', 'value' => array('on')),
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the letter spacing for label\'s text', 'dfd') . '</span></span>' . __('Letter spacing', 'dfd'),
				'param_name' => 'letter_spacing_label',
				'edit_field_class' => 'vc_column vc_col-sm-3 crum_vc crum-number-wrap',
				'dependency' => array('element' => 'show_label_text', 'value' => array('on')),
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'colorpicker',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the color for label\'s text', 'dfd') . '</span></span>' . __('Color', 'dfd'),
				'param_name' => 'color_label',
				'edit_field_class' => 'vc_column vc_col-sm-3 crum_vc',
				'dependency' => array('element' => 'show_label_text', 'value' => array('on')),
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'ult_param_heading',
				'param_name' => 'content_spacing',
				'text' => __('Other settings', 'dfd'),
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to define the height of the text area', 'dfd') . '</span></span>' . __('Textarea height (Number of visible paragraphs)', 'dfd'),
				'param_name' => 'text_area_height',
				'value' => 5,
				'min' => 1,
				'max' => 200,
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'number',
				'heading' => __('Vertical margin between inputs', 'dfd'),
				'param_name' => 'vert_margin_btw_inputs',
				'value' => 5,
				'min' => 1,
				'max' => 200,
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc crum-number-wrap',
				'dependency' => array('element' => 'preset', 'value' => array("preset1", "preset3")),
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			array(
				'type' => 'number',
				'heading' => __('Horizontal margin between inputs', 'dfd'),
				'param_name' => 'horiz_margin_btw_inputs',
				'value' => 5,
				'min' => 1,
				'max' => 200,
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc crum-number-wrap',
				'dependency' => array('element' => 'preset', 'value' => array("preset1", "preset3")),
				'group' => esc_attr__('Input Style', 'dfd'),
			),
			/* ------------------------Button Style------------------------------------ */
			array(
				'type' => 'dropdown',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the text transform for button\'s text', 'dfd') . '</span></span>' . esc_html__('Text transform', 'dfd'),
				'param_name' => 'btn_text_transform',
				'value' => array(
					__('Inherit', 'dfd') => 'inherit',
					__('Capitalize', 'dfd') => 'capitalize',
					__('Uppercase', 'dfd') => 'uppercase',
					__('Lowercase', 'dfd') => 'lowercase',
					__('Initial', 'dfd') => 'initial',
				),
				'group' => esc_attr__('Button Style', 'dfd'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the font size for button\'s text', 'dfd') . '</span></span>' . esc_html__('Font size', 'dfd'),
				'param_name' => 'font_size',
				'value' => 12,
				'min' => 1,
				'max' => 200,
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc crum-number-wrap',
				'group' => esc_attr__('Button Style', 'dfd'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the letter spacing for button\'s text', 'dfd') . '</span></span>' . esc_html__('letter spacing', 'dfd'),
				'param_name' => 'letter_spacing',
				'value' => '0',
				'min' => 1,
				'max' => 200,
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc crum-number-wrap',
				'group' => esc_attr__('Button Style', 'dfd'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the border width for the button', 'dfd') . '</span></span>' . esc_html__('Border width', 'dfd'),
				'param_name' => 'button_border_width',
				'value' => '0',
				'min' => 1,
				'max' => 200,
				'dependency' => array('element' => 'preset', 'value' => array("preset1", "preset3")),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc crum-number-wrap',
				'group' => esc_attr__('Button Style', 'dfd'),
			),
			array(
				"type" => "colorpicker",
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the border color for the button', 'dfd') . '</span></span>' . esc_html__('Border color', 'dfd'),
				"param_name" => "button_border_color",
				'dependency' => array('element' => 'preset', 'value' => array("preset1", "preset3")),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group' => esc_attr__('Button Style', 'dfd'),
			),
			array(
				"type" => "colorpicker",
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the border color on hover for the button', 'dfd') . '</span></span>' . esc_html__('Border color on hover', 'dfd'),
				"param_name" => "button_border_color_on_hover",
				'dependency' => array('element' => 'preset', 'value' => array("preset1", "preset3")),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group' => esc_attr__('Button Style', 'dfd'),
			),
			array(
				'type' => 'dropdown',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to choose the border style', 'dfd') . '</span></span>' . esc_html__('Border style', 'dfd'),
				'param_name' => 'button_border_style',
				'value' => array(
					__('solid', 'dfd') => 'solid',
					__('dotted', 'dfd') => 'dotted',
					__('dashed', 'dfd') => 'dashed',
					__('hidden', 'dfd') => 'hidden',
					__('double', 'dfd') => 'double',
					__('initial', 'dfd') => 'initial',
					__('inherit', 'dfd') => 'inherit',
				),
				'dependency' => array('element' => 'preset', 'value' => array("preset1", "preset3")),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group' => esc_attr__('Button Style', 'dfd'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to set the border radius for the button', 'dfd') . '</span></span>' . esc_html__('Border radius', 'dfd'),
				'param_name' => 'button_border_radius',
				'value' => '0',
				'min' => 1,
				'max' => 200,
				'dependency' => array('element' => 'preset', 'value' => array("preset1", "preset3")),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc crum-number-wrap',
				'group' => esc_attr__('Button Style', 'dfd'),
			),
			array(
				"type" => "colorpicker",
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the button background color', 'dfd') . '</span></span>' . esc_html__('Button backgrond', 'dfd'),
				"param_name" => "button_backgrond",
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group' => esc_attr__('Button Style', 'dfd'),
			),
			array(
				"type" => "colorpicker",
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the button background color on hover', 'dfd') . '</span></span>' . esc_html__('Button backgrond on hover', 'dfd'),
				"param_name" => "hover_button_backgrond",
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group' => esc_attr__('Button Style', 'dfd'),
			),
			array(
				"type" => "colorpicker",
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the button text color', 'dfd') . '</span></span>' . esc_html__('Button text color', 'dfd'),
				"param_name" => "button_color_text",
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group' => esc_attr__('Button Style', 'dfd'),
			),
			array(
				"type" => "colorpicker",
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the button text color on hover', 'dfd') . '</span></span>' . esc_html__('Button text color on hover', 'dfd'),
				"param_name" => "button_hover_color_text",
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group' => esc_attr__('Button Style', 'dfd'),
			),
			array(
				"type" => "dropdown",
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to specify the button text alignment', 'dfd') . '</span></span>' . esc_html__('Text alignment', 'dfd'),
				"param_name" => "text_align",
				"value" => array(
					__('Center Align', 'dfd') => "center",
					__('Left Align', 'dfd') => "left",
					__('Right Align', 'dfd') => "right",
				),
				'group' => esc_attr__('Button Style', 'dfd'),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'dependency' => array('element' => 'preset', 'value' => array("preset1", "preset3")),
			),
			array(
				'type' => 'textfield',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Enter the text for the button', 'dfd') . '</span></span>' . esc_html__('Button text', 'dfd'),
				'param_name' => 'btn_message',
				"value" => "Send message",
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group' => esc_attr__('Button Style', 'dfd'),
			),
			array(
				"type" => "dropdown",
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the width of the button', 'dfd') . '</span></span>' . esc_html__('Button width', 'dfd'),
				"param_name" => "btn_width",
				"value" => array(
					__('Full size (1/1 size)', 'dfd') => "",
					__('Half size (1/2 size)', 'dfd') => "dfd-half-size",
					__('Third size (1/3 size)', 'dfd') => "dfd-third-size",
					__('Inherit from theme options', 'dfd') => "dfd-option-size",
				),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group' => esc_attr__('Button Style', 'dfd'),
				'dependency' => array('element' => 'preset', 'value' => array("preset1", "preset3")),
			),
			array(
				"type" => "dropdown",
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the horizontal alignment for the button', 'dfd') . '</span></span>' . esc_html__('Button alignment', 'dfd'),
				"param_name" => "btn_align",
				"value" => array(
					__('Left Align', 'dfd') => "left",
					__('Center Align', 'dfd') => "center",
					__('Right Align', 'dfd') => "right",
				),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group' => esc_attr__('Button Style', 'dfd'),
				'dependency' => array('element' => 'preset', 'value' => array("preset1", "preset3")),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the offset for the button', 'dfd') . '</span></span>' . esc_html__('Button offset', 'dfd'),
				"param_name" => "btn_offset",
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc crum-number-wrap',
				'dependency' => array('element' => 'preset', 'value' => array("preset1", "preset3")),
				'group' => esc_html__('Button Style', 'dfd')
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify button height in px', 'dfd') . '</span></span>' . esc_html__('Button height', 'dfd'),
				"param_name" => "btn_height",
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc crum-number-wrap',
				'group' => esc_html__('Button Style', 'dfd')
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to use custom Google font', 'dfd') . '</span></span>' . esc_html__('Custom font family', 'dfd'),
				'param_name' => 'use_google_fonts_button',
				'value' => '',
				'options' => array(
					'yes' => array(
						'yes' => esc_attr__('Yes', 'dfd'),
						'no' => esc_attr__('No', 'dfd')
					),
				),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group' => esc_attr__('Button Style', 'dfd'),
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'custom_fonts_button',
				'settings' => array(
					'fields' => array(
						'font_family_description' => esc_html__('Select font family.', 'dfd'),
						'font_style_description' => esc_html__('Select font styling.', 'dfd'),
					),
				),
				'dependency' => array('element' => 'use_google_fonts_button', 'value' => 'yes'),
				'group' => esc_attr__('Button Style', 'dfd'),
			),
			array(
				'type' => 'dfd_font_container_param',
				'heading' => '',
				'param_name' => 'button_font_options',
				'settings' => array(
					'fields' => array(
						//'tag' => 'h5',
						//'letter_spacing',
						//'font_size',
						//'line_height',
						//'color',
						'font_style'
					),
				),
				'group' => esc_attr__('Button Style', 'dfd'),
			),
			/* -----------------------reCaptcha setting------------------------------------- */
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to enable or disable the recaptcha for the contact form', 'dfd') . '</span></span>' . __('ReCaptcha', 'dfd'),
				"description" => __("Get recaptcha in <a target='blank' href='https://www.google.com/recaptcha/intro/index.html'>google.com/recaptcha</a>", 'dfd'),
				'param_name' => 'use_recaptcha',
				'value' => '',
				'options' => array(
					'yes' => array(
						'yes' => esc_attr__('Yes', 'dfd'),
						'no' => esc_attr__('No', 'dfd')
					),
				),
				'group' => "reCaptcha setting",
			),
			array(
				'type' => 'textfield',
				'heading' => __('Public key', 'dfd'),
				'param_name' => 'recaptcha_publickey',
				'dependency' => Array('element' => 'use_recaptcha', 'value' => array("yes")),
				'group' => "reCaptcha setting",
			),
			array(
				'type' => 'textfield',
				'heading' => __('Private key', 'dfd'),
				'param_name' => 'recaptcha_privatekey',
				'dependency' => Array('element' => 'use_recaptcha', 'value' => array("yes")),
				'group' => "reCaptcha setting",
			),
			), $this->generateDependencys(), array(
			/* -----------------------Recived email form------------------------------------- */
			array(
				'type' => 'textfield',
				'heading' => __('To', 'dfd'),
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Enter the email address the emails should be mailed to', 'dfd') . '</span></span>' . __('Send emails to', 'dfd'),
				'param_name' => 'email_to',
				"value" => get_option("admin_email"),
				'weight' => "300",
				'group' => "Recived email form",
			),
			array(
				'type' => 'textfield',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Please add your subject for the emails sent via the form. Add the subject as simple text', 'dfd') . '</span></span>' . __('Subject', 'dfd'),
				'param_name' => 'email_subject',
				"value" => "your-subject",
				'weight' => "300",
				'group' => "Recived email form",
			),
			array(
				'type' => 'dfd_form_available_fields',
				'param_name' => 'form_available_fields',
				'weight' => "300",
				'group' => "Message Text",
			),
			array(
				"type" => "textarea_html",
				"heading" => __("Message", 'dfd'),
				"param_name" => "content",
				"value" => $message,
				'group' => "Message Text",
			),
			)
		);
//        print_r($arr);
		return $arr;
	}

}

function dfdcf_ajax_loader() {
//    $url = get_template_directory_uri() . '/inc/user_form/assets/images/ajax-loader.gif';
	$url = "";
	return $url;
}

if (!function_exists("dfd_normalize_css")) {
	function dfd_normalize_css($b1) {
		$b1 = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $b1);
		$b1 = str_replace(array ("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $b1);
		return $b1;
	}
}