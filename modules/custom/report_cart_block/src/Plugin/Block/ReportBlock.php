<?php

/**
 * @file
 * Contains \Drupal\report_cart_block\Plugin\Block\ReportBlock.
 */

namespace Drupal\report_cart_block\Plugin\Block;

/**
 * Create report cart
 *
 * @Block(
 *    id = "report_cart_block",
 *    admin_label = @Translation("Report cart block"),
 *    category = @Translation("Report cart block example")
 *  )
 */
class ReportBlock extends \Drupal\Core\Block\BlockBase {


  static function getDateReport() {
    // получаем ID ноды
    $nid = \Drupal::routeMatch()->getRawParameter('node');

    if (empty($nid)) {
      return NULL;
    }

    $node = (\Drupal::entityTypeManager()->getStorage('node')->load($nid));
    if (empty($node->id())) {
      return NULL;
    }


    $dates_works = $node->field_worked->getValue();


    $result_date = [];

    foreach ($dates_works as $work){
      $result_date[] = date_parse_from_format('Y-m-d',$work['value']);
    }


    return [
      'dates' => $result_date,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#theme' => 'report_cart_block',
      '#dates' =>  ReportBlock::getDateReport(),
      '#week_day' => 5,
    ];
  }
}