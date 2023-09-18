<?php 
global $ID;
$idcss = 'extl-lb-'.get_the_ID().''.$ID;
$we_eventcolor = get_post_meta( get_the_ID(), 'we_eventcolor', true );
 ?>
<div class="extl-lightbox-info" id="<?php echo esc_attr($idcss);?>">
	<div class="lb-image">
        <?php
        if(ex_wptl_image_gallery(true)!=''){ 
            echo ex_wptl_image_gallery_lb();
        }else{
            the_post_thumbnail('full'); 
        }
        ?>
    </div>
    <div class="lb-info">
        <h3 class="lb-title"><?php the_title(); ?></h3>
        <?php
        echo '<span><i class="fa fa-calendar"></i>'.wpex_date_tl().'</span>';
        if(exwptl_get_option('exwptl_disable_social','exwptl_advanced_options')!='yes'){?>
        	<div class="wpex-social-share"><?php  echo wptl_social_share();?></div>
        <?php }?>
        <div class="exp-lightbox-meta"></div>
        <div class="extl-lb-content"><?php 
        if(function_exists('do_blocks')){
            $content_post = get_post(get_the_ID());
            $content = $content_post->post_content;
            $content = apply_filters('the_content', $content);
            echo apply_filters('the_content',(do_blocks($content)));
        }else{
            the_content();
        }
        ?></div>
    </div>
    <?php 
    if($we_eventcolor!='' ){
        ?>
        <style type="text/css">
            #<?php echo esc_attr($idcss)?> .lb-info h3.lb-title:after{ border-color: <?php echo esc_attr($we_eventcolor);?> }
        </style>
        <?php
    }
    ?>
</div>