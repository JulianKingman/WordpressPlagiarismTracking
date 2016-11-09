<?php
/*
Plugin Name: Plagiarism Administration Tools
Plugin URI:
Description: A simple issue tracker for tracking and following up on plagiarism
Version: 0.0.15
Author: Mystics
Author URI: https://github.com/JulianKingman
License: none
GitHub Plugin URI: JulianKingman/WordpressPlagiarismTracking
GitHub Plugin URI: https://github.com/JulianKingman/WordpressPlagiarismTracking
GitHub Branch: master
Plugin Type: Piklist
*/

// ----------------------------------------------------------------------------
// Enque style
// ----------------------------------------------------------------------------
function wpmystics_enqueue_scripts() {
    wp_enqueue_style( 'style-name', plugin_dir_path(__FILE__) . 'style.css' );
    wp_enqueue_script( 'script-name', plugin_dir_path(__FILE__) . '/scripts.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );


// ----------------------------------------------------------------------------
// Set specific page templates
// ----------------------------------------------------------------------------

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
           array('name' => 'Contacted Nothing Happened','slug' => 'contacted-nothing-happened', 'parent' => get_term_by('slug', 'copied-parts', 'case_category')),
           array('name' => '4 + Paragraphs copied','slug' => '4-plus-paragraphs', 'parent' => get_term_by('slug', 'copied-parts', 'case_category')),
           array('name' => 'Resolved – 1 to 3 Paragraphs','slug' => '3-paragraphs-resolved', 'parent' => get_term_by('slug', 'copied-parts', 'case_category')),
           array('name' => 'Resolved – 4 + paragraphs','slug' => '4-plus-paragraphs-resolved', 'parent' => get_term_by('slug', 'copied-parts', 'case_category')),
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
