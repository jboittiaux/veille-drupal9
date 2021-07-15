<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloAccessController extends ControllerBase {
    public function content() {
        return [
            '#markup' => $this->t('Access ok !'),
        ];
    }
}
