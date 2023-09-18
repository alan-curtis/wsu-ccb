<div class="cta-image-block">
    <div class="container">
      <?php $title = get_field('title');
      if (!empty($title)): ?>
          <div class="title-center">
              <h1> <?= $title; ?> </h1>
          </div>
      <?php endif; ?>
        <div class="row">
          <?php
          $is_home = is_front_page();
          // Loop through rows.
          $numrows = count(get_field('cta-repeater'));
          while (have_rows('cta-repeater')) : the_row();
            $cta_image = get_sub_field('image');
            $cta = get_sub_field('cta');
            $cta_url = $cta['url'];
            $cta_title = $cta['title'];
            $cta_target = $cta['target'] ? $cta['target'] : '_self';
            ?>
            <?php if ($is_home): ?>
                  <div class="col-lg-3 col-6">
                      <div class="cta-image-block__wrapper">
                          <a href="<?= $cta_url; ?>" target="<?= $cta_target; ?>" class="cta-image-block__item">
                              <div class="cta-image-block__item--image">
                                  <img src="<?= $cta_image; ?>" alt=""/>
                              </div>
                              <div class="cta-image-block__item--button red-btn-container">
                                  <div class="dark-red-btn btn">
                                    <?= $cta_title; ?>
                                  </div>
                              </div>
                          </a>
                      </div>
                  </div>
            <?php else: ?>
              <?php if ($numrows % 2 == 0): ?>
                      <div class="col-6">
                          <div class="cta-image-block__wrapper">
                              <a href="<?= $cta_url; ?>" target="<?= $cta_target; ?>" class="cta-image-block__item">
                                  <div class="cta-image-block__item--image">
                                      <img src="<?= $cta_image; ?>" alt=""/>
                                  </div>
                                  <div class="cta-image-block__item--button red-btn-container">
                                      <div class="dark-red-btn btn">
                                        <?= $cta_title; ?>
                                      </div>
                                  </div>
                              </a>
                          </div>
                      </div>
              <?php else: ?>
                      <div class="col-12">
                          <div class="cta-image-block__wrapper">
                              <a href="<?= $cta_url; ?>" target="<?= $cta_target; ?>" class="cta-image-block__item">
                                  <div class="cta-image-block__item--image">
                                      <img src="<?= $cta_image; ?>" alt=""/>
                                  </div>
                                  <div class="cta-image-block__item--button red-btn-container">
                                      <div class="dark-red-btn btn">
                                        <?= $cta_title; ?>
                                      </div>
                                  </div>
                              </a>
                          </div>
                      </div>
              <?php endif; ?>
            <?php endif; ?>
          <?php // End loop.
          endwhile;
          ?>
        </div>
    </div>
</div>