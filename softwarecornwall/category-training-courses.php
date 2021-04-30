
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
							<h2 class="sd-styled-title">Upcoming Training <span class="sd-light">Courses</span></h2>
						</div>
					</div>
					<?php 
					$my_query = new WP_Query( 
						array(
							'post_type' => 'post',
							'posts_per_page' => -1,
							"orderby" => 'meta_value_date',
							"meta_key" => 'training_start_date',
							"order" => 'ASC',
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
							</br></br>
							<h2 class="sd-styled-title">Our Training <span class="sd-light">Prospectus</span></h2>
							<p>Based upon feedback from Cornwall's tech community, we're able to offer the following partially funded training courses. The course dates, price and availability will be determined based on volume of interest.</p>
						</div>
					</div>

					<?php wp_reset_query(); 
					
					$second_query = new WP_Query( 
						array(
							'post_type' => 'post',
							'cat' => '192,258',
							'posts_per_page' => -1,
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
					);?>

					<div class="col-xs-12">
						<div class="row auto-clear">
							<?php if ( $second_query->have_posts() ) :  while ( $second_query->have_posts() ) : $second_query->the_post();
							if (metadata_exists('post', get_the_ID(), 'training_delivered_by') && !metadata_exists('post', get_the_ID(), 'training_is_live')) : ?>
								<div class="col-sm-6 col-md-4 col-lg-3 sd-entry-content">
									<h3 class="sd-entry-title"><a href="<?php the_permalink(); ?>" title="<?php get_the_title();?>" rel="bookmark"><?php the_title(); ?></a></h3>
									<p>Delivered By: <?php $training_delivered_by = get_post_meta($post->ID, 'training_delivered_by', true); if ($training_delivered_by) {  echo $training_delivered_by; }?></p>
									<?php if ( ( function_exists( 'has_post_thumbnail') ) && ( has_post_thumbnail() ) ) : ?>
										<figure>
											<?php the_post_thumbnail( 'blog-grid-thumb', ['height' => 'auto', 'width' => '100%'] ); ?>
										</figure>
									<?php endif; ?>
									<?php the_excerpt('View Course'); ?>
								</div>
							<?php endif; endwhile; else: ?>
								<div class="col-sm-6 col-md-4 col-lg-3 sd-entry-content">
									<p><?php _e( 'Sorry, there are no upcoming training courses.', 'sd-framework' ) ?>.</p>
								</div>
							<?php endif; wp_reset_postdata();?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
