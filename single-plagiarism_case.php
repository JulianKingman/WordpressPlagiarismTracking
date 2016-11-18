<?php get_header(); ?>

  <div id="wrapper">
      <div class="container">
      <div class="row">
        <div class="col-sm-9">

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
      <div class="container">
      <div class="row">
        <div class="col-sm-9">

        <header>
          <h3>Plagiarism case <?php echo get_the_ID() ?></h3>
        </header>

          <table class="plagiarism-single-case stripe"><thead><tr><td></td><td></td></tr></thead><tbody>
          <tr>
            <td class='first-row-single-case'>Copied link</td>
            <td><?php
              $cl = get_the_title( get_the_ID() );
              printf('<a href="http://%s" target="_blank">%s</a>', $cl, $cl);
            ?></td>
          </tr>

          <tr>
            <td class='first-row-single-case'>Original link</td>
            <td><?php
              $ol = get_post_meta(get_the_ID(), 'original', true);
              printf('<a href="http://%s" target="_blank">%s</a>', $ol, $ol);
            ?></td>
          </tr>

          <tr>
            <td class='first-row-single-case'>Date posted</td>
            <td><?php echo get_the_date(); ?> @ <?php the_time(); ?></td>
          </tr>

          <tr>
            <td class='first-row-single-case'>Status</td>
            <td><?php echo get_post_status( $post->ID ); ?></td>
          </tr>

          <tr>
            <td class='first-row-single-case'>Assigned to</td>
            <td><?php echo $user_table[get_post_meta(get_the_ID(), 'assigned_user', true)]; ?></td>
          </tr>

          <tr>
            <td class='first-row-single-case'>Category</td>
            <td><ul>
              <?php
                $cats = get_the_terms( $post->ID, 'case_category');
                if ($cats == false) echo '<li>none</li>';
                foreach($cats as $cat) {
                  echo '<li>' . $cat->name . '</li>';
                }
              ?>
            </ul></td>
          </tr>

          <tr>
            <td class='first-row-single-case'>Submitter</td>
            <td><?php the_author(); ?></td>
          </tr>

          <tr>
            <td class='first-row-single-case'>Description</td>
            <td><?php the_content(); ?></td>
          </tr>
        </tbody></table>
        <?php comments_template( ); ?>
      </div><!-- /col-sm-12 -->
    </div><!-- /row -->
    </div> <!-- /container -->
  </div><!-- /ww -->

<?php endif; ?>

<?php wp_reset_postdata(); ?>

<?php endwhile; ?>


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
