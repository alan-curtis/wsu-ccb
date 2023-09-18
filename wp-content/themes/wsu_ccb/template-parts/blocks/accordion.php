<?php
$title = $args['accordion_title'];
 $accordion = $args['accordion_repeater'];?>

<div class="accordion-section">
    <div class="accordion-wrap">
    <?php

if( !empty( $accordion['bg_image'] ) ): ?>
    <div class="events-bg" style="background:url('<?= $accordion['bg_image']; ?>');">
    </div>
 <?php endif; ?>
    <div class="container">
        <div class="accordion-content">
        <h3><?=$title; ?></h3>

    
    <div class="row">
        <div class="col-md-7">
        <div class="accordion-containers">
            <div class="accordion accordion-flush" id="accordionFlush">
                <?php $i = 1; ?>
            <?php foreach($accordion as $accordions) { ?>

                      <div class="accordion-item">
                            <div class="accordion-header" id="flush-heading-<?= $i; ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-<?= $i; ?>" aria-expanded="false" aria-controls="flush-collapse-<?= $i; ?>">
                            <?= $accordions['title'];?>
                            </button>
                            </div>
                            <div id="flush-collapse-<?= $i; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading-<?= $i; ?>" data-bs-parent="#accordionFlush">
                            <div class="accordion-body">
                                <?= $accordions['copy']; ?>
                            </div>
                            </div>
                        </div>

                    <?php $i++; } ?>
                    
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    </div>