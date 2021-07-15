<?php

namespace Drupal\hello\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

class HelloRouteService extends RouteSubscriberBase {
    protected function alterRoutes(RouteCollection $collection) {
        $route = $collection->get('entity.user.canonical');

        $route->setRequirements([
            'user' => '\d+',
            '_access_hello' => '24',
        ]);
    }
}
