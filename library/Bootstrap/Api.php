<?php
declare(strict_types=1);

namespace Gewaer\Bootstrap;

use Canvas\Bootstrap\Api as Bootstrap;
use Phalcon\Mvc\Micro;
use Throwable;
use Kanvas\Sdk\Kanvas;
use Canvas\Http\Exception\InternalServerErrorException;

/**
 * Class Api.
 *
 * @package Canvas\Bootstrap
 *
 * @property Micro $application
 */
class Api extends Bootstrap
{
    /**
     * Run the application.
     *
     * @return mixed
     */
    public function run()
    {
        if (empty(getenv('KANVAS_SDK_API_KEY'))) {
            throw new InternalServerErrorException('Error.Need to set KANVAS_SDK_API_KEY on environmental variables file(.env)');
        }
        try {
            Kanvas::setApiKey(getenv('KANVAS_SDK_API_KEY'));
            return $this->application->handle();
        } catch (Throwable $e) {
            $this->handleException($e)->send();
        }
    }
}
