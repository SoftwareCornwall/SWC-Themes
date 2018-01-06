<div class="sd-search-courses clearfix">
	<div class="container">
		<h2><?php _e( 'Search Courses', 'sd-framework' ); ?></h2>
    	
		<?php 
		$args = sd_wp_advanced_search();
		$sd_search_course = new WP_Advanced_Search( $args );
		
		$sd_search_course->the_form();
		?>
    
    </div>
</div>