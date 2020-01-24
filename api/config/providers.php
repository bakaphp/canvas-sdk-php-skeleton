<?php

/**
 * Enabled providers. Order does matter.
 */

use Gewaer\Providers\ConfigProvider;
use Gewaer\Providers\RouterProvider;
use Gewaer\Providers\RequestProvider;
use Gewaer\Providers\DatabaseProvider;
use Gewaer\Providers\MiddlewareProvider;

return [
    ConfigProvider::class,
    RequestProvider::class,
    RouterProvider::class,
    DatabaseProvider::class,
    MiddlewareProvider::class
];
