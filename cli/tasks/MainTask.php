<?php

namespace Gewaer\Cli\Tasks;

use Phalcon\Cli\Task as PhTask;

/**
 * Class Main.
 *
 * @package Canvas\Cli\Tasks;
 *
 */
class MainTask extends PhTask
{
    /**
     * Init.
     *
     * @return void
     */
    public function mainAction()
    {
        echo 'Woot Kanvas';
    }
}
