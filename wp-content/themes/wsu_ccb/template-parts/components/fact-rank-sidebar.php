<?php $fact = get_field('fact_rank_repeater');
if( !empty( $fact ) ): ?> 
<div class="facts-ranks-sidebar-section">
    
    <?php foreach ($fact as $facts ) : ?>

    <div class="col-md col-12 facts-ranks-wrap">
    <div class="borderLeft"></div>
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <span><?= $facts['rank']; ?></span>
            </div>
            <div class="col-md-12 copy">
                <?= $facts['copy']; ?>
                <?php if( !empty( $facts['citation'] ) ): ?>
                <a href="<?= $facts['citation']['url']; ?>" target="<?= $facts['citation']['target']; ?>" class="citation"> <?= $facts['citation']['title']; ?></a>
            <?php endif; ?>
            </div>
        </div>
    </div>

    <?php endforeach; ?>
    
</div>
<?php endif; ?>