<div class="counter">
    <div class="counter__card">
    <img alt="Counter Image" loading="lazy" src="<?php echo 
        //get img form assets
        get_template_directory_uri() . '/assets/images/target-1.png'; ?>" alt="" class="counter__count--img">
        <div class="counter__count-con">
            <span id="count1" class="counter__count counter__plus">
                <?php
                    echo get_theme_mod('gs_firm_attorneys_number', 80)
                ?>
            </span>
            <span class="counter__plus ">+</span>
        </div>
        <h5 class="title--card-small counter__title">ATTORNEYS</h5>
    </div>
    <div class="counter__card">
        <img alt="Counter Image" loading="lazy" src="<?php echo 
        //get img form assets
        get_template_directory_uri() . '/assets/images/target-2.png'; ?>" alt="" class="counter__count--img">
        <div class="counter__count-con">
            <span id="count2" class="counter__count counter__plus">
                <?php
                    echo get_theme_mod('gs_firm_offices_number', 4)
                ?>
            </span>
        </div>
        <h5 class="title--card-small counter__title">Offices</h5>
    </div>
    <div class="counter__card">
        <img alt="Counter Image" loading="lazy" src="<?php echo 
        //get img form assets
        get_template_directory_uri() . '/assets/images/target-3.png'; ?>" alt="" class="counter__count--img">
        <div class="counter__count-con">
            <span id="count3" class="counter__count counter__plus">
                <?php
                    echo get_theme_mod('gs_firm_services_number', 100)
                ?>
            </span>
            <span class="counter__plus ">+</span>
        </div>
        <h5 class="title--card-small counter__title">Diverse services</h5>
    </div>
</div>