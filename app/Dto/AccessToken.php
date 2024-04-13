<?php

declare(strict_types=1);

namespace App\Dto;

readonly class AccessToken
{
    public string $accessToken;

    public int $expiresIn;

    public string $tokenType;

    public function __construct(
        string $accessToken,
        int $expiresIn,
        string $tokenType,
    ) {
        $this->accessToken = $accessToken;
        $this->expiresIn = $expiresIn;
        $this->tokenType = $tokenType;
    }
}
