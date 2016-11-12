<?php
// Add Shortcode
function cases_shortcode() {


//echo '<br>Only the _post part below: <br>';
echo 'link: ' . $_GET['link'];
echo '<br>status: ' . $_GET['status'];
echo '<br>category: ' . $_GET['category'];
echo '<br>owner: ' . $_GET['owner'];
echo '<br>submitter: ' . $_GET['submitter'];


  // function filter_by_post_category( $query ) {
  //   if ( $query->is_archive){
  //     $query->query_vars["term_id"] = '1 to 3 Paragraphs copied';
      // $query->query_vars["meta_value"] = '1';
  //   }
  // }
  // add_action( 'pre_get_posts', 'filter_by_post_category', 1 );

  /*
  function filter_by_post_author( $query ) {
  if ( $query->is_archive){
  $query->query_vars["meta_key"] = 'assigned_user';
  $query->query_vars["meta_value"] = '1';
}
}
*/
//add_action( 'pre_get_posts', 'filter_by_post_author', 1 );
// -- use args to filter different types of plagiarism cases
$args = array( 'post_type' => 'plagiarism_case' );
//$args['post_author'] = $_GET['author'];
//$args['post_status'] = $_GET['status'];
//$args['post_type'] = $_GET['cat'];

//echo get_post_terms

//$args.push( 'post_category') => $_GET['cat'] );
//$_GET['owner']
//$_GET['author']
$filter_options = "<br>
   Owner: rscheffers<br>
   Category: 1-4 paragraphs<br>";
?>

<div class="wpt-case-filters">
  filters applied: <?php echo $filter_options; ?>
</div>
<?php


// Variable to call WP_Query.
$the_query = new WP_Query( $args );
//$the_query = new WP_Query( );
if ( $the_query->have_posts() ) :
// experiment with $_GET
// if ( !empty($_GET) ){
//   echo $_GET['cat'] . '<br>';             // post_ID, terms & term_relationships
//   echo $_GET['status'] . '<br>';          // post
//   echo $_GET['owner'] . '<br>';           // postmeta
//   echo $_GET['author'] . '<br>';          // post
// } else {
//   echo 'get not specified';
// }
// Start the Loop
?>
<table class="plagiarism-cases-table">
<tr>
  <th>Status</th>
  <th>Owner</th>  
  <th>Category</th>
  <th>Links</th>
  <th>Date</th> 
  <th>Submitter</th>
  <th>Go</th>
</tr>
<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
  <tr>  
    <!-- Status -->
    <td><?php echo get_post_status( $post->ID ); ?></td>

    <!-- Owner -->    
    <td><?php echo get_post_meta(get_the_ID(), 'assigned_user', true) ?></td>

    <!-- Category -->
    <td><?php
      $cats = get_the_terms( $post->ID, 'case_category');
      if ($cats == false) echo '<ul><li>none</li></ul>';
      foreach($cats as $cat) {
        echo $cat->name . ', ';
      }
    ?></td>

    <!-- Links, copied and original -->
    <td>
      COPIED: <?php the_title(); ?><br>
      ORIGINAL: <?php echo get_post_meta(get_the_ID(), 'original', true) ?>
    </td>
    
    <!-- Date -->
    <td><?php echo get_the_date('M j, Y'); ?> @ <?php the_time(); ?></td>

    <!-- Author -->
    <td><?php the_author(); ?></td>
    <td><?php the_shortlink('view'); ?></td>
  </tr>
  <!-- // $category_detail=get_the_category( $post->ID );//$post->ID
  //  var_dump($category_detail);
  //  foreach($category_detail as $cd){
  //   echo $cd->cat_name;
  //    }

  //wp_get_post_categories( get_the_ID() );
  ?> -->
<?php     // End the Loop
endwhile;
wp_reset_postdata();
else :
// If no posts match this query, output this text.
_e( 'Sorry, no posts matched your criteria.', 'textdomain' );
endif;
?>
</table>
<?php
}
add_shortcode( 'plagiarism_cases', 'cases_shortcode' );
?>
