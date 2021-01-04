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
				<div class="sd-left-col">
					<article> 
						<div class="entry-content">
							
						</div>
					</article>
				</div>
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
