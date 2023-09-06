<?php

declare(strict_types=1);

namespace App\Contracts\Services;

use App\Models\AuthenticatableBase;
use App\Models\Base;
use Illuminate\Contracts\Auth\Authenticatable;

interface AuthenticatableServiceInterface extends BaseServiceInterface
{
    public function signInById(string $id): ?Authenticatable;

    public function signIn(array $input): null|AuthenticatableBase|Authenticatable;

    public function getToken(): null|string;

    public function signUp(array $input, string $uniqueKeyForTracking, string $branchId, string $externalJobId, string $jobRef, string $referrer): null|AuthenticatableBase|Authenticatable;

    public function signOut(): bool;

    public function resignation(): bool;

    public function setUser(AuthenticatableBase $user);

    public function getUser(): Authenticatable|AuthenticatableBase|null;

    public function isSignedIn(): bool;

    public function getGuardName(): string;

    public function create(array $input): Base;

    public function checkPassword(string $id, string $password): bool;

    public function updatePassword(string $id, string $password): bool;
}
