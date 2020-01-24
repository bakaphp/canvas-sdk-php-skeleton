<?php

use Baka\Router\Route;

return [
    Route::get('/')->controller('ApiController')->action('publicTransporter'),
    Route::post('/auth')->controller('ApiController')->action('publicTransporter'),
    Route::post('/refresh-token')->controller('ApiController')->action('publicTransporter'),
    Route::post('/users')->controller('ApiController')->action('publicTransporter'),
    Route::post('/auth/forgot')->controller('ApiController')->action('publicTransporter'),
    Route::post('/auth/reset/{key}')->controller('ApiController')->action('publicTransporter'),
    Route::get('/users-invite/validate/{hash}')->controller('ApiController')->action('publicTransporter'),
    Route::post('/users-invite/{hash}')->controller('ApiController')->action('publicTransporter'),
    Route::post('/webhook/payments')->controller('ApiController')->action('publicTransporter'),
    Route::get('/apps/{key}/settings')->controller('ApiController')->action('publicTransporter'),
    Route::post('/users/social')->controller('ApiController')->action('publicTransporter')
];
