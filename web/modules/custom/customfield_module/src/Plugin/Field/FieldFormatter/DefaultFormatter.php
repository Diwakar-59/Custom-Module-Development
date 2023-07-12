<?php

namespace Drupal\customfield_module\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'color item' formatter.
 *
 * @FieldFormatter(
 *   id = "text_formatter",
 *   label = @Translation("Default Formatter"),
 *   field_types = {
 *     "custom_color_field"
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
    foreach ($items as $delta => $item) {
      if ($items->hex_code) {
        $colorCode = 'Hex Code: ' . $items->hex_code;
        $element[$delta] = [
          '#type' => 'markup',
          '#markup' => $colorCode,
        ];
      }
      else {
        $red = $item->red;
        $green = $item->green;
        $blue = $item->blue;
        $colorCode = 'rgb(' . $red . ', ' . $green . ', ' . $blue . ')';
        $element[$delta] = [
          '#type' => 'markup',
          '#markup' => $colorCode,
        ];
      }
    }
    return $element;
  }

}
