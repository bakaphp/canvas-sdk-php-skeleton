<?php

use Baka\Router\Route;

return [
    Route::post('/auth/forgot')->controller('ApiController')->action('transporter'),
    Route::post('/auth/reset/{key}')->controller('ApiController')->action('transporter')
];