<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\UserInterface;

class UserStatController extends ControllerBase {

    public function content(UserInterface $user) {


        return [
            '#markup' => 'test',
        ];
    }
}
