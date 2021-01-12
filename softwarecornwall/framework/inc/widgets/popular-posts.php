<?php
/*
Plugin Name: Popular Posts Widget
Plugin URI: http://skat.tf/
Description: A simple widget to display the popular posts.
Version: 1.00
Author: Skat
Author URI: http://skat.tf/
*/

// The widget class
class sd_popular_posts_widget extends WP_Widget {
	
	// Widget Settings
	function __construct() {
		$widget_ops = array( 'classname' => 'sd_popular_posts_widget', 'description' => __( 'A widget to display the popular posts.', 'sd-framework' ) );
		$control_ops = "";
		parent::__construct( 'sd_popular_posts_widget', __( 'Popular Posts', 'sd-framework' ), $widget_ops, $control_ops );
	}
	
	// Widget Output
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);

		// Before the widget
		echo $before_widget;

		// Display the widget title if one was input
		if ( $title )
		echo $before_title . $title . $after_title;
		
		// Display the popular posts
		?>

<div class="sd-recent-posts-widget">
	<ul>
		<?php 
			$sd_popular_posts = new WP_Query();
			$sd_popular_posts->query( 'showposts='.$instance['postcount'].'&orderby=comment_count' );
			while ( $sd_popular_posts->have_posts() ) : $sd_popular_posts->the_post(); ?>
		<li class="clearfix"> 
			<!-- post thumbnail --> 
			<?php if (  ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() )  ) : ?>
			<div class="sd-recent-widget-thumb">
				<figure>
					<?php the_post_thumbnail( 'thumbnail' ); ?>
				</figure>
			</div>
			<?php endif; ?>
			<!-- post thumbnail end-->
			<div class="sd-recent-posts-content">
				<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_title(); ?>
					</a> </h4>
				<span class="sd-recent-date"> <?php comments_number( __( '0 comments', 'sd-framework' ), __( '1 comment', 'sd-framework' ), __( '% comments', 'sd-framework' ) ); ?> </span></div>
			<!--details--> 
		</li>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</ul>
</div>
<?php 
		// After the widget
		echo $after_widget;
	}
	// Update the widget		
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['postcount'] = strip_tags( $new_instance['postcount'] );

		return $instance;
	}

	// Widget panel settings
	function form( $instance ) {

	// Default widgets settings
		$defaults = array(
		'title' => 'Popular Posts',
		'postcount' => '3'
		);
		$instance = wp_parse_args( ( array ) $instance, $defaults ); ?>

<!-- Widget Title: Text Input -->
<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>">
    <?php _e('Title:', 'sd-framework') ?>
  </label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<!-- Post Count: Text Input -->
<p>
  <label for="<?php echo $this->get_field_id( 'postcount' ); ?>">
    <?php _e('Post Count', 'sd-framework') ?>
  </label>
  <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
</p>
<?php
	}
}
// Register and load the widget
function sd_popular_posts_widget() {
	register_widget( 'sd_popular_posts_widget' );
}
add_action( 'widgets_init', 'sd_popular_posts_widget' );
?>
