<?php
/* ------------------------------------------------------------------------ */
/* Theme's Scripts and Styles
/* ------------------------------------------------------------------------ */

if ( !function_exists( 'sd_jquery_scripts' ) ) {
	function sd_jquery_scripts() {
		/* ------------------------------------------------------------------------ */
		/* Register jQuery Scripts */
		/* ------------------------------------------------------------------------ */
		wp_register_script( 'sd-pretty-photo', SD_FRAMEWORK_JS . 'prettyphoto.js', false, '', true );
		wp_register_script( 'flexslider', SD_FRAMEWORK_JS . 'flexslider.js', false, '', true );
		wp_register_script( 'sd-isotope', SD_FRAMEWORK_JS . 'isotope.js', false, '', true );
		wp_register_script( 'sd-custom', SD_FRAMEWORK_JS . 'custom.js', false, '', true );
		wp_register_script( 'sd-tabs', SD_FRAMEWORK_JS . 'sd-tabs.js', false, '', true );
		wp_register_script( 'sd-gmap', '//maps.google.com/maps/api/js?sensor=false', false, '', false );
		
		/* ------------------------------------------------------------------------ */
		/* Enqueue Scripts */
		/* ------------------------------------------------------------------------ */
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'sd-pretty-photo' );
		wp_enqueue_script( 'flexslider' );
		wp_enqueue_script( 'sd-gmap' );
		wp_enqueue_script( 'sd-custom' );
		if ( is_page_template( 'professors.php' ) ) {
			wp_enqueue_script( 'sd-isotope' );
		}
		wp_localize_script( 'sd-custom', 'sd_advanced_search_var', array(
				'attr' => __( 'Keywords', 'sd-framework' )
			)
		);
		wp_localize_script( 'sd-custom', 'sd_newlsetter_var', array(
				'attr' => __( 'Enter your Email', 'sd-framework' )
			)
		);
		wp_localize_script( 'sd-custom', 'sd_search_var', array(
				'attr' => __( 'search here', 'sd-framework' )
			)
		);
	}
	add_action( 'wp_enqueue_scripts', 'sd_jquery_scripts' );
}

if ( !function_exists( 'sd_css_styles' ) ) {
	function sd_css_styles() {
	
		/* ------------------------------------------------------------------------ */
		/* Register Stylesheets */
		/* ------------------------------------------------------------------------ */
		
		wp_register_style( 'sd-bootstrap', SD_FRAMEWORK_CSS . 'bootstrap.css', 'style' );
		wp_register_style( 'sd-font-awesome', SD_FRAMEWORK_CSS . 'font-awesome.css', 'style' );
		wp_register_style( 'flexslider', SD_FRAMEWORK_CSS . 'flexslider.css', 'style' );
		wp_register_style( 'sd-prettyphoto', SD_FRAMEWORK_CSS . 'prettyPhoto.css', 'style' );
		wp_register_style( 'sd-custom-css', get_template_directory_uri() . '/admin/sd-admin-options/custom-styles.css', 'style' );
	
		
		/* ------------------------------------------------------------------------ */
		/* Enqueue Styles */
		/* ------------------------------------------------------------------------ */
		wp_enqueue_style( 'sd-bootstrap', '2' );	
		wp_enqueue_style( 'stylesheet', get_stylesheet_uri(), array(), '3', 'all' ); // Main Stylesheet
		wp_enqueue_style( 'sd-custom-css', '4', 'all' );
		wp_enqueue_style( 'sd-font-awesome' );
		wp_enqueue_style( 'flexslider' );
		wp_enqueue_style( 'sd-prettyphoto' );
	}
	add_action( 'wp_enqueue_scripts', 'sd_css_styles', 1 );
}
?>
