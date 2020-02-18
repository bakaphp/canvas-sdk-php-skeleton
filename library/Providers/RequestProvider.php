<?php

declare(strict_types=1);

namespace Gewaer\Providers;

use Canvas\Providers\RequestProvider as CanvasRequestProvider;
use Phalcon\DiInterface;
use Gewaer\Http\Request;
use Gewaer\Http\SwooleRequest;
use function Gewaer\Core\isSwooleServer;

class RequestProvider extends CanvasRequestProvider
{
    /**
     * @param DiInterface $container
     */
    public function register(DiInterface $container)
    {
        if (isSwooleServer()) {
            $container->setShared('request', new SwooleRequest());
        } else {
            $container->setShared('request', new Request());
        }
    }
}
