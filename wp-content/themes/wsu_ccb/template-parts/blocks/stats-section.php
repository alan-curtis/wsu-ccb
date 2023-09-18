<div class="container mobile">
  <div class="title-center">
    <h1> <?= get_field('title'); ?> </h1>
  </div>
  <div class="row"> <!-- mobile -->
    <div class="col-7">
      <div class="row accordion-container">
        <div class="accordion accordion-flush" id="accordionFlush">
          <?php
          // Loop through rows.
          while (have_rows('facts_repeater')) : the_row();
            $icon = get_sub_field('icon');
            $title = get_sub_field('title');
            $icon_url = $icon['url'];
            $icon_alt = $icon['alt'];
            $copy = get_sub_field('copy');
            $link = get_sub_field('link');
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-heading-<?= get_row_index(); ?>">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse-<?= get_row_index(); ?>" aria-expanded="false"
                        aria-controls="flush-collapse-<?= get_row_index(); ?>">
                  <img src="<?= $icon_url; ?>" alt="<?= $icon_alt; ?>"/> <?= $title; ?>
                </button>
              </h2>
              <div id="flush-collapse-<?= get_row_index(); ?>" class="accordion-collapse collapse"
                   aria-labelledby="flush-heading-<?= get_row_index(); ?>" data-bs-parent="#accordionFlush">
                <div class="accordion-body">
                  <?= $copy; ?>
                </div>
              </div>
            </div>


          <?php // End loop.
          endwhile;
          ?>
        </div>
      </div>
    </div>
    <div class="col-5 icons-mobile">
      <div class="lightbulb"></div>
      <div class="paper-plane"></div>
      <div class="book"></div>
    </div>
  </div>
  <div class="row mobile">
    <div class="col-5 col-md-12 stats-mobile">
      <?php
      // Loop through rows.
      while (have_rows('stats_repeater')) : the_row();
        $number = get_sub_field('stat_number');
        $stat_title = get_sub_field('stat_title');
        // $link = get_sub_field('stat_citation');
        // $link_url = $link['url'];
        // $link_title = $link['title'];
        // $link_target = $link['target'] ? $link['target'] : '_self';
        ?>
        <div class="stat-wrap">
            <span class="stat-number">
                <?= $number; ?>
            </span>
          <p class="statTitle">
            <?= $stat_title; ?>
          </p>
          <div class="statsubtitle">
            TheBestSchools.org
          </div>
        </div>


      <?php endwhile; ?>
    </div>
    <div class="col-7 bg-wrap">
      <div class="woman-bg"></div>
    </div>
  </div>

</div> <!-- end mobile -->

<div class="stat-section">
  <div class="container desktop ">
    <div class="row">
      <div class="col-8">
        <div class="stats-wrapper">
          <div class="stat-title">
            <h1> <?= get_field('title'); ?> </h1>
          </div>
          <?php
          // Loop through rows.
          while (have_rows('facts_repeater')) : the_row();
            $icon = get_sub_field('icon');
            $title = get_sub_field('title');
            $icon_url = $icon['url'];
            $icon_alt = $icon['alt'];
            $copy = get_sub_field('copy');
            $link = get_sub_field('link');
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
            <div class="col-12 row-container">
              <div class="img-wrap">
                <img src="<?= $icon_url; ?>" alt="<?= $icon_alt; ?>"/>
              </div>
              <div class="copy-wrap">
                <div class="title"><?= $title; ?></div>
                <div class="copy"><?= $copy; ?></div>
                <a class="link" href="<?= $link_url; ?>" target="<?= $link_target; ?>"><?= $link_title; ?></a>
              </div>
            </div>
          <?php // End loop.
          endwhile;
          ?>
        </div>
      </div>
      <div class="col-4 stat-wrapper">
        <div class="stats-container">
        <?php
        // Loop through rows.
        while (have_rows('stats_repeater')) : the_row();
          $number = get_sub_field('stat_number');
          $stat_title = get_sub_field('stat_title');
          ?>
          <div class="stat-wrap">
                <span class="stat-number">
                    <?= $number; ?>
                </span>
            <p class="statTitle">
              <?= $stat_title; ?>
            </p>
            <div class="stats-sub-title">
              TheBestSchools.org
            </div>
          </div>
        <?php endwhile; ?>
        <div class="icons-desktop">
          <div class="lightbulb"></div>
          <div class="paper-plane"></div>
          <div class="book"></div>
          <div class="woman-bg"></div>
        </div>
        </div>
      </div>
    </div>
  </div>

</div>

