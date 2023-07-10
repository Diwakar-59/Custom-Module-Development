<?php

namespace Drupal\routing_module\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

  /**
   * Class to implement dynamic routes.
   */
class RoutingController extends ControllerBase {

  protected $user;

  /**
   * {@inheritDoc}
   */
  public function __construct($user) {
    $this->user = $user;
  }

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('current_user')
    );
  }

  /**
   * Function to render the content page based on the route.
   *
   * @param mixed $slug
   * @return array
   */
  public function content($slug = null) {
    $user = $this->currentUser();
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
