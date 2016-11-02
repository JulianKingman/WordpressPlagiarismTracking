<?php
/*
Plugin Name: Plagiarism Administration Tools
Plugin URI:
Description:
Version: 0.0.3
Author: Mystics
Author URI:
Plugin Type: Piklist
License: none
GitHub Plugin URI: JulianKingman/WordpressPlagiarismTracking
*/

add_filter( 'page_template', 'patbp_page_template' );
function patbp_page_template( $page_template )
{
    if ( is_page( 'open-cases' ) ) {
        $page_template = dirname( __FILE__ ) . '/template-open-cases.php';
    } else if (is_page('my-cases')){
      $page_template = dirname( __FILE__ ) . '/template-my-cases.php';
    }
    return $page_template;
}

?>
