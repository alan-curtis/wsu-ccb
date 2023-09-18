<?php $video_group = get_field('video_modal');
 $repeaters = $video_group['numbered_section_repeater'];
 $i = 1;
if( $video_group ): ?>

 <div class="video-modal-section">
    <div class="video-wrap">

        <h3 class="title">
            <?= $video_group['title'];?>
        </h3>
        <div class="row">
        <?php
        foreach($repeaters as $repeater) { ?>
        <div class="col-2">
         <div class="number">
             <?= $i++;?>
        </div>  
        </div>
            <div class="col-10 vid-container">
            <i class="fa-regular fa-clock"></i>
               <span class="duration"> <?= $repeater['duration']; ?></span>
                <p class="section-title"><?= $repeater['title']; ?></p>
              <div><?= $repeater['copy']; ?></div>
              <?php  $links = $repeater['link_repeater']; ?>
           <?php if(!empty( $links )): ?> 
            <div class="row">
           <?php foreach($links as $link) {
            ?>
               
                    <div class="col-md-6 col-12">
                        <a href="<?= $link['link']['url'];?>"> <?= $link['link']['title'];?></a>
                    </div>
                
            <?php } ?> 
            </div>
            <?php endif; ?>
            <?php $vid = $repeater['video_link']; ?>
                <?php if(!empty( $vid )): ?> 
                    <button 
                    type="button" data-bs-toggle="modal" data-src="<?= $vid['url']; ?>" data-bs-target="#Modal" class="btn red-btn video-btn" href="<?= $vid['url'] ?>"><?= $vid['title']; ?></button>
                    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">

                    
                    <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
                        </button>        
                        <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                    <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>
                        
        
                 </div>
                </div>
            </div>
            </div> 
                <?php endif; ?>
            </div>

            <?php }?>
        </div>
    </div>

                </div>
 <?php endif; ?>