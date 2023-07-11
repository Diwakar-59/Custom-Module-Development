<?php

namespace Drupal\routing_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Class to implement dynamic routes.
 */
class RoutingController extends ControllerBase {

  /**
   * Variable to store the user object.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $user;

  /**
   * {@inheritDoc}
   */
  public function __construct(AccountInterface $user) {
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
   *   Parameter to accept the dynamic url value.
   *
   * @return array
   *   Returns a markup message.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException
   *   If user has no permission to access the page.
   */
  public function content($slug = NULL) {
    $user = $this->currentUser();
    if ($user->hasPermission('access custom page')) {
      if ($slug != NULL) {
        return [
          '#type' => 'markup',
          '#markup' => 'Hello from Routing Controller page!! <br>' .
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
