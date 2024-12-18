<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\BaseRepositoryInterface;
use App\Models\Base;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;

class BaseRepository implements BaseRepositoryInterface
{
    protected bool $cacheEnabled = false;

    protected string $cachePrefix = 'model';

    protected int $cacheLifeTime = 60; // Minutes

    protected array $querySearchTargets = [];

    public function getEmptyList(): Collection|iterable
    {
        return new Collection;
    }

    public function rules(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }

    public function all($order = null, $direction = null): Collection|iterable
    {
        $query = $this->getBaseQuery();
        if (! empty($order)) {
            $query = $this->setOrderBy($query, $order, $direction);
        }

        $query = $this->queryOptions($query);

        return $query->get();
    }

    public function allByFilterQuery($filter, $order = 'id', $direction = 'asc'): Base|Builder|EloquentBuilder
    {
        $query = $this->buildQueryByFilter($this->getBaseQuery(), $filter);

        return $this->buildOrder($query, $filter, $order, $direction);
    }

    public function allByFilter($filter, $order = 'id', $direction = 'asc'): Collection|iterable
    {
        $query = $this->allByFilterQuery($filter, $order, $direction);

        return $query->get();
    }

    public function getModelClassName(): string
    {
        $model = $this->getBlankModel();

        return \get_class($model);
    }

    public function getBlankModel(): Base|Builder
    {
        return new Base;
    }

    public function getBaseQuery(): Base|Builder
    {
        return $this->getBlankModel();
    }

    public function allEnabled($order = null, $direction = null): Collection|iterable
    {
        $model = $this->getBaseQuery();
        $query = $model->where('is_enabled', '=', true);
        if (! empty($order)) {
            $query = $this->setOrderBy($query, $order, $direction);
        }

        $query = $this->queryOptions($query);

        return $query->get();
    }

    public function get($order = 'id', $direction = 'asc', $offset = 0, $limit = 20, $before = 0, $after = 0): Collection|iterable
    {
        $query = $this->getBaseQuery();

        $query = $this->setBefore($query, $order, $direction, $before);
        $query = $this->setAfter($query, $order, $direction, $after);
        $query = $this->queryOptions($query);
        $query = $this->setOrderBy($query, $order, $direction);

        return $query->skip($offset)->take($limit)->get();
    }

    public function getByFilter($filter, $order = 'id', $direction = 'asc', $offset = 0, $limit = 20, $before = 0, $after = 0): Collection|iterable
    {
        $query = $this->buildQueryByFilter($this->getBaseQuery(), $filter);
        $query = $this->setBefore($query, $order, $direction, $before);
        $query = $this->setAfter($query, $order, $direction, $after);
        $query = $this->buildOrder($query, $filter, $order, $direction);

        return $query->skip($offset)->take($limit)->get();
    }

    public function getEnabled($order = 'id', $direction = 'asc', $offset = 0, $limit = 20, $before = 0, $after = 0): \Illuminate\Support\Collection|array
    {
        $query = $this->getBaseQuery();
        $query = $this->setBefore($query, $order, $direction, $before);
        $query = $this->setAfter($query, $order, $direction, $after);
        $query = $this->queryOptions($query);
        $query = $this->setOrderBy($query, $order, $direction);

        return $query->where('is_enabled', '=', true)->orderBy($order, $direction)->skip($offset)->take($limit)->get();
    }

    public function count(): int
    {
        $model = $this->getBaseQuery();

        return $model->count();
    }

    public function countByFilter($filter): int
    {
        $query = $this->buildQueryByFilter($this->getBaseQuery(), $filter);

        return $query->count();
    }

    public function countEnabled(): int
    {
        $model = $this->getBaseQuery();

        return $model->where('is_enabled', '=', true)->count();
    }

    public function firstByFilter(array $filter, string|array|null $order = null, string|array|null $direction = null): Model|Base|null
    {
        $query = $this->buildQueryByFilter($this->getBaseQuery(), $filter);
        if (! empty($order) && ! empty($direction)) {
            $query = $this->buildOrder($query, $filter, $order, $direction);
        }

        return $query->first();
    }

    public function updateByFilter($filter, $values): int
    {
        $query = $this->buildQueryByFilter($this->getBaseQuery(), $filter);

        $result = $query->update($values);

        if ($result) {
            return $result;
        }

        return 0;
    }

    public function getSQLByFilter($filter): string
    {
        $query = $this->buildQueryByFilter($this->getBaseQuery(), $filter);

        return $query->toSql();
    }

    public function deleteByFilter($filter): int
    {
        $query = $this->buildQueryByFilter($this->getBaseQuery(), $filter);

        return $query->delete();
    }

    public function pluck(\Illuminate\Support\Collection $collection, string $value, ?string $key = null): \Illuminate\Support\Collection
    {
        $items = [];
        foreach ($collection as $model) {
            if (empty($key)) {
                $items[] = $model->{$value};
            } else {
                $items[$model->{$key}] = $model->{$value};
            }
        }

        return Collection::make($items);
    }

    public function firstOrNew($attributes, $values = []): Base
    {
        $model = $this->getBaseQuery();

        return $model->firstOrNew($attributes, $values);
    }

    public function firstOrCreate($attributes, $values = []): Base
    {
        $model = $this->getBaseQuery();

        return $model->firstOrCreate($attributes, $values);
    }

    public function updateOrCreate($attributes, $values = []): Base
    {
        $model = $this->getBaseQuery();

        return $model->updateOrCreate($attributes, $values);
    }

    public function setOrderBy(Base|Builder|EloquentBuilder $query, string $order, ?string $direction = null): Base|Builder|EloquentBuilder
    {
        if ($order === 'random') {
            return $query->inRandomOrder();
        }
        $direction = empty($direction) ? 'asc' : $direction;

        return $query->orderBy($order, $direction);
    }

    protected function setBefore(Base|Builder|EloquentBuilder $query, string|array $order, string|array $direction, mixed $before): Base|Builder|EloquentBuilder
    {
        if ($before === 0) {
            return $query;
        }
        if (is_array($order) && is_array($direction)) {
            foreach ($order as $index => $column) {
                $query = $query->where($column, $direction[$index] === 'desc' ? '>' : '<', $before);
            }

            return $query;
        }

        return $query->where($order, $direction === 'desc' ? '>' : '<', $before);
    }

    protected function setAfter(Base|Builder|EloquentBuilder $query, string|array $order, string|array $direction, mixed $after): Base|Builder|EloquentBuilder
    {
        if ($after === 0) {
            return $query;
        }

        if (is_array($order) && is_array($direction)) {
            foreach ($order as $index => $column) {
                $query = $query->where($column, $direction[$index] === 'desc' ? '<' : '>', $after);
            }

            return $query;
        }

        return $query->where($order, $direction === 'desc' ? '<' : '>', $after);
    }

    /**
     * @param  string[]  $ids
     */
    protected function getCacheKey(array $ids): string
    {
        $key = $this->cachePrefix;
        foreach ($ids as $id) {
            $key .= '-'.$id;
        }

        return $key;
    }

    /**
     * @param  string[]  $orderCandidates
     */
    protected function getWithQueryBuilder(
        Builder $query,
        string $order,
        string $direction,
        int $offset,
        int $limit,
        array $orderCandidates = [],
        string $orderDefault = 'id'
    ): \Illuminate\Support\Collection {
        $order = strtolower($order);
        $direction = strtolower($direction);
        $offset = (int) $offset;
        $limit = (int) $limit;
        $order = \in_array($order, $orderCandidates, true) ? $order : strtolower($orderDefault);
        $direction = \in_array($direction, ['asc', 'desc'], true) ? $direction : 'asc';

        if ($limit <= 0) {
            $limit = 10;
        }
        if ($offset < 0) {
            $offset = 0;
        }

        $query = $this->buildOrder($query, [], $order, $direction);

        $query = $this->queryOptions($query);

        return $query->offset($offset)->limit($limit)->get();
    }

    protected function buildQueryByFilter(Base|Builder|EloquentBuilder $query, array $filter): Base|Builder|EloquentBuilder
    {
        $tableName = $this->getBlankModel()->getTable();

        $query = $this->queryOptions($query);

        if (\count($this->querySearchTargets) > 0 && \array_key_exists('query', $filter)) {
            $searchWord = Arr::get($filter, 'query');
            if (! empty($searchWord)) {
                $query = $query->where(function ($q) use ($searchWord): void {
                    foreach ($this->querySearchTargets as $index => $target) {
                        if ($index === 0) {
                            $q = $q->where($target, 'LIKE', '%'.$searchWord.'%');
                        } else {
                            $q = $q->orWhere($target, 'LIKE', '%'.$searchWord.'%');
                        }
                    }
                });
            }
            unset($filter['query']);
        }

        foreach ($filter as $column => $value) {
            if (\is_array($value)) {
                $query = $query->whereIn($tableName.'.'.$column, $value);
            } else {
                $query = $query->where($tableName.'.'.$column, $value);
            }
        }

        return $query;
    }

    protected function buildOrder(Base|Builder|EloquentBuilder $query, array $filter, string|array $order, string|array $direction): Base|Builder|EloquentBuilder
    {
        if (! empty($order)) {
            if (! is_array($order)) {
                $order = [$order];
            }
            if (! is_array($direction)) {
                $direction = [$direction];
            }
            foreach ($order as $index => $orderElement) {
                $directionElement = empty($direction[$index]) ? 'asc' : $direction[$index];
                $query = $this->setOrderBy($query, $orderElement, $directionElement);
            }
        }

        return $query;
    }

    protected function queryOptions(Base|Builder|EloquentBuilder $query): Base|Builder|EloquentBuilder
    {
        return $query;
    }
}
