<div class="container card-section">
<div class="col-12 title">
        <?= $args['title']?>
    </div>

<div class="row">
<?php $cta_card = $args['cta_card_repeater'];

if ( $cta_card ) : 
 $numrows = count( $cta_card ); ?>
    <?php foreach ($cta_card as $cta_cards ) :
       
        if( $numrows % 2 == 0 ){ ?>
        <div class="col-md col-6 mt-2 px-1 px-md-3" >
            <div class="card-wrap">
                <div class="cta-title">
                    <?= $cta_cards['title']; ?>
                </div>
                <div class="copy">
                    <?= $cta_cards['copy']; ?>
                </div>
                <a href="<?= $cta_cards['link']['url']; ?>" target="<?=$cta_cards['link']['target'];?>"class="red-btn btn">
                    <?= $cta_cards['link']['title'];?>   
                </a>
                </div>
        </div>   

                <?php } else { ?>

        <div class="col-md col-12" >
        <div class="card-wrap">
                <div class="cta-title">
                    <?= $cta_cards['title']; ?>
                </div>
                <div class="copy">
                    <?= $cta_cards['copy']; ?>
                </div>
                <a href="<?= $cta_cards['link']['url']; ?>" target="<?=$cta_cards['link']['target'];?>"class="red-btn btn">
                    <?= $cta_cards['link']['title'];?>   
                </a>
                </div>
                </div>
                    <?php } ?>
        <?php endforeach; ?>
    <?php endif;?>
    </div>
</div>