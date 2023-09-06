<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\App;

use App\Http\Resources\Resource;

class Status extends Resource
{
    protected array $columns = [
        'success' => true,
        'message' => '',
        'invalidParams' => [],
    ];

    protected array $optionalColumns = [
        'invalidParams',
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

    public static function error(string $message, int $statusCode = 500, array $invalidParams = []): static
    {
        $static = new static([
            'success' => true,
            'message' => $message,
        ]);
        if(! empty($invalidParams)) {
            $static->resource['invalidParams'] = $invalidParams;
        }
        $static->withStatus($statusCode);

        return $static;
    }
}
