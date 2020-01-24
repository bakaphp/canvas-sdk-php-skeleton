<?php

use Baka\Router\RouteGroup;
use Baka\Router\Route;
use Kanvas\Sdk\Routes\RouteConfigurator;
use function Gewaer\Core\appPath;

$publicRoutes = [
    // Route::get('/')->controller('IndexController'),
    Route::get('/status')->controller('IndexController')->action('status'),
    // Route::get('/users')->controller('ApiController')->action('transporter')
    // Route::get('/users')->controller('UsersController')->action('index'),
    // Route::get('/users/{id}')->controller('UsersController')->action('getById')
];

$privateRoutes = [
    // Route::get('/users')->controller('UsersController')->action('index')
];

// Lets merge Kanvas Default Routes with the public Routes since Kanvas routes
$publicRoutes = RouteConfigurator::mergePublicRoutes($publicRoutes, appPath('api/routes/publicRoutes.php'));
$privateRoutes = RouteConfigurator::mergePrivateRoutes($privateRoutes, appPath('api/routes/privateRoutes.php'));

$routeGroup = RouteGroup::from($publicRoutes)
                ->defaultNamespace('Gewaer\Api\Controllers')
                ->defaultPrefix('/v1');

$privateRoutesGroup = RouteGroup::from($privateRoutes)
                ->defaultNamespace('Gewaer\Api\Controllers')
                ->addMiddlewares('auth.jwt@before')
                ->defaultPrefix('/v1');

/**
 * @todo look for a better way to handle this
 */
return array_merge($routeGroup->toCollections(), $privateRoutesGroup->toCollections());
