
<?php
/* ------------------------------------------------------------------------ */
/* Template Name: Category
/* ------------------------------------------------------------------------ */
get_header();
?>

<!-- Template Name: Category - Frequently Asked Questions -->
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
						

					<?php 
					$all_categories = get_categories( array(
						'parent' => '354'
					));

					foreach( $all_categories as $single_category ){
						//for each category, get the ID
						$catID = $single_category->cat_ID;
						echo '<h2>' . $single_category->name . '</h2>';
				
						$query = new WP_Query( array( 'cat'=> $catID, 'posts_per_page'=>10 ) );
						while( $query->have_posts() ):$query->the_post();
						echo '<a href="'.get_the_permalink().'"><h3>'.get_the_title().'</h3></a>';
						endwhile; 
						echo '</br>';
						wp_reset_postdata();
					}?>

						<br /><br />
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
