<?php
/**
 * Template part for displaying resource page content in page--resources.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WSU_CCB
 */

?>
<?php if(get_field('sidebar') ){

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
        <div class="accordion-image">
		<div class="row">
		<div class="col-lg-7 order-2 order-lg-1">
			<div class="entry-content">
			<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wsu_ccb' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->
		</div>
		<div class="col-lg-5 ps-md-5 order-1 order-lg-2">
			<?php get_template_part( 'template-parts/components/fact-rank-sidebar'); ?>
		</div>
		</div>
        </div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->

<?php } else { ?>


	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="container breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
		<?php if(function_exists('bcn_display'))
		{
			bcn_display();
		}?>
	</div>
	<header class="entry-header container">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<div class="entry-content container">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wsu_ccb' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->

	<?php } ?>