<?php

namespace Drupal\hello\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class HelloSettingsForm extends ConfigFormBase {
    public function getFormId() {
        return 'hello_settings_form';
    }

    protected function getEditableConfigNames()
    {
        return ['hello.settings'];
    }

    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['purge_days_number'] = [
            '#type' => 'number',
            '#title' => $this->t('Purge days number'),
            '#default_value' => $this->config('hello.settings')->get('purge_days_number'),
            '#required' => true,
        ];

        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        $purgeDays = (int) $form_state->getValue('purge_days_number');

        $this->config('hello.settings')
            ->set('purge_days_number', $purgeDays)
            ->save()
        ;

        parent::submitForm($form, $form_state);
    }
}
