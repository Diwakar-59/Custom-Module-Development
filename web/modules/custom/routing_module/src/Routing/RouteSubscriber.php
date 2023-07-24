<?php

namespace Drupal\routing_module\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class to alter an existing route.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritDoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    if ($route = $collection->get('routing_module.content')) {
      $route->setPath('/routing-page-subscriber');
    }
  }

}
