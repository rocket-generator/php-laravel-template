<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\App;

class AuthRequest extends Request
{
    protected array $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];
}
