<?php
/* ------------------------------------------------------------------------ */
/* Newsletter
/* ------------------------------------------------------------------------ */
global $sd_data;
?>

<div class="sd-newsletter-wrapper">
	<div class="container">
		<div class="row">
			<div class="sd-newsletter clearfix">
				<div class="col-md-2 col-xs-12"> <span class="sd-subscribe-text"><?php echo $sd_data['sd_subscribe_word']; ?></span><br />
					<span class="sd-newsletter-text"> <?php echo $sd_data['sd_newsletter_word']; ?></span> </div>
				<div class="col-md-8 col-xs-12"> 
					<?php echo $sd_data['sd_newsletter_code']; ?>
				</div>
			</div>
		</div>
	</div>
</div>
