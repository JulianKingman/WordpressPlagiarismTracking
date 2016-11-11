<?php
/**
 * @package WordPress
 * Template Name: Open Plagiarism Cases
 */
?>
<?php
function filter_by_assigned_user( $query ) {
        if ( $query->is_archive){
          $query->query_vars["meta_key"] = 'assigned_user';
          $query->query_vars["meta_value"] = '1';
        }
    }
add_action( 'pre_get_posts', 'filter_by_assigned_user', 1 );

/*function filter_by_post_status( $query ) {
        if ( $query->is_archive){
          $query->query_vars["meta_key"] = 'assigned_user';
          $query->query_vars["meta_value"] = '1';
        }
    }
*/
//add_action( 'pre_get_posts', 'filter_by_post_status', 1 );

function filter_by_post_category( $query ) {
        if ( $query->is_archive){
          $query->query_vars["term_id"] = '1 to 3 Paragraphs copied';
         // $query->query_vars["meta_value"] = '1';
        }
    }
add_action( 'pre_get_posts', 'filter_by_post_category', 1 );
/*
function filter_by_post_author( $query ) {
        if ( $query->is_archive){
          $query->query_vars["meta_key"] = 'assigned_user';
          $query->query_vars["meta_value"] = '1';
        }
    }
*/
//add_action( 'pre_get_posts', 'filter_by_post_author', 1 );
?>

<?php get_header(); ?>
  <div id="wrapper">
      <div class="container pt">
      <div class="row">
        <div class="col-sm-9">
        <header>
          <h3><?php the_title(); ?></h3>
        </header>
<?php
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
    if ( !empty($_GET) ){
        var_dump($_GET);
        echo $_GET['copied_link'] . '<br>';  
        echo $_GET['category'] . '<br>';             // post_ID, terms & term_relationships
        echo $_GET['status'] . '<br>';          // post
        echo $_GET['owner'] . '<br>';           // postmeta
        echo $_GET['author'] . '<br>';          // post
    } else {
        echo 'get not specified';
    }

    echo '<br>';
    // temp div for showing the results
    ?>
    
    <div class="search_results">div results</div>

    <?php


    // Start the Loop
    while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <div class="wpt-wrapper">
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
?>

        </div>
        <?php if ( is_active_sidebar('right-sidebar') ) { ?>
        <div class="col-sm-3">
                <?php dynamic_sidebar('right-sidebar'); ?>
        </div>
        <?php } ?>
        
      </div><!-- /row -->
      </div> <!-- /container -->
  </div><!-- /ww -->

<?php get_footer(); ?>
