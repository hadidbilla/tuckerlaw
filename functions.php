<?php

/*
=====================
    Enqueue Customizes
=====================
*/
require_once __DIR__ . '/inc/customizer/customizer.php';

/*
=====================
    Profile Custom Fields
=====================
*/
require_once __DIR__ . '/inc/profile-custom-field/profile-custom-fields.php';
/*
=====================
    Widgets Register
=====================
*/

require_once __DIR__ . '/inc/widgets/widgets.php';

/*
=====================
    Enqueue Register
=====================
*/
require_once __DIR__ . '/inc/enqueue.php';
/*
=====================
    Setup Theme
=====================
*/
require_once __DIR__ . '/inc/setup-theme.php';

/*
=====================
    NavMenu Register
=====================
*/

require_once __DIR__ . '/inc/register-menu.php';

/*
=====================
    Custom Route and Template
=====================
*/

require_once __DIR__ . '/inc/custom-route.php';
/*
=====================
    ACF Custom Fields
=====================
*/

require_once __DIR__ . '/inc/acf-custom-fields.php';

/*
=====================
    Custom Posts
=====================
*/

require_once __DIR__ . '/inc/custom_posts/custom_posts.php';


add_role(
  'professor', //  System name of the role.
  __('Professor'), // Display name of the role.
  array(
    'read'  => true,
    'delete_posts'  => true,
    'delete_published_posts' => true,
    'edit_posts'   => true,
    'publish_posts' => true,
    'edit_published_posts'   => true,
    'upload_files'  => true,
    'moderate_comments' => true, // This user will be able to moderate the comments.
  )
);



// remove_role( 'my_role' );



/*========================= Hide Default Description in Category Page Admin  =============================*/

function wpse_hide_cat_descr()
{ ?>

  <style type="text/css">
    .term-description-wrap {
      display: none;
    }
  </style>

<?php }

add_action('admin_head-term.php', 'wpse_hide_cat_descr');
add_action('admin_head-edit-tags.php', 'wpse_hide_cat_descr');


// Review Options Disable
remove_action('pre_post_update', 'wp_save_post_revision');


/*============== Hide practice_areas_taxonomy And disable Add new Category =====================*/
function remove_subscribers_manage_categories()
{
  // get_role returns an instance of WP_Role.
  $role = get_role('professor');
  $role->remove_cap('manage_categories');
}

function wpse28782_remove_menu_items()
{
  if (current_user_can('professor')) :
    remove_menu_page('edit.php?post_type=practice_areas');
    $default_category = get_option('default_category');

  endif;
}
add_action('admin_menu', 'wpse28782_remove_menu_items');




/*========================= Filter Category =============================*/
$mainCategories = get_categories(array(
  'taxonomy'   => 'category', // Taxonomy to retrieve terms for. We want 'category'. Note that this parameter is default to 'category', so you can omit it
  'orderby'    => 'name',
  'parent'     => 0,
  'hide_empty' => 0, // change to 1 to hide categores not having a single post
));




$trams = array();
foreach ($mainCategories as $category) {
  if ($category->term_id != 1) {
    $trams[] = $category->slug;
  }
}
add_action('admin_init', 'remove_category');
function remove_category()
{
  global $current_user;
  // if( current_user_can('editor') ) {
  if (in_array('professor', $current_user->roles))
    add_filter('list_terms_exclusions', 'filter_category', 10, 2);
}

function filter_category($exclusions, $args)
{
  global $trams;
  // print_r($trams);
  $exclusions .=  " t.slug NOT IN ('" . implode("','", $trams) . "') ";
  return $exclusions;
}

// get recordings category


// get user selected category practices areas


// if current user is professor and has selected practice areas show in texonomy category


add_action('admin_print_styles', 'cor_admin_print_styles', 200);
function cor_admin_print_styles()
{
  $screen = get_current_screen();
  // print_r($screen);
  if ('edit-tags' === $screen->base && 'recordings' === $screen->taxonomy) {
    echo <<<EOF
<style>
    .fixed .column-posts {
        width: auto;
    }
    .widefat .num, .column-comments, .column-links, .column-posts {
        text-align: left;
    }
    #col-right{
        display: none;
    }
    .search-form{
      display: none;
</style>
EOF;
  }
}

// create a custom post name Office Location
function create_office_location_post() {
  register_post_type(
    'office_location',
    array(
      'labels' => array(
        'name' => __('Office Location'),
        "all_items" => __("All Office Location"),
        'singular_name' => __('Office Location'),
        'add_new' => __('Add New'),
        'add_new_item' => __('Add New Office Location'),
      ),
      'menu_icon' => 'dashicons-location-alt',
      // featured image
      'supports' => array('title', 'editor', 'thumbnail'),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'offices'),
    )
  );
}
add_action('init', 'create_office_location_post');



// Create custom post type Capabilities with custom taxonomy
function create_capabilities_post()
{
  register_post_type(
    'capabilities',
    array(
      'labels' => array(
        'name' => __('Capabilities'),
        'singular_name' => __('Capabilities'),
        'add_new' => __('Add New'),
        'add_new_item' => __('Add New Capabilities'),
      ),
      'menu_icon' => 'dashicons-screenoptions',
      'public' => true,
      'has_archive' => true,
      'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
      'rewrite' => array('slug' => 'capabilities'),
      //only for admin and adminstrator role

    )
  );
}
add_action('init', 'create_capabilities_post');
// custom taxonomy for capabilities name capabilities Category
function create_capabilities_taxonomy()
{
  register_taxonomy(
    'capabilities_category',
    'capabilities',
    array(
      'labels' => array(
        'name' => 'Capabilities Category',
        'add_new_item' => 'Add New Capabilities Category',
        'new_item_name' => "New Capabilities Category"
      ),
      'show_ui' => true,
      'show_tagcloud' => false,
      'hierarchical' => true,
      'rewrite' => array('slug' => 'capabilities'),
    )
  );
}
add_action('init', 'create_capabilities_taxonomy');

// hide capabilities, office location and profile_infos for professor role
add_action('admin_menu', 'remove_menus');
function remove_menus()
{
  global $current_user;
  if (in_array('professor', $current_user->roles)) {
    remove_menu_page('edit.php?post_type=capabilities');
    remove_menu_page('edit.php?post_type=office_location');
    remove_menu_page('edit.php?post_type=profile_infos');
  }
}

// create custom post type language only show texonomy hide post
function create_language_post()
{
  register_post_type(
    'language',
    array(
      'labels' => array(
        'name' => __('Language'),
        'singular_name' => __('Language'),
        'add_new' => __('Add New'),
        'add_new_item' => __('Add New Language'),
      ),
      'menu_icon' => 'dashicons-translation',
      'public' => true,
      'has_archive' => true,
      'supports' => array('title'),
      'rewrite' => array('slug' => 'language'),
    )
  );
}
add_action('init', 'create_language_post');

// user force to select category for capabilities post
function force_capabilities_categ_init()
{
  wp_enqueue_script('jquery');
}

function force_capabilities_categ()
{

  echo "<script type='text/javascript'>\n";
  // only for capabilities post type bn
  echo "
  if(jQuery('#post_type').val() == 'capabilities'){
    jQuery('#publish').click(function() 
  {
    var cats = jQuery('[id^=\"capabilities_categorydiv\"]')
      .find('.selectit')
      .find('input');
    category_selected=false; 
    for (counter=0; counter<cats.length; counter++) 
    {
        if (cats.get(counter).checked==true) 
        {
            category_selected=true;
            break;
        }
    }
    if(category_selected==false) 
    {
      alert('You have not selected any category for the post. Please select post category.');
      setTimeout(\"jQuery('#ajax-loading').css('visibility', 'hidden');\", 100);
      jQuery('[id^=\"capabilities_categorydiv\"]').find('.tabs-panel').css('background', '#F96');
      setTimeout(\"jQuery('#publish').removeClass('button-primary-disabled');\", 100);
      return false;
    }
  });
  }
  ";
  echo "</script>\n";
}
add_action('admin_init', 'force_capabilities_categ_init');
add_action('edit_form_advanced', 'force_capabilities_categ');
add_action('edit_page_form', 'force_capabilities_categ');


// remove select parent category option from capabilities category
add_action('admin_print_styles', 'capabilities_category_admin_print_styles', 200);
function capabilities_category_admin_print_styles()
{
  $screen = get_current_screen();
  // print_r($screen);
  if ('edit-tags' === $screen->base && 'capabilities_category' === $screen->taxonomy) {
    echo <<<EOF
<style>
    .form-field.term-parent-wrap{
      display: none;
    }
</style>
EOF;
  }
}


//remove p tag from cf7
add_filter('wpcf7_autop_or_not', '__return_false');


// create custom post type jobs with custom taxonomy
function create_jobs_post()
{
  register_post_type(
    'jobs',
    array(
      'labels' => array(
        'name' => __('Jobs'),
        'singular_name' => __('Jobs'),
        'add_new' => __('Add New'),
        'add_new_item' => __('Add New Jobs'),
      ),
      'menu_icon' => 'dashicons-businessman',
      'public' => true,
      'has_archive' => true,
      'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
      'rewrite' => array('slug' => 'jobs-category'),
      //only for admin and adminstrator role
    )
  );
}
add_action('init', 'create_jobs_post');
// remove jobs post type post permalink edit option
add_filter('get_sample_permalink_html', 'remove_permalink_edit', 10, 5);
function remove_permalink_edit($return, $id, $new_title, $new_slug, $post)
{
  if ('jobs' == $post->post_type) {
    return '';
  }
  return $return;
}
//jobs support editor don't add p tag in editor
add_filter('tiny_mce_before_init', 'jobs_editor_support');
function jobs_editor_support($mceInit)
{
  $mceInit['wpautop'] = false;
  return $mceInit;
}



// custom taxonomy for jobs name jobs Category
function create_jobs_taxonomy()
{
  register_taxonomy(
    'jobs_category',
    'jobs',
    array(
      'labels' => array(
        'name' => 'Jobs Category',
        'add_new_item' => 'Add New Jobs Category',
        'new_item_name' => "New Jobs Category"
      ),
      'show_ui' => true,
      'show_tagcloud' => false,
      'hierarchical' => true,
      'rewrite' => array('slug' => 'jobs-category'),
    )
  );
}
add_action('init', 'create_jobs_taxonomy');
// add new texonomy for jobs_type
function create_jobs_type_taxonomy()
{
  register_taxonomy(
    'jobs_type',
    'jobs',
    array(
      'labels' => array(
        'name' => 'Jobs Type',
        'add_new_item' => 'Add New Jobs Type',
        'new_item_name' => "New Jobs Type"
      ),
      'show_ui' => true,
      'show_tagcloud' => false,
      'hierarchical' => true,
      'rewrite' => array('slug' => 'jobs'),
    )
  );
}
add_action('init', 'create_jobs_type_taxonomy');

//hide admin menu taxonomy=jobs_category for jobs category taxonomy
add_action('admin_menu', 'remove_jobs_category_taxonomy_menu');
function remove_jobs_category_taxonomy_menu()
{
  remove_submenu_page('edit.php?post_type=jobs', 'edit-tags.php?taxonomy=jobs_category&amp;post_type=jobs');
  remove_submenu_page('edit.php?post_type=jobs', 'edit-tags.php?taxonomy=jobs_type&amp;post_type=jobs');
} 

// user force to select category for jobs post and jobs type
function force_jobs_categ_init()
{
  wp_enqueue_script('jquery');
}

function force_jobs_categ()
{

  echo "<script type='text/javascript'>\n";
  // only for jobs post type bn
  echo "
  if(jQuery('#post_type').val() == 'jobs'){
    jQuery('#publish').click(function() 
  {
    var cats = jQuery('[id^=\"jobs_categorydiv\"]')
      .find('.selectit')
      .find('input');
    category_selected=false; 
    for (counter=0; counter<cats.length; counter++) 
    {
        if (cats.get(counter).checked==true) 
        {
            category_selected=true;
            break;
        }
    }
    if(category_selected==false) 
    {
      alert('You have not selected any category for the post. Please select post category.');
      setTimeout(\"jQuery('#ajax-loading').css('visibility', 'hidden');\", 100);
      jQuery('[id^=\"jobs_categorydiv\"]').find('.tabs-panel').css('background', '#F96');
      setTimeout(\"jQuery('#publish').removeClass('button-primary-disabled');\", 100);
      return false;
    }
  });
  }
  ";
  echo "</script>\n";
}
add_action('admin_init', 'force_jobs_categ_init');

function force_jobs_type_categ()
{

  echo "<script type='text/javascript'>\n";
  // only for jobs post type bn
  echo "
  if(jQuery('#post_type').val() == 'jobs'){
    jQuery('#publish').click(function() 
  {
    var cats = jQuery('[id^=\"jobs_typediv\"]')
      .find('.selectit')
      .find('input');
    category_selected=false; 
    for (counter=0; counter<cats.length; counter++) 
    {
        if (cats.get(counter).checked==true) 
        {
            category_selected=true;
            break;
        }
    }
    if(category_selected==false) 
    {
      alert('You have not selected any category for the post. Please select post category.');
      setTimeout(\"jQuery('#ajax-loading').css('visibility', 'hidden');\", 100);
      jQuery('[id^=\"jobs_typediv\"]').find('.tabs-panel').css('background', '#F96');
      setTimeout(\"jQuery('#publish').removeClass('button-primary-disabled');\", 100);
      return false;
    }
  });
  }
  ";
  echo "</script>\n";
}

add_action('edit_form_advanced', 'force_jobs_categ');
add_action('edit_page_form', 'force_jobs_categ');

add_action('edit_form_advanced', 'force_jobs_type_categ');
add_action('edit_page_form', 'force_jobs_type_categ');



// hide jobs, office location and profile_infos for professor role
add_action('admin_menu', 'remove_menus_jobs');
function remove_menus_jobs()
{
  global $current_user;
  if (in_array('professor', $current_user->roles)) {
    remove_menu_page('edit.php?post_type=jobs');
    remove_menu_page('edit.php?post_type=office_location');
    remove_menu_page('edit.php?post_type=profile_infos');
  }
}



// create custom post type work-history without texonomy
function create_work_history_post()
{
  register_post_type(
    'work_history',
    array(
      'labels' => array(
        'name' => __('Work History'),
        'singular_name' => __('Work History'),
        'add_new' => __('Add New'),
        'add_new_item' => __('Add New Work History'),
      ),
      'menu_icon' => 'dashicons-hammer',
      'public' => true,
      'has_archive' => true,
      'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
      'rewrite' => array('slug' => 'work-history'),
      //only for admin and adminstrator role

    )
  );
}
add_action('init', 'create_work_history_post');

// work history rich editor don't show paragraph tag 
function remove_p_work_history($content)
{
  global $post;
  if ($post->post_type == 'work_history') {
    remove_filter('the_content', 'wpautop');
  }
}


// create custom post type tabs without texonomy
function create_tabs_post()
{
  register_post_type(
    'tabs',
    array(
      'labels' => array(
        'name' => __('Tabs'),
        'singular_name' => __('Tabs'),
        'add_new' => __('Add New'),
        'add_new_item' => __('Add New Tabs'),
      ),
      'menu_icon' => 'dashicons-welcome-add-page',
      'public' => true,
      'has_archive' => true,
      'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
      'rewrite' => array('slug' => 'tabs'),
      //only for admin and adminstrator role

    )
  );
}

add_action('init', 'create_tabs_post');
// remove tabs rich editor 
add_action('init', 'remove_tabs_editor');
function remove_tabs_editor()
{
  remove_post_type_support('tabs', 'editor');
}
// remove tabs permalink and view post option
add_action('admin_menu', 'remove_tabs_permalink');
function remove_tabs_permalink()
{
  global $current_user;
  if (in_array('professor', $current_user->roles)) {
    remove_meta_box('slugdiv', 'tabs', 'normal');
    remove_meta_box('submitdiv', 'tabs', 'side');
  }
}

//remove tabs from side menu form professor role
add_action('admin_menu', 'remove_menus_tabs');
function remove_menus_tabs()
{
  global $current_user;
  if (in_array('professor', $current_user->roles)) {
    remove_menu_page('edit.php?post_type=tabs');
    //work history
    remove_menu_page('edit.php?post_type=work_history');
    //contact form contact form 7
    remove_menu_page('wpcf7');
    //remove tools
    remove_menu_page('tools.php');
  }
}

//remove comment from side menu form all role
add_action('admin_menu', 'remove_menus_comment');
function remove_menus_comment()
{

  remove_menu_page('edit-comments.php');
}
//hide wpcf7 from side menu for professor role



//support page excerpt
add_post_type_support('page', 'excerpt');

//image upload size for classic editor
add_filter('image_size_names_choose', 'my_custom_sizes');
function my_custom_sizes($sizes)
{
  return array_merge($sizes, array(
    'custom-size' => __('Custom Size'),
  ));
}
@ini_set('upload_max_size', '800M');
@ini_set('post_max_size', '800M');
@ini_set('max_execution_time', '300');

//create custom post Name Awards
function create_awards_post()
{
  register_post_type(
    'awards',
    array(
      'labels' => array(
        'name' => __('Awards'),
        'singular_name' => __('Awards'),
        'add_new' => __('Add New'),
        'add_new_item' => __('Add New Awards'),
      ),
      'menu_icon' => 'dashicons-awards',
      'public' => true,
      'has_archive' => true,
      'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
      'rewrite' => array('slug' => 'awards'),
      //only for admin and adminstrator role

    )
  );
}

add_action('init', 'create_awards_post');

//remove awards rich editor

add_action('init', 'remove_awards_editor');

function remove_awards_editor()
{
  remove_post_type_support('awards', 'editor');
}

//remove awards permalink and view post option
add_action('admin_menu', 'remove_awards_permalink');

function remove_awards_permalink()
{
  global $current_user;
  if (in_array('professor', $current_user->roles)) {
    remove_meta_box('slugdiv', 'awards', 'normal');
    remove_meta_box('submitdiv', 'awards', 'side');
  }
}

//remove awards from side menu form professor role
add_action('admin_menu', 'remove_menus_awards');
function remove_menus_awards()
{
  global $current_user;
  if (in_array('professor', $current_user->roles)) {
    remove_menu_page('edit.php?post_type=awards');
  }
}


// classic editor p tag added
function ikreativ_tinymce_fix($init)
{
  // html elements being stripped
  $init['extended_valid_elements'] = 'div[*], article[*]';

  // don't remove line breaks
  $init['remove_linebreaks'] = false;

  // convert newline characters to BR
  $init['convert_newlines_to_brs'] = true;

  // don't remove redundant BR
  $init['remove_redundant_brs'] = false;

  // pass back to wordpress
  return $init;
}
add_filter('tiny_mce_before_init', 'ikreativ_tinymce_fix');


add_filter('wpcf7_form_tag', 'cf7_select_dropdown', 10, 2);

function cf7_select_dropdown($tag, $unused)
{
  $jobs_category = get_terms(array(
    'taxonomy' => 'jobs_category',
    'hide_empty' => false,
  ));

  $filter_args = array(
    'post_type' => 'office_location',
    'post_status' => 'publish',
    'posts_per_page' => -1
  );
  $office_location_posts = new WP_Query($filter_args);

  // get post meta data
  $office_location_meta_data = [];
  foreach ($office_location_posts->posts as $key => $value) {
    $office_location_meta_data[$value->ID] = get_post_meta($value->ID);
  }

  //country name unique form $office_location_meta_data
  $country_name = [];
  foreach ($office_location_meta_data as $key => $value) {
    //unique country name
    $country_name[] = $value['country'][0];
  }
  $country_name = array_unique($country_name);



  $category_name = [];
  foreach ($jobs_category as $job_category) {
    $category_name[] = $job_category->name;
  }
  // check if this is a select  and menu-819 is the id of the menu
  if ($tag['type'] == 'select*' && $tag['name'] == 'menu-819') {
    // $tag['raw_values'] = $category_name;
    // $tag['values'] = $category_name;
    //Select Position is default value
    $tag['labels'][] = 'Select Position';
    $tag['values'][] = '';
    foreach ($category_name as $category) {
      $tag['values'][] = $category;
      $tag['raw_values'][] = $category;
    }
  }

  //$sate_name = []; form $office_location_meta_data
  $state_name = [];
  foreach ($office_location_meta_data as $key => $value) {
    //unique state name
    //if name is NY then New York and PA then Pennsylvania
    if ($value['state'][0] == 'NY') {
      $state_name[] = 'New York';
    } elseif ($value['state'][0] == 'PA') {
      $state_name[] = 'Pennsylvania';
    } else {
      $state_name[] = $value['state'][0];
    }
  }
  $state_name = array_unique($state_name);
  $city_name = array();
  foreach ($office_location_meta_data as $key => $value) {
    $city_name[$key] = $value['city'][0];
  }
  //unique city name
  $city_name = array_unique($city_name);

  // menu-490 
  if ($tag['type'] == 'select*' && $tag['name'] == 'menu-490') {
    // $tag['raw_values'] = $category_name;
    // $tag['values'] = $category_name;
    //Select Position is default value
    $tag['labels'][] = 'Select Country';
    $tag['values'][] = '';
    foreach ($country_name as $country) {
      $tag['values'][] = $country;
      $tag['raw_values'][] = $country;
    }
  }

  //menu-13 
  if ($tag['type'] == 'select*' && $tag['name'] == 'menu-13') {
    // satet_name is default value
    $tag['labels'][] = 'Select State';
    $tag['values'][] = '';
    foreach ($state_name as $state) {
      $tag['values'][] = $state;
      $tag['raw_values'][] = $state;
    }
  }

  // menu-277
  if ($tag['type'] == 'select*' && $tag['name'] == 'menu-277') {
    // Select City as a label of select box
    // $tag['label'][] = '';
    $tag['labels'][] = 'Select City';
    $tag['values'][] = '';
    foreach ($city_name as $city) {
      $tag['values'][] = $city;
      $tag['raw_values'][] = $city;
    }
  }

  return $tag;
}

//add user meta field boolean in admin panel user profile only admin can see this field and edit this field
function add_user_meta_fields($user)
{ ?>
  <!-- <h3 tabindex="0">Extra profile information</h3> -->
  <?php if (current_user_can('administrator')) { ?>
    <table class="form-table">
      <tr>
        <th><label for="display_user_profile">Display on Front-end</label></th>
        <td>
          <select name="display_user_profile" id="display_user_profile">
            <option value="true" <?php echo esc_attr(get_the_author_meta('display_user_profile', $user->ID)) == 'true' ? 'selected' : ''; ?>>Show</option>
            <option value="false" <?php echo esc_attr(get_the_author_meta('display_user_profile', $user->ID)) == 'false' ? 'selected' : ''; ?>>Hide</option>
          </select>
        </td>
      </tr>
    </table>
  <?php } ?>

  <?php }
add_action('show_user_profile', 'add_user_meta_fields');
add_action('edit_user_profile', 'add_user_meta_fields');

//save user meta field
function save_user_meta_fields($user_id)
{
  //if current user is not admin then return
  if (!current_user_can('administrator')) {
    return false;
  }
  update_user_meta($user_id, 'display_user_profile', $_POST['display_user_profile']);
}
add_action('personal_options_update', 'save_user_meta_fields');
add_action('edit_user_profile_update', 'save_user_meta_fields');


function fix_admin_bar()
{
  if (is_admin_bar_showing()) {
  ?>
    <style type="text/css">
      @media screen and (max-width: 600px) {
        #wpadminbar {
          position: fixed !important;
        }
      }
    </style>
  <?php
  }
}
function remove_admin_bar_links() {
  if (!current_user_can('manage_options')) {
      global $wp_admin_bar;
      $wp_admin_bar->remove_menu('new-content');
  }
}
add_action('wp_before_admin_bar_render', 'remove_admin_bar_links');


//write css here

//wp_title User Profile 

// add_filter( 'wp_title', 'baw_hack_wp_title_for_home' );
// function baw_hack_wp_title_for_home( $title )
// {
//   if( empty( $title ) && ( is_home() || is_front_page() ) ) {
//     return __( 'Home', 'theme_domain' ) . ' | ' . get_bloginfo( 'description' );
//   }
//   return $title;
// }


function gen_upload_mimes_vcard_support($mimes = array()){
  $mimes['vcf'] = 'text/vcard';
  $mimes['vcard'] = 'text/vcard';
  return $mimes;
}
add_filter('upload_mimes', 'gen_upload_mimes_vcard_support');