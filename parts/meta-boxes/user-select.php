<?php
/*
Title: User Select
Post Type: plagiarism_case
*/
 ?>

 <?php

 piklist('field', array(
  'type' => 'radio'
  ,'field' => 'assigned_user'
  ,'label' => 'Assign a user'
  ,'attributes' => array(
    'class' => 'text'
  )
  ,'choices' => array(
     '' => 'Assign User'
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

  ?>
