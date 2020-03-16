<?php
declare(strict_types=1);

namespace Gewaer\Models;

use Canvas\Models\Users as CanvasUsers;
use Kanvas\Sdk\Traits\FileSystemModelTrait;
use Kanvas\Sdk\Traits\CustomFieldsTrait;
use Kanvas\Sdk\Traits\PermissionsTrait;

/**
 * Class Users.
 *
 * @package Canvas\Models
 *
 * @property Users $user
 * @property Config $config
 * @property Apps $app
 * @property Companies $defaultCompany
 * @property \Phalcon\Di $di
 */
class Users extends CanvasUsers
{
    use PermissionsTrait;
    use FileSystemModelTrait;
    use CustomFieldsTrait;

    /**
     * Upload Files.
     *
     * @todo move this to the baka class
     * @return void
     */
    public function afterSave()
    {
        // parent::afterSave();
        $this->associateFileSystem();
    }
}
