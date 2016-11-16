<?php
/*
Title: Plagiarism source link
Post Type: plagiarism_case
Capability: edit_plagiarism_cases
*/
/*
piklist('field', array(
	'type' => 'text',
	'field' => 'copied',
	'label' => 'COPIED: ',
//	'required' => 'true',
));
*/
piklist('field', array(
	'type' => 'text',
	'field' => 'original',
	'label' => 'Original link: ',
	'help' => 'Link to the article, book or page that is plagiarised',
	'capability' => 'edit_plagiarism_cases'
//	'required' => 'true',
));

?>
