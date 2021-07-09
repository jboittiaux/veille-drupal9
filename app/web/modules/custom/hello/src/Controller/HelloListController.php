<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloListController extends ControllerBase {

    public function content() {
        $nodeStorage = \Drupal::entityTypeManager()->getStorage('node');
        $nodes = $nodeStorage->loadMultiple();

        $items = [];
        foreach ($nodes as $node) {
            $items[] = $node->label();
        }

        return [
            '#theme' => 'item_list',
            '#items' => $items,
        ];
    }
}
