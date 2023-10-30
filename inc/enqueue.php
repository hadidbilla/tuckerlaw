<?php
function gs_theme_scripts()
{
  // wp_enqueue_style('style', get_stylesheet_uri());
  wp_enqueue_style("arial-font", get_template_directory_uri() . "/assets/fonts/arial/fonts.css");
  wp_enqueue_style("custom-style", get_template_directory_uri() . "/assets/css/custom.css");
  wp_enqueue_style("confirmModal-style", get_template_directory_uri() . "/assets/css/library/jquery-confirm.min.css");
  wp_enqueue_style("flickity-style", get_template_directory_uri() . "/assets/css/library/flickity.min.css");
  

// enqueue the jquery library
  wp_enqueue_script("jquery");
  // wp_enqueue_script('vcard', get_template_directory_uri() . '/assets/js/library/vcard.js', array(), '1.0.0', true);
  wp_enqueue_script('flickity-js', get_template_directory_uri() . '/assets/js/library/flickity.pkgd.js', array(), '1.0.0', true);
  wp_enqueue_script('flickityMain-js', get_template_directory_uri() . '/assets/js/flickityMain.js', array('flickity-js'), '1.0.0', true);
  wp_enqueue_script('confirmModalMin-js', get_template_directory_uri() . '/assets/js/library/ConfirmModal/jquery-confirm.min.js', array(), '1.0.0', true);
  wp_enqueue_script('customConfirmModal-js', get_template_directory_uri() . '/assets/js/customConfirmModal.js', array('confirmModalMin-js'), '1.0.0', true);
  //gsap.js
  wp_enqueue_script('gsap-js', get_template_directory_uri() . '/assets/js/library/gsap/gsap.min.js', array(), '1.0.0', true);
  wp_enqueue_script('gsap-CustomEase-js', get_template_directory_uri() . '/assets/js/library/gsap/CustomEase.min.js', array(), '1.0.0', true);
  wp_enqueue_script('gsap-SplitText-js', get_template_directory_uri() . '/assets/js/library/gsap/SplitText.js', array(), '1.0.0', true);
  wp_enqueue_script('gsap-ScrollTrigger-js', get_template_directory_uri() . '/assets/js/library/gsap/ScrollTrigger.min.js', array(), '1.0.0', true);
  // wp_enqueue_script('gsap-SmoothScroll-js', get_template_directory_uri() . '/assets/js/library/gsap/SmoothScroll.min.js', array(), '1.0.0', true);
  //link animation.js it's depend on gsap-js
  wp_enqueue_script('animation-js', get_template_directory_uri() . '/assets/js/animation.js', array('gsap-js','gsap-CustomEase-js','gsap-SplitText-js','gsap-ScrollTrigger-js'), '1.0.0', true);
  
  wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
}

add_action("wp_enqueue_scripts", "gs_theme_scripts");



//add type="module" to script tag
function add_type_attribute($tag, $handle, $src) {
  // if not your script, do nothing and return original $tag
  if ( 'animation-js' !== $handle ) {
      return $tag;
  }
  // change the script tag by adding type="module" and return it.
  $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
  return $tag;
}

add_filter('script_loader_tag', 'add_type_attribute' , 10, 3);


add_filter( 'script_loader_tag', 'add_defer_attribute', 10, 2 );

function add_defer_attribute($tag, $handle) {
  // add script handles to the array below
  $scripts_to_defer = array('main-js', 'gsap-js', 'gsap-CustomEase-js', 'gsap-SplitText-js', 'gsap-ScrollTrigger-js', 'animation-js');
  foreach($scripts_to_defer as $defer_script) {
    if ($defer_script === $handle) {
      return str_replace(' src', ' defer src', $tag);
    }
  }
  return $tag;
}
