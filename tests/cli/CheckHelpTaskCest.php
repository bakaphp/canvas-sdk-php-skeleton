<?php

namespace Gewaer\Tests\cli;

use CliTester;

class CheckHelpTaskCest
{
    public function checkHelp(CliTester $I)
    {
        $I->runShellCommand('./runCli');
        $I->seeResultCodeIs(0);
        $I->seeInShellOutput('Woot Kanvas');
    }
}
