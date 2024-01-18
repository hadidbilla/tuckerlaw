<?php 
/*=========================Display User Meta Field Category page =============================*/

function acf_load_color_field_choices($field)
{
  $args = array(
    'role'    => 'professor',
    "fields" => "all_with_meta",
    'orderby' => 'user_nicename',
    'order'   => 'ASC',
  );
  $users = new WP_User_Query($args);
  $user_meta_data = [];
  foreach ($users->results as $user) {
    $user_meta_data = get_user_meta($user->ID);
    $field['choices'][$user->ID] = $user_meta_data['nickname'][0];
  }

  return $field;
}

add_filter('acf/load_field/name=contact_parson', 'acf_load_color_field_choices');

function acf_load_practice_areas_field_choices($field)
{
  $args = array(
    'role'    => 'professor',
    "fields" => "all_with_meta",
    'orderby' => 'user_nicename',
    'order'   => 'ASC',
  );
  $users = new WP_User_Query($args);
  $user_meta_data = [];
  foreach ($users->results as $user) {
    $user_meta_data = get_user_meta($user->ID);
    $field['choices'][$user->ID] = $user_meta_data['nickname'][0];
  }

  return $field;
}

add_filter('acf/load_field/name=main_practice_areas', 'acf_load_practice_areas_field_choices');

//get current user email add acf email field default value
function acf_load_email_field_choices($field)
{
  $current_user = wp_get_current_user();
  $field['default_value'] = $current_user->user_email;
  return $field;
}

add_filter('acf/load_field/name=email', 'acf_load_email_field_choices');

