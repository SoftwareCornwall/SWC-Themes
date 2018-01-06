<?php
/* ------------------------------------------------------------------------ */
/* Theme Events Single Post
/* ------------------------------------------------------------------------ */
global $sd_data;
?>

<div class="sd-events-meta clearfix">
	<?php $event_time_from = rwmb_meta( 'sd_event_time_from' );
		  $event_time_to = rwmb_meta( 'sd_event_time_to' );
	?>
	<?php if ( $sd_data['sd_events_post_meta'][1] == '1' ) : ?>
		<?php if ( !empty( $event_time_from ) & !empty( $event_time_to ) ) : ?>
		<span class="sd-event-time"><?php echo $event_time_from; ?> - <?php echo $event_time_to; ?></span>
		<?php endif; ?>
	<?php endif; ?>
	
	<?php if ( $sd_data['sd_events_post_meta'][2] == '1' ) : ?>
		<span class="sd-event-location"><?php the_terms( $post->ID, 'event_location', '@ ', ', ', '' ); ?></span>
	<?php endif; ?>
</div>
