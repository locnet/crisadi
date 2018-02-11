<?php
/**
 *  Name - Installer Panel
 *  Dependency - Core Admin Class
 *  Version - 1.0
 *  Code Name - Nobody
 */

class IOAEasyFrontInstaller extends PLUGIN_IOA_PANEL_CORE {
	
	
	// init menu
	function __construct () { 

		add_action('admin_menu',array(&$this,'manager_admin_menu'));
        add_action('admin_init',array(&$this,'manager_admin_init'));
        
	 }
	
	// setup things before page loads , script loading etc ...
	function manager_admin_init(){	 }
	
	function manager_admin_menu(){
		add_theme_page('Installer Panel', 'Installer Panel', 'edit_theme_options', 'easint' ,array($this,'manager_admin_wrap'));
	}

	
	/**
	 * Main Body for the Panel
	 */

	function panelmarkup(){	
	   global $easy_metadata, $config_suboption;
		
		$layouts = array(
			'main' => __('Main content', 'dfd_import'),
			'corporate_one' => __('Corporate agency', 'dfd_import'),
			'new_shortcodes' => __('Shortcodes', 'dfd_import'),
			'pages' => __('Additional pages', 'dfd_import'),
			'blogger' => __('Blogger demo', 'dfd_import'),
			'one' => __('Traditional', 'dfd_import'),
			'two' => __('Barber', 'dfd_import'),
			'three' => __('Scrolling content', 'dfd_import'),
			'four' => __('Pricing agency', 'dfd_import'),
			'five' => __('Slider scroll effect', 'dfd_import'),
			'six' => __('Portfolio full screen', 'dfd_import'),
			'seven' => __('Portfolio parallax', 'dfd_import'),
			'eight' => __('Portfolio boxed', 'dfd_import'),
			'nine' => __('Portfolio side menu', 'dfd_import'),
			'ten' => __('One page traditional', 'dfd_import'),
			'eleven' => __('One page corporate', 'dfd_import'),
			'twelve' => __('Side menu corporate', 'dfd_import'),
			'thirteen' => __('Boxed corporate', 'dfd_import'),
			'fourteen' => __('Scrolling effect', 'dfd_import'),
			'fifteen' => __('One page navigation', 'dfd_import'),
			'sixteen' => __('Vertical scroll', 'dfd_import'),
			'seventeen' => __('Model agency', 'dfd_import'),
			'eighteen' => __('Coming soon', 'dfd_import'),
			'nineteen' => __('Coming soon second', 'dfd_import'),
			'twenty' => __('Minimalist', 'dfd_import'),
			'twenty_one' => __('Monochrome', 'dfd_import'),
			'twenty_two' => __('Lawyers agency', 'dfd_import'),
			'twenty_three' => __('Building agency', 'dfd_import'),
			'twenty_four' => __('Portfolio slider', 'dfd_import'),
			'twenty_five' => __('Apps corporate', 'dfd_import'),
			'twenty_six' => __('Portfolio horizontal', 'dfd_import'),
			'twenty_seven' => __('Creative bright', 'dfd_import'),
			'twenty_eight' => __('Vintage Web Agency', 'dfd_import'),
			'twenty_nine' => __('Vintage Creative Agency', 'dfd_import'),
			'thirty' => __('Contrast Portfolio', 'dfd_import'),
			'thirty_one' => __('One Page Vintage', 'dfd_import'),
			'thirty_two' => __('3D One page', 'dfd_import'),
			'thirty_three' => __('Fitness Gym', 'dfd_import'),
			'thirty_four' => __('3D Scrolling One page', 'dfd_import'),
			'thirty_five' => __('Bright Creative', 'dfd_import'),
			'thirty_six' => __('Restaurant', 'dfd_import'),
			'thirty_seven' => __('Medicine', 'dfd_import'),
			'thirty_eight' => __('Restaurant', 'dfd_import'),
			'thirty_nine' => __('Lawyers agency', 'dfd_import'),
			'forty' => __('Restaurant', 'dfd_import'),
			'forty_one' => __('Fitness App', 'dfd_import'),
			'forty_two' => __('Furniture shop', 'dfd_import'),
			'forty_three' => __('Coffee House', 'dfd_import'),
			'forty_four' => __('Steak House', 'dfd_import'),
			'forty_five' => __('Recipes', 'dfd_import'),
			'shop_first' => __('Shop with more info', 'dfd_import'),
			'shop_second' => __('Shop with categories slider', 'dfd_import'),
			'shop_third' => __('Shop with side navigation', 'dfd_import'),
			'shop_fourth' => __('Shop with full thumb products', 'dfd_import'),
			'promo' => __('Promo', 'dfd_import'),
		);
		
		$prefix = __('Install layout ', 'dfd_import');
		
		if( (isset($_GET['page']) && $_GET['page'] == 'easint') && isset($_GET['demo_install'])  ) :
			easy_import_start();
			EASYFInstallerHelper::beginInstall();
		endif; 
		if( (isset($_GET['page']) && $_GET['page'] == 'easint') ) :
			if(isset($_GET['demo_layout_select'])) {
				$dummy_file = $_GET['demo_layout_select'];
				if(array_key_exists($dummy_file, $layouts)) {
					$config_suboption = '_'.$dummy_file;
					easy_import_start();
					EASYFInstallerHelper::beginInstall();
				}
			}
		endif;
		
		?>
		
		<?php if(isset($_GET['demo_install'])): easy_success_notification(); endif; ?>

		<div class="demo-installer clearfix">
			<h2><?php echo $easy_metadata['data']->panel_title; ?></h2>

			<p><?php echo $easy_metadata['data']->panel_text; ?></p>
			
			<div class="install-layouts-section">
				<?php foreach($layouts as $value => $name) : ?>
					<a href="<?php echo admin_url() ?>themes.php?page=easint&amp;demo_layout_select=<?php echo $value; ?>" class="button-layout-install">
						<img src="<?php echo EASY_F_PLUGIN_URL . 'demo_data_here/thumbs/'.$value.'.jpg'; ?>" />
						<div class="button-title"><?php echo $prefix.$name; ?></div>
					</a>
				<?php endforeach; ?>
			</div>

			<a href="<?php echo admin_url() ?>themes.php?page=easint&amp;demo_install=true" class="button-install"><?php _e("Install Blog, Portfolio and Additional pages") ?></a>

		</div>

		<?php
		
	 }
}

new IOAEasyFrontInstaller();