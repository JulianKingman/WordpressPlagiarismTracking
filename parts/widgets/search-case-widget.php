<?php
/*
Title: Search Case Widget
Description: Search Plagiarism cases
Class: wpt-quick-form-widget
*/

echo $before_widget;
echo $before_title;
echo $after_title;

echo '<h3>Search</h3>';
//echo 'Page ID (from widget settings: '. $settings['shortcode-page'];
echo do_shortcode('[piklist_form form="search-case-form" add_on="WordpressPlagiarismTracking"]');
echo $after_widget;
