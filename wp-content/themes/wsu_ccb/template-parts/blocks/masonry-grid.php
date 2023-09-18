<div class="masonry-section">
<div class="masonry-title">
    <h1>
        <?= get_field('title');?>
    </h1>
</div>
<?php 
    $group_1 = get_field('image_group_1');
    $group_2 = get_field('image_group_2');
    $group_3 = get_field('image_group_3');
    $group_4 = get_field('image_group_4');
    $group_5 = get_field('image_group_5');
    $group_6 = get_field('image_group_6');
    $group_7 = get_field('image_group_7');
?>
<div class="row content-items" data-masonry='{"percentPosition": true }'>
    <div class="col-lg-3 col-md-4 col-6 px-2 item item--height2">
    <?php if( $group_1 ):
            if( $group_1['social_select'] == 'twitter' ): { ?>
                <div class="twitter-group">
                    <span sr-only="twitter icon" class="fa-brands fa-twitter"></span>
                    <?= $group_1['twitter_copy'];?>
                </div>

            <?php } ?>
            <?php elseif($group_1['social_select'] == 'instagram' ):{ ?>
                <div class="group-img-wrap" style="background: url('<?= $group_1['image'] ?>');">
                    <span sr-only="instagram icon" class="fa-brands fa-instagram"></span>
                    <div class="group-content">
                        <a href="<?= $group_1['link']['url'] ?>" target="<?= $group_1['link']['target'] ?>"> <?= esc_html($group_1['link']['title'] );?> </a>
                    </div>
                </div>
            <?php }?>
            <?php else:{ ?>
                <div class="group-img-wrap">
                    <img src="<?= $group_1['image'] ?>" alt="">
                    <div class="group-content">
                        <a href="<?= $group_1['link']['url'] ?>" target="<?= $group_1['link']['target'] ?>"> <?= esc_html($group_1['link']['title'] );?> </a>
                    </div>
                </div>

            <?php } endif;
        endif; ?>
    </div>

    <div class="col-lg-3 col-md-4 col-6 px-2 item item--height3">
    <?php if( $group_3 ):
            if( $group_3['social_select'] == 'twitter' ): { ?>
                <div class="twitter-group">
                    <span sr-only="twitter icon" class="fa-brands fa-twitter"></span>
                    <?= $group_3['twitter_copy'];?>
                </div>

            <?php } ?>
            <?php elseif($group_3['social_select'] == 'instagram' ):{ ?>
                <div class="group-img-wrap" style="background: url('<?= $group_3['image'] ?>');">
                    <span sr-only="instagram icon" class="fa-brands fa-instagram"></span>
                    <div class="group-content">
                        <a href="<?= $group_3['link']['url'] ?>" target="<?= $group_3['link']['target'] ?>"> <?= esc_html($group_3['link']['title'] );?> </a>
                    </div>
                </div>
            <?php }?>
            <?php else:{ ?>
                <div class="group-img-wrap">
                    <img src="<?= $group_3['image'] ?>" alt="">
                    <div class="group-content">
                        <a href="<?= $group_3['link']['url'] ?>" target="<?= $group_3['link']['target'] ?>"> <?= esc_html($group_3['link']['title'] );?> </a>
                    </div>
                </div>

            <?php } endif;
        endif; ?>
    </div>

    <div class="col-lg-3 col-md-4 col-6 px-2 item item--height2">
    <?php if( $group_4 ):
            if( $group_4['social_select'] == 'twitter' ): { ?>
                <div class="twitter-group">
                    <span sr-only="twitter icon" class="fa-brands fa-twitter"></span>
                    <?= $group_4['twitter_copy'];?>
                </div>

            <?php } ?>
            <?php elseif($group_4['social_select'] == 'instagram' ):{ ?>
                <div class="group-img-wrap" style="background: url('<?= $group_4['image'] ?>');">
                    <span sr-only="instagram icon" class="fa-brands fa-instagram"></span>
                    <div class="group-content">
                        <a href="<?= $group_4['link']['url'] ?>" target="<?= $group_4['link']['target'] ?>"> <?= esc_html($group_4['link']['title'] );?> </a>
                    </div>
                </div>
            <?php }?>
            <?php else:{ ?>
                <div class="group-img-wrap">
                    <img src="<?= $group_4['image'] ?>" alt="">
                    <div class="group-content">
                        <a href="<?= $group_4['link']['url'] ?>" target="<?= $group_4['link']['target'] ?>"> <?= esc_html($group_4['link']['title'] );?> </a>
                    </div>
                </div>

            <?php } endif;
        endif; ?>
    </div>

    <div class="col-lg-3 col-md-4 col-6 px-2 item">
    <?php if( $group_6 ):
            if( $group_6['social_select'] == 'twitter' ): { ?>
                <div class="twitter-group">
                    <span sr-only="twitter icon" class="fa-brands fa-twitter"></span>
                    <?= $group_6['twitter_copy'];?>
                </div>

            <?php } ?>
            <?php elseif($group_6['social_select'] == 'instagram' ):{ ?>
                <div class="group-img-wrap" style="background: url('<?= $group_6['image'] ?>');">
                    <span sr-only="instagram icon" class="fa-brands fa-instagram"></span>
                    <div class="group-content">
                        <a href="<?= $group_6['link']['url'] ?>" target="<?= $group_6['link']['target'] ?>"> <?= esc_html($group_6['link']['title'] );?> </a>
                    </div>
                </div>
            <?php }?>
            <?php else:{ ?>
                <div class="group-img-wrap">
                    <img src="<?= $group_6['image'] ?>" alt="">
                    <div class="group-content">
                        <a href="<?= $group_6['link']['url'] ?>" target="<?= $group_6['link']['target'] ?>"> <?= esc_html($group_6['link']['title'] );?> </a>
                    </div>
                </div>

            <?php } endif;
        endif; ?>
    </div>

    <div class="col-lg-3 col-md-4 col-6 px-2 item item--height2">
        <?php if( $group_7 ):
            if( $group_7['social_select'] == 'twitter' ): { ?>
                <div class="twitter-group">
                    <span sr-only="twitter icon" class="fa-brands fa-twitter"></span>
                    <?= $group_7['twitter_copy'];?>
                </div>

            <?php } ?>
            <?php elseif($group_7['social_select'] == 'instagram' ):{ ?>
                <div class="group-img-wrap" style="background: url('<?= $group_7['image'] ?>');">
                    <span sr-only="instagram icon" class="fa-brands fa-instagram"></span>
                    <div class="group-content">
                        <a href="<?= $group_7['link']['url'] ?>" target="<?= $group_7['link']['target'] ?>"> <?= esc_html($group_7['link']['title'] );?> </a>
                    </div>
                </div>
            <?php }?>
            <?php else:{ ?>
                <div class="group-img-wrap">
                    <img src="<?= $group_7['image'] ?>" alt="">
                    <div class="group-content">
                        <a href="<?= $group_7['link']['url'] ?>" target="<?= $group_7['link']['target'] ?>"> <?= esc_html($group_7['link']['title'] );?> </a>
                    </div>
                </div>

            <?php } endif;
        endif; ?>
    </div>

    <div class="col-lg-3 col-md-4 col-6 px-2 item item">
    <?php if( $group_2 ):
            if( $group_2['social_select'] == 'twitter' ): { ?>
                <div class="twitter-group">
                    <span sr-only="twitter icon" class="fa-brands fa-twitter"></span>
                    <?= $group_2['twitter_copy'];?>
                </div>

            <?php } ?>
            <?php elseif($group_2['social_select'] == 'instagram' ):{ ?>
                <div class="group-img-wrap" style="background: url('<?= $group_2['image'] ?>');">
                    <span sr-only="instagram icon" class="fa-brands fa-instagram"></span>
                    <div class="group-content">
                        <a href="<?= $group_2['link']['url'] ?>" target="<?= $group_2['link']['target'] ?>"> <?= esc_html($group_2['link']['title'] );?> </a>
                    </div>
                </div>
            <?php }?>
            <?php else:{ ?>
                <div class="group-img-wrap">
                    <img src="<?= $group_2['image'] ?>" alt="">
                    <div class="group-content">
                        <a href="<?= $group_2['link']['url'] ?>" target="<?= $group_2['link']['target'] ?>"> <?= esc_html($group_2['link']['title'] );?> </a>
                    </div>
                </div>

            <?php } endif;
        endif; ?>
    </div>

    <div class="col-lg-3 col-md-4 col-6 px-2 item">
    <?php if( $group_5 ):
            if( $group_5['social_select'] == 'twitter' ): { ?>
                <div class="twitter-group">
                    <span sr-only="twitter icon" class="fa-brands fa-twitter"></span>
                    <?= $group_5['twitter_copy'];?>
                </div>

            <?php } ?>
            <?php elseif($group_5['social_select'] == 'instagram' ):{ ?>
                <div class="group-img-wrap" style="background: url('<?= $group_5['image'] ?>');">
                    <span sr-only="instagram icon" class="fa-brands fa-instagram"></span>
                    <div class="group-content">
                        <a href="<?= $group_5['link']['url'] ?>" target="<?= $group_5['link']['target'] ?>"> <?= esc_html($group_5['link']['title'] );?> </a>
                    </div>
                </div>
            <?php }?>
            <?php else:{ ?>
                <div class="group-img-wrap">
                    <img src="<?= $group_5['image'] ?>" alt="">
                    <div class="group-content">
                        <a href="<?= $group_5['link']['url'] ?>" target="<?= $group_5['link']['target'] ?>"> <?= esc_html($group_5['link']['title'] );?> </a>
                    </div>
                </div>

            <?php } endif;
        endif; ?>
    </div>
</div>
</div>