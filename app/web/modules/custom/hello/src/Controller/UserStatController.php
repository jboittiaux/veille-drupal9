<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\UserInterface;

class UserStatController extends ControllerBase {

    public function content(UserInterface $user) {
        $results = \Drupal::database()
            ->select('hello_user_statistics', 's')
            ->fields('s', ['time', 'action'])
            ->condition('uid', $user->id(), '=')
            ->orderBy('time', 'DESC')
            ->execute()
        ;

        $rows = [];
        foreach ($results as $row) {
            $rows[] = [
                'action' => $row->action ? 'Login' : 'Logout',
                'time' => \Drupal::service('date.formatter')->format($row->time),
            ];
        }

        return [
            '#type' => 'table',
            '#rows' => $rows,
            '#header' => [
                $this->t('Action'),
                $this->t('Date'),
            ],
        ];
    }
}
