<?php

namespace Drupal\routing_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Class to implement dynamic routes.
 */
class RoutingController extends ControllerBase {

  /**
   * Function to render the content page based on the route.
   *
   * @param mixed $slug
   * @return array
   */
  public function content($slug = null) {
    $user = \Drupal::currentUser();
    if ($user->hasPermission('access custom page')) {
      if ($slug != null) {
        return [
          '#type' => 'markup',
          '#markup' => 'Hello from Routing Controller page!! ' . '<br>' . 
          $slug . ' is the dynamic parameter!',
        ];
      }
      else {
        return [
          '#type' => 'markup',
          '#markup' => 'Hello from Routing Controller page!!',
        ];
      }
    }
    else {
      throw new AccessDeniedHttpException();
    }
  }
}
