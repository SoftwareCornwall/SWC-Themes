
<?php
/* ------------------------------------------------------------------------ */
/* Template Name: Category
/* ------------------------------------------------------------------------ */
get_header();
?>

<!-- Template Name: Category -->
<div class="sd-blog-page">
	<div class="container">
		<div class="row"> 
			<?php 
			if (category_description()) {
				the_archive_description('<div class="col-sm-10 col-sm-offset-1 category-description-wrapper" style="text-align: center;">', '</div>');
			} ?>
			
			<div class="col-xs-12">
				<div class="row"> 
					<div id="post-wrapper" class="col-md-8">
						<?php global $wp_query;
						global $more;
						$more = 0;
							
						if ( have_posts() ) :  while ( have_posts() ) : the_post();?>

						<article <?php post_class( 'sd-blog-entry sd-standard-entry clearfix col-sm-6 col-md-4 grid-item-large' ); ?>> 
							<div class="sd-entry-wrapper clearfix"> 
								<?php if ( ( function_exists( 'has_post_thumbnail') ) && ( has_post_thumbnail() ) ) : ?>
								<div class="sd-entry-thumb">
									<figure>
										<?php the_post_thumbnail( 'blog-grid-thumb' ); ?>
									</figure>
								</div>
								<?php endif; ?>
								<div class="sd-entry-content">
									<header>
										<h3 class="sd-entry-title">
											<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink la %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
												<?php the_title(); ?>
											</a>
										</h3>
										<span class="sd-latest-blog-date"><i class="fa fa-pencil"></i> <?php the_time( get_option( 'date_format') ); ?></span>
									</header>
									<?php the_excerpt(); ?>
								</div>
							</div>
						</article>

						<?php endwhile; else: ?>
							<p><?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>.</p>
						<?php endif; wp_reset_postdata();?>
					</div>
					<div class="col-md-4">
						<?php get_sidebar(); ?>
					</div>



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
