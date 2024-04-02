<?php

namespace TestCli;

use Model\User;
use TestCli\Connection\MysqlConnection;

require_once __DIR__ . '/Connection/MysqlConnection.php';
require_once __DIR__ . '/Model/User.php';

$options = getopt("u:p:h:", ["file:", "create_table", "dry_run", "help"]);
validateArguments($options);

$mysql = new MysqlConnection();
commandSwitcher($options);

function commandSwitcher(array $options)
{
    if (isset($options["create_table"])) {
        $user = new User();
        $user->migrate();

        echo "Table users was created sucessfully";
    }
}

function validateArguments(array $options): void
{
    if (isset($options["file"]) && !is_file($options["file"])) {
        die("Please input valid data for options '--file'");
    }

    if (!isset($options["h"]) || !isset($options["u"]) || !isset($options["p"])) {
        die("Please input valid data for options '-h', '-u', '-p'");
    }
}
