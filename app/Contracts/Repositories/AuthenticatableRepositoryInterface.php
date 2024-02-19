<?php

declare(strict_types=1);

namespace App\Contracts\Repositories;

use App\Models\AuthenticatableBase;
use App\Models\Base;
use Illuminate\Database\Eloquent\Model;

/**
 * @method \App\Models\AuthenticatableBase[] getEmptyList()
 * @method \App\Models\AuthenticatableBase[]|array|\Traversable all($order = null, $direction = null)
 * @method \App\Models\AuthenticatableBase[]|array|\Traversable get($order, $direction, $offset, $limit)
 * @method \App\Models\AuthenticatableBase create(array $value)
 * @method \App\Models\AuthenticatableBase find(int $id)
 * @method \App\Models\AuthenticatableBase[]|array|\Traversable allByIds(array $ids, string $order = null, string $direction = null, bool $reorder = false)
 * @method \App\Models\AuthenticatableBase[]|array|\Traversable getByIds(array $ids, string $order = null, string $direction = null, int $offset = null, int $limit = null);
 * @method \App\Models\AuthenticatableBase update(Base $model, array $input)
 * @method \App\Models\AuthenticatableBase save(Base $model);
 * @method \App\Models\AuthenticatableBase firstByFilter($filter);
 * @method \App\Models\AuthenticatableBase[]|array|\Traversable getByFilter($filter, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\AuthenticatableBase[]|array|\Traversable allByFilter($filter, $order = null, $direction = null);
 */
interface AuthenticatableRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    public function findByEmail(string $email): ?AuthenticatableBase;

    public function updateRawPassword(AuthenticatableBase $user, string $password): AuthenticatableBase|Base|Model;
}
