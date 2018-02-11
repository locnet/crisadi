<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Team member
*/

if ( ! class_exists( 'Dfd_Team_Member' ) ) {

	class Dfd_Team_Member {

		public $social_networks = array(
			'deviantart'         => array('name'=>'Deviantart','icon'=>'soc_icon-deviantart'),
			'digg'               => array('name'=>'Digg','icon'=>'soc_icon-digg'),
			'dribbble'           => array('name'=>'Dribbble','icon'=>'soc_icon-dribbble'),
			'dropbox'            => array('name'=>'Dropbox','icon'=>'soc_icon-dropbox'),
			'evernote'           => array('name'=>'Evernote','icon'=>'soc_icon-evernote'),
			'facebook'           => array('name'=>'Facebook','icon'=>'soc_icon-facebook'),
			'flickr'             => array('name'=>'Flickr','icon'=>'soc_icon-flickr'),
			'foursquare'         => array('name'=>'Foursquare','icon'=>'soc_icon-foursquare_2'),
			'google'             => array('name'=>'Google','icon'=>'soc_icon-google__x2B_'),
			'instagram'          => array('name'=>'Instagram','icon'=>'soc_icon-instagram'),
			'last_fm'            => array('name'=>'Last FM','icon'=>'soc_icon-last_fm'),
			'linkedin'           => array('name'=>'LinkedIN','icon'=>'soc_icon-linkedin'),
			'livejournal'        => array('name'=>'Livejournal','icon'=>'soc_icon-livejournal'),
			'picasa'             => array('name'=>'Picasa','icon'=>'soc_icon-picasa'),
			'pinterest'          => array('name'=>'Pinterest','icon'=>'soc_icon-pinterest'),
			'rss'                => array('name'=>'RSS','icon'=>'soc_icon-rss'),
			'tumblr'             => array('name'=>'Tumblr','icon'=>'soc_icon-tumblr'),
			'twitter'            => array('name'=>'Twitter','icon'=>'soc_icon-twitter-3'),
			'vimeo'              => array('name'=>'Vimeo','icon'=>'soc_icon-vimeo'),
			'wordpress'          => array('name'=>'Wordpress','icon'=>'soc_icon-wordpress'),
			'youtube'            => array('name'=>'Youtube','icon'=>'soc_icon-youtube'),
			'px_500'             => array('name'=>'500 px','icon'=>'dfd-added-font-icon-px-icon'),
			'mail'               => array('name'=>'Mail','icon'=>'dfd-added-font-icon-vb'),
			'viewbug'            => array('name'=>'ViewBug','icon'=>'soc_icon-mail'),
			'vkontakte'          => array('name'=>'VKontakte','icon'=>'soc_icon-rus-vk-02'),
			'xing'               => array('name'=>'Xing','icon'=>'dfd-added-font-icon-b_Xing-icon_bl'),
			'spotify'            => array('name'=>'Spotify','icon'=>'dfd-added-font-icon-c_spotify-512-black'),
			'houzz'              => array('name'=>'Houzz','icon'=>'dfd-added-font-icon-houzz-dark-icon'),
			'skype'              => array('name'=>'Skype','icon'=>'dfd-added-font-icon-skype'),
			'slideshare'         => array('name'=>'Slideshare','icon'=>'dfd-added-font-icon-slideshare'),
			'bandcamp'           => array('name'=>'Bandcamp','icon'=>'dfd-added-font-icon-bandcamp-logo'),
			'soundcloud'         => array('name'=>'Soundcloud','icon'=>'dfd-added-font-icon-soundcloud-logo'),
			'meerkat'            => array('name'=>'Meerkat','icon'=>'dfd-added-font-icon-Meerkat-color'),
			'periscope'          => array('name'=>'Periscope','icon'=>'dfd-added-font-icon-periscope-logo'),
			'snapchat'           => array('name'=>'Snapchat','icon'=>'dfd-added-font-icon-Snapchat-logo'),
			'thecity'            => array('name'=>'The City','icon'=>'dfd-added-font-icon-the-city'),
			'behance'            => array('name'=>'Behance','icon'=>'soc_icon-behance'),
			'microsoft_pinpoint' => array('name'=>'Microsoft Pinpoint','icon'=>'dfd-added-font-icon-pinpoint'),
			'viadeo'             => array('name'=>'Viadeo','icon'=>'dfd-added-font-icon-viadeo'),
		);

		function __construct() {
			add_action( 'init', array( &$this, 'dfd_team_member_init' ) );
			add_shortcode( 'new_team_member', array( &$this, 'dfd_team_member_form' ) );
		}

		function generate_soc_networks( $soc_networks ) {

			$vc_map_socnetworks = array();

			foreach ( $soc_networks as $key => $value ) {
				$vc_map_socnetworks[] = array(
					"type"       => "textfield",
					"heading"    => $value['name'],
					"param_name" => $key,
					"group"      => esc_html__( 'Soc accounts' ),
				);
			}

			return $vc_map_socnetworks;
		}
		function dfd_team_member_init() {

			$delim_options = _crum_vc_delim_settings();
			unset( $delim_options[0] );

			$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/team_member/';

			if ( function_exists( 'vc_map' ) ) {
				vc_map(
					array(
						'name'        => esc_html__( 'Team member', 'dfd' ),
						'base'        => 'new_team_member',
						'icon'        => 'new_team_member dfd_shortcode',
						'category'    => esc_html__( 'Ronneby 2.0', 'dfd' ),
						'description' => esc_html__( 'Info about your team', 'dfd' ),
						'params'      => array_merge(
							array(
								array(
									'heading'     => esc_html__( 'Style', 'dfd' ),
									'type'        => 'radio_image_select',
									'param_name'  => 'main_layout',
									'simple_mode' => false,
									'options'     => array(
										'layout-01'	=> array(
											'tooltip'	=> esc_attr__('Classic','dfd'),
											'src'		=> $module_images . 'layout-1.png'
										),
										'layout-02'	=> array(
											'tooltip'	=> esc_attr__('Classic left','dfd'),
											'src'		=> $module_images . 'layout-2.png'
										),
										'layout-03'	=> array(
											'tooltip'	=> esc_attr__('Classic right','dfd'),
											'src'		=> $module_images . 'layout-3.png'
										),
										'layout-04'	=> array(
											'tooltip'	=> esc_attr__('Classic top','dfd'),
											'src'		=> $module_images . 'layout-4.png'
										),
										'layout-05'	=> array(
											'tooltip'	=> esc_attr__('Classic overlay','dfd'),
											'src'		=> $module_images . 'layout-5.png'
										),
										'layout-06'	=> array(
											'tooltip'	=> esc_attr__('Hovered slide','dfd'),
											'src'		=> $module_images . 'layout-6.png'
										),
										'layout-07'	=> array(
											'tooltip'	=> esc_attr__('Hovered bottom','dfd'),
											'src'		=> $module_images . 'layout-7.png'
										),
										'layout-08'	=> array(
											'tooltip'	=> esc_attr__('Hovered description','dfd'),
											'src'		=> $module_images . 'layout-8.png'
										),
										'layout-09'	=> array(
											'tooltip'	=> esc_attr__('Hovered overlay','dfd'),
											'src'		=> $module_images . 'layout-9.png'
										),
										'layout-10'	=> array(
											'tooltip'	=> esc_attr__('Hovered thumbnail','dfd'),
											'src'		=> $module_images . 'layout-10.png'
										),
										'layout-11'	=> array(
											'tooltip'	=> esc_attr__('Hovered title & icons','dfd'),
											'src'		=> $module_images . 'layout-11.png'
										),
									),
								),
								array(
									'type'       => 'dropdown',
									'heading'	  => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd').'</span></span>'.esc_html__('Animation', 'dfd'),
									'param_name' => 'module_animation',
									'value'      => dfd_module_animation_styles(),
								),
								array(
									'type'        => 'textfield',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
									'param_name'  => 'el_class',
								),
								array(
									'type'             => 'attach_image',
									'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select image from the media library','dfd').'</span></span>'.esc_html__('Image', 'dfd'),
									'param_name'       => 'team_member_photo',
									'value'            => '',
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
									'group'            => esc_html__( 'Member info', 'dfd' ),
								),
								array(
									'type'             => 'number',
									'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the width for the testimonial thumbnail','dfd').'</span></span>'.esc_html__('Width', 'dfd'),
									'param_name'       => 'team_member_img_width',
									'min'              => 0,
									'value'            => 400,
									'edit_field_class' => 'vc_column vc_col-sm-4 no-top-padding dfd-number-wrap crum_vc',
									'group'            => esc_html__( 'Member info', 'dfd' ),
								),
								array(
									'type'             => 'number',
									'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the height for the testimonial thumbnail','dfd').'</span></span>'.esc_html__('Height', 'dfd'),
									'param_name'       => 'team_member_img_height',
									'min'              => 0,
									'value'            => 400,
									'edit_field_class' => 'vc_column vc_col-sm-4 no-top-padding dfd-number-wrap crum_vc',
									'group'            => esc_html__( 'Member info', 'dfd' ),
								),
								array(
									'type'        => 'textfield',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the name of your team member','dfd').'</span></span>'.esc_html__('Title', 'dfd'),
									'param_name'  => 'team_member_name',
									'admin_label' => true,
									'group'       => esc_html__( 'Member info', 'dfd' ),
								),
								array(
									'type'        => 'textfield',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the position for your team member','dfd').'</span></span>'.esc_html__('Subtitle', 'dfd'),
									'param_name'  => 'team_member_job_position',
									'admin_label' => true,
									'group'       => esc_html__( 'Member info', 'dfd' ),
								),
								array(
									'type'        => 'textarea',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('The main information about your team member','dfd').'</span></span>'.esc_html__('Description', 'dfd'),
									'param_name'  => 'team_member_description',
									'group'       => esc_html__( 'Member info', 'dfd' ),
								),
								array(
									'type'       => 'dfd_single_checkbox',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the custom link or choose the existing page for the team member','dfd').'</span></span>'.esc_html__('Team member custom link', 'dfd'),
									'param_name' => 'enable_custom_link',
									'options'			=> array(
										'yes'				=> array(
											'yes'				=> esc_attr__('Yes', 'dfd'),
											'no'				=> esc_attr__('No', 'dfd'),
										),
									),
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'group'      => esc_html__( 'Member info', 'dfd' ),
								),
								array(
									'type'       => 'dfd_radio_advanced',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select where the link should be applied','dfd').'</span></span>'.esc_html__('Apply link to', 'dfd'),
									'param_name' => 'apply_link_to',
									'value'=> 'image-link',
									'options' => array(
										esc_html__( 'Team member image', 'dfd' )    => 'image-link',
										esc_html__( 'Title', 'dfd' )                => 'title-link',
										esc_html__( 'Both title and image', 'dfd' ) => 'both-title-and-image',
									),
									'dependency' => array( 'element' => 'enable_custom_link', 'not_empty' => true ),
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'group'      => esc_html__( 'Member info', 'dfd' ),
								),
								array(
									'type'       => 'vc_link',
									'heading'    => esc_html__( 'Custom link url', 'dfd' ),
									'param_name' => 'custtom_link_url',
									'dependency' => array( 'element' => 'enable_custom_link', 'not_empty' => true ),
									'group'      => esc_html__( 'Member info', 'dfd' ),
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Title typography', 'dfd' ),
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
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd').'</span></span>'.esc_html__('Custom font family', 'dfd'),
									'param_name'  => 'use_google_fonts',
									'options'	  => array(
										'yes'		  => array(
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
									'dependency' => array('element' => 'use_google_fonts', 'value' => 'yes'),
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Subtitle typography', 'dfd' ),
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
									'text'             => esc_html__( 'Content typography', 'dfd' ),
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
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Image options', 'dfd' ),
									'param_name'       => 'thumb_t_heading',
									'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
									'group'       => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'       => 'number',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the border radius for the team member\'s thumbnail','dfd').'</span></span>'.esc_html__('Border radius', 'dfd'),
									'param_name' => 'thumb_radius',
									'min'        => 0,
									'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
									'group'      => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'       => 'dfd_single_checkbox',
									'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the shadow for the team member\'s thumbnail','dfd').'</span></span>'.esc_html__('Shadow', 'dfd'),
									'param_name' => 'shadow',
									'value'      => '',
									'edit_field_class' => 'vc_column vc_col-sm-6',
									'options'    => array(
										'show' => array(
											'on'    => esc_html__( 'Yes', 'dfd' ),
											'off'   => esc_html__( 'No', 'dfd' ),
										),
									),
									'group'      => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'       => 'dfd_radio_advanced',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set when the shadow will be visible','dfd').'</span></span>'.esc_html__('Shadow visibility', 'dfd'),
									'param_name' => 'shadow_style',
									'value'      => 'permanent',
									'options'      => array(
										esc_html__( 'Permanent', 'dfd' ) => 'permanent',
										esc_html__( 'On hover', 'dfd' )  => 'hover',
									),
									'group'      => esc_html__( 'Style', 'dfd' ),
									'dependency' => array('element' => 'shadow', 'value' => array( 'show' )),
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Overlay options', 'dfd' ),
									'param_name'       => 'subtitle_h_heading',
									'group'            => esc_html__( 'Style', 'dfd' ),
									'dependency' => array('element' => 'main_layout', 'value' => array('layout-05', 'layout-06', 'layout-07', 'layout-08', 'layout-09', 'layout-10', 'layout-11')),
									'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								),
								array(
									'type'             => 'colorpicker',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the start color for the gradient overlay. The default value is transparent','dfd').'</span></span>'. esc_html__( 'Start color', 'dfd' ),
									'param_name'       => 'gradient_color1',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'dependency' => array('element' => 'main_layout', 'value' => array('layout-05', 'layout-06', 'layout-07', 'layout-08', 'layout-09', 'layout-10', 'layout-11')),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'colorpicker',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the end color for the gradient overlay. The default value is transparent','dfd').'</span></span>'. esc_html__( 'End color', 'dfd' ),
									'param_name'       => 'gradient_color2',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
									'dependency' => array('element' => 'main_layout', 'value' => array('layout-05', 'layout-06', 'layout-07', 'layout-08', 'layout-09', 'layout-10', 'layout-11')),
									'group'            => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'       => 'dfd_single_checkbox',
									'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to display full width for the overlay background and content according to the container width','dfd').'</span></span>'.esc_html__('Full width overlay','dfd'),
									'param_name' => 'full_width_overlay',
									'options'    => array(
										'yes' => array(
											'on'    => esc_html__( 'Yes', 'dfd' ),
											'off'   => esc_html__( 'No', 'dfd' ),
										),
									),
									'edit_field_class' => 'vc_column vc_col-sm-6',
									'dependency' => array('element' => 'main_layout', 'value' => array('layout-11')),
									'group'      => esc_html__( 'Style', 'dfd' ),
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Delimiter settings', 'dfd' ),
									'param_name'       => 'subtitle_d_heading',
									'group'            => esc_html__( 'Style', 'dfd' ),
									'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
								),
							),
							$delim_options,
							array(
								array(
									'type'       => 'dropdown',
									'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose one of the preset icon\'s hover styles from the list','dfd').'</span></span>'. __( 'Icon hover style', 'dfd' ),
									'param_name' => 'soc_icons_hover',
									'value'      => dfd_soc_icons_hover_composer(),
									'group'      => esc_html__( 'Soc accounts' ),
								),
							),
							$this->generate_soc_networks( $this->social_networks )

						)
					)
				);
			}

		}

		function dfd_team_member_form( $atts, $content = null ) {

			$main_layout = $image_style = $thumb_radius = $gradient_color1 = $gradient_color2 = $soc_icons_hover = $output = $gradient_style = $shadow_class ='';
			$team_member_photo  = $team_member_img_width = $team_member_img_height = $team_member_name = $team_member_job_position = $team_member_description  = '';
			$line_width = $line_hide = $line_border = $line_color = $el_class = $title_font_options = $subtitle_font_options = $overlay_output = $font_options = '';
			$use_google_fonts = $custom_fonts = $module_animation = $shadow = $shadow_style = $delimiter_html = $delimiter_style = $enable_custom_link = '';
			$apply_link_to = $custtom_link_url = $image_output = $title_html = $subtitle_html = $content_output = $content_css = $full_width_overlay = '';
			$animation_data = '';

			$soc_network_options = array();

			foreach ( $this->social_networks as $key => $value ) {
				$soc_network_options[ $key ] = '';
			}

			$atts = vc_map_get_attributes('new_team_member', $atts);
			extract($atts);

			if ( ! ( $module_animation == '' ) ) {
				$el_class       .= ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			if(isset($full_width_overlay) && $full_width_overlay == 'yes') {
				$el_class .= ' team-full-width-owerlay';
			}

			/**************************
			 * Social icons.
			 *************************/

			if($enable_custom_link) {
				$link = vc_build_link($custtom_link_url);
				$link_title = !empty($link['title']) ? 'title="'.esc_attr($link['title']).'"' : '';
				$link_target = !empty($link['target']) ? 'target="'.esc_attr(preg_replace('/\s+/', '', $link['target'])).'"' : '';
			} else {
				$link = array();
				$link_title = $link_target = '';
			}

			$soc_icons_hover_style = 'dfd-soc-icons-hover-style-' . esc_attr( $soc_icons_hover );

			$soc_networks_output = '<div class="widget soc-icons ' . $soc_icons_hover_style . '">';

			foreach ( $this->social_networks as $soc_network => $soc_name ) {
				if ( isset( ${$soc_network} ) && ! empty( ${$soc_network} ) ) {
					$soc_networks_output .= '<a href="' . ${$soc_network} . '" class="'.esc_attr($soc_name['icon']).'" target="_blank"><span class="line-top-left '.esc_attr($soc_name['icon']).'"></span><span class="line-top-center '.esc_attr($soc_name['icon']).'"></span><span class="line-top-right '.esc_attr($soc_name['icon']).'"></span><span class="line-bottom-left '.esc_attr($soc_name['icon']).'"></span><span class="line-bottom-center '.esc_attr($soc_name['icon']).'"></span><span class="line-bottom-right '.esc_attr($soc_name['icon']).'"></span><i class="'.esc_attr($soc_name['icon']).'"></i></a>';
				}
			}

			$soc_networks_output .= '</div>';

			/**************************
			 * Title / Subtitle HTML.
			 *************************/
			if ( ! empty( $team_member_name ) ) {
				// Title name HTML.
				$title_options = _crum_parse_text_shortcode_params( $title_font_options, 'feature-title', $use_google_fonts, $custom_fonts );
				$title_html    = '<'.$title_options['tag'].' class="team-member-title ' . $title_options['class'] . '" ' . $title_options['style'] . '>';
				if($enable_custom_link && ('title-link' === $apply_link_to) || $enable_custom_link && ('both-title-and-image' === $apply_link_to)){
					$title_html    .= '<a href="'.$link['url'].'" '.$link_title.' '.$link_target.'>';
					$title_html    .= esc_html( $team_member_name );
					$title_html    .= '</a>';
				} else {
					$title_html    .=  esc_html( $team_member_name );
				}

				$title_html    .= '</'.$title_options['tag'].'>';
			}

			// Subtitle HTML.
			if ( ! empty( $team_member_job_position ) ) {
				$subtitle_options = _crum_parse_text_shortcode_params( $subtitle_font_options, 'subtitle' );
				$subtitle_html    = '<'.$subtitle_options['tag'].' class="team-member-subtitle ' . $subtitle_options['class'] . '" ' . $subtitle_options['style'] . '>' . esc_html( $team_member_job_position ) . '</'.$subtitle_options['tag'].'>';
			}

			/**************************
			 * Delimiter HTML.
			 *************************/

			if ( $line_width != '' || $line_border != '' || $line_color ) {
				$delimiter_style .= 'style="';
				if (isset($line_width) && $line_width != '' ) {
					$delimiter_style .= 'width:' . $line_width . 'px;';
				}
				if (isset($line_border) && $line_border != '') {
					$delimiter_style .= 'border-width:' . $line_border . 'px;';
				}
				if (isset($line_color) && !empty($line_color)) {
					$delimiter_style .= 'border-color:' . $line_color;
				}
				$delimiter_style .= '"';
			}
			if ( 'yes' !== $line_hide ) {
				$delimiter_html .= '<div class="wrap-delimiter"><div class="delimiter" ' . $delimiter_style . '></div></div>';
			}

			/**************************
			 * Other Block options.
			 *************************/

			if ( 'show' === $shadow )  {
				if (  'hover' === $shadow_style  ) {
					$shadow_class .= ' module-shadow-hover ';
				} else {
					$shadow_class .= ' module-shadow-permanent ';
				}
			}

			//content HTML
			$content_font_options = _crum_parse_text_shortcode_params( $font_options, '' );
			$content_style        = $content_font_options['style'];
			$content_output       = '<div class="team-member-description" ' . $content_style . '>' . $team_member_description . '</div>';

			if( !empty($thumb_radius)){
				$image_style .= 'style="border-radius:'.$thumb_radius.'px"';
			}

			if ( isset( $team_member_photo ) && ! ( $team_member_photo == '' ) ) {
				$image_src    = wp_get_attachment_image_src( $team_member_photo, 'large' );
				$image_url    = dfd_aq_resize( $image_src[0], $team_member_img_width, $team_member_img_height, true, true, true );
				if(!$image_url) {
					$image_url = $image_src[0];
				}
				$attr = Dfd_Theme_Helpers::get_image_attrs($image_src[0], $team_member_photo, $team_member_img_width, $team_member_img_height);
				
				global $dfd_ronneby;
				if(isset($dfd_ronneby['enable_images_lazy_load']) && $dfd_ronneby['enable_images_lazy_load'] == 'on') {
					$el_class .= ' dfd-img-lazy-load';
					$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $team_member_img_width $team_member_img_height'%2F%3E";
					$image_output = '<img src="'.$loading_img_src.'" data-src="' . esc_url( $image_url ) . '" '.$attr.' width="'.esc_attr($team_member_img_width).'" height="'.esc_attr($team_member_img_height).'" class="team-member-photo '.$shadow_class.'" '.$image_style.' />';
				} else {
					$image_output = '<img src="' . esc_url( $image_url ) . '" '.$attr.' class="team-member-photo '.$shadow_class.'" '.$image_style.' />';
				}
			}

			if(! empty( $gradient_color1 ) || !empty( $gradient_color2 ) || !empty($thumb_radius)){

				$gradient_style .= 'style="';

				if ( isset( $gradient_color1 ) && ! empty( $gradient_color1 ) && isset( $gradient_color2 ) && ! empty( $gradient_color2 ) ) {
					$gradient_style .= 'background: linear-gradient(to bottom, ' . $gradient_color1 . ', ' . $gradient_color2 . ');';
				} elseif ( isset( $gradient_color1 ) && ! empty( $gradient_color1 ) || isset( $gradient_color2 ) && ! empty( $gradient_color2 ) ) {
					if ( isset( $gradient_color1 ) && ! empty( $gradient_color1 ) ) {
						$gradient_style .= 'background-color:' . $gradient_color1 . ';';
					} elseif ( isset( $gradient_color2 ) && ! empty( $gradient_color2 ) ) {
						$gradient_style .= 'background-color:' . $gradient_color2 . ';';
					}
				}
				if( !empty($thumb_radius)){
					$gradient_style .= ' border-radius:'.$thumb_radius.'px;';
				}

				$gradient_style .= '"';
			}

			if ( 'layout-06' === $main_layout || 'layout-09' === $main_layout || 'layout-10' === $main_layout || 'layout-05' === $main_layout || 'layout-07' === $main_layout || 'layout-11' === $main_layout ) {
				$overlay_output .= '<div class="overlay" ' . $gradient_style . '></div>';
			}
			if($main_layout === 'layout-11') {
				if (isset($team_member_img_width) && !empty($team_member_img_width)) {
					$content_css .= 'style="max-width:'.$team_member_img_width.'px;"';
				}
			}

			if($enable_custom_link && ('image-link' === $apply_link_to) || $enable_custom_link && ('both-title-and-image' === $apply_link_to)){
				$overlay_output .= '<a class="image-custom-link" href="'.$link['url'].'" '.$link_title.' '.$link_target.'></a>';
			}


			$output .= '<div class="dfd-team-member ' . $main_layout . ' ' . $el_class . '" ' . $animation_data . '>';

			if ( 'layout-05' === $main_layout || 'layout-06' === $main_layout || 'layout-07' === $main_layout ) {

				$output .= '<div class="image-wrap">';
				$output .= $image_output;
				$output .= $overlay_output;
				$output .= '<div class="title-wrap">';
				$output .= $title_html;
				$output .= $subtitle_html;
				$output .= $delimiter_html;
				$output .= '</div>';
				$output .= '</div>';
				$output .= '<div class="content-wrap">';
				$output .= $content_output;
				$output .= $soc_networks_output;
				$output .= '</div>';

			} elseif ( 'layout-04' === $main_layout || 'layout-08' === $main_layout ) {
				$output .= '<div class="title-wrap">';
				$output .= $title_html;
				$output .= $subtitle_html;
				$output .= $delimiter_html;
				$output .= '</div>';
				$output .= '<div class="image-wrap">';
				$output .= $image_output;
				$output .= $overlay_output;
				$output .= '</div>';
				$output .= '<div class="content-wrap">';
				$output .= $content_output;
				$output .= $soc_networks_output;
				$output .= '</div>';

			} elseif ( 'layout-09' === $main_layout ) {
				$output .= '<div class="image-wrap">';
				$output .= $image_output;
				$output .= $overlay_output;
				$output .= '<div class="ovh">';
				$output .= '<div class="title-wrap">';
				$output .= $title_html;
				$output .= $subtitle_html;
				$output .= $delimiter_html;
				$output .= $content_output;
				$output .= '</div>';
				$output .= '<div class="content-wrap">';
				$output .= '<div class="title-wrap">';
				$output .= $title_html;
				$output .= $subtitle_html;
				$output .= $delimiter_html;
				$output .= '</div>';
				$output .= $content_output;
				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '<div class="soc-icons-wrap">';
				$output .= $soc_networks_output;
				$output .= '</div>';

			}
			elseif ( 'layout-10' === $main_layout ) {
				$output .= '<div class="image-wrap">';
				$output .= $image_output;
				$output .= $overlay_output;
				$output .= '<div class="title-wrap">';
				$output .= $title_html;
				$output .= $subtitle_html;
				$output .= $delimiter_html;
				$output .= '</div>';
				$output .= '</div>';
				$output .= '<div class="content-wrap">';
				$output .= $content_output;
				$output .= $soc_networks_output;
				$output .= '</div>';

			} elseif ( 'layout-11' === $main_layout ) {
				$output .= '<div class="image-wrap">';
					$output .= $image_output;
					$output .= $overlay_output;
					$output .= '<div class="soc-icon-wrap">';
						$output .= $soc_networks_output;
					$output .= '</div>';
					$output .= '<div class="title-wrap">';
						$output .= $title_html;
						$output .= $subtitle_html;
						$output .= $delimiter_html;
					$output .= '</div>';
				$output .= '</div>';
				$output .= '<div class="content-wrap" '.$content_css.'>';
					$output .= $content_output;
				$output .= '</div>';

			} else {
				$output .= '<div class="image-wrap">';
				$output .= $image_output;
				$output .= $overlay_output;
				$output .= '</div>';
				$output .= '<div class="content-wrap">';
				$output .= '<div class="title-wrap">';
				$output .= $title_html;
				$output .= $subtitle_html;
				$output .= $delimiter_html;
				$output .= '</div>';
				$output .= $content_output;
				$output .= $soc_networks_output;
				$output .= '</div>';
			}

			$output .= '</div>';

			return $output;
		}
	}
}
if ( class_exists( 'Dfd_Team_Member' ) ) {
	$Dfd_Team_Member = new Dfd_Team_Member;
}