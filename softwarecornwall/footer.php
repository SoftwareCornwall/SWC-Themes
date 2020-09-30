<?php
/* ------------------------------------------------------------------------ */
/* Theme Footer
/* ------------------------------------------------------------------------ */
global $sd_data;
?>
<?php
$sd_newsletter = $sd_data['sd_newsletter_display'];
if ( $sd_newsletter !== '1' ) {
	if ( $sd_newsletter == '2' ) {
		if ( is_front_page() ) {
			get_template_part( 'framework/inc/newsletter' );
		}
	} else {
		get_template_part( 'framework/inc/newsletter' );
	}
}
?>

<footer id="sd-footer">
	<?php if ( $sd_data['sd_twitter_box'] == '1' ) : ?>
		<?php get_template_part( 'framework/inc/latest-tweets' ); ?>
	<?php endif; ?>
	
	
	<?php if ( $sd_data['sd_widgetized_footer'] == '1' ) : ?>
	<!-- footer widgets -->
	<div class="sd-footer-widgets">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-6">
					<?php dynamic_sidebar( 'footer-left-sidebar' ); ?>
				</div>
				<div class="col-md-4 col-sm-6">
					<?php dynamic_sidebar( 'footer-middle-sidebar' ); ?>
				</div>
				<div class="col-md-4 col-sm-6">
					<?php dynamic_sidebar( 'footer-right-sidebar' ); ?>
				</div>
			</div>
		</div>
	</div>
	<!-- footer widgets end -->
	<?php endif; ?>
	
	<?php if ( $sd_data['sd_copyright'] == '1' ) : ?>
	<div class="sd-copyright">
		<div class="container">
			Copyright © <?php echo date("Y"); ?> Software Cornwall Ltd is a Not for Profit funded by its members.
		</div>
	</div>
	<?php endif; ?>
</footer>
<!-- footer end -->

<?php wp_footer(); ?>

<?php get_template_part( '/partials/analytics' ); ?>

</body>
</html>