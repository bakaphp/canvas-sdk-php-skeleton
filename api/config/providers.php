<?php

/**
 * Enabled providers. Order does matter.
 */

use Gewaer\Providers\ConfigProvider;
use Gewaer\Providers\RegistryProvider;
use Gewaer\Providers\AppProvider;
use Gewaer\Providers\RouterProvider;
use Gewaer\Providers\RequestProvider;
use Gewaer\Providers\DatabaseProvider;
use Gewaer\Providers\MiddlewareProvider;
use Gewaer\Providers\RedisProvider;
use Gewaer\Providers\AclProvider;
use Canvas\Providers\ResponseProvider;
use Canvas\Providers\QueueProvider;


return [
    ConfigProvider::class,
    AppProvider::class,
    RedisProvider::class,
    AclProvider::class,
    RequestProvider::class,
    ResponseProvider::class,
    RouterProvider::class,
    RegistryProvider::class,
    DatabaseProvider::class,
    QueueProvider::class,
    MiddlewareProvider::class
];
