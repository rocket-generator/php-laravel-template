<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\AdminUserRepositoryInterface;
use App\Contracts\Services\AdminUserServiceInterface;
use App\Models\AdminUser;

class AdminUserService extends AuthenticatableService implements AdminUserServiceInterface
{
    protected string $resetEmailTitle = 'Reset Password';
    protected string $resetEmailTemplate = 'mails.user.reset_password';
    protected string $passwordResetLink;
    protected string $loginLink;

    public function __construct(
        AdminUserRepositoryInterface $adminUserRepository
    ) {
        $this->authenticatableRepository = $adminUserRepository;
    }

    public function getGuardName(): string
    {
        return 'admin';
    }

    public function getById(string $id): ?AdminUser
    {
        return $this->authenticatableRepository->find($id);
    }

    public function sendPasswordResetEmail(string $email): ?string
    {
        return null;
    }

    public function resetPassword(string $password, string $token): bool
    {
        return false;
    }
}
