<?php
/* ------------------------------------------------------------------------ */
/* Post Meta
/* ------------------------------------------------------------------------ */

function add_training_meta_box() {
    add_meta_box(
        'swc_training_meta',      // Unique ID
        'Training Details',       // Box title
        'training_meta_box_html', // Content callback
        'post'                    // Post type
    );
}
add_action( 'add_meta_boxes', 'add_training_meta_box' );

function training_meta_box_html( $post ) { ?>
	<input type="hidden" name="training_meta_box_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)) ?>" />
    <p>Complete this section if this is a post for a training course run by Software Cornwall.</p>
    
    <label for="training_is_live">Is this course bookable?</label><br>
    <input type="checkbox" id="training_is_live" name="training_is_live"
    <?php $is_live = get_post_meta($post->ID, 'training_is_live', true); if ($is_live) {  echo 'checked'; }?>>
    
    <h2 style="font-size:18px; padding-left:0; font-weight: 700">Course Details</h2>
	<label for="training_start_date" style="min-width:200px; display: inline-block;">Start Date</label>
	<input type="text" id="training_start_date" name="training_start_date" placeholder="e.g 17/03/2021"
		   value="<?php echo get_post_meta($post -> ID, "training_start_date", true);?>"><br />
	<label for="training_end_date" style="min-width:200px; display: inline-block;">End Date</label>
	<input type="text" id="training_end_date" name="training_end_date" placeholder="e.g 18/03/2021"
		   value="<?php echo get_post_meta($post -> ID, "training_end_date", true);?>"><br />
	<label for="training_start_time" style="min-width:200px; display: inline-block;">Start Time (24hr)</label>
	<input type="text" id="training_start_time" name="training_start_time" placeholder="e.g 9:00"
		   value="<?php echo get_post_meta($post -> ID, "training_start_time", true);?>"><br />
	<label for="training_end_time" style="min-width:200px; display: inline-block;">End Time (24hr)</label>
	<input type="text" id="training_end_time" name="training_end_time" placeholder="e.g 18:00"
		   value="<?php echo get_post_meta($post -> ID, "training_end_time", true);?>"><br />
	<label for="training_full_price" style="min-width:200px; display: inline-block;">Full Price</label>
	<input type="text" id="training_full_price" name="training_full_price" placeholder="e.g. £199.99"
		   value="<?php echo get_post_meta($post -> ID, "training_full_price", true);?>"><br />
	<label for="training_funded_price" style="min-width:200px; display: inline-block;">Funded Price</label>
	<input type="text" id="training_funded_price" name="training_funded_price" placeholder="e.g £99.99"
		   value="<?php echo get_post_meta($post -> ID, "training_funded_price", true);?>"><br />
	<label for="training_venue" style="min-width:200px; display: inline-block;">Training Venue</label>
	<input type="text" id="training_venue" name="training_venue" placeholder="e.g Online / Heartlands"
		   value="<?php echo get_post_meta($post -> ID, "training_venue", true);?>"><br />
	<label for="training_ticket_link" style="min-width:200px; display: inline-block;">Ticket Link</label>
	<input type="text" id="training_ticket_link" name="training_ticket_link" placeholder="https://eventbrite.com/tktk"
           value="<?php echo get_post_meta($post -> ID, 'training_ticket_link', true);?>" style="min-width:400px;"><br />
           
    <h2 style="font-size:18px; padding-left:0; font-weight: 700">Trainer Information</h2>
    <label for="training_delivered_by" style="min-width:200px; display: inline-block;">Delivered By</label>
	<input type="text" id="training_delivered_by" name="training_delivered_by" placeholder="Jerry Seinfeld"
           value="<?php echo get_post_meta($post -> ID, 'training_delivered_by', true);?>" style="min-width:400px;"><br />
    <label for="training_delivered_by" style="min-width:200px; display: inline-block;">Twitter Profile</label>
	<input type="text" id="trainer_twitter" name="trainer_twitter" placeholder="https://twitter.com/trainerHandle"
           value="<?php echo get_post_meta($post -> ID, 'trainer_twitter', true);?>" style="min-width:400px;"><br />
    <label for="trainer_linkedin" style="min-width:200px; display: inline-block;">LinkedIn Profile</label>
	<input type="text" id="trainer_linkedin" name="trainer_linkedin" placeholder="https://linkedin.com/trainerName"
           value="<?php echo get_post_meta($post -> ID, 'trainer_linkedin', true);?>" style="min-width:400px;"><br />
    <label for="trainer_instagram" style="min-width:200px; display: inline-block;">Instagram Profile</label>
	<input type="text" id="trainer_instagram" name="trainer_instagram" placeholder="https://instagram.com/trainerHandle"
           value="<?php echo get_post_meta($post -> ID, 'trainer_instagram', true);?>"style="min-width:400px;"><br />
    <label for="trainer_website" style="min-width:200px; display: inline-block;">Delivered By</label>
	<input type="text" id="trainer_website" name="trainer_website" placeholder="https://trainerwebsite.com"
           value="<?php echo get_post_meta($post -> ID, 'trainer_website', true);?>" style="min-width:400px;"><br />
    <label id="trainer_bio_label" for="trainer_bio" style="min-width:200px; display: inline-block;">Bio</label>
    <textarea id="trainer_bio" name="trainer_bio" rows="10" cols="53" placeholder="Add a nice bio in here">
        <?php echo get_post_meta($post -> ID, 'trainer_bio', true);?>
    </textarea>

    <style>
        @media (min-width: 1114px) {
            #trainer_bio_label { 
                margin-top: -380px;
            }
        }
    </style>
<?php } 

function swc_save_training_meta($post_id) {
    $custom_meta_fields = Array(
        "training_is_live",
		"training_start_date",
		"training_end_date",
		"training_start_time",
		"training_end_time",
		"training_full_price",
		"training_funded_price",
		"training_venue",
        "training_ticket_link",
        "training_delivered_by",
        "trainer_twitter",
        "trainer_linkedin",
        "trainer_instagram",
        "trainer_website",
        "trainer_bio"
	); 

    if (!wp_verify_nonce($_POST['training_meta_box_nonce'], basename(__FILE__)))
		return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
		error_log('Auto saving post meta. Post ID: ' . $post_id  , 0);
		return $post_id; 
	}  
         

    if ('page' == $_POST['post_type']) {  
        if (!current_user_can('edit_page', $post_id))  
            return $post_id;  
        } elseif (!current_user_can('edit_post', $post_id)) {  
            return $post_id;  
	}  
	
    foreach ($custom_meta_fields as $field) {  
        $old = get_post_meta($post_id, $field, true);  
        $new = $_POST[$field];  
        if ($new && $new != $old) {  
            update_post_meta($post_id, $field, $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id, $field, $old);  
        }  
    }
}
add_action('save_post', 'swc_save_training_meta'); 

?>
