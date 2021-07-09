<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloListController extends ControllerBase {

    public function content($nodetype = null) {
        $nodeStorage = \Drupal::entityTypeManager()->getStorage('node');
        $query = $nodeStorage->getQuery();

        if ($nodetype) {
            $query->condition('type', $nodetype, '=');
        }

        $nIds = $query->pager(5)->execute();
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
