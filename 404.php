<?php
get_header();
get_template_part('template-parts/shared/sidebar-nav-template');
?>

<div class="notfound">
  <div class="container notfound__wrp">
    <div class="notfound__maincontent">
      <img src="<?php echo get_template_directory_uri() . '/assets/images/error.gif' ?>" alt="" class="notfound__img">
      <div class="notfound__textcontent">
        <h1>404 Not Found</h1>
        <div class="notfound__btmcnt">
          <h3>UH OH! You're lost.</h3>
          <p>The page you are looking for does not exist. How you got here is a mystery. But you can click the button below to go back to the homepage.</p>
          <div class="">
          <a href="<?php echo get_site_url(); ?>" class="other-hero__butn btn btn--secondary">
            <?php 
              get_template_part("/assets/images/svg/home-icon");
            ?>
            <span class="other-hero__btn-text">
                Back to Home
            </span>
          </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
get_footer();
?>