<?php
/* ------------------------------------------------------------------------ */
/* Template Name: Page: Full Width
/* ------------------------------------------------------------------------ */
get_header();
global $sd_data;
?>

<!-- Template Name: Page: Front Page -->
<div class="">

	<div class="splash">
		<div class="cover-text-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-6 cover-content">
						<h1 class="cover-text">Software Cornwall</h1>
						<h2 class="cover-text">The Hub of Cornwall's Growing Tech Community</h2>
						<p class="cover-text">
							<a class="more-link" href="https://www.softwarecornwall.org/register">Become a member</a>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="cover-image"></div>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h2 style="text-align: center; color: #2c448c;"><strong>Welcome to Cornwall's Tech Community</strong></h2>
				<p>We actively support outreach into education and provide <a href="https://softwarecornwall.org/mission-to-mars/">work experiences</a> every year. We have <a href="https://softwarecornwall.org/employer-led-skills/"> training projects</a>, supported by funding from the European Social Fund, that will develop the skills and abilities of employees and those wishing to join the industry.</p>
				<p>Software Cornwall represents one of the <strong><a href="https://softwarecornwall.org/news/reports/cornwalls-fast-growing-tech-sector-highlighted-in-national-report-technation-wearetechnation-technation/">fastest growing tech clusters in the UK</a></strong>.  Software Cornwall connects, promotes, represents and supports Cornwall's digital tech community.  We aim to be the best way to plug in to this fast-growing community.</p>
				<p>If you run a tech business in Cornwall, then <a href="https://www.softwarecornwall.org/register/">join our tech community</a>, promote your business, network, <a href="https://www.softwarecornwall.org/jobs-board/">recruit</a> and support our tech education in Cornwall.  <a href="https://www.softwarecornwall.org/register/">Membership for students</a> is free. We are always pleased to welcome volunteers, and discuss opportunities for collaboration.  Software Cornwall is a Not for Profit funded by membership.  <a href="https://softwarecornwall.org/category/learn/career-interviews/">Explore the Career Pathways</a> into tech careers here in Cornwall - Find out more about<a href="https://www.softwarecornwall.org/mission-to-mars/"> our education support programmes</a> , visit our <a href="https://www.softwarecornwall.org/jobs-board/">jobs board</a> for the latest opportunities or submit your CV to our members via our <a href="https://www.softwarecornwall.org/submit-resume/">CV Bank</a></p>
			</div>
		</div>
	</div>
	<div style="background-color: #fff;">
		<div class="container">
			<div id="post-wrapper" class="row">
			<div class="col-md-12" style="padding: 6rem 0;">
				<h2 style="text-align: center;"><strong>Latest </strong><span class="sd-light">News</span></h2>
				<h3 style="text-align: center;"><strong><span class="sd-colored sd-light"><a href="https://www.softwarecornwall.org/news/">find out more about our community</a><br /></span></strong></h3>					
			</div>
			<?php 
				// Get the Six latests posts and loop
				$the_query = new WP_Query( 'posts_per_page=6' ); 
				while ($the_query -> have_posts()) : $the_query -> the_post(); 
			?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-standard-entry clearfix col-sm-6 col-md-4 grid-item' ); ?>> 
				<div class="sd-entry-wrapper clearfix"> 
					<?php if ( ( function_exists( 'has_post_thumbnail') ) && ( has_post_thumbnail() ) ) : ?>
					<div class="sd-entry-thumb">
						<figure>
							<?php the_post_thumbnail( 'blog-grid-thumb' ); ?>
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
			<div class="col-md-12">
				<h2 style="text-align: center;"><strong>Latest </strong><span class="sd-light">Jobs</span></h2>
				<h3 style="text-align: center;"><a href="https://www.softwarecornwall.org/jobs-2/"><strong><span class="sd-colored sd-light">Join teams in our community</span></strong></a></h3>
				<link rel='stylesheet' id='wp-job-manager-frontend-css'  href='https://www.softwarecornwall.org/wp-content/plugins/wp-job-manager/assets/css/frontend.css?ver=1.34.3' type='text/css' media='all' />
				<p><?php echo do_shortcode("[jobs]"); ?></p>
				<p style="text-align: center;">If you are looking for a job in Cornwall's tech community please <a href="https://www.softwarecornwall.org/submit-resume/">submit your CV</a> to our CV Bank so our members can find you</p>
			</div>

			<div class="col-md-4">
				<h3>Join <strong><span style="color: #2c448c;">Software Cornwall</span></strong></h3>
				<p>Software Cornwall represents and supports over 80 member organisations, as well as student members and our mentors and volunteers.  We welcome new members.  We aim to deliver direct benefits to your business and support the growing tech community in Cornwall.</p>
				<p><a class="more-link" href="https://www.softwarecornwall.org/register">Become a member</a></p>
			</div>
			<div class="col-md-4">
				<h3>Our <strong><span style="color: #2c448c;">Community</span></strong></h3>
				<p>As a collaborative Not for Profit community, we help to connect, promote, represent and develop Cornwall's digital tech community.</p>
				<p>Stay up to date with latest news from the sector, find events through our Event Calendar.  Find new recruits in our CV Bank, and promote your jobs locally and nationally on our Jobs Board.</p>
				<p><a class="more-link" href="https://www.softwarecornwall.org/members">View Directory</a></p>
			</div>
			<div class="col-md-4">
				<h3>Career<strong><span style="color: #2c448c;"> Pathways</span></strong></h3>
				<p>Through our education and careers programme find out more about career pathways, meet employers and develop your tech skills.  In our Learn section you can find out more about our Careers and Education support, including local Courses, Events, Training and Resources.</p>
				<p>Whether you are just starting out, or an experienced pro, if you are looking for employment add your details to our CV bank so members can find you easily.  Our Jobs Board has many opportunities to work in Cornwalls Tech sector.</p>
				<p><a class="more-link" href="https://www.softwarecornwall.org/learn-to-code-2/">Learn more</a></p>
			</div>
		</div>
	</div>

	<?php get_template_part( 'framework/inc/newsletter' ); ?>

</div>

<?php get_footer(); ?>
