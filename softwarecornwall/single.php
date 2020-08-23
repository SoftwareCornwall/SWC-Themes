<?php
/* ------------------------------------------------------------------------ */
/* Theme Single Post
/* ------------------------------------------------------------------------ */
get_header(); ?>
<!--left col-->

<div class="sd-blog-page">
	<div class="container">
		<div class="row"> 
			<!--left col-->
			<div class="col-md-<?php if ( $sd_data['sd_blog_layout'] == '2' ) echo '12'; else echo '8'; ?> <?php if ( $sd_data['sd_sidebar_location'] == '2' ) echo 'pull-right'; ?>">
				<div class="sd-left-col">
					<?php if (have_posts()) : while (have_posts()) : the_post();?>

					<?php get_template_part( 'framework/inc/post-formats/single', get_post_format() ); ?>

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
