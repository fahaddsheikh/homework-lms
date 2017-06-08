<?php
/*
Plugin Name: Certifications
Description: A plugin which allows you to create courses and accept registrations for it.
Version: 0.1
Author: Fahad Sheikh
License: GPL2
*/


// Register Custom Post Types
function register_offline_course() {
	$labels = array(
		'name'                  => _x( 'Courses', 'Post Type General Name', 'Course' ),
		'singular_name'         => _x( 'Course', 'Post Type Singular Name', 'Course' ),
		'menu_name'             => __( 'Courses', 'Course' ),
		'name_admin_bar'        => __( 'Course', 'Course' ),
		'archives'              => __( 'Course Archives', 'Course' ),
		'attributes'            => __( 'Course Attributes', 'Course' ),
		'parent_item_colon'     => __( 'Parent Courses:', 'Course' ),
		'all_items'             => __( 'All Courses', 'Course' ),
		'add_new_item'          => __( 'Add New Course', 'Course' ),
		'add_new'               => __( 'Add New', 'Course' ),
		'new_item'              => __( 'New Course', 'Course' ),
		'edit_item'             => __( 'Edit Course', 'Course' ),
		'update_item'           => __( 'Update Course', 'Course' ),
		'view_item'             => __( 'View Course', 'Course' ),
		'view_items'            => __( 'View Course', 'Course' ),
		'search_items'          => __( 'Search Course', 'Course' ),
		'not_found'             => __( 'Not found', 'Course' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'Course' ),
		'featured_image'        => __( 'Featured Image', 'Course' ),
		'set_featured_image'    => __( 'Set featured image', 'Course' ),
		'remove_featured_image' => __( 'Remove featured image', 'Course' ),
		'use_featured_image'    => __( 'Use as featured image', 'Course' ),
		'insert_into_item'      => __( 'Insert into Course', 'Course' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Course', 'Course' ),
		'items_list'            => __( 'Course list', 'Course' ),
		'items_list_navigation' => __( 'Course list navigation', 'Course' ),
		'filter_items_list'     => __( 'Filter Course list', 'Course' ),
	);
	$args = array(
		'label'                 => __( 'Course', 'Course' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', ),
		'taxonomies'            => array( 'offline_course_cat' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'rewrite'            => array( 'slug' => 'courses' ),
	);
	register_post_type( 'course_offline', $args );

	$labels = array(
		'name'                  => _x( 'Batches', 'Post Type General Name', 'Batch' ),
		'singular_name'         => _x( 'Batch', 'Post Type Singular Name', 'Batch' ),
		'menu_name'             => __( 'Batches', 'Batch' ),
		'name_admin_bar'        => __( 'Batch', 'Batch' ),
		'archives'              => __( 'Batch Archives', 'Batch' ),
		'attributes'            => __( 'Batch Attributes', 'Batch' ),
		'parent_item_colon'     => __( 'Parent Batches:', 'Batch' ),
		'all_items'             => __( 'All Batches', 'Batch' ),
		'add_new_item'          => __( 'Add New Batch', 'Batch' ),
		'add_new'               => __( 'Add New', 'Batch' ),
		'new_item'              => __( 'New Batch', 'Batch' ),
		'edit_item'             => __( 'Edit Batch', 'Batch' ),
		'update_item'           => __( 'Update Batch', 'Batch' ),
		'view_item'             => __( 'View Batch', 'Batch' ),
		'view_items'            => __( 'View Batch', 'Batch' ),
		'search_items'          => __( 'Search Batch', 'Batch' ),
		'not_found'             => __( 'Not found', 'Batch' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'Batch' ),
		'featured_image'        => __( 'Featured Image', 'Batch' ),
		'set_featured_image'    => __( 'Set featured image', 'Batch' ),
		'remove_featured_image' => __( 'Remove featured image', 'Batch' ),
		'use_featured_image'    => __( 'Use as featured image', 'Batch' ),
		'insert_into_item'      => __( 'Insert into Batch', 'Batch' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Batch', 'Batch' ),
		'items_list'            => __( 'Batch list', 'Batch' ),
		'items_list_navigation' => __( 'Batch list navigation', 'Batch' ),
		'filter_items_list'     => __( 'Filter Batch list', 'Batch' ),
	);
	$args = array(
		'label'                 => __( 'Batch', 'Batch' ),
		'labels'                => $labels,
		'supports'              => false,
		'taxonomies'            => array( 'offline_course_cat' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => false,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'course_batches', $args );

	$labels = array(
		'name'                       => _x( 'Course Categories', 'Taxonomy General Name', 'Course Category' ),
		'singular_name'              => _x( 'Course Category', 'Taxonomy Singular Name', 'Course Category' ),
		'menu_name'                  => __( 'Course Categories', 'Course Category' ),
		'all_items'                  => __( 'All Course Categories', 'Course Category' ),
		'parent_item'                => __( 'Parent Course Category', 'Course Category' ),
		'parent_item_colon'          => __( 'Parent Course Category:', 'Course Category' ),
		'new_item_name'              => __( 'New Course Category', 'Course Category' ),
		'add_new_item'               => __( 'Add New Course Category', 'Course Category' ),
		'edit_item'                  => __( 'Edit Course Category', 'Course Category' ),
		'update_item'                => __( 'Update Course Category', 'Course Category' ),
		'view_item'                  => __( 'View Course Category', 'Course Category' ),
		'separate_items_with_commas' => __( 'Separate Course Categories with commas', 'Course Category' ),
		'add_or_remove_items'        => __( 'Add or remove Course Categories', 'Course Category' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'Course Category' ),
		'popular_items'              => __( 'Popular Course Categories', 'Course Category' ),
		'search_items'               => __( 'Search Course Categories', 'Course Category' ),
		'not_found'                  => __( 'Not Found', 'Course Category' ),
		'no_terms'                   => __( 'No Course Categories', 'Course Category' ),
		'items_list'                 => __( 'Course Category list', 'Course Category' ),
		'items_list_navigation'      => __( 'Course Categories list navigation', 'Course Category' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'      => array('slug' => 'category_courses')
	);
	register_taxonomy( 'offline_course_cat', array( 'course_offline' ), $args );

}
add_action( 'init', 'register_offline_course', 0 );


/* Add the batches post type under All courses */

function batch_under_courses() {
//create a submenu under Settings
 add_submenu_page( 'edit.php?post_type=course_offline', 'Batches', 'Batches',
    'manage_options', 'edit.php?post_type=course_batches',NULL );
}

add_action( 'admin_menu', 'batch_under_courses' );


/**
 * Meta Boxes for batches
 */

/**
 * Register featured meta box(es).
 */
function batch_meta_register_meta_boxes() {
    add_meta_box( 'batch_meta_metabox', __( 'Batch Meta', 'textdomain' ), 'batch_meta_content_callback', 'course_batches' );
}
add_action( 'add_meta_boxes', 'batch_meta_register_meta_boxes' );


/**
 * Display featured user box.
 *
 * @param WP_Post $post Current post object.
 */
function batch_meta_content_callback( $post ) {
    // make sure the form request comes from WordPress.
    wp_nonce_field( basename( __FILE__ ), 'batch_meta_content_callback_nonce' );

    $batchnoset = get_post_meta( $post->ID, 'batch_number', true );
    $startdate = get_post_meta( $post->ID, 'start_date', true );
    $enddate = get_post_meta( $post->ID, 'end_date', true );
    $duration = get_post_meta( $post->ID, 'duration', true );
    $days = get_post_meta( $post->ID, 'days', true );
    $time = get_post_meta( $post->ID, 'time', true );
    $price = get_post_meta( $post->ID, 'price', true );
    $discounted_price = get_post_meta( $post->ID, 'discounted_price', true );
    $venue = get_post_meta( $post->ID, 'venue', true );
    $number_registered_students = get_post_meta( $post->ID, 'number_registered_students', true );
    $number_total_students = get_post_meta( $post->ID, 'number_total_students', true );
    $discount_detail = get_post_meta( $post->ID, 'discount_detail', true );

    ?>
    <div style="padding:15px;">
    	<h2><strong>Batch Details</strong></h2>
    	<hr>
		<div style="width:50%;float:left;margin-bottom:10px;">
			<!-- Batch Number -->
		    <label for="batch_number" style="display: inline-block;margin: 0 10px;width:30%;width:30%;"><h2>Batch Number#</h2></label>
		    <input type="text" name="batch_number" id="batch_number" value="<?php echo get_the_id($post->ID); ?>" class="regular-text" readonly="readonly">
		</div>
		<div style="width:50%;float:left;margin-bottom:10px;">
			<!-- Price -->
		    <label for="price" style="display: inline-block;margin: 0 10px;width:30%;width:30%;"><h2>Price(Rs)</h2></label>
		    <input type="number" name="price" id="price" value="<?php if(isset($price) && empty(!$price)) : echo $price; endif; ?>" class="regular-text" >
		</div>
		<div style="width:50%;float:left;margin-bottom:10px;">
			<!-- Location -->
		    <label for="price" style="display: inline-block;margin: 0 10px;width:30%;width:30%;"><h2>Location</h2></label>
		    <select name="venue" style="width:50%;">
		      <option value="karachi" <?php if(isset($venue) && $venue == 'karachi') : echo 'selected'; endif; ?>>Karachi</option>
		      <option value="hyderabad" <?php if(isset($venue) && $venue == 'hyderabad') : echo 'selected'; endif; ?>>Hyderabad</option>
		      <option value="online" <?php if(isset($venue) && $venue == 'online') : echo 'selected'; endif; ?>>Online</option>
		    </select>
		</div>
		<div style="width:50%;float:left;margin-bottom:10px;">
			<!-- Price -->
		    <label for="discounted_price" style="display: inline-block;margin: 0 10px;width:30%;width:30%;"><h2>Discounted Price(Rs)</h2></label>
		    <input type="number" name="discounted_price" id="discounted_price" value="<?php if(isset($discounted_price) && empty(!$discounted_price)) : echo $discounted_price; endif; ?>" class="regular-text" >
		</div>
		<div style="width:100%;float:left;margin-bottom:10px;">
			<!-- Price -->
		    <label for="discount_detail" style="display: inline-block;margin: 0 10px;width:30%;width:30%;"><h2 style="margin:20px 0px 10px 0;">Discount Detail</h2></label>
		    <textarea name="discount_detail" id="discount_detail" style="display: inline-block;box-sizing: border-box;margin: 0 21px;width: 97%;height: 100px;"><?php if(isset($discount_detail) && empty(!$discount_detail)) : echo $discount_detail; endif; ?></textarea>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div style="padding:15px;">
		<h2><strong>Duration &amp; Timing</strong></h2>
		<hr>
		<div style="width:50%;float:left;margin-bottom:10px;">
		    <!-- Start Date -->
		    <label for="start_date" style="display: inline-block;margin: 0 10px;width:30%;"><h2>Start Date</h2></label>
		    <input type="date" name="start_date" id="start_date" value="<?php if(isset($startdate) && empty(!$startdate)) : echo $startdate; endif; ?>" class="regular-text" >
		</div>
		<div style="width:50%;float:left;margin-bottom:10px;">
		    <!-- End Date -->
		    <label for="end_date" style="display: inline-block;margin: 0 10px;width:30%;"><h2>End Date</h2></label>
		    <input type="date" name="end_date" id="end_date" value="<?php if(isset($enddate) && empty(!$enddate)) : echo $enddate; endif; ?>" class="regular-text" >
		</div>
		<div style="width:50%;float:left;margin-bottom:10px;">
		    <!-- Duration -->
		    <label for="duration" style="display: inline-block;margin: 0 10px;width:30%;"><h2>Duration</h2></label>
		    <input type="text" name="duration" id="duration" value="<?php if(isset($duration) && empty(!$duration)) : echo $duration; endif; ?>" class="regular-text">
		</div>		
		<div style="width:50%;float:left;margin-bottom:10px;">
		    <!-- Days -->
		    <label for="days" style="display: inline-block;margin: 0 10px;width:30%;"><h2>Days</h2></label>
		    <input type="text" name="days" id="days" value="<?php if(isset($days) && empty(!$days)) : echo $days; endif; ?>" class="regular-text">
		</div>
		<div style="width:50%;float:left;margin-bottom:10px;">
		    <!-- Time -->
		    <label for="time" style="display: inline-block;margin: 0 10px;width:30%;"><h2>Time</h2></label>
		    <input type="text" name="time" id="time" value="<?php if(isset($time) && empty(!$time)) : echo $time; endif; ?>" class="regular-text">
		</div>
		<div style="clear:both;"></div>
	</div>
	<div style="padding:15px;">
    	<h2><strong>Number of Students</strong></h2>
    	<hr>
		<div style="width:50%;float:left;margin-bottom:10px;">
			<!-- Batch Number -->
		    <label for="number_registered_students" style="display: inline-block;margin: 0 10px;width:30%;width:30%;"><h2>Number of registered Students</h2></label>
		    <input type="number" name="number_registered_students" id="number_registered_students" value="<?php if(isset($number_registered_students) && empty(!$number_registered_students)) : echo $number_registered_students; else : echo 0; endif; ?>" class="small" >
		</div>
		<div style="width:50%;float:left;margin-bottom:10px;">
			<!-- Price -->
		    <label for="number_total_students" style="display: inline-block;margin: 0 10px;width:30%;width:30%;"><h2>Total Number of Students</h2></label>
		    <input type="number" name="number_total_students" id="number_total_students" value="<?php if(isset($number_total_students) && empty(!$number_total_students)) : echo $number_total_students;  else : echo 20; endif; ?>" class="small" >
		</div>
		<div style="clear:both;"></div>
	</div>

<?php }

/**
 * Save featured user.
 *
 * @param int $post_id Post ID
 */

function batch_meta_content_save_callback( $post_id ) {
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

    
    // Array to submit data associated to the values.
    $batch_meta_metaboxvalues = array (
        "batch_number" => $_POST["batch_number"],
		"start_date" => $_POST["start_date"],
        "end_date" => $_POST["end_date"],
        "duration" => $_POST["duration"],
        "days" => $_POST["days"],
        "time" => $_POST["time"],
        "price" => $_POST["price"],
        "venue" => $_POST["venue"],
        "number_registered_students" => $_POST["number_registered_students"],
        "number_total_students" => $_POST["number_total_students"],
        "discounted_price" => $_POST["discounted_price"],
        "discount_detail" => $_POST["discount_detail"]
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

	// unhook this function to prevent infinite looping
	remove_action( 'save_post_course_batches', 'batch_meta_content_save_callback', 10, 3 );

	// update the post title
	wp_update_post( $my_post );

	// re-hook this function
	add_action( 'save_post_course_batches', 'batch_meta_content_save_callback', 10, 3  );
}
add_action( 'save_post_course_batches', 'batch_meta_content_save_callback', 10, 3 );



/**
 * Meta Boxes for courses
 */


/**
 * Register featured meta box(es).
 */
function course_meta_register_meta_boxes() {
    add_meta_box( 'course_meta_metabox', __( 'Batches for this course', 'textdomain' ), 'course_meta_content_callback', 'course_offline' );
}
add_action( 'add_meta_boxes', 'course_meta_register_meta_boxes' );


/**
 * Display featured user box.
 *
 * @param WP_Post $post Current post object.
 */
function course_meta_content_callback( $post ) {
    // make sure the form request comes from WordPress.
    wp_nonce_field( basename( __FILE__ ), 'course_meta_content_callback_nonce' );

    $query = new WP_Query( array('post_type' => 'course_batches', 'posts_per_page' => -1) );
    $getbatchesforcourse = get_post_meta( $post->ID, 'batch_for_course', true );
    $getbatchesforcourse_array = explode(",",$getbatchesforcourse);
    ?>
    <div style="width:100%;padding:20px;height:auto;max-height:500px;overflow: auto;box-sizing:border-box;">
    		<?php if ( $query->have_posts() ) : ?>
				<!-- the loop -->
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<div style="width:50%;display:inline-block;width: 90px;margin: 10px 5px;">
						<input 
							type="checkbox" 
							name="batch_for_course[]" 
							id="<?php echo the_id() ?>" 
							value="<?php echo the_id() ?>" 
							<?php if (in_array( get_the_id() ,$getbatchesforcourse_array) ) : 
								echo "checked"; 
							endif;?>
							><label for="<?php echo the_id() ?>">#<?php echo the_id() ?></label>
					</div>
				<?php endwhile; ?>
				<!-- end of the loop -->
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</select>
	</div>

<?php }

/**
 * Save featured user.
 *
 * @param int $post_id Post ID
 */
function course_meta_content_save_callback( $post_id ) {
    // verify taxonomies meta box nonce
    if ( !isset( $_POST['course_meta_content_callback_nonce'] ) || !wp_verify_nonce( $_POST['course_meta_content_callback_nonce'], basename( __FILE__ ) ) ){
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

    $convertedvalues = implode(",",$_POST["batch_for_course"]);
    update_post_meta($post_id, 'batch_for_course', sanitize_text_field( $convertedvalues ));
}
add_action( 'save_post_course_offline', 'course_meta_content_save_callback' );



function get_offline_courses_template( $archive_template ) {
    global $post;

    if ( is_post_type_archive ( 'course_offline' ) || is_search() && $_POST['post_type'] == 'course_offline' || is_tax( 'offline_course_cat' )) {
        $archive_template = dirname( __FILE__ ) . '/archive-offline-courses.php';    
    }
    
    if ($post->post_type == 'course_offline' && is_single( )) {
         $archive_template = dirname( __FILE__ ) . '/single-offline-course.php';
    }
   	return $archive_template;

}

add_filter( 'archive_template', 'get_offline_courses_template' );
add_filter( 'single_template', 'get_offline_courses_template' );
add_filter( 'template_include', 'get_offline_courses_template', 99 );

function add_head_style() {
    ?>
	    <style>
	    	.online-t .batch-column {
	    		width: 12.5%;
	    		text-align: center;
	    		line-height: 16px;
	    		font-size: 12px;
	    		vertical-align: middle;
	    		display: inline-block;
	    		float: left;
	    		min-height: 16px;
	    		max-height: 16px;
	    		box-sizing: border-box;
	    		padding: 0 5px;
	    		text-transform: capitalize;
	    	}
	    	.online-t #batch-time {
	    		text-transform: none;
	    	}
	    	.single-batch {
	    		margin-bottom: 20px;
	    		line-height: 30px;
	    	}
	    	#price {
	    		position:relative;
	    	}
	    	#discounted-price {
	    		text-decoration: none;
	    		font-weight: bold;
	    		color: #ff4700;
	    		font-size: 14px;
	    		display: block;
	    		position: relative;
	    		top: -5px;
	    		line-height: 10px;
	    	}
	    	#original-price {
	    		text-decoration: line-through;
	    		font-size: 12px;
	    		position: relative;
	    		top: -5px;
	    		line-height: 10px;
	    	}
	    	#price .discount-detail {
    			height: 100px;
    		    overflow: hidden;
    		    display: block;
    		    padding: 10px;
    		    font-size: 85%;
    		    background-color: #1C1C1C;
    		    border-radius: 3px;
    		    color: #F6A213;
    		    margin: 0;
    		    position: absolute;
    		    top: -120px;
    		    display: none; 
    		    left: -60px;
    		    width: 200px;
    		    transition: all 1s ease-in;
    		    text-align: left;
	    	}
	    	#price:hover .discount-detail {
			display:block;
	    	}
		#head .batch-column:nth-child(6) {
    			display: none;
		}
		.single-batch #batch-registered-students {
    			display: none;
		}
	    	@media only screen and (max-width: 767px)  {
	    		.online-t .batch-column {
	    			width: 100%;
	    			font-size:20px;
	    			min-height: auto;
	    			max-height: none;
	    			margin-bottom: 12px;
	    		}
	    		.single-batch {
	    			border-bottom:1px solid #eee;
	    		}
	    		.course-features .single-batch .course-booking-button {
	    			font-size: 25px;
	    			margin: 10px;
	    			display: block;
	    		}
	    		#discounted-price {
	    			position: static;
	    			top: -5px;
	    		}
	    		#original-price {
	    			position: static;
	    		}
	    	}
	    </style>
    <?php
}
add_action('wp_head', 'add_head_style');


function enqueue_batch_register_script() {
    wp_enqueue_script( 'script-name', plugins_url( '/batch-register.js', __FILE__ ) , array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_batch_register_script' );