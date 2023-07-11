<?php

namespace Drupal\block_module\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Provides a field for color.
 *
 * @FieldType(
 *   id = "color_item",
 *   label = @Translation("Color Field"),
 *   module = "block_module",
 *   default_formatter = "color_formatter",
 *   default_widget = "color_widget",
 * )
 */
class ColorItem extends FieldItemBase {

  /**
   * {@inheritDoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'red' => [
          'type' => 'int',
          'size' => 'small',
          'not null' => TRUE,
        ],
        'green' => [
          'type' => 'int',
          'size' => 'small',
          'not null' => TRUE,
        ],
        'blue' => [
          'type' => 'int',
          'size' => 'small',
          'not null' => TRUE,
        ],
      ],
    ];
  }

  /**
   * {@inheritDoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = [];

    $properties['red'] = DataDefinition::create('integer')
      ->setLabel('Red')
      ->addConstraint('Range', ['min' => 0, 'max' => 255])
      ->setRequired(TRUE);

    $properties['green'] = DataDefinition::create('integer')
      ->setLabel('Green')
      ->addConstraint('Range', ['min' => 0, 'max' => 255])
      ->setRequired(TRUE);

    $properties['blue'] = DataDefinition::create('integer')
      ->setLabel('Blue')
      ->addConstraint('Range', ['min' => 0, 'max' => 255])
      ->setRequired(TRUE);

    return $properties;

  }

  /**
   * {@inheritDoc}
   */
  public function isEmpty() {
    $red = $this->get('red')->getValue();
    $green = $this->get('green')->getValue();
    $blue = $this->get('blue')->getValue();
    return $red === NULL || $red === '' || $green === NULL || $green === '' || $blue === NULL || $blue === '';
  }

}
