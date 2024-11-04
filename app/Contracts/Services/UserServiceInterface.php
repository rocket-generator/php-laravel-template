<?php

declare(strict_types=1);

namespace App\Contracts\Services;

use App\Dto\User as UserDto;
use App\Models\User;

interface UserServiceInterface extends AuthenticatableServiceInterface
{
    public function getById(string $id): ?User;

    public function sendPasswordResetEmail(string $email): ?string;

    public function resetPassword(string $password, string $token): bool;

    public function update(string $id, array $data): UserDto;
}
