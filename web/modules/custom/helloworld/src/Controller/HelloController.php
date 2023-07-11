<?php

namespace Drupal\helloworld\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class for handling the routes of helloworld module.
 */
class HelloController extends ControllerBase {

  /**
   * Variable to store the user object.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $account;

  /**
   * Created a HelloController object.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The AccountInterface service object.
   */
  public function __construct(AccountInterface $account) {
    $this->account = $account;
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
   * Display the markup.
   *
   * @return array
   *   Return markup array.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
   *   If user has no permission to access the page.
   */
  public function content() {
    if ($this->account->hasPermission('view custom module config page')) {
      return [
        '#type' => 'markup',
        '#markup' => $this->t('Hello,') . $this->account->getAccountName() . '!',
      ];
    }
    else {
      throw new NotFoundHttpException();
    }
  }

}
