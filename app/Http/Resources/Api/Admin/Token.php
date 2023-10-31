<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\Admin;

use App\Http\Resources\Resource;

class Token extends Resource
{
    protected array $branches = [];

    protected array $columns = [
        'access_token' => '',
        'token_type' => '',
        'expires_in' => '',
        'id' => '',
    ];

    public static function token(string $token, string $id): static
    {
        return new static([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('admin')->factory()->getTTL() * 60,
            'id' => $id,
        ]);
    }
}
