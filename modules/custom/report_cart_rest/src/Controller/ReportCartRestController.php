<?php

/**
 * @file
 * Contains \Drupal\report_cart_rest\Controller\ReportCartRestController.
 */

namespace Drupal\report_cart_rest\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class ReportCartRestController extends ControllerBase {

  /**
   * @var \Drupal\node\Entity\Node
   */
  private $_node;

  private $_is_hold_field_worked = TRUE;

  private function getNode($id) {
    $node = (\Drupal::entityTypeManager()
      ->getStorage('node')
      ->load($id));

    if (empty($node->field_worked)) {
      $this->_is_hold_field_worked = FALSE;
      $this->_node = NULL;
    }
    else {
      $this->_is_hold_field_worked = TRUE;
      $this->_node = $node;
    }
  }


  private function getDatesNode() {
    if (empty($this->_node) && empty($this->_node->isNew())) {
      return [];
    }

    if (empty($this->_node->field_worked)) {
      $this->_is_hold_field_worked = FALSE;
      return [];
    }

    $value_field = $this->_node->field_worked->getValue();

    if (empty($value_field)) {
      return [];
    }

    return array_column($value_field, 'value');
  }

  /**
   * Callback for `rc-rest/get.json` API method.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   */
  public function get_date_report_cart(Request $request) {
    $this->getNode($request->get('nid'));

    if (empty($this->_node)) {
      $response['success'] = FALSE;
      $response['error'] = "No id or wrong type";
    }
    else {
      $response['success'] = TRUE;
      $response['work_days'] = $this->getDatesNode();
    }

    return new JsonResponse($response);
  }


  /**
   * Callback for `rc-rest/post.json` API method.
   * 
   * @param \Symfony\Component\HttpFoundation\Request $request
   *
   * @return bool|\Symfony\Component\HttpFoundation\JsonResponse
   * @throws \Drupal\Core\Entity\EntityStorageException
   */
  public function add_date_report_cart(Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
      $data = json_decode($request->getContent(), TRUE);
      $request->request->replace(is_array($data) ? $data : []);
    }

    $nid = $request->get('nid');
    if (empty($nid)) {
      return FALSE;
    }
    $this->getNode($nid);

    if (empty($this->_node)) {
      $response['success'] = FALSE;
      $response['error'] = "No id or wrong type";
    }
    else {
      $dates_in = $request->get('dates');
      if (empty($dates_in)) {
        $dates_in[] = date('Y-m-d');
      }

      foreach ($dates_in as $di) {
        $this->_node->field_worked->appendItem($di);
      }
      $this->_node->save();


      $response['work_days'] = $this->getDatesNode();
      $response['success'] = TRUE;
    }

    return new JsonResponse($response);
  }


}