<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
*/


function sd_register_meta_boxes( $meta_boxes ) {
	
	$prefix = 'sd_';

	$meta_boxes[] = array(
		'id' => 'page_options',
		'title' => 'Page Options',
		'pages' => array( 'page', 'post'),
		'context' => 'normal',
		'priority' => 'high',

		'fields' => array(
				array(
					'name' => 'Insert a Custom Page title or leave blank for default page title.',
					'id'   => $prefix . "page-title",
					'type' => 'textarea',
					'desc' => 'HTML code accepted.'
				),
				array(
					'name'		=> 'Custom Header Page Background',
					'desc'		=> 'Upload your custom header page background (optimal size 2170x213 for full image)',
					'id'		=> $prefix . "header_page_bg",
					'type'		=> 'image_advanced'
				),
				array(
					'name'		=> 'Background No Repeat',			// checkbox
					'id'		=> $prefix . "no_repeat",
					'type'		=> 'checkbox',
					'std'		=> '0',
					'desc'		=> 'Header background no repeat'
				),
				array(
					'name' => 'Background Repeat Horizontally',			// checkbox
					'id'		=> $prefix . "repeat_x",
					'type'		=> 'checkbox',
					'std'		=> '0',
					'desc'		=> 'Header background repeat horizontaly'
				),
				array(
					'name'		=> 'Background Repeat Vertically',			// checkbox
					'id'		=> $prefix . "repeat_y",
					'type'		=> 'checkbox',
					'std'		=> '0',
					'desc'		=> 'Header background repeat vertically'
			),
		)
	);
	
	if( function_exists('smk_sidebar') ){
		
		$the_sidebars = smk_get_all_sidebars();
	
		$sidebar_options = array();
	
		foreach ( $the_sidebars as $key => $value ) {
			$sidebar_options[] = array($key => $value);
		}
  	
		$sidebar_options = call_user_func_array('array_merge', $sidebar_options);
	
		$meta_boxes[] = array(
			'id' => 'sidebar_options',
			'title' => 'Sidebars',
			'pages' => array( 'page', 'post' ),
			'context' => 'side',
			'priority' => 'low',

			'fields' => array(
				array(
						'name'		=> 'Sidebar',			// checkbox
						'id'		=> $prefix . "smk_sidebar",
						'type'		=> 'select',
						'desc'		=> 'Assign a custom sidebar to your page',
						'options'	=> $sidebar_options
					
					
				)
			)
		);
	}

	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'sd_register_meta_boxes' );
