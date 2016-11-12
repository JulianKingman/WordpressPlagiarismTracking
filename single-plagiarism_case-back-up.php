<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

  <?php if ($post->post_content == '') : ?>

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
        </div><!-- /col-sm-12 -->
      </div><!-- /row -->
      </div> <!-- /container -->
  </div><!-- /ww -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>

<?php endwhile; ?>

<?php get_footer(); ?>
