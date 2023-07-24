<?php

namespace Drupal\block_module\Services;

/**
 * Class to implement a custom service.
 */
class UserEmail {

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
