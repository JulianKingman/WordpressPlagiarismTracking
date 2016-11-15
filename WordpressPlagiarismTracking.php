<?php
/*
Plugin Name: Plagiarism Administration Tools
Plugin URI:
Description: A simple issue tracker for tracking and following up on plagiarism
Version: 0.1.14
Author: Mystics
Author URI: https://github.com/JulianKingman
License: none
GitHub Plugin URI: JulianKingman/WordpressPlagiarismTracking
GitHub Plugin URI: https://github.com/JulianKingman/WordpressPlagiarismTracking
GitHub Branch: master
Plugin Type: Piklist
*/

// ----------------------------------------------------------------------------
// Include
// ----------------------------------------------------------------------------
include 'cases-shortcode.php';

// ----------------------------------------------------------------------------
// Enque style
// ----------------------------------------------------------------------------
function wpmystics_enqueue_scripts() {
    wp_register_style( 'prefix-style', plugins_url('style.css', __FILE__) );
    wp_register_style( 'data-tables', 'https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css');
    wp_register_script('wpmystics_scripts', plugins_url('scripts.js', __FILE__), array('jquery'));
    wp_enqueue_style( 'prefix-style' );
    wp_enqueue_style( 'data-tables' );
    wp_localize_script('wpmystics_scripts', 'wpm_Ajax', array(
      'ajaxurl' => admin_url('admin-ajax.php'),
      'nonce' => wp_create_nonce('unique_id_nonce'),// this is a unique token to prevent form hijacking
    ));
    wp_enqueue_script('wpmystics_scripts');
    wp_enqueue_script( 'data-tables-js', 'https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js', array ( 'jquery'), '1.2.3', true);
}
add_action('wp_enqueue_scripts', 'wpmystics_enqueue_scripts');

// ----------------------------------------------------------------------------
// Set specific page templates
// ----------------------------------------------------------------------------
/*
add_filter('page_template', 'wpmystics_open_cases');
function wpmystics_open_cases ( $page_template ){
    if ( is_page( 'open-cases' ) ){
        $page_template = dirname( __FILE__ ) . '/template-open-cases.php';
    }
    return $page_template;
}

add_filter('page_template', 'wpmystics_owner_cases');
function wpmystics_owner_cases ( $page_template ){
  if ( is_page( 'my-assigned-plagiarism-cases' ) ){
    $page_template = dirname( __FILE__ ) . '/archive-plagiarism_case.php';
  }
  return $page_template;
}
*/

// ----------------------------------------------------------------------------
// By default allow comments on plagiarism single case pages
// ----------------------------------------------------------------------------
add_action('init', 'add_cpt_comment_support', 100);

function add_cpt_comment_support()
{
    add_post_type_support('plagiarism_case', 'comments');
}



//add_action( 'piklist_save_field-connect_resource_to_step', 'plagiarism_case', 10, 1 );
function plagiarism_case( $fields ) {
// Manually do some awesomeness
  wp_redirect( 'http://localhost/case-tracker' );
  exit;
}

// ----------------------------------------------------------------------------
// Redirect try but unsuccesfull
// ----------------------------------------------------------------------------
//add_filter( 'piklist_add_part', 'mcw_form_redirect', 10, 2 );
function mcw_form_redirect ( $data, $type ) {
  return 'stuff';
    wp_redirect( 'http://localhost/case-tracker' );
  exit;
  // if not a form then bail
  if ( $type != 'form' ) {
    return $data;
  }
  // check if any page template is set in the comment block
  if ( ( $data['redirect'] ) == '/plagiarism-case/' ) {
    $data['redirect'] = home_url( '/plagiarism-case/' );
  }
  return $data;
}

// this seems to be working as for the redirect :), needs a little more work

//add_action( 'piklist_save_field-post', 'my_grab_new_post_id' );
function my_grab_new_post_id( $fields ) {
//  global $mcw_new_post_id;
  //$my_new_post_id = $fields['ID']['object_id'];
}

// only is fired when a link is clicked, not a form posts with get
// also top menu links are excluded
//add_filter( 'wp_redirect', 'clean_search_url' , 1, 2);
function clean_search_url( $location, $status ) {
  if ( strpos( $location, '?') === FALSE ) {          // not get request was submitted, return location
      return $location;
  }
  else {                                              // URL includes GET, correct url
    $get_parms = substr( $location, strpos($location, '?') );
    return 'localhost/case-tracker/' . $get_parms;
  }
}





// ----------------------------------------------------------------------------
// Post type templates
// ----------------------------------------------------------------------------
function wpmystics_plagiarism_case_single($template)
{
    global $post;
    // Is this a "plagiarism_case" post?
    if ($post->post_type == 'plagiarism_case') {
        //Your plugin path
        $plugin_path = plugin_dir_path(__FILE__);
        // The name of custom post type single template
        $template_name = 'single-plagiarism_case.php';
        // A specific single template for my custom post type exists in theme folder? Or it also doesn't exist in my plugin?
        if ($template === get_stylesheet_directory().'/'.$template_name
            || !file_exists($plugin_path.$template_name)) {
            //Then return "single.php" or "single-my-custom-post-type.php" from theme directory.
            return $template;
        }
        // If not, return my plugin custom post type template.
        return $plugin_path.$template_name;
    }
    //This is not my custom post type, do nothing with $template
    return $template;
}
add_filter('single_template', 'wpmystics_plagiarism_case_single');

function wpmystics_plagiarism_case_archive($archive_template)
{
    global $post;

    if (is_post_type_archive('my_post_type')) {
        $archive_template = dirname(__FILE__).'/post-type-template.php';
    }

    return $archive_template;
}

add_filter('archive_template', 'wpmystics_plagiarism_case_archive');

// ----------------------------------------------------------------------------
// Category taxonomy
// ----------------------------------------------------------------------------


add_filter('piklist_taxonomies', 'wpmystics_register_taxonomy');
 function wpmystics_register_taxonomy($taxonomies)
 {
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
           'slug' => 'case-category',
         ),
       ),
     );

     return $taxonomies;
 }

 // register_activation_hook( __FILE__, 'wpmystics_default_categories' );
 add_action('wp_loaded', 'wpmystics_default_categories');
 // Populate the categories when not present
 function wpmystics_default_categories()
 {

    //  see if we already have populated any categories
     $terms = get_terms('case_category', array('hide_empty' => true));
    //  if no terms then lets add the categories
     if (empty($terms)) {
         $terms = array(
         array('name' => 'Complex Cases','slug' => 'complex'),
         array('name' => 'Posted MLP works','slug' => 'posted-works'),
         array('name' => 'Copied Articles and Parts of Books','slug' => 'copied-parts'),
         );
        //  var_dump($terms); // for some reason this crashes the admin page
         foreach ($terms as $term) {
             //  print($term['name'] & term_exists($term['name'], 'case_category'));
             if (!term_exists($term['name'], 'case_category')) {
                 wp_insert_term($term['name'], 'case_category',
                 array(
                   'slug' => $term['slug'],
                 )
               );
             }
         }
         unset($term);
         $child_terms = array(
           array('name' => 'Books that resemble MLP\'s works','slug' => 'resembles-mlp-works', 'parent' => get_term_by('slug', 'complex', 'case_category')),
           array('name' => 'Courses that resemble Belsebuub\'s work','slug' => 'resembles-belsebuub-works', 'parent' => get_term_by('slug', 'complex', 'case_category')),
           array('name' => 'Other copying that resembles MLP\'s works','slug' => 'resembles-other', 'parent' => get_term_by('slug', 'complex', 'case_category')),
           array('name' => 'eBook(s) posted','slug' => 'posted-ebook', 'parent' => get_term_by('slug', 'posted-works', 'case_category')),
           array('name' => 'Not readily available eBook pdfs posted','slug' => 'posted-ebook-404', 'parent' => get_term_by('slug', 'posted-works', 'case_category')),
           array('name' => 'Old Course PDFs posted','slug' => 'posted-course-pdf', 'parent' => get_term_by('slug', 'posted-works', 'case_category')),
           array('name' => 'Audio and Video','slug' => 'posted-multimedia', 'parent' => get_term_by('slug', 'posted-works', 'case_category')),
           array('name' => '1 to 3 Paragraphs copied','slug' => '3-paragraphs', 'parent' => get_term_by('slug', 'copied-parts', 'case_category')),
           //array('name' => 'Contacted Nothing Happened','slug' => 'contacted-nothing-happened', 'parent' => get_term_by('slug', 'copied-parts', 'case_category')),
           array('name' => '4+ Paragraphs copied','slug' => '4-plus-paragraphs', 'parent' => get_term_by('slug', 'copied-parts', 'case_category')),
           //array('name' => 'Resolved – 1 to 3 Paragraphs','slug' => '3-paragraphs-resolved', 'parent' => get_term_by('slug', 'copied-parts', 'case_category')),
           //array('name' => 'Resolved – 4 + paragraphs','slug' => '4-plus-paragraphs-resolved', 'parent' => get_term_by('slug', 'copied-parts', 'case_category')),
           array('name' => 'Articles on Waking Times reposted – attribution not ideal','slug' => 'attribution-not-ideal', 'parent' => get_term_by('slug', 'copied-parts', 'case_category')),
       );
         foreach ($child_terms as $term) {
             //  print($term['name'] & term_exists($term['name'], 'case_category'));
             var_dump();
             if (!term_exists($term['name'], 'case_category')) {
                 wp_insert_term($term['name'], 'case_category',
                 array(
                   'slug' => $term['slug'],
                   'parent' => $term['parent']->term_id,
                 )
               );
             }
         }
         unset($term);
     }
 }

// automatically set parent category

add_action('save_post', 'wpmystics_assign_parent_terms', 10, 2);

function wpmystics_assign_parent_terms($post_id, $post)
{
    if ($post->post_type != 'plagiarism_case') {
        return $post_id;
    }

    // get all assigned terms
    $terms = wp_get_post_terms($post_id, 'case_category');
    foreach ($terms as $term) {
        while ($term->parent != 0 && !has_term($term->parent, 'case_category', $post)) {
            // move upward until we get to 0 level terms
            wp_set_post_terms($post_id, array($term->parent), 'case_category', true);
            $term = get_term($term->parent, 'case_category');
        }
    }

    //check if they have meta fields
    if(!get_post_meta($post_id, 'original')){
      // $sources = array('eBook', 'article', 'blog post', 'book', 'video', 'audio');
      //$sources[rand(0,5)]
      add_post_meta($post_id, 'original', '');
    }
    if(!get_post_meta($post_id, 'assigned_user')){
      // rand(1,7)
      add_post_meta($post_id, 'assigned_user', 1);
    }
}

// ----------------------------------------------------------------------------
// Quick insert form ajax
// ----------------------------------------------------------------------------
//for logged out users
// add_action('wp_ajax_nopriv_quick_insert', 'wpmystics_quick_insert');
// for logged in users
add_action('wp_ajax_quick_insert', 'wpmystics_quick_insert');

function wpmystics_quick_insert()
{
    $params = array();
    parse_str($_POST['formData'], $params);
    // print_r($params);
    $post_type = $params['_post']['post_type'];
    $link = $params['_post']['post_title'];
    $status = $params['_post']['post_status'];
    $notes = $params['_post']['post_content'];
    $original = $params['_post']['original'];
    $categories = $params['_taxonomy']['case_category'];
    // print_r(array($post_type, $link, $status, $notes, $original, $categories));
    $post_id = wp_insert_post(
        array(
          post_type => $post_type,
          post_content => $notes,
          post_title => $link,
          post_status => $status,
          tax_input => array(
            'case_category' => $categories
          ),
          'meta_input'   => array(
              'original' => $original,
              'assigned_user' => null
          ),
      )
    );
    echo get_the_permalink($post_id);
    // clean_post_cache($post_id);
    // add_post_meta( $post_id, 'assigned_user', '', true );
    // redirect_post($post_id);
    die();
}

// ----------------------------------------------------------------------------
// Register plagiarism_case post type
// ----------------------------------------------------------------------------


add_filter('piklist_post_types', 'wpmystics_create_post_type');
  function wpmystics_create_post_type($post_types)
  {
      $post_types['plagiarism_case'] = array(
      'labels' => piklist('post_type_labels', 'Plagiarism Case')
      ,'title' => __('Enter a new Plagiarism Case Link')
      ,'menu_icon' => 'dashicons-shield-alt'
      ,'page_icon' => 'dashicons-shield-alt'
      ,'supports' => array(
        'title'
        , 'editor'
        , 'custom-fields'
        , 'thumbnail'
        , 'page-attributes',
      )
      ,'public' => true
      ,'admin_body_class' => array(
        // 'custom-body-class'
      )
      ,'has_archive' => true
      ,'rewrite' => array(
        'slug' => 'plagiarism-case',
      )
      ,'capability_type' => 'post'
      ,'edit_columns' => array(
        'title' => __('Link')
        ,'author' => __('Entered by'),
      )
      ,'hide_meta_box' => array(
        'author',
      )
      ,'status' => array(
        'open' => array(
          'label' => 'Open'
          ,'public' => true,
        )
        ,'draft' => array(
          'label' => 'Draft'
          ,'public' => true,
        )
        ,'in_progress' => array(
          'label' => 'In Progress'
          ,'public' => true,
        )
        ,'contacted' => array(
          'label' => 'Contacted nothing happened'
          ,'public' => true,
          // ,'exclude_from_search' => true
          // ,'show_in_admin_all_list' => true
          // ,'show_in_admin_status_list' => true
       )
        ,'resolved' => array(
          'label' => 'Resolved'
          ,'public' => true,
        )
        ,'resolved-comment' => array(
          'label' => 'Resolved - attributed via comment',
        ),
      ),
    );

      return $post_types;
  }

// ----------------------------------------------------------------------------
// custom post plagiarism_case statuses var
// ----------------------------------------------------------------------------


global $cpt_statuses;
$cpt_statuses = array(
  'open' => 'Open',
  'in_progress' => 'In Progress',
  'contacted' => 'Contacted nothing happened',
  'resolved' => 'Resolved',
  'resolved-comment' => 'Resolved - attributed via comment', );
