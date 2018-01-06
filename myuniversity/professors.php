<?php
/* ------------------------------------------------------------------------ */
/* Template Name: Page: Professors
/* ------------------------------------------------------------------------ */

get_header();

?>

<div class="container sd-professors-page">
		<?php if ( have_posts() ) : while ( have_posts( )) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-entry page-entry clearfix' ); ?>> 
			
			<!-- entry content -->
			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( 'before=<strong class="sd-page-navigation clearfix">&after=</strong>' ); ?>
			</div>
			<!-- entry content end--> 
		</article>
		<!--post-end-->
		
		<?php endwhile;
				  endif;
			?>
		<div class="sd-professors-filters clearfix">
			<?php
			$professors_filters = get_terms( 'course_discipline' );
				if ( $professors_filters ) : ?>
			<ul>
				<li><a href="#" data-filter="*" class="sd-active">
					<?php _e( 'All', 'sd-framework' ); ?>
					</a> </li>
				<?php foreach ( $professors_filters as $professors_filter ) : ?>
				<?php if ( rwmb_meta( 'sd_professors-taxonomies', 'type=checkbox_list' )  && !in_array( '0', rwmb_meta( 'sd_professors-taxonomies', 'type=checkbox_list') ) ) : ?>
				<?php if ( in_array( $professors_filter->term_id, rwmb_meta( 'sd_professors-taxonomies', 'type=checkbox_list' ) ) ): ?>
				<li><a href="#" data-filter=".<?php echo $professors_filter->slug; ?>"><?php echo $professors_filter->name; ?></a></li>
				<?php endif; ?>
				<?php else: ?>
				<li><a href="#" data-filter=".<?php echo $professors_filter->slug; ?>"><?php echo $professors_filter->name; ?></a></li>
				<?php endif; ?>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</div>
		<div class="row">
		<div class="sd-professors-isotope clearfix">
		
			<?php
	global $wp_query;
			
	$paged = get_query_var( 'paged ') ? get_query_var( 'paged' ) : 1;
	$args = array(
				'post_type' 		=> 'professors',
				'posts_per_page' 	=> 100,
				'post_status' 		=> 'publish',
				'orderby' 			=> 'date',
				'paged' 			=> $paged
			);
			
	// Only pull from selected taxonomy
	$selected_taxonomies = rwmb_meta( 'sd_professors-taxonomies', 'type=checkbox_list' );

		if ( $selected_taxonomies && $selected_taxonomies[0] == 0 ) {
			unset( $selected_taxonomies[0] );
		}
		
		if ( $selected_taxonomies ) {
			$args['tax_query'][] = array(
				'taxonomy' 	=> 'course_discipline',
				'field' 	=> 'ID',
				'terms' 	=> $selected_taxonomies
			);
		}

		$wp_query = new WP_Query( $args );
	
		while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
			<?php $taxonomies = get_the_terms( get_the_ID(), 'course_discipline' ); ?>
			<div class="<?php if ( $taxonomies ) : foreach ( $taxonomies as $taxonomy ) { echo $taxonomy->slug. ' '; } endif; ?> sd-professor-item col-md-3 col-sm-4">
				<?php if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) : ?>
				<figure> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail( 'professors-page-thumb' ); ?>
					</a>
					<?php
			?>
				</figure>
				<?php endif; ?>
				<div class="sd-professor-content">
					<h4 class="sd-styled-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">	<?php the_title(); ?></a> 
						<span class="sd-professor-discipline"><?php echo strip_tags ( get_the_term_list( get_the_ID(), 'course_discipline', "",", " ) ); ?></span>
					</h4>
						<?php
						$professor_email = rwmb_meta( 'sd_professor_email' );
						$professor_facebook = rwmb_meta( 'sd_professor_facebook' );
						$professor_twitter = rwmb_meta( 'sd_professor_twitter' );
						$professor_google = rwmb_meta( 'sd_professor_google' );
						$professor_skype = rwmb_meta( 'sd_professor_skype' );
						
						?>
						
						<?php if ( !empty( $professor_email ) || !empty( $professor_facebook ) || !empty( $professor_twitter ) || !empty( $professor_google ) || !empty( $professor_skype )  ) : ?>
							<ul class="sd-professor-meta clearfix">
							<?php if ( !empty( $professor_email ) ) : ?>
							<li><span class="sd-professor-email"><a href="mailto:<?php echo $professor_email; ?>" title="Email"><?php echo $professor_email;  ?></a></span></li>
							<?php endif; ?>
							<?php if ( !empty( $professor_facebook ) ) : ?>
							<li><span class="sd-professor-facebook"><a href="<?php echo $professor_facebook; ?>" title="Facebook"><i class="fa fa-facebook"></i></a></span></li>
							<?php endif; ?>
							<?php if ( !empty( $professor_twitter ) ) : ?>
							<li><span class="sd-professor-twitter"><a href="<?php echo $professor_twitter; ?>" title="Twitter"><i class="fa fa-twitter"></i></a></span></li>
							<?php endif; ?>
							<?php if ( !empty( $professor_google ) ) : ?>
							<li><span class="sd-professor-google"><a href="<?php echo $professor_google; ?>" title="Google Plus"><i class="fa fa-google-plus"></i></a></span></li>
							<?php endif; ?>
							<?php if ( !empty( $professor_skype ) ) : ?>
							<li><span class="sd-professor-skype"><a href="skype:<?php echo $professor_skype; ?>?call" title="Skype"><i class="fa fa-skype"></i></a></span></li>
							<?php endif; ?>
							</ul>
						<?php endif; ?>
					<?php the_excerpt(); ?>	
					</div>
			</div>
			<?php endwhile; ?>
		</div>
		<!--pagination-->
		<?php sd_custom_pagination();  ?>
		<!--pagination end--> 
		
	</div>
</div>
<?php get_footer(); ?>
