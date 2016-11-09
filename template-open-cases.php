<?php
/**
 * @package WordPress
 * Template Name: Open Plagiarism Cases
 */
?>
<style>
.box {
  padding: 10px 20px;
  margin: 20px;
  border: 1px solid #222223;
  display: inline-block;
  background-color: #d1d3d6;
}
.box:hover {
  background-color: #e8e8e8;
}
ul {
    list-style-type: disc !important;
}
li {
    margin-left: 20px;
}

</style>
<?php
    function archive_meta_query( $query ) {
        if ( $query->is_archive){
          $query->query_vars["meta_key"] = 'owner';
          $query->query_vars["meta_value"] = 'rscheffers';
        }
    }
//add_action( 'pre_get_posts', 'archive_meta_query', 1 );

add_action( 'pre_get_posts', 'custom_post_type_archive' );

function custom_post_type_archive( $query ) {

if( $query->is_main_query() && !is_admin() && is_post_type_archive( 'plagiarism_case' ) ) {

        $query->set( 'posts_per_page', '6' );
        $query->set( 'post_status', 'in_progress');
        //$query->set( 'orderby', 'title' );
        //        $query->set( 'order', 'DESC' );
    }

}

?>

<?php
    get_header();
/* -- Use for displaying open tickets
$status = 'open'
$args = array( 'post_type' => 'plagiarism_case',
                'post_status' => $status);
*/
// -- Use for displaying open tickets
$status = 'open';
$args = array( 'post_type' => 'plagiarism_case',
                'post_status' => $status);


// Variable to call WP_Query.
$the_query = new WP_Query( $args );
//$the_query = new WP_Query( ); 
if ( $the_query->have_posts() ) :
    // Start the Loop
    while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <div class="box">
        Status: <?php echo get_post_status( $post->ID ); ?>
        <br> Post ID: <?php print($post->ID); ?>
        <br> <?php echo get_the_date(); ?>, <?php the_time(); ?>
        <br> Title: <?php the_title(); ?>
        <br> Exceprt <?php the_excerpt(); ?>
        <br> Publisher: <?php the_author(); ?>
        <br> Category: <br><ul><?php
            $cats = get_the_terms( $post->ID, 'case_category');
            if ($cats == false) echo '<ul><li>none</li></ul>';
            foreach($cats as $cat) {
                echo '<li>' . $cat->name . '</li>';
            }
           // $category_detail=get_the_category( $post->ID );//$post->ID
          //  var_dump($category_detail);
          //  foreach($category_detail as $cd){
         //   echo $cd->cat_name;
        //    }

        //wp_get_post_categories( get_the_ID() );
            ?>
            </ul>
        <br> Meta data: <?php the_meta(); ?>
        <br> <?php the_shortlink('click to view'); ?>
        </div>
<?php     // End the Loop
    endwhile; 
    wp_reset_postdata();
else :
    // If no posts match this query, output this text.
    _e( 'Sorry, no posts matched your criteria.', 'textdomain' );
endif;

    get_footer(); 
?>

