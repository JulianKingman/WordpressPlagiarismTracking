<?php
/*
Title: Search Case Form
Method: get
Message: Search successfully
Logged in: true
*/

// load plagiarism_case statuses from the plugin file
global $cpt_statuses;

// ------------------------------------------------------- \\
//                Prepare data
// ------------------------------------------------------- \\

$case_cats = array();

$parents = get_terms(array(
  'taxonomy' => 'case_category'
  ,'hide_empty' => false
  ,'parent' => 0
));

foreach ($parents as $parent => $value) {
  $case_cats = array_merge( $case_cats, array( $value->term_id => $value->name ) );
  $sub_options = piklist(
     get_terms('case_category', array(
       'hide_empty' => false
       ,'child_of' =>$value->term_id
     )), array(
       'term_id','name'
     )
  );
  $case_cats = array_merge( $case_cats, $sub_options );
}

// ------------------------------------------------------- \\
//                  The form
// ------------------------------------------------------- \\

  // Where to save this form, post ID
  piklist('field', array(
    'type' => 'hidden'
    ,'scope' => 'post'
    ,'field' => 'post_type'
    ,'value' => 'plagiarism_case'
  ));


//link
  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'post' // post_title is in the wp_posts
    ,'field' => 'copied_link'
    ,'attributes' => array(
      'wrapper_class' => 'case-search',
      'placeholder' => 'Link'
    )

  ));

// status
  piklist('field', array(
    'type' => 'select',
    'scope' => 'post_term', // unsure
    'field' => 'status',      // unsure
    'attributes' => array(
      'wrapper_class' => 'case-search',
    ),
    'choices' => array_merge( array('' => 'Status'), $cpt_statuses)
  ));

// category
  piklist('field', array(
    'type' => 'select'
    ,'scope' => 'post_term' // post_status is in the wp_posts
    ,'field' => 'category'
    ,'attributes' => array(
      'wrapper_class' => 'case-search',
    ),
    'choices' => array_merge( array( '' => 'Category' ), $case_cats )
  ));

piklist('field', array(
  'type' => 'select',
  'scope' => 'post_meta',
  'field' => 'assigned_user',
  'attributes' => array(
      'wrapper_class' => 'case-search',
    ),
  'choices' => array(
     '' => 'Assigned User'
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

// Author
  piklist('field', array(
    'type' => 'select'
    ,'scope' => 'post' // post_status is in the wp_posts
    ,'field' => 'post_author'
    ,'attributes' => array(
      'wrapper_class' => 'case-search',
    ),
  'choices' => array(
     '' => 'Author'
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

// Search button
piklist('field', array(
  'type' => 'submit',
  'field' => 'submit',
  'value' => 'Search',
  'attributes' => array(
    'wrapper_class' => 'case-search',
  )
));