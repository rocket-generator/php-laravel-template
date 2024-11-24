<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Dto\User as UserDto;
use App\Exceptions\Services\ClientSideException;
use App\Models\User;

class UserService extends AuthenticatableService implements UserServiceInterface
{
    protected string $resetEmailTitle = 'Reset Password';

    protected string $resetEmailTemplate = 'mails.user.reset_password';

    protected string $passwordResetLink;

    protected string $loginLink;

    public function __construct(
        UserRepositoryInterface $UserRepository
    ) {
        parent::__construct(
            $UserRepository,
        );
        $this->authenticatableRepository = $UserRepository;
    }

    public function getGuardName(): string
    {
        return '';
    }

    public function getAuthUser(): UserDto
    {
        /**
         * @var User $user
         */
        $user = auth()->user();
        return UserDto::createFromModel($user);
    }

    public function getById(string $id): ?UserDto
    {
        $user = $this->authenticatableRepository->find($id);
        return UserDto::createFromModel($user);
    }

    public function sendPasswordResetEmail(string $email): ?string
    {
        return null;
    }

    public function resetPassword(string $password, string $token): bool
    {
        return false;
    }

    public function update(string $id, array $data): UserDto
    {
        if (array_key_exists('password', $data) && empty($data['password'])) {
            unset($data['password']);
        }
        $user = $this->authenticatableRepository->find($id);
        if (empty($user)) {
            throw new ClientSideException('User not found', 404);
        }
        $user = $this->authenticatableRepository->update($user, $data);

        return UserDto::createFromModel($user);
    }
}
