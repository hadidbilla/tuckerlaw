<?php
/* Template Name: Our New Default Page */


get_header();
get_template_part('template-parts/shared/sidebar-nav-template');
$uri = $_SERVER['REQUEST_URI'];
$last_segment = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$work_history = get_page_by_path($last_segment, OBJECT, 'work_history');

//$work_history meta data
$post_meta = get_post_meta($work_history->ID);
//
$post_title = $work_history->post_title;
$post_content = $work_history->post_excerpt;
$post_thumbnail = get_the_post_thumbnail_url($work_history->ID);
// print_r($post_thumbnail);
get_template_part('template-parts/shared/banner-template',
  null,
  array(
    'banner_title' => $post_title,
    'banner_content' => $post_content,
    'banner_image' => $post_thumbnail,
  )
);
//this page meta data

// //get current post title and content
// $current_post_title = get_the_title();
// print_r($current_post_title);

//get the current route
//get the current route last segment
//get work-history post type post by postname




// print_r($work_history);
?>
<div class="join join__default">
  <div class="container">
    <div class="contact-form-right__wrap">
      <div class="">
      <div class="join__overview-richtext" id="section1">
        <!-- <h2 tabindex="0" class="join__overview-title title--section">overview</h2> -->
        <?php
        echo $work_history->post_content;
        ?>
      </div>
      <div class="single-serve__rich custom__btn__area">
          <?php
          if ($post_meta['rich_text_area_custom_button_group_custom_text'][0] && $post_meta['rich_text_area_custom_button_group_custom_text'][0] != '') {
            echo $post_meta['rich_text_area_custom_button_group_custom_text'][0];
          }
          if ($post_meta['rich_text_area_custom_button_group_button_label'][0] && $post_meta['rich_text_area_custom_button_group_button_label'][0] != '') {
          ?>
            <div class="">
              <a href="<?php
                        echo $post_meta['rich_text_area_custom_button_group_button_url'][0];
              ?>" class="btn btn--secondary news__btn">
                <?php

                echo $post_meta['rich_text_area_custom_button_group_button_label'][0];
                ?>
              </a>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
      <div class="contact-form-right__contact-re">
        <div class="contact-form-right__contact sticky-sidebar">
          <div class="contact-form-right__contact-title">
            <h2 tabindex="0" class="title--card-small">Contact Now</h2>
            <p class="single-serve__contact-text text">Get support from our trusted attorneys.</p>
          </div>
          <?php
          get_template_part('template-parts/shared/contact-form-template');
          ?>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
get_footer();
?>