<?php
/* ------------------------------------------------------------------------ */
/* Theme Single Post - Standard Post Format
/* ------------------------------------------------------------------------ */
global $sd_data;
?>

<!-- Partial: single-training.php -->
<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-single-blog-entry clearfix' ); ?>> 
	<div class="sd-entry-wrapper single-training-wrapper">
		
		<div class="sd-entry-content">
			<?php the_content(); ?>
		</div>

		<?php if ( $sd_data['sd_blog_single_prev_next'] == '1' ) : ?>
		<footer>
			<div class="sd-prev-next-post clearfix">
				<?php $bookLink = get_post_meta($post->ID, 'training_ticket_link', true); if ($bookLink) { ?>
					<span class="sd-next-post"><a href="<?php echo $bookLink; ?>" title="Book <?php get_the_title();?> now" class="sd_blog_single_next">Book Now</a></span>
				<?php }?>
			</div>
		</footer>
		<?php endif; ?>
	</div>
</article>
