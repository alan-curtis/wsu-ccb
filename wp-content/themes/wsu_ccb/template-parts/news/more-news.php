<?php
$group = get_field('more_news');
if (!empty($group)):
    $total_args = [
        'post_type' => 'post',
        'category_name' => $group['category_select']['value'],
        'order' => 'desc',
    ];
    $total_posts = new WP_Query($total_args);
    $total = $total_posts->found_posts;
    ?>
    <div class="more-news-section">
        <div class="container">
            <div class="container-wrapper">
                <div class="d-flex align-items-center title">
                    <h3>
                        <?php echo $group['title']; ?>
                    </h3>
                </div>
                <div class="row news-wrap">
                    <?php
                    $args = [
                        'post_type' => 'post',
                        'posts_per_page' => 3,
                        'category_name' => $group['category_select']['value'],
                        'order' => 'desc',
                    ];
                    $_posts = new WP_Query($args);

                    if ($_posts->have_posts()):
                        ?>
                        <?php while ($_posts->have_posts()):
                        $_posts->the_post();
                        $featured_image = get_the_post_thumbnail_url($_posts->ID, 'post-thumbnail'); ?>
                        <div class="col-md-4 rows-column">
                            <div class="img-wrap">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?= $featured_image; ?>" alt="<?php the_title(); ?>"/>
                        </a>
                            </div>
                            <div class="post-date">
                                <?php the_date('F j, Y'); ?>
                            </div>
                            <div class="post-title"><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <?php if (!empty($group["more_link"]["url"])): ?>
                    <div class="button">
                        <a href="#" class="load-more-news">More News</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<script>
    jQuery(document).ready(function ($) {
        var offset = 3; // Initial offset, as the first 3 posts are already displayed
        var category = '<?php echo $group['category_select']['value']; ?>';
        var total = <?php echo $total; ?>;

        jQuery('.more-news-section .load-more-news').on('click', function (e) {
            e.preventDefault();

            var button = jQuery(this);

            jQuery.ajax({
                url: "/wp-admin/admin-ajax.php",
                type: 'post',
                dataType: 'json',
                data: {
                    action: 'load_more_posts',
                    offset: offset,
                    category: category,
                },
                beforeSend: function () {
                    button.text('Loading...'); // Change button text to indicate loading
                },
                success: function (response) {
                    if (response.success) {
                        jQuery('.more-news-section .news-wrap').append(response.data.html);
                        offset += 3;
                        if (jQuery(document).find('.more-news-section .news-wrap .rows-column').length == total) {
                            button.remove(); // Remove the button if no more posts are available
                        } else {
                            button.text('More News'); // Restore button text
                        }
                    } else {
                        button.remove(); // Remove the button if no more posts are available
                    }
                },
            });
        });
    });

</script>
