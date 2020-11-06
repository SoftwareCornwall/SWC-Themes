<?php
/* ------------------------------------------------------------------------ */
/* Theme Single Frequently Asked Questions Post
 * Template Name: Frequently Asked Questions
 * Template Post Type: post
/* ------------------------------------------------------------------------ */
global $sd_data;
get_header(); ?>
<!--left col-->

<!-- Template Name: Single - Frequently Asked Questions -->
<div class="sd-blog-page">
	<div class="container">
		<div class="row"> 
			<!--left col-->
			<div class="col-md-<?php if ( $sd_data['sd_blog_layout'] == '2' ) echo '12'; else echo '8'; ?> <?php if ( $sd_data['sd_sidebar_location'] == '2' ) echo 'pull-right'; ?>">
				<div class="sd-left-col">
					<?php if (have_posts()) : while (have_posts()) : the_post();?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-single-blog-entry clearfix' ); ?>> 

						<div class="sd-entry-wrapper">
							<div class="sd-entry-content">
								<?php the_content(); ?>
								<?php wp_link_pages( 'before=<strong class="sd-page-navigation clearfix">&after=</strong>' ); ?>
							</div>
						</div>
					</article>

					<?php endwhile; else: ?>
					<p>
						<?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>
						.</p>
					<?php endif; ?>
					<?php if ( $sd_data['sd_blog_comments'] == '1' ) : ?>
					<!--comments-->
					<?php comments_template( '', true ); ?>
					<!--comments end--> 
					<?php endif; ?>
				</div>
			</div>
			<!--left col end--> 
			<?php if ( $sd_data['sd_blog_layout'] !== '2' ) : ?>
			<!--sidebar-->
			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div>
			<!--sidebar end--> 
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
