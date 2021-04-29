<?php 
/* ------------------------------------------------------------------------ */
/* Theme Normal Page
/* ------------------------------------------------------------------------ */
get_header(); 
?>
<!--left col-->
<script src="https://js.stripe.com/v3"></script>
<style>


.flex-container {
  display: flex;
  padding: 1em;
}

.flex-item {
  flex: 1;
  width: 0;
}

.flex-item:not(:last-child) {
  margin-right: 1em;
}

.package {
  border: 1px solid #eee;
  list-style-type: none;
  margin: 0;
  padding: 0;
  transition: 0.25s;
}

.package:hover {
  box-shadow: 0 8px 12px 0 rgba(0, 0, 0, 0.2);
  transform: scale(1.025);
}

.package .header {
  background-color: #333;
  color: #fff;
  font-size: 1.5em;
}

.package .highlight {
  background-color: #29b6f6;
}

.package li {
  background-color: #fff;
  border-bottom: 1px solid #eee;
  padding: 1.2em;
  text-align: center;
}

.package .gray {
  background-color: #eee;
  font-size: 1.25em;
}

button {
  background-color: #2C448B;
  border: none;
  border-radius: .15em;
  color: #fff;
  cursor: pointer;
  padding: .75em 1.5em;
  font-size: 1em;
}

@media only screen and (max-width: 990px) {
  button {
    padding: .75em;
  }
  .flex-container {
	flex-flow: row wrap;
	justify-content: center;
  }
  .flex-item {
    flex: 0 0 30%;
    margin-bottom: 1em;
    /* width: 33%; */
  }
}

@media only screen and (max-width: 700px) {
  button {
    padding: .75em;
  }
}

@media only screen and (max-width: 600px) {
  .flex-container {
    flex-wrap: wrap;
  }

  .flex-item {
    flex: 0 0 100%;
    margin-bottom: 1em;
    width: 100%;
  }

  .package:hover {
    box-shadow: none;
    transform: none;
  }

  button {
    padding: .75em 1.5em;
  }
}

</style>

<div class="sd-blog-page">
	<div class="container">
		<div class="row"> 
			<!--left col-->
			<div class="col-md-12">
				<div class="sd-left-col">
					<?php if (have_posts()) : while (have_posts()) : the_post();?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-entry page-entry clearfix' ); ?>> 
						
						<!-- entry content -->
						<div class="entry-content">
							<?php the_content(); ?>
							<?php wp_link_pages( 'before=<strong class="page-navigation clearfix">&after=</strong>' ); ?>
						</div>

						<div class="flex-container">
							<div class="flex-item">
								<ul class="package">
									<li class="header">Micro</li>
									<li>1-2 People</li>
									<li class="gray">£128/year</li>
									
									<li class="gray">
									<?php echo do_shortcode('[wp_stripe_checkout_v3 price="price_1Hs3XVAyX7phdOBZmGLoHym7" mode="subscription" button_text="Purchase" cancel_url="https://softwarecornwall.org/become-a-member/"]'); ?>
									</li>
								</ul>
							</div>
							<div class="flex-item">
								<ul class="package">
									<li class="header">Small</li>
									<li>3-5 people</li>
									<li class="gray">£256/year</li>
									
									<li class="gray">
									<?php echo do_shortcode('[wp_stripe_checkout_v3 price="price_1Hs3YeAyX7phdOBZlF3BwNG3" mode="subscription" button_text="Purchase" cancel_url="https://softwarecornwall.org/become-a-member/"]'); ?>
									</li>
								</ul>
							</div>
							<div class="flex-item">
								<ul class="package">
									<li class="header">Medium</li>
									<li>6-16 people</li>
									<li class="gray">£521/year</li>
									
									<li class="gray">
									<?php echo do_shortcode('[wp_stripe_checkout_v3 price="price_1Hs3a6AyX7phdOBZchZhqnbs" mode="subscription" button_text="Purchase" cancel_url="https://softwarecornwall.org/become-a-member/"]'); ?>
									</li>
								</ul>
							</div>
							<div class="flex-item">
								<ul class="package">
									<li class="header">Large</li>  
									<li>17-49 people</li>
									<li class="gray">£1,024/year</li>
									
									<li class="gray">
									<?php echo do_shortcode('[wp_stripe_checkout_v3 price="price_1Hs3brAyX7phdOBZn2IjXbLk" mode="subscription" button_text="Purchase" cancel_url="https://softwarecornwall.org/become-a-member/"]'); ?>
									</li>
								</ul>
							</div>
							<div class="flex-item">
								<ul class="package">
									<li class="header">Enterprise</li>
									<li>50+ people</li>
									<li class="gray">£2,048/year</li>
									
									<li class="gray">
									<?php echo do_shortcode('[wp_stripe_checkout_v3 price="price_1Hs3crAyX7phdOBZzs0roJ8V" mode="subscription" button_text="Purchase" cancel_url="https://softwarecornwall.org/become-a-member/"]'); ?>
									</li>
								</ul>
							</div>
						</div>
						
						<!-- entry content end--> 
					</article>
					<!--post-end-->
					
					<?php endwhile; else: ?>
					<p>
						<?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>
						.</p>
					<?php endif; ?>
				</div>
			</div>
			<!--left col end-->
		</div>
	</div>
</div>
<?php get_footer(); ?>
