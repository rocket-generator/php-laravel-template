<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\Auth;

use App\Dto\User;
use App\Exceptions\Services\ServerSideException;
use App\Http\Resources\Resource;
use Illuminate\Contracts\Support\Arrayable;

class Me extends Resource
{
    protected array $branches = [];

    protected array $columns = [
        'id' => '',
        'name' => '',
        'email' => 'email',
        'permissions' => [],
    ];

    /**
     * Me constructor.
     *
     * @param  mixed  $resource
     */
    public function __construct(User $resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        if (! $this->resource instanceof User) {
            throw new ServerSideException('Invalid resource');
        }
        $result = [
            'id' => $this->resource->id,
            'email' => $this->resource->email,
            'name' => $this->resource->name,
            'permissions' => $this->resource->permissions,
        ];

        return $result;
    }
}
