<?php

function gs_subscribe_customize_register($wp_customize){

  $wp_customize->add_section(
    'gs_subscribe_section',
    array(
      'title' => __('Subscribe Page', 'gs'),
      'description' => __('Subscribe Page Customizes', 'gs'),
      'priority' => 8,
      'panel' => 'gs_home_panel'
    )
  );

  // CTA Title
  $wp_customize->add_setting(
    'gs_cta_title',
    array(
      'default' => 'Yeah! Your Eye Catchy CTA Title Goes Here'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_cta_title',
      array(
        'label' => __('CTA Title', 'gs'),
        'section' => 'gs_subscribe_section',
        'settings' => 'gs_cta_title',
        'type' => 'text'
      )
    )
  );

  // CTA Subtitle

  $wp_customize->add_setting(
    'gs_cta_subtitle',
    array(
      'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Risus, sed imperdiet tincidunt integer sit mauris nunc.'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_cta_subtitle',
      array(
        'label' => __('CTA Subtitle', 'gs'),
        'section' => 'gs_subscribe_section',
        'settings' => 'gs_cta_subtitle',
        'type' => 'textarea'
      )
    )
  );

    // Practice Button Text

    $wp_customize->add_setting(
      'gs_practice_btn_text',
      array(
        'default' => 'Capabilities'
      )
    );
  
    $wp_customize->add_control(
      new WP_Customize_Control(
        $wp_customize,
        'gs_practice_btn_text',
        array(
          'label' => __('Practice Button Text', 'gs'),
          'section' => 'gs_subscribe_section',
          'settings' => 'gs_practice_btn_text',
          'type' => 'text'
        )
      )
    );
  
    // Practice Button Link
  
    $wp_customize->add_setting(
      'gs_practice_btn_link',
      array(
        'default' => '#'
      )
    );
  
    $wp_customize->add_control(
      new WP_Customize_Control(
        $wp_customize,
        'gs_practice_btn_link',
        array(
          'label' => __('Practice Button Link', 'gs'),
          'section' => 'gs_subscribe_section',
          'settings' => 'gs_practice_btn_link',
          'type' => 'dropdown-pages'
        )
      )
    );
  
    // Professionals Button Text
  
    $wp_customize->add_setting(
      'gs_professionals_btn_text',
      array(
        'default' => 'Search Attorneys'
      )
    );
  
    $wp_customize->add_control(
      new WP_Customize_Control(
        $wp_customize,
        'gs_professionals_btn_text',
        array(
          'label' => __('Professionals Button Text', 'gs'),
          'section' => 'gs_subscribe_section',
          'settings' => 'gs_professionals_btn_text',
          'type' => 'text'
        )
      )
    );
  
    // Professionals Button Link
  
    $wp_customize->add_setting(
      'gs_professionals_btn_link',
      array(
        'default' => '#'
      )
    );
  
    $wp_customize->add_control(
      new WP_Customize_Control(
        $wp_customize,
        'gs_professionals_btn_link',
        array(
          'label' => __('Professionals Button Link', 'gs'),
          'section' => 'gs_subscribe_section',
          'settings' => 'gs_professionals_btn_link',
          'type' => 'dropdown-pages'
        )
      )
    );

  // Subscribe Title
  $wp_customize->add_setting(
    'gs_subscribe_title',
    array(
      'default' => 'Subscribe'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_subscribe_title',
      array(
        'label' => __('Subscribe Title', 'gs'),
        'section' => 'gs_subscribe_section',
        'settings' => 'gs_subscribe_title',
        'type' => 'text'
      )
    )
  );

  // Subscribe Subtitle

  $wp_customize->add_setting(
    'gs_subscribe_subtitle',
    array(
      'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Risus, sed imperdiet tincidunt integer sit mauris nunc.'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_subscribe_subtitle',
      array(
        'label' => __('Subscribe Subtitle', 'gs'),
        'section' => 'gs_subscribe_section',
        'settings' => 'gs_subscribe_subtitle',
        'type' => 'text'
      )
    )
  );



  // Subscribe Button Text
  $wp_customize->add_setting(
    'gs_subscribe_btn_text',
    array(
      'default' => 'Subscribe'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_subscribe_btn_text',
      array(
        'label' => __('Subscribe Button Text', 'gs'),
        'section' => 'gs_subscribe_section',
        'settings' => 'gs_subscribe_btn_text',
        'type' => 'text'
      )
    )
  );
}