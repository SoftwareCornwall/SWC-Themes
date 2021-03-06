<?php
/**
 * Widget: Events List
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/widgets/widget-events-list.php
 *
 * See more documentation about our views templating system.
 *
 * @link    http://m.tri.be/1aiy
 *
 * @version 5.3.0
 *
 * @var array<\WP_Post>      $events                     The array containing the events.
 * @var string               $rest_url                   The REST URL.
 * @var string               $rest_nonce                 The REST nonce.
 * @var int                  $should_manage_url          int containing if it should manage the URL.
 * @var array<string>        $container_classes          Classes used for the container of the view.
 * @var array<string,mixed>  $container_data             An additional set of container `data` attributes.
 * @var string               $breakpoint_pointer         String we use as pointer to the current view we are setting up with breakpoints.
 * @var array<string,string> $messages                   An array of user-facing messages, managed by the View.
 * @var boolean              $hide_if_no_upcoming_events Hide widget if no events.
 * @var string               $json_ld_data               The JSON-LD for widget events, if enabled.
 * @var string               $view_more_link             The URL to view all events.
 * @var string               $widget_title               The title of the widget.
 */

// Hide widget if no events and widget only displays with events is checked.
if ( empty( $events ) && $hide_if_no_upcoming_events ) {
	return;
}
?>
<div>
	<div>
		<h4 class="sd-footer-title">Upcoming <span class="sd-light">Events</span></h4>

		<?php if ( ! empty( $events ) ) : ?>

			<div class="sd-recent-posts-widget">
				<ul>
				<?php foreach ( $events as $event ) : ?>
					<?php $this->template( 'widgets/widget-events-list/event', [ 'event' => $event ] ); ?>
				<?php endforeach; ?>
				</ul>
			</div>

			<?php $this->template( 'widgets/widget-events-list/view-more', [ 'view_more_link' => $view_more_link ] ); ?>

		<?php else : ?>

			<?php $this->template( 'components/messages' ); ?>

		<?php endif; ?>
	</div>
</div>
