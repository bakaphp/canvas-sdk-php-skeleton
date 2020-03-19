<?php

namespace Gewaer\Core;

use Dotenv\Dotenv;
use Phalcon\Loader;

// Register the auto loader
require 'functions.php';

$loader = new Loader();
$namespaces = [
    'Gewaer' => appPath('/library'),
    'Gewaer\Api\Controllers' => appPath('/api/controllers'),
    'Gewaer\Cli\Tasks' => appPath('cli/tasks/'),
    'Niden\Tests' => appPath('/tests'),
    'Gewaer\Tests' => appPath('/tests')
];

$loader->registerNamespaces($namespaces);

$loader->register();

/**
 * Composer Autoloader.
 */
require appPath('vendor/autoload.php');

// Load environment
(new Dotenv(appPath()))->overload();
