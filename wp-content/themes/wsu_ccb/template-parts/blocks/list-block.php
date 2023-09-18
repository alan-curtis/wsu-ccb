<?php  $list = $args['list_block_repeater']; ?>
<div class="list-block-section">
    <div class="container">
        <div class="col-lg-7 section-wrap">
            <div class="section-block">
                <?php
                if ( $list ) :
                    foreach ($list as $lists ) :
                        ?>
                        <div class="list-block">
                            <div class="image" style="background: url('<?=  $lists['image']['url'];?>'); background-repeat: no-repeat;" ></div>
                            <div class="body">
                                <div class="title">
                                    <h3><?= $lists['title']; ?> </h3>
                                </div>
                                <div class="description">
                                    <p><?= $lists['copy']; ?></p>
                                </div>
                                <div class="link">
                                <a href="<?= $lists['link']['url'];?>" target="<?= $lists['link']['target']; ?>"><?= $lists['link']['title']; ?></a>
                                </div>
                            </div>
                        </div>
                    <?php // End loop.
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </div>
</div>