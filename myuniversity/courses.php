<?php 
/* ------------------------------------------------------------------------ */
/* Template name: Page: Courses
/* ------------------------------------------------------------------------ */
get_header();
?>

<div class="sd-blog-page">
	<div class="container">
		<div class="row"> 
			<!--left col-->
			<div class="col-md-<?php if ( $sd_data['sd_courses_layout'] == '2' ) echo '12'; else echo '8'; ?> <?php if ( $sd_data['sd_sidebar_location'] == '2' ) echo 'pull-right'; ?>">
				<div class="sd-left-col">
					<?php 
		global $more;
		$more = 0;
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		$args = array(
			'post_type' => 'courses',
			'post_status' => 'publish',
			'orderby' => 'date',
			'order' => 'DESC',
			'paged' => $paged
			);
		
		$wp_query = new WP_Query( $args );
		
		if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
	?>
					
					<?php get_template_part( 'framework/inc/post-formats/courses/content', get_post_format() ); ?>
					<?php endwhile; else: ?>
					<p>
						<?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>
						.</p>
					<?php endif; wp_reset_postdata(); ?>
					<!--pagination-->
					<?php if ( $sd_data['sd_pagination_type'] == '1' ) : ?>
						<?php if ( get_previous_posts_link() ) : ?>
						<div class="sd-nav-previous">
							<?php previous_posts_link( $sd_data['sd_courses_prev'] ); ?>
						</div>
						<?php endif; ?>
						<?php if ( get_next_posts_link() ) : ?>
						<div class="sd-nav-next">
							<?php next_posts_link( $sd_data['sd_courses_next'] ); ?>
						</div>
						<?php endif; ?>
					<?php else : sd_custom_pagination(); endif; ?>
					<!--pagination end--> 
				</div>
			</div>
			<!--left col end--> 
			<?php if ( $sd_data['sd_courses_layout'] !== '2' ) : ?>
			<!--sidebar-->
			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div>
			<!--sidebar end--> 
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
