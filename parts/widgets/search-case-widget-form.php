<?php

  piklist('field', array(
    'type' => 'select'
    ,'field' => 'shortcode-page'
    ,'label' => __('Display results on', 'WordpressPlagiarismTracking')
    ,'value' => 'Lorem'
    ,'help' => __('Add shortcode [plagiarism_cases] to page', 'WordpressPlagiarismTracking')
    ,'choices' => piklist(
      get_pages($args), array('ID','post_title')
    )
  ));

?>