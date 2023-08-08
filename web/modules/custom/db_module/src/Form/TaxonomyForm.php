<?php

namespace Drupal\db_module\Form;

use Drupal\Core\Database\Connection;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\Messenger;
use Drupal\Core\Url;

/**
 * Provides a DB Module form.
 */
class TaxonomyForm extends FormBase {

  /**
   * Stores the connection object.
   *
   * @var object
   */
  protected $connection;

  /**
   * Stores the messenger object.
   *
   * @var object
   */
  protected $message;

  /**
   * {@inheritDoc}
   */
  public function __construct(Connection $connection, Messenger $message) {
    $this->connection = $connection;
    $this->message = $message;
  }

  /**
   * {@inheritDoc}
   */
  public static function create($container) {
    return new static(
      $container->get('database'),
      $container->get('messenger'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'db_module_taxonomy';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['term'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Taxonomy Term'),
      '#required' => TRUE,
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Send'),
    ];

    return $form;
  }

  /**
   * Function to query the data from the database.
   *
   * @param string $term
   *   Stores the tern whose details if to be queried.
   *
   * @return array
   *   Returns the result of the query.
   */
  public function getTermDetails(string $term) {
    $query = $this->connection->select('taxonomy_term_field_data', 'ttfd');
    $query->innerjoin('taxonomy_term_data', 'ttd', 'ttfd.tid = ttd.tid');
    $query->innerJoin('taxonomy_index', 'ti', 'ttd.tid = ti.tid');
    $query->innerJoin('node_field_data', 'nfd', 'ti.nid = nfd.nid');
    $query->fields('ttd', ['tid', 'uuid']);
    $query->fields('ttfd', ['name']);
    $query->fields('nfd', ['title']);
    $query->fields('nfd', ['nid']);
    $query->condition('ttfd.name', $term);
    $result = $query->execute()->fetchAll();

    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (!is_string($form_state->getValue('term'))) {
      $form_state->setErrorByName('message', $this->t('Enter a valid Taxnomy term id'));
    }
    $result = $this->getTermDetails($form_state->getValue('term'));
    if (!$result) {
      $form_state->setErrorByName('message', $this->t('Taxonomy term does not exist'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $output = $this->getTermDetails($form_state->getValue('term'));
    if ($output) {
      foreach ($output as $out) {
        $this->message->addMessage($this->t('The term ID is: %data', ['%data' => $out->tid]));
        $this->message->addMessage($this->t('The term UUID is: %data', ['%data' => $out->uuid]));
        $this->message->addMessage($this->t('The term title is: %data', ['%data' => $out->name]));
        $this->message->addMessage($this->t('The node title using the Term is: %data', ['%data' => $out->title]));
        $nodeUrl = Url::fromUri('internal:/node/' . $out->nid)->toString();
        $url = $this->t('<a href="@url">Node URL</a>', ['@url' => $nodeUrl]);
        $this->message->addMessage($this->t('The node URL is: %data', ['%data' => $url]));

      }
    }

    else {
      $this->message->addMessage($this->t('The term does not exist.'));
    }
  }

}
