<?php
/* ------------------------------------------------------------------------ */
/* Page Titles
/* ------------------------------------------------------------------------ */
global $sd_data;

if ( !is_category() && !is_tag() && !is_search() && !is_404() && !is_day() && !is_year() && !is_archive() && !is_tax() && !is_date() && !is_author() ) {
	$header_bg = rwmb_meta( 'sd_header_page_bg' );
	$header_bg = wp_get_attachment_image_src( $header_bg, 'full' );
	$no_repeat = rwmb_meta( 'sd_no_repeat', 'type=checkbox' );
	$repeat_x = rwmb_meta( 'sd_repeat_x', 'type=checkbox' );
	$repeat_y = rwmb_meta( 'sd_repeat_y', 'type=checkbox' );
	$no_repeat = ( $no_repeat == 1 ? 'no-repeat center ' : '' );
	$repeat_x = ( $repeat_x == 1 ? ' repeat-x ' : '' );
	$repeat_y = ( $repeat_y == 1 ? ' repeat-y ' : '');
}
?>

<?php if ( !is_front_page() ) : ?>
<!-- page top -->
<div class="sd-page-top clearfix" <?php if (!empty($header_bg) && !is_category() && !is_tag() && !is_search() && !is_404() && !is_day() && !is_year() && !is_archive() && !is_tax() && !is_date() && !is_author() ) echo 'style="background: url('. $header_bg[0] .')' . $no_repeat . $repeat_x . $repeat_y .';"' ?>>
	<div class="container"> 
		<!-- page title -->
		<?php if( is_archive() ) : ?>
	
			<?php if ( have_posts() ) : ?>
				<?php /* If this is a category archive */ if ( is_category() ) { ?>
					<h1>
						<?php single_cat_title(); ?>
					</h1>
	
				<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
					<h1>
						<?php _e( 'Tagged as:', 'sd-framework' ); ?>
						<?php single_tag_title(); ?>
					</h1>
	
				<?php /* If this is a daily archive */ } elseif ( is_day() ) { ?>
					<h1>
						<?php _e( 'Archive for', 'sd-framework' ); ?>
						<?php the_time( 'F jS, Y' ); ?>
					</h1>
		
				<?php /* If this is a monthly archive */ } elseif ( is_month() ) { ?>
					<h1>
						<?php _e( 'Archive for', 'sd-framework' ); ?>
						<?php the_time( 'F, Y' ); ?>
					</h1>
				<?php /* If this is a yearly archive */ } elseif ( is_year() ) { ?>
					<h1>
						<?php _e( 'Archive for', 'sd-framework' ); ?>
						<?php the_time( 'Y' ); ?>
					</h1>

				<?php /* If this is a paged archive */ } elseif ( isset( $_GET['paged']) && !empty( $_GET['paged']) ) { ?>
					<h1>
						<?php _e( 'Archive', 'sd-framework' ); ?>
					</h1>
	
				<?php } elseif( tribe_is_month() && !is_tax() ) { ?>
					<h1>Events Calendar</h1>
				<?php } elseif( tribe_is_month() && is_tax() ) { ?>
					<h1><?php echo 'Events Calendar' . ' &raquo; ' . single_term_title('', false);?></h1>
				<?php } elseif( tribe_is_event() && !tribe_is_day() && !is_single() ) { ?>
					<h1> Events Calendar</h1>
				<?php } else { ?>
					<h1>
						<?php single_cat_title(); ?>
					</h1>
				<?php } ?>
			<?php endif; ?>
			
		<?php elseif ( is_single() ) : ?>
		
		<?php $page_title = rwmb_meta( 'sd_page-title' );
			
			if ( !empty( $page_title ) ) :
				echo $page_title;
			else :
		?>
			<h1 class="sd-styled-title">
				<?php wp_title( '' ); ?>
			</h1>
		
			<?php endif; ?>

		<?php elseif ( is_search() ) : ?>
			<h1>
				<?php _e( 'Search Results for:', 'sd-framework' ); ?>
				<?php $allsearch = new WP_Query( "s=$s&amp;showposts=-1" ); $key = esc_html( $s, 1 ); echo '"' . $key . '"'; wp_reset_query(); ?>
			</h1>
		<?php elseif ( is_404() ) : ?>
			<h1>
				<?php echo $sd_data['sd_404_title']; ?>
			</h1>
		
		
		
		<?php else : ?>
	
		<?php
			
			$page_title = rwmb_meta( 'sd_page-title' );
			
			if ( !empty( $page_title) ) :
				echo $page_title;
			else :
		?>
			<h1 class="sd-styled-title">
				<?php wp_title( '' ); ?>
			</h1>	
			<?php endif; ?>
		<?php endif; ?>
		<!-- page title end --> 
	</div>
</div>
<!-- page top end -->
<?php endif; ?>
