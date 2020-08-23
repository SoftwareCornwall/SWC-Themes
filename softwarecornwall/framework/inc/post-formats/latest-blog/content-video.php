<?php
/* ------------------------------------------------------------------------ */
/* Theme Index Content - Video Post Format
/* ------------------------------------------------------------------------ */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-video-entry clearfix' ); ?>> 
	<!-- entry wrapper -->
	<div class="sd-entry-wrapper clearfix"> 
		<!-- post thumbnail -->
		<?php $oembed = get_post_meta($post->ID, '_format_video_embed', true ); ?>
		<div class="sd-entry-video"> <?php echo  wp_oembed_get ( $oembed ); ?> </div>
		<!-- post thumbnail end--> 
		<!-- entry content  -->
		<div class="sd-entry-content">
			<header>
				<h3 class="sd-entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'sd-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
					<?php the_title(); ?>
					</a> </h3>
			<span class="sd-latest-blog-date"><i class="fa fa-pencil"></i> <?php the_time( get_option( 'date_format' ) ); ?></span>
			</header>
			<?php the_excerpt(); ?>
		</div>
	</div>
	<!-- entry wrapper end--> 
</article>
<!--post-end--> 