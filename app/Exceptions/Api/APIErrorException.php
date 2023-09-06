<?php

declare(strict_types=1);

namespace App\Exceptions\Api;

use App\Http\Resources\Resource;
use Illuminate\Http\JsonResponse;

class APIErrorException extends \Exception
{
    protected string $apiMessage = '';
    protected string $errorName = '';
    protected array $extraData = [];
    protected array $config = [];
    protected int $statusCode = 500;

    /**
     * APIErrorException constructor.
     */
    public function __construct(string $message, int $statusCode)
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
