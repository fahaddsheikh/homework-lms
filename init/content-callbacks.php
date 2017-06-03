<?php
/**
* Display featured user box.
*
* @param WP_Post $post Current post object.
*/
 function hl_create_batch( $post ) { 
      
      include( plugin_dir_path( __FILE__ ) . 'metabox-template.php');
}


/**
* Save featured user.
*
* @param int $post_id Post ID
*/
function hl_save_batch( $post_id ) {
    // verify taxonomies meta box nonce
    if ( !isset( $_POST['batch_meta_content_callback_nonce'] ) || !wp_verify_nonce( $_POST['batch_meta_content_callback_nonce'], basename( __FILE__ ) ) ){
      return;
    }
    // return if autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
      return;
    }
    // Check the user's permissions.
    if ( !current_user_can( 'edit_post', $post_id ) ){
      return;
    }
    $batchnoset                   = get_post_meta( $post->ID, 'batch_number', true );
    $startdate                    = get_post_meta( $post->ID, 'start_date', true );
    $enddate                      = get_post_meta( $post->ID, 'end_date', true );
    $duration                     = get_post_meta( $post->ID, 'duration', true );
    $days                         = get_post_meta( $post->ID, 'days', true );
    $time                         = get_post_meta( $post->ID, 'time', true );
    $price                        = get_post_meta( $post->ID, 'price', true );
    $venue                        = get_post_meta( $post->ID, 'venue', true );
    $number_registered_students   = get_post_meta( $post->ID, 'number_registered_students', true );
    $number_total_students        = get_post_meta( $post->ID, 'number_total_students', true );
   
    // Array to submit data associated to the values.
    $batch_meta_metaboxvalues = array (
      "batch_number" => $_POST["batchid"],
      "start_date" => $_POST["start_date"],
      "end_date" => $_POST["end_date"],
      "duration" => $_POST["duration"],
      "days" => $_POST["days"],
      "time" => $_POST["time"],
      "price" => $_POST["price"],
      "venue" => $_POST["venue"],
      "number_registered_students" => $_POST["number_registered_students"],
      "number_total_students" => $_POST["number_total_students"]
    );
    
    foreach ($batch_meta_metaboxvalues as $key => $value) {
      update_post_meta($post_id, $key, sanitize_text_field( $value ));
    }

    $id = get_the_id($post_id);
    $updatedtitle = "Batch No#: ".  $id;
    $my_post = array(
      'ID'           => $id,
      'post_title'   => $updatedtitle,
    );
   	
    /*
 		* Whenever a batch is saved the total enrollments for the course 
 		  this batch is assigned to is calculated and saved 
  	*/
    // unhook this function to prevent infinite looping
    remove_action( 'save_post_course_batches', 'batch_meta_content_save_callback', 10, 3 );
    // update the post title
    wp_update_post( $my_post );
    // re-hook this function
    add_action( 'save_post_course_batches', 'batch_meta_content_save_callback', 10, 3  );
}
add_action( 'save_post_course_batches', 'batch_meta_content_save_callback', 10, 3 );

/**
* Display featured user box.
*
* @param WP_Post $post Current post object.
*/
function hl_show_batch( $post ) {
 	if (isset( $_POST['post_id'] )) {
 		$post_id = sanitize_text_field( $_POST['post_id'] );
 	}
 	else {
 		$post_id = $post->ID;
 	}

 	$storedbatches = get_post_meta( $post_id, 'batch', false ); 
 	
  echo "<div id='show-batch-accordion'>";
 	
  foreach ($storedbatches as $row => $outerrow) { 
	    $batchnoset = $outerrow['batchid'];
	    $startdate = $outerrow['startdate'];
	    $enddate = $outerrow['enddate'];
	    $duration = $outerrow['duration'];
	    $days = $outerrow['days'];
	    $time = $outerrow['time'];
	    $price = $outerrow['price'];
	    $venue = $outerrow['venue'];
	    $number_registered_students = $outerrow['registeredstudents'];
	    $number_total_students = $outerrow['totalstudents'];
 		   
      include( plugin_dir_path( __FILE__ ) . 'metabox-template.php'); 
    }
  wp_reset_postdata();
  wp_die( ); 

}
add_action( 'wp_ajax_hl_show_batch', 'hl_show_batch' );
add_action('wp_ajax_nopriv_hl_show_batch', 'hl_show_batch');



/**
 *
 * Function To process batch update
 *
 */

function hl_update_batch_ajax() {

  $post_id = sanitize_text_field( $_POST['post_id'] );

  // return if autosave
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
    return;
  }

  // Check the user's permissions.
  if ( !current_user_can( 'edit_post', $post_id ) ){
    return;
  }

  // check if form was submitted from the current website
  check_ajax_referer( 'hl_batch_ajax', 'nonce' );

  $batch = Array(
    'batchid'             => sanitize_text_field( $_POST['batchid'] ),
    'price'               => sanitize_text_field( $_POST['price'] ),
    'venue'               => sanitize_text_field( $_POST['venue'] ),
    'startdate'           => sanitize_text_field( $_POST['startdate'] ),
    'enddate'             => sanitize_text_field( $_POST['enddate'] ),
    'duration'            => sanitize_text_field( $_POST['duration'] ),
    'days'                => sanitize_text_field( $_POST['days'] ),
    'time'                => sanitize_text_field( $_POST['time'] ),
    'registeredstudents'  => sanitize_text_field( $_POST['registeredstudents'] ),
    'totalstudents'       => sanitize_text_field( $_POST['totalstudents'] )
  );

  $oldbatch = Array( 
    'batchid'             => sanitize_text_field( $_POST['before_batchid'] ),
    'price'               => sanitize_text_field( $_POST['before_price'] ),
    'venue'               => sanitize_text_field( $_POST['before_venue'] ),
    'startdate'           => sanitize_text_field( $_POST['before_startdate'] ),
    'enddate'             => sanitize_text_field( $_POST['before_enddate'] ),
    'duration'            => sanitize_text_field( $_POST['before_duration'] ),
    'days'                => sanitize_text_field( $_POST['before_days'] ),
    'time'                => sanitize_text_field( $_POST['before_time'] ),
    'registeredstudents'  => sanitize_text_field( $_POST['before_registeredstudents'] ),
    'totalstudents'       => sanitize_text_field( $_POST['before_totalstudents'] )
  );

  $type = sanitize_text_field( $_POST['type'] );

  

  if ($type == 'delete') {
    delete_post_meta( $post_id, 'batch', $batch);
  }
  elseif ($type == 'update') {
    update_post_meta( $post_id, 'batch', $batch, $oldbatch);
  }
  elseif ($type == 'create') {
    add_post_meta( $post_id, 'batch', $batch);
  }
  wp_die();
}
add_action( 'wp_ajax_hl_update_batch_ajax', 'hl_update_batch_ajax' );
add_action('wp_ajax_nopriv_hl_update_batch_ajax', 'hl_update_batch_ajax');