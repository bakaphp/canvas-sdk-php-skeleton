<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\FilesystemController as CanvasFilesystemController;
use Gewaer\Models\Filesystem;

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
class FilesystemController extends CanvasFilesystemController
{
    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new FileSystem();
        $this->model->users_id = $this->userData->getId();
        $this->model->companies_id = $this->userData->currentCompanyId();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0'],
            ['companies_id', ':', $this->userData->currentCompanyId()],
            ['apps_id', ':', $this->app->getId()]
        ];
    }
}
