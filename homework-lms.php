<?php
/*
 Plugin Name: Homework LMS
 Description: A plugin which allows you to create courses and accept registrations for it.
 Version: 0.2
 Author: Fahad Sheikh
 License: GPL2
*/

// Register All Post types and Meta Boxes
include( plugin_dir_path( __FILE__ ) . 'init/register.php');
// Content callbacks for all metaboxes 
include( plugin_dir_path( __FILE__ ) . 'init/content-callbacks.php');

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
                 
 