<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$html = $css = $slide_bg_check = $el_class = $dfd_sbs_responsive_enable = $sbs_responsive_styles = $css_rules = $responsive_class = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if(isset($slide_bg_check) && strcmp($slide_bg_check, 'column-background-dark') === 0) {
	$el_class .= ' dfd-background-dark';
}

/*Resposive css rules*/
if(isset($dfd_sbs_responsive_enable) && $dfd_sbs_responsive_enable == 'dfd-sbs-responsive-enable' && isset($sbs_responsive_styles) && $sbs_responsive_styles != '') {
	$responsive_class .= uniqid('vc-sbs-responsive-');
	$css_rules .= Dfd_Resposive_Param::responsive_css($sbs_responsive_styles, '.ms-section.'.$responsive_class);
	$el_class .= ' '.$responsive_class;
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$html .= '<div class="ms-section '.esc_attr($css_class).'">';
	$html .= do_shortcode($content);
	if(!empty($css_rules)) {
		$html .= '<script type="text/javascript">'
					. '(function($) {'
						. '$("head").append("<style>'.$css_rules.'</style>");'
					. '})(jQuery);'
				. '</script>';
	}
$html .= '</div>';

print $html;