<?php if( !empty( get_field('accordion') ) ): 
$accordion_group = get_field('accordion'); ?>

<div class="accordion-repeater-section" id="<?= $accordion_group['subnav_id']; ?>">
    <div class="container">

    
    <div class="row">
        <div class="col-lg-7 col-12 order-2 order-lg-1">
        <div class="col-12">
        <h2><?=$accordion_group['title']; ?></h2>
        <div class="copy">
        <?=$accordion_group['copy']; ?>
        </div>
    </div>
      <?php  $accordion_section = $accordion_group['accordion_section_repeater'] ?>



      <?php  $i = 1; 
      foreach($accordion_section as $accordion_sections) { ?>

 
          <h3><?=  $accordion_sections['accordion_section_title'];?></h3>
        
        <div class="accordion-containers">
            <div class="accordion accordion-flush" id="accordionFlush">
            <?php $accordion = $accordion_sections['accordion_repeater'];
                ?>
            <?php foreach($accordion as $accordions) { ?>

                      <div class="accordion-item">
                            <div class="accordion-header" id="flush-heading-<?= $i; ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-<?= $i; ?>" aria-expanded="false" aria-controls="flush-collapse-<?= $i; ?>">
                            <?= $accordions['accordion_title'];?>
                            </button>
                            </div>
                            <div id="flush-collapse-<?= $i; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading-<?= $i; ?>" data-bs-parent="#accordionFlush">
                            <div class="accordion-body">
                                <span class="credits"> <?= $accordions['credits'] ?></span>
                                <span class="location-title">Locations</span>
                                <span class="locations"> 
                                    
                                    <?php
                                    $location = $accordions['locations'];
                                    foreach($location as $locations) { ?>
                                    <span class="location"> <?= $locations; ?></span>
                                  <?php  }?>
                                    </span>
                                    <div class="copy">
                                    <?= $accordions['accordion_copy']; ?>
                                    </div>
                               
                                <a href="<?= $accordions['accordion_link']['url'];?>" target="<?= $accordions['accordion_link']['target'];?>"><?= $accordions['accordion_link']['title'];?></a>
                            </div>
                            </div>
                        </div>

                    <?php  $i++;} ?>
                    
                </div>
            </div>


            <?php } ?>

            </div>
            <div class="offset-lg-1 col-lg-4 order-lg-2 order-1">
                <div class="research-cta">
                <h3><?=$accordion_group['cta_title']; ?></h3>
                <div class="copy">
                <?=$accordion_group['cta_copy']; ?>
                </div>
                <a href="<?=$accordion_group['cta_link']['url']; ?>" target="<?=$accordion_group['cta_link']['target']; ?>" class="red-btn btn"><?=$accordion_group['cta_link']['title']; ?></a>
                </div>
                <div class="callout">
                    <img src="<?=$accordion_group['callout_image']['url'];?>" alt="<?=$accordion_group['callout_image']['alt'];?>">
                    <div class="callout-copy">
                    <h3><?=$accordion_group['callout_title']; ?></h3>
                    <?=$accordion_group['callout_copy']; ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
                                    </div>
<?php endif; ?>