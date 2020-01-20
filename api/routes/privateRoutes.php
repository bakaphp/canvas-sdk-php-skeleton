<?php

use Baka\Router\Route;

return [
    Route::crud('/companies')->controller('ApiController')->action('transporter'),
    Route::crud('/roles')->controller('ApiController')->action('transporter'),
    Route::crud('/locales')->controller('ApiController')->action('transporter'),
    Route::crud('/currencies')->controller('ApiController')->action('transporter'),
    Route::crud('/apps')->controller('ApiController')->action('transporter'),
    Route::crud('/notifications')->controller('ApiController')->action('transporter')
];