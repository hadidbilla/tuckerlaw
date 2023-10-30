<?php 

function gs_awards_customize_register ($wp_customize){
  // Awards Title
  $wp_customize -> add_section("gs_awards_section", array(
    "title" => __("Awards Section", "gs"),
    "description" => __("You can change your home content", "gs"),
    "priority" => 2,
    "panel" => "gs_home_panel"
  ));
  $wp_customize -> add_setting("gs_awards_title", array(
    "default" => "awards & achievements"
  ));
  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, "gs_awards_title", array(
    "label" => __("Awards Title", "gs"),
    "section" => "gs_awards_section",
    "settings" => "gs_awards_title",
    "type" => "text"
  )));

  // Awards Subtitle
  $wp_customize -> add_setting("gs_awards_subtitle", array(
    "default" => "Trusted by More than 1 million Clients & Organizations"
  ));

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, "gs_awards_subtitle", array(
    "label" => __("Awards Subtitle", "gs"),
    "section" => "gs_awards_section",
    "settings" => "gs_awards_subtitle",
    "type" => "text"
  )));

  
}

