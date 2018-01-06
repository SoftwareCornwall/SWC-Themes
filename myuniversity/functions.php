<?php
/**
 * remove the register link from the wp-login.php script belinda oct17
 */
add_filter('option_users_can_register', function($value) {
    $script = basename(parse_url($_SERVER['SCRIPT_NAME'], PHP_URL_PATH));

    if ($script == 'wp-login.php') {
        $value = false;
    }

    return $value;
});


/**
 * add recaptcha to job post and resume post belinda oct17
 */

// Define your keys here
define( 'RECAPTCHA_SITE_KEY',   '6LdqVzUUAAAAAIAZRYEm3MiJUHtqSAAio-1KgK-R' );
define( 'RECAPTCHA_SECRET_KEY', '6LdqVzUUAAAAAGkHEyAceXoN6DAkev1s8xQejEXU' );
// Enqueue Google reCAPTCHA scripts
add_action( 'wp_enqueue_scripts', 'recaptcha_scripts' );
function recaptcha_scripts() {
    wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js' );
}
// Add reCAPTCHA to the job submission form
// If you disabled company fields, the submit_job_form_end hook can be used instead from version 1.24.1 onwards
add_action( 'submit_job_form_company_fields_end', 'recaptcha_field' );
function recaptcha_field() {
?>
<fieldset>
    <label>Are you human?</label>
    <div class="field">
        <div class="g-recaptcha" data-sitekey="<?php echo RECAPTCHA_SITE_KEY; ?>"></div>
    </div>
</fieldset>
<?php
}
// Validate
add_filter( 'submit_job_form_validate_fields', 'validate_recaptcha_field' );
function validate_recaptcha_field( $success ) {
$response = wp_remote_get( add_query_arg( array(
'secret'   => RECAPTCHA_SECRET_KEY,
'response' => isset( $_POST['g-recaptcha-response'] ) ? $_POST['g-recaptcha-response'] : '',
'remoteip' => isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']
), 'https://www.google.com/recaptcha/api/siteverify' ) );
if ( is_wp_error( $response ) || empty( $response['body'] ) || ! ( $json = json_decode( $response['body'] ) ) || ! $json->success ) {
return new WP_Error( 'validation-error', '"Are you human" check failed. Please try again.' );
}
return $success;
}
add_action( 'submit_resume_form_resume_fields_end', 'recaptcha_field' );
add_filter( 'submit_resume_form_validate_fields', 'validate_recaptcha_field' );


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

// Theme Functions
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-functions.php' );

// Include Widgets
require_once( SD_FRAMEWORK_INC . 'widgets/widgets.php' );

// Posts 2 Posts
require_once( SD_FRAMEWORK_INC . 'connection-types.php' );

// Visual Composer
if ( class_exists( 'Vc_Manager' ) ) {
require_once( SD_FRAMEWORK_INC . 'vc/sd-vc-functions.php' );
}

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

/* TGMA Automatic Plugin Activation */
require_once( SD_FRAMEWORK_INC . 'tgma/plugin-activation.php' );
require_once( SD_FRAMEWORK_INC . 'tgma/sd-tgma.php' );

// WP Advanced Search
// http://wpadvancedsearch.com
require_once( SD_FRAMEWORK_INC . 'wp-advanced-search/wpas.php' );
require_once( SD_FRAMEWORK_INC . 'wp-advanced-search/sd-wp-advanced-search.php');	