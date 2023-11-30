<?php

declare(strict_types=1);

namespace App\Http\Resources\Api;

use App\Http\Resources\Resource;

class Status extends Resource
{
    protected array $columns = [
        'success' => true,
        'message' => '',
        'invalid_params' => [],
        'code' => 0,
    ];

    protected array $optionalColumns = [
        'invalid_params',
    ];

    public static function ok(string $message = '', int $statusCode = 200): static
    {
        $static = new static([
            'success' => true,
            'message' => $message,
        ]);
        $static->withStatus($statusCode);

        return $static;
    }

    public static function error(string $message, int $statusCode = 500, int $code = 0, array $invalidParams = []): static
    {
        $static = new static([
            'success' => false,
            'message' => $message,
            'code' => $code,
        ]);
        if (! empty($invalidParams)) {
            $static->resource['invalid_params'] = $invalidParams;
        }
        $static->withStatus($statusCode);

        return $static;
    }
}
