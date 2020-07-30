<?php
global $about;

?>
<header class="header">
  <div class="container">
    <div class="logo-col">
      <?= $about->get_logo(); ?>
    </div>
    <div class="menu-col hide-md">
      <?php
      wp_nav_menu([
        'theme_location'  => 'main',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => '',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'           => 0,
        'walker'          => '',
      ]);
      ?>
    </div>
    <div class="btn-col hide-md">
      <a href="#modalOrderTest" data-fancybox data-touch="false" class="btn btn-primary">
        <span class="text"><?= __('Заказать тестирование', 'inlain'); ?></span>
      </a>
    </div>
    <div class="mobile-btn-col display-md">
      <a href="#" class="js-open-mobile-menu hamburger">
        <span class="hamburger-els"></span>
      </a>
    </div>
  </div>
</header>


<div class="mobile-menu">
  <div class="container">

    <?php
    wp_nav_menu([
      'theme_location'  => 'main',
      'menu'            => '',
      'container'       => 'div',
      'container_class' => '',
      'container_id'    => '',
      'menu_class'      => 'menu',
      'menu_id'         => '',
      'echo'            => true,
      'fallback_cb'     => 'wp_page_menu',
      'before'          => '',
      'after'           => '',
      'link_before'     => '',
      'link_after'      => '',
      'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
      'depth'           => 0,
      'walker'          => '',
    ]);
    ?>
    <div class="btn-row">
      <a href="#modalOrderTest" data-fancybox data-touch="false" class="btn btn-primary">
        <span class="text"><?= __('Заказать тестирование', 'inlain'); ?></span>
      </a>
    </div>
  </div>
</div>