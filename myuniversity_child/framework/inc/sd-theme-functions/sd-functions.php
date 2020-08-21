<?php

/* ------------------------------------------------------------------------ */
/* SD Theme Functions
/* ------------------------------------------------------------------------ */
// Theme Menus
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-theme-menus.php' );
	
// Theme Sidebars
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-theme-sidebars.php' );
	
// Custom TinyMce Styles
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-custom-tinymce-styles.php' );
	
// Custom Pagination
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-custom-pagination.php' );
	
// Custom Comments Callback
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-comments.php' );

// Font Awesome Fonts Array
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-font-awesome.php' );



// Add support for WP 2.9+ post thumbnails
if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 189, 189, true ); // default Post Thumbnail dimensions
	add_image_size( 'blog-thumbs', 770, 400, true ); // blog thumbs
	add_image_size( 'large-blog-thumbs', 1140, 680, true ); // large blog thumbs
	add_image_size( 'recent-blog-widget', 100, 65, true ); // recent blog widget thumbs
	add_image_size( 'latest-blog-sd', 370, 190, true ); // latest blog shortcode thumbs
	add_image_size( 'sd-staff-photo', 183, 183, true ); // staff shortcode thumbs
	add_image_size( 'sd-testimonial-photo', 82, 82, true ); // testimonial shortcode thumbs
	add_image_size( 'sd-professors-page-thumb', 260, 260, true ); // professors shortcode thumbs
}
	
// Add rel PrettyPhoto to images in post
if ( !function_exists( 'sd_rel_prettyphoto' ) ) {
	function sd_rel_prettyphoto( $content ) {
		global $post;
	
		$pattern ="/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
		$replacement = '<a$1href=$2$3.$4$5 rel="PrettyPhoto[' . $post->ID . ']"$6>';
		$content = preg_replace( $pattern, $replacement, $content );

		return $content;
	}
	add_filter( 'the_content', 'sd_rel_prettyphoto' );
}

	// Add feed links to header
	add_theme_support( 'automatic-feed-links' );
	
	// Add post formats WP 3.1+
	add_theme_support( 'post-formats', array( 'video', 'audio', 'gallery') );

	// Run shortcodes in widgets
	add_filter( 'widget_text', 'do_shortcode' );
 
	// Change WP admin logo
if ( !function_exists( 'sd_custom_login_logo' ) ) {
	function sd_custom_login_logo() { 
		global $sd_data;
	
		if ( !empty( $sd_data['sd_admin_logo_upload'] ) ) {
?>
		
			<style type="text/css">
				body.login div#login h1 a {
					background-image: url(<?php echo $sd_data['sd_admin_logo_upload']['url']; ?>);
					background-size: auto;
					<?php if ( !empty( $sd_data['sd_admin_logo_height'] ) ) {
						echo 'height: ' . $sd_data['sd_admin_logo_height']['height'] . ';';
					} ?>
					padding-bottom: 30px;
					width: auto;
				}
			</style>
		<?php 
		}
	}
add_action( 'login_enqueue_scripts', 'sd_custom_login_logo' );
}

// Custom admin logo url
if ( !function_exists( 'sd_custom_login_logo_url' ) ) {
	function sd_custom_login_logo_url() {
		global $sd_data;
		
		if ( !empty( $sd_data['sd_admin_url'] ) ) {
	    	return esc_url( $sd_data['sd_admin_url'] );
		
		} else {
			return esc_url( home_url() );	
		}
			
	}
	add_filter( 'login_headerurl', 'sd_custom_login_logo_url' );
}
	
// Add editor style
if ( !function_exists( 'sd_add_editor_styles' ) ) {
	function sd_add_editor_styles() {
    	add_editor_style( 'editor-styles.css' );
	}
	
	add_action( 'init', 'sd_add_editor_styles' );
}

// Custom Youtube Embed
if ( !function_exists( 'sd_customize_youtube' ) ) {
	function sd_customize_youtube( $html, $url, $args ) {
 
	/* Modify video parameters. */
		if ( strstr( $html,'youtube.com/embed/' ) ) {
			$html = str_replace( '?feature=oembed', '?feature=oembed&amp;hd=1;rel=0;showinfo=0&amp;controls=2&amp;theme=light&amp;modestbranding=1', $html );
		}
	
    	return $html;
	}
	
	add_filter( 'oembed_result', 'sd_customize_youtube', 10, 3 );
}
	
// Half title
if ( !function_exists( 'sd_half_title' ) ) {	
	function sd_half_title( $title ){
   
	// Break the sentence into its component words:
	$words = explode( ' ', $title );
	// Get the last word and trim any punctuation:
	$last_word = '<span class="sd-light"> '.$words[count( $words ) - 1].'</span>';

	$remaining_words = substr( $title, 0, strrpos( $title, " " ) );
	
	return $remaining_words . $last_word;
	}
}
	
// Chamge Widget Title
if ( !function_exists( 'sd_custom_widget_title' ) ) {	
	function sd_custom_widget_title( $title ){

		return sd_half_title( $title );

	}
	add_filter( 'widget_title', 'sd_custom_widget_title', 10, 3 );
}
	

// Filter tag clould output so that it can be styled by CSS
if ( !function_exists( 'sd_style_tag_cloud' ) ) {	
	function sd_style_tag_cloud( $tags ) {
	    $tags = preg_replace_callback( "|(class='tag-link-[0-9]+)('.*?)(style='font-size: )([0-9]+)(pt;')|",
        create_function(
            '$match',
            '$low=1; $high=5; $sz=($match[4]-8.0)/(22-8)*($high-$low)+$low; return "{$match[1]} tagsz-{$sz}{$match[2]}";'
        ),
        $tags );
    	return $tags;
	}
 	add_action( 'wp_tag_cloud', 'sd_style_tag_cloud' );
}
 
	
// Remove width and height from featured images
if ( !function_exists( 'sd_remove_width_height' ) ) {
	function sd_remove_width_height( $html ) {
		$html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
		
		return $html;
	}
	add_filter( 'post_thumbnail_html', 'sd_remove_width_height', 10 );
}
 
// Excerpt limit

if ( !function_exists( 'sd_excerpt_more' ) ) {	
	function sd_excerpt_length( $length ) {
		
		global $post;
	
		if ( get_post_type( $post ) == 'professors' ) {
		    return 13;
		} else {
			return 50;
		}
	}
	add_filter( 'excerpt_length', 'sd_excerpt_length', 999 );
}


// Excerpt more
if ( !function_exists( 'sd_excerpt_more' ) ) {	
	function sd_excerpt_more($output) {
		
		global $post;
		
		if ( get_post_type( $post ) == 'professors' ) {
		    return $output . '<p><a class="more-link" href="'. get_permalink( get_the_ID() ) . '#more-' . get_the_ID() . '">' . __('View Member', 'sd-framework') . '</a></p>';
		} elseif ( get_post_type( $post ) == 'events' ) {
			return $output . '<p><a class="more-link" href="'. get_permalink( get_the_ID() ) . '#more-' . get_the_ID() . '">' . __('View Event', 'sd-framework') . '</a></p>';
		} elseif ( get_post_type( $post ) == 'courses' ) {
			return $output . '<p><a class="more-link" href="'. get_permalink( get_the_ID() ) . '#more-' . get_the_ID() . '">' . __('View Course', 'sd-framework') . '</a></p>';
		} else {
			return $output . '<p><a class="more-link" href="'. get_permalink( get_the_ID() ) . '#more-' . get_the_ID() . '">' . __('Read More', 'sd-framework') . '</a></p>';
		}
	}
	add_filter('get_the_excerpt', 'sd_excerpt_more');
}
	
// Change excerpt ending [...] to ...
if ( !function_exists( 'sd_new_excerpt_more' ) ) {	
	function sd_new_excerpt_more( $more ) {
		return "...";
	}
	add_filter('excerpt_more', 'sd_new_excerpt_more');
}
// Exclude professors from tax archive

// add_action( 'pre_get_posts', 'sd_exclude_professors' );

// if ( !function_exists( 'sd_exclude_professors' ) ) {	
// 	function sd_exclude_professors( $query ) {
//     	if ( $query->is_tax( 'course_discipline' ) ) {
//         	$query->set( 'post_type', array( 'courses' ) );
// 	    }
//     return $query;
// 	}
// }

// Custom styling of widget titles in widget panel
if ( !function_exists( 'sd_custom_widgets_style' ) ) {
	function sd_custom_widgets_style() {
    	echo '
			 <style type="text/css">
			div.widget[id*=_tweets_widget-] .widget-top, div.widget[id*=_popular_posts_widget-] .widget-top, div.widget[id*=_feedburner_widget-] .widget-top, div.widget[id*=_ads_widget-] .widget-top, div.widget[id*=_recent_comments_widget-] .widget-top, div.widget[id*=_opening_hours_widget-] .widget-top, div.widget[id*=_social_icons_widget-] .widget-top, div.widget[id*=_recent_posts_widget-] .widget-top, div.widget[id*=_flickr_widget-] .widget-top, div.widget[id*=_sd_tabbed_widget-] .widget-top, div.widget[id*=_sd_recent_events_widget-] .widget-top, div.widget[id*=_sd_amenities_widget-] .widget-top, div.widget[id*=_sd_trainers_widget-] .widget-top, div.widget[id*=_wcs3_today_classes_widget-] .widget-top {
	color: #00adee;
	}
			</style>
';
	}
	add_action('admin_print_styles-widgets.php', 'sd_custom_widgets_style');
}
	
// Add PrettyPhoto rel to flexslider
if ( !function_exists( 'sd_prettphoto' ) ) {
	function sd_prettphoto ( $content ) {
		$content = preg_replace( "/<a/","<a rel=\"prettyPhoto[flexslider]\"", $content, 1 );
		return $content;
	}
	add_filter( 'wp_get_attachment_link', 'sd_prettphoto' );
}
	
// Alter Author Contact Fields
if ( !function_exists( 'sd_author_bio' ) ) {
	function sd_author_bio( $contactmethods ) {
		// Add Google Plus
		// $contactmethods['googleplus'] = __( 'Google+ Url', 'sd-framework' );
		$contactmethods['linkedin'] = __( 'Linked In', 'sd-framework' );
		
		return $contactmethods;
	}
	add_filter( 'user_contactmethods', 'sd_author_bio');
}

// Add custom favicon
if ( !function_exists( 'sd_custom_favicon' ) ) {
	function sd_custom_favicon() {

		global $sd_data;

		if ( !empty( $sd_data['sd_favicon_upload']['url'] ) ) {
	        echo '<link rel="shortcut icon" href="'.  $sd_data['sd_favicon_upload']['url']  .'"/>'."\n";
	    } else { 
?>
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/framework/images/favicon.ico" />
<?php   }
	}
	add_action( 'wp_head', 'sd_custom_favicon' );
}

// Custom CSS
if ( !function_exists( 'sd_custom_css' ) ) {
	function sd_custom_css() {
		
		global $sd_data;
		
		$output = '';
		
		$custom_css = ( !empty($sd_data['sd_custom_css']) ? $sd_data['sd_custom_css'] : '');
		
		if ($custom_css <> '') {
			$output .= $custom_css . "\n";
		}
		
		// Output styles
		
		if ($output <> '') {

			$output = "\n<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";

			echo $output;
		}
	}
		add_action('wp_head', 'sd_custom_css');
}
