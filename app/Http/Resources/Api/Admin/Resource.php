<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\Admin;

use App\Http\Resources\Resource as BaseResource;
use App\Models\Base;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class Resource extends BaseResource
{
    /**
     * Resource constructor.
     *
     * @param  mixed  $resource
     */
    public function __construct(Base $resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array|\JsonSerializable|Arrayable
    {
        /**
         * @var Base $this->resource
         */
        $data = $this->resource->toArray();
        foreach ($this->resource->getBigIntegerColumns() as $column) {
            $data[$column] = (string) $data[$column];
        }

        return $data;
    }
}
