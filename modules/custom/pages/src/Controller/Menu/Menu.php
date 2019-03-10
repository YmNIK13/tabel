<?php

namespace Drupal\pages\Controller\Menu;

class Menu {

   static public function menu_data($active_page = NULL) {
    $menu = [
      'home' => [
        'url' => 'home',
        'img' => 'contract.svg',
        'style' => 'contract.svg',
        'name' => 'Главная',
        'active' => $active_page== 'home' ? 'active' : NULL,

      ],
      'about' => [
        'url' => 'about_us',
        'img' => 'contract.svg',
        'style' => 'contract.svg',
        'name' => 'О нас',
        'active' => $active_page== 'about_us' ? 'active' : NULL,

      ],
    ];

    return $menu;
  }

}