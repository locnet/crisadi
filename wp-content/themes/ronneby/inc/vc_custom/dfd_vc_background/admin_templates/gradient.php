<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$file = basename(__FILE__, '.php');

$row_params[] = array(
	'type' => 'gradient',
	'class' => '',
	'heading' => __('Gradient Type', 'dfd'),
    'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the gradient direction type. You can choose Custom and design unique type.','dfd').'</span></span>'.__('Gradient Type', 'dfd'),
	'param_name' => 'dfd_bg_grad',
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'dfd_single_checkbox',
	'class' => '',
	'heading' => __('Gradient animation', 'dfd'),
    'heading'    => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to animate the gradient color background','dfd').'</span></span>'.esc_html__( 'Gradient animation', 'dfd' ),
	'param_name' => 'dfd_bg_grad_animate',
	'value' => 'off',
	'options'    => array(
		'on' => array(
			'on'    => esc_html__( 'Yes', 'dfd' ),
			'off'   => esc_html__( 'No', 'dfd' ),
		),
	),
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd'),
    'edit_field_class' => 'no-top-margin vc_column vc_col-sm-4 crum_vc',
);
$row_params[] = array(
	'type'       => 'number',
	'heading'    => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to set the animation duration in ms','dfd').'</span></span>'.esc_html__( 'Animation duration', 'dfd' ),
	'param_name' => 'dfd_bg_grad_anim_duration',
	'value'      => '3000',
	'min'        => '100',
	'max'        => '10000',
	'step'       => '100',
	'suffix'     => 'ms',
	'dependency' => array('element' => 'dfd_bg_grad_animate','value' => array('on')),
	'group' => esc_attr__('Background options', 'dfd'),
    'edit_field_class' => 'no-top-margin vc_column dfd-number-wrap vc_col-sm-6',
);
