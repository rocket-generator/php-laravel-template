<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Auth;

class SignUpRequest extends Request
{
    protected array $rules = [
        'email' => 'required|email',
        'password' => 'required',
        'name' => 'required',
    ];
}
