<?php

declare(strict_types=1);

namespace Gewaer\Middleware;

use Phalcon\Mvc\Micro;
use Canvas\Http\Exception\UnauthorizedException;
use Kanvas\Sdk\Kanvas;
use Kanvas\Sdk\Users;
use Kanvas\Sdk\Auth;

/**
 * Class AuthenticationMiddleware.
 *
 * @package Niden\Middleware
 */
class AuthenticationMiddleware extends TokenBase
{
    /**
     * Call me.
     *
     * @param Micro $api
     * @todo need to check section for auth here
     * @return bool
     */
    public function call(Micro $api)
    {
        $config = $api->getService('config');
        $request = $api->getService('request');

        //cant be empty jwt
        if (empty($request->getBearerTokenFromHeader())) {
            throw new UnauthorizedException('Missing Token');
        }

        /**
         * This is where we will find if the user exists based on
         * the token passed using Bearer Authentication.
         */
        $token = $request->getBearerTokenFromHeader();

        $api->getDI()->setShared(
            'userData',
            function () use ($config, $token, $request) {
                Kanvas::setAuthToken($token);
                return Users::getSelf();
            }
        );

        $api->getDI()->setShared(
            'userToken',
            function () use ($config, $token, $request) {
                Kanvas::setAuthToken($token);
                return Kanvas::getAuthToken();
            }
        );

        return true;
    }
}