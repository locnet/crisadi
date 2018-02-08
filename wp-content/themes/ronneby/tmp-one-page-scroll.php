<?php
/*
Template Name: For one page scroll
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }

$additional_layout_class = DfdMetaboxSettings::get('dfd_enable_page_spacer') ? 'dfd-custom-padding-html' : '';
$animation_style = DfdMetaboxSettings::get('dfd_animation_style');
$smart_header = DfdMetaboxSettings::get('dfd_auto_header_colors');
$enable_dots = DfdMetaboxSettings::get('dfd_enable_dots') != 'off' ? 'true' : 'false';

if($animation_style != 'none' && $animation_style != '') {
	$enable_animation = 'true';
	$animation_style_class = ' dfd-enable-onepage-animation '.$animation_style;
} else {
	$animation_style_class = ' dfd-disable-onepage-animation ';
	$enable_animation = 'false';
}

?>

<section id="layout" class="no-title one-page-scroll <?php echo esc_attr($animation_style_class); ?>" data-enable-dots="<?php echo $enable_dots ?>" data-enable-animation="<?php echo $enable_animation ?>" <?php 
		if($smart_header == 'on') {
			echo ' data-smart-header="1"';
		}
	?>>

	<?php get_template_part('templates/content', 'page'); ?>
	
</section>