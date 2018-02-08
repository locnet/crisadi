<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Blog posts
*/
if(!class_exists('Dfd_Blog_Posts')) {
	class Dfd_Blog_Posts {
		
		var $admin_src = 'inc/vc_custom/dfd_vc_addons/admin/img/blog_posts/';
		var $front_template = 'inc/vc_custom/dfd_vc_addons/templates/blog_posts/';
		
		function __construct(){
			add_action('init',array($this,'blog_posts_init'));
			add_shortcode('dfd_blog_posts',array($this,'blog_posts_shortcode'));
		}
		function blog_posts_init(){
			if(function_exists('vc_map')) {
				vc_map(
					array(
						'name' => __('Blog posts','dfd'),
						'base' => 'dfd_blog_posts',
						'icon' => 'dfd_blog_posts dfd_shortcode',
						'category' => __('Ronneby 2.0','dfd'),
						'description' => __('Displays blog posts','dfd'),
						'params' => array(
							array(
								'type'        => 'radio_image_select',
								'heading'     => esc_html__( 'Style', 'dfd' ),
								'param_name'  => 'style',
								'simple_mode' => false,
								'options'     => dfd_build_shortcode_style_param($this->admin_src, $this->front_template, false),
							),
							array(
								'type'        => 'radio_image_select',
								'heading'     => esc_html__( 'Layout', 'dfd' ),
								'param_name'  => 'layout_type_grid_carousel',
								'simple_mode' => false,
								'options'     => array(
									'fitRows' => array(
										'tooltip' => esc_attr__('Grid','dfd'),
										'src' => get_template_directory_uri() . '/' . $this->admin_src . 'layout_types/fitRows.png'
									),
									'carousel' => array(
										'tooltip' => esc_attr__('Carousel','dfd'),
										'src' => get_template_directory_uri() . '/' . $this->admin_src . 'layout_types/carousel.png'
									),
								),
								'dependency' => array('element' => 'style','value' => array('default','standard','advanced')),
							),
							array(
								'type'        => 'dropdown',
								'heading'	 => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd').'</span></span>'.esc_html__('Animation', 'dfd'),
								'param_name'  => 'module_animation',
								'value'       => dfd_module_animation_styles(),
							),
							array(
								'type'        => 'textfield',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
								'param_name'  => 'el_class',
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Posts settings', 'dfd' ),
								'param_name'       => 'loop_elements_heading',
								'group'            => esc_attr__( 'Content', 'dfd' ),
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allos you to choose the posts to show. You can set Loop and specify the categories to be shown or choose single item','dfd').'</span></span>'. esc_html__('Content','dfd'),
								'param_name' => 'items',
								'value'		=> 'loop',
								'options'	=> array(
									esc_attr__('Loop','dfd') => 'loop',
									esc_attr__('Single item','dfd') => 'single',
								),
								'dependency' => array('element' => 'style','value' => array('masonry','simple','default','standard','advanced', 'hovered')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'radio_image_post_select',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the single post to be shown','dfd').'</span></span>'.esc_html__('Post to show', 'dfd'),
								'param_name' => 'single_custom_post_item',
								'value' => '',
								'post_type' => 'post',
								'css' => array(
									'width' => '120px',
									'height' => '120px',
									'background-repeat' => 'repeat',
									'background-size' => 'cover' 
								),
								'show_default' => false,
								'description' => __('Select post to display', 'dfd'),
								'dependency' => array('element' => 'items','value' => array('single')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select the categories you would like to display','dfd').'</span></span>'.esc_html__('Categories','dfd'),
								'param_name' => 'post_categories',
								'value' => dfd_get_select_options_multi('category'),
								'dependency' => array('element' => 'items','value' => array('loop')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to hide the chosen categories','dfd').'</span></span>'.esc_html__('Exclude selected categories','dfd'),
								'param_name' => 'exclude_from_loop',
								'value' => 'exclude',
								'options' => array(
									'exclude' => array(
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								'dependency' => array('element' => 'post_categories','not_empty' => true),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the number of items you would like to display','dfd').'</span></span>'.esc_html__('Posts to show', 'dfd'),
								'param_name' => 'posts_to_show',
								'value' => 6,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'items','value' => array('loop')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the space between the blog post items','dfd').'</span></span>'.esc_html__('Items offset', 'dfd'),
								'param_name' => 'items_offset',
								'value' => 20,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
								'dependency' => array('element' => 'style','value' => array('masonry','default','standard','advanced')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the horizontal alignment for the blog post info','dfd').'</span></span>'.esc_html__('Content alignment','dfd'),
								'param_name' => 'content_alignment',
								'value' => 'text-left',
								'options' => array(
									esc_attr__('Left','dfd') => 'text-left',
									esc_attr__('Center','dfd') => 'text-center',
									esc_attr__('Right','dfd') => 'text-right'
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','default','standard','advanced', 'hovered')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the content width according to the container','dfd').'</span></span>'.esc_html__('Content width','dfd'),
								'param_name' => 'content_full_width',
								'value' => '',
								'options' => array(
									esc_attr__('50%','dfd') => '',
									esc_attr__('100%','dfd') => 'hovered-full-width',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('hovered')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the visibility options for the post\'s content','dfd').'</span></span>'.esc_html__('Content visibility','dfd'),
								'param_name' => 'content_effect',
								'value' => 'desc-hover',
								'options' => array(
									esc_attr__('On hover','dfd') => 'desc-hover',
									esc_attr__('Permanent','dfd') => '',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('simple','advanced')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select the categories you would like to display','dfd').'</span></span>'.esc_html__('Categories','dfd'),
								'param_name' => 'add_post_categories',
								'value' => dfd_get_select_options_multi('category'),
								'dependency' => array('element' => 'style','value' => array('featured','recent')),
								'group' => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to hide the chosen categories','dfd').'</span></span>'.esc_html__('Exclude selected categories','dfd'),
								'param_name' => 'add_exclude_from_loop',
								'value' => 'exclude',
								'options' => array(
									'exclude' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'dependency' => array('element' => 'add_post_categories','not_empty' => true),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the number of items you would like to display','dfd').'</span></span>'.esc_html__('Posts to show', 'dfd'),
								'param_name' => 'add_posts_to_show',
								'value' => 4,
								'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
								'dependency' => array('element' => 'style','value' => array('featured','recent')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Layout settings', 'dfd' ),
								'param_name'       => 'layout_settings_heading',
								'dependency' => array('element' => 'style','value' => array('masonry','default','standard','advanced')),
								'group'			   => esc_attr__( 'Content', 'dfd' ),
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option works with loop content only. The maximum number of columns for the styles FitRows and Masonry is 4','dfd').'</span></span>'. esc_html__('Number of columns', 'dfd'),
								'param_name' => 'columns',
								'value' => 3,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','default','standard','advanced')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the autoplay for the slider','dfd').'</span></span>'. esc_html__('Auto slideshow','dfd'),
								'param_name' => 'enabled_autoslideshow',
								'value' => 'true',
								'options' => array(
									'true' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'layout_type_grid_carousel','value' => array('carousel')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the speed for the slideshow','dfd').'</span></span>'. esc_html__('Slideshow speed', 'dfd'),
								'param_name' => 'carousel_slideshow_speed',
								'value' => 5000,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-ml-second',
								'dependency' => array('element' => 'enabled_autoslideshow','value' => array('true')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the width for the post thumbnail','dfd').'</span></span>'.esc_html__('Image width', 'dfd'),
								'param_name' => 'image_width',
								'value' => 900,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
								'dependency' => array('element' => 'style','value' => array('default','standard','advanced')),
								'group'      => esc_attr__( 'Thumbs settings', 'dfd' ),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the height for the post thumbnail','dfd').'</span></span>'.esc_html__('Image height', 'dfd'),
								'param_name' => 'image_height',
								'value' => 600,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap no-top-padding',
								'dependency' => array('element' => 'style','value' => array('default','standard','advanced')),
								'group'      => esc_attr__( 'Thumbs settings', 'dfd' ),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add image mask style for the idle and hover','dfd').'</span></span>'. esc_html__('Image mask style','dfd'),
								'param_name' => 'image_mask_background',
								'value'		=> '',
								'options'	=> array(
									esc_attr__('Theme default','dfd') => '',
									esc_attr__('Custom color','dfd') => 'color',
									esc_attr__('Gradient','dfd') => 'gradient',
								),
								'dependency' => array('element' => 'style','value' => array('advanced')),
								'group' => esc_attr__('Mask'),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify image mask color opacity for the idle','dfd').'</span></span>'. esc_html__('Image mask opacity', 'dfd'),
								'param_name' => 'image_mask_opacity',
								'value' => .2,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'image_mask_background','value' => array('color','gradient')),
								'group' => esc_attr__('Mask'),
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify image mask color opacity for the hover','dfd').'</span></span>'. esc_html__('Image mask opacity on hover', 'dfd'),
								'param_name' => 'image_mask_opacity_hover',
								'value' => .8,
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'image_mask_background','value' => array('color','gradient')),
								'group' => esc_attr__('Mask'),
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'image_mask_color',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify image mask color. The default color is #000','dfd').'</span></span>'. esc_html__('Image mask color', 'dfd'),
								'value' => '',
								'dependency' => array('element' => 'image_mask_background','value' => array('color')),
								'group' => esc_attr__('Mask'),
							),
							array(
								'type' => 'gradient',
								'param_name' => 'image_mask_gradient',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify gradient direction or customize your own','dfd').'</span></span>'. esc_html__('Image mask gradient', 'dfd'),						
								'dependency' => array('element' => 'image_mask_background','value' => array('gradient')),
								'group' => esc_attr__('Mask'),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Content elements', 'dfd' ),
								'param_name'       => 'enabled_elements_heading',
								'group'            => esc_attr__( 'Content', 'dfd' ),
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('Sort Panel','dfd'),
								'param_name' => 'masonry_sort_panel',
								'value' => 'sort',
								'options' => array(
									'sort' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('Sort Panel','dfd'),
								'param_name' => 'grid_sort_panel',
								'value' => 'sort',
								'options' => array(
									'sort' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'layout_type_grid_carousel','value' => array('fitRows')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('Category','dfd'),
								'param_name' => 'enabled_category',
								'value' => 'category',
								'options' => array(
									'category' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','default','standard','advanced','recent','featured','simple', 'hovered')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('Title','dfd'),
								'param_name' => 'enabled_title',
								'value' => 'title',
								'options' => array(
									'title' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','default','standard','advanced','recent','featured')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('Meta','dfd'),
								'param_name' => 'enabled_meta',
								'value' => 'meta',
								'options' => array(
									'meta' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','standard','default','advanced','recent','featured')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('Excerpt','dfd'),
								'param_name' => 'enabled_excerpt',
								'value' => 'excerpt',
								'options' => array(
									'excerpt' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','standard','default','advanced','recent','featured')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('Read more button','dfd'),
								'param_name' => 'enabled_read_more',
								'value' => 'read_more',
								'options' => array(
									'read_more' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','standard','default','recent','featured', 'hovered')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('Share buttons','dfd'),
								'param_name' => 'enabled_share',
								'value' => 'share',
								'options' => array(
									'share' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','standard','default','recent','featured')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('Comments','dfd'),
								'param_name' => 'enabled_comments',
								'value' => 'comments',
								'options' => array(
									'comments' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','standard','default','advanced','featured','recent')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('likes','dfd'),
								'param_name' => 'enabled_likes',
								'value' => 'likes',
								'options' => array(
									'likes' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','standard','default','advanced','featured','recent')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => esc_html__('Animate comments and likes','dfd'),
								'param_name' => 'enabled_anim_com_like',
								'value' => 'anim_com_like',
								'options' => array(
									'anim_com_like' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','standard','default','advanced','featured','recent')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the sort panel horizontally','dfd').'</span></span>'. esc_html__('Sort panel alignment','dfd'),
								'param_name' => 'sort_alignment',
								'value'		=> 'text-center',
								'options'	=> array(
									esc_attr__('Center','dfd') => 'text-center',
									esc_attr__('Left','dfd') => 'text-left',
									esc_attr__('Right','dfd') => 'text-right'
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'masonry_sort_panel','value' => array('sort')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the title position. This option is availeble only if title is enabled','dfd').'</span></span>'. esc_html__('Heading position','dfd'),
								'param_name' => 'heading_position',
								'value'		=> 'bottom',
								'options'	=> array(
									esc_attr__('Under media','dfd') => 'bottom',
									esc_attr__('Above media','dfd') => 'top',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'style','value' => array('masonry','featured','recent')),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose one the style for the share button','dfd').'</span></span>'.esc_html__('Share style','dfd'),
								'param_name' => 'share_style',
								'value'		=> 'animated',
								'options'	=> array(
									esc_attr__('Animated','dfd') => 'animated',
									esc_attr__('Simple','dfd') => 'simple',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'enabled_share', 'value' => 'share'),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose one the style for the read more ','dfd').'</span></span>'.esc_html__('Read more style','dfd'),
								'param_name' => 'read_more_style',
								'value'		=> 'simple',
								'options'	=> array(
									esc_attr__('Simple','dfd') => 'simple',
									esc_attr__('Shuffle','dfd') => 'chaffle',
									esc_attr__('Slide up','dfd') => 'slide-up',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'enabled_read_more', 'value' => 'read_more'),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type'        => 'textfield',
								'heading'	=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('','dfd').'</span></span>'.esc_html__('Read More Word', 'dfd'),
								'param_name'  => 'read_more_word',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'enabled_read_more', 'value' => 'read_more'),
								'group'      => esc_attr__( 'Content', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__('Title typography', 'dfd'),
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
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
								'param_name'  => 'title_google_fonts',
								'value' => '',
                                'options' => array(
                                    'yes'	=> array(
                                        'yes'	=> esc_attr__('Yes', 'dfd'),
                                        'no'	=> esc_attr__('No', 'dfd')
                                    ),
                                ),
								'group'       => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'       => 'google_fonts',
								'param_name' => 'title_custom_fonts',
								'value'      => '',
								'group'      => esc_attr__( 'Typography', 'dfd' ),
								'settings'   => array(
									'fields' => array(
										'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
										'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
									),
								),
								'dependency' => array(
									'element' => 'title_google_fonts',
									'value'   => 'yes',
								),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Additional News', 'dfd' ) . ' ' . esc_html__( 'Title', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
								'param_name'       => 'add_title_t_heading',
								'group'            => esc_attr__( 'Typography', 'dfd' ),
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								'dependency' => array('element' => 'style','value' => array('featured','recent')),
							),
							array(
								'type'       => 'dfd_font_container_param',
								'heading'    => '',
								'param_name' => 'add_title_font_options',
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
								'dependency' => array('element' => 'style','value' => array('featured','recent')),
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'        => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
								'param_name'  => 'add_title_google_fonts',
								'value' => '',
                                'options' => array(
                                    'yes'	=> array(
                                        'yes'	=> esc_attr__('Yes', 'dfd'),
                                        'no'	=> esc_attr__('No', 'dfd')
                                    ),
                                ),
								'dependency'  => array('element' => 'style','value' => array('featured','recent')),
								'group'       => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'       => 'google_fonts',
								'param_name' => 'add_title_custom_fonts',
								'value'      => '',
								'settings'   => array(
									'fields' => array(
										'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
										'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
									),
								),
								'dependency' => array('element' => 'add_title_google_fonts', 'value' => 'yes'),
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Read more & share block styles', 'dfd'),
								'param_name' => 'readmore_share_heading',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12 no-top-margin',
								'group' => esc_html__( 'Style', 'dfd' )
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Offset before block', 'dfd') . '</span></span>' . esc_html__('Offset before block', 'dfd'),
								'param_name' => 'readmore_share_before_offset',
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group' => esc_html__('Style', 'dfd')
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Border style', 'dfd') . '</span></span>' . esc_html__('Border style', 'dfd'),
								'param_name' => 'readmore_share_border_style',
								'value' => 'dotted',
								'options' => array(
									esc_attr__('None', 'dfd') => '',
									esc_attr__('Solid', 'dfd') => 'solid',
									esc_attr__('Dotted', 'dfd') => 'dotted',
									esc_attr__('Dashed', 'dfd') => 'dashed',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_html__( 'Style', 'dfd' )
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Border width', 'dfd') . '</span></span>' . esc_html__('Border width', 'dfd'),
								'param_name' => 'readmore_share_border_width',
								'dependency' => array('element' => 'readmore_share_border_style', 'not_empty' => true),
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group' => esc_html__('Style', 'dfd')
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Border color', 'dfd') . '</span></span>' . esc_html__('Border color', 'dfd'),
								'param_name' => 'readmore_share_border_color',
								'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
								'dependency' => array('element' => 'readmore_share_border_style', 'not_empty' => true),
								'group' => esc_html__('Style', 'dfd')
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Read more color', 'dfd') . '</span></span>' . esc_html__('Read more color', 'dfd'),
								'param_name' => 'readmore_color',
								'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
								'group' => esc_html__('Style', 'dfd')
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Read more hover color', 'dfd') . '</span></span>' . esc_html__('Read more hover color', 'dfd'),
								'param_name' => 'readmore_hover_color',
								'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
								'group' => esc_html__('Style', 'dfd')
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Share block backgrount', 'dfd') . '</span></span>' . esc_html__('Share block backgrount', 'dfd'),
								'param_name' => 'share_background_color',
								'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
								'dependency' => array('element' => 'share_style', 'value' => 'animated'),
								'group' => esc_html__('Style', 'dfd')
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Share block color', 'dfd') . '</span></span>' . esc_html__('Share block color', 'dfd'),
								'param_name' => 'share_block_color',
								'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
								'dependency' => array('element' => 'share_style', 'value' => 'animated'),
								'group' => esc_html__('Style', 'dfd')
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Share block border width', 'dfd') . '</span></span>' . esc_html__('Share block border width', 'dfd'),
								'param_name' => 'share_border_width',
								'dependency' => array('element' => 'share_style', 'value' => 'animated'),
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group' => esc_html__('Style', 'dfd')
							),
							array(
								'type' => 'colorpicker',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Share block border color', 'dfd') . '</span></span>' . esc_html__('Share block border color', 'dfd'),
								'param_name' => 'share_border_color',
								'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
								'dependency' => array('element' => 'share_border_width', 'not_empty' => true),
								'group' => esc_html__('Style', 'dfd')
							),
						),
					)
				);
			}
		}
		
		function blog_posts_shortcode($atts) {
			$output = $title_html = $data_atts = $article_data_atts = $css_rules = $js_scripts = $extra_class_name = $anim_class = $readmore_share_border_style = '';
			$readmore_share_border_width = $readmore_share_border_color = $readmore_color = $readmore_hover_color = $share_background_color = $share_block_color = '';
			$share_border_width = $share_border_color = $readmore_share_before_offset = $content_full_width = '';
			$sort_panel = false;
			
			$atts = vc_map_get_attributes( 'dfd_blog_posts', $atts );
			extract( $atts );
			
			$uniqid = uniqid('dfd-blog-module-');
			
			if(isset($readmore_share_before_offset) && $readmore_share_before_offset != '') {
				$css_rules .= '#'.$uniqid.' .dfd-read-share {margin-top: '.esc_js($readmore_share_before_offset).'px;}';
			}
			if(isset($readmore_share_border_style) && $readmore_share_border_style != '') {
				$css_rules .= '#'.$uniqid.' .dfd-read-share {border-top-style: '.esc_js($readmore_share_border_style).'; border-bottom-style: '.esc_js($readmore_share_border_style).';}';
			}else{
				$css_rules .= '#'.$uniqid.' .dfd-read-share {border-style: none;}';
			}
			if(isset($readmore_share_border_width) && $readmore_share_border_width != '') {
				$css_rules .= '#'.$uniqid.' .dfd-read-share {border-top-width: '.esc_js($readmore_share_border_width).'px; border-bottom-width: '.esc_js($readmore_share_border_width).'px;}';
			}
			if(isset($readmore_share_border_color) && !empty($readmore_share_border_color)) {
				$css_rules .= '#'.$uniqid.' .dfd-read-share {border-top-color: '.esc_js($readmore_share_border_color).'; border-bottom-color: '.esc_js($readmore_share_border_color).';}';
			}
			if(isset($read_more_style) && $read_more_style != 'slide-up') {
				if(isset($readmore_color) && !empty($readmore_color)) {
					$css_rules .= '#'.$uniqid.' .dfd-read-share .read-more-wrap a:not(.slide-up) {color: '.esc_js($readmore_color).';}';
				}
				if(isset($readmore_hover_color) && !empty($readmore_hover_color)) {
					$css_rules .= '#'.$uniqid.' .dfd-read-share .read-more-wrap a:not(.slide-up):hover {color: '.esc_js($readmore_hover_color).';}';
				}
			}else{
				if(isset($readmore_color) && !empty($readmore_color) && isset($readmore_hover_color) && !empty($readmore_hover_color)) {
					$css_rules .= '#'.$uniqid.' .more-button.slide-up {text-shadow: 0 0 '.esc_js($readmore_color).', 0 16px '.esc_js($readmore_hover_color).';}';
					$css_rules .= '#'.$uniqid.' .more-button.slide-up:hover {text-shadow: 0 -16px '.esc_js($readmore_color).', 0 0 '.esc_js($readmore_hover_color).';}';
				}
			}
			if(isset($share_background_color) && !empty($share_background_color)) {
				$css_rules .= '#'.$uniqid.' .dfd-share-cover .dfd-blog-share-popup-wrap .dfd-share-title {background: '.esc_js($share_background_color).';}';
			}
			if(isset($share_block_color) && !empty($share_block_color)) {
				$css_rules .= '#'.$uniqid.' .dfd-share-cover .dfd-blog-share-popup-wrap .dfd-share-title {color: '.esc_js($share_block_color).';}';
			}
			if(isset($share_border_width) && $share_border_width != '') {
				$css_rules .= '#'.$uniqid.' .dfd-share-cover .dfd-blog-share-popup-wrap .dfd-share-title:before {content: \"\"; border-style: solid; border-width: '.esc_js($share_border_width).'px;}';
				if(isset($share_border_color) && !empty($share_border_color)) {
					$css_rules .= '#'.$uniqid.' .dfd-share-cover .dfd-blog-share-popup-wrap .dfd-share-title:before {border-color: '.esc_js($share_border_color).';}';
				}
			}
			
			$el_class .= ' '.$style;
			
			if(isset($content_full_width) && $content_full_width != '') {
				$el_class .= ' '.$content_full_width;
				//$css_rules .= '#'.$uniqid.'.dfd-blog-loop.hovered .post .entry-content {width: 100%;}';
			}
			
			if(!empty($module_animation)) {
				$anim_class .= ' cr-animate-gen';
				$data_atts .= ' data-animate-item=".cover" data-animate-type="'.esc_attr($module_animation).'" ';
			}
			
			if(isset($style) && !empty($style) && ($style == 'featured' || $style == 'recent')) {
				if(isset($add_post_categories) && !empty($add_post_categories)) {
					$post_categories = $add_post_categories;
				}
				
				if(isset($add_exclude_from_loop) && !empty($add_exclude_from_loop)) {
					$exclude_from_loop = $add_exclude_from_loop;
				}
				
				if(isset($add_posts_to_show) && !empty($add_posts_to_show)) {
					$posts_to_show = $add_posts_to_show;
				}
			}
			
			if($items == 'single' && isset($single_custom_post_item) && !empty($single_custom_post_item)) {
				$args = array(
					'p' => $single_custom_post_item
				);
				$columns = 1;
			} else {
				$sticky = get_option( 'sticky_posts' );

				if (!empty($post_categories)){
					$post_categories_array = explode(',', $post_categories);
					$args = array(
						'posts_per_page' => $posts_to_show,
						'ignore_sticky_posts' => 1,
						'post__not_in' => $sticky,
					);
					if(isset($exclude_from_loop) && $exclude_from_loop == 'exclude') {
						$exclude_cats = array();
						foreach($post_categories_array as $cat) {
							$exclude_cat = get_term_by('slug', $cat, 'category');
							$exclude_cats[] = $exclude_cat->term_id;
						}
						$args['category__not_in'] = $exclude_cats;
					} else {
						$args['tax_query'] = array(
							array(
								'taxonomy' => 'category',
								'field' => 'slug',
								'terms' => $post_categories_array,
							)
						);
					}
				} else {
					$args = array(
						'posts_per_page' => $posts_to_show,
						'ignore_sticky_posts' => 1,
						'post__not_in' => $sticky,
					);
				}
			}
			
			$enable_cat = ($enabled_category == 'category') ? true : false;
			
			$enable_title = ($enabled_title == 'title') ? true : false;
			
			$enable_meta = ($enabled_meta == 'meta') ? true : false;
			
			$enable_excerpt = ($enabled_excerpt == 'excerpt') ? true : false;
			
			$read_more = ($enabled_read_more == 'read_more') ? true : false;
			
			$share = ($enabled_share == 'share') ? true : false;
			
			$comments = ($enabled_comments == 'comments') ? true : false;

			$likes = ($enabled_likes == 'likes')? true : false;
			
			$read_more_word = !empty($read_more_word) ? esc_html($read_more_word) : __('More', 'dfd');

			$media_class = ($enabled_anim_com_like == 'anim_com_like') ? 'comments-like-hover' : '';
			
			$wp_query = new WP_Query($args);
			
			$style_template = locate_template($this->front_template).$style.'.php';
			
			$output .= '<div class="dfd-module-wrapper">';
			
			ob_start();
			if(file_exists($style_template)) {
				include($style_template);
			}
			$output .= ob_get_clean();
			
			if(!empty($css_rules) || !empty($js_scripts)) {
				$output .= '<script type="text/javascript">
								(function($) {';
				if(!empty($css_rules)) {
					$output .= '$("head").append("<style>'.$css_rules.'</style>");';
				}
				
				if(!empty($js_scripts)) {
					$output .= $js_scripts;
				}
				
				$output .= '})(jQuery);
							</script>';
			}
			
			$output .= '</div>';
			
			return $output;
		}
	}
}
if(class_exists('Dfd_Blog_Posts')) {
	$Dfd_Blog_Posts = new Dfd_Blog_Posts;
}