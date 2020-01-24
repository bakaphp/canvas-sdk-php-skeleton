<?php
declare(strict_types=1);

namespace Gewaer\Providers;

use function Gewaer\Core\appPath;
use Phalcon\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Config;
use Kanvas\Sdk\Kanvas;
use Kanvas\Sdk\Auth;

class SdkProvider implements ServiceProviderInterface
{
    /**
     * @param DiInterface $container
     */
    public function register(DiInterface $container)
    {
        $container->setShared(
            'kanvas',
            function () {
                if (!Kanvas::getAuthToken()) {
                    Kanvas::setApiKey(getenv('KANVAS_SDK_API_KEY'));
                    Auth::auth(['email' => getenv('KANVAS_SDK_USER_EMAIL'), 'password' => getenv('KANVAS_SDK_USER_PASS')]);
                }
            }
        );
    }
}
