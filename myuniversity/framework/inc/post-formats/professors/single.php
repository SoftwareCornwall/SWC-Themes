<?php
/* ------------------------------------------------------------------------ */
/* Theme Single Post - Standard Post Format
/* ------------------------------------------------------------------------ */
global $sd_data;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-standard-entry sd-course-entry clearfix' ); ?>> 

	<!-- entry wrapper -->
	<div class="sd-entry-wrapper">
		<!-- entry content  -->
		<div class="sd-entry-content">
			<?php the_content(); ?>
		</div>
	</div>
	<!-- entry wrapper end--> 
</article>
<!--post-end--> 