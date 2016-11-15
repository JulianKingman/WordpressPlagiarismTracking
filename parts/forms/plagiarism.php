<?php
/*
Title: Plagiarism-info
Method: post
Logged in: true
Message: Data saved.
*/

//-Post Type: post, page
// load wordpress users
$users = get_users();
$users_names = array();
// Array of WP_User objects.
foreach ( $users as $user ) {
	$users_names[$user->display_name] = $user->display_name;
}

$current_user = wp_get_current_user();

// edit options
/*
if ( isset( $_GET['_post'] ) ) {
   $post_id = $_GET['_post']['ID']; // Get Post ID
   print('within the first get');
   $post_author_id = get_post_field( 'post_author', $post_id ); // Get Author ID

   $user_id = get_current_user_id(); // Get logged in user ID

   if($user_id == $post_author_id)
   {
   	 print('I\'m the poster<br>');
   	 print_r($post_id);
     // Show form
   }
 }
*/
/******* This section here is what you require ********/
// How to save this form. in post-meta table with plagiarism post type
piklist('field', array(
	'type' => 'hidden',
	'scope' => 'post',
	'field' => 'post_type',
	'value' => 'plagiarism'
));
/***************/

// add post_status
piklist('field', array(
	'scope' => 'post',
	'type'  => 'hidden',
	'field' => 'post_status',
	'value' => 'publish'
));


//print('users_names<br>');
//print_r($users_names);
//print_r($users);

piklist('field', array(
	'type' => 'text',
	'field' => 'copied',
	'label' => 'COPIED: ',
	'required' => 'true',
	'scope' => 'post_meta'
));

piklist('field', array(
	'type' => 'text',
	'field' => 'original',
	'label' => 'ORIGINAL: ',
	'required' => 'true',
	'scope' => 'post_meta'
));

piklist('field', array(
	'type' => 'select',
	'field' => 'category',
	'label' => 'Select category: ',
	'choices' => array(
		'1-3' => '1-3 paragraphs',
		'4+' => '4+ paragraphs',
	),
	'required' => 'true',
	'scope' => 'post_meta'
));

piklist('field', array(
	'type' => 'select',
	'field' => 'status',
	'label' => 'Select status: ',
	'choices' => array(
		'unassigned' => 'Unassigned',
		'inprogress' => 'In progress',
		'resolved' => 'Resolved'
	),
	'required' => 'true',
	'scope' => 'post_meta'
));

piklist('field', array(
	'type' => 'select',
	'field' => 'assigned_user',
	'label' => 'Assigned User: ',
	'choices' => array( 'no-owner' => 'None', $current_user->display_name => $current_user->display_name ), //$users_names ),
	'required' => 'true',
	'scope' => 'post_meta'
));

piklist('field', array(
	'type' => 'checkbox',
	'field' => 'checkbox',
	'label' => 'Checkbox',
	'value' => 'third', // set default value
	'choices' => array(
		'first' => 'First Choice',
		'second' => 'Second Choice',
		'third' => 'Third Choice'
	),
	'scope' => 'post_meta'
));

piklist('field', array(
	'type' => 'textarea',
	'field' => 'comment',
	'label' => 'Comment',
	'attributes' => array(
		'rows' => 5,
		'cols' => 50,
		'class' => 'large-text'
	),
	'scope' => 'post_meta'
));

// added to highlight which IDs are plagiarism case related data
/* optional, in case it would make things easier for the query
piklist('field', array(
	'type' => 'hidden',
	'scope' => 'post_meta',
	'field' => 'plagiarism',
	'value' => 'true'
));
*/

// Submit button
piklist('field', array(
	'type' => 'submit',
	'field' => 'submit',
	'value' => 'Submit'
));

/*
piklist('field', array(
    'type' => 'group'
    'field' => 'PS-group',
    'label' => __('Plagiarism group', 'piklist-demo'),
    'list' => false,
    'description' => __('A grouped field with a key set. Data is not searchable, since it is saved in an array.', 'piklist-demo'),
    'fields' => array();
 ));
*/

?>
