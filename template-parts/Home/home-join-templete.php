<div class="attorney section--padding">
  <div class="container">
    <div  class="attorney__wrp">
      <div class="attorney__header">
        <h3 tabindex="0" tabindex="0" class="attorney__title title" style="opacity: 1; perspective: 400px;" role="heading" aria-
level="2">
          <?php echo get_theme_mod("gs_attorneys_title", "Our Attorneys"); ?>
        </h3>
        <p tabindex="0" class="attorney__text attorney__text__top text">
          <?php echo get_theme_mod("gs_attorneys_subtitle", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sed pellentesque"); ?>
        </p>
      </div>
      <div class="attorney__img__area">
        <img alt="Stadium competition and people"  loading="lazy" src="<?php echo get_theme_mod("gs_attorneys_img", get_bloginfo("template_directory")."/assets/images/attorneys.png"); ?>" alt="" class="attorney__img">
      </div>
      <p class="attorney__text attorney__text__btm text">
      <?php echo get_theme_mod("gs_attorneys_subtitle", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sed pellentesque"); ?>
        </p>
      <div class="attorney__btn__area">
        <a href="<?php if(is_numeric(get_theme_mod("gs_attorneys_button_link", "#"))){
            echo get_page_link(get_theme_mod("gs_attorneys_button_link", "#"));
          }else{
            echo get_theme_mod("gs_attorneys_button_link", "#");
          } ?>" class="btn btn--primary attorney__btn">
        <?php get_template_part("/assets/images/svg/angle-icon");
          echo get_theme_mod("gs_attorneys_button_text", "View All Attorneys"); ?>
        </a>
      </div>
    </div>
  </div>
</div>
