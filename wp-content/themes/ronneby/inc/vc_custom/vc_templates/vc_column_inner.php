<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_Inner
 */
$output = $css_rules = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan($width);
$width = str_replace('vc_col-xs-','', $width );
$width = str_replace('vc_col-sm-','', $width );
$width = str_replace('vc_col-md-','', $width );
$width = str_replace('vc_col-lg-','', $width );
$offset = str_replace('vc_col-xs-','dfd_col-mobile-', $offset );
$offset = str_replace('vc_col-sm-','dfd_col-tablet-', $offset );
$offset = str_replace('vc_col-md-','dfd_col-laptop-', $offset );
$offset = str_replace('vc_col-lg-','dfd_col-tabletop-', $offset );
$width = dfd_vc_columns_to_string($width);
$width = vc_column_offset_class_merge($offset, $width);

/*Resposive css rules*/
$responsive_class = '';
if(isset($dfd_column_responsive_enable) && $dfd_column_responsive_enable == 'dfd-column-responsive-enable' && isset($responsive_styles) && $responsive_styles != '') {
	$responsive_class .= uniqid('vc-column-responsive-');
	$css_rules .= Dfd_Resposive_Param::responsive_css($responsive_styles, '.columns.'.$responsive_class);
	$el_class .= ' '.$responsive_class;
}

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'columns',
	$width,
	vc_shortcode_custom_css_class( $css ),
);

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= '<div class="wpb_wrapper">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>' . $this->endBlockComment( '.wpb_wrapper' );
if($css_rules != '') {
	$output .= '<script type="text/javascript">'
				. '(function($) {'
					. '$("head").append("<style>'.$css_rules.'</style>");'
				. '})(jQuery);'
			. '</script>';
}
$output .= '</div>' . $this->endBlockComment( $this->getShortcode() );

echo $output;