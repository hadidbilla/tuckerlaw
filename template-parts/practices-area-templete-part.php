<?php
get_header();
get_template_part('template-parts/shared/sidebar-nav-template');
$postData = [];
?>

<?php
get_template_part('template-parts/shared/banner-template');

// get the current route
$current_route = get_query_var('filter');
//split the route by dash
$current_route = explode('-', $current_route);
?>

<div class="index section--gap">

  <div class="container">
    <div class="index__wrap">
      <div class="index__header">
        <div class="index__name__input">
          <input id="name" name="name" type="text" class="input index__input" placeholder="What are you looking for?">
        </div>
        <?php
        // get all capabilities categories
        $args = array(
          'taxonomy' => 'capabilities_category',
          'hide_empty' => false,
        );
        $capabilities_categories = get_terms($args);
        // select options for capabilities categories
        ?>
        <form action="">
          <div class="select-wrap">
            <select class="select index__select" onchange="document.location.href=this.options[this.selectedIndex].value;" name="title" id="title">
              <option class="index__select-placeholder" value="" disabled selected=""> Capabilities </option>
              <?php
              foreach ($capabilities_categories as $key => $value) {
              ?>
                <option <?php
                        if ($current_route[0] == 'capabilities' && $current_route[1] == $value->term_id) {
                          echo 'selected';
                        }
                        ?> class="index__option-fld" value="<?php echo site_url() . '/filter/capabilities-' . $value->term_id; ?>"><?php echo $value->name; ?></option>
              <?php
              }
              ?>
            </select>
          </div>
        </form>
        <?php
        // get all capabilities posts
        $args = array(
          'post_type' => 'capabilities',
          'posts_per_page' => -1
        );
        $capabilities_posts = new WP_Query($args);
        ?>
        <form action="">
          <div class="select-wrap">
            <select onchange="document.location.href=this.options[this.selectedIndex].value;" class="select index__select" name="capabilities" id="capabilities">
              <option class="index__select-placeholder" value="" disabled="" selected="">Filed Under</option>
              <?php
              foreach ($capabilities_posts->posts as $key => $value) {
              ?>
                <option <?php if ($current_route[0] == "paritiesarea" && $current_route[1] == $value->ID) echo 'selected';
                        ?> class="index__option-fld" value="<?php echo site_url() . '/filter/paritiesarea-' . $value->ID; ?>"><?php echo $value->post_title; ?></option>
              <?php
              }
              ?>
            </select>
          </div>
        </form>
        <?php
        // get professors users roll
        $args = array(
          'role' => 'professor'
        );
        $professors = get_users($args);
        ?>
        <form action="">
          <div class="select-wrap">
            <select onchange="document.location.href=this.options[this.selectedIndex].value;" class="select index__select" name="professors" id="professors">
              <option class="index__select-placeholder" value="" disabled="" selected="">
                Attorneys
              </option>
              <?php
              foreach ($professors as $key => $value) {
                // print_r($value);
              ?>
                <option <?php if ($current_route[0] == "professor" && $current_route[1] == $value->ID) echo 'selected'; ?> class="index__option-fld" value="<?php
                                                          // site url / category=professor / professor id
                                                          echo site_url() . '/filter/professor-' . $value->ID;
                                                          ?>">
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
        </form>
      </div>
      <div class="index__wrp">
        <div class="index__news-content">
          <div class="index__blog__area" <?php post_class() ?>>
            <?php
            // javascript to get professors selected value on change
            if ($current_route[0] == 'professor') {
              // get post by author id
              $args = array(
                'post_type' => 'post',
                // published posts

                'post_status' => 'publish',
                'author' => $current_route[1],
                'posts_per_page' => -1
              );
              $posts = new WP_Query($args);
              // print_r($posts);
              if ($posts->have_posts()) {
                while ($posts->have_posts()) {
                  $posts->the_post();
                  get_template_part("/template-parts/shared/blog-card-template-part");
                }
            ?>
              <?php
              }
            }
            if ($current_route[0] == 'capabilities') {
              // get post by meta key capabilities-category and meta value capabilities id
              $args = array(
                'post_type' => 'post',
                // published posts
                'post_status' => 'publish',
                'meta_key' => 'capabilities_categor_capabilities_category',
                //check a:1:{i:0;s:3:"555";}
                'meta_value' => 'a:1:{i:0;s:' . strlen($current_route[1]) . ':"' . $current_route[1] . '";}',
                'posts_per_page' => -1
              );
              $posts = new WP_Query($args);
              if ($posts->have_posts()) {
                while ($posts->have_posts()) {
                  $posts->the_post();
                  get_template_part("/template-parts/shared/blog-card-template-part");
                }
              ?>
              <?php
              }
            }
            if ($current_route[0] == 'paritiesarea') {
              // get post by meta key capabilities-category and meta value capabilities id
              $args = array(
                'post_type' => 'post',
                // published posts
                'post_status' => 'publish',
                'meta_key' => 'capabilities_categor_practice_areas',
                //check a:1:{i:0;s:3:"555";}
                'meta_value' => 'a:1:{i:0;s:' . strlen($current_route[1]) . ':"' . $current_route[1] . '";}',
                'posts_per_page' => -1
              );
              $posts = new WP_Query($args);
              if ($posts->have_posts()) {
                while ($posts->have_posts()) {
                  $posts->the_post();
                  get_template_part("/template-parts/shared/blog-card-template-part");
                }
              ?>
            <?php
              }
            }

            ?>
          </div>
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
              <a href="<?php echo esc_url(site_url('/news-insights/')); ?>" class="index__filter-link index__filter-link-active">View all</a>
              <?php foreach ($categories as $category) { ?>
                <a href="<?php echo get_category_link($category->term_id) ?>" class="index__filter-link"><?php echo $category->name ?></a>
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
                    <div href="<?php echo esc_url(site_url('/news-insights/')); ?>" class="index__filter-link index__filter-link-active index__year">
                      <?php echo $year; ?>
                      <div class="index__filter__rgt">
                        <span class="index__post__num">
                          <?php echo $months['posts']; ?>
                        </span>
                        <span class="index__filter__icon">
                          <?php
                          set_query_var("new", "index__icon--color");
                          get_template_part("/assets/images/svg/dropdown-icon");
                          ?>

                        </span>
                      </div>
                    </div>
                    <ul>
                      <?php
                      foreach ($months['months'] as $key => $vale) {
                      ?>
                        <li>
                          <a href="<?php echo esc_url(site_url('/news-insights/')); ?>" class="index__filter-link index__filter-link-active index__month"><?php echo $wp_locale->get_month($key); ?>
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
                'hide_empty' => false
              ));
              if ($tags) {
                foreach ($tags as $tag) {
              ?>
                  <a href="<?php echo get_tag_link($tag->term_id)  ?>" class="<?php echo 'index__filter-link-tag' ?>"><?php echo $tag->name ?></a>
              <?php
                }
              }
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