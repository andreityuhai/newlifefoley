<?php

namespace Drupal\breeze_api\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Serialization\Json;
use Drupal\breeze_api\breeze_api_wrapper_php\Breeze;



class ReportsForm extends FormBase {

  const BREEZE_API_DOMAIN = 'https://newlifefoley.breezechms.com/api/';

  /**
   * @var Breeze
   */
  private $breeze;

  /**
   * @var string
   */
  private $apiKey;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'breeze_api_form';
  }

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    $this->apiKey = \Drupal::configFactory()->getEditable('breeze_api.settings')->get('breeze_api_key');
    $this->breeze = new Breeze($this->apiKey);
  }

  /**
   * Breeze API reports form.
   *
   * @param array $form
   *   Default form array structure.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Object containing current form state.
   *
   * @return array
   *   The render array defining the elements of the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['dates'] = [
      '#type' => 'fieldset',
      '#title' => t('Events date range'),
      'start_date' => [
        '#type' => 'date',
        '#title' => t('Start date'),
        '#attributes' => ['data-single-date-time' => ''],
        '#default_value' => date('Y') . '-01-01'
      ],
      'end_date' => [
        '#type' => 'date',
        '#title' => t('End date'),
        '#attributes' => ['data-single-date-time' => ''],
        '#default_value' => date('Y-m-d'),
      ],
      'load-events' => [

      ]
    ];

    $events = $this->breeze->url(self::BREEZE_API_DOMAIN . 'events');

    $form['actions'] = [
      '#type' => 'actions'
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => 'Submit',
      '#button_type' => 'primary'
    ];

    return $form;
  }

  /**
   * Implements a form submit handler.
   *
   * The submitForm method is the default method called for any submit elements.
   *
   * @param array $form
   *   The render array of the currently built form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $operation = $form_state->getTriggeringElement();
  }

}
