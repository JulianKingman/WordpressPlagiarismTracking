<?php get_header(); ?>
<?php
    function archive_meta_query( $query ) {
        if ( $query->is_archive){
          $query->query_vars["meta_key"] = 'assigned_user';
          $query->query_vars["meta_value"] = '1';
        }
    }
add_action( 'pre_get_posts', 'archive_meta_query', 1 );
?>

<?php while (have_posts()) : the_post(); ?>
  <?php if ($post->post_content == '') : ?>

    <br> Post ID: <?php print($post->ID); ?> - <?php the_title(); ?> <br>

<?php else : ?>

    <br> Post ID: <?php print($post->ID); ?>
    <br> <?php echo get_the_date(); ?>, <?php the_time(); ?>
    <br>  <?php the_title(); ?>



  <div id="wrapper">
      <div class="container pt">
      <div class="row">
        <div class="col-sm-12">
          <!-- from plugin -->
        <header>
          <h3><?php the_title(); ?></h3>
        </header>
           <?php the_content(); ?>
        </div><!-- /col-sm-12 -->
      </div><!-- /row -->
      </div> <!-- /container -->
  </div><!-- /ww -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>

<?php endwhile; ?>

<?php get_footer(); ?>
