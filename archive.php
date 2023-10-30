<?php
get_header();
get_template_part('template-parts/shared/sidebar-nav-template');
$postData = [];
$posts_per_page = get_option('posts_per_page');
$post_title = get_the_title();
$post_excerpt = get_the_excerpt();
$post_content = get_the_content();
$slice_content = substr($post_content, 0, 80);
$post_thumbnail = get_the_post_thumbnail_url();
if (has_excerpt()) {
  $post_excerpt = get_the_excerpt();
} else {
  $post_excerpt = substr($post_content, 0, 80);
}
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
//check what what kind of archive page is
$query_year;
$query_month;
if (is_month()){
  //get the year and month
  $query_year = get_query_var('year');
  $query_month = get_query_var('monthnum');
}
if (is_year()){
  $query_year = get_query_var('year');
}
// print_r($query_year);
// print_r($query_month);
$current_url = home_url(add_query_arg(array(), $wp->request));
?>

<div class="index people">
  <div class="container">
    <div class="index__wrap">
    <form class="index__header" action="">
        <div class="index__name__input">
          <input id="post-name" name="post-name" <?php
            if (isset($_GET['post-name']) && $_GET['post-name'] != '') {
              echo 'value="' . $_GET['post-name'] . '"';
            }
          ?> type="text" class="input index__input" placeholder="What are you looking for?">
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
      <div class="index__wrp">
        <div class="index__news-content">
            <?php
            $args;
            // javascript to get professors selected value on change
            $filter_data_list1 = [];
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $posts_per_page = get_option('posts_per_page');
            $filter_data_list2 = [];
            $filter_data_list3 = [];
            $filter_data_list4 = [];
            $filter_data_list_all = [];
            $posts_per_page = get_option('posts_per_page');
            if (isset($_GET['professors']) && $_GET['professors'] != '') {
              $professor = $_GET['professors'];
              // get post by author user nicename
              //if month and year are selected
              ;

              if ($query_month && $query_year) {
                $args = array(
                  'post_type' => 'post',
                  'author_name' => $professor,
                  'posts_per_page' => -1,
                  'date_query' => array(
                    array(
                      'year' => $query_year,
                      'month' => $query_month
                    )
                  )
                );
              } elseif ($query_year) {
                $args = array(
                  'post_type' => 'post',
                  'author_name' => $professor,
                  'posts_per_page' => -1,
                  'date_query' => array(
                    array(
                      'year' => $query_year
                    )
                  )
                );
               
              } else {
                //month post
                $args = array(
                  'post_type' => 'post',
                  'author_name' => $professor,
                  'posts_per_page' => -1,
                  'date_query' => array(
                    array(
                      'month' => $query_month
                    )
                  )
                );
              }

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
              if ($query_month && $query_year) {
                $args = array(
                  'post_type' => 'post',
                // published posts
                'post_status' => 'publish',
                'meta_key' => 'capabilities_categor_capabilities_category',
                //check a:1:{i:0;s:3:"555";} match with capabilities id as a string
                'meta_value' => 'a:1:{i:0;s:' . strlen($term_id) . ':"' . $term_id . '";}',
                'posts_per_page' => -1,
                  'date_query' => array(
                    array(
                      'year' => $query_year,
                      'month' => $query_month
                    )
                  )
                );
              } elseif ($query_year) {
                $args = array(
                  'post_type' => 'post',
                // published posts
                'post_status' => 'publish',
                'meta_key' => 'capabilities_categor_capabilities_category',
                //check a:1:{i:0;s:3:"555";} match with capabilities id as a string
                'meta_value' => 'a:1:{i:0;s:' . strlen($term_id) . ':"' . $term_id . '";}',
                'posts_per_page' => -1,
                  'date_query' => array(
                    array(
                      'year' => $query_year
                    )
                  )
                );
              } else {
                $args = array(
                  'post_type' => 'post',
                // published posts
                'post_status' => 'publish',
                'meta_key' => 'capabilities_categor_capabilities_category',
                //check a:1:{i:0;s:3:"555";} match with capabilities id as a string
                'meta_value' => 'a:1:{i:0;s:' . strlen($term_id) . ':"' . $term_id . '";}',
                'posts_per_page' => -1,
                  'date_query' => array(
                    array(
                      'month' => $query_month
                    )
                  )
                );
              }
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
              if ($query_month && $query_year) {
                $args = array(
                  'post_type' => 'post',
                  'posts_per_page' => -1,
                // published posts
                'post_status' => 'publish',
                'meta_query' => array(
                  array(
                    'key' => 'capabilities_categor_practice_areas',
                    'value' => '"' . $post_id . '"',
                    'compare' => 'LIKE'
                  )
                ),
                  'date_query' => array(
                    array(
                      'year' => $query_year,
                      'month' => $query_month
                    )
                  )
                );
              } elseif ($query_year) {
                $args = array(
                  'post_type' => 'post',
                  'posts_per_page' => -1,
                // published posts
                'post_status' => 'publish',
                'meta_query' => array(
                  array(
                    'key' => 'capabilities_categor_practice_areas',
                    'value' => '"' . $post_id . '"',
                    'compare' => 'LIKE'
                  )
                ),
                  'date_query' => array(
                    array(
                      'year' => $query_year
                    )
                  )
                );
              } else {
                $args = array(
                  'post_type' => 'post',
                  'posts_per_page' => -1,
                  // published posts
                  'post_status' => 'publish',
                  'meta_query' => array(
                    array(
                      'key' => 'capabilities_categor_practice_areas',
                      'value' => '"' . $post_id . '"',
                      'compare' => 'LIKE'
                    )
                  ),
                  'date_query' => array(
                    array(
                      'month' => $query_month
                    )
                  )
                );
              }
              $data = new WP_Query($args);
              if($data->posts){
                foreach ($data->posts as $key => $value) {
                  $filter_data_list3[] = $value->ID;
                }
               }
               array_push($filter_data_list_all,$filter_data_list3);
            }
            if (isset($_GET['post-name']) && $_GET['post-name'] != '') {
              $search = $_GET['post-name'];

              if ($query_month && $query_year) {
                $args = array(
                  'post_type' => 'post',
                'post_status' => 'publish',
                //check title or content search
                's' => $search,
                'posts_per_page' => -1,
                  'date_query' => array(
                    array(
                      'year' => $query_year,
                      'month' => $query_month
                    )
                  )
                );
              } elseif ($query_year) {
                $args = array(
                  'post_type' => 'post',
                'post_status' => 'publish',
                //check title or content search
                's' => $search,
                'posts_per_page' => -1,
                  'date_query' => array(
                    array(
                      'year' => $query_year
                    )
                  )
                );
              } else {
                $args = array(
                  'post_type' => 'post',
                'post_status' => 'publish',
                //check title or content search
                's' => $search,
                'posts_per_page' => -1,
                  'date_query' => array(
                    array(
                      'month' => $query_month
                    )
                  )
                );
              }
              $data = new WP_Query($args);
              if($data->posts){
                foreach ($data->posts as $key => $value) {
                  $filter_data_list4[] = $value->ID;
                }
               }
               array_push($filter_data_list_all,$filter_data_list4);
            }
            if ($args) {
              if(count($filter_data_list_all) > 1){
                $new_filter_data_list = array_intersect(...$filter_data_list_all);
              }else{
                $new_filter_data_list = $filter_data_list_all[0];
              }
              
                if (count($new_filter_data_list) > 0) {
                  // print_r($new_filter_data_list);
                  ?>
                  
                  <div class="index__blog__area">
                    <?php
                  $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'post__in' => $new_filter_data_list,
                    'posts_per_page' => $posts_per_page,
                    'paged' => $paged
                  );
                  $all_posts = new WP_Query($args);
                  //post count
                  $post_count = $all_posts->found_posts;
                  // print_r($post_count);
                  while ($all_posts->have_posts()) {
                    $all_posts->the_post();
                    get_template_part("/template-parts/shared/blog-card-template-part");
                  }
                  ?>
                  </div>
                  <?php
                } else {
                  echo '<h2 tabindex="0" class="no-result">No Results Found</h2>';
                }
              
            } else {
              //get is it month or not
              if($query_month && $query_year){
                $args = array(
                  'post_type' => 'post',
                  'post_status' => 'publish',
                  'posts_per_page' => $posts_per_page,
                  "paged" => $paged,
                  'date_query' => array(
                    array(
                      'year' => $query_year,
                      'month' => $query_month
                    )
                  )
                );
              }
              else{
                $args = array(
                  'post_type' => 'post',
                  'post_status' => 'publish',
                  'posts_per_page' => $posts_per_page,
                  "paged" => $paged,
                  'date_query' => array(
                    array(
                      'year' => $query_year
                    )
                  )
                );
              }
              $all_posts = new WP_Query($args);
              //print_r length
              if($all_posts->posts){
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
            }
            else{
              echo '<h2 tabindex="0" class="no-result">No Results Found</h2>';
            }
            }
            ?>
          
          <?php
          $total_pages = $all_posts->max_num_pages;
          // print_r($total_pages);

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
            // get the years with post count and months with posts number
            $years = $wpdb->get_results("SELECT YEAR(post_date) AS year, MONTH(post_date) AS month, count(ID) as posts FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' GROUP BY year, month ORDER BY post_date DESC");


            $years_months = array();
            foreach ($years as $year) {

              $years_months[$year->year]['posts'] += $year->posts;
              $years_months[$year->year]['months'][$year->month] = $year->posts;
            }
            ?>
            <div class="index__filter-link-sec">
              <a href="<?php echo esc_url(site_url('/news-insights/')); ?>" class="index__filter-link">View all</a>
              <?php foreach ($categories as $category) { ?>
                <a href="<?php echo get_category_link($category->term_id).'#news'  ?>" class="index__filter-link"><?php echo $category->name ?></a>
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
                    <div class="index__filter-link index__year <?php
                                                                // check it is year archive or not
                                                                if (is_year()) {
                                                                  if (get_query_var('year') == $year) {
                                                                    echo 'index__filter-link-active';
                                                                  }
                                                                  // if it is month archive check if it is same year and month
                                                                } elseif (is_month()) {
                                                                  //in $months array we have months with posts number
                                                                  if (get_query_var('year') == $year && array_key_exists(get_query_var('monthnum'), $months['months'])) {
                                                                    echo 'index__filter-link-active';
                                                                  }
                                                                }
                                                                ?>">
                      <a class="index__year__link" href="<?php echo get_year_link($year).'#news'  ?>">
                        <?php echo $year; ?>
                      </a>
                      <div class="index__filter__rgt">
                      <span  class="index__post__num">
                          <?php echo $months['posts']; ?>
                        </span>
                        <span onclick="dataDropDown(this)" btn-year-data="<?php echo $year; ?>" class="index__filter__icon
                        <?php
                        // check it is year archive or not
                        if (is_year()) {
                          if (get_query_var('year') == $year) {
                            echo 'index__icon__rotate';
                          }
                          // if it is month archive check if it is same year and month
                        } elseif (is_month()) {
                          //in $months array we have months with posts number
                          if (get_query_var('year') == $year && array_key_exists(get_query_var('monthnum'), $months['months'])) {
                            echo 'index__icon__rotate';
                          }
                        }
                        ?>
                        ">
                          <?php
                          set_query_var("new", "index__icon--color");
                          get_template_part("/assets/images/svg/dropdown-icon");
                          ?>
                        </span>
                      </div>
                    </div>
                    <ul year-data="<?php echo $year; ?>" class="index__child <?php
                          // check it is month archive or not
                          if (get_query_var('year') == $year) {
                            echo 'index__show__child';
                          }
                          ?>">
                      <?php
                      foreach ($months['months'] as $key => $vale) {
                      ?>
                        <li>
                          <a href="<?php echo
                                    get_month_link($year, $key).'#news'; ?>" class="index__filter-link index__month
                          <?php
                          // check it is month archive or not
                          if (is_month()) {
                            if (get_query_var('monthnum') == $key && get_query_var('year') == $year) {
                              echo 'index__filter-link-active';
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
              'orderby' => 'count',
              'order' => 'DESC'
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