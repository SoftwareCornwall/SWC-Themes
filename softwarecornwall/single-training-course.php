<?php
/* ------------------------------------------------------------------------ //
 * Template Name: Single - Training Course
 * Template Post Type: post
/* ------------------------------------------------------------------------ */
get_header(); ?>

<!--Theme File: Single - Training Course-->
<div class="sd-blog-page">
	<div class="container">
		<div class="row"> 
			<div class="col-md-<?php if ( $sd_data['sd_blog_layout'] == '2' ) echo '12'; else echo '8'; ?> <?php if ( $sd_data['sd_sidebar_location'] == '2' ) echo 'pull-right'; ?>">
				<div class="sd-left-col">
					<?php if (have_posts()) : while (have_posts()) : the_post();?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-single-blog-entry clearfix' ); ?>> 
							<div class="sd-entry-wrapper single-training-wrapper">
								
								<div class="sd-entry-content">
									<div class="sd-title-wrapper">
										<h3 class="sd-styled-title">Course <span class="sd-light">Content</span></h3>
									</div>
									<?php the_content(); ?>
								</div>

								<?php if ( $sd_data['sd_blog_single_prev_next'] == '1' ) : ?>
								<footer>
									<div class="sd-prev-next-post clearfix">
										<?php $bookLink = get_post_meta($post->ID, 'training_ticket_link', true); if ($bookLink) { ?>
											<span class="sd-next-post"><a href="<?php echo $bookLink; ?>" title="Book <?php get_the_title();?> now" class="sd_blog_single_next">Book Now</a></span>
										<?php }?>
									</div>
								</footer>
								<?php endif; ?>
							</div>
						</article>

					<?php endwhile; else: ?>
					<p>
						<?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>
						.</p>
					<?php endif; ?>
				</div>
			</div>

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
						<h3 class="sd-styled-title">Course <span class="sd-light">Details</span></h3>
					</div>

					<?php if ( $sd_data['sd_blog_featured_img'] == '1' ) : ?>
						<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) : ?>
						<div class="sd-entry-thumb">
							<figure>
								<?php $sd_layout = $sd_data['sd_blog_layout'];  $feat_img_size = ( ( $sd_layout == '2' ) ? 'large-post-image' : 'post-image' ); ?>
								<?php the_post_thumbnail( $feat_img_size, ['height' => '374px', 'width' => '720px']); ?>
							</figure>
						</div>
						<?php endif; ?>
					<?php endif; ?>
					<p>
						Delivered By: <?php $training_delivered_by = get_post_meta($post->ID, 'training_delivered_by', true); if ($training_delivered_by) {  echo $training_delivered_by; }?></br>
						Location: <?php $training_venue = get_post_meta($post->ID, 'training_venue', true); if ($training_venue) {  echo $training_venue; }?>
					</p>
					<p>
						Start Date: <?php $date = get_post_meta($post->ID, 'training_start_date', true); if ($date) {  echo $date; }?></br>
						End Date: <?php $endDate = get_post_meta($post->ID, 'training_end_date', true); if ($endDate) {  echo ' - ' . $endDate; }?></br>
						Start Time: <?php $time = get_post_meta($post->ID, 'training_start_time', true); if ($time) {  echo $time; }?> to 
						<?php $endTime = get_post_meta($post->ID, 'training_end_time', true); if ($endTime) {  echo $endTime; }?>
					</p>
					<p>
						Full Price: <?php $training_full_price = get_post_meta($post->ID, 'training_full_price', true); if ($training_full_price) {  echo $training_full_price; }?></br>
						Funded Price (see description): <?php $training_funded_price = get_post_meta($post->ID, 'training_funded_price', true); if ($training_funded_price) {  echo $training_funded_price; }?>
					</p>
					<p>
						<?php 
						$bookLink = get_post_meta($post->ID, 'training_ticket_link', true); 
						if ($bookLink) { ?>
							<a href="<?php echo $bookLink; ?>" title="Book <?php get_the_title();?> now" class="more-link">Book Now</a></span>
						<?php }?>
					</p>
					</br>
					<?php get_sidebar(); ?>
				</aside>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
