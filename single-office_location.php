<?php
get_header();
get_template_part('template-parts/shared/sidebar-nav-template');
get_template_part('template-parts/shared/banner-template');

$office_location_meta = get_post_meta(get_the_ID());

$page = ($_GET['pages']) ? $_GET['pages'] : 1;
      $per_page = get_option('posts_per_page');
      $offset = (($page - 1) * $per_page);
// get professors users roll this location
$professors = get_users(array(
  'role__in' => array('professor'),
  'number' => -1,
  'meta_query' => array(
    array(
      'key' => 'office_location',
      'value' => get_the_ID(),
      'compare' => 'LIKE'
    )
  )
));

//get these professors services, industries, Departments

$professors_services = array();
$professors_industries = array();
$professors_departments = array();

foreach ($professors as $professor) {
  $professor_services = get_user_meta($professor->ID, 'services', true);
  $professor_industries = get_user_meta($professor->ID, 'industries', true);
  $professor_departments = get_user_meta($professor->ID, 'departments', true);
  if ($professor_services) {
    foreach ($professor_services as $professor_service) {
      //post title by id
      $post_title = get_the_title($professor_service);
      //post link by id
      $post_link = get_the_permalink($professor_service);
      if (!in_array($professor_service, $professors_services)) {
        array_push($professors_services, $professor_service);
      }
    }
  }

  if ($professor_industries) {
    foreach ($professor_industries as $professor_industry) {
      if (!in_array($professor_industry, $professors_industries)) {
        array_push($professors_industries, $professor_industry);
      }
    }
  }

  if ($professor_departments) {
    foreach ($professor_departments as $professor_department) {
      if (!in_array($professor_department, $professors_departments)) {
        array_push($professors_departments, $professor_department);
      }
    }
  }
}

// combine all the services, industries, Departments in one array
$professors_services = array($professors_services, $professors_industries, $professors_departments);

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
        get_template_part(
          'template-parts/shared/contact-form-template',
          null,
          array(
            'locationName' => $office_location_meta['city'][0]
          )
        );
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
              Directions to <?php echo $office_location_meta['city'][0]; ?>
            </a>
          </div>
          <?php
          if ($office_location_meta['phone'][0]) {
          ?>
            <div class="slof-content">
              <a href="tel:<?php echo $office_location_meta['phone'][0] ?>" class="slof-cont" data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now- navigable="true">
                <?php
                set_query_var("color", "slof__icon1");
                get_template_part("/assets/images/svg/phone-icon-round") ?>
              </a>
              <a href="tel:<?php echo $office_location_meta['phone'][0] ?>" class="" data-acsb-tooltip="New Window" data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-navigable="true">
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
              <a href="tel:<?php echo $office_location_meta['fax'][0] ?>" class="slof-cont-fax" data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now- navigable="true">
                <?php
                set_query_var("color", "slof__icon2");
                get_template_part("/assets/images/svg/telephone-icon-round") ?>
              </a>
              <a href="tel:<?php echo $office_location_meta['fax'][0] ?>" class="slof-text " data-acsb-tooltip="New Window" data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-navigable="true">

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
              <a href="<?php echo $office_location_meta['email'][0] ?>" class="slof-cont" data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now- navigable="true">
                <?php
                set_query_var("color", "slof__icon3");
                get_template_part("/assets/images/svg/mail-icon-round") ?>
              </a>
              <a href="mailto:<?php echo $office_location_meta['email'][0] ?>" class="slof-text " data-acsb-tooltip="New Window" data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-now-navigable="true">

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
    <?php
    if (count($professors) > 0) {
    ?>
      <div class="services-wrap">
        <h2 tabindex="0" class="title--section" style="margin-top: 80px; margin-bottom: 30px;">
          Services at <?php echo get_the_title(); ?>
        </h2>
        <div class="services__cat-contain">
          <?php
          $parent_category = array("services", "industries", "departments");
          foreach ($parent_category as $key => $parent_cat) {
            // if (count($professors_services[$key]) == 0) {
            //   continue;
            // }
            if ($key != 0) {
              continue;
            }
            //get capabilities_category id by name
            $category = get_term_by('name', $parent_cat, 'capabilities_category');
            //get meta data of capabilities_category
            $category_meta = get_term_meta($category->term_id);
            // get the category image by id
            $category_image = wp_get_attachment_image_src($category_meta['feature_image'][0], 'full');
          ?>
            <div class="services__cat-sec">
              <div class="services__cat-img-con">
                <div class="services__overlay"></div>
                <img loading="lazy" src="<?php if ($category_image) {
                                            echo $category_image[0];
                                          } else {
                                            echo get_template_directory_uri() . '/assets/images/services-category.png';
                                          } ?>" alt="Capabilities Image" class="services__cat-img" alt="Blog Image">
              </div>
              <div class="services__cat-hover">
                <ul class="services__cat-lists">
                  <?php
                  foreach ($professors_services[$key] as $new_service) {
                  ?>

                    <li class="services__cat-list">
                      <a href="<?php echo get_the_permalink($new_service)  ?>" class="services__cat-item text--small">
                        <?php echo get_the_title($new_service) ?>
                      </a>
                    </li>
                  <?php
                  }
                  ?>
                </ul>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>

      <div id="people" class="">
        <h2 tabindex="0" class="title--section" style="margin-top: 80px; margin-bottom: 30px;">
          People at <?php echo get_the_title(); ?>
        </h2>
        <div class="people__card-contain">

          <?php
          $new_professors = get_users(array(
            'role__in' => array('professor'),
            'number' => $per_page,
            'offset' => $offset,
            'paged' => $page,
            //last name ASC
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'meta_key' => 'last_name',
            'meta_query' => array(
              array(
                'key' => 'office_location',
                'value' => get_the_ID(),
                'compare' => 'LIKE'
              )
            )
          ));
          foreach ($new_professors as $user) {
            $user_data = get_user_meta($user->ID);
            $user_mail = $user->user_email;
            //get biography_image id to get biography_image url
            $biography_image_id = $user_data['biography_image'][0];
            $biography_image_url = wp_get_attachment_image_src($biography_image_id, 'full');
            $featured_image_id = $user_data['featured_image'][0];
            $featured_image_url = wp_get_attachment_image_src($featured_image_id, 'full');
            $user_parma_link = get_author_posts_url($user->ID);
          ?>
            <div class="people__card">
              <a href="<?php echo $user_parma_link ?>" class="people__card-image-con">
                <?php
                //  echo $profile_img; 
                if ($featured_image_url[0] && $featured_image_url[0] != '') {
                ?>
                  <img loading='lazy' alt='alt attribute' src="<?php echo $featured_image_url[0]; ?>" alt='' class='people__card-image'>
                <?php
                } elseif ($biography_image_url[0] && $biography_image_url[0] != '') {
                ?>
                  <img loading='lazy' alt='alt attribute' src="<?php echo $biography_image_url[0]; ?>" alt='' class='people__card-image'>
                <?php
                } else {
                ?>
                  <img loading='lazy' alt='alt attribute' src="<?php echo get_template_directory_uri(); ?>/assets/images/attorney_avatar.jpg" alt='' class='people__card-image'>
                <?php
                }
                ?>
              </a>
              <div class="people__card-content">
                <a href="<?php echo $user_parma_link ?>" class="people__card-name">
                  <?php
                  if (isset($user_data['first_name'][0])) {
                    echo $user_data['first_name'][0] . " " . $user_data['last_name'][0];
                  }
                  if (isset($user_data['surname'][0]) && $user_data['surname'][0] != '') {
                    echo " " . $user_data['surname'][0];
                  }
                  ?>
                </a>
                <h6 class="people__card-designation text--small">
                  <?php if (isset($user_data['position'][0])) {
                    //position texonomy term name by id
                    $position = get_term_by('id', $user_data['position'][0], 'position');
                    echo $position->name;
                  } ?>
                </h6>
                <div class="people__card-icon-content">
                  <?php
                  //get user id
                  set_query_var("color", "people__card-icon");
                  get_template_part("/assets/images/svg/email-icon") ?>
                  <a href="<?php
                            if (isset($user_mail)) {
                              echo "mailto:" . $user_mail;
                            }
                            ?>" class="people__card-icon-text text text--smallest">
                    <?php if (isset($user_mail)) {
                      echo 'Email Address';
                    }
                    ?>
                  </a>
                </div>
                <div class="people__card-icon-content">
                  <?php if (isset($user_data['contact_information_phone'][0]) && $user_data['contact_information_phone'][0] != "") {
                  ?>
                    <?php get_template_part("/assets/images/svg/phone-icon") ?>
                    <a href="
                    <?php
                    if (isset($user_data['contact_information_phone'][0])) {
                      echo "tel:" . $user_data['contact_information_phone'][0];
                    }
                    ?>
                    " class="people__card-icon-text text text--smallest">
                    <?php
                    echo $user_data['contact_information_phone'][0];
                  }
                    ?>
                    </a>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
        <?php
        $total_users = count($professors);
        $total_pages = ceil($total_users / $per_page);
        $current_page = $page;
        if($total_users > $per_page){
          $pagination = paginate_links(array(
            'base' => add_query_arg('pages', '%#%'),
            'format' => '?pages=%#%',
            //prv-next false
            'prev_next' => false,
            'total' => $total_pages,
            'current' => $current_page
          ));
          if ($pagination && $_GET['letter'] == "") {
            echo '<div class="people__pagination index__pagination people--space">';
            //previous button
            if ($current_page == 1) {
              echo '<span class="people__page-btn people__page-prev disabled">Previous</span>';
            } else {
              echo '<a class="people__page-btn people__page-prev" href="' . add_query_arg('pages', $current_page - 1) . '#people">Previous</a>';
            }
            for ($i = 1; $i <= $total_pages; $i++) {
              if ($i == $current_page) {
                echo '<span class="people__page-btn people__page-num current index__hide__pagenation">' . $i . '</span>';
              } else {
                if ($i == 1 || $i == $total_pages || ($i >= $current_page - 2 && $i <= $current_page + 2)) {
                  echo '<a class="people__page-btn people__page-num index__hide__pagenation" href="' . add_query_arg('pages', $i) . '#people">' . $i . '</a>';
                } elseif ($i == $current_page - 3 || $i == $current_page + 3) {
                  echo '<span class="people__page-btn people__page-num dots index__hide__pagenation">...</span>';
                }
              }
            }
            //next button
            if ($current_page == $total_pages) {
              echo '<span class="people__page-btn people__page-next disabled">Next</span>';
            } else {
              echo '<a class="people__page-btn people__page-next" href="' . add_query_arg('pages', $current_page + 1) . '#people">Next</a>';
            }
            echo '</div>';
          }
          if ($total_pages > 1) {
          ?>
            <div class="index__pagination-rsp">
              <p class="index__pagination__text text">
                Page <?php echo $current_page; ?> of <?php echo $total_pages; ?>
              </p>
            </div>
          <?php
          }
        }
        ?>
      </div>
    <?php
    }
    ?>
  </div>
</div>

<?php
get_footer();
?>

<style>
  .services__cat-list::before {
    content: "";
    position: absolute;
    height: 20px;
    top: 3px;
    width: 20px;
    left: -20px;
    background-image: url(<?php echo get_template_directory_uri() . '/assets/images/eva_arrow-right-fill.svg'; ?>);
  }
</style>