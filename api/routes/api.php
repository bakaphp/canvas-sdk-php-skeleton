<?php

use Baka\Router\RouteGroup;
use Baka\Router\Route;
use Kanvas\Sdk\Routes\RouteConfigurator;
use function Canvas\Core\appPath;

$publicRoutes = [
    Route::get('/')->controller('IndexController')->action('index'),
    Route::get('/status')->controller('IndexController')->action('status'),
    Route::post('/login')->controller('AuthController')->action('login'),
    Route::post('/signup')->controller('AuthController')->action('signup')
];

$privateRoutes = [
    Route::get('/users')->controller('UsersController')->action('index'),
    Route::get('/users-custom-fields')->controller('UsersController')->action('getAllCustomFields'),
    Route::post('/custom-fields/users')->controller('UsersController')->action('getCustomFields'),
    Route::post('/users-custom-fields')->controller('UsersController')->action('addCustomFields'),
    Route::post('/custom-fields-modules/{name}')->controller('UsersController')->action('addCustomFieldsModule'),
    Route::post('/acl')->controller('AclController')->action('updatePermissions')
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
