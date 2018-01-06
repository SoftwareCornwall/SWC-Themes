<?php

/*-----------------------------------------------------------------------------------*/
/*	SD Visual Composer Functions
/*-----------------------------------------------------------------------------------*/

// change VC templates dir

$dir = SD_FRAMEWORK_INC . 'vc/vc-templates/';
vc_set_template_dir( $dir );

// Set Visual Composer to run in Theme Mode
if( function_exists( 'vc_set_as_theme' ) ) {
	function sd_vc_as_theme() {
		vc_set_as_theme( true );
	}
	add_action( 'init', 'vc_set_as_theme' );

	if ( !function_exists( 'sd_disable_vc_front_end' ) ) {
		function sd_disable_vc_front_end() {
			if ( function_exists( 'vc_disable_frontend' ) ) {
				
			} else {
				return;
			}
		}
	}
	add_action( 'init', 'sd_disable_vc_front_end' );
}

// disable frontend mode (still in beta)

vc_disable_frontend();

// remove params and elements
require_once( SD_FRAMEWORK_INC . 'vc/sd-vc-remove.php' );
	
// update params
require_once( SD_FRAMEWORK_INC . 'vc/sd-vc-update.php' );

// include theme's shortcodes
require_once( SD_FRAMEWORK_INC . 'vc/shortcodes/sd-blog.php' );
require_once( SD_FRAMEWORK_INC . 'vc/shortcodes/sd-events.php' );
require_once( SD_FRAMEWORK_INC . 'vc/shortcodes/sd-staff.php' );
require_once( SD_FRAMEWORK_INC . 'vc/shortcodes/sd-gmap.php' );
require_once( SD_FRAMEWORK_INC . 'vc/shortcodes/sd-icon-box.php' );
require_once( SD_FRAMEWORK_INC . 'vc/shortcodes/sd-testimonial.php' );

// remove default layout templates

add_filter( 'vc_load_default_templates', 'sd_remove_default_layout_templates' );

if ( !function_exists( 'sd_remove_default_layout_templates' ) ) {
	function sd_remove_default_layout_templates( $data ) {
    	return array(); // This will remove all default templates
	}
}

// include SD layout templates

require_once( SD_FRAMEWORK_INC . 'vc/sd-layout-templates.php' );


// Run code in admin only
if ( !is_admin() ) {
	return;
	} else {

		// Remove VC Teaser metabox
		if ( ! function_exists( 'sd_remove_vc_boxes' ) ) {
			function sd_remove_vc_boxes() {
				$post_types = get_post_types( '', 'names' ); 
				foreach ( $post_types as $post_type ) {
					remove_meta_box( 'vc_teaser',  $post_type, 'side' );
				}
			} 
		}
	add_action( 'do_meta_boxes', 'sd_remove_vc_boxes' );
}