<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WSU_CCB
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/blocks/hero' );
			get_template_part( 'template-parts/content', 'page' );



			// ACF - Flexible Content fields.
			$sections = get_field( 'wsu_page_sections' );

			if ( $sections ) :
				foreach ( $sections as $section ) :
					$template = str_replace( '_', '-', $section['acf_fc_layout'] );
					get_template_part( 'template-parts/blocks/' . $template, '', $section );
				endforeach;
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
