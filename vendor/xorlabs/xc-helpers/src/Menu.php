<?php
namespace XORLabs\XC\Helpers;

class Menu {

  public static $menu_list;

  public static function display($menu_list, $active_link = '') {
    self::$menu_list = $menu_list;
    if ( ! $active_link) $active_link = '/' . get_instance()->uri->uri_string();
    // start building
    self::build(self::$menu_list, $active_link);
  }

  public static function build($menu_list, $active_link = '') {
    foreach ($menu_list as $mi): ?>
    <li class="<?= self::active($mi, $active_link)?>">
      <?php if ( ! count($mi->sub)): ?>
        <a href="<?= $mi->link?>">
          <i class="menu-class fa fa-<?= $mi->class?>"></i>
          <span class="menu-text"> <?= $mi->text ?> </span>
        </a>
        <b class="arrow"></b>
      <?php else: ?>
        <a href="#" class="dropdown-toggle">
          <i class="menu-class fa fa-<?= $mi->class?>"></i>
          <span class="menu-text"> <?= $mi->text?> </span>

          <b class="arrow fa fa-angle-down"></b>
        </a>
        <b class="arrow"></b>
        <ul class="submenu">
          <?php self::build($mi->sub, $active_link); ?>
        </ul>
      <?php endif; ?>
    </li>
    <?php endforeach;
  }

  public static function mi($link, $class, $text, $sub = []) {
    return (object) [
      'link' => $link,
      'class' => $class,
      'text' => $text,
      'sub' => $sub
    ];
  }

  public static function active($mi, $active_link) {
    if ($mi->link == $active_link) {
      echo 'active';
    }
    else if (count($mi->sub)) {
      foreach ($mi->sub as $mi) {
        if ($mi->link == $active_link) echo 'open';
      }
    }
    else {
      echo '';
    }
  }

}
