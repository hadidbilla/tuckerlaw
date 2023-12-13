<?php
get_header();
get_template_part('template-parts/shared/sidebar-nav-template');
get_template_part('template-parts/shared/banner-template');

$office_location_meta = get_post_meta(get_the_ID());
?>
<div class="contact-page">
  <div class="container">
    <div class="contact-page__wrap">
      <div class="contact-page__content">
        <h2 tabindex="0" class="title--section">
          Contact Us
        </h2>
        <div class="contact-page__contact-text text join__overview-richtext">
          <?php

          the_content();
          ?>
        </div>
        <?php
        get_template_part('template-parts/shared/contact-form-template', null,
        array(
          'locationName' => $office_location_meta['city'][0]
        ));
        ?>
      </div>
      <div class="slof">
        <div class="slof__cnt">
          <p class="slof__text text"><?php
            if ($office_location_meta['address'][0] || $office_location_meta['city'][0] || $office_location_meta['state'][0] || $office_location_meta['zip'][0] || $office_location_meta['country'][0] || $office_location_meta['suite'][0]) {
              echo $office_location_meta['address'][0] . ' ' . $office_location_meta['suite'][0] . ' ' . $office_location_meta['city'][0] . ', ' . $office_location_meta['state'][0] . ' ' . $office_location_meta['zip'][0];
            }
            ?></p>
          <div class="slof__rgt__cnt">
          <a href="<?php
                    echo $office_location_meta['map'][0];
                    ?>" class="slof-cont" data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now- navigable="true">
            <?php
            set_query_var("color", "slof__icon1");
            get_template_part("/assets/images/svg/map-pin-icon-round") ?>
          </a>
          <a href="<?php
                    echo $office_location_meta['map'][0];
                    ?>" target="_blank" class="" data-acsb-tooltip="New Window" data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-navigable="true">
             Directions to <?php echo$office_location_meta['city'][0]; ?>
          </a>
        </div>
        <?php
                if ($office_location_meta['phone'][0]) {
                  ?>
            <div class="slof-content">
              <a href="tel:<?php echo $office_location_meta['phone'][0] ?>" class="slof-cont" data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-
navigable="true">
                <?php
                set_query_var("color", "slof__icon1");
                get_template_part("/assets/images/svg/phone-icon-round") ?>
              </a>
              <a href="tel:<?php echo $office_location_meta['phone'][0] ?>" class="" data-acsb-tooltip="New Window"
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
            <div class="slof-content">
              <a href="tel:<?php echo $office_location_meta['fax'][0] ?>" class="slof-cont-fax" data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-
navigable="true">
                <?php
                set_query_var("color", "slof__icon2");
                get_template_part("/assets/images/svg/telephone-icon-round") ?>
              </a>
              <a href="tel:<?php echo $office_location_meta['fax'][0] ?>" class="slof-text " data-acsb-tooltip="New Window"
data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-navigable="true">
                
                  <?php
                    echo $office_location_meta['fax'][0];
                  ?>
                
              </a>
            </div>
            <?php
            } ?>

<?php
                if ($office_location_meta['email'][0]) {
                  ?>
            <div class="slof-content">
              <a href="<?php echo $office_location_meta['email'][0] ?>" class="slof-cont" data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-
navigable="true">
                <?php
                set_query_var("color", "slof__icon3");
                get_template_part("/assets/images/svg/mail-icon-round") ?>
              </a>
              <a href="mailto:<?php echo $office_location_meta['email'][0] ?>" class="slof-text " data-acsb-tooltip="New Window"
data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-navigable="true">
                
                  <?php
                    echo $office_location_meta['email'][0];
                  ?>
                </a>
              </div>
              <?php
            }
            ?>
          </div>
      </div>
    </div>
  </div>
</div>

</div>

<?php
get_footer();
?>