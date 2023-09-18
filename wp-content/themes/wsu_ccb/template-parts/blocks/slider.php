<?php
$images = get_field('gallery');
if ($images): ?>
    <div class="slider-gallery" data-loop="<?= count($images); ?>">
        <div class="swiper mainSwiper">
            <div class="swiper-wrapper">
              <?php
              $counter = 1;
              foreach ($images as $image): ?>
                  <div class="swiper-slide">
                      <div class="swiper-container">
                          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>
                        <?php if ($image['caption']) : ?>
                            <span class="flex-caption"><?= $image['caption'] ?></span>
                        <?php endif; ?>
                          <span class="slide-number"><?= $counter ?>/<?= count($images) ?></span>
                      </div>
                  </div>
                <?php
                $counter++;
              endforeach; ?>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>

        <div thumbsSlider="" class="swiper thumbSwiper">
            <div class="swiper-wrapper">
              <?php foreach ($images as $image): ?>
                  <div class="swiper-slide"><img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>"
                                                 alt="Thumbnail of <?php echo esc_url($image['alt']); ?>"/></div>
              <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
