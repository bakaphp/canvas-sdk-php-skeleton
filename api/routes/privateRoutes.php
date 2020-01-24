<?php

use Baka\Router\Route;

return [
    Route::crud('/companies')->controller('ApiController')->action('privateTransporter'),
    Route::crud('/roles')->controller('ApiController')->action('privateTransporter'),
    Route::crud('/locales')->controller('ApiController')->action('privateTransporter'),
    Route::crud('/currencies')->controller('ApiController')->action('privateTransporter'),
    Route::crud('/apps')->controller('ApiController')->action('privateTransporter'),
    Route::crud('/notifications')->controller('ApiController')->action('privateTransporter')
];