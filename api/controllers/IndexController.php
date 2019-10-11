<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Phalcon\Http\Response;
use Canvas\Api\Controllers\IndexController as CanvasIndexController;
use Canvas\Canvas;
use Canvas\Resources\Auth;
use Canvas\Resources\Users;

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
class IndexController extends BaseController
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
        Canvas::setApiKey('asdeaefaefaefae');
        Auth::auth(['email'=> 'max@mctekk.com','password'=>'nosenose']);

        $users = Users::all();

        return $this->response($users);
        return $this->response(['Woot Canvas']);
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
