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
//                  The form
// ------------------------------------------------------- \\

  // Where to save this form, post ID
/*
  piklist('field', array(
    'type' => 'hidden'
 //   ,'scope' => 'post'
    ,'field' => 'post_id'
    ,'value' => '2'
  ));
*/

//link
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'link'
    ,'attributes' => array(
      'wrapper_class' => 'case-search',
      'class' => 'form-control',   
      'placeholder' => 'Link...'
    )

  ));

// status
  piklist('field', array(
    'type' => 'select',
 //   'scope' => 'post_term', // unsure
    'field' => 'status',      // unsure
    'attributes' => array(
      'wrapper_class' => 'case-search',
      'class' => 'form-control'      
    ),
    'choices' => array_merge( array('' => 'Status'), $cpt_statuses)
  ));

// category
  $main_cats = get_terms(array(
  'taxonomy' => 'case_category'
  ,'hide_empty' => false
  ,'parent' => 0
  ));

  function sub_cats($parent_cats){
    $cats = [];
    $cats[''] = array( '' => 'Category');
    foreach ($parent_cats as $parent) {
      $cats[$parent->name] = piklist(
      get_terms('case_category', array(
        'hide_empty' => false
        ,'child_of' =>$parent->term_id
      )), array(
        'term_id','name'
      ));
    }
    return $cats;
  }

  piklist('field', array(
    'type' => 'select'
 //   ,'scope' => 'post_term' // post_status is in the wp_posts
    ,'field' => 'category'
    ,'attributes' => array(
      //'class' => 'form-control',
      'wrapper_class' => 'case-search',
      'class' => 'form-control'
    ),
    'choices' => sub_cats($main_cats)
  ));

//Owner
piklist('field', array(
  'type' => 'select',
//  'scope' => 'post_meta',
  'field' => 'owner',
  'attributes' => array(
      'class' => 'form-control',   
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

/* Author
  piklist('field', array(
    'type' => 'select'
 //   ,'scope' => 'post' // post_status is in the wp_posts
    ,'field' => 'submitter'
    ,'attributes' => array(
      'wrapper_class' => 'case-search',
    ),
  'choices' => array(
     '' => 'Submitter'
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
*/
// Search button
piklist('field', array(
  'type' => 'submit',
  'field' => 'submit',
  'value' => 'Search',
  'attributes' => array(
    'class' => 'wpt-search-submit',
  )
));
