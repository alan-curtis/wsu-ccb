<?php
/**
 * Template part for displaying news center content in page--blog.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WSU_CCB
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="news-featured-banner">
		<div class="container">
			<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
				<?php if(function_exists('bcn_display'))
				{
					bcn_display();
				}?>
			</div>
			<h1><?= the_title();?> </h1>
		</div>
			<?php get_template_part('template-parts/news/featured-banner'); ?>
		</div>
	</div>
	<div class="">
		<?php
		the_content();

		?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
