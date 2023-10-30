<?php

function gs_footer_customize_register($wp_customize){

  $wp_customize->add_section(
    'gs_footer_section',
    array(
      'title' => __('Footer', 'gs'),
      'description' => __('Footer Customizes', 'gs'),
      'priority' => 100
    )
  );
  //Footer Image 1
  $wp_customize->add_setting("gs_footer_img1", array(
    "default" => get_bloginfo("template_directory")."/assets/images/brand-logo.png"
  ));

  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      "gs_footer_img1",
      array(
        "label" => __("Footer Brand Image", "gs"),
        "section" => "gs_footer_section",
        "settings" => "gs_footer_img1"
      )
    )
  );

  //Footer Image 2
  $wp_customize->add_setting("gs_footer_img2", array(
    "default" => get_bloginfo("template_directory")."/assets/images/footer-logo2.png"
  ));

  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      "gs_footer_img2",
      array(
        "label" => __("Footer Partner Image", "gs"),
        "section" => "gs_footer_section",
        "settings" => "gs_footer_img2"
      )
    )
  );

  //Footer copyright text
  $wp_customize->add_setting("gs_footer_copyright", array(
    "default" => "© 2022 Tucker Arensberg, P.C. All Rights Reserved."
  ));

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      "gs_footer_copyright",
      array(
        "label" => __("Footer Copyright Text", "gs"),
        "section" => "gs_footer_section",
        "settings" => "gs_footer_copyright"
      )
    )
  );

  //Footer facebook link
  $wp_customize->add_setting("gs_footer_facebook", array(
    "default" => "#"
  ));

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      "gs_footer_facebook",
      array(
        "label" => __("Facebook Link", "gs"),
        "section" => "gs_footer_section",
        "settings" => "gs_footer_facebook"
      )
    )
  );

  //footer instagram link
    $wp_customize->add_setting("gs_footer_instagram", array(
        "default" => "#"
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            "gs_footer_instagram",
            array(
                "label" => __("Instagram Link", "gs"),
                "section" => "gs_footer_section",
                "settings" => "gs_footer_instagram"
            )
        )
    );

  //Footer twitter link
  $wp_customize->add_setting("gs_footer_twitter", array(
    "default" => "#"
  ));

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      "gs_footer_twitter",
      array(
        "label" => __("Twitter Link", "gs"),
        "section" => "gs_footer_section",
        "settings" => "gs_footer_twitter"
      )
    )
  );

  //Footer linkedin link

  $wp_customize->add_setting("gs_footer_linkedin", array(
    "default" => "#"
  ));

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      "gs_footer_linkedin",
      array(
        "label" => __("Linkedin Link", "gs"),
        "section" => "gs_footer_section",
        "settings" => "gs_footer_linkedin"
      )
    )
  );
  $wp_customize->add_setting("gs_footer_youtube", array(
    "default" => "#"
  ));

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      "gs_footer_youtube",
      array(
        "label" => __("Youtube Link", "gs"),
        "section" => "gs_footer_section",
        "settings" => "gs_footer_youtube"
      )
    )
  );
}
