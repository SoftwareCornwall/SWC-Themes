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
						// Logged out user content
						echo do_shortcode('[um_loggedout]'.'<h3>Log in to view your dashboard</h3>'.'[/um_loggedout]');

						// Logged in member content
						$username = um_user('user_login');
						echo do_shortcode( '[um_show_content roles="um_member,administrator"]'.
						
							'<h3>Promote your business</h3>
							<p>Your profile is the window into your business on the Software Cornwall Website. Complete as much as you can, keep it up to date with fresh information and make your company stand out.</p>
							<p>Add your latest news, press releases and event details to the website to promote your business.</br>
								<a class="more-link" href="https://www.softwarecornwall.org/member/' . $username . '/?um_action=edit" title="Edit your profile">Update Your Business Profile</a> <a class="more-link" href="https://softwarecornwall.org/wp-admin/post-new.php" title="Add an news post">Add a News Item</a> <a class="more-link" href="https://softwarecornwall.org/wp-admin/post-new.php?post_type=tribe_events" title="Add an event">Add an Event</a>
							</p>
								
							<h3>Grow your team</h3>
							<p>Add your job to the jobs board to put the role in front of the right people to help grow your team.</br>
								<a class="more-link" href="https://softwarecornwall.org/post-a-job/" title="Post a Job">Add a New Job</a> <a class="more-link" href="https://softwarecornwall.org/job-dashboard/" title="Jobs Dashboard">View Your Active Jobs</a> <a class="more-link" href="https://softwarecornwall.org/resumes/" title="View CV Bank">View CV Bank</a>
							</p>'.'[/um_show_content]' ); 
							
						// Logged in candidate content
						echo do_shortcode( '[um_show_content roles="candidate,administrator"]'.
						
							'<h3>Your CV</h3>
							<p>Adding your CV to out CV bank is a brilliant way to put yourself in front of businesses from Cornwall&amp;s tech industry who are hiring right now.</br>
								<a class="more-link" href="https://softwarecornwall.org/candidate-dashboard" title="View all CVs">View Your CVs</a> 
								<a class="more-link" href="https://softwarecornwall.org/submit-resume/" title="Add a new CV">Add a New CV</a>
							</p>
								
							<h3>Our Jobs Board</h3>
							<p>Our jobs board features roles from member businesses and companies looking to expand their development team.</br>
								<a class="more-link" href="https://softwarecornwall.org/jobs-board/" title="Software Developer Jobs in Cornwall">View our Jobs Board</a>
							</p>'.'[/um_show_content]' ); 

						// Logged in team
						echo do_shortcode( '[um_show_content roles="administrator,editor"]'.
						
							'<h3>Software Cornwall Team</h3>
							<p>Hey Team 👋</p>
							<p>Thanks for logging in. These useful links are your reward 👇</br>
								<a class="more-link" href="https://softwarecornwall.org/wp-admin/" title="WordPress Dashboard">Admin Dashboard</a> <a class="more-link" href="https://softwarecornwall.org/wp-admin/post-new.php" title="Add an new post">Add a New Post</a> <a class="more-link" href="https://app.hubspot.com/tasks/5662851/" title="HubSpot">View HubSpot Tasks</a> <a class="more-link" href="https://trello.com/softwarecornwall1" title="Trello">Go to Trello</a> 
							</p>'.'[/um_show_content]' ); 

						// Everyone
						echo do_shortcode( '[um_show_content roles="um_member,administrator,editor,candidate,author,subscriber"]'.
						
							'<h3>Your Account</h3>
							<p>Update your personal information, reset your password and manage your data.</br>
								<a class="more-link" href="https://softwarecornwall.org/account/" title="Update Account">Update Account Details</a>
							</p>'.'[/um_show_content]');

						// Members and the team
						echo do_shortcode( '[um_show_content roles="um_member,administrator,editor"]'. 
						
							'<h3>Contact Us</h3>
							<p>Need a hand getting the most from your member benefits? Get in touch.</br>
								<a class="more-link" href="https://softwarecornwall.org/contact/" title="Contact Software Cornwall">Send a Message</a> <a class="more-link" href="https://softwarecornwall.slack.com" title="Slack Group">Slack</a>'.'[/um_show_content]' ); 

						// Other users don't need the slack link
						echo do_shortcode( '[um_show_content not="um_member,editor"]'. 
						
							'<h3>Contact Us</h3>
							<p>Need a hand getting the most from your member benefits? Get in touch.</br>
								<a class="more-link" href="https://softwarecornwall.org/contact/" title="Contact Software Cornwall">Send a Message</a>' .'[/um_show_content]' ); 							
							?>
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
