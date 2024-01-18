<?php
get_header();

get_template_part('template-parts/shared/sidebar-nav-template');
$postData = [];
//get the tag current id
$tag_id = get_queried_object_id();
$current_url = home_url(add_query_arg(array(), $wp->request));

$page_meta = get_post_meta(get_page_by_path('news-insights')->ID);
$first_btn_label = $page_meta['first_button_group_first_button_label'][0];
$first_btn_link = $page_meta['first_button_group_first_button_link'][0];
$first_btn_icon = $page_meta['first_button_group_first_button_icon'][0];
$second_btn_label = $page_meta['second_button_group_second_button_label'][0];
$second_btn_link = $page_meta['second_button_group_second_button_link'][0];
$second_btn_icon = $page_meta['second_button_group_second_button_icon'][0];

get_template_part('template-parts/shared/banner-template', null, array(
  'first_btn_label' => $first_btn_label,
  'first_btn_link' => $first_btn_link,
  'first_btn_icon' => $first_btn_icon,
  'second_btn_label' => $second_btn_label,
  'second_btn_link' => $second_btn_link,
  'second_btn_icon' => $second_btn_icon
));
$current_url = home_url(add_query_arg(array(), $wp->request));

?>

<div class="index people">

  <div class="container">
    <div class="index__wrap">
    <form id="news"  class="index__header" action="">
        <div class="index__name__input">
          <input id="post-name" name="post-name" type="text"  <?php
            if (isset($_GET['post-name']) && $_GET['post-name'] != '') {
              echo 'value="' . $_GET['post-name'] . '"';
            }
          ?>  class="input index__input" placeholder="What are you looking for?">
          <div class="index__search-submit">
            <input type="submit" class="index__search-btn" />
            <?php get_template_part("/assets/images/svg/search-small-icon") ?>
          </div>

        </div>
        <?php
        // get all capabilities categories
        $filter_select = array(
          'taxonomy' => 'capabilities_category',
          'hide_empty' => false,
        );
        $capabilities_categories = get_terms($filter_select);
        // select options for capabilities categories
        ?>
        <div class="select-wrap">
          <select  class="select index__select" name="capability" id="capabilities">
            <option class="index__select-placeholder" value="" disabled selected> Capabilities </option>
            <?php
            foreach ($capabilities_categories as $key => $value) {
            ?>
              <option <?php
                      if (isset($_GET['capability']) && $_GET['capability'] == $value->slug) {
                        echo 'selected';
                      }
                      ?> class="index__option-fld" value=<?php echo $value->slug; ?>><?php echo $value->name; ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <?php
        // get all capabilities posts
        $filter_select = array(
          'post_type' => 'capabilities',
          'posts_per_page' => -1,
          'orderby' => 'title',
        'order' => 'ASC',
        );
        $capabilities_posts = new WP_Query($filter_select);
        ?>
        <div class="select-wrap">
          <select  class="select index__select" name="paritiesarea" id="paritiesarea">
            <option class="index__select-placeholder" value="" disabled="" selected="">Filed Under</option>
            <?php
            foreach ($capabilities_posts->posts as $key => $value) {

            ?>
              <option <?php
                      if (isset($_GET['paritiesarea']) && $_GET['paritiesarea'] == $value->post_name) {
                        echo 'selected';
                      }
                      ?> class="index__option-fld" value="<?php echo $value->post_name; ?>"><?php echo $value->post_title; ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <?php
        // get professors users roll
        $filter_select = array(
          'role' => 'professor'
        );
        $professors = get_users($filter_select);
        ?>
        <div class="select-wrap">
          <select  class="select index__select" name="professors" id="professors">
            <option class="index__select-placeholder" value="" disabled="" selected="">
              Attorneys
            </option>
            <?php
            foreach ($professors as $key => $value) {
            ?>
              <option <?php
                      if (isset($_GET['professors']) && $_GET['professors'] == $value->user_nicename) {
                        echo 'selected';
                      }
                      ?> class="index__option-fld" value="<?php echo $value->user_nicename; ?>">
                <?php
                if ($value->first_name && $value->last_name) {
                  echo $value->first_name . ' ' . $value->last_name;
                } else {
                  echo $value->display_name;
                }
                ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div class="index__bttm__btn__area">
        <a href="<?php echo $current_url; ?>" class="index__bttm__btn index__bttm__refresh">
          <?php
          get_template_part("/assets/images/svg/reset-icon");
          ?>
        </a>
        <a href="<?php echo $current_url; ?>" class="index__bttm__btn index__bttm__seeall">
          See All
        </a>
      </div>
      <div class="index__bttm__btn__area--submit">
      <button onclick="this.form.submit()" class="index__bttm__btn index__bttm__submit">
      <?php get_template_part("/assets/images/svg/search-icon") ?>
      Search
        </button>
      </div>
      </form>
      <div id="news"  class="index__wrp">
          <div class="index__news-content">
                <?php
                $args;
                $posts_per_page = get_option('posts_per_page');
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $filter_data_list1 = [];
                $filter_data_list2 = [];
                $filter_data_list3 = [];
                $filter_data_list4 = [];
                $filter_data_list_all = [];
                // javascript to get professors selected value on change
                if (isset($_GET['professors']) && $_GET['professors'] != '') {
                  $professor = $_GET['professors'];
                  // get post by author user nicename
                  $args = array(
                    'post_type' => 'post',
                    'author_name' => $professor,
                    'posts_per_page' => -1,
                    'tag_id' => $tag_id
                  );
                  $data = new WP_Query($args);
                  if($data->posts){
                    foreach ($data->posts as $key => $value) {
                      $filter_data_list1[] = $value->ID;
                    }
                   }
                   array_push($filter_data_list_all,$filter_data_list1);
                }
                if (isset($_GET['capability']) && $_GET['capability'] != '') {
                  $capability = $_GET['capability'];
                  //get texonomy id by slug
                  $term = get_term_by('slug', $capability, 'capabilities_category');
                  $term_id = $term->term_id;
                  // print_r($term_id);
                  // get post by meta key capabilities-category and meta value capabilities id
                  $args = array(
                    'post_type' => 'post',
                    // published posts
                    'post_status' => 'publish',
                    'meta_key' => 'capabilities_categor_capabilities_category',
                    //tag id
                    'tag_id' => $tag_id,
                    //check a:1:{i:0;s:3:"555";} match with capabilities id as a string
                    'meta_value' => 'a:1:{i:0;s:' . strlen($term_id) . ':"' . $term_id . '";}',
                    'posts_per_page' => -1
                  );
                  $data = new WP_Query($args);
                  if($data->posts){
                    foreach ($data->posts as $key => $value) {
                      $filter_data_list2[] = $value->ID;
                    }
                   }
                   array_push($filter_data_list_all,$filter_data_list2);
                }
                if (isset($_GET['paritiesarea']) && $_GET['paritiesarea'] != '') {
                  $paritiesarea = $_GET['paritiesarea'];
                  //get capabilities post id by post name
                  $post_id = get_page_by_path($paritiesarea, OBJECT, 'capabilities')->ID;
                  ///check how many capabilities_categor_practice_areas are selected in bl
                  $args = array(
                    'post_type' => 'post',
                    // published posts
                    'post_status' => 'publish',
                    //tag id
                    'tag_id' => $tag_id,
                    'meta_query' => array(
                      array(
                        'key' => 'capabilities_categor_practice_areas',
                        'value' => '"' . $post_id . '"',
                        'compare' => 'LIKE'
                      )
                    ),
                  );
                  $data = new WP_Query($args);
                  if($data->posts){
                    foreach ($data->posts as $key => $value) {
                      $filter_data_list3[] = $value->ID;
                    }
                   }
                   array_push($filter_data_list_all,$filter_data_list3);
                }
                if(isset($_GET['post-name']) && $_GET['post-name'] != ''){
                  $search = $_GET['post-name'];
                  
                  $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    //check title or content search
                    //tag id
                    'tag_id' => $tag_id,
                    's' => $search,
                    'posts_per_page' => $posts_per_page
                  );
                  $data = new WP_Query($args);
                  if($data->posts){
                    foreach ($data->posts as $key => $value) {
                      $filter_data_list4[] = $value->ID;
                    }
                   }
                   array_push($filter_data_list_all,$filter_data_list4);
                }
                if ($args) {
                  $new_filter_data_list;
                  if(count($filter_data_list_all) > 1){
                    $new_filter_data_list = array_intersect(...$filter_data_list_all);
                  }else{
                    $new_filter_data_list = $filter_data_list_all[0];
                  }
                    if (count($new_filter_data_list) > 0) {
                      ?>
                      <div class="index__blog__area">
                        <?php
                      $args = array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'post__in' => $new_filter_data_list,
                        'posts_per_page' => $posts_per_page,
                        "paged" => $paged,
                      );
                      $all_posts = new WP_Query($args);
                      while ($all_posts->have_posts()) {
                        $all_posts->the_post();
                        get_template_part("/template-parts/shared/blog-card-template-part");
                      }
                      ?>
                      </div>
                      <?php
                    }
                      else {
                        ?>
                        
                            <h2 tabindex="0" class="no-result">No Results Found</h2>
                       
                        <?php
                      }
                  
                } else {
                  $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'tag_id' => $tag_id,
                    'posts_per_page' => $posts_per_page,
                    "paged" => $paged,
                  );
                  $all_posts = new WP_Query($args);
                  if ($all_posts->have_posts()) {
                    ?>
                    <div class="index__blog__area">
                      <?php
                  while ($all_posts->have_posts()) {
                    $all_posts->the_post();
                    get_template_part("/template-parts/shared/blog-card-template-part");
                  }
                  ?>
                  </div>
                  <?php
                  } else {
                    ?>
                        <h2 tabindex="0" class="no-result">No Results Found</h2>
                    <?php
                  }
                }
                ?>
             
              <?php
                $total_pages = $all_posts->max_num_pages;
                if ($total_pages > 1) {

                  $current_page = max(1, get_query_var('paged'));
      
                  echo '<div class="people__pagination index__pagination">';
                  if ($current_page == 1) {
                    echo '<span class="people__page-btn people__page-prev disabled">Previous</span>';
                  } else {
                    echo '<a class="people__page-btn people__page-prev" href="' . get_pagenum_link($current_page - 1) . '">Previous</a>';
                  }
                  for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $current_page) {
                      echo '<span class="people__page-btn people__page-num current index__hide__pagenation">' . $i . '</span>';
                    } else {
                     //show first 3 numbers and last 3 numbers
                      if ($i <= 3 || $i >= $total_pages - 2) {
                        echo '<a class="people__page-btn people__page-num index__hide__pagenation" href="' . get_pagenum_link($i) . '">' . $i . '</a>';
                      } else {
                        //show dots between 3 and last 3 numbers
                        if ($i == $current_page - 1 || $i == $current_page + 1) {
                          echo '<a class="people__page-btn people__page-num index__hide__pagenation" href="' . get_pagenum_link($i) . '">' . $i . '</a>';
                        } else {
                          //show dots between 3 and last 3 numbers
                          if ($i == $current_page - 2 || $i == $current_page + 2) {
                            echo '<span class="people__page-btn people__page-num index__hide__pagenation">...</span>';
                            // echo '<span class="people__page-btn people__page-num-rsp">of</span>';
                          }
                        }
                      }
                    }
                  }
                  //next button
                  if ($current_page == $total_pages) {
                    echo '<span class="people__page-btn people__page-next disabled">Next</span>';
                  } else {
                    echo '<a class="people__page-btn people__page-next" href="' . get_pagenum_link($current_page + 1) . '">Next</a>';
                  }
                  echo '</div>';
                }
                //current page of total pages
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
            <div class="index__filter-links">
              <div class="index__filter-sec">
                <h4 tabindex="0" class="index__filter-title">Category</h4>

                <?php
                $categories = get_categories(array(
                  'hide_empty' => false
                ));
                $isBlogPage = is_home();
                // get current page url without author base and page number
                $currentUrl = get_pagenum_link();
                $currentUrl = preg_replace('/\/author\/[a-zA-Z0-9]+/', '', $currentUrl);
                $currentUrl = rtrim($currentUrl, '/');
                $currentUrl = strtok($currentUrl, '?');
                $currentUrlBaseName = basename($currentUrl);

                // get the years with post count and months with posts number
                $years = $wpdb->get_results("SELECT YEAR(post_date) AS year, MONTH(post_date) AS month, count(ID) as posts FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' GROUP BY year, month ORDER BY post_date DESC");

                $years_months = array();
                foreach ($years as $year) {

                  $years_months[$year->year]['posts'] += $year->posts;
                  $years_months[$year->year]['months'][$year->month] = $year->posts;
                }
                ?>
                <div class="index__filter-link-sec">
                  <a href="<?php echo esc_url(site_url('/news-insights/')); ?>" class="<?php echo  is_home()  ? 'index__filter-link-active' : 'index__filter-link' ?>">View all</a>
                  <?php foreach ($categories as $category) { ?>
                    <a href="<?php echo get_category_link($category->term_id).'#news'; ?>" class="<?php echo  $currentUrlBaseName == $category->slug  ? 'index__filter-link-active index__filter-link' : 'index__filter-link' ?>"><?php echo $category->name ?></a>
                  <?php } ?>
                </div>
              </div>

              <div class="index__filter-sec">
                <h4 tabindex="0" class="index__filter-title">Browse By Year</h4>
                <div class="index__filter-link-sec">
                  <ul>
                    <?php foreach ($years_months as $year => $months) {
                    ?>
                      <li>
                        <div class="index__filter-link index__year ">
                        <a class="index__year__link" href="<?php echo get_year_link($year).'#news'  ?>">
                          <?php echo $year; ?>
                        </a>
                          <div class="index__filter__rgt">
                            <span class="index__post__num">
                              <?php echo $months['posts']; ?>
                            </span>
                            <span onclick="dataDropDown(this)" btn-year-data="<?php echo $year; ?>" class="index__filter__icon">
                              <?php
                              set_query_var("new", "index__icon--color");
                              get_template_part("/assets/images/svg/dropdown-icon"); ?>
                            </span>
                          </div>
                        </div>
                        <ul year-data="<?php echo $year; ?>" class="index__child <?php
                              // check it is month archive or not
                              if (is_month()) {
                                if (get_query_var('monthnum')) {
                                  echo 'index__show__child';
                                }
                              }
                              ?>">
                          <?php
                          foreach ($months['months'] as $key => $vale) {
                          ?>
                            <li>
                            <a href="<?php echo 
                              get_month_link($year, $key).'#news'  ?>" class="index__filter-link index__month <?php
                              // check it is month archive or not
                              if (is_month()) {
                                if (get_query_var('monthnum') == $key) {
                                  echo 'index__filter-link-active index__show__child';
                                }
                              }
                              ?>"><?php echo $wp_locale->get_month($key); ?>
                                <span class="index__post__num">
                                  <?php echo $vale; ?>
                                </span>
                              </a>
                            </li>
                          <?php } ?>
                        </ul>
                      </li>
                    <?php } ?>
                  </ul>


                </div>
              </div>

              <div class="index__filter-sec">
                <h4 tabindex="0" class="index__filter-title">Browse by tags</h4>
                <div class="index__filter-link-sec index__tag">
                <?php
            $tags = get_tags(array(
              'number' => 0, // Retrieve all tags
              'hide_empty' => false,
              'orderby' => 'name', // Sort tags by name
              'order' => 'ASC'
            ));
            if ($tags) {
              $count = 0;
              foreach ($tags as $tag) {
                //fist 10 tags are class add class active-tag other tags are class add class hide-tag

                if ($count < 10) {
                  $count++;

            ?>
                <a href="<?php echo get_tag_link($tag->term_id) . '#news';  ?>" class="<?php echo 'index__filter-link-tag active__tag' ?>"><?php echo $tag->name ?></a>
            <?php
                } else {
            ?>
              <a href="<?php echo get_tag_link($tag->term_id) . '#news';  ?>" class="<?php echo 'index__filter-link-tag active__tag-hide' ?>"><?php echo $tag->name ?></a>
            <?php
              }
            }
            }
            ?>
            <span id="seemore" class="news__tag news__tag--bold">
            See More
            <?php

              echo get_template_part( 'assets/images/svg/left-arrow' );
            ?>
          </span>
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