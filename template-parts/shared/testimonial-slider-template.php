<?php
$awards = get_posts(array(
  'post_type' => 'awards',
  'posts_per_page' => -1,
  'post_status' => 'publish',
  'orderby' => 'date',
  'order' => 'DESC',
));
//meta data
$all_meta_data = [];
for ($i = 0; $i < count($awards); $i++) {
  $all_meta_data[] = get_post_meta($awards[$i]->ID);
}

// print_r($all_meta_data);

?>

<div class="slider">
  <div class="slider__wrap">
    <h2 tabindex="0" class="title--section">
      <?php
      echo $awards[0]->post_title;
      ?>
    </h2>
    <div class="join__overview-richtext testimonial__slider-text">
      <?php echo $all_meta_data[0]['awards_subtitle'][0] ?>
    </div>
      <div class="slider__card-contain testimonial__slider">
        <?php
        for ($i = 0; $i < $all_meta_data[0]['awards'][0]; $i++) {
          ?>
        <div class="slider__award-card">
          <div class="slider__award-img-con">
            <img loading="lazy" src="<?php
            echo wp_get_attachment_url($all_meta_data[0]['awards_' . $i . '_awards_image'][0]);
            ?>" alt="" class="slider__award-img">
          </div>
          <div class="slider__award-content">
            <h4 tabindex="0" class="title--card-small">
              <?php echo $all_meta_data[0]['awards_' . $i . '_awards_image_title'][0]; ?>
            </h4>
            <div class="join__overview-richtext testimonial__slider-text">
              <?php echo $all_meta_data[0]['awards_' . $i . '_awards_image_subtitle'][0]; ?>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
  </div>
</div>