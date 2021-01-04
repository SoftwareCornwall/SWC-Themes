
<?php
/* ------------------------------------------------------------------------ */
/* Template Name: Category
/* ------------------------------------------------------------------------ */
get_header();
?>

<!-- Template Name: Category - Training -->
<div class="sd-blog-page">
	<div class="container">
		<div class="row"> 
			<?php 
			if (category_description()) {
				the_archive_description('<div class="col-sm-10 col-sm-offset-1 category-description-wrapper" style="text-align: center;">', '</div>');
			} ?>
			
			<div class="col-xs-12">
			<div class="row" id="post-wrapper"> 
					<?php global $wp_query;
					global $more;
					$more = 0;
						
					if ( have_posts() ) :  while ( have_posts() ) : the_post();

						get_template_part( 'partials/training-list-item' );

					endwhile; else: ?>
						<p><?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>.</p>
					<?php endif; wp_reset_postdata();?>
				</div>
			</div>

			<div class="col-sm-10 col-sm-offset-1 category-description-wrapper" style="text-align: center;">
			<!--pagination-->
			<?php if ( $sd_data['sd_pagination_type'] == '1' ) : ?>
				<?php if ( get_previous_posts_link() ) : ?>
				<div class="sd-nav-previous">
					<?php previous_posts_link( $sd_data['sd_blog_prev'] ); ?>
				</div>
				<?php endif; ?>
				<?php if ( get_next_posts_link() ) : ?>
				<div class="sd-nav-next">
					<?php next_posts_link( $sd_data['sd_blog_next'] ); ?>
				</div>
				<?php endif; ?>
			<?php else : sd_custom_pagination(); endif; ?>
			<!--pagination end--> 
				</div>
				</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
