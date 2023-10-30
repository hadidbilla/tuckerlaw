<?php
//office_location post type all posts
$args = array(
  'post_type' => 'office_location',
  'posts_per_page' => -1,
);
$office_location_posts = new WP_Query($args);
// print_r($office_location_posts);

?>
<div class="office-location">
  <h2 tabindex="0" class="office-location__title office-location__title-res title" style="opacity: 1; perspective:
400px;" role="heading" aria-level="2">Office Locations</h2>
  <div class="office-location__img-con office-location__img-con-desktop">
    <img alt="Architecture downtown and skyscraper" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/achievement-location.png" alt="" class="office-location__img">
  </div>
  <div class="office-location__img-con office-location__img-con-responsive " aria-hidden="true" data-acsb-hidden="true">
    <img alt="Architecture downtown and skyscraper" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/achievement-location.png" alt="" class="office-location__img">
  </div>
  <div class="office-location__content">
    <h2 tabindex="0" tabindex="0" class="office-location__title office-location__title-desk title">Office Locations</h2>
    <div class="office-location__wrap">
      <?php
      if ($office_location_posts->have_posts()) {
        while ($office_location_posts->have_posts()) {
          $office_location_posts->the_post();
          //post title
          $post_title = get_the_title();
          $office_location_id = get_the_ID();
          // get office_location post meta
          $office_location_meta = get_post_meta($office_location_id);
          // print_r($office_location_meta);
      ?>
          <div class="office-location__loc-sec">
            <h3 tabindex="0" tabindex="0" class="office-location__sec-title title--card-small" role="heading" aria-level="6">
              <?php
              if ($post_title) {
                echo $post_title;
              }
              ?>
            </h3>
            <div class="office-location__sec-content">
              <a href="<?php
                echo $office_location_meta['map'][0];
              ?>" class="office-location__img-cont" data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-
navigable="true">
                <?php
                set_query_var("color", "office-location__icon1");
                get_template_part("/assets/images/svg/map-pin-icon-round") ?>
              </a>
              <a href="<?php
                echo $office_location_meta['map'][0];
              ?>" target="_blank"class="office-location__icon-text text--small" data-acsb-tooltip="New Window"
data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-navigable="true">
                <?php
                if ($office_location_meta['address'][0] || $office_location_meta['city'][0] || $office_location_meta['state'][0] || $office_location_meta['zip'][0] || $office_location_meta['country'][0] || $office_location_meta['suite'][0]) {
                  echo $office_location_meta['address'][0]. ' '.$office_location_meta['suite'][0].' '.$office_location_meta['city'][0].', '.$office_location_meta['state'][0].' '.$office_location_meta['zip'][0];
                }
                ?>
              </a>
            </div>
            <?php
                if ($office_location_meta['phone'][0]) {
                  ?>
            <div class="office-location__sec-content">
              <a href="tel:<?php echo $office_location_meta['phone'][0] ?>" class="office-location__img-cont" data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-
navigable="true">
                <?php
                set_query_var("color", "office-location__icon1");
                get_template_part("/assets/images/svg/phone-icon-round") ?>
              </a>
              <a href="tel:<?php echo $office_location_meta['phone'][0] ?>" class="office-location__icon-text text--small" data-acsb-tooltip="New Window"
data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-navigable="true">
                <?php
                
                  echo $office_location_meta['phone'][0];
               
                ?>
                </a>
              </div>
              <?php
            }
            ?>
            <?php
                if ($office_location_meta['fax'][0]) {
                  ?>
            <div class="office-location__sec-content">
              <a href="tel:<?php echo $office_location_meta['fax'][0] ?>" class="office-location__img-cont" data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-
navigable="true">
                <?php
                set_query_var("color", "office-location__icon2");
                get_template_part("/assets/images/svg/telephone-icon-round") ?>
              </a>
              <a href="tel:<?php echo $office_location_meta['fax'][0] ?>" class="office-location__icon-text text--small" data-acsb-tooltip="New Window"
data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-navigable="true">
                
                  <?php
                    echo $office_location_meta['fax'][0];
                  ?>
                
              </a>
            </div>
            <?php
            }
                ?>
                <?php
                if ($office_location_meta['email'][0]) {
                  ?>
            <div class="office-location__sec-content">
              <a href="<?php echo $office_location_meta['email'][0] ?>" class="office-location__img-cont" data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-
navigable="true">
                <?php
                set_query_var("color", "office-location__icon3");
                get_template_part("/assets/images/svg/mail-icon-round") ?>
              </a>
              <a href="mailto:<?php echo $office_location_meta['email'][0] ?>" class="office-location__icon-text text--small" data-acsb-tooltip="New Window"
data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-navigable="true">
                
                  <?php
                    echo $office_location_meta['email'][0];
                  ?>
                </a>
              </div>
              <?php
            }
            ?>
            <div class="office-location__main__cnt" aria-hidden="true" data-acsb-hidden="true">
                <?php
                //  print_r($office_location_meta);
                if($office_location_meta['asterisk__sentence'][0] != ''){
                  ?>
                  <p class="office-location__main__cnt__text">
                    <?php
                    echo $office_location_meta['asterisk__sentence'][0];
                    ?>
                  </p>
                  <?php
                }
                ?>
            </div>
          </div>
      <?php
        }
        //reset post data
        wp_reset_postdata();
      }
      ?>
    </div>
  </div>
</div>