<?php

namespace Drupal\block_module\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * A RGB value widget.
 *
 * @FieldWidget(
 *   id = "color_widget",
 *   label = @Translation("A RGB value widget"),
 *   field_types = {
 *     "color_item"
 *   }
 * )
 */
class ColorItemDefaultWidget extends WidgetBase {

  /**
   * {@inheritDoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $item = $items[$delta];

    $element['red'] = [
      '#type' => 'number',
      '#title' => $this->t('Red'),
      '#size' => '10',
      '#min' => 0,
      '#max' => 255,
      '#default_value' => $items[$delta]->red ?? NULL,
    ];
    $element['green'] = [
      '#type' => 'number',
      '#title' => $this->t('Green'),
      '#size' => '10',
      '#min' => 0,
      '#max' => 255,
      '#default_value' => $items[$delta]->green ?? NULL,
    ];
    $element['blue'] = [
      '#type' => 'number',
      '#title' => $this->t('Blue'),
      '#size' => '10',
      '#min' => 0,
      '#max' => 255,
      '#default_value' => $items[$delta]->blue ?? NULL,
    ];

    return $element;
  }

}
