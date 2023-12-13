<?php
function gs_cookies_modal_customize_register($wp_customize) {
  
    //cookies modal section
    $wp_customize->add_section(
      'gs_cookies_modal_section',
      array(
        'title' => 'Cookies Modal',
        'description' => 'You can change your cookies modal content',
        'priority' => 30,
      )
    );

    //cookies modal title
    $wp_customize->add_setting(
      'gs_cookies_modal_title',
      array(
        'default' => 'By using this site, you agree with our use of cookies.',
        'sanitize_callback' => 'sanitize_text_field',
      ));

      //cookies modal title control
      $wp_customize->add_control(
        'gs_cookies_modal_title',
        array(
          'label' => 'Title',
          'section' => 'gs_cookies_modal_section',
          'type' => 'text',
        )
      );

      //button text 1
      $wp_customize->add_setting(
        'gs_cookies_modal_btn_text_1',
        array(
          'default' => 'I consent to cookies',
          'sanitize_callback' => 'sanitize_text_field',
        )
      );

      //button text 1 control
      $wp_customize->add_control(
        'gs_cookies_modal_btn_text_1',
        array(
          'label' => 'Button Text 1',
          'section' => 'gs_cookies_modal_section',
          'type' => 'text',
        )
      );

      //button text 2

      $wp_customize->add_setting(
        'gs_cookies_modal_btn_text_2',
        array(
          'default' => 'Decline All',
          'sanitize_callback' => 'sanitize_text_field',
        )
      );

      //button text 2 control
      $wp_customize->add_control(
        'gs_cookies_modal_btn_text_2',
        array(
          'label' => 'Button Text 2',
          'section' => 'gs_cookies_modal_section',
          'type' => 'text',
        )
      );

      //button text 3
      $wp_customize->add_setting(
        'gs_cookies_modal_btn_text_3',
        array(
          'default' => 'Want to know more?',
          'sanitize_callback' => 'sanitize_text_field',
        )
      );

      //button text 3 control
      $wp_customize->add_control(
        'gs_cookies_modal_btn_text_3',
        array(
          'label' => 'Button Text 3',
          'section' => 'gs_cookies_modal_section',
          'type' => 'text',
        )
      );

      //button text 3 link
      $wp_customize->add_setting(
        'gs_cookies_modal_btn_link_3',
        array(
          'default' => '/'
        )
      );

      //button text 3 link control
      $wp_customize->add_control(
        'gs_cookies_modal_btn_link_3',
        array(
          'label' => 'Button Text 3 Link',
          'section' => 'gs_cookies_modal_section',
          'settings' => 'gs_cookies_modal_btn_link_3',
          'type' => 'dropdown-pages',
        )
      );
      

      //button text 4

      $wp_customize->add_setting(
        'gs_cookies_modal_btn_text_4',
        array(
          'default' => 'Privacy Policy',
          'sanitize_callback' => 'sanitize_text_field',
        )
      );

      //button text 4 control
      $wp_customize->add_control(
        'gs_cookies_modal_btn_text_4',
        array(
          'label' => 'Button Text 4',
          'section' => 'gs_cookies_modal_section',
          'type' => 'text',
        )
      );

      //button text 4 link
      $wp_customize->add_setting(
        'gs_cookies_modal_btn_link_4',
        array(
          'default' => '/'
        )
      );

      //button text 4 link control
      $wp_customize->add_control(
        'gs_cookies_modal_btn_link_4',
        array(
          'label' => 'Button Text 4 Link',
          'section' => 'gs_cookies_modal_section',
          'settings' => 'gs_cookies_modal_btn_link_4',
          'type' => 'dropdown-pages',
        )
      );

  }