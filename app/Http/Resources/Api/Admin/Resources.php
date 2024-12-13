<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\Admin;

use App\Http\Resources\Resource as BaseResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class Resources extends BaseResource
{
    protected array $columns = [
        'data' => [],
        'count' => 0,
    ];

    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array|\JsonSerializable|Arrayable
    {
        $resources = [];
        foreach ($this->resource['resources'] as $resource) {
            $object = new Resource($resource);
            $resources[] = $object->toArray($request);
        }

        return [
            'data' => $resources,
            'count' => $this->resource['count'],
        ];
    }
}
