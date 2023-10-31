<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\Admin;

use App\Http\Resources\Resource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class Me extends Resource
{
    protected array $branches = [];

    protected array $columns = [
        'id' => '',
        'name' => '',
        'email' => 'email',
    ];

    /**
     * Me constructor.
     *
     * @param  mixed  $resource
     */
    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array|\JsonSerializable|Arrayable
    {
        return parent::toArray($request);
    }
}
