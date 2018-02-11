<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category Ronneby theme
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_filter( 'cmb_meta_boxes', 'cmb_headers_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function dfd_cmb_convert_option($options, $default_text) {
	$return = array();
	if( is_array($options) ){
		array_unshift( $options, $default_text );
		foreach($options as $v => $k) {
			$result = array();
			$result['name'] = $k;
			$result['value'] = $v;
			$return[] = $result;
		}
	}
	return $return;
}

function cmb_headers_metaboxes( array $meta_boxes ) {

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'dfd_headers_';
	
	$the_headers = dfd_headers_type();
	$logo_position = dfd_logo_position();
	$menu_position = dfd_menu_position();
	
   
	$meta_boxes[] = array(
        'id'         => 'dfd-select_header',
        'title'      => __('Header style', 'dfd'),
        'pages'      =>  array('page','post','my-product','product','gallery'),
        'context'    => 'side',
        'priority'   => 'default',
        'show_names' => true, // Show field names on the left
        'fields'     => array(         
            array(
                'type' => 'select',
                'id' =>  $prefix.'header_style',
                'name' => 'Select header style',
				'options' => dfd_cmb_convert_option($the_headers, __('Header style is not selected', 'dfd')),
            ),
            array(
                'type' => 'select',   
                'id' =>  $prefix.'logo_position',
                'name' => 'Select logo position',
				'options' => dfd_cmb_convert_option($logo_position, __('Logo position is not selected', 'dfd')),
            ),
            array(
                'type' => 'select',   
                'id' =>  $prefix.'menu_position',
                'name' => 'Select menu position',
				'options' => dfd_cmb_convert_option($menu_position, __('Menu position is not selected', 'dfd')),
            ),
			/*array(
                'name' => 'Top_Header',
				'desc'	=> '',
                'id' =>  $prefix.'show_top_header',
				'type'	=> 'radio_inline',
                'std'  => 'Left Sidebar',
				'options' => array(
					array(
						'name' => __('On', 'dfd'),
						'value' => 'on',
					),
					array(
						'name' => __('Off', 'dfd'),
						'value' => 'off',
					),
				),
			),*/
			array(
				'type'	=> 'radio_inline_triple',
                'id' =>  $prefix.'show_side_area',
                'name' => 'Side area',
				'options' => array(
					array('name' => __('Enable', 'dfd'), 'value' => 'on',),
					array('name' => __('Disable', 'dfd'), 'value' => 'off',),
				),
			),
			array(
				'type'	=> 'radio_inline_triple',
                'id' =>  $prefix.'show_top_inner_apge',
                'name' => 'Top inner page',
				'options' => array(
					array('name' => __('Enable', 'dfd'), 'value' => 'on',),
					array('name' => __('Disable', 'dfd'), 'value' => 'off',),
				),
			),
        ),
    );

    // Add other metaboxes as needed

    return $meta_boxes;
}