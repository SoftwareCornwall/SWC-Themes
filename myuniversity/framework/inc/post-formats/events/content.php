<?php
/* ------------------------------------------------------------------------ */
/* Theme Index Content - Standard Post Format
/* ------------------------------------------------------------------------ */
global $sd_data;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-standard-entry sd-course-entry clearfix' ); ?>> 
	
	<!-- entry wrapper -->
	<div class="sd-events-page">
		<div class="sd-entry-wrapper">
			<header> <span class="sd-event-date"><?php echo rwmb_meta( 'sd_event_date' ); ?></span> </header>
			<?php if ( $sd_data['sd_events_featured_img'] == '1' ) : ?>
		<!-- post thumbnail -->
		<?php if ( ( function_exists( 'has_post_thumbnail') ) && ( has_post_thumbnail() ) ) : ?>
		<div class="sd-entry-thumb">
			<figure>
				<?php $sd_layout = $sd_data['sd_events_layout'];  $feat_img_size = ( ( $sd_layout == '2' ) ? 'large-blog-thumbs' : 'blog-thumbs' ); ?>
				<?php the_post_thumbnail( $feat_img_size ); ?>
			</figure>
		</div>
		<?php endif; ?>
		<!-- post thumbnail end--> 
		<?php endif; ?>
			<h3 class="sd-entry-title">
				<?php if ( is_single() ) : ?>
				<?php the_title(); ?>
				<?php else : ?>
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'sd-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
				<?php the_title(); ?>
				</a>
				<?php endif; ?>
			</h3>
			<?php if ( $sd_data['sd_events_post_meta_enable'] == '1' ) : ?>
				<?php get_template_part( 'framework/inc/post-meta-events' ); ?>
			<?php endif; ?>
			<!-- entry content  -->
			<div class="sd-entry-content">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>
	<!-- entry wrapper end--> 
</article>
<!--post-end--> 