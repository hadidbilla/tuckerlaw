<?php
//get this post author id
$author_id = get_the_author_meta('ID');
//get this post author meta
$user_meta_data = get_user_meta($author_id);
//get image url by id
$image = wp_get_attachment_image_src($user_meta_data['featured_image'][0], 'thumbnail')[0];

?>

<div class="news__card card--animation">
  <a href="<?php the_permalink(); ?>">
    <div class="news__card__img__area">
      <?php
      //user meta data
      //get post thumbnail
      $post_thumbnail_id = get_post_thumbnail_id();
      $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
      if ($post_thumbnail_url) {
        the_post_thumbnail('full', array('class' => 'news__card__img'));
      } else {
        echo '<img alt="Architecture building and city" decoding="async"
srcset="https://www.tuckerlaw.com/wp-content/uploads/2023/09/Camp-Hill-Location-
scaled.jpg 1920w, https://www.tuckerlaw.com/wp-content/uploads/2023/09/Camp-Hill-
Location-300x200.jpg 300w, https://www.tuckerlaw.com/wp-content/uploads/2023/09/Camp-
Hill-Location-1024x682.jpg 1024w, https://www.tuckerlaw.com/wp-
content/uploads/2023/09/Camp-Hill-Location-768x511.jpg 768w,
https://www.tuckerlaw.com/wp-content/uploads/2023/09/Camp-Hill-Location-1536x1023.jpg
1536w" sizes="(max-width: 1920px) 100vw, 1920px" width="1920" height="1278" src="' . get_template_directory_uri() . '/assets/images/about.png" alt="news-thumbnail" class="news__card__img" />';
      }
      ?>
    </div>
  </a>
  <div class="news__card__content">
    <p class="news__card__tag">
      <?php the_category(', '); ?>
    </p>
    <a href="<?php 
      //get permalink of this post only slug
      $post_slug = $post->post_name;
      echo get_site_url() . '/' . $post_slug;
    ?>" class="news__card__title__area">
      <p  class="news__card__title title--card-small">
        <?php the_title(); ?>
      </p>
      <div class="news__card__angle-icon-con">
        <?php
        set_query_var("color", "news__card__angle-icon");
        get_template_part("/assets/images/svg/angle-icon") ?>
      </div>
    </a>
    <p class="news__card__text text" aria-hidden="true" data-acsb-hidden="true">
      <?php 
        //only show excerpt if it is not empty
        if (has_excerpt()) {
          echo get_the_excerpt();
        } 
      ?>
    </p>
    <div class="news__card__autr">
      <a data-acsb-clickable="true" data-acsb-navigable="true" data-acsb-redundant-stop="true" aria-hidden="true" data-acsb-hidden="true" tabindex="-1" data-acsb-now-navigable="false" href="<?php
        $link = get_author_posts_url(get_the_author_meta('ID'));
        //remove cap from link
        $link = str_replace('cap-', '', $link);
        echo $link;
      ?>" class="news__card__autr__img__area">
        <?php
        $get_author_id = get_the_author_meta('ID');
        // print_r($image);
        if ($image) {
        ?>
          <img alt="Blog Image" loading="lazy" src="<?php echo $image; ?>" alt="<?php the_author(); ?>" class="news__card__autr__img">
        <?php } else { ?>
          <img alt="Blog Image" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/attorney_avatar.jpg" alt="<?php the_author(); ?>" class="news__card__autr__img">
        <?php } ?>

      </a>
      <div class="news__card__autr__content">
        <a href="<?php
          $link = get_author_posts_url(get_the_author_meta('ID'));
          //remove cap from link
          $link = str_replace('cap-', '', $link);
          echo $link;
        ?>" class="news__card__autr__name">
          <?php the_author(); ?>
        </a>
        <p class="news__card__autr__date">
          <?php the_time('F j, Y'); ?>
        </p>
      </div>
    </div>
  </div>
</div>