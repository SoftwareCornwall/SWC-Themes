<?php

/*-----------------------------------------------------------------------------------*/
/* Define Theme Constants
/*-----------------------------------------------------------------------------------*/

define( 'SD_FRAMEWORK', get_template_directory() .'/framework/' );
define( 'SD_FRAMEWORK_INC', get_template_directory() .'/framework/inc/' );
define( 'SD_FRAMEWORK_CSS', get_template_directory_uri() .'/framework/css/' );
define( 'SD_FRAMEWORK_JS', get_template_directory_uri() .'/framework/js/' );

// Define content width
if ( ! isset( $content_width ) ) $content_width = 1170;

/* ------------------------------------------------------------------------ */
/* Localization
/* ------------------------------------------------------------------------ */

$lang = SD_FRAMEWORK . '/lang';
load_theme_textdomain('sd-framework', $lang);

/* ------------------------------------------------------------------------ */
/* Inlcudes
/* ------------------------------------------------------------------------ */

// Enqueue JavaScripts & CSS
require_once( SD_FRAMEWORK_INC . 'enqueue.php');

// Include Widgets
require_once( SD_FRAMEWORK_INC . 'widgets/widgets.php' );

// Theme Menus
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-theme-menus.php' );
	
// Theme Sidebars
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-theme-sidebars.php' );
	
// Custom Pagination
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-custom-pagination.php' );
	
// Custom Comments Callback
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-comments.php' );

// Font Awesome Fonts Array
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-font-awesome.php' );

// Remove Pingbacks completely to potential exploit avenues
require_once( SD_FRAMEWORK_INC . 'pingbacks.php');

// Redux Theme Options
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/admin/ReduxCore/framework.php' ) ) {
require_once( dirname( __FILE__ ) . '/admin/ReduxCore/framework.php' );
}

if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/admin/sd-admin-options/sd-admin-options.php' ) ) {
require_once( dirname( __FILE__ ) . '/admin/sd-admin-options/sd-admin-options.php' );
}

/* Include Meta Box Script */
if ( !function_exists( 'sd_load_meta_box_plugin' ) ) {
function sd_load_meta_box_plugin() {
// Re-define meta box path and URL
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/framework/inc/metabox' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/framework/inc/metabox' ) );
require_once RWMB_DIR . 'meta-box.php';
include 'framework/inc/metabox/the-meta-boxes.php';
}
add_action('init', 'sd_load_meta_box_plugin');
}

// Add support for WP 2.9+ post thumbnails
if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 189, 189, true ); // default Post Thumbnail dimensions
	add_image_size( 'blog-thumbs', 770, 400, true ); // blog thumbs
	add_image_size( 'large-blog-thumbs', 1140, 680, true ); // large blog thumbs
	add_image_size( 'recent-blog-widget', 100, 65, true ); // recent blog widget thumbs
	add_image_size( 'latest-blog-sd', 370, 190, true ); // latest blog shortcode thumbs
}

// remove the register link from the wp-login.php script - belinda oct17
add_filter('option_users_can_register', function($value) {
    $script = basename(parse_url($_SERVER['SCRIPT_NAME'], PHP_URL_PATH));

    if ($script == 'wp-login.php') {
        $value = false;
    }

    return $value;
});
	

	// Add feed links to header
	add_theme_support( 'automatic-feed-links' );

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
		return 50;
	}
	add_filter( 'excerpt_length', 'sd_excerpt_length', 999 );
}

// Excerpt more
if ( !function_exists( 'sd_excerpt_more' ) ) {	
	function sd_excerpt_more($output) {
		return $output . '<p><a class="more-link" href="'. get_permalink( get_the_ID() ) . '#more-' . get_the_ID() . '">' . __('Read More', 'sd-framework') . '</a></p>';
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

// Custom styling of widget titles in widget panel
if ( !function_exists( 'sd_custom_widgets_style' ) ) {
	function sd_custom_widgets_style() {
    	echo '
			 <style type="text/css">
			div.widget[id*=_tweets_widget-] .widget-top, div.widget[id*=_popular_posts_widget-] .widget-top, div.widget[id*=_feedburner_widget-] .widget-top, div.widget[id*=_ads_widget-] .widget-top, div.widget[id*=_recent_comments_widget-] .widget-top, div.widget[id*=_opening_hours_widget-] .widget-top, div.widget[id*=_social_icons_widget-] .widget-top, div.widget[id*=_recent_posts_widget-] .widget-top, div.widget[id*=_sd_tabbed_widget-] .widget-top, div.widget[id*=_sd_recent_events_widget-] .widget-top, div.widget[id*=_sd_amenities_widget-] .widget-top, div.widget[id*=_sd_trainers_widget-] .widget-top, div.widget[id*=_wcs3_today_classes_widget-] .widget-top {
	color: #00adee;
	}
			</style>
';
	}
	add_action('admin_print_styles-widgets.php', 'sd_custom_widgets_style');
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
			echo "\n<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
		}
	}
		add_action('wp_head', 'sd_custom_css');
}

// Add custom footer to the admin area
function modify_footer_admin () {
	echo 'Created by <a href="https://tonyedwardspz.co.uk">Tony Edwards</a> | ';
	echo 'For <a href="https://softwarecornwall.org">Software Cornwall</a> | ';
	echo 'Powered by<a href="http://WordPress.org">WordPress</a>';
}
add_filter('admin_footer_text', 'modify_footer_admin');

// Removes from post and pages
add_action('init', 'remove_comment_support', 100);
function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}

// Remove comments from the admin area
add_action( 'admin_menu', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}

function software_cornwall_admin_bar_render() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'software_cornwall_admin_bar_render' );

// Remove WordPress Emoji from the markup. No comments, no emoji needed
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Hide WP REST API links in page headers
remove_action( 'wp_head', 'rest_output_link_wp_head', 10);
remove_action( 'template_redirect', 'rest_output_link_header', 11);

// Remove RSD link, used by 3rd party tools (V. SMALL chance of conflict with JetPack)
remove_action ('wp_head', 'rsd_link');

// Remove version number from markup
function remove_version() {
	return '';
}
add_filter('the_generator', 'remove_version');

?>
