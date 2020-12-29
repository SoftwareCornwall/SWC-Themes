<?php
/**
 * Widget: Events List Event
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/widgets/widget-events-list/event.php
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
<li class="clearfix">
	<div class="sd-recent-widget-thumb upcoming-events-widget-thumb">
		<?php $this->template( 'widgets/widget-events-list/event/date-tag', [ 'event' => $event ] ); ?>
	</div>

	<div class="sd-recent-posts-content">
		<?php $this->template( 'widgets/widget-events-list/event/title', [ 'event' => $event ] ); ?>	
		<?php $this->template( 'widgets/widget-events-list/event/date', [ 'event' => $event ] ); ?>
		<?php $this->do_entry_point( 'event_meta' ); ?>
	</div>

</li>
