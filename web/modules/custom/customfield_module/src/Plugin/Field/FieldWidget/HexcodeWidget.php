<?php

namespace Drupal\customfield_module\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * A RGB hex code widget.
 *
 * @FieldWidget(
 *   id = "custom_field_hex_widget",
 *   label = @Translation("A Hex code widget"),
 *   field_types = {
 *     "custom_color_field"
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
      '#size' => 7,
      '#default_value' => $items[$delta]->hex_code ?? NULL,
    ];
    return $element;
  }

}
