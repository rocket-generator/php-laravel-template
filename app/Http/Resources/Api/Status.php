<?php

declare(strict_types=1);

namespace App\Http\Resources\Api;

use App\Http\Resources\Resource;
use Illuminate\Support\Arr;

class Status extends Resource
{
    protected array $columns = [
        'success' => true,
        'detail' => '',
    ];

    protected array $optionalColumns = [
    ];

    public static function ok(string $message = '', int $statusCode = 200): static
    {
        $static = new static([
            'success' => true,
            'detail' => $message,
        ]);
        $static->withStatus($statusCode);

        return $static;
    }

    public static function error(string $message, int $statusCode = 500): static
    {
        $static = new static([
            'success' => false,
            'detail' => $message,
        ]);
        $static->withStatus($statusCode);

        return $static;
    }
}
