<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloListController extends ControllerBase {
    public function content() {
        return [
            '#markup' => $this->t('Hello List'),
        ];
    }
}
