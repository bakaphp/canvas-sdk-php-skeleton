<?php

namespace Gewaer\Providers;

use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Di\DiInterface;
use Redis;
use function Baka\envValue;

class RedisProvider implements ServiceProviderInterface
{
    /**
     * @param DiInterface $container
     */
    public function register(DiInterface $container): void
    {
        $container->setShared(
            'redis',
            function () {
                //Connect to redis
                $redis = new Redis();
                $redis->connect(envValue('REDIS_HOST', '127.0.0.1'), (int) envValue('REDIS_PORT', 6379));
                $redis->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP);
                return $redis;
            }
        );
    }
}
