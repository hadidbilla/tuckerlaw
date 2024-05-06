<?php
//get the current page url with quey params
$url = $_SERVER['REQUEST_URI'];

?>
<div class="people">
  <div class="container">
    <div class="people__wrap">
      <h2 class="people__tag title title--section">Search Attorneys</h2>
      <div class="people__alphabet-button-con">
        <?php
        global $wpdb;
        $searchUser;
        $conditionList = array();
        $args = array(
          'role' => 'professor',
          'meta_query' => array(
            'relation' => 'AND',
            array(
              'relation' => 'OR',
              array(
                'key' => 'display_user_profile',
                'value' => 'true',
                'compare' => '='
              ),
              array(
                'key' => 'display_user_profile',
                'compare' => 'NOT EXISTS'
              )
            )
          ),
          'meta_key' => 'last_name',
          'orderby' => 'meta_value',
          'order' => 'ASC',
        );
        $users = get_users($args);
        $alphabet = range('A', 'Z');
        // print user a-z list with link by user last first word
        foreach ($alphabet as $letter) {
          $found = false;
          //check if the letter is in the user last name first word
          foreach ($users as $user) {
            $user_name = $user->last_name;
            $user_name = explode(' ', $user_name);
            $user_name = $user_name[0];
            if (strtolower($letter) == strtolower($user_name[0])) {
              //if the letter is in the user last name first word, set found to true
              $found = true;
            }
          }
          if ($found == true) {
        ?>
            <form action="">
              <button class="people__alphabet-button btn--secondary
                <?php if (isset($_GET['letter']) && $_GET['letter'] == strtolower($letter)) {
                  echo 'select-btn';
                } ?>" type="submit" name="letter" value="<?php echo strtolower($letter); ?>"><?php echo $letter; ?></button>
            </form>
          <?php
          } else {
          ?>
            <button class="people__alphabet-button btn--secondary disable-btn"><?php echo $letter; ?></button>
        <?php
          }
        }
        ?>
      </div>
      <div class="people__filters-con">
        <form action="<?php the_permalink() ?>" method="get" class="people__form">
          <div class="people__filters">
            <div class="people__input-fil">
              <div class="people__name-input">
                <input id="user-name" name="user-name" type="text" <?php if (isset($_GET['user-name'])) {
                                                                      echo 'value="' . $_GET['user-name'] . '"';
                                                                    } ?> class="input people__input" placeholder="Name (Ex: John)">
                <label for="user-name" class="people__optional">Optional</label>
              </div>
              <div class="select-wrap">
                <select class="select people__select" name="office" id="office">
                  <?php
                  $args = array(
                    'post_type' => 'office_location',
                    'posts_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
                  );
                  $query = new WP_Query($args);
                  if ($query->have_posts()) {
                    echo '<option class="people__option-fld" disabled selected="" value="all">Office</option>';
                    while ($query->have_posts()) {
                      $query->the_post();
                      $office_location = get_the_title();
                      $slug = get_post_field('post_name', get_post());
                      //if query param office is set and is equal to the current office location, set the option to selected
                      if (isset($_GET['office']) && $_GET['office'] == $slug) {
                        echo '<option class="people__option-fld" selected value="' . $slug . '">' . $office_location . '</option>';
                      } else {
                        echo '<option class="people__option-fld" value="' . $slug . '">' . $office_location . '</option>';
                      }
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="select-wrap">
                <select class="select people__select" name="industry" id="industry">
                  <option class="people__select-placeholder" value="" disabled="" selected="">Industry</option>
                  <?php
                  // capabilities post type who has the taxonomy industry
                  $args = array(
                    'post_type' => 'capabilities',
                    'posts_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
                    //who has the capabilities_category taxonomy is equal to industry
                    'tax_query' => array(
                      array(
                        'taxonomy' => 'capabilities_category',
                        'field' => 'slug',
                        'terms' => 'industries',
                      ),
                    ),
                  );
                  $query = new WP_Query($args);
                  if ($query->have_posts()) {
                    while ($query->have_posts()) {
                      $query->the_post();
                      $industry = get_the_title();
                      $slug = get_post_field('post_name', get_post());
                      // print_r($industry . '\n' . $_GET['industry']);
                      // print_r(isset($_GET['industry']) && $_GET['industry'] == $industry);
                      if (isset($_GET['industry']) && $_GET['industry'] == $slug) {
                        echo '<option class="people__option-fld" selected value="' . $slug . '">' . $industry . '</option>';
                      } else {
                        echo '<option class="people__option-fld" value="' . $slug . '">' . $industry . '</option>';
                      }
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="select-wrap">
                <select class="select people__select" name="services" id="services">
                  <option class="people__select-placeholder" value="" disabled="" selected="">Services</option>
                  <?php
                  // capabilities post type post
                  $args = array(
                    'post_type' => 'capabilities',
                    'posts_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
                    //who has the capabilities_category taxonomy is equal to industry
                    'tax_query' => array(
                      array(
                        'taxonomy' => 'capabilities_category',
                        'field' => 'slug',
                        'terms' => 'services',
                      ),
                    ),
                  );
                  $query = new WP_Query($args);

                  if ($query->have_posts()) {
                    while ($query->have_posts()) {
                      $query->the_post();
                      $services = get_the_title();
                      $slug = get_post_field('post_name', get_post());
                      if (isset($_GET['services']) && $_GET['services'] == $slug) {
                        echo '<option class="people__option-fld" selected value="' . $slug . '">' . $services . '</option>';
                      } else {
                        echo '<option class="people__option-fld" value="' . $slug . '">' . $services . '</option>';
                      }
                    }
                  }
                  ?>
                </select>
              </div>
              <?php wp_reset_postdata(); ?>
              <div class="select-wrap">
                <select class="select people__select" name="admissions" id="admissions">
                  <option class="people__select-placeholder" value="" disabled="" selected="">Admissions</option>
                  <?php
                  //get bar_admission texonomy terms  and court_admission taxonomy terms
                  $bar_admission = get_terms(array(
                    'taxonomy' => 'bar_admission',
                    'hide_empty' => false,
                  ));
                  $court_admission = get_terms(array(
                    'taxonomy' => 'court_admission',
                    'hide_empty' => false,
                  ));
                  //if bar_admission or court_admission is set, set the option to selected and make group
                  if (isset($_GET['admissions'])) {
                    echo '<optgroup label="Bar Admissions">';
                    foreach ($bar_admission as $bar) {
                      if (isset($_GET['admissions']) && $_GET['admissions'] == $bar->slug) {
                        echo '<option class="people__option-fld" selected value="' . $bar->slug . '">' . $bar->name . '</option>';
                      } else {
                        echo '<option class="people__option-fld" value="' . $bar->slug . '">' . $bar->name . '</option>';
                      }
                    }
                    echo '</optgroup>';
                    echo '<optgroup label="Court Admissions">';
                    foreach ($court_admission as $court) {
                      if (isset($_GET['admissions']) && $_GET['admissions'] == $court->slug) {
                        echo '<option class="people__option-fld" selected value="' . $court->slug . '">' . $court->name . '</option>';
                      } else {
                        echo '<option class="people__option-fld" value="' . $court->slug . '">' . $court->name . '</option>';
                      }
                    }
                    echo '</optgroup>';
                  } else {
                    echo '<optgroup label="Bar Admissions">';
                    foreach ($bar_admission as $bar) {
                      echo '<option class="people__option-fld" value="' . $bar->slug . '">' . $bar->name . '</option>';
                    }
                    echo '</optgroup>';
                    echo '<optgroup label="Court Admissions">';
                    foreach ($court_admission as $court) {
                      echo '<option class="people__option-fld" value="' . $court->slug . '">' . $court->name . '</option>';
                    }
                    echo '</optgroup>';
                  }

                  ?>
                </select>
              </div>
              <div class="select-wrap">
                <select class="select people__select" name="school" id="school">
                  <option class="people__select-placeholder" value="" disabled="" selected="">School</option>
                  <?php
                  // get school taxonomy terms
                  $school = get_terms(array(
                    'taxonomy' => 'school',
                    'hide_empty' => false,
                  ));
                  //if school is set, set the option to selected
                  if (isset($_GET['school'])) {
                    foreach ($school as $school) {
                      if ($_GET['school'] == $school->slug) {
                        echo '<option class="people__option-fld" selected value="' . $school->slug . '">' . $school->name . '</option>';
                      } else {
                        echo '<option class="people__option-fld" value="' . $school->slug . '">' . $school->name . '</option>';
                      }
                    }
                  } else {
                    foreach ($school as $school) {
                      echo '<option class="people__option-fld" value="' . $school->slug . '">' . $school->name . '</option>';
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="select-wrap">
                <select class="select people__select" name="degree" id="degree">
                  <option class="people__select-placeholder" value="" disabled="" selected="">Undergraduate Degree</option>
                  <?php
                  // degree taxonomy terms
                  $degree = get_terms(array(
                    'taxonomy' => 'degree',
                    'hide_empty' => false,
                  ));
                  //if degree is set, set the option to selected
                  if (isset($_GET['degree'])) {
                    foreach ($degree as $degree) {
                      if ($_GET['degree'] == $degree->slug) {
                        echo '<option class="people__option-fld" selected value="' . $degree->slug . '">' . $degree->name . '</option>';
                      } else {
                        echo '<option class="people__option-fld" value="' . $degree->slug . '">' . $degree->name . '</option>';
                      }
                    }
                  } else {
                    foreach ($degree as $degree) {
                      echo '<option class="people__option-fld" value="' . $degree->slug . '">' . $degree->name . '</option>';
                    }
                  }
                  // reset post data
                  wp_reset_postdata();
                  ?>
                </select>
              </div>
              <div class="select-wrap">
                <select class="select people__select" name="title" id="title">
                  <option class="people__select-placeholder" value="" disabled="" selected="">Title</option>
                  <?php
                  // degree taxonomy terms
                  $title = get_terms(array(
                    'taxonomy' => 'position',
                    'hide_empty' => false,
                  ));
                  //if title is set, set the option to selected
                  if (isset($_GET['title'])) {
                    foreach ($title as $title) {
                      if ($_GET['title'] == $title->slug) {
                        echo '<option class="people__option-fld" selected value="' . $title->slug . '">' . $title->name . '</option>';
                      } else {
                        echo '<option class="people__option-fld" value="' . $title->slug . '">' . $title->name . '</option>';
                      }
                    }
                  } else {
                    foreach ($title as $title) {
                      echo '<option class="people__option-fld" value="' . $title->slug . '">' . $title->name . '</option>';
                    }
                  }
                  // reset post data
                  wp_reset_postdata();
                  ?>
                </select>
              </div>
            </div>
            <div class="people__btn-fil">
              <button class="people__search-btn btn btn--secondary">
                <?php get_template_part("/assets/images/svg/search-icon") ?>
                Search
              </button>
              <div class="people__search-btn-div">
                <a href="<?php
                          $page = get_page_by_title('Professionals');
                          echo get_permalink($page->ID);
                          ?>" class="people__search-btn people__reset-sec people__search-btn--clear btn">
                  <?php get_template_part("/assets/images/svg/reset-icon") ?>
                </a>
                <a href="<?php
                          $page = get_page_by_title('Professionals');
                          echo get_permalink($page->ID);
                          ?>" class="people__search-btn people__search-btn--clear btn">
                  See All
                </a>
              </div>
            </div>

          </div>
        </form>
      </div>

      <?php

      $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $per_page = get_option('posts_per_page');
      $offset = (($page - 1) * $per_page);
      //if _GET['letter] is set, get the letter
      if (isset($_GET['letter'])) {
        $args = array(
          'role' => 'professor',
          'meta_query' => array(
            'relation' => 'AND',
            array(
              'key' => 'last_name',
              'value' => '^' . $_GET['letter'] . '.*',
              'compare' => 'REGEXP'
            ),
            array(
              'relation' => 'OR',
              array(
                'key' => 'display_user_profile',
                'value' => 'true',
                'compare' => '='
              ),
              array(
                'key' => 'display_user_profile',
                'compare' => 'NOT EXISTS'
              )
            )
          ),
          'orderby' => 'meta_value',
          'meta_key' => 'last_name',
          'order' => 'ASC'
        );
        $searchUser = new WP_User_Query($args);
      } elseif ((isset($_GET['title']) && $_GET['title'] != '') || (isset($_GET['school']) && $_GET['school'] != '') || (isset($_GET['degree']) && $_GET['degree'] != '') || (isset($_GET['admissions']) && $_GET['admissions'] != '') || (isset($_GET['practice-area']) && $_GET['practice-area'] != '') || (isset($_GET['office']) && $_GET['office'] != '') || (isset($_GET['user-name']) && $_GET['user-name'] != '') || (isset($_GET['industry']) && $_GET['industry'] != '') || (isset($_GET['services']) && $_GET['services'] != '')) {

        $resultList = array();
        if ($_GET["school"]) {
          //get the school term id by slug
          $school = get_term_by('slug', $_GET["school"], 'school');
          $queryString = "SELECT user_id FROM `wp_usermeta` WHERE meta_key LIKE 'education\_%\_school' AND meta_value = $school->term_id";
          $result = $wpdb->get_results($queryString);
          $result = json_decode(json_encode($result), true);
          // convert $resultId to get the user_id
          $resultId = array_column($result, 'user_id');
          array_push($resultList, $resultId);
        }
        if ($_GET["office"]) {
          //get the school term id by slug
          $office_location_post_id = get_page_by_path($_GET['office'], OBJECT, 'office_location')->ID;
          // print_r($office_location_post_id);
          //NAME OF THE META KEY IS office_location

          $queryString = "SELECT user_id FROM `wp_usermeta` WHERE meta_key LIKE 'office_location' AND meta_value LIKE '%" . $office_location_post_id . "%'";
          $result = $wpdb->get_results($queryString);
          $result = json_decode(json_encode($result), true);
          // convert $resultId to get the user_id
          $resultId = array_column($result, 'user_id');
          array_push($resultList, $resultId);
        }

        if ($_GET["degree"]) {
          // get degree taxonomy terms id by slug
          $degree = get_term_by('slug', $_GET["degree"], 'degree');
          $queryString = "SELECT user_id FROM `wp_usermeta` WHERE meta_key LIKE 'education\_%\_degree' AND meta_value = $degree->term_id";
          $result = $wpdb->get_results($queryString);
          // convert object to array
          $result = json_decode(json_encode($result), true);
          // convert $resultId to get the user_id
          $resultId = array_column($result, 'user_id');
          array_push($resultList, $resultId);
        }

        if ($_GET["industry"]) {

          $industryId = get_page_by_path($_GET["industry"], OBJECT, 'capabilities');
          $industryId = $industryId->ID;
          $queryString = "SELECT user_id FROM `wp_usermeta` WHERE meta_key LIKE 'industries' AND meta_value LIKE '%" . $industryId . "%'";
          $result = $wpdb->get_results($queryString);
          // convert object to array
          $result = json_decode(json_encode($result), true);
          // convert $resultId to get the user_id
          $resultId = array_column($result, 'user_id');
          array_push($resultList, $resultId);
        }
        if ($_GET["services"]) {

          $industryId = get_page_by_path($_GET["services"], OBJECT, 'capabilities');
          $industryId = $industryId->ID;
          $queryString = "SELECT user_id FROM `wp_usermeta` WHERE meta_key LIKE 'services' AND meta_value LIKE '%" . $industryId . "%'";
          $result = $wpdb->get_results($queryString);
          // convert object to array
          $result = json_decode(json_encode($result), true);
          // convert $resultId to get the user_id
          $resultId = array_column($result, 'user_id');
          array_push($resultList, $resultId);
        }
        if ($_GET["title"]) {

          $industryId = get_term_by('slug', $_GET["title"], 'position');
          // print_r($industryId->term_id);
          $industryId = $industryId->term_id;
          //term name by id 
          // $industryId = get_term($industryId)->name;
          $queryString = "SELECT user_id FROM `wp_usermeta` WHERE meta_key LIKE 'position' AND meta_value LIKE $industryId  ";
          $result = $wpdb->get_results($queryString);
          // convert object to array
          $result = json_decode(json_encode($result), true);
          // convert $resultId to get the user_id
          $resultId = array_column($result, 'user_id');
          array_push($resultList, $resultId);
        }
        // SELECT user_id FROM `wp_usermeta` WHERE (meta_key LIKE 'first_name' OR meta_key LIKE 'last_name') AND LOWER(meta_value) LIKE '%Steven%'
        if ($_GET["user-name"]) {
          // $trimmedName = strtolower(trim($_GET["user-name"]));
          // $queryString = "SELECT user_id FROM wp_usermeta WHERE (meta_key LIKE 'first_name' OR meta_key LIKE 'last_name') AND LOWER(meta_value LIKE '%" . $trimmedName . "%') AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key LIKE 'display_user_profile' AND meta_value LIKE 'true')";
          // $result = $wpdb->get_results($queryString);
          // // convert object to array
          // $result = json_decode(json_encode($result), true);
          // // convert $resultId to get the user_id
          // $resultId = array_column($result, 'user_id');
          // print_r($resultId);
          // array_push($resultList, $resultId);
          $args = array(
            'role' => 'professor',
            'meta_query' => array(
              array(
                'relation' => 'OR',
                array(
                  'key' => 'display_user_profile',
                  'value' => 'true',
                  'compare' => '='
                ),
                array(
                  'key' => 'display_user_profile',
                  'compare' => 'NOT EXISTS'
                )
              )
            ),
            'orderby' => 'meta_value',
            'meta_key' => 'last_name',
            'order' => 'ASC'
          );

          $searchUser = new WP_User_Query($args);
          $searchUser = $searchUser->results;
          $splitName = explode(' ', $_GET["user-name"]);
          //remove empty string
          $splitName = array_filter($splitName);
          
          $query;
          //loop through the split name
          foreach ($splitName as $name) {
            //every name match first name name[0] || first name name[1] || last name name[0] || last name name[1]
            $query = "SELECT user_id FROM wp_usermeta WHERE (meta_key LIKE 'first_name' OR meta_key LIKE 'last_name') AND LOWER(meta_value) LIKE '%" . strtolower($name) . "%'";
          }
          $result = $wpdb->get_results($query);
          // convert object to array
          $result = json_decode(json_encode($result), true);
          //get these which are in the searchUser
          $resultId = array_column($result, 'user_id');
          $searchUser = array_filter($searchUser, function ($user) use ($resultId) {
            return in_array($user->ID, $resultId);
          });
          
          array_push($resultList, $resultId);
          // // convert $resultId to get the user_id
          // $resultId = array_column($result, 'user_id');
          // array_push($resultList, $resultId);
        }
        if ($_GET["practice-area"]) {
          // get capabilities post id by slug
          $practiceArea = get_page_by_path($_GET["practice-area"], OBJECT, 'capabilities');
          // $practiceArea = $practiceArea->ID;
          $practiceArea_id = $practiceArea->ID;
          // find this id in wp_usermeta table field name services or industries or departments get the user id

          $newQuery = "SELECT user_id FROM `wp_usermeta` WHERE (meta_key LIKE 'services' AND meta_value LIKE '%" . $practiceArea_id . "%') OR (meta_key LIKE 'industries' AND meta_value LIKE '%" . $practiceArea_id . "%') OR (meta_key LIKE 'departments' AND meta_value LIKE '%" . $practiceArea_id . "%')";
          // print_r($newQuery);
          $result = $wpdb->get_results($newQuery);
          // convert object to array
          $result = json_decode(json_encode($result), true);
          // convert $resultId to get the user_id
          $resultId = array_column($result, 'user_id');
          array_push($resultList, $resultId);
        }
        if ($_GET["admissions"]) {
          $texonomyName = '';
          $admissions = get_term_by('slug', $_GET["admissions"], 'bar_admission');
          $texonomyName = $admissions->taxonomy . 's';
          if (!$admissions->term_id) {
            $admissions = get_term_by('slug', $_GET["admissions"], 'court_admission');
            $texonomyName = $admissions->taxonomy . 's';
          }
          // print_r($admissions->term_id);
          $queryString = "SELECT user_id FROM `wp_usermeta` WHERE (meta_key LIKE 'bar_admissions' AND meta_value LIKE '%" . $admissions->term_id . "%') OR (meta_key LIKE 'court_admissions' AND meta_value LIKE '%" . $admissions->term_id . "%')";
          // $queryString = "SELECT user_id FROM `wp_usermeta` WHERE meta_key LIKE '".$texonomyName."' AND meta_value LIKE '%".$practiceArea->ID."%'";
          $result = $wpdb->get_results($queryString);
          // // convert object to array
          $result = json_decode(json_encode($result), true);
          // convert $resultId to get the user_id
          $resultId = array_column($result, 'user_id');
          array_push($resultList, $resultId);
        }
        // array intersect
        // print_r($resultList);
        if (count($resultList) > 1) {
          $resultId = array_intersect(...$resultList);
        } else {
          $resultId = $resultList[0];
        }
        // print_r($resultId);
        if ($resultId && count($resultId) > 0) {
          $queryString = "SELECT * FROM `wp_users` WHERE ID IN (" . implode(',', $resultId) . ")";
        } else {
          $queryString = "SELECT * FROM `wp_users` WHERE ID = 0";
        }
        // print_r($queryString);
        $result = $wpdb->get_results($queryString);
        $result = json_decode(json_encode($result), true);
        $searchUser = $result;
        //sort array by meta value last_name
        usort($searchUser, function ($a, $b) {
          //meta key  last_name
          $a = get_user_meta($a['ID'], 'last_name', true);
          $b = get_user_meta($b['ID'], 'last_name', true);
          return strcmp($a, $b);
        });
      } else {
        $args = array(
          'role' => 'professor',
          'number' => $per_page,
          'offset' => $offset,
          //display_user_profile is not  false
          'meta_query' => array(
            'relation' => 'OR',
            array(
              'key' => 'display_user_profile',
              'value' => 'true',
              'compare' => '='
            ),
            array(
              'key' => 'display_user_profile',
              'compare' => 'NOT EXISTS'
            )
          ),
          'orderby' => 'meta_value',
          'meta_key' => 'last_name',
          'order' => 'ASC'
        );
        $searchUser = new WP_User_Query($args);
      }
      if (gettype($searchUser) == "object") {
        if ($searchUser->total_users == 0) {
          echo "<h2 class='no-result'>No Results Found</h2>";
        }
      ?>
        <div class="people__card-contain">
          <?php
          foreach ($searchUser->results as $user) {
            $user_data = get_user_meta($user->ID);
            $user_mail = $user->user_email;
            //get biography_image id to get biography_image url
            $biography_image_id = $user_data['biography_image'][0];
            $biography_image_url = wp_get_attachment_image_src($biography_image_id, 'full');
            $featured_image_id = $user_data['featured_image'][0];
            $featured_image_url = wp_get_attachment_image_src($featured_image_id, 'full');
            $user_parma_link = get_author_posts_url($user->ID);
          ?>
            <div class="people__card">
              <a href="<?php echo $user_parma_link ?>" class="people__card-image-con">
                <?php
                //  echo $profile_img; 
                if ($featured_image_url[0] && $featured_image_url[0] != '') {
                ?>
                  <img loading='lazy' alt='alt attribute' src="<?php echo $featured_image_url[0]; ?>" alt='' class='people__card-image'>
                <?php
                } elseif ($biography_image_url[0] && $biography_image_url[0] != '') {
                ?>
                  <img loading='lazy' alt='alt attribute' src="<?php echo $biography_image_url[0]; ?>" alt='' class='people__card-image'>
                <?php
                } else {
                ?>
                  <img loading='lazy' alt='alt attribute' src="<?php echo get_template_directory_uri(); ?>/assets/images/attorney_avatar.jpg" alt='' class='people__card-image'>
                <?php
                }
                ?>
              </a>
              <div class="people__card-content">
                <a href="<?php echo $user_parma_link ?>" class="people__card-name">
                  <?php
                  if (isset($user_data['first_name'][0])) {
                    echo $user_data['first_name'][0] . " " . $user_data['last_name'][0];
                  }
                  if (isset($user_data['surname'][0]) && $user_data['surname'][0] != '') {
                    echo " " . $user_data['surname'][0];
                  }
                  ?>
                </a>
                <h6 class="people__card-designation text--small">
                  <?php if (isset($user_data['position'][0])) {
                    //position texonomy term name by id
                    $position = get_term_by('id', $user_data['position'][0], 'position');
                    echo $position->name;
                  } ?>
                </h6>
                <div class="people__card-icon-content">
                  <?php
                  //get user id
                  set_query_var("color", "people__card-icon");
                  get_template_part("/assets/images/svg/email-icon") ?>
                  <a href="<?php
                            if (isset($user_mail)) {
                              echo "mailto:" . $user_mail;
                            }
                            ?>" class="people__card-icon-text text text--smallest">
                    <?php if (isset($user_mail)) {
                      echo 'Email Address';
                    }
                    ?>
                  </a>
                </div>
                <div class="people__card-icon-content">
                  <?php if (isset($user_data['contact_information_phone'][0]) && $user_data['contact_information_phone'][0] != "") {
                  ?>
                    <?php get_template_part("/assets/images/svg/phone-icon") ?>
                    <a href="
                    <?php
                    if (isset($user_data['contact_information_phone'][0])) {
                      echo "tel:" . $user_data['contact_information_phone'][0];
                    }
                    ?>
                    " class="people__card-icon-text text text--smallest">
                    <?php
                    echo $user_data['contact_information_phone'][0];
                  }
                    ?>
                    </a>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      <?php
      } else {
        if (count($searchUser) == 0) {

          echo "<h2 class='no-result'>No Results Found</h2>";
        }
      ?>
        <div class="people__card-contain">
          <?php
          foreach ($searchUser as $user) {
            //display_user_profile 
            // $display_user_profile = get_user_meta($user['ID'], 'display_user_profile', true);
            // if ($display_user_profile == 'false') {
            //   continue;
            // }
            $user_data = get_user_meta($user['ID']);
            //avatar
            $user_avatar = get_avatar_data($user['ID']);
            $profile_img = $user_avatar['url'];
            $isShow = $user_data['display_user_profile'][0];
            //if isShow empty then or not exist then $isShow = true
            if (empty($isShow) || $isShow == '' || $isShow == 'true') {
              $isShow = true;
            }
            if ($isShow == 'true') {
          ?>
              <div class="people__card">
                <a href="<?php echo get_author_posts_url($user['ID']); ?>" class="people__card-image-con">
                  <?php
                  //  echo $profile_img; 
                  if ($profile_img && $profile_img != "") {
                  ?>
                    <img loading='lazy' alt='alt attribute' src="<?php echo $profile_img; ?>" alt='' class='people__card-image'>
                  <?php
                  } else {
                  ?>
                    <img loading='lazy' alt='alt attribute' src="<?php echo get_template_directory_uri(); ?>/assets/images/attorney_avatar.jpg" alt='' class='people__card-image'>
                  <?php
                  }
                  ?>
                </a>
                <div class="people__card-content">
                  <a href="<?php echo get_author_posts_url($user['ID']); ?>" class="people__card-name title--card-small">
                    <?php
                    if (isset($user_data['first_name'][0])) {
                      echo $user_data['first_name'][0] . " " . $user_data['last_name'][0];
                    }
                    if (isset($user_data['surname'][0]) && $user_data['surname'][0] != '') {
                      echo " " . $user_data['surname'][0];
                    }
                    ?>
                  </a>
                  <h6 class="people__card-designation text--small">
                    <?php if (isset($user_data['position'][0])) {
                      // get the position term id from the term name
                      $position_name = get_term_by('id', $user_data['position'][0], 'position');
                      echo $position_name->name;
                    } ?>
                  </h6>
                  <?php
                  $user_mail = get_user_by('id', $user['ID']);
                  $user_mail = $user_mail->user_email;
                  ?>
                  <a href="<?php
                            if (isset($user_mail)) {
                              echo "mailto:" . $user_mail;
                            }
                            ?>" class="people__card-icon-content">
                    <?php
                    //get user id

                    set_query_var("color", "people__card-icon");
                    get_template_part("/assets/images/svg/email-icon") ?>
                    <span class="people__card-icon-text text text--smallest">
                      <?php if (isset($user_mail)) {
                        echo 'Email Address';
                      }
                      ?>
                    </span>
                  </a>
                  <div class="people__card-icon-content">
                    <?php if (isset($user_data['contact_information_phone'][0]) && $user_data['contact_information_phone'][0] != "") {
                    ?>
                      <?php get_template_part("/assets/images/svg/phone-icon") ?>
                      <a href="
                    <?php
                      if (isset($user_data['contact_information_phone'][0])) {
                        echo "tel:" . $user_data['contact_information_phone'][0];
                      }
                    ?>
                    " class="people__card-icon-text text text--smallest">
                      <?php
                      // print_r($user_data);
                      echo $user_data['contact_information_phone'][0];
                    }
                      ?>
                      </a>
                  </div>
                </div>
              </div>
          <?php
            }
          }
          ?>
        <?php
      }
        ?>
        <?php
        $total_users = $searchUser->total_users;
        $total_pages = ceil($total_users / $per_page);
        $current_page = $page;
        $pagination = paginate_links(array(
          'base' => add_query_arg('paged', '%#%'),
          'format' => '?paged=%#%',
          //prv-next false
          'prev_next' => false,
          'total' => $total_pages,
          'current' => $current_page
        ));
        if ($pagination && $_GET['letter'] == "") {
          echo '<div class="people__pagination index__pagination people--space">';
          //previous button
          if ($current_page == 1) {
            echo '<span class="people__page-btn people__page-prev disabled">Previous</span>';
          } else {
            echo '<a class="people__page-btn people__page-prev" href="' . add_query_arg('paged', $current_page - 1) . '">Previous</a>';
          }
          for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $current_page) {
              echo '<span class="people__page-btn people__page-num current index__hide__pagenation">' . $i . '</span>';
            } else {
              if ($i == 1 || $i == $total_pages || ($i >= $current_page - 2 && $i <= $current_page + 2)) {
                echo '<a class="people__page-btn people__page-num index__hide__pagenation" href="' . get_pagenum_link($i) . '">' . $i . '</a>';
              } elseif ($i == $current_page - 3 || $i == $current_page + 3) {
                echo '<span class="people__page-btn people__page-num dots index__hide__pagenation">...</span>';
              }
            }
          }
          //next button
          if ($current_page == $total_pages) {
            echo '<span class="people__page-btn people__page-next disabled">Next</span>';
          } else {
            echo '<a class="people__page-btn people__page-next" href="' . add_query_arg('paged', $current_page + 1) . '">Next</a>';
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
        ?>
        </div>
    </div>
  </div>