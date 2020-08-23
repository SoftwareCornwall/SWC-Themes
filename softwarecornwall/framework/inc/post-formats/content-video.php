<?php
/* ------------------------------------------------------------------------ */
/* Theme Index Content - Video Post Format
/* ------------------------------------------------------------------------ */
global $sd_data;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-video-entry clearfix' ); ?>> 
	<!-- entry wrapper -->
	<div class="sd-entry-wrapper">
		<header>
			<h3 class="sd-entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink la %s', 'sd-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
				<?php the_title(); ?>
				</a> </h3>
		</header>
		<?php if ( $sd_data['sd_blog_post_meta_enable'] == '1' ) : ?>
			<?php get_template_part( 'framework/inc/post-meta' ); ?>
		<?php endif; ?>
		<!-- post video -->
		<?php $oembed = get_post_meta($post->ID, '_format_video_embed', true ); ?>
		<div class="sd-entry-video"> <?php echo  wp_oembed_get ( $oembed ); ?> </div>
		<!-- post video end--> 
		<!-- entry content  -->
		<div class="sd-entry-content">
			<?php the_excerpt(); ?>
		</div>
		<!-- entry content end -->
	</div>
	<!-- entry wrapper end--> 
</article>
<!--post-end--> 