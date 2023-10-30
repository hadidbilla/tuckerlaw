<?php
function gs_header_customize_register($wp_customize)
{

  // Header Logo

  $wp_customize->add_setting("gs_brnd_logo", array(
    "default" => get_bloginfo("template_directory") . "/assets/images/brand-logo.png",
  ));

  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      "gs_brnd_logo",
      array(
        "label" => __("Brand Logo", "gs"),
        "section" => "gs_header",
        "settings" => "gs_brnd_logo"
      )
    )
  );

  // Header Add Phone Number

  $wp_customize->add_setting("gs_phone", array(
    "default" => "11234567890",
  ));

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      "gs_phone",
      array(
        "label" => __("Phone Number", "gs"),
        "section" => "gs_header",
        "settings" => "gs_phone",
        "type" => "text"
      )
    )
  );

  //Header Add Secondary Phone Number
  $wp_customize->add_setting("gs_secondary_phone", array(
    "default" => "11234567890",
  ));

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      "gs_secondary_phone",
      array(
        "label" => __("Secondary Phone Number", "gs"),
        "section" => "gs_header",
        "settings" => "gs_secondary_phone",
        "type" => "text"
      )
    )
  );

  // Header Add Email

  $wp_customize->add_setting("gs_email", array(
    "default" => "info@tuckerlaw.com",
  ));

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      "gs_email",
      array(
        "label" => __("Email", "gs"),
        "section" => "gs_header",
        "settings" => "gs_email",
        "type" => "text"
      )
    )
  );

  // //Covid Button

  // $wp_customize->add_setting("gs_covid_btn_text", array(
  //   "default" => "Covid-19",
  // ));

  // $wp_customize->add_control(
  //   new WP_Customize_Control(
  //     $wp_customize,
  //     "gs_covid_btn",
  //     array(
  //       "label" => __("Covid-19 Button Text", "gs"),
  //       "section" => "gs_header",
  //       "settings" => "gs_covid_btn_text",
  //       "type" => "text"
  //     )
  //   )
  // );

  // //Covid Button Link

  // $wp_customize->add_setting("gs_covid_btn_link", array(
  //   "default" => "/",
  // ));

  // $wp_customize->add_control(
  //   new WP_Customize_Control(
  //     $wp_customize,
  //     "gs_covid_btn_link",
  //     array(
  //       "label" => __("Covid-19 Button Link", "gs"),
  //       "section" => "gs_header",
  //       "settings" => "gs_covid_btn_link",
  //       "type" => "dropdown-pages"
  //     )
  //   )
  // );

  // Contact Button Text

  $wp_customize->add_setting("gs_contact_btn_text", array(
    "default" => "CONTACT US",
  ));

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      "gs_contact_btn_text",
      array(
        "label" => __("Contact Button Text", "gs"),
        "section" => "gs_header",
        "settings" => "gs_contact_btn_text",
        "type" => "text"
      )
    )
  );

  // Contact Button Link

  $wp_customize->add_setting("gs_contact_btn_link", array(
    "default" => "/",
  ));

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      "gs_contact_btn_link",
      array(
        "label" => __("Contact Button Link", "gs"),
        "section" => "gs_header",
        "settings" => "gs_contact_btn_link",
        "type" => "dropdown-pages"
      )
    )
  );
}