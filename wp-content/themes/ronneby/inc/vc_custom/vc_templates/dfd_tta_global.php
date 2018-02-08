<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $this WPBakeryShortCode_VC_Tta_Accordion|WPBakeryShortCode_VC_Tta_Tabs|WPBakeryShortCode_VC_Tta_Tour|WPBakeryShortCode_VC_Tta_Pageable
 */
/* @var $this WPBakeryShortCode_VC_Tta_Tabs */
$el_class = $css = '';
$type = $this->getShortcode();
if (!function_exists("check_property")) {

	function check_property(&$property) {
		$result = (isset($property) && (!empty($property) || $property == 0));
		if (is_int($property) && $result) {
			return $property >= 0;
		}
		if ($result) {
			return true;
		}
		return false;
	}

}
//$atts["gap"]="";
//print_r($atts);
//$gap_replace = "";
//if (isset($atts["style"]) && $atts["style"] == "big_icon") {
//	if (isset($atts["gap"])) {
//		$gap_replace = $atts["gap"];
//		$atts["gap"] = "";
//	}
//}

$tab_title_font_options = $tab_title_google_fonts = $tab_title_custom_fonts = $tab_title_uppercase = $tour_title_font_options = $tour_title_google_fonts = '';
$tour_title_custom_fonts = $tour_title_uppercase = $disable_plus_minus = $active_two_px_border = '';

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
$this->resetVariables($atts, $content);
extract($atts);

$this->setGlobalTtaInfo();

$this->enqueueTtaStyles();
$this->enqueueTtaScript();
//echo "<pre>";
//print_r($atts);
//echo "</pre>";
$style = check_property($style) ? esc_attr($style) : "";
$border_radius = check_property($border_radius) ? esc_attr($border_radius) . "px !important" : "";
$border_color_radius = check_property($border_color_radius) ? esc_attr($border_color_radius) . "" : "";
$color_content_area = check_property($color_content_area) ? esc_attr($color_content_area) : "";
$underline = isset($underline) && $underline == "on" ? "underline" : "";
$c_icon_position = isset($c_icon_position) ? "icon-position-" . $c_icon_position : "";
$tab_active_color_text = check_property($tab_active_color_text) ? esc_attr($tab_active_color_text) : "";
$tab_active_hover_color_text = check_property($tab_active_hover_color_text) ? esc_attr($tab_active_hover_color_text) : "";
$tab_hover_text_color = check_property($tab_hover_text_color) ? esc_attr($tab_hover_text_color) : "";
$tab_text_color = check_property($tab_text_color) ? esc_attr($tab_text_color) : "";
$border_color_active = check_property($border_color_active) ? esc_attr($border_color_active) : "";
$font_size = check_property($font_size) ? esc_attr($font_size) : "";
$icon_color = check_property($icon_color) ? esc_attr($icon_color) : "";
$icon_size = check_property($icon_size) ? esc_attr($icon_size) : "";
$module_animation = isset($module_animation) ? $module_animation : "";
$tab_title_font_options = _crum_parse_text_shortcode_params($tab_title_font_options, '', $tab_title_google_fonts, $tab_title_custom_fonts);
$tour_title_font_options = _crum_parse_text_shortcode_params($tour_title_font_options, '', $tour_title_google_fonts, $tour_title_custom_fonts);

/* * ************************
 * Appear Animation
 * *********************** */

$animation_data  = $an_class = '';

if (!( $module_animation == '' )) {
	$an_class .= 'cr-animate-gen ';
	$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
}

$active_two_px_border = isset($active_two_px_border) && $active_two_px_border == 'on' ? 'show_two_px' : '';
$show_separator_line = isset($show_separator_line) && $show_separator_line == "on" ? "show_separator" : "hide_separator";
//$gap = $gap_replace;
$gap = isset($gap) ? (int) $gap : 0;
$id = uniqid();
if ($style == "collapse")
	$border_radius = "0px";
if ($style == "big_icon")
	$border_radius = "2px !important";
/* Add padding to content area if background color is exist */
$padding = "";
if ($color_content_area != "inherit" && $color_content_area != "") {
	$padding = "padding-left:20px;padding-right:20px;";
	if ($type == "vc_tta_tour")
		$padding .= "padding-top:20px;padding-bottom:20px;";
}
$separator_space = ($gap / 2);
if (!$separator_space) {
	if ($padding) {
		$separator_space = 7;
	} else {
		$separator_space = 0;
	}
}
// It is required to be before tabs-list-top/left/bottom/right for tabs/tours
$prepareContent = $this->getTemplateVariable('content');
$class_to_filter = $this->getTtaGeneralClasses();
$class_to_filter.=" " . $underline . " " . $type . " " . $show_separator_line . " " . $c_icon_position . " " .$active_two_px_border. " ";
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ') . $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
$output = '<div class="dfd_tabs_block '.$an_class.'" id="tabid_' . $id . '" '.$animation_data.'>';
$output .= '<div ' . $this->getWrapperAttributes() . '>';
$output .= $this->getTemplateVariable('title');
$output .= '<div class="' . esc_attr($css_class) . " " . esc_attr($style) . '">';
$output .= $this->getTemplateVariable('tabs-list-top');
$output .= $this->getTemplateVariable('tabs-list-left');
$output .= '<div class="vc_tta-panels-container ' . $style . '">';
$output .= $this->getTemplateVariable('pagination-top');
$output .= '<div class="vc_tta-panels">';
$output .= $prepareContent;
$output .= '</div>';
$output .= $this->getTemplateVariable('pagination-bottom');
$output .= '</div>';
$output .= $this->getTemplateVariable('tabs-list-bottom');
$output .= $this->getTemplateVariable('tabs-list-right');
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo $output;

$id = "#tabid_" . $id;

ob_start();

    /*Tabs*/
$dfd_tab_style = '';
	if(isset($border_radius) && $border_radius != '') {
		$dfd_tab_style .= $id.'.dfd_tabs_block .vc_tta-tabs:not(.empty_style) .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a, '.$id.'.dfd_tabs_block .dfd_tta_tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading a {border-radius: '.$border_radius.';}';
		$dfd_tab_style .= $id.'.dfd_tabs_block .vc_tta-tabs.classic_empty .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a {border-radius: '.$border_radius.';}';
	}
	if(isset($border_color_radius) && !empty($border_color_radius)) {
		$dfd_tab_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a, '.$id.'.dfd_tabs_block .dfd_tta_tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading a {border-color: '.$border_color_radius.';}';
		$dfd_tab_style .= $id.'.dfd_tabs_block .vc_tta-tabs.classic_empty .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a {border-color: '.$border_color_radius.' !important;}';
	}
	if(isset($font_size) && $font_size != '') {
		$dfd_tab_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a, '.$id.'.dfd_tabs_block .dfd_tta_tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading a {font-size: '.$font_size.'px !important;}';
	}
	if(isset($tab_text_color) && !empty($tab_text_color)) {
		$dfd_tab_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a, '.$id.'.dfd_tabs_block .dfd_tta_tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading a {color: '.$tab_text_color.';}';
	}
	if(isset($tab_background) && !empty($tab_background)) {
		$dfd_tab_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab:not(.vc_active) a {background-color: '.$tab_background.' !important;}';
	}
	if(isset($tab_hover_text_color) && !empty($tab_hover_text_color)) {
		$dfd_tab_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a:hover, '.$id.'.dfd_tabs_block .dfd_tta_tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading a:hover {color: '.$tab_hover_text_color.' !important;}';
	}
	if(isset($tab_hover_background) && !empty($tab_hover_background)) {
		$dfd_tab_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a:hover, '.$id.'.dfd_tabs_block .dfd_tta_tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading a:hover {background-color: '.$tab_hover_background.' !important;}';
	}
	if(isset($icon_size) && $icon_size != '') {
		$dfd_tab_style .= $id.'.dfd_tabs_block .dfd_tta_tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a .vc_tta-icon {font-size: '.$icon_size.'px !important;}';
	}
	if(isset($icon_color) && !empty($icon_color)) {
		$dfd_tab_style .= $id.'.dfd_tabs_block .dfd_tta_tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a .vc_tta-icon {color: '.$icon_color.';}';
	}
	if(isset($tab_active_color_text) && !empty($tab_active_color_text)) {
		$dfd_tab_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a {color: '.$tab_active_color_text.';}';
	}
	if(isset($active_tab_background) && !empty($active_tab_background)) {
		$dfd_tab_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a, '.$id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a:hover {background-color: '.$active_tab_background.' !important;}';
	}
	if(isset($tab_active_hover_color_text) && !empty($tab_active_hover_color_text)) {
		$dfd_tab_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a:hover {color: '.$tab_active_hover_color_text.' !important;}';
	}
	if(isset($color_content_area) && !empty($color_content_area)) {
		$dfd_tab_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-panels-container .vc_tta-panel {background-color: '.$color_content_area.';}';
	}
	if(isset($padding) && $padding != '') {
		$dfd_tab_style .= $id.'.dfd_tabs_block .vc_tta-panel .vc_tta-panel-body {'.$padding.';}';
	}
	if(isset($tab_title_font_options['style']) && $tab_title_font_options['style'] != '') {
		$dfd_tab_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a,'.$id.'.dfd_tabs_block .dfd_tta_tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading a {'.$tab_title_font_options['style'].'}';
	}
	if(isset($tab_title_uppercase) && $tab_title_uppercase != '') {
		$dfd_tab_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a,'.$id.'.dfd_tabs_block .dfd_tta_tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading a {text-transform: '.$tab_title_uppercase.'}';
	}
echo $dfd_tab_style;

    /*Accordion*/
$dfd_acc_style = '';
	if(isset($disable_plus_minus) && !empty($disable_plus_minus)) {
		$dfd_acc_style .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel-heading .vc_tta-panel-title .vc_tta-controls-icon {display: none;}';
		$dfd_acc_style .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel-heading .vc_tta-panel-title a {padding-left: 14px;}';
	}
	if(isset($tab_title_font_options['style']) && $tab_title_font_options['style'] != '') {
		$dfd_acc_style .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-heading h4 a {'.$tab_title_font_options['style'].'}';
	}
	if(isset($border_color_active) && !empty($border_color_active)) {
		$dfd_acc_style .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading {border-color: '.$border_color_active.' !important;}';
		$dfd_acc_style .= $id.'.dfd_tabs_block .vc_tta-accordion.show_two_px .vc_tta-panel.vc_active .vc_tta-panel-heading {-webkit-box-shadow: inset 0px 0px 0px 1px '.$border_color_active.'; box-shadow: inset 0px 0px 0px 1px '.$border_color_active.';}';
	}
echo $dfd_acc_style;
?>
<?php echo $id; ?>.dfd_tabs_block .vc_tta-panel .vc_tta-panel-heading{
        border-color: <?php echo $border_color_radius ?>; 
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading{
		background-color: <?php echo $tab_background; ?> !important;
		border-radius:<?php echo $border_radius; ?>;	
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading:hover{
		background-color: <?php echo $tab_hover_background; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading{
		background-color: <?php echo $active_tab_background; ?> !important;
		border-radius:<?php echo $border_radius; ?>;	
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-body{
        background-color: <?php echo $color_content_area; ?>;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-heading h4 a{
		font-size: <?php echo $font_size; ?>px !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading h4 a{
		color:<?php echo $tab_text_color; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading h4 a:hover{
		color:<?php echo $tab_hover_text_color; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading h4 a{
		color:<?php echo $tab_active_color_text; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading h4 a i:before, <?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading h4 a i:after{
		border-color: <?php echo $tab_active_color_text; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-heading h4 a i:before, <?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-heading h4 a i:after{
		border-color: <?php echo $tab_text_color; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-heading h4 a .vc_tta-icon{
		font-size: <?php echo $icon_size; ?>px !important;	
		color: <?php echo $icon_color; ?>;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title a .vc_tta-title-text .accordion_inner_text{
		font-size: <?php echo $font_size; ?>px !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-title a .vc_tta-title-text .accordion_inner_text{
		color:<?php echo $tab_active_color_text; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-title a .vc_tta-title-text .accordion_inner_text{
		color:<?php echo $tab_text_color; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-title a .vc_tta-title-text .accordion_inner_text:hover{
		color:<?php echo $tab_hover_text_color; ?> !important;
    }
<?php
    /* Tour*/
$dfd_tour_style = '';
	if(isset($font_size) && $font_size != '') {
		$dfd_tour_style .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab a {font-size: '.$font_size.'px !important;}';
	}
	if(isset($icon_size) && $icon_size != '') {
		$dfd_tour_style .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab a .vc_tta-icon {font-size: '.$icon_size.'px !important;}';
	}
	if(isset($icon_color) && !empty($icon_color)) {
		$dfd_tour_style .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab a .vc_tta-icon {color: '.$icon_color.';}';
	}
	if(isset($tab_background) && !empty($tab_background)) {
		$dfd_tour_style .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab:not(.vc_active) a {background-color: '.$tab_background.';}';
	}
	if(isset($tab_text_color) && !empty($tab_text_color)) {
		$dfd_tour_style .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab:not(.vc_active) a {color: '.$tab_text_color.' !important;}';
		$dfd_tour_style .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab a:before, '.$id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab a:after {border-color: '.$tab_text_color.' !important;}';
	}
	if(isset($tab_hover_background) && !empty($tab_hover_background)) {
		$dfd_tour_style .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab:not(.vc_active) a:hover {background-color: '.$tab_hover_background.' !important;}';
	}
	if(isset($tab_hover_text_color) && !empty($tab_hover_text_color)) {
		$dfd_tour_style .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab:not(.vc_active) a:hover {color: '.$tab_hover_text_color.' !important;}';
	}
	if(isset($active_tab_background) && !empty($active_tab_background)) {
		$dfd_tour_style .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab.vc_active a {background-color: '.$active_tab_background.' !important;}';
	}
	if(isset($tab_active_color_text) && !empty($tab_active_color_text)) {
		$dfd_tour_style .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab.vc_active a {color: '.$tab_active_color_text.' !important;}';
		$dfd_tour_style .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab.vc_active a:before, '.$id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab.vc_active a:after {border-color: '.$tab_active_color_text.' !important;}';
	}
	if(isset($border_color_active) && !empty($border_color_active)) {
		$dfd_tour_style .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab.vc_active a {border-color: '.$border_color_active.' !important;}';
	}
	if(isset($tour_title_font_options['style']) && $tour_title_font_options['style'] != '') {
		$dfd_tour_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a,'.$id.'.dfd_tabs_block .dfd_tta_tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading a  {'.$tour_title_font_options['style'].'}';
	}
	if(isset($tour_title_uppercase) && $tour_title_uppercase != '') {
		$dfd_tour_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a,'.$id.'.dfd_tabs_block .dfd_tta_tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading a  {text-transform: '.$tour_title_uppercase.'}';
	}
echo $dfd_tour_style;
?>
    /*Separator*/
<?php echo $id; ?>.dfd_tabs_block .dfd_tta_tabs:not(.big_icon) .vc_tta-panels-container:before{
		top:-<?php echo $separator_space; ?>px !important;
    }
<?php echo $id; ?>.dfd_tabs_block .dfd_tta_tabs:not(.big_icon) .vc_tta-panels-container:after{
		bottom:-<?php echo $separator_space; ?>px !important;
    }
<?php $css = ob_get_clean();?>
	
<?php ?>
<script type="text/javascript">
	(function($){
		$('head').append('<style type="text/css"><?php echo esc_js($css); ?></style>');
		$("<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion.underline .vc_tta-title-text").each(function(){
			var accordion_text = $(this).text();
			$(this).text(" ");
			$(this).append("<div class='accordion_inner_text'>" + accordion_text + "</div>");
		});

		$("<?php echo $id; ?> .vc_tta-accordion .vc_tta-panels .vc_tta-panel").each(function(){
			var $icon = $(this).find(".vc_tta-icon");
			if($icon[0]){
				$(this).find(".vc_tta-panel-title").addClass("hasIcon");
			}
		});

	})(jQuery);
</script>
<?php ?>