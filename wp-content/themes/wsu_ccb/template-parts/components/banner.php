<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );  ?>
<div class="banner-section" style="background: url('<?= $image[0]?>'), #A60F2D;">
    <div class="container">
		<div class="row align-items-end banner-inner">
		<div class="col-12">
			<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
					<?php if(function_exists('bcn_display'))
					{
						bcn_display();
					}?>
			</div>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
		</div>
		</div>
    </div>
</div>
