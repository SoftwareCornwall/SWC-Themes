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
	
	
	// if ( post_type_exists( 'professors' ) ) {

	// 	$types = get_terms('course_discipline', 'hide_empty=0');
	// 	$types_array[0] = 'All Disciplines';
	
	// 	if($types) {
	// 		foreach($types as $type) {
	// 			$types_array[$type->term_id] = $type->name;
	// 		}
	// 	}
	// } 
	
	$prefix = 'sd_';
	
	// if ( post_type_exists( 'professors' ) ) {
	// 	$meta_boxes[] = array(
	// 		'id' => 'professors_page_options',
	// 		'title' => 'Professors Template Options',
	// 		'pages' => array( 'page' ),
	// 		'context' => 'normal',
	// 		'fields' => array(

	// 			array(
	// 				'name' => 'Select Professors Disciplines',
	// 				'id'   => $prefix . "professors-taxonomies",
	// 				'type' => 'checkbox_list',
	// 				// Options of checkboxes, in format 'value' => 'Label'
	// 				'options' => $types_array,
	// 				'desc' => 'Optional. Only if you use this page as a professors page. Choose which professors discipline you want to display on this page (If Professors Template is chosen).'
	// 					)
	// 			)
	// 		);
	// }
	
	// if ( post_type_exists( 'events' ) ) {
	// 	$meta_boxes[] = array(
	// 		'id' => 'events_page_options',
	// 		'title' => 'Professors Template Options',
	// 		'pages' => array( 'events' ),
	// 		'context' => 'normal',
	// 		'fields' => array(

	// 			array(
	// 				'name' => __( 'Event Date', 'sd-framework' ),
	// 				'id'   => $prefix . "event_date",
	// 				'type' => 'date',
	// 				'desc' => __( 'Insert the event date', 'sd-framework' ),
	// 				'js_options' => array(
	// 								'autoSize'        => true,
	// 								'dateFormat'      => __( 'MM d, yy', 'sd-framework' ),
	// 								'showButtonPanel' => true,
	// 							),
	// 				),
	
	// 			array(
	// 			'name' => __( 'From', 'sd-framework' ),
	// 			'id'   => $prefix . "event_time_from",
	// 			'type' => 'time',
	// 			'js_options' => array(
	// 							'timeFormat' => 'hh:mm tt',
	// 							'ampm' => true
	// 							),
	// 			),
	// 			array(
	// 			'name' => __( 'To', 'sd-framework' ),
	// 			'id'   => $prefix . "event_time_to",
	// 			'type' => 'time',
	// 			'js_options' => array(
	// 							'timeFormat' => 'hh:mm tt',
	// 							'ampm' => true
	// 							),
	// 			),
	// 		)
	// 	);
	// }
	
	// if ( post_type_exists( 'professors' ) ) {
	// 	$meta_boxes[] = array(
	// 		'id' => 'professors_meta_options',
	// 		'title' => 'Professor Options',
	// 		'pages' => array( 'professors' ),
	// 		'context' => 'normal',
	// 		'fields' => array(
	
	// 			array(
	// 				'name' => 'Email Address',
	// 				'id'   => $prefix . "professor_email",
	// 				'type' => 'text',
	// 				'desc' => 'Professor\'s Email Address.'
	// 				),
	// 			array(
	// 				'name' => 'Facebook URL',
	// 				'id'   => $prefix . "professor_facebook",
	// 				'type' => 'text',
	// 				'desc' => 'Professor\'s Facebook URL.'
	// 				),
	// 			array(
	// 				'name' => 'Twitter URL',
	// 				'id'   => $prefix . "professor_twitter",
	// 				'type' => 'text',
	// 				'desc' => 'Professor\'s Twitter URL.'
	// 				),
	// 			array(
	// 				'name' => 'Google Plus URL',
	// 				'id'   => $prefix . "professor_google",
	// 				'type' => 'text',
	// 				'desc' => 'Professor\'s Google Plus URL.'
	// 				),
	// 			array(
	// 				'name' => 'Skype Id',
	// 				'id'   => $prefix . "professor_skype",
	// 				'type' => 'text',
	// 				'desc' => 'Professor\'s Skype Id.'
	// 				)
	// 			)
	// 		);
	// }

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
			'pages' => array( 'page', 'post', 'professors', 'courses' ),
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
