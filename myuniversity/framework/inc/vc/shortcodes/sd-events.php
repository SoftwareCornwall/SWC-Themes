<?php
/*-----------------------------------------------------------------------------------*/
/*	Latest Events
/*-----------------------------------------------------------------------------------*/


if ( !function_exists( 'sd_latest_events_items' ) ) {
	function sd_latest_events_items( $atts ) {
		extract( shortcode_atts( array(
			'items'	=>	'6'
		), $atts ) );
		
	global $post;

	$args = array(
		'post_type' => 'events',
		'posts_per_page' => $items,
		'order'          => 'DESC',
		'orderby'        => 'date',
		'post_status'    => 'publish'
    );
	
    query_posts( $args );
	
	global $wp_query;
	global $more;
	$more = 0;
	
	ob_start(); ?>
	
	<div class="row">
		<div class="sd-latest-events">
	
	<?php if( have_posts() ) :
			
		while ( have_posts() ) : the_post();
	?>
		
			<div class="col-md-3 col-sm-6 sd-events-shortcode">
				<!-- post thumbnail -->
				<span class="sd-event-date"><?php echo rwmb_meta( 'sd_event_date' ); ?></span>
				<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) : ?>
					<div class="sd-entry-thumb">
						<figure>
							<?php the_post_thumbnail( 'blog-thumbs' ); ?>
						</figure>
					</div>
				<?php endif; ?>
				<!-- post thumbnail end--> 
				<h3 class="sd-event-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'sd-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
					<?php the_title(); ?>
					</a> </h3>
					
				<?php $event_time_from = rwmb_meta( 'sd_event_time_from' );
					  $event_time_to = rwmb_meta( 'sd_event_time_to' );
				?>
				<?php if ( !empty( $event_time_from ) & !empty( $event_time_to ) ) : ?>
				<span class="sd-event-time"><?php echo $event_time_from; ?> - <?php echo $event_time_to; ?></span>
				<?php endif; ?>
				<span class="sd-event-location">@ <?php the_terms( $post->ID, 'event_location', '', ', ', '' ); ?></span>
				
				<a class="sd-learn-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php _e('Learn More', 'sd-framework'); ?></a>
				
			</div>
		
		
	<?php endwhile;

		wp_reset_query();

	endif; ?>
		</div>
	</div>
	
	<?php return ob_get_clean();	
	
	}
	add_shortcode( 'sd_events','sd_latest_events_items' );
}

// register shortcode to VC

add_action( 'init', 'sd_latest_events_vcmap' );

if ( ! function_exists( 'sd_latest_events_vcmap' ) ) {
	function sd_latest_events_vcmap() {
		vc_map( array(
			'name'					=> 'Latest Events',
			'description'			=> 'Display latest events',
			'base'					=> "sd_events",
			'class'					=> "sd_events",
			'category'				=> 'My University',
			'icon' 					=> "icon-wpb-sd-events",
			'admin_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'front_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'params'				=> array(
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'Number of items to show',
					'param_name'	=> 'items',
					'value'			=> '6',
					'description'	=> 'Insert the number of items to show.',
					)
				)
			));
	}
}