<?php 

namespace Drupal\helloworld\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

  /**
   * Class to handle the configuration form of the helloworld custom module.
   */
class HelloworldSettingsForm extends ConfigFormBase {

  /**
   * Function to get the form id of the configure form.
   * @return string
   */
  public function getFormId() {
    return 'helloworld_admin_settings';
  }

  /**
   * Returns an array of the configuration fields of the form.
   */
  protected function getEditableConfigNames() {
    return [
      'helloworld.admin_settings',
    ];
  }

  /**
   * Function responsible for building the form elements.
   *
   * @param array $form
   * @param FormStateInterface $form_state
   * @return array 
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['full_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Full Name'),
      '#default_value' => $this->config(
        'helloworld.admin_settings')->get('full_name'),
      '#required' => TRUE,
    ];
    $form['phone_number'] = [
      '#type' => 'tel',
      '#title' => 'Phone Number',
      '#default_value' => $this->config(
        'helloworld.admin_settings')->get('phone_number'),
    ];    
    $form['email'] = [
      '#type' => 'email',
      '#title' => 'Email ID',
      '#default_value' => $this->config(
        'helloworld.admin_settings')->get('email'),
      '#patterns' => array('*@gmail.com', '*@yahoo.com', '*@outlook.com'),
      '#required' => TRUE,
    ];   
    $form['gender'] = [
      '#type' => 'radios',
      '#options' => array(
        'Male' => $this->t('Male'), 
        'Female' => $this->t('Female'), 
        'Others' => $this->t('Others')),
      '#title' => 'Gender',
      '#default_value' => $this->config('helloworld.admin_settings')->get('gender'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * Function for validating the form inputs.
   *
   * @param array $form
   * @param FormStateInterface $form_state
   * @return void
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if(!preg_match('/^[0-9]{10}+$/', $form_state->getValue('phone_number'))) {
      $form_state->setErrorByName(
        'phone_number', $this->t('Enter a valid 10 digit number'));
    }

    if(!preg_match(
      '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', 
      $form_state->getValue('email'))) {
        $form_state->setErrorByName(
          'email', $this->t('Enter a valid email address!!'));
      }
  }


  /**
   * Fuction to handle the submission of the form and updating the fields data.
   *
   * @param array $form
   * @param FormStateInterface $form_state
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('helloworld.admin_settings')
    ->set('full_name', $form_state->getValue('full_name'))
    ->set('email', $form_state->getValue('email'))
    ->set('phone_number', $form_state->getValue('phone_number'))
    ->set('gender', $form_state->getValue('gender'))

    ->save();
    parent::submitForm($form, $form_state);

  }
}
