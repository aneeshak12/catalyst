<?php

namespace TestCli;

$options = getopt("u:p:h:", ["file:", "create_table", "dry_run", "help"]);
validateArguments($options);

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
