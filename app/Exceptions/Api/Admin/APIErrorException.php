<?php

declare(strict_types=1);

namespace App\Exceptions\Api\Admin;

use App\Http\Resources\Api\Admin\Status;

class APIErrorException extends \App\Exceptions\Api\APIErrorException
{
    public function getErrorResponse(): Status
    {
        return Status::error($this->apiMessage, $this->statusCode);
    }
}
