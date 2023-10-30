<?php
$user_data = $args['user_meta_data'];
$image_list = [];
// loop length is the number of badges
// print_r($user_data['badges'][0]);
if ($user_data['badges'][0]) {

  for ($i = 0; $i < $user_data['badges'][0]; $i++) {
    // print_r($user_data['badges_' . $i . '_image']);
    // get the badge image
    $image_list[] = $user_data['badges_' . $i . '_image'];
  }
}

//get awards custom post data with all meta data
// print_r($user_data);
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
for($i=0; $i < $all_meta_data['awards'][0]; $i++){
  $all_meta_data_image[] = $all_meta_data['awards_'.$i.'_awards_image'][0];
}
// print_r($all_meta_data_image);

//is home page

$sliderClass = "";

function addClassBySliderCount($lenght){
  // print_r($lenght);
  //switch case for slider count
  switch ($lenght) {
    case 1:
      $sliderClass = "award__slider__cell--one";
      break;
    case 2:
      $sliderClass = "award__slider__cell--two";
      break;
    case 3:
      $sliderClass = "award__slider__cell--three";
      break;
    default:
      $sliderClass = "award__slider__cell--four";
      break;
  }

  return $sliderClass;

}


?>
<div class="award">
  <div class=" container">
    <div class="award__wrp">
      <div class="award__content">
        <h3 tabindex="0" tabindex="0" class="award__title" role="heading" aria-level="6">
          <?php echo get_theme_mod("gs_awards_title","awards & achievements"); ?>
        </h3>
        <?php
        //if is home page then show the content
        if (is_front_page()) {
          ?>
          <div class="award__text text">
          <?php echo get_theme_mod("gs_awards_subtitle","Trusted by More than 1 million Clients & Organizations"); ?>
        </div>
        <?php
        }
        ?>
      </div>
      <div class="award__items awards__slider" role="region" data-
acsb-carousel="true" data-acsb-force-visible="true" aria-label="Carousel" >
        <?php
        //if $image_list length is greater than 0
        if (count($all_meta_data_image) > 0 && is_front_page()) {
          // loop through the image list
          foreach ($all_meta_data_image as $image) {
            // print_r($image);
            if ($image == null) {
              continue;
            } else {
              $alt_text = get_post_meta($image, '_wp_attachment_image_alt', true);
        ?>
            <div aria-hidden="true" class="award__slider__cell <?php
              echo addClassBySliderCount(count($all_meta_data_image));?>">
                <img alt="<?php echo !empty($alt_text) ? esc_attr($alt_text) : 'Award Image';  ?>" loading="lazy" src="<?php echo wp_get_attachment_image_src($image, 'full')[0]?>" alt="" class="award__img">
              
            </div>
          <?php
            }
          }
        } else{
          //if $image_list length is greater than 0
          if (count($image_list) > 0) {
            // loop through the image list
            foreach ($image_list as $image) {
              print_r($image);
              
              if ($image[0] == null) {
                continue;
              } else {
          ?>
              <div class="award__slider__cell <?php
              echo addClassBySliderCount(count($image_list));
            ?>">
                  <img alt="Award Image"  loading="lazy" src="<?php echo wp_get_attachment_image_src($image[0], 'full')[0]?>" alt="" class="award__img">
              </div>
            <?php
              }
            }
          }
        }
        ?>

      </div>
    </div>
  </div>
</div>