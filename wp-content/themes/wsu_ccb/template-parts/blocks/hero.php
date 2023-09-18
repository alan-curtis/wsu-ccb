<?php
$carousel_height = get_field('carousel_height');
$heightAuto = ($carousel_height == 'auto') ? 'true' : 'false';
$inlineStyle = '';
$helperClasses = '';
$videoTagHeight = '';
if($carousel_height != 'auto'){
    $inlineStyle = "style= height:{$carousel_height};margin-bottom:30px;";
    $helperClasses = 'fixed-height';
    $videoTagHeight = 'height="'.str_replace("px","",$carousel_height).'"';
}
?>
<script type="text/javascript">
    window.hero_carousel_height_auto = <?php echo $heightAuto;?>;
   /* jQuery(document).ready(function( $ ) {
    var owl = $('.hero--section');
    owl.owlCarousel({
    items: 1,
    loop:true,
    autoplay:true,
    autoplayTimeout:8000,
    autoplayHoverPause:true,
    dots: false
});
});*/
</script>
<div class="container">

<?php if( have_rows('carousel_slide') ): ?>
    <div class="hero--section <?php echo $helperClasses?>" <?php echo $inlineStyle?>>
      <div id="hero-carousel" class="owl-carousel owl-theme owl-loaded hero-video" <?php echo $inlineStyle?>>
        <div class="owl-stage-outer">
          <div class="owl-stage">
          <?php while ( have_rows('carousel_slide') ) : the_row();
            $formatSupported = array('mp4', 'webm', 'ogv');
            $slide_type = get_sub_field('carousel_slide_type');
            $video_url= get_sub_field('carousel_slide_youtube');
            $carousel_image= get_sub_field('carousel_slide_image');
            $carousel_video_url = '';
            $carousel_video_url_type = '';

            foreach ($formatSupported as $videoFormat) {
                $vidUrl = get_sub_field("carousel_slide_video_url_{$videoFormat}");
                if($vidUrl !== '') {
                    $carousel_video_url = $vidUrl;
                    $carousel_video_url_type = $videoFormat;
                    break;
                }
            }
            if($slide_type == 'video'){
                foreach ($formatSupported as $videoFormat) {
                    $vidUrl = get_sub_field("carousel_slide_video_{$videoFormat}");
                    if($vidUrl !== '') {
                        $carousel_video_url = $vidUrl['url'];
                        $carousel_video_url_type = $videoFormat;
                        $slide_type = 'video_url';
                        break;
                    }
                }
                $vidPoster = get_sub_field("carousel_slide_video_poster_image") ? 'poster="' . get_sub_field("carousel_slide_video_poster_image") . '"' : '';
            }
            if($slide_type == 'youtube' && !empty($video_url)):
              ?>
                <div class="owl-item">
                    <div class="videoWrapper" style="height: <?php echo $carousel_height?>">
                        <?php echo $video_url?>
                    </div>
                </div>
            <?php elseif ($slide_type == 'image' && !empty($carousel_image)):
              $title = get_sub_field('carousel_slide_title');
              $sliderUrl = get_sub_field('carousel_slide_url');
              $description = get_sub_field('carousel_slide_subtitle');
              ?>
              <div class="owl-item">
                <img class="hero-image" src="<?php echo $carousel_image; ?>" alt="<?php echo $title?>" <?php echo $videoTagHeight?>>
                  <?php if($title !== '' || $description !== ''): ?>
                    
                    <?php if($title !== '' || $description !== ''): ?>
                      <div class="hero-content">
                        <?php endif; ?>

                    <?php if($title !== '' ): ?>
                      <h1><?php echo $title?></h1>
                      <?php endif; ?>

                    <?php if($description !== ''): ?>
                      <p class="slide-desc">
                        <?php echo $description; ?>
                    </p>
                      <?php endif; ?>
                      <?php 
                      if( $sliderUrl !== '' ): 
                        $link_url = $sliderUrl['url'];
                        $link_title = $sliderUrl['title'];
                        $link_target = $sliderUrl['target'] ? $sliderUrl['target'] : '_self';
                        ?>
                        <a class="red-btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                      
                      


                    <?php if($title !== '' || $description !== '' || $slideUrl !==''): ?>
                    </div>
                    <?php endif; ?>

                    
                <?php endif;?>
              </div>
                <?php elseif ($slide_type == 'video_url' && !empty($carousel_video_url) ):
                $title = get_sub_field('carousel_slide_title');
                $sliderUrl = get_sub_field('carousel_slide_url');
                $description = get_sub_field('carousel_slide_subtitle');
                ?>
                <div class="owl-item type-video owl-video">
                  <video class="hero-video" muted="muted" loop="loop" autoplay="autoplay" id="player" <?php echo $videoTagHeight?> <?php echo $vidPoster; ?>>
                      <source src="<?php echo $carousel_video_url?>" type="video/<?php echo $carousel_video_url_type?>">
                      Your browser does not support the video tag.
                  </video>
                  <?php if($title !== '' || $description !== ''):?>
                
                    <?php if($title !== '' || $description !== ''): ?>
                      <div class="hero-content">
                        <?php endif; ?>

                    <?php if($title !== '' ): ?>
                      <h1><?php echo $title?></h1>
                      <?php endif; ?>
                    <?php if($description !== ''): ?>
                      <p class="slide-desc">
                        <?php echo $description; ?>
                    </p>
                      <?php endif; ?>

                      <?php 
                      if( $sliderUrl !== '' ): 
                        $link_url = $sliderUrl['url'];
                        $link_title = $sliderUrl['title'];
                        $link_target = $sliderUrl['target'] ? $sliderUrl['target'] : '_self';
                        ?>
                        <a class="red-btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                      
                      


                    <?php if($title !== '' || $description !== '' || $slideUrl !==''): ?>
                    </div>
                    <?php endif; ?>

                  <?php endif; ?>
                    <div id="carouselButtons">
                      <button id="playButton" type="button" class="btn btn-default btn-xs pause-btn">
                          <span class="glyphicon glyphicon-pause"></span>
                      </button>
                      <button id="pauseButton" type="button" class="btn btn-default btn-xs play-btn d-none">
                          <span class="glyphicon glyphicon-play"></span>
                      </button>
                    </div>
              </div>

            <?php endif;
          endwhile; ?>

          </div>
        </div>
        <div id="custom-controls-container">
                <button id="playControl" type="button" class="btn btn-default btn-xs pause-btn">
                    <span class="glyphicon glyphicon-pause"></span>
                </button>
                <button id="pauseControl" type="button" class="btn btn-default btn-xs play-btn d-none">
                    <span class="glyphicon glyphicon-play"></span>
                </button>
              </div>
      </div>
    </div>
<?php endif; ?>
</div>