<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Baka\Http\Api\BaseController as BakaBaseController;
use Kanvas\Sdk\Passthroughs\PhalconPassthrough;
use Phalcon\Http\Response;

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
class AclController extends BakaBaseController
{
    public function managePermissions(): Response
    {
        return $this->response('hello');
    }

    /**
     * Verify origin of request.
     *
     * @return void
     */
    private function verifyRequestOrigin(): void
    {
    }
}
