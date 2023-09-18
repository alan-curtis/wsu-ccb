<?php

if( !empty( get_field('secondary_nav_repeater') ) ): 
$navs = get_field('secondary_nav_repeater');
$info = get_field('department_info');?> 
<div class="secondary-nav-section">
    <div class="container  desktop">
        <div class="row">
            <?php foreach($navs as $nav) { ?>
                <div class="col">
                    <a href="<?= $nav['link']['url'];?>" target="<?= $nav['link']['target'];?>"><?= $nav['link']['title'];?></a>
                </div>

            <?php
            }
            ?>
            </div>
    </div>
</div>
<div class="department-info-section--mobile">
    <div class="container mobile">
        <div class="row">
            <div class="col-7 dept-info--wrap">
           <p class="title"><?= $info['department_title'];  ?></p>
            <?= $info['address'];  ?>
            <a href="mailto:<?= $info['email'];?>"><?= $info['email'];?></a>
            <a href="tel:<?= $info['phone'];?>"><?= $info['phone'];?></a>
            <a href="tel:<?= $info['fax'];?>">Fax: <?= $info['fax'];?></a>
            </div>
            <div class="col-5 secondary">
            <?php foreach($navs as $nav) { ?>
                <div class="col subnav-item">
                    <a href="<?= $nav['link']['url'];?>" target="<?= $nav['link']['target'];?>"><?= $nav['link']['title'];?></a>
                </div>

            <?php
            }
            ?>
            </div>
        </div>
    </div>
</div>



<div class="department-info-section" id="<?= $info['subnav_id']; ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-12">
                <h2><?= $info['about_title'];  ?></h2>
                <?= $info['about_copy'];  ?>
            </div>
            <div class="offset-md-1 col-4 desktop dept-info">
                <div class="dept-info--wrap">
           <p class="title"><?= $info['department_title'];  ?></p>
            <?= $info['address'];  ?>
            <a href="mailto:<?= $info['email'];?>"><?= $info['email'];?></a>
            <a href="tel:<?= $info['phone'];?>"><?= $info['phone'];?></a>
            <a href="tel:<?= $info['fax'];?>">Fax: <?= $info['fax'];?></a>
            </div>
            </div>
        </div>
    </div>
</div>






<?php endif; ?>
