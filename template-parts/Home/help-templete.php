<?php
//get capabilities all texonomy terms
$args = array(
  'taxonomy' => 'capabilities_category',
  'hide_empty' => false,
);
$terms = get_terms($args);
?>

<div class="help section--gap">
  <div class="help__wrp">
    <div class="container">
      <div class="help__header">
        <h3 tabindex="0" tabindex="0" class="help__title title" style="opacity: 1; perspective: 400px;" role="heading" aria-
level="2">
          <?php echo get_theme_mod('gs_help_title', 'How can we help you'); ?>
        </h3>
      </div>
    </div>
    <div class="help__card__area">
      <?php
      if ($terms) {
        //reverse the array
        $terms = array_reverse($terms);
        foreach ($terms as $trm) {
          $term_id = $trm->term_id;
          $term_name = $trm->name;
          //get the term meta
          $term_meta = get_term_meta($term_id);
          // print_r($term_meta);
          $feature_img = wp_get_attachment_image_src($term_meta['feature_image'][0], 'full');
         
      ?>
          <div class="help__card card--animation">
            <div aria-label="Card Overlay" class="help__card__overlay"></div>
            <img aria-hidden="true" data-acsb-hidden="true" alt="Help Image" loading="lazy" src="<?php echo $feature_img[0] ?>" alt="" class="help__card__img">
            
            <div class="help__card__content">
              <h3 tabindex="0" class="help__card__title title--card-small" role="heading" aria-level="5">
                <?php 
                  if($term_meta['header_title'][0] != ''){
                    echo $term_meta['header_title'][0];
                  }else{
                    echo $term_name;
                  }
                ?>
              </h3>
              <div class="help__card__content__btm">
                <?php
                  if($term_meta['description'][0] != ''){
                    ?>
                    <p class="help__card__text text">
                  <?php echo substr($term_meta['description'][0], 0, 100); ?>
                </p>
                    <?php
                  }
                ?>
                <div class="help__card__btn__area" aria-hidden="true" data-acsb-hidden="true">
                  <a tabindex='-1' href="<?php echo get_site_url()."/capabilities#".$trm->slug ?>" class="btn btn--primary help__card__btn" data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-navigable="true"><span class="acsb-sr-only" data-acsb-sr-only="true" data-acsb-force-visible="true" aria-hidden="false" data-acsb-hidden="false">
                    View More
                    <?php get_template_part("/assets/images/svg/angle-icon") ?>
                  </a>
                </div>
              </div>
            </div>
          </div>
      <?php
        }
      }
      ?>
    </div>
    <div class="container">
    <div class="help__btn__area">
      <a href="<?php echo get_site_url().'/capabilities' ?>" class="btn btn--primary help__btn">
        <?php get_template_part("/assets/images/svg/angle-icon");
        echo get_theme_mod('gs_help_button_text', 'View All Help'); ?>
      </a>
    </div>
    </div>
  </div>
</div>