<?php
/*
Title: Case Category
Post Type: plagiarism_case
*/
 ?>

 <?php

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
     )
   ));
 }

  ?>
