<?php

function gs_help_customize_register($wp_customize){

  $wp_customize->add_section('gs_help', array(
    'title' => __('How can we help you', 'gs'),
    'description' => __('Options for help', 'gs'),
    'priority' => 3,
    "panel" => "gs_home_panel"
  ));

  // Help Title

  $wp_customize -> add_setting('gs_help_title', array(
    'default' => 'How can we help you'
  ));

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, 'gs_help_title', array(
    'label' => __('Help Title', 'gs'),
    'section' => 'gs_help',
    'settings' => 'gs_help_title',
    'type' => 'text'
  )));

  // Help Subtitle

  $wp_customize -> add_setting('gs_help_subtitle', array(
    'default' => 'Business and Finance Praesent sed pellentesque'
  ));

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, 'gs_help_subtitle', array(
    'label' => __('Help Subtitle', 'gs'),
    'section' => 'gs_help',
    'settings' => 'gs_help_subtitle',
    'type' => 'text'
  )));

  // Help Button Text

  $wp_customize -> add_setting('gs_help_button_text', array(
    'default' => 'Contact Us'
  ));

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, 'gs_help_button_text', array(
    'label' => __('Help Button Text', 'gs'),
    'section' => 'gs_help',
    'settings' => 'gs_help_button_text',
    'type' => 'text'
  )));

  // Help Button Link

  $wp_customize -> add_setting('gs_help_button_link', array(
    'default' => '#'
  ));

  $wp_customize -> add_control(new WP_Customize_Control($wp_customize, 'gs_help_button_link', array(
    'label' => __('Help Button Link', 'gs'),
    'section' => 'gs_help',
    'settings' => 'gs_help_button_link',
    'type' => 'dropdown-pages'
  )));


}

add_action( 'customize_register', 'gs_help_customize_register' );