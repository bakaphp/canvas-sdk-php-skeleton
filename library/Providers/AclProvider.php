<?php

namespace Gewaer\Providers;

use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;
use Gewaer\Acl\RedisManager;
use Phalcon\Acl;

class AclProvider implements ServiceProviderInterface
{
    /**
     * @param DiInterface $container
     */
    public function register(DiInterface $container)
    {
        //$config = $container->getShared('config');
        $redis = $container->getShared('redis');

        $container->setShared(
            'acl',
            function () use ($redis) {
                $acl = new RedisManager($redis);

                return $acl;
            }
        );
    }
}
