<?php
/**
 * Template Name: Department
 **/
get_header();
?>
<main id="primary" class="site-main">

<?php
while ( have_posts() ) :
    the_post();
    get_template_part( 'template-parts/components/banner' );
    get_template_part( 'template-parts/components/secondary-nav' );
    get_template_part( 'template-parts/content', 'department' );
    get_template_part( 'template-parts/blocks/cta-icon-block' );

endwhile; // End of the loop.
?>

</main><!-- #main -->

<?php
get_footer();