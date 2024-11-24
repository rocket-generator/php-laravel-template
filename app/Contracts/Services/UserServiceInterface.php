<?php

declare(strict_types=1);

namespace App\Contracts\Services;

use App\Dto\User as UserDto;

interface UserServiceInterface extends AuthenticatableServiceInterface
{
    public function getAuthUser(): UserDto;

    public function getById(string $id): ?UserDto;

    public function sendPasswordResetEmail(string $email): ?string;

    public function resetPassword(string $password, string $token): bool;

    public function update(string $id, array $data): UserDto;
}
