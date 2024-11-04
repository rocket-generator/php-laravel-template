<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Models\Base;
use App\Models\User;
use Illuminate\Database\Query\Builder;

class UserRepository extends AuthenticatableRepository implements UserRepositoryInterface
{
    public function getBlankModel(): Base|Builder
    {
        return new User;
    }
}
