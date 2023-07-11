<?php

namespace Drupal\block_module\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Template\Attribute;

/**
 * Plugin implementation of the 'color item' formatter.
 *
 * @FieldFormatter(
 *   id = "color_background",
 *   label = @Translation("Color Background"),
 *   field_types = {
 *     "color_item"
 *   }
 * )
 */
class ColorBackground extends FormatterBase {

  /**
   * {@inheritDoc}
   */
  public function settingsSummary() {
    $summary = [];
    $summary[] = $this->t('Displays the color at the background.');
    return $summary;
  }

  /**
   * {@inheritDoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];
    foreach ($items as $delta => $item) {
      $red = $item->red;
      $green = $item->green;
      $blue = $item->blue;
      $colorCode = 'rgb(' . $red . ', ' . $green . ', ' . $blue . ')';
      $attributes = new Attribute();
      $attributes->setAttribute('style', 'background-color: ' . $colorCode);
      $element[$delta] = [
        '#type' => 'html_tag',
        '#tag' => 'div',
        '#value' => $colorCode,
        '#attributes' => $attributes->toArray(),
      ];
    }
    return $element;
  }

}
