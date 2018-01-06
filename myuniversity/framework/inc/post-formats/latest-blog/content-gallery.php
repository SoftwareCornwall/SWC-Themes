<?php
/* ------------------------------------------------------------------------ */
/* Theme Index Content - Gallery Post Format
/* ------------------------------------------------------------------------ */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-gallery-entry clearfix' ); ?>> 
	<!-- entry wrapper -->
	<div class="sd-entry-wrapper clearfix"> 
		<!-- post thumbnail -->
		<div class="sd-entry-gallery">
			<div class="flexslider">
				<ul class="slides">
					<?php if ( $images = get_children( array( 'post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image' ) ) ) : ?>
					<?php foreach( $images as $image ) :  ?>
					<li><a href="<?php the_permalink(); ?>" title="<?php printf( 'Permalink la %s', the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
						<figure><?php echo wp_get_attachment_image( $image->ID, 'latest-blog-sd' ); ?></figure>
						</a></li>
					<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
		</div>
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