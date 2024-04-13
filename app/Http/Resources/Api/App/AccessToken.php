<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\App;

use App\Dto\AccessToken as AccessTokenDto;
use App\Http\Resources\Resource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class AccessToken extends Resource
{
    protected array $columns = [
        'access_token' => '',
        'expires_in' => '',
        'token_type' => '',
    ];

    /**
     * AccessToken constructor.
     *
     * @param  mixed  $resource
     */
    public function __construct(AccessTokenDto $resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     */
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        $result = [
            'access_token' => $this->resource->accessToken,
            'expires_in' => $this->resource->expiresIn,
            'token_type' => $this->resource->tokenType,
        ];

        return $result;
    }
}
