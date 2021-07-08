<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloController extends ControllerBase {
    public function content() {
        $account = \Drupal::service('current_user');

        return [
            '#markup' => $this->t('Hello %name !', [
                '%name' => $account->getAccountName(),
            ]),
        ];
    }
}
