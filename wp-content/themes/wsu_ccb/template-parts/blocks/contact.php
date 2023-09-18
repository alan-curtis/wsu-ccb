<?php $contact = $args['contact_info']; ?>
<div class="contact-section">
    <div class="container">

<!--       Desktop + tablet version-->
        <div class="row main-view-column d-none d-md-flex">
            <div class="col-12 col-md-3 title-section view-column">
                <h3>
                  <?= $contact['title']; ?>
                </h3>
            </div>
            <div class="col-12 col-md-3 content-section view-column">
                <p class="name">
                  <?= $contact['name']; ?>
                </p>
                <p class="person-title">
                  <?= $contact['person_title']; ?>
                </p>
                <p class="person-department">
                  <?= $contact['department']; ?>
                </p>
            </div>
            <div class="col-12 col-md-3 contact-info view-column">
              <?php if (!empty($contact['phone_number'])): ?>
                  <a href="tel:<?= $contact['phone_number']; ?>"><?= $contact['phone_number']; ?></a>
              <?php endif; ?>
              <?php if (!empty($contact['email'])): ?>
                  <a href="mailto:<?= $contact['email']; ?>"><?= $contact['email']; ?></a>
              <?php endif; ?>
            </div>
            <div class="col-12 col-md-3 social-wrap view-column">
                <div class="social-media">
                  <?php if (!empty($contact['facebook'])): ?>
                      <a href="<?= $contact['facebook']; ?>">
                          <i class="fa-brands fa-facebook-f"></i>
                      </a>
                  <?php endif; ?>
                  <?php if (!empty($contact['twitter'])): ?>
                      <a href="<?= $contact['twitter']; ?>">
                          <i class="fa-brands fa-twitter"></i>
                      </a>
                  <?php endif; ?>
                  <?php if (!empty($contact['instagram'])): ?>
                      <a href="<?= $contact['instagram']; ?>">
                          <i class="fa-brands fa-instagram"></i>
                      </a>
                  <?php endif; ?>
                  <?php if (!empty($contact['youtube'])): ?>
                      <a href="<?= $contact['youtube']; ?>">
                          <i class="fa-brands fa-youtube"></i>
                      </a>
                  <?php endif; ?>
                </div>
            </div>
        </div>

<!--        Mobile Version-->
        <div class="row contact-mobile d-flex d-md-none">
            <div class="col-8 m-auto">
                <div class="contact-mobile__title">
                    <h3>
                      <?= $contact['title']; ?>
                    </h3>
                </div>
            </div>
            <div class="col-8 m-auto">
                <div class="contact-mobile__wrapper">
                    <div class="contact-mobile__left">
                        <div class="contact-mobile__content">
                            <p class="name">
                              <?= $contact['name']; ?>
                            </p>
                            <p class="person-title">
                              <?= $contact['person_title']; ?>
                            </p>
                            <p class="person-department">
                              <?= $contact['department']; ?>
                            </p>
                        </div>
                        <div class="contact-mobile__contact">
                          <?php if (!empty($contact['phone_number'])): ?>
                              <a href="tel:<?= $contact['phone_number']; ?>"><?= $contact['phone_number']; ?></a>
                          <?php endif; ?>
                          <?php if (!empty($contact['email'])): ?>
                              <a href="mailto:<?= $contact['email']; ?>"><?= $contact['email']; ?></a>
                          <?php endif; ?>
                        </div>
                    </div>
                    <div class="contact-mobile__right">
                        <div class="contact-mobile__social">
                            <div class="social-media">
                              <?php if (!empty($contact['facebook'])): ?>
                                  <a href="<?= $contact['facebook']; ?>">
                                      <i class="fa-brands fa-facebook-f"></i>
                                  </a>
                              <?php endif; ?>
                              <?php if (!empty($contact['twitter'])): ?>
                                  <a href="<?= $contact['twitter']; ?>">
                                      <i class="fa-brands fa-twitter"></i>
                                  </a>
                              <?php endif; ?>
                              <?php if (!empty($contact['instagram'])): ?>
                                  <a href="<?= $contact['instagram']; ?>">
                                      <i class="fa-brands fa-instagram"></i>
                                  </a>
                              <?php endif; ?>
                              <?php if (!empty($contact['youtube'])): ?>
                                  <a href="<?= $contact['youtube']; ?>">
                                      <i class="fa-brands fa-youtube"></i>
                                  </a>
                              <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>