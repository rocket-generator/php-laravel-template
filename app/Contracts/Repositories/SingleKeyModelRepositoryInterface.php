<?php

declare(strict_types=1);

namespace App\Contracts\Repositories;

use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface SingleKeyModelRepositoryInterface extends BaseRepositoryInterface
{
    public function getPrimaryKey(): string;

    public function find(string $id, array $with = [], array $withCount = []): Base|null|Model;

    /**
     * @param  string[]  $ids
     * @return Base[]|Collection
     */
    public function allByIds(array $ids, ?string $order = null, ?string $direction = null, bool $reorder = false): Collection|array;

    /**
     * @param  string[]  $ids
     */
    public function countByIds(array $ids): int;

    /**
     * @param  string[]  $ids
     * @return Base[]|Collection
     */
    public function getByIds(array $ids, ?string $order = null, ?string $direction = null, ?int $offset = null, ?int $limit = null): Collection|array;

    public function create(array $input): Base;

    public function dryUpdate(Base $model, array $input): Base;

    public function update(Base $model, array $input): ?Base;

    public function save(Base $model): ?Base;

    public function delete(Base $model): bool;

    public function updateMultipleEntries(string $id, string $parentColumnName, string $targetColumnName, array $list): bool;

    public function updateMultipleEntriesWithFilter(array $filter, string $targetColumnName, array $list): bool;
}
