<?php 

namespace Drupal\block_module\Controller;


use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * @inheritDoc
 */
class BlockController extends ControllerBase {

  /**
   * Creates a content page with basic markup displayed on the page.
   *
   * @return array
   */
  public function content() {
    return [
      '#type' => 'markup',
      '#markup' => 'This is the custom page where the custom block is displayed!!',
    ];
  }
}
