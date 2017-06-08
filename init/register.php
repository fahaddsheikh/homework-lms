<?php
// Register Custom Post Types
function hl_register_homework_course() {
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
	register_post_type( 'homework-course', $args );
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
	register_taxonomy( 'homework-course-category', array( 'homework-course' ), $args );
}
add_action( 'init', 'hl_register_homework_course', 0 );
/**
 * Register Batch meta boxes in Courses.
 */
function hl_batch_meta_boxes() {
	add_meta_box( 'create_batch_metabox', __( 'Create a new batch', 'textdomain' ), 'hl_create_batch', 'homework-course' );
    add_meta_box( 'show_batch_metabox', __( 'Existing Batches for this course', 'textdomain' ), 'hl_show_batch', 'homework-course' );
}
add_action( 'add_meta_boxes', 'hl_batch_meta_boxes' );
/**
 * Assign templates for single and archive courses
 */
function hl_assign_course_templates( $archive_template ) {
    global $post;
    if ( is_post_type_archive ( 'homework-course' ) || is_search() && $_POST['post_type'] == 'homework-course' || is_tax( 'offline_course_cat' )) {
       	$archive_template = dirname( __FILE__ ) . '/archive-offline-courses.php';    
    }
    
    if ($post->post_type == 'homework-course' && is_single( )) {
        $archive_template = dirname( __FILE__ ) . '/single-offline-course.php';
    }
   	return $archive_template;
}
add_filter( 'archive_template', 'hl_assign_course_templates' );
add_filter( 'single_template', 'hl_assign_course_templates' );
add_filter( 'template_include', 'hl_assign_course_templates', 99 );