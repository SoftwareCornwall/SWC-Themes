<?php 
/* ------------------------------------------------------------------------ */
/* Theme Mission to Mars Page
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
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
						<!-- entry content end--> 
					</article>
					<!--post-end-->
				<?php endwhile; else: ?>
					<p><?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>.</p>
				<?php endif; ?>
				
				<div class="row">
				<br /><br />
					<div class="col-xs-12 col-sm-12">
						<h2>Upcoming and Recent Missions</h2>
					</div>
					<br /><br />
					<?php 
					$args = array(
						'posts_per_page' => 4,
						'orderby' => 'date',
						'order' => 'DESC',
						'cat' => get_cat_ID( 'Mission to Mars' )
					);
					$query = new WP_Query( $args );
						
					if ( $query->have_posts() ) :  while ( $query->have_posts() ) : $query->the_post();?>
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

					<?php endwhile; endif; 
						wp_reset_postdata();
						$category_id = get_cat_ID( 'Mission to Mars' );
						$category_link = get_category_link( $category_id );
					?>
					<div class="col-xs-12 col-sm-12">
						<a href="<?php echo esc_url( $category_link ); ?>" title="Mission to Mars Activities" class="more-link dark-button">View all Missions</a>
						<br /><br />
					</div>
				</div>


				<div class="row">
				<br /><br />
					<div class="col-xs-12 col-sm-12">
						<h2>Latest Mission to Mars News</h2>
					</div>
					<br /><br />
					<?php 
					$args = array(
						'posts_per_page' => 6,
						'orderby' => 'date',
						'order' => 'DESC',
						'cat' => get_cat_ID( 'Mission to Mars News' )
					);
					$query = new WP_Query( $args );
						
					if ( $query->have_posts() ) :  while ( $query->have_posts() ) : $query->the_post();?>
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

					<?php endwhile; endif; 
						wp_reset_postdata();
						$category_id = get_cat_ID( 'Mission to Mars News' );
						$category_link = get_category_link( $category_id );
					?>
					<div class="col-xs-12 col-sm-12">
						<a href="<?php echo esc_url( $category_link ); ?>" title="Mission to Mars News" class="more-link dark-button">View all Mission to Mars News</a>
						<br /><br />
					</div>
				</div>
					

			</div>

			<!--sidebar-->
			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div>
			<!--sidebar end--> 
		</div>
	</div>
</div>
<?php get_footer(); ?>
