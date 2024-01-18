<?php
function gs_history_customize_register($wp_customize){

  //History Section Title
  $wp_customize->add_section(
    'gs_history_header_section',
    array(
      'title' => __('History Header Section', 'gs'),
      'description' => __('History Section Title', 'gs'),
      'panel' => 'gs_history_panel',
      'priority' => 10
    )
  );

  $wp_customize->add_setting(
    'gs_history_section_title_setting',
    array(
      'default' => 'LOREM IPSUM HEADING TITLE',
      'transport' => 'refresh',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );

  $wp_customize->add_control(
    'gs_history_section_title_control',
    array(
      'label' => __('History Section Title', 'gs'),
      'section' => 'gs_history_header_section',
      'settings' => 'gs_history_section_title_setting',
      'type' => 'text'
    )
  );

  //History Section Description
  $wp_customize->add_setting(
    'gs_history_section_description_setting',
    array(
      'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Est sagittis sed dui hendrerit porta sagittis odio risus. Pretium sit mattis eget sagittis egestas. Amet urna ut nisl nibh habitant nisl. Nunc enim at eu condimentum platea sed elementum viverra ut. Amet tortor urna, amet eleifend platea lacus lacus, eu. Gravida sapien pellentesque tristique proin quam diam sed mauris. Vel, tellus magna sed lobortis mi donec. Arcu urna imperdiet sed euismod neque. In sed diam ac ut ac dolor, molestie et.',
      'transport' => 'refresh',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );
  
  $wp_customize->add_control(
    'gs_history_section_description_control',
    array(
      'label' => __('History Section Description', 'gs'),
      'section' => 'gs_history_header_section',
      'settings' => 'gs_history_section_description_setting',
      'type' => 'textarea'
    )
  );

  //Card 1 Title
  // $wp_customize->add_section(
  //   'gs_history_card_1',
  //   array(
  //     'title' => __('History Card 1', 'gs'),
  //     'description' => __('History Card 1', 'gs'),
  //     'panel' => 'gs_history_panel',
  //     'priority' => 20
  //   )
  // );

  // $wp_customize->add_setting(
  //   'gs_history_card_1_title',
  //   array(
  //     'default' => 'Card 1 Title',
  //     'transport' => 'refresh',
  //     'sanitize_callback' => 'sanitize_text_field'
  //   )
  // );

  // $wp_customize->add_control(
  //   'gs_history_card_1_title_control',
  //   array(
  //     'label' => __('Card 1 Title', 'gs'),
  //     'section' => 'gs_history_card_1',
  //     'settings' => 'gs_history_card_1_title',
  //     'type' => 'text'
  //   )
  // );

  // //Card 1 Description

  // $wp_customize->add_setting(
  //   'gs_history_card_1_description',
  //   array(
  //     'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Est sagittis sed dui hendrerit porta sagittis odio risus. Pretium sit mattis eget sagittis egestas. Amet urna ut nisl nibh habitant nisl. Nunc enim at eu condimentum platea sed elementum viverra ut. Amet tortor urna, amet eleifend .',
  //     'transport' => 'refresh',
  //     'sanitize_callback' => 'sanitize_text_field'
  //   )
  // );

  // $wp_customize->add_control(
  //   'gs_history_card_1_description_control',
  //   array(
  //     'label' => __('Card 1 Description', 'gs'),
  //     'section' => 'gs_history_card_1',
  //     'settings' => 'gs_history_card_1_description',
  //     'type' => 'textarea'
  //   )
  // );

  // //Card 1 Year

  // $wp_customize->add_setting(
  //   'gs_history_card_1_year',
  //   array(
  //     'default' => '2010',
  //     'transport' => 'refresh',
  //     'sanitize_callback' => 'sanitize_text_field'
  //   )
  // );

  // $wp_customize->add_control(
  //   'gs_history_card_1_year_control',
  //   array(
  //     'label' => __('Card 1 Year', 'gs'),
  //     'section' => 'gs_history_card_1',
  //     'settings' => 'gs_history_card_1_year',
  //     'type' => 'text'
  //   )
  // );

  // //Card 1 Image

  // $wp_customize->add_setting(
  //   'gs_history_card_1_image',
  //   array(
  //     'default' => get_template_directory_uri() . '/assets/images/history-img.png',
  //     'transport' => 'refresh',
  //     'sanitize_callback' => 'esc_url_raw'
  //   )
  // );

  // $wp_customize->add_control(
  //   new WP_Customize_Image_Control(
  //     $wp_customize,
  //     'gs_history_card_1_image_control',
  //     array(
  //       'label' => __('Card 1 Image', 'gs'),
  //       'section' => 'gs_history_card_1',
  //       'settings' => 'gs_history_card_1_image'
  //     )
  //   )
  // );

  // //Card 2

  // $wp_customize->add_section(
  //   'gs_history_card_2',
  //   array(
  //     'title' => __('History Card 2', 'gs'),
  //     'description' => __('History Card 2', 'gs'),
  //     'panel' => 'gs_history_panel',
  //     'priority' => 30
  //   )
  // );

  // //Card 2 Title

  // $wp_customize->add_setting(
  //   'gs_history_card_2_title',
  //   array(
  //     'default' => 'LOREM IPSUM HEADING TITLE',
  //     'transport' => 'refresh',
  //     'sanitize_callback' => 'sanitize_text_field'
  //   )
  // );

  // $wp_customize->add_control(
  //   'gs_history_card_2_title_control',
  //   array(
  //     'label' => __('Card 2 Title', 'gs'),
  //     'section' => 'gs_history_card_2',
  //     'settings' => 'gs_history_card_2_title',
  //     'type' => 'text'
  //   )
  // );

  // //Card 2 Description

  // $wp_customize->add_setting(
  //   'gs_history_card_2_description',
  //   array(
  //     'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Est sagittis sed dui hendrerit porta sagittis odio risus. Pretium sit mattis eget sagittis egestas. Amet urna ut nisl nibh habitant nisl. Nunc enim at eu condimentum platea sed elementum viverra ut. Amet tortor urna, amet eleifend .',
  //     'transport' => 'refresh',
  //     'sanitize_callback' => 'sanitize_text_field'
  //   )
  // );

  // $wp_customize->add_control(
  //   'gs_history_card_2_description_control',
  //   array(
  //     'label' => __('Card 2 Description', 'gs'),
  //     'section' => 'gs_history_card_2',
  //     'settings' => 'gs_history_card_2_description',
  //     'type' => 'textarea'
  //   )
  // );

  // //Card 2 Year

  // $wp_customize->add_setting(
  //   'gs_history_card_2_year',
  //   array(
  //     'default' => '2010',
  //     'transport' => 'refresh',
  //     'sanitize_callback' => 'sanitize_text_field'
  //   )
  // );

  // $wp_customize->add_control(
  //   'gs_history_card_2_year_control',
  //   array(
  //     'label' => __('Card 2 Year', 'gs'),
  //     'section' => 'gs_history_card_2',
  //     'settings' => 'gs_history_card_2_year',
  //     'type' => 'text'
  //   )
  // );

  // //Card 2 Image

  // $wp_customize->add_setting(
  //   'gs_history_card_2_image',
  //   array(
  //     'default' => get_template_directory_uri() . '/assets/images/history-img.png',
  //     'transport' => 'refresh',
  //     'sanitize_callback' => 'esc_url_raw'
  //   )
  // );

  // $wp_customize->add_control(
  //   new WP_Customize_Image_Control(
  //     $wp_customize,
  //     'gs_history_card_2_image_control',
  //     array(
  //       'label' => __('Card 2 Image', 'gs'),
  //       'section' => 'gs_history_card_2',
  //       'settings' => 'gs_history_card_2_image'
  //     )
  //   )
  // );

  // //Card 3

  // $wp_customize->add_section(
  //   'gs_history_card_3',
  //   array(
  //     'title' => __('History Card 3', 'gs'),
  //     'description' => __('History Card 3', 'gs'),
  //     'panel' => 'gs_history_panel',
  //     'priority' => 30
  //   )
  // );

  // //Card 3 Title

  // $wp_customize->add_setting(
  //   'gs_history_card_3_title',
  //   array(
  //     'default' => 'LOREM IPSUM HEADING TITLE',
  //     'transport' => 'refresh',
  //     'sanitize_callback' => 'sanitize_text_field'
  //   )
  // );

  // $wp_customize->add_control(
  //   'gs_history_card_3_title_control',
  //   array(
  //     'label' => __('Card 3 Title', 'gs'),
  //     'section' => 'gs_history_card_3',
  //     'settings' => 'gs_history_card_3_title',
  //     'type' => 'text'
  //   )
  // );

  // //Card 3 Description

  // $wp_customize->add_setting(
  //   'gs_history_card_3_description',
  //   array(
  //     'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Est sagittis sed dui hendrerit porta sagittis odio risus. Pretium sit mattis eget sagittis egestas. Amet urna ut nisl nibh habitant nisl. Nunc enim at eu condimentum platea sed elementum viverra ut. Amet tortor urna, amet eleifend .',
  //     'transport' => 'refresh',
  //     'sanitize_callback' => 'sanitize_text_field'
  //   )
  // );


  // $wp_customize->add_control(
  //   'gs_history_card_3_description_control',
  //   array(
  //     'label' => __('Card 3 Description', 'gs'),
  //     'section' => 'gs_history_card_3',
  //     'settings' => 'gs_history_card_3_description',
  //     'type' => 'textarea'
  //   )
  // );

  // //Card 3 Year

  // $wp_customize->add_setting(
  //   'gs_history_card_3_year',
  //   array(
  //     'default' => '2010',
  //     'transport' => 'refresh',
  //     'sanitize_callback' => 'sanitize_text_field'
  //   )
  // );

  // $wp_customize->add_control(
  //   'gs_history_card_3_year_control',
  //   array(
  //     'label' => __('Card 3 Year', 'gs'),
  //     'section' => 'gs_history_card_3',
  //     'settings' => 'gs_history_card_3_year',
  //     'type' => 'text'
  //   )
  // );

  // //Card 3 Image

  // $wp_customize->add_setting(
  //   'gs_history_card_3_image',
  //   array(
  //     'default' => get_template_directory_uri() . '/assets/images/history-img.png',
  //     'transport' => 'refresh',
  //     'sanitize_callback' => 'esc_url_raw'
  //   )
  // );

  // $wp_customize->add_control(
  //   new WP_Customize_Image_Control(
  //     $wp_customize,
  //     'gs_history_card_3_image_control',
  //     array(
  //       'label' => __('Card 3 Image', 'gs'),
  //       'section' => 'gs_history_card_3',
  //       'settings' => 'gs_history_card_3_image'
  //     )
  //   )
  // );

  // //Card 4

  // $wp_customize->add_section(
  //   'gs_history_card_4',
  //   array(
  //     'title' => __('History Card 4', 'gs'),
  //     'description' => __('History Card 4', 'gs'),
  //     'panel' => 'gs_history_panel',
  //     'priority' => 40
  //   )
  // );

  // //Card 4 Title

  // $wp_customize->add_setting(
  //   'gs_history_card_4_title',
  //   array(
  //     'default' => 'LOREM IPSUM HEADING TITLE',
  //     'transport' => 'refresh',
  //     'sanitize_callback' => 'sanitize_text_field'
  //   )
  // );

  // $wp_customize->add_control(
  //   'gs_history_card_4_title_control',
  //   array(
  //     'label' => __('Card 4 Title', 'gs'),
  //     'section' => 'gs_history_card_4',
  //     'settings' => 'gs_history_card_4_title',
  //     'type' => 'text'
  //   )
  // );

  // //Card 4 Description

  // $wp_customize->add_setting(
  //   'gs_history_card_4_description',
  //   array(
  //     'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Est sagittis sed dui hendrerit porta sagittis odio risus. Pretium sit mattis eget sagittis egestas. Amet urna ut nisl nibh habitant nisl. Nunc enim at eu condimentum platea sed elementum viverra ut. Amet tortor urna, amet eleifend .',
  //     'transport' => 'refresh',
  //     'sanitize_callback' => 'sanitize_text_field'
  //   )
  // );

  // $wp_customize->add_control(
  //   'gs_history_card_4_description_control',
  //   array(
  //     'label' => __('Card 4 Description', 'gs'),
  //     'section' => 'gs_history_card_4',
  //     'settings' => 'gs_history_card_4_description',
  //     'type' => 'textarea'
  //   )
  // );

  // //Card 4 Year

  // $wp_customize->add_setting(
  //   'gs_history_card_4_year',
  //   array(
  //     'default' => '2010',
  //     'transport' => 'refresh',
  //     'sanitize_callback' => 'sanitize_text_field'
  //   )
  // );

  // $wp_customize->add_control(
  //   'gs_history_card_4_year_control',
  //   array(
  //     'label' => __('Card 4 Year', 'gs'),
  //     'section' => 'gs_history_card_4',
  //     'settings' => 'gs_history_card_4_year',
  //     'type' => 'text'
  //   )
  // );

  // //Card 4 Image

  // $wp_customize->add_setting(
  //   'gs_history_card_4_image',
  //   array(
  //     'default' => get_template_directory_uri() . '/assets/images/history-img.png',
  //     'transport' => 'refresh',
  //     'sanitize_callback' => 'esc_url_raw'
  //   )
  // );

  // $wp_customize->add_control(
  //   new WP_Customize_Image_Control(
  //     $wp_customize,
  //     'gs_history_card_4_image_control',
  //     array(
  //       'label' => __('Card 4 Image', 'gs'),
  //       'section' => 'gs_history_card_4',
  //       'settings' => 'gs_history_card_4_image'
  //     )
  //   )
  // );

  // //Card 5

  // $wp_customize->add_section(
  //   'gs_history_card_5',
  //   array(
  //     'title' => __('History Card 5', 'gs'),
  //     'description' => __('History Card 5', 'gs'),
  //     'panel' => 'gs_history_panel',
  //     'priority' => 50
  //   )
  // );

  // //Card 5 Title

  // $wp_customize->add_setting(
  //   'gs_history_card_5_title',
  //   array(
  //     'default' => 'LOREM IPSUM HEADING TITLE',
  //     'transport' => 'refresh',
  //     'sanitize_callback' => 'sanitize_text_field'
  //   )
  // );

  // $wp_customize->add_control(
  //   'gs_history_card_5_title_control',
  //   array(
  //     'label' => __('Card 5 Title', 'gs'),
  //     'section' => 'gs_history_card_5',
  //     'settings' => 'gs_history_card_5_title',
  //     'type' => 'text'
  //   )
  // );

  // //Card 5 Description

  // $wp_customize->add_setting(
  //   'gs_history_card_5_description',
  //   array(
  //     'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Est sagittis sed dui hendrerit porta sagittis odio risus. Pretium sit mattis eget sagittis egestas. Amet urna ut nisl nibh habitant nisl. Nunc enim at eu condimentum platea sed elementum viverra ut. Amet tortor urna, amet eleifend .',
  //     'transport' => 'refresh',
  //     'sanitize_callback' => 'sanitize_text_field'
  //   )
  // );

  // $wp_customize->add_control(
  //   'gs_history_card_5_description_control',
  //   array(
  //     'label' => __('Card 5 Description', 'gs'),
  //     'section' => 'gs_history_card_5',
  //     'settings' => 'gs_history_card_5_description',
  //     'type' => 'textarea'
  //   )
  // );

  // //Card 5 Year

  // $wp_customize->add_setting(
  //   'gs_history_card_5_year',
  //   array(
  //     'default' => '2010',
  //     'transport' => 'refresh',
  //     'sanitize_callback' => 'sanitize_text_field'
  //   )
  // );

  // $wp_customize->add_control(
  //   'gs_history_card_5_year_control',
  //   array(
  //     'label' => __('Card 5 Year', 'gs'),
  //     'section' => 'gs_history_card_5',
  //     'settings' => 'gs_history_card_5_year',
  //     'type' => 'text'
  //   )
  // );

  // //Card 5 Image

  // $wp_customize->add_setting(
  //   'gs_history_card_5_image',
  //   array(
  //     'default' => get_template_directory_uri() . '/assets/images/history-img.png',
  //     'transport' => 'refresh',
  //     'sanitize_callback' => 'esc_url_raw'
  //   )
  // );

  // $wp_customize->add_control(
  //   new WP_Customize_Image_Control(
  //     $wp_customize,
  //     'gs_history_card_5_image_control',
  //     array(
  //       'label' => __('Card 5 Image', 'gs'),
  //       'section' => 'gs_history_card_5',
  //       'settings' => 'gs_history_card_5_image'
  //     )
  //   )
  // );

}