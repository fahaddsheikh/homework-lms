<?php
/*
 Plugin Name: Homework LMS
 Description: A plugin which allows you to create courses and accept registrations for it.
 Version: 5.0
 Author: Fahad Sheikh
 License: GPL2
*/

// Register All Post types and Meta Boxes
include( plugin_dir_path( __FILE__ ) . 'init/register.php');
// Content callbacks for all metaboxes 
include( plugin_dir_path( __FILE__ ) . 'init/content-callbacks.php');
// Shortcodes 
include( plugin_dir_path( __FILE__ ) . 'shortcodes.php');

/*
	Load CSS and JS Files
*/
function hl_enqueue() {
	wp_enqueue_style( 'hl_style', plugins_url( 'css/style.css', __FILE__ ) , array(), '1.0.0', false );
 	wp_enqueue_script( 'hl_js', plugins_url( 'js/hl_frontendjs.js', __FILE__ ) , array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'hl_enqueue' );

/*
	Load Admin Scripts only on homework-course post type.
*/
function hl_enqueue_admin() {
	global $post;
	$screen = get_current_screen();
	if ($screen->post_type !== 'homework-course') {
		return;
	}
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-widget');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_style( 'hl_jquery-ui', plugins_url( 'css/hl-jquery-ui.css', __FILE__ ) , array(), '1.0.0', false );
	wp_enqueue_script( 'hl_admin_script', plugins_url( '/js/hl_admin_script.js', __FILE__ ) , array('jquery','jquery-ui-core', 'jquery-ui-sortable','jquery-ui-accordion'), '2.0.0', false );
	// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
	wp_localize_script( 'hl_admin_script', 'ajax_object',
         array( 
         	'ajax_url' => admin_url( 'admin-ajax.php' ), 
         	'post_id' => $post->ID,
         ));
}
add_action( 'admin_enqueue_scripts', 'hl_enqueue_admin' ,1000 ,0 );


/**
 *
 * Assign Templates
 *
 */



function get_lms_courses_template( $archive_template ) {
    global $post;

    if ( is_post_type_archive ( 'homework-course' ) || is_search() && $_POST['post_type'] == 'homework-course' || is_tax( 'homework-course-category' )) {
        $archive_template = dirname( __FILE__ ) . '/templates/archive-offline-courses.php';    
    }
    
    if ($post->post_type == 'homework-course' && is_single( )) {
         $archive_template = dirname( __FILE__ ) . '/templates/single-offline-course.php';
    }
   	return $archive_template;

}

add_filter( 'archive_template', 'get_lms_courses_template' );
add_filter( 'single_template', 'get_lms_courses_template' );
add_filter( 'template_include', 'get_lms_courses_template', 99 );
                 

/**
 *
 * Get Price Starting From
 *
 */
function price_starting_from($post_id) {
    $batches = get_post_meta( $post_id, 'batch', true );
    if (!empty($batches)) {
        foreach ($batches as $batch) {
            $price[] = $batch['price'];
            if (isset($batch['discounted_price'])) {
                $price[] = $batch['discounted_price']; 
            }
        }
    }
    echo "Starting from Rs. ". intval(min($price)) ." ";   
}


/**
 *
 * Get Author link and Avatar
 *
 */

function get_author_avatar($author_id) {
	$instructor_title = '<a href="'.get_author_posts_url( $author_id ).'" class="author-avatar">'. get_avatar( get_the_author_meta( 'user_email',$author_id ), 20 ).get_the_author_meta( 'display_name',$author_id ).'</a>';
	echo '<div class="modern-instructor">'.$instructor_title.'</div>';
}


/**
 *
 * Get Assigned Categories
 *
 */

function get_assigned_categories($post_id) {
	if (get_the_terms($post_id, 'homework-course-category' )) {
		echo '<div class="modern-cat">';
		$categories = get_the_terms($post_id, 'homework-course-category' );
		$typeName = array();
		foreach ( $categories as $category ){
			$cat_icon = (function_exists('tax_icons_output_term_icon'))?tax_icons_output_term_icon( $category->term_id ):'';
			$typeName[] = '<a class="hcolorf" href="' . esc_url( get_category_link( $category ) ) . '" title="' . esc_attr( sprintf( esc_html__( 'View all courses under %s', 'michigan' ), $category->name ) ) . '">'. $cat_icon . esc_html( $category->name ). '</a>';
		}
		echo implode(', ', $typeName);
		echo '</div>';
	}
}


/**
 *
 * Get Post images
 *
 */

function get_post_image($post_id) {

	if ( has_post_thumbnail( $post_id ) ) {
		$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'michigan_webnus_blog2_img' );
		if (class_exists('LLMS_Product')){
			echo apply_filters( 'lifterlms_featured_img', '<img src="' . $img[0] . '" alt="Placeholder" class="llms-course-image llms-featured-imaged wp-post-image" />' );
		}else{
			echo '<img src="' . $img[0] . '" alt="Placeholder" class="llms-course-image llms-featured-imaged wp-post-image" />';
		}
	}elseif(function_exists('llms_placeholder_img_src')){
		if(llms_placeholder_img_src()){
			$no_img = get_template_directory_uri().'/images/course_no_image.png';
			echo apply_filters( 'lifterlms_placeholder_img', '<img src="' . $no_img . '" alt="Placeholder" class="llms-course-image llms-placeholder wp-post-image" />' );
		}
	}
	echo '</a>';
}
