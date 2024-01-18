<?php 

function gs_firm_customize_register($wp_customize){
  $wp_customize -> add_section("gs_firm_section", array(
    "title" => __("About Firm", "gs"),
    "description" => __("You can change your About Firm content", "gs"),
    "priority" => 1,
    "panel" => "gs_firm_panel"
  ));

 //about firm image
 $wp_customize -> add_setting("gs_firm_section_image", array(
  "default" => get_template_directory_uri() . "/assets/images/about.png"
)); 

$wp_customize -> add_control(new WP_Customize_Image_Control($wp_customize, "gs_firm_section_image", array(
  "label" => __("About Firm Section Image", "gs"),
  "section" => "gs_firm_section",
  "settings" => "gs_firm_section_image"
)));

//btn text
$wp_customize -> add_setting("gs_firm_btn_text", array(
  "default" => __("Reach Out to Us for Legal Consultation", "gs")
));

$wp_customize -> add_control("gs_firm_btn_text", array(
  "label" => __("Reach Out to Us for Legal Consultation Text", "gs"),
  "section" => "gs_firm_section",
  "settings" => "gs_firm_btn_text"
));

//btn page link
$wp_customize -> add_setting("gs_firm_btn_page_link", array(
  "default" => "/"
));

$wp_customize -> add_control("gs_firm_btn_page_link", array(
  "label" => __("Reach Out to Us for Legal Consultation Page Link", "gs"),
  "section" => "gs_firm_section",
  "settings" => "gs_firm_btn_page_link",
  "type" => "dropdown-pages"
));


//get in touch image 
$wp_customize -> add_setting("gs_firm_get_in_touch_image", array(
  "default" => get_template_directory_uri() . "/assets/images/contact.png"
));

$wp_customize -> add_control(new WP_Customize_Image_Control($wp_customize, "gs_firm_get_in_touch_image", array(
  "label" => __("Get In Touch Image", "gs"),
  "section" => "gs_firm_section",
  "settings" => "gs_firm_get_in_touch_image"
)));

//get number of Attorneys
$wp_customize -> add_setting("gs_firm_attorneys_number", array(
  "default" => 80
));

$wp_customize -> add_control("gs_firm_attorneys_number", array(
  "label" => __("Number of Attorneys", "gs"),
  "section" => "gs_firm_section",
  "settings" => "gs_firm_attorneys_number",
  "type" => "number"
));

//get number of Offices
$wp_customize -> add_setting("gs_firm_offices_number", array(
  "default" => 4
));

$wp_customize -> add_control("gs_firm_offices_number", array(
  "label" => __("Number of Offices", "gs"),
  "section" => "gs_firm_section",
  "settings" => "gs_firm_offices_number",
  "type" => "number"
));

//get number of services
$wp_customize -> add_setting("gs_firm_services_number", array(
  "default" => 100
));

$wp_customize -> add_control("gs_firm_services_number", array(
  "label" => __("Number of Services", "gs"),
  "section" => "gs_firm_section",
  "settings" => "gs_firm_services_number",
  "type" => "number"
));


}