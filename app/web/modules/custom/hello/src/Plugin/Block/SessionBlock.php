<?php

namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

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

    protected function blockAccess(AccountInterface $account) {
        return AccessResult::allowedIfHasPermission($account, 'hello.access');
    }
}
