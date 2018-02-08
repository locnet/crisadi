<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="dfd-blog-loop dfd-blog-posts-module <?php echo esc_attr($el_class) ?>" id="<?php echo esc_attr($uniqid) ?>" <?php echo $data_atts ?>>
	<div class="dfd-blog-wrap">

<?php
		while ($wp_query->have_posts()) : $wp_query->the_post();

			$permalink = get_permalink();

			$excerpt = get_the_excerpt();

			if(!empty($excerpt)) {
				$excerpt = '<p>'.$excerpt.'</p>';
			}

			$post_class = get_post_class();

			$post_class = implode(' ', $post_class);
			
			$post_class .= ' '.$content_effect;
			
			$post_class .= ' '.$content_alignment;
			
			$enable_title = $enable_meta = true;
			
			?>
			<div class="<?php echo esc_attr($post_class) ?>">
				<div class="cover">
					<?php
					if (has_post_thumbnail()) {
						$thumb = get_post_thumbnail_id();
						$img_src = wp_get_attachment_image_src($thumb, array(70,70));
						if(isset($img_src[0]) && !empty($img_src[0])) {
							$img_url = $img_src[0];
						}
					} else {
						$img_url = get_template_directory_uri() . '/assets/images/no_image_resized_120-120.jpg';
					}
					?>

					<div class="clearfix">
						<div class="title-wrap">
							<?php include(locate_template('inc/vc_custom/dfd_vc_addons/templates/blog_posts/template_parts/heading.php')); ?>
						</div>
						<div class="entry-media">
							<div class="entry-thumb">
								<img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title(); ?>"/>
							</div>
						</div>
						<div class="entry-content">
							<?php echo $excerpt; ?>
							<?php if($read_more) : ?>
								<a href="<?php echo esc_url($permalink) ?>" class="more-button <?php echo esc_attr($read_more_style) ?>" title="<?php __('Read more','dfd') ?>" data-lang="en"><?php echo $read_more_word; ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<?php
		endwhile;
	wp_reset_postdata();
	?>
	</div>
</div>