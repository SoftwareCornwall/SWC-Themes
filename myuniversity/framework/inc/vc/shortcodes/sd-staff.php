<?php
/*-----------------------------------------------------------------------------------*/
/*	Staff
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'sd_staff' ) ) {
	function sd_staff( $atts ){
		extract( shortcode_atts( array(
			'photo'		 => '',
			'name'		 => 'Jhon Doe',
			'position'	 => 'Professor',
			'desc'		 => '',
			'facebook'	 => '',
			'twitter'	 => '',
			'googleplus' => '',
			'linkedin'	 => ''
		), $atts ) );
		
		$photo = wp_get_attachment_image_src( $photo, 'sd-staff-photo' );
		
	
		$image = ( !empty( $photo ) ) ? '<img src="' . $photo[0] . '" alt="' .$name. '" title="' .$name. '" />' : NULL;
		$span6 = ( !empty( $photo ) ) ? 'col-md-8 col-sm-6' : 'col-md-10';
		$name = ( !empty( $name ) ) ? '<h3>' . $name . '</h3>' : NULL;
		$position = ( !empty( $position ) ) ? '<span>' . $position . '</span>' : NULL;
		$desc = ( !empty( $desc ) ) ? '<p>' . $desc . '</p>' : NULL;
		$facebook = ( !empty( $facebook ) ) ? '<li><a class="sd-staff-facebook" href="' . $facebook . '" rel="nofollow" title="Facebook"><i class="fa fa-facebook"></i> Facebook</a></li>' : NULL;
		$twitter = ( !empty( $twitter ) ) ? '<li><a class="sd-staff-twitter" href="' . $twitter . '" rel="nofollow" title="Twitter"><i class="fa fa-twitter"></i> Twitter</a></li>' : NULL;
		$googleplus = ( !empty( $googleplus ) ) ? '<li><a class="sd-staff-googleplus" href="' . $googleplus . '" rel="nofollow" title="Google Plus"><i class="fa fa-google-plus"></i> Google</a></li>' : NULL;
		$linkedin = ( !empty($linkedin) ) ? '<li><a class="sd-staff-linkedin" href="' . $linkedin . '" rel="nofollow" title="Linked In"><i class="fa fa-linkedin"></i> LinkedIn</a></li>' : NULL;
		
		ob_start();
	?>
		<div class="row">
			<div class="sd-staff-short clearfix">
				<div class="col-md-2 col-sm-2"><?php echo $name . $position;?></div>
				<?php if ( !empty($photo) ) : ?>
				<div class="col-md-2 col-sm-4"><?php echo $image; ?></div>
				<?php endif; ?>
				<div class="<?php echo $span6; ?>">
					<?php echo $desc; ?>
					<?php if ( !empty( $facebook ) || !empty( $twitter ) || !empty( $googleplus ) || !empty( $linkedin ) ) : ?>
					<ul>
					<?php endif; ?>
					<?php echo $facebook . $twitter . $googleplus . $linkedin; ?>
					<?php if ( !empty( $facebook ) || !empty( $twitter ) || !empty( $googleplus ) || !empty( $linkedin ) ) : ?>
					</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
	
<?php
		return ob_get_clean();	
	}
	add_shortcode( 'sd_staff','sd_staff' );
}

// register shortcode to VC

add_action( 'init', 'sd_staff_vcmap' );

if ( ! function_exists( 'sd_staff_vcmap' ) ) {
	function sd_staff_vcmap() {
		vc_map( array(
			'name'					=> 'Staff',
			'description'			=> 'Staff person',
			'base'					=> "sd_staff",
			'class'					=> "sd_staff",
			'category'				=> 'My University',
			'icon' 					=> "icon-wpb-sd-staff",
			'admin_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'front_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'params'				=> array(
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'Name',
					'param_name'	=> 'name',
					'value'			=> 'John Doe',
					'description'	=> 'Insert the name of the person.',
					),
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'Position',
					'param_name'	=> 'position',
					'value'			=> 'Professor',
					'description'	=> 'Insert the position occupied.',
					),
				array(
					'type'			=> 'textarea',
					'class'			=> '',
					'heading'		=> 'Description',
					'param_name'	=> 'desc',
					'value'			=> '',
					'description'	=> 'Insert a short description.',
					),
				array(
					'type'			=> 'attach_image',
					'class'			=> '',
					'heading'		=> 'Photo',
					'param_name'	=> 'photo',
					'value'			=> '',
					'description'	=> 'Insert a photo of the person.',
					),
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'Facebook URL',
					'param_name'	=> 'facebook',
					'value'			=> '',
					'description'	=> 'Insert Facebook url.',
					),
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'Twitter URL',
					'param_name'	=> 'twitter',
					'value'			=> '',
					'description'	=> 'Insert Twitter url.',
					),
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'Google Plus URL',
					'param_name'	=> 'googleplus',
					'value'			=> '',
					'description'	=> 'Insert Google Plus url.',
					),
				array(
					'type'			=> 'textfield',
					'class'			=> '',
					'heading'		=> 'LinkedIn URL',
					'param_name'	=> 'linkedin',
					'value'			=> '',
					'description'	=> 'Insert LinkedIn url.',
					),
				)
			));
	}
}