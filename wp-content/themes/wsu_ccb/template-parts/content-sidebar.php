<?php
?>
<!--    <div class="sidebar-cta-accordion">-->
<!--      --><?php
//      dynamic_sidebar('wsu-ccb-sidebar-menu');
//      ?>
<!--    </div>-->
<?php $sidebar_menu =
  get_field('menu_select');
?>
    <div class="sidebar-cta-accordion">
      <?php
      $menu_object = wp_get_nav_menu_object($sidebar_menu);
      if ($menu_object) {
      $menu_name = $menu_object->name;
      $menu_slug = $menu_object->slug;
      $string_arr = explode(' ', $menu_name);
      if(is_array($string_arr) && count($string_arr) == 2){
        $menu_name = '<div class="title">'.$string_arr[0].'<span>'.$string_arr[1].'</span></div>';
      } else {
        $menu_name = '<div class="title">'.$menu_name.'</div>';
      }
      ?>
        <div class="widget-content">
            <h2 class="widget-title">
                <?= $menu_name; ?>
            </h2>
          <?php
          wp_nav_menu(
            array(
              //'theme_location' => 'Sidebar navigation',
              'menu' => $menu_slug,
              'menu_class' => '',
            )
          );
          }
          ?>
        </div>
    </div>

<?php
$sidebar_cta = get_field('sidebar_cta');
if ( !empty( $sidebar_cta['title'])):
  
  ?>
    <div class="sidebar-cta">

      <?php if (isset($sidebar_cta["title"])): ?>
          <div class="sidebar-cta__title">
            <?php echo $sidebar_cta["title"]; ?>
          </div>
      <?php endif; ?>

      <?php if (isset($sidebar_cta["caption"])): ?>
          <div class="sidebar-cta__caption">
            <?php echo $sidebar_cta["caption"]; ?>
          </div>
      <?php endif; ?>
<?php
$rows = $sidebar_cta['link_repeater'];

if($rows){
  foreach( $rows as $row){
?>
          <div class="sidebar-cta__link-spacing">
          <a href="<?php echo $row["link"]['url']; ?>"
             class="sidebar-cta__link"><?php echo  $row["link"]['title']; ?></a>
          </div>
          


      <?php
    }
  }?>
    </div>
<?php endif; ?>