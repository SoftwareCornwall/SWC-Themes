<?php
/* ------------------------------------------------------------------------ /
/ Partial: Training List Item
/ Created for the training category page
/ ------------------------------------------------------------------------ */
global $sd_data;
?>

<div class="training_list_item sd-entry-wrapper clearfix">
    <div class="col-sm-1 sd-entry-content">
        <?php 
            try {
                $date = get_post_meta($post->ID, 'training_start_date', true);
                $trainingDate = strtotime(str_replace('/','-', $date));
                $day = date('jS', $trainingDate);
                $month = date('M', $trainingDate);
            } catch (Exception $e) {
                error_log('Caught exception: ' .  $e->getMessage(), 0);
            }
        ?>
        <p class="training-list-date-wrapper"><?php if ($day) { echo $day; } ?><span><?php if ($month) { echo $month; } ?></span></p>
    </div>

    <!-- Info -->
    <div class="col-sm-7 sd-entry-content">
        <h3 class="sd-entry-title"><a href="<?php the_permalink(); ?>" title="<?php get_the_title();?>" rel="bookmark"><?php the_title(); ?></a></h3>
        <p><?php if ($date) {  echo $date; }?>
           <?php $endDate = get_post_meta($post->ID, 'training_end_date', true); if ($endDate) {  echo ' - ' . $endDate; }?> /
           <?php $time = get_post_meta($post->ID, 'training_start_time', true); if ($time) {  echo $time; }?> to
           <?php $endTime = get_post_meta($post->ID, 'training_end_time', true); if ($endTime) {  echo $endTime; }?></br>
           <?php $location = get_post_meta($post->ID, 'training_venue', true); if ($location) {  echo 'Location: ' . $location; }?>
        </p>
        
        <?php the_excerpt(); ?>

    </div>

    <!-- Image -->
    <div class="col-sm-4 sd-entry-thumb">
        <?php if ( ( function_exists( 'has_post_thumbnail') ) && ( has_post_thumbnail() ) ) : ?>
            <figure>
                <?php the_post_thumbnail( 'blog-grid-thumb', ['height' => '185px', 'width' => '360px'] ); ?>
            </figure>
        <?php endif; ?>
    </div>
</div>
<hr>
