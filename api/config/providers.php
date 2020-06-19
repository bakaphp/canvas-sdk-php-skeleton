<?php

/**
 * Enabled providers. Order does matter.
 */

use Canvas\Providers\FileSystemProvider;
use Canvas\Providers\LoggerProvider;
use Canvas\Providers\QueueProvider;
use Canvas\Providers\ResponseProvider;
use Canvas\Providers\ViewProvider;
use Gewaer\Providers\AclProvider;
use Gewaer\Providers\AppProvider;
use Gewaer\Providers\ConfigProvider;
use Gewaer\Providers\DatabaseProvider;
use Gewaer\Providers\MiddlewareProvider;
use Gewaer\Providers\RedisProvider;
use Gewaer\Providers\RegistryProvider;
use Gewaer\Providers\RequestProvider;
use Gewaer\Providers\RouterProvider;

return [
    ConfigProvider::class,
    AppProvider::class,
    RedisProvider::class,
    LoggerProvider::class,
    AclProvider::class,
    RequestProvider::class,
    ResponseProvider::class,
    RouterProvider::class,
    RegistryProvider::class,
    DatabaseProvider::class,
    QueueProvider::class,
    MiddlewareProvider::class,
    ViewProvider::class,
    FileSystemProvider::class
];
