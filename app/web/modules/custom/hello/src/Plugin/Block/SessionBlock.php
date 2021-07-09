<?php

namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * @Block(
 *  id = "hello_session_block",
 *  admin_label = @Translation("Hello Session Block")
 * )
 */
class SessionBlock extends BlockBase {
    /**
     * {@inheritdoc}
     */
    public function build() {
        $db = \Drupal::database();

        $nbSession = $db->select('sessions', 's')
            ->countQuery()
            ->execute()
            ->fetchField()
        ;
        return [
            '#markup' => $this->t('Il y a %nbSession sessions actives', [
                '%nbSession' => $nbSession,
            ]),
            '#cache' => [
                'max-age' => 0,
            ],
        ];
    }
}
