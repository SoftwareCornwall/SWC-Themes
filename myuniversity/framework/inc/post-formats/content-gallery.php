<?php
/* ------------------------------------------------------------------------ */
/* Theme Index Content - Gallery Post Format
/* ------------------------------------------------------------------------ */
global $sd_data;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-gallery-entry clearfix' ); ?>> 
	<!-- entry wrapper -->
	<div class="sd-entry-wrapper">
		<header>
			<h3 class="sd-entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'sd-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
				<?php the_title(); ?>
				</a> </h3>
		</header>
		<?php if ( $sd_data['sd_blog_post_meta_enable'] == '1' ) : ?>
			<?php get_template_part( 'framework/inc/post-meta' ); ?>
		<?php endif; ?>
		<!-- post gallery slider -->
		<div class="sd-entry-gallery">
			<div class="flexslider">
				<ul class="slides">
					<?php if ( $images = get_children( array( 'post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image' ) ) ) : ?>
					<?php foreach( $images as $image ) :  ?>
					<li><a href="<?php the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', 'sd-framework' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
						<figure><?php echo wp_get_attachment_image( $image->ID, 'blog-thumbs' ); ?></figure>
						</a></li>
					<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
		</div>
		<!-- post gallery slider end--> 
		<!-- entry content  -->
		<div class="sd-entry-content">
			<?php the_excerpt(); ?>
		</div>
		<!-- entry content end --> 
	</div>
	<!-- entry wrapper end--> 
</article>
<!--post-end--> 