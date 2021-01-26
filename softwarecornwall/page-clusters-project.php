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

				<div class="sd-title-wrapper">
						<h2 class="sd-styled-title">Latest <span class="sd-light">Clusters Project News</span></h2>
					</div>
					<?php $args = array(
						'posts_per_page' => 6,
						'orderby' => 'date',
						'order' => 'DESC',
						'cat' => get_cat_ID( 'Clusters Project News' )
					);
					$query = new WP_Query( $args ); ?>
					<div class="row">
					<?php if ( $query->have_posts() ) :  while ( $query->have_posts() ) : $query->the_post();?>
						<div class="col-xs-12 col-sm-6 grid-item">
							<header>
								<a href="<?php the_permalink(); ?>" title="<?php get_the_title();?>" rel="bookmark">
									<h3><?php the_title(); ?></h3>
								</a>
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="sd-entry-thumb">
										<figure>
											<?php the_post_thumbnail( 'blog-grid-thumb' ); ?>
										</figure>
									</div>
								<?php endif; ?>
							</header>

							<div class="sd-entry-content">
								<p><?php the_excerpt(); ?></p>
							</div>
						</div>

					<?php endwhile; endif; ?>
					</div>
					<?php
						wp_reset_postdata();
						$category_id = get_cat_ID( 'Clusters Project News' );
						$category_link = get_category_link( $category_id );
					?>
					<div class="sd-center">
						<a href="<?php echo esc_url( $category_link ); ?>" title="Clusters Project News" class="more-link dark-button">View all Clusters Project News</a>
					</div>

					</br></br>
					<h2>European Social Fund</h2>
					<p>The European Social Fund is partially funding Software Cornwall to run this project to help up skill Cornish people, ready to enter the software industry. This course is only available to those from the UK or EU. To participate in the training certain personal information will be required from attendants as proof of employment and eligibility to attend. This information is for the purposes of ensuring that the training will go to the correct participants. You will also be required to complete an evaluation form after the training as part of the attendance.</p>
					<img 
						src="https://softwarecornwall.org/wp-content/uploads/2020/10/ESF_logo.png" 
						alt="European Social Fund Logo" 
						loading="lazy" 
						height="74px" width="360px"
						style="width: 100%;"/>
					</br></br>

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
				</aside>
				<?php get_sidebar(); ?>
			</div>
			<!--sidebar end--> 
		</div>
	</div>
</div>
<?php get_footer(); ?>
