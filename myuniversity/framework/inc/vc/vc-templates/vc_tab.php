<?php
$defaults = array( 'title' => 'Tab Title', 'icon' => 'fa-money' );
		extract( shortcode_atts( $defaults, $atts ) );
		
		$out =  '<div id="sd-tab-'. sanitize_title( $title ) .'" class="sd-tab">'. do_shortcode( $content ) .'</div>';
		
		echo $out;