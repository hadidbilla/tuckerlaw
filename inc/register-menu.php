<?php

register_nav_menu('primary', __('Primary Menu'));
register_nav_menu('footer1', __('Home'));
register_nav_menu('footer2', __('About Us'));
register_nav_menu('footer3', __('Community & Inclusion'));
register_nav_menu('footer4', __('Careers'));
register_nav_menu('footer5', __('Social'));
register_nav_menu('footer6', __('Legal'));
register_nav_menu('footer_horizontal', __('Horizontal Footer Menu'));
//sidebar menu


function gs_nav_menu_link_attributes($atts, $item, $args)
{
  if ('primary' === $args->theme_location) {
    $atts['class'] = "nav__menu__link";
  } elseif ('footer_horizontal' === $args->theme_location) {
    $atts['class'] = "footer__social-item text--smallest";
  } else {
    $atts['class'] = "footer__list-item text--small";
     $atts['data-acsb-clickable'] = 'true';
     $atts['data-acsb-navigable'] = 'true';
     $atts['data-acsb-now-navigable'] = 'true';
     $atts['data-acsb-menu'] = 'a';
     $atts['data-acsb-menu-root-link'] = 'true';
  }

  return $atts;
}

add_filter('nav_menu_link_attributes', 'gs_nav_menu_link_attributes', 10, 3);


function gs_nav_menu_css_class($classes, $item, $args)
{
  if ('primary' === $args->theme_location) {
    $classes[] = "nav__menu__item";
  }

  return $classes;
}

add_filter('nav_menu_css_class', 'gs_nav_menu_css_class', 10, 3);