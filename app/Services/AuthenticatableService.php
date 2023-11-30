<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\AuthenticatableRepositoryInterface;
use App\Contracts\Services\AuthenticatableServiceInterface;
use App\Models\AuthenticatableBase;
use App\Models\Base;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AuthenticatableService extends BaseService implements AuthenticatableServiceInterface
{
    protected AuthenticatableRepositoryInterface $authenticatableRepository;

    public function __construct(
        AuthenticatableRepositoryInterface $authenticatableRepository
    ) {
        $this->authenticatableRepository = $authenticatableRepository;
    }

    public function signInById(string $id): ?Authenticatable
    {
        $user = $this->authenticatableRepository->find($id);
        if (empty($user)) {
            return null;
        }
        $guard = $this->getGuard();
        $guard->login($user);

        return $guard->user();
    }

    public function getGuardName(): string
    {
        return '';
    }

    public function signIn(array $input): null|AuthenticatableBase|Authenticatable
    {
        $guard = $this->getGuard();
        if (! $guard->attempt(['email' => $input['email'], 'password' => $input['password']])) {
            return null;
        }

        return $guard->user();
    }

    public function getToken(): ?string
    {
        $guard = $this->getGuard();
        $user = $guard->user();
        if ($user) {
            return $guard->tokenById($user->id);
        }

        return null;
    }

    public function signUp(array $input, string $uniqueKeyForTracking, string $externalBranchId, string $externalJobId, string $jobRef, string $referrer): null|AuthenticatableBase|Authenticatable
    {
        $existingAuthenticatableBase = $this->authenticatableRepository->findByEmail(Arr::get($input, 'email'));
        if (! empty($existingAuthenticatableBase)) {
            return null;
        }

        $user = $this->create($input);
        if (empty($user)) {
            return null;
        }
        $guard = $this->getGuard();
        $guard->login($user);

        return $guard->user();
    }

    public function create(array $input): Base
    {
        return $this->authenticatableRepository->create($input);
    }

    public function signOut(): bool
    {
        $user = $this->getAuthenticatableBase();
        if (empty($user)) {
            return false;
        }
        $guard = $this->getGuard();
        $guard->logout();
        session()->flush();

        return true;
    }

    public function getAuthenticatableBase(): Authenticatable|AuthenticatableBase|null
    {
        $guard = $this->getGuard();

        return $guard->user();
    }

    public function resignation(): bool
    {
        $user = $this->getAuthenticatableBase();
        if (empty($user)) {
            return false;
        }
        $guard = $this->getGuard();
        $guard->logout();
        session()->flush();
        $this->authenticatableRepository->delete($user);

        return true;
    }

    public function setAuthenticatableBase(AuthenticatableBase $user): void
    {
        $guard = $this->getGuard();
        $guard->login($user);
    }

    public function isSignedIn(): bool
    {
        $guard = $this->getGuard();

        return $guard->check();
    }

    public function checkPassword(string $id, string $password): bool
    {
        $user = $this->authenticatableRepository->find($id);

        return Hash::check($password, $user->password);
    }

    public function updatePassword(string $id, string $password): bool
    {
        $user = $this->authenticatableRepository->find($id);
        $this->authenticatableRepository->update($user, ['password' => $password]);

        return true;
    }

    protected function getGuard(): Guard
    {
        return auth($this->getGuardName());
    }

    public function setUser(AuthenticatableBase $user): void
    {
        $guard = $this->getGuard();
        $guard->login($user);
    }

    public function getUser(): Authenticatable|AuthenticatableBase|null
    {
        return $this->getAuthenticatableBase();
    }
}
