<?php 

function gs_about_customize_register($wp_customize){

  $wp_customize -> add_section("gs_about_section", array(
    "title" => __("About Section", "gs"),
    "description" => __("You can change your home content", "gs"),
    "priority" => 6,
    "panel" => "gs_home_panel"
  ));

  // About Title
  $wp_customize -> add_setting("gs_about_title", array(
    "default" => "About Us"
  ));

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, "gs_about_title", array(
    "label" => __("About Title", "gs"),
    "section" => "gs_about_section",
    "settings" => "gs_about_title",
    "type" => "text"
  )));

  // About Subtitle

  $wp_customize -> add_setting("gs_about_subtitle", array(
    "default" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Risus, sed imperdiet tincidunt integer sit mauris nunc."
  ));

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, "gs_about_subtitle", array(
    "label" => __("About Subtitle", "gs"),
    "section" => "gs_about_section",
    "settings" => "gs_about_subtitle",
    "type" => "text"
  )));

  // About Section Title

  $wp_customize -> add_setting("gs_about_section_title", array(
    "default" => "LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT."
  ));

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, "gs_about_section_title", array(
    "label" => __("About Section Title", "gs"),
    "section" => "gs_about_section",
    "settings" => "gs_about_section_title",
    "type" => "text"
  )));

  // About Section Subtitle

  $wp_customize -> add_setting("gs_about_section_subtitle", array(
    "default" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Neque, viverra turpis lorem lorem eu turpis massa elit. Luctus eget ut pellentesque volutpat augue bibendum. In sagittis turpis mi, viverra nisl ullamcorper. Sagittis donec sit amet, vel tellus sit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Neque, viverra turpis lorem lorem eu turpis massa elit."
  ));

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, "gs_about_section_subtitle", array(
    "label" => __("About Section Subtitle", "gs"),
    "section" => "gs_about_section",
    "settings" => "gs_about_section_subtitle",
    "type" => "text"
  )));

  // About Section Button Text

  $wp_customize -> add_setting("gs_about_section_btn_text", array(
    "default" => "About Our Firm"
  ));

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, "gs_about_section_btn_text", array(
    "label" => __("About Section Button Text", "gs"),
    "section" => "gs_about_section",
    "settings" => "gs_about_section_btn_text",
    "type" => "text"
  )));

  // About Section Button Link

  $wp_customize -> add_setting("gs_about_section_btn_link", array(
    "default" => "/"
  ));

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, "gs_about_section_btn_link", array(
    "label" => __("About Section Button Link", "gs"),
    "section" => "gs_about_section",
    "settings" => "gs_about_section_btn_link",
    "type" => "dropdown-pages"
  )));

  // About Section Image

  $wp_customize -> add_setting("gs_about_section_image", array(
    "default" => get_template_directory_uri() . "/assets/images/about.png"
  ));

  $wp_customize -> add_control(new WP_Customize_Image_Control($wp_customize, "gs_about_section_image", array(
    "label" => __("About Section Image", "gs"),
    "section" => "gs_about_section",
    "settings" => "gs_about_section_image"
  )));

}

