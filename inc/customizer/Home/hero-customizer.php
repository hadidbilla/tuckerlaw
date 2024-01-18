<?php

function gs_customize_hero_register($wp_customize){

    // Home Hero Background Image
    $wp_customize->add_section("gs_home_hero", array(
      "title" => __("Home Hero", "gs"),
      "description" => __("You can change your home hero content", "gs"),
      "priority" => 1,
      "panel" => "gs_home_panel"
    ));
  
    $wp_customize->add_setting("gs_home_hero_img", array(
      "default" => get_template_directory_uri()."/assets/images/hero-bg.png"
    ));
  
    $wp_customize->add_control(
      new WP_Customize_Image_Control(
        $wp_customize,
        "gs_home_hero_img",
        array(
          "label" => __("Home Hero Image", "gs"),
          "section" => "gs_home_hero",
          "settings" => "gs_home_hero_img"
        )
      )
    );
  
    // Home Hero Title
  
    $wp_customize->add_setting("gs_home_hero_title", array(
      "default" => "RAISE THE BAR & IMPROVE YOUR BOTTOM LINE"
    ));
  
    $wp_customize->add_control(
      new WP_Customize_Control(
        $wp_customize,
        "gs_home_hero_title",
        array(
          "label" => __("Home Hero Title", "gs"),
          "section" => "gs_home_hero",
          "settings" => "gs_home_hero_title",
          "type" => "text"
        )
      )
    );
  
    // Home Hero Practice Button Text
  
    $wp_customize->add_setting("gs_home_hero_practice_btn_text", array(
      "default" => "Practice Areas",
    ));
  
    $wp_customize->add_control(
      new WP_Customize_Control(
        $wp_customize,
        "gs_home_hero_practice_btn_text",
        array(
          "label" => __("Home Hero Practice Button Text", "gs"),
          "section" => "gs_home_hero",
          "settings" => "gs_home_hero_practice_btn_text",
          "type" => "text"
        )
      )
    );
  
    // Home Hero Practice Button Link
  
    $wp_customize->add_setting("gs_home_hero_practice_btn_link", array(
      "default" => "/",
    ));
  
    $wp_customize->add_control(
      new WP_Customize_Control(
        $wp_customize,
        "gs_home_hero_practice_btn_link",
        array(
          "label" => __("Home Hero Practice Button Link", "gs"),
          "section" => "gs_home_hero",
          "settings" => "gs_home_hero_practice_btn_link",
          "type" => "dropdown-pages"
        )
      )
    );
  
    // Home Hero Search Button Text
  
    $wp_customize->add_setting("gs_home_hero_search_btn_text", array(
      "default" => "Search",
    ));
  
    $wp_customize->add_control(
      new WP_Customize_Control(
        $wp_customize,
        "gs_home_hero_search_btn_text",
        array(
          "label" => __("Home Hero Search Button Text", "gs"),
          "section" => "gs_home_hero",
          "settings" => "gs_home_hero_search_btn_text",
          "type" => "text"
        )
      )
    );
  
    // Home Hero Search Button Link
  
    $wp_customize->add_setting("gs_home_hero_search_btn_link", array(
      "default" => "/",
    ));
  
    $wp_customize->add_control(
      new WP_Customize_Control(
        $wp_customize,
        "gs_home_hero_search_btn_link",
        array(
          "label" => __("Home Hero Search Button Link", "gs"),
          "section" => "gs_home_hero",
          "settings" => "gs_home_hero_search_btn_link",
          "type" => "dropdown-pages"
        )
      )
    );
  
    // Home Hero Form Title
  
    $wp_customize->add_setting("gs_home_hero_form_title", array(
      "default" => "Search for a doctor"
    ));
  
    $wp_customize->add_control(
      new WP_Customize_Control(
        $wp_customize,
        "gs_home_hero_form_title",
        array(
          "label" => __("Home Hero Form Title", "gs"),
          "section" => "gs_home_hero",
          "settings" => "gs_home_hero_form_title",
          "type" => "text"
        )
      )
    );
  
    // Home Hero Form Subtitle
  
    $wp_customize->add_setting("gs_home_hero_form_subtitle", array(
      "default" => "Search for a doctor"
    ));
  
    $wp_customize->add_control(
      new WP_Customize_Control(
        $wp_customize,
        "gs_home_hero_form_subtitle",
        array(
          "label" => __("Home Hero Form Subtitle", "gs"),
          "section" => "gs_home_hero",
          "settings" => "gs_home_hero_form_subtitle",
          "type" => "text"
        )
      )
    );
}