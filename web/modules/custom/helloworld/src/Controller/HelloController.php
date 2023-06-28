<?php 

namespace Drupal\helloworld\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * Class for handling the routes of helloworld module.
 */
class HelloController extends ControllerBase {
    /**
   * Display the markup.
   *
   * @return array
   *   Return markup array.
   */
  public function content() {
    $user = \Drupal::currentUser();
    if ($user->hasPermission('view custom module config page')) {
      return [
        '#type' => 'markup',
        '#markup' => $this->t('Hello,' . $user->getAccountName() . '!'),
      ];
    }
    else {
      throw new NotFoundHttpException();
    }
  }
}
