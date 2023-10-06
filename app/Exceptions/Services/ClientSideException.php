<?php

declare(strict_types=1);

namespace App\Exceptions\Services;

use Exception;

class ClientSideException extends Exception
{
    public const ERROR_UNKNOWN = 0;
    public const ERROR_USER_NOT_FOUND = 1001;
    public const ERROR_INVALID_PARAMETERS = 1002;

    public int $statusCode;
    public int $errorCode;

    public function __construct(string $message, int $statusCode = 400, int $errorCode = 0)
    {
        $this->statusCode = $statusCode;
        $this->errorCode = $errorCode;
        parent::__construct($message, $errorCode, null);
    }

}
