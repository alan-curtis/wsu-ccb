
<?php $group = get_field('news_group');
if( !empty( $group ) ): ?> 
    <div class="featured-news-section">
        <div class="container">
            <div class="d-flex align-items-center title">
                <div class="me-auto p2 ">
                    <h3><?= $group['category_select']['label']; ?></h3>
                </div>
                <div class="p2">
                <a href="<?= $group['link']['url']; ?>"><?= $group['link']['title']; ?></a>
                </div>

            </div>
            <div class="row news-wrap">

    <?php 
if ($group['featured_news_position'] == 'left') { ?>
	              <?php
                  
                  $args = [
                    'post_type' => 'post',
                    'posts_per_page' => 2,
                    'category_name' => $group['category_select']['value'],
                    //'orderby' => 'publish_date',
                    'order' => 'desc',
   
                  ];
                  $_posts = new WP_Query($args);
    
                  if ($_posts->have_posts()):
                    ?>
                    <?php while ($_posts->have_posts()): $_posts->the_post();
                    $featured_image = get_the_post_thumbnail_url($_posts->ID, 'post-thumbnail'); ?>
                    <div class="col-lg-4 col-12 news-container">
                    <a href="<?php the_permalink(); ?>">
                      <div class="featured-img-wrap">
                        <div class="img-wrap">
                        <img src="<?= $featured_image; ?>" alt="<?php the_title(); ?>"/>
                        </div>
                        
    
                        <div class="featured-content-wrap">
                          <div class="post-date"><?php the_date('F j, Y'); ?></div>
                          <div class="post-title"> <?php the_title(); ?></div>
                        </div>
                      </div>
                    </a>
                    </div>
    
                  <?php endwhile; ?>
                  <?php endif; ?>
                  <?php wp_reset_postdata();
                  wp_reset_query(); ?>
    
        <div class="col-lg-4 ps-0 ps-md-2 news-wrap">
            <?php
              $args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'category_name' => $group['category_select']['value'],
                'orderby' => 'publish_date',
                'order' => 'DESC',
                'offset' => '2',
              );
              $_posts = new WP_Query($args);
              if ($_posts->have_posts()):
                ?>
                <?php while ($_posts->have_posts()): $_posts->the_post();
                $featured_image = get_the_post_thumbnail_url($_posts->ID, 'post-thumbnail');
                $post_date = get_the_time('F j, Y');
                ?>
                <a href="<?php the_permalink(); ?>">
                  <div class="news-container d-flex">
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

        </div>




    <?php  } ?>

    <?php 
if ($group['featured_news_position'] == 'right') { ?>
	        <div class="col-lg-4 ps-0 ps-md-2 news-wrap">
            <?php
              $args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'category_name' => $group['category_select']['value'],
                'orderby' => 'publish_date',
                'order' => 'DESC',
                'offset' => '2',
              );
              $_posts = new WP_Query($args);
              if ($_posts->have_posts()):
                ?>
                <?php while ($_posts->have_posts()): $_posts->the_post();
                $featured_image = get_the_post_thumbnail_url($_posts->ID, 'post-thumbnail');
                $post_date = get_the_time('F j, Y');
                ?>
                <a href="<?php the_permalink(); ?>">
                  <div class="news-container d-flex">
                    <div class="news-img-wrap">
                    <div class="img-wrap">
                        <img src="<?= $featured_image; ?>" alt="<?php the_title(); ?>"/>
                        </div>
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

        </div>
        
    <?php
                  
                  $args = [
                    'post_type' => 'post',
                    'posts_per_page' => 2,
                    'category_name' => $group['category_select']['value'],
                    //'orderby' => 'publish_date',
                    'order' => 'desc',
   
                  ];
                  $_posts = new WP_Query($args);
    
                  if ($_posts->have_posts()):
                    ?>
                    <?php while ($_posts->have_posts()): $_posts->the_post();
                    $featured_image = get_the_post_thumbnail_url($_posts->ID, 'post-thumbnail'); ?>
                    <div class="col-lg-4 col-12 news-container">
                    <a href="<?php the_permalink(); ?>">
                      <div class="featured-img-wrap">
                        <div class="img-wrap">
                        <img src="<?= $featured_image; ?>" alt="<?php the_title(); ?>"/>
                        </div>
                        
    
                        <div class="featured-content-wrap">
                          <div class="post-date"><?php the_date('F j, Y'); ?></div>
                          <div class="post-title"> <?php the_title(); ?></div>
                        </div>
                      </div>
                    </a>
                    </div>
    
                  <?php endwhile; ?>
                  <?php endif; ?>
                  <?php wp_reset_postdata();
                  wp_reset_query(); ?>
    



<?php } ?>



                </div>
        </div>
    </div>
    <?php
    endif;
    ?>