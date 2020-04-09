<?php

declare(strict_types=1);

namespace Gewaer\Bootstrap;

use Canvas\Bootstrap\Cli as Bootstrap;
use Phalcon\Cli\Console;
use Kanvas\Sdk\Kanvas;

/**
 * Class Cli.
 *
 * @package Canvas\Bootstrap
 *
 * @property Console $application
 */
class Cli extends Bootstrap
{
    /**
     * Run the application.
     *
     * @return mixed
     */
    public function run()
    {
        Kanvas::setApiKey(getenv('KANVAS_SDK_API_KEY'));

        parent::run();
    }
}
