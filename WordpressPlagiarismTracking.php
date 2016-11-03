<?php
/*
Plugin Name: Plagiarism Administration Tools
Plugin URI:
Description: A simple issue tracker for tracking and following up on plagiarism
Version: 0.0.8
Author: Mystics
Author URI: https://github.com/JulianKingman
License: none
GitHub Plugin URI: JulianKingman/WordpressPlagiarismTracking
GitHub Plugin URI: https://github.com/JulianKingman/WordpressPlagiarismTracking
GitHub Branch: master
Plugin Type: Piklist
*/

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


add_filter('piklist_taxonomies', 'wpmystics_register_taxonomy');
 function wpmystics_register_taxonomy($taxonomies) {
    $taxonomies[] = array(
       'post_type' => 'plagiarism_case'
       ,'name' => 'case_category'
       ,'show_admin_column' => true
       ,'configuration' => array(
         'hierarchical' => true
         ,'labels' => piklist('taxonomy_labels', 'Case Category')
         ,'hide_meta_box' => true
         ,'show_ui' => true
         ,'query_var' => true
         ,'rewrite' => array(
           'slug' => 'case-category'
         )
       )
     );
   return $taxonomies;
 }
 add_action ( 'init', 'wpmystics_default_categories' );
 // Populate the categories when not present
 function wpmystics_default_categories(){

    //  see if we already have populated any statuses
     $terms = get_terms ('case_category', array( 'hide_empty' => false ) );
    //  if no terms then lets add the statuses
     if( empty( $terms ) ){
     $terms = array(
         '0' => array( 'name' => 'Complex Cases','slug' => 'complex'),
         '1' => array( 'name' => 'Posted MLP works','slug' => 'posted-works'),
         '2' => array( 'name' => 'Copied Articles and Parts of Books','copied-parts' => 'resolved–attributed-in-article'),
     	);
         foreach( $terms as $term ){
             if( !term_exists( $term['name'], 'case_category' ) ){
                 wp_insert_term( $term['name'], 'case_category', array( 'slug' => $term['slug'] ) );
             }
         }
     }

 }

// add_action( 'init', 'wpmystics_register_taxonomy' );
// register taxonomy to go with the custom post type
// function wpmystics_register_taxonomy() {
	// set up labels
// 	$labels = array(
// 		'name'              => 'Case Statuses',
// 		'singular_name'     => 'Case Status',
// 		'search_items'      => 'Search Case Statuses',
// 		'all_items'         => 'All Case Statuses',
// 		'edit_item'         => 'Edit Case Status',
// 		'update_item'       => 'Update Case Status',
// 		'add_new_item'      => 'Add New Case Status',
// 		'new_item_name'     => 'New Case Status',
// 		'menu_name'         => 'Case Statuses'
// 	);
// 	// register taxonomy
// 	register_taxonomy( 'status', 'plagiarism_case', array(
// 		'hierarchical' => true,
// 		'labels' => $labels,
// 		'query_var' => true,
// 		'show_admin_column' => true
// 	) );
// }

// add_action ( 'init', 'wpmystics_default_statuses' );
// Populate the statuses when not present
// function wpmystics_default_statuses(){

    //see if we already have populated any statuses
    // $terms = get_terms ('status', array( 'hide_empty' => false ) );

    //if no terms then lets add the statuses
    // if( empty( $terms ) ){
    // $terms = array(
    //     '0' => array( 'name' => 'Open','slug' => 'open'),
    //     '1' => array( 'name' => 'In Progress','slug' => 'in-progress'),
    //     '2' => array( 'name' => 'Resolved – attributed in article','slug' => 'resolved–attributed-in-article'),
    //     '3' => array( 'name' => 'Resolved – attributed via comment','slug' => 'resolved–attributed-via-comment'),
    //     '4' => array( 'name' => 'Contacted nothing happened','slug' => 'contacted-nothing-happened'),
    // 	);
    //     foreach( $terms as $term ){
    //         if( !term_exists( $term['name'], 'status' ) ){
    //             wp_insert_term( $term['name'], 'status', array( 'slug' => $term['slug'] ) );
    //         }
    //     }
    // }

// }

// ----------------------------------------------------------------------------
// Register plagiarism_case post type
// ----------------------------------------------------------------------------

add_filter('piklist_post_types', 'wpmystics_create_post_type');
  function wpmystics_create_post_type($post_types)
  {
    $post_types['plagiarism_case'] = array(
      'labels' => piklist('post_type_labels', 'Plagiarism Case')
      ,'title' => __('Enter a new Plagiarism Case Link')
      ,'menu_icon' => 'dashicons-welcome-view-site'
      ,'page_icon' => 'dashicons-welcome-view-site'
      ,'supports' => array(
        'title'
        , 'editor'
        , 'custom-fields'
        , 'thumbnail'
        , 'page-attributes'
      )
      ,'public' => true
      ,'admin_body_class' => array(
        // 'custom-body-class'
      )
      ,'has_archive' => true
      ,'rewrite' => array(
        'slug' => 'plagiarism-case'
      )
      ,'capability_type' => 'post'
      ,'edit_columns' => array(
        'title' => __('Link')
        ,'author' => __('Entered by')
      )
      ,'hide_meta_box' => array(
        ,'author'
      )
      ,'status' => array(
        'open' => array(
          'label' => 'Open'
          ,'public' => true
        )
        ,'in_progress' => array(
          'label' => 'In Progress'
          ,'public' => true
        )
        ,'contacted' => array(
          'label' => 'Contacted nothing happened'
          ,'public' => true
          // ,'exclude_from_search' => true
          // ,'show_in_admin_all_list' => true
          // ,'show_in_admin_status_list' => true
       )
        ,'resolved' => array(
          'label' => 'Resolved'
          ,'public' => true
        )
      )
    );
    return $post_types;
  }


?>
