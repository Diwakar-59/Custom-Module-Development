<?php

namespace Drupal\block_module\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * A RGB hex code widget.
 *
 * @FieldWidget(
 *   id = "hex_color_widget",
 *   label = @Translation("A RGB hex code widget"),
 *   field_types = {
 *     "color_item"
 *   }
 * )
 */
class HexcodeWidget extends WidgetBase {

  /**
   * {@inheritDoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['hex_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Hex Code'),
      '#default_value' => isset($items[$delta]->hex_code) ? $items[$delta]->hex_code : NULL,
      '#size' => 255,
      '#maxlength' => 255,
    ];
    return $element;
  }

}
