<div class="container cta-card-img-section">
<div class="col-12 title">
        <?= $args['title']?>
    </div>

<div class="row">
<?php $cta_card = $args['cta_card_img_repeater'];

if ( $cta_card ) : 
 $numrows = count( $cta_card ); ?>
    <?php foreach ($cta_card as $cta_cards ) :
       
        if( $numrows % 2 == 0 ){ ?>
        <div class="col-md col-6 card-inner" >
            <div class="img-wrap">
                <img src="<?= $cta_cards['image']['url']; ?>" alt="<?= $cta_cards['image']['alt']; ?>">
            
            </div>
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

        <div class="col-md col-12 mt-3 mt-md-0 px-0 px-md-3 card-inner">
        <div class="img-wrap">
            <div class="img-holder" style="background: url('<?=  $cta_cards['image']['url'];?>');"></div>
            
            </div>
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