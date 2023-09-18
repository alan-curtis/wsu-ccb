<div class="news-events-section" id="<?= get_field('subnav_id'); ?>">
  <div class="news-events-wrap">
    <?php if (!empty(get_field('bg_img'))): ?>
      <div class="events-bg" style="background:url('<?= get_field('bg_img'); ?>');">

      </div>
    <?php endif; ?>

    <div class="container">
      <div class="row">
        <div class="col-lg-8 news-border">
          <div class="news-title">
            <h1> <?= get_field('news_title'); ?> </h1>
          </div>
          <div class="row">
            <div class="col-5 featured-news-container">
              <?php
              $args = [
                'post_type' => 'post',
                'posts_per_page' => 1,
                //'orderby' => 'publish_date',
                'order' => 'ASC',
                'meta_query' => [
                  'relation' => 'AND',
                  [
                    'meta_key' => 'featured',
                    'value' => '"true"',
                    'compare' => 'LIKE',
                  ],
                ]
              ];
              $_posts = new WP_Query($args);

              if ($_posts->have_posts()):
                ?>
                <?php while ($_posts->have_posts()): $_posts->the_post();
                $featured_image = get_the_post_thumbnail_url($_posts->ID, 'post-thumbnail'); ?>
                <a href="<?php the_permalink(); ?>">
                  <div class="featured-img-wrap">
                    <img src="<?= $featured_image; ?>" alt="<?php the_title(); ?>"/>
                  </div>
                  <div class="featured-content-wrap">
                    <div class="post-date"><?php the_date('F j, Y'); ?></div>
                    <div class="post-title"> <?php the_title(); ?></div>
                  </div>
                </a>

              <?php endwhile; ?>
              <?php endif; ?>
              <?php wp_reset_postdata();
              wp_reset_query(); ?>
            </div>

            <div class="col-md-7 ps-0 ps-md-2">
              <div class="events-wrapper">
              <?php
              $args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'orderby' => 'publish_date',
                'order' => 'DESC',
                'meta_query' => array(
                  'relation' => 'OR',
                  array(
                    'key' => 'featured',
                    'compare' => 'NOT EXISTS',
                  ),
                  array(
                    'key' => 'featured',
                    'value' => '1',
                    'compare' => '!=',
                  ),
                ),
              );
              $_posts = new WP_Query($args);
              if ($_posts->have_posts()):
                ?>
                <?php while ($_posts->have_posts()): $_posts->the_post();
                $featured_image = get_the_post_thumbnail_url($_posts->ID, 'post-thumbnail');
                $post_date = get_the_time('F j, Y');
                ?>
                <a href="<?php the_permalink(); ?>">
                  <div class="news-container">
                    <div class="news-img-wrap">
                      <img src="<?= $featured_image; ?>" alt="<?php the_title(); ?>"/>
                    </div>
                    <div class="news-content-wrap">
                      <div class="post-date"><?= $post_date; ?></div>
                      <div class="post-title"> <?php the_title(); ?></div>
                    </div>
                  </div>
                </a>
              <?php endwhile; ?>
              <?php endif; ?>
              <?php wp_reset_postdata();
              wp_reset_query(); ?>
              <div class="link-wrap">
                <?php
                $link = get_field('more_news');
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                <a class="link" href="<?= $link_url; ?>" target="<?= $link_target; ?>"><?= $link_title; ?></a>
              </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 px-4 events-container right-event-container">
          <div class="news-title">
            <h1> <?= get_field('events_title'); ?> </h1>
          </div>
          <div class="events-wrapper">
            <?php
            $events = new WP_Query([
              'start_date' => 'now',
              'posts_per_page' => 3,
              'post_type' => 'tribe_events',
            ]);

            if ($events->have_posts()):
              ?>
              <?php while ($events->have_posts()): $events->the_post();
              $featured_image = get_the_post_thumbnail_url($events->ID, 'post-thumbnail');
              $post_date = get_the_time('F j, Y');
              ?>

              <a href="<?php the_permalink(); ?>">
                <div class="news-container">
                  <div class="news-content-wrap">
                    <div class="post-date"><?= $post_date; ?></div>
                    <div class="post-title"> <?php the_title(); ?></div>
                  </div>
                </div>
              </a>

            <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_postdata();
            wp_reset_query(); ?>
          </div>
          <div class="link-wrap">
            <?php
            $link = get_field('more_events');
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self'; ?>
            <a class="link" href="<?= $link_url; ?>" target="<?= $link_target; ?>"><?= $link_title; ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
