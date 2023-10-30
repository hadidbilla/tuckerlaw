<?php

function gs_attorneys_customize_register($wp_customize){

  $wp_customize->add_section("gs_attorneys_section", array(
    "title" => __("Join Attorneys", "gs"),
    "description" => __("You can change your attorneys content", "gs"),
    "priority" => 7,
    "panel" => "gs_home_panel"
  ));

  // Attorneys Title
  $wp_customize -> add_setting("gs_attorneys_title", array(
    "default" => "Our Attorneys"
  ));

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, "gs_attorneys_title", array(
    "label" => __("Join Our Team Title", "gs"),
    "section" => "gs_attorneys_section",
    "settings" => "gs_attorneys_title",
    "type" => "text"
  )));

  // Attorneys Subtitle
  $wp_customize -> add_setting("gs_attorneys_subtitle", array(
    "default" => "Trusted by More than 1 million Clients & Organizations"
  ));

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, "gs_attorneys_subtitle", array(
    "label" => __("Join Our Team Subtitle", "gs"),
    "section" => "gs_attorneys_section",
    "settings" => "gs_attorneys_subtitle",
    "type" => "text"
  )));

  // Attorneys Image
  $wp_customize -> add_setting("gs_attorneys_img", array(
    "default" => get_bloginfo("template_directory") . "/assets/images/attorneys.png"
  ));

  $wp_customize -> add_control(new WP_Customize_Image_Control($wp_customize, "gs_attorneys_img", array(
    "label" => __("Join Our Team Image", "gs"),
    "section" => "gs_attorneys_section",
    "settings" => "gs_attorneys_img"
  )));

  // Attorneys Button Text
  $wp_customize -> add_setting("gs_attorneys_button_text", array(
    "default" => "Meet Our Attorneys"
  ));

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, "gs_attorneys_button_text", array(
    "label" => __("Join Our Team Button Text", "gs"),
    "section" => "gs_attorneys_section",
    "settings" => "gs_attorneys_button_text",
    "type" => "text"
  )));

  // Attorneys Button Link
  $wp_customize -> add_setting("gs_attorneys_button_link", array(
    "default" => "#"
  ));

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, "gs_attorneys_button_link", array(
    "label" => __("Join Our Team Button Link", "gs"),
    "section" => "gs_attorneys_section",
    "settings" => "gs_attorneys_button_link",
    "type" => "dropdown-pages"
  )));
}
