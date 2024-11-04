<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\Auth;

use App\Dto\AccessToken as AccessTokenDto;
use App\Exceptions\Services\ServerSideException;
use App\Http\Resources\Resource;
use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class AccessToken extends Resource
{
    protected array $branches = [];

    protected array $columns = [
        'access_token' => '',
        'token_type' => '',
        'expires_in' => '',
        'id' => '',
        'permissions' => [],
    ];

    public function toArray(Request $request): array|\JsonSerializable|Arrayable
    {
        if (! $this->resource instanceof AccessTokenDto) {
            throw new ServerSideException('Invalid resource');
        }
        /**
         * @var User $user
         */
        $user = auth('app')->user();
        $result = [
            'id' => $user->id,
            'access_token' => $this->resource->accessToken,
            'token_type' => $this->resource->tokenType,
            'expires_in' => $this->resource->expiresIn,
            'permissions' => $user->permissions,
        ];

        return $result;
    }
}
