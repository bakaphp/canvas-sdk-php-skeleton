<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Phalcon\Http\Response;
use Canvas\Api\Controllers\IndexController as CanvasIndexController;
use Canvas\Canvas;
use Canvas\Resources\Auth;
use Canvas\Resources\Users;

/**
 * Class UsersController.
 *
 * @package Gewaer\Api\Controllers
 *
 * @property Redis $redis
 * @property Beanstalk $queue
 * @property Mysql $db
 * @property \Monolog\Logger $log
 */
class UsersController extends BaseController
{
    /**
     * Constructor.
     *
     * @return void
     */
    public function onConstruct()
    {
        // if (!Canvas::getAuthToken()) {
        //     Canvas::setApiKey('asdeaefaefaefae');
        //     Auth::auth(['email' => 'max@mctekk.com', 'password' => 'nosenose']);
        // }
    }

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
        $auth = Canvas::getAuthToken();
        // Should we set the token before
        $users = Users::all();

        return $this->response($auth);
    }

    /**
     * Get User.
     *
     * @param mixed $id
     *
     * @method GET
     * @url /v1/users/{id}
     *
     * @return Response
     */
    public function getById($id) : Response
    {
        $user = Users::retrieve($id);

        return $this->response($user);
    }

    /**
     * Create new User.
     *
     * @method GET
     * @url /status
     *
     * @return Response
     */
    public function create() : Response
    {
        $request = $this->request->getPost();

        $user = Users::create($request);
        return $this->response($user);
    }

    /**
     * Update User.
     *
     * @method GET
     * @url /status
     *
     * @return Response
     */
    public function edit($id) : Response
    {
        $request = $this->request->getPut();

        $user = Users::update($id, $request);
        return $this->response($user);
    }

    /**
     * Update User.
     *
     * @method GET
     * @url /status
     *
     * @return Response
     */
    public function delete($id) : Response
    {
        $user = Users::delete($id);
        return $this->response($user);
    }
}
