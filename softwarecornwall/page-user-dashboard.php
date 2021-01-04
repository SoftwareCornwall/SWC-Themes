<?php 
/* ------------------------------------------------------------------------ */
/* Theme Normal Page
/* ------------------------------------------------------------------------ */
get_header(); 
?>

<!--Theme file: Page - Account-->
<div class="sd-blog-page">
	<div class="container">
		<div class="row"> 
			<div class="col-md-8">
				<article class="sd-left-col">
					<div class="entry-content user-dashboard">
						<?php 
							$username = um_user('user_login');
							$business_name = um_user('business_name');
						?>

						<h3>Promote your business</h3>
						<p>Your profile is the window into your business on the Software Cornwall Website. Complete as much as you can, keep it up to date with fresh information and make your company stand out.</p>
						<p>Add your latest news, press releases and event details to the website to promote your business.</br>
							<a class="more-link" href="<?php echo 'https://www.softwarecornwall.org/member/' . $username . '/?um_action=edit' ;?>" title="Edit your profile">Update Your Business Profile</a>
							<a class="more-link" href="https://softwarecornwall.org/wp-admin/post-new.php" title="Add an new post">Add a News Item</a>
							<a class="more-link" href="https://softwarecornwall.org/wp-admin/post-new.php?post_type=tribe_events" title="Add an event">Add an Event</a>
						</p>
							
						<h3>Grow your team</h3>
						<p>Add your job to the jobs board to put the role in front of the right people to help grow your team.</br>
							<a class="more-link" href="https://softwarecornwall.org/post-a-job/" title="Post a job">Add a new Job</a>
							<a class="more-link" href="https://softwarecornwall.org/job-dashboard/" title="Jobs Dashboard">View Your Active Jobs</a>
							<a class="more-link" href="https://softwarecornwall.org/resumes/" title="View CV Bank">View CV Bank</a>
						</p>

						<h3>Your Account</h3>
						<p>Update your personal information, reset your password and manage your data.</br>
							<a class="more-link" href="https://softwarecornwall.org/account/" title="Update Account">Update account details</a>
						</p>

						<h3>Help</h3>
						<p>Having problems using your member benefits? Get in touch. We're happy to help.</br>
							<a class="more-link" href="https://softwarecornwall.org/contact/" title="Contact Software Cornwall">Contact Us</a>
						</p>
					</div>
				</article>
			</div>

			<?php if (have_posts()) : while (have_posts()) : the_post();?>
				<div class="col-md-4" id="post-<?php the_ID(); ?>">
					<?php the_content(); ?>
				</div>
			<?php endwhile; endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>