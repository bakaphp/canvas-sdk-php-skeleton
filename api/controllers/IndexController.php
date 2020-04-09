<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Phalcon\Http\Response;
use Canvas\Api\Controllers\IndexController as BakaIndexController;

/**
 * Class IndexController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class IndexController extends BakaIndexController
{
    /**
     * Index.
     *
     * @method GET
     * @url /
     *
     * @return Response
     */
    public function index($id = null) : Response
    {
        return $this->response(['Woot Gewaer']);
    }

    /**
     * Show the status of the diferent services.
     *
     * @method GET
     * @url /status
     *
     * @return Response
     */
    public function status() : Response
    {
        return parent::status();
    }
}
