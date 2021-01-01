<?php
/* ------------------------------------------------------------------------ /
/ Partial: Training List Item
/ Created for the training category page
/ ------------------------------------------------------------------------ */
global $sd_data;
?>

<div class="training_list_item sd-entry-wrapper clearfix">
    <!-- Info -->
    <div class="col-md-8 sd-entry-content">
        <h3 class="sd-entry-title"><a href="<?php the_permalink(); ?>" title="<?php get_the_title();?>" rel="bookmark"><?php the_title(); ?></a></h3>
        <p><?php $date = get_post_meta($post->ID, 'training_start_date', true); if ($date) {  echo $date; }?>
           <?php $endDate = get_post_meta($post->ID, 'training_end_date', true); if ($endDate) {  echo ' - ' . $endDate; }?> //
           <?php $time = get_post_meta($post->ID, 'training_start_time', true); if ($time) {  echo $time; }?> to
           <?php $endTime = get_post_meta($post->ID, 'training_end_time', true); if ($endTime) {  echo $endTime; }?></br>
           Location: <?php $training_venue = get_post_meta($post->ID, 'training_venue', true); if ($training_venue) {  echo $training_venue; }?>     
           Delivered By: <?php $training_delivered_by = get_post_meta($post->ID, 'training_delivered_by', true); if ($training_delivered_by) {  echo $training_delivered_by; }?>
        </p>
        <p>
            Full Price: <?php $training_full_price = get_post_meta($post->ID, 'training_full_price', true); if ($training_full_price) {  echo $training_full_price; }?> // 
            Funded Price: <?php $training_funded_price = get_post_meta($post->ID, 'training_funded_price', true); if ($training_funded_price) {  echo $training_funded_price; }?>
        </p>
<p>
        <a href="<?php the_permalink(); ?>" title="<?php get_the_title();?>" rel="bookmark" class="more-link dark-button">Find out more</a></br></br></p>
    </div>

    <!-- Image -->
    <div class="col-md-4 sd-entry-thumb">
        <?php if ( ( function_exists( 'has_post_thumbnail') ) && ( has_post_thumbnail() ) ) : ?>
            <figure>
                <?php the_post_thumbnail( 'blog-grid-thumb', ['height' => '122px', 'width' => '230px'] ); ?>
            </figure>
        <?php endif; ?>
    </div>
</div>
