<div class="subc">
  <div class="subc__wrp container">
    <div class="subc__lft">
      <div class="subc__lft__wrp ">
        <div class="subc__title-text-con">
          <h1 tabindex="0" class="subc__ttl title--section" role="heading" aria-level="3">
            <?php echo get_theme_mod('gs_cta_title',"Yeah! Your Eye Catchy CTA Title Goes Here"); ?>
          </h1>
          <p class="subc__txt text">
            <?php echo get_theme_mod('gs_cta_subtitle',"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo."); ?>
          </p>
        </div>
        <div class="subc__btn__area">
          <a href="<?php if(is_numeric(get_theme_mod("gs_practice_btn_link", "#"))){
            echo get_page_link(get_theme_mod("gs_practice_btn_link", "#"));
          }else{
            echo get_theme_mod("gs_practice_btn_link", "#");
          } ?>" class="subc__btn btn btn--primary">
            <?php
            set_query_var("color", "subc__grid-icon");
            get_template_part("/assets/images/svg/grid-icon");
              echo get_theme_mod('gs_practice_btn_text',"Capabilities"); ?>

          </a>
          <a href="<?php if(is_numeric(get_theme_mod("gs_professionals_btn_link", "#"))){
            echo get_page_link(get_theme_mod("gs_professionals_btn_link", "#"));
          }else{
            echo get_theme_mod("gs_professionals_btn_link", "#");
          } ?>" class="subc__btn btn btn--secondary">
            <?php get_template_part('/assets/images/svg/search-icon'); 
            echo get_theme_mod('gs_professionals_btn_text',"Search Attorneys"); ?>
            
          </a>
        </div>
      </div>
    </div>
    <div class="subc__rgt">
      <div class="subc__rgt__wrp">
        <div class="subc__title-text-con">
          <h1 tabindex="0" class="subc__rgt__title subc__ttl title--section" role="heading" aria-level="3">
            <?php echo get_theme_mod('gs_subscribe_title',"Subscribe to our Legal Insights Email"); ?>
            </h1>
          <p class="subc__rgt__txt text">
          <?php echo get_theme_mod('gs_subscribe_subtitle',"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sed pellentesque"); ?>
          </p>
        </div>
        <?php
          echo do_shortcode('[contact-form-7 id="22121" title="Subscription Form"]');
        ?>
      </div>
    </div>
  </div>
</div>