<?php

namespace Yng\Console\Exception;

use Exception;

class InvalidOptionException extends Exception
{

    public function __construct($message)
    {
        $this->message = "\033[41;30mInvalidOption!\033[0m\n{$message}";
    }

}
