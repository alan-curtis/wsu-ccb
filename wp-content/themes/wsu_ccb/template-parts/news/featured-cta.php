<?php $featured_cta = get_field('featured_news_cta'); ?>

<?php if( $featured_cta) :

    $bg_img = wp_get_attachment_image_src( get_post_thumbnail_id( $featured_cta ), 'full' );
    $link = get_permalink($featured_cta->ID);
    $title = get_the_title($featured_cta->ID);
    $category = wp_get_post_categories($featured_cta->ID, [ 'fields' => 'all' ]);
    $cats = "";
    $post_date = get_the_time('F j, Y');
    ?>

    <div class="container px-0 px-md-2">
        <div class="news-featured-cta-section">
        <a href="<?= $link; ?>">
            <div class="featured-bg" style="background: url('<?= $bg_img[0]?>')">
                <div class="content-wrap">
                    <div class="content">

                    
                    <?php
                    foreach(array_slice($category,0, 2 ) as $cats){
                        echo '<div class="cat-item"> ' .$cats->name. ' </div>' ;
                        
                }
                     ?>
                    <div class="title">
                    <?= $title; ?>
                    </div>
                    <div class="date">
                    <?= $post_date; ?>
                    </div>
            
                </div>
                </div>
            </div>
            </a>
        </div>
    </div>


<?php endif;?>