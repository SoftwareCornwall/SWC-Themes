<?php 
/* ------------------------------------------------------------------------ */
/* Theme Employer Led skills page
/* ------------------------------------------------------------------------ */
get_header(); 
?>
<!--left col-->

<div class="sd-blog-page">
	<div class="container">
		<div class="row"> 
			<!--left col-->
			<div class="col-md-8 <?php if ( $sd_data['sd_sidebar_location'] == '2' ) echo 'pull-right'; ?>">
				<?php if (have_posts()) : while (have_posts()) : the_post();?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-entry page-entry clearfix' ); ?>> 
						<!-- entry content -->
						<div class="entry-content els-page-entry-content">
							<?php the_content(); ?>
						</div>
						<!-- entry content end--> 
					</article>
					<!--post-end-->
				<?php endwhile; else: ?>
					<p><?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>.</p>
				<?php endif; ?>
				
				<div class="row">
					<?php 
					$args = array(
						'posts_per_page' => 4,
						'orderby' => 'date',
						'order' => 'DESC',
						'cat' => get_cat_ID( 'Employer Led Skills Training Courses' ),
						'post_type' => 'post',
						'posts_per_page' => -1,
						'meta_query' => array(
							array(
								'key' => 'training_is_live',
								'value' => 'on',
							)
						),
					);
					$query = new WP_Query( $args );
						
					if ( $query->have_posts() ) :  ?>
						<br />
						<div class="col-xs-12 col-sm-12">
							<h2>Upcoming Training Courses</h2>
						</div>
						
						<?php while ( $query->have_posts() ) : $query->the_post();?>
						<br /><br />
						<div class="col-xs-12">
							<div class="row">
								<?php get_template_part( 'partials/training-list-item-small-with-date' ); ?>
							</div>
						</div>
					
					<?php endwhile; endif; wp_reset_postdata();

					$second_query = new WP_Query( 
						array(
							'post_type' => 'post',
							'cat' => '192,258',
							'relation' => 'OR',
							'posts_per_page' => -1,
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

					if ( $second_query->have_posts() ) : ?> 

						<br />
						<div class="col-xs-12 col-sm-12">
							<h2>Our Training Prospectus</h2>
							<p>Based upon feedback from Cornwall's tech community, we're able to offer the following partially funded training courses. The course dates, price and availability will be determined based on volume of interest.</p>
						</div>
					
					<?php while ( $second_query->have_posts() ) : $second_query->the_post(); ?>

						<br /><br />
						<div class="col-xs-12">
							<div class="row">
								<?php get_template_part( 'partials/training-list-item-prospectus' ); ?>
							</div>
						</div>

					<?php endwhile; endif; wp_reset_postdata(); ?>
				</div>
			</div>

			<!--sidebar-->
			<div class="col-md-4">
				<aside id="recent-posts-2" class="sd-sidebar-widget clearfix widget_recent_entries">
					<div class="sd-title-wrapper">
						<h3 class="sd-styled-title">Part <span class="sd-light">Financed By:</span></h3>
					</div>
					<img 
						src="https://softwarecornwall.org/wp-content/uploads/2020/10/ESF_logo.png" 
						alt="European Social Fund Logo" 
						loading="lazy" 
						height="74px" width="360px"
						style="width: 100%;"/>
					</br></br>
					<div class="sd-title-wrapper">
						<h3 class="sd-styled-title">Latest <span class="sd-light">ELS News</span></h3>
					</div>
					<?php $args = array(
						'posts_per_page' => 6,
						'orderby' => 'date',
						'order' => 'DESC',
						'cat' => get_cat_ID( 'Employer Led Skills News' )
					);
					$query = new WP_Query( $args );
						
					if ( $query->have_posts() ) :  while ( $query->have_posts() ) : $query->the_post();?>
						<div class="sd-recent-posts-widget">
							<?php if (  ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() )  ) : ?>
								<div class="sd-recent-widget-thumb">
									<figure>
										<?php the_post_thumbnail( 'thumbnail' ); ?>
									</figure>
								</div>
							<?php endif; ?>

							<div class="sd-recent-posts-content clearfix">
								<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_title(); ?>
									</a> </h4>
								<span class="sd-recent-date"> <?php echo get_the_date( get_option( 'date_format' ) ); ?> </span></br></p>
							</div>
							<div class="sd-entry-content clearfix">
								<p><?php echo wp_trim_words( get_the_content(), 34, ' ...' ); ?>
								<a class="sidebar-inline-more-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read More</a></p>
							</div>
							</br>
						</div>

					<?php endwhile; endif; 
						wp_reset_postdata();
						$category_id = get_cat_ID( 'Employer Led Skills News' );
						$category_link = get_category_link( $category_id );
					?>
					<div class="sd-center">
						<a href="<?php echo esc_url( $category_link ); ?>" title="Employer Led Skills News" class="more-link dark-button">View all Employer Led Skills News</a>
					</div>
				</aside>
			</div>
			<!--sidebar end--> 
		</div>
	</div>
</div>
<?php get_footer(); ?>
