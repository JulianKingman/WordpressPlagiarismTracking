<?php
/*
Title: Quick Insert Form
Method: post
Message: Added case successfully
Logged in: true
*/

  // Where to save this form
  piklist('field', array(
    'type' => 'hidden'
    ,'scope' => 'post'
    ,'field' => 'post_type'
    ,'value' => 'plagiarism_case'
  ));


  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'post' // post_title is in the wp_posts table, so scope is: post
    ,'field' => 'post_title'
    ,'label' => __('Link', 'piklist-demo')
    ,'attributes' => array(
      'wrapper_class' => 'case-link',
      'placeholder' => 'Paste link here...'
    ),
    'required' => true,
  ));

  $parents = get_terms(array(
  'taxonomy' => 'case_category'
  ,'hide_empty' => false
  ,'parent' => 0
  ));

  foreach ($parents as $parent => $value) {
    piklist('field', array(
      'type' => 'checkbox',
      'scope' => 'taxonomy',
      'field' => 'case_category',
      'label' => $value->name,
      'attributes' => array(
        'class' => 'form-control'
      ),
      'choices' => piklist(
      get_terms('case_category', array(
        'hide_empty' => false
        ,'child_of' =>$value->term_id
      )), array(
        'term_id','name'
      )
    ),
    'required' => true,
    ));
  }


  piklist('field', array(
    'type' => 'textarea'
    ,'scope' => 'post' // post_title is in the wp_posts table, so scope is: post
    ,'field' => 'post_content'
    ,'label' => __('Notes', 'piklist-demo')
    ,'attributes' => array(
      'wrapper_class' => 'case-link',
      'placeholder' => 'Write notes about the link here'
    )
  ));

  piklist('field', array(
    'type' => 'submit'
    ,'field' => 'submit'
    ,'value' => 'Submit'
  ));
