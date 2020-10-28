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
							
							<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/shell.js"></script>
							<script>
							hbspt.forms.create({
								portalId: "5662851",
								formId: "39a50d38-61d5-473b-94a6-e6c2193c139a"
							});
							</script>
							<style>
								.sd-blog-page aside {
									margin-bottom: 40px;
								}
							</style>
						</div>
						<!-- entry content end--> 
					</article>
					<!--post-end-->
					
					<?php endwhile; else: ?>
						<p><?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>.</p>
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
