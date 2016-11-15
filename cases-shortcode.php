<?php
// Add Shortcode
function cases_shortcode()
{
// ---------------------------------------------------------------------
// Setting vars and pre-processing
// ---------------------------------------------------------------------
    $user_table = piklist(get_users(
    array(
      'orderby' => 'display_name', 'order' => 'asc',
    ), 'objects'
  ), array('ID', 'display_name')
  );

    $link = $_GET['link'];
    $status = $_GET['status'];
    $cat_id = $_GET['category'];
    $owner_id = $_GET['owner'];
    //$submitter_id = $_GET['submitter'];

    $owner_name = $user_table[$owner_id];
    $submitter_name = $user_table[$submitter_id];
    ?>
<!--for debugging only
  Search options:
  <br>link: <?php //echo $link; ?>
  <br>status: <?php //echo $status; ?>
  <br>category: <?php //echo $cat_id; ?>
  <br>owner: <?php //echo $owner_name; ?>
  <br>submitter: <?php //echo $submitter_name; ?><br>
-->
<?php
  // -- query arguments
  $args = array('post_type' => 'plagiarism_case' ,      // only show post plagiarism_case data
                 'orderby' => 'date',
                 'order' => 'ASC',                   // sort on date, olders to newest
                 'meta_key' => 'assigned_user',         // optional filter: Owner
                 'title' => $link,                   // optional filter for links
                 'post_status' => $status,                 // optional filter for status
                 'meta_value' => $owner_id,               // owner value
                 'author' => $submitter_id,            // optional filter for submitter
                 'posts_per_page' => '-1'
  );
    if ($cat_id != '') {
        $args['tax_query'] = array(array(
                                    'taxonomy' => 'case_category',
                                    'field' => 'term_id',
                                    'terms' => $cat_id,
                                   ));
    };

// ---------------------------------------------------------------------
// Add quick actions
// ---------------------------------------------------------------------
$current_user = wp_get_current_user();
?>

<div class="quick-actions">
  <!--<h4>Quick actions</h4>-->
  <ul>
  <li><a href="<?php echo get_site_url() . '?status=in_progress&owner=' . $current_user->ID; ?>">Show cases assigned to me</a></li>
  <li><a href="<?php echo get_site_url() . '?status=open'; ?>">Show all open cases</a></li>
  </ul>
  <h4>Results</h4>
</div>

<?php
// ---------------------------------------------------------------------
// The loop, query and display plagiarism cases
// ---------------------------------------------------------------------

  $the_query = new WP_Query($args);
  //$the_query = new WP_Query( );
  if ($the_query->have_posts()) :
  // Start the Loop
?>
  <table class="plagiarism-cases-table stripe">
  <thead>
  <tr>
    <th>ID</th>
    <th>Status</th>
    <th>Assigned to</th>
    <th>Category</th>
    <th>Links</th>
    <th>Date</th>
    <!--<th>Submitter</th>-->
    <th>Go</th>
  </tr>
  </thead>
  <tbody>
  <?php while ($the_query->have_posts()) : $the_query->the_post();
    ?>
    <tr>
      <td><?php echo get_the_ID() ?></td>
      <!-- Status -->
      <td><?php echo get_post_status($post->ID);
    ?></td>

      <!-- Owner -->
      <td><?php echo $user_table[get_post_meta(get_the_ID(), 'assigned_user', true)];
    ?></td>

      <!-- Category -->
      <td><?php $cats = get_the_terms($post->ID, 'case_category');
    ?>
        <ul>
          <?php if ($cats == false) {
    echo '<li>none</li>';
}
    foreach ($cats as $cat) {
        echo '<li>'.$cat->name.'</li>';
    }
    ?>
        </ul>
      </td>

      <!-- Links, copied and original -->
      <td>
        COPIED: <?php the_title();
    ?><br>
        ORIGINAL: <?php echo get_post_meta(get_the_ID(), 'original', true) ?>
      </td>

      <!-- Date -->
      <td><?php echo get_the_date('M j, Y');
    ?> @ <?php the_time();
    ?></td>

      <!-- Author -->
      <!--<td><?php //the_author(); ?></td>-->
      <td><?php the_shortlink('view');
    ?></td>
    </tr>
  <?php     // End the Loop
  endwhile;
    wp_reset_postdata(); else :
  // If no posts match this query, output this text.
  _e('Sorry, no posts matched your criteria.', 'textdomain');
    endif;
    ?>
</tbody>
  </table>
  <?php

}
add_shortcode('plagiarism_cases', 'cases_shortcode');
?>
