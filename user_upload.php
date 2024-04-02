<?php

namespace TestCli;

use Model\User;
use TestCli\Connection\MysqlConnection;
use TestCli\Services\CsvService;

require_once __DIR__ . '/Connection/MysqlConnection.php';
require_once __DIR__ . '/Services/CsvService.php';
require_once __DIR__ . '/Model/User.php';

$options = getopt("u:p:h:", ["file:", "create_table", "dry_run", "help"]);
if (isset($options["help"])) {
    echo include('help.php');
    exit; 
}

validateArguments($options);

$mysql = new MysqlConnection();
commandSwitcher($options);

function commandSwitcher(array $options)
{
    if (isset($options["create_table"])) {
        $user = new User();
        $user->migrate();

        echo "Table users was created sucessfully";
    } elseif (isset($options["file"]) || isset($options["dry_run"])) {
        $dryRun = isset($options["dry_run"]);
        $messageKey = isset($options["dry_run"]) ? "parsed" : "imported";
        
        $csvService = new CsvService();
        $csvService->parse($dryRun);

        echo "File {$messageKey} sucessfully";
    }
}

function validateArguments(array $options): void
{
    if (isset($options["dry_run"]) && !isset($options["file"])) {
        die("You need to provide --file 'filepath' as well on --dry_run options");
    }

    if (isset($options["file"]) && !is_file($options["file"])) {
        die("Please input valid data for options '--file'");
    }

    if (!isset($options["h"]) || !isset($options["u"]) || !isset($options["p"])) {
        die("Please input valid data for options '-h', '-u', '-p'");
    }
}
