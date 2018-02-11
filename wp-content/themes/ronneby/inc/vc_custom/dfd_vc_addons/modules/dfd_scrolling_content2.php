<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists("Dfd_Scrolling_Content2")){
	class Dfd_Scrolling_Content2{
		
		function __construct(){
			add_action('init', array($this, 'dfd_scrolling_content_init2'));
			add_shortcode('dfd_scrolling_content2', array($this, 'dfd_scrolling_content_shortcode2'));
		}
		
		function dfd_scrolling_content_init2(){
			if(function_exists("vc_map")){
				new dfd_hide_unsuport_module_frontend("scroll_content_block2");
				vc_map(
					array(
						"name" => __('Scrolling content blocks2', 'dfd'),
						'base' => "dfd_scrolling_content2",
						'icon' => "dfd_scrolling_content2 dfd_shortcode",
						'class' => "scroll_content_block2",
						'as_parent' => array('except' => 'vc_gmaps'),
						'content_element' => true,
						'controls' => 'full',
						'show_settings_on_create' => true,
						'category' => esc_attr__('Ronneby 2.0','dfd'),
						'params' => array(
							array(
								'type' => 'dfd_single_checkbox',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the dots navigation','dfd').'</span></span>'.esc_html__('Dots navigation', 'dfd'),
								'param_name' => 'disable_dots',
								'value' => '',
								'options'			=> array(
									'yes'				=> array(
										'yes'				=> esc_attr__('Yes', 'dfd'),
										'no'				=> esc_attr__('No', 'dfd'),
									),
								),
							),
							array(
								'type' => 'textfield',
								'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
								'param_name' => 'el_class',
						  	),
						),
						'js_view' => 'VcColumnView'
					)
				); // vc_map
			}
		}
		
		function dfd_scrolling_content_shortcode2($atts, $content){
			if(dfd_show_unsuport_nested_module_frontend("Scrolling content blocks2")) return false;
			
			$el_class = $disable_dots = '';
			
			extract(shortcode_atts(array(
				'disable_dots' => '',
				'el_class' => ''
			),$atts));
			
			$show_dots = ($disable_dots) ? 'false' : 'true';
			
			ob_start();
			$uniqid = uniqid(rand());
			echo '<div class="dfd-full-screen-scroll-content-wrapper">';
			echo '<div id="'.esc_attr($uniqid).'" class="dfd-full-screen-scroll-content-second '.esc_attr($el_class).'">';
				echo do_shortcode($content);
			echo '</div>';
			echo '</div>';
			?>
			<script type="text/javascript">
				(function($) {
					"use strict";
					$(window).load(function() {
						var width, height;
						var $carousel = $('#<?php echo esc_js($uniqid); ?>');
						var $wrap = $carousel.parents('.vc-row-wrapper');
						if (!Modernizr.touch) {
							$carousel.prepend('<div />');
							$carousel.append('<div />');
							$carousel.find('> * ').addClass('dfd-scrolling-content-slide');
							$carousel.slick({
								infinite: false,
								slidesToShow: 1,
								slidesToScroll: 1,
								arrows: false,
								dots: <?php echo esc_js($show_dots) ?>,
								draggable: false,
								autoplay: false,
								speed: 700,
								vertical: true
							});
							
							$carousel.find('.slick-slide.dfd-scrolling-content-slide').wrapInner('<div class="dfd-vertical-aligned" />');
							
							var recalcValues = function() {
								var heightOffset = 0;
								var widthOffset = 0;
								/*
								if($('body').hasClass('admin-bar')) {
									heightOffset = $('#wpadminbar').outerHeight();
								}
								if($('body > .boxed_layout').length > 0) {
									$('body > .boxed_layout').css('maxWidth', '100%');
								}
								 */
								if($('.dfd-custom-padding-html').length > 0) {
									var bodyOffset = $('.dfd-custom-padding-html').css('margin').replace('px', '');
									heightOffset += bodyOffset * 2;
									widthOffset = bodyOffset * 2;
								}
								width = $(window).width() - widthOffset;
								height = $(window).height() - heightOffset;
								$carousel.find('> .slick-list').css({
									height : height,
									maxHeight : height
								}).find('.slick-slide.dfd-scrolling-content-slide').css({
									//width : width,
									maxWidth : width,
									height : height,
									maxHeight : height
								});
							};

							recalcValues();

							var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? 'DOMMouseScroll' : 'mousewheel';
							$wrap.addClass('dfd-scrolling-content-outer').bind(mousewheelevt, function(e){
								var ev = window.event || e;
								ev = ev.originalEvent ? ev.originalEvent : ev;
								var delta = ev.detail ? ev.detail*(-40) : ev.wheelDelta;
								if(delta > 0) {
									if($carousel.find('.slick-slide.slick-active').prev('.slick-slide').length > 0) {
										ev.preventDefault();
										$(window).scrollTo($carousel.parents('.dfd-full-screen-scroll-content-wrapper'), {duration:'fast'});
										$carousel.eq(0).slick('slickPrev');
									}
								} else {
									if($carousel.find('.slick-slide.slick-active').next('.slick-slide').length > 0) {
										ev.preventDefault();
										$(window).scrollTo($carousel.parents('.dfd-full-screen-scroll-content-wrapper'), {duration:'fast'});
										$carousel.eq(0).slick('slickNext');
									}
								}
							});
							/*
							$('body').keyup(function(e) {
								if (e.keyCode == 38 || e.keyCode == 37) {
									if($('#<?php echo esc_js($uniqid); ?> .slick-slide.slick-active').prev('.slick-slide').length > 0) {
										$('#<?php echo esc_js($uniqid); ?>').slickPrev();
									}
								}
								if (e.keyCode == 40 || e.keyCode == 39) {
									if($('#<?php echo esc_js($uniqid); ?> .slick-slide.slick-active').next('.slick-slide').length > 0) {
										$('#<?php echo esc_js($uniqid); ?>').slickNext();
									}
								}
							});
							*/
							
							$(window).on('load resize', recalcValues);
						}
					});
				})(jQuery);
			</script>
            <?php
			return ob_get_clean();
		}
	}
	new Dfd_Scrolling_Content2;
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_dfd_scrolling_content2 extends WPBakeryShortCodesContainer {
		}
	}
}