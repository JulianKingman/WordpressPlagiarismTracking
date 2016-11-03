<?php
/**
 * @package WordPress
 * Template Name: Open Plagiarism Cases
 */
?>

<?php get_header(); ?>

<?php
$loop = new WP_Query( array(
  'post_type' => 'plagiarism_case'
);
while (have_posts()) : the_post(); ?>

  <?php if($post->post_content=="") : ?>

<?php else : ?>
  <div id="wrapper">
      <div class="container pt">
      <div class="row">
        <div class="col-sm-12">
          <!-- from plugin -->
        <header>
          <h3><?php the_title(); ?></h3>
        </header>
           <?php the_content(); ?>
           <?php
              // ...Call the database connection settings
              //print('before require');
              include( '../../../wp-config.php' );
              //print('after require');
              // ...Connect to WP database
              $dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
              if ( !$dbc ) {
                  die( 'Not Connected: ' . mysql_error());
              }
              // Select the database
              $db = mysql_select_db(DB_NAME);
              if (!$db) {
                  echo "There is no database: " . $db;
              }

              //print('before the query<br>');
              $query = "SELECT wpmlp_posts.post_date, wpmlp_posts.ID, wpmlp_posts.post_type, wpmlp_postmeta.meta_key, wpmlp_postmeta.meta_value
                  FROM wpmlp_postmeta
                  INNER JOIN wpmlp_posts ON
                      wpmlp_postmeta.post_id = wpmlp_posts.ID
                      AND wpmlp_posts.ID in (SELECT wpmlp_posts.ID
                                FROM wpmlp_postmeta
                                INNER JOIN wpmlp_posts ON
                                    wpmlp_postmeta.post_id = wpmlp_posts.ID
                                    AND wpmlp_posts.post_type = 'plagiarism'
                                    AND wpmlp_postmeta.meta_key = 'status'
                                    AND wpmlp_postmeta.meta_value = 'unassigned')";
              $result = mysql_query($query);

              //echo "<table>"; // start a table tag in the HTML

              while($data = mysql_fetch_array($result)){   //Loop through array results
              print('<p>row<br>');
              print_r($data);
              print('</p>');
              //echo "<tr><td>" . $data['name'] . "</td><td>" . $data['age'] . "</td></tr>";  //$row['index'] the index here is a field name
              }

              //echo "</table>"; //Close the table in HTML

              mysql_close(); //Make sure to close out the database connection
           ?>



        </div><!-- /col-sm-12 -->
      </div><!-- /row -->
      </div> <!-- /container -->
  </div><!-- /ww -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>

<?php endwhile; ?>







<?php get_footer(); ?>
