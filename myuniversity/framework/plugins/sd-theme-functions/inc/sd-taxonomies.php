<?php
/* ----------------------------------------------------- */
/* Courses Taxonomies */
/* ----------------------------------------------------- */

if ( !function_exists( 'sd_courses_taxonomies' ) ) {
	function sd_courses_taxonomies() {
		
		global $sd_data;
		
		// course discipline
		
		$sd_course_discipline_name = ( !empty( $sd_data['sd_discipline_name'] ) ? $sd_data['sd_discipline_name'] : _x( 'Discipline', 'sd-framework' ) );
		$sd_course_discipline_slug = ( !empty( $sd_data['sd_discipline_slug'] ) ? $sd_data['sd_discipline_slug'] : 'course-discipline' );
		
		$labels_course_discipline = array(
			'name'              => $sd_course_discipline_name,
			'singular_name'     => $sd_course_discipline_name,
			'search_items'      => __( 'Search ', 'sd-framework' ) . $sd_course_discipline_name,
			'all_items'         => __( 'All ', 'sd-framework' ) . $sd_course_discipline_name,
			'edit_item'         => __( 'Edit ', 'sd-framework' ) . $sd_course_discipline_name,
			'update_item'       => __( 'Update ', 'sd-framework' ) . $sd_course_discipline_name,
			'add_new_item'      => __( 'Add New ', 'sd-framework' ) . $sd_course_discipline_name,
			'new_item_name'     => __( 'New', 'sd-framework' ) . $sd_course_discipline_name . __( 'Name', 'sd-framework' ),
			'menu_name'         => $sd_course_discipline_name
		);
	
		$args_course_discipline = array(
			'hierarchical'      => true,
			'labels'            => $labels_course_discipline,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => $sd_course_discipline_slug )
		);
		
		register_taxonomy( 'course_discipline', array( 'courses', 'professors' ), $args_course_discipline );
		
		// course length
		
		$sd_course_length_name = ( !empty( $sd_data['sd_course_length_name'] ) ? $sd_data['sd_course_length_name'] : _x( 'Course Length', 'sd-framework' ) );
		$sd_course_length_slug = ( !empty( $sd_data['sd_course_length_slug'] ) ? $sd_data['sd_course_length_slug'] : 'course-length' );
		
		$labels_course_length = array(
			'name'              => $sd_course_length_name,
			'singular_name'     => $sd_course_length_name,
			'search_items'      => __( 'Search ', 'sd-framework' ) . $sd_course_length_name,
			'all_items'         => __( 'All ', 'sd-framework' ) . $sd_course_length_name,
			'edit_item'         => __( 'Edit ', 'sd-framework' ) . $sd_course_length_name,
			'update_item'       => __( 'Update ', 'sd-framework' ) . $sd_course_length_name,
			'add_new_item'      => __( 'Add New ', 'sd-framework' ) . $sd_course_length_name,
			'new_item_name'     => __( 'New', 'sd-framework') . $sd_course_length_name . __( 'Name', 'sd-framework' ),
			'menu_name'         => $sd_course_length_name
		);
	
		$args_course_length = array(
			'hierarchical'      => true,
			'labels'            => $labels_course_length,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => $sd_course_length_slug )
		);
		
		register_taxonomy( 'course_length', array( 'courses' ), $args_course_length );
		
		// study level
		
		$sd_study_level_name = ( !empty( $sd_data['sd_study_level_name'] ) ? $sd_data['sd_study_level_name'] : _x( 'Study Level', 'sd-framework' ) );
		$sd_study_level_slug = ( !empty( $sd_data['sd_study_level_slug'] ) ? $sd_data['sd_study_level_slug'] : 'study-level' );
		
		$labels_course_level = array(
			'name'              => $sd_study_level_name,
			'singular_name'     => $sd_study_level_name,
			'search_items'      => __( 'Search ', 'sd-framework' ) . $sd_study_level_name,
			'all_items'         => __( 'All ', 'sd-framework' ) . $sd_study_level_name,
			'edit_item'         => __( 'Edit ', 'sd-framework' ) . $sd_study_level_name,
			'update_item'       => __( 'Update ', 'sd-framework' ) . $sd_study_level_name,
			'add_new_item'      => __( 'Add New ', 'sd-framework' ) . $sd_study_level_name,
			'new_item_name'     => __( 'New', 'sd-framework' ) . $sd_study_level_name . __( 'Name', 'sd-framework' ),
			'menu_name'         => $sd_study_level_name
		);
	
		$args_course_level = array(
			'hierarchical'      => true,
			'labels'            => $labels_course_level,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => $sd_study_level_slug )
		);
		
		register_taxonomy( 'course_level', array( 'courses' ), $args_course_level );
		
		// course location
		
		$sd_course_location_name = ( !empty( $sd_data['sd_campus_location_name'] ) ? $sd_data['sd_campus_location_name'] : _x( 'Course Location', 'sd-framework' ) );
		$sd_course_location_slug = ( !empty( $sd_data['sd_campus_location_slug'] ) ? $sd_data['sd_campus_location_slug'] : 'course-location' );
		
		$labels_course_location = array(
			'name'              => $sd_course_location_name,
			'singular_name'     => $sd_course_location_name,
			'search_items'      => __( 'Search ', 'sd-framework' ) . $sd_course_location_name,
			'all_items'         => __( 'All ', 'sd-framework' ) . $sd_course_location_name,
			'edit_item'         => __( 'Edit ', 'sd-framework' ) . $sd_course_location_name,
			'update_item'       => __( 'Update ', 'sd-framework' ) . $sd_course_location_name,
			'add_new_item'      => __( 'Add New ', 'sd-framework' ) . $sd_course_location_name,
			'new_item_name'     => __( 'New', 'sd-framework') . $sd_course_location_name . __( 'Name', 'sd-framework' ),
			'menu_name'         => $sd_course_location_name
		);
	
		$args_course_location = array(
			'hierarchical'      => true,
			'labels'            => $labels_course_location,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => $sd_course_location_slug )
		);
		
		register_taxonomy( 'course_location', array( 'courses'), $args_course_location );
		
		// course ID
		
		$labels_course_id = array(
			'name'              => _x( 'Course ID', 'sd-framework' ),
			'singular_name'     => _x( 'Course ID', 'sd-framework' ),
			'search_items'      => __( 'Search Course ID', 'sd-framework' ),
			'all_items'         => __( 'All Course IDs', 'sd-framework' ),
			'edit_item'         => __( 'Edit Course ID', 'sd-framework' ),
			'update_item'       => __( 'Update Course ID', 'sd-framework' ),
			'add_new_item'      => __( 'Add New Course ID', 'sd-framework' ),
			'new_item_name'     => __( 'New Course ID Name', 'sd-framework' ),
			'menu_name'         => __( 'Course ID', 'sd-framework' )
		);
	
		$args_course_id = array(
			'hierarchical'      => true,
			'labels'            => $labels_course_id,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'course-id' )
		);
		
		register_taxonomy( 'course_id', array( 'courses' ), $args_course_id );
		
		// event location
		
		$labels_course_location = array(
			'name'              => _x( 'Event Location', 'sd-framework' ),
			'singular_name'     => _x( 'Event Location', 'sd-framework' ),
			'search_items'      => __( 'Search Event Location', 'sd-framework' ),
			'all_items'         => __( 'All Event Location', 'sd-framework' ),
			'edit_item'         => __( 'Edit Event Location', 'sd-framework' ),
			'update_item'       => __( 'Update Event Location', 'sd-framework' ),
			'add_new_item'      => __( 'Add New Event Location', 'sd-framework' ),
			'new_item_name'     => __( 'New Event Location Name', 'sd-framework' ),
			'menu_name'         => __( 'Event Location', 'sd-framework' )
		);
	
		$args_course_location = array(
			'hierarchical'      => true,
			'labels'            => $labels_course_location,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'event-location' )
		);
		
		register_taxonomy( 'event_location', array( 'events'), $args_course_location );
		
		// professors
		
		$labels_professors = array(
			'name'              => _x( 'Professors', 'sd-framework' ),
			'singular_name'     => _x( 'Professor', 'sd-framework' ),
			'search_items'      => __( 'Search Professors', 'sd-framework' ),
			'all_items'         => __( 'All Professors', 'sd-framework' ),
			'edit_item'         => __( 'Edit Professor', 'sd-framework' ),
			'update_item'       => __( 'Update Professor', 'sd-framework' ),
			'add_new_item'      => __( 'Add New Professor', 'sd-framework' ),
			'new_item_name'     => __( 'New Professor', 'sd-framework' ),
			'menu_name'         => __( 'Professors', 'sd-framework' )
		);
	
		$args_professors = array(
			'hierarchical'      => true,
			'labels'            => $labels_professors,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'professors-testimonials' )
		);
		
		register_taxonomy( 'professors_tax', array( 'testimonials' ), $args_professors );
		
		
		
	}
	add_action( 'init', 'sd_courses_taxonomies' );
}