<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Validation as CanvasValidation;
use Gewaer\Models\Users;
use Kanvas\Sdk\Resources\CustomFieldsModules;
use Kanvas\Sdk\Resources\Users as SdkUsers;
use Phalcon\Http\Response;
use Phalcon\Validation\Validator\PresenceOf;

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
        // print_r(Auth::getClient()->getAuthToken());
        // die();
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
     *
     * @return Response
     */
    public function getAllCustomFields() : Response
    {
        return $this->response($this->userData->getAllCustomFields());
    }

    /**
     * Update User.
     *
     * @method GET
     *
     * @return Response
     */
    public function getCustomFields() : Response
    {
        $request = $this->request->getPostData();

        $validation = new CanvasValidation();
        $validation->add('name', new PresenceOf(['message' => 'The name is required.']));
        $validation->add('custom_fields_module_id', new PresenceOf(['message' => 'The custom_fields_module_id is required.']));
        $validation->validate($request);

        $customFieldsModule = CustomFieldsModules::findFirst($request['custom_fields_module_id']);

        return $this->response($this->userData->getCustomField($request['name'], (int)$customFieldsModule->id));
    }

    /**
     * Update User.
     *
     * @method POST
     *
     * @return Response
     */
    public function addCustomFields() : Response
    {
        $request = $this->request->getPostData();

        $validation = new CanvasValidation();
        $validation->add('name', new PresenceOf(['message' => 'The name is required.']));
        $validation->add('field_type_id', new PresenceOf(['message' => 'The fields_type_id is required.']));
        $validation->add('custom_fields_module_id', new PresenceOf(['message' => 'The custom_fields_module_id is required.']));
        $validation->validate($request);

        $customFieldsModule = CustomFieldsModules::findFirst($request['custom_fields_module_id']);

        return $this->response(Users::createCustomField($request['name'], (int)$request['field_type_id'], (int)$customFieldsModule->id));
    }

    /**
     * Update User.
     *
     * @method GET
     * @url /status
     *
     * @param string $name
     *
     * @return Response
     */
    public function addCustomFieldsModule(string $name) : Response
    {
        return $this->response(Users::createCustomFieldsModule($name));
    }
}
