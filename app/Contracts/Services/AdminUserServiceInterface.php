<?php

declare(strict_types=1);

namespace App\Contracts\Services;

use App\Dto\CollectionWithCount;
use App\Models\AdminUser;
use Illuminate\Database\Eloquent\Collection;

interface AdminUserServiceInterface extends AuthenticatableServiceInterface
{
    public function getById(string $id): ?AdminUser;

    public function sendPasswordResetEmail(string $email): ?string;

    public function resetPassword(string $password, string $token): bool;
}
