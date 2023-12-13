<?php
/* Template Name: Home Page Template*/
?>

<?php
    get_header();
    get_template_part('template-parts/shared/cookies-modal');
    get_template_part('template-parts/shared/sidebar-nav-template');
    get_template_part('template-parts/shared/sidebar-nav-template');
    get_template_part('template-parts/Home/home-template-hero'); 
    get_template_part('template-parts/Home/home-award-template');
    get_template_part('template-parts/Home/help-templete');
    get_template_part('template-parts/Home/choose-us-templete');
    get_template_part('template-parts/Home/news-templete');
    get_template_part('template-parts/Home/about-templete');
    get_template_part('template-parts/Home/home-join-templete');
    // get_template_part('template-parts/Home/location-templete');
    get_template_part('template-parts/shared/office-location-template');
    get_footer();
?>