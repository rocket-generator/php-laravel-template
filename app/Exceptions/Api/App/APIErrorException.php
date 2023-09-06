<?php

declare(strict_types=1);

namespace App\Exceptions\Api\App;

use App\Http\Resources\Api\App\Status;

class APIErrorException extends \App\Exceptions\Api\APIErrorException
{
    public function getErrorResponse(): Status
    {
        return Status::error($this->apiMessage, $this->statusCode);
    }
}
