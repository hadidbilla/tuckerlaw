<?php
// the_post();
$post_id = get_the_ID();

//get the post category
// /categories
$categories = get_the_category();
$cat_name = [];
//cat_name name
// print_r($categories);
foreach ($categories as $category) {
  $cat_name[] = $category->name;
}


//post tile
$post_title = get_the_title();

// get post meta
$post_meta = get_post_meta($post_id);
$content = get_the_content();
// get author by post id
$author_id = get_post_field('post_author', $post_id);
$user_meta_data = get_user_meta($author_id);
$user_profile_link = get_author_posts_url($author_id);
// print_r($user_meta_data);
//get user mail by id
$user_mail = get_the_author_meta('user_email', $author_id);
$office_location_meta_data = get_post_meta($user_meta_data['office_location'][0]);
$address = $office_location_meta_data['address'][0] . ', ' . $office_location_meta_data['suite'][0] . ', ' . $office_location_meta_data['city'][0] . ', ' . $office_location_meta_data['state'][0] . ', ' . $office_location_meta_data['zip'][0];
// print_r($address);
$biography_image = wp_get_attachment_image_src($user_meta_data['biography_image'][0], 'thumbnail')[0];
$image_binary_data = null;
if ($biography_image) {
  $response = wp_remote_get($biography_image);
  // $image_binary_data = file_get_contents($biography_image);
  if (!is_wp_error($response) && $response['response']['code'] == 200) {
    $image_binary_data = wp_remote_retrieve_body($response);
  } else {
    $default_image_path = get_template_directory() . '/assets/images/attorney_avatar.jpg';
    $image_binary_data = file_get_contents($default_image_path);
  }
}
$base64_image = base64_encode($image_binary_data);
$data_uri = 'data:image/png;base64,' . $base64_image;

$current_user_mail = get_user_by('id', $author_id);
$email = $current_user_mail->user_email;

if (isset($_GET['pdf'])) {
  // path to dompdf
  require_once get_template_directory() . '/dompdf/autoload.inc.php';
  // instantiating dompdf
  $dompdf = new Dompdf\Dompdf();
  $options = $dompdf->getOptions();
  $options->set('isRemoteEnabled', TRUE);
  $dompdf->setOptions($options);

  // getting the html content
  $html = "
  <html lang='en'>
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
      font-size: 22px;
      font-weight: 700;
      margin: 0px;
      margin-bottom: 10px;
      color: #0E3A68;
    }
    
    .newcv__post__title{
      font-size: 1rem;
      font-weight: 700;
      margin: 0;
      margin-bottom: 10px;
      color: #0E3A68;
    }
    
    .newcv__profile__bio{
      font-size: .9rem;
      font-weight: 600;
      margin-bottom: 10px;
      color: #000;
      margin-top: 10px;
      padding-bottom: 10px;
      border-bottom: 2px solid #DBB46A;
    }
    
    .newcv__body__rgt{
      padding-left: 30px;
    }
    
    p {
      line-height: 1.6;
      margin: 0;
      font-size: 14px;
    }
    
    .star {
      float: right;
      width: 200px;
    }
    
    .star-img {
      max-width: 200px;
      width: 100%;
      object-fit: contain;

    }

    .newcv__content{
      margin-bottom: 20px;
      font-size: 1rem;
      color: #000;
      line-height: 1.6;
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
    .newcv a last-child{
      margin-bottom: 0px;
    }

    .newcv__profile__badge__image{
      max-width: 250px;
      width: 100%;
      height: auto;
      object-fit: contain;
      margin-top: 10px;
    }
    .newcv__profile__info{
      display: flex;
      flex-direction: column;
      grid-gap: 8px;
      padding-bottom: 10px;
      border-bottom: 2px solid #DBB46A;
    }

    .newcv__profile__info a{
      font-size: .9rem;
      color: #000!important;
    }

    .newcv__post__date{
      color: #000;
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
    <div class='star'>
      <div class='newcv__body__rgt'>
      <div class='newcv__profile'>
        " . (isset($user_meta_data['featured_image'][0])
    ? "<img src='" . wp_get_attachment_image_src($user_meta_data['featured_image'][0], 'full')[0] . "' class='star-img'>"
    : "<img src='" . get_template_directory_uri() . "/assets/images/attorney_avatar.jpg' class='star-img'>"
  ) . "
</div>";
  //user name 
  $html .= "<div class='newcv__profile__bio'>" . $current_user_mail->display_name . "</div>";
  if ($user_meta_data['secondary_title'][0] != "" && $user_meta_data['secondary_title'][0] > 0) {
    $html .= "<div class='newcv__profile__bio'>";
    for ($j = 0; $j < $user_meta_data['secondary_title'][0]; $j++) {
      $html .= $user_meta_data['secondary_title_' . $j . '_enter_your_name'][0] . "<br>";
    }
    $html .= "</div>";
  }
  $html .= "
<div class='newcv__profile__bio'>
            " . (isset($user_meta_data['position'][0]) ? get_term_by('id', $user_meta_data['position'][0], 'position')->name : '') . "
          </div>
          <div class='newcv__profile__info'>
            <a href='mailto:" . (isset($user_meta_data['contact_information_email'][0]) ? $current_user_mail->user_email : '') . "'>" . (isset($user_meta_data['contact_information_email'][0]) ? $current_user_mail->user_email : '') . "</a>
            <a href='tel:" . (isset($user_meta_data['contact_information_phone'][0]) ? $user_meta_data['contact_information_phone'][0] : '') . "'>" . (isset($user_meta_data['contact_information_phone'][0]) ? $user_meta_data['contact_information_phone'][0] : '') . "</a>
        </div> ";
  $html .= "
</div>
</div>
<div class='newcv__body__lft'>
          <h1 class='newcv__user__name'>" . $post_title . "</h1>
          <p class='newcv__post__title'>" . 'By ' . $user_meta_data['first_name'][0] . ' ' . $user_meta_data['last_name'][0] . "</p>
          <div class='newcv__content'>" . $content . "</div>
          <div class=''>
              <p class='newcv__post__date'> Published Date: " . get_the_date('F d, Y') . "</p>
          </div>
       </div>
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
// print_r($email);
get_header();
get_template_part('template-parts/shared/sidebar-nav-template');
?>


<div class="single">
  <div class="profile__overview-profile">
    <div class="profile__overlay"></div>
    <img alt="Blog Logo" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-image.jpeg" alt="" class="profile__hero-image">
    <div class="profile__container container">
      <div class="profile__over-wrap">
        <div class="profile__image-con">
          <!-- display image by id -->
          <?php
          if ($user_meta_data['biography_image'][0]) {
            $image = wp_get_attachment_image_src($user_meta_data['biography_image'][0], 'full');
            echo '<img alt="Blog Logo" loading="lazy" src="' . $image[0] . '" alt="" class="profile__img">';
          } else {
          ?>
            <img alt="Blog Logo" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/attorney_avatar.jpg" alt="" class="profile__img">
          <?php
          }
          ?>
        </div>
        <div class="profile__text-con">
          <h2 tabindex="0" class="profile__name title--section">
            <?php
            if (isset($user_meta_data['first_name'][0])) {
              echo $user_meta_data['first_name'][0];
            }
            if (isset($user_meta_data['last_name'][0])) {
              echo ' ' . $user_meta_data['last_name'][0];
            }
            if (isset($user_meta_data['surname'][0])) {
              echo ' ' . $user_meta_data['surname'][0];
            }
            ?>
          </h2>
          <h3 tabindex="0" class="profile__designation text--small">
            <?php
            if (isset($user_meta_data['position'][0])) {
              // custom post texonomy position name by id
              $position_id = $user_meta_data['position'][0];
              $position_name = get_term_by('id', $position_id, 'position');
              echo $position_name->name;
            }
            ?>
          </h3>
          <?php
          if ($user_meta_data['secondary_title'][0] != "" && $user_meta_data['secondary_title'][0] > 0) {
            // echo 'dbv';
            for ($j = 0; $j < $user_meta_data['secondary_title'][0]; $j++) {
              // echo "hello";
          ?>
              <h3 tabindex="0" class="profile__designation text--small">
                <?php echo $user_meta_data['secondary_title_' . $j . '_enter_your_name'][0] ?>
              </h3>
          <?php
            }
          }
          ?>
          <h3 tabindex="0" class="profile__contact-title text--small">Contact information</h3>
          <div class="profile__icon-con">
            <?php get_template_part("/assets/images/svg/email-icon") ?>
            <a href="<?php
                      if (isset($user_meta_data['contact_information_email'][0])) {
                        echo 'mailto:' . $current_user_mail->user_email;
                      }
                      ?>" class="profile__icon-text text--smallest">
              <?php

              if (isset($user_meta_data['contact_information_email'][0])) {
                echo "Email Address";
              }

              ?>
            </a>
          </div>
          <?php
          if (isset($user_meta_data['contact_information_phone'][0]) && $user_meta_data['contact_information_phone'][0] != '') {
          ?>
            <div class="profile__icon-con">
              <?php
              set_query_var("color", "profile__phone-icon");
              get_template_part("/assets/images/svg/phone-icon") ?>
              <a href="<?php
                        if (isset($user_meta_data['contact_information_phone'][0])) {
                          echo 'tel:' . $user_meta_data['contact_information_phone'][0];
                        }
                        ?>" class="profile__icon-text text--smallest">
                <?php
                if (isset($user_meta_data['contact_information_phone'][0])) {
                  echo $user_meta_data['contact_information_phone'][0];
                }
                ?>
              </a>
            </div>
          <?php
          }
          if (isset($user_meta_data['social_media_informations'][0]) && $user_meta_data['social_media_informations'][0] != '') {
          ?>
            <h3 tabindex="0" class="profile__social-title text--small">Follow on Socoal Media</h3>
          <?php
          }
          ?>
          <ul class="profile__socials">
            <?php
            if (isset($user_meta_data['social_media_informations_twitter'][0]) && $user_meta_data['social_media_informations_twitter'][0] != '') {
              $twitter = $user_meta_data['social_media_informations_twitter'][0];
            ?>
              <li class="profile__social-list">
                <a href="<?php echo $twitter ?>" target="_blank" class="profile__social-link">
                  <?php get_template_part("/assets/images/svg/twitter-icon") ?>
                </a>
              </li>
            <?php } ?>
            <?php
            if (isset($user_meta_data['social_media_informations_linkedin'][0]) && $user_meta_data['social_media_informations_linkedin'][0] != '') {
              $linkedin = $user_meta_data['social_media_informations_linkedin'][0];
            ?>

              <li class="profile__social-list">
                <a href="<?php echo $linkedin ?>" target="_blank" class="profile__social-link">
                  <?php get_template_part("/assets/images/svg/linkedin-icon") ?>
                </a>
              </li>
            <?php } ?>
            <?php
            if (isset($user_meta_data['social_media_informations_facebook'][0]) && $user_meta_data['social_media_informations_facebook'][0] != '') {
              $facebook = $user_meta_data['social_media_informations_facebook'][0];
            ?>
              <li class="profile__social-list">
                <a href="<?php echo $facebook ?>" target="_blank" class="profile__social-link">
                  <?php get_template_part("/assets/images/svg/facebook-icon") ?>
                </a>
              </li>
            <?php } ?>
          </ul>
          <div class="profile__s-btns">
            <form action="">
              <input type="hidden" name="pdf" value="<?php echo $user_meta_data['nickname'][0] ?>">
              <button class="profile__download-btn">
                <?php get_template_part("/assets/images/svg/pdf-icon") ?>
                <span class="profile__download-text">Download PDF</span>
              </button>
            </form>
            <button onclick='generateVcard()' class="profile__download-btn">
              <?php get_template_part("/assets/images/svg/v-card-icon") ?>
              <span class="profile__download-text">Download vCard</span>
            </button>
            <a href="javascript:void(0)" onClick="return rudr_favorite(this);" class="profile__download-btn" download>
              <?php get_template_part("/assets/images/svg/bookmark-icon") ?>
              BOOKMARK
            </a>
            <a href="https://www.addtoany.com/share" class="profile__download-btn a2a_dd" download>
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
        <a href="
                <?php echo get_permalink(get_option('page_for_posts')); ?>" type="submit" class="single__bar-sec-link section-bar__sec-link">
          View All News & Insights
        </a>
        <?php
        //get current post id to get author id
        $post_id = get_the_ID();
        $author_id = get_post_field('post_author', $post_id);
        $author_url = get_author_posts_url($author_id);
        ?>
        <form action="<?php echo $author_url ?>" method="get">
          <input type="hidden" name="blogs" value="<?php echo $user_meta_data['nickname'][0] ?>">
          <button type="submit" class="single__bar-sec-link section-bar__sec-link ">
            View All News & Insights by <?php echo $user_meta_data['first_name'][0] . ' ' . $user_meta_data['last_name'][0] ?>
          </button>
          <!-- <input type="submit" class="single__bar-sec-link" value="View Only Irving S. Firman‘s News & Insights"> -->
        </form>
        <a href="<?php
                  echo $user_profile_link;
                  ?>" class="single__bar-sec-link section-bar__sec-link">BACK TO <?php echo $user_meta_data['first_name'][0] . '’S PROFILE' ?> </a>
      </div>
    </div>
  </div>

  <?php
  // print_r($post_meta['ppma_authors_name'][0]);
  //split the string into an array
  // $authors = explode(',', $post_meta['ppma_authors_name'][0]);
  // print_r($authors);
  //get the author id from the author name

  ?>

  <div class="join">
    <div class="container">
      <div class="single__wrap">
        <div class="contact-form-right__wrap">
          <?php
          ?>
          <div class="">
            <div class="join__overview-richtext" id="section1">
              <h1 class="join__overview-richtext__title" tabindex="0">
                <?php the_title(); ?>
              </h1>
              <?php
              if (have_posts()) {
                while (have_posts()) {
                  the_post();
                  the_content();
                }
              }
              //get the published date of the post February 07, 2023
              ?>
              <div class="join__pub">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">

                  <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#707173" stroke="none">
                    <path d="M2375 4899 c-782 -64 -1478 -510 -1864 -1196 -324 -576 -385 -1281
-167 -1912 116 -333 289 -611 540 -869 705 -723 1792 -913 2701 -472 491 239
898 659 1115 1150 358 809 242 1724 -306 2422 -129 164 -385 396 -564 510
-199 127 -446 236 -665 293 -166 44 -277 62 -445 75 -150 11 -199 11 -345 -1z
m490 -443 c202 -36 347 -83 524 -167 740 -354 1172 -1135 1076 -1949 -83 -714
-559 -1324 -1230 -1575 -844 -316 -1787 -8 -2282 746 -143 218 -238 464 -290
749 -24 133 -24 467 0 600 39 211 83 352 168 529 286 598 847 997 1519 1080
107 14 408 6 515 -13z" />
                    <path d="M2460 4028 c-25 -14 -58 -44 -75 -67 l-30 -43 -3 -696 c-2 -506 0
-708 9 -737 9 -33 70 -99 352 -383 364 -365 397 -392 484 -392 155 0 256 158
192 300 -15 33 -100 125 -319 345 l-300 300 -2 631 -3 631 -27 39 c-44 62 -90
88 -167 92 -55 3 -74 -1 -111 -20z" />
                  </g>
                </svg>

                <?php
                $date = get_the_date('F d, Y');
                echo '<p class="single__date">' . $date . '</p>';

                ?>
              </div>

            </div>
            <div class="single-serve__rich custom__btn__area">

              <?php
              // print_r($post_meta);
              if ($post_meta['rich_text_area_custom_button_group_custom_text'][0] && $post_meta['rich_text_area_custom_button_group_custom_text'][0] != '') {
                echo $post_meta['rich_text_area_custom_button_group_custom_text'][0];
              }
              if ($post_meta['rich_text_area_custom_button_group_button_label'][0] && $post_meta['rich_text_area_custom_button_group_button_label'][0] != '') {
              ?>
                <div class="">
                  <a href="<?php
                            echo $post_meta['rich_text_area_custom_button_group_button_url'][0];
                            ?>" class="btn btn--secondary news__btn">
                    <?php

                    echo $post_meta['rich_text_area_custom_button_group_button_label'][0];
                    ?>
                  </a>
                </div>
              <?php
              }
              ?>
            </div>
          </div>

          <?php

          ?>
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
  </div>
</div>



<?php
get_footer();
?>

<script async src="https://static.addtoany.com/menu/page.js"></script>
<script>
  function generateData(data) {
    var data = <?php echo json_encode($user_meta_data); ?>;
    var html = `
  <div class="cv">
    <div class="cv__wrp">
      <div class="cv__header">
        <div class="cv__header__img__area">
        <img alt="Blog Logo" src="<?php
                                  echo get_template_directory_uri() . '/assets/images/brand-logo.png';
                                  ?>" alt="" class="cv__header__img">
        </div>
        <div class="cv__bio">
        <div class="other-hero__overlay">&nbsp;</div>
        <img alt="Banner Image" loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/hero-image.jpeg' ?>" alt="banner image" class="cv__bio__image">
          <div class="cv__bio__lft">
          <?php
          if ($user_meta_data['featured_image'][0]) {
            $image = wp_get_attachment_image_src($user_meta_data['featured_image'][0], 'full');
            echo '<img  alt="Blog Logo"loading="lazy" src="' . $image[0] . '" alt="" class="cv__bio__img">';
          } else {
          ?>
            <img  alt="Blog Logo" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/attorney_avatar.jpg" alt="" class="cv__bio__img">
            <?php
          }
            ?>
          </div>
          <div class="cv__bio__rgt">
            <h2 tabindex="0" class="cv__bio__name cv__txt__big"><?php
                                                                if (isset($user_meta_data['first_name'][0]) && $user_meta_data['first_name'][0] != "") {
                                                                  echo $user_meta_data['first_name'][0];
                                                                }
                                                                if (isset($user_meta_data['last_name'][0]) && $user_meta_data['last_name'][0] != "") {
                                                                  echo " " . $user_meta_data['last_name'][0];
                                                                }
                                                                ?></h2>
            <p class="cv__txt__mid">
            <?php
            if (isset($user_meta_data['position'][0])) {
              // custom post texonomy position name by id
              $position_id = $user_meta_data['position'][0];
              $position_name = get_term_by('id', $position_id, 'position');
              echo $position_name->name;
            }
            ?>
            </p>
            <div class="cv__bio__btm">
            <a href="<?php
                      if (isset($user_meta_data['contact_information_email'][0])) {
                        echo 'mailto:' . $current_user_mail->user_email;
                      }
                      ?>" class="cv__txt__bld">
              <?php
              if (isset($user_meta_data['contact_information_email'][0])) {
                echo "Email Address: " . $current_user_mail->user_email;
              }
              ?>
            </a>
            <a href="<?php
                      if (isset($user_meta_data['contact_information_phone'][0])) {
                        echo 'tel:' . $user_meta_data['contact_information_phone'][0];
                      }
                      ?>" class="cv__txt__bld">
              <?php
              if (isset($user_meta_data['contact_information_phone'][0])) {
                echo "Phone: " . $user_meta_data['contact_information_phone'][0];
              }
              ?>
            </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="profile__rich-news">
            <div class="profile__overview-richtext cv__richtext cv__richtext__wrp">
               
              <?php
              if ($post_title != "") {
              ?>
              <h4 tabindex="0" class="avoid-page-break-after avoid-page-break">
                <?php echo $post_title ?>
              </h4>
              <?php
              }
              ?>
              <div class="cv__cat__area">
                <p class="cv__cat__lbl">Category Name:</p>
                <div class="cv__cat__name__area">
                <?php
                foreach ($cat_name as $category) {
                  echo '<span class="news__tag cv__cat__name">' . $category . '</span>';
                }
                ?>
                </div>
              </div>
              <div class="profile__richText avoid-page-break-after">
              <?php
              if (have_posts()) {
                while (have_posts()) {
                  the_post();
                  the_content();
                }
              }
              ?>
              </div>
            </div>
          </div>
  `;

    var opt = {
      margin: [0, 0, .5, 0],
      filename: '<?php echo $user_meta_data['first_name'][0] ?>.pdf',
      pagebreak: {
        mode: ['avoid-all',
          'css',
          'legacy'
        ]
      },
      image: {
        type: 'jpeg',
        quality: 1
      },
      html2canvas: {
        scale: 1,
        letterRendering: true
      },
      jsPDF: {
        unit: 'in',
        format: 'A3',
        orientation: 'portrait',
        compressPDF: true,
        pagesplit: true
      }
    };
    //html2pdf added blank page at the end of the pdf
    html2pdf().set(opt).from(html).save();
  }

  function generateVcard() {
    var imageElement = document.createElement('img');
    imageElement.src = '<?php echo $data_uri ?>';
    var base64Image = imageElement.src.replace(/^data:image\/(png|jpg);base64,/, "");
    var data = [
      'BEGIN:VCARD',
      'VERSION:4.0',
      //image
      'PHOTO;ENCODING=b;TYPE=JPEG:' + base64Image,
      'FN:<?php echo $user_meta_data['first_name'][0] ?> <?php echo " " . $user_meta_data['last_name'][0] ?>',
      //email EMAIL;TYPE=<type1>,<type2>:<email address>
      'EMAIL;type=WORK;type=pref:<?php echo $email; ?>',
      'TEL;type=WORK;type=pref:<?php echo $user_meta_data['contact_information_phone'][0] ?>',
      'ADR;type=WORK;type=pref:;;<?php echo $address ?>',
      'END:VCARD'
    ].join('\n');
    var blob = new Blob([data], {
      type: 'text/vcard'
    });
    var url = URL.createObjectURL(blob);
    var link = document.createElement('a');
    link.setAttribute('href', url);
    link.setAttribute('download', '<?php echo $user_meta_data['first_name'][0] ?>.vcf');
    link.click();


  }
</script>
<style type="text/css">
  .join__overview-richtext ul li::before {
    content: "";
    position: absolute;
    height: 20px;
    width: 20px;
    top: 6px;
    left: -24px;
    background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/eva_arrow-right-fill-blue.svg');
  }

  h2{
    color: var(--color-secondary);
    font-size: 22px!important;
  }

  h3{
    color: var(--color-secondary);
    font-size: 20px!important;
  }

  .wp-block-button a {
    box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05);
    border-radius: 4px;
    font-weight: bold;
    font-size: 16px;
    line-height: 100%;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    color: var(--color-white);
    text-decoration: none !important;
    padding: 16px 24px;
    cursor: pointer;
    background: var(--color-primary);
    transform: translateY(0);
    transition: all 0.3s ease;
  }

  .wp-block-button a:hover {
    background-color: #e7c27a;
    box-shadow: 5px 10px 20px 0px #dfbb4540;
  }

  .join__overview-richtext__title {
    color: var(--color-secondary);
    margin: 0px 0 20px 0;
    font-family: var(--font-title);
    font-weight: bold;
    font-size: 24px;
    line-height: 1.4;
    letter-spacing: 0.02em;
    text-transform: uppercase;
}


</style>