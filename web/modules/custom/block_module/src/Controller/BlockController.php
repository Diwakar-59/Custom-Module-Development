<?php

namespace Drupal\block_module\Controller;

use Drupal\block_module\Services\UserEmail;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class to display the customblock on content page.
 */
class BlockController extends ControllerBase {

  /**
   * Stores the current user object.
   *
   * @var object
   */
  protected $user;

  /**
   * {@inheritDoc}
   */
  public function __construct(UserEmail $user) {
    $this->user = $user;
  }

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('block_module.useremail_service')
    );
  }

  /**
   * Creates a content page with basic markup displayed on the page.
   *
   * @return array
   *   Returns a markup array to render dynamic statements coming from service.
   */
  public function content() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('This is the custom page where the custom block is displayed!!<br>
                            @value!', ['@value' => $this->user->result()]),
    ];
  }

}
