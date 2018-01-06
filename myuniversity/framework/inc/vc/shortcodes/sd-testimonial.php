<?php
/*-----------------------------------------------------------------------------------*/
/*	Testimonial
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'sd_testimonials' ) ) {
	function sd_testimonials( $atts, $content = NULL ) {
		extract( shortcode_atts( array(
			'cat'		 => '',
			'items'		 => '3'
		), $atts ) );
		
		
		if ( !empty( $cat ) ) {
			
			$category =	array(
							'taxonomy' => 'professors_tax',
							'field' => 'slug',
							'terms' => $cat,
							'operator' => 'IN'
						);
		} else {
			$category = NULL;
		}
		
		global $post;

		$args = array(
			'post_type' => 'testimonials',
			'posts_per_page' => $items,
			'order'          => 'DESC',
			'orderby'        => 'date',
			'post_status'    => 'publish',
			'tax_query' => array(
				'relation' => 'AND',
				$category
			)
	    );
	
    	query_posts( $args );
	
		global $wp_query;
		
		

		
		ob_start();
?>
<?php if( have_posts() ) : ?>
<script type="text/javascript">
					jQuery( function( $ ) {
							var $slider = $( ".sd-testimonials .flexslider" );

								$slider.flexslider({
									animation: "fade",
									controlNav : false,
									directionNav: true,
									pauseOnHover: true
								});
					});
</script>
<div class="sd-testimonials">
	<div class="flexslider">
		<ul class="slides">
	<?php while ( have_posts() ) : the_post(); ?>
			<li>
				<div class="sd-testimonial-content"><?php the_content(); ?></div>
				<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) : ?>
					<figure>
						<?php the_post_thumbnail( 'blog-thumbs' ); ?>
					</figure>
				<?php endif; ?>						
				<h4><?php the_title(); ?></h4>
			</li>
   <?php endwhile; 
		wp_reset_query();
   ?>
		</ul>
	</div>
</div>
<?php endif; ?>

		
	
<?php
		return ob_get_clean();	
	}
	add_shortcode( 'sd_testimonials','sd_testimonials' );
}

// register shortcode to VC

add_action( 'init', 'sd_testimonial_vcmap' );

if ( ! function_exists( 'sd_testimonial_vcmap' ) ) {
	function sd_testimonial_vcmap() {
		vc_map( array(
			'name'					=> 'Testimonials',
			'description'			=> 'Insert professor testimonials',
			'base'					=> "sd_testimonials",
			'class'					=> "sd_testimonials",
			'category'				=> 'My University',
			'icon' 					=> "icon-wpb-sd-testimonials",
			'admin_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'front_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'params'				=> array(
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'Professor Category',
					'param_name'	=> 'cat',
					'value'			=> '',
					'description'	=> 'Enter the slug of the professors testimonials category. Eg. jhon-doe.',
					),
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'Number of items to display',
					'param_name'	=> 'items',
					'value'			=> '3',
					'description'	=> 'Enter the number of items to display (default is 3)',
					)
				)
			));
	}
}