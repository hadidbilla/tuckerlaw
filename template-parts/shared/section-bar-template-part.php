<?php
$tabs = $args['tabs'];
// id to get page link
$tabs_links = array();
foreach ($tabs as $tab) {
  $tabs_links[] = get_post($tab);
}

// is single page
$is_single_page = is_single();
//if single page then get the archive page id by slug
$archive_page_id;
if ($is_single_page) {
  $archive_page_id = get_page_by_path('jobs', OBJECT, 'page')->ID;
}



?>

<div class="section-bar">
  <div class="container">
    <div class="section-bar__wrap">
      <?php
      if (have_posts()) {
        foreach ($tabs_links as $tab) {
      ?>
          <a href="
                            <?php echo get_permalink($tab->ID); ?>
                         " class="<?php
                                  if (is_page($tab->ID) || $archive_page_id == $tab->ID) {
                                    echo 'section-bar__sec-link section-bar-active';
                                  } else {
                                    echo 'section-bar__sec-link';
                                  }
                                  ?>">
            <?php echo $tab->post_title; ?>
          </a>
      <?php
        }
      }
      ?>
      <!-- <a href="#section1" class="section-bar__sec-link section-bar-active" >A FUTURE WITH Tucker Arensberg</a>
            <a href="#section2" class="section-bar__sec-link">A FUTURE WITH Tucker Arensberg</a> -->
    </div>
  </div>
</div>