<?php
// receive the data set as a variable
// alternative get_query_var
$banner_title = $args['banner_title'];
$banner_content = $args['banner_content'];
$banner_image = $args['banner_image'];
$first_btn_label = $args['first_btn_label'];
$first_btn_link = $args['first_btn_link'];
$first_btn_icon = $args['first_btn_icon'];
$second_btn_label = $args['second_btn_label'];
$second_btn_link = $args['second_btn_link'];
$second_btn_icon = $args['second_btn_icon'];
// print_r($second_btn_label);

//get the current page id
$page_id = get_the_ID();


if (!$banner_image) {
  if (is_home() || is_archive() || is_tag()) {
    //get the blog page id
    $blog_page_id = get_option('page_for_posts');
    $banner_image = get_the_post_thumbnail_url($blog_page_id);
  } else {
    $banner_image = get_the_post_thumbnail_url();
  }
}
if (!$banner_title) {
  //is default blog page
  if (is_home() || is_archive() || is_tag()) {
    $banner_title = 'News & Insights';
  } else {
    $page_id = get_the_ID();
    $banner_title = get_the_title($page_id);
  }
}
if (!$banner_content) {
  if (is_home() || is_archive() || is_tag()) {
    //get the blog page id
    $blog_page_id = get_option('page_for_posts');
    $banner_content = get_the_excerpt($blog_page_id);
  } else {
    //get the excerpt not the content

    $banner_content = wp_trim_words(get_post_field('post_excerpt', get_the_ID()));
  }
}

//get the current page id
//get the page title by id
// $page_title = ;

//create function who return a template part by switch case

function get_banner_template($icon){

  switch ($icon) {
    case 'grid':
      return get_template_part("/assets/images/svg/grid-icon");
      break;
    case 'user':
      return get_template_part("/assets/images/svg/user-icon");
      break;
    case 'envelope':
      return get_template_part("/assets/images/svg/email-icon");
      break;
    case 'search':
      return get_template_part("/assets/images/svg/search-icon");
      break;
    default:
      return get_template_part("/assets/images/svg/grid-icon");
      break;
  }
}

?>
<div class="other-hero">
  <div class="other-hero__wrap">
    <div class="other-hero__overlay">&nbsp;</div>

    <?php if ($banner_image && $banner_image != '') {

    ?>
      <img alt="Banner Image" loading="lazy" class="other-hero__image" alt="banner image" src="<?php echo $banner_image; ?>"  >
    <?php
    } else {
    ?>
      <img alt="Banner Image" loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/hero-image.jpeg' ?>" alt="banner image" class="other-hero__image">

    <?php
    } ?>

    <div class="other-hero__text">
      <div class="container">
        <h1 tabindex="0" class="title title--white other-hero__tag">
          <?php
          if ($banner_title) {
            echo $banner_title;
          } else {
            echo 'Provide A Title';
          }
          ?>
        </h1>
        <p class="text text--white other-hero__subtext">
          <?php
          if ($banner_content) {
            echo $banner_content;
          }
          ?>
        </p>
        <div class="other-hero__button">
          <a href="<?php
            if ($first_btn_link) {
              echo $first_btn_link;
            } else {
              echo get_site_url() . '/capabilities';
            }
          ?>" class="other-hero__butn btn btn--primary">
            <?php 
            if ($first_btn_icon) {
              get_banner_template($first_btn_icon);
            } else {
              get_template_part("/assets/images/svg/grid-icon");
            }
            ?>
            <span class="other-hero__btn-text">
              <?php
              if ($first_btn_label) {
                echo $first_btn_label;
              } else {
                echo 'Capabilities';
              }
              ?>
            </span>
          </a>
          <a href="<?php
            if ($second_btn_link) {
              echo $second_btn_link;
            } else {
              echo get_site_url() . '/people';
            }
          ?>" class="other-hero__butn btn btn--secondary">
            <?php 
            if ($second_btn_icon) {
              get_banner_template($second_btn_icon);
            } else {
              get_template_part("/assets/images/svg/search-icon");
            }
            ?>
            <span class="other-hero__btn-text">
              <?php
              if ($second_btn_label) {
                echo $second_btn_label;
              } else {
                echo 'Search Attorneys';
              }
              ?>
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>