<?php
/* ------------------------------------------------------------------------ */
/* Theme Index Content - Audio Post Format
/* ------------------------------------------------------------------------ */
global $sd_data;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-audio-entry clearfix' ); ?>> 
	<!-- entry wrapper -->
	<div class="sd-entry-wrapper"> 
		<!-- post thumbnail -->
		<div class="sd-entry-audio">
			<?php $audio_url = get_post_meta( $post->ID, '_format_audio_embed', true ); ?>
			<?php echo do_shortcode( '[audio src="'. $audio_url .'"]' ); ?> </div>
		<!-- post thumbnail end-->
		<header>
			<h3 class="sd-entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'sd-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
				<?php the_title(); ?>
				</a> </h3>
		</header>
		<?php if ( $sd_data['sd_blog_post_meta_enable'] == '1' ) : ?>
			<?php get_template_part( 'framework/inc/post-meta' ); ?>
		<?php endif; ?>
		<!-- entry content  -->
		<div class="sd-entry-content">
			<?php the_excerpt(); ?>
		</div>
		<!-- entry content end --> 
	</div>
	<!-- entry wrapper end--> 
</article>
<!--post-end--> 