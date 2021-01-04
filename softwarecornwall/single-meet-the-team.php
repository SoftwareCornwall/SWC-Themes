<?php
/* ------------------------------------------------------------------------
 * Template Name: Single - Meet the Team
 * Template Post Type: post
/* ------------------------------------------------------------------------ */
get_header(); 
global $sd_data;
?>

<!--MEET THE TEAM SINGLE -->
<div class="sd-blog-page">
	<div class="container">
		<div class="row"> 
			<!--left col-->
			<div class="col-md-<?php if ( $sd_data['sd_blog_layout'] == '2' ) echo '12'; else echo '8'; ?> <?php if ( $sd_data['sd_sidebar_location'] == '2' ) echo 'pull-right'; ?>">
				<div class="sd-left-col">
					<?php if (have_posts()) : while (have_posts()) : the_post();?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-single-blog-entry clearfix' ); ?>> 
							<!-- entry wrapper -->
							<div class="sd-entry-wrapper">
								<?php if ( $sd_data['sd_blog_featured_img'] == '1' ) : ?>
									<!-- post thumbnail -->
									<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) : ?>
									<div class="sd-entry-thumb">
										<figure>
											<?php $sd_layout = $sd_data['sd_blog_layout'];  $feat_img_size = ( ( $sd_layout == '2' ) ? 'large-post-image' : 'post-image' ); ?>
											<?php the_post_thumbnail( $feat_img_size ); ?>
										</figure>
									</div>
									<?php endif; ?>
									<!-- post thumbnail end--> 
								<?php endif; ?>
								<!-- entry content  -->
								<div class="sd-entry-content">
									<?php the_content(); ?>
									<?php wp_link_pages( 'before=<strong class="sd-page-navigation clearfix">&after=</strong>' ); ?>
								</div>
								<!-- entry content end -->
							</div>
							<!-- entry wrapper end--> 
						</article>
						<p>
						    <a class="more-link" href="<?php $cat = get_the_category(); $cat = $cat[0]; echo get_category_link($cat->cat_ID); ?>">Meet the Team</a>
						</p>
						<!--post-end-->

					<?php endwhile; else: ?>
					<p>
						<?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>
						.</p>
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
