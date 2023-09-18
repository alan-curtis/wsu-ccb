<?php $list_group = get_field('list_section_group');
 $repeaters = $list_group['list_section_repeater'];

if( !empty( $list_group ) ): ?>
<div class="cta-list-icon">
    <div class="cta-list-icon__wrapper">
    <?php
        foreach($repeaters as $repeater) {
            if ($repeater['icon_select'] == '1') {
                $i =  ' <img src="' . $repeater['image']['url'] . ' "> ';
            }
            if ($repeater['icon_select'] == '2') {
                $i = $repeater['icon'];
            }
            ?>
             <div class="cta-list-icon__item">
                 <div class="cta-list-icon__item--title-section">
                   <?= $i; ?>
                   <h3><?= $repeater['title']; ?></h3>
                 </div>
                 <div class="cta-list-icon__item--description">
                   <?= $repeater['content']; ?>
                 </div>
                 <div class="cta-list-icon__item--links">
                   <?php
                   $links = $repeater['link_repeater'];
                   if (!empty( $links )) { ?>
                       <ul class="roundDown">
                         <?php   foreach($links as $link) { ?>
                             <li class="">
                                 <a href="<?= $link['link']['url'];?>"><?= $link['link']['title'];?></a>
                             </li>
                         <?php  } ?>
                       </ul>
                   <?php    }; ?>
                 </div>
             </div>
     <?php   }?>
    </div>
</div>
<?php endif; ?>