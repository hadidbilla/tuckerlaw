<?php
$current_slug = get_post_field('post_name', get_post());

$contact_forms = array(
    'cleveland' => array('id' => '25595', 'title' => 'Contact form Tucker Arensberg, P.C. cleveland'),
    'san-francisco-bay-area' => array('id' => '406', 'title' => 'Contact form Tucker Arensberg, P.C. Foster City'),
    'harrisburg' => array('id' => '25597', 'title' => 'Contact form Tucker Arensberg, P.C. harrisburg'),
    'new-york' => array('id' => '25598', 'title' => 'Contact form Tucker Arensberg, P.C. NEW YORK'),
    'pittsburgh' => array('id' => '25596', 'title' => 'Contact form Tucker Arensberg, P.C. pittsburgh')
);

$default_form = array('id' => '406', 'title' => 'Contact form Tucker Arensberg, P.C.');

$selected_form = isset($contact_forms[$current_slug]) ? $contact_forms[$current_slug] : $default_form;

echo '<div class="contact-con__contact-form">';
echo apply_shortcodes('[contact-form-7 id="' . $selected_form['id'] . '" title="' . $selected_form['title'] . '"]');
echo '</div>';
?>