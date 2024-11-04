<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Auth;

class PutMeRequest extends Request
{
    protected array $rules = [
        'name' => 'sometimes',
        'password' => 'sometimes',
    ];
}
