<?php

declare(strict_types=1);

namespace App\Dto;

class Status
{
    public readonly bool $success;

    public function __construct(bool $success)
    {
        $this->success = $success;
    }
}
