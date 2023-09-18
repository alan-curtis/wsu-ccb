<?php $banner = $args['banner_cta']; 

if ($banner['banner_alignment'] == 'Center') {
	$i = 4;

}
if ($banner['banner_alignment'] == 'Right') {
	$i = 8;

}
if ($banner['banner_color'] == 'Red') {
	$j =  ", #A60F2D";

}
if ($banner['banner_color'] == 'None') {
	$j =  "";

}
?>
<div class="banner-cta-section" style="background: url('<?= $banner['image']; ?>')<?= $j;?>;">
    <div class="container">
        <div class="row content-height align-items-center">
            <div class="col-lg-4 offset-lg-<?= $i; ?>">
            <div class="content-wrap">
            <h3>
                <?= $banner['title']; ?>
            </h3>
            <div class="copy">
                <?= $banner['copy']; ?>
            </div>
            <div class="row">
            <?php if( !empty( $banner['button'] ) ): ?>
                <div class="col-6">
                    
                    <a href="<?= $banner['button']['url']; ?>" target="<?= $banner['button']['target'];?>"class="red-btn btn">
                    <?= $banner['button']['title']; ?>  
                </a>
                </div>
                <?php endif;?>
                
                <?php if( !empty( $banner['Button_2'] ) ): ?>
                <div class="col-6">
                    <a href="<?= $banner['Button_2']['url']; ?>" target="<?= $banner['Button_2']['target'];?>"class="grey-btn btn">
                        <?= $banner['Button_2']['title']; ?>  
                    </a>
                </div>
                <?php endif;?>
            </div>
            </div>
            </div>
        </div>
    </div>
</div>