<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="blog-top-block mobile-hide">
	<div class="title"><?php echo esc_html__('Filter by:','dfd') ?></div>
	<?php
	$categories = get_terms('my-product_category');
	if(!empty($categories) && is_array($categories)) : ?>
		<div class="click-dropdown">
			<a href="#"><?php _e('Categories','dfd') ?><span></span></a>
			<div>
				<ul class="category-filer">
						<?php
						foreach($categories as $category) :
							$cat_url = get_term_link($category->slug, 'my-product_category');
							if(!is_wp_error($cat_url)) {
								$t_id = $category->term_id;
								$icon = get_option("taxonomy_$t_id");
								?>
								<li>
									<div class="icon-wrap"><i class="<?php echo !empty($icon['custom_term_meta']) ? $icon['custom_term_meta'] : 'none'; ?>"></i></div>
									<a href="<?php echo esc_url($cat_url); ?>"><?php echo $category->name; ?></a>
								</li>
							<?php
							}
						endforeach; ?>
				</ul>
			</div>
		</div>
	<?php endif; ?>
	<?php
	$id = get_the_ID();
	$tags = get_terms('my-product_tags');
	if(!empty($tags) && is_array($tags)) : ?>
		<div class="click-dropdown">
			<a href="#"><?php _e('Tags','dfd') ?><span></span></a>
			<div>
				<ul class="filter-tags">
					<?php
					foreach($tags as $tag) :
						$t_id = $tag->term_id;
						?>
						<li>
							<a href="<?php echo esc_url(get_term_link($tag->slug, 'my-product_tags')); ?>"><?php echo $tag->name; ?></a>
						</li>

					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	<?php endif; ?>
	<?php
	$users = get_users(array('who' => 'authors'));
	if(!empty($users) && is_array($users)) {
		echo '<div class="click-dropdown">';
			echo '<a href="#">'. esc_html__('Authors','dfd-native') .'<span></span></a>';
			echo '<div>';
				echo '<ul class="filter-authors">';
					foreach($users as $user) {
						if(count_user_posts($user->ID, 'my-product', true)) {
							echo '<li>'
									.'<a href="'.esc_url(get_author_posts_url($user->ID)).'" title="'.esc_attr($user->display_name).'">'.esc_html($user->display_name).'</a>'
								.'</li>';
						}
					}
				echo '</ul>';
			echo '</div>';
		echo '</div>';
	}
	?>
	<?php get_template_part('templates/entry-meta/folio-top-link'); ?>
</div>