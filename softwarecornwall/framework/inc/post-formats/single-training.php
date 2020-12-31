<?php
/* ------------------------------------------------------------------------ */
/* Theme Single Post - Standard Post Format
/* ------------------------------------------------------------------------ */
global $sd_data;
?>

<!-- Partial: single-training.php -->
<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-single-blog-entry clearfix' ); ?>> 
	<!-- entry wrapper -->
	<div class="sd-entry-wrapper">
		<?php if ( $sd_data['sd_blog_post_meta_enable'] == '1' ) : ?>
			<header>
				<?php get_template_part( 'framework/inc/post-meta' ); ?>
			</header>
		<?php endif; ?>
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
		<?php if ( $sd_data['sd_blog_single_prev_next'] == '1' ) : ?>
		<footer>
			<div class="sd-prev-next-post clearfix">
				<span class="sd-prev-post">	<?php next_post_link( '%link', '&larr; ' . $sd_data['sd_blog_single_prev'] ); ?> </span>
				<span class="sd-next-post">	<?php previous_post_link( '%link',  $sd_data['sd_blog_single_next'] . ' &rarr;' ); ?> </span>
			</div>
		</footer>
		<?php endif; ?>
	</div>
	<!-- entry wrapper end--> 
</article>
<!--post-end-->
