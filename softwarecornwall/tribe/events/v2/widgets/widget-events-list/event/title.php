<?php
/**
 * Widget: Events List Event Title
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/widgets/widget-events-list/event/title.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://m.tri.be/1aiy
 *
 * @version 5.2.1
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */
?>
<h4>
	<a href="<?php echo esc_url( $event->permalink ); ?>"
	   title="<?php echo esc_attr( $event->title ); ?>"
	   rel="bookmark">
		<?php echo $event->title;?>
	</a>
</h4>
