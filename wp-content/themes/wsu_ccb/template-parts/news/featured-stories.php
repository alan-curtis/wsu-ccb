<?php
$group = get_field('featured_stories');
if( !empty( $group ) ):
    $total_args = [
        'post_type' => 'post',
        'category_name' => $group['category_select']['value'],
        'order' => 'desc',
    ];
    $total_posts = new WP_Query($total_args);
    $total = $total_posts->found_posts;
    ?>
<div class="container card-section featured-stories-no-img">
    <div class="d-flex align-items-center title-section">
        <div class="me-auto p2 ">
            <h3>
                <?php echo $group['title']; ?>
            </h3>
        </div>
        <?php if (!empty($group["more_link"]["url"])): ?>
            <div class="top-link">
                <a href="<?= $group["more_link"]["url"]; ?>"><?= $group["more_link"]["title"]; ?></a>
            </div>
        <?php endif; ?>
    </div>
    <div class="row news-row">
        <?php
        $args = [
            'post_type' => 'post',
            'posts_per_page' => 4,
            'category_name' => $group['category_select']['value'],
            'order' => 'desc',
        ];
        $_posts = new WP_Query($args);

        if ($_posts->have_posts()):
            ?>
            <?php while ($_posts->have_posts()):
            $_posts->the_post();
            $featured_image = get_the_post_thumbnail_url($_posts->ID, 'post-thumbnail'); ?>
            <div class="col-lg-3 col-6 rows-col">
                <div class="card-wrapper">
                    <div class="card-title">
                        <h3>
                            <?php the_title(); ?>
                        </h3>
                    </div>
                    <div class="card-desc">
                        <p><?php echo wp_trim_words(get_the_excerpt(), 10); ?></p>
                    </div>
                    <div class="card-actions">
                        <a href="<?php the_permalink(); ?>" target="" class="upper-btn">Read More</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <?php endif; ?>
    </div>
    <div class="red-btn">
        <button href="#" target="" class="load-more-stories">More Stories</button>
    </div>
</div>
<?php endif; ?>

<script>
    jQuery(document).ready(function($) {
        var offset = 4; // Initial offset, as the first 3 posts are already displayed
        var category = '<?php echo $group['category_select']['value']; ?>';
        var total = <?php echo $total; ?>;

        jQuery('.featured-stories-no-img .load-more-stories').on('click', function(e) {
            e.preventDefault();

            var button = jQuery(this);

            jQuery.ajax({
                url: "/wp-admin/admin-ajax.php",
                type: 'post',
                dataType: 'json',
                data: {
                    action: 'load_more_stories',
                    offset: offset,
                    category: category,
                },
                beforeSend: function() {
                    button.text('Loading...'); // Change button text to indicate loading
                },
                success: function(response) {
                    if (response.success) {
                        jQuery('.featured-stories-no-img .news-row').append(response.data.html);
                        offset += 3;
                        if (jQuery(document).find('.featured-stories-no-img .news-row .rows-col').length == total) {
                            button.remove(); // Remove the button if no more posts are available
                        } else {
                            button.text('More Stories'); // Restore button text
                        }
                    } else {
                        button.remove(); // Remove the button if no more posts are available
                    }
                },
            });
        });
    });

</script>

