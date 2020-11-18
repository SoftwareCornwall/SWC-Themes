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
					<?php 
					$args = array(
						'posts_per_page' => 4,
						'orderby' => 'date',
						'order' => 'DESC',
						'cat' => get_cat_ID( 'Employer Led Skills Training Courses' )
					);
					$query = new WP_Query( $args );
						
					if ( $query->have_posts() ) : ?>
					<br />
					<div class="col-xs-12 col-sm-12">
						<h3>Upcoming Employer Led Skills Training Courses</h3>
					</div>
					<br /><br />
					<div class="col-xs-12">
					<table class="table table-striped table-bordered table-condensed">
						<thead> 
							<tr> 
								<th>Course Title</th>
								<th>Location</th>
								<th>Date</th>
								<th>Full Cost</th>
								<th>Member Cost</th>
							</tr>
						</thead>
						<tbody>
						<?php while ( $query->have_posts() ) : $query->the_post();?>
						 <tr> 
							 <td><a href="<?php the_permalink(); ?>" title="<?php get_the_title();?>" rel="bookmark"><?php the_title(); ?></a></td>
							 <td><?php $location = get_post_meta($post->ID, 'training_venue', true); if ($location) {  echo $location; }?></td>
							 <td><?php $date = get_post_meta($post->ID, 'training_start_date', true); if ($date) {  echo $date; }?></td>
							 <td><?php $full_price = get_post_meta($post->ID, 'training_full_price', true); if ($full_price) {  echo $full_price; }?></td>
							 <td><?php $member_price = get_post_meta($post->ID, 'training_funded_price', true); if ($member_price) {  echo $member_price; }?></td>
						</tr> 
						<?php endwhile; ?>
						</tbody>
					</table>
					</div>
					
					<?php endif; 
						wp_reset_postdata();
						$category_id = get_cat_ID( 'Mission to Mars' );
						$category_link = get_category_link( $category_id );
					?>
				</div>

				<div class="row">
				<br />
					<div class="col-xs-12 col-sm-12">
						<h2>Latest News</h2>
					</div>
					<br /><br />
					<?php 
					$args = array(
						'posts_per_page' => 6,
						'orderby' => 'date',
						'order' => 'DESC',
						'cat' => get_cat_ID( 'Employer Led Skills News' )
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
						$category_id = get_cat_ID( 'Employer Led Skills News' );
						$category_link = get_category_link( $category_id );
					?>
					<div class="col-xs-12 col-sm-12">
						<a href="<?php echo esc_url( $category_link ); ?>" title="Employer Led Skills News" class="more-link dark-button">View all Employer Led Skills News</a>
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
