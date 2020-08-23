<?php 
/* ------------------------------------------------------------------------ */
/* Theme 404 Page
/* ------------------------------------------------------------------------ */
get_header();
global $sd_data;
?>
<!--left col-->

<div class="sd-blog-page">
	<div class="container">
		<div class="row"> 
			<!--left col-->
			<div class="col-md-<?php if ( $sd_data['sd_404_layout'] == '2' ) echo '12'; else echo '8'; ?> <?php if ( $sd_data['sd_sidebar_location'] == '2' ) echo 'pull-right'; ?>">
				<div class="sd-left-col">
					<div class="sd-not-found">
					<?php if ( !empty( $sd_data['sd_404_content'] ) ) : ?>
						<?php echo do_shortcode( $sd_data['sd_404_content'] ); ?>
					<?php else : ?>
						<p> 
						<a href="<?php echo home_url('/'); ?>" title="<?php _e( 'Back to Homepage', 'sd-framework' ); ?>">
						<div class="sd-center"><img src="<?php echo get_template_directory_uri(); ?>/framework/images/404.png" alt="<?php _e( 'Back to Homepage', 'sd-framework' ); ?>" title="<?php _e( 'Back to Homepage', 'sd-framework' ); ?>" /></a></div>
						<br/>
						<?php _e( 'We are really sorry, but the page you requested was not found.', 'sd-framework' ); ?>
						<br />
						</p>
						<p>
							<?php _e( 'It seems that the page you were trying to reach does not exist anymore or maybe it has just been moved.', 'sd-framework' ); ?>
							<?php _e( 'If you\'re looking for something try using the search form the top or just click on the image to go to the homepage.', 'sd-framework' ); ?>
						</p>
						<p>
							<?php _e( 'Sorry for the inconvenience.', 'sd-framework' ); ?>
						</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<!--left col end--> 
			<?php if ( $sd_data['sd_404_layout'] !== '2' ) : ?>
			<!--sidebar-->
			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div>
			<!--sidebar end--> 
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
