<?php
/**
 * Duplicated and tweaked WP core Categories widget class
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

require_once(dirname(__FILE__).'/widget.php');

class Dfd_Category_Widged extends SB_WP_Widget {
	
	protected $widget_base_id = 'dfd_category';
	protected $widget_name = 'Custom: Wiget categories';
	
	protected $options;

    public function __construct() {
		$this->widget_args = array(
			'description' => __('Post category', 'dfd'),
		);
		
		$this->options = array(
			array(
				'title', 'text', '', 
				'label' => __('Title', 'dfd'), 
				'input'	=> 'text', 
				'filters' => 'widget_title', 
				'on_update' => 'esc_attr',
			),
//			array(
//				'dropdown', 'text', '', 
//				'label' => __('Display as dropdown', 'dfd'), 
//				'input' => 'checkbox', 
//				'filters' => 'widget_title', 
//				'on_update' => 'esc_attr',
//			),
//			array(
//				'count', 'text', '', 
//				'label' => __('Show post counts', 'dfd'), 
//				'input' => 'checkbox', 
//				'filters' => 'widget_title', 
//				'on_update' => 'esc_attr',
//			),
//			array(
//				'hierarchical', 'text', '', 
//				'label' => __('Show hierarchy', 'dfd'), 
//				'input' => 'checkbox', 
//				'filters' => 'widget_title', 
//				'on_update' => 'esc_attr',
//			),
		);
		
        parent::__construct();
    }

    function widget( $args, $instance ) {
        extract( $args );
		
		$before_container_cat_html = $after_container_html = $container_scroll_class = '';
		
		$this->setInstances($instance, 'filter');
		
		$title = $this->getInstance('title');
//		$dropdown = $this->getInstance('dropdown');
//		$count = $this->getInstance('count');
//		$hierarchical = $this->getInstance('hierarchical');

//        $c = !empty( $count ) ? '1' : '0';
//        $h = !empty( $hierarchical ) ? '1' : '0';
//        $d = !empty( $dropdown ) ? '1' : '0';

        echo $before_widget;

//		if ( $d ) {
//			$before_container_cat_html = '<div class="dk_container" style="display: block;"><a class="dk_toggle"><span class="dk_label">'. __('Category', 'dfd') .'</span></a><div class="dk_options">';
//			$after_container_html = '</div></div>';
//			$container_scroll_class = 'dk_options_inner';
//		}
		
		if(!empty($title)) {
			echo $before_title . $title . $after_title;
		}

//		$cat_args = array(
//			'orderby' => 'name',
//			'show_count' => $c,
//			'hierarchical' => $h
//		);

//		echo $before_container_cat_html ;?>
			<ul class="<?php echo $container_scroll_class ;?>">
			<?php
				$categories = get_categories();
				foreach($categories as $category) :
			?>
					<li>
						<a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php echo $category->name; ?></a>
					</li>

				<?php endforeach; ?>
			</ul>
		<?php
//		echo $after_container_html;

        echo $after_widget;
    }
}