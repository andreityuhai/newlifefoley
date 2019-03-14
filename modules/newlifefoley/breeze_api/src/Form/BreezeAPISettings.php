<?php

namespace Drupal\breeze_api\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Breeze API settings.
 */
class BreezeAPISettings extends ConfigFormBase {
  /** @var string Config settings */
  const SETTINGS = 'breeze_api.settings';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'breeze_api_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);

    $form['breeze_api_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Breeze API key'),
      '#default_value' => $config->get('breeze_api_key'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration
    $this->configFactory->getEditable(static::SETTINGS)
      // Set the submitted configuration setting
      ->set('breeze_api_key', $form_state->getValue('breeze_api_key'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}