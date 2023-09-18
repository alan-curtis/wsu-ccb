<?php
/**
 * Template Name: Events
 **/
get_header();
?>
<main id="primary" class="site-main">

<?php
while ( have_posts() ) :
    the_post();
    get_template_part( 'template-parts/components/banner' );
    get_template_part( 'template-parts/content', 'event' );
endwhile; // End of the loop.
?>

</main><!-- #main -->

<?php
get_footer();