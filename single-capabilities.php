<?php
// post title set to variable 

$post_title = get_the_title();
// set post title to banner title to pass to banner template
$banner_title = $post_title;
// fature image set to variable
$banner_image = get_the_post_thumbnail_url();
//post id

$post_id = get_the_ID();
$post_content = get_the_content();
$post_meta = get_post_meta($post_id);

$first_btn_label = $post_meta['first_button_group_first_button_label'][0];
$first_btn_link = $post_meta['first_button_group_first_button_link'][0];
$first_btn_icon = $post_meta['first_button_group_first_button_icon'][0];
$second_btn_label = $post_meta['second_button_group_second_button_label'][0];
$second_btn_link = $post_meta['second_button_group_second_button_link'][0];
$second_btn_icon = $post_meta['second_button_group_second_button_icon'][0];
$banner_content;
// if exists, excerpt set to variable or post content set to variable
if (has_excerpt()) {
  $banner_content = get_the_excerpt();
}

// print_r($post_title);
//get the current post id
$current_post_id = get_the_ID();
//get the current post slug by id
$current_post_slug = get_post_field('post_name', $current_post_id);
// print_r($current_post_slug);
//get these user id have the current post id in their meta field like industries, departments and services 

$newQuery = "SELECT user_id FROM wp_usermeta WHERE (meta_key LIKE 'services' AND meta_value LIKE '%" . $current_post_id . "%') OR (meta_key LIKE 'industries' AND meta_value LIKE '%" . $current_post_id . "%') OR (meta_key LIKE 'departments' AND meta_value LIKE '%" . $current_post_id . "%') AND (meta_key LIKE 'display_user_profile' AND meta_value LIKE 'true')";



//get the user id from the query
$professors_id = $wpdb->get_results($newQuery);
//get the user id from the query
$professors_id = array_map(function ($professor) {
  return $professor->user_id;
}, $professors_id);
//get the user meta data from the user id
// print_r($professors_id);
$professors_meta = [];
// print_r($professors_id);
foreach ($professors_id as $professor_id) {
  $professors_meta[$professor_id] = get_user_meta($professor_id, '', true);
}

function sort_by_last_name($a, $b)
{
  return strcmp($a['last_name'][0], $b['last_name'][0]);
}

uasort($professors_meta, 'sort_by_last_name');

if (isset($_GET['pdf'])) {
  // path to dompdf
  require_once get_template_directory() . '/dompdf/autoload.inc.php';
  // instantiating dompdf
  $dompdf = new Dompdf\Dompdf();
  $options = $dompdf->getOptions();
  $options->set('isRemoteEnabled', TRUE);
  $dompdf->setOptions($options);

  $html = "
    <html>
      <head>
      <style>
      .newcv__header{
        width: 100%;
        margin-bottom: 20px;
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
      }
      
      .newcv__header__img{
        max-width: 250px;
        width: 100%;
        height: auto;
        object-fit: contain;
        margin-left: 64%;
        margin-top: -20px;
        margin-bottom: 20px;
      }

      .newcv__user__name{
        font-size: 1.6rem;
        font-weight: 700;
        margin: 0px;
        margin-bottom: 20px;
        color: #0E3A68;
      }

      .newcv__post__title{
        font-size: 1rem;
        font-weight: 700;
        margin: 0;
        margin-bottom: 10px;
        color: #0E3A68;
      }

      .newcv__team__name{
        font-size: 1rem;
        font-weight: 700;
        margin: 0;
        margin-bottom: 0px;
        color: #0E3A68;
      }

      .newcv__content{
        margin-bottom: 20px;
        font-size: 14px;
      }
      
      .newcv ul li{
        list-style: square;
        margin-bottom: 10px;
      }
      
      .newcv ul li:last-child{
        margin-bottom: 0px;
      }
      
      .newcv a{
        color: #165ca9;
    text-decoration: none;
      }

      .newcv__professor__link{
        color: #000!important;
        text-decoration: none;
        display: block;
      }

      p {
        line-height: 1.6;
        margin: 0;
        font-size: 14px;
      }

      .newcv__professor{
        margin-bottom: 20px;
      }

      @page {
        margin: 100px 25px 100px 25px;
    }

      footer { 
        position: fixed;
        bottom: -40px; 
        left: 0px; 
        right: 0px;
        border-top: 1px solid #000;
      }
      header { position: fixed; top: -60px; left: 0px; right: 0px;  }
      </style>
      </head>
      <body>
      <header>
  <img src='" . get_template_directory_uri() . "/assets/images/tucker.png' class='newcv__header__img'>
  </header>  
  <footer>
  <p style='margin: 0px; margin-top: 8px;'>
  Copyright 2023. All Rights Reserved. Tucker Arensberg, P.C.   
  </p>
  </footer>
      <main>
      <div class='newcv'>
      <h1 class='newcv__user__name'>" . $post_title . "</h1>
      <h2 class='newcv__post__title'>" . $banner_content . "</h2>
      <div class='newcv__content'>" . $post_content . "</div>";
  if (count($professors_meta)) {
    $html .= "<div class='newcv__content'>
                  <h1 class='newcv__user__name'>The Team</h1>";
    $newcv_professors_count = count($professors_meta);
    $html .= "<div class='newcv__professors'>";
    $html .= "<div class='newcv__professors-list'>";
    $i = 0;
    foreach ($professors_meta as $key => $value) {
      //get user mail by id
      $display_user_profile = get_user_meta($key, 'display_user_profile', true);
      if ($display_user_profile === 'true') {

        $user_info = get_userdata($key);
        $user_email = $user_info->user_email;
        $html .= "<div class='newcv__professor' style='float: left; width: 33.33%; box-sizing: border-box; padding: 0 10px;'>";
        $html .= "<div class='newcv__professor__content'>";
        $html .= "<h2 class='newcv__team__name'>" . $value['first_name'][0] . " " . $value['last_name'][0] . "</h2>";
        $html .= "<p class='newcv__professor__title'>";
        if (isset($value['position'][0])) {
          $position = get_term_by('id', $value['position'][0], 'position');
          $html .= $position->name;
        }
        $html .= "</p>";
        $html .= '<p class="newcv__professor__link"><a href="mailto:' . $user_email . '" class="newcv__professor__link text text--smallest">Email: ' . $user_email . '</a></p>';
        $html .= "<p class='newcv__professor__phone'>";
        if (isset($value['contact_information_phone'][0]) && $value['contact_information_phone'][0] != "") {
          $html .= "<a href='tel:" . $value['contact_information_phone'][0] . "' class='newcv__professor__link text text--smallest'>Phone: " . $value['contact_information_phone'][0] . "</a>";
        } else {
          $html .= "<p class='newcv__professor__phone'>" . $value['phone'][0] . "</p>";
        }
        $html .= "</p>";
        $html .= "</div>";
        $html .= "</div>";
        $i++;
        if ($i % 3 == 0 && $i != $newcv_professors_count) {
          $html .= '<div style="clear:both;"></div>';
        }
      }
    }
    $html .= "</div>";
    $html .= "</div>";
    $html .= "</div>";
  }
  $html .= "
      </div>
      </main>
      </body>
    </html>
  ";
  // loading the html content
  $dompdf->loadHtml($html);
  // setting the paper size
  $dompdf->setPaper('A4', 'portrait');
  // rendering the pdf
  $dompdf->render();

  // get the PDF contents
  $pdf = $dompdf->output();

  // output the PDF to the browser
  header('Content-Type: application/pdf');
  header('Content-Length: ' . strlen($pdf));
  header('Content-Disposition: inline; filename="' . $post_title . '.pdf"');
  header('Cache-Control: private, max-age=0, must-revalidate');
  header('Pragma: public');
  header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
  echo $pdf;
  exit;
}

// get professor role users with acf all acf custom meta fields
function get_banner_template($icon)
{

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
get_header();
get_template_part('template-parts/shared/sidebar-nav-template');
?>
<div class="other-hero other-hero__single__capabilities">
  <div class="other-hero__wrap">
    <div class="other-hero__overlay">&nbsp;</div>

    <?php if ($banner_image && $banner_image != '') {

    ?>
      <img alt="Banner Image" loading="lazy" class="other-hero__image" alt="banner image" src="<?php echo $banner_image; ?>">
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
        <div class="profile__s-btns">
          <form action="">
            <input type="hidden" name="pdf" value="downloaded">
            <button class="profile__download-btn">
              <?php get_template_part("/assets/images/svg/pdf-icon") ?>
              <span class="profile__download-text">Download PDF</span>
            </button>
          </form>
          <a href="javascript:void(0)" onClick="return rudr_favorite(this);" class="profile__download-btn">
            <?php get_template_part("/assets/images/svg/bookmark-icon") ?>
            BOOKMARK
          </a>
          <a href="https://www.addtoany.com/share" class="profile__download-btn a2a_dd">
            <?php get_template_part("/assets/images/svg/share-icon") ?>
            SHARE
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="single__section-bar">
  <div class="container">
    <div class="single__bar-wrap section-bar__wrap">
      <a href="" type="submit" class="single__bar-sec-link section-bar__sec-link section-bar-active">
        Overview
      </a>
      <a href="#team" type="submit" class="single__bar-sec-link section-bar__sec-link">
        Team
      </a>
      <a href="#news" type="submit" class="single__bar-sec-link section-bar__sec-link">
        News & Insights
      </a>
    </div>
  </div>
</div>
<?php

?>
<div class="single-serve section--gap">
  <div class="container">
    <div class="contact-form-right__wrap">
      <div class="single-serve__content">
        <div class="single-serve__rich">
          <?php
          while (have_posts()) {
            the_post();
            the_content();
          }
          ?>
        </div>
        <div class="single-serve__rich custom__btn__area">
          <?php
          if ($post_meta['rich_text_area_custom_button_group_custom_text'][0] && $post_meta['rich_text_area_custom_button_group_custom_text'][0] != '') {
            echo $post_meta['rich_text_area_custom_button_group_custom_text'][0];
          }
          if ($post_meta['rich_text_area_custom_button_group_button_label'][0] && $post_meta['rich_text_area_custom_button_group_button_label'][0] != '') {
          ?>
            <div class="">
              <a href="<?php
                        echo $post_meta['rich_text_area_custom_button_group_button_url'][0];
                        ?> class=" btn btn--secondary news__btn">
                <?php

                echo $post_meta['rich_text_area_custom_button_group_button_label'][0];
                ?>
              </a>
            </div>
          <?php
          }
          ?>
        </div>
        <?php
        if (count($professors_meta)) {

        ?>
          <div id="team" class="single-serve__team">
            <h2 tabindex="0" class="title--section">THE TEAM</h2>
            <?php
            ?>
            <div class="single-serve__team-wrap">
              <?php
              foreach ($professors_meta as $key => $value) {
                $display_user_profile = get_user_meta($key, 'display_user_profile', true);
                $user = get_userdata($key);
                if ($display_user_profile === 'true' && in_array('professor', $user->roles)) {
                  get_template_part('template-parts/shared/info-card-template-part', null, array(
                    'team' => $value,
                    "id" => $key
                  ));
                }
              }
              ?>
            </div>
            <?php
            ?>

          </div>
        <?php
        }
        $post_limit = 4;
        $queryString = "SELECT p.ID as post_id FROM wp_posts p INNER JOIN wp_postmeta pm ON p.ID = pm.post_id WHERE pm.meta_key = 'capabilities_categor_practice_areas' AND pm.meta_value LIKE '%{$current_post_id}%' AND p.post_status = 'publish' AND p.post_type = 'post' ORDER BY p.post_date DESC LIMIT " . $post_limit . "";

        $posts = $wpdb->get_results($queryString);
        $posts = array_map(function ($post) {
          return $post->post_id;
        }, $posts);
        // print_r($posts);
        if (count($posts) && $posts[0] != null) {
          $posts = new WP_Query(array(
            'post_type' => 'post',
            'post__in' => $posts,
            //order by date ascending
            'orderby' => 'date',
            'order' => 'DESC',
          ));
        }
        // print_r($posts);
        // print_r($posts);
        ?>
        <div id="news" class="single-serve__news">
          <h2 tabindex="0" class="title--section">Latest News & Insights</h2>
          <?php
          // print_r($posts);
          if ($posts->posts[0] != null) {
          ?>
            <div class="single-serve__news-wrap">
              <?php
              while ($posts->have_posts()) {
                $posts->the_post();
                get_template_part(
                  "/template-parts/shared/blog-card-template-part",
                  null,
                  array(
                    'blog' => get_post(),
                    'id' => get_the_ID()
                  )
                );
              }
              ?>
            </div>
          <?php
          } else {
          ?>
            <div class="single-serve__nf__area">
              <p class="">No News & Insights Available </p>
              <a href="<?php
                        //news-insights page
                        echo get_permalink(get_page_by_path('news-insights'))
                        ?>" class="btn btn--primary profile__news-btn">
                <?php
                set_query_var("color", "news__card__angle-icon-white");
                get_template_part("/assets/images/svg/angle-icon")
                ?>

                <span>View ALL POSTS</span></a>
            </div>
          <?php
          }
          ?>
          <?php
          if (is_array($posts->posts) && count($posts->posts) >= $post_limit) {
          ?>
            <form action="
        <?php
            //redirect to the people page
            echo get_permalink(get_page_by_path('news-insights'))
        ?>
        ">
              <input type="hidden" name="paritiesarea" value="<?php echo $current_post_slug ?>">
              <button class="btn btn--primary profile__news-btn">
                <?php
                set_query_var("color", "news__card__angle-icon-white");
                get_template_part("/assets/images/svg/angle-icon")
                ?>
                <span>View ALL POSTS</span></button>
            </form>
          <?php
          }
          ?>
        </div>
      </div>
      <div class="contact-form-right__contact-re">
        <div class="contact-form-right__contact sticky-sidebar">
          <div class="contact-form-right__contact-title">
            <h2 tabindex="0" class="title--card-small">Contact Now</h2>
            <p class="single-serve__contact-text text">Get support from our trusted attorneys.</p>
          </div>
          <?php
          get_template_part('template-parts/shared/contact-form-template');
          ?>
        </div>
      </div>

    </div>
  </div>
</div>

<?php
get_footer();
?>

<script async src="https://static.addtoany.com/menu/page.js"></script>

<style type="text/css">
  .single-serve__rich ul li::before {
    content: "";
    position: absolute;
    height: 20px;
    width: 20px;
    top: 6px;
    left: -24px;
    background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/eva_arrow-right-fill-blue.svg');
  }
</style>