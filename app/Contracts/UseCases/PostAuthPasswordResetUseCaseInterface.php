<?php

declare(strict_types=1);

namespace App\Contracts\UseCases;

interface PostAuthPasswordResetUseCaseInterface extends BaseUseCaseInterface
{
    public function handle(string $email, string $newPassword, string $token): bool;
}
