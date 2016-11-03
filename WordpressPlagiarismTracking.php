<?php
/*
Plugin Name: Plagiarism Administration Tools
Plugin URI:
Description:
Version: 0.0.3
Author: Mystics
Author URI:
Plugin Type: Piklist
License: none
GitHub Plugin URI: JulianKingman/WordpressPlagiarismTracking
*/

add_filter( 'page_template', 'patbp_page_template' );
function patbp_page_template( $page_template )
{
    if ( is_page( 'open-cases' ) ) {
        $page_template = dirname( __FILE__ ) . '/template-open-cases.php';
    } else if (is_page('my-cases')){
      $page_template = dirname( __FILE__ ) . '/template-my-cases.php';
    }
    return $page_template;
}


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
	register_taxonomy( 'status', 'plagiarism-cases', array(
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'show_admin_column' => true
	) );
}

add_action ( 'init', 'check_status_type_terms' );
// Populate the statuses when not present
function check_status_type_terms(){
   
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
	register_post_type( 'plagiarism-cases', array(
		'labels' => $labels,
		'has_archive' => true,
 		'public' => true,
		'supports' => array( 'editor', 'custom-fields', 'thumbnail','page-attributes' ),
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'plagiarism-cases' ),
		)
	);
}


?>
