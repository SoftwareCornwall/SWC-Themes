<?php
/*-----------------------------------------------------------------------------------*/
/*	Staff
/*-----------------------------------------------------------------------------------*/

if ( !function_exists('sd_icon_box' ) ) {
	function sd_icon_box( $atts, $content = NULL ){
		extract( shortcode_atts( array(
			'icon'		 => '',
			'icon_color' => '#000000',
			'icon_size'  => '',
			'heading'	 => 'h3',
			'title'		 => '',
			'style'		 => '',
			'padding'		 => '35px'
		), $atts ) );
		
		$icon = ( !empty($icon) ) ? $icon : 'fa fa-laptop';
		$icon_color = ( !empty( $icon_color ) ) ? 'color: ' . $icon_color . ';' : 'color: #000000;';
		$icon_size = ( !empty( $icon_size ) ) ? 'font-size: ' . $icon_size . ';' : 'font-size: 24px;';
		$title = ( !empty( $title ) && !empty( $heading ) ) ? '<' . $heading . '>' . $title . '</' . $heading . '>' : '<h3>Sample Heading</h3>' ;
		$style = ( !empty( $style) ) ? $style : 'left';
		$padding = ( !empty( $padding ) && $style == 'left' ) ? 'style="padding-left: ' . $padding . ';"' : '';

		
		ob_start();
?>


<div <?php echo $padding; ?> class="sd-icon-box sd-icon-box sd-icon-box-<?php echo $style; ?>">
<i style="<?php echo $icon_size . $icon_color; ?>" class="<?php echo $icon; ?> "></i>
<?php echo $title; ?>
<?php echo wpb_js_remove_wpautop( $content ); ?>
</div>
		
	
<?php
		return ob_get_clean();	
	}
	add_shortcode( 'sd_icon_box','sd_icon_box' );
}

// register shortcode to VC

add_action( 'init', 'sd_icon_box_vcmap' );

if ( ! function_exists( 'sd_icon_box_vcmap' ) ) {
	function sd_icon_box_vcmap() {
		vc_map( array(
			'name'					=> 'Icon Box',
			'description'			=> 'Insert an icon box',
			'base'					=> "sd_icon_box",
			'class'					=> "sd_icon_box",
			'category'				=> 'My University',
			'icon' 					=> "icon-wpb-sd-icon-box",
			'admin_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'front_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'params'				=> array(
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'Title',
					'param_name'	=> 'title',
					'value'			=> 'Sample Title',
					'description'	=> 'Insert your title.',
					),
				array(
					'type'			=> 'textarea_html',
					'class'			=> '',
					'heading'		=> 'Content',
					'param_name'	=> 'content',
					'value'			=> 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
					'description'	=> 'Insert the content of the box.',
					),
				array(
					'type'			=> 'dropdown',
					'class'			=> '',
					'heading'		=> 'Icon',
					'param_name'	=> 'icon',
					'value' => sd_font_awesome_icons(),
					'description'	=> 'Select an icon. See <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/cheatsheet/">Icons List Here.</a>'
					),
				array(
					'type'			=> 'colorpicker',
					'class'			=> '',
					'heading'		=> 'Icon Color',
					'param_name'	=> 'icon_color',
					'value'			=> '#000000',
					'description'	=> 'Select the color of your icon.',
					),
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'Icon Size',
					'param_name'	=> 'icon_size',
					'value'			=> '24px',
					'description'	=> 'Insert the icons size in pixels (eg. 24px).',
					),
				array(
					'type'			=> 'dropdown',
					'class'			=> '',
					'heading'		=> 'Heading Type',
					'param_name'	=> 'heading',
					'value' => array('h2', 'h3', 'h4', 'h5', 'h6'),
					'description'	=> 'Select the heading type.'
					),
				array(
					'type'			=> 'dropdown',
					'class'			=> '',
					'heading'		=> 'Box Style',
					'param_name'	=> 'style',
					'value' => array('left', 'center'),
					'description'	=> 'Select the style of the box.'
					),
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'Left Padding',
					'param_name'	=> 'padding',
					'value'			=> '35px',
					'description'	=> 'Insert the padding in pixels (eg. 35px) (usable only when left style is selected).',
					)
				)
			));
	}
}