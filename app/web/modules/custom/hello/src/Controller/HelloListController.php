<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloListController extends ControllerBase {

    public function content() {
        $nodeStorage = \Drupal::entityTypeManager()->getStorage('node');
        $nIds = $nodeStorage->getQuery()
            ->pager(5)
            ->execute()
        ;
        $nodes = $nodeStorage->loadMultiple($nIds);

        $items = [];
        foreach ($nodes as $node) {
            $items[] = $node->toLink();
        }

        $pager = ['#type' => 'pager'];
        $list = [
            '#theme' => 'item_list',
            '#items' => $items,
        ];

        return [$list, $pager];
    }
}
