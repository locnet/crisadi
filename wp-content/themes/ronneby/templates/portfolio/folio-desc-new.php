<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby, $description_position;
$custom_fields = $acf_columns = $columns = '';
$acf_html = array();

if (function_exists('get_field_objects')) {
	$fields = get_field_objects();
} else {
	$fields = false;
}
?>

<?php if((!isset($dfd_ronneby['entry_meta_display']) || $dfd_ronneby['entry_meta_display']) && (strcmp($description_position, 'left') !== 0 && strcmp($description_position, 'right') !== 0)) : ?>
	<div class="dfd-folio-add-fields-wrap">
		<?php get_template_part('templates/portfolio/additional','fields'); ?>
	</div>
<?php endif; ?>

<div class="columns twelve">
	<div class="folio-info-field folio-info-field-inner">
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
</div>

<?php
if(!empty($fields)) {
	$count = count($fields);
	foreach ($fields as $field_name => $field) {
		$html = '';
		if (!empty($field['label']) && !empty($field['value'])) {
			$html .= '<div class="twelve columns">';
				$html .= '<div class="'. strtolower($field['label']) .' folio-info-field">';
					$html .= '<div class="folio-field-name box-name">'. $field['label'] .'</div>';
					if(is_array($field['value'])) {
						foreach($field['value'] as $cont) {
							if(is_object($cont)) {
								$html .= '<span>'. $cont -> name .'</span></br>';
							}else{
								$html .= '<p>'. $cont .'</p>';
							}
						}
					}else{
						$html .= do_shortcode($field['value']);
					}
				$html .= '</div>';
			$html .= '</div>';
			$acf_html[$field['order_no']] = $html;
		}
	}
	ksort($acf_html);
	if(!empty($acf_html) && is_array($acf_html)) {
		foreach($acf_html as $k => $v) {
			echo $v;
		}
	}
}
?>

<?php if(strcmp($description_position, 'left') === 0 || strcmp($description_position, 'right') === 0) : ?>
	<?php get_template_part('templates/portfolio/additional','fields'); ?>
	<div class="columns twelve">
		<div class="folio-info-field folio-add-info">
			<?php get_template_part('templates/entry-meta/mini', 'add-info'); ?>
		</div>
	</div>
<?php endif;