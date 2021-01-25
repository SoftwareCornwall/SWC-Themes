
<?php
/* ------------------------------------------------------------------------ //
 * Theme File: Category - Training
 * Template Post Type: category
/* ------------------------------------------------------------------------ */
get_header();
?>

<!-- Theme File: Category - Training -->
<div class="sd-blog-page">
	<div class="container">
		<div class="row"> 
			<?php 
			if (category_description()) {
				the_archive_description('<div class="col-sm-10 col-sm-offset-1 category-description-wrapper" style="text-align: center;">', '</div>');
			} ?>
			
			<div class="col-xs-12">
				<div class="row" id="post-wrapper">
					<div class="col-xs-12">
						<div class="sd-title-wrapper">
							<h3 class="sd-styled-title">Upcoming Training <span class="sd-light">Courses</span></h3>
						</div>
					</div>
					<?php 
					$my_query = new WP_Query( 
						array(
							'post_type' => 'post',
							'meta_query' => array(
								array(
									'key' => 'training_is_live',
									'value' => 'on',
								)
						    ),
						) 
					);
						
					if ( $my_query->have_posts() ) :  while ( $my_query->have_posts() ) : $my_query->the_post();
						get_template_part( 'partials/training-list-item' );
					endwhile; else: ?>
						<p><?php _e( 'Sorry, there are no upcoming training courses.', 'sd-framework' ) ?>.</p>
					<?php endif; wp_reset_postdata();?>
					
					<div class="col-xs-12">
						<div class="sd-title-wrapper">
							<h3 class="sd-styled-title">Our Training <span class="sd-light">Prospectus</span></h3>
							<p>Based upon feedback from Cornwall's tech community, we're able to offer the following partially funded training courses. The course dates, price and availability will be determined based on volume of interest.</p>
						</div>
					</div>

					<?php wp_reset_query(); 
					
					$second_query = new WP_Query( 
						array(
							'post_type' => 'post',
							'cat' => '336,353',
							'relation' => 'OR', 
							array(
								'key' => 'training_is_live',
								'compare' => 'NOT EXISTS'
							),
							array(
								'key' => 'training_is_live',
								'value' => '_wp_zero_value',
								'compare' => '='
							)
						) 
					);

					if ( $second_query->have_posts() ) :  while ( $second_query->have_posts() ) : $second_query->the_post(); ?>
						<div class="col-sm-6 col-md-4 col-lg-3 sd-entry-content">
							<h3 class="sd-entry-title"><a href="<?php the_permalink(); ?>" title="<?php get_the_title();?>" rel="bookmark"><?php the_title(); ?></a></h3>
							<?php if ( ( function_exists( 'has_post_thumbnail') ) && ( has_post_thumbnail() ) ) : ?>
								<figure>
									<?php the_post_thumbnail( 'blog-grid-thumb', ['height' => 'auto', 'width' => '100%'] ); ?>
								</figure>
							<?php endif; ?>
							<?php the_excerpt('View Course'); ?>
						</div>
					<?php endwhile; else: ?>
						<p><?php _e( 'Sorry, there are no upcoming training courses.', 'sd-framework' ) ?>.</p>
					<?php endif; wp_reset_postdata();?>
				
					

				</div>
			</div>

			<div class="col-sm-10 col-sm-offset-1 category-description-wrapper" style="text-align: center;">
				<!--pagination-->
				<?php if ( $sd_data['sd_pagination_type'] == '1' ) : ?>
					<?php if ( get_previous_posts_link() ) : ?>
						<div class="sd-nav-previous">
							<?php previous_posts_link( $sd_data['sd_blog_prev'] ); ?>
						</div>
					<?php endif; ?>
					<?php if ( get_next_posts_link() ) : ?>
						<div class="sd-nav-next">
							<?php next_posts_link( $sd_data['sd_blog_next'] ); ?>
						</div>
					<?php endif; ?>
				<?php else : sd_custom_pagination(); endif; ?>
				<!--pagination end--> 
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
