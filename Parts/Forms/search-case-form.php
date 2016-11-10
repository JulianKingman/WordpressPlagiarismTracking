<?php
/*
Title: Search Case Form
Method: post
Message: Search successfully
Logged in: true
*/

// echo get_post_stati( $args, $output, $operator );

 $parents = get_terms(array(
 'taxonomy' => 'case_category'
 ,'hide_empty' => false
 ,'parent' => 0
 ));

$case_statuses = array( '' => 'Search by Status' );
foreach ($parents as $parent => $value) {
  $case_statuses = array_merge( $case_statuses, array( $value->term_id => $value->name ) );
  $sub_options = piklist(
     get_terms('case_category', array(
       'hide_empty' => false
       ,'child_of' =>$value->term_id
     )), array(
       'term_id','name'
     )
     );
  $case_statuses = array_merge( $case_statuses, $sub_options );
}

  // Where to save this form, post ID
  piklist('field', array(
    'type' => 'hidden'
    ,'scope' => 'post'
    ,'field' => 'post_type'
    ,'value' => 'plagiarism_case'
  ));

  piklist('field', array(
    'type' => 'select'
    ,'scope' => 'post' // post_status is in the wp_posts
    ,'field' => 'post_status'
    ,'attributes' => array(
      'wrapper_class' => 'case-search',
    ),
    'choices' => $case_statuses
  ));

piklist('field', array(
  'type' => 'select',
  'scope' => 'post_meta',
  'field' => 'assigned_user',
  'attributes' => array(
      'wrapper_class' => 'case-search',
    ),
  'choices' => array(
     '' => 'Seach by Assigned User'
   )
   + piklist(
    get_users(
      array(
       'orderby' => 'display_name'
       ,'order' => 'asc'
      )
      ,'objects'
    )
    ,array(
      'ID'
      ,'display_name'
    )
   )
));

  piklist('field', array(
    'type' => 'select'
    ,'scope' => 'post' // post_status is in the wp_posts
    ,'field' => 'post_author'
    ,'attributes' => array(
      'wrapper_class' => 'case-search',
    ),
  'choices' => array(
     '' => 'Seach by Author'
   )
   + piklist(
    get_users(
      array(
       'orderby' => 'display_name'
       ,'order' => 'asc'
      )
      ,'objects'
    )
    ,array(
      'ID'
      ,'display_name'
    )
   )
));