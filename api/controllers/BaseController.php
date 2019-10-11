<?php
declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Baka\Http\Api\BaseController as BakaBaseController;
use Baka\Http\Contracts\Api\CrudBehaviorTrait;
use Canvas\Canvas;

/**
 * Class BaseController.
 *
 * @package Canvas\Api\Controllers
 *
 */
abstract class BaseController extends BakaBaseController
{
    use CrudBehaviorTrait;

    /**
     * activate softdelete.
     * @var int
     */
    public $softDelete = 1;

    /**
     * Constructor.
     *
     * @return void
     */
    public function onConstruct()
    {
        if (!Canvas::getAuthToken()) {
            Canvas::setApiKey('asdeaefaefaefae');
        }
    }
}
