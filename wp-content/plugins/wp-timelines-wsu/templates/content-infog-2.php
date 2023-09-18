<?php
global $style, $post, $ajax_load, $ID, $animations,$posttype,$show_media, $taxonomy,$full_content,$feature_label,$lightbox,$hide_img,$img_size,$hide_title,$back_p;
if($img_size==''){ $img_size = 'wptl-320x220';}
$class = 'filter-'.$ID.'_'.get_the_ID();
if($animations!=''){
    $animations = ' scroll-effect';
}
if($ajax_load==1){ $class .=' de-active';}
$icon = get_post_meta( $post->ID, 'wpex_icon', true ) !='' ? get_post_meta( $post->ID, 'wpex_icon', true ) : 'fa-square no-icon';
$wpex_icon_img = get_post_meta( $post->ID, 'wpex_icon_img', true );
if($wpex_icon_img!=''){ $icon = $icon.' icon-img';}
$we_eventcolor = get_post_meta( $post->ID, 'we_eventcolor', true );
$custom_link = wpex_custom_link($back_p);
$wpex_felabel ='';
if($feature_label==1){
    $wpex_felabel = get_post_meta( $post->ID, 'wpex_felabel', true );
    if($posttype!='wp-timeline' && $wpex_felabel==''){
        global $year_post;
        if(!isset($year_post) || $year_post==''){
            $wpex_felabel = $year_post = get_the_date('Y');
        }elseif($year_post!= get_the_date('Y')){
            $wpex_felabel = $year_post = get_the_date('Y');
        }
    }
    if($wpex_felabel!=''){
        $class .=' wptl-feature';
    }
}
$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' );
$link_lb = '';
if($lightbox==1){
    $link_lb  = isset($image_src[0]) ? $image_src[0] : '';
}
if($full_content=='1' || $full_content=='lightbox'){
    $no_link = 'javascript:;';
    $custom_link = apply_filters( 'wptl_link_in_fullcontent', $no_link, $custom_link);
}
?>
<li <?php post_class($class.' exif-li '.ex_wptl_lightbox($full_content,$ID,'class'));?> <?php echo 'data-id="filter-'.$ID.'_'.get_the_ID().'"';?> <?php echo ex_wptl_lightbox($full_content,$ID,'data'); ?>>
    <div class="<?php echo esc_attr($animations);?> tl-ani">
        <?php ex_wptl_lightbox($full_content,$ID,''); ?>
        <div class="tlif-contai">
            <?php 
            $img_class = !has_post_thumbnail(get_the_ID()) ? 'exif-no-img' : '';
            ?>
            <div class="tlif-img <?php echo esc_attr($img_class);?>">
                <div class="tlef-date">
                    
                </div>
                <?php 
                if($show_media=='1' && wptl_audio_video_iframe()!='<div class="wptl-embed"></div>'){
                    echo '<div class="tlif-media">'.wptl_audio_video_iframe().'</div>';
                }elseif($show_media=='1' && ex_wptl_image_gallery()!=''){
                    echo '<div class="tlif-media">'.ex_wptl_image_gallery().'</div>';   
                }else if($hide_img!=1 && has_post_thumbnail(get_the_ID())){ ?>
                    <a href="<?php echo extl_dataes($link_lb!='' ? $link_lb : $custom_link);?>" title="<?php the_title_attribute();?>" class="tlif-img-link">
                        <?php the_post_thumbnail($img_size);?>
                    </a>
                <?php }?>
                <span class="tlif-icon">
                    <i class="fa <?php echo esc_attr($icon);?>"></i>
                </span>
                
            </div>
            <div class="tlif-content">
                <div class="tlif-details">
                    <div class="tlif-info">
                        <?php if($wpex_felabel!=''){
                            echo '<div class="extlif-felname"><span>'.$wpex_felabel.'</span></div>';
                        }?>
                        <h2 class="tlif-title">
                            <?php wpex_tmfulldate(1);?>
                            <?php 
                            if($hide_title!='1'){?>
                                <a href="<?php echo extl_dataes($custom_link);?>" title="<?php the_title_attribute();?>"><?php the_title();?></a>
                            <?php }?>

                        </h2>
                        <?php if((get_post_meta( get_the_ID(), 'wpex_sublabel', true )!='')){
                            echo '<div class="wptl-more-meta"><span>'.get_post_meta( get_the_ID(), 'wpex_sublabel', true ).'</span></div>';
                        }?>
                        <div class="tpif-des">
                            <?php  echo wptl_timeline_desc($full_content,$show_media); ?>
                        </div>
                        <?php 
                        $cat_html = wptl_show_cat($posttype, $taxonomy);
                        if($cat_html!=''){?>
                        <div class="wptl-more-meta">
                            <?php echo extl_dataes($cat_html);?>
                        </div>
                        <?php }?>
                        <?php if($full_content!=1 && $custom_link!='#'){?>
                        <div class="tlif-readmore">
                            <a href="<?php echo extl_dataes($custom_link);?>" title="<?php the_title_attribute();?>">
                                <?php echo exwptl_get_option('exwptl_text_ct','exwptl_advanced_options')!='' ? exwptl_get_option('exwptl_text_ct','exwptl_advanced_options') : esc_html__('Continue reading','wp-timeline');?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                        <?php }?>
                    </div>
                    <!-- End info  -->
                </div>
            </div>
        </div>
    </div>
    <?php if($we_eventcolor!=''|| $wpex_icon_img!=''){?>
        <style type="text/css">
        <?php if($wpex_icon_img!=''){?>
            #timeline-<?php echo esc_attr($ID);?> li.post-<?php the_ID();?> .tlif-icon .fa.no-icon:before{ background:url(<?php echo esc_url(wp_get_attachment_thumb_url( $wpex_icon_img ));?>); background-repeat: no-repeat; background-size: 100% auto; background-position: center;color: transparent;}
            <?php }
            if($we_eventcolor!=''){?>
                #timeline-<?php echo esc_attr($ID);?> li.post-<?php the_ID();?> .tlif-img span.tlif-icon,
                #timeline-<?php echo esc_attr($ID);?> .infogr-list > li.post-<?php the_ID();?> .tlif-content .tlif-info span.tll-date{color:<?php echo esc_attr($we_eventcolor);?>;}
                #timeline-<?php echo esc_attr($ID);?> li.post-<?php the_ID();?> .tlif-img span.tlif-icon,
                #timeline-<?php echo esc_attr($ID);?> li.post-<?php the_ID();?> .tlif-readmore a,
                #timeline-<?php echo esc_attr($ID);?> li.post-<?php the_ID();?> .tlif-media,
                #timeline-<?php echo esc_attr($ID);?> li.post-<?php the_ID();?> .extlif-felname span,
                #timeline-<?php echo esc_attr($ID);?> li.post-<?php the_ID();?>  .tlif-img a{border-color:<?php echo esc_attr($we_eventcolor);?>;}
                <?php 
            }?>
            
        </style>
    <?php } ?>
</li>