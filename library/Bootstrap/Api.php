<?php
declare(strict_types=1);

namespace Gewaer\Bootstrap;

use Canvas\Bootstrap\Api as Bootstrap;
use Phalcon\Mvc\Micro;
use Throwable;
use Kanvas\Sdk\Kanvas;
use Kanvas\Sdk\Traits\ApiKeyTrait;

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
     * Api Key Trait.
     */
    use ApiKeyTrait;

    /**
     * Run the application.
     *
     * @return mixed
     */
    public function run()
    {
        try {
            Kanvas::setApiKey($this->getSdkKey());
            return $this->application->handle();
        } catch (Throwable $e) {
            $this->handleException($e)->send();
        }
    }
}
