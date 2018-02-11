<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Scrolling Effect Module
*/
if(!class_exists('Dfd_Scrolling_Effect')) 
{
	class Dfd_Scrolling_Effect{
		function __construct(){
			add_action('init',array($this,'dfd_scrolling_effect_init'));
			add_shortcode('dfd_scrolling_effect',array($this,'dfd_scrolling_effect_shortcode'));
		}
		function dfd_scrolling_effect_init(){
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   'name' => __('Scrolling effect module','dfd'),
					   'base' => 'dfd_scrolling_effect',
					   'icon' => 'dfd_scrolling_effect dfd_shortcode',
					   'category' => __('Ronneby 2.0','dfd'),
					   'description' => __('Pretty scrolling effect. Can be used at the top of the page only','dfd'),
					   'params' => array(
							array(
								'type' => 'attach_image',
								'heading'		=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the custom image from media library','dfd').'</span></span>'.esc_html__('Upload Image', 'dfd'),
								'param_name' => 'module_image',
								'value' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6',
							),
							array(
								'type' => 'number',
								'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add space above the image','dfd').'</span></span>'.esc_html__( 'Image offset ', 'dfd' ),
								'param_name' => 'module_image_offset',
								'value' => 0,
								'min' => '-500',
								'max' => '500',
								'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
							),
							array(
								'type' => 'textfield',
								'heading'	  => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd').'</span></span>'.esc_html__('Custom CSS Class', 'dfd'),
								'param_name' => 'el_class',
							),
						),
					)
				);
			}
		}
		// Shortcode handler function
		function dfd_scrolling_effect_shortcode($atts) {
			$output = $el_class = $module_image = $module_image_offset = $item_width = $item_height = '';
			
			extract(shortcode_atts( array(
				'module_image' => '',
				'module_image_offset' => '0',
				'el_class' => '',
			),$atts));
			
			$att_image_css = $image_width = $image_height = '';
			
			$image_src = wp_get_attachment_image_src($module_image, 'full');
			
			$uniqid = uniqid('dfd-scrolling-effect-');
			
			if(!empty($image_src[0]) && isset($image_src[1]) && isset($image_src[2])) {
				$image_width = $image_src[1];
				$image_height = $image_src[2];
			}
			if($image_src[0]) {
				$att_image_css .= '#'.esc_attr($uniqid).' .dfd-same-bg {background-image: url('.esc_url($image_src[0]).');}';
			}
			if(!empty($image_width) && !empty($image_height)) {
				$att_image_css .= '#'.esc_attr($uniqid).' .dfd-scaling-image {
							top: 50%;
							width: '.esc_attr($image_width).'px;
							height: '.esc_attr($image_height).'px;
							margin-left: -'.esc_attr($image_width/2).'px;
							margin-top: -'.esc_attr($image_height/2 - $module_image_offset).'px;
						}
						#'.esc_attr($uniqid).' .dfd-appearing-image {
							width: '.esc_attr($image_width*.3).'px;
							height: '.esc_attr($image_height*.3).'px;
							margin-top: '.esc_attr($image_height/2 + $module_image_offset).'px;
						}';
			}
			ob_start();
			?>
			
			<div id="<?php echo esc_attr($uniqid) ?>" class="dfd-scrolling-effect-module <?php echo esc_attr($el_class) ?>">
				
				<div class="dfd-scrolling-effect-item">
				
					<div class="dfd-scaling-image dfd-same-bg"></div>
					<div class="dfd-appearing-image dfd-same-bg"><img src="<?php echo esc_url($image_src[0]);?>" alt="image holder" style="visibility: hidden;" /></div>
				
				</div>
				
				<script type="text/javascript">
					(function($) {
						$(document).ready(function() {
							
							<?php if(!empty($att_image_css)) : ?>
								$('head').append('<style type="text/css"><?php echo esc_js($att_image_css) ?></style>');
							<?php endif; ?>
							
							if(!Modernizr.touch) {
								var $window = $(window),
									$container = $('#<?php echo esc_js($uniqid) ?>'),
									el = $('.dfd-scaling-image', $container),
									mac = $('.dfd-appearing-image', $container),
									offset = mac.offset();

								$window.on('scroll', function() {
									var windowTop = $window.scrollTop(),
										scrollPercent = (offset.top - windowTop) / offset.top,
										scale = 'scale(' + scrollPercent + ')';

									el.css('transform', scale);

									if (scrollPercent <= .3) {
										el.hide();
										mac.css('opacity',1);
									} else {
										el.show();
										mac.css('opacity',0);
									}
								});
							}
						});
					})(jQuery);
				</script>
				
			</div>
			<?php
			$output .= ob_get_clean();
			return $output;
		}
	}
}
if(class_exists('Dfd_Scrolling_Effect'))
{
	$Dfd_Scrolling_Effect = new Dfd_Scrolling_Effect;
}
