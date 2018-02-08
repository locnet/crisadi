<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: News Scroll Container
* Add-on URI: http://wpsaloon.com
*/
if(!class_exists('Dfd_News_Scroller')) {
	class Dfd_News_Scroller {
		
		var $top_container_height;
		var $bottom_container_height;
		var $items_offset;
		
		function __construct() {
			$this->top_container_height = '';
			$this->bottom_container_height = '';
			$this->items_offset = '';
			add_action('init', array($this, 'add_dfd_news_scroller'));
			add_shortcode( 'dfd_news_scroller', array($this, 'dfd_news_scroller' ) );
			add_shortcode( 'dfd_news_scroller_container_top', array($this, 'dfd_news_scroller_container_top' ) );
			add_shortcode( 'dfd_news_scroller_container_bottom', array($this, 'dfd_news_scroller_container_bottom' ) );
			add_shortcode( 'dfd_news_scroller_item_top', array($this, 'dfd_news_scroller_item_top' ) );
			add_shortcode( 'dfd_news_scroller_item_bottom', array($this, 'dfd_news_scroller_item_bottom' ) );
		}
		function dfd_news_scroller($atts, $content = null) {
			$top_container_slides = $bottom_container_slides = $top_container_height = $bottom_container_height = $enable_prev_next = $container_height = $items_offset = $el_class = $module_animation = $arrows_color = '';
			extract(shortcode_atts(array(
				'top_container_slides' => '2',
				'bottom_container_slides' => '3',
				'top_container_height' => '512',
				'bottom_container_height' => '224',
				'enable_prev_next' => '',
				'items_offset' => '',
				'arrows_color' => '',
				'el_class' => '',
				'module_animation' => '',
			), $atts));
			
			$container_css = '';
			
			if(!empty($items_offset)) {
				$items_padding = $items_offset/2;
				$container_css .= 'style="margin: -'.esc_attr($items_padding).'px;"';
			} else {
				$items_padding = 0;
			}
			
			$this->top_container_height = $top_container_height;
			
			$this->bottom_container_height = $bottom_container_height;
			
			$this->items_offset = $items_padding;
			
			$output = $animate = $animation_data = $navbar_css = $arrows_css =  '';
			
			if($arrows_color != '') {
				$arrows_css =  'style="color: '.esc_attr($arrows_color).'"';
			}
			
			if ( ! ($module_animation == '')){
				$animate = ' cr-animate-gen';
				$animation_data = 'data-animate-item = ".dfd-scrolling-news-wrap" data-animate-type = "'.esc_attr($module_animation).'" ';
			}
			
			if($top_container_slides < 2) {
				$top_container_slides = 2;
			} elseif($top_container_slides > 4) {
				$top_container_slides = 4;
			}
			
			if($bottom_container_slides < 3) {
				$bottom_container_slides = 3;
			} elseif($bottom_container_slides > 5) {
				$bottom_container_slides = 5;
			}
			
			wp_enqueue_script('dfd-scrolling-news');
			
			$output .= '<div class="dfd-scrolling-news-wrap '.esc_attr($animate).'" data-slides-top="'.esc_attr($top_container_slides).'" data-slides-bottom="'.esc_attr($bottom_container_slides).'" '.$animation_data.' '.$container_css.'>';
			$output .= '<div class="dfd-scrolling-news-container">';
			$output .= do_shortcode($content);
			$output .= '</div>';
			if($enable_prev_next) {
				$output .= '<div class="slider-controls">';
				$output .= '<a href="#" title="slick" class="slider-control prev"></a>';
				$output .= '<a href="#" title="slick" class="slider-control next"></a>';
				$output .= '</div>';
			}
			$output .= '</div>';
			
			return $output;
		}
		function dfd_news_scroller_container_top($atts,$content = null) {
			$el_class = $css = '';
			extract(shortcode_atts(array(
				'el_class' => '',
			), $atts));
			$output = '';
			
			$output .= '<div class="dfd-news-top '.esc_attr($el_class).'">';
			$output .= do_shortcode($content);
			$output .= '</div>';
			
			return $output;
		}
		function dfd_news_scroller_container_bottom($atts,$content = null) {
			$el_class = $css = '';
			extract(shortcode_atts(array(
				'el_class' => '',
			), $atts));
			$output = '';
			
			$output .= '<div class="dfd-news-bottom '.esc_attr($el_class).'">';
			$output .= do_shortcode($content);
			$output .= '</div>';
			
			return $output;
		}
		function dfd_news_scroller_item_top($atts,$content = null) {
			$single_post_item = $el_class = '';
			$heading_typography_type = $main_heading_font_size = $main_heading_font_family = $main_heading_custom_family = $main_heading_style = $main_heading_default_style = $main_heading_default_weight = $main_heading_color = $main_heading_line_height = $main_heading_letter_spacing = '';
			$subheading_typography_type = $sub_heading_font_size = $sub_heading_font_family = $main_subheading_custom_family = $sub_heading_style = $sub_heading_default_style = $sub_heading_default_weight = $sub_heading_color = $sub_heading_line_height = $sub_heading_letter_spacing = '';
			$content_background = $content_alignment = $title_alignment = $show_title = $heading_tag = $show_meta = $show_categories = $post_style = $show_mask = $image_mask_style = $image_mask_color = $image_mask_gradient = '';
			extract(shortcode_atts(array(
				'single_post_item' => '',
				'show_title' => '',
				'heading_tag' => 'h2',
				'title_alignment' => 'text-left',
				'show_meta' => '',
				'show_categories' => '',
				'post_style' => 'default',
				'content_alignment' => 'dfd-content-left',
				'content_background' => '',
				'show_mask' => '',
				'image_mask_style' => '',
				'image_mask_color' => '',
				'image_mask_gradient' => '',
				'heading_typography_type'	=> 	'default',
				'main_heading_font_size'	=> 	'',
				'main_heading_font_family' => '',
				'main_heading_custom_family' => '',
				'main_heading_style'		=>	'',
				'main_heading_default_style'		=>	'',
				'main_heading_default_weight'		=>	'',
				'main_heading_color'		=>	'',
				'main_heading_line_height' => '',
				'main_heading_letter_spacing' => '',
				'subheading_typography_type'	=> 	'default',
				'sub_heading_font_size'	=> 	'',
				'sub_heading_font_family' => '',
				'main_subheading_custom_family' => '',
				'sub_heading_style'		=>	'',
				'sub_heading_default_style'		=>	'',
				'sub_heading_default_weight'		=>	'',
				'sub_heading_color'		=>	'',
				'sub_heading_line_height' => '',
				'sub_heading_letter_spacing' => '',
				'el_class' => '',
			), $atts));
			$output = $item_html = $image_mask_css = '';
			
			$image_width = 960;
			
			$items_padding = $this->items_offset;
			
			$image_height = $this->top_container_height;
			
			if(empty($image_height)) {
				$image_height = 512;
			}
			
			$main_heading_style_inline = $sub_heading_style_inline = $image_mask_html = $image_mask_class = $content_css = '';
			
			if($main_heading_font_family != '' && strcmp($heading_typography_type, 'google_fonts') === 0) {
				$mhfont_family = get_ultimate_font_family($main_heading_font_family);
				$main_heading_style_inline .= 'font-family:\''.esc_attr($mhfont_family).'\';';
			} elseif(!empty($main_heading_custom_family) && strcmp($heading_typography_type, 'default') === 0) {
				$main_heading_style_inline .= 'font-family:\''.esc_attr($main_heading_custom_family).'\';';
			}
			// main heading font style
			if(strcmp($heading_typography_type, 'google_fonts') === 0) {
				$main_heading_style_inline .= get_ultimate_font_style($main_heading_style);
			}elseif(!empty($main_heading_default_style) && strcmp($heading_typography_type, 'default') === 0) {
				$main_heading_style_inline .= 'font-style:'.esc_attr($main_heading_default_style).';';
			}
			if(!empty($main_heading_default_weight) && strcmp($heading_typography_type, 'default') === 0) {
				$main_heading_style_inline .= 'font-weight:'.esc_attr($main_heading_default_weight).';';
			}
			//attach font size if set
			if($main_heading_font_size != '') {
				$main_heading_style_inline .= 'font-size:'.esc_attr($main_heading_font_size).'px;';
			}
			//attach font color if set	
			if($main_heading_color != '') {
				$main_heading_style_inline .= 'color:'.esc_attr($main_heading_color).';';
			}
			//line height
			if($main_heading_line_height != '') {
				$main_heading_style_inline .= 'line-height:'.esc_attr($main_heading_line_height).'px;';
			}
			//letter spacing
			if($main_heading_letter_spacing != '') {
				$main_heading_style_inline .= 'letter-spacing:'.esc_attr($main_heading_letter_spacing).'px;';
			}
				
			/* ----- sub heading styles ----- */
			if($sub_heading_font_family != '' && strcmp($subheading_typography_type, 'google_fonts') === 0)
			{
				$shfont_family = get_ultimate_font_family($sub_heading_font_family);
				$sub_heading_style_inline .= 'font-family:\''.$shfont_family.'\';';
			}elseif(!empty($main_subheading_custom_family) && strcmp($subheading_typography_type, 'default') === 0) {
				$sub_heading_style_inline .= 'font-family:\''.$main_subheading_custom_family.'\';';
			}
			//sub heaing font style
			if(strcmp($subheading_typography_type, 'google_fonts') === 0) {
				$sub_heading_style_inline .= get_ultimate_font_style($sub_heading_style);
			}elseif(!empty($sub_heading_default_style) && strcmp($subheading_typography_type, 'default') === 0) {
				$sub_heading_style_inline .= 'font-style:'.esc_attr($sub_heading_default_style).';';
			}
			if(!empty($sub_heading_default_weight) && strcmp($heading_typography_type, 'default') === 0) {
				$sub_heading_style_inline .= 'font-weight:'.esc_attr($sub_heading_default_weight).';';
			}
			//attach font size if set
			if($sub_heading_font_size != '') {
				$sub_heading_style_inline .= 'font-size:'.esc_attr($sub_heading_font_size).'px;';
			}
			//attach font color if set	
			if($sub_heading_color != '') {
				$sub_heading_style_inline .= 'color:'.esc_attr($sub_heading_color).';';	
			}
			//line height
			if($sub_heading_line_height != '') {
				$sub_heading_style_inline .= 'line-height:'.esc_attr($sub_heading_line_height).'px;';
			}
			//letter spacing
			if($sub_heading_letter_spacing != '') {
				$sub_heading_style_inline .= 'letter-spacing:'.esc_attr($sub_heading_letter_spacing).'px;';	
			}
			
			if($show_mask) {
				$image_mask_class .= 'dfd-hide-on-hover';
			}
			
			if($image_mask_style == 'color' || $image_mask_color != '') {
				$image_mask_css .= 'style="background: '.esc_attr($image_mask_color).';"';
			} elseif($image_mask_style == 'gradient' || $image_mask_gradient != '') {
				$image_mask_css .= 'style="'.$image_mask_gradient.';"';
			}
			
			if($post_style == 'default' && $content_background != '') {
				$content_css .= 'style="background: '.esc_attr($content_background).'"';
			}
						
			if($single_post_item != '') {
				$args = array(
					'post_type' => 'post',
					'p' => $single_post_item,
				);

				global $dfd_ronneby;
				$cover_class = '';
				$lazy_load = false;
				if(isset($dfd_ronneby['enable_images_lazy_load']) && $dfd_ronneby['enable_images_lazy_load'] == 'on') {
					$lazy_load = true;
					$cover_class = 'dfd-img-lazy-load';
					$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $image_width $image_height'%2F%3E";
				}
				
				$the_query = new WP_Query($args);
				while ($the_query->have_posts()) : $the_query->the_post();
					if (has_post_thumbnail()) {
						$thumb = get_post_thumbnail_id();
						$img_id = $thumb;
						$img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
						$article_image = dfd_aq_resize($img_url, $image_width, $image_height, true, true, true);
						if(!$article_image) {
							$article_image = $img_url;
						}
					} else {
						$img_id = '';
						$article_image = get_template_directory_uri() . '/assets/images/no_image_resized_480-360.jpg';
					}
					$attr = Dfd_Theme_Helpers::get_image_attrs($article_image, $img_id, $image_width, $image_height);
					if($lazy_load) {
						$img_html = '<img src="'.$loading_img_src.'" data-src="'. esc_url($article_image) .'" '.$attr.'/>';
					} else {
						$img_html = '<img src="'. esc_url($article_image) .'" '.$attr.'/>';
					}
					$title = get_the_title();
					ob_start();
					echo '<div class="post dfd-post-style-'.esc_attr($post_style).' '.$cover_class.'">';
						echo '<div class="cover" style="padding: '.esc_attr($items_padding).'px;">';
							echo '<div class="entry-thumb">';
								echo $img_html;
								echo '<div class="dfd-image-mask '.esc_attr($image_mask_class).'" '.$image_mask_css.'></div>';
								if($show_title || $show_meta || $show_categories) {
									echo '<div class="dfd-title-wrap '.esc_attr($title_alignment).' '.esc_attr($content_alignment).'" '.$content_css.'>';
									if($show_categories) {
										echo '<div class="dfd-news-categories">';
											get_template_part('templates/entry-meta/mini', 'category-highlighted');
										echo '</div>';
									}
									if($show_title) {
										echo '<'.esc_attr($heading_tag).' class="widget-title dfd-news-title"><a href="'.esc_url(get_permalink()).'" title="'.esc_attr($title).'" style="'.$main_heading_style_inline.'">'.$title.'</a></'.esc_attr($heading_tag).'>';
									}
									if($show_meta) {
										echo '<div class="entry-meta" style="'.$sub_heading_style_inline.'">';
											get_template_part('templates/entry-meta/mini', 'author');
											get_template_part('templates/entry-meta/mini', 'delim-blank');
											get_template_part('templates/entry-meta/mini', 'date');
										echo '</div>';
									}
									echo '</div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
					$item_html .= ob_get_clean();
				endwhile; wp_reset_postdata();
			}
			
			$output .= $item_html;
			
			return $output;
		}
		function dfd_news_scroller_item_bottom($atts,$content = null) {
			$single_post_item = $el_class = '';
			$heading_typography_type = $main_heading_font_size = $main_heading_font_family = $main_heading_custom_family = $main_heading_style = $main_heading_default_style = $main_heading_default_weight = $main_heading_color = $main_heading_line_height = $main_heading_letter_spacing = '';
			$subheading_typography_type = $sub_heading_font_size = $sub_heading_font_family = $main_subheading_custom_family = $sub_heading_style = $sub_heading_default_style = $sub_heading_default_weight = $sub_heading_color = $sub_heading_line_height = $sub_heading_letter_spacing = '';
			$content_background = $content_alignment = $title_alignment = $show_title = $heading_tag = $show_meta = $show_categories = $post_style = $show_mask = $image_mask_style = $image_mask_color = $image_mask_gradient = '';
			extract(shortcode_atts(array(
				'single_post_item' => '',
				'show_title' => '',
				'heading_tag' => 'h2',
				'title_alignment' => 'text-left',
				'show_meta' => '',
				'show_categories' => '',
				'post_style' => 'default',
				'content_alignment' => 'dfd-content-left',
				'content_background' => '',
				'show_mask' => '',
				'image_mask_style' => '',
				'image_mask_color' => '',
				'image_mask_gradient' => '',
				'heading_typography_type'	=> 	'default',
				'main_heading_font_size'	=> 	'',
				'main_heading_font_family' => '',
				'main_heading_custom_family' => '',
				'main_heading_style'		=>	'',
				'main_heading_default_style'		=>	'',
				'main_heading_default_weight'		=>	'',
				'main_heading_color'		=>	'',
				'main_heading_line_height' => '',
				'main_heading_letter_spacing' => '',
				'subheading_typography_type'	=> 	'default',
				'sub_heading_font_size'	=> 	'',
				'sub_heading_font_family' => '',
				'main_subheading_custom_family' => '',
				'sub_heading_style'		=>	'',
				'sub_heading_default_style'		=>	'',
				'sub_heading_default_weight'		=>	'',
				'sub_heading_color'		=>	'',
				'sub_heading_line_height' => '',
				'sub_heading_letter_spacing' => '',
				'el_class' => '',
			), $atts));
			$output = $item_html = $image_mask_css = '';
			
			$image_width = 640;
			
			$items_padding = $this->items_offset;
			
			$image_height = $this->bottom_container_height;
			
			if(empty($image_height)) {
				$image_height = 224;
			}
			
			$main_heading_style_inline = $sub_heading_style_inline = $image_mask_html = $image_mask_class = $content_css = '';
			
			if($main_heading_font_family != '' && strcmp($heading_typography_type, 'google_fonts') === 0) {
				$mhfont_family = get_ultimate_font_family($main_heading_font_family);
				$main_heading_style_inline .= 'font-family:\''.esc_attr($mhfont_family).'\';';
			} elseif(!empty($main_heading_custom_family) && strcmp($heading_typography_type, 'default') === 0) {
				$main_heading_style_inline .= 'font-family:\''.esc_attr($main_heading_custom_family).'\';';
			}
			// main heading font style
			if(strcmp($heading_typography_type, 'google_fonts') === 0) {
				$main_heading_style_inline .= get_ultimate_font_style($main_heading_style);
			}elseif(!empty($main_heading_default_style) && strcmp($heading_typography_type, 'default') === 0) {
				$main_heading_style_inline .= 'font-style:'.esc_attr($main_heading_default_style).';';
			}
			if(!empty($main_heading_default_weight) && strcmp($heading_typography_type, 'default') === 0) {
				$main_heading_style_inline .= 'font-weight:'.esc_attr($main_heading_default_weight).';';
			}
			//attach font size if set
			if($main_heading_font_size != '') {
				$main_heading_style_inline .= 'font-size:'.esc_attr($main_heading_font_size).'px;';
			}
			//attach font color if set	
			if($main_heading_color != '') {
				$main_heading_style_inline .= 'color:'.esc_attr($main_heading_color).';';
			}
			//line height
			if($main_heading_line_height != '') {
				$main_heading_style_inline .= 'line-height:'.esc_attr($main_heading_line_height).'px;';
			}
			//letter spacing
			if($main_heading_letter_spacing != '') {
				$main_heading_style_inline .= 'letter-spacing:'.esc_attr($main_heading_letter_spacing).'px;';
			}
				
			/* ----- sub heading styles ----- */
			if($sub_heading_font_family != '' && strcmp($subheading_typography_type, 'google_fonts') === 0)
			{
				$shfont_family = get_ultimate_font_family($sub_heading_font_family);
				$sub_heading_style_inline .= 'font-family:\''.$shfont_family.'\';';
			}elseif(!empty($main_subheading_custom_family) && strcmp($subheading_typography_type, 'default') === 0) {
				$sub_heading_style_inline .= 'font-family:\''.$main_subheading_custom_family.'\';';
			}
			//sub heaing font style
			if(strcmp($subheading_typography_type, 'google_fonts') === 0) {
				$sub_heading_style_inline .= get_ultimate_font_style($sub_heading_style);
			}elseif(!empty($sub_heading_default_style) && strcmp($subheading_typography_type, 'default') === 0) {
				$sub_heading_style_inline .= 'font-style:'.esc_attr($sub_heading_default_style).';';
			}
			if(!empty($sub_heading_default_weight) && strcmp($heading_typography_type, 'default') === 0) {
				$sub_heading_style_inline .= 'font-weight:'.esc_attr($sub_heading_default_weight).';';
			}
			//attach font size if set
			if($sub_heading_font_size != '') {
				$sub_heading_style_inline .= 'font-size:'.esc_attr($sub_heading_font_size).'px;';
			}
			//attach font color if set	
			if($sub_heading_color != '') {
				$sub_heading_style_inline .= 'color:'.esc_attr($sub_heading_color).';';	
			}
			//line height
			if($sub_heading_line_height != '') {
				$sub_heading_style_inline .= 'line-height:'.esc_attr($sub_heading_line_height).'px;';
			}
			//letter spacing
			if($sub_heading_letter_spacing != '') {
				$sub_heading_style_inline .= 'letter-spacing:'.esc_attr($sub_heading_letter_spacing).'px;';	
			}
			
			if($show_mask) {
				$image_mask_class .= 'dfd-hide-on-hover';
			}
			
			if($image_mask_style == 'color' || $image_mask_color != '') {
				$image_mask_css .= 'style="background: '.esc_attr($image_mask_color).';"';
			} elseif($image_mask_style == 'gradient' || $image_mask_gradient != '') {
				$image_mask_css .= 'style="'.$image_mask_gradient.';"';
			}
			
			if($post_style == 'default' && $content_background != '') {
				$content_css .= 'style="background: '.esc_attr($content_background).'"';
			}
						
			if($single_post_item != '') {
				$args = array(
					'post_type' => 'post',
					'p' => $single_post_item,
				);
				$the_query = new WP_Query($args);
				while ($the_query->have_posts()) : $the_query->the_post();
					if (has_post_thumbnail()) {
						$thumb = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
						$article_image = dfd_aq_resize($img_url, $image_width, $image_height, true, true, true);
						if(!$article_image) {
							$article_image = $img_url;
						}
					} else {
						$article_image = get_template_directory_uri() . '/assets/images/no_image_resized_480-360.jpg';
					}
					$title = get_the_title();
					ob_start();
					echo '<div class="post dfd-post-style-'.esc_attr($post_style).'">';
						echo '<div class="cover" style="padding: '.esc_attr($items_padding).'px;">';
							echo '<div class="entry-thumb">';
								echo '<img src="'. esc_url($article_image) .'" alt="'. esc_attr($title) .'"/>';
								echo '<div class="dfd-image-mask '.esc_attr($image_mask_class).'" '.$image_mask_css.'></div>';
								if($show_title || $show_meta || $show_categories) {
									echo '<div class="dfd-title-wrap '.esc_attr($title_alignment).' '.esc_attr($content_alignment).'" '.$content_css.'>';
									if($show_categories) {
										echo '<div class="dfd-news-categories">';
											get_template_part('templates/entry-meta/mini', 'category-highlighted');
										echo '</div>';
									}
									if($show_title) {
										echo '<'.esc_attr($heading_tag).' class="widget-title dfd-news-title"><a href="'.esc_url(get_permalink()).'" title="'.esc_attr($title).'" style="'.$main_heading_style_inline.'">'.$title.'</a></'.esc_attr($heading_tag).'>';
									}
									if($show_meta) {
										echo '<div class="entry-meta" style="'.$sub_heading_style_inline.'">';
											get_template_part('templates/entry-meta/mini', 'author');
											get_template_part('templates/entry-meta/mini', 'delim-blank');
											get_template_part('templates/entry-meta/mini', 'date');
										echo '</div>';
									}
									echo '</div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
					$item_html .= ob_get_clean();
				endwhile; wp_reset_postdata();
			}
			
			$output .= $item_html;
			
			return $output;
		}

		function add_dfd_news_scroller() {
			if(function_exists('vc_map')) {
				vc_map(
				array(
				   'name' => __('News scroller module (Beta version)','dfd'),
				   'base' => 'dfd_news_scroller',
				   'icon' => 'dfd_news_scroller dfd_shortcode',
				   'category' => __('Ronneby 2.0','dfd'),
				   'as_parent' => array('only' => 'dfd_news_scroller_container_top, dfd_news_scroller_container_bottom'),
				   'description' => __('','dfd'),
				   'content_element' => true,
				   'show_settings_on_create' => true,
				   'params' => array(
						array(
							'type' => 'number',
							'class' => '',
							'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the number of slides to be show in top part of module. Available values from 2 to 4 slides','dfd').'</span></span>'. __('Number of slides in top container', 'dfd'),
							'param_name' => 'top_container_slides',
							'min' => 2,
							'max' => 4,
							'value' => 2,
							'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
						),
						array(
							'type' => 'number',
							'class' => '',
							'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the number of slides to be show in top part of module. Available values from 3 to 5 slides','dfd').'</span></span>'.__('Number of slides in bottom container', 'dfd'),
							'param_name' => 'bottom_container_slides',
							'min' => 3,
							'max' => 5,
							'value' => 3,
							'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-top-padding',
						),
						array(
							'type' => 'number',
							'class' => '',
							'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the height of the top container','dfd').'</span></span>'.__('Top container height', 'dfd'),
							'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
							'param_name' => 'top_container_height',
							'value' => 512,
						),
						array(
							'type' => 'number',
							'class' => '',
							'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the height of the top container','dfd').'</span></span>'. __('Bottom container height', 'dfd'),
							'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
							'param_name' => 'bottom_container_height',
							'value' => 224,
						),
						array(
							'type' => 'dfd_single_checkbox',
							'class' => '',
							'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the navigation arrows','dfd').'</span></span>'.  __('Prev/next navigation arrows', 'dfd'),
							'param_name' => 'enable_prev_next',
							'value' => '',
                                'options' => array(
                                    'yes'	=> array(
                                        'yes'	=> esc_attr__('Yes', 'dfd'),
                                        'no'	=> esc_attr__('No', 'dfd')
                                    ),
                                ),
							'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
						),
						array(
							'type' => 'colorpicker',
							'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the navigation arrows color. The default value is','dfd').'</span></span>'. __('Arrows Color', 'dfd'),
							'param_name' => 'arrows_color',
							'value' => '',
							'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
							'dependency' => array(
								'element' => 'enable_prev_next',
								'not_empty' => true,
							),
						),
						array(
							'type' => 'number',
							'heading' =>'<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the space between the post items','dfd').'</span></span>'. __('Items offset', 'dfd'),
							'param_name' => 'items_offset',
							'edit_field_class' => 'vc_column vc_col-sm-6  dfd-number-wrap crum_vc',
						),
						array(
							'type' => 'textfield',
							'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
							'param_name' => 'el_class',
						),
						array(
							   'type'        => 'dropdown',
							   'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd').'</span></span>'.esc_html__( 'Animation', 'dfd' ),
							   'param_name'  => 'module_animation',
							   'value'       => dfd_module_animation_styles(),
							   'description' => __( '', 'dfd' ),
							   'group'       => 'Animation Settings',
							),
					),
					'js_view' => 'VcColumnView'
				));
				vc_map(
					array(
						'name' =>  __( 'Top container', 'dfd' ),
						'base' => 'dfd_news_scroller_container_top',
						'as_parent' => array('only' => 'dfd_news_scroller_item_top'),
						'as_child' => array('only' => 'dfd_news_scroller'),
						'content_element' => true,
						'category' => esc_attr__('Ronneby 2.0','dfd'),
						'icon' => 'dfd_news_scroller_container_top dfd_shortcode',
						'show_settings_on_create' => false,
						'js_view' => 'VcColumnView',
						'params' => array(
							array(
								'type' => 'textfield',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
								'param_name' => 'el_class',
							),
						)
					)
				);
				vc_map(
					array(
						'name' =>  __( 'Bottom container', 'dfd' ),
						'base' => 'dfd_news_scroller_container_bottom',
						'as_parent' => array('only' => 'dfd_news_scroller_item_bottom'),
						'as_child' => array('only' => 'dfd_news_scroller'),
						'content_element' => true,
						'category' => esc_attr__('Ronneby 2.0','dfd'),
						'icon' => 'dfd_news_scroller_container_bottom dfd_shortcode',
						'show_settings_on_create' => false,
						'js_view' => 'VcColumnView',
						'params' => array(
							array(
								'type' => 'textfield',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
								'param_name' => 'el_class',
							),
						)
					)
				);
				vc_map(
					array(
						'name' => __('Post item', 'dfd'),
						'base' => 'dfd_news_scroller_item_top',
						'icon' => 'dfd_news_scroller_item_top dfd_shortcode',
						'category' => esc_attr__('Ronneby 2.0','dfd'),
						'content_element' => true,
						'as_child' => array('only' => 'dfd_news_scroller_container_top'),
						'params' => array(
							array(
								'type' => 'radio_image_post_select',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the single post to be shown','dfd').'</span></span>'.esc_html__('Post to show', 'dfd'),
								'param_name' => 'single_post_item',
								'value' => '',
								'post_type' => 'post',
								'css' => array(
									'width' => '120px',
									'height' => '120px',
									'background-repeat' => 'repeat',
									'background-size' => 'cover' 
								),
								'show_default' => false,
							),
							array(
								'type' => 'dfd_single_checkbox',
								'param_name' => 'show_title',
								'heading' => __('Title', 'dfd'),
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc',
								'options' => array(
									'true' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify tag for title typography','dfd').'</span></span>'. __('Tag','dfd'),
								'param_name' => 'heading_tag',
								'value'		=> 'h3',
								'options'	=> array(
									__('H1','dfd') => 'h1',
									__('H3','dfd') => 'h3',
									__('H4','dfd') => 'h4',
									__('H5','dfd') => 'h5',
									__('H6','dfd') => 'h6',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => Array('element' => 'show_title', 'not_empty' => true),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the horizontal alignment for the title','dfd').'</span></span>'. __('Title Alignment', 'dfd'),
								'param_name' => 'title_alignment',
								'value'		=> 'text-left',
								'options'	=> array(
									__('Left', 'dfd') => 'text-left',
									__('Center', 'dfd') => 'text-center',
									__('Right', 'dfd') => 'text-right'
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => Array('element' => 'show_title', 'not_empty' => true),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'param_name' => 'show_meta',
								'heading' => __('Date and author', 'dfd'),
								'value' => '',
								'options' => array(
									'true' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
							),
							array(
								'type' => 'dfd_single_checkbox',
								'class' => '',
								'param_name' => 'show_categories',
								'heading' => __('Categories', 'dfd'),
								'value' => '',
								'options' => array(
									'true' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the blog style. If you chosse simple, the post content will be displayed near the post featued image. If the style Advanced is choosen post content is set on the post\'s featured image','dfd').'</span></span>'. __('Post style', 'dfd'),
								'param_name' => 'post_style',
								'value'		=> 'default',
								'options'	=> array(
									__('Simple', 'dfd')	=>	'default',
									__('Advanced','dfd')		=>	'title_over_thumb',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the horizontal alignment for the blog content','dfd').'</span></span>'. __('Content Alignment', 'dfd'),
								'param_name' => 'content_alignment',
								'value'		=> 'dfd-content-left',
								'options'	=> array(
									__('Left', 'dfd') => 'dfd-content-left',
									__('Right', 'dfd') => 'dfd-content-right'
								),
								'dependency' => Array('element' => 'post_style', 'value' => array('default')),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'content_background',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to speciy the background color for the content. The default value is #f4f4f4','dfd').'</span></span>'. __('Content background', 'dfd'),
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => Array('element' => 'post_style', 'value' => array('default')),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable mask by default','dfd').'</span></span>'.__('Mask by default','dfd'),
								'param_name' => 'show_mask',
								'value' => '',
                                'options' => array(
                                    'yes'	=> array(
                                        'yes'	=> esc_attr__('Yes', 'dfd'),
                                        'no'	=> esc_attr__('No', 'dfd')
                                    ),
                                ),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'post_style','value' => array('title_over_thumb')),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'class' => '',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the mask style for the blog posts','dfd').'</span></span>'. __('Image mask style','dfd'),
								'param_name' => 'image_mask_style',
								'value'		=> '',
								'options'	=> array(
									__('Theme default','dfd') => '',
									__('Color','dfd') => 'color',
									__('Gradient','dfd') => 'gradient',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'image_mask_color',
								'class' => '',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the color for the image mask. The default color is rgba(27,27,27,0.5)','dfd').'</span></span>'. __('Image mask color', 'dfd'),
								'value' => '',
								'dependency' => array('element' => 'image_mask_style','value' => array('color')),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
							),
							array(
								'type' => 'dfd_gradient',
								'param_name' => 'image_mask_gradient',
								'class' => '',
								'heading' => __('Image mask gradient', 'dfd'),						
								'description' => '',
								'dependency' => array('element' => 'image_mask_style','value' => array('gradient')),
							),
							array(
								'type' => 'ult_param_heading',
								'text' => __('Heading Settings', 'dfd'),
								'param_name' => 'main_heading_typograpy',
								'group' => 'Typography',
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dfd_radio_advanced',
								'class' => '',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the heading type. You can choose custom google font here or leave defalt value','dfd').'</span></span>'. __('Heading type', 'dfd'),
								'param_name' => 'heading_typography_type',
								'value' => 'default',
								'options' => array(
									__('Default', 'dfd')	=>	'default',
									__('Google Fonts','dfd')		=>	'google_fonts',
								),
								'group' => 'Typography',
							),
							array(
								'type' => 'ultimate_google_fonts',
								'heading' => __('Font Family', 'dfd'),
								'param_name' => 'main_heading_font_family',
								'description' => __('Select the font of your choice. You can <a target="_blank" href="'.admin_url('admin.php?page=ultimate-font-manager').'">add new in the collection here</a>.', 'dfd'),
								'group' => 'Typography',
								'dependency' => Array('element' => 'heading_typography_type', 'value' => array('google_fonts')),
							),
							array(
								'type' => 'textfield',
								'heading' => __( 'Custom font family', 'dfd' ),
								'param_name' => 'main_heading_custom_family',
								'holder' => 'div',
								'value' => '',
								'group' => 'Typography',
								'dependency' => Array('element' => 'heading_typography_type', 'value' => array('default')),
							),
							array(
								'type' => 'ultimate_google_fonts_style',
								'heading' 		=>	__('Font Style', 'dfd'),
								'param_name'	=>	'main_heading_style',
								'dependency' => Array('element' => 'heading_typography_type', 'value' => array('google_fonts')),
								'group' => 'Typography'
							),
							array(
								'type' => 'dropdown',
								'heading' 		=>	__('Font Style', 'dfd'),
								'param_name'	=>	'main_heading_default_style',
								'value' => array(
									__('Theme default', 'dfd')	=>	'',
									__('Normal', 'dfd')	=>	'normal',
									__('Italic','dfd')		=>	'italic',
									__('Inherit','dfd')		=>	'inherit',
									__('Initial','dfd')		=>	'initial',
								),
								'dependency' => Array('element' => 'heading_typography_type', 'value' => array('default')),
								'group' => 'Typography'
							),
							array(
								'type' => 'dropdown',
								'heading' 		=>	__('Font Weight', 'dfd'),
								'param_name'	=>	'main_heading_default_weight',
								'value' => array(
									__('Default', 'dfd')	=>	'',
									'100'	=>	'100',
									'200'	=>	'200',
									'300'	=>	'300',
									'500'	=>	'500',
									'600'	=>	'600',
									'700'	=>	'700',
									'800'	=>	'800',
									'900'	=>	'900',
								),
								'dependency' => Array('element' => 'heading_typography_type', 'value' => array('default')),
								'group' => 'Typography'
							),
							array(
								'type' => 'number',
								'class' => 'font-size',
								'heading' => __('Font Size', 'dfd'),
								'param_name' => 'main_heading_font_size',
								'min' => 10,
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group' => 'Typography'
							),
							array(
								'type' => 'colorpicker',
								'heading' => __('Font Color', 'dfd'),
								'param_name' => 'main_heading_color',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group' => 'Typography'
							),
							array(
								'type' => 'number',
								'heading' => __('Line Height', 'dfd'),
								'param_name' => 'main_heading_line_height',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group' => 'Typography'
							),
							array(
								'type' => 'number',
								'heading' => __('Letter spacing', 'dfd'),
								'param_name' => 'main_heading_letter_spacing',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group' => 'Typography'
							),
							array(
								'type' => 'ult_param_heading',
								'text' => __('Post meta Settings', 'dfd'),
								'param_name' => 'sub_heading_typograpy',
								'group' => 'Typography',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the heading type. You can choose custom google font here or leave defalt value','dfd').'</span></span>'. __('Heading type', 'dfd'),
								'param_name' => 'subheading_typography_type',
								'value' => 'default',
								'options' => array(
									__('Default', 'dfd')	=>	'default',
									__('Google Fonts','dfd')		=>	'google_fonts',
								),
								'group' => 'Typography',
							),
							array(
								'type' => 'ultimate_google_fonts',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the font family from your collecton','dfd').'</span></span>'.__('Font Family', 'dfd'),
								'param_name' => 'sub_heading_font_family',
								'description' => __('You can <a target="_blank" href="'.admin_url('admin.php?page=ultimate-font-manager').'">add new in the collection here</a>.', 'dfd'),
								'group' => 'Typography',
								'dependency' => array('element' => 'subheading_typography_type', 'value' => array('google_fonts')),
							),
							array(
								'type' => 'textfield',
								'heading' => __( 'Custom font subfamily', 'dfd' ),
								'param_name' => 'main_subheading_custom_family',
								'holder' => 'div',
								'value' => '',
								'dependency' => array('element' => 'subheading_typography_type', 'value' => array('default')),
								'group' => 'Typography',
							),
							array(
								'type' => 'ultimate_google_fonts_style',
								'heading' 		=>	__('Font Style', 'dfd'),
								'param_name'	=>	'sub_heading_style',
								'dependency' => array('element' => 'subheading_typography_type', 'value' => array('google_fonts')),
								'group' => 'Typography',
							),
							array(
								'type' => 'dropdown',
								'heading' 		=>	__('Font Style', 'dfd'),
								'param_name'	=>	'sub_heading_default_style',
								'value' => array(
									__('Theme default', 'dfd')	=>	'',
									__('Normal', 'dfd')	=>	'normal',
									__('Italic','dfd')		=>	'italic',
									__('Inherit','dfd')		=>	'inherit',
									__('Initial','dfd')		=>	'initial',
								),
								'dependency' => Array('element' => 'subheading_typography_type', 'value' => array('default')),
								'group' => 'Typography'
							),
							array(
								'type' => 'dropdown',
								'heading' 		=>	__('Font Weight', 'dfd'),
								'param_name'	=>	'sub_heading_default_weight',
								'value' => array(
									__('Default', 'dfd')	=>	'',
									'100'	=>	'100',
									'200'	=>	'200',
									'300'	=>	'300',
									'500'	=>	'500',
									'600'	=>	'600',
									'700'	=>	'700',
									'800'	=>	'800',
									'900'	=>	'900',
								),
								'dependency' => Array('element' => 'subheading_typography_type', 'value' => array('default')),
								'group' => 'Typography'
							),
							array(
								'type' => 'number',
								'heading' => __('Font Size', 'dfd'),
								'param_name' => 'sub_heading_font_size',
								'min' => 14,
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group' => 'Typography',
							),
							array(
								'type' => 'colorpicker',
								'heading' => __('Font Color', 'dfd'),
								'param_name' => 'sub_heading_color',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group' => 'Typography',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Line Height', 'dfd'),
								'param_name' => 'sub_heading_line_height',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group' => 'Typography'
							),
							array(
								'type' => 'number',
								'heading' => __('Letter spacing', 'dfd'),
								'param_name' => 'sub_heading_letter_spacing',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group' => 'Typography'
							),
							array(
								'type' => 'textfield',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
								'param_name' => 'el_class',
							),
						)
					) 
				);
				vc_map(
					array(
					   'name' => __('Post item', 'dfd'),
					   'base' => 'dfd_news_scroller_item_bottom',
					   'icon' => 'dfd_news_scroller_item_bottom dfd_shortcode',
					   'category' => __('Ronneby 2.0','dfd'),
					   'content_element' => true,
					   'as_child' => array('only' => 'dfd_news_scroller_container_bottom'),
					   'params' => array(
							array(
								'type' => 'radio_image_post_select',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the single post to be shown','dfd').'</span></span>'. __('Post to show','dfd'),
								'param_name' => 'single_post_item',
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
							),
							array(
								'type' => 'dfd_single_checkbox',
								'param_name' => 'show_title',
								'heading' => __('Title', 'dfd'),
								'value' => '',
								'options' => array(
									'true' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc',
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify tag for title typography','dfd').'</span></span>'.__('Tag','dfd'),
								'param_name' => 'heading_tag',
								'value'		=> 'h3',
								'options'	=> array(
									__('H1','dfd') => 'h1',
									__('H3','dfd') => 'h3',
									__('H4','dfd') => 'h4',
									__('H5','dfd') => 'h5',
									__('H6','dfd') => 'h6',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => Array('element' => 'show_title', 'not_empty' => true),
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the horizontal alignment for the title','dfd').'</span></span>'. __('Title Alignment', 'dfd'),
								'param_name' => 'title_alignment',
								'value'		=> 'text-left',
								'options'	=> array(
									__('Left', 'dfd') => 'text-left',
									__('Center', 'dfd') => 'text-center',
									__('Right', 'dfd') => 'text-right'
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => Array('element' => 'show_title', 'not_empty' => true),
							),
							array(
								'type' => 'dfd_single_checkbox',
								'param_name' => 'show_meta',
								'heading' => __('Date and author', 'dfd'),
								'value' => '',
								'options' => array(
									'true' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
							),
							array(
								'type' => 'dfd_single_checkbox',
								'param_name' => 'show_categories',
								'heading' => __('Categories', 'dfd'),
								'value' => '',
								'options' => array(
									'true' => array(
										'on' => 'Yes',
										'off' => 'No',
									),
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the blog style. If you chosse simple, the post content will be displayed near the post featued image. If the style Advanced is choosen post content is set on the post\'s featured image','dfd').'</span></span>'. __('Post style', 'dfd'),
								'param_name' => 'post_style',
								'value'		=> 'default',
								'options'	=> array(
									__('Simple', 'dfd')	=>	'default',
									__('Advanced','dfd')		=>	'title_over_thumb',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the horizontal alignment for the blog content','dfd').'</span></span>'.  __('Content Alignment', 'dfd'),
								'param_name' => 'content_alignment',
								'value'		=> 'dfd-content-left',
								'options'	=> array(
									__('Left', 'dfd') => 'dfd-content-left',
									__('Right', 'dfd') => 'dfd-content-right'
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => Array('element' => 'post_style', 'value' => array('default')),
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'content_background',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to speciy the background color for the content. The default value is #f4f4f4','dfd').'</span></span>'. __('Content background', 'dfd'),
								'value' => '',
								'dependency' => Array('element' => 'post_style', 'value' => array('default')),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
							),
						   array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable mask by default','dfd').'</span></span>'. __('Mask by default','dfd'),
								'param_name' => 'show_mask',
								'value' => '',
                                'options' => array(
                                    'yes'	=> array(
                                        'yes'	=> esc_attr__('Yes', 'dfd'),
                                        'no'	=> esc_attr__('No', 'dfd')
                                    ),
                                ),
								'dependency' => array('element' => 'post_style','value' => array('title_over_thumb')),
							   'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the mask style for the blog posts','dfd').'</span></span>'. __('Image mask style','dfd'),
								'param_name' => 'image_mask_style',
								'value'		=> '',
								'options'	=> array(
									__('Theme default','dfd') => '',
									__('Color','dfd') => 'color',
									__('Gradient','dfd') => 'gradient',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
							),
							array(
								'type' => 'colorpicker',
								'param_name' => 'image_mask_color',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the color for the image mask. The default color is rgba(27,27,27,0.5)','dfd').'</span></span>'. __('Image mask color', 'dfd'),
								'value' => '',
								'dependency' => array('element' => 'image_mask_style','value' => array('color')),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
							),
							array(
								'type' => 'gradient',
								'param_name' => 'image_mask_gradient',
								'heading' => __('Image mask gradient', 'dfd'),						
								'description' => '',
								'dependency' => array('element' => 'image_mask_style','value' => array('gradient')),
							),
							array(
								'type' => 'ult_param_heading',
								'text' => __('Heading Settings', 'dfd'),
								'param_name' => 'main_heading_typograpy',
								'group' => 'Typography',
								'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the heading type. You can choose custom google font here or leave defalt value','dfd').'</span></span>'. __('Heading type', 'dfd'),
								'param_name' => 'heading_typography_type',
								'value' => 'default',
								'options' => array(
									__('Default', 'dfd')	=>	'default',
									__('Google Fonts','dfd')		=>	'google_fonts',
								),
								'group' => 'Typography',
							),
							array(
								'type' => 'ultimate_google_fonts',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the font family from your collecton','dfd').'</span></span>'.__('Font Family', 'dfd'),
								'param_name' => 'main_heading_font_family',
								'description' => __('You can <a target="_blank" href="'.admin_url('admin.php?page=ultimate-font-manager').'">add new in the collection here</a>.', 'dfd'),
								'group' => 'Typography',
								'dependency' => Array('element' => 'heading_typography_type', 'value' => array('google_fonts')),
							),
							array(
								'type' => 'textfield',
								'heading' => __( 'Custom font family', 'dfd' ),
								'param_name' => 'main_heading_custom_family',
								'holder' => 'div',
								'value' => '',
								'group' => 'Typography',
								'dependency' => Array('element' => 'heading_typography_type', 'value' => array('default')),
							),
							array(
								'type' => 'ultimate_google_fonts_style',
								'heading' 		=>	__('Font Style', 'dfd'),
								'param_name'	=>	'main_heading_style',
								'dependency' => Array('element' => 'heading_typography_type', 'value' => array('google_fonts')),
								'group' => 'Typography'
							),
							array(
								'type' => 'dropdown',
								'heading' 		=>	__('Font Style', 'dfd'),
								'param_name'	=>	'main_heading_default_style',
								'value' => array(
									__('Theme default', 'dfd')	=>	'',
									__('Normal', 'dfd')	=>	'normal',
									__('Italic','dfd')		=>	'italic',
									__('Inherit','dfd')		=>	'inherit',
									__('Initial','dfd')		=>	'initial',
								),
								'dependency' => Array('element' => 'heading_typography_type', 'value' => array('default')),
								'group' => 'Typography'
							),
							array(
								'type' => 'dropdown',
								'heading' 		=>	__('Font Weight', 'dfd'),
								'param_name'	=>	'main_heading_default_weight',
								'value' => array(
									__('Default', 'dfd')	=>	'',
									'100'	=>	'100',
									'200'	=>	'200',
									'300'	=>	'300',
									'500'	=>	'500',
									'600'	=>	'600',
									'700'	=>	'700',
									'800'	=>	'800',
									'900'	=>	'900',
								),
								'dependency' => Array('element' => 'heading_typography_type', 'value' => array('default')),
								'group' => 'Typography'
							),
							array(
								'type' => 'number',
								'class' => 'font-size',
								'heading' => __('Font Size', 'dfd'),
								'param_name' => 'main_heading_font_size',
								'min' => 10,
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group' => 'Typography'
							),
							array(
								'type' => 'colorpicker',
								'heading' => __('Font Color', 'dfd'),
								'param_name' => 'main_heading_color',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group' => 'Typography'
							),
							array(
								'type' => 'number',
								'heading' => __('Line Height', 'dfd'),
								'param_name' => 'main_heading_line_height',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group' => 'Typography'
							),
							array(
								'type' => 'number',
								'heading' => __('Letter spacing', 'dfd'),
								'param_name' => 'main_heading_letter_spacing',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group' => 'Typography'
							),
							array(
								'type' => 'ult_param_heading',
								'text' => __('Post meta Settings', 'dfd'),
								'param_name' => 'sub_heading_typograpy',
								'group' => 'Typography',
								'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'dfd_radio_advanced',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the heading type. You can choose custom google font here or leave defalt value','dfd').'</span></span>'. __('Heading type', 'dfd'),
								'param_name' => 'subheading_typography_type',
								'value' => 'default',
								'options' => array(
									__('Default', 'dfd')	=>	'default',
									__('Google Fonts','dfd')		=>	'google_fonts',
								),
								'group' => 'Typography',
							),
							array(
								'type' => 'ultimate_google_fonts',
								'heading' => __('Font Family', 'dfd'),
								'param_name' => 'sub_heading_font_family',
								'description' => __('Select the font of your choice. You can <a target="_blank" href="'.admin_url('admin.php?page=ultimate-font-manager').'">add new in the collection here</a>.', 'dfd'),
								'group' => 'Typography',
								'dependency' => Array('element' => 'subheading_typography_type', 'value' => array('google_fonts')),
							),
							array(
								'type' => 'textfield',
								'heading' => __( 'Custom font subfamily', 'dfd' ),
								'param_name' => 'main_subheading_custom_family',
								'holder' => 'div',
								'value' => '',
								'dependency' => Array('element' => 'subheading_typography_type', 'value' => array('default')),
								'group' => 'Typography',
							),
							array(
								'type' => 'ultimate_google_fonts_style',
								'heading' 		=>	__('Font Style', 'dfd'),
								'param_name'	=>	'sub_heading_style',
								'dependency' => Array('element' => 'subheading_typography_type', 'value' => array('google_fonts')),
								'group' => 'Typography',
							),
							array(
								'type' => 'dropdown',
								'heading' 		=>	__('Font Style', 'dfd'),
								'param_name'	=>	'sub_heading_default_style',
								'value' => array(
									__('Theme default', 'dfd')	=>	'',
									__('Normal', 'dfd')	=>	'normal',
									__('Italic','dfd')		=>	'italic',
									__('Inherit','dfd')		=>	'inherit',
									__('Initial','dfd')		=>	'initial',
								),
								'dependency' => Array('element' => 'subheading_typography_type', 'value' => array('default')),
								'group' => 'Typography'
							),
							array(
								'type' => 'dropdown',
								'heading' 		=>	__('Font Weight', 'dfd'),
								'param_name'	=>	'sub_heading_default_weight',
								'value' => array(
									__('Default', 'dfd')	=>	'',
									'100'	=>	'100',
									'200'	=>	'200',
									'300'	=>	'300',
									'500'	=>	'500',
									'600'	=>	'600',
									'700'	=>	'700',
									'800'	=>	'800',
									'900'	=>	'900',
								),
								'dependency' => Array('element' => 'subheading_typography_type', 'value' => array('default')),
								'group' => 'Typography'
							),
							array(
								'type' => 'number',
								'heading' => __('Font Size', 'dfd'),
								'param_name' => 'sub_heading_font_size',
								'min' => 14,
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group' => 'Typography',
							),
							array(
								'type' => 'colorpicker',
								'heading' => __('Font Color', 'dfd'),
								'param_name' => 'sub_heading_color',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'group' => 'Typography',
							),
							array(
								'type' => 'number',
								'heading' => __('Line Height', 'dfd'),
								'param_name' => 'sub_heading_line_height',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group' => 'Typography'
							),
							array(
								'type' => 'number',
								'heading' => __('Letter spacing', 'dfd'),
								'param_name' => 'sub_heading_letter_spacing',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
								'group' => 'Typography'
							),
							array(
								'type' => 'textfield',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
								'param_name' => 'el_class',
							),
						)
					) 
				);
			}//endif
		}
	}
}
global $Dfd_News_Scroller;
if(class_exists('WPBakeryShortCodesContainer')) {
	class WPBakeryShortCode_dfd_news_scroller extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_dfd_news_scroller_container_top extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_dfd_news_scroller_container_bottom extends WPBakeryShortCodesContainer {}
}
if(class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_dfd_news_scroller_item_top extends WPBakeryShortCode {}
	class WPBakeryShortCode_dfd_news_scroller_item_bottom extends WPBakeryShortCode {}
}
if(class_exists('Dfd_News_Scroller')) {
	$Dfd_News_Scroller = new Dfd_News_Scroller;
}