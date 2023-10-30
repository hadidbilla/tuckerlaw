

<div class="hhero">
  <?php
      $img_array = [] ;
      $img = get_theme_mod("gs_home_hero_img", get_bloginfo("template_directory")."/assets/images/hero-bg.png");
      //get this image path to 
  ?>
  <img alt="Home Image" src="<?php echo get_theme_mod("gs_home_hero_img", get_bloginfo("template_directory")."/assets/images/hero-bg.png"); ?>" alt="Home Image" class="hhero__bg__img"
  srcset="<?php echo get_theme_mod("gs_home_hero_img", get_bloginfo("template_directory")."/assets/images/hero-bg.png"); ?> 1920w,
  <?php echo get_theme_mod("gs_home_hero_img", get_bloginfo("template_directory")."/assets/images/hero-bg.png"); ?> 768w,
  <?php echo get_theme_mod("gs_home_hero_img", get_bloginfo("template_directory")."/assets/images/hero-bg.png"); ?> 480w"
  sizes="(max-width: 300px) 100vw, 300px, (max-width: 768px) 100vw, 768px, (max-width: 1920px) 100vw, 1920px"
  />
  
  <div class="hhero__overly"></div>
  <div class="hhero__wrp container">
    <div class="hhero__lft" data-acsb-main="true" role="main">
    <div class="hhero__overly--res" aria-hidden="true" data-acsb-hidden="true"></div>
    <img alt="Home Image" src="<?php echo get_theme_mod("gs_home_hero_img", get_bloginfo("template_directory")."/assets/images/hero-bg.png"); ?>" alt="" class="hhero__bg__img--res" aria-hidden="true" data-
acsb-hidden="true" >
      <h1 tabindex="0" class="hhero__title hero__animation"  role="heading" aria-level="1"> <?php echo get_theme_mod("gs_home_hero_title","RAISE THE BAR & IMPROVE YOUR BOTTOM LINE"); ?> </h1>
      
      <div class="hhero__link__area ">
        <a href="<?php if(is_numeric(get_theme_mod("gs_home_hero_practice_btn_link", "#"))){
            echo get_page_link(get_theme_mod("gs_home_hero_practice_btn_link", "#"));
          }else{
            echo get_theme_mod("gs_home_hero_practice_btn_link", "#");
          } ?>" class="hhero__link btn  btn--primary">
          <?php echo  get_template_part("/assets/images/svg/user-icon");
          echo get_theme_mod("gs_home_hero_practice_btn_text",'PRACTICE AREAS'); ?>
        </a>
        <a href="<?php if(is_numeric(get_theme_mod("gs_home_hero_search_btn_link", "#"))){
            echo get_page_link(get_theme_mod("gs_home_hero_search_btn_link", "#"));
          }else{
            echo get_theme_mod("gs_home_hero_search_btn_link", "#");
          } ?>" class="hhero__link btn  btn--secondary">
          <?php
          get_template_part("/assets/images/svg/search-icon");
          echo get_theme_mod("gs_home_hero_search_btn_text",'SEARCH PROFESSIONALS');
          ?>
        </a>
      </div>
    </div>
    <div class="hhero__rgt">
      <div class="hhero__rgt__wrp">
        <div class="hhero__lft__header">
          <h2 tabindex="0" tabindex="0" class="hhero__header__title text" role="heading" aria-level="4">
            <?php echo get_theme_mod("gs_home_hero_form_title", "Find your legal Professional"); ?>
          </h2>
          <p class="hhero__header__subtitle text"> <?php echo get_theme_mod("gs_home_hero_form_subtitle", "Choose from any or all of the categories below to find a legal professional that can help you."); ?> </p>
        </div>
        <form class="hhero__frm" action="<?php 
        //redirect to the people page
        echo get_permalink( get_page_by_path('people'))
        ?>" method="get" >
          <div class="hhero__frm__inputs">
            <input id="name" name="user-name" type="text" class="hhero__frm__input" placeholder="Name (Ex: John)" data-acsb-navigable="true" data-acsb-now-navigable="true"
aria-hidden="false" data-acsb-hidden="false" data-acsb-validation-uuid="name" data-acsb-
field-visible="true" aria-required="true" required="true" aria-invalid="true" aria-label="Name
(Ex: John)" data-acsb-tooltip="Name (Ex: John) | Required field">
          
            <div class="select-wrap">
              <?php
                $args = array(
                  'post_type' => 'capabilities',
                  'posts_per_page' => -1,
                  'orderby' => 'title',
                  'order' => 'ASC',
                );
                $query = new WP_Query($args);
              ?>
              <select tabindex="0" aria-label="Practice Area" class=" select hhero__frm__select" name="practice-area" id="practice-area" data-acsb-navigable="true" data-acsb-now-navigable="true" aria-hidden="false" data-acsb-hidden="false" type="select-one" data-acsb-validation-uuid="practice-area" data-acsb-field-visible="true" aria-required="true" required="true" aria-invalid="true" placeholder="Practice Area" data-acsb-tooltip="Practice Area | Required field">
                <option class="hhero__select__placeholder"   value="" disabled selected>Practice Area</option>
                <?php  
                  if($query->have_posts()){
                    while($query->have_posts()){
                      $query->the_post();
                      $practice_area = get_the_title();
                      $slug = get_post_field('post_name', get_post());
                      echo '<option class="hhero__option-fld" value="'.$slug.'">'.$practice_area.'</option>';
                    }
                  }
                ?>
              </select>
            </div>
            <div class="select-wrap">
            <?php
      // get office_location all posts
      $args = array(
        'post_type' => 'office_location',
        'posts_per_page' => -1
      );
      $office_location_posts = new WP_Query($args);
      ?>
              <select tabindex="0" aria-label="Office Location" class="select hhero__frm__select" name="office" id="office" data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-navigable="true" aria-hidden="false" data-acsb-hidden="false" type="select-one" data-acsb-validation-uuid="office" data-acsb-field-visible="true" aria-required="true" required="true" aria-invalid="true"
 placeholder="Office Location" data-acsb-tooltip="Office Location | Required field">
                <option class="hhero__select__placeholder" value="" disabled selected>Office Location</option>
                <?php
                if ($office_location_posts->have_posts()) {
                  while ($office_location_posts->have_posts()) {
                    $office_location_posts->the_post();
                    $office_location = get_the_title();
                    $slug = get_post_field('post_name', get_post());
                    echo '<option class="hhero__option__fld" value="' . $slug . '">' . $office_location . '</option>';
                  }
                }
                ?>
              </select>
            </div>
            <button type="submit" class="hhero__submit__btn btn btn--primary">
              <?php get_template_part("/assets/images/svg/search-icon"); ?> Search
            </button>
            <button type="reset" type="submit" class="hhero__submit__btn btn btn--primary hhero__submit__btn--reset">
              <?php get_template_part("/assets/images/svg/reset-icon"); ?> Reset Filters
            </button>
          </div>
        </form>
        <div class="footer__second-logo-con">
          <p class="text--smallest align-left">Proud Member of the</p>
          <div class="footer__logo-con  footer__second">
            <a href="https://www.lawfirmalliance.org/" target="_blank" target="
_
blank" data-acsb-tooltip="New Window"
data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-navigable="true">
<span class="acsb-sr-only" data-acsb-sr-only="true" data-acsb-force-visible="true" aria-
hidden="false" data-acsb-hidden="false" >
            <img alt="Law Firm ALLIANCE" loading="lazy" src="<?php
                      echo esc_url(get_theme_mod("gs_footer_img2", "" . get_template_directory_uri() . '/assets/images/footer-logo2.png'));
                      ?>" alt='' class="footer__logo">
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>