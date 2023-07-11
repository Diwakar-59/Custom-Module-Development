<?php

namespace Drupal\block_module\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * A RGB picker widget.
 *
 * @FieldWidget(
 *   id = "color_picker_widget",
 *   label = @Translation("A RGB color picker widget"),
 *   field_types = {
 *     "color_item"
 *   }
 * )
 */
class PickerWidget extends WidgetBase {

  /**
   * {@inheritDoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $item = $items[$delta];
    $red = $items[$delta]->red ?? '00';
    $green = $items[$delta]->green ?? '00';
    $blue = $items[$delta]->blue ?? '00';
    $element['picker'] = [
      '#type' => 'color',
      '#default_value' => sprintf("#%02x%02x%02x", $red, $green, $blue),
    ];

    return $element;
  }

}
