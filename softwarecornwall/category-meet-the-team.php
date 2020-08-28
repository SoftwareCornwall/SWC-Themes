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

			<?php global $wp_query;
					global $more;
					$more = 0;
			?>
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); 
					$title = get_the_title();
					$title_array = explode(' ', $title);
					$first_name = $title_array[0];
				?>
				
				<div class="col-sm-4">
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

					<div class="sd-entry-content">
						<header>
							
						</header>
						<p><?php the_excerpt(); ?></p>
					</div>
				</div>

				<?php endwhile; else: ?>
					<p><?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>.</p>
				<?php endif; ?>

					

		</div>
	</div>
</div>
<?php get_footer(); ?>
