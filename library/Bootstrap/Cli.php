<?php

declare(strict_types=1);

namespace Gewaer\Bootstrap;

use Canvas\Bootstrap\Cli as Bootstrap;
use Phalcon\Cli\Console;
use Kanvas\Sdk\Kanvas;
use Kanvas\Sdk\Traits\ApiKeyTrait;

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
        Kanvas::setApiKey($this->validateSdkKey());

        parent::run();
    }
}
