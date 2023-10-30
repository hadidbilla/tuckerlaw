<?php

function gs_choose_customize_register($wp_customize){

  $wp_customize->add_section(
    'gs_choose_section',
    array(
      'title' => __('Why Choose Us', 'gs'),
      'description' => __('You can can change all element', 'gs'),
      'priority' => 4,
      'panel' => 'gs_home_panel'
    )
  );

  // Choose Title
  $wp_customize->add_setting(
    'gs_choose_title',
    array(
      'default' => 'Why Choose Us',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_choose_title',
      array(
        'label' => __('Section Title', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_title',
        'type' => 'text',
      )
    )
  );

  // Choose Description
  $wp_customize->add_setting(
    'gs_choose_description',
    array(
      'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sed pellentesque'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_choose_description',
      array(
        'label' => __('Description', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_description',
        'type' => 'textarea',
      )
    )
  );

  // Choose Image
  $wp_customize->add_setting(
    'gs_choose_image',
    array(
      'default' => get_template_directory_uri() . '/assets/images/frame.png',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'gs_choose_image',
      array(
        'label' => __('Image', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_image',
      )
    )
  );

  // Choose Card 1 Title
  $wp_customize->add_setting(
    'gs_choose_card_1_title',
    array(
      'default' => 'Lorem ipsum dolor sit amet'
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_choose_card_1_title',
      array(
        'label' => __('Card 1 Title', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_card_1_title',
        'type' => 'text'
      )
    )
  );

  // Choose Card 1 Description

  $wp_customize->add_setting(
    'gs_choose_card_1_description',
    array(
      'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam euismod, nisi vel consectetur interdum, nisl nisi consectetur nisi, eget consectetur nisi nisi vel nisi. Nam euismod, nisi vel consectetur interdum',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_choose_card_1_description',
      array(
        'label' => __('Card 1 Description', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_card_1_description',
        'type' => 'textarea',
      )
    )
  );

  // Choose Card 1 Image
  $wp_customize->add_setting(
    'gs_choose_card_1_image',
    array(
      'default' => get_template_directory_uri() . '/assets/images/client.png',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'gs_choose_card_1_image',
      array(
        'label' => __('Card 1 Image', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_card_1_image',
      )
    )
  );

  // Choose Card 2 Title
  $wp_customize->add_setting(
    'gs_choose_card_2_title',
    array(
      'default' => 'Lorem ipsum dolor sit amet',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_choose_card_2_title',
      array(
        'label' => __('Card 2 Title', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_card_2_title',
        'type' => 'text',
      )
    )
  );

  // Choose Card 2 Description

  $wp_customize->add_setting(
    'gs_choose_card_2_description',
    array(
      'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam euismod, nisi vel consectetur interdum, nisl nisi consectetur nisi, eget consectetur nisi nisi vel nisi. Nam euismod, nisi vel consectetur interdum',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_choose_card_2_description',
      array(
        'label' => __('Card 2 Description', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_card_2_description',
        'type' => 'textarea',
      )
    )
  );

  // Choose Card 2 Image
  $wp_customize->add_setting(
    'gs_choose_card_2_image',
    array(
      'default' => get_template_directory_uri() . '/assets/images/ethics.png',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'gs_choose_card_2_image',
      array(
        'label' => __('Card 2 Image', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_card_2_image',
      )
    )
  );

  // Choose Card 3 Title

  $wp_customize->add_setting(
    'gs_choose_card_3_title',
    array(
      'default' => 'Lorem ipsum dolor sit amet',
    )
  );

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_choose_card_3_title',
      array(
        'label' => __('Card 3 Title', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_card_3_title',
        'type' => 'text',
      )
    )
  );
  // Choose Card 3 Description
  $wp_customize->add_setting(
    'gs_choose_card_3_description',
    array(
      'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam euismod, nisi vel consectetur interdum, nisl nisi consectetur nisi, eget consectetur nisi nisi vel nisi. Nam euismod, nisi vel consectetur interdum',
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_choose_card_3_description',
      array(
        'label' => __('Card 3 Description', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_card_3_description',
        'type' => 'textarea',
      )
    )
  );
  // Choose Card 3 Image
  $wp_customize->add_setting(
    'gs_choose_card_3_image',
    array(
      'default' => get_template_directory_uri() . '/assets/images/Collaboration.png',
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'gs_choose_card_3_image',
      array(
        'label' => __('Card 3 Image', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_card_3_image',
      )
    )
  );

  // Choose Card 4 Title
  $wp_customize->add_setting(
    'gs_choose_card_4_title',
    array(
      'default' => 'Lorem ipsum dolor sit amet',
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_choose_card_4_title',
      array(
        'label' => __('Card 4 Title', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_card_4_title',
        'type' => 'text',
      )
    )
  );
  // Choose Card 4 Description
  $wp_customize->add_setting(
    'gs_choose_card_4_description',
    array(
      'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam euismod, nisi vel consectetur interdum, nisl nisi consectetur nisi, eget consectetur nisi nisi vel nisi. Nam euismod, nisi vel consectetur interdum',
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_choose_card_4_description',
      array(
        'label' => __('Card 4 Description', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_card_4_description',
        'type' => 'textarea',
      )
    )
  );
  // Choose Card 4 Image
  $wp_customize->add_setting(
    'gs_choose_card_4_image',
    array(
      'default' => get_template_directory_uri() . '/assets/images/independence.png',
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'gs_choose_card_4_image',
      array(
        'label' => __('Card 4 Image', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_card_4_image',
      )
    )
  );

  // Choose Card 5 Title
  $wp_customize->add_setting(
    'gs_choose_card_5_title',
    array(
      'default' => 'Lorem ipsum dolor sit amet',
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_choose_card_5_title',
      array(
        'label' => __('Card 5 Title', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_card_5_title',
        'type' => 'text',
      )
    )
  );
  // Choose Card 5 Description
  $wp_customize->add_setting(
    'gs_choose_card_5_description',
    array(
      'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam euismod, nisi vel consectetur interdum, nisl nisi consectetur nisi, eget consectetur nisi nisi vel nisi. Nam euismod, nisi vel consectetur interdum',
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_choose_card_5_description',
      array(
        'label' => __('Card 5 Description', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_card_5_description',
        'type' => 'textarea',
      )
    )
  );
  // Choose Card 5 Image
  $wp_customize->add_setting(
    'gs_choose_card_5_image',
    array(
      'default' => get_template_directory_uri() . '/assets/images/transparency.png',
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'gs_choose_card_5_image',
      array(
        'label' => __('Card 5 Image', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_card_5_image',
      )
    )
  );

  // Choose Card 6 Title
  $wp_customize->add_setting(
    'gs_choose_card_6_title',
    array(
      'default' => 'Lorem ipsum dolor sit amet',
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_choose_card_6_title',
      array(
        'label' => __('Card 6 Title', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_card_6_title',
        'type' => 'text',
      )
    )
  );
  // Choose Card 6 Description
  $wp_customize->add_setting(
    'gs_choose_card_6_description',
    array(
      'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam euismod, nisi vel consectetur interdum, nisl nisi consectetur nisi, eget consectetur nisi nisi vel nisi. Nam euismod, nisi vel consectetur interdum',
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'gs_choose_card_6_description',
      array(
        'label' => __('Card 6 Description', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_card_6_description',
        'type' => 'textarea',
      )
    )
  );
  // Choose Card 6 Image
  $wp_customize->add_setting(
    'gs_choose_card_6_image',
    array(
      'default' => get_template_directory_uri() . '/assets/images/history.png',
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'gs_choose_card_6_image',
      array(
        'label' => __('Card 6 Image', 'gs'),
        'section' => 'gs_choose_section',
        'settings' => 'gs_choose_card_6_image',
      )
    )
  );

}