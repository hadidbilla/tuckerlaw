<?php
/* Template Name: Our Inclusion Page */
?>

<?php 
get_header();
get_template_part('template-parts/shared/sidebar-nav-template');
get_template_part('template-parts/shared/banner-template');
?>

<?php 
get_template_part('template-parts/shared/section-bar-template-part');
?>
<div class="inclusion">
    <div class="container">
        <div class="contact-form-right__wrap">
            <div class="inclusion__overview-richtext" id="section1">
                <h2 tabindex="0" class="inclusion__overview-title title--section">overview</h2>
                <h3 tabindex="0">EXPERIENCED LITIGATOR, PROBLEM SOLVER AND OUTSIDE GENERAL COUNSEL FOR A DIVERSE CLIENT BASE
                </h3>
                <p>
                    Erin has represented clients in a variety of industries including investment management and financial
                    institutions, energy and telecommunications, technology, retail and manufacturing, real estate, healthcare and
                    education. She has litigated civil jury trials to verdict and also tried numerous arbitrations and injunction
                    matters.
                </p>
                <p>
                    Prior to attending law school, Erin worked in the Washington, D.C. office of a large New York-based law firm and
                    lobby group, and in the New York office of a global advertising agency.
                </p>
                <img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/assets/images/about.png" alt="">
                <h3 tabindex="0">Representative Experience</h3>
                <ul>
                    <li>Defense verdict for oil and gas company in state court jury trial where Plaintiff demanded $1.4 million
                        dollars on breach of lease dispute and royalty claims;</li>
                    <li>Defense verdict for oil and gas company in state court jury trial where Plaintiff demanded $1.4 million
                        dollars on breach of lease dispute and royalty claims;</li>
                    <li>Defense verdict for oil and gas company in state court jury trial where Plaintiff demanded $1.4 million
                        dollars on breach of lease dispute and royalty claims;</li>
                    <li>Defense verdict for oil and gas company in state court jury trial where Plaintiff demanded $1.4 million
                        dollars on breach of lease dispute and royalty claims;</li>
                </ul>
                <h3 tabindex="0">Bullet points</h3>
                <ul>
                    <li>Defense verdict for oil and gas company in state court jury trial where Plaintiff demanded $1.4 million
                        dollars on breach of lease dispute and royalty claims;</li>
                    <li>Defense verdict for oil and gas company in state court jury trial where Plaintiff demanded $1.4 million
                        dollars on breach of lease dispute and royalty claims;</li>
                    <li>Defense verdict for oil and gas company in state court jury trial where Plaintiff demanded $1.4 million
                        dollars on breach of lease dispute and royalty claims;</li>
                    <li>Defense verdict for oil and gas company in state court jury trial where Plaintiff demanded $1.4 million
                        dollars on breach of lease dispute and royalty claims;</li>
                </ul>
            </div>

            <div class="contact-form-right__contact-re">
                <div class="contact-form-right__contact sticky-sidebar">
                    <div class="contact-form-right__contact-title">
                        <h2 tabindex="0" class="title--card-small">Contact Now</h2>
                        <p class="single-serve__contact-text text">Get support from our trusted attorneys.</p>
                    </div>
                    <?php
                    get_template_part('template-parts/shared/contact-form-template');
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>


<?php
get_footer();
?>
