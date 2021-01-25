<?php
/* ------------------------------------------------------------------------ /
/ Partial: Training List Item
/ Created for the training category page
/ ------------------------------------------------------------------------ */
global $sd_data;

$training_venue = get_post_meta($post->ID, 'training_venue', true);
$training_delivered_by = get_post_meta($post->ID, 'training_delivered_by', true);
$training_full_price = get_post_meta($post->ID, 'training_full_price', true);
$training_funded_price = get_post_meta($post->ID, 'training_funded_price', true);
?>

<div class="training_list_item sd-entry-wrapper clearfix">
    <!-- Info -->
    <div class="col-sm-8 sd-entry-content">
        <h3 class="sd-entry-title"><a href="<?php the_permalink(); ?>" title="<?php get_the_title();?>" rel="bookmark"><?php the_title(); ?></a></h3>
        <p>
            <?php if ($training_venue) { ?>Location: <?php echo $training_venue; ?></br><?php } ?>
            <?php if ($training_delivered_by) { ?>Delivered By: <?php echo $training_delivered_by; ?><?php } ?>
        </p>
        <p>
            <?php  if ($training_full_price) { ?>Full Price: <?php echo $training_full_price; ?> // <?php } ?>
            <?php  if ($training_funded_price) { ?>Funded Price: <?php echo $training_funded_price; ?><?php } ?>
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
