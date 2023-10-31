<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\AdminUserRepositoryInterface;
use App\Models\AdminUser;
use App\Models\Base;
use Illuminate\Database\Query\Builder;

class AdminUserRepository extends AuthenticatableRepository implements AdminUserRepositoryInterface
{
    public function getBlankModel(): Base|Builder
    {
        return new AdminUser();
    }
}
