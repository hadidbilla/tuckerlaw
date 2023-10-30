<?php
/* Template Name: Our Achievement Page */

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
//excerpt support html tag
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
//get excerpt
$excerpt = get_the_excerpt();

get_template_part('template-parts/shared/banner-template',
  null,
  array(
    'banner_title' => $post->post_title,
    'banner_content' => $excerpt,
    'banner_image' => get_the_post_thumbnail_url($post_id),
    'first_btn_label' => $first_btn_label,
    'first_btn_link' => $first_btn_link,
    'first_btn_icon' => $first_btn_icon,
    'second_btn_label' => $second_btn_label,
    'second_btn_link' => $second_btn_link,
    'second_btn_icon' => $second_btn_icon,
  ));
$tabs = get_posts(array(
  'post_type' => 'tabs',
  'name' => "about-us",
  'post_status' => 'publish',
  'numberposts' => 1
));
// get tabs meta data
$tabs_meta_data = get_post_meta($tabs[0]->ID);
// print_r($tabs_meta_data);
//a:5:{i:0;s:3:"419";i:1;s:2:"18";i:2;s:3:"414";i:3;s:3:"145";i:4;s:3:"412";}  convert to array
$tabs_meta_data = unserialize($tabs_meta_data['realed_page'][0]);


get_template_part('template-parts/shared/section-bar-template-part', null, array(
  'tabs' => $tabs_meta_data
));

?>

<?php
get_template_part('template-parts/shared/testimonial-slider-template');
?>

<?php
get_template_part('template-parts/shared/office-location-template');
?>
<?php
get_footer();
?>