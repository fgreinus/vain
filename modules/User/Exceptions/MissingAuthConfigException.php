<?php

namespace Modules\User\Exceptions;

/**
 * MissingAuthConfigException.
 */
class MissingAuthConfigException extends Exception
{
    public function __construct()
    {
        $message = 'Please Ensure a config file is present at app/config/auth.php';

        parent::__construct($message);
    }
}
