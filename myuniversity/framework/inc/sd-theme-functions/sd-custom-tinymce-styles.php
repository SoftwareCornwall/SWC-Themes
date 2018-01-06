<?php
/*-----------------------------------------------------------------------------------*/
/*	SD Register Theme Sidebars
/*-----------------------------------------------------------------------------------*/

if ( !class_exists( 'SdCustomTinyMceStyles' ) ) {
	class SdCustomTinyMceStyles {
  	
		public function __construct() {
    		add_filter( 'mce_buttons', array( &$this, 'add_dropdown' ) );
    		add_filter( 'tiny_mce_before_init', array( &$this, 'add_items' ) );
  		}
 
 
  		public function add_dropdown( $buttons ){
    		array_unshift( $buttons, 'styleselect' );
		    return $buttons;
  		}
 
 
  		public function add_items( $init_array ){
    		$styles = array();
 
			$styles[] = array(
					      	"title"   => "SD Light Text",
      						"classes" => "sd-light",
					      	"inline"  => "span",
							'wrapper' => true
					    );
			
			$styles[] = array(
					      	"title"    => "SD Styled List",
      						"classes"  => "sd-list-style",
							"selector" => "ul",
							"wrapper"  => true
					    );

			$styles[] = array(
					      	"title"   => "SD Subtitle",
      						"classes" => "sd-subtitle",
							"inline"  => "span",
							"wrapper" => true
					    );
			$styles[] = array(
					      	"title"	  => "SD Colored",
      						"classes" => "sd-colored",
							"inline"  => 'span',
							"wrapper" => true
					    );
			$styles[] = array(
					      	"title"	  => "SD Img Float Left",
      						"classes" => "pull-left",
							"inline"  => 'img',
							"wrapper" => true
					    );
			$styles[] = array(
					      	"title"	  => "SD Img Float Right",
      						"classes" => "pull-right",
							"selector" => "img",
							"wrapper" => true
					    );
			$styles[] = array(
					      	"title"	  => "SD Small Text",
      						"classes" => "sd-small-text",
							"inline"  => "span",
							"wrapper" => true
					    );
			$styles[] = array(
					      	"title"	  => "SD No Margin Paragraph",
      						"classes" => "sd-margin-none",
							"selector" => "p",
							"wrapper" => true
					    );
			$styles[] = array(
					      	"title"	  => "SD Clear Floats",
      						"classes" => "sd-clear",
							"selector" => "p, h2, h3, h4, h5, h6, div, img",
							"wrapper" => true
					    );
 
		    $init_array['style_formats'] = json_encode( $styles );
 
		    return $init_array;
		}
	}	
 
	new SdCustomTinyMceStyles();
}