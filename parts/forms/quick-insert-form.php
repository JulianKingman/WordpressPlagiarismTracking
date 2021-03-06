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

  // post_status
  // $statuses = piklist_cpt::get_post_statuses_for_type('plagiarism_case', false);
piklist(
	'field', array(
		'scope' => 'post',
		'type'  => 'hidden',
		'field' => 'post_status',
		'value' => 'open',
    // 'label' => 'Status',
    // 'choices' => $statuses
	)
);


  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'post' // post_title is in the wp_posts table, so scope is: post
    ,'field' => 'post_title'
    ,'label' => __('Link', 'piklist-demo')
    ,'attributes' => array(
      'wrapper_class' => 'case-link',
      'class' => 'form-control',     
      'placeholder' => 'Paste link to copied material here...'
    ),
    'required' => true,
  ));


  piklist('field', array(
    'type' => 'text'
    ,'scope' => 'post' // post_title is in the wp_posts table, so scope is: post
    ,'field' => 'original'
    ,'label' => __('Original Source', 'piklist-demo')
    ,'attributes' => array(
      'wrapper_class' => 'case-link',
      'class' => 'form-control',
      'placeholder' => 'Paste book title, article link, etc...'
    ),
    'required' => true,
  ));

  $parents = get_terms(array(
  'taxonomy' => 'case_category'
  ,'hide_empty' => false
  ,'parent' => 0
  ));

  function choices($parent_cats){
    $cats = [];
    $cats[''] = array( '' => 'Select a Category');
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
  // var_dump(choices($parents));

    piklist('field', array(
      'type' => 'select',
      'scope' => 'taxonomy',
      'field' => 'case_category',
      'label' => 'Category',
      'attributes' => array(
        'class' => 'form-control'
      ),
      'choices' => choices($parents),
    'required' => true,
    ));


  piklist('field', array(
    'type' => 'textarea'
    ,'scope' => 'post' // post_title is in the wp_posts table, so scope is: post
    ,'field' => 'post_content'
    ,'label' => __('Notes', 'piklist-demo')
    ,'attributes' => array(
      'wrapper_class' => 'case-link',
      'class' => 'form-control',
      'placeholder' => 'Write notes about the link here'
    )
  ));

  piklist('field', array(
    'type' => 'submit'
    ,'field' => 'submit'
    ,'value' => 'Submit'
  ));
