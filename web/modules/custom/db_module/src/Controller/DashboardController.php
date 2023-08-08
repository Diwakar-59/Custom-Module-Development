<?php

namespace Drupal\db_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class to display the customblock on content page.
 */
class DashboardController extends ControllerBase {

  /**
   * Stores the current user object.
   *
   * @var object
   */
  protected $connection;

  /**
   * {@inheritDoc}
   */
  public function __construct(Connection $connection) {
    $this->connection = $connection;
  }

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }

  /**
   * Creates a content page with basic markup displayed on the page.
   *
   * @return array
   *   Returns a markup array to render dynamic statements coming from service.
   */
  public function content() {
    $query = $this->connection->query("SELECT YEAR(field_date_value) as Year, COUNT(*) as Events 
      FROM {node__field_date} inner join {node__field_type} 
      on {node__field_date}.entity_id = {node__field_type}.entity_id 
      GROUP BY YEAR(field_date_value)");
    $result = $query->fetchAll();

    $query2 = $this->connection->query("SELECT EXTRACT(QUARTER FROM field_date_value) as Quarter, COUNT(*) as Events 
      FROM {node__field_date} inner join {node__field_type} 
      on {node__field_date}.entity_id = {node__field_type}.entity_id 
      GROUP BY EXTRACT(QUARTER FROM field_date_value)");
    $result2 = $query2->fetchAll();

    $query3 = $this->connection->query("SELECT field_type_value, COUNT(field_type_value) as Events
      FROM {node__field_type} 
      GROUP BY field_type_value");
    $result3 = $query3->fetchAll();

    $res = json_decode(json_encode($result), TRUE);
    $res2 = json_decode(json_encode($result2), TRUE);
    $res3 = json_decode(json_encode($result3), TRUE);

    return [
      '#cache' => [
        'tags' => ['node:events'],
      ],
      '#theme' => 'my_template',
      '#event_per_year' => $res,
      '#event_per_quarter' => $res2,
      '#event_per_type' => $res3,
    ];
  }

}
