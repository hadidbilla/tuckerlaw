<?php
function gs_theme_setup()
{
  load_theme_textdomain('gstheme');
  add_theme_support('post-thumbnails');
  add_theme_support('title-tag');
  add_theme_support(
    'html5',
    array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
      'script',
      'style',
      'navigation-widgets',
    )
  );
}
add_action('after_setup_theme', 'gs_theme_setup');