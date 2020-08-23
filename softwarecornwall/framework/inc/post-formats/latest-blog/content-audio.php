<?php
/* ------------------------------------------------------------------------ */
/* Theme Index Content - Audio Post Format
/* ------------------------------------------------------------------------ */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-audio-entry clearfix' ); ?>> 
	<!-- entry wrapper -->
	<div class="sd-entry-wrapper clearfix"> 
		<!-- post thumbnail -->
		<div class="sd-entry-audio">
			<?php $audio_url = get_post_meta( $post->ID, '_format_audio_embed', true ); ?>
			<?php echo do_shortcode( '[audio src="'. $audio_url .'"]' ); ?> </div>
		<!-- post thumbnail end--> 
		<!-- entry content  -->
		<div class="sd-entry-content">
			<header>
				<h3 class="sd-entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'sd-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
					<?php the_title(); ?>
					</a> </h3>
				<span class="sd-latest-blog-date"><i class="fa fa-pencil"></i>
				<?php the_time( get_option( 'date_format' ) ); ?>
				</span> </header>
			<?php the_excerpt(); ?>
		</div>
	</div>
	<!-- entry wrapper end--> 
</article>
<!--post-end--> 