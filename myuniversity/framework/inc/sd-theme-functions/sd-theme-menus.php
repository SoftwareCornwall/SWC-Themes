<?php

/* ------------------------------------------------------------------------ */
/* Theme Menus
/* ------------------------------------------------------------------------ */

// Theme support adding changed from 'nav-menus' to just 'menus'
add_theme_support( 'menus' );
 
// Function for registering wp_nav_menu()
if ( !function_exists( 'sd_register_navmenus' ) ) {
	function sd_register_navmenus() {
		register_nav_menus( array(
			'Header Menu'    => __( 'Header Navigation', 'sd-framework' )
			)
		);
	}
	add_action( 'init', 'sd_register_navmenus' );
}

// Automatically add home link to the menu
if ( !function_exists( 'sd_page_menu_args' ) ) {
	function sd_page_menu_args( $args ) {
	    $args['show_home'] = true;
    	return $args;
	}
	add_filter( 'wp_page_menu_args', 'sd_page_menu_args' );
}