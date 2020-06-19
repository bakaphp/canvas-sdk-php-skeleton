<?php
declare(strict_types=1);

namespace Gewaer\Bootstrap;

use Canvas\Bootstrap\Api as Bootstrap;
use Canvas\Http\Response;
use Kanvas\Sdk\Contracts\ApiKeyTrait;
use Kanvas\Sdk\Resources\Auth;
use Phalcon\Mvc\Micro;
use Throwable;

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
            Auth::setApiKey($this->getSdkKey());
            return $this->application->handle();
        } catch (Throwable $e) {
            $response = new Response();
            $response->handleException($e)->send();
        }
    }
}
