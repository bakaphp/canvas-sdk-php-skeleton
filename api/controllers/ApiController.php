<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Baka\Http\Api\BaseController as BakaBaseController;
use Kanvas\Passthroughs\PhalconPassthrough;

/**
 * Class IndexController.
 *
 * @package Gewaer\Api\Controllers
 *
 * @property Redis $redis
 * @property Beanstalk $queue
 * @property Mysql $db
 * @property \Monolog\Logger $log
 */
class ApiController extends BakaBaseController
{
    use PhalconPassthrough;
}
