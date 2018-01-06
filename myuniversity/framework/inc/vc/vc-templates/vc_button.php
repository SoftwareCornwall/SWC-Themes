<?php
$output = $color = $size = $icon = $target = $href = $el_class = $title = $position = $button_type = $border_radius = $text_color = $button_rel = $button_size = '';
extract( shortcode_atts( array(
	'color' => '#0191c6',
	'textcolor' => '',
	'size' => '',
	'icon' => 'none',
	'target' => '_self',
	'href' => '',
	'rel' => '',
	'radius' => '',
	'type' => 'outlined',
	'el_class' => '',
	'title' => __( 'Text on the button', "js_composer" ),
	'position' => ''
), $atts ) );
$a_class = '';

if ( $el_class != '' ) {
	$tmp_class = explode( " ", strtolower( $el_class ) );
	$tmp_class = str_replace( ".", "", $tmp_class );
	if ( in_array( "prettyphoto", $tmp_class ) ) {
		wp_enqueue_script( 'prettyphoto' );
		wp_enqueue_style( 'prettyphoto' );
		$a_class .= ' prettyphoto';
		$el_class = str_ireplace( "prettyphoto", "", $el_class );
	}
	if ( in_array( "pull-right", $tmp_class ) && $href != '' ) {
		$a_class .= ' pull-right';
		$el_class = str_ireplace( "pull-right", "", $el_class );
	}
	if ( in_array( "pull-left", $tmp_class ) && $href != '' ) {
		$a_class .= ' pull-left';
		$el_class = str_ireplace( "pull-left", "", $el_class );
	}
}

if ( $target == 'same' || $target == '_self' ) {
	$target = '';
}
$target = ( $target != '' ) ? ' target="' . $target . '"' : '';


$button_type = ( $type == 'outlined' ? 'border: 1px solid ' . $color . ';' : 'background-color: ' . $color . ';'); 
$border_radius = ( !empty($radius) ? 'border-radius: ' . $radius . ';' : NULL );
$button_rel = ( !empty($rel) ? 'rel="' . $rel . '"' : NULL );
$text_color = ( !empty($textcolor) ? 'color: ' . $textcolor . ';' : 'color: #0191c6;' );

$icon = ( $icon != '' && $icon != 'none' ) ? ' ' . $icon : '';
$i_icon = ( $icon != '' ) ? ' <i class="icon"> </i>' : '';
$position = ( $position != '' ) ? ' ' . $position . '-button-position' : '';
$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,  $icon . $el_class . $position, $this->settings['base'], $atts );

if ( $href != '' ) {
	$output .= '<span class="' . $css_class . '">' . $title . $i_icon . '</span>';
	$output = '<a ' . $button_rel . ' style="' . $button_type . $border_radius . $text_color . '" class="sd-button ' . $a_class . $size . '" title="' . $title . '" href="' . $href . '"' . $target . '>' . $output . '</a>';
} else {
	$output .= '<button class="' . $css_class . '">' . $title . $i_icon . '</button>';

}

echo $output . $this->endBlockComment( 'button' ) . "\n";