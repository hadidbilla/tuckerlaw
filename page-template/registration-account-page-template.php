<?php
/* Template Name: Sign Up Page */
?>


<?php
get_header();
get_template_part('template-parts/shared/sidebar-nav-template');

$wpdb;

if (isset($_POST["submit"])) {
  $username = esc_sql($_POST['username']);
  $email = esc_sql($_POST['email']);
  $password = esc_sql($_POST['password']);
  $confirmPassword = esc_sql($_POST['confirm-password']);
  $error = array();


  if (strpos($username, ' ') !== FALSE) {
    $error['username_space'] = "Username has Space";
  }

  if (empty($username)) {
    $error['username_empty'] = "Needed Username must";
  }

  if (username_exists($username)) {
    $error['username_exists'] = "Username already exists";
  }

  if (!is_email($email)) {
    $error['email_valid'] = "Email has no valid value";
  }

  if (email_exists($email)) {
    $error['email_existence'] = "Email already exists";
  }

  if (strcmp($password, $confirmPassword) !== 0) {
    $error['password'] = "Password didn't match";
  }

  if (count($error) == 0) {

    wp_create_user($username, $password, $email);
    wp_redirect(home_url('/login'));
    echo "User Created Successfully";
    exit();
  } else {

    print_r($error);
  }
}

?>
<div class="register">
  <div class="register__wrp">
    <div class="container">
      <h1 tabindex="0">Register your Account</h1>
      <form method="POST" class="register__form">
        <div class="register__input__area">
          <input type="text" placeholder="Enter your username" id="username" name="username" class="register__input">
        </div>
        <div class="register__input__area">
          <input type="email" id="email" placeholder="Enter your email" name="email" class="register__input">
        </div>
        <div class="register__input__area">
          <input type="password" id="password" placeholder="Enter your password" name="password" class="register__input">
        </div>
        <div class="register__input__area">
          <input type="password" id="confirm-password" placeholder="Confirm your password" name="confirm-password" class="register__input">
        </div>
        <div class="register__input__area">
          <input type="submit" name="submit" value="Submit" class="register__input">
        </div>
      </form>
    </div>
  </div>
</div>
<?php

get_footer();
?>