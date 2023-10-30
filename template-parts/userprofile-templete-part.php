<?php
/* Template Name: User Profile */

add_action('init', 'me_post_pdf');

$slug = add_query_arg(array(), $wp->request);
$slug_concat = explode('/', $slug);
$current_user_name = end($slug_concat);
//get current user url to id 
$user = get_user_by('slug', $current_user_name);
$user_id = $user->ID;
$user_profile_link = get_author_posts_url($user_id);
//get current user email
$current_user_mail = get_user_by('id', $user_id);

$user_data = get_user_by('login', $current_user_name);
$user_meta_data = get_user_meta($user_id);
// $user_meta_json = json_encode($user_meta_data);
// print_r($user_meta_data);
//get office_location custom post by id
$office_location = get_post($user_meta_data['office_location'][0]);
//get office_location post meta data
$office_location_meta_data = get_post_meta($user_meta_data['office_location'][0]);

$post_per_page;
//v-card data
$first_name = $user_meta_data['first_name'][0];
$last_name = $user_meta_data['last_name'][0];
$full_name = $first_name . ' ' . $last_name;
$job_title = $user_meta_data['position'][0];
$job_title = get_term($job_title)->name;


$phone_number = $user_meta_data['contact_information_phone'][0];
// print_r($phone_number);
//image
$biography_image = wp_get_attachment_image_src($user_meta_data['biography_image'][0], 'thumbnail')[0];
$company_phone = $office_location_meta_data['phone'][0];
// print_r($biography_image[0]);
$email = $current_user_mail->user_email;
$address = $office_location_meta_data['address'][0] . ', ' . $office_location_meta_data['suite'][0] . ', ' . $office_location_meta_data['city'][0] . ', ' . $office_location_meta_data['state'][0] . ', ' . $office_location_meta_data['zip'][0];
// print_r($address);

//get the full url of the current page
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
//featured image
$featured_image;
if (isset($user_meta_data['featured_image'][0])) {
  $featured_image = wp_get_attachment_image_src($user_meta_data['featured_image'][0], 'full')[0];
} else {
  $featured_image = get_template_directory_uri() . '/assets/images/hero-image.jpeg';
}

$show_profile;
if (isset($user_meta_data['display_user_profile'][0])) {
  $show_profile = $user_meta_data['display_user_profile'][0];
}
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
      position: fixed;
                top: -60px;
                left: 0px;
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
      font-size: 24px;
      font-weight: 700;
      margin: 0px;
      margin-bottom: 0px;
      color: #0E3A68;
    }
    
    .newcv__post__title{
      font-size: 1rem!important;
      text-transform: capitalize!important;
      font-weight: 700;
      margin: 0;
      margin-bottom: 10px;
      color: #0E3A68;
    }

    .newcv__bio__title{
      font-size: 20px!important;
      text-transform: capitalize!important;
      font-weight: 700;
      margin: 0;
      margin-top: 10px;
      margin-bottom: 10px;
      color: #0E3A68;
    }

    .newcv__bio__title h1{
      font-size: 20px!important;
      text-transform: capitalize!important;
      font-weight: 700;
      margin: 0;
      margin-top: 10px;
      margin-bottom: 10px;
      color: #0E3A68;
    }

    .newcv__bio__title h2{
      font-size: 20px!important;
      text-transform: capitalize!important;
      font-weight: 700;
      margin: 0;
      margin-top: 10px;
      margin-bottom: 10px;
      color: #0E3A68;
    }

    .newcv__bio__title h3{
      font-size: 20px!important;
      text-transform: capitalize!important;
      font-weight: 700;
      margin: 0;
      margin-top: 10px;
      margin-bottom: 10px;
      color: #0E3A68;
    }

    .newcv__bio__title h4{
      font-size: 20px!important;
      text-transform: capitalize!important;
      font-weight: 700;
      margin: 0;
      margin-top: 10px;
      margin-bottom: 10px;
      color: #0E3A68;
    }

    .newcv__bio__title h5{
      font-size: 20px!important;
      text-transform: capitalize!important;
      font-weight: 700;
      margin: 0;
      margin-top: 10px;
      margin-bottom: 10px;
      color: #0E3A68;
    }

    .newcv__bio__title h6{
      font-size: 20px!important;
      text-transform: capitalize!important;
      font-weight: 700;
      margin: 0;
      margin-top: 10px;
      margin-bottom: 10px;
      color: #0E3A68;
    }

    .newcv__bio__title p{
      font-size: 20px!important;
      text-transform: capitalize!important;
      font-weight: 700;
      margin: 0;
      margin-top: 10px;
      margin-bottom: 0px;
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
    
    .newcv__profile__info{
      display: flex;
      flex-direction: column;
      grid-gap: 8px;
      padding-bottom: 10px;
      border-bottom: 2px solid #DBB46A;
    }

    .newcv__profile__info span{
      font-size: .9rem;
      color: #000;
    }
    
    .newcv__body__rgt{
      padding-left: 30px;
    }
    
    p {
      line-height: 1.6;
      margin: 0;
      font-size: 14px;
      margin-bottom: 10px;
      letter-spacing: .5px;
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
    }

    .newcv ul{
      margin: 0px;
      margin-bottom: 10px;
    }
    
    .newcv ul li{
      list-style: square;
      margin: 0;
      margin-bottom: 8px;
      line-height: 1.6;
      font-size: 14px;
      letter-spacing: .5px;
    }
    
    .newcv ul li:last-child{
      margin-bottom: 0px;
    }
    
    .newcv a{
      color: #0E3A68;
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

    p strong{
      margin-top: 20px;
    }

    .newcv__content__honors ul li{
      margin-bottom: 0px;
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
      </div>
          ";
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
  if ($user_meta_data['badges'][0]) {
    $html .= "<div class='newcv__profile__badge__images'>";
    for ($i = 0; $i < $user_meta_data['badges'][0]; $i++) {
      $html .= "<img src='" . wp_get_attachment_image_src($user_meta_data['badges_' . $i . '_image'][0], 'full')[0] . "' class='newcv__profile__badge__image'>";
    }
    $html .= "</div>";
  }
  $html .= "
      </div>
    </div>
    <div>
      <div class='newcv__body__lft'>
      <h1 class='newcv__user__name'>
      " . (isset($user_meta_data['first_name'][0]) ? $user_meta_data['first_name'][0] : '') . "
      " . (isset($user_meta_data['last_name'][0]) ? ' ' . $user_meta_data['last_name'][0] : '') . "
      " . (isset($user_meta_data['surname'][0]) ? ' ' . $user_meta_data['surname'][0] : '') . "
    </h1>
    <h2 class='newcv__bio__title'>
      " . (isset($user_meta_data['user_bio_header'][0]) ? $user_meta_data['user_bio_header'][0] : '') . "
    </h2>
    " . (isset($user_meta_data['affiliations_'][0]) ? "<div class='newcv__content'>
      " . $user_meta_data['affiliations_'][0] . "
    </div>" : '') . "
    ";
  if ($user_meta_data['wildcard_content_main'][0] > 0) {
    for ($i = 0; $i < $user_meta_data['wildcard_content_main'][0]; $i++) {
      $html .= "
          <div class='newcv__content'>
            <h2 class='newcv__post__title'>
              " . (isset($user_meta_data['wildcard_content_main_' . $i . '_title'][0]) ? $user_meta_data['wildcard_content_main_' . $i . '_title'][0] : '') . "
            </h2>
            " . (isset($user_meta_data['wildcard_content_main_' . $i . '_discription'][0]) ? $user_meta_data['wildcard_content_main_' . $i . '_discription'][0] : '') . "
          </div>
        ";
    }
  }
  if ($user_meta_data['education'][0] > 0) {
    $html .= "
        <div class='newcv__content'>
          <h2 class='newcv__post__title'>
            Education
          </h2>
          <ul>
        ";
    for ($i = 0; $i < $user_meta_data['education'][0]; $i++) {
      $education = $user_meta_data['education_' . $i . '_school'][0];
      $education_degree = $user_meta_data['education_' . $i . '_degree'][0];
      $education_year = $user_meta_data['education_' . $i . '_year'][0];
      $education_honors = $user_meta_data['education_' . $i . '_honors'][0];
      $education_distinction = $user_meta_data['education_' . $i . '_distinction'][0];
      $education_distinction = get_term_by('id', $education_distinction, 'distinction');
      $education_distinction_name = $education_distinction->name;
      // get custom texonomy data name by id
      $education_name = get_term_by('id', $education, 'school');
      $education_degree_name = get_term_by('id', $education_degree, 'degree');
      $html .= "
              <li style='margin-bottom: 0px;'>
                " . $education_name->name . " (" . $education_degree_name->name . "";
      if ($education_distinction_name) {
        $html .= ", " . $education_distinction_name;
      }
      $html .= ")";
      $html .= "

                <div class='newcv__content__honors'>
                  " . $education_honors . "
                </div>
              </li>
            ";
    }
    $html .= "
          </ul>
        </div>
      ";
  }

  if (isset($user_meta_data['bar_admissions'][0]) && $user_meta_data['bar_admissions'][0] != "") {
    $html .= "
        <div class='newcv__content'>
          <h2 class='newcv__post__title'>
            Bar Admissions
          </h2>
          <ul>
        ";
    $unserialize_bar_admissions = unserialize($user_meta_data['bar_admissions'][0]);
    foreach ($unserialize_bar_admissions as $key => $value) {
      $bar_admissions = get_term_by('id', $value, 'bar_admission');
      $html .= "
              <li>
                " . $bar_admissions->name . "
              </li>
            ";
    }
    $html .= "
          </ul>
        </div>
      ";
  }

  if (isset($user_meta_data['court_admissions'][0]) && $user_meta_data['court_admissions'][0] != "") {
    $html .= "
        <div class='newcv__content'>
          <h2 class='newcv__post__title'>
            Court Admissions
          </h2>
          <ul>
        ";
    $unserialize_court_admissions = unserialize($user_meta_data['court_admissions'][0]);
    foreach ($unserialize_court_admissions as $key => $value) {
      $court_admissions = get_term_by('id', $value, 'court_admission');
      $html .= "
              <li>
                " . $court_admissions->name . "
              </li>
            ";
    }
    $html .= "
          </ul>
        </div>
      ";
  }

  $all_capabilities = ['services', 'industries', 'departments'];

  foreach ($all_capabilities as $capability) {
    if (isset($user_meta_data[$capability][0])) {
      $unserialize_services = unserialize($user_meta_data[$capability][0]);
      if (isset($unserialize_services) && !empty($unserialize_services)) {
        $html .= '
      <div class="newcv__content">
        <h3 tabindex="0" class="newcv__post__title">
          ' . ucfirst($capability) . '
        </h3>
        <ul>
    ';
        foreach ($unserialize_services as $key => $value) {
          // $services = get_term_by('id', $value, 'services');
          //get capabilites post by id
          $services = get_post($value);
          // print_r($services);
          $html .= '
        <li>
          ' . $services->post_title . '
        </li>
      ';
        }
        $html .= '
        </ul>
      </div>
    ';
      }
    }
  }

  //office locations
  if (isset($user_meta_data['office_location'][0]) && $user_meta_data['office_location'][0] != "") {
    $unserialize_office_location = array();
    if (is_serialized($user_meta_data['office_location'][0])) {
      $unserialize_office_location = unserialize($user_meta_data['office_location'][0]);
      $length = count($unserialize_office_location);
    } else {
      $unserialize_office_location = array($user_meta_data['office_location'][0]);
      $length = 1;
    }
    $html .= "
  <div class='newcv__content'>
    <h3 class='newcv__post__title'>
      Office Locations
    </h3>
    <ul>
  ";
    foreach ($unserialize_office_location as $key => $value) {
      $office_location = get_term_by('id', $value, 'office_location');
      //get post by id
      $office_location = get_post($value);
      $html .= "
        <li>
          " . $office_location->post_title . "
        </li>
      ";
    }
    $html .= "
    </ul>
  </div>
";
  }

  //languages

  if (isset($user_meta_data['language'][0]) && $user_meta_data['language'][0] != "") {
    $unserialize_language = unserialize($user_meta_data['language'][0]);
    $length = count($unserialize_language);
    $html .= "
  <div class='newcv__content'>
    <h3 class='newcv__post__title'>
      Languages
    </h3>
    <ul>
  ";
    foreach ($unserialize_language as $key => $value) {
      // echo $i;
      $language = get_post($value);
      // if ($key == $length - 1) {
      //   echo $language->post_title;
      // } else {
      //   echo $language->post_title . ', ';
      // }
      if ($key == $length - 1) {
        $html .= "
          <li>
            " . $language->post_title . "
          </li>
        ";
      } else {
        $html .= "
          <li>
            " . $language->post_title . "
          </li>
        ";
      }
    }
    $html .= "
    </ul>
  </div>
";
  }

  if (isset($user_meta_data['honors_and_awards_'][0]) && $user_meta_data['honors_and_awards_'][0] != '') {
    $html .= "
  <div class='newcv__content'>
    <h4 class='newcv__post__title'>
    Awards & Recognition
    </h4>
    " . $user_meta_data['honors_and_awards_'][0] . "
  </div>
";
  }

  if (isset($user_meta_data['associations_associations_description'][0]) && $user_meta_data['associations_associations_description'][0] != "") {
    $html .= "
  <div class='newcv__content'>
    <h3 tabindex='0' class='newcv__post__title'>
";
    if (isset($user_meta_data['associations_associations_title'][0]) && $user_meta_data['associations_associations_title'][0] != '') {
      $html .= $user_meta_data['associations_associations_title'][0];
    } else {
      $html .= "Professional & Community Affiliations";
    }
    $html .= "
    </h3>
    " . $user_meta_data['associations_associations_description'][0] . "
  </div>
";
  }


  $html .= "
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
  header('Content-Disposition: inline; filename="' . $user_meta_data['first_name'][0] . ' ' . $user_meta_data['last_name'][0] . '.pdf"');
  header('Cache-Control: private, max-age=0, must-revalidate');
  header('Pragma: public');
  header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
  echo $pdf;
  exit;
}
get_header();
get_template_part('template-parts/shared/sidebar-nav-template');
?>
<div id="profile_pdf" class="profile">
  <div class="profile__overview-profile">
    <div class="profile__overlay"></div>
    <img alt="User Image" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-image.jpeg" alt="" class="profile__hero-image">
    <div class="profile__container container">
      <div class="profile__over-wrap">
        <div class="profile__image-con">
          <!-- display image by id -->
          <?php
          if ($user_meta_data['biography_image'][0]) {
            $image = wp_get_attachment_image_src($user_meta_data['biography_image'][0], 'full');
            echo '<img alt="User Image" loading="lazy" src="' . $image[0] . '" alt="" class="profile__img">';
          } else {
          ?>
            <img alt="User Image" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/attorney_avatar.jpg" alt="" class="profile__img">
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
            <h3 tabindex="0" class="profile__social-title text--small">Follow on Social Media</h3>
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
            <button onClick="return rudr_favorite(this);" class="profile__download-btn">
              <?php get_template_part("/assets/images/svg/bookmark-icon") ?>
              Bookmark
            </button>
            <a href="https://www.addtoany.com/share" class="profile__download-btn a2a_dd">
              <?php get_template_part("/assets/images/svg/share-icon") ?>
              Share
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  if ($user_meta_data['badges'][0] > 0 && $user_meta_data['badges_0_image'][0] != null) {
    get_template_part(
      'template-parts/Home/home-award-template',
      null,
      array(
        'user_meta_data' => $user_meta_data,
      )
    );
  }
  ?>
  <?php

  //if query parameter is set
  if (isset($_GET['blogs'])) {
  ?>
    <div class="single__section-bar">
      <div class="container">
        <div class="single__bar-wrap section-bar__wrap">
          <a href="
                <?php echo get_permalink(get_option('page_for_posts')); ?>" type="submit" class="single__bar-sec-link section-bar__sec-link">
            View All News & Insights
          </a>
          <form style="margin: 0;" action="<?php echo get_permalink(get_page_by_path('news-insights')) ?>" method="get">
            <input type="hidden" name="professors" value="<?php echo
                                                          //to lowercase
                                                          strtolower($user_meta_data['nickname'][0])
                                                          ?>">
            <button type="submit" class="single__bar-sec-link section-bar__sec-link <?php
                                                                                    if (isset($_GET['blogs']) && $_GET['blogs'] != '') {
                                                                                      echo 'section-bar-active';
                                                                                    }
                                                                                    ?> ">
              View All News & Insights by <?php echo $user_meta_data['first_name'][0] . ' ' . $user_meta_data['last_name'][0] ?>
            </button>

            <a href="<?php
                      echo $user_profile_link;
                      ?>" class="single__bar-sec-link section-bar__sec-link">BACK TO <?php echo $user_meta_data['first_name'][0] . '’S PROFILE' ?> </a>
            <!-- <input type="submit" class="single__bar-sec-link" value="View Only Irving S. Firman‘s News & Insights"> -->
          </form>
        </div>
      </div>
    </div>
  <?php
  }

  ?>
  <div class="profile__overview">
    <div class="container">
      <?php
      if (isset($_GET['blogs'])) {

        $paged = ($_GET['pages']) ? $_GET['pages'] : 1;
        $post_per_page = 4;
        $offset = ($paged - 1) * $post_per_page;
        //only show posts by author username
        $args = array(
          'author' => $user_id,
          'posts_per_page' => $post_per_page,
          'offset' => $offset,
          'post_type' => 'post',
          'post_status' => 'publish',
          'orderby' => 'date',
          'order' => 'DESC',
          'paged' => $paged,
          'meta_query' => array(
            array(
              'key' => 'ppma_authors_name',
              'value' => $author,
              'compare' => 'LIKE'
            )
          )
        );
        $query = new WP_Query($args);
      ?>
        <div class="contact-form-right__wrap">
          <div class="profile__rich-news">
            <?php
            if ($query->have_posts()) {
            ?>
              <div class="profile__news">
                <h2 tabindex="0" class="title--section">LATEST News & Insights</h2>
                <p class="text profile__news-text">The latest news & insights from our team at Tucker Arensberg.</p>
                <div class="profile__news-wrap">
                  <?php
                  while ($query->have_posts()) {
                    $query->the_post();
                    get_template_part("/template-parts/shared/blog-card-template-part") ?>
                  <?php
                  }
                  ?>
                </div>
              </div>
            <?php
            }
            //&paged=%#% is the key

            wp_reset_postdata();
            $total_posts = $query->found_posts;
            $total_pages = ceil($total_posts / $post_per_page);
            $current_page = $paged;
            // print_r($current_page);
            $pagination = paginate_links(array(
              'base' => add_query_arg(
                'pages',
                '%#%'
              ),
              'format' => '&pages=%#%',
              'prev_next' => false,
              'total' => $total_pages,
              'current' => $current_page
            ));
            if ($pagination) {
              echo '<div class="people__pagination index__pagination">';
              //previous button
              if ($current_page == 1) {
                echo '<span class="people__page-btn people__page-prev">Previous</span>';
              } else {
                echo '<a class="people__page-btn people__page-prev" href="' . add_query_arg('pages', $current_page - 1) . '">Previous</a>';
              }
              for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $current_page) {
                  echo '<span class="people__page-btn people__page-num current index__hide__pagenation">' . $i . '</span>';
                } else {
                  if ($i == 1 || $i == $total_pages || ($i >= $current_page - 2 && $i <= $current_page + 2)) {
                    //get the permalink of the page

                    echo '<a class="people__page-btn people__page-num index__hide__pagenation" href="' .
                      add_query_arg('pages', $i)
                      . '">' . $i . '</a>';
                  } elseif ($i == $current_page - 3 || $i == $current_page + 3) {
                    echo '<span class="people__page-btn people__page-num dots index__hide__pagenation">...</span>';
                  }
                }
              }
              if ($current_page == $total_pages) {
                echo '<span class="people__page-btn people__page-next disabled">Next</span>';
              } else {
                echo '<a class="people__page-btn people__page-next" href="' . add_query_arg('pages', $current_page
                  + 1) . '">Next</a>';
              }
              echo '</div>';
            }
            if ($total_pages > 1) {
            ?>
              <div class="index__pagination-rsp">
                <p class="index__pagination__text text">
                  Page <?php echo $current_page; ?> of <?php echo $total_pages; ?>
                </p>
              </div>
            <?php
            }
            //add pagination after query parameter by useing & operator
            ?>
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
      <?php
      } else {
        //if $show_profile is true 
      ?>
        <div class="profile__overview-wrap">
          <?php
          if ($user_meta_data['display_user_profile'][0] == 'true') {
          ?>

            <div class="profile__rich-news">
              <div class="profile__overview-richtext">
                <!-- <h2 tabindex="0" class="profile__overview-title title--section">overview</h2> -->
                <?php
                if (isset($user_meta_data['user_bio_header'][0])) {
                ?>
                  <div tabindex="0" class="profile__subtitle">
                  <?php echo $user_meta_data['user_bio_header'][0]; ?>
                  </div>
                <?php
                }
                // echo $user_meta_data['affiliations_'][0];
                if ($user_meta_data['affiliations_'][0] != '') {
                ?>
                  <div class="profile__richText">
                    <?php echo $user_meta_data['affiliations_'][0]; ?>
                  </div>
                <?php
                }
                ?>
                <?php
                if ($user_meta_data['wildcard_content_main'][0] > 0) {
                  $wildcard_content_main = $user_meta_data['wildcard_content_main'][0];
                  for ($i = 0; $i < $wildcard_content_main; $i++) {
                    if (isset($user_meta_data['wildcard_content_main_' . $i . '_title'][0])) {
                ?>
                      <h3 tabindex="0">
                        <?php echo $user_meta_data['wildcard_content_main_' . $i . '_title'][0]; ?>
                      </h3>
                    <?php
                    }
                    if (isset($user_meta_data['wildcard_content_main_' . $i . '_discription'][0])) {
                    ?>
                      <div class="profile__richText">
                        <?php echo $user_meta_data['wildcard_content_main_' . $i . '_discription'][0]; ?>
                      </div>
                <?php
                    }
                  }
                }
                ?>
              </div>
              <div class="profile__overview-content profile__overview-content--mobile">
                <div class="profile__overview-con">
                  <h3 tabindex="0" class="title--card-small">Education</h3>
                  <?php
                  if (isset($user_meta_data['education'][0])) {
                    for ($i = 0; $i < $user_meta_data['education'][0]; $i++) {
                      $education = $user_meta_data['education_' . $i . '_school'][0];
                      $education_degree = $user_meta_data['education_' . $i . '_degree'][0];
                      $education_year = $user_meta_data['education_' . $i . '_year'][0];
                      $education_honors = $user_meta_data['education_' . $i . '_honors'][0];
                      // get custom texonomy data name by id
                      $education_name = get_term_by('id', $education, 'school');
                      $education_degree_name = get_term_by('id', $education_degree, 'degree');
                  ?>
                      <div class="profile__icon-varsity">
                        <div class="profile__icon">
                          <?php get_template_part("/assets/images/svg/education-icon") ?>
                        </div>
                        <span class="text text--edu-honer">
                          <?php echo $education_name->name ?>
                          <?php echo '(' . $education_degree_name->name . ')';
                          if ($user_meta_data['education_' . $i . '_honors'][0] != "") {
                            echo ', ' . $user_meta_data['education_' . $i . '_honors'][0];
                          }
                          ?>
                        </span>
                      </div>
                    <?php
                    }
                  }
                  if (isset($user_meta_data['bar_admissions'][0]) && $user_meta_data['bar_admissions'][0] != "") {
                    ?>
                    <h3 tabindex="0" class="title--card-small">Bar Admissions</h3>
                    <?php
                    //convert a:2:{i:0;s:2:"69";i:1;s:2:"71";} type data to array
                    $unserialize_bar_admissions = unserialize($user_meta_data['bar_admissions'][0]);
                    foreach ($unserialize_bar_admissions as $key => $value) {
                      $bar_admissions = get_term_by('id', $value, 'bar_admission');
                    ?>
                      <div class="profile__icon-varsity">
                        <span class="profile__icon">
                          <?php get_template_part("/assets/images/svg/admission-icon") ?>
                        </span>
                        <span class=" text">
                          <?php echo $bar_admissions->name ?>
                        </span>
                      </div>
                    <?php
                    }
                  }
                  // multiselect data get by id
                  if ($user_meta_data['court_admissions'][0] != "") {
                    $unserialize_court_admissions = unserialize($user_meta_data['court_admissions'][0]);
                    // print_r($unserialize_court_admissions);
                    ?>
                    <h3 tabindex="0" class="title--card-small">Court Admissions</h3>
                    <?php
                    //convert a:2:{i:0;s:2:"69";i:1;s:2:"71";} type data to array
                    foreach ($unserialize_court_admissions as $key => $value) {
                      $court_admissions = get_term_by('id', $value, 'court_admission');
                    ?>
                      <div class="profile__icon-varsity">
                        <span class="profile__icon">
                          <?php get_template_part("/assets/images/svg/court-ad-icon") ?>
                        </span>
                        <span class=" text">
                          <?php echo $court_admissions->name ?>
                        </span>
                      </div>
                  <?php
                    }
                  }
                  ?>
                </div>
                <?php
                if (isset($user_meta_data['office_location'][0]) && $user_meta_data['office_location'][0] != "") {
                  //conter to array
                  //check is it serialize or not
                  $unserialize_office_location = array();
                  if (is_serialized($user_meta_data['office_location'][0])) {
                    $unserialize_office_location = unserialize($user_meta_data['office_location'][0]);
                    $length = count($unserialize_office_location);
                  } else {
                    $unserialize_office_location = array($user_meta_data['office_location'][0]);
                    $length = 1;
                  }
                ?>
                  <div class="profile__overview-con">
                    <h3 tabindex="0" class="title--card-small">
                      Office Location
                    </h3>
                    <ul>
                      <?php
                      foreach ($unserialize_office_location as $key => $value) {
                        $office_location = get_term_by('id', $value, 'office_location');
                        //get post by id
                        $office_location = get_post($value);
                      ?>
                        <li class="text">
                          <?php
                          echo $office_location->post_title;
                          ?>
                        </li>
                      <?php
                      }
                      ?>
                    </ul>
                  </div>
                <?php
                }
                //secondary_title is more then 0 then show this section
                if ($user_meta_data['language'][0] != "") {
                  // a:2:{i:0;s:5:"21796";i:1;s:5:"21798";} type data to array
                  $unserialize_language = unserialize($user_meta_data['language'][0]);
                  $length = count($unserialize_language);

                ?>
                  <div class="profile__overview-con">
                    <h3 tabindex="0" class="title--card-small">
                      Languages
                    </h3>
                    <ul>
                      <li class="text">
                        <?php
                        foreach ($unserialize_language as $key => $value) {
                          // echo $i;
                          $language = get_post($value);
                        ?>
                          <?php
                          if ($key == $length - 1) {
                            echo $language->post_title;
                          } else {
                            echo $language->post_title . ', ';
                          }
                          ?>
                        <?php
                        }
                        ?>
                      </li>
                    </ul>
                  </div>
                  <?php
                }
                $all_capabilities = ['services', 'industries', 'departments'];

                foreach ($all_capabilities as $capability) {
                  if (isset($user_meta_data[$capability][0])) {
                    $unserialize_services = unserialize($user_meta_data[$capability][0]);
                    if (isset($unserialize_services) && !empty($unserialize_services)) {
                  ?>
                      <div class="profile__overview-con">
                        <h3 tabindex="0" class="title--card-small">
                          <?php
                          echo ucfirst($capability);
                          ?>
                        </h3>
                        <ul>
                          <?php
                          foreach ($unserialize_services as $key => $value) {
                            // $services = get_term_by('id', $value, 'services');
                            //get capabilites post by id
                            $services = get_post($value);
                            // print_r($services);
                          ?>
                            <li class="text">
                              <?php echo $services->post_title ?>
                            </li>
                          <?php
                          }
                          ?>
                        </ul>
                      </div>
                  <?php
                    }
                  }
                }
                if (isset($user_meta_data['honors_and_awards_'][0]) && $user_meta_data['honors_and_awards_'][0] != '') {
                  ?>
                  <div class="profile__overview-con profile__richText">
                    <h3 tabindex="0" class="title--card-small">
                      <?php
                      if (isset($user_meta_data['honors_and_awards_honors_and_awards_title'][0]) && $user_meta_data['honors_and_awards_honors_and_awards_title'][0] != '') {
                        echo $user_meta_data['honors_and_awards_honors_and_awards_title'][0];
                      } else {
                        echo "AWARDS & RECOGNITION";
                      }
                      ?>
                    </h3>

                    <?php
                    echo $user_meta_data['honors_and_awards_'][0];
                    ?>
                  </div>
                <?php
                }
                if (isset($user_meta_data['associations_associations_description'][0]) && $user_meta_data['associations_associations_description'][0] != "") {
                ?>
                  <div class="profile__overview-con profile__richText">
                    <h3 tabindex="0" class="title--card-small">
                      <?php
                      if (isset($user_meta_data['associations_associations_title'][0]) && $user_meta_data['associations_associations_title'][0] != '') {
                        echo $user_meta_data['associations_associations_title'][0];
                      } else {
                        echo "Professional & Community Affiliations";
                      }
                      ?>
                    </h3>
                    <?php
                    echo $user_meta_data['associations_associations_description'][0];
                    ?>

                  </div>
                <?php
                }
                ?>
              </div>
            <?php
          }
          $homePageNews = new WP_Query(array(
            'author_name' => $current_user_name,
            'posts_per_page' => 4,
            'post_type' => 'post',
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
          ));
          // if post length is greater than 0
          if ($homePageNews->have_posts()) {
            ?>
              <div class="profile__news">
                <h2 tabindex="0" class="title--section">LATEST News & Insights</h2>
                <p class="text profile__news-text">The latest news & insights from our team at Tucker Arensberg.</p>
                <div class="profile__news-wrap">
                  <?php
                  while ($homePageNews->have_posts()) {
                    $homePageNews->the_post();
                  ?>
                    <?php get_template_part("/template-parts/shared/blog-card-template-part") ?>
                  <?php }
                  wp_reset_postdata();
                  ?>
                </div>
                <?php
                if ($homePageNews->found_posts > $post_per_page) {
                ?>
                  <form action="">
                    <input type="hidden" name="blogs" value="<?php echo $user_meta_data['nickname'][0] ?>">
                    <button class="btn btn--primary profile__news-btn">

                      <?php
                      set_query_var("color", "news__card__angle-icon-white");
                      get_template_part("/assets/images/svg/angle-icon")
                      ?>

                      <span>View ALL POSTS</span></button>
                  </form>
                <?php } ?>
              </div>
            <?php
          }
            ?>
            </div>
            <?php
            if (!isset($user_meta_data['display_user_profile'][0]) || $user_meta_data['display_user_profile'][0] == 'true') {
            ?>
              <div class="profile__overview-content">
                <div class="profile__overview-con">
                  <h3 tabindex="0" class="title--card-small">Education</h3>
                  <?php
                  if (isset($user_meta_data['education'][0])) {
                    for ($i = 0; $i < $user_meta_data['education'][0]; $i++) {
                      $education = $user_meta_data['education_' . $i . '_school'][0];
                      $education_degree = $user_meta_data['education_' . $i . '_degree'][0];
                      $education_year = $user_meta_data['education_' . $i . '_year'][0];
                      $education_distinction = $user_meta_data['education_' . $i . '_distinction'][0];
                      $education_distinction = get_term_by('id', $education_distinction, 'distinction');
                      $education_distinction_name = $education_distinction->name;
                      // get custom texonomy data name by id
                      $education_name = get_term_by('id', $education, 'school');
                      $education_degree_name = get_term_by('id', $education_degree, 'degree');
                  ?>
                      <div class="profile__icon-varsity">
                        <div class="profile__icon">
                          <?php get_template_part("/assets/images/svg/education-icon") ?>
                        </div>
                        <span class="text text--edu-honer">
                          <?php echo $education_name->name ?>
                          <?php echo '(' . $education_degree_name->name;
                          if ($education_distinction_name != "") {
                            echo ', ' . $education_distinction_name;
                          }
                          echo ')';

                          if ($user_meta_data['education_' . $i . '_honors'][0] != "") {
                            echo ' ' . $user_meta_data['education_' . $i . '_honors'][0];
                          }
                          ?>
                        </span>
                      </div>
                    <?php
                    }
                  }
                  if (isset($user_meta_data['bar_admissions'][0]) && $user_meta_data['bar_admissions'][0] != "") {
                    ?>
                    <h3 tabindex="0" class="title--card-small">Bar Admissions</h3>
                    <?php
                    //convert a:2:{i:0;s:2:"69";i:1;s:2:"71";} type data to array
                    $unserialize_bar_admissions = unserialize($user_meta_data['bar_admissions'][0]);
                    foreach ($unserialize_bar_admissions as $key => $value) {
                      $bar_admissions = get_term_by('id', $value, 'bar_admission');
                    ?>
                      <div class="profile__icon-varsity">
                        <span class="profile__icon">
                          <?php get_template_part("/assets/images/svg/admission-icon") ?>
                        </span>
                        <span class=" text">
                          <?php echo $bar_admissions->name ?>
                        </span>
                      </div>
                    <?php
                    }
                  }
                  // multiselect data get by id
                  if ($user_meta_data['court_admissions'][0] != "") {
                    $unserialize_court_admissions = unserialize($user_meta_data['court_admissions'][0]);
                    // print_r($unserialize_court_admissions);
                    ?>
                    <h3 tabindex="0" class="title--card-small">Court Admissions</h3>
                    <?php
                    foreach ($unserialize_court_admissions as $key => $value) {
                      $court_admissions = get_term_by('id', $value, 'court_admission');
                    ?>
                      <div class="profile__icon-varsity">
                        <span class="profile__icon">
                          <?php get_template_part("/assets/images/svg/court-ad-icon") ?>
                        </span>
                        <span class=" text">
                          <?php echo $court_admissions->name ?>
                        </span>
                      </div>
                  <?php
                    }
                  }
                  ?>
                </div>
                <?php
                if (isset($user_meta_data['office_location'][0]) && $user_meta_data['office_location'][0] != "") {
                  //conter to array
                  //check is it serialize or not
                  $unserialize_office_location = array();
                  if (is_serialized($user_meta_data['office_location'][0])) {
                    $unserialize_office_location = unserialize($user_meta_data['office_location'][0]);
                    $length = count($unserialize_office_location);
                  } else {
                    $unserialize_office_location = array($user_meta_data['office_location'][0]);
                    $length = 1;
                  }
                ?>
                  <div class="profile__overview-con">
                    <h3 tabindex="0" class="title--card-small">
                      Office Location
                    </h3>
                    <ul>
                      <?php
                      foreach ($unserialize_office_location as $key => $value) {
                        $office_location = get_term_by('id', $value, 'office_location');
                        //get post by id
                        $office_location = get_post($value);
                      ?>
                        <li class="text">
                          <?php
                          echo $office_location->post_title;
                          ?>
                        </li>
                      <?php
                      }
                      ?>
                    </ul>
                  </div>
                <?php
                }
                if ($user_meta_data['language'][0] != "") {
                  // a:2:{i:0;s:5:"21796";i:1;s:5:"21798";} type data to array
                  $unserialize_language = unserialize($user_meta_data['language'][0]);
                  $length = count($unserialize_language);

                ?>
                  <div class="profile__overview-con">
                    <h3 tabindex="0" class="title--card-small">
                      Languages
                    </h3>
                    <ul>
                      <li class="text">
                        <?php
                        foreach ($unserialize_language as $key => $value) {
                          // echo $i;
                          $language = get_post($value);
                        ?>
                          <?php
                          if ($key == $length - 1) {
                            echo $language->post_title;
                          } else {
                            echo $language->post_title . ', ';
                          }
                          ?>
                        <?php
                        }
                        ?>
                      </li>
                    </ul>
                  </div>
                  <?php
                }
                $all_capabilities = ['services', 'industries', 'departments'];
                foreach ($all_capabilities as $capability) {
                  if (isset($user_meta_data[$capability][0])) {
                    $unserialize_services = unserialize($user_meta_data[$capability][0]);
                    if (isset($unserialize_services) && !empty($unserialize_services)) {
                  ?>
                      <div class="profile__overview-con">
                        <h3 tabindex="0" class="title--card-small">
                          <?php
                          echo ucfirst($capability);
                          ?>
                        </h3>
                        <ul>
                          <?php
                          foreach ($unserialize_services as $key => $value) {
                            // $services = get_term_by('id', $value, 'services');
                            //get capabilites post by id
                            $services = get_post($value);
                            // print_r($services);
                          ?>
                            <li class="text">
                              <?php echo $services->post_title ?>
                            </li>
                          <?php
                          }
                          ?>
                        </ul>
                      </div>
                  <?php
                    }
                  }
                }
                if (isset($user_meta_data['honors_and_awards_'][0]) && $user_meta_data['honors_and_awards_'][0] != '') {
                  ?>
                  <div class="profile__overview-con profile__richText">
                    <h3 tabindex="0" class="title--card-small">
                      <?php
                      if (isset($user_meta_data['honors_and_awards_honors_and_awards_title'][0]) && $user_meta_data['honors_and_awards_honors_and_awards_title'][0] != '') {
                        echo $user_meta_data['honors_and_awards_honors_and_awards_title'][0];
                      } else {
                        echo "AWARDS & RECOGNITION";
                      }
                      ?>
                    </h3>

                    <?php
                    echo $user_meta_data['honors_and_awards_'][0];
                    ?>
                  </div>
                <?php
                }
                if (isset($user_meta_data['associations_associations_description'][0]) && $user_meta_data['associations_associations_description'][0] != "") {
                ?>
                  <div class="profile__overview-con profile__richText">
                    <h3 tabindex="0" class="title--card-small">
                      <?php
                      if (isset($user_meta_data['associations_associations_title'][0]) && $user_meta_data['associations_associations_title'][0] != '') {
                        echo $user_meta_data['associations_associations_title'][0];
                      } else {
                        echo "Professional & Community Affiliations";
                      }
                      ?>
                    </h3>
                    <?php
                    echo $user_meta_data['associations_associations_description'][0];
                    ?>

                  </div>
                <?php
                }
                ?>
              </div>
            <?php
            }
            ?>
        </div>
      <?php
      }
      ?>
    </div>
  </div>


</div>
<?php
//if ?pdf is set in the url then generate pdf dompdf  

get_footer();
?>
<style type="text/css">
  .profile__overview-con ul li::before {
    content: "";
    position: absolute;
    height: 20px;
    width: 20px;
    top: 6px;
    left: -24px;
    background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/eva_arrow-right-fill-blue.svg');
  }

  .profile__overview-richtext ul li::before {
    content: "";
    position: absolute;
    height: 20px;
    width: 20px;
    top: 6px;
    left: -24px;
    background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/eva_arrow-right-fill-blue.svg');
  }
</style>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<script>
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