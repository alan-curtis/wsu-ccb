<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WSU_CCB
 */

?>

</div><!-- #page -->
<?php
if (have_rows('footer', 'option')) {
  while (have_rows('footer', 'option')) {
    the_row();
    $footerlogo = get_sub_field('footer_logo');
    $footerlink = get_sub_field('footer_logo_link');
    $footerctas = get_sub_field('footer_ctas');
    $socialicons = get_sub_field('social_icons');
    $footermenucolumns = get_sub_field('footer_menu_columns');
    $footercopyright = get_sub_field('footer_copyright');
    $footer_bg_img = get_sub_field('footer_bg_img');
  }
}
?>

<!-- <div class="footer-bg" style="background-image: url('<?php echo $footer_bg_img; ?>');"></div> -->
<footer class="footer">
    <div class="footer__red-border"></div>

    <div class="footer__image">
        <img src="<?php echo $footer_bg_img; ?>" alt="" class="footer-bg">
    </div>
    <div class="container">
        <div class="row footer__logo-row">
            <div class="col-md-4 footer__logo-row--logo">
                <div class="footer__logo-image">
                  <?php
                  if (!empty($footerlogo)) {
                    ?>
                      <a href="<?php echo $footerlink ?>" target="_blank">
                          <img class="mx-auto mx-sm-0" src="<?php echo $footerlogo['url']; ?>" class="img-fluid"
                               alt="drglow-footer-logo">
                      </a>
                  <?php } ?>
                </div>
            </div>
            <div class="col-md-8 footer__logo-row--menu">
              <?php
              wp_nav_menu(
                array(
                  'theme_location' => 'menu-3',
                  'menu_id' => 'top-nav',
                )
              );
              ?>
            </div>
        </div>

        <!-- <div class="tabs-columns row footer-menu-columns">
            <div class="panel-group" id="accordion">
                <?php
        foreach ($footermenucolumns as $index => $columns) {
          $menuitemsobject = wp_get_nav_menu_items($columns['menu']);
          if (!empty($menuitemsobject)) {
            ?>
                        <div class="panel panel-default col-lg-3 col-md-4 col-12 col-sm-6 text-sm-left text-center">
                            <p class="smalltext text-sm-uppercase
                        <?php if ($index != 0) {
              echo 'collapsed';
            } ?>" data-toggle="collapse" data-parent="#accordion"
                               data-target="#collapse<?php echo $index; ?>" aria-expanded="<?php if ($index == 0) {
              echo 'true';
            } ?>"> <?php foreach ($menuitemsobject as $i => $menuitem_top) {
              if ($i == 0) {
                ?>
                                        <a class="smalltext text-sm-uppercase"
                                           href="<?php echo $menuitem_top->url; ?>"><?php echo $menuitem_top->title; ?></a>
                                        <?php
              }
            } ?>
                            </p>
                            <div id="collapse<?php echo $index; ?>"
                                 class="panel-collapse collapse <?php if ($index == 0) {
              echo 'show';
            } ?>">
                                <?php
            foreach ($menuitemsobject as $in => $menuitem) {
              if ($in != 0) {
                ?><p><a class="color-grey"
                                                href="<?php echo $menuitem->url; ?>"><?php echo $menuitem->title; ?></a>
                                        </p><?php }
            }
            ?>
                            </div>
                        </div>
                        <?php
          }
        } ?>
            </div>
        </div> -->

        <div class="default-columns row footer__menus">
            <div class="col-md-3 footer__menus--item">
              <?php dynamic_sidebar('footer-column-1'); ?>
            </div>
            <div class="col-md-3 footer__menus--item footer__menus--item--second-column">
              <?php dynamic_sidebar('footer-column-2'); ?>
            </div>
            <div class="col-md-3 footer__menus--item">
              <?php dynamic_sidebar('footer-column-3'); ?>
            </div>
            <div class="col-md-3 footer__menus--item">
              <?php dynamic_sidebar('footer-column-4'); ?>
            </div>

        </div>

        <div>

            <!-- <?php
            wp_nav_menu(
              array(
                'theme_location' => 'menu-4',
                'menu_id' => 'footer-nav',
              )
            );
            ?> -->
        </div>

    </div>
    <div class="footer__copyright">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12">
                  <div class="footer__copyright--content">
                    <?php echo $footercopyright; ?>
                  </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
        integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous"
        async></script>
</body>
</html>
