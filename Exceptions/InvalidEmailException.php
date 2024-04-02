<?php

namespace TestCli\Exceptions;

use Exception;

class InvalidEmailException extends Exception
{
    public function __construct(?string $messageKey = "")
    {
        parent::__construct(
            message: "Invalid Email Format: {$messageKey}",
        );
    }
}
