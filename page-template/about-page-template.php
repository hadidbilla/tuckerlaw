<?php
/* Template Name: Our About Page */
?>

<?php
get_header();
get_template_part('template-parts/shared/sidebar-nav-template');
get_template_part('template-parts/shared/banner-template');
$tabs = get_posts(array(
    'post_type' => 'tabs',
    'name' => "about-us",
    'post_status' => 'publish',
    'numberposts' => 1
  ));

  //get current page id
    $current_page_id = get_the_ID();

  //get post meta data
  $meta_data = get_post_meta($current_page_id);
//   print_r( $meta_data);
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


<div class="about">
    <div class="container">
        <div class="about__wrap">
            <div class="about__wrap-content">
                <?php
                $about_us_page = get_posts(array(
                    'post_type' => 'page',
                    'name' => "about-firm",
                    'post_status' => 'publish',
                    'numberposts' => 1
                ));
                // print_r($about_us_page);
                // echo get_site_url() . '/contact-us';
                echo $about_us_page[0]->post_content;
                ?>
                <a href="<?php if(is_numeric(get_theme_mod("gs_firm_btn_page_link", "#"))){
            echo get_page_link(get_theme_mod("gs_firm_btn_page_link", "#"));
          }else{
            echo get_theme_mod("gs_firm_btn_page_link", "#");
          } ?>" class="btn btn--primary about__wrap-btn">
                    <?php get_template_part("/assets/images/svg/user-icon") ?>
                    <?php
                    echo get_theme_mod('gs_firm_btn_text', 'Reach Out to Us for Legal Consultation')
                    ?>
                </a>
            </div>
            <div class="about__wrap-img-con">
                <?php
                //get page thumbnail
            $page_thumbnail = $meta_data['content_image'][0];
            if ($page_thumbnail) {
                ?>
                <img alt="About Image" loading="lazy" src="<?php echo 
                    //get full size image url by attachment id
                    wp_get_attachment_image_src($page_thumbnail, 'full')[0];
                ?>" alt="" class="about__wrap-img">
                <?php
            } else {
                ?>
                <img alt="About Image" loading="lazy" src="<?php echo get_theme_mod("gs_firm_section_image", get_bloginfo("template_directory")."/assets/images/about.png"); ?>" alt="" class="about__wrap-img">
                <?php
            }
                ?>
            </div>
            
        </div>
        <div class="about__counter">
            <?php
            
                get_template_part('template-parts/shared/counter-template-part');
            ?>
        </div>
    </div>
</div>


<?php
get_template_part('template-parts/shared/office-location-template');
?>

<div class="container">
<div class="about-contact ">
    <div class="about-contact__content">
    <h2 tabindex="0" class="title--section">Get in touch</h2>
    <p class="about-contact__contact-text text">Our friendly team would love to hear from you.</p>
    <?php
     get_template_part('template-parts/shared/contact-form-template');
    ?>
    </div>
    <div class="about-contact__img-con">
        <img alt="About Image"  loading="lazy" src="<?php echo get_theme_mod("gs_firm_get_in_touch_image", get_bloginfo("template_directory")."/assets/images/contact.png");?>" alt="" class="about-contact__img">
    </div>
</div>
</div>

<?php
get_footer();
?>

