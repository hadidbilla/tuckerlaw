<?php
get_header();
get_template_part('template-parts/shared/sidebar-nav-template');
// get_template_part('template-parts/shared/banner-template');
$custom_posts = get_posts(array(
  'post_name'        => 'offices', // Change 'name' to 'post_name'
  'post_type'   => 'office_location',
  'post_status' => 'publish',
  'posts_per_page' => -1
));
?>
<div class="ofc">
  <div class="ofc__cnt">
    <?php
    if ($custom_posts) {
      foreach ($custom_posts as $post) {
        $officeMetaData = get_post_meta($post->ID); // Replace 'city' with your actual meta key
    ?>

        <a href="<?php echo get_permalink($post->ID); ?>" class="ofc__card">
          <div class="ofc__card--overly"></div>
          <?php if (has_post_thumbnail()) {
            the_post_thumbnail('full', ['class' => 'ofc__card__img']);
          } else { ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home-banner.png" alt="Default Image" class="ofc__card__img">
          <?php } ?>
          <h3 class="ofc__card--title">
            <?php echo $officeMetaData['city'][0] ?>
          </h3>
        </a>
      <?php
      }
      ?>
    <?php
      wp_reset_postdata();
    }
    ?>
  </div>
</div>
<?php


get_footer();
?>