<?php
/*
Title: Search Case Widget
Description: Quickly add cases from the sidebar
Class: wpt-quick-form-widget
*/

echo $before_widget;
echo $before_title;
echo $after_title;
echo do_shortcode('[piklist_form form="search-case-form" add_on="WordpressPlagiarismTracking"]');
echo $after_widget;
