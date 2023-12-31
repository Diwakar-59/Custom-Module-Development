<?php

namespace Drupal\customfield_module\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * A RGB picker widget.
 *
 * @FieldWidget(
 *   id = "custom_field_picker_widget",
 *   label = @Translation("A color picker widget"),
 *   field_types = {
 *     "custom_color_field"
 *   }
 * )
 */
class PickerWidget extends WidgetBase {

  /**
   * {@inheritDoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $red = $items[$delta]->red ?? '00';
    $green = $items[$delta]->green ?? '00';
    $blue = $items[$delta]->blue ?? '00';
    $element['hex_code'] = [
      '#type' => 'color',
      '#default_value' => sprintf("#%02x%02x%02x", $red, $green, $blue) ?? NULL,
    ];

    return $element;
  }

}
