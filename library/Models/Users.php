<?php
declare(strict_types=1);

namespace Gewaer\Models;

use Canvas\Models\Users as CanvasUsers;
use Kanvas\Sdk\Traits\FileSystemModelTrait;
use Kanvas\Sdk\Traits\CustomFieldsTrait;
use Phalcon\Di;

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
class Users extends BaseModel
{
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
