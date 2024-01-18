<?php
/* Template Name: People Page */

//get the page title
$page_title = get_the_title();
// print_r($page_title);
//get this page meta data
$page_meta = get_post_meta(get_the_ID());
$first_btn_label = $page_meta['first_button_group_first_button_label'][0];
$first_btn_link = $page_meta['first_button_group_first_button_link'][0];
$first_btn_icon = $page_meta['first_button_group_first_button_icon'][0];
$second_btn_label = $page_meta['second_button_group_second_button_label'][0];
$second_btn_link = $page_meta['second_button_group_second_button_link'][0];
$second_btn_icon = $page_meta['second_button_group_second_button_icon'][0];
?>

<?php
    get_header();
    get_template_part('template-parts/shared/sidebar-nav-template');
    get_template_part('template-parts/shared/banner-template', null, array(
        'banner_title' => $page_title,
        'first_btn_label' => $first_btn_label,
        'first_btn_link' => $first_btn_link,
        'first_btn_icon' => $first_btn_icon,
        'second_btn_label' => $second_btn_label,
        'second_btn_link' => $second_btn_link,
        'second_btn_icon' => $second_btn_icon
    ));
    get_template_part('template-parts/People/people-template');
    get_footer();
?>