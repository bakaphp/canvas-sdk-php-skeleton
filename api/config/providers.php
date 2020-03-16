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

return [
    ConfigProvider::class,
    AppProvider::class,
    RequestProvider::class,
    RouterProvider::class,
    RegistryProvider::class,
    DatabaseProvider::class,
    MiddlewareProvider::class
];
