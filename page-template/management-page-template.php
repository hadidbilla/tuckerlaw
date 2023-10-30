<?php
/* Template Name: Our Management Page */


$management_page = get_page_by_path('management-team');
$management_page_id = $management_page->ID;
$management_page_title = $management_page->post_title;
$management_page_content = $management_page->post_content;
$management_page_content = apply_filters('the_content', $management_page_content);
$management_page_content = str_replace(']]>', ']]>', $management_page_content);
$management_page_thumbnail = get_the_post_thumbnail_url($management_page_id, 'full');
$management_page_thumbnail_alt = get_post_meta(get_post_thumbnail_id($management_page_id), '_wp_attachment_image_alt', true);
// meta data
$management_page_meta = get_post_meta($management_page_id);
// print_r($management_page_meta);

get_header();
get_template_part('template-parts/shared/sidebar-nav-template');
get_template_part('template-parts/shared/banner-template');
$tabs = get_posts(array(
  'post_type' => 'tabs',
  'name' => "about-us",
  'post_status' => 'publish',
  'numberposts' => 1
));
// get tabs meta data
$tabs_meta_data = get_post_meta($tabs[0]->ID);
// print_r($tabs_meta_data);
//a:5:{i:0;s:3:"419";i:1;s:2:"18";i:2;s:3:"414";i:3;s:3:"145";i:4;s:3:"412";}  convert to array
$tabs_meta_data = unserialize($tabs_meta_data['realed_page'][0]);



//get menu items

get_template_part('template-parts/shared/section-bar-template-part', null, array(
  'tabs' => $tabs_meta_data
));
?>

<div class="management">
  <div class="container">
    <div class="management__wrap">
      <div class="management__rich">
        <h2 tabindex="0" class="title--section">
          <?php echo $management_page_title; ?>
        </h2>
          <?php echo $management_page_content; ?>
      </div>

      <div class="management__committee">
        <h3 tabindex="0" class="title--card-small">
          <?php echo $management_page_meta['management_team_title'][0]; ?>
        </h3>
        <p class="text">
          <?php echo $management_page_meta['management_team_discription'][0]; ?>
        </p>
        <div class="management__committee-wrap">
          <?php
          // management_team_user
          $management_team_user = $management_page_meta['management_team_user'][0];
          //convert a:1:{i:0;s:1:"9";} to array
          $management_team_user = unserialize($management_team_user);
          //display user data
          foreach ($management_team_user as $user_id) {
            $user_info = get_user_meta($user_id);
            // print_r($user_info);
            get_template_part("/template-parts/shared/info-card-template-part",
            null,
            array(
              'team' => $user_info,
              'id' => $user_id,
            )
            );
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
get_footer();
?>