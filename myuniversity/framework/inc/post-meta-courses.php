<?php
/* ------------------------------------------------------------------------ */
/* Post Meta Courses
/* ------------------------------------------------------------------------ */
global $sd_data;
?>
<!-- course post  meta -->

<aside class="sd-entry-meta sd-course-meta clearfix">
	<ul>
		<?php if ( $sd_data['sd_courses_post_meta'][1] == '1' ) : ?>
		<?php echo  get_the_term_list( $post->ID, 'course_id', '<li class="sd-meta-course-id">'. __( 'ID:', 'sd-framework' ) .' ', ', ', '</li>' ) ?>
		<?php endif; ?>
		
		<?php if ( $sd_data['sd_courses_post_meta'][2] == '1' ) : ?>
		<?php echo  get_the_term_list( $post->ID, 'course_discipline', '<li class="sd-meta-course-discipline"><i class="fa fa-pencil"></i>  ', ', ', '</li>' ) ?>
		<?php endif; ?>
		
		<?php if ( $sd_data['sd_courses_post_meta'][3] == '1' ) : ?>
		<?php echo  get_the_term_list( $post->ID, 'course_level', '<li class="sd-meta-course-level"><i class="fa fa-book"></i> ', ', ', '</li>' ) ?>
		<?php endif; ?>
		
		<?php if ( $sd_data['sd_courses_post_meta'][4] == '1' ) : ?>
		<?php echo  get_the_term_list( $post->ID, 'course_length', '<li class="sd-meta-course-length"><i class="fa fa-calendar"></i>  ', ', ', '</li>' ) ?>
		<?php endif; ?>
		
		<?php if ( $sd_data['sd_courses_post_meta'][5] == '1' ) : ?>
		<?php echo  get_the_term_list( $post->ID, 'course_location', '<li class="sd-meta-course-location"><i class="fa fa-building-o"></i>  ', ', ', '</li>' ) ?>
		<?php endif; ?>
		
		<?php if ( $sd_data['sd_courses_post_meta'][6] == '1' ) : ?>
		<?php $connected = new WP_Query( array(
				  'connected_type' => 'professors_to_courses',
				  'connected_items' => get_the_ID(),
				  'nopaging' => true,
				  'suppress_filters' => false
				) );

			if ( $connected->have_posts() ) : 
			
				echo '<li class="sd-professors-icon"><i class="fa fa-user"></i></li> ';

				while ( $connected->have_posts() ) : $connected->the_post(); 
		?>
		<li class="sd-professor-name">
		<a href="<?php the_permalink(); ?>">
		<?php the_title( '', '' ); ?>
		</a>
		</li>
		<?php 
				endwhile;
				wp_reset_postdata();
		endif; ?>
		<?php endif; ?>
	</ul>
</aside>
<!-- course  post meta end --> 