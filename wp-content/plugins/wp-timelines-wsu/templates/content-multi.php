<?php
global $ID,$style, $post, $posttype,$show_media ,$show_label , $taxonomy, $number_excerpt, $full_content, $hide_thumb,$img_size,$back_p;
$thumb_size = $img_size!='' ? $img_size : 'wptl-600x450';
$custom_link = wpex_custom_link($back_p);
$bg_style = '';
if($style=='3'){
	$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' );
	$bg_style = isset($image_src[0]) ? ' background-image:url('.$image_src[0].');' :'';
}
$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' );
if($full_content=='1' || $full_content=='lightbox'){
    $no_link = 'javascript:;';
    $custom_link = apply_filters( 'wptl_link_in_fullcontent', $no_link, $custom_link);
}
?>
<div <?php post_class(ex_wptl_lightbox($full_content,$ID,'class'));?> id="wpextt_content-<?php echo get_the_ID();?>" style=" <?php echo extl_dataes($bg_style);?>" <?php echo ex_wptl_lightbox($full_content,$ID,'data'); ?>>
	<?php ex_wptl_lightbox($full_content,$ID,''); ?>
    <div class="wpex-timeline-label">
        <?php 
		if($hide_thumb!='1' && $style!='3'){
			if($show_media=='1' && wptl_audio_video_iframe()!='<div class="wptl-embed"></div>'){
					echo '<div class="timeline-media">'.wptl_audio_video_iframe().'</div>';
				}elseif(has_post_thumbnail(get_the_ID())){?>
				<div class="timeline-media">
					<a href="<?php echo extl_dataes($custom_link);?>" title="<?php the_title_attribute();?>">
					<?php the_post_thumbnail($thumb_size);?>
					<span class="bg-opacity"></span>
					</a>
				</div>
			<?php }
		}
		?>
        <div class="timeline-details">
        	<h2>
                <a href="<?php echo extl_dataes($custom_link);?>" title="<?php the_title_attribute();?>">
					<?php the_title()?>
                </a>
            </h2>
            <?php 
			if($style=='3' && $show_media=='1' && wptl_audio_video_iframe()!='<div class="wptl-embed"></div>'){
				echo '<div class="timeline-media">'.wptl_audio_video_iframe().'</div>';
			}
			if($posttype != 'wp-timeline' && preg_replace('/\s+/', '', wptl_show_cat($posttype, $taxonomy))!=''){?>
            <div class="wptl-more-meta">
            	<?php echo wptl_show_cat($posttype, $taxonomy);?>
            </div>
            <?php }else{
				if($show_label==1){
					$wpex_sublabel = wpex_date_tl();
					$wpex_sublabel = $wpex_sublabel !='' ? '<i class="fa fa-calendar"></i>'.$wpex_sublabel : '';
				}else{
					$wpex_sublabel = get_post_meta( get_the_ID(), 'wpex_sublabel', true );
				}if($wpex_sublabel!=''){?>
            		<div class="wptl-more-meta"><span><?php echo extl_dataes($wpex_sublabel,true);?></span></div>
            <?php }
			}?>
            <div class="wptl-excerpt">
				<?php 
				if($full_content=='1' && $hide_thumb!='1' && $show_media=='1'){
					$content =  preg_replace ('#<embed(.*?)>(.*)#is', ' ', get_the_content(),1);
					$content =  preg_replace ('@<iframe[^>]*?>.*?</iframe>@siu', ' ', $content,1);
					$content =  preg_replace ('/<source\s+(.+?)>/i', ' ', $content,1);
					$content =  preg_replace ('/\<object(.*)\<\/object\>/is', ' ', $content,1);
					$content =  preg_replace ('#\[video\s*.*?\]#s', ' ', $content,1);
					$content =  preg_replace ('#\[audio\s*.*?\]#s', ' ', $content,1);
					$content =  preg_replace ('#\[/audio]#s', ' ', $content,1);
					preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $content, $match);
					foreach ($match[0] as $amatch) {
						if(strpos($amatch,'soundcloud.com') !== false){
							$content = str_replace($amatch, '', $content);
						}elseif(strpos($amatch,'youtube.com') !== false){
							$content = str_replace($amatch, '', $content);
						}
					}
					$content = preg_replace('%<object.+?</object>%is', '', $content,1);
					echo apply_filters('the_content',$content);
				}elseif($full_content=='1'){
					echo apply_filters('the_content', get_the_content());
				}else if($number_excerpt!='0'){
					echo wp_trim_words(get_the_excerpt(),$number_excerpt,$more = '...');
				}?>
            </div>
            <?php 
			if($full_content!='1' && $custom_link!='#'){?>
            <div class="wptl-readmore"><a href="<?php echo extl_dataes($custom_link);?>" title="<?php the_title_attribute();?>"><?php echo exwptl_get_option('exwptl_text_ct','exwptl_advanced_options')!='' ? exwptl_get_option('exwptl_text_ct','exwptl_advanced_options') : esc_html__('Continue reading','wp-timeline');?></a></div>
            <?php }?>
        </div>
        <div class="exclearfix"></div>
    </div>
</div>