<div class="cksm cksm--hide">
  <div class="cksm__wrp">
  <p class="cksm__title">
    <?php echo get_theme_mod('gs_cookies_modal_title', 'Cookies Modal Title'); ?>
  </p>
  <div class="cksm__btn__grp">
  <button onclick="hideModal()" type="button" class=" cksm__btn cksm__btn--pry">
    <?php echo get_theme_mod('gs_cookies_modal_btn_text_1', 'I consent to cookies'); ?>
</button>
  <button  type="button" class="cksm__btn cksm__btn--pry">
    <?php echo get_theme_mod('gs_cookies_modal_btn_text_2', 'Decline All'); ?>
  </button>
  <?php
    $pageIdToLink = get_theme_mod('gs_cookies_modal_btn_link_3');
    $pageLink = get_permalink($pageIdToLink);
  ?>
  <a href="
  <?php echo $pageLink; ?>" type="button" class="cksm__btn cksm__btn--sndy">
    <?php echo get_theme_mod('gs_cookies_modal_btn_text_3', 'Want to know more?'); ?>
  </a>
  </div>
  <?php
    $pageIdToLink = get_theme_mod('gs_cookies_modal_btn_link_4');
    $pageLink = get_permalink($pageIdToLink);
  ?>
  <a class="cksm__lnk" href="<?php echo $pageLink; ?>
  " target="_blank"  >
    <?php echo get_theme_mod('gs_cookies_modal_btn_text_4', 'Privacy Policy'); ?>
    <?php echo get_theme_mod('gs_cookies_modal_btn_page_link_4') ?>
</a>
  </div>
</div>

<script>
const isShowCookiesModal = localStorage.getItem('isShowCookiesModal');
const cookiesModal = document.querySelector('.cksm');
if (isShowCookiesModal === 'false') {
  cookiesModal.classList.add('cksm--hide');
} else {
  cookiesModal.classList.remove('cksm--hide');
}
  function hideModal() {
    cookiesModal.classList.add('cksm--hide');
    //set local storage isShowCookiesModal to false
    localStorage.setItem('isShowCookiesModal', false);
  }
</script>