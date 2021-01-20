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
			<div class="col-sm-12">

				<div class="row">
					<div class="col-sm-12">
						<div class="top-eu-logo">
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
						</div>
						<div class="row">
							<div class="col-sm-8">
								<div class="sd-title-wrapper">
									<h3 class="sd-styled-title">Course <span class="sd-light">Details</span></h3>
								</div>
								<div class="row">
									<?php 
										try {
											$date = get_post_meta($post->ID, 'training_start_date', true);
											$endDate = get_post_meta($post->ID, 'training_end_date', true);
											$dayParts = explode('/', $date);
											$startDay = date('jS', mktime(0, 0, 0, $dayParts[0], 10));
											$startMonth = date('M', mktime(0, 0, 0, $dayParts[1], 10));

											$endDayParts = explode('/', $date);
											$endDay = date('jS', mktime(0, 0, 0, $endDayParts[0], 10));
											$endMonth = date('M', mktime(0, 0, 0, $endDayParts[1], 10));
										} catch (Exception $e) {
											error_log('Caught exception: ' .  $e->getMessage(), 0);
										}
									?>
									<div class="col-xs-2 col-md-1 col-xs-offset-3 col-md-offset-0 sd-entry-content"  style="text-align:center;">
										<p class="training-list-date-wrapper-single"><?php if ($startDay) { echo $startDay; } ?><span><?php if ($startMonth) { echo $startMonth; } ?></span></p>
									</div>
									<div class="col-xs-1 col-sm-1 sd-entry-content" style="text-align:center;">
										to
									</div>
									<div class="col-xs-2 col-md-1 sd-entry-content"  style="text-align:center;">
										<p class="training-list-date-wrapper-single"><?php if ($endDay) { echo $endDay; } ?><span><?php if ($endMonth) { echo $endMonth; } ?></span></p>
									</div>
									<div class="clearfix visible-xs-block"></div>
									<div class="col-sm-7 col-md-9">
											<strong>Location:</strong> <?php $training_venue = get_post_meta($post->ID, 'training_venue', true); if ($training_venue) {  echo $training_venue; }?></br>
											<strong>Times:</strong> <?php $time = get_post_meta($post->ID, 'training_start_time', true); if ($time) {  echo $time; }?> to <?php $endTime = get_post_meta($post->ID, 'training_end_time', true); if ($endTime) {  echo $endTime; }?></br>
											<strong>Full Price:</strong> <?php $training_full_price = get_post_meta($post->ID, 'training_full_price', true); if ($training_full_price) {  echo $training_full_price; }?></br>
											<strong>Funded Price:</strong> <?php $training_funded_price = get_post_meta($post->ID, 'training_funded_price', true); if ($training_funded_price) {  echo $training_funded_price; }?> (see description)
									</div>
									<div class="col-xs-12">
										<p><em>Course dates and availability will be determined based on volume of interest. Please complete the <a href="https://share.hsforms.com/1GDF4Zm5iQUan1jnsvbfhOA3ddhf">Register your interest</a> form to go on the list.</em></p>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="side-eu-logo">
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
								</div>
							</div>
						
						</div>
					</div>
	
				</div>
			</div>
			<div class="col-sm-8">
				<div class="sd-left-col">

					<?php if (have_posts()) : while (have_posts()) : the_post();?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-single-blog-entry clearfix' ); ?>> 
							<div class="sd-entry-wrapper single-training-wrapper">
								
								<div class="sd-entry-content">
									<div class="sd-title-wrapper">
										<h3 class="sd-styled-title" style="margin-top:0px;">Course <span class="sd-light">Content</span></h3>
									</div>
									<?php the_content(); ?>
									<div class="sd-prev-next-post clearfix">
										<?php $bookLink = get_post_meta($post->ID, 'training_ticket_link', true); if ($bookLink) { ?>
											<span class="sd-next-post"><a href="<?php echo $bookLink; ?>" title="Book <?php get_the_title();?> now" class="sd_blog_single_next">Book Now</a></span>
										<?php }?>
									</div>
									<div class="clearfix"></br></br></div>

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

									<h2>European Social Fund</h2>
									<p>The European Social Fund is partially funding Software Cornwall to run this training project to provide development training for employees within the software industry. As a Software Cornwall member you will be receiving a discount to this course by email. This course is only available to those from the UK or EU. To participate in the training certain personal information will be required from attendants as proof of employment and eligibility to attend. This information is for the purposes of ensuring that the training will go to the correct participants. You will also be required to complete an evaluation form after the training as part of the attendance.</p>
									<img 
										src="https://softwarecornwall.org/wp-content/uploads/2020/10/ESF_logo.png" 
										alt="European Social Fund Logo" 
										loading="lazy" 
										height="74px" width="360px"
										style="width: 100%;"/>
								</div>
							</div>
						</article>

					<?php endwhile; else: ?>
					<p>
						<?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>
						.</p>
					<?php endif; ?>
				</div>
			</div>

			<div class="col-sm-4">				
				<aside id="recent-posts-2" class="sd-sidebar-widget clearfix widget_recent_entries">					
					<div class="sd-title-wrapper">
						<h3 class="sd-styled-title">Meet the <span class="sd-light">Trainer</span></h3>
					</div>

					<p>
						Delivered By: <?php $training_delivered_by = get_post_meta($post->ID, 'training_delivered_by', true); if ($training_delivered_by) {  echo $training_delivered_by; }?></br>
					</p>
					<p>
						<?php 
						$bookLink = get_post_meta($post->ID, 'training_ticket_link', true); 
						if ($bookLink) { ?>
							<a href="<?php echo $bookLink; ?>" title="Book <?php get_the_title();?> now" class="more-link">Book Now</a></span>
						<?php } ?>
					</p>
				</aside>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
