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
/* Includes
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

// Font Awesome Fonts Array
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-font-awesome.php' );

// Remove Pingbacks completely to reduce potential exploit avenues
// require_once( SD_FRAMEWORK_INC . 'pingbacks.php');

// Redux Theme Options
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/admin/ReduxCore/framework.php' ) ) {
	require_once( dirname( __FILE__ ) . '/admin/ReduxCore/framework.php' );
}

if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/admin/sd-admin-options/sd-admin-options.php' ) ) {
	require_once( dirname( __FILE__ ) . '/admin/sd-admin-options/sd-admin-options.php' );
}

/* Include Meta Box Script */
function sd_load_meta_box_plugin() {
	// Re-define meta box path and URL
	define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/framework/inc/metabox' ) );
	define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/framework/inc/metabox' ) );
	require_once RWMB_DIR . 'meta-box.php';
	include 'framework/inc/metabox/the-meta-boxes.php';
}
add_action('init', 'sd_load_meta_box_plugin');

// Sets up theme default image sizes, and removes a couple for luck
add_theme_support( 'post-thumbnails' );
add_image_size( 'job-thumb', 150, 150, true );
add_image_size( 'blog-grid-thumb', 370, 190, true ); // latest blog thumbs, used in grids
add_image_size( 'post-image', 770, 400, true ); // blog thumbs used on individual page
remove_image_size( '1536x1536' );
remove_image_size( '2048x2048' );

// Removes the register link from the login page
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

// Custom admin logo url
function sd_custom_login_logo_url() {
	global $sd_data;
	if ( !empty( $sd_data['sd_admin_url'] ) ) {
		return esc_url( $sd_data['sd_admin_url'] );
	} else {
		return esc_url( home_url() );	
	}	
}
add_filter( 'login_headerurl', 'sd_custom_login_logo_url' );
	
// Add editor style
function sd_add_editor_styles() {
	add_editor_style( 'editor-styles.css' );
}
add_action( 'init', 'sd_add_editor_styles' );

// Custom Youtube Embed
function sd_customize_youtube( $html, $url, $args ) {
/* Modify video parameters. */
	if ( strstr( $html,'youtube.com/embed/' ) ) {
		$html = str_replace( '?feature=oembed', '?feature=oembed&amp;hd=1;rel=0;showinfo=0&amp;controls=2&amp;theme=light&amp;modestbranding=1', $html );
	}
	return $html;
}
add_filter( 'oembed_result', 'sd_customize_youtube', 10, 3 );
	
// Half title
function sd_half_title( $title ){
	// Break the sentence into its component words:
	$words = explode( ' ', $title );
	// Get the last word and trim any punctuation:
	$last_word = '<span class="sd-light"> '.$words[count( $words ) - 1].'</span>';

	$remaining_words = substr( $title, 0, strrpos( $title, " " ) );
	
	return $remaining_words . $last_word;
}
	
// Change Widget Title
function sd_custom_widget_title( $title ){
	return sd_half_title( $title );
}
add_filter( 'widget_title', 'sd_custom_widget_title', 10, 3 );	

// Filter tag cloud output so that it can be styled by CSS
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
	
// Remove width and height from featured images
function sd_remove_width_height( $html ) {
	$html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
	
	return $html;
}
add_filter( 'post_thumbnail_html', 'sd_remove_width_height', 10 );
 
// Excerpt limit	
function sd_excerpt_length( $length ) {
	return 50;
}
add_filter( 'excerpt_length', 'sd_excerpt_length', 999 );

// Excerpt more
function swc_excerpt_more($output) {
	
	if ( is_category( 'meet-the-team' ) ) { // "Meet First name" button for Team Member profiles
		return $output;
	} else {
		return $output . '<p><a class="more-link" href="'. get_permalink( get_the_ID() ) . '#more-' . get_the_ID() . '">' . __('Read More', 'sd-framework') . '</a></p>';
	}
}
add_filter('get_the_excerpt', 'swc_excerpt_more');
	
// Change excerpt ending [...] to ...
function sd_new_excerpt_more( $more ) {
	return "...";
}
add_filter('excerpt_more', 'sd_new_excerpt_more');

// Custom styling of widget titles in widget panel
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

	
// Alter Author Contact Fields
function sd_author_bio( $contactmethods ) {
	$contactmethods['linkedin'] = __( 'Linked In', 'sd-framework' );
	
	return $contactmethods;
}
add_filter( 'user_contactmethods', 'sd_author_bio');

// Add custom favicon from admin panel
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

// Custom CSS taken from admin panel
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

// Add custom footer to the admin area
function modify_footer_admin () {
	echo 'Developed by <a href="https://tonyedwardspz.co.uk">Tony Edwards</a> | ';
	echo 'For <a href="https://softwarecornwall.org">Software Cornwall</a> | ';
	echo 'Based on a theme by <a href="http://www.skat.tf/redirect/?theme=myuniversity">SKAT Design</a> | ';
	echo 'Powered by <a href="http://WordPress.org">WordPress</a>';
}
add_filter('admin_footer_text', 'modify_footer_admin');

// Removes comments from post and pages
function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
	remove_post_type_support( 'page', 'comments' );
	wp_deregister_script( 'comment-reply' ); 
}
add_action('init', 'remove_comment_support', 100);

// Remove comments from the admin area
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'my_remove_admin_menus' );

function software_cornwall_admin_bar_render() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('comments');
  $wp_admin_bar->remove_menu('notes');
}
add_action( 'wp_before_admin_bar_render', 'software_cornwall_admin_bar_render' );

// disable srcset on frontend
function disable_wp_responsive_images() {
	return 1;
}
add_filter('max_srcset_image_width', 'disable_wp_responsive_images');

// Select template file for FAQ & meet the team
add_filter( 'single_template', function ( $single_template ) {

	if ( has_category( 'frequently-asked-questions') || has_category( 'about-software-cornwall' ) ||
		 has_category( 'eu-programmes' ) || has_category( 'how-to' ) ) {
        $single_template = dirname( __FILE__ ) . '/single-frequently-asked-question.php';
	} elseif( has_category( 'meet-the-team' ) ) {
		$single_template = dirname( __FILE__ ) . '/single-meet-the-team.php';
	} elseif( has_category( 'training-courses' ) || has_category('employer-led-skills-training-courses')) {
		$single_template = dirname( __FILE__ ) . '/single-training-course.php';
	}
    return $single_template;
     
}, PHP_INT_MAX, 2 );

function add_training_meta_box() {
    $screens = [ 'post' ];
    foreach ( $screens as $screen ) {
        add_meta_box(
            'swc_training_meta',     // Unique ID
            'Training Details',  // Box title
            'training_meta_box_html', // Content callback
            $screen                  // Post type
        );
    }
}
add_action( 'add_meta_boxes', 'add_training_meta_box' );

// TODO - Not happy with having HTML in this file. Find a better solution if this gets edited in the future.
function training_meta_box_html( $post ) { ?>
	<input type="hidden" name="training_meta_box_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)) ?>" />
	<p>Complete this section if this is a post for a training course run by Software Cornwall.</p>
	<label for="training_start_date" style="min-width:200px; display: inline-block;">Start Date</label>
	<input type="text" id="training_start_date" name="training_start_date" placeholder="e.g 17/03/2021"
		   value="<?php echo get_post_meta($post -> ID, "training_start_date", true);?>"><br />
	<label for="training_end_date" style="min-width:200px; display: inline-block;">End Date</label>
	<input type="text" id="training_end_date" name="training_end_date" placeholder="e.g 18/03/2021"
		   value="<?php echo get_post_meta($post -> ID, "training_end_date", true);?>"><br />
	<label for="training_start_time" style="min-width:200px; display: inline-block;">Start Time (24hr)</label>
	<input type="text" id="training_start_time" name="training_start_time" placeholder="e.g 9:00"
		   value="<?php echo get_post_meta($post -> ID, "training_start_time", true);?>"><br />
	<label for="training_end_time" style="min-width:200px; display: inline-block;">End Time (24hr)</label>
	<input type="text" id="training_end_time" name="training_end_time" placeholder="e.g 18:00"
		   value="<?php echo get_post_meta($post -> ID, "training_end_time", true);?>"><br />
	<label for="training_full_price" style="min-width:200px; display: inline-block;">Full Price</label>
	<input type="text" id="training_full_price" name="training_full_price" placeholder="e.g. £199.99"
		   value="<?php echo get_post_meta($post -> ID, "training_full_price", true);?>"><br />
	<label for="training_funded_price" style="min-width:200px; display: inline-block;">Funded Price</label>
	<input type="text" id="training_funded_price" name="training_funded_price" placeholder="e.g £99.99"
		   value="<?php echo get_post_meta($post -> ID, "training_funded_price", true);?>"><br />
	<label for="training_venue" style="min-width:200px; display: inline-block;">Training Venue</label>
	<input type="text" id="training_venue" name="training_venue" placeholder="e.g Online / Heartlands"
		   value="<?php echo get_post_meta($post -> ID, "training_venue", true);?>"><br />
	<label for="training_delivered_by" style="min-width:200px; display: inline-block;">Delivered By</label>
	<input type="text" id="training_delivered_by" name="training_delivered_by" placeholder="e.g Tony Edwards"
		   value="<?php echo get_post_meta($post -> ID, 'training_delivered_by', true);?>"><br />
	<label for="training_ticket_link" style="min-width:200px; display: inline-block;">Ticket Link</label>
	<input type="text" id="training_ticket_link" name="training_ticket_link" placeholder="https://eventbrite.com/tktk"
		   value="<?php echo get_post_meta($post -> ID, 'training_ticket_link', true);?>"><br />
<?php } 

function swc_save_training_meta($post_id) {
    $custom_meta_fields = Array(
		"training_start_date",
		"training_end_date",
		"training_start_time",
		"training_end_time",
		"training_full_price",
		"training_funded_price",
		"training_venue",
		"training_delivered_by",
		"training_ticket_link"
	); 

    if (!wp_verify_nonce($_POST['training_meta_box_nonce'], basename(__FILE__)))
		return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
		error_log('Auto saving post meta. Post ID: ' . $post_id  , 0);
		return $post_id; 
	}  
         

    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
	}  
	
    foreach ($custom_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field, true);  
        $new = $_POST[$field];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field, $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field, $old);  
        }  
    }
}
add_action('save_post', 'swc_save_training_meta'); 

// Exclude certain categories from displaying the related posts widget after the content
function jetpackme_filter_exclude_category( $filters ) {
    $filters[] = array(
        'not' => array(
            'term' => array(
                'category.slug' => array(
					'frequently-asked-questions', 
					'about-software-cornwall', 
					'eu-programmes', 
					'how-to',
					'employer-led-skills-training-courses',
					'training-courses'
				),
            ),
        ),
    );
 
    return $filters;
}
add_filter( 'jetpack_relatedposts_filter_filters', 'jetpackme_filter_exclude_category' );


?>
