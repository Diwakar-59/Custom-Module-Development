<?php

namespace Drupal\block_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Adds a custom block to welcome user.
 *
 * @Block(
 *   id = "userwelcome_custom_block",
 *   admin_label = @Translation("The User Welcome Custom Block"),
 * )
 */
class UserWelcomeBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Stores the current user account object.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $account;

  /**
   * {@inheritDoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_defination, AccountInterface $account) {
    $this->account = $account;
  }

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_defination) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_defination,
      $container->get('current_user')
    );
  }

  /**
   * {@inheritDoc}
   */
  public function build() {
    $userrole = $this->account->getRoles();
    $roles = '';
    foreach ($userrole as $role) {
      $roles .= $role . '<br>';
    }
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Welcome  <br>') . $roles,
    ];
  }

}
