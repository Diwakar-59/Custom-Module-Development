<?php

namespace Drupal\customfield_module\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Provides a field for color.
 *
 * @FieldType(
 *   id = "custom_color_field",
 *   label = @Translation("Custom Color Field"),
 *   module = "customfield_module",
 *   default_formatter = "text_formatter",
 *   default_widget = "custom_field_color_widget",
 * )
 */
class ColorItem extends FieldItemBase {

  /**
   * {@inheritDoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'hex_code' => [
          'type' => 'varchar',
          'length' => 255,
          'not null' => FALSE,
        ],
        'red' => [
          'type' => 'int',
          'size' => 'small',
          'not null' => FALSE,
        ],
        'green' => [
          'type' => 'int',
          'size' => 'small',
          'not null' => FALSE,
        ],
        'blue' => [
          'type' => 'int',
          'size' => 'small',
          'not null' => FALSE,
        ],
      ],
    ];
  }

  /**
   * {@inheritDoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = [];

    $properties['hex_code'] = DataDefinition::create('string')
      ->setLabel('Hex Code');

    $properties['red'] = DataDefinition::create('integer')
      ->setLabel('Red')
      ->addConstraint('Range', ['min' => 0, 'max' => 255]);

    $properties['green'] = DataDefinition::create('integer')
      ->setLabel('Green')
      ->addConstraint('Range', ['min' => 0, 'max' => 255]);

    $properties['blue'] = DataDefinition::create('integer')
      ->setLabel('Blue')
      ->addConstraint('Range', ['min' => 0, 'max' => 255]);

    return $properties;
  }

}
