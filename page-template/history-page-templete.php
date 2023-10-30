<?php
/* Template Name: Our History Page */

get_header();
get_template_part('template-parts/shared/sidebar-nav-template');
//get post title and content
$post = get_post();
$post_title = $post->post_title;
$post_content = $post->post_content;
//get excerpt
$post_excerpt = $post->post_excerpt;
//get current page id
$post_id = $post->ID;
//get current page meta data
$page_meta = get_post_meta($post_id);
$first_btn_label = $page_meta['first_button_group_first_button_label'][0];
$first_btn_link = $page_meta['first_button_group_first_button_link'][0];
$first_btn_icon = $page_meta['first_button_group_first_button_icon'][0];
$second_btn_label = $page_meta['second_button_group_second_button_label'][0];
$second_btn_link = $page_meta['second_button_group_second_button_link'][0];
$second_btn_icon = $page_meta['second_button_group_second_button_icon'][0];
get_template_part('template-parts/shared/banner-template',
  null,
  array(
    'banner_title' => $post_title,
    'banner_content' => $post_excerpt,
    'first_btn_label' => $first_btn_label,
    'first_btn_link' => $first_btn_link,
    'first_btn_icon' => $first_btn_icon,
    'second_btn_label' => $second_btn_label,
    'second_btn_link' => $second_btn_link,
    'second_btn_icon' => $second_btn_icon,
  )
);
$tabs = get_posts(array(
  'post_type' => 'tabs',
  'name' => "about-us",
  'post_status' => 'publish',
  'numberposts' => 1
));
// get tabs meta data
$tabs_meta_data = get_post_meta($tabs[0]->ID);
// print_r($tabs_meta_data);
//a:5:{i:0;s:3:"419";i:1;s:2:"18";i:2;s:3:"414";i:3;s:3:"145";i:4;s:3:"412";}  convert to array
$tabs_meta_data = unserialize($tabs_meta_data['realed_page'][0]);



//get menu items

get_template_part('template-parts/shared/section-bar-template-part', null, array(
  'tabs' => $tabs_meta_data
));
?>

<div class="history ">
  <div class="container">
    <div class="history__wrap">
      <?php
      echo $post->post_content;
      ?>
      <div class="history__full-timeline-sec">
        <div class="history__timeline-his-con">
          <div class="history__circle"></div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1881
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1881
                </span>
                <!-- <div class="history__divider">
              </div>
              <span class="history__date">1881</span> -->
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1881.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
                The Founder Starts Practicing Law
              </h3>
              <p class="history__sec-text text">
                Thomas W. Patterson started practicing law in Pittsburgh, PA. He was born in Carroll Township, Washington County, Pennsylvania on November 14, 1856. He was the son of a printer and had been apprenticed to a printer before becoming a lawyer. He attended Columbia University.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1900
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1900
                </span>
                <!-- <div class="history__divider">
              </div>
              <span class="history__date">1881</span> -->
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1990.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
                The Firm Is Established
              </h3>
              <p class="history__sec-text text">
                Thomas Patterson founded the Firm, which was then called Patterson, Sterrett & Acheson in Pittsburgh, PA. The Firm was composed of Thomas W. Patterson, Ross Sterrett and Mark Acheson. All of them were of old Western Pennsylvania families. The Firm was located on the 12th floor of the Frick Building which was brand new at the time. Henry Clay Frick had his office upstairs.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1904
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1904
                </span>
                <!-- <div class="history__divider">
              </div>
              <span class="history__date">1881</span> -->
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1904.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
                Charles F.C. Arensberg Starts With The Firm.
              </h3>
              <p class="history__sec-text text">
                Charles F.C. Arensberg started with the Firm while he was a student at Harvard Law School. At this time, not all lawyers came from law schools; some elected to study law in law firms. In 1909 or 1910 the Firm formally offered him a job, which he held for the balance of his career.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1900
                </span>
                <div class="history__divider">
                </div>
                <span class="history__date">1920</span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1900
                </span>
                <div class="history__divider">
                </div>
                <span class="history__date">1920</span>
                <!-- <div class="history__divider">
              </div>
              <span class="history__date">1881</span> -->
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1990-1920.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
              Early Clients & Establishing a Reputation
              </h3>
              <p class="history__sec-text text">
                The Firm was counsel for the Pennsylvania Railroad, Bell Telephone Company, for the receivers of the Wabash Pittsburgh Railway Company, First National Bank, Peoples Savings and Trust Company, as well as a number of other railroads and banks.
                The Firm was engaged in litigation almost constantly and tried a number of cases in other counties of the state. Mr. Patterson’s reputation as a leader of the bar was state-wide. He had been president of the Allegheny County Bar Association (1902) and also of the Pennsylvania Bar Association (1907). Mr. Patterson also helped to organize the predecessor to Pitt Law School.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1917
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1917
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1917.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
                Changing Names
              </h3>
              <p class="history__sec-text text">
              The Firm of Patterson, Sterrett & Acheson dissolved; the new Firm was called Patterson, Crawford and Miller and then became Patterson, Crawford, Miller and Arensberg.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1927
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1927
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1927.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
              First Female Attorney Admitted to Pennsylvania Bar Association
              </h3>
              <p class="history__sec-text text">
                The Firm was called Patterson, Crawford, Arensberg & Dunn. Ella Graubhart, who started with the Firm in 1935, graduated from law school and was admitted to the Pennsylvania Bar Association. She is believed to be the first female ever admitted to the Pennsylvania Bar Association. At this time the offices were at 1404 First National Bank Building at the corner of Fifth Avenue and Wood Street where PNC Plaza (formerly known as the Pittsburgh National Building) now stands.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1937
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1937
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1937.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
                Richard B. Tucker starts with the firm
              </h3>
              <p class="history__sec-text text">
                Richard B. Tucker, Jr. started with the Firm, which was named Patterson, Crawford, Arensberg & Dunn. He attended the University of Virginia and served in World War II.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1938
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1938
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1938.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
                Forming a 50-year partnership
              </h3>
              <p class="history__sec-text text">
                Charles Covert Arensberg (“Charlie Arensberg” and the son of Charles F.C. Arensberg) came to the Firm and Richard B. Tucker and he happily practiced law together for more than 50 years. At this time, the Firm represented the Colonial Trust Company and the Etna Bank which eventually merged into Peoples First National Bank & Trust Company, predecessor to PNC Bank.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1940
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1940
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1940.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
                First female senior partner in Pennsylvania and World War II Challenges
              </h3>
              <p class="history__sec-text text">
                Ella Graubhart becomes the first female Senior Partner of a Pennsylvania law firm. The Firm also helped to create the Public Parking Authority of Pittsburgh during this decade and represented this client until 1969.
                During the years of World War II (1939-1945), the Firm was reduced to six lawyers at one point as several lawyers went into service. When the war was over, most of the attorneys that left to go into the service came back.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1942
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1942
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1942.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
              Moving Towards Equality in the Legal Industry
              </h3>
              <p class="history__sec-text text">
              Charles F.C. Arensberg was elected President of the Allegheny County Bar Association. Until this time, African American lawyers had been excluded from membership. During his term as President, he saw to it that these restrictions were abolished and for the first time elected to the association.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1950
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1950
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1950.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
                Charles F.C. Arensberg Elected President of the PBA
              </h3>
              <p class="history__sec-text text">
                Charles F.C. Arensberg was elected President of the Pennsylvania Bar Association and served the customary year.
                During the 1940’s and 1950’s the Firm had bread-and-butter clients like Peoples-Pittsburgh Trust Company, The Bell Telephone Company of PA (now Verizon), Erie Railroad, United Engineering Company, Lawyers Title Insurance Company and others.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1964
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1964
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1964.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
                Fighting for Positive Change
              </h3>
              <p class="history__sec-text text">
                Charlie Arensberg read a Father Drinan’s story of black churches being burnt in the South and at least one African American pastor being accused of arson. He volunteered for the Lawyer’s Constitutional Defense Committee and took a bus to Jackson, Mississippi where he spent to weeks living in African American quarters, defending African American activists and generally being depressed, fearful and mindful of racial differences at the core.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1968
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1968
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1968.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
                New Firm Location
              </h3>
              <p class="history__sec-text text">
                The Firm moved out of the First National Bank Building to the 6th and 11th floors of One Oliver Plaza.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1969
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1969
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1969.jpg' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
                Representing Multi-employer Funds
              </h3>
              <p class="history__sec-text text">
                The Firm started to represent multiemployer funds for compliance and litigation/collections. This represents a big part of our business today.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1970
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1970
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1970.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
                More Name Changes
              </h3>
              <p class="history__sec-text text">
                Patterson, Crawford, Arensberg & Dunn merged with Campbell Thomas & Burke to form Tucker, Burke, Campbell & Arensberg which dissolved February 28, 1971, and on March 1, 1971, Tucker, Arensberg & Ferguson was formed.Patterson, Crawford, Arensberg & Dunn merged with Campbell Thomas & Burke to form Tucker, Burke, Campbell & Arensberg which dissolved February 28, 1971, and on March 1, 1971, Tucker, Arensberg & Ferguson was formed.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1971
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1971
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1971.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
                New Office & Higher Education Clients
              </h3>
              <p class="history__sec-text text">
                The Firm moved into the new Pittsburgh National Bank (PNB) Building. Due to the close relationship with PNB, the Firm was the first non-Bank tenant in the building. The Firm occupied part of the 12th floor and eventually took over all of the space on the 12th floor and then took space on 11 in 1985 or 1986.
                During the 1970s the Firm did much legal work for the University of Pittsburgh and also represented Point Park College since it was incorporated. Mr. Tucker saved the college from financial ruin in the 1970s when he tried its case for exemption of its real estate from local taxation. Mr. Tucker thereafter served on the Board of Trustees for many years and Point Park remains a client to this day.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1983
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1983
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1983.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
                The permanent name is established
              </h3>
              <p class="history__sec-text text">
                Tucker Arensberg, PC was formed as a corporation and the permanent name of the Firm is established.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1984
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1984
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1984.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
              Office Merges into Tucker Arensberg
              </h3>
              <p class="history__sec-text text">
                The Firm merged with Brooks & Ewalt which added five lawyers and new practice specialties. Our client, Pittsburgh National announced a merger with Hershey Bank and the Firm had other clients in the Harrisburg region. The Firm started an office sharing arrangement on State Street in Harrisburg.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1985
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1985
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1985.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
                Harrisburg Office is Established
              </h3>
              <p class="history__sec-text text">
                The shared office in Harrisburg merged into Tucker Arensberg.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1987
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1987
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1987.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
                Harrisburg office move and new firm management and structure
              </h3>
              <p class="history__sec-text text">
                The Tucker Arensberg Harrisburg office moved to more spacious quarters on Pine Street.
                During the 1980s the Firm adopted a new managing committee format with Mr. Tucker’s full support. In 1986 he wrote, “The present system works much better; it provides leadership.” The Firm’s philosophy progressed from the belief that management and business planning were beneath the dignity of a lawyer to the belief that management and planning are essential to the furnishing of effective professional services to our clients.
                In the early 1980s the Firm organized itself into Commercial and Litigation practice groups and by the mid-1980s, the departmentalization improved the Firm’s profitability. The Board also hired an office manager to focus on the fact that this was a business.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1988
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1988
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1988.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
              Merger to add expertisee
              </h3>
              <p class="history__sec-text text">
              The Firm merged with Finkel, Lefkowitz, Ostrow & Woolridge to add corporate, tax, securities and ERISA expertise.
              </p>
            </div>
          </div>
          <!-- <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1990
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1990
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1990.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
              The then 5-member board became a 3-member Management Committee.
              </h3>
              <p class="history__sec-text text">
              The Firm merged with Finkel, Lefkowitz, Ostrow & Woolrdidge to add corporate, tax, securities and ERISA expertise.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1991
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1991
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1991.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
              Adding New Banking Clients
              </h3>
              <p class="history__sec-text text">
              The Firm was granted permission by PNC Bank to accept work by other banking clients because PNC was being represented by other law firms and brought in banking attorneys that were a good fit.
              </p>
            </div>
          </div> -->
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1993
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1993
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1993.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
              Pittsburgh Office Moves
              </h3>
              <p class="history__sec-text text">
              The Pittsburgh office moved to One PPG Place.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1995
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1995
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1995.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
              First Managing Shareholder is Established
              </h3>
              <p class="history__sec-text text">
              The Firm formally vested day-to-day management authority to Charles Vater when they named him Managing Shareholder of the Firm.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1998
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1998
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1998.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
              Harrisburg Office Merger
              </h3>
              <p class="history__sec-text text">
              The Firm of Hepford, Swartz and Morgan merged with the Tucker Arensberg Harrisburg office located on Front Street.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  1999
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  1999
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/1999.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
              New Managing Shareholder, Gary Hunt
              </h3>
              <p class="history__sec-text text">
              Gary Hunt succeeded Chuck Vater as Managing Shareholder.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  2000
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  2000
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/2000.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
              Celebrating 100 years
              </h3>
              <p class="history__sec-text text">
              With about 65 lawyers, the Firm celebrated its centennial with a big party at Dowe’s on 9th. 
              This is a photo from the event of then Managing Shareholder Gary Hunt with then Pittsburgh Mayor, Tom Murphy
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  2009
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  2009
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/2009.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
              New Managing Shareholder, Thomas Peterson
              </h3>
              <p class="history__sec-text text">
              Thomas Peterson succeeded Gary Hunt as Managing Shareholder.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  2010
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  2010
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/2010.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
              Gary Hunt: Allegheny County Bar Association President
              </h3>
              <p class="history__sec-text text">
              Gary Hunt is elected President of the Allegheny County Bar Association and served the customary year.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  2020
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  2020
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/2020.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
              New Managing Shareholder, Irving Firman
              </h3>
              <p class="history__sec-text text">
              Irving Firman succeeded Thomas Peterson as Managing Shareholder.
              </p>
            </div>
          </div>
          <div class="history__timeline-section">
            <div class="history__time-res">
              <div class="history__time__res__wrp">
                <span class=" history__date">
                  2021
                </span>
              </div>
            </div>
            <div class="history__sec-img-con">
              <div class="history__time">
                <span class=" history__date">
                  2021
                </span>
              </div>
              <img alt="History Image"  loading="lazy" src="<?php echo get_template_directory_uri() . '/assets/images/2021.png' ?>" alt="" class="history__image">
            </div>
            <div class="history__sec-content">
              <h3 tabindex="0" class="history__sec-title title--card-small">
              New Harrisburg office location and expansion into California
              </h3>
              <p class="history__sec-text text">
              Tucker Arensberg, PC expands to provide legal services through Tucker Arensberg, L.L.P. with an office in the San Francisco Bay area. Tucker Arensberg Harrisburg law office moved to a new state-of-the-art office space to accommodate growth.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php
get_footer();
?>