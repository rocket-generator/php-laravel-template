<?php

declare(strict_types=1);

namespace App\Contracts\Repositories;

use App\Models\Base;
use Illuminate\Database\Query\Builder;

/**
 * @method \App\Models\AdminUser[]                    getEmptyList()
 * @method \App\Models\AdminUser[]|array|\Traversable all($order = null, $direction = null)
 * @method \App\Models\AdminUser[]|array|\Traversable get($order, $direction, $offset, $limit)
 * @method \App\Models\AdminUser                      create(array $value)
 * @method \App\Models\AdminUser                      find(int $id)
 * @method \App\Models\AdminUser[]|array|\Traversable allByIds(array $ids, string $order = null, string $direction = null, bool $reorder = false)
 * @method \App\Models\AdminUser[]|array|\Traversable getByIds(array $ids, string $order = null, string $direction = null, int $offset = null, int $limit = null);
 * @method \App\Models\AdminUser update(Base $model, array $input)
 * @method \App\Models\AdminUser save(Base $model);
 * @method \App\Models\AdminUser firstByFilter($filter);
 * @method \App\Models\AdminUser[]|array|\Traversable getByFilter($filter, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\AdminUser[]|array|\Traversable allByFilter($filter, $order = null, $direction = null);
 */
interface AdminUserRepositoryInterface extends AuthenticatableRepositoryInterface
{
    public function getBlankModel(): Base|Builder;
}
