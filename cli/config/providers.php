<?php

/**
 * Enabled providers. Order does matter.
 */

use Canvas\Providers\CacheDataProvider;
use Gewaer\Providers\ConfigProvider;
use Gewaer\Providers\DatabaseProvider;
use Gewaer\Providers\ErrorHandlerProvider;
use Gewaer\Providers\RedisProvider;
use Gewaer\Providers\AclProvider;
use Gewaer\Providers\AppProvider;
use Gewaer\Providers\RegistryProvider;
use Gewaer\Providers\LoggerProvider;

return [
    ConfigProvider::class,
    LoggerProvider::class,
    RegistryProvider::class,
    AppProvider::class,
    ErrorHandlerProvider::class,
    DatabaseProvider::class,
    CacheDataProvider::class,
    RedisProvider::class,
    AclProvider::class
];
