<?php

declare(strict_types=1);

namespace App\Exceptions\Api;

use App\Http\Resources\Resource;

class APIErrorException extends \Exception
{
    protected string $apiMessage = '';

    protected string $errorName = '';

    protected array $extraData = [];

    protected array $config = [];

    public readonly int $statusCode;

    /**
     * APIErrorException constructor.
     */
    public function __construct(string $message, int $statusCode = 500)
    {
        $this->apiMessage = $message;
        $this->statusCode = $statusCode;
        parent::__construct($message, $statusCode, null);
    }

    public function getErrorResponse(): Resource
    {
        return (new \App\Http\Resources\Resource(null))->withStatus(500);
    }
}
