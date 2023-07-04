<?php 

namespace Drupal\helloworld\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * Class for handling the routes of helloworld module.
 */
class HelloController extends ControllerBase {

  protected $account;

  public function __construct(AccountInterface $account) {
    $this->account = $account;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('current_user')
    );
  }

    /**
   * Display the markup.
   *
   * @return array
   *   Return markup array.
   */
  public function content() {
    if ($this->account->hasPermission('view custom module config page')) {
      return [
        '#type' => 'markup',
        '#markup' => $this->t('Hello,' . $this->account->getAccountName() . '!'),
      ];
    }
    else {
      throw new NotFoundHttpException();
    }
  }
}
