<?php $fact = $args['fact_rank_repeater'];?>
<div class="container facts-ranks-section">
    <div class="row justify-content-center">
    <?php foreach ($fact as $facts ) : ?>

    <div class="col-md col-12 facts-ranks-wrap">
    <div class="borderLeft"></div>
        <div class="row justify-content-center">
            <div class="col-md-12 col-5">
                <span><?= $facts['rank']; ?></span>
            </div>
            <div class="col-md-12 col-7 copy">
                <?= $facts['copy']; ?>
                <?php if( !empty( $facts['citation'] ) ): ?>
                <a href="<?= $facts['citation']['url']; ?>" target="<?= $facts['citation']['target']; ?>" class="citation"> <?= $facts['citation']['title']; ?></a>
            <?php endif; ?>
            </div>
        </div>
    </div>

    <?php endforeach; ?>
    </div>
</div>