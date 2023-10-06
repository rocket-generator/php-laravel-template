<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Database\Eloquent\Collection;

class CollectionWithCount
{
    public readonly array|Collection $collection;
    public readonly int $count;

    public function __construct(array|Collection $collection, int $count)
    {
        $this->collection = $collection;
        $this->count = $count;
    }

    public static function empty(): self
    {
        return new self(new Collection(), 0);
    }
}
