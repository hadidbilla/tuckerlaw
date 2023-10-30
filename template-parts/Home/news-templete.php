<div class="news section--gap">
  <div class="container">
    <div class="news__wrp">
      <div class="news__header">
        <h3 tabindex="0" tabindex="0" class="news__title title">
          <?php echo esc_html(get_theme_mod('gs_news_title', 'LATEST News & Insights')); ?>
          
        </h3>
        <p class="news__text text">
          <?php echo esc_html(get_theme_mod('gs_news_subtitle', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Risus, sed imperdiet tincidunt integer sit mauris nunc.')); ?>
          
        </p>
      </div>
      
      <div class="news__tag__area">
      <?php
        $tags = get_tags(array(
          'orderby' => 'count',
          'order' => 'DESC',
          'number' => 10
        ));
        foreach ($tags as $tag) {
          ?>
          <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="news__tag">
            <?php echo esc_html($tag->name); ?>
          </a>
          <?php
        }
      ?>
      <a href="<?php echo esc_url(site_url('/news-insights/')); ?>" class="news__tag news__tag--bold" data-
acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-navigable="true"><span
class="acsb-sr-only" data-acsb-sr-only="true" data-acsb-force-visible="true" aria-
hidden="false" data-acsb-hidden="false" >
            See More
            <?php

              echo get_template_part( 'assets/images/svg/left-arrow' );
            ?>
          </a>
      </div>
      <div class="news__card__area">
      <?php
      $homePageNews = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 6,
        'order' => 'DESC',
        'orderby' => 'date',
      )); 
        while ($homePageNews-> have_posts()) {
          $homePageNews-> the_post();
        ?>
          <?php get_template_part("/template-parts/shared/blog-card-template-part") ?>
        <?php }
        
        echo paginate_links();
        ?>
        
      </div>
      <div class="news__btn__area">
        <a href="<?php 
          echo esc_url(site_url('/news-insights'));
        ?>" class="btn btn--primary news__btn">
          <?php
          set_query_var("color", "news__card__angle-icon-white");
          get_template_part("/assets/images/svg/angle-icon");
          echo get_theme_mod("gs_news_btn_text","View All News") 
          ?>
        </a>
      </div>
    </div>
  </div>
</div>


