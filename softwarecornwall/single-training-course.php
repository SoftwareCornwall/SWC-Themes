<?php
/* ------------------------------------------------------------------------ //
 * Template Name: Single - Training Course
 * Template Post Type: post
/* ------------------------------------------------------------------------ */
get_header(); 

// Get all of the training custom fields upfront
$is_live = get_post_meta($post->ID, 'training_is_live', true);
$training_venue = get_post_meta($post->ID, 'training_venue', true);
$time = get_post_meta($post->ID, 'training_start_time', true);
$endTime = get_post_meta($post->ID, 'training_end_time', true);
$training_full_price = get_post_meta($post->ID, 'training_full_price', true);
$training_funded_price = get_post_meta($post->ID, 'training_funded_price', true);
$bookLink = get_post_meta($post->ID, 'training_ticket_link', true);
$trainer_website = get_post_meta($post->ID, 'trainer_website', true);
$trainer_linkedin = get_post_meta($post->ID, 'trainer_linkedin', true);
$trainer_twitter = get_post_meta($post->ID, 'trainer_twitter', true);
$trainer_instagram = get_post_meta($post->ID, 'trainer_instagram', true);
$trainer_bio = get_post_meta($post->ID, 'trainer_bio', true);
$training_delivered_by = get_post_meta($post->ID, 'training_delivered_by', true);
$trainer_headshot = get_post_meta($post->ID, 'trainer_headshot', true);

// Add the trainer links to array so we can iterate over existing ones later
$speaker_links = array();
if($trainer_website){ $speaker_links['globe'] = $trainer_website; }
if($trainer_twitter){ $speaker_links['twitter'] = $trainer_twitter; }
if($trainer_linkedin){ $speaker_links['linkedin'] = $trainer_linkedin; }
if($trainer_instagram){ $speaker_links['instagram'] = $trainer_instagram; }

// Convert date to display format
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
} ?>

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
											<strong>Location:</strong> <?php if ($training_venue) {  echo $training_venue; }?></br>
											<strong>Times:</strong> <?php  if ($time) {  echo $time; }?> to <?php if ($endTime) {  echo $endTime; }?></br>
											<strong>Full Price:</strong> <?php if ($training_full_price) {  echo $training_full_price; }?></br>
											<strong>Funded Price:</strong> <?php if ($training_funded_price) {  echo $training_funded_price; }?> (see description)
									</div>
									<div class="col-xs-12">
										<?php if($is_live) { ?>
											<p><a href="<?php echo $bookLink; ?>" title="Book <?php get_the_title();?> now" class="more-link">Book Now</a></span></p>
										<?php } elseif ($bookLink) { ?>
											<p><em>Course dates, price and availability will be determined based on volume of interest. Please complete the <a href="https://share.hsforms.com/1GDF4Zm5iQUan1jnsvbfhOA3ddhf">Register your interest</a> form to go on the list.</em></p>
										<?php } ?> 
									</div>
								</div>
								<div class="sd-left-col">

					<?php if (have_posts()) : while (have_posts()) : the_post();?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-single-blog-entry clearfix' ); ?>> 
							<div class="sd-entry-wrapper single-training-wrapper">
								
								<div class="sd-entry-content">
									<div class="sd-title-wrapper">
										<h3 class="sd-styled-title" style="margin-top:0px;">Course <span class="sd-light">Content</span></h3>
									</div>
									<?php the_content(); ?>

									<!-- <div class="sd-prev-next-post clearfix">
										<?php  if ($bookLink) { ?>
											<span class="sd-next-post"><a href="<?php echo $bookLink; ?>" title="Book <?php get_the_title();?> now" class="sd_blog_single_next">Book Now</a></span>
										<?php }?>
									</div>
									<div class="clearfix"></br></br></div> -->

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
								<aside id="recent-posts-2" class="sd-sidebar-widget clearfix widget_recent_entries">					
									<div class="sd-title-wrapper">
										<h3 class="sd-styled-title">Meet the <span class="sd-light">Trainer</span></h3>
									</div>

									<p style="margin-top:0; font-size:18px;"><strong><?php if ($training_delivered_by) { echo $training_delivered_by; }?></strong></p>
									
									<img src="<?php if ($trainer_headshot) { echo $trainer_headshot; } ?>" alt="<?php echo $training_delivered_by . ' headshot';?>"
										height="400px" width="400px" loading="lazy" class="trainer_headshot_img">

									<div class="sd-header-social trainer-social clearfix">
										<?php
										foreach ( $speaker_links as $font_class => $url ) { ?>
												<a class="sd-bg-trans sd-header-<?php echo $font_class; ?>" href="<?php echo esc_url($url); ?>" title="<?php echo $font_class; ?>" target="_blank" rel="nofollow"><i class="fa fa-<?php echo $font_class; ?>"></i></a>
											<?php } ?>
									</div>
									<div class="clearfix"></div>
									
									<p><?php  if ($trainer_bio) {  echo $trainer_bio; }?></br></p>
								</aside>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
