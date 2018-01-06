<?php
/* ------------------------------------------------------------------------ */
/* WP Advanced Search
/* ------------------------------------------------------------------------ */

if ( !function_exists( 'sd_wp_advanced_search' ) ) {	
	function sd_wp_advanced_search() {
		
		global $sd_data;
	
		$args = array();
			
		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		
		$results_page_id = $sd_data['sd_search_courses_results'];

		$args['form'] = array( 'action' => get_permalink( $results_page_id )  );
		
		$sd_fields = $sd_data['sd_search_fields'];
						
		$args['wp_query'] = array( 'post_type' => 'courses',
					                              'order' => 'DESC',
												  'orderby' => 'date',
												  'paged' => $paged );
		
		if ( $sd_fields[1] == '1' ) {
			
			$args['fields'][] = array('type' 	   => 'taxonomy',
									  'taxonomy'   => 'course_discipline',
									  'format'	   => 'select',
									  'allow_null' => $sd_data['sd_discipline_name'],
									  'operator'   => 'AND'
									  );
		}
		
		if ( $sd_fields[2] == '1' ) {

			$args['fields'][] = array('type' 	   => 'taxonomy',
									  'taxonomy'   => 'course_length',
									  'format'	   => 'select',
									  'allow_null' => $sd_data['sd_course_length_name'],
									  'operator'   => 'AND'
									  );
		}
				
		if ( $sd_fields[3] == '1' ) {										
		
			$args['fields'][] = array('type' 	   => 'taxonomy',
									  'taxonomy'   => 'course_level',
									  'format'	   => 'select',
									  'allow_null' => $sd_data['sd_study_level_name'],
									  'operator'   => 'AND'
									  );
		}
		
		if ( $sd_fields[4] == '1' ) {

			$args['fields'][] = array('type' 	   => 'taxonomy',
									  'taxonomy'   => 'course_location',
									  'format'	   => 'select',
									  'allow_null' => $sd_data['sd_campus_location_name'],
									  'operator'   => 'AND'
									  );
		}
		
		if ( $sd_fields[5] == '1' ) {
			
			$args['fields'][] = array('type'  => 'search',
									  'label' => '',
									  'value' => ''
									  );
		}

		$args['fields'][] = array('type'  => 'submit',
			                      'value' => __('Search', 'sd-framework')
								  );
												
		return $args;
												
	}
}