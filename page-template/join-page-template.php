<?php
/* Template Name: Our Join us Page */
//get page featured image by page id
$page_meta_data = get_post_meta(get_the_ID());
//get excerpt
//get current page id
$current_page_id = get_the_ID();
$page_excerpt = get_post_field('post_excerpt', get_the_ID());

//get page excerpt
// $page_excerpt
//get page excerpt not the content
// $page_excerpt = get_the_excerpt();

//get the page title
$page_title = get_the_title();
//get the page featured image
$page_featured_image = get_the_post_thumbnail_url();
$page_meta = get_post_meta(get_the_ID());
$first_btn_label = $page_meta['first_button_group_first_button_label'][0];
$first_btn_link = $page_meta['first_button_group_first_button_link'][0];
$first_btn_icon = $page_meta['first_button_group_first_button_icon'][0];
$second_btn_label = $page_meta['second_button_group_second_button_label'][0];
$second_btn_link = $page_meta['second_button_group_second_button_link'][0];
$second_btn_icon = $page_meta['second_button_group_second_button_icon'][0];


get_header();
get_template_part('template-parts/shared/sidebar-nav-template');
get_template_part('template-parts/shared/banner-template', null, array(
  'banner_title' => $page_title,
  'banner_content' => $page_excerpt,
  'banner_image' => $page_featured_image,
  'first_btn_label' => $first_btn_label,
  'first_btn_link' => $first_btn_link,
  'first_btn_icon' => $first_btn_icon,
  'second_btn_label' => $second_btn_label,
  'second_btn_link' => $second_btn_link,
  'second_btn_icon' => $second_btn_icon
));
//
//this page meta data

// get tabs post type post by postname
//get current page id
$current_page_id = get_the_ID();

//custom post type tabs post type post meta key realed_page value is current page id
$tabs_post_type = new WP_Query(array(
  'post_type' => 'tabs',
  'pst_status' => 'publish',
  "meta_query" => array(
    array(
      'key' => 'realed_page',
      'value' => '"' . $current_page_id . '"',
      'compare' => 'LIKE'
    )
  )
));

$tabs_meta_data = get_post_meta($tabs_post_type->post->ID);
$tabs_meta_data = unserialize($tabs_meta_data['realed_page'][0]);



//get menu items

if ($tabs_meta_data) {
  get_template_part('template-parts/shared/section-bar-template-part', null, array(
    'tabs' => $tabs_meta_data
  ));
}
?>
<div class="join ">
  <div class="container">
    <div class="contact-form-right__wrap">
      <div class="">
        <div class="join__overview-richtext" id="section1">
          <!-- <h2 tabindex="0" class="join__overview-title title--section">overview</h2> -->
          <?php
          if (have_posts()) {
            while (have_posts()) {
              the_post();
              the_content();
            }
          }
          ?>
        </div>
        <div class="single-serve__rich custom__btn__area">
          <?php
          if ($page_meta_data['rich_text_area_custom_button_group_custom_text'][0] && $page_meta_data['rich_text_area_custom_button_group_custom_text'][0] != '') {
            echo $page_meta_data['rich_text_area_custom_button_group_custom_text'][0];
          }
          if ($page_meta_data['rich_text_area_custom_button_group_button_label'][0] && $page_meta_data['rich_text_area_custom_button_group_button_label'][0] != '') {
          ?>
          <div class="">
            <a href="<?php
                        echo $page_meta_data['rich_text_area_custom_button_group_button_url'][0];
              ?>" class="btn btn--secondary news__btn">
              <?php

                echo $page_meta_data['rich_text_area_custom_button_group_button_label'][0];
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
<style type="text/css">
.join__overview-richtext ul li::before {
  content: "";
  position: absolute;
  height: 20px;
  width: 20px;
  top: 6px;
  left: -24px;
  background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/eva_arrow-right-fill-blue.svg');
}
</style>

<!-- join__overview-richtext -->