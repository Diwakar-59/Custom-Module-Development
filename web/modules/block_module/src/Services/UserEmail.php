<?php

namespace Drupal\block_module\Services;

/**
 * Class to implement a custom service.
 */
class UserEmail {
  /**
   * Variable to store a message.
   *
   * @var string
   */
  protected $user;

  /**
   * Function  to return a string response.
   *
   * @return string
   *   Returns a descriptive sentence.
   */
  public function result() {
    $user = 'Hi, This response is from userEmail Service!';
    return $user;
  }

}
