<?php

declare(strict_types=1);

namespace App\Dto;

readonly class AccessToken
{
    public string $accessToken;

    public int $expiresIn;

    public string $tokenType;

    public array $permissions;

    public function __construct(
        string $accessToken,
        int $expiresIn,
        string $tokenType,
        array $permissions = [],
    ) {
        $this->accessToken = $accessToken;
        $this->expiresIn = $expiresIn;
        $this->tokenType = $tokenType;
        $this->permissions = $permissions;
    }
}
