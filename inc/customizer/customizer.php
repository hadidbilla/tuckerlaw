<?php 

//Home Page Customizes Files Import

require_once __DIR__ . '/Home/awards-customizer.php';
require_once __DIR__ . '/Home/hero-customizer.php';
require_once __DIR__ . '/Home/about-customizer.php';
require_once __DIR__ . '/Home/home-join-customizer.php';
require_once __DIR__ . '/Home/choose-customizer.php';
require_once __DIR__ . '/Home/help-customizer.php';
require_once __DIR__ . '/Home/news-customizer.php';
require_once __DIR__ . '/Home/subscribe-customizer.php';
require_once __DIR__ . '/Home/home-announce-customizer.php';
//Common Customizes Files Import
require_once __DIR__ . '/common/footer-customizer.php';
require_once __DIR__ . '/common/footer-customizer.php';

$slug = basename(get_permalink());



function gs_home_customizer($wp_customize) {
  $wp_customize->add_panel(
    'gs_home_panel',
    array(
      'title' => __('Home Page', 'gs'),
      'description' => __('Home Page Customizer', 'gs'),
      'priority' => 10
      )
    );

  gs_customize_hero_register($wp_customize);
  gs_awards_customize_register($wp_customize);
  gs_attorneys_customize_register($wp_customize);
  gs_about_customize_register($wp_customize);
  gs_choose_customize_register($wp_customize);
  gs_help_customize_register($wp_customize);
  gs_subscribe_customize_register($wp_customize);
  gs_footer_customize_register($wp_customize);
  home_announce_customizer_reg($wp_customize);
}

add_action( 'customize_register', 'gs_home_customizer' );

//About Page Customizes
require_once __DIR__ . '/About/about-firm.php';

function gs_firm_customizer($wp_customize) {
  $wp_customize->add_panel(
    'gs_firm_panel',
    array(
      'title' => __('About Us Pages', 'gs'),
      'description' => __('About Us All Pages Customizer', 'gs'),
      'priority' => 11
      )
    );

    gs_firm_customize_register($wp_customize);
}


add_action( 'customize_register', 'gs_firm_customizer' );

//Header Customizes
require_once __DIR__ . '/common/header-customizer.php';

function gs_header_customizer($wp_customize) {
  $wp_customize->add_section("gs_header", array(
    "title" => __("Header", "gs"),
    "description" => __("You chnage your header content", "gs"),
    "priority" => 30
  ));

  gs_header_customize_register($wp_customize);
}


add_action( 'customize_register', 'gs_header_customizer' );

//History Page Customizes
require_once __DIR__ . '/History/history-customizer.php';

function gs_history_customizer($wp_customize) {
  $wp_customize->add_panel(
    'gs_history_panel',
    array(
      'title' => __('History Page', 'gs'),
      'description' => __('History Page Customizer', 'gs'),
      'priority' => 10
      )
    );

  gs_history_customize_register($wp_customize);
}



//Cookies Modal Customizes

add_action( 'customize_register', 'gs_cookies_modal_customizer' );

require_once __DIR__ . '/cookies-modal/cookies-modal-customizer.php';

function gs_cookies_modal_customizer($wp_customize) {
  $wp_customize->add_section("gs_cookies_modal", array(
    "title" => __("Cookies Modal", "gs"),
    "description" => __("You chnage your cookies modal content", "gs"),
    "priority" => 30
  ));

  gs_cookies_modal_customize_register($wp_customize);
}





