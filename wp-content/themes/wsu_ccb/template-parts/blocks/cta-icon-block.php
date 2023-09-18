
<?php 

if( !empty( get_field( 'icon_block_repeater' ) ) ): 
    $list = get_field( 'icon_block_repeater' );
  ?>

<div class="icon-block-section">
    <div class="container">
        <div class="row align-items-center icon-block-wrap">
            <?php
                // Loop through rows.
                $numrows = count( get_field( 'icon_block_repeater' ) );
                while( have_rows('icon_block_repeater') ) : the_row();
                $cta_image = get_sub_field('image');
                $cta = get_sub_field('link');
                $cta_url = $cta['url'];
                $cta_title = $cta['title'];
                $cta_target = $cta['target'] ? $cta['target'] : '_self';
                ?>
                <?php if( $numrows % 2 == 0 ){ ?>
                <div class="col-md col-6 icon-block-container" >
                <a href="<?= $cta_url; ?>" target="<?= $cta_target;?> ">
                    <div class="icon-wrap"> 
                        <img src="<?= $cta_image['url']; ?>" alt="<?= $cta_image['alt']; ?>">            
                    </div>
                    <div class="btn-container">      
                            <?= $cta_title;?>   
                    </div>
                    </a>  
                </div>
                    <?php } else {?>
                        <div class="col-md col-12 icon-block-container" >
                <a href="<?= $cta_url; ?>" target="<?= $cta_target;?> ">
                    <div class="icon-wrap"> 
                        <img src="<?= $cta_image['url']; ?>" alt="<?= $cta_image['alt']; ?>">            
                    </div>
                    <div class="btn-container">      
                            <?= $cta_title;?>   
                    </div>
                    </a>  
                </div>

                <?php }// End loop.
                endwhile;
            ?>
        </div>
    </div>
</div>
<?php endif; ?>