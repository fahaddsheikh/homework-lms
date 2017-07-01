<?php
/**
* Display featured user box.
*
* @param WP_Post $post Current post object.
*/
 function hl_create_batch(  ) { 
      
      include( plugin_dir_path( __FILE__ ) . 'metabox-template.php');
}

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
  
  if (isset($storedbatches) && !empty($storedbatches))  :
    
    echo "<div id='show-batch-accordion'>";
    foreach ($storedbatches as $row => $outerrow) { 
        if (isset($outerrow['batchid']))    : $batchnoset   = $outerrow['batchid']; endif;
        if (isset($outerrow['startdate']))  : $startdate    = $outerrow['startdate']; endif;
        if (isset($outerrow['enddate']))    : $enddate      = $outerrow['enddate']; endif;
        if (isset($outerrow['duration']))   : $duration     = $outerrow['duration']; endif;
        if (isset($outerrow['days']))       : $days         = $outerrow['days']; endif;
        if (isset($outerrow['time']))       : $time         = $outerrow['time']; endif;
        if (isset($outerrow['price']))      : $price        = $outerrow['price']; endif;
        if (isset($outerrow['venue']))      : $venue        = $outerrow['venue']; endif;
        if (isset($outerrow['discounted_price'])) : $discounted_price = $outerrow['discounted_price']; endif;
        if (isset($outerrow['discount_detail'])) : $discount_detail   = $outerrow['discount_detail']; endif;
        if (isset($outerrow['registeredstudents']))     : $number_registered_students   = $outerrow['registeredstudents']; endif;
        if (isset($outerrow['totalstudents']))      : $number_total_students          = $outerrow['totalstudents']; endif;
        include( plugin_dir_path( __FILE__ ) . 'metabox-template.php');
      }
      echo "</div>";

  endif;
  wp_reset_postdata();
   /* AJAX REQUEST check  */

   if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
     /* special ajax here */
     wp_die();
   }
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

  
  $result =  $_POST['result'];

  $batch = Array(
    'batchid'             => sanitize_text_field( $result['batchid'] ),
    'price'               => sanitize_text_field( $result['price'] ),
    'venue'               => sanitize_text_field( $result['venue'] ),
    'startdate'           => sanitize_text_field( $result['startdate'] ),
    'enddate'             => sanitize_text_field( $result['enddate'] ),
    'duration'            => sanitize_text_field( $result['duration'] ),
    'days'                => sanitize_text_field( $result['days'] ),
    'time'                => sanitize_text_field( $result['time'] ),
    'registeredstudents'  => sanitize_text_field( $result['registeredstudents'] ),
    'totalstudents'       => sanitize_text_field( $result['totalstudents'] ),
    'discounted_price'    => sanitize_text_field( $result['discounted_price'] ),
    'discount_detail'     => sanitize_text_field( $result['discount_detail'] ) 
  );

  $oldbatch = Array( 
    'batchid'             => sanitize_text_field( $result['before_batchid'] ),
    'price'               => sanitize_text_field( $result['before_price'] ),
    'venue'               => sanitize_text_field( $result['before_venue'] ),
    'startdate'           => sanitize_text_field( $result['before_startdate'] ),
    'enddate'             => sanitize_text_field( $result['before_enddate'] ),
    'duration'            => sanitize_text_field( $result['before_duration'] ),
    'days'                => sanitize_text_field( $result['before_days'] ),
    'time'                => sanitize_text_field( $result['before_time'] ),
    'registeredstudents'  => sanitize_text_field( $result['before_registeredstudents'] ),
    'totalstudents'       => sanitize_text_field( $result['before_totalstudents'] ),
    'discounted_price'    => sanitize_text_field( $result['before_discounted_price'] ),
    'discount_detail'     => sanitize_text_field( $result['before_discount_detail'] ) 
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