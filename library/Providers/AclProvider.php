<?php

namespace Gewaer\Providers;

use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Di\DiInterface;
use Gewaer\Acl\Manager;
use Phalcon\Acl;

class AclProvider implements ServiceProviderInterface
{
    /**
     * @param DiInterface $container
     */
    public function register(DiInterface $container): void
    {
        //$config = $container->getShared('config');
        $redis = $container->getShared('redis');

        $container->setShared(
            'acl',
            function () use ($redis) {
                $acl = new Manager($redis);

                return $acl;
            }
        );
    }
}
