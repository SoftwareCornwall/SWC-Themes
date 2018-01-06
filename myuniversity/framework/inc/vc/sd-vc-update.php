<?php

/*-----------------------------------------------------------------------------------*/
/*	Update Visual Composer Parameters
/*-----------------------------------------------------------------------------------*/

//rows
vc_add_param( 'vc_row', array(
	'type'			=> 'dropdown',
	'heading'		=> 'Center content?',
	'param_name'	=> 'centered',
	'value'			=> array('no', 'yes')
) );

vc_add_param( 'vc_row_inner', array(
	'type'			=> 'dropdown',
	'heading'		=> 'Center content?',
	'param_name'	=> 'centered',
	'value' 		=> array('no', 'yes')
) );

//buttons
vc_add_param( 'vc_button', array(
	'type'			=> 'colorpicker',
	'heading'		=> 'Background Color',
	'param_name'	=> 'color'
) );

vc_add_param( 'vc_button', array(
	'type'			=> 'colorpicker',
	'heading'		=> 'Text Color',
	'param_name'	=> 'textcolor'
) );

vc_add_param( 'vc_button', array(
	'type'			=> 'dropdown',
	'heading'		=> 'Size',
	'param_name'	=> 'size',
	'value'			=> array('large', 'medium' => 'sd-button-medium', 'small' => 'sd-button-small')
) );

vc_add_param( 'vc_button', array(
	'type'			=> 'dropdown',
	'heading'		=> 'Type',
	'param_name'	=> 'type',
	'value' 		=> array('background', 'outlined')
) );

vc_add_param( 'vc_button', array(
	'type'			=> 'textfield',
	'heading'		=> 'Border Radius',
	'description'	=> 'In pixels (eg. 2px)',
	'param_name'	=> 'radius'
) );
vc_add_param( 'vc_button', array(
	'type'			=> 'textfield',
	'heading'		=> 'Rel',
	'description'	=> 'eg. nofollow',
	'param_name'	=> 'rel'
) );

//separator
vc_add_param( 'vc_separator', array(
	'type'			=> 'textfield',
	'heading'		=> 'Margin Top',
	'description'	=> 'Insert the top margin of the separator in pixels. (eg. 20px)',
	'param_name'	=> 'margintop'
) );
vc_add_param( 'vc_separator', array(
	'type'			=> 'textfield',
	'heading'		=> 'Margin Bottom',
	'description'	=> 'Insert the bottom margin of the separator in pixels. (eg. 20px)',
	'value'			=> '0',
	'param_name'	=> 'marginbottom'
) );
//separator text
vc_add_param( 'vc_text_separator', array(
	'type'			=> 'dropdown',
	'heading'		=> 'Heading Type',
	'description'	=> 'Insert the bottom margin of the separator in pixels (eg. 20px)',
	'value' => array( "h2", "h3", "h4", "h5", "h6" ),
	'param_name'	=> 'heading'
) );
vc_add_param( 'vc_text_separator', array(
	'type'			=> 'textfield',
	'heading'		=> 'Margin Top',
	'description'	=> 'Insert the top margin of the separator in pixels (eg. 20px)',
	'value'			=> '0',
	'param_name'	=> 'margintop'
) );
vc_add_param( 'vc_text_separator', array(
	'type'			=> 'textfield',
	'heading'		=> 'Margin Bottom',
	'description'	=> 'Insert the bottom margin of the separator in pixels (eg. 20px)',
	'value'			=> '20px',
	'param_name'	=> 'marginbottom'
) );


//tabs
vc_add_param( 'vc_tabs', array(
	'type'			=> 'dropdown',
	'heading'		=> 'Icon Tabs?',
	'param_name'	=> 'icons',
	'value' => array('no', 'yes')
) );

vc_add_param( 'vc_tab', array(
	'type'			=> 'dropdown',
	'heading'		=> 'Icon',
	'param_name'	=> 'icon',
	'description'	=> 'Select an icon for your tab. See <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/cheatsheet/">Icons List Here.</a>',
	'value' => sd_font_awesome_icons()
) );