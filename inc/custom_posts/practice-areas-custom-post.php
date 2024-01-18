<?php 
function practice_areas_post_type()
{
  register_post_type('practice_areas', array(
    'labels' => array(
      'name' => __('Practice Areas'),
      'singular_name' => __('Practice Area'),
      'add_new' => __('Add New'),
      'add_new_item' => __('Add New Practice Areas'),
      'edit' => __('Edit'),
      'edit_item' => __('Edit Practice Areas'),
      'all_items' => __('All Practice Areas'),
      'new_item' => __('New Practice Areas'),
      'view' => __('View Practice Areas'),
      'view_item' => __('View Practice Areas'),
      'search_items' => __('Search Practice Areas'),
      'not_found' => __('No Practice Areas found'),
      'not_found_in_trash' => __('No Practice Areas found in Trash'),
      'parent' => __('Parent Practice Areas'),

    ),
    'supports' => array(
      'title',
      'editor',
      'thumbnail',
      'page-attributes',
      'custom-fields',
      'post-formats'
    ),
    'show_ui' => true,
    'exclude_from_search' => true,
    'hierarchical' => true,
    'show_in_menu' => true,
    'query_var' => true,
  ));
}

add_action('init', 'practice_areas_post_type');


// Add Custom Taxonomy for Practice Areas

function practice_areas_taxonomy()
{
  $labels = array(
    'name' => _x('Recordings', 'taxonomy general name'),
    'singular_name' => __('Recording', 'taxonomy singular name'),
    'search_items' =>  __('Search Recordings'),
    'popular_items' => __('Popular Recordings'),
    'all_items' => __('All Recordings'),
    'parent_item' => __('Parent Recording'),
    'parent_item_colon' => __('Parent Recording:'),
    'edit_item' => __('Edit Recording'),
    'update_item' => __('Update Recording'),
    'add_new_item' => __('Add New Recording'),
    'new_item_name' => __('New Recording Name'),
  );
  register_taxonomy('recordings', array('practice_areas', 'post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'recordings'),
  ));
}

add_action('init', 'practice_areas_taxonomy');