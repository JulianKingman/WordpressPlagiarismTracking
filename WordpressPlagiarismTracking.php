<?php
/*
Plugin Name: Plagiarism Administration Tools
Plugin URI:
Description: A simple issue tracker for tracking and following up on plagiarism
Version: 0.0.7
Author: Mystics
Author URI: https://github.com/JulianKingman
License: none
GitHub Plugin URI: JulianKingman/WordpressPlagiarismTracking
GitHub Plugin URI: https://github.com/JulianKingman/WordpressPlagiarismTracking
GitHub Branch: master
Plugin Type: Piklist
*/

// add_filter( 'page_template', 'patbp_page_template' );
// function patbp_page_template( $page_template )
// {
//     if ( is_page( 'open-cases' ) ) {
//         $page_template = dirname( __FILE__ ) . '/template-open-cases.php';
//     } else if (is_page('my-cases')){
//       $page_template = dirname( __FILE__ ) . '/template-my-cases.php';
//     }
//     return $page_template;
// }

// ----------------------------------------------------------------------------
// Post type templates
// ----------------------------------------------------------------------------

function wpmystics_plagiarism_case_single($template) {
    global $post;
    // Is this a "plagiarism_case" post?
    if ($post->post_type == "plagiarism_case"){
        //Your plugin path
        $plugin_path = plugin_dir_path( __FILE__ );
        // The name of custom post type single template
        $template_name = 'single-plagiarism_case.php';
        // A specific single template for my custom post type exists in theme folder? Or it also doesn't exist in my plugin?
        if($template === get_stylesheet_directory() . '/' . $template_name
            || !file_exists($plugin_path . $template_name)) {
            //Then return "single.php" or "single-my-custom-post-type.php" from theme directory.
            return $template;
        }
        // If not, return my plugin custom post type template.
        return $plugin_path . $template_name;
    }
    //This is not my custom post type, do nothing with $template
    return $template;
}
add_filter('single_template', 'wpmystics_plagiarism_case_single');

function wpmystics_plagiarism_case_archive( $archive_template ) {
     global $post;

     if ( is_post_type_archive ( 'my_post_type' ) ) {
          $archive_template = dirname( __FILE__ ) . '/post-type-template.php';
     }
     return $archive_template;
}

add_filter( 'archive_template', 'wpmystics_plagiarism_case_archive' ) ;

// ----------------------------------------------------------------------------
// Status taxonomy
// ----------------------------------------------------------------------------

add_action( 'init', 'wpmystics_register_taxonomy' );
// register taxonomy to go with the custom post type
function wpmystics_register_taxonomy() {
	// set up labels
	$labels = array(
		'name'              => 'Case Statuses',
		'singular_name'     => 'Case Status',
		'search_items'      => 'Search Case Statuses',
		'all_items'         => 'All Case Statuses',
		'edit_item'         => 'Edit Case Status',
		'update_item'       => 'Update Case Status',
		'add_new_item'      => 'Add New Case Status',
		'new_item_name'     => 'New Case Status',
		'menu_name'         => 'Case Statuses'
	);
	// register taxonomy
	register_taxonomy( 'status', 'plagiarism_case', array(
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'show_admin_column' => true
	) );
}

add_action ( 'init', 'wpmystics_default_statuses' );
// Populate the statuses when not present
function wpmystics_default_statuses(){

    //see if we already have populated any statuses
    $terms = get_terms ('status', array( 'hide_empty' => false ) );

    //if no terms then lets add the statuses
    if( empty( $terms ) ){
    $terms = array(
        '0' => array( 'name' => 'Open','slug' => 'open'),
        '1' => array( 'name' => 'In Progress','slug' => 'in-progress'),
        '2' => array( 'name' => 'Resolved – attributed in article','slug' => 'resolved–attributed-in-article'),
        '3' => array( 'name' => 'Resolved – attributed via comment','slug' => 'resolved–attributed-via-comment'),
        '4' => array( 'name' => 'Contacted nothing happened','slug' => 'contacted-nothing-happened'),
    	);
        foreach( $terms as $term ){
            if( !term_exists( $term['name'], 'status' ) ){
                wp_insert_term( $term['name'], 'status', array( 'slug' => $term['slug'] ) );
            }
        }
    }

}

// ----------------------------------------------------------------------------
// Register plagiarism_case post type
// ----------------------------------------------------------------------------

// register custom post type to work with
add_action( 'init', 'wpmystics_create_post_type' );
function wpmystics_create_post_type() {
	// set up labels
	$labels = array(
 		'name' => 'Plagiarism Cases',
    	'singular_name' => 'Plagiarism case',
    	'add_new' => 'Add New Plagiarism case',
    	'add_new_item' => 'Add New Plagiarism case',
    	'edit_item' => 'Edit Plagiarism case',
    	'new_item' => 'New Plagiarism case',
    	'all_items' => 'All Plagiarism cases',
    	'view_item' => 'View Plagiarism case',
    	'search_items' => 'Search Plagiarism cases',
    	'not_found' =>  'No Plagiarism cases Found',
    	'not_found_in_trash' => 'No Plagiarism cases found in Trash',
    	'parent_item_colon' => '',
    	'menu_name' => 'Plagiarism Cases',
    );
    //register post type
    //note that hyphens aren't allowed in post type, also renamed to singular
	register_post_type( 'plagiarism_case', array(
		'labels' => $labels,
		'has_archive' => true,
 		'public' => true,
		'supports' => array( 'editor', 'custom-fields', 'thumbnail','page-attributes' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		// 'rewrite' => array( 'slug' => 'plagiarismcases' ),
		)
	);
}


?>
