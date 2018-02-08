<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_filter( 'cmb_meta_boxes', 'cmb_post_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_post_metaboxes( array $meta_boxes ) {

	$prefix = 'blog_';
	
	$appear_effects = dfd_module_animation_styles('metaboxes');
	
	$appear_effects[0]['name'] = __('Inherit from theme options', 'dfd');
	
	$meta_boxes[] = array(
		'id'         => 'dfd-single_post_settings',
		'title'      => esc_html__('Single post settings', 'dfd'),
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => esc_html__('Single post settings','dfd'),
				'id' => 'single_post_advanced_heading',
				'type' => 'title',
			),
			array(
				'type'	=> 'select',
				'id'	=> $prefix . 'single_style',
				'name'	=> esc_html__('Single post style', 'dfd'),
                'tooltip_text' => esc_html__('Choose the style for your single post. If you choose inherit from theme options the displaying will correspond to the theme options settings.','dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => esc_attr__('Simple', 'dfd'), 'value' => 'base', ),
					array( 'name' => esc_attr__('Advanced', 'dfd'), 'value' => 'advanced', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'single_stun_header',
				'name'	=> esc_html__('Stunning header', 'dfd'),
                'tooltip_text' => esc_html__('Allows you to enable or disable the Stunning header on the single post. If you choose inherit from theme options the displaying will correspond to the theme options settings.','dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Enable', 'dfd'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Disable', 'dfd'), 'value' => 'off', ),
				),
			),
			array(
				'type' => 'radio_inline_triple',
				'id'	=> 'dfd_post_thumb_enable',
				'name' =>  esc_html__('Post thumb in Stunning header', 'dfd'),
                'tooltip_text' => esc_html__('Allows you to show the post\'s featured image as Stunning header background image.','dfd'),
				'std' => 'disabled',
				'options' => array(
					array('name' => esc_attr__('Disable', 'dfd'),'value' => 'disabled',),
					array('name' => esc_attr__('Enable', 'dfd'),'value' => 'enabled',),
				),
			),
			array(
				'type' => 'radio_inline_triple',
				'id'	=> $prefix . 'single_layout',
				'name' =>  esc_html__('Layout width', 'dfd'),
                'tooltip_text' => esc_html__('Allows you to set your post\'s content width to full width or boxed. If you choose inherit from theme options the displaying will correspond to the theme options settings.','dfd'),
				'std' => '',
				'options' => array(
					array('name' => esc_attr__('Inherit from theme options', 'dfd'),'value' => '',),
					array('name' => esc_attr__('Boxed', 'dfd'),'value' => 'boxed',),
					array('name' => esc_attr__('Full width', 'dfd'),'value' => 'full_width',),
				),
			),
			array(
				'type'	=> 'radio_inline',
				'id'	=> $prefix . 'single_sidebars',
				'name'	=> esc_html__('Sidebar cofiguration', 'dfd'),
                'tooltip_text' => esc_html__('Allows you to choose sidebars and their position. If you choose inherit from theme options the displaying will correspond to the theme options settings.','dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => esc_attr__('No sidebars', 'dfd'), 'value' => '1col-fixed', ),
                    array( 'name' => esc_attr__('Sidebar on left', 'dfd'), 'value' => '2c-l-fixed', ),
                    array( 'name' => esc_attr__('Sidebar on right', 'dfd'), 'value' => '2c-r-fixed', ),
                    //array( 'name' => esc_attr__('2 left sidebars', 'dfd'), 'value' => '3c-l-fixed', ),
                    //array( 'name' => esc_attr__('2 right sidebars', 'dfd'), 'value' => '3c-r-fixed', ),
                    array( 'name' => esc_attr__('Both left and right sidebars', 'dfd'), 'value' => '3c-fixed', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'single_show_title',
				'name'	=> esc_html__('Title', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide the title of the blog post. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => esc_attr__('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => esc_attr__('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'single_show_meta',
				'name'	=> esc_html__('Meta', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide publication date, author\'s name and category of the single blog post. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => esc_attr__('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => esc_attr__('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'single_show_read_more_share',
				'name'	=> esc_html__('Share', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide share under the single post . If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => esc_attr__('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'single_show_fixed_share',
				'name'	=> esc_html__('Fixed Share', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide fixed share on the single post\'s page. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => esc_attr__('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'single_share_style',
				'name'	=> esc_html__('Share style', 'dfd'),
                'tooltip_text'	=> esc_html__('Choose one of the preset share styles. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Animated on hover', 'dfd'), 'value' => 'animated', ),
					array( 'name' => esc_attr__('Simple', 'dfd'), 'value' => 'simple', ),
					//array( 'name' => esc_attr__('Slide up', 'dfd'), 'value' => 'slide-up', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'single_enable_pagination',
				'name'	=> esc_html__('Inside pagination', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to enable or disable the inner pagination style for blog post. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Enable', 'dfd'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Disable', 'dfd'), 'value' => 'off', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'single_pagination_style',
				'name'	=> esc_html__('Inside pagination position', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to select the inner pagination style for blog post. If you choose inherit from theme options the displaying will correspond to the theme options settings. If \'Fixed\' is selected, the next/prev pagination arrows will be displayed on scroll. When \'Top\' is selected the next/prev pagination arrows are displayed on top of the blog post.', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Fixed', 'dfd'), 'value' => 'fixed', ),
                    array( 'name' => esc_attr__('Top', 'dfd'), 'value' => 'top', ),
				),
				'dep_option'    => $prefix . 'single_enable_pagination',
				'dep_values'    => 'on',
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'vc_content_position',
				'name'	=> esc_html__('Content position', 'dfd'),
                'tooltip_text'	=> esc_html__('Display the Visual Composer content above or below the post item. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Before projects', 'dfd'), 'value' => 'top', ),
                    array( 'name' => esc_attr__('After projects', 'dfd'), 'value' => 'bottom', ),
				),
			),
			array(
				'type' => 'checkbox',
				'id'	=> $prefix . 'single_reset_counter',
                'name' => __('Reset views counter', 'dfd'),
                'tooltip_text' => esc_html__('Allows you to reset the conter of the reviews for the blog post.','dfd'),
            ),
		),
	);
	$meta_boxes[] = array(
		'id'         => 'dfd-post_video_custom_fields',
		'title'      => esc_html__('Post Video', 'dfd'),
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'type' => 'title',
				'id' => 'video_post_heading',
				'name' => esc_html__('Video post settings','dfd'),
			),
            array(
                'type'	=> 'text',
                'id'	=> 'post_youtube_video_url',
                'name' => esc_html__('YouTube video ID', 'dfd'),
                'tooltip_text'	=> esc_html__('Look at the URL of the video, and at the end of it, you should see a combination of numbers and letters after an equal sign (=).', 'dfd'),
            ),
            array(
                'type'	=> 'text',
                'id'	=> 'post_vimeo_video_url',
                'name' =>  esc_html__('Vimeo video ID', 'dfd'),
                'tooltip_text'	=> esc_html__('Copy the numeric code that appears at the end of the video URL.', 'dfd'),
            ),
            array(
                'type'	=> 'file',
                'id'	=> 'post_self_hosted_mp4',
                'name' =>  esc_html__('Self hosted video file in mp4 format', 'dfd'),
            ),
            array(
                'type'	=> 'file',
                'id'	=> 'post_self_hosted_webm',
                'name' =>  esc_html__('Self hosted video file in webM format', 'dfd'),
            ),
		),
	);

        
	$meta_boxes[] = array(
		'id'         => 'dfd-post_audio_custom_fields',
		'title'      => esc_html__('Post Audio', 'dfd'),
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'type' => 'title',
				'id' => 'audio_post_heading',
				'name' => esc_html__('Audio post settings','dfd'),
			),
			array(
				'type'	=> 'text',
				'id'	=> 'post_custom_post_audio_url',
				'name' =>  esc_html__('Audio embed code', 'dfd'),
			),
			array(
				'type'	=> 'file',
				'id'	=> 'post_self_hosted_audio',
				'name' =>  esc_html__('Self hosted audio file in mp3 format', 'dfd'),
			),
			array(
				'type'	=> 'textarea_code',
				'id'	=> 'post_soundcloud_audio',
				'name' =>  esc_html__('Soundcloud audio', 'dfd'),
			),
		),
	);
	
	$meta_boxes[] = array(
		'id'         => 'dfd-post_quote_custom_fields',
		'title'      => esc_html__('Post Quote', 'dfd'),
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'type' => 'title',
				'id' => 'quote_post_heading',
				'name' => esc_html__('Quote post settings','dfd'),
			),
			array(
				'type'	=> 'text',
				'id'	=> 'post_custom_author_name',
				'name' =>  esc_html__('Quote author name', 'dfd'),
			),
		),
	);
	
	$meta_boxes[] = array(
		'id'         => 'dfd-blog_settings_box',
		'title'      => esc_html__('Blog page options', 'dfd'),
		'pages'      => array('page'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on' => array(
			'key' => 'page-template',
			'value' => 'tmp-blog.php',
		),
		'fields'     => array(
			array(
				'type' => 'title',
				'id' => 'post_layout_heading',
				'name' => esc_html__('Blog page options','dfd'),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'stun_header',
				'name'	=> esc_html__('Stunning header', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide Stunning header. If you choose inherit from theme options the displaying will correspond to the theme options settings', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Enable', 'dfd'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Disable', 'dfd'), 'value' => 'off', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'cat_tag',
				'name'	=> esc_html__('Categories and tags dropdown', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide categories, tags and author drop-down sorter before post items. If you choose inherit from theme options the displaying will correspond to the theme options settings', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Enable', 'dfd'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Disable', 'dfd'), 'value' => 'off', ),
				),
			),
			array(
				'type' => 'radio_inline_triple',
				'id' => $prefix . 'layout',
				'name' => esc_html__('Blog layout width','dfd'),
                'tooltip_text'	=> esc_html__('Allows you specify the width of the page. If you choose inherit from theme options the displaying will correspond to the theme options settings', 'dfd'),
				'std'  => '1',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Boxed','dfd'), 'value' => 'boxed', ),
					array( 'name' => esc_attr__('Full width','dfd'), 'value' => 'full_width', ),
				),
			),
			array(
				'type'	=> 'radio_inline',
				'id'	=> $prefix . 'sidebars',
				'name'	=> esc_html__('Sidebar cofiguration', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you specify the sidebars to be shown. If you choose inherit from theme options the displaying will correspond to the theme options settings', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => esc_attr__('No sidebars', 'dfd'), 'value' => '1col-fixed', ),
                    array( 'name' => esc_attr__('Sidebar on left', 'dfd'), 'value' => '2c-l-fixed', ),
                    array( 'name' => esc_attr__('Sidebar on right', 'dfd'), 'value' => '2c-r-fixed', ),
                    //array( 'name' => esc_attr__('2 left sidebars', 'dfd'), 'value' => '3c-l-fixed', ),
                    //array( 'name' => esc_attr__('2 right sidebars', 'dfd'), 'value' => '3c-r-fixed', ),
                    array( 'name' => esc_attr__('Both left and right sidebars', 'dfd'), 'value' => '3c-fixed', ),
				),
			),
			array(
				'type' => 'select',
				'id' => $prefix . 'layout_style',
				'name' => esc_html__('Blog layout style','dfd'),
                'tooltip_text'	=> esc_html__('Here you can choose layout style for the whole blog page', 'dfd'),
				'std'  => '',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options','dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Standard','dfd'), 'value' => 'standard', ),
					array( 'name' => esc_attr__('Left image','dfd'), 'value' => 'left-image', ),
					array( 'name' => esc_attr__('Right image','dfd'), 'value' => 'right-image', ),
					array( 'name' => esc_attr__('Masonry','dfd'), 'value' => 'masonry', ),
					array( 'name' => esc_attr__('Grid','dfd'), 'value' => 'fitRows', ),
				),
			),
			array(
				'type' => 'radio_inline_triple',
				'id' => $prefix . 'smart_grid',
				'name' => esc_html__('Smart grid mode','dfd'),
                'tooltip_text'	=> esc_html__('Allows you to enable or disable the smart grid style, all the post content will be displayed over the thumbnail image. If you choose inherit from theme options the displaying will correspond to the theme options settings', 'dfd'),
				'std'  => 'off',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options','dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Enable','dfd'), 'value' => 'on', ),
					array( 'name' => esc_attr__('Disable','dfd'), 'value' => 'off', ),
				),
				'dep_option'    => $prefix . 'layout_style',
				'dep_values'    => 'fitRows',
			),
			array(
				'type' => 'select',
				'id' => $prefix . 'columns',
				'name' => esc_html__('Number of columns','dfd'),
				'std'  => '1',
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options','dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('One column','dfd'), 'value' => '1', ),
					array( 'name' => esc_attr__('Two columns','dfd'), 'value' => '2', ),
					array( 'name' => esc_attr__('Three columns','dfd'), 'value' => '3', ),
					array( 'name' => esc_attr__('Four columns','dfd'), 'value' => '4', ),
					array( 'name' => esc_attr__('Five columns','dfd'), 'value' => '5', ),
					array( 'name' => esc_attr__('Six columns','dfd'), 'value' => '6', ),
				),
				'dep_option'    => $prefix . 'layout_style',
				'dep_values'    => 'masonry,fitRows',
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'sort_panel',
				'name'	=> esc_html__('Sort panel', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to enable or disable post categories sorter above blog post items', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Enable', 'dfd'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Disable', 'dfd'), 'value' => 'off', ),
				),
				'dep_option'    => $prefix . 'layout_style',
				'dep_values'    => 'masonry,fitRows',
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'sort_panel_align',
				'name'	=> esc_html__('Sort panel alignment', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Left', 'dfd'), 'value' => 'text-left', ),
                    array( 'name' => esc_attr__('Right', 'dfd'), 'value' => 'text-right', ),
                    array( 'name' => esc_attr__('Center', 'dfd'), 'value' => 'text-center', ),
				),
				'dep_option'    => $prefix . 'sort_panel',
				'dep_values'    => 'on',
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'show_title',
				'name'	=> esc_html__('Title', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide the title of the blog post. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => esc_attr__('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => esc_attr__('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'show_meta',
				'name'	=> esc_html__('Meta', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide publication date, category, comments counter, likes of the single blog post. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => esc_attr__('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => esc_attr__('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'show_comments',
				'name'	=> __('Comments count', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide the comments count of the single blog post. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'show_likes',
				'name'	=> __('Likes', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide the likes count of the single blog post. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => __('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'type'	=> 'select',
				'id'	=> $prefix . 'comments_likes_style',
				'name'	=> __('Comments and likes style', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to specify the visibility of comments and likes counter. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => __('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => __('Always show', 'dfd'), 'value' => ' ', ),
					array( 'name' => __('Show on hover', 'dfd'), 'value' => 'comments-like-hover', ),
				),
			),
			array(
				'type'	=> 'select',
				'id'	=> $prefix . 'heading_position',
				'name'	=> esc_html__('Heading position', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to specify the position for the title and content. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Under media', 'dfd'), 'value' => 'bottom', ),
                    array( 'name' => esc_attr__('Over media', 'dfd'), 'value' => 'top', ),
				),
				'dep_option'    => $prefix . 'layout_style',
				'dep_values'    => 'standard,masonry,fitRows',
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'show_description',
				'name'	=> esc_html__('Description', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide excerpt of the single blog post. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => esc_attr__('Show', 'dfd'), 'value' => 'on', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'content_alignment',
				'name'	=> esc_html__('Description alignment', 'dfd'),
                'tooltip_text'	=> esc_html__('Choose the description position of the single blog post. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
                    array( 'name' => esc_attr__('Center', 'dfd'), 'value' => 'text-center', ),
                    array( 'name' => esc_attr__('Left', 'dfd'), 'value' => 'text-left', ),
					array( 'name' => esc_attr__('Right', 'dfd'), 'value' => 'text-right', ),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
				'id'	=> $prefix . 'show_read_more_share',
				'name'	=> esc_html__('Read more and Share', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide the Read more and share buttons of the single blog post. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Hide', 'dfd'), 'value' => 'off', ),
					array( 'name' => esc_attr__('Show', 'dfd'), 'value' => 'on', ),
				),
				'dep_option'    => $prefix . 'smart_grid',
				'dep_values'    => ' ,off',
			),
			array(
				'type'	=> 'select',
				'id'	=> $prefix . 'read_more_style',
				'name'	=> esc_html__('Read more style', 'dfd'),
                'tooltip_text'	=> esc_html__('Choose one of the preset styles for the Read more button. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Simple', 'dfd'), 'value' => 'simple', ),
					array( 'name' => esc_attr__('Shuffle', 'dfd'), 'value' => 'chaffle', ),
					array( 'name' => esc_attr__('Slide up', 'dfd'), 'value' => 'slide-up', ),
				),
			),
			array(
				'type'	=> 'select',
				'id'	=> $prefix . 'share_style',
				'name'	=> esc_html__('Share style', 'dfd'),
                'tooltip_text'	=> esc_html__('Choose one of the preset styles for the Share button. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => array(
					array( 'name' => esc_attr__('Inherit from theme options', 'dfd'), 'value' => '', ),
					array( 'name' => esc_attr__('Animated on hover', 'dfd'), 'value' => 'animated', ),
					array( 'name' => esc_attr__('Simple', 'dfd'), 'value' => 'simple', ),
					//array( 'name' => esc_attr__('Slide up', 'dfd'), 'value' => 'slide-up', ),
				),
			),
			array(
				'type' => 'text',
				'id' => $prefix . 'works_per_page',
				'name' => esc_html__('Works per page', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to enter the number of items to be displayed on blog page.', 'dfd'),
				'std' => '',
				'save_id' => false, // save ID using true
			),
			array(
				'type' => 'text',
				'id' => $prefix . 'items_offset',
				'name' => esc_html__('Items offset in px', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to add space between single posts.', 'dfd'),
				'std' => '',
				'save_id' => false, // save ID using true
			),
			array(
                'type' => 'taxonomy_multicheck',
                'id'	=> $prefix . 'category',
                'name' => esc_html__('Blog Category','dfd'),
                'taxonomy' => 'category',
            ),
			array(
				'type'	=> 'select',
				'id'	=> $prefix . 'item_appear_effect',
				'name'	=> esc_html__('Items appear effect', 'dfd'),
                'tooltip_text'	=> esc_html__('Allows you to set the unique appear effect for the blog post items. If you choose inherit from theme options the displaying will correspond to the theme options settings.', 'dfd'),
				'options' => $appear_effects,
			),
		),
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function dfd_post_add_custom_box() {

    $screens = array( 'post' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'dfd_post_gallery',
            esc_html__( 'Images gallery', 'dfd' ),
            'dfd_post_inner_custom_box',
            $screen,
            'side'
        );
    }
}
add_action( 'add_meta_boxes', 'dfd_post_add_custom_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function dfd_post_inner_custom_box( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'dfd_post_inner_custom_box', 'dfd_post_inner_custom_box_nonce' );


    ?>

    <div id="my_post_images_container">
        <ul class="my_post_images">
            <?php
            if ( metadata_exists( 'post', $post->ID, '_my_post_image_gallery' ) ) {
                $my_post_image_gallery = get_post_meta( $post->ID, '_my_post_image_gallery', true );
            } else {
                // Backwards compat
                $attachment_ids = get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' );
                $attachment_ids = array_diff( $attachment_ids, array( get_post_thumbnail_id() ) );
                $my_post_image_gallery = implode( ',', $attachment_ids );
            }

            $attachments = array_filter( explode( ',', $my_post_image_gallery ) );

            if ( $attachments ) {
                foreach ( $attachments as $attachment_id ) {
                    echo '<li class="image" data-attachment_id="' . esc_attr($attachment_id) . '">
								' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '
								<ul class="actions">
									<li><a href="#" class="delete tips" data-tip="' . esc_attr__( 'Delete image', 'dfd' ) . '">' . esc_attr__( 'Delete', 'dfd' ) . '</a></li>
								</ul>
							</li>';
                }
			} ?>
        </ul>

        <input type="hidden" id="my_post_image_gallery" name="my_post_image_gallery" value="<?php echo esc_attr( $my_post_image_gallery ); ?>" />

    </div>
    <p class="add_my_post_images hide-if-no-js">
        <a class="button" href="#"><?php _e( 'Add gallery images', 'dfd' ); ?></a>
    </p>
    <script type="text/javascript">
        jQuery(document).ready(function($){
			"use strict";
            // Uploading files
            var my_post_gallery_frame;
            var $image_gallery_ids = $('#my_post_image_gallery');
            var $my_post_images = $('#my_post_images_container ul.my_post_images');

            jQuery('.add_my_post_images').on( 'click', 'a', function( event ) {

                var $el = $(this);
                var attachment_ids = $image_gallery_ids.val();

                event.preventDefault();

                // If the media frame already exists, reopen it.
                if ( my_post_gallery_frame ) {
                    my_post_gallery_frame.open();
                    return;
                }

                // Create the media frame.
                my_post_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: '<?php _e( 'Add Images to post Gallery', 'dfd' ); ?>',
                    button: {
                        text: '<?php _e( 'Add to gallery', 'dfd' ); ?>'
                    },
                    multiple: true
                });

                // When an image is selected, run a callback.
                my_post_gallery_frame.on( 'select', function() {

                    var selection = my_post_gallery_frame.state().get('selection');

                    selection.map( function( attachment ) {

                        attachment = attachment.toJSON();

                        if ( attachment.id ) {
                            attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;

                            $my_post_images.append('\
									<li class="image" data-attachment_id="' + attachment.id + '">\
										<img src="' + attachment.url + '" />\
										<ul class="actions">\
											<li><a href="#" class="delete" title="<?php _e( 'Delete image', 'dfd' ); ?>"><?php _e( 'Delete', 'dfd' ); ?></a></li>\
										</ul>\
									</li>');
                        }

                    } );

                    $image_gallery_ids.val( attachment_ids );
                });

                // Finally, open the modal.
                my_post_gallery_frame.open();
            });

            // Image ordering
            $my_post_images.sortable({
                items: 'li.image',
                cursor: 'move',
                scrollSensitivity:40,
                forcePlaceholderSize: true,
                forceHelperSize: false,
                helper: 'clone',
                opacity: 0.65,
                placeholder: 'wc-metabox-sortable-placeholder',
                start:function(event,ui){
                    ui.item.css('background-color','#f6f6f6');
                },
                stop:function(event,ui){
                    ui.item.removeAttr('style');
                },
                update: function(event, ui) {
                    var attachment_ids = '';

                    $('#my_post_images_container ul li.image').css('cursor','default').each(function() {
                        var attachment_id = jQuery(this).attr( 'data-attachment_id' );
                        attachment_ids = attachment_ids + attachment_id + ',';
                    });

                    $image_gallery_ids.val( attachment_ids );
                }
            });

            // Remove images
            $('#my_post_images_container').on( 'click', 'a.delete', function() {

                $(this).closest('li.image').remove();

                var attachment_ids = '';

                $('#my_post_images_container ul li.image').css('cursor','default').each(function() {
                    var attachment_id = jQuery(this).attr( 'data-attachment_id' );
                    attachment_ids = attachment_ids + attachment_id + ',';
                });

                $image_gallery_ids.val( attachment_ids );

                return false;
            } );

        });
    </script>


<?php

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function dfd_post_save_postdata( $post_id ) {

    /*
     * We need to verify this came from the our screen and with proper authorization,
     * because save_post can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['dfd_post_inner_custom_box_nonce'] ) )
        return $post_id;

    $nonce = $_POST['dfd_post_inner_custom_box_nonce'];

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'dfd_post_inner_custom_box' ) )
        return $post_id;

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;

    // Check the user's permissions.
    if ( 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) )
            return $post_id;

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) )
            return $post_id;
    }

    /* OK, its safe for us to save the data now. */

    // Sanitize user input.
    $mydata = $_POST['my_post_image_gallery'];

    // Update the meta field in the database.
    update_post_meta( $post_id, '_my_post_image_gallery', $mydata );
}
add_action( 'save_post', 'dfd_post_save_postdata' );