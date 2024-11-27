<?php

declare(strict_types=1);

namespace App\Dto;

use Carbon\Carbon;

readonly class User
{
    public string $email;

    public string $id;

    public string $name;

    public ?array $permissions;

    public ?string $avatarUrl;

    public Carbon $createdAt;

    public Carbon $updatedAt;

    public const PERMISSION_ADMIN = 'admin';

    public function __construct(
        string $id,
        string $email,
        string $name,
        array $permissions,
        ?string $avatarUrl,
        Carbon $createdAt,
        Carbon $updatedAt,
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->permissions = $permissions;
        $this->avatarUrl = $avatarUrl;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function createFromModel(
        \App\Models\User $model
    ): ?static {
        $permissions = $model->permissions;

        return new static(
            id: $model->id,
            email: $model->email,
            name: $model->name,
            permissions: $permissions,
            avatarUrl: $model->avatar_url,
            createdAt: $model->created_at,
            updatedAt: $model->updated_at,
        );
    }
}
