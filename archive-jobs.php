<?php
/* Template Name: Our Career Page */
?>

<?php
get_header();
get_template_part('template-parts/shared/sidebar-nav-template');
get_template_part('template-parts/shared/banner-template');
?>

<?php
get_template_part('template-parts/shared/section-bar-template-part');
?>

<div class="career">
  <div class="container">
      <form class="index__header" action="">
        <div class="index__name__input">
          <input id="name" name="name" type="text" class="input index__input" placeholder="Search">
          <div class="index__search-submit">
            <input type="submit" class="index__search-btn" />
            <?php get_template_part("/assets/images/svg/search-small-icon") ?>
          </div>

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
        <div class="select-wrap">
          <select onchange="document.location.href=this.options[this.selectedIndex].value;" class="select index__select" name="title" id="title">
            <option class="index__select-placeholder" value="" disabled selected> Job Categories </option>
            <?php
            foreach ($capabilities_categories as $key => $value) {
            ?>
              <option class="index__option-fld" value=<?php echo site_url() . '/filter/capabilities-' . $value->term_id; ?>"><?php echo $value->name; ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <?php
        // get all capabilities posts
        $args = array(
          'post_type' => 'capabilities',
          'posts_per_page' => -1
        );
        $capabilities_posts = new WP_Query($args);
        ?>
        <div class="select-wrap">
          <select onchange="document.location.href=this.options[this.selectedIndex].value;" class="select index__select" name="capabilities" id="capabilities">
            <option class="index__select-placeholder" value="" disabled="" selected="">Job Types</option>
            <?php
            foreach ($capabilities_posts->posts as $key => $value) {
            ?>
              <option class="index__option-fld" value="<?php echo site_url() . '/filter/paritiesarea-' . $value->ID; ?>"><?php echo $value->post_title; ?></option>
            <?php
            }
            ?>
          </select>
        </div>

        <?php
        // get professors users roll
        $args = array(
          'role' => 'professor'
        );
        $professors = get_users($args);
        ?>
        <div class="select-wrap">
          <select onchange="document.location.href=this.options[this.selectedIndex].value;" class="select index__select" name="professors" id="professors">
            <option class="index__select-placeholder" value="" disabled="" selected="">
              Job Locations
            </option>
            <?php
            foreach ($professors as $key => $value) {
              // print_r($value);
            ?>
              <option class="index__option-fld" value="<?php
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
    <div class="career__card-contain">
      <a href="/" class="career__card">
        <h4 tabindex="0" class="career__card-title title--card-small">
          Finance Transactional Attorney
        </h4>
        <div class="career__location">
          <?php
          set_query_var("color", "career__icon");
          get_template_part("/assets/images/svg/map-pin-icon-round-blue") ?>
          <span class="career__place">Harrisburg</span>
        </div>
        <div class="career__details">
          More Details
          <?php
          set_query_var("color", "career__icon-next");
          get_template_part("/assets/images/svg/next-icon") ?>

        </div>
      </a>
      <a href="/" class="career__card">
        <h4 tabindex="0" class="career__card-title title--card-small">
          Bankruptcy Attorney
        </h4>
        <div class="career__location">
          <?php
          set_query_var("color", "career__icon");
          get_template_part("/assets/images/svg/map-pin-icon-round-blue") ?>
          <span class="career__place">New York</span>
        </div>
        <div class="career__details">
          More Details
          <?php
          set_query_var("color", "career__icon-next");
          get_template_part("/assets/images/svg/next-icon") ?>

        </div>
      </a>
      <a href="/" class="career__card">
        <h4 tabindex="0" class="career__card-title title--card-small">
          Finance Transactional Attorney
        </h4>
        <div class="career__location">
          <?php
          set_query_var("color", "career__icon");
          get_template_part("/assets/images/svg/map-pin-icon-round-blue") ?>
          <span class="career__place">Harrisburg</span>
        </div>
        <div class="career__details">
          More Details
          <?php
          set_query_var("color", "career__icon-next");
          get_template_part("/assets/images/svg/next-icon") ?>

        </div>
      </a>
      <a href="/" class="career__card">
        <h4 tabindex="0" class="career__card-title title--card-small">
          Finance Transactional Attorney
        </h4>
        <div class="career__location">
          <?php
          set_query_var("color", "career__icon");
          get_template_part("/assets/images/svg/map-pin-icon-round-blue") ?>
          <span class="career__place">Harrisburg</span>
        </div>
        <div class="career__details">
          More Details
          <?php
          set_query_var("color", "career__icon-next");
          get_template_part("/assets/images/svg/next-icon") ?>

        </div>
      </a>
      <a href="/" class="career__card">
        <h4 tabindex="0" class="career__card-title title--card-small">
          Finance Transactional Attorney
        </h4>
        <div class="career__location">
          <?php
          set_query_var("color", "career__icon");
          get_template_part("/assets/images/svg/map-pin-icon-round-blue") ?>
          <span class="career__place">Harrisburg</span>
        </div>
        <div class="career__details">
          More Details
          <?php
          set_query_var("color", "career__icon-next");
          get_template_part("/assets/images/svg/next-icon") ?>

        </div>
      </a>
      <a href="/" class="career__card">
        <h4 tabindex="0" class="career__card-title title--card-small">
          Finance Transactional Attorney
        </h4>
        <div class="career__location">
          <?php
          set_query_var("color", "career__icon");
          get_template_part("/assets/images/svg/map-pin-icon-round-blue") ?>
          <span class="career__place">Harrisburg</span>
        </div>
        <div class="career__details">
          More Details
          <?php
          set_query_var("color", "career__icon-next");
          get_template_part("/assets/images/svg/next-icon") ?>

        </div>
      </a>
    </div>

  </div>

</div>

<?php
get_footer();
?>