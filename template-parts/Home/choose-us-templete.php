<style>
  .choose__card__text p::before {
    content: url(<?php echo get_template_directory_uri() . '/assets/images/check-icon.svg' ?>);
    position: absolute;
    width: 16px;
    height: 16px;
    top: 4px;
    left: -24px;
  }

  @media screen and (max-width: 1024px) {
    .choose__card__text::before {
      display: none;
    }
  }
</style>

<div class="choose section--gap">
  <div class="container">
    <div class="choose__wrp">
      <div class="choose__header">
        <h3 tabindex="0" tabindex="0" class="choose__title title" style="opacity: 1; perspective: 400px;" role="heading" aria-
level="2">
          <?php echo get_theme_mod("gs_choose_title", "Why Choose Us"); ?>
        </h3>
        <p class="choose__text text">
          <?php echo get_theme_mod("gs_choose_description", "Since our founding, our attorneys have continued to set industry benchmarks for expertise, value, and dedication to our clients.");
          ?>
        </p>
      </div>
      <div class="choose__eth__img__area" aria-hidden="true" data-acsb-hidden="true">
        <img alt="Choose Image" loading="lazy" src="<?php echo esc_url(get_theme_mod("gs_choose_image", '' . get_bloginfo("template_directory") . '/assets/images/frame.png')); ?>" alt="" class="choose__eth__img">
      </div>
      <div class="choose__content__area">
        <div class="choose__content__lft">
          <div class="choose__card choose__card__lft">
            <div class="choose__card__icon">
              <img alt="Choose Image" loading="lazy" src="<?php
                        echo esc_url(get_theme_mod("gs_choose_card_1_image", "" . get_bloginfo("template_directory") . "/assets/images/client.png"));
                        ?>" alt="" class="choose__card__img">
            </div>
            <div class="choose__card__content">
              <h4 tabindex="0" tabindex="0" class="choose__card__title " role="heading" aria-level="4">
                <?php echo get_theme_mod("gs_choose_card_1_title", "Client First Mentality"); ?>
              </h4>
              <div class="choose__card__text text">
                <?php echo get_theme_mod("gs_choose_card_1_description", "We always put the needs of the client before anything else."); ?>
              </div>
            </div>
          </div>
          <div class="choose__card choose__card__lft">
            <div class="choose__card__icon">
              <img alt="Choose Image" loading="lazy" src="<?php
                        echo esc_url(get_theme_mod("gs_choose_card_2_image", "" . get_bloginfo("template_directory") . "/assets/images/ethics.png"));
                        ?>" alt="" class="choose__card__img">
            </div>
            <div class="choose__card__content">
              <h4 tabindex="0" tabindex="0" class="choose__card__title " role="heading" aria-level="4">
                <?php echo get_theme_mod("gs_choose_card_2_title", "Ethics & Integrity"); ?>
              </h4>
              <div class="choose__card__text text">
                <?php echo get_theme_mod("gs_choose_card_2_description", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Risus, sed imperdiet tincidunt integer sit mauris nunc."); ?>
              </div>
            </div>
          </div>
          <div class="choose__card choose__card__lft">
            <div class="choose__card__icon">
              <img alt="Choose Image" loading="lazy" src="<?php
                        echo esc_url(get_theme_mod("gs_choose_card_3_image", "" . get_bloginfo("template_directory") . "/assets/images/Collaboration.png"));
                        ?>" alt="" class="choose__card__img">
            </div>
            <div class="choose__card__content">
              <h4 tabindex="0" tabindex="0" class="choose__card__title " role="heading" aria-level="4">
                <?php echo get_theme_mod("gs_choose_card_3_title", "Ethics & Integrity"); ?>

              </h4>
              <div class="choose__card__text text">
                <?php echo get_theme_mod("gs_choose_card_3_description", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Risus, sed imperdiet tincidunt integer sit mauris nunc."); ?>

              </div>
            </div>
          </div>
        </div>
        <div class="choose__content__mid">
          <div class="choose__main__img__area">
            <img alt="Justice balance and weight" loading="lazy" src="<?php

                      echo esc_url(get_theme_mod("gs_choose_image", '' . get_bloginfo("template_directory") . '/assets/images/frame.png')); ?>" alt="" class="choose__main__img">

          </div>
        </div>
        <div class="choose__content__rgt">
          <div class="choose__card choose__card__rgt">
            <div class="choose__card__icon">
              <img alt="Choose Image" loading="lazy" src="<?php
                        echo esc_url(get_theme_mod("gs_choose_card_4_image", "" . get_bloginfo("template_directory") . "/assets/images/independence.png"));
                        ?>" alt="" class="choose__card__img">
            </div>
            <div class="choose__card__content">
              <h4 tabindex="0" tabindex="0" class="choose__card__title " role="heading" aria-level="4">
                <?php echo get_theme_mod("gs_choose_card_4_title", "Independence & Entrepreneurship"); ?>

              </h4>
              <div class="choose__card__text text">
                <?php echo get_theme_mod("gs_choose_card_4_description", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Risus, sed imperdiet tincidunt integer sit mauris nunc."); ?>

              </div>
            </div>
          </div>
          <div class="choose__card choose__card__rgt">
            <div class="choose__card__icon">
              <img alt="Choose Image"  loading="lazy" src="<?php
                        echo esc_url(get_theme_mod("gs_choose_card_5_image", "" . get_bloginfo("template_directory") . "/assets/images/transparency.png"));
                        ?>" alt="" class="choose__card__img">
            </div>
            <div class="choose__card__content">
              <h4 tabindex="0" tabindex="0" class="choose__card__title " role="heading" aria-level="4">
                <?php echo get_theme_mod("gs_choose_card_5_title", "Transparency"); ?>

              </h4>
              <div class="choose__card__text text">
                <?php echo get_theme_mod("gs_choose_card_5_description", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Risus, sed imperdiet tincidunt integer sit mauris nunc."); ?>

              </div>
            </div>
          </div>
          <div class="choose__card choose__card__rgt">
            <div class="choose__card__icon">
              <img alt="G" loading="lazy" src="<?php
                        echo esc_url(get_theme_mod("gs_choose_card_6_image", "" . get_bloginfo("template_directory") . "/assets/images/history.png"));
                        ?>" alt="" class="choose__card__img">
            </div>
            <div class="choose__card__content">
              <h4 tabindex="0" tabindex="0" class="choose__card__title " role="heading" aria-level="4">
                <?php echo get_theme_mod("gs_choose_card_6_title", "History"); ?>
              </h4>
              <div class="choose__card__text text">
                <?php echo get_theme_mod("gs_choose_card_6_description", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Risus, sed imperdiet tincidunt integer sit mauris nunc."); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>