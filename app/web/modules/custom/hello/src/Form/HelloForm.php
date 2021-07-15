<?php

namespace Drupal\hello\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class HelloForm extends FormBase {
    const OPERATOR_ADD = '+';
    const OPERATOR_SUBSTRACT = '-';
    const OPERATOR_MULTIPLY = '*';
    const OPERATOR_DIVIDE = '/';

    public static $availableOperators = [
        self::OPERATOR_ADD,
        self::OPERATOR_SUBSTRACT,
        self::OPERATOR_MULTIPLY,
        self::OPERATOR_DIVIDE,
    ];

    public function getFormId() {
        return 'hello_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state) {
        $result = $form_state->getRebuildInfo()['result'] ?? null;
        if ($result) {
            $form ['result'] = [
                '#type' => 'html_tag',
                '#tag' => 'p',
                '#value' => $result,
            ];
        }

        $form['first'] = [
            '#type' => 'textfield',
            '#title' => $this->t('First value'),
            '#description' => $this->t('The first value for the operation'),
            '#required' => true,
        ];

        $form['operator'] = [
            '#type' => 'radios',
            '#title' => $this->t('Operator'),
            '#options' => [
                self::OPERATOR_ADD => $this->t('Add'),
                self::OPERATOR_SUBSTRACT => $this->t('Substract'),
                self::OPERATOR_MULTIPLY => $this->t('Multiply'),
                self::OPERATOR_DIVIDE => $this->t('Divide'),
            ],
            '#default_value' => self::OPERATOR_ADD,
        ];

        $form['second'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Second value'),
            '#description' => $this->t('The second value for the operation'),
            '#required' => true,
        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Calculate'),
        ];

        return $form;
    }

    public function validateForm(array &$form, FormStateInterface $form_state) {
        $first = $form_state->getValue('first');
        $second = $form_state->getValue('second');
        $operator = $form_state->getValue('operator');

        if (!is_numeric($first)) {
            $form_state->setErrorByName('first', $this->t('First value must be a number'));
        }
        if (!is_numeric($second)) {
            $form_state->setErrorByName('second', $this->t('Second value must be a number'));
        }
        elseif ($operator === self::OPERATOR_DIVIDE && (int) $second === 0) {
            $form_state->setErrorByName('second', $this->t('Second value must be > 0 for divide operation'));
        }

        if (!in_array($operator, self::$availableOperators)) {
            $form_state->setErrorByName('operator', $this->t('Invalid operator'));
        }
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        $first = $form_state->getValue('first');
        $second = $form_state->getValue('second');
        $operator = $form_state->getValue('operator');

        // calcul du resultat
        $result = 0;
        $str = sprintf('$result = %s %s %s;', $first, $operator, $second);
        eval($str);

        $displayResult = sprintf('%s : %s', $this->t('Result'), $result);

        // affichage du resultat via messenger
        \Drupal::service('messenger')->addMessage($displayResult);

        // stockage du resultat pour reutilisation dans le form
        $form_state->addRebuildInfo('result', $displayResult);

        $form_state->setRebuild();

        // stockage du timestamp dans la state api
        \Drupal::state()->set('hello.calculation.timestamp', \Drupal::time()->getCurrentTime());
    }
}
