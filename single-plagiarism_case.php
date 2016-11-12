<?php get_header(); ?>
<?php
  $user_table = piklist(get_users(
    array(
      'orderby' => 'display_name'
      ,'order' => 'asc'
    )
    ,'objects'
  )
  ,array('ID' ,'display_name')
  );
?>
<?php while (have_posts()) : the_post(); ?>

  <?php if ($post->post_content == '') : ?>

<?php else : ?>
  <div id="wrapper">
      <div class="container pt">
      <div class="row">
        <div class="col-sm-12">

          <table class="plagiarism-single-case">
          <tr>
            <td>ID</td>
            <td><?php echo get_the_ID() ?></td>
          </tr>

          <tr>
            <td>Copied link</td>
            <td><?php the_title(); ?></td>
          </tr>

          <tr>
            <td>Original link</td>
            <td><?php echo get_post_meta(get_the_ID(), 'original', true) ?></td>
          </tr>

          <tr>
            <td>Copied link:</td>
            <td></td>
          </tr>

          <tr>
            <td>Date posted</td>
            <td><?php echo get_the_date('M j, Y'); ?> @ <?php the_time(); ?></td>
          </tr>

          <tr>
            <td>Status</td>
            <td><?php echo get_post_status( $post->ID ); ?></td>
          </tr>

          <tr>
            <td>Owner</td>
            <td><?php echo $user_table[get_post_meta(get_the_ID(), 'assigned_user', true)]; ?></td>
          </tr>

          <tr>
            <td>Category</td>
            <td>
              <?php
                $cats = get_the_terms( $post->ID, 'case_category');
                if ($cats == false) echo '<ul><li>none</li></ul>';
                foreach($cats as $cat) {
                  echo $cat->name . ', ';
                }
              ?>
            </td>
          </tr>

          <tr>
            <td>Submitter</td>
            <td><?php the_author(); ?></td>
          </tr>

          <tr>
            <td>Description</td>
            <td><?php the_content(); ?></td>
          </tr>
        </table>
        <?php comments_template( ); ?>
      </div><!-- /col-sm-12 -->
    </div><!-- /row -->
    </div> <!-- /container -->
  </div><!-- /ww -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>

<?php endwhile; ?>

<?php get_footer(); ?>
