<?php

/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */
if (!class_exists('Redux')) {
	return;
}


// This is your option name where all the Redux data is stored.
if (!defined('DFD_THEME_SETTINGS_NAME')) {
	exit;
}

$opt_name = DFD_THEME_SETTINGS_NAME;

/*
 *
 * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
 *
 */
require_once locate_template('/redux_framework/option_values.php');

$sampleHTML = '';
if (file_exists(dirname(__FILE__) . '/info-html.html')) {
	Redux_Functions::initWpFilesystem();

	global $wp_filesystem;

	$sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
}

// Background Patterns Reader
$sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
$sample_patterns_url = ReduxFramework::$_url . '../sample/patterns/';
$sample_patterns = array();
$assets_folder = get_template_directory_uri() . '/assets/';

if (is_dir($sample_patterns_path)) {

	if ($sample_patterns_dir = opendir($sample_patterns_path)) {
		$sample_patterns = array();

		while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

			if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
				$name = explode('.', $sample_patterns_file);
				$name = str_replace('.' . end($name), '', $sample_patterns_file);
				$sample_patterns[] = array(
					'alt' => $name,
					'img' => $sample_patterns_url . $sample_patterns_file
				);
			}
		}
	}
}

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */
$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
	// TYPICAL -> Change these values as you need/desire
	'opt_name' => $opt_name,
	// This is where your data is stored in the database and also becomes your global variable name.
	'display_name' => $theme->get('Name'),
	// Name that appears at the top of your panel
	'display_version' => $theme->get('Version'),
	// Version that appears at the top of your panel
	'menu_type' => 'menu',
	//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
	'allow_sub_menu' => true,
	// Show the sections below the admin menu item or not
	'menu_title' => __('Theme Options', 'dfd'),
	'page_title' => __('Theme Options', 'dfd'),
	// You will need to generate a Google API key to use this feature.
	// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
	'google_api_key' => 'AIzaSyAP7HLJmPCd44UnyeSwejW_G1Q9OLMFFMg',
	// Set it you want google fonts to update weekly. A google_api_key value is required.
	'google_update_weekly' => false,
	// Must be defined to add google fonts to the typography module
	'async_typography' => false,
	// Use a asynchronous font on the front end or font string
	//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
	'admin_bar' => true,
	// Show the panel pages on the admin bar
	'admin_bar_icon' => 'dashicons-portfolio',
	// Choose an icon for the admin bar menu
	'admin_bar_priority' => 50,
	// Choose an priority for the admin bar menu
	'global_variable' => 'dfd_' . DFD_THEME_SETTINGS_NAME,
	// Set a different name for your global variable other than the opt_name
	'dev_mode' => false,
	// Show the time the page took to load, etc
	'update_notice' => true,
	// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
	'customizer' => true,
	// Enable basic customizer support
	//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
	//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
	// OPTIONAL -> Give you extra features
	'page_priority' => null,
	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_parent' => 'themes.php',
	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	'page_permissions' => 'manage_options',
	// Permissions needed to access the options panel.
	'menu_icon' => '',
	// Specify a custom URL to an icon
	'last_tab' => '',
	// Force your panel to always open to a specific tab (by id)
	'page_icon' => 'icon-themes',
	// Icon displayed in the admin panel next to your menu_title
	'page_slug' => '',
	// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
	'save_defaults' => true,
	// On load save the defaults to DB before user clicks save or not
	'default_show' => false,
	// If true, shows the default value next to each field that is not the default value.
	'default_mark' => '',
	// What to print by the field's title if the value shown is default. Suggested: *
	'show_import_export' => true,
	// Shows the Import/Export panel when not used as a field.
	'allow_tracking' => false,
	// Disable tracking
	// CAREFUL -> These options are for advanced use only
	'transient_time' => 60 * MINUTE_IN_SECONDS,
	'output' => true,
	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	'output_tag' => true,
	// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	'database' => '',
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'use_cdn' => true,
	// If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
	// HINTS
	'hints' => array(
		'icon' => 'el el-question-sign',
		'icon_position' => 'left',
		'icon_color' => 'lightgray',
		'icon_size' => 'normal',
		'tip_style' => array(
			'color' => 'dark',
			'shadow' => false,
			'rounded' => false,
			'style' => 'tipsy',
		),
		'tip_position' => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect' => array(
			'show' => array(
				'effect' => 'slide',
				'duration' => '500',
				'event' => 'mouseover',
			),
			'hide' => array(
				'effect' => 'slide',
				'duration' => '500',
				'event' => 'click mouseleave',
			),
		),
	),
);

// Panel Intro text -> before the form
if (!isset($args['global_variable']) || $args['global_variable'] !== false) {
	if (!empty($args['global_variable'])) {
		$v = $args['global_variable'];
	} else {
		$v = str_replace('-', '_', $args['opt_name']);
	}
	$args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo'), $v);
} else {
	$args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo');
}

// Add content after the form.
$args['footer_text'] = '';

Redux::setArgs($opt_name, $args);

/*
 * ---> END ARGUMENTS
 */


/*
 * ---> START HELP TABS
 */

$tabs = array(
	array(
		'id' => 'redux-help-tab-1',
		'title' => __('Theme Information 1', 'redux-framework-demo'),
		'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
	),
	array(
		'id' => 'redux-help-tab-2',
		'title' => __('Theme Information 2', 'redux-framework-demo'),
		'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
	)
);
Redux::setHelpTab($opt_name, $tabs);

// Set the help sidebar
$content = __('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo');
Redux::setHelpSidebar($opt_name, $content);


/*
 * <--- END HELP TABS
 */


/*
 *
 * ---> START SECTIONS
 *
 */

/*

  As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


 */

//Redux::setSection( $opt_name, array(
Redux::setSection($opt_name, array(
	'title' => esc_html__('General options', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'icon' => 'dashicons dashicons-admin-generic',
	//Lets leave this as a blank section, no options just some intro text set above.
));
Redux::setSection($opt_name, array(
	'title' => __('Main settings', 'dfd'),
	//'desc' => __('<p class="description">Main options of site</p>', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'icon' => 'crdash-crown',
	'subsection' => true,
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'main_options_info_content',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Main options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'scroll_animation',
			'type' => 'button_set',
			'title' => __('Smooth page scroll', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Smooth page scroll', 'dfd'),
				'content' => esc_attr__('Enable the page scroll animation to have the smooth scroll', 'dfd')
			)
		),
		array(
			'id' => 'mobile_responsive',
			'type' => 'button_set',
			'title' => __('Mobile Responsive', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Mobile responsive', 'dfd'),
				'content' => esc_attr__('Allows you to enable or disable the responsiveness for the mobile devices', 'dfd')
			)
		),
		array(
			'id' => 'enable_envato_toolkit',
			'type' => 'button_set',
			'title' => __('Envato Toolkit auto update tool', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Envato Toolkit auto update', 'dfd'),
				'content' => esc_attr__('Allows you to enable or disable autoupdate via Envato Toolkit', 'dfd')
			)
		),
		array(
			'id' => 'enqueue_styles_file',
			'type' => 'button_set',
			'title' => esc_html__('Generate dynamic styles file', 'dfd'),
			'options' => array('on' => esc_html__('On', 'dfd'), 'off' => esc_html__('Off', 'dfd')),
			'default' => 'off',
			'hint' => array(
				'title' => esc_attr__('Dynamic styles file', 'dfd'),
				'content' => esc_attr__('This option allows you to enqueue dynamic styles from file. These styles are enqueued in HEAD tag by default. This option allows you to enable browser and server cache for that file and increase site performance', 'dfd')
			)
		),
		array(
			'id' => 'enable_styled_button',
			'type' => 'button_set',
			'title' => __('Styled button', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'off',
			'hint' => array(
				'title' => esc_attr__('Styled button', 'dfd'),
				'content' => esc_attr__('Allows you to enable or disable Styled button feature of default text editor', 'dfd')
			)
		),
		array(
			'id' => 'enable_images_lazy_load',
			'type' => 'button_set',
			'title' => esc_html__('Images lazy load', 'dfd'),
			'options' => array('on' => esc_html__('On', 'dfd'), 'off' => esc_html__('Off', 'dfd')),
			'default' => 'off',
			'hint' => array(
				'title' => esc_attr__('Images lazy load', 'dfd'),
				'content' => esc_attr__('This option allows you to enable lazy load feature for blog, portfolio and gallery to increase your site speed.', 'dfd')
			)
		),
		array(
			'id' => 'lazy_load_offset',
			'type' => 'slider',
			'title' => esc_html__('Lazy images load offset', 'dfd'),
			'desc' => '',
			'min' => '50',
			'max' => '200',
			'step' => '1',
			'default' => '140',
			'required' => array('enable_images_lazy_load', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Lazy images load offset', 'dfd'),
				'content' => esc_attr__('This option allows you to define the offset from the current viewport to start images loading in %. 100% means that images will start loading from the bottom of viewport, 150% means that images will start loading half of viewport below the current page screen position.', 'dfd')
			)
		),
		array(
			'id' => 'custom_google_api_key',
			'type' => 'text',
			'title' => __('Google Maps API Key', 'dfd'),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Google API key', 'dfd'),
				'content' => esc_attr__('Allows you to add custom Google API key which will be used for the Google map', 'dfd')
			)
		),
		array(
			'id' => 'shortcodes_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Shortcodes options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'enable_default_modules',
			'type' => 'button_set',
			'title' => __('Default Modules for Visual Composer', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Default VC modules', 'dfd'),
				'content' => esc_attr__('Allows you to enable or disable default modules for the Visual Composer', 'dfd')
			)
		),
		array(
			'id' => 'enable_default_addons',
			'type' => 'button_set',
			'title' => __('Default modules of Ultimate Addons plugin', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Default Ultimate Addons modules', 'dfd'),
				'content' => esc_attr__('Allows you to enable or disable default modules for the Ultimate Addons', 'dfd')
			)
		),
		array(
			'id' => 'disable_ult_addons',
			'type' => 'button_set',
			'title' => __('Shortcodes used for old demos', 'dfd'),
			'desc' => '',
			'options' => array('enable' => 'On', 'disable' => 'Off'),
			'default' => 'enable',
			'hint' => array(
				'title' => esc_attr__('Old demos shortcodes', 'dfd'),
				'content' => esc_attr__('Allows you to enable or disable modules used for the old demos ', 'dfd')
			)
		),
		array(
			'id' => 'developers_set',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Developer settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'enable_wordpress_heartbeat',
			'type' => 'button_set',
			'title' => __('Wordpress Heartbeat', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Wordpress Heartbeat', 'dfd'),
				'content' => esc_attr__('Allows you to enable or disable Wordpress Heartbeat', 'dfd')
			)
		),
		array(
			'id' => 'dev_mode',
			'type' => 'button_set',
			'title' => __('Enable DEV mode', 'dfd'),
			'desc' => '',
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'off'
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Layouts settings', 'dfd'),
	'icon' => 'crdash-web_layout',
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'lazy_load_pagination_image',
			'type' => 'media',
			'title' => __('Lazy load pagination image', 'dfd'),
			'desc' => '',
			'default' => array(
				'url' => $assets_folder . 'img/lazy_load.gif'
			),
			'hint' => array(
				'title' => esc_attr__('Lazy load image', 'dfd'),
				'content' => esc_attr__('This option allows you to add the image for the lazy load pagination', 'dfd')
			)
		),
		array(
			'id' => 'pages_layout',
			'type' => 'image_select',
			'title' => __('Single pages layout', 'dfd'),
			'sub_desc' => __('Select one type of layout for single pages', 'dfd'),
			'options' => dfd_page_layouts(),
			'default' => '1col-fixed',
			'hint' => array(
				'title' => esc_attr__('Single layout', 'dfd'),
				'content' => esc_attr__('Select one of the layout types which will be set as default for all the single pages', 'dfd')
			)
		),
		array(
			'id' => 'pages_head_type',
			'type' => 'select',
			'title' => __('Single pages header', 'dfd'),
			'options' => dfd_headers_type(),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Single header', 'dfd'),
				'content' => esc_attr__('Select the header type which will be set as default for all the single pages. There is also an option on the item\'s page if you need to change the header style for the single page', 'dfd')
			)
		),
		array(
			'id' => 'archive_layout',
			'type' => 'image_select',
			'title' => __('Archive pages layout', 'dfd'),
			'sub_desc' => __('Select one type of layout for archive pages', 'dfd'),
			'options' => dfd_page_layouts(),
			'default' => '2c-r-fixed',
			'hint' => array(
				'title' => esc_attr__('Archive layout', 'dfd'),
				'content' => esc_attr__('Select one of the layout types which will be set as default for all the archive pages', 'dfd')
			)
		),
		array(
			'id' => 'archive_head_type',
			'type' => 'select',
			'title' => __('Archive pages header', 'dfd'),
			'options' => dfd_headers_type(),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Archive header', 'dfd'),
				'content' => esc_attr__('Select the header type which will be set as default for all the archive pages', 'dfd')
			)
		),
		array(
			'id' => 'single_layout',
			'type' => 'image_select',
			'title' => __('Single posts layout', 'dfd'),
			'sub_desc' => __('Select one type of layout for single posts', 'dfd'),
			'options' => dfd_page_layouts(),
			'default' => '2c-r-fixed',
			'hint' => array(
				'title' => esc_attr__('Post layout', 'dfd'),
				'content' => esc_attr__('Select one of the layout types which will be set as default for all the single posts. There is also an option on the item\'s page if you need to change the layout for the single post', 'dfd')
			)
		),
		array(
			'id' => 'single_head_type',
			'type' => 'select',
			'title' => __('Single posts header', 'dfd'),
			'options' => dfd_headers_type(),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Post header', 'dfd'),
				'content' => esc_attr__('Select the header type which will be set as default for all the single posts. There is also an option on the item\'s page if you need to change the header style for the single post', 'dfd')
			)
		),
		array(
			'id' => 'search_layout',
			'type' => 'image_select',
			'title' => __('Search results layout', 'dfd'),
			'sub_desc' => __('Select one type of layout for search results', 'dfd'),
			'options' => dfd_page_layouts(),
			'default' => '1col-fixed',
			'hint' => array(
				'title' => esc_attr__('Search layout', 'dfd'),
				'content' => esc_attr__('Select one of the layout types which will be set as default for the search results page', 'dfd')
			)
		),
		array(
			'id' => 'search_head_type',
			'type' => 'select',
			'title' => __('Search results header', 'dfd'),
			'options' => dfd_headers_type(),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Search header', 'dfd'),
				'content' => esc_attr__('Select the header type which will be set as default for the search results page', 'dfd')
			)
		),
		array(
			'id' => '404_layout',
			'type' => 'image_select',
			'title' => __('404 page layout', 'dfd'),
			'sub_desc' => __('Select one of layouts for 404 page', 'dfd'),
			'options' => dfd_page_layouts(),
			'default' => '1col-fixed',
			'hint' => array(
				'title' => esc_attr__('404 layout', 'dfd'),
				'content' => esc_attr__('Select one of the layout types which will be set as default for the 404 page', 'dfd')
			)
		),
		array(
			'id' => '404_head_type',
			'type' => 'select',
			'title' => __('404 Page header', 'dfd'),
			'options' => dfd_headers_type(),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('404 header', 'dfd'),
				'content' => esc_attr__('Select the header type which will be set as default for the 404 page', 'dfd')
			)
		),
		array(
			'id' => 'layout_whitespace_size',
			'type' => 'slider',
			'title' => __('Layout frame size', 'dfd'),
			'min' => '0',
			'max' => '50',
			'step' => '1',
			'default' => '30',
			'hint' => array(
				'title' => esc_attr__('Layout frame', 'dfd'),
				'content' => esc_attr__('Set the size for the frame around the page', 'dfd')
			)
		),
		array(
			'id' => 'layout_whitespace_color',
			'type' => 'color',
			'title' => __('Layout frame color', 'dfd'),
			'validate' => 'color_rgba',
			'default' => '#ffffff',
			'hint' => array(
				'title' => esc_attr__('Frame color', 'dfd'),
				'content' => esc_attr__('Select the color for the layout frame', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Logos', 'dfd'),
	'icon' => 'crdash-photos',
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'fav_icons',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Favicons', 'dfd') . '</h3>'
		),
		array(
			'id' => 'custom_favicon',
			'type' => 'media',
			'title' => __('Favicon', 'dfd'),
			'default' => array(
				'url' => $assets_folder . 'img/favicon/favicon.ico'
			),
			'hint' => array(
				'title' => esc_attr__('Favicon', 'dfd'),
				'content' => esc_attr__('Select 16px X 16px image from the file location on your computer and upload it as a favicon of your site', 'dfd')
			)
		),
		array(
			'id' => 'custom_favicon_iphone',
			'type' => 'media',
			'title' => __('Favicon', 'dfd'),
			'default' => array(
				'url' => $assets_folder . 'img/favicon/favicon.ico'
			),
			'hint' => array(
				'title' => esc_attr__('Favicon', 'dfd'),
				'content' => esc_attr__('Select 16px X 16px image from the file location on your computer and upload it as a favicon of your site', 'dfd')
			)
		),
		array(
			'id' => 'custom_favicon_ipad',
			'type' => 'media',
			'title' => __('Favicon', 'dfd'),
			'default' => array(
				'url' => $assets_folder . 'img/favicon/favicon.ico'
			),
			'hint' => array(
				'title' => esc_attr__('Favicon', 'dfd'),
				'content' => esc_attr__('Select 76px X 76px image from the file location on your computer and upload it as a favicon of your site', 'dfd')
			)
		),
		array(
			'id' => 'custom_favicon_iphone_retina',
			'type' => 'media',
			'title' => __('Favicon', 'dfd'),
			'default' => array(
				'url' => $assets_folder . 'img/favicon/favicon.ico'
			),
			'hint' => array(
				'title' => esc_attr__('Favicon', 'dfd'),
				'content' => esc_attr__('Select 120px X 120px image from the file location on your computer and upload it as a favicon of your site', 'dfd')
			)
		),
		array(
			'id' => 'custom_favicon_ipad_retina',
			'type' => 'media',
			'title' => __('Favicon', 'dfd'),
			'default' => array(
				'url' => $assets_folder . 'img/favicon/favicon.ico'
			),
			'hint' => array(
				'title' => esc_attr__('Favicon', 'dfd'),
				'content' => esc_attr__('Select 152px X 152px image from the file location on your computer and upload it as a favicon of your site', 'dfd')
			)
		),
		array(
			'id' => 'site_logos',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Header logotype images', 'dfd') . '</h3>'
		),
		array(
			'id' => 'custom_logo_image',
			'type' => 'media',
			'title' => __('Dark logotype', 'dfd'),
			'default' => array(
				'url' => $assets_folder . 'img/logo.png'
			),
			'hint' => array(
				'title' => esc_attr__('Dark logotype', 'dfd'),
				'content' => esc_attr__('Select an image from the file location on your computer or choose from the media library. The logo will be displayed for the header styles 1, 3, 9, 12', 'dfd')
			)
		),
		array(
			'id' => 'custom_retina_logo_image',
			'type' => 'media',
			'title' => __('Dark Logotype for retina', 'dfd'),
			'default' => array(
				'url' => $assets_folder . 'img/logo.png'
			),
			'hint' => array(
				'title' => esc_attr__('Dark logotype for retina', 'dfd'),
				'content' => esc_attr__('Select an image from the file location on your computer or choose from the media library. The retina logo will be displayed for the header styles 1, 3, 9, 12', 'dfd')
			)
		),
		array(
			'id' => 'custom_logo_image_second',
			'type' => 'media',
			'title' => __('Light logotype', 'dfd'),
			'default' => array(
				'url' => $assets_folder . 'img/logo.png'
			),
			'hint' => array(
				'title' => esc_attr__('Light logotype', 'dfd'),
				'content' => esc_attr__('Select an image from the file location on your computer or choose from the media library. The logo will be displayed for the header styles 2, 4, 6, 7, 10, 13, 14', 'dfd')
			)
		),
		array(
			'id' => 'custom_retina_logo_image_second',
			'type' => 'media',
			'title' => __('Light logotype for retina', 'dfd'),
			'default' => array(
				'url' => $assets_folder . 'img/logo.png'
			),
			'hint' => array(
				'title' => esc_attr__('Light logotype for retina', 'dfd'),
				'content' => esc_attr__('Select an image from the file location on your computer or choose from the media library. The logo will be displayed for the header styles 2, 4, 6, 7, 10, 13, 14', 'dfd')
			)
		),
		array(
			'id' => 'custom_logo_image_side',
			'type' => 'media',
			'title' => __('Logotype for 5 & 8 header styles', 'dfd'),
			'default' => array(
				'url' => $assets_folder . 'img/logo.png'
			),
			'hint' => array(
				'title' => esc_attr__('Header 5 & 8 logotype', 'dfd'),
				'content' => esc_attr__('Select an image from the file location on your computer or choose from the media library. The logo will be displayed for the header styles 5 and 8', 'dfd')
			)
		),
		array(
			'id' => 'custom_retina_logo_image_side',
			'type' => 'media',
			'title' => __('Logotype for retina for 5 & 8 header styles', 'dfd'),
			'default' => array(
				'url' => $assets_folder . 'img/logo.png'
			),
			'hint' => array(
				'title' => esc_attr__('Header 5 & 8 retina logotype', 'dfd'),
				'content' => esc_attr__('Select an image from the file location on your computer or choose from the media library. The logo will be displayed for the header styles 5 and 8', 'dfd')
			)
		),
		array(
			'id' => 'small_logo_image',
			'type' => 'media',
			'title' => __('Small logotype for header style 8', 'dfd'),
			//'desc' => __('Select 70x70 logo to be displayed at the top of Header 8 and 11 style side panel.', 'dfd'),
			'default' => array(
				'url' => ''
			),
			'hint' => array(
				'title' => esc_attr__('Small logotype for header 8', 'dfd'),
				'content' => esc_attr__('Select an image from the file location on your computer or choose from the media library. The logo will be displayed as small logotype in closed header style 8. The recommended logotype image size is 70x70', 'dfd')
			)
		),
		array(
			'id' => 'custom_logo_fixed_header',
			'type' => 'media',
			'title' => __('Sticky header logotype', 'dfd'),
			'default' => array(
				'url' => $assets_folder . 'img/logo.png'
			),
			'hint' => array(
				'title' => esc_attr__('Sticky header logotype', 'dfd'),
				'content' => esc_attr__('Select an image from the file location on your computer or choose from the media library. The logo will be displayed for sticky header, the header displayed on scroll', 'dfd')
			)
		),
		array(
			'id' => 'mobile_logo_image',
			'type' => 'media',
			'title' => __('Mobile logotype', 'dfd'),
			'default' => array(
				'url' => ''
			),
			'hint' => array(
				'title' => esc_attr__('Mobile logotype', 'dfd'),
				'content' => esc_attr__('Select an image from the file location on your computer or choose from the media library. The logo will be displayed for mobile header', 'dfd')
			)
		),
		array(
			'id' => 'mobile_menu_logo_image',
			'type' => 'media',
			'title' => __('Mobile menu logotype', 'dfd'),
			'default' => array(
				'url' => ''
			),
			'hint' => array(
				'title' => esc_attr__('Mobile menu logotype', 'dfd'),
				'content' => esc_attr__('Select an image from the file location on your computer or choose from the media library. The logo will be displayed as logotype in mobile menu', 'dfd')
			)
		),
		array(
			'id' => 'additional_logos',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Additional logotype images', 'dfd') . '</h3>'
		),
		array(
			'id' => 'custom_logo_image_third',
			'type' => 'media',
			'title' => __('Logotype for widget Logo', 'dfd'),
			'default' => array(
				'url' => $assets_folder . 'img/logo.png'
			),
			'hint' => array(
				'title' => esc_attr__('Logo widget logotype', 'dfd'),
				'content' => esc_attr__('Select an image from the file location on your computer or choose from the media library. The logo will be displayed for Logo widget, which can be set in Appearance > Widgets', 'dfd')
			)
		),
		/* array(
		  'id' => 'preloader_logo_image',
		  'type' => 'media',
		  'title' => __('Logo for site preloader', 'dfd'),
		  'desc' => __('Select the small logo to be displayed while your site is being loaded.', 'dfd'),
		  'default' => array(
		  'url' => ''
		  ),
		  ), */
		array(
			'id' => 'side_area_title',
			'type' => 'media',
			'title' => __('Side area logotype', 'dfd'),
			'default' => array(
				'url' => $assets_folder . 'img/logo.png'
			),
			'hint' => array(
				'title' => esc_attr__('Side area logotype', 'dfd'),
				'content' => esc_attr__('Select an image from the file location on your computer or choose from the media library. The logo will be displayed as Side area logotype. The Side area can be enabled in Theme Options > Side area', 'dfd')
			)
		),
		array(
			'id' => 'logo_footer',
			'type' => 'media',
			'title' => __('Footer logotype', 'dfd'),
			'default' => array(
				'url' => $assets_folder . 'img/logo.png'
			),
			'hint' => array(
				'title' => esc_attr__('Footer logotype', 'dfd'),
				'content' => esc_attr__('Select an image from the file location on your computer or choose from the media library. The logo will be displayed in footer', 'dfd')
			)
		),
	/* array(
	  'id' => 'logo_subfooter',
	  'type' => 'media',
	  'title' => __('Logotype in subfooter', 'dfd'),
	  'desc' => __('Will be displayed in subfooter', 'dfd'),
	  'default' => array(
	  'url' => $assets_folder . 'img/logo.png'
	  ),
	  ), */
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Site preloader option', 'dfd'),
	'icon' => 'crdash-box',
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'site_preloader_enabled',
			'type' => 'button_set',
			'title' => __('Site preloader', 'dfd'),
			'options' => array('1' => 'On', '0' => 'Off'),
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Preloader', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the preloader for the site. When enabled the visitor will first see the preloader and then fully loaded page', 'dfd')
			)
		),
		array(
			'id' => 'preloader_percentage',
			'type' => 'button_set',
			'title' => __('Preloader percentage', 'dfd'),
			'options' => array('1' => 'On', '0' => 'Off'),
			'default' => '0',
			'required' => array('site_preloader_enabled', "=", '1'),
			'hint' => array(
				'title' => esc_attr__('Percentage', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable preloader percentage counter', 'dfd')
			)
		),
		array(
			'id' => 'preloader_percentage_typography',
			'type' => 'typography',
			'title' => __('Preloader counter typography', 'redux-framework-demo'),
			//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
			'google' => true,
			// Disable google fonts. Won't work if you haven't defined your google api key
			//'font-backup' => true,
			// Select a backup non-google font in addition to a google font
			'font-style' => true, // Includes font-style and weight. Can use font-style or font-weight to declare
			'subsets' => true, // Only appears if google is true and subsets not set to false
			'font-size' => true,
			'text-align' => false,
			'line-height' => true,
			'word-spacing' => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'text-transform' => true,
			'color' => true,
			'preview' => false, // Disable the previewer
			'all_styles' => true,
			// Enable all Google Font style/weight variations to be added to the page
			//'output'      => array( 'h2.site-description, .entry-title' ),
			// An array of CSS selectors to apply this font style to dynamically
			//'compiler'    => array( 'h2.site-description-compiler' ),
			// An array of CSS selectors to apply this font style to dynamically
			'units' => 'px',
			// Defaults to px
			//'subtitle'    => __( 'Typography option with each property can be called individually.', 'redux-framework-demo' ),
			'default' => array(
				'font-style' => 'normal',
				'font-weight' => '',
				'font-family' => 'texgyreadventorregular',
				'google' => true,
				'font-size' => '45px',
				'line-height' => '55px',
				'text-transform' => 'uppercase',
				//'word-spacing'  => '0px',
				'letter-spacing' => '2px',
				'color' => '#ffffff',
			),
			'required' => array('preloader_percentage', "=", '1'),
			'hint' => array(
				'title' => esc_attr__('Counter typography', 'dfd'),
				'content' => esc_attr__('Specify the typography for the counter', 'dfd')
			)
		),
		array(
			'id' => 'preloader_background',
			'type' => 'background',
			'title' => __('Preloader background', 'dfd'),
			'required' => array('site_preloader_enabled', "=", '1'),
			'hint' => array(
				'title' => esc_attr__('Background', 'dfd'),
				'content' => esc_attr__('Ths option allows you to set custom image for the preloader background and adjust its styling', 'dfd')
			)
		),
		array(
			'id' => 'preloader_style',
			'type' => 'select',
			'title' => __('Preloader style', 'dfd'),
			'options' => array(
				'' => __('None', 'dfd'),
				'css_animation' => __('CSS animation', 'dfd'),
				'image' => __('Image', 'dfd'),
				'progress_bar' => __('Progress bar', 'dfd'),
			),
			'default' => '',
			'required' => array('site_preloader_enabled', "=", '1'),
			'hint' => array(
				'title' => esc_attr__('Style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset preloader styles', 'dfd')
			)
		),
		array(
			'id' => 'css_animation_style',
			'type' => 'select',
			'title' => __('Animation style', 'dfd'),
			'options' => dfd_preloader_animation_style(),
			'default' => '',
			'required' => array('preloader_style', "=", 'css_animation'),
			'hint' => array(
				'title' => esc_attr__('Animation style', 'dfd'),
				'content' => esc_attr__('Select among 16 preset CSS animation styles', 'dfd')
			)
		),
		array(
			'id' => 'preoader_animation_color',
			'type' => 'color',
			'title' => __('Animation base color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array('preloader_style', "=", 'css_animation'),
			'hint' => array(
				'title' => esc_attr__('Animation color', 'dfd'),
				'content' => esc_attr__('Ths option allows you to choose the base color for the CSS animation', 'dfd')
			)
		),
		array(
			'id' => 'preloader_image',
			'type' => 'media',
			'title' => __('Preloader image', 'dfd'),
			'default' => array(
				'url' => $assets_folder . 'img/logo.png'
			),
			'required' => array('preloader_style', "=", 'image'),
			'hint' => array(
				'title' => esc_attr__('Image', 'dfd'),
				'content' => esc_attr__('Ths option allows you to set custom image for the preloader', 'dfd')
			)
		),
		array(
			'id' => 'preloader_bar_bg',
			'type' => 'color',
			'title' => __('Progress bar background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array('preloader_style', "=", 'progress_bar'),
			'hint' => array(
				'title' => esc_attr__('Progress bar background', 'dfd'),
				'content' => esc_attr__('Ths option allows you to set the color for the loading progress', 'dfd')
			)
		),
		array(
			'id' => 'preloader_bar_opacity',
			'type' => 'slider',
			'title' => __('Progress bar opacity ', 'dfd'),
			'min' => '1',
			'max' => '100',
			'step' => '1',
			'default' => '100',
			'required' => array('preloader_style', "=", 'progress_bar'),
			'hint' => array(
				'title' => esc_attr__('Progress bar opacity', 'dfd'),
				'content' => esc_attr__('Ths option allows you to set the opacity value for the progress bar', 'dfd')
			)
		),
		array(
			'id' => 'preloader_bar_position',
			'type' => 'select',
			'title' => __('Progress bar position', 'dfd'),
			'options' => array(
				'middle' => __('Middle', 'dfd'),
				'top' => __('Top', 'dfd'),
				'bottom' => __('Bottom', 'dfd'),
			),
			'default' => 'middle',
			'required' => array('preloader_style', "=", 'progress_bar'),
			'hint' => array(
				'title' => esc_attr__('Progress bar position', 'dfd'),
				'content' => esc_attr__('Ths option allows you to align the loading progress vertically', 'dfd')
			)
		),
		array(
			'id' => 'preloader_bar_height',
			'type' => 'text',
			'title' => __('Preloader bar height (in px)', 'dfd'),
			'default' => __('Full screen by default', 'dfd'),
			'validate' => 'numeric',
			'default' => '',
			'required' => array('preloader_style', "=", 'progress_bar'),
			'hint' => array(
				'title' => esc_attr__('Progress bar height', 'dfd'),
				'content' => esc_attr__('Ths option allows you adjust the height for the loading progress. The value should be set in px, don\'t include "px"', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Default button options', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'icon' => 'crdash-coverflow',
	'subsection' => true,
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'button_gen_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('General settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'default_button_typography_option',
			'type' => 'typography',
			'title' => __('Default Button Typography', 'redux-framework-demo'),
			//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
			'google' => true,
			// Disable google fonts. Won't work if you haven't defined your google api key
			//'font-backup' => true,
			// Select a backup non-google font in addition to a google font
			'font-style' => true, // Includes font-style and weight. Can use font-style or font-weight to declare
			'subsets' => true, // Only appears if google is true and subsets not set to false
			'font-size' => true,
			'text-align' => false,
			'line-height' => true,
			'word-spacing' => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'text-transform' => true,
			'color' => true,
			'preview' => false, // Disable the previewer
			'all_styles' => true,
			// Enable all Google Font style/weight variations to be added to the page
			//'output'      => array( 'h2.site-description, .entry-title' ),
			// An array of CSS selectors to apply this font style to dynamically
			//'compiler'    => array( 'h2.site-description-compiler' ),
			// An array of CSS selectors to apply this font style to dynamically
			'units' => 'px',
			// Defaults to px
			'default' => array(
				'font-style' => 'normal',
				'font-weight' => '',
				'font-family' => 'texgyreadventorregular',
				'google' => true,
				'font-size' => '12px',
				'line-height' => '45px',
				'text-transform' => 'uppercase',
				//'word-spacing'  => '0px',
				'letter-spacing' => '2px',
				'color' => '#ffffff',
			),
			'hint' => array(
				'title' => esc_attr__('Button typography', 'dfd'),
				'content' => esc_attr__('Allows you to set the font family and styling for all the default buttons. Typography option with each property can be called individually', 'dfd')
			)
		),
		array(
			'id' => 'default_button_hover_color',
			'type' => 'color',
			'title' => __('Default button hover text color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Button text hover', 'dfd'),
				'content' => esc_attr__('This option allows you to set the text hover color for all the default buttons', 'dfd')
			),
		),
		array(
			'id' => 'default_button_background',
			'type' => 'color',
			'title' => __('Default button background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Button background', 'dfd'),
				'content' => esc_attr__('This option allows you to set the background color for all the default buttons', 'dfd')
			)
		),
		array(
			'id' => 'default_button_background_opacity',
			'type' => 'slider',
			'title' => __('Default button background opacity', 'dfd'),
			'min' => '1',
			'max' => '100',
			'step' => '1',
			'default' => '100',
			'hint' => array(
				'title' => esc_attr__('Button background opacity', 'dfd'),
				'content' => esc_attr__('This option allows you to set the background color\'s opacity for all the default buttons', 'dfd')
			)
		),
		array(
			'id' => 'default_button_hover_bg',
			'type' => 'color',
			'title' => __('Default button hover background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Button background hover', 'dfd'),
				'content' => esc_attr__('This option allows you to set the button background hover color for all the default buttons', 'dfd')
			)
		),
		array(
			'id' => 'default_button_hover_bg_opacity',
			'type' => 'slider',
			'title' => __('Default button hover background opacity', 'dfd'),
			'min' => '1',
			'max' => '100',
			'step' => '1',
			'default' => '100',
			'hint' => array(
				'title' => esc_attr__('Button background opacity', 'dfd'),
				'content' => esc_attr__('This option allows you to set the background color\'s opacity for all the default buttons on hover', 'dfd')
			)
		),
		array(
			'id' => 'button_border',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Border settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'default_button_border_style',
			'type' => 'select',
			'title' => __('Default button border style', 'dfd'),
			'options' => array(
				'solid' => __('Solid', 'dfd'),
				'dashed' => __('Dashed', 'dfd'),
				'dotted' => __('Dotted', 'dfd'),
			),
			'default' => 'solid',
			'hint' => array(
				'title' => esc_attr__('Border style', 'dfd'),
				'content' => esc_attr__('This option allows you to set the button border style for all the default buttons', 'dfd')
			)
		),
		array(
			'id' => 'default_button_border_width',
			'type' => 'text',
			'title' => __('Default button border width', 'dfd'),
			'validate' => 'numeric',
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Border width', 'dfd'),
				'content' => esc_attr__('This option allows you to set the button border width for all the default buttons. The width should be added in px, don\'t include "px"', 'dfd')
			)
		),
		array(
			'id' => 'default_button_border',
			'type' => 'color',
			'title' => __('Default button border color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Button border color', 'dfd'),
				'content' => esc_attr__('This option allows you to set the border color for all the default buttons', 'dfd')
			)
		),
		array(
			'id' => 'default_button_border_opacity',
			'type' => 'slider',
			'title' => __('Default button border opacity', 'dfd'),
			'min' => '1',
			'max' => '100',
			'step' => '1',
			'default' => '100',
			'hint' => array(
				'title' => esc_attr__('Button border opacity', 'dfd'),
				'content' => esc_attr__('This option allows you to set the border color\'s opacity for all the default buttons', 'dfd')
			)
		),
		array(
			'id' => 'default_button_hover_border',
			'type' => 'color',
			'title' => __('Default button border color on hover', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Button border hover color', 'dfd'),
				'content' => esc_attr__('This option allows you to set the border hover color for all the default buttons', 'dfd')
			)
		),
		array(
			'id' => 'default_button_hover_border_opacity',
			'type' => 'slider',
			'title' => __('Default button border opacity on hover', 'dfd'),
			'min' => '1',
			'max' => '100',
			'step' => '1',
			'default' => '100',
			'hint' => array(
				'title' => esc_attr__('Button border hover opacity', 'dfd'),
				'content' => esc_attr__('This option allows you to set the border color\'s opacity on hover for all the default buttons', 'dfd')
			)
		),
		array(
			'id' => 'default_button_border_radius',
			'type' => 'text',
			'title' => __('Default button border radius', 'dfd'),
			'validate' => 'numeric',
			'default' => 0,
			'hint' => array(
				'title' => esc_attr__('Border radius', 'dfd'),
				'content' => esc_attr__('This option allows you to set the button border radius for all the default buttons', 'dfd')
			)
		),
		array(
			'id' => 'button_paddings',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Size settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'default_button_padding_left',
			'type' => 'text',
			'title' => __('Default button left padding', 'dfd'),
			'validate' => 'numeric',
			'default' => 80,
			'hint' => array(
				'title' => esc_attr__('Button left padding', 'dfd'),
				'content' => esc_attr__('This option allows you to set the left padding to the button text, will be aplied for all the default buttons. The padding should be added in px, don\'t include "px"', 'dfd')
			)
		),
		array(
			'id' => 'default_button_padding_right',
			'type' => 'text',
			'title' => __('Default button right padding', 'dfd'),
			'validate' => 'numeric',
			'default' => 40,
			'hint' => array(
				'title' => esc_attr__('Button right padding', 'dfd'),
				'content' => esc_attr__('This option allows you to set the left padding to the button text, will be aplied for all the default buttons. The padding should be added in px, don\'t include "px"', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('To top button', 'dfd'),
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'to_top_paddings',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Size settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'to_top_button_font_size',
			'type' => 'text',
			'title' => __('To Top button font size', 'dfd'),
			'validate' => 'numeric',
			'default' => 14,
			'hint' => array(
				'title' => esc_attr__('Button font size', 'dfd'),
				'content' => esc_attr__('This option allows you specify the button\'s font size in px', 'dfd')
			)
		),
		array(
			'id' => 'to_top_button_size',
			'type' => 'text',
			'title' => __('To Top button size', 'dfd'),
			'validate' => 'numeric',
			'default' => 45,
			'hint' => array(
				'title' => esc_attr__('Button size', 'dfd'),
				'content' => esc_attr__('This option allows you specify the button\'s size in px', 'dfd')
			)
		),
		array(
			'id' => 'to_top_style',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Styling options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'to_top_button_color',
			'type' => 'color',
			'title' => __('To Top button icon color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Icon color', 'dfd'),
				'content' => esc_attr__('This option allows you specify the button\'s icon color', 'dfd')
			)
		),
		array(
			'id' => 'to_top_button_hover_color',
			'type' => 'color',
			'title' => __('To Top button icon hover color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Icon hover color', 'dfd'),
				'content' => esc_attr__('This option allows you specify the button\'s icon color on hover', 'dfd')
			)
		),
		array(
			'id' => 'to_top_button_background',
			'type' => 'color',
			'title' => __('To Top button background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Button background', 'dfd'),
				'content' => esc_attr__('This option allows you to set the background color for the back to top button', 'dfd')
			)
		),
		array(
			'id' => 'to_top_button_background_opacity',
			'type' => 'slider',
			'title' => __('To Top button background opacity', 'dfd'),
			'min' => '1',
			'max' => '100',
			'step' => '1',
			'default' => '100',
			'hint' => array(
				'title' => esc_attr__('Button background opacity', 'dfd'),
				'content' => esc_attr__('This option allows you to set the background color\'s opacity for the back to top button', 'dfd')
			)
		),
		array(
			'id' => 'to_top_button_hover_bg',
			'type' => 'color',
			'title' => __('To Top button hover background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Button hover background', 'dfd'),
				'content' => esc_attr__('This option allows you to set the background color for the back to top button on hover', 'dfd')
			)
		),
		array(
			'id' => 'to_top_button_hover_bg_opacity',
			'type' => 'slider',
			'title' => __('To Top button hover background opacity', 'dfd'),
			'min' => '1',
			'max' => '100',
			'step' => '1',
			'default' => '100',
			'hint' => array(
				'title' => esc_attr__('Button background hover opacity', 'dfd'),
				'content' => esc_attr__('This option allows you to set the background color\'s opacity for the back to top button on hover', 'dfd')
			)
		),
		array(
			'id' => 'to_top_border',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Border settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'to_top_button_border_style',
			'type' => 'select',
			'title' => __('To Top button border style', 'dfd'),
			'options' => array(
				'solid' => __('Solid', 'dfd'),
				'dashed' => __('Dashed', 'dfd'),
				'dotted' => __('Dotted', 'dfd'),
			),
			'default' => 'solid',
			'hint' => array(
				'title' => esc_attr__('Border style', 'dfd'),
				'content' => esc_attr__('This option allows you to set the border style for the back to top button, choose between 3 preset styles', 'dfd')
			)
		),
		array(
			'id' => 'to_top_button_border_width',
			'type' => 'text',
			'title' => __('To Top button border width', 'dfd'),
			'validate' => 'numeric',
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Border width', 'dfd'),
				'content' => esc_attr__('This option allows you to set the border width for the back to top button. The width should be added in px, don\'t include "px"', 'dfd')
			)
		),
		array(
			'id' => 'to_top_button_border_radius',
			'type' => 'text',
			'title' => __('To Top button border radius', 'dfd'),
			'validate' => 'numeric',
			'default' => 3,
			'hint' => array(
				'title' => esc_attr__('Border radius', 'dfd'),
				'content' => esc_attr__('This option allows you to set the border radius for the back to top button. The radius should be added in %, don\'t include "%"', 'dfd')
			)
		),
		array(
			'id' => 'to_top_button_border',
			'type' => 'color',
			'title' => __('To Top button border color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Button border', 'dfd'),
				'content' => esc_attr__('This option allows you to set the border color for the back to top button', 'dfd')
			)
		),
		array(
			'id' => 'to_top_button_border_opacity',
			'type' => 'slider',
			'title' => __('To Top button border opacity', 'dfd'),
			'min' => '1',
			'max' => '100',
			'step' => '1',
			'default' => '100',
			'hint' => array(
				'title' => esc_attr__('Button border opacity', 'dfd'),
				'content' => esc_attr__('This option allows you to set the border color\'s opacity for the back to top button', 'dfd')
			)
		),
		array(
			'id' => 'to_top_button_hover_border',
			'type' => 'color',
			'title' => __('To Top button border color on hover', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Border hover color', 'dfd'),
				'content' => esc_attr__('This option allows you to set the border hover color for the back to top button', 'dfd')
			)
		),
		array(
			'id' => 'to_top_button_hover_border_opacity',
			'type' => 'slider',
			'title' => __('To Top button border opacity on hover', 'dfd'),
			'min' => '1',
			'max' => '100',
			'step' => '1',
			'default' => '100',
			'hint' => array(
				'title' => esc_attr__('Button border hover opacity', 'dfd'),
				'content' => esc_attr__('This option allows you to set the border color\'s opacity for the back to top button on hover', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Custom CSS / JS', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'icon' => 'crdash-crown',
	'subsection' => true,
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'head_custom_js',
			'type' => 'textarea',
			'title' => __('JS code to be added inside HEAD tag', 'dfd'),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('JS in HEAD', 'dfd'),
				'content' => esc_attr__('Allows you to add the custom javascript code to head tag streight after the Jquery. Please pay attention that this option requires at list WP 4.5 version', 'dfd')
			)
		),
		array(
			'id' => 'custom_js',
			'type' => 'textarea',
			'title' => __('Custom JS', 'dfd'),
			'validate' => 'dfd_prebuilt_js',
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Custom JS', 'dfd'),
				'content' => esc_attr__('Allows you to add the custom javascript code if you need to customize anything using js', 'dfd')
			)
		),
		array(
			'id' => 'custom_css',
			'type' => 'textarea',
			'title' => __('Custom CSS', 'dfd'),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Custom CSS', 'dfd'),
				'content' => esc_attr__('Allows you to add any custom CSS code if you need to customize styles', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => esc_html__('Header options', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'icon' => 'crdash-panel_show',
	//Lets leave this as a blank section, no options just some intro text set above.
));
Redux::setSection($opt_name, array(
	'title' => __('Header main options', 'dfd'),
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'top_page_inner',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Top inner page settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'top_panel_inner_page_select',
			'type' => 'select',
			'data' => 'pages',
			'title' => __('Top inner page', 'dfd'),
			'hint' => array(
				'title' => esc_attr__('Top inner page', 'dfd'),
				'content' => esc_attr__('Allows you to select any custom page as top inner page. Note, you have to be sure, that the top inner page and the main page are not the same to avoid conflicts and errors on the page', 'dfd')
			)
		),
		array(
			'id' => 'top_panel_inner_style',
			'type' => 'select',
			'title' => __('Top inner page style', 'dfd'),
			'options' => array(
				'' => __('Sliding up/down over header', 'dfd'),
				'dfd-panel-animated' => __('Full screen animated', 'dfd')
			),
			'required' => array('top_panel_inner_page_select', "!=", ''),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Inner page style', 'dfd'),
				'content' => esc_attr__('Allows you to specify the style of the top inner page', 'dfd')
			)
		),
		array(
			'id' => 'top_panel_inner_background',
			'type' => 'color',
			'title' => __('Top inner page background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array('top_panel_inner_page_select', "!=", ''),
			'hint' => array(
				'title' => esc_attr__('Top page background', 'dfd'),
				'content' => esc_attr__('Allows you to add the background color for the top panel inner page', 'dfd')
			)
		),
		array(
			'id' => 'top_panel_inner_background_opacity',
			'type' => 'slider',
			'title' => __('Top inner page background opacity ', 'dfd'),
			'min' => '0',
			'max' => '100',
			'step' => '1',
			'default' => '100',
			'required' => array('top_panel_inner_page_select', "!=", ''),
			'hint' => array(
				'title' => esc_attr__('Top page background opacity', 'dfd'),
				'content' => esc_attr__('Allows you to add the background color opacity for the top panel inner page', 'dfd')
			)
		),
		array(
			'id' => 'main_header_settings',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Header main settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'extra_header_options',
			'type' => 'button_set',
			'title' => __('New header styles', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'off',
			'hint' => array(
				'title' => esc_attr__('New header styles', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable new styles for the header', 'dfd')
			)
		),
		array(
			'id' => 'header_layout',
			'type' => 'button_set',
			'title' => __('Boxed header layout', 'dfd'),
			'options' => dfd_header_layouts(),
			'default' => 'fullwidth',
			'hint' => array(
				'title' => esc_attr__('Boxed header', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the boxed width for the header', 'dfd')
			)
		),
		array(
			'id' => 'top_adress_field',
			'type' => 'textarea',
			'title' => __('Top address panel', 'dfd'),
			'sub_desc' => __('Please do not use single quote here', 'dfd'),
			'validate' => 'html',
			'default' => '<i class="dfd-icon-phone"></i><span class="dfd-top-info-delim-blank"></span>+1234567890<span class="dfd-top-info-delim"></span><i class="dfd-icon-email_2"></i><span class="dfd-top-info-delim-blank"></span>info@yourmail.com',
			'hint' => array(
				'title' => esc_attr__('Address panel', 'dfd'),
				'content' => esc_attr__('Add the address information which will be visible in top panel', 'dfd')
			)
		),
		array(
			'id' => 'show_header_cart',
			'type' => 'button_set',
			'title' => __('Shopping cart button in header', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'required' => array('extra_header_options', "=", 'on'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Shopping cart', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the shopping cart button in header. Note, this option is available if Woocommerce plugin is installed', 'dfd')
			)
		),
		array(
			'id' => 'header_cart_style',
			'type' => 'select',
			'title' => __('Shopping cart button style', 'dfd'),
			'options' => dfd_header_cart_style(),
			'required' => array('show_header_cart', "=", 'on'),
			'default' => 'simple',
			'hint' => array(
				'title' => esc_attr__('Shopping cart style', 'dfd'),
				'content' => esc_attr__('This option allows you to one of the preset styles for the cart button', 'dfd')
			)
		),
		array(
			'id' => 'wpml_lang_show',
			'type' => 'button_set',
			'title' => __('WPML language switcher', 'dfd'),
			'desc' => __('You can find WPML plugin here: http://wpml.org/', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('WPML switcher', 'dfd'),
				'content' => esc_attr__('Allows you to have the WPML language switcher in header. Note, WPML plugin must be installed', 'dfd')
			)
		),
		array(
			'id' => 'lang_shortcode',
			'type' => 'textarea',
			'title' => __('Language selection shortcode', 'dfd'),
			'default' => '<div class="lang-sel sel-dropdown"><a href="#"><span>En</span></a><ul><li><a href="#">En</a></li><li><a href="#">De</a></li><li><a href="#">Fr</a></li></ul></div>',
			'hint' => array(
				'title' => esc_attr__('Language shortcode', 'dfd'),
				'content' => esc_attr__('In this field you can paste the language shortcode provided by the translating plugin', 'dfd')
			)
		),
		array(
			'id' => 'header_logo_width',
			'type' => 'slider',
			'title' => __('Header logo width', 'dfd'),
			'min' => '30',
			'max' => '700',
			'step' => '1',
			'default' => '206',
			'hint' => array(
				'title' => esc_attr__('Logo width', 'dfd'),
				'content' => esc_attr__('Specify the width on the logotype image set in the header. The logotype can be uploaded in Theme Options > General options >Logos', 'dfd')
			)
		),
		array(
			'id' => 'header_logo_height',
			'type' => 'slider',
			'title' => __('Header logo height', 'dfd'),
			'min' => '20',
			'max' => '300',
			'step' => '1',
			'default' => '42',
			'hint' => array(
				'title' => esc_attr__('Logo height', 'dfd'),
				'content' => esc_attr__('Specify the height on the logotype image set in the header. The logotype can be uploaded in Theme Options > General options > Logos', 'dfd')
			)
		),
		array(
			'id' => 'top_menu_height',
			'type' => 'slider',
			'title' => __('Top menu height', 'dfd'),
			'min' => '20',
			'max' => '150',
			'step' => '2',
			'default' => '70',
			'hint' => array(
				'title' => esc_attr__('Top menu height', 'dfd'),
				'content' => esc_attr__('Set the height of the header (without the top panel). The min recommended height for the top menu height should be the same as the logo height in order not to damage the header structure', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Sticky header options', 'dfd'),
	'icon' => 'crdash-crown',
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'sticky_header_settings',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Sticky header main options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'enable_sticky_header',
			'type' => 'button_set',
			'title' => __('Sticky header', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Sticky header', 'dfd'),
				'content' => esc_attr__('Allows you to add the sticky header which makes the menu visible when you scroll down the page', 'dfd')
			)
		),
		array(
			'id' => 'sticky_header_animation',
			'type' => 'select',
			'title' => __('Sticky header animation', 'dfd'),
			'options' => dfd_sticky_header_animations(),
			'required' => array('enable_sticky_header', "=", 'on'),
			'default' => 'simple',
			'hint' => array(
				'title' => esc_attr__('Sticky header animation', 'dfd'),
				'content' => esc_attr__('Allows you to add the sticky header appear animation', 'dfd')
			)
		),
		array(
			'id' => 'sticky_header_style',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Sticky header color options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'fixed_header_background_color',
			'type' => 'color',
			'title' => __('Sticky header background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array('enable_sticky_header', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Sticky header background', 'dfd'),
				'content' => esc_attr__('Allows you to add the background for the sticky header', 'dfd')
			)
		),
		array(
			'id' => 'sticky_header_logo_background_color',
			'type' => 'color',
			'title' => __('Sticky header logo background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array('enable_sticky_header', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Sticky header logo background', 'dfd'),
				'content' => esc_attr__('Allows you to add the background for the sticky header\'s logotype image', 'dfd')
			)
		),
		array(
			'id' => 'fixed_header_background_opacity',
			'type' => 'slider',
			'title' => __('Sticky Header background opacity ', 'dfd'),
			'min' => '0',
			'max' => '100',
			'step' => '1',
			'default' => '100',
			'required' => array('enable_sticky_header', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Sticky header background opacity', 'dfd'),
				'content' => esc_attr__('Allows you to add the background color opacity for the sticky header', 'dfd')
			)
		),
		array(
			'id' => 'fixed_header_text_color',
			'type' => 'color',
			'title' => __('Sticky header text color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array('enable_sticky_header', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Sticky header text', 'dfd'),
				'content' => esc_attr__('Allows you to choose the color for the menu items text in sticky header', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Stunning header option', 'dfd'),
	'icon' => 'crdash-crown',
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'stunning_header_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Stunning header main options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'stan_header',
			'type' => 'button_set',
			'title' => __('Stunning header', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Stunning header', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the stunning header. Stunning header is an area with page title, subtitle and breadcrumbs that is set in the top header section', 'dfd')
			)
		),
		array(
			'id' => 'stunning_header_min_height',
			'type' => 'slider',
			'title' => __('Stunning header min height', 'dfd'),
			'min' => '100',
			'step' => '5',
			'max' => '600',
			'default' => '400',
			'hint' => array(
				'title' => esc_attr__('Min height', 'dfd'),
				'content' => esc_attr__('This option allows you to set the min height for the stunning header. There is also an option on the item\'s page if you need to change the stunning header height for one single item', 'dfd')
			)
		),
		array(
			'id' => 'stunning_header_main_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Stunning header background options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'stan_header_color',
			'type' => 'color',
			'title' => __('Default background color', 'dfd'),
			'default' => '#ffffff',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('This option allows you to set the default background color for the stunning header. There is also an option on the item\'s page if you need to change the stunning header background color for one single item', 'dfd')
			)
		),
		array(
			'id' => 'stan_header_image',
			'type' => 'media',
			'title' => __('Default background image', 'dfd'),
			'desc' => __('Upload your own background image or pattern.', 'dfd'),
			'default' => array(
				'url' => ''
			),
			'hint' => array(
				'title' => esc_attr__('Background image', 'dfd'),
				'content' => esc_attr__('This option allows you to set the default background image for the stunning header. There is also an option on the item\'s page if you need to change the stunning header background image for one single item', 'dfd')
			)
		),
		array(
			'id' => 'stan_header_bg_img_position',
			'type' => 'select',
			'title' => __('Default background position', 'dfd'),
			'default' => '',
			'options' => dfd_get_bgposition(),
			'hint' => array(
				'title' => esc_attr__('Background position', 'dfd'),
				'content' => esc_attr__('This option allows you to set the default background image position for the stunning header. There is also an option on the item\'s page if you need to change the stunning header background image position for one single item', 'dfd')
			)
		),
		array(
			'id' => 'stun_header_bg_size',
			'type' => 'select',
			'title' => __('Default background size', 'dfd'),
			'default' => 'initial',
			'options' => dfd_get_bgsize(),
			'hint' => array(
				'title' => esc_attr__('Background size', 'dfd'),
				'content' => esc_attr__('This option allows you to set the default background image size for the stunning header. There is also an option on the item\'s page if you need to change the stunning header background image size for one single item', 'dfd')
			)
		),
		array(
			'id' => 'stan_header_fixed',
			'type' => 'button_set',
			'title' => __('Fixed background position', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd'),),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Fixed background position', 'dfd'),
				'content' => esc_attr__('This option allows you to set the fixed background image position for the stunning header. There is also an option on the item\'s page if you need to change the stunning header background image position for one single item', 'dfd')
			)
		),
		array(
			'id' => 'stan_header_bgcheck',
			'type' => 'button_set',
			'title' => __('Dark background', 'dfd'),
			'options' => array(
				'1' => __('On', 'dfd'),
				'0' => __('Off', 'dfd'),
			),
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Dark background', 'dfd'),
				'content' => esc_attr__('Enable this option if you\'ve set dark background color. The text color will be changed to make the text more readable', 'dfd')
			)
		),
		array(
			'id' => 'stunning_header_content',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Stunning header content options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'enable_stun_header_title',
			'type' => 'button_set',
			'title' => __('Stunning header title', 'dfd'),
			'options' => array(
				'1' => __('On', 'dfd'),
				'0' => __('Off', 'dfd'),
			),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Stunning header title', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the title of the page in the stunning header', 'dfd')
			)
		),
		array(
			'id' => 'stan_header_text_align',
			'type' => 'select',
			'title' => __('Stunning header text alignment', 'dfd'),
			'options' => array(
				'text-center' => __('Center', 'dfd'),
				'text-left' => __('Left', 'dfd'),
				'text-right' => __('Right', 'dfd'),
			),
			'default' => 'text-center',
			'hint' => array(
				'title' => esc_attr__('Text alignment', 'dfd'),
				'content' => esc_attr__('This option allows you to align the text horizontally in stunning header', 'dfd')
			)
		),
		array(
			'id' => 'stan_header_breadcrumbs',
			'type' => 'button_set',
			'title' => __('Stunning header breadcrumbs', 'dfd'),
			'options' => array(
				'1' => __('On', 'dfd'),
				'off' => __('Off', 'dfd'),
			),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Stunning header breadcrumbs', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the breadcrumbs of the page in the stunning header', 'dfd')
			)
		),
		array(
			'id' => 'stan_header_breadcrumbs_style',
			'type' => 'select',
			'title' => __('Breadcrumbs style', 'dfd'),
			'options' => array(
				'simple' => __('Theme default', 'dfd'),
				'transparent-bg' => __('Transparent background', 'dfd'),
			),
			'default' => 'simple',
			'hint' => array(
				'title' => esc_attr__('Breadcrumbs style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset styles for the breadcrumbs of the page in the stunning header', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Header style 1 options', 'dfd'),
	'subsection' => true,
	'icon' => 'crdash-panel_show',
	'fields' => array(
		array(
			'id' => 'header_first_sticky',
			'type' => 'button_set',
			'title' => __('Header animation', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Header animation', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the header animation on scroll', 'dfd')
			)
		),
		array(
			'id' => 'h1_top_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Top panel settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'header_first_top_panel',
			'type' => 'button_set',
			'title' => __('Header top panel', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Header top panel', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the header top panel where the address information, login and social icons can be set', 'dfd')
			)
		),
		array(
			'id' => 'head_first_enable_top_panel_wishlist_link',
			'type' => 'button_set',
			'title' => __('Wishlist button in top panel', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('header_first_top_panel', "=", 'on'),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Wishlist button', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the Wishlist button in header. Note, this option is available if YITH WooCommerce Wishlist plugin is installed', 'dfd')
			)
		),
		array(
			'id' => 'header_first_login',
			'type' => 'button_set',
			'title' => __('Login form', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array(
				'header_first_top_panel', "=", 'on',
			),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Login form', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the login form in the top panel', 'dfd')
			)
		),
		array(
			'id' => 'head_first_show_header_soc_icons',
			'type' => 'button_set',
			'title' => __('Social icons', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('header_first_top_panel', "=", 'on'),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Social icons', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the social icon in the top panel, the social icons can be added in Social networks section in theme options', 'dfd')
			)
		),
		array(
			'id' => 'header_first_soc_icons_hover_style',
			'type' => 'select',
			'title' => __('Social icons hover style', 'dfd'),
			'options' => dfd_soc_icons_hover_style(),
			'required' => array('header_first_top_panel', "=", 'on'),
			'default' => '26',
			'hint' => array(
				'title' => esc_attr__('Icons hover style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset hover styles for the Social networks', 'dfd')
			)
		),
		/* array(
		  'id' => 'header_first_soc_icons_background',
		  'type' => 'color',
		  'title' => __('Header social networks section background', 'dfd'),
		  'default' => '',
		  'required' => array( 'header_first_top_panel', "=", 'on' ),
		  'validate' => 'color_rgba',
		  ), */
		array(
			'id' => 'header_first_top_panel_background_color',
			'type' => 'color',
			'title' => __('Top panel background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array('header_first_top_panel', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background color for the header top panel', 'dfd')
			)
		),
		array(
			'id' => 'header_first_top_panel_color',
			'type' => 'color',
			'title' => __('Top panel text color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array('header_first_top_panel', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Text color', 'dfd'),
				'content' => esc_attr__('Choose the text color for the elements set in header top panel', 'dfd')
			)
		),
		array(
			'id' => 'h1_header_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Main section settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'head_first_enable_buttons',
			'type' => 'button_set',
			'title' => __('Header buttons and links', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Buttons and links', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable buttons set in header', 'dfd')
			)
		),
		array(
			'id' => 'show_search_form_header_1',
			'type' => 'button_set',
			'title' => __('Search form in header', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('head_first_enable_buttons', "=", 1),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Search in header', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the search icon in header', 'dfd')
			)
		),
		array(
			'id' => 'header_first_background_color',
			'type' => 'color',
			'title' => __('Header background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background color for the header main section', 'dfd')
			)
		),
		array(
			'id' => 'header_first_text_color',
			'type' => 'color',
			'title' => __('Header text color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Text color', 'dfd'),
				'content' => esc_attr__('Choose the text color for the elements set in header', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Header style 2 options', 'dfd'),
	'subsection' => true,
	'icon' => 'crdash-panel_show',
	'fields' => array(
		array(
			'id' => 'header_second_sticky',
			'type' => 'button_set',
			'title' => __('Header animation', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Header animation', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the header animation on scroll', 'dfd')
			)
		),
		array(
			'id' => 'h2_top_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Top panel settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'header_second_top_panel',
			'type' => 'button_set',
			'title' => __('Header top panel', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Header top panel', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the header top panel where the address information, login and social icons can be set', 'dfd')
			)
		),
		array(
			'id' => 'header_second_login',
			'type' => 'button_set',
			'title' => __('Login form', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array(
				'header_second_top_panel', "=", 'on',
			),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Login form', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the login form in the top panel', 'dfd')
			)
		),
		array(
			'id' => 'head_second_enable_top_panel_wishlist_link',
			'type' => 'button_set',
			'title' => __('Wishlist button in top panel', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('header_second_top_panel', "=", 'on'),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Wishlist button', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the Wishlist button in header. Note, this option is available if YITH WooCommerce Wishlist plugin is installed', 'dfd')
			)
		),
		array(
			'id' => 'head_second_show_soc_icons',
			'type' => 'button_set',
			'title' => __('Social icons', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('header_second_top_panel', "=", 'on'),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Social icons', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the social icon in the top panel, the social icons can be added in Social networks section in theme options', 'dfd')
			)
		),
		/* array(
		  'id' => 'header_second_soc_icons_background',
		  'type' => 'color',
		  'title' => __('Header social networks section background', 'dfd'),
		  'default' => '',
		  'required' => array( 'header_second_top_panel', "=", 'on' ),
		  'validate' => 'color_rgba',
		  ), */
		array(
			'id' => 'header_second_soc_icons_hover_style',
			'type' => 'select',
			'title' => __('Social icons hover style', 'dfd'),
			'options' => dfd_soc_icons_hover_style(),
			'required' => array('header_second_top_panel', "=", 'on'),
			'default' => '26',
			'hint' => array(
				'title' => esc_attr__('Icons hover style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset hover styles for the Social networks', 'dfd')
			)
		),
		array(
			'id' => 'header_second_top_panel_background_color',
			'type' => 'color',
			'title' => __('Top panel background color', 'dfd'),
			'default' => 'transparent',
			'validate' => 'color_rgba',
			'required' => array('header_second_top_panel', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background color for the header top panel', 'dfd')
			)
		),
		array(
			'id' => 'header_second_top_panel_background_opacity',
			'type' => 'slider',
			'title' => __('Top panel background opacity ', 'dfd'),
			'min' => '0',
			'max' => '100',
			'step' => '1',
			'default' => '0',
			'required' => array('header_second_top_panel', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Background color opacity', 'dfd'),
				'content' => esc_attr__('Choose the background color opacity for the header top panel', 'dfd')
			)
		),
		array(
			'id' => 'header_second_top_panel_color',
			'type' => 'color',
			'title' => __('Top panel text color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array('header_second_top_panel', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Text color', 'dfd'),
				'content' => esc_attr__('Choose the text color for the elements set in header top panel', 'dfd')
			)
		),
		array(
			'id' => 'h2_header_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Main section settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'head_second_enable_buttons',
			'type' => 'button_set',
			'title' => __('Header buttons and links', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Buttons and links', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable buttons set in header', 'dfd')
			)
		),
		array(
			'id' => 'show_search_form_header_2',
			'type' => 'button_set',
			'title' => __('Search form in header', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('head_second_enable_buttons', "=", 1),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Search in header', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the search icon in header', 'dfd')
			)
		),
		array(
			'id' => 'header_second_background_color',
			'type' => 'color',
			'title' => __('Header background color', 'dfd'),
			'default' => 'transparent',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background color for the header main section', 'dfd')
			)
		),
		array(
			'id' => 'header_second_background_opacity',
			'type' => 'slider',
			'title' => __('Header background opacity ', 'dfd'),
			'min' => '0',
			'max' => '100',
			'step' => '1',
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Background color opacity', 'dfd'),
				'content' => esc_attr__('Choose the background color opacity for the header main section', 'dfd')
			)
		),
		array(
			'id' => 'header_second_text_color',
			'type' => 'color',
			'title' => __('Header text color', 'dfd'),
			'default' => '#ffffff',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Text color', 'dfd'),
				'content' => esc_attr__('Choose the text color for the elements set in header', 'dfd')
			)
		),
		array(
			'id' => 'stun_header_title_align_header_2',
			'type' => 'button_set',
			'title' => __('Center align stunning header title from the bottom of the menu', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Align stunning header', 'dfd'),
				'content' => esc_attr__('This option allows you to add extra space beneath the header and the Stunning header shifts down for the header height', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Header style 3 options', 'dfd'),
	'subsection' => true,
	'icon' => 'crdash-panel_show',
	'fields' => array(
		array(
			'id' => 'header_third_sticky',
			'type' => 'button_set',
			'title' => __('Header animation', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Header animation', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the header animation on scroll', 'dfd')
			)
		),
		array(
			'id' => 'h3_top_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Top panel settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'header_third_top_panel',
			'type' => 'button_set',
			'title' => __('Header top panel', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Header top panel', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the header top panel where the address information, login and social icons can be set', 'dfd')
			)
		),
		array(
			'id' => 'header_third_login',
			'type' => 'button_set',
			'title' => __('Login form', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array(
				'header_third_top_panel', "=", 'on',
			),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Login form', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the login form in the top panel', 'dfd')
			)
		),
		array(
			'id' => 'head_third_enable_top_panel_wishlist_link',
			'type' => 'button_set',
			'title' => __('Wishlist button in top panel', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('header_third_top_panel', "=", 'on'),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Wishlist button', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the Wishlist button in header. Note, this option is available if YITH WooCommerce Wishlist plugin is installed', 'dfd')
			)
		),
		array(
			'id' => 'head_third_show_header_soc_icons',
			'type' => 'button_set',
			'title' => __('Social icons', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('header_third_top_panel', "=", 'on'),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Social icons', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the social icon in the top panel, the social icons can be added in Social networks section in theme options', 'dfd')
			)
		),
		/* array(
		  'id' => 'header_third_soc_icons_background',
		  'type' => 'color',
		  'title' => __('Header social networks section background', 'dfd'),
		  'default' => '',
		  'required' => array( 'header_third_top_panel', "=", 'on' ),
		  'validate' => 'color_rgba',
		  ), */
		array(
			'id' => 'header_third_soc_icons_hover_style',
			'type' => 'select',
			'title' => __('Social icons hover style', 'dfd'),
			'options' => dfd_soc_icons_hover_style(),
			'required' => array('header_third_top_panel', "=", 'on'),
			'default' => '26',
			'hint' => array(
				'title' => esc_attr__('Icons hover style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset hover styles for the Social networks', 'dfd')
			)
		),
		array(
			'id' => 'header_third_top_panel_background_color',
			'type' => 'color',
			'title' => __('Top panel background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array('header_third_top_panel', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background color for the header top panel', 'dfd')
			)
		),
		array(
			'id' => 'header_third_top_panel_color',
			'type' => 'color',
			'title' => __('Top panel text color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array('header_third_top_panel', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Text color', 'dfd'),
				'content' => esc_attr__('Choose the text color for the elements set in header top panel', 'dfd')
			)
		),
		array(
			'id' => 'h3_header_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Main section settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'head_third_enable_buttons',
			'type' => 'button_set',
			'title' => __('Header buttons and links', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Buttons and links', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable buttons set in header', 'dfd')
			)
		),
		array(
			'id' => 'show_search_form_header_3',
			'type' => 'button_set',
			'title' => __('Search form in header', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('head_third_enable_buttons', "=", 1),
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Search in header', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the search icon in header', 'dfd')
			)
		),
		array(
			'id' => 'show_lang_sel_header_3',
			'type' => 'button_set',
			'title' => __('Language switcher in header', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('head_third_enable_buttons', "=", 1),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Language switcher', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable language switcher in header', 'dfd')
			)
		),
		array(
			'id' => 'header_third_background_color',
			'type' => 'color',
			'title' => __('Header background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background color for the header main section', 'dfd')
			)
		),
		array(
			'id' => 'header_third_text_color',
			'type' => 'color',
			'title' => __('Header text color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Text color', 'dfd'),
				'content' => esc_attr__('Choose the text color for the elements set in header', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Header style 4 options', 'dfd'),
	'subsection' => true,
	'icon' => 'crdash-panel_show',
	'fields' => array(
		array(
			'id' => 'header_fourth_sticky',
			'type' => 'button_set',
			'title' => __('Header animation', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Header animation', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the header animation on scroll', 'dfd')
			)
		),
		array(
			'id' => 'h4_top_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Top panel settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'header_fourth_top_panel',
			'type' => 'button_set',
			'title' => __('Header top panel', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Header top panel', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the header top panel where the address information, login and social icons can be set', 'dfd')
			)
		),
		array(
			'id' => 'header_fourth_login',
			'type' => 'button_set',
			'title' => __('Login form', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array(
				'header_fourth_top_panel', "=", 'on',
			),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Login form', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the login form in the top panel', 'dfd')
			)
		),
		array(
			'id' => 'head_fourth_enable_top_panel_wishlist_link',
			'type' => 'button_set',
			'title' => __('Wishlist button in top panel', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('header_fourth_top_panel', "=", 'on'),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Wishlist button', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the Wishlist button in header. Note, this option is available if YITH WooCommerce Wishlist plugin is installed', 'dfd')
			)
		),
		array(
			'id' => 'head_fourth_show_soc_icons',
			'type' => 'button_set',
			'title' => __('Social icons', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('header_fourth_top_panel', "=", 'on'),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Social icons', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the social icon in the top panel, the social icons can be added in Social networks section in theme options', 'dfd')
			)
		),
		/* array(
		  'id' => 'header_fourth_soc_icons_background',
		  'type' => 'color',
		  'title' => __('Header social networks section background', 'dfd'),
		  'default' => '',
		  'required' => array( 'header_fourth_top_panel', "=", 'on' ),
		  'validate' => 'color_rgba',
		  ), */
		array(
			'id' => 'header_fourth_soc_icons_hover_style',
			'type' => 'select',
			'title' => __('Social icons hover style', 'dfd'),
			'options' => dfd_soc_icons_hover_style(),
			'required' => array('header_fourth_top_panel', "=", 'on'),
			'default' => '26',
			'hint' => array(
				'title' => esc_attr__('Icons hover style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset hover styles for the Social networks', 'dfd')
			)
		),
		array(
			'id' => 'header_fourth_top_panel_background_color',
			'type' => 'color',
			'title' => __('Top panel background color', 'dfd'),
			'default' => 'transparent',
			'validate' => 'color_rgba',
			'required' => array('header_fourth_top_panel', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background color for the header top panel', 'dfd')
			)
		),
		array(
			'id' => 'header_fourth_top_panel_background_opacity',
			'type' => 'slider',
			'title' => __('Top panel background opacity ', 'dfd'),
			'min' => '0',
			'max' => '100',
			'step' => '1',
			'default' => '0',
			'required' => array('header_fourth_top_panel', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Background color opacity', 'dfd'),
				'content' => esc_attr__('Choose the background color opacity for the header top panel', 'dfd')
			)
		),
		array(
			'id' => 'header_fourth_top_panel_color',
			'type' => 'color',
			'title' => __('Top panel text color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array('header_fourth_top_panel', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Text color', 'dfd'),
				'content' => esc_attr__('Choose the text color for the elements set in header top panel', 'dfd')
			)
		),
		array(
			'id' => 'h4_header_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Main section settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'head_fourth_enable_buttons',
			'type' => 'button_set',
			'title' => __('Header buttons and links', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Buttons and links', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable buttons set in header', 'dfd')
			)
		),
		array(
			'id' => 'show_search_form_header_4',
			'type' => 'button_set',
			'title' => __('Search form in header', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('head_fourth_enable_buttons', "=", 1),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Search in header', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the search icon in header', 'dfd')
			)
		),
		array(
			'id' => 'show_lang_sel_header_4',
			'type' => 'button_set',
			'title' => __('Language switcher in header', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('head_fourth_enable_buttons', "=", 1),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Language switcher', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable language switcher in header', 'dfd')
			)
		),
		array(
			'id' => 'header_fourth_background_color',
			'type' => 'color',
			'title' => __('Header background color', 'dfd'),
			'default' => 'transparent',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background color for the header main section', 'dfd')
			)
		),
		array(
			'id' => 'header_fourth_background_opacity',
			'type' => 'slider',
			'title' => __('Header background opacity ', 'dfd'),
			'min' => '0',
			'max' => '100',
			'step' => '1',
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Background color opacity', 'dfd'),
				'content' => esc_attr__('Choose the background color opacity for the header main section', 'dfd')
			)
		),
		array(
			'id' => 'header_fourth_text_color',
			'type' => 'color',
			'title' => __('Header text color', 'dfd'),
			'default' => '#ffffff',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Text color', 'dfd'),
				'content' => esc_attr__('Choose the text color for the elements set in header', 'dfd')
			)
		),
		array(
			'id' => 'stun_header_title_align_header_4',
			'type' => 'button_set',
			'title' => __('Center align stunning header title from the bottom of the menu', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Align stunning header', 'dfd'),
				'content' => esc_attr__('This option allows you to add extra space beneath the header and the Stunning header shifts down for the header height', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Header style 5 options', 'dfd'),
	'subsection' => true,
	'icon' => 'crdash-panel_show',
	'fields' => array(
		array(
			'id' => 'h5_header_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Main content settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'header_fifth_copyright',
			'type' => 'text',
			'title' => __('Copyright message', 'dfd'),
			'sub_desc' => __('Please do not use single quote here', 'dfd'),
			'validate' => 'html',
			'default' => '<a href="http://rnbtheme.com" title="DFD">© DynamicFrameworks</a>- Elite ThemeForest Author.',
			'hint' => array(
				'title' => esc_attr__('Copyright', 'dfd'),
				'content' => esc_attr__('Add the copyright message which will be visible in header', 'dfd')
			)
		),
		array(
			'id' => 'header_fifth_top_panel',
			'type' => 'button_set',
			'title' => __('Top info', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Top info', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable top info in header', 'dfd')
			)
		),
		array(
			'id' => 'header_fifth_login',
			'type' => 'button_set',
			'title' => __('Login form', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Login form', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the login form in the header', 'dfd')
			)
		),
		array(
			'id' => 'head_fifth_show_header_soc_icons',
			'type' => 'button_set',
			'title' => __('Social icons', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Social icons', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the social icon in the top panel, the social icons can be added in Social networks section in header', 'dfd')
			)
		),
		array(
			'id' => 'header_fifth_soc_icons_hover_style',
			'type' => 'select',
			'title' => __('Social icons hover style', 'dfd'),
			'options' => dfd_soc_icons_hover_style(),
			'default' => '26',
			'hint' => array(
				'title' => esc_attr__('Icons hover style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset hover styles for the Social networks', 'dfd')
			)
		),
		array(
			'id' => 'show_search_form_header_5',
			'type' => 'button_set',
			'title' => __('Search form in header', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Search in header', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the search icon in header', 'dfd')
			)
		),
		array(
			'id' => 'show_lang_sel_header_5',
			'type' => 'button_set',
			'title' => __('Language switcher in header', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Language switcher', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable language switcher in header', 'dfd')
			)
		),
		array(
			'id' => 'h5_styling_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Header styling options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'header_fifth_alignment',
			'type' => 'select',
			'title' => __('Header alignment', 'dfd'),
			'options' => array(
				'left' => __('Left', 'dfd'),
				'right' => __('Right', 'dfd'),
			),
			'default' => 'left',
			'hint' => array(
				'title' => esc_attr__('Header alignment', 'dfd'),
				'content' => esc_attr__('Choose the position of the header according to the content', 'dfd')
			)
		),
		array(
			'id' => 'header_fifth_content_alignment',
			'type' => 'select',
			'title' => __('Header content alignment', 'dfd'),
			'options' => dfd_alignment_options(),
			'default' => 'text-left',
			'hint' => array(
				'title' => esc_attr__('Header content alignment', 'dfd'),
				'content' => esc_attr__('This option allows you to choose horizontal alignment for the header content', 'dfd')
			)
		),
		array(
			'id' => 'fifth_header_logo_background_color',
			'type' => 'color',
			'title' => __('Header logo background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Header logo background', 'dfd'),
				'content' => esc_attr__('Allows you to add the background for the header\'s logotype image', 'dfd')
			)
		),
		array(
			'id' => 'header_fifth_background_color',
			'type' => 'color',
			'title' => __('Header background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background color for the header main section', 'dfd')
			)
		),
		array(
			'id' => 'header_fifth_bg_image',
			'type' => 'media',
			'title' => __('Header background image', 'dfd'),
			'desc' => __('Upload your own background image or pattern.', 'dfd'),
			'default' => array(
				'url' => ''
			),
			'hint' => array(
				'title' => esc_attr__('Header background image', 'dfd'),
				'content' => esc_attr__('Select the image from the media library which will be set as a header background image', 'dfd')
			)
		),
		array(
			'id' => 'header_fifth_bg_img_position',
			'type' => 'select',
			'title' => __('Header background image position', 'dfd'),
			'default' => '',
			'options' => dfd_get_bgposition(),
			'hint' => array(
				'title' => esc_attr__('Background position', 'dfd'),
				'content' => esc_attr__('This option allows you to set the background image position for the header', 'dfd')
			)
		),
		array(
			'id' => 'header_fifth_text_color',
			'type' => 'color',
			'title' => __('Header text color', 'dfd'),
			'default' => '',
			'validate' => 'color',
			'hint' => array(
				'title' => esc_attr__('Text color', 'dfd'),
				'content' => esc_attr__('Choose the text color for the elements set in header', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Header style 6 options', 'dfd'),
	'subsection' => true,
	'icon' => 'crdash-panel_show',
	'fields' => array(
		array(
			'id' => 'header_sixth_sticky',
			'type' => 'button_set',
			'title' => __('Header animation', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Header animation', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the header animation on scroll', 'dfd')
			)
		),
		array(
			'id' => 'show_search_form_header_6',
			'type' => 'button_set',
			'title' => __('Show search form in header (for mobile devices only)', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Search in header', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the search icon in header', 'dfd')
			)
		),
		array(
			'id' => 'header_sixth_text_color',
			'type' => 'color',
			'title' => __('Header elements color', 'dfd'),
			'default' => '',
			'validate' => 'color',
			'hint' => array(
				'title' => esc_attr__('Elements color', 'dfd'),
				'content' => esc_attr__('Choose the text color for the elements set in header', 'dfd')
			)
		),
		array(
			'id' => 'header_sixth_text_hover_color',
			'type' => 'color',
			'title' => __('Header elements hover color', 'dfd'),
			'validate' => 'color',
			'hint' => array(
				'title' => esc_attr__('Elements hover color', 'dfd'),
				'content' => esc_attr__('Choose the text hover color for the elements set in header', 'dfd')
			)
		),
		array(
			'id' => 'header_sixth_text_hover_background',
			'type' => 'color',
			'title' => __('Menu icon hover background', 'dfd'),
			'validate' => 'color',
			'hint' => array(
				'title' => esc_attr__('Menu hover background', 'dfd'),
				'content' => esc_attr__('Choose the background hover color for the menu icon', 'dfd')
			)
		),
		array(
			'id' => 'stun_header_title_align_header_6',
			'type' => 'button_set',
			'title' => __('Center align stunning header title from the bottom of the menu', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Align stunning header', 'dfd'),
				'content' => esc_attr__('This option allows you to add extra space beneath the header and the Stunning header shifts down for the header height', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Header style 7 options', 'dfd'),
	'subsection' => true,
	'icon' => 'crdash-panel_show',
	'fields' => array(
		array(
			'id' => 'header_seventh_sticky',
			'type' => 'button_set',
			'title' => __('Header animation', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Header animation', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the header animation on scroll', 'dfd')
			)
		),
		array(
			'id' => 'header_seventh_appear_effect',
			'type' => 'select',
			'title' => __('Header appear effect', 'dfd'),
			'options' => dfd_header_seventh_appear_effects(),
			'default' => 'default',
			'hint' => array(
				'title' => esc_attr__('Header appear effect', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the appear animation for the header', 'dfd')
			)
		),
		array(
			'id' => 'h7_header_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Main content settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'header_seventh_copyright',
			'type' => 'text',
			'title' => __('Copyright message', 'dfd'),
			'sub_desc' => __('Please do not use single quote here', 'dfd'),
			'validate' => 'html',
			'default' => '<a href="http://rnbtheme.com" title="DFD">© DynamicFrameworks</a>- Elite ThemeForest Author.',
			'hint' => array(
				'title' => esc_attr__('Copyright', 'dfd'),
				'content' => esc_attr__('Add the copyright message which will be visible in opened (active) header', 'dfd')
			)
		),
		array(
			'id' => 'header_seventh_top_panel',
			'type' => 'button_set',
			'title' => __('Top info', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Top info', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable top info in opened(active) header', 'dfd')
			)
		),
		array(
			'id' => 'header_seventh_login',
			'type' => 'button_set',
			'title' => __('Login form', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Login form', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the login form in the header', 'dfd')
			)
		),
		array(
			'id' => 'head_seventh_show_soc_icons',
			'type' => 'button_set',
			'title' => __('Social icons', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Social icons', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the social icon in the top panel, the social icons can be added in Social networks section in header', 'dfd')
			)
		),
		array(
			'id' => 'header_seventh_soc_icons_hover_style',
			'type' => 'select',
			'title' => __('Social icons hover style', 'dfd'),
			'options' => dfd_soc_icons_hover_style(),
			'default' => '26',
			'required' => array('head_seventh_show_soc_icons', '=', '1'),
			'hint' => array(
				'title' => esc_attr__('Icons hover style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset hover styles for the Social networks', 'dfd')
			)
		),
		array(
			'id' => 'show_search_form_header_7',
			'type' => 'button_set',
			'title' => __('Search form in header', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Search in header', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the search icon in header', 'dfd')
			)
		),
		array(
			'id' => 'show_lang_sel_header_7',
			'type' => 'button_set',
			'title' => __('Language switcher in header', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Language switcher', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable language switcher in opened(active) header', 'dfd')
			)
		),
		array(
			'id' => 'h7_styling_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Header styling options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'header_seventh_content_alignment',
			'type' => 'select',
			'title' => __('Header content alignment', 'dfd'),
			'options' => dfd_alignment_options(),
			'default' => 'text-left',
			'hint' => array(
				'title' => esc_attr__('Header content alignment', 'dfd'),
				'content' => esc_attr__('This option allows you to choose horizontal alignment for the header content', 'dfd')
			)
		),
		array(
			'id' => 'header_seventh_background_color',
			'type' => 'color',
			'title' => __('Header background color', 'dfd'),
			'default' => '#000000',
			'validate' => 'color',
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background color for the header main section', 'dfd')
			)
		),
		array(
			'id' => 'header_seventh_background_opacity',
			'type' => 'slider',
			'title' => __('Header background opacity ', 'dfd'),
			'min' => '0',
			'max' => '100',
			'step' => '1',
			'default' => '90',
			'hint' => array(
				'title' => esc_attr__('Background color opacity', 'dfd'),
				'content' => esc_attr__('Choose the background color opacity for the header main section', 'dfd')
			)
		),
		array(
			'id' => 'header_seventh_text_color_active',
			'type' => 'color',
			'title' => __('Active header text color', 'dfd'),
			'default' => '#ffffff',
			'validate' => 'color',
			'hint' => array(
				'title' => esc_attr__('Active header text color', 'dfd'),
				'content' => esc_attr__('Choose the text color for the opened(active) header', 'dfd')
			)
		),
		array(
			'id' => 'header_seventh_text_color',
			'type' => 'color',
			'title' => __('Menu button color', 'dfd'),
			'default' => '#ffffff',
			'validate' => 'color',
			'hint' => array(
				'title' => esc_attr__('Menu button color', 'dfd'),
				'content' => esc_attr__('Choose the color for the menu button', 'dfd')
			)
		),
		array(
			'id' => 'stun_header_title_align_header_7',
			'type' => 'button_set',
			'title' => __('Center align stunning header title from the bottom of the menu', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Align stunning header', 'dfd'),
				'content' => esc_attr__('This option allows you to add extra space beneath the header and the Stunning header shifts down for the header height', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Header style 8 options', 'dfd'),
	'subsection' => true,
	'icon' => 'crdash-panel_show',
	'fields' => array(
		array(
			'id' => 'h8_header_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Main content settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'header_eighth_copyright',
			'type' => 'text',
			'title' => __('Copyright message', 'dfd'),
			'sub_desc' => __('Please do not use single quote here', 'dfd'),
			'validate' => 'html',
			'default' => '<a href="http://rnbtheme.com" title="DFD">© DynamicFrameworks</a>- Elite ThemeForest Author.',
			'hint' => array(
				'title' => esc_attr__('Copyright', 'dfd'),
				'content' => esc_attr__('Add the copyright message which will be visible in opened (active) header', 'dfd')
			)
		),
		array(
			'id' => 'header_eighth_top_panel',
			'type' => 'button_set',
			'title' => __('Top info', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Top info', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable top info in opened(active) header', 'dfd')
			)
		),
		array(
			'id' => 'header_eighth_login',
			'type' => 'button_set',
			'title' => __('Login form', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Login form', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the login form in the header', 'dfd')
			)
		),
		array(
			'id' => 'head_eighth_show_header_soc_icons',
			'type' => 'button_set',
			'title' => __('Social icons', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Social icons', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the social icon in the top panel, the social icons can be added in Social networks section in header', 'dfd')
			)
		),
		array(
			'id' => 'header_eighth_soc_icons_hover_style',
			'type' => 'select',
			'title' => __('Social icons hover style', 'dfd'),
			'options' => dfd_soc_icons_hover_style(),
			'default' => '26',
			'required' => array('head_eighth_show_header_soc_icons', '=', '1'),
			'hint' => array(
				'title' => esc_attr__('Icons hover style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset hover styles for the Social networks', 'dfd')
			)
		),
		array(
			'id' => 'show_search_form_header_8',
			'type' => 'button_set',
			'title' => __('Search form in header', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Search in header', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the search icon in header', 'dfd')
			)
		),
		array(
			'id' => 'show_lang_sel_header_8',
			'type' => 'button_set',
			'title' => __('Language switcher in header', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Language switcher', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable language switcher in opened(active) header', 'dfd')
			)
		),
		array(
			'id' => 'h8_styling_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Header styling options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'header_eighth_alignment',
			'type' => 'select',
			'title' => __('Header alignment', 'dfd'),
			'options' => array(
				'left' => __('Left', 'dfd'),
				'right' => __('Right', 'dfd'),
			),
			'default' => 'left',
			'hint' => array(
				'title' => esc_attr__('Header alignment', 'dfd'),
				'content' => esc_attr__('Choose the position of the header according to the content', 'dfd')
			)
		),
		array(
			'id' => 'header_eighth_content_alignment',
			'type' => 'select',
			'title' => __('Header content alignment', 'dfd'),
			'options' => dfd_alignment_options(),
			'default' => 'text-left',
			'hint' => array(
				'title' => esc_attr__('Header content alignment', 'dfd'),
				'content' => esc_attr__('This option allows you to choose horizontal alignment for the header content', 'dfd')
			)
		),
		array(
			'id' => 'eighth_header_logo_background_color',
			'type' => 'color',
			'title' => __('Header logo background color', 'dfd'),
			'default' => '',
			'validate' => 'color',
			'hint' => array(
				'title' => esc_attr__('Header logo background', 'dfd'),
				'content' => esc_attr__('Allows you to add the background for the header\'s logotype image', 'dfd')
			)
		),
		array(
			'id' => 'header_eighth_navbutton_color',
			'type' => 'color',
			'title' => __('Button color', 'dfd'),
			'default' => '',
			'validate' => 'color',
			'hint' => array(
				'title' => esc_attr__('Menu button', 'dfd'),
				'content' => esc_attr__('Choose the color for the menu button', 'dfd')
			)
		),
		array(
			'id' => 'header_eighth_navbutton_bg',
			'type' => 'color',
			'title' => __('Button bar background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Button bar color', 'dfd'),
				'content' => esc_attr__('Choose the color for the button bar background', 'dfd')
			)
		),
		array(
			'id' => 'header_eighth_background_color',
			'type' => 'color',
			'title' => __('Header background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background color for the header main section', 'dfd')
			)
		),
		array(
			'id' => 'header_eighth_bg_image',
			'type' => 'media',
			'title' => __('Header background image', 'dfd'),
			'desc' => __('Upload your own background image or pattern.', 'dfd'),
			'default' => array(
				'url' => ''
			),
			'hint' => array(
				'title' => esc_attr__('Header background image', 'dfd'),
				'content' => esc_attr__('Select the image from the media library which will be set as a header background image', 'dfd')
			)
		),
		array(
			'id' => 'header_eighth_bg_img_position',
			'type' => 'select',
			'title' => __('Header background image position', 'dfd'),
			'default' => '',
			'options' => dfd_get_bgposition(),
			'hint' => array(
				'title' => esc_attr__('Background position', 'dfd'),
				'content' => esc_attr__('This option allows you to set the background image position for the header', 'dfd')
			)
		),
		array(
			'id' => 'header_eighth_text_color',
			'type' => 'color',
			'title' => __('Header text color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Text color', 'dfd'),
				'content' => esc_attr__('Choose the text color for the elements set in header', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Header style 9 options', 'dfd'),
	'subsection' => true,
	'icon' => 'crdash-panel_show',
	'fields' => array(
		array(
			'id' => 'header_ninth_sticky',
			'type' => 'button_set',
			'title' => __('Header animation', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Header animation', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the header animation on scroll', 'dfd')
			)
		),
		array(
			'id' => 'h9_top_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Top panel settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'header_ninth_top_panel',
			'type' => 'button_set',
			'title' => __('Header top panel', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Header top panel', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the header top panel where the address information, login and social icons can be set', 'dfd')
			)
		),
		array(
			'id' => 'head_ninth_enable_top_panel_wishlist_link',
			'type' => 'button_set',
			'title' => __('Wishlist button in top panel', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('header_ninth_top_panel', "=", 'on'),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Wishlist button', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the Wishlist button in header. Note, this option is available if YITH WooCommerce Wishlist plugin is installed', 'dfd')
			)
		),
		array(
			'id' => 'header_ninth_login',
			'type' => 'button_set',
			'title' => __('Login form', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array(
				'header_ninth_top_panel', "=", 'on',
			),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Login form', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the login form in the top panel', 'dfd')
			)
		),
		array(
			'id' => 'head_ninth_show_header_soc_icons',
			'type' => 'button_set',
			'title' => __('Social icons', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('header_ninth_top_panel', "=", 'on'),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Social icons', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the social icon in the top panel, the social icons can be added in Social networks section in theme options', 'dfd')
			)
		),
		array(
			'id' => 'header_ninth_soc_icons_hover_style',
			'type' => 'select',
			'title' => __('Social icons hover style', 'dfd'),
			'options' => dfd_soc_icons_hover_style(),
			'required' => array('header_ninth_top_panel', "=", 'on'),
			'default' => '26',
			'hint' => array(
				'title' => esc_attr__('Icons hover style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset hover styles for the Social networks', 'dfd')
			)
		),
		array(
			'id' => 'header_ninth_logo_align',
			'type' => 'select',
			'title' => __('Logo alignment', 'dfd'),
			'default' => '',
			'options' => array(
				'logo_left' => __('Left', 'dfd'),
				'logo_right' => __('Right', 'dfd'),
			),
			'hint' => array(
				'title' => esc_attr__('Logo alignment', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the horizontal alignment for the logotype image', 'dfd')
			)
		),
		array(
			'id' => 'header_ninth_top_panel_background_color',
			'type' => 'color',
			'title' => __('Top panel background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array('header_ninth_top_panel', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background color for the header top panel', 'dfd')
			)
		),
		array(
			'id' => 'header_ninth_top_panel_color',
			'type' => 'color',
			'title' => __('Top panel text color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array('header_ninth_top_panel', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Text color', 'dfd'),
				'content' => esc_attr__('Choose the text color for the elements set in header top panel', 'dfd')
			)
		),
		array(
			'id' => 'h9_middle_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Middle section settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'header_ninth_middle_item',
			'type' => 'select',
			'title' => __('Middle panel item', 'dfd'),
			'default' => '',
			'options' => array(
				'banner' => __('Banner', 'dfd'),
				'menu' => __('Menu', 'dfd'),
			),
			'hint' => array(
				'title' => esc_attr__('Middle panel item', 'dfd'),
				'content' => esc_attr__('Specify what element should be visible in middle panel', 'dfd')
			)
		),
		array(
			'id' => 'header_ninth_banner_image',
			'type' => 'media',
			'title' => __('Banner image', 'dfd'),
			'required' => array(
				array('header_ninth_middle_item', '=', 'banner'),
			),
			'default' => array(
				'url' => ''
			),
			'hint' => array(
				'title' => esc_attr__('Banner image', 'dfd'),
				'content' => esc_attr__('Upload the image from the media library', 'dfd')
			)
		),
		array(
			'id' => 'header_ninth_banner_url',
			'type' => 'text',
			'title' => __('Banner url', 'dfd'),
			'validate' => 'url',
			'required' => array(
				array('header_ninth_middle_item', '=', 'banner'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Banner URL', 'dfd'),
				'content' => esc_attr__('This option allows you to add the link to your banner', 'dfd')
			)
		),
		array(
			'id' => 'header_ninth_banner_height',
			'type' => 'slider',
			'title' => __('Banner height', 'dfd'),
			'min' => '20',
			'max' => '300',
			'step' => '1',
			'default' => '42',
			'required' => array(
				array('header_ninth_middle_item', '=', 'banner'),
			),
			'hint' => array(
				'title' => esc_attr__('Banner height', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the height of the banner. Max height is 300px', 'dfd')
			)
		),
		array(
			'id' => 'h9_header_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Main section settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'header_ninth_menu_align',
			'type' => 'select',
			'title' => __('Primary navigation alignment', 'dfd'),
			'default' => '',
			'options' => array(
				'' => __('Inherit from menu options', 'dfd'),
				'menu_left' => __('Left', 'dfd'),
				'menu_right' => __('Right', 'dfd'),
				'menu_center' => __('Center', 'dfd'),
			),
			'hint' => array(
				'title' => esc_attr__('Navigation alignment', 'dfd'),
				'content' => esc_attr__('Specify the horizontal alignment for the primary navigation', 'dfd')
			)
		),
		array(
			'id' => 'head_ninth_enable_buttons',
			'type' => 'button_set',
			'title' => __('Header buttons and links', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Buttons and links', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable buttons set in header', 'dfd')
			)
		),
		array(
			'id' => 'show_search_form_header_9',
			'type' => 'button_set',
			'title' => __('Search form in header', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('head_ninth_enable_buttons', "=", 1),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Search in header', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the search icon in header', 'dfd')
			)
		),
		array(
			'id' => 'header_ninth_background_color',
			'type' => 'color',
			'title' => __('Header background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background color for the header main section', 'dfd')
			)
		),
		array(
			'id' => 'header_ninth_text_color',
			'type' => 'color',
			'title' => __('Header text color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Text color', 'dfd'),
				'content' => esc_attr__('Choose the text color for the elements set in header', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Header style 10 options', 'dfd'),
	'subsection' => true,
	'icon' => 'crdash-panel_show',
	'fields' => array(
		array(
			'id' => 'header_tenth_sticky',
			'type' => 'button_set',
			'title' => __('Header animation', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Header animation', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the header animation on scroll', 'dfd')
			)
		),
		array(
			'id' => 'h10_top_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Top panel settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'header_tenth_top_panel',
			'type' => 'button_set',
			'title' => __('Header top panel', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Header top panel', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the header top panel where the address information, login and social icons can be set', 'dfd')
			)
		),
		array(
			'id' => 'header_tenth_login',
			'type' => 'button_set',
			'title' => __('Login form', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array(
				'header_tenth_top_panel', "=", 'on',
			),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Login form', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the login form in the top panel', 'dfd')
			)
		),
		array(
			'id' => 'head_tenth_enable_top_panel_wishlist_link',
			'type' => 'button_set',
			'title' => __('Wishlist button in top panel', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('header_tenth_top_panel', "=", 'on'),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Wishlist button', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the Wishlist button in header. Note, this option is available if YITH WooCommerce Wishlist plugin is installed', 'dfd')
			)
		),
		array(
			'id' => 'head_tenth_show_soc_icons',
			'type' => 'button_set',
			'title' => __('Social icons', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('header_tenth_top_panel', "=", 'on'),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Social icons', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the social icon in the top panel, the social icons can be added in Social networks section in theme options', 'dfd')
			)
		),
		array(
			'id' => 'header_tenth_logo_align',
			'type' => 'select',
			'title' => __('Logo alignment', 'dfd'),
			'default' => '',
			'options' => array(
				'logo_left' => __('Left', 'dfd'),
				'logo_right' => __('Right', 'dfd'),
			),
			'hint' => array(
				'title' => esc_attr__('Logo alignment', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the horizontal alignment for the logotype image', 'dfd')
			)
		),
		array(
			'id' => 'header_tenth_soc_icons_hover_style',
			'type' => 'select',
			'title' => __('Social icons hover style', 'dfd'),
			'options' => dfd_soc_icons_hover_style(),
			'required' => array('header_tenth_top_panel', "=", 'on'),
			'default' => '26',
			'hint' => array(
				'title' => esc_attr__('Icons hover style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset hover styles for the Social networks', 'dfd')
			)
		),
		array(
			'id' => 'header_tenth_top_panel_background_color',
			'type' => 'color',
			'title' => __('Top panel background color', 'dfd'),
			'default' => 'transparent',
			'validate' => 'color_rgba',
			'required' => array('header_tenth_top_panel', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background color for the header top panel', 'dfd')
			)
		),
		array(
			'id' => 'header_tenth_top_panel_background_opacity',
			'type' => 'slider',
			'title' => __('Top panel background opacity ', 'dfd'),
			'min' => '0',
			'max' => '100',
			'step' => '1',
			'default' => '0',
			'required' => array('header_tenth_top_panel', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Background color opacity', 'dfd'),
				'content' => esc_attr__('Choose the background color opacity for the header top panel', 'dfd')
			)
		),
		array(
			'id' => 'header_tenth_top_panel_color',
			'type' => 'color',
			'title' => __('Top panel text color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array('header_tenth_top_panel', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Text color', 'dfd'),
				'content' => esc_attr__('Choose the text color for the elements set in header top panel', 'dfd')
			)
		),
		array(
			'id' => 'h10_middle_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Middle section settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'header_tenth_middle_item',
			'type' => 'select',
			'title' => __('Middle panel item', 'dfd'),
			'default' => '',
			'options' => array(
				'banner' => __('Banner', 'dfd'),
				'menu' => __('Menu', 'dfd'),
			),
			'hint' => array(
				'title' => esc_attr__('Middle panel item', 'dfd'),
				'content' => esc_attr__('Specify what element should be visible in middle panel', 'dfd')
			)
		),
		array(
			'id' => 'header_tenth_banner_image',
			'type' => 'media',
			'title' => __('Banner image', 'dfd'),
			'required' => array(
				array('header_tenth_middle_item', '=', 'banner'),
			),
			'default' => array(
				'url' => ''
			),
			'hint' => array(
				'title' => esc_attr__('Banner image', 'dfd'),
				'content' => esc_attr__('Upload the image from the media library', 'dfd')
			)
		),
		array(
			'id' => 'header_tenth_banner_url',
			'type' => 'text',
			'title' => __('Banner url', 'dfd'),
			'validate' => 'url',
			'required' => array(
				array('header_tenth_middle_item', '=', 'banner'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Banner URL', 'dfd'),
				'content' => esc_attr__('This option allows you to add the link to your banner', 'dfd')
			)
		),
		array(
			'id' => 'header_tenth_banner_height',
			'type' => 'slider',
			'title' => __('Banner height', 'dfd'),
			'min' => '20',
			'max' => '300',
			'step' => '1',
			'default' => '42',
			'required' => array(
				array('header_tenth_middle_item', '=', 'banner'),
			),
			'hint' => array(
				'title' => esc_attr__('Banner height', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the height of the banner. Max height is 300px', 'dfd')
			)
		),
		array(
			'id' => 'h10_header_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Main section settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'header_tenth_menu_align',
			'type' => 'select',
			'title' => __('Primary navigation alignment', 'dfd'),
			'default' => '',
			'options' => array(
				'' => __('Inherit from menu options', 'dfd'),
				'menu_left' => __('Left', 'dfd'),
				'menu_right' => __('Right', 'dfd'),
				'menu_center' => __('Center', 'dfd'),
			),
			'hint' => array(
				'title' => esc_attr__('Navigation alignment', 'dfd'),
				'content' => esc_attr__('Specify the horizontal alignment for the primary navigation', 'dfd')
			)
		),
		array(
			'id' => 'head_tenth_enable_buttons',
			'type' => 'button_set',
			'title' => __('Header buttons and links', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Buttons and links', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable buttons set in header', 'dfd')
			)
		),
		array(
			'id' => 'show_search_form_header_10',
			'type' => 'button_set',
			'title' => __('Search form in header', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('head_tenth_enable_buttons', "=", 1),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Search in header', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the search icon in header', 'dfd')
			)
		),
		array(
			'id' => 'header_tenth_background_color',
			'type' => 'color',
			'title' => __('Header background color', 'dfd'),
			'default' => 'transparent',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background color for the header main section', 'dfd')
			)
		),
		array(
			'id' => 'header_tenth_background_opacity',
			'type' => 'slider',
			'title' => __('Header background opacity ', 'dfd'),
			'min' => '0',
			'max' => '100',
			'step' => '1',
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Background color opacity', 'dfd'),
				'content' => esc_attr__('Choose the background color opacity for the header main section', 'dfd')
			)
		),
		array(
			'id' => 'header_tenth_text_color',
			'type' => 'color',
			'title' => __('Header text color', 'dfd'),
			'default' => '#ffffff',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Text color', 'dfd'),
				'content' => esc_attr__('Choose the text color for the elements set in header', 'dfd')
			)
		),
		array(
			'id' => 'stun_header_title_align_header_10',
			'type' => 'button_set',
			'title' => __('Center align stunning header title from the bottom of the menu', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Align stunning header', 'dfd'),
				'content' => esc_attr__('This option allows you to add extra space beneath the header and the Stunning header shifts down for the header height', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Header style 11 options', 'dfd'),
	'subsection' => true,
	'icon' => 'crdash-panel_show',
	'fields' => array(
		array(
			'id' => 'h11_header_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Main content settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'header_eleventh_copyright',
			'type' => 'text',
			'title' => __('Copyright message', 'dfd'),
			'desc' => __('Please enter the copyright message here.', 'dfd'),
			'sub_desc' => __('Please do not use single quote here', 'dfd'),
			'validate' => 'html',
			'default' => '<a href="http://rnbtheme.com" title="DFD">© DynamicFrameworks</a>- Elite ThemeForest Author.',
			'hint' => array(
				'title' => esc_attr__('Copyright', 'dfd'),
				'content' => esc_attr__('Add the copyright message which will be visible in header', 'dfd')
			)
		),
		array(
			'id' => 'header_eleventh_login',
			'type' => 'button_set',
			'title' => __('Login form', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Login form', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the login form in the header', 'dfd')
			)
		),
		array(
			'id' => 'head_eleventh_show_header_soc_icons',
			'type' => 'button_set',
			'title' => __('Social icons', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Social icons', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the social icon in the top panel, the social icons can be added in Social networks section in header', 'dfd')
			)
		),
		array(
			'id' => 'header_eleventh_soc_icons_hover_style',
			'type' => 'select',
			'title' => __('Social icons hover style', 'dfd'),
			'options' => dfd_soc_icons_hover_style(),
			'default' => '26',
			'hint' => array(
				'title' => esc_attr__('Icons hover style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset hover styles for the Social networks', 'dfd')
			)
		),
		array(
			'id' => 'show_search_form_header_11',
			'type' => 'button_set',
			'title' => __('Search form in header', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Search in header', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the search icon in header', 'dfd')
			)
		),
		array(
			'id' => 'h11_styling_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Header styling options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'header_eleventh_alignment',
			'type' => 'select',
			'title' => __('Header alignment', 'dfd'),
			'options' => array(
				'left' => __('Left', 'dfd'),
				'right' => __('Right', 'dfd'),
			),
			'default' => 'left',
			'hint' => array(
				'title' => esc_attr__('Header alignment', 'dfd'),
				'content' => esc_attr__('Choose the position of the header according to the content', 'dfd')
			)
		),
		array(
			'id' => 'header_eleventh_background_color',
			'type' => 'color',
			'title' => __('Header background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background color for the header main section', 'dfd')
			)
		),
		array(
			'id' => 'header_eleventh_bg_image',
			'type' => 'media',
			'title' => __('Header background image', 'dfd'),
			'desc' => __('Upload your own background image or pattern.', 'dfd'),
			'default' => array(
				'url' => ''
			),
			'hint' => array(
				'title' => esc_attr__('Header background image', 'dfd'),
				'content' => esc_attr__('Select the image from the media library which will be set as a header background image', 'dfd')
			)
		),
		array(
			'id' => 'header_eleventh_bg_img_position',
			'type' => 'select',
			'title' => __('Header background image position', 'dfd'),
			'default' => '',
			'options' => dfd_get_bgposition(),
			'hint' => array(
				'title' => esc_attr__('Background position', 'dfd'),
				'content' => esc_attr__('This option allows you to set the background image position for the header', 'dfd')
			)
		),
		array(
			'id' => 'header_eleventh_text_color',
			'type' => 'color',
			'title' => __('Header text color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Text color', 'dfd'),
				'content' => esc_attr__('Choose the text color for the elements set in header', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Header style 12 options', 'dfd'),
	'subsection' => true,
	'icon' => 'crdash-panel_show',
	'fields' => array(
		array(
			'id' => 'header_twelfth_sticky',
			'type' => 'button_set',
			'title' => __('Header animation', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Header animation', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the header animation on scroll', 'dfd')
			)
		),
		array(
			'id' => 'header_twelfth_menu_align',
			'type' => 'select',
			'title' => __('Primary navigation alignment', 'dfd'),
			'default' => '',
			'options' => array(
				'' => __('Inherit from menu options', 'dfd'),
				'menu_left' => __('Left', 'dfd'),
				'menu_right' => __('Right', 'dfd'),
				'menu_center' => __('Center', 'dfd'),
			),
			'hint' => array(
				'title' => esc_attr__('Navigation alignment', 'dfd'),
				'content' => esc_attr__('Specify the horizontal alignment for the primary navigation', 'dfd')
			)
		),
		array(
			'id' => 'head_twelfth_enable_buttons',
			'type' => 'button_set',
			'title' => __('Header buttons and links', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Buttons and links', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable buttons set in header', 'dfd')
			)
		),
		array(
			'id' => 'show_search_form_header_12',
			'type' => 'button_set',
			'title' => __('Search form in header', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('head_twelfth_enable_buttons', "=", 1),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Search in header', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the search icon in header', 'dfd')
			)
		),
		array(
			'id' => 'header_twelfth_background_color',
			'type' => 'color',
			'title' => __('Header background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background color for the header main section', 'dfd')
			)
		),
		array(
			'id' => 'header_twelfth_text_color',
			'type' => 'color',
			'title' => __('Header text color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Text color', 'dfd'),
				'content' => esc_attr__('Choose the text color for the elements set in header', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Header style 13 options', 'dfd'),
	'subsection' => true,
	'icon' => 'crdash-panel_show',
	'fields' => array(
		array(
			'id' => 'header_thirteenth_sticky',
			'type' => 'button_set',
			'title' => __('Header animation', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Header animation', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the header animation on scroll', 'dfd')
			)
		),
		array(
			'id' => 'header_thirteenth_menu_align',
			'type' => 'select',
			'title' => __('Primary navigation alignment', 'dfd'),
			'default' => '',
			'options' => array(
				'' => __('Inherit from menu options', 'dfd'),
				'menu_left' => __('Left', 'dfd'),
				'menu_right' => __('Right', 'dfd'),
				'menu_center' => __('Center', 'dfd'),
			),
			'hint' => array(
				'title' => esc_attr__('Navigation alignment', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the horizontal alignment for the primary navigation', 'dfd')
			)
		),
		array(
			'id' => 'head_thirteenth_enable_buttons',
			'type' => 'button_set',
			'title' => __('Header buttons and links', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Buttons and links', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable buttons set in header', 'dfd')
			)
		),
		array(
			'id' => 'show_search_form_header_13',
			'type' => 'button_set',
			'title' => __('Search form in header', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('head_thirteenth_enable_buttons', "=", 1),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Search in header', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the search icon in header', 'dfd')
			)
		),
		array(
			'id' => 'header_thirteenth_background_color',
			'type' => 'color',
			'title' => __('Header background color', 'dfd'),
			'default' => 'transparent',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background color for the header main section', 'dfd')
			)
		),
		array(
			'id' => 'header_thirteenth_background_opacity',
			'type' => 'slider',
			'title' => __('Header background opacity ', 'dfd'),
			'min' => '0',
			'max' => '100',
			'step' => '1',
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Background color opacity', 'dfd'),
				'content' => esc_attr__('Choose the background color opacity for the header main section', 'dfd')
			)
		),
		array(
			'id' => 'header_thirteenth_text_color',
			'type' => 'color',
			'title' => __('Header text color', 'dfd'),
			'default' => '#ffffff',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Text color', 'dfd'),
				'content' => esc_attr__('Choose the text color for the elements set in header', 'dfd')
			)
		),
		array(
			'id' => 'stun_header_title_align_header_13',
			'type' => 'button_set',
			'title' => __('Center align stunning header title from the bottom of the menu', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Align stunning header', 'dfd'),
				'content' => esc_attr__('This option allows you to add extra space beneath the header and the Stunning header shifts down for the header height', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Header style 14 options', 'dfd'),
	'subsection' => true,
	'icon' => 'crdash-panel_show',
	'fields' => array(
		array(
			'id' => 'header_fourteenth_sticky',
			'type' => 'button_set',
			'title' => __('Header animation', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Header animation', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the header animation on scroll', 'dfd')
			)
		),
		array(
			'id' => 'header_fourteenth_appear_effect',
			'type' => 'select',
			'title' => __('Header appear effect', 'dfd'),
			'options' => dfd_header_seventh_appear_effects(),
			'default' => 'default',
			'hint' => array(
				'title' => esc_attr__('Header appear effect', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the appear animation for the header', 'dfd')
			)
		),
		array(
			'id' => 'h14_header_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Main content settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'header_fourteenth_copyright',
			'type' => 'text',
			'title' => __('Copyright message', 'dfd'),
			'sub_desc' => __('Please do not use single quote here', 'dfd'),
			'validate' => 'html',
			'default' => '<a href="http://rnbtheme.com" title="DFD">© DynamicFrameworks</a>- Elite ThemeForest Author.',
			'hint' => array(
				'title' => esc_attr__('Copyright', 'dfd'),
				'content' => esc_attr__('Add the copyright message which will be visible in opened (active) header', 'dfd')
			)
		),
		array(
			'id' => 'header_fourteenth_login',
			'type' => 'button_set',
			'title' => __('Login form', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Login form', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the login form in the header', 'dfd')
			)
		),
		array(
			'id' => 'head_fourteenth_show_soc_icons',
			'type' => 'button_set',
			'title' => __('Social icons', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Social icons', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the social icon in the header, the social icons can be added in Social networks section in theme options', 'dfd')
			)
		),
		array(
			'id' => 'header_fourteenth_soc_icons_hover_style',
			'type' => 'select',
			'title' => __('Social icons hover style', 'dfd'),
			'options' => dfd_soc_icons_hover_style(),
			'default' => '26',
			'hint' => array(
				'title' => esc_attr__('Icons hover style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset hover styles for the Social networks', 'dfd')
			)
		),
		array(
			'id' => 'show_search_form_header_14',
			'type' => 'button_set',
			'title' => __('Search form in header', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Search in header', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the search icon in header', 'dfd')
			)
		),
		array(
			'id' => 'h14_styling_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Header styling options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'header_fourteenth_content_alignment',
			'type' => 'select',
			'title' => __('Header content alignment', 'dfd'),
			'options' => dfd_alignment_options(),
			'default' => 'text-left',
			'hint' => array(
				'title' => esc_attr__('Header content alignment', 'dfd'),
				'content' => esc_attr__('This option allows you to choose horizontal alignment for the header content', 'dfd')
			)
		),
		array(
			'id' => 'header_fourteenth_background_color',
			'type' => 'color',
			'title' => __('Header background color', 'dfd'),
			'default' => '#000000',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background color for the header main section', 'dfd')
			)
		),
		array(
			'id' => 'header_fourteenth_background_opacity',
			'type' => 'slider',
			'title' => __('Header background opacity ', 'dfd'),
			'min' => '0',
			'max' => '100',
			'step' => '1',
			'default' => '90',
			'hint' => array(
				'title' => esc_attr__('Background color opacity', 'dfd'),
				'content' => esc_attr__('Choose the background color opacity for the header main section', 'dfd')
			)
		),
		array(
			'id' => 'header_fourteenth_text_color_active',
			'type' => 'color',
			'title' => __('Active header text color', 'dfd'),
			'default' => '#ffffff',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Active header text color', 'dfd'),
				'content' => esc_attr__('Choose the text color for the opened(active) header', 'dfd')
			)
		),
		array(
			'id' => 'header_fourteenth_text_color',
			'type' => 'color',
			'title' => __('Menu button color', 'dfd'),
			'default' => '#ffffff',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Menu button color', 'dfd'),
				'content' => esc_attr__('Choose the color for the menu button', 'dfd')
			)
		),
		array(
			'id' => 'stun_header_title_align_header_14',
			'type' => 'button_set',
			'title' => __('Center align stunning header title from the bottom of the menu', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Align stunning header', 'dfd'),
				'content' => esc_attr__('This option allows you to add extra space beneath the header and the Stunning header shifts down for the header height', 'dfd')
			)
		),
	),
));
$_mobile_header_options_fields = array();
$_mobile_header_options_fields[] = array(
	'id' => 'header_responsive_breakpoint',
	'type' => 'slider',
	'title' => __('Header responsive breakpoint', 'dfd'),
	'min' => '768',
	'max' => '1280',
	'step' => '1',
	'default' => '1101',
	'hint' => array(
		'title' => esc_attr__('Breakpoint', 'dfd'),
		'content' => esc_attr__('This option allows you to specify the width of the screen from which the mobile header should appear', 'dfd')
	),
);
$_mobile_header_options_fields[] = array(
	'id' => 'mobile_header_bg',
	'type' => 'color',
	'title' => __('Header background color', 'dfd'),
	'default' => '',
	'validate' => 'color_rgba',
	'hint' => array(
		'title' => esc_attr__('Background color', 'dfd'),
		'content' => esc_attr__('Choose the background color for the mobile header', 'dfd')
	)
);
$_mobile_header_options_fields[] = array(
	'id' => 'mobile_header_color',
	'type' => 'color',
	'title' => __('Header elements color', 'dfd'),
	'default' => '',
	'validate' => 'color_rgba',
	'hint' => array(
		'title' => esc_attr__('Elements color', 'dfd'),
		'content' => esc_attr__('Choose the text color for the elements set in mobile header', 'dfd')
	)
);
$_mobile_header_options_fields[] = array(
	'id' => 'mobile_menu_bg',
	'type' => 'color',
	'title' => __('Menu background color', 'dfd'),
	'default' => '',
	'validate' => 'color_rgba',
	'hint' => array(
		'title' => esc_attr__('Opened menu background', 'dfd'),
		'content' => esc_attr__('Choose the background color for the opened(active) mobile header', 'dfd')
	)
);
$_mobile_header_options_fields[] = array(
	'id' => 'mobile_menu_color',
	'type' => 'color',
	'title' => __('Menu color', 'dfd'),
	'default' => '',
	'validate' => 'color_rgba',
	'hint' => array(
		'title' => esc_attr__('Menu color', 'dfd'),
		'content' => esc_attr__('Specify the color for the mobile menu items', 'dfd')
	)
);
$_mobile_header_options_fields[] = array(
	'id' => 'mobile_menu_color_opacity',
	'type' => 'slider',
	'title' => __('Menu items opacity', 'dfd'),
	'min' => '0',
	'max' => '100',
	'step' => '1',
	'default' => '50',
	'hint' => array(
		'title' => esc_attr__('Menu opacity', 'dfd'),
		'content' => esc_attr__('Specify the opacity color for the mobile menu items', 'dfd')
	)
);
$_mobile_header_options_fields[] = array(
	'id' => 'search_form_mobile_header',
	'type' => 'button_set',
	'title' => __('Search in mobile header', 'dfd'),
	'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
	'default' => '1',
	'hint' => array(
		'title' => esc_attr__('Search in header', 'dfd'),
		'content' => esc_attr__('This option allows you to enable or disable the search in opened(active) mobile header', 'dfd')
	)
);
$_mobile_header_options_fields[] = array(
	'id' => 'text_mobile_header',
	'type' => 'textarea',
	'title' => __('Text in mobile header', 'dfd'),
	'validate' => 'html',
	'default' => '',
	'hint' => array(
		'title' => esc_attr__('Text in header', 'dfd'),
		'content' => esc_attr__('This option allows you to custom text to opened(active) mobile header', 'dfd')
	)
);
Redux::setSection($opt_name, array(
	'title' => __('Mobile header options', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'icon' => 'crdash-ipad',
	'subsection' => true,
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => $_mobile_header_options_fields,
));
$_side_area_options_fields = array();
/* $_side_area_default_font_family = array(
  1 => 'texgyreadventorregular',//menu titles
  2 => 'Raleway',//menu dropdowns
  3 => 'Droid Serif',//menu dropdown subtitles
  );
  $_side_area_default_font_size = array(
  1 => '11px',//menu titles
  2 => '12px',//menu dropdowns
  3 => '11px',//menu dropdown subtitles
  );
  $_side_area_default_line_height_increment = array(
  1 => 1.6,//menu titles
  2 => 1.57,//menu dropdowns
  3 => 1,//menu dropdown subtitles
  );
  $_side_area_default_font_weight = array(
  1 => '600',//menu titles
  2 => '400',//menu dropdowns
  3 => '400',//menu dropdown subtitles
  );
  $_side_area_default_font_style = array(
  1 => 'normal',//menu titles
  2 => 'normal',//menu dropdowns
  3 => 'italic',//menu dropdown subtitles
  );
  $_side_area_default_text_transform = array(
  1 => 'uppercase',//menu titles
  2 => 'none',//menu dropdowns
  3 => 'none',//menu dropdown subtitles
  );
  $_side_area_default_word_spacing = array(
  1 => '0px',//menu titles
  2 => '0px',//menu dropdowns
  3 => '0px',//menu dropdown subtitles
  );
  $_side_area_default_letter_spacing = array(
  1 => '0px',//menu titles
  2 => '0px',//menu dropdowns
  3 => '0px',//menu dropdown subtitles
  );
  $_side_area_default_option_name = array(
  1 => 'side_area_menu_titles',//menu titles
  2 => 'side_area_menu_dropdowns',//menu dropdowns
  3 => 'side_area_menu_dropdown_subtitles',//menu dropdown subtitles
  );
  $_side_area_default_color = array(
  1 => '',//menu titles
  2 => '',//menu dropdowns
  3 => '',//menu dropdown subtitles
  );
  $_side_area_default_option_title = array(
  1 => 'Side Area Menu titles',//menu titles
  2 => 'Side Area Menu dropdowns',//menu dropdowns
  3 => 'Side Area Menu dropdown subtitles',//menu dropdown subtitles
  );

  for ($i=1; $i<=3; $i++) {
  $_side_area_options_fields[] = array(
  'id'          => $_side_area_default_option_name[$i].'_typography_option',
  'type'        => 'typography',
  'title'       => __( $_side_area_default_option_title[$i].' Typography', 'redux-framework-demo' ),
  //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
  'google'      => true,
  // Disable google fonts. Won't work if you haven't defined your google api key
  //'font-backup' => true,
  // Select a backup non-google font in addition to a google font
  'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
  'subsets'       => true, // Only appears if google is true and subsets not set to false
  'font-size'     => true,
  'text-align'	=> false,
  'line-height'   => true,
  'word-spacing'  => false,  // Defaults to false
  'letter-spacing'=> true,  // Defaults to false
  'text-transform'=> true,
  'color'         => true,
  'preview'       => false, // Disable the previewer
  'all_styles'  => true,
  // Enable all Google Font style/weight variations to be added to the page
  //'output'      => array( 'h2.site-description, .entry-title' ),
  // An array of CSS selectors to apply this font style to dynamically
  //'compiler'    => array( 'h2.site-description-compiler' ),
  // An array of CSS selectors to apply this font style to dynamically
  'units'       => 'px',
  // Defaults to px
  'subtitle'    => __( 'Typography option with each property can be called individually.', 'redux-framework-demo' ),
  'default'     => array(
  'font-style'  => $_side_area_default_font_style[$i],
  'font-weight'  => $_side_area_default_font_weight[$i],
  'font-family' => $_side_area_default_font_family[$i],
  'google'      => true,
  'font-size'   => $_side_area_default_font_size[$i],
  'line-height' => $_side_area_default_font_size[$i] * $_side_area_default_line_height_increment[$i].'px',
  'text-transform'=> $_side_area_default_text_transform[$i],
  //'word-spacing'  => $_side_area_default_word_spacing[$i],
  'letter-spacing'=> $_side_area_default_letter_spacing[$i],
  'color'	=> $_side_area_default_color[$i],
  ),
  );
  } */
/*
  $_side_area_options_fields[] = array(
  'id' => 'side_area_search',
  'type' => 'button_set',
  'title' => __('Enable Side Area Search', 'dfd'),
  'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
  'default' => '1'
  );
  $_side_area_options_fields[] = array(
  'id' => 'side_area_cart',
  'type' => 'button_set',
  'title' => __('Enable Side Area Cart', 'dfd'),
  'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
  'default' => '1'
  );
 */
$_side_area_options_fields[] = array(
	'id' => 'side_area_enable',
	'type' => 'button_set',
	'title' => __('Side area by default', 'dfd'),
	'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
	'default' => 'on',
	'hint' => array(
		'title' => esc_attr__('Side area', 'dfd'),
		'content' => esc_attr__('This option allows you to enable or disable the side area by default. There is also an option on the item\'s page if you need to enable or disable the sidearea on the single page', 'dfd')
	)
);
$_side_area_options_fields[] = array(
	'id' => 'side_area_widget',
	'type' => 'button_set',
	'title' => __('Widgetised Side area', 'dfd'),
	'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
	'default' => 'off',
	'hint' => array(
		'title' => esc_attr__('Widgetised Side area', 'dfd'),
		'content' => esc_attr__('This option allows you to enable or disable the widgetized Side area. The widgets can be set in Appearance > Widgets > Side area', 'dfd')
	)
);
$_side_area_options_fields[] = array(
	'id' => 'side_area_alignment',
	'type' => 'select',
	'title' => __('Elements alignment', 'dfd'),
	'options' => dfd_alignment_options(),
	'required' => array('side_area_widget', "=", 'off'),
	'default' => 'text-left',
	'hint' => array(
		'title' => esc_attr__('Elements alignment', 'dfd'),
		'content' => esc_attr__('Specify the alignment of the elements set in Side area', 'dfd')
	)
);
$_side_area_options_fields[] = array(
	'id' => 'side_area_soc_icons',
	'type' => 'button_set',
	'title' => __('Social icons', 'dfd'),
	'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
	'required' => array('side_area_widget', "=", 'off'),
	'default' => '1',
	'hint' => array(
		'title' => esc_attr__('Social icons', 'dfd'),
		'content' => esc_attr__('This option allows you to show or hide the social icons in Side area', 'dfd')
	)
);
$_side_area_options_fields[] = array(
	'id' => 'side_area_soc_icons_hover_style',
	'type' => 'select',
	'title' => __('Social icons hover style', 'dfd'),
	'options' => dfd_soc_icons_hover_style(),
	'required' => array('side_area_widget', "=", 'off'),
	'default' => '4',
	'hint' => array(
		'title' => esc_attr__('Social icons hover', 'dfd'),
		'content' => esc_attr__('This option allows you to specify the hover style for the social icons in Side area', 'dfd')
	)
);
$_side_area_options_fields[] = array(
	'id' => 'side_area_copyright',
	'type' => 'textarea',
	'title' => __('Copyright message', 'dfd'),
	'validate' => 'html',
	'default' => '<a href="dfd.name" title="DFD">© DynamicFrameworks</a>- Elite ThemeForest Author.',
	'required' => array('side_area_widget', "=", 'off'),
	'hint' => array(
		'title' => esc_attr__('Copyright', 'dfd'),
		'content' => esc_attr__('Add the copyright message which will be visible in Side area', 'dfd')
	)
);
/*
  $_side_area_options_fields[] = array(
  'id' => 'side_area_width',
  'type' => 'slider',
  'title' => __('Side area width', 'dfd'),
  'min' => '10',
  'max' => '100',
  'step' => '1',
  'default' => '50',
  );
 */
$_side_area_options_fields[] = array(
	'id' => 'side_area_bg_color',
	'type' => 'color',
	'validate' => 'color_rgba',
	'title' => __('Background Color', 'dfd'),
	'default' => '#ffffff',
	'hint' => array(
		'title' => esc_attr__('Background color', 'dfd'),
		'content' => esc_attr__('This option allows you to set the background color for the side area', 'dfd')
	),
);
$_side_area_options_fields[] = array(
	'id' => 'side_area_bg_image',
	'type' => 'media',
	'title' => __('Background image', 'dfd'),
	'default' => array(
		'url' => '',
	),
	'hint' => array(
		'title' => esc_attr__('Background image', 'dfd'),
		'content' => esc_attr__('Upload the custom image from the media library for the side area background', 'dfd')
	),
);
$_side_area_options_fields[] = array(
	'id' => 'side_area_bg_position',
	'type' => 'select',
	'title' => __('Background position', 'dfd'),
	'options' => dfd_get_bgposition(),
	'default' => '',
	'hint' => array(
		'title' => esc_attr__('Background position', 'dfd'),
		'content' => esc_attr__('This option allows you to choose the position for the background image', 'dfd')
	),
);
$_side_area_options_fields[] = array(
	'id' => 'side_area_bg_repeat',
	'type' => 'select',
	'title' => __('Background repeat', 'dfd'),
	'options' => array('no-repeat' => 'no-repeat', 'repeat-y' => 'vertically', 'repeat-x' => 'horizontally', 'repeat' => 'both vertically and horizontally',),
	'default' => 'no-repeat',
	'hint' => array(
		'title' => esc_attr__('Background repeat', 'dfd'),
		'content' => esc_attr__('This option allows you to choose the repeat for the background image', 'dfd')
	),
);
$_side_area_options_fields[] = array(
	'id' => 'side_area_bg_dark',
	'type' => 'button_set',
	'title' => __('Dark background', 'dfd'),
	'options' => array('1' => __('Yes', 'dfd'), '0' => __('No', 'dfd')),
	'default' => '0',
	'hint' => array(
		'title' => esc_attr__('Dark background', 'dfd'),
		'content' => esc_attr__('Enable this option if you\'ve set dark background color. The text color will be changed to make the text more readable', 'dfd')
	),
);
Redux::setSection($opt_name, array(
	'title' => __('Side area options', 'dfd'),
	//'desc' => __('<p class="description">Side area and fixed left and right aligned headers options</p>', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'icon' => 'crdash-layout_alt2',
	'subsection' => true,
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => $_side_area_options_fields
));
/*
 */
$_menu_options_fields = array();
$_menu_default_font_family = array(
	1 => 'texgyreadventorregular', //menu titles
	2 => 'Raleway', //menu dropdowns
	3 => 'Droid Serif', //menu dropdown subtitles
);
$_menu_default_font_size = array(
	1 => '11px', //menu titles
	2 => '13px', //menu dropdowns
	3 => '11px', //menu dropdown subtitles
);
$_menu_default_line_height_increment = array(
	1 => 1.6, //menu titles
	2 => 2, //menu dropdowns
	3 => 1, //menu dropdown subtitles
);
$_menu_default_font_weight = array(
	1 => '600', //menu titles
	2 => '600', //menu dropdowns
	3 => '400', //menu dropdown subtitles
);
$_menu_default_font_style = array(
	1 => 'normal', //menu titles
	2 => 'normal', //menu dropdowns
	3 => 'italic', //menu dropdown subtitles
);
$_menu_default_text_transform = array(
	1 => 'uppercase', //menu titles
	2 => 'none', //menu dropdowns
	3 => 'none', //menu dropdown subtitles
);
/* $_menu_default_word_spacing = array(
  1 => '0px',//menu titles
  2 => '0px',//menu dropdowns
  3 => '0px',//menu dropdown subtitles
  ); */
$_menu_default_letter_spacing = array(
	1 => '2px', //menu titles
	2 => '0px', //menu dropdowns
	3 => '0px', //menu dropdown subtitles
);
$_menu_default_option_name = array(
	1 => 'menu_titles', //menu titles
	2 => 'menu_dropdowns', //menu dropdowns
	3 => 'menu_dropdown_subtitles', //menu dropdown subtitles
);
$_menu_default_color = array(
	1 => '#28262b', //menu titles
	2 => '#ffffff', //menu dropdowns
	3 => '#bbbbbb', //menu dropdown subtitles
);
$_menu_default_option_title = array(
	1 => 'Menu titles', //menu titles
	2 => 'Menu dropdowns', //menu dropdowns
	3 => 'Menu dropdown subtitles', //menu dropdown subtitles
);

$_menu_options_fields[] = array(
	'id' => 'menu_typography',
	'type' => 'info',
	'desc' => '<h3 class="description">' . esc_html__('Typography settings', 'dfd') . '</h3>'
);
for ($i = 1; $i <= 3; $i++) {
	$_menu_options_fields[] = array(
		'id' => $_menu_default_option_name[$i] . '_typography_option',
		'type' => 'typography',
		'title' => __($_menu_default_option_title[$i] . ' Typography', 'redux-framework-demo'),
		//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
		'google' => true,
		// Disable google fonts. Won't work if you haven't defined your google api key
		//'font-backup' => true,
		// Select a backup non-google font in addition to a google font
		'font-style' => true, // Includes font-style and weight. Can use font-style or font-weight to declare
		'subsets' => true, // Only appears if google is true and subsets not set to false
		'font-size' => true,
		'text-align' => false,
		'line-height' => true,
		'word-spacing' => false, // Defaults to false
		'letter-spacing' => true, // Defaults to false
		'text-transform' => true,
		'color' => true,
		'preview' => false, // Disable the previewer
		'all_styles' => true,
		// Enable all Google Font style/weight variations to be added to the page
		//'output'      => array( 'h2.site-description, .entry-title' ),
		// An array of CSS selectors to apply this font style to dynamically
		//'compiler'    => array( 'h2.site-description-compiler' ),
		// An array of CSS selectors to apply this font style to dynamically
		'units' => 'px',
		// Defaults to px
		'subtitle' => __('Typography option with each property can be called individually.', 'redux-framework-demo'),
		'default' => array(
			'font-style' => $_menu_default_font_style[$i],
			'font-weight' => $_menu_default_font_weight[$i],
			'font-family' => $_menu_default_font_family[$i],
			'google' => true,
			'font-size' => $_menu_default_font_size[$i],
			'line-height' => (float) $_menu_default_font_size[$i] * $_menu_default_line_height_increment[$i] . 'px',
			'text-transform' => $_menu_default_text_transform[$i],
			//'word-spacing'  => $_menu_default_word_spacing[$i],
			'letter-spacing' => $_menu_default_letter_spacing[$i],
			'color' => $_menu_default_color[$i],
		),
	);
}

$_menu_options_fields[] = array(
	'id' => 'menu_styling',
	'type' => 'info',
	'desc' => '<h3 class="description">' . esc_html__('Menu styling settings', 'dfd') . '</h3>'
);
$_menu_options_fields[] = array(
	'id' => 'menu_dropdowns_opacity',
	'type' => 'slider',
	'title' => __('Menu dropdown items text opacity', 'dfd'),
	'min' => '0',
	'max' => '100',
	'step' => '1',
	'default' => '60',
	'hint' => array(
		'title' => esc_attr__('Dropdown items text opacity', 'dfd'),
		'content' => esc_attr__('This option allows you to specify the opacity for the menu items placed in dropdown', 'dfd')
	),
);
$_menu_options_fields[] = array(
	'id' => 'menu_dropdown_hover_color',
	'type' => 'color',
	'title' => __('Menu dropdown text hover color', 'dfd'),
	'default' => '#8a8f6a',
	'validate' => 'color_rgba',
	'hint' => array(
		'title' => esc_attr__('Dropdown hover color', 'dfd'),
		'content' => esc_attr__('This option allows you to specify the text hover color for the dropdown', 'dfd')
	),
);
$_menu_options_fields[] = array(
	'id' => 'menu_dropdown_background',
	'type' => 'color',
	'title' => __('Menu dropdown background color', 'dfd'),
	'default' => '#1b1b1b',
	'validate' => 'color_rgba',
	'hint' => array(
		'title' => esc_attr__('Dropdown background color', 'dfd'),
		'content' => esc_attr__('This option allows you to specify the background color for the dropdown', 'dfd')
	),
);
$_menu_options_fields[] = array(
	'id' => 'menu_dropdown_background_opacity',
	'type' => 'slider',
	'title' => __('Menu dropdown background opacity', 'dfd'),
	'min' => '0',
	'max' => '100',
	'step' => '1',
	'default' => '100',
	'hint' => array(
		'title' => esc_attr__('Dropdown background opacity', 'dfd'),
		'content' => esc_attr__('This option allows you to specify the background opacity for the dropdown', 'dfd')
	),
);
$_menu_options_fields[] = array(
	'id' => 'menu_dropdown_hover_bg',
	'type' => 'color',
	'title' => __('Menu dropdown hover background color (header styles 1 - 4 only)', 'dfd'),
	'default' => 'transparent',
	'validate' => 'color_rgba',
	'hint' => array(
		'title' => esc_attr__('Dropdown hover background color', 'dfd'),
		'content' => esc_attr__('This option allows you to specify the hover background color for the dropdown', 'dfd')
	),
);
$_menu_options_fields[] = array(
	'id' => 'menu_dropdown_hover_bg_opacity',
	'type' => 'slider',
	'title' => __('Menu dropdown hover background opacity', 'dfd'),
	'min' => '0',
	'max' => '100',
	'step' => '1',
	'default' => '',
	'hint' => array(
		'title' => esc_attr__('Dropdown hover background opacity', 'dfd'),
		'content' => esc_attr__('This option allows you to specify the hover background opacity for the dropdown', 'dfd')
	),
);
$_menu_options_fields[] = array(
	'id' => 'menu_alignment',
	'type' => 'select',
	'title' => __('Primary navigation alignment', 'dfd'),
	'options' => dfd_alignment_options(),
	'default' => 'text-right',
	'hint' => array(
		'title' => esc_attr__('Navigation alignment', 'dfd'),
		'content' => esc_attr__('This option allows you to specify the hover background opacity for the dropdown', 'dfd')
	),
);
$_menu_options_fields[] = array(
	'id' => 'enable_menu_titles_delimiter',
	'type' => 'button_set',
	'title' => __('Menu titles delimiter', 'dfd'),
	'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
	'required' => array('extra_header_options', "=", 'off'),
	'default' => 'on',
	'hint' => array(
		'title' => esc_attr__('Titles delimiter', 'dfd'),
		'content' => esc_attr__('This option allows you to enable or disable the delimiter between the menu items', 'dfd')
	),
);
$_menu_options_fields[] = array(
	'id' => 'enable_menu_line_animated',
	'type' => 'button_set',
	'title' => __('Menu line animated', 'dfd'),
	'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
	'required' => array('extra_header_options', "=", 'off'),
	'default' => 'on',
	'hint' => array(
		'title' => esc_attr__('Animated line', 'dfd'),
		'content' => esc_attr__('This option allows you to enable or disable the animated line for the menu items on hover', 'dfd')
	),
);
$_menu_options_fields[] = array(
	'id' => 'highlight_has_submenu',
	'type' => 'button_set',
	'title' => __('Highlight menu item title if it has submenu', 'dfd'),
	'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
	'required' => array('extra_header_options', "=", 'on'),
	'default' => 'off',
	'hint' => array(
		'title' => esc_attr__('Highlight menu item', 'dfd'),
		'content' => esc_attr__('This option allows you to display 3 dots near the menu item title if the meny item has subitems', 'dfd')
	),
);
$_menu_options_fields[] = array(
	'id' => 'menu_first_level_hover_color',
	'type' => 'color',
	'title' => __('Menu first level hover color (header style 7 only)', 'dfd'),
	'validate' => 'color_rgba',
	'hint' => array(
		'title' => esc_attr__('First level hover color', 'dfd'),
		'content' => esc_attr__('This option allows you to specify hover color for the first level menu items', 'dfd')
	),
);
Redux::setSection($opt_name, array(
	'title' => __('Menu options', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'icon' => 'crdash-indent',
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => $_menu_options_fields,
));
Redux::setSection($opt_name, array(
	'title' => __('Footer section options', 'dfd'),
	//'desc' => __('<p class="description">Footer section options</p>', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'icon' => 'crdash-panel_close',
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'foot_settings',
			'type' => 'info',
			'desc' => '<h3 class="description">' . __('Footer main options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'footer_variant',
			'type' => 'select',
			'title' => __('Footer variants', 'dfd'),
			'options' => dfd_footer_values(),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Footer variants', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the variant for your footer', 'dfd')
			)
		),
		array(
			'id' => 'enable_footer_logo',
			'type' => 'button_set',
			'title' => __('Footer logotype', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('footer_variant', "=", '1'),
			'default' => '1', // 1 = on | 0 = off
			'hint' => array(
				'title' => esc_attr__('Footer logotype', 'dfd'),
				'content' => esc_attr__('This option allows you to show the logotype image in footer', 'dfd')
			)
		),
		array(
			'id' => 'enable_footer_soc_icons',
			'type' => 'button_set',
			'title' => __('Footer social icons', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('footer_variant', "=", '1'),
			'default' => '1', // 1 = on | 0 = off
			'hint' => array(
				'title' => esc_attr__('Social icons', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the social icons in footer, the social icons can be added in Social accounts section in theme options', 'dfd')
			)
		),
		array(
			'id' => 'footer_soc_icons_hover_style',
			'type' => 'select',
			'title' => __('Social icons hover style', 'dfd'),
			'options' => dfd_soc_icons_hover_style(),
			'default' => '4',
			'required' => array('enable_footer_soc_icons', "=", 1),
			'hint' => array(
				'title' => esc_attr__('Social icons hover', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the hover style for the social icons in footer', 'dfd')
			)
		),
		array(
			'id' => 'enable_footer_menu',
			'type' => 'button_set',
			'title' => __('Footer menu', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'required' => array('footer_variant', "=", '1'),
			'default' => '0', // 1 = on | 0 = off
			'hint' => array(
				'title' => esc_attr__('Footer menu', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the menu in footer, the menu can be set in Appearance > Menus > Manage locations > Footer navigation', 'dfd')
			)
		),
		array(
			'id' => 'enable_subfooter',
			'type' => 'button_set',
			'title' => __('Subfooter', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1', // 1 = on | 0 = off
			'hint' => array(
				'title' => esc_attr__('Subfooter', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the subfooter on your site', 'dfd')
			)
		),
		array(
			'id' => 'footer_page_select',
			'type' => 'select',
			'data' => 'pages',
			'title' => __('Footer Section Page', 'dfd'),
			'desc' => __('Please select Footer Section Page', 'dfd'),
			'required' => array('footer_variant', "=", 3),
			'hint' => array(
				'title' => esc_attr__('Footer page', 'dfd'),
				'content' => esc_attr__('Select the page which will be set as footer on your site', 'dfd')
			)
		),
		array(
			'id' => 'copyright_footer',
			'type' => 'textarea',
			'title' => __('Copyright message', 'dfd'),
			'validate' => 'html',
			'default' => '© DynamicFrameworks- Elite ThemeForest Author.',
			'hint' => array(
				'title' => esc_attr__('Copyright', 'dfd'),
				'content' => esc_attr__('Add the copyright message which will be visible in footer or subfooter', 'dfd')
			)
		),
		array(
			'id' => 'footer_copyright_position',
			'type' => 'select',
			'title' => __('Copyright message position', 'dfd'),
			'options' => array(
				'footer' => __('In Footer', 'dfd'),
				'subfooter' => __('In Subfooter', 'dfd'),
			),
			'default' => 'subfooter',
			'hint' => array(
				'title' => esc_attr__('Copyright position', 'dfd'),
				'content' => esc_attr__('Specify where the copyright message should be displayed', 'dfd')
			)
		),
		array(
			'id' => 'info_foot',
			'type' => 'info',
			'desc' => '<h3 class="description">' . __('Footer styling options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'footer_bg_color',
			'type' => 'color',
			'title' => __('Footer background color', 'dfd'),
			'validate' => 'color_rgba',
			'default' => '#323232',
			'hint' => array(
				'title' => esc_attr__('Footer background', 'dfd'),
				'content' => esc_attr__('Select the footer background color', 'dfd')
			)
		),
		array(
			'id' => 'footer_bg_dark',
			'type' => 'button_set',
			'title' => __('Dark background', 'dfd'),
			'options' => array('1' => __('Yes', 'dfd'), '0' => __('No', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Dark background', 'dfd'),
				'content' => esc_attr__('Enable this option if you\'ve set dark background color. The text color will be changed to make the text more readable', 'dfd')
			)
		),
		array(
			'id' => 'footer_bg_image',
			'type' => 'media',
			'title' => __('Background image', 'dfd'),
			'default' => array(
				'url' => ''
			),
			'hint' => array(
				'title' => esc_attr__('Background image', 'dfd'),
				'content' => esc_attr__('Upload the custom image from the media library for the footer background', 'dfd')
			)
		),
		array(
			'id' => 'footer_custom_repeat',
			'type' => 'select',
			'title' => __('Background repeat', 'dfd'),
			'desc' => __('Select type background image repeat', 'dfd'),
			'options' => array('repeat-y' => 'vertically', 'repeat-x' => 'horizontally', 'no-repeat' => 'no-repeat', 'repeat' => 'both vertically and horizontally',), //Must provide key => value pairs for select options
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Background repeat', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the repeat for the background image', 'dfd')
			)
		),
		array(
			'id' => 'info_sub_foot',
			'type' => 'info',
			'desc' => '<h3 class="description">' . __('Subfooter styling options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'sub_footer_bg_color',
			'type' => 'color',
			'title' => __('Subfooter background color', 'dfd'),
			'validate' => 'color_rgba',
			'default' => '#323232',
			'hint' => array(
				'title' => esc_attr__('Subfooter background', 'dfd'),
				'content' => esc_attr__('Select the subfooter background color', 'dfd')
			)
		),
		array(
			'id' => 'sub_footer_bg_dark',
			'type' => 'button_set',
			'title' => __('Dark background', 'dfd'),
			'options' => array('1' => __('Yes', 'dfd'), '0' => __('No', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Dark background', 'dfd'),
				'content' => esc_attr__('Enable this option if you\'ve set dark background color. The text color will be changed to make the text more readable', 'dfd')
			)
		),
		array(
			'id' => 'sub_footer_bg_image',
			'type' => 'media',
			'title' => __('Background image', 'dfd'),
			'default' => array(
				'url' => ''
			),
			'hint' => array(
				'title' => esc_attr__('Background image', 'dfd'),
				'content' => esc_attr__('Upload the custom image from the media library for the subfooter background', 'dfd')
			)
		),
		array(
			'id' => 'sub_footer_custom_repeat',
			'type' => 'select',
			'title' => __('Background repeat', 'dfd'),
			'options' => array('repeat' => 'both vertically and horizontally', 'repeat-y' => 'vertically', 'repeat-x' => 'horizontally', 'no-repeat' => 'no-repeat',), //Must provide key => value pairs for select options
			'default' => 'repeat',
			'hint' => array(
				'title' => esc_attr__('Background repeat', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the repeat for the background image', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => esc_html__('Social accounts', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'icon' => 'crdash-share',
	//Lets leave this as a blank section, no options just some intro text set above.
));
Redux::setSection($opt_name, array(
	'title' => __('Social networks', 'dfd'),
	//'desc' => __('<p class="description">Type links for social accounts</p>', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'subsection' => true,
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'soc_icons_hover_style',
			'type' => 'select',
			'title' => __('Social icons hover style', 'dfd'),
			'options' => dfd_soc_icons_hover_style(),
			'default' => '26',
			'hint' => array(
				'title' => esc_attr__('Icons hover style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset hover styles for the Social networks', 'dfd')
			)
		),
		/*
		  array(
		  'id' => 'author_soc_icons_hover_style',
		  'type' => 'select',
		  'title' => __('Author Box Social icons hover style', 'dfd'),
		  'options' => dfd_soc_icons_hover_style(),
		  'default' => '4',
		  ),
		 */
		array(
			'id' => 'de_link',
			'type' => 'text',
			'title' => __('Deviantart link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'dg_link',
			'type' => 'text',
			'title' => __('Digg link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'dr_link',
			'type' => 'text',
			'title' => __('Dribbble link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => 'http://dribbble.com'
		),
		array(
			'id' => 'db_link',
			'type' => 'text',
			'title' => __('Dropbox link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'en_link',
			'type' => 'text',
			'title' => __('Evernote link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'fb_link',
			'type' => 'text',
			'title' => __('Facebook link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => 'http://facebook.com'
		),
		array(
			'id' => 'flk_link',
			'type' => 'text',
			'title' => __('Flickr link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'fs_link',
			'type' => 'text',
			'title' => __('Foursquare link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'gp_link',
			'type' => 'text',
			'title' => __('Google + link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'in_link',
			'type' => 'text',
			'title' => __('Instagram link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'lf_link',
			'type' => 'text',
			'title' => __('Last FM link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'li_link',
			'type' => 'text',
			'title' => __('LinkedIN link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'lj_link',
			'type' => 'text',
			'title' => __('Livejournal link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'pi_link',
			'type' => 'text',
			'title' => __('Picasa link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'pt_link',
			'type' => 'text',
			'title' => __('Pinterest link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'rss_link',
			'type' => 'text',
			'title' => __('RSS', 'dfd'),
			'desc' => __('Paste alternative link to Rss', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'tu_link',
			'type' => 'text',
			'title' => __('Tumblr link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'tw_link',
			'type' => 'text',
			'title' => __('Twitter link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => 'http://twitter.com'
		),
		array(
			'id' => 'vi_link',
			'type' => 'text',
			'title' => __('Vimeo link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => 'https://vimeo.com/'
		),
		array(
			'id' => 'wp_link',
			'type' => 'text',
			'title' => __('Wordpress link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'yt_link',
			'type' => 'text',
			'title' => __('YouTube link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => '500px_link',
			'type' => 'text',
			'title' => __('500px link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'ml_link',
			'type' => 'text',
			'title' => __('Mail link', 'dfd'),
			'desc' => __('Type your email in a form, e.g.: mailto:youremail@mail.com', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'vb_link',
			'type' => 'text',
			'title' => __('ViewBug link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'vk2_link',
			'type' => 'text',
			'title' => __('VKontacte 2 link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'xn_link',
			'type' => 'text',
			'title' => __('Xing link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'sp_link',
			'type' => 'text',
			'title' => __('Spotify link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'hz_link',
			'type' => 'text',
			'title' => __('Houzz link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'sk_link',
			'type' => 'text',
			'title' => __('Skype link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'ss_link',
			'type' => 'text',
			'title' => __('Slideshare link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'bd_link',
			'type' => 'text',
			'title' => __('Bandcamp link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'sd_link',
			'type' => 'text',
			'title' => __('Soundcloud link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'mk_link',
			'type' => 'text',
			'title' => __('Meerkat link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'ps_link',
			'type' => 'text',
			'title' => __('Periscope link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'sc_link',
			'type' => 'text',
			'title' => __('Snapchat link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'tc_link',
			'type' => 'text',
			'title' => __('The City link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'bh_link',
			'type' => 'text',
			'title' => __('Behance link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'pp_link',
			'type' => 'text',
			'title' => __('Microsoft Pinpoint link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'vd_link',
			'type' => 'text',
			'title' => __('Viadeo link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
		array(
			'id' => 'ta_link',
			'type' => 'text',
			'title' => __('TripAdvisor link', 'dfd'),
			'desc' => __('Paste link to your account if you\'d like to show this social network', 'dfd'),
			'default' => ''
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Single items share options', 'dfd'),
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'single_enable_facebook',
			'type' => 'button_set', //the field type
			'title' => __('Facebook share button', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Facebook', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the Facebook share button', 'dfd')
			)
		),
		array(
			'id' => 'single_enable_twitter',
			'type' => 'button_set', //the field type
			'title' => __('Twitter share button', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Twitter', 'dfd'),
				'content' => esc_attr__('This option allows enable or disable the Twitter share button', 'dfd')
			)
		),
		array(
			'id' => 'single_enable_google_plus',
			'type' => 'button_set', //the field type
			'title' => __('Google+ share button', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Google+', 'dfd'),
				'content' => esc_attr__('This option allows enable or disable the Google+ share button', 'dfd')
			)
		),
		array(
			'id' => 'single_enable_linkedin',
			'type' => 'button_set', //the field type
			'title' => __('LinkedIN share button', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('LinkedIN', 'dfd'),
				'content' => esc_attr__('This option allows enable or disable the LinkedIN share button', 'dfd')
			)
		),
		array(
			'id' => 'single_enable_pinterest',
			'type' => 'button_set', //the field type
			'title' => __('Pinterest share button', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Pinterest', 'dfd'),
				'content' => esc_attr__('This option allows enable or disable the Pinterest share button', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Twitter section options', 'dfd'),
	'subsection' => true,
	'fields' => array(
		/*
		  array(
		  'id' => 't_panel_padding',
		  'type' => 'button_set',
		  'title' => __('Section padding', 'dfd'),
		  'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
		  'default' => '0'// 1 = on | 0 = off
		  ),
		  array(
		  'id' => 't_panel_bg_color',
		  'type' => 'color',
		  'title' => __('Background color for twitter panel', 'dfd'),
		  'validate' => 'color_rgba',
		  'default' => '#f7f7f7'
		  ),
		  array(
		  'id' => 't_panel_bg_image',
		  'type' => 'media',
		  'title' => __('Background image for twitter panel', 'dfd'),
		  'desc' => __('Upload your own background image or pattern.', 'dfd'),
		  'default' => array(
		  'url' => ''
		  )
		  ),
		  array(
		  'id' => 'footer_tw_disp',
		  'type' => 'button_set',
		  'title' => __('Display twitter statuses before footer', 'dfd'),
		  'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
		  'default' => '0'// 1 = on | 0 = off
		  ),
		 */
		array(
			'id' => 'cachetime',
			'type' => 'text',
			'title' => __('Cache tweets', 'dfd'),
			'sub_desc' => __('In minutes', 'dfd'),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Cache tweets', 'dfd'),
				'content' => esc_attr__('Specify the cache time for tweets in minutes', 'dfd')
			)
		),
		array(
			'id' => 'numb_lat_tw',
			'type' => 'text',
			'title' => __('Latest tweets to display', 'dfd'),
			'default' => '10',
			'hint' => array(
				'title' => esc_attr__('Latest tweets', 'dfd'),
				'content' => esc_attr__('Specify the number of tweets you\'d like to display', 'dfd')
			)
		),
		array(
			'id' => 'username',
			'type' => 'text',
			'title' => __('Username', 'dfd'),
			'default' => 'Envato',
			'hint' => array(
				'title' => esc_attr__('Username', 'dfd'),
				'content' => esc_attr__('Specify the twitter username', 'dfd')
			)
		),
		array(
			'id' => 'twiiter_consumer',
			'type' => 'text',
			'title' => __('Consumer key', 'dfd'),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Consumer key', 'dfd'),
				'content' => esc_attr__('Enter the consumer key', 'dfd')
			)
		),
		array(
			'id' => 'twiiter_con_s',
			'type' => 'text',
			'title' => __('Consumer secret', 'dfd'),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Consumer secret', 'dfd'),
				'content' => esc_attr__('Enter the consumer secret', 'dfd')
			)
		),
		array(
			'id' => 'twiiter_acc_t',
			'type' => 'text',
			'title' => __('Access token', 'dfd'),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Access token', 'dfd'),
				'content' => esc_attr__('Enter the access token', 'dfd')
			)
		),
		array(
			'id' => 'twiiter_acc_t_s',
			'type' => 'text',
			'title' => __('Access token secret', 'dfd'),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Access token secret', 'dfd'),
				'content' => esc_attr__('Enter the access token secret', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => esc_html__('Blog options', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'icon' => 'crdash-thumbnail_list',
	//Lets leave this as a blank section, no options just some intro text set above.
));
Redux::setSection($opt_name, array(
	'title' => __('Base blog options', 'dfd'),
	//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'subsection' => true,
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'blog_base',
			'type' => 'info',
			'desc' => '<h3 class="description">' . __('Base blog options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'blog_top_link_src',
			'type' => 'select',
			'title' => __('Blog top link source', 'dfd'),
			'options' => array(
				'page' => __('Page', 'dfd'),
				'url' => __('Custom url', 'dfd'),
			),
			'default' => 'chaffle',
			'hint' => array(
				'title' => esc_attr__('Link source', 'dfd'),
				'content' => esc_attr__('This option allows you to set the page or custom link which will be used for the button placed next to the categories and tags dropdown on pages with "Blog page template"', 'dfd')
			)
		),
		array(
			'id' => 'blog_top_page_select',
			'type' => 'select',
			'data' => 'pages',
			'title' => __('Blog page', 'dfd'),
			'required' => array(
				array('blog_top_link_src', '=', 'page'),
			),
			'hint' => array(
				'title' => esc_attr__('Blog page', 'dfd'),
				'content' => esc_attr__('Select the page which will be used as main blog page', 'dfd')
			)
		),
		array(
			'id' => 'blog_top_page_url',
			'type' => 'text',
			'title' => __('Blog page URL', 'dfd'),
			'validate' => 'url',
			'required' => array(
				array('blog_top_link_src', '=', 'url'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Blog page URL', 'dfd'),
				'content' => esc_attr__('Set the blog page URL which will be used as main blog page', 'dfd')
			)
		),
		array(
			'id' => 'blog_general',
			'type' => 'info',
			'desc' => '<h3 class="description">' . __('General options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'post_share_button',
			'type' => 'button_set',
			'title' => __('Social share buttons', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1', // 1 = on | 0 = off
			'hint' => array(
				'title' => esc_attr__('Social share', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the social share buttons', 'dfd')
			)
		),
		array(
			'id' => 'custom_share_code',
			'type' => 'textarea',
			'title' => __('Custom share code', 'dfd'),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Share code', 'dfd'),
				'content' => esc_attr__('This option allows you to add custom code for the share', 'dfd')
			)
		), /*
		  array(
		  'id' => 'autor_box_disp',
		  'type' => 'button_set',
		  'title' => __('Author Info', 'dfd'),
		  'desc' => __('This option enables you to insert information about the author of the post.', 'dfd'),
		  'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
		  'default' => '1', // 1 = on | 0 = off
		  ),
		  array(
		  'id' => 'thumb_inner_disp',
		  'type' => 'button_set', //the field type
		  'title' => __('Thumbnail on inner page', 'dfd'),
		  'desc' => __('Display featured image on single post', 'dfd'),
		  'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
		  'default' => '0', //this should be the key as defined above
		  ), */
		array(
			'id' => 'blog_items_disp',
			'type' => 'button_set', //the field type
			'title' => __('Display block under single blog item', 'dfd'),
			'sub_desc' => __('Block with recent news', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '0', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Block under single item', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the block that will be displayed under posts on single post page', 'dfd')
			)
		),
		array(
			'id' => 'block_single_blog_item',
			'type' => 'textarea',
			'title' => __('Block shortcode', 'dfd'),
			//'sub_desc' => __('', 'dfd'),
			'default' => '',
			'required' => array(
				array('blog_items_disp', '=', '1'),
			),
			'hint' => array(
				'title' => esc_attr__('Block shortcode', 'dfd'),
				'content' => esc_attr__('This option allows you to add custom shortcode which will be displayed under posts on single post page', 'dfd')
			)
		),
		array(
			'id' => 'style_hover_read_more',
			'type' => 'select',
			'title' => __('"MORE INFO" button hover style', 'dfd'),
			'options' => array(
				'chaffle' => __('Shuffle', 'dfd'),
				'slide-up' => __('Slide up', 'dfd'),
			),
			'default' => 'chaffle',
			'hint' => array(
				'title' => esc_attr__('"MORE INFO" button hover', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the hover effect for the More info buttom on blog post page templates', 'dfd')
			)
		),
		array(
			'id' => 'info_msc',
			'type' => 'info',
			'desc' => __('<h3 class="description">Archive page options</h3>', 'dfd')
		),
		array(
			'id' => 'thumb_image_crop',
			'type' => 'button_set',
			'title' => __('Crop thumbnails', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Crop thumbnails', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the crop for the posts\' thumbnails images', 'dfd')
			)
		),
		array(
			'id' => 'post_thumbnails_width',
			'type' => 'text',
			'title' => __('Post thumbnail width (in px)', 'dfd'),
			'validate' => 'numeric',
			'default' => '900',
			'hint' => array(
				'title' => esc_attr__('Thumbnail width', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the width of the posts\' thumbnails images on archive pages', 'dfd')
			)
		),
		array(
			'id' => 'post_thumbnails_height',
			'type' => 'text',
			'title' => __('Post thumbnail height (in px)', 'dfd'),
			'validate' => 'numeric',
			'default' => '600',
			'hint' => array(
				'title' => esc_attr__('Thumbnail height', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the height of the posts\' thumbnails images on archive pages', 'dfd')
			)
		),
		array(
			'id' => 'post_title_bottom_offset',
			'type' => 'text',
			'title' => __('Post title bottom offset (in px)', 'dfd'),
			'validate' => 'numeric',
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Title bottom offset', 'dfd'),
				'content' => esc_attr__('This option allows you to set the extra padding for the posts on archive page', 'dfd')
			)
		),
		array(
			'id' => 'post_header',
			'type' => 'button_set',
			'title' => __('Post info', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Post info', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the information about the post (time and date of creation, author, comments on the post)', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Single post options', 'dfd'),
	//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'subsection' => true,
	'icon' => 'crdash-thumbnail_list',
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'blog_single_page',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Layout settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'blog_single_style',
			'type' => 'select',
			'title' => __('Single post style', 'dfd'),
			'options' => array(
				'base' => __('Simple', 'dfd'),
				'advanced' => __('Advanced', 'dfd'),
			),
			'default' => 'base',
			'hint' => array(
				'title' => esc_attr__('Post style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the style of your blog post items', 'dfd')
			)
		),
		array(
			'id' => 'blog_single_layout',
			'type' => 'select',
			'title' => __('Layout width', 'dfd'),
			'options' => array(
				'' => __('Boxed', 'dfd'),
				'full_width' => __('Full width', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Layout width', 'dfd'),
				'content' => esc_attr__('This option defines the single post content width. There is also an option on the single post page if you need to change the layout width on single item', 'dfd')
			)
		),
		array(
			'id' => 'blog_single_sidebars',
			'type' => 'select',
			'title' => __('Sidebars configuration', 'dfd'),
			'options' => array(
				'' => __('Inherit from single post settings', 'dfd'),
				'1col-fixed' => __('No sidebars', 'dfd'),
				'2c-l-fixed' => __('Left sidebar', 'dfd'),
				'2c-r-fixed' => __('Right sidebar', 'dfd'),
				'3c-fixed' => __('Both left and right sidebars', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Sidebars configuration', 'dfd'),
				'content' => esc_attr__('Allows you to choose sidebars and their position. There is also an option on the item\'s page if you need to change the layout for the single post', 'dfd')
			)
		),
		array(
			'id' => 'blog_single_stun_header',
			'type' => 'button_set', //the field type
			'title' => __('Stunning header', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Stunning header', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the stunning header for the single post pages by default. There is also an option on the single post page if you need to change stunning header settings on single item', 'dfd')
			)
		),
		array(
			'id' => 'blog_single_content',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Content settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'blog_single_stun_header_cat',
			'type' => 'button_set', //the field type
			'title' => __('Category in stunning header', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'required' => array(
				array('blog_single_stun_header', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Category', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the post category in stunning header on single post page', 'dfd')
			)
		),
		array(
			'id' => 'blog_single_stun_header_meta',
			'type' => 'button_set', //the field type
			'title' => __('Meta in stunning header', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'required' => array(
				array('blog_single_stun_header', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Meta', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the post meta in stunning header on single post page', 'dfd')
			)
		),
		array(
			'id' => 'blog_single_show_title',
			'type' => 'button_set', //the field type
			'title' => __('Title', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Title', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the post title on single post page', 'dfd')
			)
		),
		array(
			'id' => 'blog_single_show_meta',
			'type' => 'button_set', //the field type
			'title' => __('Meta', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'required' => array(
				array('blog_single_style', '=', 'advanced'),
			),
			'hint' => array(
				'title' => esc_attr__('Meta', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the post meta on single post page', 'dfd')
			)
		),
		array(
			'id' => 'blog_single_show_read_more_share',
			'type' => 'button_set', //the field type
			'title' => __('Comments counter, tags, likes and share', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'sub_desc' => '',
			'default' => 'on',
			'required' => array(
				array('blog_single_style', '=', 'advanced'),
			),
			'hint' => array(
				'title' => esc_attr__('Counter, tags, likes and share', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the post comments counter, tags, likes and share on single post page', 'dfd')
			)
		),
		array(
			'id' => 'blog_single_share_style',
			'type' => 'select', //the field type
			'title' => __('Share style', 'dfd'),
			'sub_desc' => '',
			'options' => array(
				'animated' => __('Animated on hover', 'dfd'),
				'simple' => __('Simple', 'dfd'),
			),
			'default' => '',
			'required' => array(
				array('blog_single_show_read_more_share', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Share style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the share style set on single post page', 'dfd')
			)
		),
		array(
			'id' => 'blog_single_show_fixed_share',
			'type' => 'button_set', //the field type
			'title' => __('Fixed Share', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'sub_desc' => '',
			'default' => 'on',
			'required' => array(
				array('blog_single_style', '=', 'advanced'),
			),
			'hint' => array(
				'title' => esc_attr__('Fixed share', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the fixed share which is visible on the side of the single post page', 'dfd')
			)
		),
		array(
			'id' => 'blog_single_paging',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Pagination settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'blog_single_enable_pagination',
			'type' => 'button_set', //the field type
			'title' => __('Inside pagination', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'sub_desc' => '',
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Inside pagination', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the inside pagination on single post page', 'dfd')
			)
		),
		array(
			'id' => 'blog_single_pagination_style',
			'type' => 'select',
			'title' => __('Pagination position', 'dfd'),
			'options' => array(
				'' => __('Fixed', 'dfd'),
				'top' => __('Top', 'dfd'),
			),
			'default' => '',
			'required' => array(
				array('blog_single_enable_pagination', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Pagination position', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the position of the inside pagination on single post page', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Blog page options', 'dfd'),
	//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'subsection' => true,
	'icon' => 'crdash-thumbnail_list',
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'blog_page_set',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Layout settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'blog_layout',
			'type' => 'select',
			'title' => __('Layout width', 'dfd'),
			'options' => array(
				'' => __('Boxed', 'dfd'),
				'full_width' => __('Full width', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Layout width', 'dfd'),
				'content' => esc_attr__('This option defines the single content width. There is also an option on the blog post page if you need to change the layout width on single page', 'dfd')
			)
		),
		array(
			'id' => 'blog_sidebars',
			'type' => 'select',
			'title' => __('Sidebars configuration', 'dfd'),
			'options' => array(
				'' => __('Inherit from single layout settings', 'dfd'),
				'1col-fixed' => __('No sidebars', 'dfd'),
				'2c-l-fixed' => __('Left sidebar', 'dfd'),
				'2c-r-fixed' => __('Right sidebar', 'dfd'),
				'3c-fixed' => __('Both left and right sidebars', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Sidebars configuration', 'dfd'),
				'content' => esc_attr__('Allows you to choose sidebars and their position. There is also an option on the item\'s page if you need to change the layout for the single page', 'dfd')
			)
		),
		array(
			'id' => 'blog_layout_style',
			'type' => 'select',
			'title' => __('Layout style', 'dfd'),
			'options' => array(
				false => __('Standard', 'dfd'),
				'right-image' => __('Right image', 'dfd'),
				'left-image' => __('Left image', 'dfd'),
				'masonry' => __('Masonry', 'dfd'),
				'fitRows' => __('Grid', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Layout style', 'dfd'),
				'content' => esc_attr__('Choose the layout style for the blog page which will be applied for all the blog pages by default. There is also an option on the item\'s page if you need to change the layout for the single blog page', 'dfd')
			)
		),
		array(
			'id' => 'blog_smart_grid',
			'type' => 'button_set',
			'title' => __('Smart grid mode', 'dfd'),
			'options' => array(
				'on' => __('Enable', 'dfd'),
				'off' => __('Disable', 'dfd'),
			),
			'default' => 'off',
			'required' => array(
				array('blog_layout_style', '!=', false),
				array('blog_layout_style', '!=', 'masonry'),
				array('blog_layout_style', '!=', 'right-image'),
				array('blog_layout_style', '!=', 'left-image'),
			),
			'hint' => array(
				'title' => esc_attr__('Smart grid', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the smart grid, all the post content will be displayed over the thumbnail image. There is also an option on the item\'s page if you need to change the layout for the single blog page', 'dfd')
			)
		),
		array(
			'id' => 'blog_smart_hover_text_color',
			'type' => 'color',
			'title' => __('Text hover color for Smart grid', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Smart grid text hover color', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the hover color of meta (date, author and category), description and background for title', 'dfd')
			)
		),
		array(
			'id' => 'blog_smart_hover_mask_style',
			'type' => 'select',
			'title' => __('Hover mask style for Smart grid', 'dfd'),
			'options' => array(
				'simple' => __('Simple color', 'dfd'),
				'gradient' => __('Gradient', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Hover mask style', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the hover mask background color style for the smart grid post items', 'dfd')
			)
		),
		array(
			'id' => 'blog_smart_hover_bg',
			'type' => 'color',
			'title' => __('Hover mask color for Smart grid style', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array(
				'blog_smart_hover_mask_style', "=", 'simple'
			),
			'hint' => array(
				'title' => esc_attr__('Hover mask color', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the hover mask background color for the smart grid post items', 'dfd')
			)
		),
		array(
			'id' => 'blog_smart_hover_bg_gradient',
			'type' => 'color_gradient',
			'title' => __('Hover mask gradient color for Smart grid style', 'dfd'),
			'default' => array(
				'from' => '',
				'to' => '',
			),
			'validate' => 'color',
			'required' => array(
				'blog_smart_hover_mask_style', "=", 'gradient'
			),
			'hint' => array(
				'title' => esc_attr__('Hover mask gradient color', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the hover mask gradient background color for the smart grid post items', 'dfd')
			)
		),
		array(
			'id' => 'blog_smart_hover_bg_opacity',
			'type' => 'slider',
			'title' => __('Background opacity for Smart grid style', 'dfd'),
			'min' => '1',
			'max' => '100',
			'step' => '1',
			'default' => '70',
			'hint' => array(
				'title' => esc_attr__('Hover mask gradient color', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the hover mask background color opacity for the smart grid post items', 'dfd')
			)
		),
		array(
			'id' => 'blog_columns',
			'type' => 'select',
			'title' => __('Number of columns', 'dfd'),
			'options' => array(
				'1' => __('One', 'dfd'),
				'2' => __('Two', 'dfd'),
				'3' => __('Three', 'dfd'),
				'4' => __('Four', 'dfd'),
				'5' => __('Five', 'dfd'),
			//'6' => __('Six', 'dfd'),
			),
			'default' => '1',
			'required' => array(
				array('blog_layout_style', 'contains', 'o'),
			),
		),
		array(
			'id' => 'blog_stun_header',
			'type' => 'button_set', //the field type
			'title' => __('Stunning header', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Stunning header', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the stunning header for the blog post pages by default. There is also an option on the blog post page if you need to change stunning header settings on single page', 'dfd')
			)
		),
		array(
			'id' => 'blog_cat_tag',
			'type' => 'button_set', //the field type
			'title' => __('Categories, tags and author dropdown', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Categories and tags dropdown', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide categories, tags and author drop-down sorter before post items', 'dfd')
			)
		),
		array(
			'id' => 'blog_page_content',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Content settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'blog_sort_panel',
			'type' => 'button_set', //the field type
			'title' => __('Sort panel', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'required' => array(
				array('blog_layout_style', 'contains', 'o'),
			),
			'default' => 'on', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Sort panel', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable post categories sorter above blog post items. There is also an option on the item\'s page if you need to change it for single blog posts page', 'dfd')
			)
		),
		array(
			'id' => 'blog_sort_panel_align',
			'type' => 'select', //the field type
			'title' => __('Sort panel alignment', 'dfd'),
			'sub_desc' => '',
			'options' => array(
				'text-left' => __('Left', 'dfd'),
				'text-right' => __('Right', 'dfd'),
				'text-center' => __('Center', 'dfd'),
			),
			'required' => array(
				array('blog_layout_style', 'contains', 'o'),
			),
			'default' => 'text-left', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Sort panel alignment', 'dfd'),
				'content' => esc_attr__('This option allows you to align the sort panel horizontally', 'dfd')
			)
		),
		array(
			'id' => 'blog_items_offset',
			'type' => 'text',
			'title' => __('Blog items offset (in px)', 'dfd'),
			'validate' => 'numeric',
			'default' => '',
			/* 'required' => array(
			  array('blog_single_type', 'not_empty_and', 'masonry'),
			  ), */
			'hint' => array(
				'title' => esc_attr__('Items offset', 'dfd'),
				'content' => esc_attr__('This option allows you to add space between single posts, don\'t include "px". There is also an option on the item\'s page if you need to change it for single blog posts page', 'dfd')
			)
		),
		array(
			'id' => 'blog_show_comments',
			'type' => 'button_set', //the field type
			'title' => __('Comments', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Comments', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the post comments counter on blog posts page', 'dfd')
			)
		),
		array(
			'id' => 'blog_show_likes',
			'type' => 'button_set', //the field type
			'title' => __('Likes', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Likes', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the post likes counter on blog posts page', 'dfd')
			)
		),
		array(
			'id' => 'blog_comments_likes_style',
			'type' => 'select', //the field type
			'title' => __('Comments and like style', 'dfd'),
			'sub_desc' => '',
			'options' => array(
				' ' => __('Always show', 'dfd'),
				'comments-like-hover' => __('Show on hover', 'dfd'),
			),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Comments and like style', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the style of the post likes counter on blog posts page', 'dfd')
			)
		),
		array(
			'id' => 'blog_show_title',
			'type' => 'button_set', //the field type
			'title' => __('Titles', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Titles', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the post title on blog posts page. There is also an option on the item\'s page if you need to change it for single blog posts page', 'dfd')
			)
		),
		array(
			'id' => 'blog_show_meta',
			'type' => 'button_set', //the field type
			'title' => __('Meta', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Meta', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the post meta on blog posts page. There is also an option on the item\'s page if you need to change it for single blog posts page', 'dfd')
			)
		),
		array(
			'id' => 'blog_heading_position',
			'type' => 'select', //the field type
			'title' => __('Heading position', 'dfd'),
			'sub_desc' => '',
			'options' => array(
				'bottom' => __('Under media', 'dfd'),
				'top' => __('Over media', 'dfd'),
			),
			'default' => 'bottom',
			'required' => array(
				array('blog_show_title', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Heading position', 'dfd'),
				'content' => esc_attr__('This option allows you to choose heading position on blog posts page. There is also an option on the item\'s page if you need to change it for single blog posts page', 'dfd')
			)
		),
		array(
			'id' => 'blog_show_description',
			'type' => 'button_set', //the field type
			'title' => __('Description', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'sub_desc' => '',
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Description', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the post description on blog posts page. There is also an option on the item\'s page if you need to change it for single blog posts page', 'dfd')
			)
		),
		array(
			'id' => 'blog_content_alignment',
			'type' => 'select', //the field type
			'title' => __('Content alignment', 'dfd'),
			'sub_desc' => '',
			'options' => array(
				'text-center' => __('Center', 'dfd'),
				'text-left' => __('Left', 'dfd'),
				'text-right' => __('Right', 'dfd'),
			),
			'default' => '',
			'required' => array(
				array('blog_show_description', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Content alignment', 'dfd'),
				'content' => esc_attr__('This option allows you to choose horizontal alignment for the post description on blog posts page. There is also an option on the item\'s page if you need to change it for single blog posts page', 'dfd')
			)
		),
		array(
			'id' => 'blog_show_read_more_share',
			'type' => 'button_set', //the field type
			'title' => __('Read more and Share', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'sub_desc' => '',
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Read more and Share', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable Read more and Share buttons under the single posts on blog posts page. There is also an option on the item\'s page if you need to change it for single blog posts page', 'dfd')
			)
		),
		array(
			'id' => 'blog_read_more_style',
			'type' => 'select', //the field type
			'title' => __('Read more style', 'dfd'),
			'sub_desc' => '',
			'options' => array(
				'simple' => __('Simple', 'dfd'),
				'chaffle' => __('Shuffle', 'dfd'),
				'slide-up' => __('Slide up', 'dfd'),
			),
			'default' => 'simple',
			'required' => array(
				array('blog_show_read_more_share', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Read more style', 'dfd'),
				'content' => esc_attr__('This option allows you to specify Read more button style under the single posts on blog posts page. There is also an option on the item\'s page if you need to change it for single blog posts page', 'dfd')
			)
		),
		array(
			'id' => 'blog_share_style',
			'type' => 'select', //the field type
			'title' => __('Share style', 'dfd'),
			'sub_desc' => '',
			'options' => array(
				'animated' => __('Animated on hover', 'dfd'),
				'simple' => __('Simple', 'dfd'),
			),
			'default' => '',
			'required' => array(
				array('blog_show_read_more_share', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Share style', 'dfd'),
				'content' => esc_attr__('This option allows you to specify Share button style under the single posts on blog posts page. There is also an option on the item\'s page if you need to change it for single blog posts page', 'dfd')
			)
		),
		array(
			'id' => 'blog_extra_features',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Extra features', 'dfd') . '</h3>'
		),
		array(
			'id' => 'blog_vc_content_position',
			'type' => 'select',
			'title' => __('Content position', 'dfd'),
			'options' => array(
				'top' => __('Before projects', 'dfd'),
				'bottom' => __('After projects', 'dfd'),
			),
			'default' => 'top',
			'hint' => array(
				'title' => esc_attr__('Content position', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the displaying of the Visual Composer content. You can set the content above or below the post items. There is also an option on the item\'s page if you need to change it for single blog posts page', 'dfd')
			)
		),
		array(
			'id' => 'blog_item_appear_effect',
			'type' => 'select',
			'title' => __('Items appear effect', 'dfd'),
			'options' => dfd_module_animation_styles('options'),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Appear effect', 'dfd'),
				'content' => esc_attr__('Choose the appear effect for the posts. There is also an option on the item\'s page if you need to change it for single blog posts page', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Archive page options', 'dfd'),
	//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'subsection' => true,
	'icon' => 'crdash-thumbnail_list',
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'blog_archive_set',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Layout settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'archive_layout_style',
			'type' => 'select',
			'title' => __('Layout style', 'dfd'),
			'options' => array(
				'standard' => __('Standard', 'dfd'),
				'right-image' => __('Right image', 'dfd'),
				'left-image' => __('Left image', 'dfd'),
				'masonry' => __('Masonry', 'dfd'),
				'fitRows' => __('Grid', 'dfd'),
			),
			'default' => 'standard',
			'hint' => array(
				'title' => esc_attr__('Layout style', 'dfd'),
				'content' => esc_attr__('Choose the layout style for the blog page which will be applied for all the blog archive pages', 'dfd')
			)
		),
		array(
			'id' => 'archive_layout_width',
			'type' => 'select',
			'title' => __('Layout width', 'dfd'),
			'options' => array(
				'' => __('Boxed', 'dfd'),
				'full_width' => __('Full width', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Layout width', 'dfd'),
				'content' => esc_attr__('This option defines the single content width', 'dfd')
			)
		),
		array(
			'id' => 'archive_sidebars',
			'type' => 'select',
			'title' => __('Sidebars configuration', 'dfd'),
			'options' => array(
				'' => __('Inherit from single layout settings', 'dfd'),
				'1col-fixed' => __('No sidebars', 'dfd'),
				'2c-l-fixed' => __('Left sidebar', 'dfd'),
				'2c-r-fixed' => __('Right sidebar', 'dfd'),
				'3c-fixed' => __('Both left and right sidebars', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Sidebars configuration', 'dfd'),
				'content' => esc_attr__('Allows you to choose sidebars and their position', 'dfd')
			)
		),
		array(
			'id' => 'archive_stun_header',
			'type' => 'button_set', //the field type
			'title' => __('Stunning header', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Stunning header', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the stunning header for the blog post archive pages', 'dfd')
			)
		),
		array(
			'id' => 'archive_cat_tag',
			'type' => 'button_set', //the field type
			'title' => __('Categories, tags and author dropdown', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Categories and tags dropdown', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide categories, tags and author drop-down sorter before post items', 'dfd')
			)
		),
		array(
			'id' => 'blog_archive_content',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Content settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'archive_show_title',
			'type' => 'button_set', //the field type
			'title' => __('Titles', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Titles', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the post title on blog posts archive page', 'dfd')
			)
		),
		array(
			'id' => 'archive_show_meta',
			'type' => 'button_set', //the field type
			'title' => __('Meta', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Meta', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the post meta on blog posts archive page', 'dfd')
			)
		),
		array(
			'id' => 'archive_heading_position',
			'type' => 'select', //the field type
			'title' => __('Heading position', 'dfd'),
			'sub_desc' => '',
			'options' => array(
				'bottom' => __('Under media', 'dfd'),
				'top' => __('Before media', 'dfd'),
			),
			'default' => 'bottom',
			'required' => array(
				array('archive_show_title', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Heading position', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the heading position on blog posts archive page', 'dfd')
			)
		),
		array(
			'id' => 'archive_show_description',
			'type' => 'button_set', //the field type
			'title' => __('Description', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'sub_desc' => '',
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Description', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the post description on blog posts archive page', 'dfd')
			)
		),
		array(
			'id' => 'archive_content_alignment',
			'type' => 'select', //the field type
			'title' => __('Content alignment', 'dfd'),
			'sub_desc' => '',
			'options' => array(
				'text-center' => __('Center', 'dfd'),
				'text-left' => __('Left', 'dfd'),
				'text-right' => __('Right', 'dfd'),
			),
			'default' => '',
			'required' => array(
				array('archive_show_description', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Content alignment', 'dfd'),
				'content' => esc_attr__('This option allows you to choose horizontal alignment for the post description on blog posts archive page', 'dfd')
			)
		),
		array(
			'id' => 'archive_show_read_more_share',
			'type' => 'button_set', //the field type
			'title' => __('Read more and Share', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'sub_desc' => '',
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Read more and Share', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable Read more and Share buttons under the single posts on blog posts archive page', 'dfd')
			)
		),
		array(
			'id' => 'archive_read_more_style',
			'type' => 'select', //the field type
			'title' => __('Read more style', 'dfd'),
			'sub_desc' => '',
			'options' => array(
				'simple' => __('Simple', 'dfd'),
				'chaffle' => __('Shuffle', 'dfd'),
				'slide-up' => __('Slide up', 'dfd'),
			),
			'default' => 'simple',
			'required' => array(
				array('archive_show_read_more_share', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Read more style', 'dfd'),
				'content' => esc_attr__('This option allows you to specify Read more button style under the single posts on blog posts archive page', 'dfd')
			)
		),
		array(
			'id' => 'archive_share_style',
			'type' => 'select', //the field type
			'title' => __('Share style', 'dfd'),
			'sub_desc' => '',
			'options' => array(
				'animated' => __('Animated on hover', 'dfd'),
				'simple' => __('Simple', 'dfd'),
			),
			'default' => '',
			'required' => array(
				array('archive_show_read_more_share', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Share style', 'dfd'),
				'content' => esc_attr__('This option allows you to specify Share button style under the single posts on blog posts archive page', 'dfd')
			)
		),
		array(
			'id' => 'archive_columns',
			'type' => 'select',
			'title' => __('Number of columns', 'dfd'),
			'options' => array(
				'1' => __('One', 'dfd'),
				'2' => __('Two', 'dfd'),
				'3' => __('Three', 'dfd'),
				'4' => __('Four', 'dfd'),
				'5' => __('Five', 'dfd'),
			//'6' => __('Six', 'dfd'),
			),
			'default' => '1',
			'required' => array(
				array('archive_layout_style', 'contains', 'o'),
			),
		),
		array(
			'id' => 'archive_items_offset',
			'type' => 'text',
			'title' => __('Items offset (in px)', 'dfd'),
			'validate' => 'numeric',
			'default' => '',
			/* 'required' => array(
			  array('archive_single_type', 'not_empty_and', 'masonry'),
			  ), */
			'hint' => array(
				'title' => esc_attr__('Items offset', 'dfd'),
				'content' => esc_attr__('This option allows you to add space between single posts, don\'t include "px"', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => esc_html__('Portfolio options', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'icon' => 'crdash-briefcase',
	//Lets leave this as a blank section, no options just some intro text set above.
));
Redux::setSection($opt_name, array(
	'title' => __('Base portfolio options', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'subsection' => true,
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'portfolio_base',
			'type' => 'info',
			'desc' => '<h3 class="description">' . __('Base portfolio options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'folio_top_link_src',
			'type' => 'select',
			'title' => __('Portfolio top link source', 'dfd'),
			'options' => array(
				'page' => __('Page', 'dfd'),
				'url' => __('Custom url', 'dfd'),
			),
			'default' => 'chaffle',
			'hint' => array(
				'title' => esc_attr__('Link source', 'dfd'),
				'content' => esc_attr__('This option allows you to set the page or custom link which will be used for the button placed next to the categories and tags dropdown on pages with "Portfolio page template"', 'dfd')
			)
		),
		array(
			'id' => 'folio_top_page_select',
			'type' => 'select',
			'data' => 'pages',
			'title' => __('Portfolio page', 'dfd'),
			'required' => array(
				array('folio_top_link_src', '=', 'page'),
			),
			'hint' => array(
				'title' => esc_attr__('Portfolio page', 'dfd'),
				'content' => esc_attr__('Select the page which will be used as main portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_top_page_url',
			'type' => 'text',
			'title' => __('Portfolio page URL', 'dfd'),
			'validate' => 'url',
			'required' => array(
				array('folio_top_link_src', '=', 'url'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Portfolio page URL', 'dfd'),
				'content' => esc_attr__('Set the portfolio page URL which will be used as main portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_top_page_title',
			'type' => 'text',
			'title' => esc_html__('Portfolio page title', 'dfd'),
			'default' => esc_html__('Portfolio', 'dfd'),
			'hint' => array(
				'title' => esc_attr__('Portfolio page title', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the Portfolio page title which will be visible in breadcrumbs on single portfolio item', 'dfd')
			)
		),
		array(
			'id' => 'portfolio_url_slug',
			'type' => 'text',
			'title' => __('Portfolio URL slug', 'dfd'),
			'desc' => __('Please do not forget to save permalinks in Settings -> Permalinks section after changing this option', 'dfd'),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Portfolio URL slug', 'dfd'),
				'content' => esc_attr__('This option allows you to change the portfolio slug. Set your custom slug which will be displayed instead of portfolio in portfolio URL', 'dfd')
			)
		),
		array(
			'id' => 'portfolio_content',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Content settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'portfolio_inner_description_title',
			'type' => 'text',
			'title' => __('Portfolio inner page description title', 'dfd'),
			'default' => __('Description', 'dfd'),
			'hint' => array(
				'title' => esc_attr__('Description title', 'dfd'),
				'content' => esc_attr__('This option allows you to change the portfolio description title. Set your custom word which will be visible instead of "Description" on portfolio inner page', 'dfd')
			)
		),
		array(
			'id' => 'folio_sorting',
			'type' => 'button_set', //the field type
			'title' => __('Sort panel', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Sort panel', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable portfolio categories sorter above portfolio items on deprecated portfolio page templates', 'dfd')
			)
		),
		array(
			'id' => 'entry_meta_display',
			'type' => 'button_set', //the field type
			'title' => __('Display single item meta', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Meta', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the single portfolio item\'s meta(publication date, author and category) on portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'recent_items_disp',
			'type' => 'button_set', //the field type
			'title' => __('Display block under single item', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '1', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Block under single item', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the block that will be displayed under portfolios on single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'block_single_folio_item',
			'type' => 'textarea',
			'title' => __('Block shortcode', 'dfd'),
			'required' => array('recent_items_disp', "=", '1'),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Block shortcode', 'dfd'),
				'content' => esc_attr__('This option allows you to add custom shortcode which will be displayed under portfolios on single portfolio page', 'dfd')
			)
		),
	/* array(
	  'id' => 'folio_top_page_select',
	  'type'     => 'select',
	  'data'     => 'pages',
	  'title' => __('Portfolio page select', 'dfd'),
	  'desc' => __('Please select main portfolio page', 'dfd'),
	  ), */
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Portfolio page options', 'dfd'),
	//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'subsection' => true,
	'icon' => 'crdash-briefcase',
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'portfolio	_page_set',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Layout settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'folio_layout',
			'type' => 'select',
			'title' => __('Layout width', 'dfd'),
			'options' => array(
				'' => __('Boxed', 'dfd'),
				'full_width' => __('Full width', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Layout width', 'dfd'),
				'content' => esc_attr__('This option defines the portfolio page\'s content width', 'dfd')
			)
		),
		array(
			'id' => 'folio_layout_style',
			'type' => 'select',
			'title' => __('Layout style', 'dfd'),
			'options' => array(
				false => __('Standard', 'dfd'),
				'masonry' => __('Masonry', 'dfd'),
				'fitRows' => __('Grid', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Layout style', 'dfd'),
				'content' => esc_attr__('Choose the layout style for the portfolio page which will be applied for all the portfolio pages by default. There is also an option on the item\'s page if you need to change the layout for the single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_sidebars',
			'type' => 'select',
			'title' => __('Sidebars configuration', 'dfd'),
			'options' => array(
				'' => __('Inherit from single layout settings', 'dfd'),
				'1col-fixed' => __('No sidebars', 'dfd'),
				'2c-l-fixed' => __('Left sidebar', 'dfd'),
				'2c-r-fixed' => __('Right sidebar', 'dfd'),
				'3c-fixed' => __('Both left and right sidebars', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Sidebars configuration', 'dfd'),
				'content' => esc_attr__('Allows you to choose sidebars and their position.  There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_stun_header',
			'type' => 'button_set', //the field type
			'title' => __('Stunning header', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Stunning header', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the stunning header for the pages with Portfolio page template', 'dfd')
			)
		),
		array(
			'id' => 'folio_cat_tag',
			'type' => 'button_set', //the field type
			'title' => __('Categories, tags and author dropdown', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Categories and tags dropdown', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide categories, tags and author drop-down sorter before portfolio items', 'dfd')
			)
		),
		array(
			'id' => 'folio_sort_panel',
			'type' => 'button_set', //the field type
			'title' => __('Sort panel', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Sort panel', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable portfolio categories sorter above portfolio items. There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_sort_panel_align',
			'type' => 'select', //the field type
			'title' => __('Sort panel alignment', 'dfd'),
			'options' => array(
				'text-left' => __('Left', 'dfd'),
				'text-right' => __('Right', 'dfd'),
				'text-center' => __('Center', 'dfd'),
			),
			'default' => 'text-left', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Sort panel alignment', 'dfd'),
				'content' => esc_attr__('This option allows you to align the sort panel horizontally', 'dfd')
			)
		),
		array(
			'id' => 'folio_items_offset',
			'type' => 'text',
			'title' => __('Portfolio items offset (in px)', 'dfd'),
			'validate' => 'numeric',
			'default' => '',
			/* 'required' => array(
			  array('folio_single_type', 'not_empty_and', 'masonry'),
			  ), */
			'hint' => array(
				'title' => esc_attr__('Items offset', 'dfd'),
				'content' => esc_attr__('This option allows you to add space between single portfolio items, don\'t include "px". There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_columns',
			'type' => 'select',
			'title' => __('Number of columns', 'dfd'),
			'options' => array(
				'1' => __('One', 'dfd'),
				'2' => __('Two', 'dfd'),
				'3' => __('Three', 'dfd'),
				'4' => __('Four', 'dfd'),
				'5' => __('Five', 'dfd'),
			//'6' => __('Six', 'dfd'),
			),
			'default' => '1',
			'required' => array(
				array('folio_layout_style', '!=', false),
			),
		),
		array(
			'id' => 'portfolio_page_content',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Content settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'folio_show_title',
			'type' => 'button_set', //the field type
			'title' => __('Titles', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Titles', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the portfolio title on portfolio page.  There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_title_position',
			'type' => 'select',
			'title' => __('Title position', 'dfd'),
			'options' => array(
				'under' => __('Under the image', 'dfd'),
				'front' => __('In front of the image', 'dfd'),
			),
			'default' => '',
			'required' => array(
				array('folio_show_title', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Titles position', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the title\'s position according to the single portfolio item on portfolio page.  There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_title_decoration',
			'type' => 'select',
			'title' => __('Title decoration', 'dfd'),
			'options' => array(
				'none' => __('None', 'dfd'),
				'background' => __('Background', 'dfd'),
				'line' => __('Line', 'dfd'),
				'shadow' => __('Shadow', 'dfd'),
			),
			'default' => '',
			'required' => array(
				array('folio_show_title', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Title decoration', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the styling of portfolio\'s title. There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_title_color',
			'type' => 'color',
			'title' => __('Title decoration color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array(
				array('folio_show_title', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Decoration color', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the decoration color of portfolio\'s title. There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_show_subtitle',
			'type' => 'button_set', //the field type
			'title' => __('Subtitles', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Subtitles', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the portfolio title on portfolio page.  There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_title_deco_bg',
			'type' => 'color',
			'title' => __('Title decoration background', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array(
				array('folio_title_decoration', '=', 'background'),
			),
			'hint' => array(
				'title' => esc_attr__('Decoration background', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the decoration background color of portfolio\'s title. There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_title_deco_line_bg',
			'type' => 'color',
			'title' => __('Title decoration line background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array(
				array('folio_title_decoration', '=', 'line'),
			),
			'hint' => array(
				'title' => esc_attr__('Line background color', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the color of title\'s decoration line. There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_title_deco_shadow',
			'type' => 'color',
			'title' => __('Title decoration shadow color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array(
				array('folio_title_decoration', '=', 'shadow'),
			),
			'hint' => array(
				'title' => esc_attr__('Line background color', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the color of title\'s decoration shadow. There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_show_meta',
			'type' => 'button_set', //the field type
			'title' => __('Meta', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Meta', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide publication date, author\'s name and category of the single portfolio item. There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_show_comments',
			'type' => 'button_set', //the field type
			'title' => __('Comments', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Comments', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the comments count of the single portfolio item. There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_show_likes',
			'type' => 'button_set', //the field type
			'title' => __('Likes', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Likes', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the likes count of the single portfolio item. There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_comments_likes_style',
			'type' => 'select', //the field type
			'title' => __('Comments and like style', 'dfd'),
			'sub_desc' => '',
			'options' => array(
				' ' => __('Always show', 'dfd'),
				'comments-like-hover' => __('Show on hover', 'dfd'),
			),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Comments and like style', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the visibility of comments and likes counter. There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_show_description',
			'type' => 'button_set', //the field type
			'title' => __('Description', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'sub_desc' => '',
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Description', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide description of the single portfolio item. There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_content_alignment',
			'type' => 'select', //the field type
			'title' => __('Content alignment', 'dfd'),
			'sub_desc' => '',
			'options' => array(
				'text-center' => __('Center', 'dfd'),
				'text-left' => __('Left', 'dfd'),
				'text-right' => __('Right', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Content alignment', 'dfd'),
				'content' => esc_attr__('Choose the content position of the single portfolio item. There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_show_read_more_share',
			'type' => 'button_set', //the field type
			'title' => __('Read more and share', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'sub_desc' => '',
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Read more and share', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the Read more and share buttons of the single portfolio item. There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_read_more_style',
			'type' => 'select', //the field type
			'title' => __('Read more style', 'dfd'),
			'sub_desc' => '',
			'options' => array(
				'simple' => __('Simple', 'dfd'),
				'chaffle' => __('Shuffle', 'dfd'),
				'slide-up' => __('Slide up', 'dfd'),
			),
			'default' => 'simple',
			'required' => array(
				array('folio_show_read_more_share', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Read more style', 'dfd'),
				'content' => esc_attr__('Choose one of the preset styles for the Read more button. There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_share_style',
			'type' => 'select', //the field type
			'title' => __('Share style', 'dfd'),
			'sub_desc' => '',
			'options' => array(
				'animated' => __('Animated on hover', 'dfd'),
				'simple' => __('Simple', 'dfd'),
			),
			'default' => 'animated',
			'required' => array(
				array('folio_show_read_more_share', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Share style', 'dfd'),
				'content' => esc_attr__('Choose one of the preset styles for the Share button. There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'porfolio_extra_features',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Extra features', 'dfd') . '</h3>'
		),
		array(
			'id' => 'folio_vc_content_position',
			'type' => 'select',
			'title' => __('Content position', 'dfd'),
			'options' => array(
				'top' => __('Before projects', 'dfd'),
				'bottom' => __('After projects', 'dfd'),
			),
			'default' => 'top',
			'hint' => array(
				'title' => esc_attr__('Content position', 'dfd'),
				'content' => esc_attr__('Display the Visual Composer content above or below the portfolio items. There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
		array(
			'id' => 'folio_item_appear_effect',
			'type' => 'select',
			'title' => __('Items appear effect', 'dfd'),
			'options' => dfd_module_animation_styles('options'),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Appear effect', 'dfd'),
				'content' => esc_attr__('This option allows you to set the unique appear effect for the portfolio items. There is also an option on the item\'s page if you need to change it for single portfolio page', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Single portfolio item options', 'dfd'),
	//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'subsection' => true,
	'icon' => 'crdash-briefcase',
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'folio_single_style',
			'type' => 'select',
			'title' => __('Portfolio style', 'dfd'),
			'options' => array(
				'1' => __('Simple', 'dfd'),
				'2' => __('Advanced', 'dfd'),
			),
			'default' => '1',
			'hint' => array(
				'title' => esc_attr__('Portfolio style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the style for your single portfolio', 'dfd')
			)
		),
		array(
			'id' => 'folio_inside_template',
			'type' => 'select',
			'title' => __('Portfolio template', 'dfd'),
			'options' => array(
				'folio_inside_1' => __('Portfolio inside 1 variant', 'dfd'),
				'folio_inside_2' => __('Portfolio inside 2 variant', 'dfd'),
			),
			'default' => 'folio_inside_1',
			'hint' => array(
				'title' => esc_attr__('Portfolio template', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the portfolio template for the single portfolio items. There is also an option on the item\'s page if you need to change it for single portfolio item', 'dfd')
			)
		),
		array(
			'id' => 'portfolio_single_set',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Layout settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'folio_single_stun_header',
			'type' => 'button_set', //the field type
			'title' => __('Stunning header', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Stunning header', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the stunning header for the single portfolio items. There is also an option on the single item page', 'dfd')
			)
		),
		array(
			'id' => 'folio_single_layout',
			'type' => 'select',
			'title' => __('Layout width', 'dfd'),
			'options' => array(
				'' => __('Boxed', 'dfd'),
				'full_width' => __('Full width', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Layout width', 'dfd'),
				'content' => esc_attr__('This option defines the single portfolio items\' content width. There is also an option on the item\'s page if you need to change it for single portfolio item', 'dfd')
			)
		),
		array(
			'id' => 'folio_gallery_type',
			'type' => 'select',
			'title' => __('Portfolio gallery type', 'dfd'),
			'options' => array(
				'default' => __('Default', 'dfd'),
				'big_images_list' => __('Big images', 'dfd'),
				'middle_image_list' => __('Middle image list', 'dfd'),
				'small_images_list' => __('Small image list', 'dfd'),
				'advanced_gallery' => __('Advanced Gallery', 'dfd'),
			),
			'default' => 'default',
			'hint' => array(
				'title' => esc_attr__('Portfolio template', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the gallery type for your single portfolio. There is also an option on the item\'s page if you need to change it for single portfolio item', 'dfd')
			)
		),
		array(
			'id' => 'folio_layout_type',
			'type' => 'select',
			'title' => __('Layout type', 'dfd'),
			'options' => array(
				'default' => __('Default', 'dfd'),
				'page_builder_only' => __('Page builder only', 'dfd'),
			),
			'default' => 'default',
			'hint' => array(
				'title' => esc_attr__('Layout type', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the layout type for your single portfolio. Choose \'Page builder only\' to create the portfolio with the Visual Composer modules, note only the Visual Composer modules will be displayed. Please do not add VC modules while using \'Default\' layout type. There is also an option on the item\'s page if you need to change it for single portfolio item', 'dfd')
			)
		),
		array(
			'id' => 'portfolio_single_content',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Content settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'folio_description_position',
			'type' => 'select',
			'title' => __('Description position', 'dfd'),
			'options' => array(
				'left' => __('Left', 'dfd'),
				'right' => __('Right', 'dfd'),
				//'top' => __('Top', 'dfd'),
				'bottom' => __('Bottom', 'dfd'),
			),
			'default' => 'left',
			'hint' => array(
				'title' => esc_attr__('Description position', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the position of the portfolio\'s description. There is also an option on the item\'s page if you need to change it for single portfolio item', 'dfd')
			)
		),
		array(
			'id' => 'folio_single_show_title',
			'type' => 'button_set', //the field type
			'title' => __('Titles', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Titles', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the title of the portfolio item. There is also an option on the item\'s page if you need to change it for single portfolio item', 'dfd')
			)
		),
		array(
			'id' => 'folio_single_show_subtitle',
			'type' => 'button_set', //the field type
			'title' => __('Subtitle', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Subtitles', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the subtitle of the portfolio item. There is also an option on the item\'s page if you need to change it for single portfolio item', 'dfd')
			)
		),
		/* array(
		  'id' => 'folio_single_show_meta',
		  'type' => 'button_set', //the field type
		  'title' => __('Enable meta', 'dfd'),
		  'sub_desc' => '',
		  'options' => array('on' => __('On', 'dfd'), '' => __('Off', 'dfd')),
		  'default' => 'on',
		  'required' => array(
		  array('folio_single_style', '=', 'advanced'),
		  ),
		  ), */
		array(
			'id' => 'folio_single_show_read_more_share',
			'type' => 'button_set', //the field type
			'title' => __('Share', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'sub_desc' => '',
			'default' => 'on',
			'required' => array(
				array('folio_single_style', '=', '2'),
			),
			'hint' => array(
				'title' => esc_attr__('Share', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the share buttons of the single portfolio item. There is also an option on the item\'s page if you need to change it for single portfolio item', 'dfd')
			)
		),
		array(
			'id' => 'folio_single_share_style',
			'type' => 'select', //the field type
			'title' => __('Share style', 'dfd'),
			'sub_desc' => '',
			'options' => array(
				'animated' => __('Animated on hover', 'dfd'),
				'simple' => __('Simple', 'dfd'),
			),
			'default' => '',
			'required' => array(
				array('folio_single_show_read_more_share', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Share style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset styles for the Share button. There is also an option on the item\'s page if you need to change it for single portfolio item', 'dfd')
			)
		),
		array(
			'id' => 'folio_single_show_fixed_share',
			'type' => 'button_set', //the field type
			'title' => __('Fixed share', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'sub_desc' => '',
			'default' => 'on',
			'required' => array(
				array('folio_single_style', '=', '2'),
			),
			'hint' => array(
				'title' => esc_attr__('Fixed share', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide fixed share on the single portfolio item\'s page. There is also an option on the item\'s page if you need to change it for single portfolio item', 'dfd')
			)
		),
		array(
			'id' => 'portfolio_single_paging',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Pagination settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'folio_single_enable_pagination',
			'type' => 'button_set', //the field type
			'title' => __('Inside pagination', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'sub_desc' => '',
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Inside pagination', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the inner pagination style for portfolio item. There is also an option on the item\'s page if you need to change it for single portfolio item', 'dfd')
			)
		),
		array(
			'id' => 'folio_single_pagination_style',
			'type' => 'select',
			'title' => __('Pagination position', 'dfd'),
			'options' => array(
				'' => __('Fixed', 'dfd'),
				'top' => __('Top', 'dfd'),
			),
			'default' => '',
			'required' => array(
				array('folio_single_enable_pagination', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Pagination position', 'dfd'),
				'content' => esc_attr__('This option allows you to select the inner pagination style for portfolio item. There is also an option on the item\'s page if you need to change it for single portfolio item', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Portfolio archive page options', 'dfd'),
	//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'subsection' => true,
	'icon' => 'crdash-briefcase',
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'portfolio_archive_set',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Layout settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'archive_folio_layout_style',
			'type' => 'select',
			'title' => __('Layout style', 'dfd'),
			'options' => array(
				false => __('Standard', 'dfd'),
				'masonry' => __('Masonry', 'dfd'),
				'fitRows' => __('Grid', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Layout style', 'dfd'),
				'content' => esc_attr__('Choose the layout style for the portfolio page which will be applied for all the portfolio archive pages by default', 'dfd')
			)
		),
		array(
			'id' => 'archive_folio_columns',
			'type' => 'select',
			'title' => __('Number of columns', 'dfd'),
			'options' => array(
				'1' => __('One', 'dfd'),
				'2' => __('Two', 'dfd'),
				'3' => __('Three', 'dfd'),
				'4' => __('Four', 'dfd'),
				'5' => __('Five', 'dfd'),
			//'6' => __('Six', 'dfd'),
			),
			'default' => '1',
			'required' => array(
				array('archive_folio_layout_style', '!=', false),
			),
		),
		array(
			'id' => 'archive_folio_layout',
			'type' => 'select',
			'title' => __('Layout width', 'dfd'),
			'options' => array(
				'' => __('Boxed', 'dfd'),
				'full_width' => __('Full width', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Layout width', 'dfd'),
				'content' => esc_attr__('This option defines the single portfolio archive pages\' content width', 'dfd')
			)
		),
		array(
			'id' => 'archive_folio_sidebars',
			'type' => 'select',
			'title' => __('Sidebars configuration', 'dfd'),
			'desc' => '',
			'options' => array(
				'' => __('Inherit from single layout settings', 'dfd'),
				'1col-fixed' => __('No sidebars', 'dfd'),
				'2c-l-fixed' => __('Left sidebar', 'dfd'),
				'2c-r-fixed' => __('Right sidebar', 'dfd'),
				'3c-fixed' => __('Both left and right sidebars', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Sidebars configuration', 'dfd'),
				'content' => esc_attr__('Allows you to choose sidebars and their position', 'dfd')
			)
		),
		array(
			'id' => 'archive_folio_stun_header',
			'type' => 'button_set', //the field type
			'title' => __('Stunning header', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Stunning header', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the stunning header for the portfolio archive pages', 'dfd')
			)
		),
		array(
			'id' => 'archive_folio_cat_tag',
			'type' => 'button_set', //the field type
			'title' => __('Categories, tags and author dropdown', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Categories and tags dropdown', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide categories, tags and author drop-down sorter before portfolio items on archive pages', 'dfd')
			)
		),
		array(
			'id' => 'portolio_archive_content',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Content settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'archive_folio_show_title',
			'type' => 'button_set', //the field type
			'title' => __('Titles', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Titles', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the title of the portfolio item', 'dfd')
			)
		),
		array(
			'id' => 'archive_folio_title_position',
			'type' => 'select',
			'title' => __('Title position', 'dfd'),
			'options' => array(
				'under' => __('Under the image', 'dfd'),
				'front' => __('In front of the image', 'dfd'),
			),
			'default' => '',
			'required' => array(
				array('archive_folio_show_title', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Titles position', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the title\'s position according to the single portfolio item on portfolio archive pages', 'dfd')
			)
		),
		array(
			'id' => 'archive_folio_title_decoration',
			'type' => 'select',
			'title' => __('Title decoration', 'dfd'),
			'options' => array(
				'none' => __('None', 'dfd'),
				'background' => __('Background', 'dfd'),
				'line' => __('Line', 'dfd'),
				'shadow' => __('Shadow', 'dfd'),
			),
			'default' => '',
			'required' => array(
				array('archive_folio_show_title', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Title decoration', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the styling of portfolio\'s title', 'dfd')
			)
		),
		array(
			'id' => 'archive_folio_title_color',
			'type' => 'color',
			'title' => __('Title decoration color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array(
				array('archive_folio_show_title', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Decoration color', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the decoration color of portfolio\'s title', 'dfd')
			)
		),
		array(
			'id' => 'archive_folio_show_subtitle',
			'type' => 'button_set', //the field type
			'title' => __('Subtitles', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Subtitles', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the subtitle of the portfolio item', 'dfd')
			)
		),
		array(
			'id' => 'archive_folio_title_deco_bg',
			'type' => 'color',
			'title' => __('Title decoration background', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array(
				array('archive_folio_title_decoration', '=', 'background'),
			),
			'hint' => array(
				'title' => esc_attr__('Decoration background', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the decoration background color of portfolio\'s title', 'dfd')
			)
		),
		array(
			'id' => 'archive_folio_title_deco_line_bg',
			'type' => 'color',
			'title' => __('Title decoration line background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array(
				array('archive_folio_title_decoration', '=', 'line'),
			),
			'hint' => array(
				'title' => esc_attr__('Line background color', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the color of title\'s decoration line', 'dfd')
			)
		),
		array(
			'id' => 'archive_folio_title_deco_shadow',
			'type' => 'color',
			'title' => __('Title decoration shadow color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array(
				array('archive_folio_title_decoration', '=', 'shadow'),
			),
			'hint' => array(
				'title' => esc_attr__('Line background color', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the color of title\'s decoration shadow', 'dfd')
			)
		),
		array(
			'id' => 'archive_folio_show_meta',
			'type' => 'button_set', //the field type
			'title' => __('Meta', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Meta', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide publication date, author\'s name and category of the single portfolio item on portfolio archive pages', 'dfd')
			)
		),
		array(
			'id' => 'archive_folio_show_comments',
			'type' => 'button_set', //the field type
			'title' => __('Comments', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Comments', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the comments count of the single portfolio item on portfolio archive pages', 'dfd')
			)
		),
		array(
			'id' => 'archive_folio_show_likes',
			'type' => 'button_set', //the field type
			'title' => __('Likes', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Likes', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the likes count of the single portfolio item on portfolio archive pages', 'dfd')
			)
		),
		array(
			'id' => 'archive_folio_show_description',
			'type' => 'button_set', //the field type
			'title' => __('Description', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Description', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide descrition of the single portfolio item on portfolio archive pages', 'dfd')
			)
		),
		array(
			'id' => 'archive_folio_content_alignment',
			'type' => 'select', //the field type
			'title' => __('Content alignment', 'dfd'),
			'options' => array(
				'text-center' => __('Center', 'dfd'),
				'text-left' => __('Left', 'dfd'),
				'text-right' => __('Right', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Content alignment', 'dfd'),
				'content' => esc_attr__('Choose the content position of the single portfolio item on portfolio archive pages', 'dfd')
			)
		),
		array(
			'id' => 'archive_folio_show_read_more_share',
			'type' => 'button_set', //the field type
			'title' => __('Read more and share', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Read more and share', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the Read more and share buttons of the single portfolio item on portfolio archive pages', 'dfd')
			)
		),
		array(
			'id' => 'archive_folio_read_more_style',
			'type' => 'select', //the field type
			'title' => __('Read more style', 'dfd'),
			'options' => array(
				'simple' => __('Simple', 'dfd'),
				'chaffle' => __('Shuffle', 'dfd'),
				'slide-up' => __('Slide up', 'dfd'),
			),
			'default' => 'simple',
			'required' => array(
				array('archive_folio_show_read_more_share', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Read more style', 'dfd'),
				'content' => esc_attr__('Choose one of the preset styles for the Read more button on portfolio archive pages', 'dfd')
			)
		),
		array(
			'id' => 'archive_folio_share_style',
			'type' => 'select', //the field type
			'title' => __('Share style', 'dfd'),
			'options' => array(
				'animated' => __('Animated on hover', 'dfd'),
				'simple' => __('Simple', 'dfd'),
			),
			'default' => 'animated',
			'required' => array(
				array('archive_folio_show_read_more_share', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Share style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset styles for the Share button on portfolio archive pages', 'dfd')
			)
		),
		array(
			'id' => 'archive_folio_items_offset',
			'type' => 'text',
			'title' => __('Portfolio items offset (in px)', 'dfd'),
			'validate' => 'numeric',
			'default' => '',
			/* 'required' => array(
			  array('archive_folio_single_type', 'not_empty_and', 'masonry'),
			  ), */
			'hint' => array(
				'title' => esc_attr__('Items offset', 'dfd'),
				'content' => esc_attr__('This option allows you to add space between single portfolio items, don\'t include "px"', 'dfd')
			)
		),
		array(
			'id' => 'portfolio_archive_extra',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Extra features', 'dfd') . '</h3>'
		),
		array(
			'id' => 'archive_folio_item_appear_effect',
			'type' => 'select',
			'title' => __('Items appear effect', 'dfd'),
			'options' => dfd_module_animation_styles('options'),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Appear effect', 'dfd'),
				'content' => esc_attr__('This option allows you to set the unique appear effect for the portfolio items on portfolio archive pages', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Portfolio hover options', 'dfd'),
	//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'subsection' => true,
	'icon' => 'crdash-briefcase',
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'folio_hover_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Main hover settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'folio_hover_style_group',
			'type' => 'select',
			'title' => __('Hover style group', 'dfd'),
			'options' => array(
				'custom' => __('Advanced customizable hover', 'dfd'),
				'entry' => __('Pre-built hovers &#40old version&#41', 'dfd')
			),
			'default' => 'custom',
			'hint' => array(
				'title' => esc_attr__('Hover style group', 'dfd'),
				'content' => esc_attr__('This option allows you to choose preset hover or customize your own. ', 'dfd')
			)
		),
		array(
			'id' => 'folio_hover_appear_effect',
			'type' => 'select',
			'title' => __('Appear effect', 'dfd'),
			'options' => array(
				'dfd-fade-out' => __('Fade out', 'dfd'),
				'dfd-fade-offset' => __('Fade out with offset', 'dfd'),
				'dfd-left-to-right' => __('From left to right', 'dfd'),
				'dfd-right-to-left' => __('From right to left', 'dfd'),
				'dfd-top-to-bottom' => __('From top to bottom', 'dfd'),
				'dfd-bottom-to-top' => __('From bottom to top', 'dfd'),
				'dfd-left-to-right-shift' => __('From left to right shift image', 'dfd'),
				'dfd-right-to-left-shift' => __('From right to left shift image', 'dfd'),
				'dfd-top-to-bottom-shift' => __('From top to bottom shift image', 'dfd'),
				'dfd-bottom-to-top-shift' => __('From bottom to top shift image', 'dfd'),
				'portfolio-hover-style-1' => __('Following the mouse', 'dfd'),
				'dfd-rotate-content-up' => __('Rotate content up', 'dfd'),
				'dfd-rotate-content-down' => __('Rotate content down', 'dfd'),
				'dfd-rotate-left' => __('Rotate left', 'dfd'),
				'dfd-rotate-right' => __('Rotate right', 'dfd'),
				'dfd-rotate-top' => __('Rotate top', 'dfd'),
				'dfd-rotate-bottom' => __('Rotate bottom', 'dfd'),
			),
			'default' => 'dfd-fade-out',
			'required' => array(
				array('folio_hover_style_group', '=', 'custom'),
			),
			'hint' => array(
				'title' => esc_attr__('Appear effect', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset appear animations for the portfolio items', 'dfd')
			)
		),
		array(
			'id' => 'folio_hover_image_effect',
			'type' => 'select',
			'title' => __('Image effect', 'dfd'),
			'options' => array(
				'panr' => __('Image parallax', 'dfd'),
				'dfd-image-scale' => __('Grow', 'dfd'),
				'dfd-image-scale-rotate' => __('Grow with rotation', 'dfd'),
				'dfd-image-shift-left' => __('Shift left', 'dfd'),
				'dfd-image-shift-right' => __('Shift right', 'dfd'),
				'dfd-image-shift-top' => __('Shift top', 'dfd'),
				'dfd-image-shift-bottom' => __('Shift bottom', 'dfd'),
				'dfd-image-blur' => __('Blur', 'dfd'),
			),
			'default' => '',
			'required' => array(
				array('folio_hover_appear_effect', '!=', 'dfd-left-to-right-shift'),
				array('folio_hover_appear_effect', '!=', 'dfd-right-to-left-shift'),
				array('folio_hover_appear_effect', '!=', 'dfd-top-to-bottom-shift'),
				array('folio_hover_appear_effect', '!=', 'dfd-bottom-to-top-shift'),
				array('folio_hover_appear_effect', '!=', 'dfd-rotate-left'),
				array('folio_hover_appear_effect', '!=', 'dfd-rotate-right'),
				array('folio_hover_appear_effect', '!=', 'dfd-rotate-top'),
				array('folio_hover_appear_effect', '!=', 'dfd-rotate-bottom'),
			),
			'hint' => array(
				'title' => esc_attr__('Image effect', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset animations for the images', 'dfd')
			)
		),
		array(
			'id' => 'folio_hover_decor',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Hover decoration settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'folio_hover_main_dedcoration',
			'type' => 'select',
			'title' => __('Main decoration', 'dfd'),
			'options' => array(
				'none' => __('None', 'dfd'),
				'heading' => __('Heading', 'dfd'),
				'plus' => __('Plus', 'dfd'),
				'lines' => __('Lines', 'dfd'),
				'dots' => __('Dots', 'dfd'),
			),
			'default' => 'custom',
			'required' => array(
				array('folio_hover_style_group', '=', 'custom'),
			),
			'hint' => array(
				'title' => esc_attr__('Main decoration', 'dfd'),
				'content' => esc_attr__('This option allows you to set the decoration which will be displayed on hover', 'dfd')
			)
		),
		array(
			'id' => 'folio_hover_title_dedcoration',
			'type' => 'select',
			'title' => __('Heading decoration', 'dfd'),
			'options' => array(
				'title-deco-none' => __('None', 'dfd'),
				'diagonal-line' => __('Diagonal line', 'dfd'),
				'title-underline' => __('Title underline', 'dfd'),
				'square-behind-heading' => __('Square behind heading', 'dfd'),
			),
			'default' => 'custom',
			'required' => array(
				array('folio_hover_main_dedcoration', '=', 'heading'),
			),
			'hint' => array(
				'title' => esc_attr__('Heading decoration', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the style for the heading hover decoration', 'dfd')
			)
		),
		array(
			'id' => 'folio_hover_show_title',
			'type' => 'button_set', //the field type
			'title' => __('Titles', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'required' => array(
				array('folio_hover_main_dedcoration', '=', 'heading'),
			),
			'hint' => array(
				'title' => esc_attr__('Title', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the title of the portfolio item on hover', 'dfd')
			)
		),
		array(
			'id' => 'folio_hover_show_subtitle',
			'type' => 'button_set', //the field type
			'title' => __('Subtitle', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'required' => array(
				array('folio_hover_main_dedcoration', '=', 'heading'),
			),
			'hint' => array(
				'title' => esc_attr__('Subtitle', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the subtitle of the portfolio item on hover', 'dfd')
			)
		),
		array(
			'id' => 'folio_hover_plus_position',
			'type' => 'select',
			'title' => __('Plus position', 'dfd'),
			'options' => array(
				'dfd-middle' => __('Middle of the project', 'dfd'),
				'dfd-top-right' => __('Top right corner', 'dfd'),
				'dfd-top-left' => __('Top left corner', 'dfd'),
				'dfd-bottom-right' => __('Bottom right corner', 'dfd'),
				'dfd-bottom-left' => __('Bottom left corner', 'dfd'),
			),
			'default' => 'custom',
			'required' => array(
				array('folio_hover_main_dedcoration', '=', 'plus'),
			),
			'hint' => array(
				'title' => esc_attr__('Plus position', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the Plus decoration position', 'dfd')
			)
		),
		array(
			'id' => 'folio_hover_plus_bg',
			'type' => 'color',
			'title' => __('Plus background', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array(
				array('folio_hover_plus_position', 'not_empty_and', 'dfd-middle'),
			),
			'hint' => array(
				'title' => esc_attr__('Plus background', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the Plus decoration\'s background', 'dfd')
			)
		),
		array(
			'id' => 'folio_hover_show_ext_link',
			'type' => 'button_set', //the field type
			'title' => __('External link button', 'dfd'),
			'sub_desc' => __('This field requirest Button URL options to be specified for portfolio items to show subtitle correctly', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'required' => array(
				array('folio_hover_style_group', '=', 'custom'),
			),
			'hint' => array(
				'title' => esc_attr__('External link', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the external link button on hover', 'dfd')
			)
		),
		array(
			'id' => 'folio_hover_show_quick_view',
			'type' => 'button_set', //the field type
			'title' => __('Quick view', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'required' => array(
				array('folio_hover_style_group', '=', 'custom'),
			),
			'hint' => array(
				'title' => esc_attr__('Quick view', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide quick view button on hover', 'dfd')
			)
		),
		array(
			'id' => 'folio_hover_show_lightbox',
			'type' => 'button_set', //the field type
			'title' => __('Lightbox button', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'required' => array(
				array('folio_hover_style_group', '=', 'custom'),
			),
			'hint' => array(
				'title' => esc_attr__('Lightbox', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide lightbox button on hover', 'dfd')
			)
		),
		array(
			'id' => 'hover_subtitle_text',
			'type' => 'select',
			'title' => __('Subtitle text', 'dfd'),
			'options' => array(
				'' => __('Categories', 'dfd'),
				'1' => __('Single item subtitle', 'dfd')
			),
			'default' => '',
			'required' => array(
				array('folio_hover_style_group', '=', 'entry'),
			),
			'hint' => array(
				'title' => esc_attr__('Subtitle text', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the text to be shown as the portfolio subtitle on hover', 'dfd')
			)
		),
		array(
			'id' => 'folio_hover_style',
			'type' => 'select',
			'title' => __('Hover style', 'dfd'),
			'options' => array(
				'portfolio-hover-style-1' => __('Style 1', 'dfd'),
				'portfolio-hover-style-2' => __('Style 2', 'dfd'),
				'portfolio-hover-style-3' => __('Style 3', 'dfd'),
				'portfolio-hover-style-4' => __('Style 4', 'dfd'),
				'portfolio-hover-style-5' => __('Style 5', 'dfd'),
				'portfolio-hover-style-6' => __('Style 6', 'dfd'),
				'portfolio-hover-style-7' => __('Style 7', 'dfd'),
				'portfolio-hover-style-8' => __('Style 8', 'dfd'),
				'portfolio-hover-style-9' => __('Style 9', 'dfd'),
				'portfolio-hover-style-10' => __('Style 10', 'dfd'),
				'portfolio-hover-style-11' => __('Style 11', 'dfd'),
				'portfolio-hover-style-12' => __('Style 12', 'dfd'),
				'portfolio-hover-style-13' => __('Style 13', 'dfd'),
				'portfolio-hover-style-14' => __('Style 14', 'dfd'),
				'portfolio-hover-style-15' => __('Style 15', 'dfd'),
				'portfolio-hover-style-16' => __('Style 16', 'dfd'),
				'portfolio-hover-style-17' => __('Style 17', 'dfd'),
				'portfolio-hover-style-18' => __('Style 18', 'dfd'),
				'portfolio-hover-style-19' => __('Style 19', 'dfd'),
				'portfolio-hover-style-20' => __('Style 20', 'dfd'),
				'portfolio-hover-style-21' => __('Style 21', 'dfd'),
				'portfolio-hover-style-22' => __('Style 22', 'dfd'),
				'portfolio-hover-style-23' => __('Style 23', 'dfd'),
				'portfolio-hover-style-24' => __('Style 24', 'dfd'),
			),
			'default' => '',
			'required' => array(
				array('folio_hover_style_group', '=', 'entry'),
			),
			'hint' => array(
				'title' => esc_attr__('Hover style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the 24 preset hover styles', 'dfd')
			)
		),
		array(
			'id' => 'folio_hover_colors',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Hover color settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'folio_hover_text_color',
			'type' => 'color',
			'title' => __('Text hover color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Text color', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the text of the elements on hover', 'dfd')
			)
		),
		array(
			'id' => 'folio_hover_mask_style',
			'type' => 'select',
			'title' => __('Hover mask background style', 'dfd'),
			'options' => array(
				'simple' => __('Simple color', 'dfd'),
				'gradient' => __('Gradient', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Hover mask background style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the mask background style, you can choose simple color or gradient', 'dfd')
			)
		),
		array(
			'id' => 'folio_hover_bg',
			'type' => 'color',
			'title' => __('Mask background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array(
				'folio_hover_mask_style', "=", 'simple'
			),
			'hint' => array(
				'title' => esc_attr__('Mask background', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the mask background color', 'dfd')
			)
		),
		array(
			'id' => 'folio_hover_bg_gradient',
			'type' => 'color_gradient',
			'title' => __('Mask background gradient', 'dfd'),
			'default' => array(
				'from' => '',
				'to' => '',
			),
			'validate' => 'color',
			'required' => array(
				'folio_hover_mask_style', "=", 'gradient'
			),
			'hint' => array(
				'title' => esc_attr__('Mask background gradient', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the start and end colors for the mask background gradient', 'dfd')
			)
		),
		array(
			'id' => 'folio_hover_bg_opacity',
			'type' => 'slider',
			'title' => __('Background opacity', 'dfd'),
			'min' => '1',
			'max' => '100',
			'step' => '1',
			'default' => '70',
			'hint' => array(
				'title' => esc_attr__('Background opacity', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the opacity for the portfolios\' hover background', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => esc_html__('Gallery options', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'icon' => 'crdash-photos_alt',
	//Lets leave this as a blank section, no options just some intro text set above.
));
Redux::setSection($opt_name, array(
	'title' => __('Base gallery options', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'subsection' => true,
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'gallery_base',
			'type' => 'info',
			'desc' => '<h3 class="description">' . __('Base gallery options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'dfd_gallery_top_link_src',
			'type' => 'select',
			'title' => __('Gallery top link source', 'dfd'),
			'options' => array(
				'page' => __('Page', 'dfd'),
				'url' => __('Custom url', 'dfd'),
			),
			'default' => 'chaffle',
			'hint' => array(
				'title' => esc_attr__('Link source', 'dfd'),
				'content' => esc_attr__('This option allows you to set the page or custom link which will be used for the button placed next to the categories and tags dropdown on pages with "Gallery page template"', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_top_page_select',
			'type' => 'select',
			'data' => 'pages',
			'title' => __('Gallery page', 'dfd'),
			'required' => array(
				array('dfd_gallery_top_link_src', '=', 'page'),
			),
			'hint' => array(
				'title' => esc_attr__('Gallery page', 'dfd'),
				'content' => esc_attr__('Select the page which will be used as main gallery page', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_top_page_url',
			'type' => 'text',
			'title' => __('Gallery page url', 'dfd'),
			'validate' => 'url',
			'required' => array(
				array('dfd_gallery_top_link_src', '=', 'url'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Gallery page URL', 'dfd'),
				'content' => esc_attr__('Set the portfolio page URL which will be used as main gallery page', 'dfd')
			)
		),
		array(
			'id' => 'gallery_archive_set',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Layout settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'dfd_gallery_layout',
			'type' => 'select',
			'title' => __('Layout width', 'dfd'),
			'options' => array(
				'boxed' => __('Boxed', 'dfd'),
				'full-width' => __('Full width', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Layout width', 'dfd'),
				'content' => esc_attr__('This option defines the gallery page\'s content width. There is also an option on the item\'s page if you need to change it for single gallery page', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_layout_style',
			'type' => 'select',
			'title' => __('Layout style', 'dfd'),
			'options' => array(
				false => __('Standard', 'dfd'),
				'masonry' => __('Masonry', 'dfd'),
				'fitRows' => __('Grid', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Layout style', 'dfd'),
				'content' => esc_attr__('Choose the layout style for the gallery page which will be applied for all the gallery pages by default.  There is also an option on the item\'s page if you need to change it for single gallery page', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_columns',
			'type' => 'select',
			'title' => __('Number of columns', 'dfd'),
			'options' => array(
				'1' => __('One', 'dfd'),
				'2' => __('Two', 'dfd'),
				'3' => __('Three', 'dfd'),
				'4' => __('Four', 'dfd'),
				'5' => __('Five', 'dfd'),
			//'6' => __('Six', 'dfd'),
			),
			'default' => '1',
			'required' => array(
				array('dfd_gallery_layout_style', '!=', false),
			),
		),
		array(
			'id' => 'dfd_gallery_sidebars',
			'type' => 'select',
			'title' => __('Sidebars configuration', 'dfd'),
			'options' => array(
				'' => __('Inherit from single layout settings', 'dfd'),
				'1col-fixed' => __('No sidebars', 'dfd'),
				'2c-l-fixed' => __('Left sidebar', 'dfd'),
				'2c-r-fixed' => __('Right sidebar', 'dfd'),
				'3c-fixed' => __('Both left and right sidebars', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Sidebars configuration', 'dfd'),
				'content' => esc_attr__('Allows you to choose sidebars and their position. There is also an option on the item\'s page if you need to change it for single gallery page', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_stun_header',
			'type' => 'button_set', //the field type
			'title' => __('Stunning header', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Stunning header', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the stunning header for the gallery pages. There is also an option on the item\'s page if you need to change it for single gallery page', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_cat_tag',
			'type' => 'button_set', //the field type
			'title' => __('Categories, tags and author dropdown', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Categories and tags dropdown', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide categories, tags and author drop-down sorter before galleries items on gallery pages. There is also an option on the item\'s page if you need to change it for single gallery page', 'dfd')
			)
		),
		array(
			'id' => 'gallery_content',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Content settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'dfd_gallery_content_alignment',
			'type' => 'select', //the field type
			'title' => __('Content alignment', 'dfd'),
			'sub_desc' => '',
			'options' => array(
				'text-center' => __('Center', 'dfd'),
				'text-left' => __('Left', 'dfd'),
				'text-right' => __('Right', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Content alignment', 'dfd'),
				'content' => esc_attr__('Choose the content position of the single gallery item on portfolio gallery pages. There is also an option on the item\'s page if you need to change it for single gallery page', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_items_offset',
			'type' => 'text',
			'title' => __('Gallery items offset (in px)', 'dfd'),
			'validate' => 'numeric',
			'default' => '',
			/* 'required' => array(
			  array('dfd_gallery_single_type', 'not_empty_and', 'masonry'),
			  ), */
			'hint' => array(
				'title' => esc_attr__('Items offset', 'dfd'),
				'content' => esc_attr__('This option allows you to add space between single gallery items, don\'t include "px". There is also an option on the item\'s page if you need to change it for single gallery page', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_show_title',
			'type' => 'button_set',
			'title' => __('Titles', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'off',
			'hint' => array(
				'title' => esc_attr__('Title', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the title of the gallery item. There is also an option on the item\'s page if you need to change it for single gallery page', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_show_subtitle',
			'type' => 'button_set',
			'title' => __('Subtitles', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'off',
			'hint' => array(
				'title' => esc_attr__('Subtitle', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the subtitle of the gallery item. There is also an option on the item\'s page if you need to change it for single gallery page', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_title_position',
			'type' => 'select',
			'title' => __('Heading position', 'dfd'),
			'options' => array(
				'top' => __('Over the image', 'dfd'),
				'bottom' => __('Under the image', 'dfd'),
			),
			'default' => '',
			'required' => array(
				array('dfd_gallery_show_title', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Heading position', 'dfd'),
				'content' => esc_attr__('This option allows you to choose heading position on gallery page. There is also an option on the item\'s page if you need to change it for single gallery page', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_show_comments',
			'type' => 'button_set', //the field type
			'title' => __('Comments', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Comments', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the comments count of the single gallery item on gallery pages. There is also an option on the item\'s page if you need to change it for single gallery page', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_show_likes',
			'type' => 'button_set', //the field type
			'title' => __('Likes', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Comments', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the likes count of the single gallery item on gallery pages. There is also an option on the item\'s page if you need to change it for single gallery page', 'dfd')
			)
		),
		array(
			'id' => 'gallery_extra_features',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Extra features', 'dfd') . '</h3>'
		),
		array(
			'id' => 'dfd_gallery_item_appear_effect',
			'type' => 'select',
			'title' => __('Items appear effect', 'dfd'),
			'options' => dfd_module_animation_styles('options'),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Appear effect', 'dfd'),
				'content' => esc_attr__('This option allows you to set the unique appear effect for the gallery items on gallery pages. There is also an option on the item\'s page if you need to change it for single gallery page', 'dfd')
			)
		),
	/* array(
	  'id' => 'dfd_gallery_top_page_select',
	  'type'     => 'select',
	  'data'     => 'pages',
	  'title' => __('Gallery page select', 'dfd'),
	  'desc' => __('Please select main gallery page', 'dfd'),
	  ), */
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Single gallery item options', 'dfd'),
	//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'subsection' => true,
	'icon' => 'crdash-photos_alt',
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'gallry_single_set',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Layout settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'dfd_gallery_single_layout',
			'type' => 'select',
			'title' => __('Layout width', 'dfd'),
			'options' => array(
				'' => __('Boxed', 'dfd'),
				'full-width' => __('Full width', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Layout width', 'dfd'),
				'content' => esc_attr__('This option defines the single gallery items\' content width', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_single_type',
			'type' => 'select',
			'title' => __('Layout style', 'dfd'),
			'options' => array(
				'carousel' => __('Carousel', 'dfd'),
				'masonry' => __('Masonry', 'dfd'),
				'fitRows' => __('Grid', 'dfd'),
				'advanced-gallery' => __('Advanced gallery', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Layout style', 'dfd'),
				'content' => esc_attr__('Choose the layout style for the gallery item which will be applied for all the gallery items by default.  There is also an option on the item\'s page if you need to change it for single gallery item', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_single_columns',
			'type' => 'select',
			'title' => __('Number of columns', 'dfd'),
			'options' => array(
				'1' => __('One', 'dfd'),
				'2' => __('Two', 'dfd'),
				'3' => __('Three', 'dfd'),
				'4' => __('Four', 'dfd'),
				'5' => __('Five', 'dfd'),
			//'6' => __('Six', 'dfd'),
			),
			'default' => '1',
			'required' => array(
				array('dfd_gallery_single_type', 'not_empty_and', 'carousel'),
			),
		),
		array(
			'id' => 'dfd_gallery_single_sidebars',
			'type' => 'select',
			'title' => __('Sidebars configuration', 'dfd'),
			'options' => array(
				'' => __('Inherit from single layout settings', 'dfd'),
				'1col-fixed' => __('No sidebars', 'dfd'),
				'2c-l-fixed' => __('Left sidebar', 'dfd'),
				'2c-r-fixed' => __('Right sidebar', 'dfd'),
				'3c-fixed' => __('Both left and right sidebars', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Sidebars configuration', 'dfd'),
				'content' => esc_attr__('Allows you to choose sidebars and their position. There is also an option on the item\'s page if you need to change it for single gallery item', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_single_stun_header',
			'type' => 'button_set', //the field type
			'title' => __('Stunning header', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Stunning header', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the stunning header for the single gallery items', 'dfd')
			)
		),
		array(
			'id' => 'gallery_single_content',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Content settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'dfd_gallery_single_show_title',
			'type' => 'button_set',
			'title' => __('Titles', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'off',
			'hint' => array(
				'title' => esc_attr__('Title', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the title of the gallery item. There is also an option on the item\'s page if you need to change it for single gallery item', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_single_show_meta',
			'type' => 'button_set',
			'title' => __('Subtitle', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'off',
			'hint' => array(
				'title' => esc_attr__('Subtitle', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the subtitle of the gallery item. There is also an option on the item\'s page if you need to change it for single gallery item', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_single_items_offset',
			'type' => 'text',
			'title' => __('Gallery items offset (in px)', 'dfd'),
			'validate' => 'numeric',
			'default' => '',
			/* 'required' => array(
			  array('dfd_gallery_single_type', 'not_empty_and', 'masonry'),
			  ), */
			'hint' => array(
				'title' => esc_attr__('Items offset', 'dfd'),
				'content' => esc_attr__('This option allows you to add space between gallery images, don\'t include "px". There is also an option on the item\'s page if you need to change it for single gallery item', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_single_autoplay',
			'type' => 'button_set', //the field type
			'title' => __('Autoslideshow', 'dfd'),
			'sub_desc' => '',
			'options' => array('true' => __('On', 'dfd'), 'false' => __('Off', 'dfd')),
			'default' => 'true', //this should be the key as defined above
			'required' => array(
				array('dfd_gallery_single_type', "=", 'carousel'),
			),
			'hint' => array(
				'title' => esc_attr__('Autoslideshow', 'dfd'),
				'content' => esc_attr__('This option allows you to add enable or disable the autoslideshow for the single gallery item. There is also an option on the item\'s page if you need to change it for single gallery item', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_single_slideshow_speed',
			'type' => 'text',
			'title' => __('Slideshow speed', 'dfd'),
			'validate' => 'numeric',
			'default' => '3000',
			'required' => array(
				array('dfd_gallery_single_type', "=", 'carousel'),
			),
			'hint' => array(
				'title' => esc_attr__('Slideshow speed', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the speed of the autoslideshow for the single gallery item. There is also an option on the item\'s page if you need to change it for single gallery item', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_single_image_width',
			'type' => 'text',
			'title' => __('Gallery image width (px)', 'dfd'),
			'validate' => 'numeric',
			'default' => '900',
			'required' => array(
				array('dfd_gallery_single_type', 'not_empty_and', 'masonry'),
			),
			'hint' => array(
				'title' => esc_attr__('Image width', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the image width in px for the single gallery item. Please do not include "px". There is also an option on the item\'s page if you need to change it for single gallery item', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_single_image_height',
			'type' => 'text',
			'title' => __('Gallery image height (px)', 'dfd'),
			'validate' => 'numeric',
			'default' => '600',
			'required' => array(
				array('dfd_gallery_single_type', 'not_empty_and', 'masonry'),
			),
			'hint' => array(
				'title' => esc_attr__('Image height', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the image height in px for the single gallery item. Please do not include "px". There is also an option on the item\'s page if you need to change it for single gallery item', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_single_show_read_more_share',
			'type' => 'button_set', //the field type
			'title' => __('Share', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'sub_desc' => '',
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Share', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the share buttons of the single gallery item. There is also an option on the item\'s page if you need to change it for single gallery item', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_single_share_style',
			'type' => 'select', //the field type
			'title' => __('Share style', 'dfd'),
			'sub_desc' => '',
			'options' => array(
				'animated' => __('Animated on hover', 'dfd'),
				'simple' => __('Simple', 'dfd'),
			),
			'default' => '',
			'required' => array(
				array('dfd_gallery_single_show_read_more_share', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Share style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset styles for the Share button on single gallery item\'s page', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_single_show_fixed_share',
			'type' => 'button_set', //the field type
			'title' => __('Fixed Share', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'sub_desc' => '',
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Fixed share', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide fixed share on the single gallery item\'s page. There is also an option on the item\'s page if you need to change it for single gallery item', 'dfd')
			)
		),
		array(
			'id' => 'gallery_single_paging',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Pagination settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'dfd_gallery_single_enable_pagination',
			'type' => 'button_set', //the field type
			'title' => __('Inside pagination', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'sub_desc' => '',
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Inside pagination', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the inner pagination style for gallery item. There is also an option on the item\'s page if you need to change it for single gallery item', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_single_pagination_style',
			'type' => 'select',
			'title' => __('Pagination position', 'dfd'),
			'options' => array(
				'' => __('Fixed', 'dfd'),
				'top' => __('Top', 'dfd'),
			),
			'default' => '',
			'required' => array(
				array('dfd_gallery_single_enable_pagination', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Pagination position', 'dfd'),
				'content' => esc_attr__('This option allows you to select the inner pagination style for gallery item. There is also an option on the item\'s page if you need to change it for single gallery item', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Gallery hover options', 'dfd'),
	//'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'subsection' => true,
	'icon' => 'crdash-photos_alt',
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'gallery_hover_options',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Main hover settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'dfd_gallery_hover_appear_effect',
			'type' => 'select',
			'title' => __('Appear effect', 'dfd'),
			'options' => array(
				'dfd-fade-out' => __('Fade out', 'dfd'),
				'dfd-fade-offset' => __('Fade out with offset', 'dfd'),
				'dfd-left-to-right' => __('From left to right', 'dfd'),
				'dfd-right-to-left' => __('From right to left', 'dfd'),
				'dfd-top-to-bottom' => __('From top to bottom', 'dfd'),
				'dfd-bottom-to-top' => __('From bottom to top', 'dfd'),
				'dfd-left-to-right-shift' => __('From left to right shift image', 'dfd'),
				'dfd-right-to-left-shift' => __('From right to left shift image', 'dfd'),
				'dfd-top-to-bottom-shift' => __('From top to bottom shift image', 'dfd'),
				'dfd-bottom-to-top-shift' => __('From bottom to top shift image', 'dfd'),
				'portfolio-hover-style-1' => __('Following the mouse', 'dfd'),
				'dfd-rotate-content-up' => __('Rotate content up', 'dfd'),
				'dfd-rotate-content-down' => __('Rotate content down', 'dfd'),
				'dfd-rotate-left' => __('Rotate left', 'dfd'),
				'dfd-rotate-right' => __('Rotate right', 'dfd'),
				'dfd-rotate-top' => __('Rotate top', 'dfd'),
				'dfd-rotate-bottom' => __('Rotate bottom', 'dfd'),
			),
			'default' => 'dfd-fade-out',
			'hint' => array(
				'title' => esc_attr__('Appear effect', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset appear animations for the gallery items', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_hover_image_effect',
			'type' => 'select',
			'title' => __('Image effect', 'dfd'),
			'options' => array(
				'panr' => __('Image parallax', 'dfd'),
				'dfd-image-scale' => __('Grow', 'dfd'),
				'dfd-image-scale-rotate' => __('Grow with rotation', 'dfd'),
				'dfd-image-shift-left' => __('Shift left', 'dfd'),
				'dfd-image-shift-right' => __('Shift right', 'dfd'),
				'dfd-image-shift-top' => __('Shift top', 'dfd'),
				'dfd-image-shift-bottom' => __('Shift bottom', 'dfd'),
				'dfd-image-blur' => __('Blur', 'dfd'),
			),
			'default' => '',
			'required' => array(
				array('dfd_gallery_hover_appear_effect', '!=', 'dfd-left-to-right-shift'),
				array('dfd_gallery_hover_appear_effect', '!=', 'dfd-right-to-left-shift'),
				array('dfd_gallery_hover_appear_effect', '!=', 'dfd-top-to-bottom-shift'),
				array('dfd_gallery_hover_appear_effect', '!=', 'dfd-bottom-to-top-shift'),
				array('dfd_gallery_hover_appear_effect', '!=', 'dfd-rotate-left'),
				array('dfd_gallery_hover_appear_effect', '!=', 'dfd-rotate-right'),
				array('dfd_gallery_hover_appear_effect', '!=', 'dfd-rotate-top'),
				array('dfd_gallery_hover_appear_effect', '!=', 'dfd-rotate-bottom'),
			),
			'hint' => array(
				'title' => esc_attr__('Image effect', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset animations for the images', 'dfd')
			)
		),
		array(
			'id' => 'gallery_hover_decor',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Hover decoration settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'dfd_gallery_hover_main_dedcoration',
			'type' => 'select',
			'title' => __('Main decoration', 'dfd'),
			'options' => array(
				'none' => __('None', 'dfd'),
				'heading' => __('Heading', 'dfd'),
				'plus' => __('Plus', 'dfd'),
				'lines' => __('Lines', 'dfd'),
				'dots' => __('Dots', 'dfd'),
			),
			'default' => 'custom',
			'hint' => array(
				'title' => esc_attr__('Main decoration', 'dfd'),
				'content' => esc_attr__('This option allows you to set the decoration which will be displayed on hover', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_hover_link',
			'type' => 'select',
			'title' => __('Hover link', 'dfd'),
			'options' => array(
				'lightbox' => __('Open Gallery in lightbox', 'dfd'),
				'link' => __('Go to Gallery single item', 'dfd'),
			),
			'default' => 'custom',
			'hint' => array(
				'title' => esc_attr__('Hover link', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the hover link behaviour. You can open the gallery in lightbox or go inside the gallery item', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_hover_title_dedcoration',
			'type' => 'select',
			'title' => __('Heading decoration', 'dfd'),
			'options' => array(
				'title-deco-none' => __('None', 'dfd'),
				'diagonal-line' => __('Diagonal line', 'dfd'),
				'title-underline' => __('Title underline', 'dfd'),
				'square-behind-heading' => __('Square behind heading', 'dfd'),
			),
			'default' => 'custom',
			'required' => array(
				array('dfd_gallery_hover_main_dedcoration', '=', 'heading'),
			),
			'hint' => array(
				'title' => esc_attr__('Heading decoration', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the style for the heading hover decoration', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_hover_show_title',
			'type' => 'button_set', //the field type
			'title' => __('Titles', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'required' => array(
				array('dfd_gallery_hover_main_dedcoration', '=', 'heading'),
			),
			'hint' => array(
				'title' => esc_attr__('Title', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the title of the gallery item on hover', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_hover_show_subtitle',
			'type' => 'button_set', //the field type
			'title' => __('Subtitle', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'required' => array(
				array('dfd_gallery_hover_main_dedcoration', '=', 'heading'),
			),
			'hint' => array(
				'title' => esc_attr__('Subtitle', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the subtitle of the gallery item on hover', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_hover_plus_position',
			'type' => 'select',
			'title' => __('Plus position', 'dfd'),
			'options' => array(
				'dfd-middle' => __('Middle of the project', 'dfd'),
				'dfd-top-right' => __('Top right corner', 'dfd'),
				'dfd-top-left' => __('Top left corner', 'dfd'),
				'dfd-bottom-right' => __('Bottom right corner', 'dfd'),
				'dfd-bottom-left' => __('Bottom left corner', 'dfd'),
			),
			'default' => 'custom',
			'required' => array(
				array('dfd_gallery_hover_main_dedcoration', '=', 'plus'),
			),
			'hint' => array(
				'title' => esc_attr__('Plus position', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the Plus decoration\'s position', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_hover_plus_bg',
			'type' => 'color',
			'title' => __('Plus background', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array(
				array('dfd_gallery_hover_plus_position', 'not_empty_and', 'dfd-middle'),
			),
			'hint' => array(
				'title' => esc_attr__('Plus background', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the Plus decoration\'s background', 'dfd')
			)
		),
		array(
			'id' => 'gallery_hover_colors',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Hover color settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'dfd_gallery_hover_text_color',
			'type' => 'color',
			'title' => __('Text hover color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Text color', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the text of the elements on hover', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_hover_mask_style',
			'type' => 'select',
			'title' => __('Hover mask background style', 'dfd'),
			'options' => array(
				'simple' => __('Simple color', 'dfd'),
				'gradient' => __('Gradient', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Hover mask background style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the mask background style, you can choose simple color or gradient', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_hover_bg',
			'type' => 'color',
			'title' => __('Mask background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array(
				'dfd_gallery_hover_mask_style', "=", 'simple'
			),
			'hint' => array(
				'title' => esc_attr__('Mask background', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the mask background color', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_hover_bg_gradient',
			'type' => 'color_gradient',
			'title' => __('Mask background gradient', 'dfd'),
			'default' => array(
				'from' => '',
				'to' => '',
			),
			'validate' => 'color',
			'required' => array(
				'dfd_gallery_hover_mask_style', "=", 'gradient'
			),
			'hint' => array(
				'title' => esc_attr__('Mask background gradient', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the start and end colors for the mask background gradient', 'dfd')
			)
		),
		array(
			'id' => 'dfd_gallery_hover_bg_opacity',
			'type' => 'slider',
			'title' => __('Gallery hover background opacity', 'dfd'),
			'min' => '1',
			'max' => '100',
			'step' => '1',
			'default' => '70',
			'hint' => array(
				'title' => esc_attr__('Background opacity', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the opacity for the galleries\' hover background', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => esc_html__('Woocommerce', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'icon' => 'crdash-credit_card',
	//Lets leave this as a blank section, no options just some intro text set above.
));
Redux::setSection($opt_name, array(
	'title' => __('Woocommerce base options', 'dfd'),
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'woo_base',
			'type' => 'info',
			'desc' => '<h3 class="description">' . __('Base shop options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'woo_top_link_src',
			'type' => 'select',
			'title' => __('Shop top link source', 'dfd'),
			'options' => array(
				'page' => __('Page', 'dfd'),
				'url' => __('Custom url', 'dfd'),
			),
			'default' => 'chaffle',
			'hint' => array(
				'title' => esc_attr__('Link source', 'dfd'),
				'content' => esc_attr__('This option allows you to set the page or custom link which will be used for the button placed next to the categories and tags dropdown on shop pages', 'dfd')
			)
		),
		array(
			'id' => 'woo_top_page_select',
			'type' => 'select',
			'data' => 'pages',
			'title' => __('Shop page', 'dfd'),
			'required' => array(
				array('woo_top_link_src', '=', 'page'),
			),
			'hint' => array(
				'title' => esc_attr__('Shop page', 'dfd'),
				'content' => esc_attr__('Select the page which will be used as main shop page', 'dfd')
			)
		),
		array(
			'id' => 'woo_top_page_url',
			'type' => 'text',
			'title' => __('Shop page URL', 'dfd'),
			'validate' => 'url',
			'required' => array(
				array('woo_top_link_src', '=', 'url'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Shop page URL', 'dfd'),
				'content' => esc_attr__('Set the portfolio page URL which will be used as main shop page', 'dfd')
			)
		),
		array(
			'id' => 'shop_title',
			'type' => 'text',
			'title' => esc_html__('Shop title', 'dfd'),
			'default' => esc_html__('Best offers', 'dfd'),
			'hint' => array(
				'title' => esc_attr__('Shop title', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the shop title which will be visible on the shop and categories pages above the products', 'dfd')
			)
		),
		/* array(
		  'id' => 'woo_top_page_select',
		  'type'     => 'select',
		  'data'     => 'pages',
		  'title' => __('Shop page select', 'dfd'),
		  'desc' => __('Please select main shop page', 'dfd'),
		  ), */
		array(
			'id' => 'woo_general',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Styling options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'woocommerce_catalogue_mode',
			'type' => 'button_set', //the field type
			'title' => esc_html__('Catalogue mode', 'dfd'),
			'options' => array('1' => esc_html__('On', 'dfd'), '0' => esc_html__('Off', 'dfd')),
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Catalogue mode', 'dfd'),
				'content' => esc_attr__('This option allows you to display products without prices', 'dfd')
			)
		),
		array(
			'id' => 'dfd_woocommerce_templates_path',
			'type' => 'select',
			'title' => esc_html__('Woocommerce style', 'dfd'),
			'options' => array(
				'' => esc_html__('Advanced', 'dfd'),
				'_old' => esc_html__('Old styles', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Woocommerce style', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the styles for the woocommerce pages', 'dfd')
			)
		),
		array(
			'id' => 'woo_products_loop_style',
			'type' => 'select',
			'title' => esc_html__('Product style', 'dfd'),
			'options' => array(
				'style-1' => esc_html__('Standard', 'dfd'),
				'style-2' => esc_html__('Price and hover mask', 'dfd'),
				'style-3' => esc_html__('Hover mask', 'dfd'),
			),
			'required' => array(
				'dfd_woocommerce_templates_path', '!=', '_old'
			),
			'default' => 'style-1',
			'hint' => array(
				'title' => esc_attr__('Product style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset styles for the products displaying', 'dfd')
			)
		),
		array(
			'id' => 'woo_products_buttons_color_scheme',
			'type' => 'select',
			'title' => esc_html__('Buttons style', 'dfd'),
			'options' => array(
				'' => esc_html__('Dark', 'dfd'),
				'dfd-buttons-light' => esc_html__('Light', 'dfd'),
			),
			'required' => array(
				'dfd_woocommerce_templates_path', '!=', '_old'
			),
			'default' => 'dfd-buttons-light',
			'hint' => array(
				'title' => esc_attr__('Buttons style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose one of the preset styles for the products buttons', 'dfd')
			)
		),
		array(
			'id' => 'woo_star_rating_color',
			'type' => 'color',
			'title' => esc_html__('Star rating color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Star rating color', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the color for the product\'s rating stars', 'dfd')
			)
		),
		array(
			'id' => 'woocommerce_archive_slideshow_speed',
			'type' => 'text',
			'title' => esc_html__('Product preview slideshow speed', 'dfd'),
			'validate' => 'numeric',
			'default' => '2000',
			'hint' => array(
				'title' => esc_attr__('Preview slideshow speed', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the speed of the product\'s slideshow', 'dfd')
			)
		),
		array(
			'id' => 'woo_products_hover_mask_style',
			'type' => 'select',
			'title' => esc_html__('Hover mask background style', 'dfd'),
			'options' => array(
				'simple' => esc_html__('Simple color', 'dfd'),
				'gradient' => esc_html__('Gradient', 'dfd'),
			),
			'required' => array(
				'woo_products_loop_style', "not_empty_and", 'style-1'
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Hover mask background style', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the mask background style, you can choose simple color or gradient', 'dfd')
			)
		),
		array(
			'id' => 'woo_products_hover_bg',
			'type' => 'color',
			'title' => esc_html__('Products mask background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array(
				'woo_products_hover_mask_style', "=", 'simple'
			),
			'hint' => array(
				'title' => esc_attr__('Mask background', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the mask background color', 'dfd')
			)
		),
		array(
			'id' => 'woo_products_hover_bg_gradient',
			'type' => 'color_gradient',
			'title' => esc_html__('Hover mask background gradient', 'dfd'),
			'default' => array(
				'from' => '',
				'to' => '',
			),
			'validate' => 'color',
			'required' => array(
				'woo_products_hover_mask_style', "=", 'gradient'
			),
			'hint' => array(
				'title' => esc_attr__('Mask background gradient', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the start and end colors for the mask background gradient', 'dfd')
			)
		),
		array(
			'id' => 'woo_products_hover_bg_opacity',
			'type' => 'slider',
			'title' => esc_html__('Products hover background opacity', 'dfd'),
			'min' => '1',
			'max' => '100',
			'step' => '1',
			'default' => '70',
			'hint' => array(
				'title' => esc_attr__('Background opacity', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the opacity for the poducts\' hover background', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Woocommerce category options', 'dfd'),
	'icon' => 'crdash-credit_card',
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'woo_layout',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Layout settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'woo_category_stun_header',
			'type' => 'button_set', //the field type
			'title' => __('Stunning header', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'required' => array(
				'dfd_woocommerce_templates_path', '!=', '_old'
			),
			'default' => 'on', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Stunning header', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the stunning header for the woocommerce archive pages', 'dfd')
			)
		),
		array(
			'id' => 'woo_category_layout',
			'type' => 'select',
			'title' => __('Layout width', 'dfd'),
			'options' => array(
				'' => __('Boxed', 'dfd'),
				'full_width' => __('Full width', 'dfd'),
			),
			'required' => array(
				'dfd_woocommerce_templates_path', '!=', '_old'
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Layout width', 'dfd'),
				'content' => esc_attr__('This option defines the woocommerce archive page\'s content width', 'dfd')
			)
		),
		array(
			'id' => 'woo_category_sidebars',
			'type' => 'select',
			'title' => __('Sidebars configuration', 'dfd'),
			'options' => array(
				'' => __('Inherit from single layout settings', 'dfd'),
				'1col-fixed' => __('No sidebars', 'dfd'),
				'2c-l-fixed' => __('Left sidebar', 'dfd'),
				'2c-r-fixed' => __('Right sidebar', 'dfd'),
				'3c-fixed' => __('Both left and right sidebars', 'dfd'),
			),
			'required' => array(
				'dfd_woocommerce_templates_path', '!=', '_old'
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Sidebars configuration', 'dfd'),
				'content' => esc_attr__('Allows you to choose sidebars and their position', 'dfd')
			)
		),
		array(
			'id' => 'woo_category_cat_tag',
			'type' => 'button_set', //the field type
			'title' => __('Categories, tags and author dropdown', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'required' => array(
				'dfd_woocommerce_templates_path', '!=', '_old'
			),
			'default' => 'on', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Categories and tags dropdown', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide categories, tags and author drop-down sorter before product items on shop pages', 'dfd')
			)
		),
		/* array(
		  'id' => 'woo_category_layout_style',
		  'type' => 'select',
		  'title' => __('Layout style', 'dfd'),
		  'options' => array(
		  false => __('Woocommerce default', 'dfd'),
		  'right-image' => __('Left image', 'dfd'),
		  'left-image' => __('Right image', 'dfd'),
		  'masonry' => __('Masonry', 'dfd'),
		  'fitRows' => __('Grid', 'dfd'),
		  ),
		  'default' => '',
		  ),
		  array(
		  'id' => 'woo_category_items_offset',
		  'type' => 'text',
		  'title' => __('Products offset (in px)', 'dfd'),
		  'validate' => 'numeric',
		  'default' => '',
		  ), */
		array(
			'id' => 'woo_category_columns',
			'type' => 'select',
			'title' => __('Number of columns', 'dfd'),
			'options' => array(
				1 => __('One', 'dfd'),
				2 => __('Two', 'dfd'),
				3 => __('Three', 'dfd'),
				4 => __('Four', 'dfd'),
			//5 => __('Five', 'dfd'),
			//'6' => __('Six', 'dfd'),
			),
			'required' => array(
				'dfd_woocommerce_templates_path', '!=', '_old'
			),
			'default' => 3,
		),
		array(
			'id' => 'woo_category_products_number',
			'type' => 'text',
			'title' => __('Number of products per page', 'dfd'),
			'validate' => 'numeric',
			'default' => '10',
			'required' => array(
				'dfd_woocommerce_templates_path', '!=', '_old'
			),
			'hint' => array(
				'title' => esc_attr__('Products per page', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the amount of products to be displayed per page on shop pages', 'dfd')
			)
		),
		array(
			'id' => 'woo_category_content_alignment',
			'type' => 'select', //the field type
			'title' => __('Content alignment', 'dfd'),
			'sub_desc' => '',
			'options' => array(
				'text-center' => __('Center', 'dfd'),
				'text-left' => __('Left', 'dfd'),
				'text-right' => __('Right', 'dfd'),
			),
			'default' => 'text-center',
//			'required' => array(
//				array('woo_category_show_description', '=', 'on'),
//			),
			'hint' => array(
				'title' => esc_attr__('Content alignment', 'dfd'),
				'content' => esc_attr__('Choose the content position of the single product item on portfolio shop pages', 'dfd')
			)
		),
		array(
			'id' => 'woo_extra_features',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Extra features', 'dfd') . '</h3>'
		),
		array(
			'id' => 'woo_category_item_appear_effect',
			'type' => 'select',
			'title' => __('Items appear effect', 'dfd'),
			'options' => dfd_module_animation_styles('options'),
			'required' => array(
				'dfd_woocommerce_templates_path', '!=', '_old'
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Appear effect', 'dfd'),
				'content' => esc_attr__('This option allows you to set the unique appear effect for the product items on shop pages', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Woocommerce single options', 'dfd'),
	'icon' => 'crdash-credit_card',
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'woo_single_stun_header',
			'type' => 'button_set', //the field type
			'title' => __('Stunning header', 'dfd'),
			'sub_desc' => '',
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'required' => array(
				'dfd_woocommerce_templates_path', '!=', '_old'
			),
			'default' => 'on', //this should be the key as defined above
			'hint' => array(
				'title' => esc_attr__('Stunning header', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the stunning header for the single product pages', 'dfd')
			)
		),
		array(
			'id' => 'woo_single_layout',
			'type' => 'select',
			'title' => __('Layout width', 'dfd'),
			'options' => array(
				'' => __('Boxed', 'dfd'),
				'full-width' => __('Full width', 'dfd'),
			),
			'required' => array(
				'dfd_woocommerce_templates_path', '!=', '_old'
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Layout width', 'dfd'),
				'content' => esc_attr__('This option defines the single product page\'s content width', 'dfd')
			)
		),
		array(
			'id' => 'woo_single_sidebars',
			'type' => 'select',
			'title' => __('Sidebars configuration', 'dfd'),
			'options' => array(
				'1col-fixed' => __('No sidebars', 'dfd'),
				'2c-l-fixed' => __('Left sidebar', 'dfd'),
				'2c-r-fixed' => __('Right sidebar', 'dfd'),
				'3c-fixed' => __('Both left and right sidebars', 'dfd'),
				'' => __('Inherit from single post settings', 'dfd'),
			),
			'default' => '1col-fixed',
			'hint' => array(
				'title' => esc_attr__('Sidebars configuration', 'dfd'),
				'content' => esc_attr__('Allows you to choose sidebars and their position', 'dfd')
			)
		),
		array(
			'id' => 'woocommerce_hide_single_thumb',
			'type' => 'button_set', //the field type
			'title' => esc_html__('Hide thumbnails on single product page', 'dfd'),
			'options' => array('1' => esc_html__('On', 'dfd'), '0' => esc_html__('Off', 'dfd')),
			'required' => array(
				'dfd_woocommerce_templates_path', '!=', '_old'
			),
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Hide thumbnails', 'dfd'),
				'content' => esc_attr__('This option allows you to hide the product thumbnails on single product page', 'dfd')
			)
		),
		array(
			'id' => 'woo_single_columns_config',
			'type' => 'select',
			'title' => esc_html__('Image and description width configuration', 'dfd'),
			'options' => array(
				2 => esc_html__('1/5 to 4/5', 'dfd'),
				3 => esc_html__('1/4 to 3/4', 'dfd'),
				4 => esc_html__('1/3 to 2/3', 'dfd'),
				5 => esc_html__('5/12 to 7/12', 'dfd'),
				6 => esc_html__('1/2 to 1/2', 'dfd'),
				7 => esc_html__('7/12 to 5/12', 'dfd'),
				8 => esc_html__('2/3 to 1/3', 'dfd'),
				9 => esc_html__('3/4 to 1/4', 'dfd'),
				10 => esc_html__('4/5 to 1/5', 'dfd'),
			),
			'default' => 7,
			'hint' => array(
				'title' => esc_attr__('Image and description width', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the width configuration of the image on single product page', 'dfd')
			)
		),
		array(
			'id' => 'woo_single_thumb_position',
			'type' => 'select',
			'title' => esc_html__('Thumbnails position', 'dfd'),
			'options' => array(
				'' => esc_html__('Under image', 'dfd'),
				'thumbs-left' => esc_html__('To the left from image', 'dfd'),
			),
			'default' => '',
			'required' => array(
				array('woocommerce_hide_single_thumb', '=', '0'),
			),
			'hint' => array(
				'title' => esc_attr__('Thumbnails position', 'dfd'),
				'content' => esc_attr__('This option allows you to specify the thumbnails position according to the main image', 'dfd')
			)
		),
		array(
			'id' => 'woo_single_thumb_number',
			'type' => 'select',
			'title' => esc_html__('Number of thumbnails to show', 'dfd'),
			'options' => array(
				1 => esc_html__('One', 'dfd'),
				2 => esc_html__('Two', 'dfd'),
				3 => esc_html__('Three', 'dfd'),
				4 => esc_html__('Four', 'dfd'),
				5 => esc_html__('Five', 'dfd'),
				6 => esc_html__('Six', 'dfd'),
				7 => esc_html__('Seven', 'dfd'),
				8 => esc_html__('Eight', 'dfd'),
			),
			'required' => array(
				'dfd_woocommerce_templates_path', '!=', '_old'
			),
			'default' => 4,
		),
		array(
			'id' => 'woo_paging',
			'type' => 'info',
			'desc' => '<h3 class="description">' . esc_html__('Pagination settings', 'dfd') . '</h3>'
		),
		array(
			'id' => 'woo_single_enable_pagination',
			'type' => 'button_set', //the field type
			'title' => __('Inside pagination', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'sub_desc' => '',
			'required' => array(
				'dfd_woocommerce_templates_path', '!=', '_old'
			),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Inside pagination', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the inner pagination style for product item', 'dfd')
			)
		),
		array(
			'id' => 'woo_single_pagination_style',
			'type' => 'select',
			'title' => __('Pagination position', 'dfd'),
			'options' => array(
				'' => __('Fixed', 'dfd'),
				'top' => __('Top', 'dfd'),
			),
			'default' => '',
			'required' => array(
				array('woo_single_enable_pagination', '=', 'on'),
			),
			'hint' => array(
				'title' => esc_attr__('Pagination position', 'dfd'),
				'content' => esc_attr__('This option allows you to select the inner pagination style for product item', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => esc_html__('Styling options', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'icon' => 'crdash-paintbrush',
	//Lets leave this as a blank section, no options just some intro text set above.
));
Redux::setSection($opt_name, array(
	'title' => __('Styling base options', 'dfd'),
	//'desc' => __('<p class="description">Style parameters of body and footer</p>', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'subsection' => true,
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'main_colors',
			'type' => 'info',
			'desc' => '<h3 class="description">' . __('Main site colors setup', 'dfd') . '</h3>'
		),
		array(
			'id' => 'main_site_color',
			'type' => 'color',
			'title' => __('Main site color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Main site color', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the main site color to adjust the styling of the site. This color is used as default color for the Visual Composer elements. Detailed list of elements which inherit Main site color you can find in Theme Documentation', 'dfd')
			)
		),
		array(
			'id' => 'secondary_site_color',
			'type' => 'color',
			'title' => __('Second site color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Second site color', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the second site color. This color is used as additional color. Detailed list of elements which inherit Second site color you can find in Theme Documentation', 'dfd')
			)
		),
		array(
			'id' => 'third_site_color',
			'type' => 'color',
			'title' => __('Third site color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Third color', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the third site color. The color is used as default border color', 'dfd')
			)
		),
		/* array(
		  'id' => 'fourth_site_color',
		  'type' => 'color',
		  'title' => __('Fourth site color', 'dfd'),
		  'default' => '',
		  'validate' => 'color_rgba',
		  ), */
		array(
			'id' => 'title_color',
			'type' => 'color',
			'title' => __('Default title color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Default title color', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the default color for the title. The full list of the elements which are inherited this color you can check in theme documentation', 'dfd')
			)
		),
		array(
			'id' => 'subtitle_color',
			'type' => 'color',
			'title' => __('Default subtitle color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Default subtitle color', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the default color for the subtitle. The full list of the elements which are inherited this color you can check in theme documentation', 'dfd')
			)
		),
		array(
			'id' => 'border_color',
			'type' => 'color',
			'title' => __('Border color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Border color', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the border color which will be applied for borders by default', 'dfd')
			)
		),
		array(
			'id' => 'background_gray',
			'type' => 'color',
			'title' => __('Light background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Light background color', 'dfd'),
				'content' => esc_attr__('This option allows you to choose light background color, it\'s used as the background color for the sidebars, inputs, portfolio\'s description. The full list of the elements which are inherited this color you can check in theme documentation', 'dfd')
			)
		),
		array(
			'id' => 'info_bxd',
			'type' => 'info',
			'desc' => '<h3 class="description">' . __('Boxed site options', 'dfd') . '</h3>'
		),
		array(
			'id' => 'site_boxed',
			'type' => 'button_set',
			'title' => __('Boxed Body Layout', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '0',
			'hint' => array(
				'title' => esc_attr__('Boxed body', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the boxed site layout, its width will be set to 1280px', 'dfd')
			)
		),
		//Body wrapper
		array(
			'id' => 'wrapper_bg_color',
			'type' => 'color',
			'title' => __('Content background color', 'dfd'),
			'validate' => 'color_rgba',
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('This option allows you to set the default color for the content', 'dfd')
			)
		),
		array(
			'id' => 'wrapper_bg_image',
			'type' => 'media',
			'title' => __('Content background image', 'dfd'),
			'default' => array(
				'url' => '',
			),
			'hint' => array(
				'title' => esc_attr__('Background image', 'dfd'),
				'content' => esc_attr__('This option allows you to set the default background image for the content', 'dfd')
			)
		),
		array(
			'id' => 'wrapper_custom_repeat',
			'type' => 'select',
			'title' => __('Content image repeat', 'dfd'),
			'options' => array('repeat-y' => 'vertically', 'repeat-x' => 'horizontally', 'no-repeat' => 'no-repeat', 'repeat' => 'both vertically and horizontally',), //Must provide key => value pairs for select options
			'default' => 'repeat',
			'hint' => array(
				'title' => esc_attr__('Background repeat', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the repeat for the background image', 'dfd')
			)
		),
		array(
			'id' => 'info_sth',
			'type' => 'info',
			'desc' => '<h3 class="description">' . __('Body styling options', 'dfd') . '</h3>',
		),
		array(
			'id' => 'body_bg_color',
			'type' => 'color',
			'title' => __('Body background color', 'dfd'),
			'validate' => 'color_rgba',
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('This option allows you to set the default color for the body', 'dfd')
			)
		),
		array(
			'id' => 'body_bg_image',
			'type' => 'media',
			'title' => __('Body background image', 'dfd'),
			'default' => array(
				'url' => ''
			),
			'hint' => array(
				'title' => esc_attr__('Background image', 'dfd'),
				'content' => esc_attr__('This option allows you to set the default background image for the body', 'dfd')
			)
		),
		array(
			'id' => 'body_custom_repeat',
			'type' => 'select',
			'title' => __('Body background image repeat', 'dfd'),
			'options' => array('repeat-y' => 'vertically', 'repeat-x' => 'horizontally', 'no-repeat' => 'no-repeat', 'repeat' => 'both vertically and horizontally',), //Must provide key => value pairs for select options
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Background repeat', 'dfd'),
				'content' => esc_attr__('This option allows you to choose the repeat for the background image', 'dfd')
			)
		),
		array(
			'id' => 'body_bg_fixed',
			'type' => 'button_set',
			'title' => __('Fixed body background', 'dfd'),
			'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
			'default' => '0', // 1 = on | 0 = off
			'hint' => array(
				'title' => esc_attr__('Fixed background', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the fixed background. When enabled fixed background, the background image is fixed and content scrolls separately over it.', 'dfd')
			)
		),
		array(
			'id' => 'dfd_pagination_style',
			'type' => 'select',
			'title' => __('Pagination style', 'dfd'),
			'options' => array(
				'1' => __('Style 1', 'dfd'),
				'2' => __('Style 2', 'dfd'),
				'3' => __('Style 3', 'dfd'),
				'4' => __('Style 4', 'dfd'),
				'5' => __('Style 5', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Pagination style', 'dfd'),
				'content' => esc_attr__('The default pagination style for blog, portfolio, gallery, archive and search pages can be defined here. It will be applied for theme defined post types only but will not affect plugins functionality.', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Lightbox styling options', 'dfd'),
	'subsection' => true,
	'icon' => 'crdash-photo',
	'fields' => array(
		array(
			'id' => 'enable_deep_links',
			'type' => 'button_set',
			'title' => __('Lightbox deep links', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'off',
			'hint' => array(
				'title' => esc_attr__('Deep links', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the link of the image opened in lightbox', 'dfd')
			)
		),
		array(
			'id' => 'enable_lightbox_counter',
			'type' => 'button_set',
			'title' => __('Lightbox slides navigation', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('slides navigation', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the slides navigation for the images opened in lightbox', 'dfd')
			)
		),
		array(
			'id' => 'lightbox_overlay_style',
			'type' => 'select',
			'title' => __('Background style', 'dfd'),
			'options' => array(
				'simple' => __('Simple color', 'dfd'),
				'gradient' => __('Gradient', 'dfd'),
			),
			'default' => 'simple',
			'hint' => array(
				'title' => esc_attr__('Background style', 'dfd'),
				'content' => esc_attr__('Choose the background style for the lighbox background. You can set simple color or gradient', 'dfd')
			)
		),
		array(
			'id' => 'lightbox_overley_bg_color',
			'type' => 'color',
			'title' => __('Background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array('lightbox_overlay_style', "=", 'simple'),
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background style for the lighbox background', 'dfd')
			)
		),
		array(
			'id' => 'lightbox_overley_color_gradient',
			'type' => 'color_gradient',
			'title' => __('Background gradient', 'dfd'),
			'default' => array(
				'from' => '',
				'to' => '',
			),
			'validate' => 'color',
			'required' => array('lightbox_overlay_style', "=", 'gradient'),
			'hint' => array(
				'title' => esc_attr__('Background gradient', 'dfd'),
				'content' => esc_attr__('Choose the start and end color for the lighbox background gradient color', 'dfd')
			)
		),
		array(
			'id' => 'lightbox_overley_bg_opacity',
			'type' => 'slider',
			'title' => __('Background opacity', 'dfd'),
			'min' => '1',
			'max' => '100',
			'step' => '1',
			'default' => '70',
			'hint' => array(
				'title' => esc_attr__('Background opacity', 'dfd'),
				'content' => esc_attr__('Set the opacity value for the lighbox background', 'dfd')
			)
		),
		array(
			'id' => 'lightbox_elements_color',
			'type' => 'color',
			'title' => __('Lightbox elements color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'hint' => array(
				'title' => esc_attr__('Elements color', 'dfd'),
				'content' => esc_attr__('Choose the color for the elements set in lightbox', 'dfd')
			)
		),
		array(
			'id' => 'enable_lightbox_share',
			'type' => 'button_set',
			'title' => __('Lightbox share', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Lightbox Share', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the share buttons in the lightbox', 'dfd')
			)
		),
		array(
			'id' => 'enable_lightbox_arrows',
			'type' => 'button_set',
			'title' => __('Lightbox navigation arrows', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Lightbox navigation', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the navigation arrows in the lightbox', 'dfd')
			)
		),
		array(
			'id' => 'enable_zoom_button',
			'type' => 'button_set',
			'title' => __('Lightbox zoom button', 'dfd'),
			'options' => array('on' => __('On', 'dfd'), 'off' => __('Off', 'dfd')),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Lightbox zoom', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the zoom button for the images in the lightbox', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Link options', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'icon' => 'crdash-thumb_tac',
	'subsection' => true,
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'link_typography_option',
			'type' => 'typography',
			'title' => __('Link Typography', 'redux-framework-demo'),
			//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
			'google' => true,
			// Disable google fonts. Won't work if you haven't defined your google api key
			//'font-backup' => true,
			// Select a backup non-google font in addition to a google font
			'font-style' => true, // Includes font-style and weight. Can use font-style or font-weight to declare
			'subsets' => true, // Only appears if google is true and subsets not set to false
			'font-size' => true,
			'text-align' => false,
			'line-height' => true,
			'word-spacing' => false, // Defaults to false
			'letter-spacing' => true, // Defaults to false
			'text-transform' => true,
			'color' => true,
			'preview' => false, // Disable the previewer
			'all_styles' => true,
			// Enable all Google Font style/weight variations to be added to the page
			//'output'      => array( 'h2.site-description, .entry-title' ),
			// An array of CSS selectors to apply this font style to dynamically
			//'compiler'    => array( 'h2.site-description-compiler' ),
			// An array of CSS selectors to apply this font style to dynamically
			'units' => 'px',
			// Defaults to px
			'default' => array(
				'font-style' => 'normal',
				'font-weight' => '',
				'font-family' => 'Lora',
				'google' => true,
				'font-size' => '14px',
				'line-height' => '24px',
				'text-transform' => 'none',
				//'word-spacing'  => '0px',
				'letter-spacing' => '0px',
				'color' => '#242424',
			),
			'hint' => array(
				'title' => esc_attr__('Link Typography', 'dfd'),
				'content' => esc_attr__('Specify the typography settings and color for the links. Typography option with each property can be called individually', 'dfd')
			)
		),
		array(
			'id' => 'link_hover_color',
			'type' => 'color',
			'title' => __('Link hover color', 'dfd'),
			'validate' => 'color_rgba',
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Link hover color', 'dfd'),
				'content' => esc_attr__('Specify the color for the links on hover', 'dfd')
			)
		),
		array(
			'id' => 'link_decoration',
			'type' => 'select',
			'title' => __('Link decoration', 'dfd'),
			'options' => array(
				'none' => __('None', 'dfd'),
				'solid' => __('Underline solid', 'dfd'),
				'dotted' => __('Underline dotted', 'dfd'),
				'dashed' => __('Underline dashed', 'dfd'),
			),
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Link decoration', 'dfd'),
				'content' => esc_attr__('Choose one of the preset link\'s decoration style', 'dfd')
			)
		),
		array(
			'id' => 'link_decoration_color',
			'type' => 'color',
			'title' => __('Link decoration color', 'dfd'),
			'validate' => 'color_rgba',
			'default' => '',
			'hint' => array(
				'title' => esc_attr__('Decoration color', 'dfd'),
				'content' => esc_attr__('Specify the color for the link\'s decoration', 'dfd')
			)
		),
		array(
			'id' => 'info_msc',
			'type' => 'info',
			'desc' => '<h3 class="description">' . __('Inside pagination', 'dfd') . '</h3>'
		),
		array(
			'id' => 'inside_pagination_arrow',
			'type' => 'select',
			'title' => __('Fixed pagination style', 'dfd'),
			'options' => array(
				'text' => __('With text', 'dfd'),
				'arrows' => __('With arrows', 'dfd'),
			),
			'default' => 'text',
			'hint' => array(
				'title' => esc_attr__('Fixed pagination', 'dfd'),
				'content' => esc_attr__('Specify the style for the fixed pagination. It will be displayed on single posts, gallery and portfolio items', 'dfd')
			)
		),
		array(
			'id' => 'inside_pagination_hover',
			'type' => 'button_set',
			'title' => __('Hover animation', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Hover animation', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the hover animation for the fixed pagination', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Login page options', 'dfd'),
	//'desc' => __('<p class="description">More information about api keys and how to get it you can find in that tutorial <a href="http://dfd.name/twitter-settings">http://dfd.name/twitter-settings/</a></p>', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'icon' => 'crdash-paintbrush',
	'subsection' => true,
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'custom_login_page',
			'type' => 'button_set',
			'title' => __('Custom styles', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'default' => 'off',
			'hint' => array(
				'title' => esc_attr__('Custom styles', 'dfd'),
				'content' => esc_attr__('This option allows you to enable or disable the custom changes for the login page', 'dfd')
			),
		),
		array(
			'id' => 'custom_login_page_logo',
			'type' => 'button_set',
			'title' => __('Logo', 'dfd'),
			'options' => array('on' => 'On', 'off' => 'Off'),
			'required' => array('custom_login_page', "=", 'on'),
			'default' => 'on',
			'hint' => array(
				'title' => esc_attr__('Logo', 'dfd'),
				'content' => esc_attr__('This option allows you to show or hide the logotype for the login page', 'dfd')
			)
		),
		array(
			'id' => 'login_page_bg_color',
			'type' => 'color',
			'title' => __('Background color', 'dfd'),
			'default' => '',
			'validate' => 'color_rgba',
			'required' => array('custom_login_page', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Background color', 'dfd'),
				'content' => esc_attr__('Choose the background color for the login page', 'dfd')
			)
		),
		array(
			'id' => 'login_page_bg_image',
			'type' => 'media',
			'title' => __('Background image', 'dfd'),
			'default' => array(
				'url' => $assets_folder . 'img/login_bg.jpg'
			),
			'required' => array('custom_login_page', "=", 'on'),
			'hint' => array(
				'title' => esc_attr__('Background image', 'dfd'),
				'content' => esc_attr__('Choose the background image for the login page', 'dfd')
			)
		),
		array(
			'id' => 'login_page_bg_image_size',
			'type' => 'select',
			'title' => __('Background size', 'dfd'),
			'options' => array(
				'initial' => __('Initial', 'dfd'),
				'cover' => __('Cover', 'dfd'),
				'contain' => __('Contain', 'dfd'),
			),
			'required' => array('login_page_bg_image', "!=", ''),
			'default' => 'initial',
			'hint' => array(
				'title' => esc_attr__('Background size', 'dfd'),
				'content' => esc_attr__('This option allows you to set the background size for the background image', 'dfd')
			)
		),
		array(
			'id' => 'login_page_color_scheme',
			'type' => 'select',
			'title' => __('Color scheme', 'dfd'),
			'options' => array(
				'light' => __('Light', 'dfd'),
				'dark' => __('Dark', 'dfd'),
			),
			'required' => array('custom_login_page', "=", 'on'),
			'default' => 'dark',
			'hint' => array(
				'title' => esc_attr__('Color scheme', 'dfd'),
				'content' => esc_attr__('According to the color scheme you choose the text color will be changed to make it more readable', 'dfd')
			)
		),
	),
));
Redux::setSection($opt_name, array(
	'title' => __('Responsive options', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'icon' => 'crdash-paintbrush',
	'subsection' => true,
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'x_large_responsive_breakpoint',
			'type' => 'slider',
			'title' => __('Large screen min-width', 'dfd'),
			'min' => '1280',
			'max' => '1920',
			'step' => '1',
			'default' => '1280',
			'hint' => array(
				'title' => esc_attr__('Large screen min-width', 'dfd'),
				'content' => esc_attr__('Define the default width for Large screens', 'dfd')
			)
		),
		array(
			'id' => 'large_responsive_breakpoint',
			'type' => 'slider',
			'title' => __('Normal screen min-width', 'dfd'),
			'min' => '1024',
			'max' => '1280',
			'step' => '1',
			'default' => '1024',
			'hint' => array(
				'title' => esc_attr__('Normal screen min-width', 'dfd'),
				'content' => esc_attr__('Define the default width for Normal screens', 'dfd')
			)
		),
		array(
			'id' => 'medium_responsive_breakpoint',
			'type' => 'slider',
			'title' => __('Medium screen min-width', 'dfd'),
			'min' => '768',
			'max' => '1024',
			'step' => '1',
			'default' => '800',
			'hint' => array(
				'title' => esc_attr__('Medium screen min-width', 'dfd'),
				'content' => esc_attr__('Define the default width for Medium screens', 'dfd')
			)
		),
		array(
			'id' => 'small_responsive_breakpoint',
			'type' => 'slider',
			'title' => __('Small screen min-width', 'dfd'),
			'min' => '480',
			'max' => '768',
			'step' => '1',
			'default' => '480',
			'hint' => array(
				'title' => esc_attr__('Small screen min-width', 'dfd'),
				'content' => esc_attr__('Define the default width for Small screens', 'dfd')
			)
		),
	),
));
$_title_typography_fields = array();

$_default_font_family = array(
	1 => 'texgyreadventorregular', //h1 title
	2 => 'texgyreadventorregular', //h2 title
	3 => 'texgyreadventorregular', //h3 title
	4 => 'texgyreadventorregular', //h4 title
	5 => 'texgyreadventorregular', //h5 title
	6 => 'texgyreadventorregular', //h6 title
	7 => 'Droid Serif', //h1 subtitle
	8 => 'Droid Serif', //h2 subtitle
	9 => 'Droid Serif', //h3 subtitle
	10 => 'Droid Serif', //h4 subtitle
	11 => 'Droid Serif', //h5 subtitle
	12 => 'Droid Serif', //h6 subtitle
	13 => 'texgyreadventorregular', //stunning header title
	14 => 'texgyreadventorregular', //standard blog title
	15 => 'texgyreadventorregular', //widget title
	16 => 'texgyreadventorregular', //block title
	17 => 'texgyreadventorregular', //feature title
	18 => 'texgyreadventorregular', //box name
	19 => 'Droid Serif', //subtitle
	20 => 'Raleway', //text
	21 => 'Droid Serif', //entry-meta
);
$_default_font_size = array(
	1 => '55px', //h1 title
	2 => '45px', //h2 title
	3 => '35px', //h3 title
	4 => '30px', //h4 title
	5 => '22px', //h5 title
	6 => '18px', //h6 title
	7 => '18px', //h1 subtitle
	8 => '16px', //h2 subtitle
	9 => '14px', //h3 subtitle
	10 => '13px', //h4 subtitle
	11 => '13px', //h5 subtitle
	12 => '12px', //h6 subtitle
	13 => '35px', //stunning header title
	14 => '18px', //standard blog title
	15 => '13px', //widget title
	16 => '15px', //block title
	17 => '15px', //feature title
	18 => '14px', //box name
	19 => '13px', //subtitle
	20 => '14px', //text
	21 => '13px', //entry-meta
);
$_default_line_height_increment = array(
	1 => 1.2, //h1 title
	2 => 1.2, //h2 title
	3 => 1.2, //h3 title
	4 => 1.2, //h4 title
	5 => 1.2, //h5 title
	6 => 1.2, //h6 title
	7 => 2, //h1 subtitle
	8 => 1.875, //h2 subtitle
	9 => 1.43, //h3 subtitle
	10 => 1.38, //h4 subtitle
	11 => 1.38, //h5 subtitle
	12 => 1.25, //h6 subtitle
	13 => 1.6, //stunning header title
	14 => 1.6, //standard blog title
	15 => 1.6, //widget title
	16 => 1.92, //block title
	17 => 1.71, //feature title
	18 => 1.37, //box name
	19 => 1.72, //subtitle
	20 => 1.785, //text
	21 => 1.6, //entry-meta
);
$_default_font_weight = array(
	1 => '600', //h1 title
	2 => '600', //h2 title
	3 => '600', //h3 title
	4 => '600', //h4 title
	5 => '600', //h5 title
	6 => '600', //h6 title
	7 => '400', //h1 subtitle
	8 => '400', //h2 subtitle
	9 => '400', //h3 subtitle
	10 => '400', //h4 subtitle
	11 => '400', //h5 subtitle
	12 => '400', //h6 subtitle
	13 => '600', //stunning header title
	14 => '600', //standard blog title
	15 => '600', //widget title
	16 => '600', //block title
	17 => '600', //feature title
	18 => '600', //box name
	19 => '400', //subtitle
	20 => '400', //text
	21 => '300', //entry-meta
);
$_default_font_style = array(
	1 => 'normal', //h1 title
	2 => 'normal', //h2 title
	3 => 'normal', //h3 title
	4 => 'normal', //h4 title
	5 => 'normal', //h5 title
	6 => 'normal', //h6 title
	7 => 'italic', //h1 subtitle
	8 => 'italic', //h2 subtitle
	9 => 'italic', //h3 subtitle
	10 => 'italic', //h4 subtitle
	11 => 'italic', //h5 subtitle
	12 => 'italic', //h6 subtitle
	13 => 'normal', //stunning header title
	14 => 'normal', //standard blog title
	15 => 'normal', //widget title
	16 => 'normal', //block title
	17 => 'normal', //feature title
	18 => 'normal', //box name
	19 => 'italic', //subtitle
	20 => 'normal', //text
	21 => 'italic', //entry-meta
);
$_default_text_transform = array(
	1 => 'none', //h1 title
	2 => 'none', //h2 title
	3 => 'none', //h3 title
	4 => 'none', //h4 title
	5 => 'uppercase', //h5 title
	6 => 'none', //h6 title
	7 => 'none', //h1 subtitle
	8 => 'none', //h2 subtitle
	9 => 'none', //h3 subtitle
	10 => 'none', //h4 subtitle
	11 => 'none', //h5 subtitle
	12 => 'none', //h6 subtitle
	13 => 'none', //stunning header title
	14 => 'none', //standard blog title
	15 => 'uppercase', //widget title
	16 => 'none', //block title
	17 => 'none', //feature title
	18 => 'none', //box name
	19 => 'none', //subtitle
	20 => 'none', //text
	21 => 'none', //entry-meta
);
$_default_word_spacing = array(
	1 => '0px', //h1 title
	2 => '0px', //h2 title
	3 => '0px', //h3 title
	4 => '0px', //h4 title
	5 => '0px', //h5 title
	6 => '0px', //h6 title
	7 => '0px', //h1 subtitle
	8 => '0px', //h2 subtitle
	9 => '0px', //h3 subtitle
	10 => '0px', //h4 subtitle
	11 => '0px', //h5 subtitle
	12 => '0px', //h6 subtitle
	13 => '0px', //stunning header title
	14 => '0px', //standard blog title
	15 => '0px', //widget title
	16 => '0px', //block title
	17 => '0px', //feature title
	18 => '0px', //box name
	19 => '0px', //subtitle
	20 => '0px', //text
	21 => '0px', //entry-meta
);
$_default_letter_spacing = array(
	1 => '0px', //h1 title
	2 => '4px', //h2 title
	3 => '5px', //h3 title
	4 => '5px', //h4 title
	5 => '5px', //h5 title
	6 => '4px', //h6 title
	7 => '0px', //h1 subtitle
	8 => '0px', //h2 subtitle
	9 => '0px', //h3 subtitle
	10 => '0px', //h4 subtitle
	11 => '0px', //h5 subtitle
	12 => '0px', //h6 subtitle
	13 => '0px', //stunning header title
	14 => '0px', //standard blog title
	15 => '4px', //widget title
	16 => '0px', //block title
	17 => '0px', //feature title
	18 => '0px', //box name
	19 => '0px', //subtitle
	20 => '0px', //text
	21 => '0px', //entry-meta
);
$_default_option_name = array(
	1 => 'title_h1', //h1 title
	2 => 'title_h2', //h2 title
	3 => 'title_h3', //h3 title
	4 => 'title_h4', //h4 title
	5 => 'title_h5', //h5 title
	6 => 'title_h6', //h6 title
	7 => 'subtitle_h1', //h1 subtitle
	8 => 'subtitle_h2', //h2 subtitle
	9 => 'subtitle_h3', //h3 subtitle
	10 => 'subtitle_h4', //h4 subtitle
	11 => 'subtitle_h5', //h5 subtitle
	12 => 'subtitle_h6', //h6 subtitle
	13 => 'stunning_header_title', //standard blog title
	14 => 'blog_title', //standard blog title
	15 => 'widget_title', //widget title
	16 => 'block_title', //block title
	17 => 'feature_title', //feature title
	18 => 'box_name', //box name
	19 => 'subtitle', //subtitle
	20 => 'text', //text
	21 => 'entry_meta', //entry-meta
);
$_default_color = array(
	1 => '', //h1 title
	2 => '', //h2 title
	3 => '', //h3 title
	4 => '', //h4 title
	5 => '', //h5 title
	6 => '', //h6 title
	7 => '', //h1 subtitle
	8 => '', //h2 subtitle
	9 => '', //h3 subtitle
	10 => '', //h4 subtitle
	11 => '', //h5 subtitle
	12 => '', //h6 subtitle
	13 => '', //stunning header title
	14 => '', //standard blog title
	15 => '', //widget title
	16 => '', //block title
	17 => '', //feature title
	18 => '', //box name
	19 => '', //subtitle
	20 => '', //text
	21 => '', //entry-meta
);
$_default_option_title = array(
	1 => 'H1 Title', //h1 title
	2 => 'H2 Title', //h2 title
	3 => 'H3 Title', //h3 title
	4 => 'H4 Title', //h4 title
	5 => 'H5 Title', //h5 title
	6 => 'H6 Title', //h6 title
	7 => 'H1 Subtitle', //h1 subtitle
	8 => 'H2 Subtitle', //h2 subtitle
	9 => 'H3 Subtitle', //h3 subtitle
	10 => 'H4 Subtitle', //h4 subtitle
	11 => 'H5 Subtitle', //h5 subtitle
	12 => 'H6 Subtitle', //h6 subtitle
	13 => 'Stunning header title', //stunning header title
	14 => 'Blog heading', //standard blog title
	15 => 'Widget title', //widget title
	16 => 'Block Title', //block title
	17 => 'Features Title', //feature title
	18 => 'Box Name', //box name
	19 => 'Subtitle', //subtitle
	20 => 'Text', //text
	21 => 'Entry meta', //entry-meta
);
for ($i = 1; $i <= 21; $i++) {
	$_title_typography_fields[] = array(
		'id' => $_default_option_name[$i] . '_typography_option',
		'type' => 'typography',
		'title' => __($_default_option_title[$i] . ' Typography', 'redux-framework-demo'),
		//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
		'google' => true,
		// Disable google fonts. Won't work if you haven't defined your google api key
		//'font-backup' => true,
		// Select a backup non-google font in addition to a google font
		'font-style' => true, // Includes font-style and weight. Can use font-style or font-weight to declare
		'subsets' => true, // Only appears if google is true and subsets not set to false
		'font-size' => true,
		'text-align' => false,
		'line-height' => true,
		'word-spacing' => false, // Defaults to false
		'letter-spacing' => true, // Defaults to false
		'text-transform' => true,
		'color' => true,
		'preview' => false, // Disable the previewer
		'all_styles' => true,
		// Enable all Google Font style/weight variations to be added to the page
		//'output'      => array( 'h2.site-description, .entry-title' ),
		// An array of CSS selectors to apply this font style to dynamically
		//'compiler'    => array( 'h2.site-description-compiler' ),
		// An array of CSS selectors to apply this font style to dynamically
		'units' => 'px',
		// Defaults to px
		'subtitle' => __('Typography option with each property can be called individually. The full list of the elements which inherited this typography you can check in theme documentation', 'redux-framework-demo'),
		'default' => array(
			'font-style' => $_default_font_style[$i],
			'font-weight' => $_default_font_weight[$i],
			'font-family' => $_default_font_family[$i],
			'google' => true,
			'font-size' => $_default_font_size[$i],
			'line-height' => (float) $_default_font_size[$i] * $_default_line_height_increment[$i] . 'px',
			'text-transform' => $_default_text_transform[$i],
			//'word-spacing'  => $_default_word_spacing[$i],
			'letter-spacing' => $_default_letter_spacing[$i],
			'color' => $_default_color[$i],
		),
	);
}

$_title_typography_fields[] = array(
	'id' => 'disable_typography_responsive',
	'type' => 'button_set',
	'title' => __('Disable responsive mode for Heading module typography elements', 'dfd'),
	'options' => array('1' => __('On', 'dfd'), '0' => __('Off', 'dfd')),
	'default' => '1', // 1 = on | 0 = off
	'hint' => array(
		'title' => esc_attr__('Disable responsive mode', 'dfd'),
		'content' => esc_attr__('This option allows you to disable responsive mode for the Heading module. You will have the same typography values on all devices', 'dfd')
	)
);

Redux::setSection($opt_name, array(
	'title' => __('Custom typography', 'dfd'),
	//		'desc' => __('<p class="description"></p>', 'dfd'),
	'icon' => 'crdash-keyboard',
	'fields' => $_title_typography_fields,
));
Redux::setSection($opt_name, array(
	'title' => __('Custom fonts', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'icon' => 'crdash-briefcase',
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
//							array (
//									'id' => 'opt-media',
//									'type' => 'media',
//									'url' => true,
//									'title' => __('Media w/ URL', 'redux-framework-demo'),
//									'desc' => __('Basic media uploader with disabled URL input field.', 'redux-framework-demo'),
//									'subtitle' => __('Upload any media using the WordPress native uploader', 'redux-framework-demo'),
//									'library_filter'=>array("zip","jpeg"),
//									'default' => array (
//											'url' => 'http://s.wordpress.org/style/images/codeispoetry.png'
//									),
//							),
		array(
			'type' => 'custom_font',
			'id' => 'custom_font',
			'validate' => 'font_load',
			'title' => __('Font-face list:', 'redux-framework-demo'),
			'subtitle' => __('Upload .zip archive with font-face files.<br>(<a target="_blank" href="http://www.fontsquirrel.com/tools/webfont-generator">Create you font-face package</a>)', 'redux-framework-demo'),
			'desc' => __('<span style="color:#F09191">Note:</span> You have to download the font-face.zip archive. <br>Pay your attention, that the archive has to contain the font-face files itself, and not the subfolders<br> (E.g.: font-face.zip/your-font-face.ttf, font-face.zip/your-font-face.eot, font-face.zip/your-font-face.woff etc ).<br> They\'ll be extracted and assigned automatically. Please check the instruction how to create <a href="http://rnbtheme.com/documentation/theme-options/custom-fonts">your font-face package.</a>', 'redux-framework-demo'),
			'placeholder' => array(
				'title' => __('This is a title', 'redux-framework-demo'),
				'description' => __('Description Here', 'redux-framework-demo'),
				'url' => __('Give us a link!', 'redux-framework-demo'),
			),
//									'default_values'=>array(
//											"def_123", //font id
//									),
		),
	)
));
Redux::setSection($opt_name, array(
	'title' => __('System check', 'dfd'),
	//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
	//You dont have to though, leave it blank for default.
	'icon' => 'crdash-layout_alt2',
	'class' => 'system_check',
	//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'type' => 'sysinfo',
			'id' => 'sysifo',
			'title' => __('System check', 'redux-framework-demo'),
			'subtitle' => __('Press run test to show your server configuration', 'redux-framework-demo'),
		),
	)
));

if (file_exists(dirname(__FILE__) . '/../README.md')) {
	$section = array(
		'icon' => 'el el-list-alt',
		'title' => __('Documentation', 'redux-framework-demo'),
		'fields' => array(
			array(
				'id' => '17',
				'type' => 'raw',
				'markdown' => true,
				'content_path' => dirname(__FILE__) . '/../README.md', // FULL PATH, not relative please
			//'content' => 'Raw content here',
			),
		),
	);
	Redux::setSection($opt_name, $section);
}
/*
 * <--- END SECTIONS
 */


/*
 *
 * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
 *
 */

/*
 *
 * --> Action hook examples
 *
 */

// If Redux is running as a plugin, this will remove the demo notice and links
//add_action( 'redux/loaded', 'remove_demo' );
// Function to test the compiler hook and demo CSS output.
// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
//add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);
// Change the arguments after they've been declared, but before the panel is created
//add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );
// Change the default value of a field after it's been set, but before it's been useds
//add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );
// Dynamically add a section. Can be also used to modify sections/fields
//add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

/**
 * This is a test function that will let you see when the compiler hook occurs.
 * It only runs if a field    set with compiler=>true is changed.
 * */
if (!function_exists('compiler_action')) {

	function compiler_action($options, $css, $changed_values) {
		echo '<h1>The compiler hook has run!</h1>';
		echo "<pre>";
		print_r($changed_values); // Values that have changed since the last save
		echo "</pre>";
		//print_r($options); //Option values
		//print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
	}

}

/**
 * Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')) {

	function redux_validate_callback_function($field, $value, $existing_value) {
		$error = false;
		$warning = false;

		//do your validation
		if ($value == 1) {
			$error = true;
			$value = $existing_value;
		} elseif ($value == 2) {
			$warning = true;
			$value = $existing_value;
		}

		$return['value'] = $value;

		if ($error == true) {
			$field['msg'] = 'your custom error message';
			$return['error'] = $field;
		}

		if ($warning == true) {
			$field['msg'] = 'your custom warning message';
			$return['warning'] = $field;
		}

		return $return;
	}

}

/**
 * Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')) {

	function redux_my_custom_field($field, $value) {
		print_r($field);
		echo '<br/>';
		print_r($value);
	}

}

/**
 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
 * so you must use get_template_directory_uri() if you want to use any of the built in icons
 * */
if (!function_exists('dynamic_section')) {

	function dynamic_section($sections) {
		//$sections = array();
		$sections[] = array(
			'title' => __('Section via hook', 'redux-framework-demo'),
			'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
			'icon' => 'el el-paper-clip',
			// Leave this as a blank section, no options just some intro text set above.
			'fields' => array()
		);

		return $sections;
	}

}

/**
 * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
 * */
if (!function_exists('change_arguments')) {

	function change_arguments($args) {
		//$args['dev_mode'] = true;

		return $args;
	}

}

/**
 * Filter hook for filtering the default value of any given field. Very useful in development mode.
 * */
if (!function_exists('change_defaults')) {

	function change_defaults($defaults) {
		$defaults['str_replace'] = 'Testing filter hook!';

		return $defaults;
	}

}

/**
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 */
if (!function_exists('remove_demo')) {

	function remove_demo() {
		// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
		if (class_exists('ReduxFrameworkPlugin')) {
			remove_filter('plugin_row_meta', array(
				ReduxFrameworkPlugin::instance(),
				'plugin_metalinks'
				), null, 2);

			// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
			remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
		}
	}

}