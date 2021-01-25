<?php
/* ------------------------------------------------------------------------ /
/ Partial: Training List Item (small) with date
/ Created for the dedicated ELS page to display scheduled courses
/ ------------------------------------------------------------------------ */
global $sd_data;
?>

<div class="training_list_item sd-entry-wrapper clearfix">
    <!-- Info -->
    <div class="col-sm-12">
        <h3 class="sd-entry-title"><a href="<?php the_permalink(); ?>" title="<?php get_the_title();?>" rel="bookmark"><?php the_title(); ?></a></h3>
    </div>
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
    <div class="col-sm-7 sd-entry-content">
        
        <p>
           Location: <?php $training_venue = get_post_meta($post->ID, 'training_venue', true); if ($training_venue) {  echo $training_venue; }?></br>     
           Delivered By: <?php $training_delivered_by = get_post_meta($post->ID, 'training_delivered_by', true); if ($training_delivered_by) {  echo $training_delivered_by; }?>
        </p>
        <p>
            Full Price: <?php $training_full_price = get_post_meta($post->ID, 'training_full_price', true); if ($training_full_price) {  echo $training_full_price; }?> // 
            Funded Price: <?php $training_funded_price = get_post_meta($post->ID, 'training_funded_price', true); if ($training_funded_price) {  echo $training_funded_price; }?>
        </p>
    </div>

    <!-- Image -->
    <div class="col-sm-4 sd-entry-thumb" style="margin-bottom:10px;">
        <?php if ( ( function_exists( 'has_post_thumbnail') ) && ( has_post_thumbnail() ) ) : ?>
            <figure>
                <?php the_post_thumbnail( 'blog-grid-thumb', ['height' => '122px', 'width' => '230px'] ); ?>
            </figure>
        <?php endif; ?>
    </div>

    <div class="col-sm-12">
        <a href="<?php the_permalink(); ?>" title="<?php get_the_title();?>" rel="bookmark" class="more-link dark-button" style="margin-top:0;">Find out more</a></br></br>
    </div>
</div>
