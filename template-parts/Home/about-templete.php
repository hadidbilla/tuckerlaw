<div class="about section--gap">
  <div class="container">
    <div class="about__wrp">
      <div class="about__header">
        <h3 tabindex="0" class="about__title title">
          <?php echo get_theme_mod("gs_about_title", "About Our Firm"); ?>
        </h3>
        <p class="about__text text">
          <?php
          $text="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Risus, sed imperdiet tincidunt integer sit mauris nunc.";
           echo get_theme_mod("gs_about_subtitle", $text); 
           ?>
        </p>
      </div>
      <div class="about__content">
        <div class="about__content__lft">
         
          <h2 tabindex="0" class="about__sec__title title--section" role="heading" aria-level="6">
            <?php echo get_theme_mod("gs_about_section_title", "Lorem ipsum dolor sit amet, consectetur adipiscing elit."); ?>
          </h2>
         
          
          <p class="about__conetent__text text">
            <?php echo get_theme_mod("gs_about_section_subtitle", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Neque, viverra turpis lorem lorem eu turpis massa elit. Luctus eget ut pellentesque volutpat augue bibendum. In sagittis turpis mi, viverra nisl ullamcorper. Sagittis donec sit amet, vel tellus sit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Neque, viverra turpis lorem lorem eu turpis massa elit."); ?>
          </p>
          
          <div class="about__btn__area">
            <a href="<?php echo get_site_url().'/about-firm' ?>" class="btn btn--primary about__btn">
            <?php get_template_part("/assets/images/svg/angle-icon") ?>
              <?php echo get_theme_mod("gs_about_section_btn_text", "About Our Firm"); ?>
            </a>
          </div>
        </div>
        <div class="about__content__rgt">
          <div class="about__img__area">
            <img alt="User Image" loading="lazy" loading="lazy" src="<?php echo get_theme_mod("gs_about_section_image", get_bloginfo("template_directory")."/assets/images/about.png"); ?>" alt="" class="about__img">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>