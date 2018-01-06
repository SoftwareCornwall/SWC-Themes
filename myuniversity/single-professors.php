<?php
/* ------------------------------------------------------------------------ */
/* Theme Professors Single Post
/* ------------------------------------------------------------------------ */
get_header(); ?>
<!--left col-->
<div class="container">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'full-width-page clearfix' ); ?>> 
	
	<!-- entry content -->
	<div class="entry-content">
		<?php get_template_part( 'framework/inc/post-formats/professors/single', get_post_format() ); ?>
	</div>
	<!-- entry content end--> 
</article>
<!--post-end-->

<?php endwhile; else: ?>
<p>
	<?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>
	.</p>
<?php endif; ?>
</div>
<!-- content end -->
<?php get_footer(); ?>