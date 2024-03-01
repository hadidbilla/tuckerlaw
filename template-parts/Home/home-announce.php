<div class="annc">
  <div class=" container">
    <div class="annc__wrp">
      <div class="annc__content__wrp">
        <div class="">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
            <path d="M9.99965 7.23802V10.5714M9.99965 13.9047H10.008M8.57465 2.95469L1.51632 14.738C1.37079 14.99 1.29379 15.2758 1.29298 15.5668C1.29216 15.8578 1.36756 16.144 1.51167 16.3968C1.65579 16.6496 1.86359 16.8603 2.11441 17.0079C2.36523 17.1555 2.65032 17.2348 2.94132 17.238H17.058C17.349 17.2348 17.6341 17.1555 17.8849 17.0079C18.1357 16.8603 18.3435 16.6496 18.4876 16.3968C18.6317 16.144 18.7071 15.8578 18.7063 15.5668C18.7055 15.2758 18.6285 14.99 18.483 14.738L11.4247 2.95469C11.2761 2.70978 11.0669 2.50729 10.8173 2.36676C10.5677 2.22623 10.2861 2.1524 9.99965 2.1524C9.71321 2.1524 9.43159 2.22623 9.18199 2.36676C8.93238 2.50729 8.72321 2.70978 8.57465 2.95469Z" stroke="#DC6803" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>
        <div class="annc__content">
          <h3 tabindex="0" tabindex="0" class="annc__title " role="heading" aria-level="6">
            <?php echo get_theme_mod("gs_announce_title", "Attention Clients"); ?>
          </h3>
          <div class="annc__text ">
            <?php echo get_theme_mod("gs_announce_subtitle", "If you are an owner, officer, or a trustee of certain business organizations, please note that effective January 1, 2024, new federal reporting obligations went into effect for those business entities under the Corporate Transparency Act. Reporting obligations are time sensitive and ongoing. The failure to timely report may result in civil and criminal penalties."); ?>
          </div>
          <div class="annc__btn__area">
            <a href="<?php echo get_theme_mod("gs_announce_btn_link", "#"); ?>" class="annc__btn">
              <?php echo get_theme_mod("gs_announce_btn_text", "Click here to learn more"); ?>
              <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                  <path d="M4.1665 10.5714H15.8332M15.8332 10.5714L9.99984 4.73804M15.8332 10.5714L9.99984 16.4047" stroke="#B54708" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .annc {
    background-color: var(--color-secondary);
    padding: 32px 0;
  }

  .annc__content {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .annc__wrp {
    padding: 18px 16px;
    background-color: #FFFCF5;
    border-radius: 6px;
  }

  .annc__title {
    color: #B54708;
    font-size: 20px;
    font-style: normal;
    font-weight: 500;
    line-height: 20px;
  }

  .annc__text {
    color: #DC6803;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 20px;
  }

  .annc__btn__area {
    display: inline-block;
  }

  .annc__btn {
    color: #B54708;
    display: flex;
    gap: 8px;
  }

  .annc__content__wrp {
    display: flex;
    gap: 12px;
  }
</style>