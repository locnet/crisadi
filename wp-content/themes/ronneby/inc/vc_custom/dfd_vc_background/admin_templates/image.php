<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$file = basename(__FILE__, '.php');

$row_params[] = array(
	'type' => 'dropdown',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the parallax style you would like to have for the background image','dfd').'</span></span>'.__('Parallax Style','dfd'),
	'param_name' => 'dfd_parallax_style',
	'value' => array(
		__('Simple Background Image','dfd') => 'dfd_simple_image',
		__('Auto Moving Background','dfd') => 'dfd_animated_bg',
		__('Vertical Parallax On Scroll','dfd') => 'dfd_vertical_parallax',
		__('Horizontal Parallax On Scroll','dfd') => 'dfd_horizontal_parallax',
		__('Interactive Parallax On Mouse Move','dfd') => 'dfd_mousemove_parallax',
		__('Multilayer Vertical Parallax','dfd') => 'dfd_multi_parallax',
	), 
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'attach_image',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the image from the media library to be set as background image for the row','dfd').'</span></span>'.__('Background Image', 'dfd'),	
	'param_name' => 'dfd_bg_image_new',
	'value' => '',
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image','dfd_animated_bg','dfd_vertical_parallax','dfd_horizontal_parallax',)),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'attach_images',
	'heading' => __('Layer Images', 'dfd'),
	'param_name' => 'dfd_layer_image',
	'value' => '',
	'description' => __('Upload or select background images from media gallery.', 'dfd'),
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_mousemove_parallax','dfd_multi_parallax')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'dfd_radio_advanced',
	'heading' => __('Parallax Direction', 'dfd'),
	'param_name' => 'dfd_multi_parallax_direction',
	'value'	=> 'vertical',
	'options' => array(
		__('Vertical', 'dfd') => 'vertical',
		__('Horizontal', 'dfd') => 'horizontal',

	),
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_multi_parallax')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'dfd_radio_advanced',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the repeating of the image you\'ve set as background for the row','dfd').'</span></span>'.__('Background Image Repeat', 'dfd'),
	'param_name' => 'dfd_bg_image_repeat',
	'value'	=> 'repeat',
	'options' => array(
			__('Repeat', 'dfd') => 'repeat',
			__('Repeat X', 'dfd') => 'repeat-x',
			__('Repeat Y', 'dfd') => 'repeat-y',
			__('No Repeat', 'dfd') => 'no-repeat',
		),
	'description' => __('Options to control repeatation of the background image. Learn on <a href="http://www.w3schools.com/cssref/playit.asp?filename=playcss_background-repeat" target="_blank">W3School</a>', 'dfd'),
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image','dfd_vertical_parallax','dfd_horizontal_parallax')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'dfd_radio_advanced',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the image size','dfd').'</span></span>'.__('Background Image Size', 'dfd'),
	'param_name' => 'dfd_bg_image_size',
	'value'	=> 'cover',
	'options' => array(
		esc_html__('Cover', 'dfd') => 'cover',
		esc_html__('Contain', 'dfd') => 'contain',
		esc_html__('Initial', 'dfd') => 'initial',
		esc_html__('Custom', 'dfd') => 'manual',
		/*__('Automatic', 'dfd') => 'automatic', */
	),
	'description' => __('Options to control size of the background image. Learn on <a href="http://www.w3schools.com/cssref/playit.asp?filename=playcss_background-size&preval=50%25" target="_blank">W3School</a>', 'dfd'),
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image','dfd_animated_bg','dfd_vertical_parallax','dfd_horizontal_parallax')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'textfield',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to set custom size for the background image in px or %. Do not add any punctuation marks','dfd').'</span></span>'.__('Custom size', 'dfd'),
	'param_name' => 'dfd_bg_image_manual_size',
	'value' => '',	
	'dependency' => array('element' => 'dfd_bg_image_size','value' => array('manual')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'colorpicker',
	'heading' =>'<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose background color for the row','dfd').'</span></span>'. esc_html__('Background color', 'dfd'),
	'param_name' => 'dfd_image_bg_color',
	'value' => '',
	'group' => esc_attr__('Background options', 'dfd'),
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'description' => __('Select RGBA values or opacity will be set to 20% by default.','dfd')
);
$row_params[] = array(
	'type' => 'dfd_radio_advanced',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose scroll effect for the image. It can be fixed or scroll with the content','dfd').'</span></span>'.__('Scroll Effect', 'dfd'),
	'param_name' => 'dfd_bg_img_attach',
	'value'	=> 'scroll',
	'options' => array(
		__('Scroll', 'dfd') => 'scroll',
		__('Fixed', 'dfd') => 'fixed',								
	),
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image', 'dfd_vertical_parallax', 'dfd_animated_bg')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'number',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Control the speed of parallax. Values from 1 to 100 are acceptable','dfd').'</span></span>'.__('Parallax Speed', 'dfd'),
	'param_name' => 'dfd_parallax_sense',
	'value' =>'30',
	'min'=>'1',
	'max'=>'100',
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_animated_bg', 'dfd_vertical_parallax','dfd_horizontal_parallax','dfd_mousemove_parallax','dfd_multi_parallax')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'number',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the parallax start offset value. Enter value between -500 to 500','dfd').'</span></span>'.__('Parallax Offset', 'dfd'),
	'param_name' => 'dfd_parallax_offset',
	'value' =>'',
	'min'=>'-500',
	'max'=>'500',
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_vertical_parallax')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'textfield',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the background image position. You can use pixels, percents or words like left bottom. Please check ','dfd').'<a href="https://www.w3schools.com/cssref/pr_background-position.asp">'.esc_html__('this link ','dfd').'</a>'.esc_html__('for more details on this property.','dfd').'</span></span>'.__('Background Image Position', 'dfd'),
	'param_name' => 'dfd_bg_image_position',
	'value' =>'',	
	'description' => __('You can use any number with px, em, %, etc. Example- 100px 100px.', 'dfd'),
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'dfd_radio_advanced',
	'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the animation direction for your moving parallax','dfd').'</span></span>'.__('Animation Direction', 'dfd'),
	'param_name' => 'dfd_animation_direction',
	'value'	=> 'right',
	'options' => array(
		__('None', 'dfd') => '',
		__('Left to Right', 'dfd') => 'right',
		__('Right to Left', 'dfd') => 'left',
		__('Top to Bottom', 'dfd') => 'bottom',
		__('Bottom to Top', 'dfd') => 'top',
	),
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_animated_bg')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'ult_param_heading',
	'text' => esc_html__('Mobile Background settings', 'dfd'),
	'param_name' => 'bg_mobile_main',
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'dfd_single_checkbox',
	'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enable or disable the parallax on mobile devices','dfd').'</span></span>'.__('Parallax on Mobile devices', 'dfd'),
	'param_name' => 'dfd_mobile_enable',
	'value' => 'yes',
	'options' => array(
		'yes' => array(
			'on' => 'Yes',
			'off' => 'No',
		),
	),
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_animated_bg','dfd_horizontal_parallax','dfd_vertical_parallax')),
	'group' => esc_attr__('Background options', 'dfd'),
);
$row_params[] = array(
	'type' => 'attach_image',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the image from the media library to be set as background image for the row on mobile devices','dfd').'</span></span>'.__('Mobile Background Image', 'dfd'),
	'param_name' => 'dfd_bg_image_new_responsive',
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image','dfd_animated_bg','dfd_vertical_parallax','dfd_horizontal_parallax',)),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'number',
	'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to specify screen resolution to apply settings from','dfd').'</span></span>'.__('Mobile Background Screen Resolution', 'dfd'),
	'param_name' => 'dfd_bg_resolution',
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image','dfd_animated_bg','dfd_vertical_parallax','dfd_horizontal_parallax',)),
	'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'textfield',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the background image position on mobile devices','dfd').'</span></span>'.__('Mobile Background Image Position', 'dfd'),
	'param_name' => 'dfd_bg_image_position_mobile',
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image')),
	'edit_field_class' => 'vc_column vc_col-sm-6',
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'dfd_radio_advanced',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the repeating of the image you\'ve set as background for the row','dfd').'</span></span>'.__('Background Image Repeat', 'dfd'),
	'param_name' => 'dfd_bg_image_repeat_mobile',
	'value'	=> '',
	'options' => array(
		esc_html__('Inherit from large', 'dfd') => '',
		esc_html__('Repeat', 'dfd') => 'repeat',
		esc_html__('Repeat X', 'dfd') => 'repeat-x',
		esc_html__('Repeat Y', 'dfd') => 'repeat-y',
		esc_html__('No Repeat', 'dfd') => 'no-repeat',
	),
	'description' => __('Options to control repeatation of the background image. Learn on <a href="http://www.w3schools.com/cssref/playit.asp?filename=playcss_background-repeat" target="_blank">W3School</a>', 'dfd'),
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'dfd_radio_advanced',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the image size on mobile devices','dfd').'</span></span>'.__('Mobile Background Image Size', 'dfd'),
	'param_name' => 'dfd_bg_image_size_mobile',
	'value' => '',
	'options' => array(
		esc_html__('Inherit from large', 'dfd') => '',
		esc_html__('Cover', 'dfd') => 'cover',
		esc_html__('Contain', 'dfd') => 'contain',
		esc_html__('Initial', 'dfd') => 'initial',
		esc_html__('Custom', 'dfd') => 'manual',
	),
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image','dfd_vertical_parallax','dfd_horizontal_parallax',)),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'textfield',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to set custom size for the background image in px or %. Do not add any punctuation marks','dfd').'</span></span>'.__('Custom size', 'dfd'),
	'param_name' => 'dfd_bg_image_manual_size_mobile',
	'value' => '',	
	'dependency' => array('element' => 'dfd_bg_image_size_mobile','value' => array('manual')),
	'group' => esc_attr__('Background options', 'dfd')
);