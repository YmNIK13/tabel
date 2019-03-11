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

  private $_cur_month;

  private $_cur_year;

  private $_cur_max_days_month;

  private $_cur_number_day_first_week;


  private function initDate() {
    // hook_report_cart_block_set_date().
    $cur_date = \Drupal::moduleHandler()
      ->invokeAll('report_cart_block_set_date');


    if (empty($cur_date)) {
      $cur_date = time();
    }

    $this->_cur_month = date('n', $cur_date);
    $this->_cur_year = date('Y', $cur_date);
    $this->_cur_max_days_month = date('t', $cur_date);

    // указываем первый день месяца
    $date_first_day_mouth = new \DateTime();
    $date_first_day_mouth->setDate($this->_cur_year, $this->_cur_month, 1);
    $this->_cur_number_day_first_week = date('N', $date_first_day_mouth->getTimestamp());
  }

  private function getDatesThisMonth() {
    // получаем ID ноды из пути
    $nid = \Drupal::routeMatch()->getRawParameter('node');

    if (empty($nid)) {
      return NULL;
    }

    $node = (\Drupal::entityTypeManager()->getStorage('node')->load($nid));
    if (empty($node->id())) {
      return NULL;
    }


    $work_days = [];
    foreach ($node->field_worked->getValue() as $work) {
      $work_date_array = date_parse_from_format('Y-m-d', $work['value']);
      // выбираем даты текущего месяца
      if (!empty($work_date_array)
        && ($work_date_array['year'] == $this->_cur_year)
        && ($work_date_array['month'] == $this->_cur_month)) {
        $work_days[] = $work_date_array['day'];
      }
    }

    return $work_days;
  }


  /**
   * {@inheritdoc}
   */
  public function build() {
    $this->initDate();

    return [
      '#theme' => 'report_cart_block',
      '#work_days' => $this->getDatesThisMonth(),
      '#week_day' => $this->_cur_number_day_first_week,
      '#max_days_month' => $this->_cur_max_days_month,
    ];
  }
}