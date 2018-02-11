<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby, $description_position;
$acf_columns = $columns = '';
$acf_html = array();
if (function_exists('get_field_objects')) {
	$fields = get_field_objects();
} else {
	$fields = false;
}
if(strcmp($description_position, 'left') === 0 || strcmp($description_position, 'right') === 0) {
	$add_info_columns = $desc_columns = 'twelve';
} else {
	$add_info_columns = 'three';
	$desc_columns = 'nine';
}
if(!empty($fields)) {
	$i = 1;
	$count = count($fields);
	foreach ($fields as $field_name => $field) {
		$custom_fields = '';
		if (!empty($field['label']) && !empty($field['value'])) {
			$custom_fields .= '<div class="folio-info-field eq-height '.strtolower($field['label']).' twelve columns">';
			$custom_fields .= '<div class="folio-field-name box-name">'.$field['label'].'</div>';
			if(is_array($field['value'])) {
				foreach($field['value'] as $cont) {
					$custom_fields .= '<p>'.$cont.'</p>';
				}
			}else{
				$custom_fields .= do_shortcode($field['value']);
			}
			$custom_fields .= '</div>';
			$i++;
		}
		$acf_html[$field['order_no']] = $custom_fields;
	}
	ksort($acf_html);
}
?>

<div class="folio-info-field folio-info-field-inner eq-height columns <?php echo esc_attr($desc_columns); ?>">
	<?php if(isset($dfd_ronneby['portfolio_inner_description_title']) && !empty($dfd_ronneby['portfolio_inner_description_title'])) : ?>
		<div class="folio-field-name box-name"><?php echo $dfd_ronneby['portfolio_inner_description_title']; ?></div>
	<?php endif; ?>
	<?php 
		while (have_posts()) {
			the_post();
			echo get_the_content();
		}
	?>
</div>

<?php if((!isset($dfd_ronneby['entry_meta_display']) || $dfd_ronneby['entry_meta_display']) && (strcmp($description_position, 'left') !== 0 && strcmp($description_position, 'right') !== 0)) : ?>
<div class="folio-info-field folio-add-info columns <?php echo esc_attr($add_info_columns); ?>">
	<div class="box-name"><?php _e('Info', 'dfd') ?></div>
	<?php get_template_part('templates/portfolio/folio', 'meta'); ?>
	<?php get_template_part('templates/entry-meta/mini', 'add-info'); ?>
</div>
<?php endif; ?>

<?php
if(!empty($acf_html) && is_array($acf_html)) {
	foreach($acf_html as $k => $v) {
		echo $v;
	}
}
?>

<?php if((!isset($dfd_ronneby['entry_meta_display']) || $dfd_ronneby['entry_meta_display']) && (strcmp($description_position, 'left') === 0 || strcmp($description_position, 'right') === 0)) : ?>
<div class="folio-info-field folio-add-info columns <?php echo esc_attr($add_info_columns); ?>">
	<?php get_template_part('templates/entry-meta/mini', 'add-info'); ?>
	<div class="box-name"><?php _e('Info', 'dfd') ?></div>
	<?php get_template_part('templates/portfolio/folio', 'meta'); ?>
</div>
<?php endif; ?>