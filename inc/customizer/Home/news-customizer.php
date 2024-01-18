<?php

function gs_news_customize_register($wp_customize){

  $wp_customize->add_section(
    'gs_news_section',
    array(
      'title' => __('News Page', 'gs'),
      'description' => __('News Page Customizer', 'gs'),
      'priority' => 5,
      'panel' => 'gs_home_panel'
    )
  );

  // News Page Title
  $wp_customize->add_setting(
    'gs_news_title',
    array(
      'default' => 'LATEST News & Insights'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_news_title',
      array(
        'label' => __('News Page Title', 'gs'),
        'section' => 'gs_news_section',
        'settings' => 'gs_news_title',
        'type' => 'text'
      )
    )
  );

  // News Page Subtitle
  $wp_customize->add_setting(
    'gs_news_subtitle',
    array(
      'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Risus, sed imperdiet tincidunt integer sit mauris nunc.'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_news_subtitle',
      array(
        'label' => __('News Page Subtitle', 'gs'),
        'section' => 'gs_news_section',
        'settings' => 'gs_news_subtitle',
        'type' => 'text'
      )
    )
  );

  // News Page Button Text
  $wp_customize->add_setting(
    'gs_news_btn_text',
    array(
      'default' => 'View All News'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_news_btn_text',
      array(
        'label' => __('News Page Button Text', 'gs'),
        'section' => 'gs_news_section',
        'settings' => 'gs_news_btn_text',
        'type' => 'textarea'
      )
    )
  );

  // News Page Button Link

  $wp_customize->add_setting(
    'gs_news_btn_link',
    array(
      'default' => '#'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_news_btn_link',
      array(
        'label' => __('News Page Button Link', 'gs'),
        'section' => 'gs_news_section',
        'settings' => 'gs_news_btn_link',
        'type' => 'dropdown-pages'
      )
    )
  );
}

add_action( 'customize_register', 'gs_news_customize_register' );