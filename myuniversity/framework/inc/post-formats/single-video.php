<?php
/* ------------------------------------------------------------------------ */
/* Theme Single Post - Video Post Format
/* ------------------------------------------------------------------------ */
global $sd_data;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-single-blog-entry clearfix' ); ?>> 
	<!-- entry wrapper -->
	<div class="sd-entry-wrapper"> 
		<!-- post thumbnail -->
		<?php $oembed = get_post_meta($post->ID, '_format_video_embed', true ); ?>
		<div class="sd-entry-video"> <?php echo  wp_oembed_get ( $oembed ); ?> </div>
		<!-- post thumbnail end-->
		<?php if ( $sd_data['sd_blog_post_meta_enable'] == '1' ) : ?>
			<header>
				<?php get_template_part( 'framework/inc/post-meta' ); ?>
			</header>
		<?php endif; ?>
		<!-- entry content  -->
		<div class="sd-entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( 'before=<strong class="page-navigation clearfix">&after=</strong>' ); ?>
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