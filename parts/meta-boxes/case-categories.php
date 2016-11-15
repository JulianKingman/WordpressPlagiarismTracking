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

 function choices($parent_cats){
   $cats = [];
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

  ?>
