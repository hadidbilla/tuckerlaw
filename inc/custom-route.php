<?php
/*========================= change Author Default slug name =============================*/
function new_author_base()
{
  global $wp_rewrite;
  $myauthor_base = 'people'; // change slug name
  $wp_rewrite->author_base = $myauthor_base;
}
add_action('init', 'new_author_base');


/*========================= Call Dynamic Template By route for show user profile  =============================*/
add_action('init', function () {
  add_rewrite_rule('people/([a-z][a-z0-9-]+)[/]?$', 'index.php?people=$matches[1]', 'top');
});

add_filter('query_vars', function ($query_vars) {
  $query_vars[] = 'people';
  return $query_vars;
});

add_action('template_include', function ($template) {
  if (get_query_var('people') == false || get_query_var('people') == '') {
    return $template;
  }

  // Remove Yoast SEO canonical URL
  add_filter('wpseo_canonical', '__return_false');

  // Set the canonical URL
  add_action('wp_head', function () {
    $canonical_url = home_url('/people/');
    $canonical_url = home_url('/people/' . get_query_var('people') . '/');
    echo '<link rel="canonical" href="' . esc_url($canonical_url) . '" />' . PHP_EOL;
  }, 1); // Specify a priority of 1 to ensure it is added first

  return get_template_directory() . '/template-parts/userprofile-templete-part.php';
});

//people/([a-z]+)[/]?$/blog
//if last url is blog then it will show custom template



//create a custom route  practices-area/([a-z][a-z0-9-]+)[/]?$
add_action('init', function () {
  add_rewrite_rule('filter/([a-z]+)[/]?$', 'index.php?filter=$matches[1]', 'top');
});

add_filter('query_vars', function ($query_vars) {
  $query_vars[] = 'filter';
  return $query_vars;
});

add_action('template_include', function ($template) {

  if (get_query_var('filter') == false || get_query_var('filter') == '') {
    return $template;
  }

  return get_template_directory() . '/template-parts/practices-area-templete-part.php';
});

// if route is practices-area then redirect to capabilities page

// jobs page route  jobs/([a-z][a-z0-9-]+)[/]?$
add_action('init', function () {
  add_rewrite_rule('jobs/([a-z][a-z0-9-]+)[/]?$', 'index.php?jobs=$matches[1]', 'top');
});

add_filter('query_vars', function ($query_vars) {
  $query_vars[] = 'jobs';
  return $query_vars;
});

add_action('template_include', function ($template) {

  if (get_query_var('jobs') == false || get_query_var('jobs') == '') {
    return $template;
  }

  return get_template_directory() . '/template-parts/single-job-page-template.php';
});

//achievements page route  achievements/([a-z][a-z0-9-]+)[/]?$

add_action('init', function () {
  add_rewrite_rule('achievements/([a-z][a-z0-9-]+)[/]?$', 'index.php?achievements=$matches[1]', 'top');
});

add_filter('query_vars', function ($query_vars) {
  $query_vars[] = 'achievements';
  return $query_vars;
});

add_action('template_include', function ($template) {

  if (get_query_var('achievements') == false || get_query_var('achievements') == '') {
    return $template;
  }

  return get_template_directory() . '/template-parts/shared/default-template.php';
});
