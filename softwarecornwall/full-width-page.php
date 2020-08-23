<?php
/* ------------------------------------------------------------------------ */
/* Template Name: Page: Full Width
/* ------------------------------------------------------------------------ */
// Template Name: Page: Full Width
get_header();
?>

<div class="sd-blog-page">
	<div class="container">
		<div class="row">
			<!--left col-->
			<div class="col-sm-12>


				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<article id=" post-<?php the_ID(); ?>" <?php post_class( 'sd-full-width clearfix' ); ?>>

				<!-- entry content -->
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				<!-- entry content end-->
				</article>
				<!--post-end-->

				<?php endwhile; else: ?>
				<p>
					<?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>
					.</p>
				<?php endif; ?>
				<!-- content end -->


			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
