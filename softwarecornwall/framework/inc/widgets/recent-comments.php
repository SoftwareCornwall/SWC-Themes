<?php
/*
Plugin Name: Top Commentators Widget
Plugin URI: http://www.skatdesign.com/
Description: A simple widget to display the top commentators and comments count.
Version: 1.00
Author: Skat
Author URI: http://www.skatdesign.com/
*/

// The widget class
class recent_comments_widget extends WP_Widget {
	
	// Widget Settings
	function __construct() {
		$widget_ops = array( 'classname' => 'recent_comments_widget', 'description' => __('A widget that displays the recent comments.', 'framework') );
		$control_ops = "";
		parent::__construct( 'recent_comments_widget', __('Custom Recent Comments', 'framework'), $widget_ops, $control_ops );
	}
	
	// Widget Output
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		// Before the widget
		echo $before_widget;

		// Display the widget title if one was input
		if ( $title )
		echo $before_title . $title . $after_title;
		?>

		<?php
			// Display recent comments
			
			function custom_recent_comments($amount = 5, $avatar_size = 35) {
				
 				$comments_query = new WP_Comment_Query();
				$comments = $comments_query->query( array( 'number' => $amount ) );
				
				$comm = '';
				if ( $comments ) : foreach ( $comments as $comment ) :
					$comm .= '<li><div class="recent-avatar">' . get_avatar( $comment->comment_author_email, $avatar_size );
					$comm .= '</div><div class="recent-text"><p><a class="recent-author" href="' . get_permalink($comment->comment_post_ID) . '#comment-' . $comment->comment_ID . '">';
					$comm .= get_comment_author( $comment->comment_ID ) . '</a> la:<br /> ';
					$comm .= '<a href="'. get_permalink($comment->comment_post_ID) .'">' . get_the_title($comment->comment_post_ID) . '</a></p></div></li>';

				endforeach; else :
					$comm .= 'No comments.';
				endif;

				echo $comm;	
			}
			
			echo '<ul class="custom-recent-comments">';
			custom_recent_comments($instance['amount']);
			echo '</ul>';
		?>
		<?php 
		// After the widget
		echo $after_widget;
	}
	// Update the widget		
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['amount'] = strip_tags( $new_instance['amount'] );

		return $instance;
	}

	// Widget panel settings
	function form( $instance ) {

	// Default widgets settings
		$defaults = array(
		'title' => __('Recent Comments', 'framework'),
		'amount' => '5',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<!-- Number of commentators: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'amount' ); ?>"><?php _e('Number of commentators', 'framework') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'amount' ); ?>" name="<?php echo $this->get_field_name( 'amount' ); ?>" value="<?php echo $instance['amount']; ?>" />
		</p>
		
	<?php
	}
}
// Register and load the widget
function recent_comments_widget() {
	register_widget( 'recent_comments_widget' );
}
add_action( 'widgets_init', 'recent_comments_widget' );
?>
