<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Models\Base;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;

class UserRepository extends AuthenticatableRepository implements UserRepositoryInterface
{
    public function getBlankModel(): Base|Builder
    {
        return new User;
    }

    protected function buildQueryByFilter(Builder|EloquentBuilder|Base $query, array $filter, ?array $columns = null): Builder|Base|EloquentBuilder
    {
        if (\array_key_exists('query', $filter)) {
            $searchWord = Arr::get($filter, 'query');
            if (! empty($searchWord)) {
                $query = $query->where(function ($q) use ($searchWord): void {
                    $q->where('email', 'LIKE', '%'.$searchWord.'%')
                        ->orWhere('name', 'LIKE', '%'.$searchWord.'%');
                });
            }
            unset($filter['query']);
        }

        return parent::buildQueryByFilter($query, $filter);
    }
}
