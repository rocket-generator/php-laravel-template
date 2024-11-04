<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Admin;

use App\Contracts\Repositories\UserRepositoryInterface;

class UsersController extends ResourceController
{
    public function __construct(
        UserRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }
}
