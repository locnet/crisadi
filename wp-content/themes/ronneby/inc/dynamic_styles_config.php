<?php
if(!class_exists('Dfd_Dynamic_Style_Vars')) {
	class Dfd_Dynamic_Style_Vars {		
		public static function return_vars() {
			global $dfd_ronneby;
			
			$_variables = array();
			
			$_defaults = self::defaults();

			$_typography_defaults = self::typography_defautls();
		
			$_typography_option = self::typography_option();
		
			$_typography_option_name = array_keys($_typography_defaults);
			
			foreach($_defaults as $k => $v) {
				if(isset($dfd_ronneby[$k]) && $dfd_ronneby[$k] != '') {
					$_variables[$k] = $dfd_ronneby[$k];
				} else {
					$_variables[$k] = $v;
				}
			}
			
			foreach($_typography_option_name as $k => $option) {
				foreach($_typography_option as $n => $prop) {
					$_typography_val = '';
					if(isset($dfd_ronneby[$option.'_typography_option'][$prop]) && $dfd_ronneby[$option.'_typography_option'][$prop] != '') {
						$_typography_val = $dfd_ronneby[$option.'_typography_option'][$prop];
					} elseif(isset($_typography_defaults[$option][$prop]) && $_typography_defaults[$option][$prop] != '') {
						$_typography_val = $_typography_defaults[$option][$prop];
					}
					if($_typography_val != '') {
						if($prop == 'font-family') {
							switch ($_typography_val) {
								case 'Arial, Helvetica, sans-serif':
									$pref = '';
									break;

								default:
									$pref = '"';
									break;
							}
							$_typography_val = $pref.$_typography_val.$pref;
						}
						$_variables[$option.'_'.$prop] = $_typography_val;
					}
				}
			}
			
			return $_variables;
		}
		
		public static function defaults() {
			return array(
				/*Main colors*/
				'main_site_color' => '#8a8f6a',
				'secondary_site_color' => '#e27863',
				'third_site_color' => '#c39f76',
				'title_color' => '#28262b',
				'background_gray' => '#f4f4f4',
				'subtitle_color' => '#bcbcbc',
				'border_color' => '#cdcdcd',
				/*Header 1*/
				'header_first_top_panel_background_color' => '#ffffff',
				'header_first_top_panel_color' => '#1b1b1b',
				'header_first_background_color' => '#ffffff',
				'header_first_text_color' => '#28262b',
				/*Header 2*/
				'header_second_top_panel_background_color' => '#ffffff',
				'header_second_top_panel_background_opacity' => '0',
				'header_second_top_panel_color' => '#ffffff',
				'header_second_background_color' => '#ffffff',
				'header_second_background_opacity' => '0',
				'header_second_text_color' => '#ffffff',
				/*Header 3*/
				'header_third_top_panel_background_color' => '#ffffff',
				'header_third_top_panel_color' => '#28262b',
				'header_third_background_color' => '#ffffff',
				'header_third_text_color' => '#28262b',
				/*Header 4*/
				'header_fourth_top_panel_background_color' => '#ffffff',
				'header_fourth_top_panel_background_opacity' => '0',
				'header_fourth_top_panel_color' => '#ffffff',
				'header_fourth_background_color' => '#ffffff',
				'header_fourth_background_opacity' => '0',
				'header_fourth_text_color' => '#ffffff',
				/*Header 5*/
				'fifth_header_logo_background_color' => 'transparent',
				'header_fifth_background_color' => '#ffffff',
				'header_fifth_bg_image' => array(
					'url' => ''
				),
				'header_fifth_bg_img_position' => 'center center',
				'header_fifth_text_color' => '#28262b',
				/*Header 6*/
				'header_sixth_text_color' => '#ffffff',
				'header_sixth_text_hover_color' => '#ffffff',
				'header_sixth_text_hover_background' => '',
				/*Header 7*/
				'header_seventh_background_color' => '#000000',
				'header_seventh_background_opacity' => '90',
				'header_seventh_text_color_active' => '#ffffff',
				'header_seventh_text_color' => '#ffffff',
				/*Header 8*/
				'eighth_header_logo_background_color' => 'transparent',
				'header_eighth_background_color' => '#ffffff',
				'header_eighth_bg_image' => array(
					'url' => ''
				),
				'header_eighth_bg_img_position' => 'center center',
				'header_eighth_text_color' => '#28262b',
				'header_eighth_navbutton_color' => '#28262b',
				'header_eighth_navbutton_bg' => '#ffffff',
				/*Header 9*/
				'header_ninth_top_panel_background_color' => '#ffffff',
				'header_ninth_top_panel_color' => '#1b1b1b',
				'header_ninth_background_color' => '#ffffff',
				'header_ninth_text_color' => '#28262b',
				/*Header 10*/
				'header_tenth_top_panel_background_color' => '#ffffff',
				'header_tenth_top_panel_background_opacity' => '0',
				'header_tenth_top_panel_color' => '#ffffff',
				'header_tenth_background_color' => '#ffffff',
				'header_tenth_background_opacity' => '0',
				'header_tenth_text_color' => '#ffffff',
				/*Header 11*/
				'header_eleventh_background_color' => '#ffffff',
				'header_eleventh_bg_image' => array(
					'url' => ''
				),
				'header_eleventh_bg_img_position' => 'center center',
				'header_eleventh_text_color' => '#28262b',
				/*Header 12*/
				'header_twelfth_top_panel_background_color' => '#ffffff',
				'header_twelfth_top_panel_color' => '#28262b',
				'header_twelfth_background_color' => '#ffffff',
				'header_twelfth_text_color' => '#28262b',
				/*Header 13*/
				'header_thirteenth_top_panel_background_color' => '#ffffff',
				'header_thirteenth_top_panel_background_opacity' => '0',
				'header_thirteenth_top_panel_color' => '#1b1b1b',
				'header_thirteenth_background_color' => '#ffffff',
				'header_thirteenth_background_opacity' => '0',
				'header_thirteenth_text_color' => '#ffffff',
				/*Header 14*/
				'header_fourteenth_background_color' => '#ffffff',
				'header_fourteenth_background_opacity' => '90',
				'header_fourteenth_text_color_active' => '#ffffff',
				'header_fourteenth_text_color' => '#ffffff',
				/*Sticky header*/
				'sticky_header_logo_background_color' => 'transparent',
				'fixed_header_background_color' => '#ffffff',
				'fixed_header_background_opacity' => '92',
				'fixed_header_text_color' => '#28262b',
				'top_panel_inner_background' => '#1b1b1b',
				'top_panel_inner_background_opacity' => '100',
				/*Logo size*/
				'header_logo_width' => '220',
				'header_logo_height' => '58',
				'top_menu_height' => '70',
				/*Stunning header height*/
				'stunning_header_min_height' => '200',
				/*Blog header*/
				'blog_smart_hover_text_color' => '#ffffff',
				'blog_smart_hover_bg' => '#000000',
				'blog_smart_hover_bg_opacity' => '70',
				/*Portfolio hover*/
				'folio_hover_text_color' => '#ffffff',
				'folio_hover_bg' => '#000000',
				'folio_hover_bg_opacity' => '70',
				/*Gallery hover*/
				'dfd_gallery_hover_text_color' => '#ffffff',
				'dfd_gallery_hover_bg' => '#000000',
				'dfd_gallery_hover_bg_opacity' => '70',
				/*Button*/
				'default_button_hover_color' => '#ffffff',
				'default_button_background' => '#c39f76',
				'default_button_background_opacity' => '100',
				'default_button_hover_bg' => '#a58969',
				'default_button_hover_bg_opacity' => '100',
				'default_button_border' => '#c39f76',
				'default_button_border_opacity' => '100',
				'default_button_hover_border' => '#a58969',
				'default_button_hover_border_opacity' => '100',
				'default_button_border_width' => '1',
				'default_button_border_style' => 'solid',
				'default_button_border_radius' => '0',
				'default_button_padding_left' => '80',
				'default_button_padding_right' => '40',
				/*To top button*/
				'to_top_button_font_size' => '10',
				'to_top_button_size' => '45',
				'to_top_button_color' => '#28262b',
				'to_top_button_hover_color' => '#ffffff',
				'to_top_button_background' => '#e8e8e8',
				'to_top_button_background_opacity' => '100',
				'to_top_button_hover_bg' => '#1b1b1b',
				'to_top_button_hover_bg_opacity' => '100',
				'to_top_button_border' => '#ffffff',
				'to_top_button_border_opacity' => '100',
				'to_top_button_hover_border' => '#1b1b1b',
				'to_top_button_hover_border_opacity' => '100',
				'to_top_button_border_width' => '0',
				'to_top_button_border_style' => 'solid',
				'to_top_button_border_radius' => '3',
				/*Menu dropdown*/
				'menu_dropdowns_opacity' => '60',
				'menu_dropdown_hover_color' => '#ffffff',
				'menu_dropdown_background' => '#1b1b1b',
				'menu_dropdown_background_opacity' => '100',
				'menu_dropdown_hover_bg' => '#ffffff',
				'menu_dropdown_hover_bg_opacity' => '0',
				'menu_first_level_hover_color' => '',
				/*Mobile header*/
				'mobile_header_bg' => '#ffffff',
				'mobile_header_color' => '#28262b',
				'mobile_menu_bg' => '#2d2d2d',
				'mobile_menu_color' => '#ffffff',
				'mobile_menu_color_opacity' => '50',
				/*White space*/
				'layout_whitespace_size' => '30',
				'layout_whitespace_color' => '#ffffff',
				/*Extra*/
				'post_title_bottom_offset' => '0',
				/*Link*/
				'link_hover_color' => '#c39f76',
				'link_decoration' => 'dotted',
				'link_decoration_color' => '#c39f76',
				/*WooCommerce*/
				'woo_star_rating_color' => '#f1b141',
				'woo_products_hover_bg' => '#1b1b1b',
				'woo_products_hover_bg_opacity' => '80',
				/*Responsive*/
				'header_responsive_breakpoint' => '1100',
				'x_large_responsive_breakpoint' => '1280',
				'large_responsive_breakpoint' => '1180',
				'normal_responsive_breakpoint' => '1024',
				'medium_responsive_breakpoint' => '800',
				'small_responsive_breakpoint' => '480',
			);
		}
		
		public static function typography_defautls() {
			return array(
				'title_h1' => array(
					'font-family' => 'texgyreadventorregular',
					'font-size' => '55px',
					'font-style' => 'normal',
					'font-weight' => '600',
					'text-transform' => 'none',
					'line-height' => '1.63',
					'letter-spacing' => '0',
					'color' => '#28262b',
				),
				'title_h2' => array(
					'font-family' => 'texgyreadventorregular',
					'font-size' => '45px',
					'font-style' => 'normal',
					'font-weight' => '600',
					'text-transform' => 'none',
					'line-height' => '1.866',
					'letter-spacing' => '4px',
					'color' => '#28262b',
				),
				'title_h3' => array(
					'font-family' => 'texgyreadventorregular',
					'font-size' => '35px',
					'font-style' => 'normal',
					'font-weight' => '600',
					'text-transform' => 'none',
					'line-height' => '1.54',
					'letter-spacing' => '5px',
					'color' => '#28262b',
				),
				'title_h4' => array(
					'font-family' => 'texgyreadventorregular',
					'font-size' => '30px',
					'font-style' => 'normal',
					'font-weight' => '600',
					'text-transform' => 'none',
					'line-height' => '2',
					'letter-spacing' => '5px',
					'color' => '#28262b',
				),
				'title_h5' => array(
					'font-family' => 'texgyreadventorregular',
					'font-size' => '22px',
					'font-style' => 'normal',
					'font-weight' => '600',
					'text-transform' => 'uppercase',
					'line-height' => '2.05',
					'letter-spacing' => '5px',
					'color' => '#28262b',
				),
				'title_h6' => array(
					'font-family' => 'texgyreadventorregular',
					'font-size' => '18px',
					'font-style' => 'normal',
					'font-weight' => '600',
					'text-transform' => 'none',
					'line-height' => '1.2',
					'letter-spacing' => '4px',
					'color' => '#28262b',
				),
				'subtitle_h1' => array(
					'font-family' => 'Droid Serif',
					'font-size' => '18px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '2',
					'letter-spacing' => '0',
					'color' => '#727272',
				),
				'subtitle_h2' => array(
					'font-family' => 'Droid Serif',
					'font-size' => '16px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '1.875',
					'letter-spacing' => '0',
					'color' => '#727272',
				),
				'subtitle_h3' => array(
					'font-family' => 'Droid Serif',
					'font-size' => '14px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '1.43',
					'letter-spacing' => '0',
					'color' => '#727272',
				),
				'subtitle_h4' => array(
					'font-family' => 'Droid Serif',
					'font-size' => '13px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '1.38',
					'letter-spacing' => '0',
					'color' => '#727272',
				),
				'subtitle_h5' => array(
					'font-family' => 'Droid Serif',
					'font-size' => '13px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '1.38',
					'letter-spacing' => '0',
					'color' => '#727272',
				),
				'subtitle_h6' => array(
					'font-family' => 'Droid Serif',
					'font-size' => '12px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '1.25',
					'letter-spacing' => '0',
					'color' => '#727272',
				),
				'stunning_header_title' => array(
					'font-family' => 'texgyreadventorregular',
					'font-size' => '35px',
					'font-style' => 'normal',
					'font-weight' => '600',
					'text-transform' => 'none',
					'line-height' => '1.6',
					'letter-spacing' => '0',
					'color' => '#28262b',
				),
				'blog_title' => array(
					'font-family' => 'texgyreadventorregular',
					'font-size' => '18px',
					'font-style' => 'normal',
					'font-weight' => '600',
					'text-transform' => 'none',
					'line-height' => '1.6',
					'letter-spacing' => '0',
					'color' => '#28262b',
				),
				'widget_title' => array(
					'font-family' => 'texgyreadventorregular',
					'font-size' => '13px',
					'font-style' => 'normal',
					'font-weight' => '600',
					'text-transform' => 'uppercase',
					'line-height' => '1.6',
					'letter-spacing' => '4px',
					'color' => '#28262b',
				),
				'block_title' => array(
					'font-family' => 'texgyreadventorregular',
					'font-size' => '15px',
					'font-style' => 'normal',
					'font-weight' => '600',
					'text-transform' => 'none',
					'line-height' => '1.92',
					'letter-spacing' => '0',
					'color' => '#28262b',
				),
				'feature_title' => array(
					'font-family' => 'texgyreadventorregular',
					'font-size' => '15px',
					'font-style' => 'normal',
					'font-weight' => '600',
					'text-transform' => 'none',
					'line-height' => '1.71',
					'letter-spacing' => '0',
					'color' => '#28262b',
				),
				'box_name' => array(
					'font-family' => 'texgyreadventorregular',
					'font-size' => '14px',
					'font-style' => 'normal',
					'font-weight' => '600',
					'text-transform' => 'none',
					'line-height' => '1.37',
					'letter-spacing' => '0',
					'color' => '#28262b',
				),
				'subtitle' => array(
					'font-family' => 'Droid Serif',
					'font-size' => '13px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '1.72',
					'letter-spacing' => '0',
					'color' => '#727272',
				),
				'text' => array(
					'font-family' => 'Raleway',
					'font-size' => '14px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '1.785',
					'letter-spacing' => '0',
					'color' => '#565656',
				),
				'entry_meta' => array(
					'font-family' => 'Droid Serif',
					'font-size' => '13px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '1.6',
					'letter-spacing' => '0',
					'color' => '#727272',
				),
				'menu_titles' => array(
					'font-family' => 'texgyreadventorregular',
					'font-size' => '11px',
					'font-style' => 'normal',
					'font-weight' => '600',
					'text-transform' => 'uppercase',
					'line-height' => '1.6',
					'letter-spacing' => '0',
					'color' => '#28262b',
				),
				'menu_dropdowns' => array(
					'font-family' => 'Raleway',
					'font-size' => '13px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '1.6',
					'letter-spacing' => '0',
					'color' => '#565656',
				),
				'menu_dropdown_subtitles' => array(
					'font-family' => 'Raleway',
					'font-size' => '11px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => '1.6',
					'letter-spacing' => '0',
					'color' => '#bbbbbb',
				),
				'default_button' => array(
					'font-family' => 'texgyreadventorregular',
					'font-size' => '12px',
					'font-style' => 'normal',
					'font-weight' => '600',
					'text-transform' => 'none',
					'line-height' => '45px',
					'letter-spacing' => '2px',
					'color' => '#ffffff',
				),
				'link' => array(
					'font-family' => 'Droid Serif',
					'font-size' => '14px',
					'font-style' => 'normal',
					'font-weight' => '400',
					'text-transform' => 'none',
					'line-height' => 'inherit',
					'letter-spacing' => '0',
					'color' => '#c39f76',
				),
			);
		}
		public static function typography_option() {
			return array(
				1 => 'font-style',
				2 => 'font-weight',
				3 => 'font-family',
				4 => 'font-size',
				5 => 'line-height',
				6 => 'text-transform',
				7 => 'letter-spacing',
				8 => 'color'
			);
		}
	}
	
	$vars = Dfd_Dynamic_Style_Vars::return_vars();
	
	$vars['menu_inner_height'] = $vars['top_menu_height'] - 40;
	
	$vars['menu_dropdown_items_color'] = '';
	
	$vars['height_ninth'] = $vars['top_menu_height'];
	if(isset($vars['header_ninth_banner_height'])) {
		$vars['height_ninth'] = $vars['header_ninth_banner_height'];
		if($vars['header_ninth_banner_height'] < $vars['header_logo_height']) {
			$vars['height_ninth'] = $vars['header_logo_height'];
		}
	}
	
	$vars['height_tenth'] = $vars['top_menu_height'];
	if(isset($vars['header_tenth_banner_height'])) {
		$vars['height_tenth'] = $vars['header_tenth_banner_height'];
		if($vars['header_tenth_banner_height'] < $vars['header_logo_height']) {
			$vars['height_tenth'] = $vars['header_logo_height'];
		}
	}
	
	$vars['header_second_top_panel_background'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['header_second_top_panel_background_color'], (int)$vars['header_second_top_panel_background_opacity'] / 100);
	
	$vars['header_second_background'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['header_second_background_color'], (int)$vars['header_second_background_opacity'] / 100);
	
	$vars['header_fourth_top_panel_background'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['header_fourth_top_panel_background_color'], (int)$vars['header_fourth_top_panel_background_opacity'] / 100);
	
	$vars['header_fourth_background'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['header_fourth_background_color'], (int)$vars['header_fourth_background_opacity'] / 100);
	
	$vars['header_seventh_background'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['header_seventh_background_color'], (int)$vars['header_seventh_background_opacity'] / 100);
	
	$vars['header_tenth_top_panel_background'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['header_tenth_top_panel_background_color'], (int)$vars['header_tenth_top_panel_background_opacity'] / 100);
	
	$vars['header_tenth_background'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['header_tenth_background_color'], (int)$vars['header_tenth_background_opacity'] / 100);
	
	$vars['header_thirteenth_top_panel_background'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['header_thirteenth_top_panel_background_color'], (int)$vars['header_thirteenth_top_panel_background_opacity'] / 100);
	
	$vars['header_thirteenth_background'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['header_thirteenth_background_color'], (int)$vars['header_thirteenth_background_opacity'] / 100);
	
	$vars['header_fourteenth_background'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['header_fourteenth_background_color'], (int)$vars['header_fourteenth_background_opacity'] / 100);
	
	$vars['fixed_header_background'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['fixed_header_background_color'], (int)$vars['fixed_header_background_opacity'] / 100);
	
	$vars['menu_dropdown_items_color'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['menu_dropdowns_color'], (int)$vars['menu_dropdowns_opacity'] / 100);
	
	$vars['menu_dropdown_bg'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['menu_dropdown_background'], (int)$vars['menu_dropdown_background_opacity'] / 100);
	
	$vars['menu_dropdown_hover_background'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['menu_dropdown_hover_bg'], (int)$vars['menu_dropdown_hover_bg_opacity'] / 100);
	
	$vars['mobile_menu_color_value'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['mobile_menu_color'], (int)$vars['mobile_menu_color_opacity'] / 100);
	
	$vars['button_background_color'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['default_button_background'], (int)$vars['default_button_background_opacity'] / 100);
	
	$vars['button_hover_background'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['default_button_hover_bg'], (int)$vars['default_button_hover_bg_opacity'] / 100);
	
	$vars['button_border_color'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['default_button_border'], (int)$vars['default_button_border_opacity'] / 100);
	
	$vars['button_hover_border_color'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['default_button_hover_border'], (int)$vars['default_button_hover_border_opacity'] / 100);
	
	$vars['top_button_background_color'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['to_top_button_background'], (int)$vars['to_top_button_background_opacity'] / 100);
	
	$vars['top_button_hover_background'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['to_top_button_hover_bg'], (int)$vars['to_top_button_hover_bg_opacity'] / 100);
	
	$vars['top_button_border_color'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['to_top_button_border'], (int)$vars['to_top_button_border_opacity'] / 100);
	
	$vars['top_button_hover_border_color'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['to_top_button_hover_border'], (int)$vars['to_top_button_hover_border_opacity'] / 100);
	
	$vars['top_panel_inner_bg_option'] = Dfd_Theme_Helpers::dfd_hex2rgb($vars['top_panel_inner_background'], (int)$vars['top_panel_inner_background_opacity'] / 100);

	global $dfd_ronneby;
	
	$output = '';
	
	$required_files = array(
		'app.php',
		'prettyPhoto.php',
		'styled-button.php',
		'site-preloader.php',
	);
	
	if ( class_exists( 'Vc_Manager', false ) ) {
		$required_files[] = 'visual-composer.php';
	}
	
	if (
		isset($dfd_ronneby['mobile_responsive'])
		&&
		strcmp($dfd_ronneby['mobile_responsive'],'1') === 0
		&&
		(
			$vars['header_responsive_breakpoint'] != '1100'
			||
			$vars['x_large_responsive_breakpoint'] != '1280'
			||
			$vars['large_responsive_breakpoint'] != '1180'
			||
			$vars['normal_responsive_breakpoint'] != '1024'
			||
			$vars['medium_responsive_breakpoint'] != '800'
			||
			$vars['small_responsive_breakpoint'] != '480'
		)
	) {
		$required_files[] = 'mobile-responsive.php';
	}
	
	if (is_plugin_active('woocommerce/woocommerce.php')) {
		$postfix = '';
		if(isset($dfd_ronneby['dfd_woocommerce_templates_path']) && $dfd_ronneby['dfd_woocommerce_templates_path'] == '_old') {
			$postfix = '_old';
		}
		$required_files[] = 'woocommerce'.$postfix.'.php';
	}
	
	if(is_plugin_active('bbpress/bbpress.php')) {
		$required_files[] = 'bbpress.php';
	}
	
	if(class_exists('BuddyPress')) {
		$required_files[] = 'buddypress.php';
	}

	foreach(glob(get_template_directory().'/inc/dynamic_styles/*.php') as $file) {
		if(in_array(basename($file), $required_files)) {
			require_once($file);
		}
	}

	ob_start();
	require locate_template('/redux_framework/styles.php');
	$output .= ob_get_clean();

	echo $output;
}