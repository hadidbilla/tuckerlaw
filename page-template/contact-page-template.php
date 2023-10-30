<?php
/* Template Name: Our Contact Page */


    get_header();
get_template_part('template-parts/shared/sidebar-nav-template');
    get_template_part('template-parts/shared/banner-template');

    //get this page id 
    $post_meta = get_post_meta(get_the_ID());
    // print_r($post_meta);
    // print_r($post_meta);
    $image = $post_meta['contact_image'][0];
    $image = wp_get_attachment_image_src($image, 'full');
    
?>


<div class="contact-page">
    <div class="container">
        <div class="contact-page__wrap">
            <div class="contact-page__content">
                <h2 tabindex="0" class="title--section">
                    <?php echo $post_meta['title'][0] ?>
                </h2>
                <div class="contact-page__contact-text text join__overview-richtext">
                    <?php
                        
                        the_content();
                    ?>
                </div>
                <?php
                get_template_part('template-parts/shared/contact-form-template');
                ?>
            </div>
            <div class="contact-page__img-con">
                <?php if($image){ ?>
                    <img alt="Contact Image" loading="lazy" src="<?php echo $image[0] ?>" alt="" class="contact-page__img">
                <?php } else{
                    ?>
                    <img alt="Contact Image"  loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/about-img.png" alt="" class="contact-page__img">
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<?php
    get_footer();
?>