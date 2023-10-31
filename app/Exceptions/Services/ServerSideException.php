<?php

declare(strict_types=1);

namespace App\Exceptions\Services;

use Exception;

class ServerSideException extends Exception
{
    public const ERROR_UNKNOWN = 0;

    public int $statusCode;

    public int $errorCode;

    public function __construct(string $message, int $statusCode = 500, int $errorCode = 0)
    {
        $this->statusCode = $statusCode;
        $this->errorCode = $errorCode;
        parent::__construct($message, $errorCode, null);
    }
}
