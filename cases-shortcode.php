<?php
// Add Shortcode
function cases_shortcode() {

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
<table class="">
<tr>
  <th>Link</th>
  <th>Status</th>
  <th>Source</th>
  <th>Category</th>
  <th>Date</th>
  <th>Assigned</th>
  <th>Author</th>
  <th>Go</th>
</tr>
<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
  <tr>
    <td><?php the_title(); ?></td>
    <td><?php echo get_post_status( $post->ID ); ?></td>
    <td><?php echo get_post_meta(get_the_ID(), 'original', true) ?></td>
    <td><?php echo get_the_date(); ?></td>
    <td><?php
    $cats = get_the_terms( $post->ID, 'case_category');
    if ($cats == false) echo '<ul><li>none</li></ul>';
    foreach($cats as $cat) {
      echo $cat->name . ', ';
    }
    ?></td>
    <td>Assigned</td>
    <td><?php the_author(); ?></td>
    <td><?php the_shortlink('click to view'); ?></td>
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
