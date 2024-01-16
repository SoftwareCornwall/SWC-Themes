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
	$trainingDate = strtotime(str_replace('/','-', $date));
	$startDay = date('jS', $trainingDate);
	$startMonth = date('M', $trainingDate);

	$endDate = get_post_meta($post->ID, 'training_end_date', true);
	$trainingEndDate = strtotime(str_replace('/','-', $endDate));
	$endDay = date('jS', $trainingEndDate);
	$endMonth = date('M', $trainingEndDate);
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
						
						<div class="row">
							<div class="col-sm-8">
								
								<?php if($is_live) { ?>
									<div class="sd-title-wrapper">
										<h3 class="sd-styled-title">Course <span class="sd-light">Details</span></h3>
									</div>
								<?php } ?>
								
								<div class="row">
									<?php if($is_live) { ?>
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
												<?php if ($training_venue) { ?><strong>Location:</strong> <?php echo $training_venue; ?></br><?php } ?>
												<?php if ($time) { ?><strong>Times:</strong> <?php echo $time; ?> to <?php if ($endTime) {  echo $endTime; }?></br><?php } ?>
												<?php if ($training_full_price) { ?><strong>Full Price:</strong> <?php echo $training_full_price; ?></br><?php } ?>
												<?php if ($training_funded_price) { ?><strong>Funded Price:</strong> <?php echo $training_funded_price; ?> (see description)<?php } ?>
										</div>
										<div class="col-xs-12">
											<a href="<?php echo $bookLink; ?>" title="Book <?php get_the_title();?> now" class="more-link" style="margin-bottom:20px; margin-top:10px;">Book Now</a></span>
										</div>
									<?php } else { ?>
										<div class="col-xs-12">
											<p style="margin-top: 0;"><strong>Location:</strong> <?php if ($training_venue) {  echo $training_venue; }?></br><em>Course dates, price and availability will be determined based on volume of interest.</em></p>
											<a href="https://share.hsforms.com/1GDF4Zm5iQUan1jnsvbfhOA3ddhf" title="Register your interest" class="more-link training-more-link">Register Your Interest</a></span>
										</div>
									<?php } ?> 
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
									<?php if(!$is_live){ ?>
										<h3 class="sd-styled-title">Register Your <span class="sd-light">Interest</span></h3>
										<p style="margin-top: 0;"><em>Course dates, price and availability will be determined based on volume of interest.</em></p>
										<a href="https://share.hsforms.com/1GDF4Zm5iQUan1jnsvbfhOA3ddhf" title="Register your interest" class="more-link training-more-link">Register Your Interest</a></span>
									<?php } ?> 

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

									
								</div>
							</div>
						</article>

					<?php endwhile; else: ?>
					<p><?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>.</p>
					<?php endif; ?>
				</div>
							</div>
							<div class="col-sm-4">
								
								<aside id="recent-posts-2" class="sd-sidebar-widget clearfix widget_recent_entries trainer-sidebar">					
									<div class="sd-title-wrapper">
										<h3 class="sd-styled-title">Meet the <span class="sd-light">Trainer</span></h3>
									</div>
									<?php if ($training_delivered_by) { ?>
										<p style="margin-top:0; font-size:18px;"><strong><?php echo $training_delivered_by; ?></strong></p>
									<?php }
									if ($trainer_headshot) { ?>
									<img src="<?php echo $trainer_headshot; ?>" alt="<?php echo $training_delivered_by . ' headshot';?>"
										height="300px" width="300px" loading="lazy" class="trainer_headshot_img">
									<?php }
									if (count($speaker_links) > 0) { ?>
									<div class="sd-header-social trainer-social clearfix">
										<?php foreach ( $speaker_links as $font_class => $url ) { ?>
											<a class="sd-bg-trans sd-header-<?php echo $font_class; ?>" href="<?php echo esc_url($url); ?>" title="<?php echo $font_class; ?>" target="_blank" rel="nofollow"><i class="fa fa-<?php echo $font_class; ?>"></i></a>
										<?php } ?>
									</div>
									<?php } ?>
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
