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

    public function findUserById(string $id): ?UserDto
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

    public function updateUser(string $id, array $data): UserDto
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

    public function getUsers(int $offset, int $limit, string $order, string $direction, array $filter = []): array
    {
        $models = $this->authenticatableRepository->getByFilter(
            $filter,
            $order,
            $direction,
            $offset,
            $limit,
        );
        $result = [];
        foreach ($models as $model) {
            $result[] = UserDto::createFromModel($model);
        }

        return $result;
    }

    public function countUsers(?array $filter = null): int
    {
        return $this->authenticatableRepository->countByFilter($filter);
    }


    public function createUser(array $data): UserDto
    {
        $user = $this->authenticatableRepository->create($data);

        return UserDto::createFromModel($user);
    }

    public function deleteUser(string $id): bool
    {
        $user = $this->authenticatableRepository->find($id);
        if (empty($user)) {
            throw new ClientSideException('User not found', 404);
        }
        return $this->authenticatableRepository->delete($user);
    }
}
