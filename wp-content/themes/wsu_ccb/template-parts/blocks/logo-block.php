<?php $logos = get_field('logo_repeater');
if( !empty( $logos ) ): ?> 
    <div class="logo-section">
        <div class="container">
            <div class="row">
                <?php foreach($logos as $logo) { ?>
                    <div class="col-6 col-md logo-wrap">
                        <a href="<?= $logo['link']['url']?>" target="<?= $logo['link']['target'];?>">
                       <img src="<?= $logo['image']['url']?>" alt="<?= $logo['image']['alt']?>">
                       </a>
                    </div>
    
                <?php
                }
                ?>
                </div>
        </div>
    </div>
    <?php
    endif;
    ?>