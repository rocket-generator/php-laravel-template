<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Admin;

use App\Contracts\Repositories\AdminUserRepositoryInterface;

class AdminUsersController extends ResourceController
{
    public function __construct(
        AdminUserRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }
}
