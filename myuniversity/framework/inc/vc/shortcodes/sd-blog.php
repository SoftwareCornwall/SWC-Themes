<?php
/*-----------------------------------------------------------------------------------*/
/*	Latest Blog Items
/*-----------------------------------------------------------------------------------*/

if (!function_exists( 'sd_latest_blog_items' ) ) {
	function sd_latest_blog_items( $atts ) {
		extract( shortcode_atts( array(
			'cats'	=>	'',
			'items'	=>	'6'
		), $atts ) );
		
	wp_enqueue_script( 'sd-isotope' );
    
	global $post;

	$args = array(
		'post_type' => 'post',
		'cat' => $cats,
		'posts_per_page' => $items,
		'order'          => 'DESC',
		'orderby'        => 'date',
		'post_status'    => 'publish'
    );
	
    query_posts( $args );
	
	global $wp_query;
	global $more;
	$more = 0;
	
	ob_start();
	?>
		
        	<div class="row">
		        <div class="sd-latest-blog-short">
	
		<?php if( have_posts() ) : ?>
			
								<?php while ( have_posts() ) : the_post(); ?>
                                
                               	<div class="col-md-4 col-sm-6 sd-isotope-item-recent-blog">
									
								<?php get_template_part( 'framework/inc/post-formats/latest-blog/content', get_post_format() ); ?>

								</div>
										
							 	<?php endwhile; ?>
							
		
		<?php      wp_reset_query();
			  endif;
	
		 ?>
				</div>
			</div>

		<?php return ob_get_clean();	
		
	}
	add_shortcode( 'sd_blog','sd_latest_blog_items' );
}

// register shortcode to VC

add_action( 'init', 'sd_latest_blog_items_vcmap' );

if ( ! function_exists( 'sd_latest_blog_items_vcmap' ) ) {
	function sd_latest_blog_items_vcmap() {
		vc_map( array(
			'name'					=> 'Latest Blog',
			'description'			=> 'Latest blog items',
			'base'					=> "sd_blog",
			'class'					=> "sd_blog",
			'category'				=> 'My University',
			'icon' 					=> "icon-wpb-sd-blog",
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
					),
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'Categories',
					'param_name'	=> 'cats',
					'value'			=> '',
					'description'	=> 'Insert the ids of the categories you want to pull posts from (optional). Comma separated. (eg. 2, 43)',
					)
				)
			));
	}
}