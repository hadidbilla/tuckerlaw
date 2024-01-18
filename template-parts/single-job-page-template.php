

<?php
/* Template Name: Our Job Page */
?>
<?php
get_header();
get_template_part('template-parts/shared/sidebar-nav-template');


// get the current url last segment
$last_segment = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
// print_r($last_segment);
//get the jobs post type by post name
$job_post = get_page_by_path($last_segment, OBJECT, 'jobs');
//post meta 
$job_post_meta = get_post_meta($job_post->ID);
// print_r($job_post_meta);
//get post selected office location 
// $page_meta = get_post_meta($post_id);
$first_btn_label = $job_post_meta['first_button_group_first_button_label'][0];
$first_btn_link = $job_post_meta['first_button_group_first_button_link'][0];
$first_btn_icon = $job_post_meta['first_button_group_first_button_icon'][0];
$second_btn_label = $job_post_meta['second_button_group_second_button_label'][0];
$second_btn_link = $job_post_meta['second_button_group_second_button_link'][0];
$second_btn_icon = $job_post_meta['second_button_group_second_button_icon'][0];
get_template_part(
  'template-parts/shared/banner-template',
  null,
  array(
    'banner_title' => $job_post->post_title,
    //slice the content to 100 words
    'banner_content' => wp_trim_words($job_post->post_excerpt),
    'banner_image' => get_the_post_thumbnail_url($job_post->ID),
    'first_btn_label' => $first_btn_label,
    'first_btn_link' => $first_btn_link,
    'first_btn_icon' => $first_btn_icon,
    'second_btn_label' => $second_btn_label,
    'second_btn_link' => $second_btn_link,
    'second_btn_icon' => $second_btn_icon,
  )
);

$tabs = get_posts(array(
  'post_type' => 'tabs',
  'name' => "join-us",
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
// print_r($job_post_meta);




//add to contact form 7
// [text* your-name class:contact-form-right__input placeholder "Name"]
// [email* your-email class:contact-form-right__input placeholder "Email"]
// [tel* your-phone class:contact-form-right__input placeholder "Phone"]
// function get_options() {
//   $jobs_category = get_terms(array(
//     'taxonomy' => 'jobs_category',
//     'hide_empty' => false,
//   ));

//   print_r("sdfbvasdbjv");
//   $category_name = [];
//   foreach ($jobs_category as $job_category) {
//     $category_name = $job_category->name;
//   }
//   $options = array(
//     'Option 1',
//     'Option 2',
//     'Option 3'
// );
//   return $options;
// }
// $options = get_options();
// var_dump($options);

?>

<div class="job join">
  <div class="container">
    <div class="contact-form-right__wrap">
      <div class="job__left">
        <div class="join__overview-richtext" id="section1">
          <!-- <h2 tabindex="0" class="join__overview-title title--section">overview</h2> -->
          <h2 tabindex="0">
            <?php echo $job_post->post_title; ?>
          </h2>
          <h3 tabindex="0">Job brief</h3>
          <div class="join__overview-richtext">
            <?php echo $job_post->post_content; ?>
          </div>
          <h3 tabindex="0">Responsibilities</h3>
          <div class="join__overview-richtext">
            <?php echo $job_post_meta['responsibilities'][0] ?>
          </div>
          <h3 tabindex="0">Experience:</h3>
          <div class="join__overview-richtext">
            <?php echo $job_post_meta['experience'][0] ?>
          </div>
          <h3 tabindex="0">Perks:</h3>
          <div class="join__overview-richtext">
            <?php echo $job_post_meta['perks'][0] ?>
          </div>

        </div>
        <div class="job-details">
          <div class="job__category-con">
            <?php
            set_query_var("color", "job__grid-icon");
            get_template_part("/assets/images/svg/grid-icon") ?>
            <p class="job__category-type">Job Categories: <span>
                <?php
                //get the job category terms
                $job_category_terms = get_the_terms($job_post->ID, 'jobs_category');
                // print_r($job_category_terms);
                foreach ($job_category_terms as $job_category_term) {
                  echo $job_category_term->name;
                }
                ?>
              </span></p>
            </span></p>
          </div>
          <div class="job__category-con">
            <?php
            get_template_part("/assets/images/svg/job-type-icon") ?>
            <p class="job__category-type">Job Types: <span>
                <?php
                //get the job type taxonomy
                $job_type = get_the_terms($job_post->ID, 'jobs_type');
                // print_r($job_type);
                foreach ($job_type as $type) {
                  echo $type->name;
                }
                ?>
              </span></p>
            </span></p>
          </div>
          <div class="job__category-con">
            <?php
            set_query_var("color", "job__grid-icon");
            get_template_part("/assets/images/svg/map-pin-icon-round-blue") ?>
            <p class="job__category-type">Job Locations: <span>
                <?php
                // capabilites post data by id
                $location = get_post($job_post_meta['job_location'][0]);
                echo $location->post_title;
                ?>
              </span></p>
            </span></p>
          </div>
          <a href="<?php echo get_site_url().'/jobs' ?>" class="job__back">
            <span class="job__left-icon"></span>
            <span class="job__back-text">Back to Listings</span>
          </a>
        </div>
      </div>

      <div class="contact-form-right__contact-re">
        <div class="contact-form-right__contact">
          <div class="contact-form-right__contact-title">
            <h2 tabindex="0" class="title--card-small">Apply Now</h2>
            <p class="single-serve__contact-text text">Apply now to our open positions.</p>
          </div>
          <div class="contact-con__contact-form">
            <?php echo apply_shortcodes('[contact-form-7 id="682" title="Career Opportunities"]'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<?php
get_footer();
?>

<style type="text/css">
  .join__overview-richtext ul li::before {
  content: "";
  position: absolute;
  height: 20px;
  width: 20px;
  top: 6px;
left: -24px;
  background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/eva_arrow-right-fill-blue.svg');
}
</style>