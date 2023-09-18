<?php if( !empty( get_field('faculty') ) ): 
    $arg = get_field('faculty'); ?> 

<div class="featured-faculty-section" id="<?= $arg['subnav_id']; ?>">
<div class="faculty-wrap">
<div class="events-bg" style="background:url('<?= $arg['bg_img']; ?>');">

</div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h2>
                    <?= $arg['title']; ?>
                </h2>
                <a class="featured-link" href="<?= $arg['featured_faculty_link']; ?>">
                <div class="featured-faculty">
                   <img src=" <?= $arg['featured_faculty_image']['url']; ?>" alt="<?= $arg['featured_faculty_image']['alt']; ?>">
                   <div class="featured-faculty--copy">
                   <p class="featured-faculty--name"><?= $arg['featured_faculty_name'];?></p>
                   <p class="featured-faculty--position"> <?= $arg['featured_faculty_position'];?></p>
                   </div>
                </div>
                </a>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <?php $faculty_sections = $arg['faculty_sub_department_repeater']; 
                        foreach($faculty_sections as $faculty_section) { ?>
                            <div class="col-12">
                                <h3>
                                <?= $faculty_section['faculty_sub_department']; ?>
                                </h3>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                   <?php $repeaters = $faculty_section['faculty_repeater'];
                                    foreach($repeaters as $repeater) { ?>
                                    <div class="col-lg-6 col-12">
                                        <a href="<?= $repeater['faculty_link'];?>">
                                        <div class="faculty">
                                            <img src="<?= $repeater['faculty_image']['url']; ?>" alt="<?= $repeater['faculty_image']['alt']; ?>">
                                            <div class="faculty--copy align-self-lg-center">
                                           <p class="faculty--name"><?= $repeater['faculty_name'];?></p> 
                                            <p class="faculty--position"> <?= $repeater['faculty_position'];?></p> 
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php   }?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php endif; ?>