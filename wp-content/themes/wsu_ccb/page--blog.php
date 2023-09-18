<?php
/**
 * Template Name: News Center
 **/
get_header();
?>
<main id="primary" class="site-main">

<?php
while ( have_posts() ) :
    the_post();
    get_template_part( 'template-parts/content', 'news' );

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