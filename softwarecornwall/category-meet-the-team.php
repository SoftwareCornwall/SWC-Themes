<?php
/* ------------------------------------------------------------------------ */
/* Template Name: Category: Meet the team
/* ------------------------------------------------------------------------ */
get_header();
?>

<!-- Template Name: Category: Meet the team -->
<div class="sd-blog-page">
	<div class="container">
		<div class="row"> 

			<div class="col-sm-10 col-sm-offset-1 category-description-wrapper" style="text-align: center;">
				<?php the_archive_description();?>
			</div>			

			<?php 
			$args = array(
				'numberposts' => -1,
				'orderby' => 'post_date',
				'order' => 'DESC',
				'cat' => $current_category->cat_ID // current category ID
			);
			$the_query = new WP_Query( $args );
			global $more;
			$more = 0;
				
			if ( $wp_query->have_posts() ) :  while ( have_posts() ) : the_post();?>
			<article class="col-xs-6 col-sm-4">
				<header>
					<a href="<?php the_permalink(); ?>" title="<?php get_the_title();?> Team Member Page." rel="bookmark">
						<h3><?php the_title(); ?></h3>
					</a>
					<!-- post thumbnail -->
					<?php if ( ( function_exists( 'has_post_thumbnail') ) && ( has_post_thumbnail() ) ) : ?>
					<div class="sd-entry-thumb">
						<figure>
							<?php the_post_thumbnail( 'blog-grid-thumb' ); ?>
						</figure>
					</div>
					<?php endif; ?>
					<!-- post thumbnail end-->
				</header>

				<div class="sd-entry-content">
					<p><?php the_excerpt(); ?></p>
				</div>
			</article>

			<?php endwhile; else: ?>
				<p><?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>.</p>
			<?php endif; wp_reset_postdata();?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
