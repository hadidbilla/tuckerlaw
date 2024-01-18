<?php
function gs_sidebar_init()
{

  register_sidebar(
    array(
      "name" => __("Footer Left", "gs"),
      "id" => "footer_left",
      "description" => __("Footer Left", "gs"),
      "before_widget" => '<div id="%1$s" class="widget %2$s">',
      "after_widget" => "</div>",
      "before_title" => "<h3 class='widget-title'>",
      "after_title" => "</h3>"
    )
  );

  register_sidebar(
    array(
      "name" => __("Footer Right", "gs"),
      "id" => "footer_right",
      "description" => __("Footer Right", "gs"),
      "before_widget" => '<div id="%1$s" class="text-right widget %2$s">',
      "after_widget" => "</div>",
      "before_title" => "<h3 class='widget-title'>",
      "after_title" => "</h3>"
    )
  );
}

add_action("widgets_init", "gs_sidebar_init");