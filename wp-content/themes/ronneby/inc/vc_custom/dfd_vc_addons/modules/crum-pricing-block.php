<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Pricing Block
*/
if ( ! class_exists( 'Dfd_Pricing_Block' ) ) {
	/**
	 * Class Dfd_Pricing_Block
	 */
	class Dfd_Pricing_Block {
		/**
		 * Main construct class.
		 */
		function __construct() {
			add_action( 'init', array( &$this, 'dfd_pricing_block_init' ) );
			add_shortcode( 'pricing_block', array( &$this, 'dfd_pricing_block_form' ) );
		}

		/**
		 * Block options.
		 */
		function dfd_pricing_block_init() {

			$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/pricing/';

			if ( function_exists( 'vc_map' ) ) {
				vc_map(
					array(
						'name'        => esc_html__( 'Pricing block', 'dfd' ),
						'base'        => 'pricing_block',
						'icon'        => 'pricing_block dfd_shortcode',
						'category'    => esc_html__( 'Ronneby 2.0', 'dfd' ),
						'description' => esc_html__( 'Your pricing information', 'dfd' ),
						'params'      => array_merge(
							array(
								array(
									'heading'     => esc_html__( 'Style', 'dfd' ),
									'type'        => 'radio_image_select',
									'param_name'  => 'style',
									'simple_mode' => false,
									'options'     => array(
										'style-01'	=> array(
											'tooltip'	=> esc_attr__('Classic','dfd'),
											'src'		=> $module_images . 'style-01.png'
										),
										'style-02'	=> array(
											'tooltip'	=> esc_attr__('Simple','dfd'),
											'src'		=> $module_images . 'style-02.png'
										),
										'style-03'	=> array(
											'tooltip'	=> esc_attr__('Main','dfd'),
											'src'		=> $module_images . 'style-03.png'
										),
										'style-04'	=> array(
											'tooltip'	=> esc_attr__('Colored','dfd'),
											'src'		=> $module_images . 'style-04.png'
										),
									),
								),
								array(
									'type'        => 'dfd_single_checkbox',
									'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Paddings and spaces will be decreased to perfect fit into 4-column row','dfd').'</span></span>'. esc_html__( 'Slim style', 'dfd' ),
									'value' => '',
									'options' => array (
										'on' => array (
											'on' => 'Yes',
											'off' => 'No',
										),
									),
									'param_name'  => 'slim',
								),
								//heading tab
								array(
									'type'        => 'textfield',
									'heading'     => esc_html__( 'Title', 'dfd' ),
									'param_name'  => 'title',
									'admin_label' => true,
								),
								array(
									'type'        => 'textfield',
									'heading'     => esc_html__( 'Subtitle', 'dfd' ),
									'param_name'  => 'subtitle',
								),
								array(
									'type'             => 'textfield',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you set any currency symbol you need','dfd').'</span></span>'.esc_html__('Currency symbol', 'dfd'),
									'param_name'       => 'currency_symbol',
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								),
								array(
									'type'             => 'number',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you set the price for your table','dfd').'</span></span>'.esc_html__('Price', 'dfd'),
									'param_name'       => 'payment_amount',
									'min'              => 0,
									'std'              => '',
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								),
								array(
									'type'             => 'textfield',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the recurring fee for your pricing table, it will be displayed at the right side of the price','dfd').'</span></span>'.esc_html__('Recurring fee', 'dfd'),
									'param_name'       => 'time_interval',
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								),
								array(
									'type'       => 'dfd_single_checkbox',
									'heading'	 => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the icon or custom image to the top of the pricing table','dfd').'</span></span>'. esc_html__( 'Icon in header', 'dfd' ),
									'param_name' => 'show_icon',
									'options'			=> array(
										'yes'				=> array(
											'yes'				=> esc_attr__('Yes', 'dfd'),
											'no'				=> esc_attr__('No', 'dfd'),
										),
									),
								),
								array(
									'type'       => 'dropdown',
									'heading'	 => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd').'</span></span>'.esc_html__('Animation', 'dfd'),
									'param_name' => 'module_animation',
									'value'      => dfd_module_animation_styles(),
								),
								array(
									'type'        => 'textfield',
									'heading'	  => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
									'param_name'  => 'el_class',
								),
								array(
									'type'       => 'dfd_radio_advanced',
									'heading'    => esc_html__( 'Icon to display', 'dfd' ),
									'param_name' => 'icon_type',
									'value'	=> 'selector',
									'options'	=> array(
										esc_html__( 'Font Icon Manager', 'dfd' ) => 'selector',
										esc_html__( 'Custom Image', 'dfd' ) => 'custom',
									),
									'group'      => esc_html__( 'Icon', 'dfd' ),
									'dependency'  => array(
										'element' => 'show_icon',
										'value'   => array( 'yes' ),
									),
								),
								array(
									'type'             => 'number',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the opacity value for the pricing table\'s icon. The minimum value is 0(the icon will be transparent), the maximum value is 100%', 'dfd').'</span></span>'. esc_html__( 'Opacity', 'dfd' ),
									'param_name'       => 'opacity',
									'min'              => '0',
									'max'              => '100',
									'value'            => '100',
									'edit_field_class' => 'vc_col-sm-6 vc_column dfd-number-percent crum_vc',
									'dependency'  => array(
										'element' => 'show_icon',
										'value'   => array( 'yes' ),
									),
									'group'            => esc_html__( 'Icon', 'dfd' ),
								),
								array(
									'type'       => 'number',
									'heading'	=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the size of the icon set for the pricing table', 'dfd').'</span></span>'. esc_html__( 'Icon size', 'dfd' ),
									'param_name' => 'icon_size',
									'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
									'min'        => 12,
									'dependency'  => array(
										'element' => 'show_icon',
										'value'   => array( 'yes' ),
									),
									'group'      => esc_html__( 'Icon', 'dfd' ),
								),
								array(
									'type'       => 'colorpicker',
									'class'      => 'crum_vc',
									'heading'	=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the color of the icon set for the pricing table', 'dfd').'</span></span>'.esc_html__( 'Color', 'dfd' ),
									'param_name' => 'icon_color',
									'group'      => esc_html__( 'Icon', 'dfd' ),
									'dependency' => array( 'element' => 'icon_type', 'value' => array( 'selector' ) ),
								),
								array(
									'type'       => 'icon_manager',
									'heading'    => esc_html__( 'Select Icon ', 'dfd' ),
									'param_name' => 'icon',
									'group'      => esc_html__( 'Icon', 'dfd' ),
									'dependency' => array( 'element' => 'icon_type', 'value' => array( 'selector' ) ),
								),
								array(
									'type'        => 'attach_image',
									'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the custom image from media library','dfd').'</span></span>'.esc_html__('Upload Image', 'dfd'),
									'param_name'  => 'icon_image_id',
									'group'       => esc_html__( 'Icon', 'dfd' ),
									'description' => esc_html__( 'Upload the custom image icon.', 'dfd' ),
									'dependency'  => Array( 'element' => 'icon_type', 'value' => array( 'custom' ) ),
								),

								array(
									'type'       => 'textarea',
									'heading'    => esc_html__( 'Content', 'dfd' ),
									'param_name' => 'description',
									'group'      => esc_html__( 'Content', 'dfd' ),
								),
								array(
									'type'        => 'param_group',
									'heading'     => __( 'Features', 'dfd' ),
									'param_name'  => 'values',
									'group'       => esc_html__( 'Content', 'dfd' ),
									'description' => __( 'Features list', 'dfd' ),
									'value'       => urlencode( json_encode( array(
										array(
											'feature_style' => 'text_icon',
											'label'         => __( 'Development', 'dfd' ),
										),
									) ) ),
									'params'      => array(
										array(
											'type'       => 'dropdown',
											'heading'    => esc_html__( 'Type', 'dfd' ),
											'param_name' => 'feature_style',
											'admin_label' => true,
											'value'      => array(
												esc_html__( 'Text with icon', 'dfd' ) => 'text_icon',
												esc_html__( 'Only text', 'dfd' ) => 'text_only',
												esc_html__( 'Only Icon', 'dfd' ) => 'icon_only',
												esc_html__( 'Dot Enabled', 'dfd' )    => 'dot-enabled',
												esc_html__( 'Dot Disabled', 'dfd' )   => 'dot-disabled',
												esc_html__( 'Dot Custom', 'dfd' )     => 'dot',
											),
										),
										array(
											'type'        => 'textfield',
											'heading'     => __( 'Label', 'dfd' ),
											'param_name'  => 'label',
											'admin_label' => true,
											'dependency'  => array(
												'element' => 'feature_style',
												'value'   => array( 'text_icon', 'text_only' ),
											),
										),
										array(
											'type' => 'dropdown',
											'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon library','dfd').'</span></span>'.esc_html__('Icon library', 'dfd'),
											'value' => array(
												__( 'Font Awesome', 'dfd' ) => 'fontawesome',
												__( 'Open Iconic', 'dfd' ) => 'openiconic',
												__( 'Typicons', 'dfd' ) => 'typicons',
												__( 'Entypo', 'dfd' ) => 'entypo',
												__( 'Linecons', 'dfd' ) => 'linecons',
											),
											'param_name' => 'type',
											'dependency'  => array(
												'element' => 'feature_style',
												'value'   => array( 'text_icon','icon_only' ),
											),
										),
										array(
											'type' => 'iconpicker',
											'heading' => __( 'Icon', 'dfd' ),
											'param_name' => 'icon_fontawesome',
											'value' => 'fa fa-adjust', // default value to backend editor admin_label
											'settings' => array(
												'emptyIcon' => false,
												// default true, display an "EMPTY" icon?
												'iconsPerPage' => 4000,
												// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
											),
											'dependency' => array(
												'element' => 'type',
												'value' => 'fontawesome',
											),
										),
										array(
											'type' => 'iconpicker',
											'heading' => __( 'Icon', 'dfd' ),
											'param_name' => 'icon_openiconic',
											'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
											'settings' => array(
												'emptyIcon' => false, // default true, display an "EMPTY" icon?
												'type' => 'openiconic',
												'iconsPerPage' => 4000, // default 100, how many icons per/page to display
											),
											'dependency' => array(
												'element' => 'type',
												'value' => 'openiconic',
											),
										),
										array(
											'type' => 'iconpicker',
											'heading' => __( 'Icon', 'dfd' ),
											'param_name' => 'icon_typicons',
											'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
											'settings' => array(
												'emptyIcon' => false, // default true, display an "EMPTY" icon?
												'type' => 'typicons',
												'iconsPerPage' => 4000, // default 100, how many icons per/page to display
											),
											'dependency' => array(
												'element' => 'type',
												'value' => 'typicons',
											),
										),
										array(
											'type' => 'iconpicker',
											'heading' => __( 'Icon', 'dfd' ),
											'param_name' => 'icon_entypo',
											'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
											'settings' => array(
												'emptyIcon' => false, // default true, display an "EMPTY" icon?
												'type' => 'entypo',
												'iconsPerPage' => 4000, // default 100, how many icons per/page to display
											),
											'dependency' => array(
												'element' => 'type',
												'value' => 'entypo',
											),
										),
										array(
											'type' => 'iconpicker',
											'heading' => __( 'Icon', '' ),
											'param_name' => 'icon_linecons',
											'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
											'settings' => array(
												'emptyIcon' => false, // default true, display an "EMPTY" icon?
												'type' => 'linecons',
												'iconsPerPage' => 4000, // default 100, how many icons per/page to display
											),
											'dependency' => array(
												'element' => 'type',
												'value' => 'linecons',
											),
										),
										array(
											'type'       => 'colorpicker',
											'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the dots placed near features','dfd').'</span></span>'.esc_html__( 'Color', 'dfd' ),
											'param_name' => 'dot_color',
											'dependency' => array(
												'element' => 'feature_style',
												'value'   => array( 'dot' ),
											),
										),
									),
								),
								array(
									'type'        => 'textfield',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the text for the prcing table button','dfd').'</span></span>'.esc_html__( 'Button text', 'dfd' ),
									'param_name'  => 'button_text',
									'group'       => esc_html__( 'Content', 'dfd' ),
								),
								array(
									'type'        => 'vc_link',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the link for the prcing table button','dfd').'</span></span>'. __( 'Button link', 'dfd' ),
									'param_name'  => 'button_link',
									'group'       => esc_html__( 'Content', 'dfd' ),
								),
							),
							//Style tab
							array(
								array(
									'type'       => 'dropdown',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the border style for the pricing block','dfd').'</span></span>'. esc_html__( 'Block border style', 'dfd' ),
									'param_name' => 'border_style',
									'value'      => array(
										esc_html__( 'None', 'dfd' )   => '',
										esc_html__( 'Solid', 'dfd' )  => 'solid',
										esc_html__( 'Dotted', 'dfd' ) => 'dotted',
										esc_html__( 'Dashed', 'dfd' ) => 'dashed',

									),
									'group'      => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border color for the pricing block','dfd').'</span></span>'. esc_html__( 'Border color', 'dfd' ),
									'param_name'       => 'border_color',
									'dependency'       => array(
										'element' => 'border_style',
										'value' => array( 'solid', 'dotted', 'dashed' ),
									),
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'number',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the width for the border','dfd').'</span></span>'. esc_html__( 'Border width', 'dfd' ),
									'param_name'       => 'border_width',
									'min'              => 0,
									'std'              => '1',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'dependency'       => array(
										'element' => 'border_style',
										'value' => array( 'solid', 'dotted', 'dashed' ),
									),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the background color for the top part of the pricing table. The default color for the style Simple is #fff. The default color for the style Main is inherited from Theme Options > Styling options > Third site color. The default color for the styles Classic and Colored is inherited from Theme Options > Styling options > Light background color','dfd').'</span></span>'. esc_html__( 'Heading BACKGROUND COLOR', 'dfd' ),
									'param_name'       => 'head_bg_color',
									'group'            => esc_html__( 'Style', 'dfd' ),
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								),
								array(
									'type'             => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the background color for the features part of the pricing table. The default color for the styles Classic and Simple is #fff. The default color for the style Main is inherited from Theme Options > Styling options > Third site color. The default color for the style  Colored is inherited from Theme Options > Styling options > Light background color','dfd').'</span></span>'. esc_html__( 'Features background color', 'dfd' ),
									'param_name'       => 'desc_bg_color',
									'group'            => esc_html__( 'Style', 'dfd' ),
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								),
								array(
									'type'        => 'dfd_single_checkbox',
									'param_name'  => 'feat_mark',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the label mark on the top of the pricing table','dfd').'</span></span>'. esc_html__( 'Label', 'dfd' ),
									'options'	  => array(
									'yes' => array(
											'on' => esc_html__( 'Yes', 'dfd' ),
											'off' => esc_html__( 'No', 'dfd' ),
										),
									),
									'group'       => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'        => 'textfield',
									'heading'     => esc_html__( 'Label text', 'dfd' ),
									'param_name'  => 'feat_mark_text',
									'group'       => esc_html__( 'Style', 'dfd' ),
									'dependency'  => array(
										'element' => 'feat_mark',
										'value'   => 'yes',
									),
								),
								array(
									'type'             => 'dfd_radio_advanced',
									'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the label mark style','dfd').'</span></span>'. esc_html__( 'Lebel style', 'dfd' ),
									'param_name'       => 'feat_mark_style',
									'value'			=> 'style-01',
									'options'		=> array(
										esc_html__( 'Square', 'dfd' )  => 'style-01',
										esc_html__( 'Rounded', 'dfd' )  => 'style-02',

									),
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
									'dependency'       => array(
										'element' => 'feat_mark',
										'value'   => 'yes',
									),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the label','dfd').'</span></span>'. esc_html__( 'Label text color', 'dfd' ),
									'param_name'       => 'feat_mark_text_color',
									'dependency'       => array(
										'element' => 'feat_mark',
										'value'   => 'yes',
									),
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the label background','dfd').'</span></span>'. esc_html__( 'Label backgrond', 'dfd' ),
									'param_name'       => 'feat_mark_bg_color',
									'dependency'       => array(
										'element' => 'feat_mark',
										'value'   => 'yes',
									),
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'        => 'dfd_single_checkbox',
									'param_name'  => 'price_sep',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the separator between title and price','dfd').'</span></span>'. esc_html__( 'Price delimiter', 'dfd' ),
									'options'			=> array(
										'yes'		=> array(
											'on'				=> esc_html__( 'Yes', 'dfd' ),
											'off'				=> esc_html__( 'No', 'dfd' ),
										),
									),
									'group'       => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the color of the separator between title and price. The default color is inherited from Theme Options > Styling options > Third site color. The default color for the style Main is #fff','dfd').'</span></span>'. esc_html__( 'Color', 'dfd' ),
									'param_name'       => 'line_color',
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
									'dependency'       => array('element' => 'price_sep', 'value' => 'yes'),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'number',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the width of the separator between title and price. The default width is 140px','dfd').'</span></span>'. esc_html__( 'Width', 'dfd' ),
									'param_name'       => 'line_width',
									'min'              => 0,
									'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
									'dependency'       => array('element' => 'price_sep', 'value' => 'yes'),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'number',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the width of the separator between title and price. The default value is 2px','dfd').'</span></span>'. esc_html__( 'Height', 'dfd' ),
									'param_name'       => 'line_border',
									'min'              => 0,
									'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
									'dependency'       => array('element' => 'price_sep', 'value' => 'yes'),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the color for the currency symbol, price amount and recurring fee','dfd').'</span></span>'. esc_html__( 'Currency, price & RECURRING FEE color', 'dfd' ),
									'param_name'       => 'price_color',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'ult_param_heading',
									'param_name'       => 'content_t_heading',
									'text'             => esc_html__( 'Content settings', 'dfd' ),
									'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
									'group'            => esc_attr__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'param_name'       => 'content_color',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the text color for the content','dfd').'</span></span>'.  esc_html__( 'Content color', 'dfd' ),
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'ult_param_heading',
									'param_name'       => 'button_t_heading',
									'text'             => esc_html__( 'Button settings', 'dfd' ),
									'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
									'group'            => esc_attr__( 'Style', 'dfd' ),
								),
								array(
									'type'				=> 'dfd_single_checkbox',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the custom styles for the pricing block button','dfd').'</span></span>'.  esc_html__( 'Custom styles', 'dfd' ),
									'param_name'		=> 'extended_button_settings',
									'options'			=> array(
										'yes'		=> array(
											'on'				=> esc_html__( 'Yes', 'dfd' ),
											'off'				=> esc_html__( 'No', 'dfd' ),
										),
									),
									'group'            => esc_attr__( 'Style', 'dfd' ),
								),
								array(
									'type'       => 'dfd_radio_advanced',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the border style for the button','dfd').'</span></span>'.esc_html__( 'Border style', 'dfd' ),
									'param_name' => 'button_border_style',
									'value'      => 'none',
									'options'      => array(
										esc_html__( 'None', 'dfd' )   => 'none',
										esc_html__( 'Solid', 'dfd' )  => 'solid',
										esc_html__( 'Dotted', 'dfd' ) => 'dotted',
										esc_html__( 'Dashed', 'dfd' ) => 'dashed',

									),
									'dependency'       => array('element' => 'extended_button_settings', 'value' => 'yes'),
									'group'      => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'number',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the border width for the button','dfd').'</span></span>'. esc_html__( 'Border width', 'dfd' ),
									'param_name'       => 'button_border_width',
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc dfd-number-wrap',
									'dependency'       => array('element' => 'button_border_style', 'value' => array('solid', 'dotted', 'dashed')),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the border color for the button','dfd').'</span></span>'. esc_html__( 'Border color', 'dfd' ),
									'param_name'       => 'button_border_color',
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
									'dependency'       => array('element' => 'button_border_style', 'value' => array('solid', 'dotted', 'dashed')),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the border color for the button on hover','dfd').'</span></span>'. esc_html__( 'Border hover color', 'dfd' ),
									'param_name'       => 'button_border_hover_color',
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
									'dependency'       => array('element' => 'button_border_style', 'value' => array('solid', 'dotted', 'dashed')),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the button background color. The default value is inherited from Theme Options > General Options > Default button options > Default button background color. The default background color for the style Main is #fff','dfd').'</span></span>'. esc_html__( 'Background color', 'dfd' ),
									'param_name'       => 'button_background_color',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'dependency'       => array('element' => 'extended_button_settings', 'value' => 'yes'),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the button background color. The default value is inherited from Theme Options > General Options > Default button options > Default button hover background color. The default background hover color for the style Main is rgba(255,255,255,0.8)','dfd').'</span></span>'. esc_html__( 'Background hover color', 'dfd' ),
									'param_name'       => 'button_background_hover_color',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'dependency'       => array('element' => 'extended_button_settings', 'value' => 'yes'),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the text color for the button. The default value is inherited from Theme Options > General Options > Default button options > Default Button Typography. The default text color for the style Main is #1b1b1b','dfd').'</span></span>'. esc_html__( 'Text color', 'dfd' ),
									'param_name'       => 'button_text_color',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'dependency'       => array('element' => 'extended_button_settings', 'value' => 'yes'),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the text hover color for the button. The default value is inherited from Theme Options > General Options > Default button options > Default button hover text color. The default text hover color for the style Main is #1b1b1b','dfd').'</span></span>'. esc_html__( 'Text hover color', 'dfd' ),
									'param_name'       => 'button_text_hover_color',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'dependency'       => array('element' => 'extended_button_settings', 'value' => 'yes'),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
							),
							//typography tab
							array(
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
									'type'        => 'dfd_single_checkbox',
									'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
									'param_name'  => 'use_google_fonts',
									'options'			=> array(
									'yes'				=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd'),
										),
									),
									'group'       => esc_attr__( 'Typography', 'dfd' ),
								),
								array(
									'type'       => 'google_fonts',
									'param_name' => 'custom_fonts',
									'value'      => '',
									'group'      => esc_attr__( 'Typography', 'dfd' ),
									'settings'   => array(
										'fields' => array(
											'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
											'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
										),
									),
									'dependency' => array(
										'element' => 'use_google_fonts',
										'value'   => 'yes',
									),
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
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Content Typography', 'dfd' ),
									'param_name'       => 'content_t_heading',
									'group'            => esc_attr__( 'Typography', 'dfd' ),
									'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								),
								array(
									'type'       => 'dfd_font_container_param',
									'heading'    => '',
									'param_name' => 'font_options',
									'settings'   => array(
										'fields' => array(
											'letter_spacing',
											'font_size',
											'line_height',
											'color',
											'font_style'
										),
									),
									'group'      => esc_attr__( 'Typography', 'dfd' ),
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
		 * @param array $atts Shortcode atributes.
		 *
		 * @return string
		 */
		function dfd_pricing_block_form( $atts ) {

			$style = $slim = $output = $el_class = $module_animation = $link_css = $uniqid = $border_style_css = $border_width_css = $border_color_css = $price_color = '';
			$title = $subtitle = $currency_symbol = $payment_amount = $time_interval = $hide_heading = $description = $values = $button_text = $button_link = $button_text_color = '';
			$border_style = $border_color = $border_width = $head_bg_color = $desc_bg_color = $feat_mark = $feat_mark_text = $title_font_options = $subtitle_font_options = '';
			$feat_mark_style = $feat_mark_text_color = $feat_mark_bg_color = $price_sep =  $line_width = $line_border = $line_color = $price_sep_style = $price_sep_color = '';
			$desc_sep  = $desc_sep_style = $desc_sep_color = $el_class = $no_margin_class = $font_options = $use_google_fonts = $custom_fonts = $pricing_style = $title_html = '';
			$icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypoicons = $icon_linecons = $show_icon = $icon_html = $heading_style = $description_style = '';
			$subtitle_html = $price_sep_html = $sep_style_price = $desc_sep_class = $sep_style_desc = $hide_heading_class = $animation_data = $extended_button_settings = '';
			$button_border_style = $button_border_width = $button_border_hover_color = $button_background_color = $button_background_hover_color = $button_text_hover_color = '';
			$content_color = $mark_style = '';
			
			$atts = vc_map_get_attributes( 'pricing_block', $atts );
			extract( $atts );

			/**************************
			 * Appear Animation
			 *************************/

			$uniqid = uniqid('dfd-pricing-block-') .'-'.rand(1,9999);

			if ( ! ( $module_animation == '' ) ) {
				$el_class       .= ' cr-animate-gen ';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}

			if ( ! empty ( $show_icon ) ) {
				$icon_html = '<div class="icon-wrap">' . crumina_icon_render( $atts ) . '</div>';
			}

			$attributes    = array();

			/**************************
			 * Header block options.
			 *************************/

			if ( ! empty( $head_bg_color ) ) {
				$heading_style = 'style="background-color:' . $head_bg_color . '"';
                $link_css .= '#'.esc_js($uniqid).'.dfd-pricing-block .block-head {background: '.esc_js($head_bg_color).';}';
                $link_css .= '#'.esc_js($uniqid).'.dfd-pricing-block.style-01 .block-head:before {background: linear-gradient(45deg, transparent 33.333%, '.$head_bg_color.' 33.333%, '.$head_bg_color.' 66.667%, transparent 66.667%), linear-gradient(-45deg, transparent 33.333%, '.$head_bg_color.' 33.333%, '.$head_bg_color.' 66.667%, transparent 66.667%);}';
                $link_css .= '#'.esc_js($uniqid).'.dfd-pricing-block.style-01 .block-head:before {background-size: 10px 20px;}';
                $link_css .= '#'.esc_js($uniqid).'.dfd-pricing-block.style-01 .block-head:after {background: linear-gradient(45deg, transparent 33.333%, #ffffff 33.333%, #ffffff 66.667%, transparent 66.667%), linear-gradient(-45deg, '.$head_bg_color.' 33.333%, transparent 33.333%, transparent 66.667%, '.$head_bg_color.' 66.667%);}';
                $link_css .= '#'.esc_js($uniqid).'.dfd-pricing-block.style-01 .block-head:after {background-size: 10px 20px;}';
			}
			if ( ! empty( $desc_bg_color ) ) {
				$description_style = 'style="background-color:' . $desc_bg_color . '"';
			}

			if(isset($price_color) && !empty($price_color)) {
				$pricing_style = 'style="color:' .esc_attr($price_color). '"';
			}

			/**************************
			 * Title / Subtitle HTML.
			 *************************/

			if ( ! empty( $title ) ) {
				$title_options = _crum_parse_text_shortcode_params( $title_font_options, 'feature-title', $use_google_fonts, $custom_fonts  );
				$title_html .= '<' . $title_options['tag'] . ' class="' . $title_options['class'] . '" ' . $title_options['style'] . '>' . $title . '</' . $title_options['tag'] . '>';
			}

			if ( ! empty( $subtitle ) ) {
				$subtitle_options = _crum_parse_text_shortcode_params( $subtitle_font_options, 'subtitle' );
				$subtitle_html .= '<' . $subtitle_options['tag'] . ' class="' . $subtitle_options['class'] . '" ' . $subtitle_options['style'] . '>' . $subtitle . '</' . $subtitle_options['tag'] . '>';
			}

			/**************************
			 * Delimiter HTML.
			 *************************/

			if ( $line_width || $line_border || $line_color ) {
				$sep_style_price .= 'style="';
				if ($line_width != '') {
					$sep_style_price .= 'width:' . $line_width . 'px;';
				}
				if ($line_border != '') {
					$sep_style_price .= 'border-width:' . $line_border . 'px;';
				}
				if ( $line_color ) {
					$sep_style_price .= 'border-color:' . $line_color;
				}
				$sep_style_price .= '"';
			}
			if ( 'yes' === $price_sep ) {
				$price_sep_html .= '<div class="delimiter-wrap"><span class="price-sep" ' . $sep_style_price . '></span></div>';
			}

			/***************************
			 * Button style.
			 **************************/
			if ( function_exists( 'vc_build_link' ) ) {
				$button_link = ( '||' === $button_link ) ? '' : $button_link;
				$button_link = vc_build_link( $button_link );

				$a_href   = $button_link['url'];
				$a_title  = $button_link['title'];
				$a_target = strlen( $button_link['target'] ) > 0 ? $button_link['target'] : '_self';

				$attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
				$attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
				$attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
			}

			/***************************
			 * "Featured" label style
			 **************************/
			if ( ! empty( $feat_mark_text_color ) || ! empty( $feat_mark_bg_color ) ) {
				$mark_style = 'style="';
				if ( ! empty( $feat_mark_text_color ) ) {
					$mark_style .= 'color:' . $feat_mark_text_color . '; ';
				}
				if ( isset( $feat_mark_bg_color ) && ! empty( $feat_mark_bg_color ) ) {
					$mark_style .= 'background-color:' . $feat_mark_bg_color . ';';
				}
				$mark_style .= '"';
			}
			/**************************
			 * Block Border
			 *************************/
			if (isset($border_style) && !empty($border_style)) {
				$border_style_css = 'border-style: '.esc_attr($border_style).';';
			}
			if (isset($border_width) && !empty($border_width)) {
				$border_width_css = 'border-width: '.esc_attr($border_width).'px;';
			}
			if (isset($border_color) && !empty($border_color)) {
				$border_color_css = 'border-color: '.esc_attr($border_color).';';
			}
			$link_css .= '#'.$uniqid.'.dfd-pricing-block {'.$border_style_css.' '.$border_width_css.' '.$border_color_css.'}';

			if(isset($button_border_style) && !empty($button_border_style)) {
				$link_css .= '#'.esc_js($uniqid).' .pricing-button.button {border-style: '.esc_js($button_border_style).';}';
			}
			if(isset($button_border_width) && $button_border_width != '') {
				$link_css .= '#'.esc_js($uniqid).' .pricing-button.button {border-width: '.esc_js($button_border_width).'px;}';
			}
			if(isset($button_border_color) && !empty($button_border_color)) {
				$link_css .= '#'.esc_js($uniqid).' .pricing-button.button {border-color: '.esc_js($button_border_color).';}';
			}
			if(isset($button_border_hover_color) && !empty($button_border_hover_color)) {
				$link_css .= '#'.esc_js($uniqid).' .pricing-button.button:hover {border-color: '.esc_js($button_border_hover_color).';}';
			}
			if(isset($button_background_color) && !empty($button_background_color)) {
				$link_css .= '#'.esc_js($uniqid).' .pricing-button.button {background: '.esc_js($button_background_color).';}';
			}
			if(isset($button_background_hover_color) && !empty($button_background_hover_color)) {
				$link_css .= '#'.esc_js($uniqid).' .pricing-button.button:hover {background: '.esc_js($button_background_hover_color).';}';
			}
			if(isset($button_text_color) && !empty($button_text_color)) {
				$link_css .= '#'.esc_js($uniqid).' .pricing-button.button {color: '.esc_js($button_text_color).';}';
			}
			if(isset($button_text_hover_color) && !empty($button_text_hover_color)) {
				$link_css .= '#'.esc_js($uniqid).' .pricing-button.button:hover {color: '.esc_js($button_text_hover_color).';}';
			}
			
			if ( 'yes' === $slim ) {
				$el_class .= ' slim-block';
			}

			/**************************
			 * Module.
			 *************************/

			if ( empty( $description ) ) {
				$el_class .= ' no-description ';
			}

			$output .= '<div id="'.$uniqid.'" class="dfd-pricing-block ' . $style . ' ' . $el_class . '" ' . $border_style . ' ' . $animation_data . '>';
			$output .= '<div class="block-head ' . $desc_sep_class . ' " ' . $heading_style . '>';

			/**************************
			 * Module-Header.
			 *************************/
			if ( isset( $feat_mark ) && ( 'yes' === $feat_mark ) ) {
				$output .= '<span class="feat-mark ' . $feat_mark_style . '" ' . $mark_style . '>' . $feat_mark_text . '</span>';
			}

			$output .= $icon_html;

			$output .= $title_html;

			$output .= $subtitle_html;
			
			$output .= $price_sep_html;
			
			$output .= '<div class="price-wrap">';

			if ( ! empty( $currency_symbol ) ) {
				$output .= '<span class="currency-symbol" ' . $pricing_style . '>' . $currency_symbol . '</span>';
			}

			if ( ! empty( $payment_amount ) ) {
				$output .= '<span class="payment-amount" ' . $pricing_style . '>' . $payment_amount . '</span>';
			}

			if ( ! empty( $time_interval ) ) {
				$output .= '<span class="time-interval" ' . $pricing_style . '> / ' . $time_interval . '</span>';
			}
			$output .= '</div>';

			$output .= '</div>';/*crum-pricing-block-head*/

			/**************************
			 * Module-Description.
			 *************************/

			$output .= '<div class="block-desc" ' . $description_style . '>';

			if ( ! empty( $description ) ) {
				$output .= '<' . $subtitle_options['tag'] . ' class="desc-text ' . $subtitle_options['class'] . '">' . $description . '</' . $subtitle_options['tag'] . '>';
				if(isset($subtitle_options['style']) && !empty($subtitle_options['style'])) {
					$link_css .= '#'.esc_js($uniqid).' .desc-text {'.esc_attr($subtitle_options['style']).'}';
				}
			}
			if(isset($content_color) && !empty($content_color)) {
				$link_css .= '#'.esc_js($uniqid).' .desc-text {color: '.esc_js($content_color).' !important;}';
			}

			/**************************
			 * Module-options-values.
			 *************************/
			if ( function_exists( 'vc_param_group_parse_atts' ) ) {
				$values = (array) vc_param_group_parse_atts( $values );
			}

			if ( is_array( $values ) ) {
				$description_option = _crum_parse_text_shortcode_params( $font_options, 'price-feature');

				$output .= '<ul class="options-list">';

				foreach ( $values as $single_feature ) {

					// Enqueue needed icon font.
					vc_icon_element_fonts_enqueue( $single_feature['type'] );

					$iconClass = isset( $single_feature{'icon_' . $single_feature['type']} ) ? esc_attr( $single_feature{'icon_' . $single_feature['type']} ) : '';

					$output .= '<li class="option">';
					if ( ( 'text_icon' !== $single_feature['feature_style'] ) && ( 'text_only' !== $single_feature['feature_style'] ) && ( 'icon_only' !== $single_feature['feature_style'] ) ) {
						if ( ! empty( $single_feature['dot_color'] ) ) {
							$dot_style = 'style="background-color:' . $single_feature['dot_color'] . '"';
						} else {
							$dot_style = '';
						}
						$output .= '<span class="price-block-dot ' . $single_feature['feature_style'] . '" ' . $dot_style . '></span>';
					} else {
						if ( ! empty( $iconClass ) && ( 'text_only' !== $single_feature['feature_style'] ) ) {

							if(( 'icon_only' === $single_feature['feature_style'] )){
								$no_margin_class = 'no-margin';
							}

							$output .= '<span class="option-icon ' . $no_margin_class . '"><i class="' . $iconClass . '"></i></span>';
						}
						if ( ! empty( $single_feature['label'] ) && ( 'icon_only' !== $single_feature['feature_style'] ) ) {
							$output .= '<' . $description_option['tag'] . ' class="pricing-feature-description" ' . $description_option['style'] . '>' . $single_feature['label'] . '</' . $description_option['tag'] . '>';
						}
					}
					$output .= '</li>';
				}
				$output .= '</ul>';
			}
			/**************************
			 * Module-Button.
			 *************************/
			if ( ! empty( $button_link ) ) {
				$output .= '<a class="pricing-button button" ' . implode( ' ', $attributes ) . '>' . $button_text . '</a>';
			}

			$output .= '</div>';
			//Description end

			$output .= '</div>';
			//module end
			
			if(!empty($link_css)) {
				$output .= '<script type="text/javascript">
					(function($) {
						$("head").append("<style>'. esc_js($link_css) .'</style>");
					})(jQuery);
				</script>';
			}

			return $output;
		}
	}
}

if ( class_exists( 'Dfd_Pricing_Block' ) ) {
	$Dfd_Pricing_Block = new Dfd_Pricing_Block;
}