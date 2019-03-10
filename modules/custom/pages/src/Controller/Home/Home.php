<?php

namespace Drupal\pages\Controller\Home;

use Drupal\Core\Controller\ControllerBase;

class Home extends ControllerBase {

  public function get_data() {
    global $base_url;

    $menu = \Drupal\pages\Controller\Menu\Menu::menu_data('home');


    $data = [
      'title' => 'Главная стр',
      'window' => [
        0 => [
          'title' => "Первое окно",
          'content' => "Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum",
        ],
        1 => [
          'title' => "Второе окно",
          'content' => "Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum",
        ],
        2 => [
          'title' => "Третье окно",
          'content' => "Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum",
        ],
      ],

    ];

    return [
      '#theme' => 'home_the',
      '#data' => $data,
      '#base_url' => $base_url,
      '#menu' => $menu,
    ];
  }

}