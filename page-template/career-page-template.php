<?php
/* Template Name: Our Career Page */
?>

<?php
get_header();
get_template_part('template-parts/shared/sidebar-nav-template');
//get current page id
$post_id = $post->ID;
//get current page meta data
$page_meta = get_post_meta($post_id);
$first_btn_label = $page_meta['first_button_group_first_button_label'][0];
$first_btn_link = $page_meta['first_button_group_first_button_link'][0];
$first_btn_icon = $page_meta['first_button_group_first_button_icon'][0];
$second_btn_label = $page_meta['second_button_group_second_button_label'][0];
$second_btn_link = $page_meta['second_button_group_second_button_link'][0];
$second_btn_icon = $page_meta['second_button_group_second_button_icon'][0];
get_template_part(
  'template-parts/shared/banner-template',
  null,
  array(
    'banner_title' => $page_meta['banner_title'][0],
    'banner_content' => $page_meta['banner_content'][0],
    'banner_image' => $page_meta['banner_image'][0],
    'first_btn_label' => $first_btn_label,
    'first_btn_link' => $first_btn_link,
    'first_btn_icon' => $first_btn_icon,
    'second_btn_label' => $second_btn_label,
    'second_btn_link' => $second_btn_link,
    'second_btn_icon' => $second_btn_icon,
  )
);
$tabs = get_posts(array(
  'post_type' => 'tabs',
  'name' => "join-us",
  'post_status' => 'publish',
  'numberposts' => 1
));
// get tabs meta data
$tabs_meta_data = get_post_meta($tabs[0]->ID);
// print_r($tabs_meta_data);
//a:5:{i:0;s:3:"419";i:1;s:2:"18";i:2;s:3:"414";i:3;s:3:"145";i:4;s:3:"412";}  convert to array
$tabs_meta_data = unserialize($tabs_meta_data['realed_page'][0]);



//get menu items

get_template_part('template-parts/shared/section-bar-template-part', null, array(
  'tabs' => $tabs_meta_data
));
$current_url = home_url(add_query_arg(array(), $wp->request));
?>

<div class="career">
  <div class="container">
    <div class="career__iframe">
      <iframe id='myIframe' src="https://recruiting.paylocity.com/recruiting/jobs/All/61440aef-cecd-4ed4-9622-bf59166bb45d/Tucker-Arensberg-PC" width="100%" height="100%" frameborder="0" scrolling="auto"></iframe>
    </div>
  </div>
</div>

<?php
get_footer();
?>
<style>
  .career__iframe {
    height: 80vh;
  }
</style>
