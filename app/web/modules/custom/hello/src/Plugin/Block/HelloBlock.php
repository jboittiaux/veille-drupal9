<?php

namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\devel\Plugin\Devel\Dumper\Kint;

/**
 * @Block(
 *  id = "hello_example_block",
 *  admin_label = @Translation("Hello Block")
 * )
 */
class HelloBlock extends BlockBase {
    /**
     * {@inheritdoc}
     */
    public function build() {
        $dateFormatter = \Drupal::service('date.formatter');

        return [
            '#markup' => $this->t('Coucou, il est %time', [
                '%time' => $dateFormatter->format(
                    \Drupal::time()->getCurrentTime(),
                    'custom',
                    'H:i s\s'
                ),
            ]),
            '#cache' => [
                'keys' => ['hello:block_time'],
                'max-age' => '10',
            ],
        ];
    }
}
