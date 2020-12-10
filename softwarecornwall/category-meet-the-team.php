<?php
/* ------------------------------------------------------------------------ */
/* Template Name: Category: Meet the team
/* ------------------------------------------------------------------------ */
get_header();
?>

<!-- Template Name: Category: Meet the team -->
<div class="sd-blog-page">
	<div class="container">
		<div id="post-wrapper" class="row"> 

			<div class="col-sm-10 col-sm-offset-1 category-description-wrapper" style="text-align: center;">
				<?php the_archive_description();?>
			</div>			

			<?php 
			$args = array(
				'posts_per_page' => -1,
				'orderby' => 'rand',
				'order' => 'DESC',
				'cat' => get_cat_ID( 'Meet the Team' ) // current category ID
			);
			$query = new WP_Query( $args );
				
			if ( $query->have_posts() ) :  while ( $query->have_posts() ) : $query->the_post();?>
				<article class="col-xs-6 col-sm-4 sd-blog-entry">
					<header>
					<?php $permalink = get_the_permalink(); 
						  $first_name = explode(' ', get_the_title())[0]; ?>
						<a href="<?php echo $permalink; ?>" title="<?php get_the_title();?> Team Member Page." rel="bookmark">
							<h3><?php the_title(); ?></h3>
						</a>
						<!-- post thumbnail -->
						<?php if ( ( function_exists( 'has_post_thumbnail') ) && ( has_post_thumbnail() ) ) : ?>
							<div class="sd-entry-thumb">
								<figure><?php the_post_thumbnail( 'blog-grid-thumb' ); ?></figure>
							</div>
						<?php endif; ?>
						<!-- post thumbnail end-->
					</header>

					<div class="sd-entry-content">
						<p><?php the_excerpt(); ?></p>
						<p><a class="more-link" href="<?php echo $permalink; ?>">Meet <?php echo $first_name; ?></a></p>
					</div>
				</article>

			<?php endwhile; else: ?>
				<p><?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>.</p>
			<?php endif; wp_reset_postdata();?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
