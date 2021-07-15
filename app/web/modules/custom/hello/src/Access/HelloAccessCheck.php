<?php

namespace Drupal\hello\Access;

use Drupal\Core\Access\AccessCheckInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;

class HelloAccessCheck implements AccessCheckInterface {
    public function applies(Route $route) {
        return null;
    }

    public function access(
        Route $route,
        Request $request = null,
        AccountInterface $account
    ) {
        $param = (int) $route->getRequirement('_access_hello');

        if ($account->isAnonymous()) {
            return AccessResult::forbidden();
        }

        $created = $account->getAccount()->created;

        $now = \Drupal::time()->getCurrentTime();

        $elapsed = $now - $created;

        return AccessResult::allowedIf($elapsed > ($param * 60 * 60));
    }
}
