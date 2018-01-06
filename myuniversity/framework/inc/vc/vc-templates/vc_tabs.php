<?php
$out = $title = $icons = $interval = $el_class = '';
extract( shortcode_atts( array(
	'title' => '',
	'interval' => 0,
	'type' => '',
	'icons' => 'no',
	'el_class' => ''
), $atts ) );

		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'jquery-effects-core', '', '', array( 'jquery' ) );
		wp_enqueue_script( 'jquery-effects-fade', '', '', array( 'jquery-effects-core' ) );
		wp_enqueue_script( 'sd-tabs' );

		$tab_type = ( $type == 'vertical' ? 'sd-vertical-tabs' : '' );
		$icons_type = ( $icons == 'yes' ? 'sd-icon-tabs' : '' );
		
		STATIC $i = 0;
		$i++;
		
		$sd_tab_class = ( 'vc_tour' == $this->shortcode ) ? 'sd-tour' : NULL ;
	
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( $sd_tab_class . $el_class ), $this->settings['base'], $atts );
		
		if ( $icons == 'yes' ) {

			preg_match_all( '/vc_tab title="([^\"]+)" tab_id="([^\"]+){0,1}" icon="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		
		} else {
			
			preg_match_all( '/vc_tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
			
		}
		
		$tab_titles = array();
		
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
		
		if ( $icons == 'yes' ) {
	
			$tab_icons = array();
			if( isset($matches[3]) ){ $tab_icons = $matches[3]; }
		}
		
		
		
		
		$out = '';
		
		if( count($tab_titles) ){
		    $out .= '<div id="sd-tabs-'. $i .'" class="sd-tabs '. $css_class .' sd-tabs-visibility no-js ' . $tab_type . $icons_type . ' "><div class="sd-tab-content">';
			$out .= '<ul class="clearfix sd-tab-titles">';
			
			if ( $icons == 'yes' ) {
				
				$j = 0;
				
				foreach( $tab_titles as $tab  ) {
					
					$j++;
					
					$out .= '<li><a href="#sd-tab-'. sanitize_title( $tab[0] ) .'"><span class="sd-icon-span"><i class="fa fa-2x ' . $tab_icons[$j - 1][0] . '"></i></span> ' . $tab[0] . '</a></li>';
					
				}
				
				
			} else  {
				
				foreach( $tab_titles as $tab  ){
					$out .= '<li><a href="#sd-tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
				}
			}
		    
		    $out .= '</ul>';
		    $out .= do_shortcode( $content );
		    $out .= '</div></div>';
		} else {
			$out .= do_shortcode( $content );
		}

echo $out;