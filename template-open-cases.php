<?php
/**
 * @package WordPress
 * Template Name: Open Plagiarism Cases
 */
?>
<style>
.box {
  padding: 20px;
  margin: 20px;
  border: 1px solid #222223;
  display: inline-block;
}
</style>


<?php
    get_header();

$args = array( 'post_type' => 'plagiarism_case');
 
// Variable to call WP_Query.
$the_query = new WP_Query( $args );
 
if ( $the_query->have_posts() ) :
    // Start the Loop
    while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <div class="box">
        Time of the post: <?php the_time(); ?>
        <br> Title: <?php the_title(); ?>
        <br> Exceprt <?php the_excerpt(); ?>
        <br> Publisher: <?php the_author(); ?>
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

