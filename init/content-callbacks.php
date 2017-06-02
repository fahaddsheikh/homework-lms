<?php
/**
* Display featured user box.
*
* @param WP_Post $post Current post object.
*/
 function hl_create_batch( $post ) {       ?>
        <div style="padding:15px;">
            <h2><strong>Batch Details</strong></h2>
            <hr>
            <div style="width:50%;float:left;margin-bottom:10px;">
                <!-- Batch Number -->
                <label for="batch_number" style="display: inline-block;margin: 0 10px;width:30%;width:30%;">
                    <h2>Batch Number#</h2>
                </label>
                <input type="text" name="batch_number" id="batch_number" value="" class="regular-text" >
            </div>
            <div style="width:50%;float:left;margin-bottom:10px;">
                <!-- Price -->
                <label for="price" style="display: inline-block;margin: 0 10px;width:30%;width:30%;">
                    <h2>Price(Rs)</h2>
                </label>
                <input type="number" name="price" id="price" value="<?php if(isset($price) && empty(!$price)) : echo $price; endif; ?>" class="regular-text" >
            </div>
            <div style="width:50%;float:left;margin-bottom:10px;">
                <!-- Location -->
                <label for="price" style="display: inline-block;margin: 0 10px;width:30%;width:30%;">
                    <h2>Location</h2>
                </label>
                <select name="venue" id="venue" style="width:50%;">
                    <option value="karachi" <?php if(isset($venue) && $venue == 'karachi') : echo 'selected'; endif; ?>>Karachi</option>
                    <option value="hyderabad" <?php if(isset($venue) && $venue == 'hyderabad') : echo 'selected'; endif; ?>>Hyderabad</option>
                    <option value="online" <?php if(isset($venue) && $venue == 'online') : echo 'selected'; endif; ?>>Online</option>
                </select>
            </div>
            <div style="clear:both;"></div>
        </div>
        <div style="padding:15px;">
            <h2><strong>Duration &amp; Timing</strong></h2>
            <hr>
            <div style="width:50%;float:left;margin-bottom:10px;">
                <!-- Start Date -->
                <label for="start_date" style="display: inline-block;margin: 0 10px;width:30%;">
                    <h2>Start Date</h2>
                </label>
                <input type="date" name="start_date" id="start_date" value="<?php echo date("Y-m-d"); ?>" class="regular-text" >
            </div>
            <div style="width:50%;float:left;margin-bottom:10px;">
                <!-- End Date -->
                <label for="end_date" style="display: inline-block;margin: 0 10px;width:30%;">
                    <h2>End Date</h2>
                </label>
                <input type="date" name="end_date" id="end_date" value="<?php echo date("Y-m-d"); ?>" class="regular-text" >
            </div>
            <div style="width:50%;float:left;margin-bottom:10px;">
                <!-- Duration -->
                <label for="duration" style="display: inline-block;margin: 0 10px;width:30%;">
                    <h2>Duration</h2>
                </label>
                <input type="text" name="duration" id="duration" value="<?php if(isset($duration) && empty(!$duration)) : echo $duration; endif; ?>" class="regular-text">
            </div>
            <div style="width:50%;float:left;margin-bottom:10px;">
                <!-- Days -->
                <label for="days" style="display: inline-block;margin: 0 10px;width:30%;">
                    <h2>Days</h2>
                </label>
                <input type="text" name="days" id="days" value="<?php if(isset($days) && empty(!$days)) : echo $days; endif; ?>" class="regular-text">
            </div>
            <div style="width:50%;float:left;margin-bottom:10px;">
                <!-- Time -->
                <label for="time" style="display: inline-block;margin: 0 10px;width:30%;">
                    <h2>Time</h2>
                </label>
                <input type="text" name="time" id="time" value="<?php if(isset($time) && empty(!$time)) : echo $time; endif; ?>" class="regular-text">
            </div>
            <div style="clear:both;"></div>
        </div>
        <div style="padding:15px;">
            <h2><strong>Number of Students</strong></h2>
            <hr>
            <div style="width:50%;float:left;margin-bottom:10px;">
                <!-- Batch Number -->
                <label for="number_registered_students" style="display: inline-block;margin: 0 10px;width:30%;width:30%;">
                    <h2>Number of registered Students</h2>
                </label>
                <input type="number" name="number_registered_students" id="number_registered_students" value="<?php if(isset($number_registered_students) && empty(!$number_registered_students)) : echo $number_registered_students; else : echo 0; endif; ?>" class="small" >
            </div>
            <div style="width:50%;float:left;margin-bottom:10px;">
                <!-- Price -->
                <label for="number_total_students" style="display: inline-block;margin: 0 10px;width:30%;width:30%;">
                    <h2>Total Number of Students</h2>
                </label>
                <input type="number" name="number_total_students" id="number_total_students" value="<?php if(isset($number_total_students) && empty(!$number_total_students)) : echo $number_total_students;  else : echo 20; endif; ?>" class="small" >
            </div>
            <div style="clear:both;"></div>
        </div>
        <hr>
        <div style="padding:15px 30px;;text-align:right;">
        <div id="batch-error" class="notice notice-error" style="display:none;">
            <h4 style="text-align:left;"></h4>
        </div>
        <input type="hidden" name="submitted" id="submitted" value="<?php echo wp_create_nonce( 'hl_create_batch_nonce' );?>">
        <div class="spinner hl-create" style="float: none;width: auto;height: auto;padding: 10px 0 10px 21px;"></div>
        <button type="button" name="create-batch" id="create-batch" class="button button-primary">Create Batch!</button>
 	</div>
<?php }

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

  // make sure the form request comes from WordPress.
  wp_nonce_field( basename( __FILE__ ), 'course_meta_content_callback_nonce' );

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
 		?>

 		<h4>Batch ID#: <?php echo $batchnoset ?></h4>
 		<div id="<?php echo $batchnoset ?>" class="batch">
   		    <div>
 		    	<h2><strong>Batch Details</strong></h2>
 		    	<hr>
 				<div style="width:50%;float:left;margin-bottom:10px;">
 					<!-- Batch Number -->
 				    <label for="batch_number" style="display: inline-block;margin: 0 10px;width:25%;"><h2>Batch Number#</h2></label>
 				    <input type="text" name="batch_number" id="batch_number" value="<?php echo $batchnoset; ?>" class="regular-text" readonly="readonly">
 				</div>
 				<div style="width:50%;float:left;margin-bottom:10px;">
 					<!-- Price -->
 				    <label for="price" style="display: inline-block;margin: 0 10px;width:25%;"><h2>Price(Rs)</h2></label>
 				    <input type="number" name="price" id="price" value="<?php if(isset($price) && empty(!$price)) : echo $price; endif; ?>" class="regular-text" readonly="readonly">
 				</div>
 				<div style="width:50%;float:left;margin-bottom:10px;">
 					<!-- Location -->
 				    <label for="price" style="display: inline-block;margin: 0 10px;width:25%;"><h2>Location</h2></label>
 				    <select name="venue" id="venue" style="width:50%;" disabled>
 				      <option value="karachi" <?php if(isset($venue) && $venue == 'karachi') : echo 'selected'; endif; ?>>Karachi</option>
 				      <option value="hyderabad" <?php if(isset($venue) && $venue == 'hyderabad') : echo 'selected'; endif; ?>>Hyderabad</option>
 				      <option value="online" <?php if(isset($venue) && $venue == 'online') : echo 'selected'; endif; ?>>Online</option>
 				    </select>
 				</div>
 				<div style="clear:both;"></div>
 			</div>
 			<div>
 				<h2><strong>Duration &amp; Timing</strong></h2>
 				<hr>
 				<div style="width:50%;float:left;margin-bottom:10px;">
 				    <!-- Start Date -->
 				    <label for="start_date" style="display: inline-block;margin: 0 10px;width:25%;"><h2>Start Date</h2></label>
 				    <input type="date" name="start_date" id="start_date" value="<?php if(isset($startdate) && empty(!$startdate)) : echo $startdate; endif; ?>" class="regular-text" readonly="readonly">
 				</div>
 				<div style="width:50%;float:left;margin-bottom:10px;">
 				    <!-- End Date -->
 				    <label for="end_date" style="display: inline-block;margin: 0 10px;width:25%;"><h2>End Date</h2></label>
 				    <input type="date" name="end_date" id="end_date" value="<?php if(isset($enddate) && empty(!$enddate)) : echo $enddate; endif; ?>" class="regular-text" readonly="readonly">
 				</div>
 				<div style="width:50%;float:left;margin-bottom:10px;">
 				    <!-- Duration -->
 				    <label for="duration" style="display: inline-block;margin: 0 10px;width:25%;"><h2>Duration</h2></label>
 				    <input type="text" name="duration" id="duration" value="<?php if(isset($duration) && empty(!$duration)) : echo $duration; endif; ?>" class="regular-text" readonly="readonly">
 				</div>		
 				<div style="width:50%;float:left;margin-bottom:10px;">
 				    <!-- Days -->
 				    <label for="days" style="display: inline-block;margin: 0 10px;width:25%;"><h2>Days</h2></label>
 				    <input type="text" name="days" id="days" value="<?php if(isset($days) && empty(!$days)) : echo $days; endif; ?>" class="regular-text" readonly="readonly">
 				</div>
 				<div style="width:50%;float:left;margin-bottom:10px;">
 				    <!-- Time -->
 				    <label for="time" style="display: inline-block;margin: 0 10px;width:25%;"><h2>Time</h2></label>
 				    <input type="text" name="time" id="time" value="<?php if(isset($time) && empty(!$time)) : echo $time; endif; ?>" class="regular-text" readonly="readonly">
 				</div>
 				<div style="clear:both;"></div>
 			</div>
 			<div>
 		    	<h2><strong>Number of Students</strong></h2>
 		    	<hr>
 				<div style="width:50%;float:left;margin-bottom:10px;">
 					<!-- Batch Number -->
 				    <label for="number_registered_students" style="display: inline-block;margin: 0 10px;width:25%;"><h2>Number of registered Students</h2></label>
 				    <input type="number" name="number_registered_students" id="number_registered_students" value="<?php if(isset($number_registered_students) && empty(!$number_registered_students)) : echo $number_registered_students; else : echo 0; endif; ?>" class="small" readonly="readonly">
 				</div>
 				<div style="width:50%;float:left;margin-bottom:10px;">
 					<!-- Price -->
 				    <label for="number_total_students" style="display: inline-block;margin: 0 10px;width:25%;"><h2>Total Number of Students</h2></label>
 				    <input type="number" name="number_total_students" id="number_total_students" value="<?php if(isset($number_total_students) && empty(!$number_total_students)) : echo $number_total_students;  else : echo 20; endif; ?>" class="small" readonly="readonly">
 				</div>
 				<div style="clear:both;"></div>
 			</div>
 			<hr>
 			<div style="padding:15px 30px;;text-align:right;">
 				<div id="batch-error" class="notice notice-error" style="display:none;"><h4 style="text-align:left;"></h4></div>
 				<input type="hidden" name="submitted" id="submitted" value="<?php echo wp_create_nonce( 'hl_delete_batch_ajax' );?>">
 				<div class="spinner hl-create" style="float: none;width: auto;height: auto;padding: 10px 0 10px 21px;background-position: 0;position: absolute;left: 50%;top: 50%;"></div>
        <button type="button" name="edit-batch" id="edit-batch" class="button button-primary">Edit Batch</button>
 				<button type="button" name="update-batch" id="update-batch" class="button button-primary" style="display:none;">Update Batch</button>
 				<button type="button" name="delete-batch" id="delete-batch" class="button button-secondary delete" onclick="return confirm('Are you sure?');" style="display:none;">Delete Batch</button>
 			</div>
 		
 		</div>
 	<?php } ?>
  </div>
  <div class='spinner hl-show' style='float: none;width: auto;height: auto;padding: 10px 0 10px 21px;background-position: 0;background-position: 0;position: absolute;top: 50%;left: 50%;'></div>

 	<?php 
  wp_reset_postdata();
  wp_die( ); 
}
add_action( 'wp_ajax_hl_show_batch', 'hl_show_batch' );
add_action('wp_ajax_nopriv_hl_show_batch', 'hl_show_batch');

/**
 *
 * Function to get the information from hl_show_batch 
 * and create a new meta field on that hl_show_batch entries
 *
 */


function hl_create_batch_ajax() {

  $post_id = sanitize_text_field( $_POST['post_id'] ); 

  // check if form was submitted from the current website
  check_ajax_referer( 'hl_create_batch_nonce', 'nonce' );

  // return if autosave
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
    return;
  }

  // Check the user's permissions.
  if ( !current_user_can( 'edit_post', $post_id ) ){
    return;
  }

  $batch = Array(
    'coursetitle'			=> sanitize_text_field( $_POST['coursetitle'] ),
    'batchid' 				=> sanitize_text_field( $_POST['batchid'] ),
    'price' 				=> sanitize_text_field( $_POST['price'] ),
    'venue'					=> sanitize_text_field( $_POST['venue'] ),
    'startdate' 			=> sanitize_text_field( $_POST['startdate'] ),
    'enddate' 				=> sanitize_text_field( $_POST['enddate'] ),
    'duration' 				=> sanitize_text_field( $_POST['duration'] ),
    'days' 					=> sanitize_text_field( $_POST['days'] ),
    'time' 					=> sanitize_text_field( $_POST['time'] ),
    'registeredstudents'	=> sanitize_text_field( $_POST['registeredstudents'] ),
    'totalstudents'			=> sanitize_text_field( $_POST['totalstudents'] )
  );

  add_post_meta( $post_id, 'batch', $batch);
  wp_die();
}
add_action( 'wp_ajax_hl_create_batch_ajax', 'hl_create_batch_ajax' );
add_action('wp_ajax_nopriv_hl_create_batch_ajax', 'hl_create_batch_ajax');

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
  check_ajax_referer( 'hl_delete_batch_ajax', 'nonce' );

  $batch = Array(
    'coursetitle'         => sanitize_text_field( $_POST['coursetitle'] ),
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
    'coursetitle'         => sanitize_text_field( $_POST['before_coursetitle'] ),
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

  var_dump($type);

  if ($type == 'delete') {
    delete_post_meta( $post_id, 'batch', $batch);
  }
  elseif ($type == 'update') {
    update_post_meta( $post_id, 'batch', $batch, $oldbatch);
  }
  wp_die();
}
add_action( 'wp_ajax_hl_update_batch_ajax', 'hl_update_batch_ajax' );
add_action('wp_ajax_nopriv_hl_update_batch_ajax', 'hl_update_batch_ajax');