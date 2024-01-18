<?php
get_header();
//get the capabilities page meta data
$page_meta = get_post_meta(get_page_by_path('capabilities')->ID);
$page_title = get_the_title(get_page_by_path('capabilities')->ID);
$page_excerpt = get_the_excerpt(get_page_by_path('capabilities')->ID);
$banner_image = get_the_post_thumbnail(get_page_by_path('capabilities')->ID);

$current_url = home_url(add_query_arg(array(), $wp->request));

// $page_meta = get_post_meta(get_page_by_path('news-insights')->ID);
$first_btn_label = $page_meta['first_button_group_first_button_label'][0];
$first_btn_link = $page_meta['first_button_group_first_button_link'][0];
$first_btn_icon = $page_meta['first_button_group_first_button_icon'][0];
$second_btn_label = $page_meta['second_button_group_second_button_label'][0];
$second_btn_link = $page_meta['second_button_group_second_button_link'][0];
$second_btn_icon = $page_meta['second_button_group_second_button_icon'][0];
get_template_part('template-parts/shared/sidebar-nav-template',);
get_template_part('template-parts/shared/banner-template',
  null,
  array(
    'banner_title' => $page_title,
    'banner_content' => $page_excerpt,
    'first_btn_label' => $first_btn_label,
    'banner_image' => $banner_image,
    'first_btn_link' => $first_btn_link,
    'first_btn_icon' => $first_btn_icon,
    'second_btn_label' => $second_btn_label,
    'second_btn_link' => $second_btn_link,
    'second_btn_icon' => $second_btn_icon
  )
);
//get the page title
$page_title = get_the_title();
?>
<style>
  .services__cat-list::before {
        content: "";
        position: absolute;
        height: 20px;
        top: 1px;
    width: 20px;
    left: -12px;
        background-image: url(<?php echo get_template_directory_uri() . '/assets/images/eva_arrow-right-fill.svg'; ?>);
      }
</style>

<div class="services section--gap">
  <div class="container">
    <div class="services-wrap">
      <div class="services__cat-contain">
        <?php

        // sperate the posts by capabilities post by category
        $categories = get_categories(array(
          'taxonomy' => 'capabilities_category',
          'hide_empty' => false,
          'orderby' => 'name',
          'order' => 'DESC'
        ));
        // show post by categories
        foreach ($categories as $category) {
          $args = array(
            'post_type' => 'capabilities',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'orderby' => 'title',
            'tax_query' => array(
              array(
                'taxonomy' => 'capabilities_category',
                'field' => 'slug',
                'terms' => $category->slug
              )
            )
          );
          $capabilities = new WP_Query($args);
          if ($capabilities->have_posts()) {
            //category meta data
            $category_meta = get_term_meta($category->term_id);
            // get the category image by id
            $category_image = wp_get_attachment_image_src($category_meta['feature_image'][0], 'full');
            ?>
            <div id="<?php echo $category->slug ?>" class="services__cat-sec">
            <div class="services__cat-img-con">
            <div class="services__overlay"></div>
            <img loading="lazy" src="<?php if($category_image){ echo $category_image[0]; } else { echo get_template_directory_uri() . '/assets/images/services-category.png'; } ?>" alt="Capabilities Image" class="services__cat-img" alt="Blog Image" >
            </div>
            <div class="services__cat-hover">
            <h4 tabindex="0" class="services__cat-title-hover title--card-small">
            <?php echo $category->name ?>
            </h4>
            <ul class="services__cat-lists">
            <?php
            while ($capabilities->have_posts()) {
              $capabilities->the_post();
              ?>
              <li class="services__cat-list">
              <a href="<?php echo get_the_permalink()  ?>" class="services__cat-item text--small">
              <?php echo get_the_title() ?>
              </a>
              </li>
              <?php
            }
            echo '</ul>';
            echo '</div>';
            echo '</div>';
          }
        }
          
        ?>
      </div>
    </div>
  </div>
</div>

<?php
get_footer();
?>