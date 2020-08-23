<?php 
/* ------------------------------------------------------------------------ */
/* Theme Normal Page
/* ------------------------------------------------------------------------ */
get_header(); 
?>
<!--left col-->

<div class="sd-blog-page">
	<div class="container">
		<div class="row"> 
			<!--left col-->
			<div class="col-md-8 <?php if ( $sd_data['sd_sidebar_location'] == '2' ) echo 'pull-right'; ?>">
				<div class="sd-left-col">
			<?php if (have_posts()) : while (have_posts()) : the_post();?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-entry page-entry clearfix' ); ?>> 
				
				<!-- entry content -->
				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( 'before=<strong class="page-navigation clearfix">&after=</strong>' ); ?>
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
			</div>
			<!--left col end--> 
			<!--sidebar-->
			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div>
			<!--sidebar end--> 
		</div>
	</div>
</div>
<?php get_footer(); ?>
