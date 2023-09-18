<?php

$inc = rand(999, 111);
$args = get_field('media_group');
?>

<section class="featured-media">
	<div class="row">
		<div class="img-block">
			<img class="w-100 thumb_<?php echo $inc; ?>" src="<?php echo $args['image']['url']; ?>">
			<?php
			if (!empty($args['video_embed_url'])) {

				$link = $args['video_embed_url'];

				//echo getDomain($link); // outputs 'example.com'

				if (getDomain($link) == 'youtube.com') {
					$playicon = 'youtubeplayicon';
					$videoiconsrc = get_template_directory_uri() . '/assets/images/youtubeicon.png';
					$video_id = explode("?v=", $link); // For videos like http://www.youtube.com/watch?v=...
					if (empty($video_id[1]))
						$video_id = explode("/v/", $link); // For videos like http://www.youtube.com/watch/v/..
					$video_id = explode("&", $video_id[1]); // Deleting any other params
					$video_id = $video_id[0];
					?>
                        <a href="#" class="play-btn" type="<?php echo $playicon; ?>" data-id="<?php echo $inc; ?>">
                            <img class="playicon" src="<?php echo $videoiconsrc; ?>">
                        </a>
					<?php
				} elseif (getDomain($link) == 'vimeo.com') {
					$playicon = 'vimeoplayicon';
					$videoiconsrc = get_template_directory_uri() . '/assets/images/youtubeicon.png';
					?>
                    <a href="#" class="play-btn" type="<?php echo $playicon; ?>" data-id="<?php echo $inc; ?>" >
                        <img class="playicon" src="<?php echo $videoiconsrc; ?>">
                    </a>
					<?php
				}


				?>


				<div class="wrapiframe" data-id="<?php echo $inc; ?>">
					<?php
					if (getDomain($link) == 'youtube.com') {
						?>
						<iframe data-id="<?php echo $inc; ?>" width="853" height="480" src="https://www.youtube.com/embed/<?php echo $video_id; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					<?php } elseif (getDomain($link) == 'vimeo.com') {
						
						?>
						<iframe data-id="<?php echo $inc; ?>" src="https://player.vimeo.com/video/<?php echo (int) substr(parse_url($link, PHP_URL_PATH), 1); ?>?h=ba7556abf4" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
						<?php
					}

					?>
				</div>
				<?php
			}
			?>

		</div>
		<div class="d-flex flex-column justify-content-center">
			<?php
			if (!empty($args['subtitle'])) { ?>
				<h3 class="color-white"><?php echo $args['subtitle']; ?></h3>
				<?php
			}
			?>
			<?php if (!empty($args['link']['title'])) { ?>
				<a class="cta bg-darkpurple color-white" href="<?php if (!empty($args['link']['url'])) {
					echo $args['link']['url'];
				}  ?>"><?php
				if (!empty($args['link']['title'])) {
					echo $args['link']['title'];
				}  ?></a>
			<?php } ?>
		</div>
	</div>

</section>