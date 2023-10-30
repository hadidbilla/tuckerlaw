<?php 
// add custom post profile info without add new post button in admin panel
function user_profile_custompost_type()
{
  $labels = array(
    'name'               => _x('Professional Information', 'post type general name'),
    'singular_name'      => _x('Professional Information', 'post type singular name'),
    'parent_item_colon'  => '',
    'menu_name'          => 'Professional Info'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our Custom Post specific data',
    'public'        => true,
    'menu_position' => 25,
    'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
    'has_archive'   => true,
    'menu_icon'         => 'dashicons-groups',
  );
  register_post_type('profile_infos', $args);
}
add_action('init', 'user_profile_custompost_type');

// remove add new post button and  all menu items from admin panel
function remove_add_new_custom_type()
{
  global $submenu;
  // REMOVE POST TYPE
  unset($submenu['edit.php?post_type=profile_infos'][10]);
  // remove all menu items
  unset($submenu['edit.php?post_type=profile_infos'][5]);


}
add_action('admin_menu', 'remove_add_new_custom_type');

//add custom texonomy in custom post
function create_bar_admission_texonomy()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => _x('Bar Admission', 'taxonomy general name'),
    'singular_name'     => _x('Bar Admission', 'taxonomy singular name'),
    'search_items'      => __('Search Bar Admission'),
    'all_items'         => __('All Bar Admission'),
    'parent_item'       => __('Parent Custom Taxonomy'),
    'parent_item_colon' => __('Parent Custom Taxonomy:'),
    'edit_item'         => __('Edit Custom Taxonomy'),
    'update_item'       => __('Update Custom Taxonomy'),
    'add_new_item'      => __('Add New Bar Admission'),
    'new_item_name'     => __('New Custom Taxonomy Name'),
    'menu_name'         => __('Bar Admission'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'bar_admission'),
  );

  register_taxonomy('bar_admission', array('profile_infos'), $args);
}
add_action('init', 'create_bar_admission_texonomy', 0);
// remove custom_taxonomy parent_item category select box
function remove_parent_item()
{
  global $current_user;
  
    // only for bar_admission texonomy
    if (isset($_GET['taxonomy']) && $_GET['taxonomy'] == 'bar_admission' || isset($_GET['taxonomy']) && $_GET['taxonomy'] == 'court_admission' || isset($_GET['taxonomy']) && $_GET['taxonomy'] == 'position'|| isset($_GET['taxonomy']) && $_GET['taxonomy'] == 'school' || isset($_GET['taxonomy']) && $_GET['taxonomy'] == 'degree' || isset($_GET['taxonomy']) && $_GET['taxonomy'] == 'distinction') {
      echo <<<EOF
<style>
    .form-field.term-parent-wrap{
        display: none;
    }
</style>
EOF;
    }
  
}
add_action('admin_print_styles', 'remove_parent_item', 200);

// add custom texonomy in Court Admissions
function create_court_admission_texonomy()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => _x('Court Admissions', 'taxonomy general name'),
    'singular_name'     => _x('Court Admissions', 'taxonomy singular name'),
    'search_items'      => __('Search Court Admissions'),
    'all_items'         => __('All Court Admissions'),
    'parent_item'       => __('Parent Custom Taxonomy'),
    'parent_item_colon' => __('Parent Custom Taxonomy:'),
    'edit_item'         => __('Edit Custom Taxonomy'),
    'update_item'       => __('Update Custom Taxonomy'),
    'add_new_item'      => __('Add New Court Admissions'),
    'new_item_name'     => __('New Custom Taxonomy Name'),
    'menu_name'         => __('Court Admissions'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'court_admission'),
  );

  register_taxonomy('court_admission', array('profile_infos'), $args);
}
add_action('init', 'create_court_admission_texonomy', 0);

// create custom texonomy for positions in custom post
function create_position_texonomy()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => _x('Positions', 'taxonomy general name'),
    'singular_name'     => _x('Positions', 'taxonomy singular name'),
    'search_items'      => __('Search Positions'),
    'all_items'         => __('All Positions'),
    'parent_item'       => __('Parent Custom Taxonomy'),
    'parent_item_colon' => __('Parent Custom Taxonomy:'),
    'edit_item'         => __('Edit Custom Taxonomy'),
    'update_item'       => __('Update Custom Taxonomy'),
    'add_new_item'      => __('Add New Positions'),
    'new_item_name'     => __('New Custom Taxonomy Name'),
    'menu_name'         => __('Positions'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'position'),
  );

  register_taxonomy('position', array('profile_infos'), $args);
}
add_action('init', 'create_position_texonomy', 0);

// add custom texonomy for School in custom post
function create_school_texonomy()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => _x('Schools', 'taxonomy general name'),
    'singular_name'     => _x('Schools', 'taxonomy singular name'),
    'search_items'      => __('Search School'),
    'all_items'         => __('All Schools'),
    'parent_item'       => __('Parent Custom Taxonomy'),
    'parent_item_colon' => __('Parent Custom Taxonomy:'),
    'edit_item'         => __('Edit Custom Taxonomy'),
    'update_item'       => __('Update Custom Taxonomy'),
    'add_new_item'      => __('Add New School'),
    'new_item_name'     => __('New Custom Taxonomy Name'),
    'menu_name'         => __('Schools'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'school'),
  );

  register_taxonomy('school', array('profile_infos'), $args);
}
add_action('init', 'create_school_texonomy', 0);


// add custom texonomy for Degrees in custom post
function create_degree_texonomy()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => _x('Degrees', 'taxonomy general name'),
    'singular_name'     => _x('Degrees', 'taxonomy singular name'),
    'search_items'      => __('Search Degrees'),
    'all_items'         => __('All Degrees'),
    'parent_item'       => __('Parent Custom Taxonomy'),
    'parent_item_colon' => __('Parent Custom Taxonomy:'),
    'edit_item'         => __('Edit Custom Taxonomy'),
    'update_item'       => __('Update Custom Taxonomy'),
    'add_new_item'      => __('Add New Degrees'),
    'new_item_name'     => __('New Custom Taxonomy Name'),
    'menu_name'         => __('Degrees'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'degree'),
  );

  register_taxonomy('degree', array('profile_infos'), $args);
}
add_action('init', 'create_degree_texonomy', 0);

// add custom texonomy for Distinctions in custom post

function create_distinction_texonomy()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => _x('Distinctions', 'taxonomy general name'),
    'singular_name'     => _x('Distinctions', 'taxonomy singular name'),
    'search_items'      => __('Search Distinctions'),
    'all_items'         => __('All Distinctions'),
    'parent_item'       => __('Parent Custom Taxonomy'),
    'parent_item_colon' => __('Parent Custom Taxonomy:'),
    'edit_item'         => __('Edit Custom Taxonomy'),
    'update_item'       => __('Update Custom Taxonomy'),
    'add_new_item'      => __('Add New Distinctions'),
    'new_item_name'     => __('New Custom Taxonomy Name'),
    'menu_name'         => __('Distinctions'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'distinction'),
  );

  register_taxonomy('distinction', array('profile_infos'), $args);
}
add_action('init', 'create_distinction_texonomy', 0);