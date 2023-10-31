<?php

declare(strict_types=1);

namespace App\Contracts\Services;

use App\Models\AdminUser;

interface AdminUserServiceInterface extends AuthenticatableServiceInterface
{
    public function getById(string $id): ?AdminUser;

    public function sendPasswordResetEmail(string $email): ?string;

    public function resetPassword(string $password, string $token): bool;
}
