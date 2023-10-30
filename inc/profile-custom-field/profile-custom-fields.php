<?php


// add_action('show_user_profile', 'gs_extra_user_profile_fields');
// add_action('edit_user_profile', 'gs_extra_user_profile_fields');



//remove user profile user-description-wrap 

function remove_user_description_wrap() {
  //import jquery
  global $current_user;
  if ($current_user->roles[0] == 'professor' || $current_user->roles[0] == 'administrator') {
    //<h2 tabindex="0">Contact Info</h2>
    
        echo <<<EOF

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    jQuery(document).ready(function(){
        jQuery('.user-description-wrap').remove();
        jQuery('.application-passwords').remove();
        jQuery('.user-rich-editing-wrap').remove();
        jQuery('.user-admin-color-wrap').remove();
        jQuery('.user-comment-shortcuts-wrap').remove();
        jQuery('.user-syntax-highlighting-wrap').remove();
        
        jQuery('h2:contains("Contact Info")').remove();
        jQuery('h2:contains("About Yourself")').remove();
        jQuery('h2:contains("Personal Options")').remove();
    });
</script>
EOF;
    }
}
add_action('admin_print_styles', 'remove_user_description_wrap', 200);
