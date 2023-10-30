<?php
get_header();
get_template_part('template-parts/shared/sidebar-nav-template');
$postData = [];
?>


<div class="index">
  <?php
  get_template_part('template-parts/shared/banner-template');
  ?>
  <div class="container">
    <div class="index__wrp section--gap">
      
      <div class="index__blog__area" <?php post_class() ?>>
        <?php
        while (have_posts()) {
          the_post();
        ?>
          <?php 
            the_content();
          ?>
        <?php }
        echo paginate_links();
        ?>
      </div>
    </div>
  </div>
</div>
<?php
get_footer();
?>