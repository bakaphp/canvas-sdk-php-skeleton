<?php

/**
 * Enabled providers. Order does matter.
 */

use Gewaer\Providers\ConfigProvider;
use Gewaer\Providers\RouterProvider;

return [
    ConfigProvider::class,
    RouterProvider::class,
];
