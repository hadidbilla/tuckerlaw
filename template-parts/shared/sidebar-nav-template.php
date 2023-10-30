<?php

$manuName = "primary";
$locations = get_nav_menu_locations();
$menuID = $locations[$manuName];
$menuItems = wp_get_nav_menu_items($menuID);
// create array for menu items parent to child to grandchild relationship
$menuItemsParent = [];
$menuItemsChild = [];
$menuItemsGrandChild = [];
$menuItemsGrandGrandChild = [];
// parent menu items
foreach ($menuItems as $item) {
  if (!$item->menu_item_parent) {
    $menuItemsParent[] = $item;
  }
}

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
?>

<div class="nav-res">
  <div class="nav-res__container">
    <div class="nav-res__menu">
      <ul class="nav-res__link-sec">
        <?php
        foreach ($menuItemsParent as $item) {
          $hasChild = false;
          $hasGrandChild = false;
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
          // nav-res__link
          if ($hasChild) {
        ?>
            <li class="nav-res__link nav-res__icon" onclick="navShowChild(event)">
              <?php
              echo $item->title;
              echo "<ul class='nav-res__childlink-sec'>";
              foreach ($menuItemsChild as $child) {
                if ($child->menu_item_parent == $item->ID) {
                  if ($hasGrandChild) {
              ?>
            <li class="nav-res__childlink nav-res__icon" onclick="navShowChild(event)">
              <?php echo $child->title; ?>
              <ul class="nav-res__grandchildlink-sec nav-res__scroll">
                <?php
                    foreach ($menuItemsGrandChild as $grandChild) {
                      if ($grandChild->menu_item_parent == $child->ID && $child->title == "Departments") {
                ?>
                    <li class="nav-res__grandchildlink nav-res__icon" onclick="navShowGrandChild(event)">
                      <?php echo $grandChild->title; ?>
                      <ul class="nav-res__grandgrandchildlink-sec nav-res__scroll">
                        <?php
                        foreach ($menuItemsGrandGrandChild as $grandGrandChild) {
                          if ($grandGrandChild->menu_item_parent == $grandChild->ID) {
                        ?>
                            <li class="nav-res__grandgrandchildlink">
                              <a tabindex='-1'href="<?php echo $grandGrandChild->url ?>" class="nav-res__link-res"><?php echo $grandGrandChild->title ?></a>
                            </li>
                        <?php
                          }
                        }
                        ?>
                      </ul>
                    <?php
                      } else if ($grandChild->menu_item_parent == $child->ID) {
                    ?>
                    <li class="nav-res__grandgrandchildlink">
                      <a tabindex='-1'href="<?php echo $grandChild->url ?>" class="nav-res__link-res"><?php echo $grandChild->title ?></a>
                    </li>
                <?php
                      }
                    }

                ?>
              </ul>
            </li>
          <?php
                  } else {
          ?>
            <li class="nav-res__childlink">
              <a tabindex='-1'href="<?php echo $child->url ?>" class="nav-res__link-res"><?php echo $child->title ?></a>
            </li>
      <?php
                  }
                }
              }
              echo "</ul>";
      ?>
    <?php
          } else {
    ?>
      <li class="nav-res__link">
        <a tabindex='-1'href="<?php echo $item->url ?>" class="nav-res__link-res"><?php echo $item->title ?></a>
      </li>
  <?php
          }
        }
  ?>
      </ul>
    </div>
  </div>
</div>