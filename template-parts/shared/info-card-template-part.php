<?php
$team_data = $args['team'];
$team_id = $args['id'];
// print_r($team_id);
// get_author_posts_url($user->ID)
?>

<div class="info__card">
  <div class="info__card-img-con">
    <?php
    $image = $team_data['featured_image'][0];
    if ($image) {
      // get the image url by id
      $image_url = wp_get_attachment_image_src($image, 'large');
      // print the image
      echo '<img alt="Info Image" loading="lazy" src="' . $image_url[0] . '" alt="image" class="info__card-img">';
    } else {
      echo '<img alt="Info Image" loading="lazy" src="' . get_template_directory_uri() . '/assets/images/attorney_avatar.jpg" alt="image" class="info__card-img">';
    }

    ?>
  </div>
  <div class="info__card-content">
    <h3 tabindex="0" class="title--card-small">
      <?php echo $team_data['first_name'][0] . ' ' . $team_data['last_name'][0];
        if (isset($team_data['surname']) && isset($team_data['surname'])) {
          echo ' ' . $team_data['surname'][0];
        }
      ?>
    </h3>
  </div>
  <div class="info__card-hover-con">
    <a href="<?php
              echo get_author_posts_url($team_id);
              ?>" class="info__card-link"><?php get_template_part("/assets/images/svg/angle-icon") ?></a>
    <a href="<?php
              echo get_author_posts_url($team_id);
              ?>" class="title--card-small">
      <?php
      echo $team_data['first_name'][0] . ' ' . $team_data['last_name'][0];
      if (isset($team_data['surname']) && isset($team_data['surname'])) {
        echo ' ' . $team_data['surname'][0];
      }
      ?>
    </a>
    <span class="info__card-icon-text text text--smallest">
      <?php
      $position_id = $team_data['position'][0];
      $position_name = get_term_by('id', $position_id, 'position');
      echo $position_name->name;
      ?>
    </span>
    <div class="info__card-icon-con">
      <?php get_template_part("/assets/images/svg/email-icon") ?>
      <a href="
            <?php
            //get user id
            $user_id = $team_id;
            echo 'mailto:' . get_the_author_meta('user_email', $user_id);
            ?>
            " class="info__card-icon-text text text--smallest">
        <?php
        echo "Email Address";

        ?>
      </a>
    </div>
    <div class="info__card-icon-con">
      <?php
      set_query_var("color", "info__card-icon");
      get_template_part("/assets/images/svg/phone-icon") ?>
      <a href="
            <?php
            if ($team_data['contact_information_phone'][0]) {
              echo 'tel:' . $team_data['contact_information_phone'][0];
            }
            ?>
            " class="info__card-icon-text text text--smallest">
        <?php
        if ($team_data['contact_information_phone'][0]) {
          echo $team_data['contact_information_phone'][0];
        }
        ?>
      </a>
    </div>
  </div>
</div>