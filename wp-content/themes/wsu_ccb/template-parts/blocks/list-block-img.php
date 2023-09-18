<?php  $banner = $args['list_repeater']; ?>
<div class="row list-block-section">
<?php
if ( $banner ) :
?>

                <?php
                    // Loop through rows.
                    foreach ($banner as $banners ) :
                    ?>
                    <div class="col-12 block-wrap">

                            <div class="img-wrap">
                            <?php //echo wp_get_attachment_image( $lists['image'], 'full' ); ?>
                            </div>

                            <div class="content-wrap">
                                <h3><?= $banners['title']; ?></h3>
                               <p><?= $banners['copy']; ?></p> 
                                <a href="<?= $banners['link']['url'];?>" target="<?= $banners['link']['target']; ?>"><?= $banners['link']['title']; ?></a>
                            </div>
                        </div>        

                    <?php // End loop.
                    endforeach;
                endif;
                ?>
                </div>