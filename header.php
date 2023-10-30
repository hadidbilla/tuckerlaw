<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
	<?php
	//get the current url
	$current_url = get_site_url() . $_SERVER['REQUEST_URI'];
	//get the current page id
	// /people/erin-beckner-conlin/
	//split the url by /
	$url_parts = explode('/', $current_url);
	$before_last_part = $url_parts[count($url_parts) - 3];
	$last_part = $url_parts[count($url_parts) - 2];
	if($before_last_part == 'people' && $last_part != ''){
		$user = get_user_by('slug', $last_part);
		$user_id = $user->ID;
		$user_meta = get_user_meta($user_id);
		?>

        <title><?php echo $user_meta['first_name'][0] . ' ' . $user_meta['last_name'][0];
			if (isset($user_meta['surname']) && isset($user_meta['surname'])) {
				echo ' ' . $user_meta['surname'][0]. ' | ' . get_bloginfo('name');
			} ?></title>
		<?php
	}


	?>
    <meta charset="<?php bloginfo("charset"); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index">
    <meta name="google-site-verification" content="JxfgshUya_iLJjkzOdv3XfnLzKCG_ueu4R4PJIWkpAg" />
	<?php wp_head() ?>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Attorney",
            "name": "Tucker Arensberg P.C.",
            "image": "https://www.tuckerlaw.com/wp-content/themes/tucker-law/assets/images/brand-logo.png",
            "@id": "",
            "url": "https://www.tuckerlaw.com/",
            "telephone": "(412) 566-1212",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "One PPG Place Suite 1500",
                "addressLocality": "Pittsburgh",
                "addressRegion": "PA",
                "postalCode": "15222",
                "addressCountry": "US"
            },
            "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "4.3",
                "ratingCount": "23"
            }
        }
    </script>

</head>

<body class="<?php body_class(); ?>">
<header class="nav">
    <div class="nav__wrp">
        <div class="nav__lft">
            <div class="nav__logo__area">
                <a href="<?php echo get_site_url() ?>" data-acsb-clickable="true" data-acsb-navigable="true"
data-acsb-now-navigable="true"><span class="acsb-sr-only" data-acsb-sr-only="true" data-
acsb-force-visible="true" aria-hidden="false" data-acsb-hidden="false">
                    <img alt="Logo" loading="lazy" loading="lazy" src="<?php echo
					get_theme_mod('gs_brnd_logo', get_template_directory_uri() . '/assets/images/brand-logo.png') ?>" alt="" class="nav__logo">
                </a>
            </div>
        </div>
        <div class="nav__rgt">
            <div class="nav__rgt__top">
                <div class="nav__top__lft" data-acsb-fake-menu="true" data-acsb-menu="ul" role="navigation"
                     data-acsb-main-menu="true" aria-label="Main Menu">
                    <div class="nav__top__cont">
                        <div class="nav__top__icon">
							<?php
							set_query_var("color", "nav__svg__color");
							get_template_part("/assets/images/svg/phone-icon");
							?>
                        </div>
                        <a href="tel:<?php echo get_theme_mod('gs_phone', '1234567890') ?>" class="nav__top__link" data-acsb-clickable="true" data-acsb-
navigable="true" data-acsb-now-navigable="true" data-acsb-menu="a" data-acsb-menu-root-
link="true" data-acsb-tooltip="Use ←/→ to navigate"><span class="acsb-sr-only" data-acsb-sr-
only="true" data-acsb-force-visible="true" aria-hidden="false" data-acsb-hidden="false" >PIT +<?php echo get_theme_mod("gs_phone", '1234567890'); ?></a>
                    </div>
                    <div class="nav__top__cont">
                        <div class="nav__top__icon">
							<?php
							set_query_var("color", "nav__svg__color");
							get_template_part("/assets/images/svg/phone-icon");
							?>
                        </div>
                        <a href="tel:<?php echo get_theme_mod('gs_secondary_phone', '1234567890') ?>" class="nav__top__link">HAR +<?php echo get_theme_mod("gs_secondary_phone", '1234567890'); ?></a>
                    </div>
                    <div class="nav__top__cont">
                        <div class="nav__top__icon">
							<?php
							set_query_var("color", "nav__svg__color");
							get_template_part("/assets/images/svg/email-icon");
							?>
                        </div>
                        <a href="mailto:<?php echo get_theme_mod("gs_email", 'info@tuckerla.com') ?>" class="nav__top__link"><?php echo get_theme_mod("gs_email", 'info@tuckerla.com') ?></a>
                    </div>
                </div>
            </div>
            <div class="nav__lft__btm">
                <a href="<?php echo get_site_url() ?>" class="nav__res__btm" data-acsb-clickable="true" data-
acsb-navigable="true" tabindex="
-1" data-acsb-now-navigable="false" aria-hidden="true"
data-acsb-hidden="true">
                    <img loading="lazy" loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/barnd-logo-black.png" alt="" class="nav__res__img">
                </a>
                <div   class="nav__menus">
                    <div class="nav__menu__list">
						<?php
						$staticText = true;
						$dropdowIcon = get_template_directory_uri() . "/assets/images/svg/dropdown-icon.php";
						$manuName = "primary";
						$locations = get_nav_menu_locations();
						$menuID = $locations[$manuName];
						$menuItems = wp_get_nav_menu_items($menuID);
						// create array for menu items parent to child to grandchild relationship
						$menuItemsParent = [];
						$menuItemsChild = [];
						$menuItemsGrandChild = [];
						$menuItemsGrandGrandChild = [];
						//get capabilities custom post by category
						$args = array(
							'post_type' => 'capabilities',
							'posts_per_page' => -1,
							'orderby' => 'title',
							'order' => 'ASC',
							'tax_query' => array(
								array(
									'taxonomy' => 'capabilities_category',
									'field' => 'slug',
									'terms' => 'departments'
								)
							)
						);
						$capabilities = new WP_Query($args);
						//reset query
						wp_reset_query();


						// parent menu items
						foreach ($menuItems as $item) {
							if (!$item->menu_item_parent) {
								$menuItemsParent[] = $item;
							}
						}
						// only snd layer child menu items
						foreach ($menuItems as $item) {
							foreach ($menuItemsParent as $parent) {
								if ($item->menu_item_parent == $parent->ID) {
									$menuItemsChild[] = $item;
								}
							}
						}
						// grandchild menu items
						foreach ($menuItems as $item) {
							foreach ($menuItemsChild as $child) {
								if ($item->menu_item_parent == $child->ID) {
									$menuItemsGrandChild[] = $item;
								}
							}
						}
						// grandgrandchild menu items
						foreach ($menuItems as $item) {
							foreach ($menuItemsGrandChild as $grandChild) {
								if ($item->menu_item_parent == $grandChild->ID) {
									$menuItemsGrandGrandChild[] = $item;
								}
							}
						}
						// create menu
						foreach ($menuItemsParent as $item) {
						$hasChild = false;
						$hasGrandChild = false;
						$hasGrandGrandChild = false;
						foreach ($menuItemsChild as $child) {
							if ($child->menu_item_parent == $item->ID) {
								$hasChild = true;
							}
							if ($hasChild) {
								foreach ($menuItemsGrandChild as $grandChild) {
									if ($grandChild->menu_item_parent == $child->ID) {
										$hasGrandChild = true;
									}
								}
							}
							if ($hasGrandChild) {
								foreach ($menuItemsGrandGrandChild as $grandGrandChild) {

									if ($grandGrandChild->menu_item_parent == $grandChild->ID && $child->title == "Departments") {
										$hasGrandGrandChild = true;
									}
								}
							}
						}
						if ($hasChild) {
						?>
                        <div  class='nav__menu__item <?php echo $hasGrandChild ? 'nav__menu__item--grdChild' : 'nav__menu__item--has-child' ?>'>
                            <a href='<?php echo $item->url ?>' class='nav__menu__link ' data-acsb-clickable="true" data-acsb-navigable="true"
data-acsb-now-navigable="true" role="button">
								<?php echo $item->title ?> <div class="nav__menu__icon">
									<?php
									get_template_part("/assets/images/svg/dropdown-icon");
									?>
                                </div>
                            </a>
							<?php
							echo "<div class='nav__menu__child__wrp' aria-hidden='true' data-acsb-hidden='true'>";
							foreach ($menuItemsChild as $child) {
							if ($child->menu_item_parent == $item->ID) {
							if ($hasGrandChild) {
							// call p at once
							if ($staticText) {
								$staticText = false;
								echo "<p class='nav__menu__static'>Capabilities</p>";
							}
							if($hasGrandGrandChild && $child->title == "Departments"){
							echo "<div class='nav__menu__child__item nav__menu__child__item--has-child nav__menu__grand__grand__child--has'>";
							echo "<p  class='nav__menu__child__link nav__menu__link'>$child->title</p>";
							//$menuItemsGrandChild
							foreach ($menuItemsGrandChild as $grandChild) {
							if ($grandChild->menu_item_parent == $child->ID) {
							?>
                            <div  class='nav__menu__grand__grand__child'>
								<?php echo $grandChild->title ?>
								<?php
								echo "<div class='nav__menu__grand-top'>";
								echo "<div class='nav__menu__grand__child__wrp-mid'>";
								foreach ($menuItemsGrandGrandChild as $grandGrandChild) {
									if ($grandGrandChild->menu_item_parent == $grandChild->ID) {
										?>
                                        <a tabindex='-1' href='<?php echo $grandGrandChild->url ?>' class='nav__menu__grand__grand__child__link nav__menu__link '>
											<?php echo $grandGrandChild->title ?>
                                        </a>
										<?php
									}
								}
								echo "</div>";
								echo "</div>";
								echo "</div>";
								}
								}
								echo "<div class='nav__menu__grand'>";
								echo "<div class='nav__menu__grand__child__wrp'>";
								foreach ($capabilities->posts as $capability) {
									?>
                                    <a tabindex='-1' href='<?php echo get_permalink($capability->ID) ?>' class='nav__menu__grand__child__link nav__menu__link '>
										<?php echo $capability->post_title ?>
                                    </a>
									<?php
								}
								echo "</div>";
								echo "</div>";
								echo "</div>";
								}else{
									echo "<div class='nav__menu__child__item nav__menu__child__item--has-child'>";
									echo "<p  class='nav__menu__child__link nav__menu__link'>$child->title</p>";
									echo "<div class='nav__menu__grand'>";
									echo "<div class='nav__menu__grand__child__wrp'>";
									foreach ($menuItemsGrandChild as $grandChild) {
										if ($grandChild->menu_item_parent == $child->ID) {
											?>
                                            <a tabindex='-1' href='<?php echo $grandChild->url ?>' class='nav__menu__grand__child__link nav__menu__link '>
												<?php echo $grandChild->title ?>
                                            </a>
											<?php
										}
									}
									echo "</div>";
									echo "</div>";
									echo "</div>";
								}
								} else {
									echo "<div class='nav__menu__child__item'>";
									?>
                                    <a tabindex='-1' href='<?php echo $child->url ?>' class='nav__menu__child__link nav__menu__link '>
										<?php echo $child->title ?>
                                    </a>
									<?php
									echo "</div>";
								}
								}
								}
								echo "</div>";
								echo "</div>";
								} else {
									echo "<div class='nav__menu__item'>";
									?>
                                    <a href="<?php echo $item->url ?>" class='nav__menu__link'>
										<?php echo $item->title ?>
                                    </a>
									<?php
									echo "</div>";
								}
								}
								?>
                            </div>
                        </div>
                        <div class="nav__contact__btn__area">
                            <a href="<?php if (is_numeric(get_theme_mod("gs_contact_btn_link", "#"))) {
								echo get_page_link(get_theme_mod("gs_contact_btn_link", "#"));
							} else {
								echo get_theme_mod("gs_contact_btn_link", "#");
							} ?>" class="nav__btm__btn btn btn--primary">
								<?php
								set_query_var("color", "nav__color--dark");
								get_template_part("/assets/images/svg/user-icon");
								echo get_theme_mod("gs_contact_btn_text", 'Contact Us');
								?>
                            </a>
                        </div>
                        <div class="nav__hambrg__area" aria-hidden="true" data-acsb-hidden="true">
                            <button class="nav__hambrg" onclick="showSidebar(this)">
								<?php get_template_part("/assets/images/svg/menu-icon") ?>
                            </button>
                            <button class="nav__close" onclick="closeSidebar(this)">
								<?php get_template_part("/assets/images/svg/close-icon") ?>
                            </button>
                        </div>

                    </div>
                </div>

            </div>


</header>