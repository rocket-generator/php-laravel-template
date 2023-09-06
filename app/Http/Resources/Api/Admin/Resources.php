<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\Admin;

use App\Http\Resources\Resource as BaseResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class Resources extends BaseResource
{
    protected array $columns = [
        'resources' => [],
        'count' => 0,
    ];

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     */
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        $resources = [];
        foreach ($this->resource['resources'] as $resource) {
            $resources[] = $resource->toArray($request);
        }

        return [
            'resources' => $resources,
            'count' => $this->resource['count'],
        ];
    }
}
