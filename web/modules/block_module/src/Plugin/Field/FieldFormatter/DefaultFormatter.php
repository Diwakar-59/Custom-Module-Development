<?php

namespace Drupal\block_module\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'color item' formatter.
 *
 * @FieldFormatter(
 *   id = "color_formatter",
 *   label = @Translation("Color Formatter"),
 *   field_types = {
 *     "color_item"
 *   }
 * )
 */
class DefaultFormatter extends FormatterBase {

  /**
   * {@inheritDoc}
   */
  public function settingsSummary() {
    $summary = [];
    $summary[] = $this->t('Displays the color details.');
    return $summary;
  }

  /**
   * {@inheritDoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];
    // Render each element as markup.
    foreach ($items as $delta => $item) {
      $red = $item->red;
      $green = $item->green;
      $blue = $item->blue;
      $colorCode = 'rgb(' . $red . ', ' . $green . ', ' . $blue . ')';
      $element[$delta] = [
        '#type' => 'markup',
        '#markup' => $colorCode,
      ];
    }

    return $element;
  }

}
