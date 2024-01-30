<?php
function home_announce_customizer_reg($wp_customize)
{
  // announce Title
  $wp_customize->add_section("gs_announce_section", array(
    "title" => __("Announcement Section", "gs"),
    "description" => __("You can change your home content", "gs"),
    "priority" => 2,
    "panel" => "gs_home_panel"
  ));
  $wp_customize->add_setting("gs_announce_title", array(
    "default" => "Attention Clients"
  ));
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, "gs_announce_title", array(
    "label" => __("Awards Title", "gs"),
    "section" => "gs_announce_section",
    "settings" => "gs_announce_title",
    "type" => "text"
  )));

  // announce Subtitle

  $wp_customize->add_setting("gs_announce_subtitle", array(
    "default" => "If you are an owner, officer, or a trustee of certain business organizations, please note that effective January 1, 2024, new federal reporting obligations went into effect for those business entities under the Corporate Transparency Act. Reporting obligations are time sensitive and ongoing. The failure to timely report may result in civil and criminal penalties."
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, "gs_announce_subtitle", array(
    "label" => __("Awards Subtitle", "gs"),
    "section" => "gs_announce_section",
    "settings" => "gs_announce_subtitle",
    "type" => "textarea"
  )));

  //button text
  $wp_customize->add_setting("gs_announce_btn_text", array(
    "default" => "Click here to learn more"
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, "gs_announce_btn_text", array(
    "label" => __("Button Text", "gs"),
    "section" => "gs_announce_section",
    "settings" => "gs_announce_btn_text",
    "type" => "text"
  )));

  //button link

  $wp_customize->add_setting("gs_announce_btn_link", array(
    "default" => "#"
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, "gs_announce_btn_link", array(
    "label" => __("Button Link", "gs"),
    "section" => "gs_announce_section",
    "settings" => "gs_announce_btn_link",
    "type" => "text"

  )));
}
