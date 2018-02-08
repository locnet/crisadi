<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby; ?>
<article <?php post_class(); ?>>
	<div class="entry-data">
		<figure class="author-photo">
			<?php echo get_avatar( get_the_author_meta('ID') , 40 ); ?>
		</figure>
		<?php get_template_part('templates/entry-meta', 'post-bottom'); ?>
	</div>

	<div class="entry-content">

		<?php     

		if(!get_post_format()) {
			get_template_part($post->ID, 'standard');
			the_content();
		} elseif (has_post_format('video')) {
			get_template_part('templates/post', 'video');
			the_content();
		} elseif (has_post_format('gallery')) {
			get_template_part('templates/post', 'gallery');
			the_content();
		} elseif (has_post_format('quote')) {
			get_template_part('templates/post', 'quote');
		} elseif (has_post_format('audio')) {
			get_template_part('templates/post', 'audio');
			the_content();
		}
	 ?>

	</div>
	<div class="dfd-meta-container">
		<div class="post-like-wrap left">
			<?php get_template_part('templates/entry-meta/mini-like', 'old'); ?>
			<div class="box-name"><?php _e('Recommend', 'dfd'); ?></div>
		</div>
		<div class="dfd-single-share left">
			<?php
			if (isset($dfd_ronneby['post_share_button']) && $dfd_ronneby['post_share_button']) {
				get_template_part('templates/entry-meta/mini', 'share-popup');
			}
			?>
			<div class="box-name"><?php _e('Share', 'dfd'); ?></div>
		</div>
		<div class="dfd-single-tags right">
			<?php get_template_part('templates/entry-meta/mini', 'tags'); ?>
			<div class="box-name"><?php _e('Tagged in', 'dfd'); ?></div>
		</div>
	</div>

</article>