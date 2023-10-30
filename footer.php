<?php
 //if current page is not About Firm page
  // if(!is_page_template("about-page-template.php")){
  //   print_r("not about page");
  // }
  
  //get the current page name and check if it is about page
  $current_page = get_post(get_the_ID());
  if($current_page->post_name != "about-firm"){
    get_template_part('template-parts/Home/subscribe-templete');
  }
  // get_template_part('template-parts/About/our-people');
  //get awards custom post data with all meta data
$awards = get_posts(array(
  'post_type' => 'awards',
  'posts_per_page' => -1,
  'post_status' => 'publish',
  'orderby' => 'date',
  'order' => 'DESC',
));
//get awards custom post title
$title = $awards[0]->post_title;
$all_meta_data = get_post_meta($awards[0]->ID);
$all_meta_data_image = [];
// print_r($all_meta_data);
for($i=0; $i < $all_meta_data['awards'][0]; $i++){
  $all_meta_data_image[] = $all_meta_data['awards_'.$i.'_awards_image'][0];
}

$sliderClass = "";

function addFooterClassBySliderCount($lenght){
  // print_r($lenght);
  //switch case for slider count
  switch ($lenght) {
    case 1:
      $sliderClass = "award__slider__cell__footer--one";
      break;
    case 2:
      $sliderClass = "award__slider__cell__footer--two";
      break;
    case 3:
      $sliderClass = "award__slider__cell__footer--three";
      break;
    default:
      $sliderClass = "award__slider__cell__footer--four";
      break;
  }

  return $sliderClass;

}
?>
<footer class="footer section--padding" id="section2" data-acsb-overflower="true" data-acsb-
page-footer="true" role="contentinfo" aria-label="Footer">

  <div class="container">
    <div class="footer__wrap">
      <div class="footer__content-links">
        <?php
        //forloop six times
        for ($i = 1; $i <= 6; $i++) {
          if (has_nav_menu('footer' . $i)) {
            $menu_obj = wp_get_nav_menu_name('footer' . $i);
        ?>
            <div class="footer__link-sec" role="navigation" aria-label="Home" >
                <h5 class="text text--white center footer__link__title" role="heading" aria-level="6">
                  <?php echo $menu_obj; ?>
                </h5>
              
              <?php
              wp_nav_menu(array(
                'theme_location' => 'footer' . $i,
                'menu_class' => 'footer__lists',
                'container' => 'ul'
              ));
              ?>
            </div>
        <?php
          }
        }
        ?>

      </div>

      <div class="award__items awards__slider-footer " role="region"
data-acsb-carousel="true" data-acsb-force-visible="true" aria-label="Carousel">
      <?php
        //if $image_list length is greater than 0
        if (count($all_meta_data_image) > 0) {
          // loop through the image list
          foreach ($all_meta_data_image as $image) {
            // print_r($image);
            if ($image == null) {
              continue;
            } else {
              $alt_text = get_post_meta($image, '_wp_attachment_image_alt', true);
        ?>
            <div  class="award__slider__cell <?php
              echo addFooterClassBySliderCount(count($all_meta_data_image));?>">
                <img alt="<?php echo !empty($alt_text) ? esc_attr($alt_text) : 'Award Image';  ?>" loading="lazy" src="<?php echo wp_get_attachment_image_src($image, 'full')[0]?>" alt="" class="award__img">
              
            </div>
          <?php
            }
          }
        }
        ?>
      </div>


      <div class="footer__social-links">
        <div class="footer__logo-con footer__logo-fst">
          <img alt="Footer Logo" alt="Footer Logo" loading="lazy" src="<?php echo esc_url(get_theme_mod("gs_footer_img1", "" . get_template_directory_uri() . '/assets/images/brand-logo.png')); ?>" alt="" class="footer__logo">

        </div>
        <div class="footer__social-con">
          <div class="footer__social-link-text" role="navigation" aria-label="Footer Menu" >
            <?php
            if (has_nav_menu('footer_horizontal')) {
              wp_nav_menu(array(
                'theme_location' => 'footer_horizontal',
                'menu_class' => 'footer__socials',
                'container' => 'ul'
              ));
            }
            ?>
          </div>
          <div class="footer__social-link-icon">
            <a href="<?php echo get_theme_mod("gs_footer_twitter", "#") ?>" class="footer__social__link" data-acsb-
clickable="true" data-acsb-navigable="true" data-acsb-now-navigable="true">
              <img alt="Footer Logo" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter-icon.png" alt="" class="footer__social-icon">
            </a>
            <a href="<?php echo get_theme_mod("gs_footer_linkedin", "#") ?>" class="footer__social__link" data-acsb-
clickable="true" data-acsb-navigable="true" data-acsb-now-navigable="true">
              <img alt="Footer Logo" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/linkedin-icon.png" alt="" class="footer__social-icon">
            </a>
            <a href="<?php echo get_theme_mod("gs_footer_facebook", "#") ?>" class="footer__social__link" data-acsb-
clickable="true" data-acsb-navigable="true" data-acsb-now-navigable="true">
              <img alt="Footer Logo" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook-icon.png" alt="" class="footer__social-icon">
            </a>
            <a href="<?php echo get_theme_mod("gs_footer_instagram", "#") ?>" class="footer__social__link" data-acsb-
clickable="true" data-acsb-navigable="true" data-acsb-now-navigable="true">
              <?php
                echo get_template_part("/assets/images/svg/instagram-icon");
              ?>
            </a>
            <a href="<?php echo get_theme_mod("gs_footer_youtube", "#") ?>" class="footer__social__link" data-acsb-
clickable="true" data-acsb-navigable="true" data-acsb-now-navigable="true">
              <?php
                //youtube
                echo get_template_part("/assets/images/svg/youtube-icon");
              ?>
            </a>
          </div>
        </div>
        <div class="footer__second-logo-con">
          <p class="text--smallest align-left">Proud Member of the</p>
          <div class="footer__logo-con  footer__second" data-acsb-tooltip="New Window"
data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-navigable="true">
            <a href="https://www.lawfirmalliance.org/" target="_blank">
            <img alt="Footer Logo" loading="lazy" src="<?php
                      echo esc_url(get_theme_mod("gs_footer_img2", "" . get_template_directory_uri() . '/assets/images/footer-logo2.png'));
                      ?>" alt='' class="footer__logo">
            </a>
            
          </div>
        </div>
      </div>

      <div class="footer__copyright">
        <p class="text--smallest center">
          <?php echo get_theme_mod('gs_footer_copyright', '© 2022 Tucker Arensberg, P.C. All Rights Reserved.'); ?>
        </p>
      </div>
      <div class="footer__copyright">
        <p class="text--smallest center">
            Designed and Developed by <a target="_blank" class="footer__copyright__link" href="https://mentiscollective.com/" target="_blank" data-
acsb-tooltip="New Window" data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-
now-navigable="true">Mentis Collective. </a>
        </p>
      </div>
    </div>
  </div>
</footer>
<?php wp_footer() ?>
</body>

</html>