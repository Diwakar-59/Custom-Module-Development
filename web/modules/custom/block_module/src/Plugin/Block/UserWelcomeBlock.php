<?php

namespace Drupal\block_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountInterface;
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
  public function __construct(array $configuration, $plugin_id, $plugin_definition, AccountInterface $account) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
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
    $user_roles = $this->account->getRoles();
    $roles = implode('<br>', $user_roles);
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Welcome  <br>') . $roles,
    ];
  }

}
