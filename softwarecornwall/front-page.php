<?php
/* ------------------------------------------------------------------------ //
 * Theme File: Page: Full Width
 * Template Post Type: page
/* ------------------------------------------------------------------------ */
get_header();
global $sd_data;
?>

<!-- Theme File: Page: Front Page -->
<div class="">

	<div class="splash">
		<div class="cover-text-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-6 cover-content">
						<h1 class="cover-text">Software Cornwall</h1>
						<h2 class="cover-text">The Hub of Cornwall's Growing Tech Community</h2>
						<p class="cover-text">
						<?php if(is_user_logged_in()){ ?>
							<a class="more-link dark-button" href="https://softwarecornwall.org/user-dashboard/" title="Manage your account">Your Account</a>
						<?php } else { ?>
							<a class="more-link dark-button" href="https://www.softwarecornwall.org/register" title="Join Software Cornwall">Become a member</a>
						<?php } ?>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="cover-image"></div>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1" style="font-size:16px;">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<div style="background-color: #fff;">
		<div class="container">
			<div id="post-wrapper" class="row">
			<div class="col-md-12" style="padding: 6rem 0;">
				<h2 style="text-align: center;"><strong>Latest </strong><span class="sd-light">News</span></h2>
				<h3 style="text-align: center;"><strong><span class="sd-colored sd-light"><a href="https://www.softwarecornwall.org/category/news/">find out more about our community</a><br /></span></strong></h3>					
			</div>
			<?php 
				// Get the Six latests posts, omitting team and FAQ posts and loop
				$the_query = new WP_Query( array(
					'posts_per_page' => 6, 
					'cat' => '-202,-268,-269,-270,-271' // OMIT CATEGORIES FROM QUERY
				)); 
				while ($the_query -> have_posts()) : $the_query -> the_post(); 
			?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-standard-entry clearfix col-sm-6 col-md-4 grid-item' ); ?>> 
				<div class="sd-entry-wrapper clearfix"> 
					<?php if ( ( function_exists( 'has_post_thumbnail') ) && ( has_post_thumbnail() ) ) : ?>
					<div class="sd-entry-thumb">
						<figure>
							<?php the_post_thumbnail( 'blog-grid-thumb', ['height' => '185px', 'width' => '360px'] ); ?>
						</figure>
					</div>
					<?php endif; ?>
					<div class="sd-entry-content">
						<header>
							<h3 class="sd-entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink la %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
								<?php the_title(); ?>
								</a> </h3>
						<span class="sd-latest-blog-date"><i class="fa fa-pencil"></i> <?php the_time( get_option( 'date_format') ); ?></span>
						</header>
						<?php the_excerpt(); ?>
					</div>
				</div>
			</article>
			<?php 
			endwhile;
			wp_reset_postdata();
			?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			
			<div class="col-md-12 homepage-jobs-wrapper">
				<h2 style="text-align: center;"><strong>Latest </strong><span class="sd-light">Jobs</span></h2>
				<h3 style="text-align: center;"><a href="https://www.softwarecornwall.org/jobs-board/" title="Software Industry Jobs in the South West"><strong><span class="sd-colored sd-light">find your perfect job</span></strong></a></h3>
				<link rel='stylesheet' id='wp-job-manager-frontend-css'  href='https://www.softwarecornwall.org/wp-content/plugins/wp-job-manager/assets/css/frontend.css?ver=1.34.3' type='text/css' media='all' />
				<p><?php echo do_shortcode("[jobs]"); ?></p>
				<p style="text-align: center;">If you are looking for a job in Cornwall's tech community please <strong><a href="https://www.softwarecornwall.org/submit-resume/">submit your CV</a></strong> to our CV Bank so our members can find you</p>
			</div>

			<div class="col-md-4">
				<h3>Join <strong><span style="color: #2c448c;">Software Cornwall</span></strong></h3>
				<p>Software Cornwall represents and supports its <strong><a href="https://softwarecornwall.org/members/" title="Software Cornwall Membership Directory">member organisations</a></strong>, as well as student, mentors and volunteers. We welcome new members. We aim to deliver <strong><a href="https://softwarecornwall.org/membership-benefits/" title="Benefits of becoming a Software Cornwall member">direct benefits</a></strong> to your business and support the growing tech community in Cornwall.</p>
				<p><a class="more-link" href="https://www.softwarecornwall.org/register" title="Become a part of Cornwall's software community">Become a member</a></p>
			</div>
			<div class="col-md-4">
				<h3>Get <strong><span style="color: #2c448c;">Trained</span></strong></h3>
				<p>Taking direction from Cornwall's tech community, our technical software and professional training courses offers a great way to upskill both you and your team. Can't find the right course? <strong><a href="https://softwarecornwall.org/contact" title="Contact Software Cornwall">Get in touch</a></strong> to suggest a future course.</p>
				<p><a class="more-link" href="https://softwarecornwall.org/category/skills-and-training/training-courses/" title="software training courses">View training courses</a></p>
			</div>
			<div class="col-md-4">
				<h3>Find Your<strong><span style="color: #2c448c;"> Perfect Job</span></strong></h3>
				<p>Whether you are just starting out, or an experienced pro, if you are looking for employment add your details to our <strong><a href="https://softwarecornwall.org/submit-resume/" title="Software Cornwall CV Submission">CV bank</a></strong> so members can find you easily.  Our Jobs Board has many opportunities to work in Cornwall's Tech sector.</p>
				<p><a class="more-link" href="https://www.softwarecornwall.org/jobs-board" title="Job Vacancies for Software Developers in Cornwall">View jobs board</a></p>
			</div>
		</div>
	</div>

	<?php get_template_part( 'framework/inc/newsletter' ); ?>

</div>

<?php get_footer(); ?>
