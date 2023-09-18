<div class="fullwidth-list-block-section">
    
    <?php $block = $args['fullwidth_list_block_repeater'];

if ( $block ) : 
 $numrows = 1; ?>
    <?php foreach ($block as $blocks ) :
       
        if( $numrows % 2 == 0 ){ ?>
        <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-2 content-wrap" >
            <div class="content-inner">
                <h3>
                    <?= $blocks['title']; ?>
                </h3>
                <div class="copy">
                    <?= $blocks['copy']; ?>
                </div>
                <?php if (isset($blocks['link']['url'])): ?>
                <a href="<?= $blocks['link']['url']; ?>" target="<?=$blocks['link']['target'];?>">
                    <?= $blocks['link']['title'];?>   
                </a>
                <?php endif; ?>
                </div>
        </div>  
        <div class="col-12 col-md-6 px-0 order-1 order-md-2" >
            <div class="img-wrap" style="background: url('<?= $blocks['image']; ?>');">
            </div>
        </div> 
        </div>
                <?php } else { ?>
                    <div class="row">
        <div class="col-12 col-md-6 px-0 order-1 " >
            <div class="img-wrap" style="background: url('<?= $blocks['image']; ?>');">
            </div>
        </div>
        <div class="col-12 col-md-6 order-2 content-wrap" >
        <div class="content-inner">
            <div class="content-wrap">
                <h3>
                    <?= $blocks['title']; ?>
                </h3>
                <div class="copy">
                    <?= $blocks['copy']; ?>
                </div>
                <?php if (isset($blocks['link']['url'])): ?>
                <a href="<?= $blocks['link']['url']; ?>" target="<?=$blocks['link']['target'];?>">
                    <?= $blocks['link']['title'];?>   
                </a>
                <?php endif; ?>
                </div>

        </div>
        </div>
                </div>
                    <?php } ?>
        <?php $numrows++; endforeach; ?>
    <?php endif;?>

</div>