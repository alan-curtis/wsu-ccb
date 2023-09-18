<div class="featured-news-banner-section">
<div class="container-fluid px-0">
			<div class="row">
				<div class="col-lg-7">
				<?php
              $args = [
                'post_type' => 'post',
                'posts_per_page' => 1,
                //'orderby' => 'publish_date',
                'order' => 'desc',
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
                $featured_image = get_the_post_thumbnail_url($_posts->ID, 'post-thumbnail'); 
                $category = get_the_category();
                ?>
                <div class="featured-image-container">
                 <a href="<?php the_permalink();?>">
                  <div class="featured-img-wrap">
                  <img src="<?= $featured_image; ?>" alt="<?php the_title(); ?>"/>
                  <div class="content-wrap">
                    <div class="featured-content-wrap">
                      <div class="post-category"><?php the_category(2); ?></div>
                      <div class="post-title"> <?php the_title(); ?></div>
                    </div>
				          </div>
                  </div>
                  </a>
                </div>

              <?php endwhile; ?>
              <?php endif; ?>
              <?php wp_reset_postdata();
              wp_reset_query(); ?>
				</div>
				<div class="col-lg-4">
          
            <div class="events-wrapper">
              <h2>Trending</h2>
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
                $category = wp_get_post_categories($post->ID, [ 'fields' => 'all' ]);
                ?>
               
                  <div class="news-container">
                  <a href="<?php the_permalink(); ?>">
                    <div class="news-img-wrap">
                      <img src="<?= $featured_image; ?>" alt="<?php the_title(); ?>"/>
                    </div>
                    </a>
                    <div class="news-content-wrap">
                    <?php
                    foreach(array_slice($category,0, 2 ) as $cats){
                        echo '<a href="/news-center/category/'.$cats->slug.'" class="post-date"> ' .$cats->name. ' </a>' ;
                        
                }
                     ?>
                       <a href="<?php the_permalink(); ?>">
                        <div class="post-title"> <?php the_title(); ?> </div>
                      </a>
                    </div>
                  </div>
                
              <?php endwhile; ?>
              <?php endif; ?>
              <?php wp_reset_postdata();
              wp_reset_query(); ?>
            </div>
				</div>
			</div>

            </div>
            </div>