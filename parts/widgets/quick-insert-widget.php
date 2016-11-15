<?php
/*
Title: Quick Insert Widget
Description: Quickly add cases from the sidebar
Class: wpt-quick-form-widget
*/

echo $before_widget;
echo $before_title;
echo $after_title;

echo '<h3>Add Case</h3>';
echo do_shortcode('[piklist_form form="quick-insert-form" add_on="WordpressPlagiarismTracking"]');
echo $after_widget;
