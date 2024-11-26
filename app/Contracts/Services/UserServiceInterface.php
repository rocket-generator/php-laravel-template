<?php

declare(strict_types=1);

namespace App\Contracts\Services;

use App\Dto\User as UserDto;

interface UserServiceInterface extends AuthenticatableServiceInterface
{
    public function getAuthUser(): UserDto;

    public function findUserById(string $id): ?UserDto;

    public function sendPasswordResetEmail(string $email): ?string;

    public function resetPassword(string $password, string $token): bool;

    public function getUsers(int $offset, int $limit, string $order, string $direction, array $filter = []): array;

    public function countUsers(?array $filter = null): int;

    public function createUser(array $data): UserDto;

    public function updateUser(string $id, array $data): UserDto;

    public function deleteUser(string $id): bool;
}
