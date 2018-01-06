<?php

/*-----------------------------------------------------------------------------------*/
/*	SD Register Theme Sidebars
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'sd_register_sidebars' ) ) {
 	function sd_register_sidebars() {
		
		register_sidebar( array(
			'name' => __( 'Main Sidebar', 'sd-framework' ),
			'id' => 'main-sidebar',
			'description'   => __( 'Main sidebar that appears on the right.', 'sd-framework' ),
			'before_widget' => '<aside id="%1$s" class="sd-sidebar-widget clearfix %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<div class="sd-title-wrapper"><h3 class="sd-styled-title">',
			'after_title' => '</h3></div>',
			) 
		);
		
		register_sidebar( array(
			'name' => __( 'Footer Left Sidebar', 'sd-framework' ),
			'id' => 'footer-left-sidebar',
			'description'   => __( 'Appears in the left footer section of the site.', 'sd-framework' ),
			'before_widget' => '<aside id="%1$s" class="sd-footer-sidebar-widget clearfix %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="sd-footer-title">',
			'after_title' => '</h4>',
			) 
		);
		
		register_sidebar( array(
			'name' => __( 'Footer Middle Sidebar', 'sd-framework' ),
			'id' => 'footer-middle-sidebar',
			'description'   => __( 'Appears in the middle footer section of the site.', 'sd-framework' ),
			'before_widget' => '<aside id="%1$s" class="sd-footer-sidebar-widget clearfix %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="sd-footer-title">',
			'after_title' => '</h4>',
			) 
		);
		
		register_sidebar( array(
			'name' => __( 'Footer Right Sidebar', 'sd-framework' ),
			'id' => 'footer-right-sidebar',
			'description'   => __( 'Appears in the right footer section of the site.', 'sd-framework' ),
			'before_widget' => '<aside id="%1$s" class="sd-footer-sidebar-widget clearfix %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="sd-footer-title">',
			'after_title' => '</h4>',
			) 
		);
	}
	add_action( 'widgets_init', 'sd_register_sidebars' );
}