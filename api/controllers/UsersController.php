<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Phalcon\Http\Response;
use Canvas\Api\Controllers\IndexController as CanvasIndexController;
use Kanvas\Sdk\Kanvas;
use Kanvas\Sdk\Auth;
use Kanvas\Sdk\Models\Users as SdkUsers;
use Gewaer\Models\Users;

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
        if (!Kanvas::getAuthToken()) {
            Kanvas::setAuthToken($this->userToken);
        }
        $this->model = new Users();
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
        $users = SdkUsers::find();
        return $this->response($users);
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
        $user = SdkUsers::findFirst($id);

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

        $user = SdkUsers::create($request);
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
        $user = SdkUsers::delete($id);
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
    public function getAllCustomFields() : Response
    {
        return $this->response(Users::getAllCustomFields());
    }

    /**
     * Update User.
     *
     * @method GET
     * @url /status
     *
     * @return Response
     */
    public function getCustomFields() : Response
    {
        $request = $this->request->getPost();
        return $this->response(Users::getCustomField($request['name'], $request['custom_fields_module_id']));
    }

    /**
     * Update User.
     *
     * @method GET
     * @url /status
     *
     * @return Response
     */
    public function addCustomFields() : Response
    {
        $request = $this->request->getPost();
        return $this->response(Users::createCustomField($request['name'], (int)$request['field_type_id'], (int)$request['custom_fields_module_id']));
    }
    
}
