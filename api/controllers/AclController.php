<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Baka\Http\Api\BaseController as BakaBaseController;
use Phalcon\Http\Response;
use Kanvas\Sdk\Kanvas;
use Kanvas\Sdk\Apps;
use Exception;

/**
 * Class AclController.
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
    }

    /**
     * Update ACL Permissions.
     *
     * @return Response
     */
    public function updatePermissions(): Response
    {
        $appKey = $this->request->getPostData()['key'];
        $aclArray = $this->request->getPostData()['acl'];

        $this->verifyRequestOrigin($appKey);

        $this->processAclPermissions($aclArray);

        return $this->response(true);
    }

    /**
     * Verify origin of request.
     *
     * @param string $key
     * @return void
     */
    private function verifyRequestOrigin(string $key): void
    {
        $adminApp = Apps::findFirstByKey($key);

        if (!($adminApp == getenv('DEFAULT_ADMIN_APP'))) {
            throw new Exception('App key given is not an admin app');
        }
    }

    /**
     * Process Roles.
     *
     * @param array $aclArray
     * @return void
     */
    private function processAclPermissions(array $aclArray): void
    {
        foreach ($aclArray as $aclElement) {
            $this->processRole($aclElement['role']);
            $this->processResource($aclElement['resource']);
            $this->processPermissions($aclElement['role'], $aclElement['resource'], $aclElement['permissions']);
        }
    }

    /**
     * Process Role.
     *
     * @param string $role
     * @return void
     */
    private function processRole(string $role): void
    {
        if (!$this->acl->isRole($role)) {
            $this->acl->addRole($role);
        }
    }

    /**
     * Process Resource.
     *
     * @param string resource
     * @return void
     */
    private function processResource(string $resource): void
    {
        if (!$this->acl->isResource($resource)) {
            $this->acl->addResource($resource);
        }
    }

    /**
     * Process Permissions.
     *
     * @param string $role
     * @param string $resource
     * @param array $permissions
     * @return void
     */
    private function processPermissions(string $role, string $resource, array $permissions): void
    {
        if (array_key_exists('allow', $permissions)) {
            $this->acl->allow($role, $resource, $permissions['allow']);
        } else {
            $this->acl->allow($role, $resource, $permissions['deny']);
        }
    }
}
