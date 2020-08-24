<?php
/* ------------------------------------------------------------------------ */
/* Theme Single Post - Gallery Post Format
/* ------------------------------------------------------------------------ */
global $sd_data;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-single-blog-entry clearfix' ); ?>> 
	<!-- entry wrapper -->
	<div class="sd-entry-wrapper"> 
		<!-- post thumbnail -->
		<div class="sd-entry-gallery">
			<div class="flexslider">
				<ul class="slides">
					<?php $sd_layout = $sd_data['sd_events_layout'];  $feat_img_size = ( ( $sd_layout == '2' ) ? 'large-post-image' : 'post-image' ); ?>
					<?php if ($images = get_children( array( 'post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image' ) ) ) : ?>
					<?php foreach( $images as $image ) :  ?>
					<li>
						<figure><?php echo wp_get_attachment_link( $image->ID, $feat_img_size ); ?></figure>
					</li>
					<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
		</div>
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
